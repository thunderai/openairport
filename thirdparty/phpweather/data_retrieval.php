<?php

require_once(PHPWEATHER_BASE_DIR . '/db_layer.php');

/**
 * This class contains all the logic needed to get and store METARs and TAFs.
 *
 * It manages the caching system, the station, the METAR and the TAF.
 *
 * @author	Martin Geisler <gimpster@gimpster.com>
 * @version	data_retrieval.php,v 1.41 2004/06/17 13:10:43 gimpster Exp
 */
class data_retrieval extends db_layer {

  /**
   * The METAR is stored here.
   *
   * The property is used whenever someone wants access to the raw
   * METAR. This should be used for reading only, if you want to
   * change the METAR (for testing purposes etc.), then use
   * set_metar() instead.
   *
   * @var string
   * @see set_metar()
   */
  var $metar;
  var $metar_time;
  var $metar_arch;

  /**
   * The TAF is stored here.
   *
   * The property is used whenever someone wants access to the raw
   * TAF. This should be used for reading only, if you want to
   * change the TAF (for testing purposes etc.), then use
   * set_taf() instead.
   *
   * @var string
   * @see set_taf()
   */
  var $taf;

  /**
   * Data associated with the current ICAO.
   *
   * @var  array  The array has three entries: name, country,
   *              and country code of the ICAO.
   */
  var $icao_data;

  var $time_from;
  var $time_to;

  /**
   * Constructor
   *
   * This sets the station.
   *
   * @access	private
   * @param	array   The initial properties of the object.
   */
  function data_retrieval($input = array()) {
    /* We start by calling the parent constructor. */
    $this->db_layer($input);
    
    /* Then we set the station. */
    $this->set_icao($this->properties['icao']);

    $this->metar = false;
    $this->metar_time = false;
    $this->metar_arch = false;
    $this->time_from = false;
    $this->time_to = false;

  }

  /**
   * Returns the current ICAO.
   *
   * @access	public
   * @return	string	 The ICAO of the current station.
   */
  function get_icao() {
    return $this->properties['icao'];
  }
  
  /**
   * Sets the station or rather the ICAO.
   *
   * It also clears the METAR and the decoded METAR data if the ICAO
   * is different from the old one. If the new ICAO is the same as the
   * old one, nothing is changed.
   *
   * @access	public
   * @param	string   The ICAO of the new station.
   */
  function set_icao($new_icao) {
    
    /* We start by adding slashes, since $new_icao might come directly
     * from the user.
     */
    $new_icao = addslashes($new_icao);
    if ($new_icao != $this->get_icao()) {
      $this->properties['icao'] = strtoupper($new_icao);
      $this->icao_data = false;
      $this->metar = false;
      $this->metar_time = false;
      $this->decoded_metar = false;
      $this->metar_arch = false;
      $this->taf = false;
      $this->decoded_taf = false;
    }
  }

  function set_times($time_from=false, $time_to=false) {
    $this->time_from = $time_from;
    $this->time_to = $time_to;
  }

  /**
   * Retrieves a raw METAR, either from the web or from a database.
   *
   * If the METAR is already set, then it just returns that. If it's
   * not set, then it tries to get it from the database.
   *
   * @access	public
   * @return	string   The raw METAR.
   */
  function get_metar() {

    if (empty($this->metar)) {
      /* The METAR is not set - we try to load it */
      $this->debug('The METAR is not set, I\'ll try to find the METAR in the database.');
      return $this->get_metar_from_db();
    } else {
      $this->debug('The METAR was set - I\'ll just use that.');
      return $this->metar;
    }
  }

  /**
   * Sets the METAR directly, for testing etc
   *
   * It loads and decodes the METAR if it is different from the old
   * one. If the new METAR is the same as the old one, nothing is
   * changed.
   *
   * Also sets the ICAO to be correct for this METAR.
   *
   * @access	public
   * @param	string   The METAR we want decoded.
   */
  function set_metar($new_metar) {

    if ($new_metar != $this->get_metar()) {
      $this->debug('Loading a METAR manually.');
      $this->properties['icao'] = strtoupper(substr($new_metar,0,4));
      $this->icao_data = $this->db->lookup_icao($this->get_icao());
      $this->metar = $new_metar;
      $this->decoded_metar = $this->decode_metar();
    }
  }

  /**
   * Retrieves a file using fsockopen().
   *
   * The communication with the proxy (if one is needed) and the host
   * is done using fsockopen(). This should be used when the file()
   * function is disabled.
   *
   * @access  private
   * @param   string   The host
   * @param   string   The location of the file
   * @return  array    The raw file line by line in an array.
   */
  function get_file_socket($host,$location) {
    $request = "HTTP/1.1\r\n" .
      "If-Modified-Since: Sat, 29 Oct 1994 09:00:00 GMT\r\n" .
      "Pragma: no-cache\r\n".
      "Cache-Control: no-cache\r\n";

    if ($this->properties['use_proxy']) { 
      /* We use a proxy */
      $fp = @fsockopen($this->properties['proxy_host'],
                       $this->properties['proxy_port']);
      $request = "GET http://$host$location $request" .
        "Host: $host\r\n" .
        "Content-Type: text/html\r\n" .
        "Connection: Close\r\n\r\n";
    } else {
      $fp = @fsockopen($host, 80);
      $request = "GET $location $request" .
        "Host: $host\r\n" .
        "Content-Type: text/html\r\n" .
        "Connection: Close\r\n\r\n";
    }

    $data = false;

    if ($fp) {
      fputs($fp, $request);
      /* We check the status line */
      if (strpos(fgets($fp, 1024), '200 ')) {
        /* Then we seek until we find the empty line between the
         * headers and the contents.
         */
        do {
          $line = fgets($fp, 1024);
        } while ($line != "\r\n");

        /* We know now, that the following lines are the contents. */
        while ($line = fgets($fp, 1024)) {
          $data[] = $line;
        }
        fclose($fp);
      }
    }

    return $data;
  }

  /**
   * Retrieves a METAR report using fsockopen().
   *
   * The communication with the proxy (if one is needed) and the NWS
   * is done using fsockopen(). This should be used when the file()
   * function is disabled.
   *
   * @access  private
   * @param   string   The ICAO for which the report will be fetched.
   * @return  array    The raw METAR report line by line in an array.
   * @see     get_metar_file()
   */
  function get_metar_socket($icao) {
    $host = 'weather.noaa.gov';
    $location = "/pub/data/observations/metar/stations/$icao.TXT";
    return $this->get_file_socket($host,$location);
  }

  /**
   * Retrieves a METAR report using file().
   *
   * The communication with the NWS is done using file(). This should
   * only be used when a direct connection to the NWS can be
   * established, the proxy settings isn't used with file().
   *
   * @access  private
   * @param   string   The ICAO for which the report will be fetched.
   * @return  array    The raw METAR report line by line in an array.
   * @see     get_metar_socket()
   */
  function get_metar_file($icao) {
    $host = 'weather.noaa.gov';
    $location = "/pub/data/observations/metar/stations/$icao.TXT";
    return @file('http://' . $host . $location);
  }


  /**
   * Tries to get a METAR from the database.
   *
   * It looks in the database, and fetches a new METAR if necessary.
   * You do not have to be connected to the database before you call
   * this function, just make sure that you have passed the right
   * properties to the object.
   *
   * If $this->properties['always_use_db'] is True, then it ignores
   * the timestamp of the METAR and just returns it. Otherwise it will
   * try to get a new METAR from the web, if the old one is older than
   * one hour.
   *
   * @access	public
   * @return	string   The raw METAR.
   */
  function get_metar_from_db() {

    if (!$this->db->connect()) {
      return false;
    }

    $tmp_metar = false;
    
    if ($data = $this->db->get_metar($this->get_icao())) { /* found station */
      $this->debug('get_metar_from_db(): Found the METAR in the database');
      list($metar, $timestamp, $time) = end($data);
      reset($data);

      /* We set the METAR right away, and then count on
       * get_metar_from_web() to set it to something else, if
       * necessary.
       */
      $tmp_metar = $metar;
      $this->metar = $metar;
      $this->metar_time = $time;
      
      if ($this->properties['always_use_db'] ||
          $timestamp > time() - $this->properties['cache_timeout']) {
	/* We have asked explicit for a cached METAR, or the METAR is
         * still fresh. Either way - we return the METAR we found in
         * the database.
         */
        $this->debug('get_metar_from_db(): Using previously cached METAR for <code>' .
                     $this->get_location() . '</code>. The METAR expires in ' .
                     ($timestamp + $this->properties['cache_timeout'] - time()) .
                     ' seconds.');
	$tmp_metar = $metar;
      } else {
	/* The METAR is too old, so we fetch new */
	$this->debug('get_metar_from_db(): The METAR for <code>' .
		     $this->get_location() . '</code> was ' . 
		     (time() - $this->properties['cache_timeout'] - $timestamp) .
		     ' seconds too old.');
	$tmp_metar = $this->get_metar_from_web(false);
      }
      
    } else {
      /* We need to get a new METAR from the web. */
      $this->debug('get_metar_from_db(): New station <code>' .
		   $this->get_location() . '</code> - fetching a new METAR.');
      $tmp_metar = $this->get_metar_from_web(true);
    }

    /* Now we can get the archive METARs. */
    $this->metar_arch = false;
    if ($this->time_from !== false) {
      if ($data = $this->db->get_metar($this->get_icao(),
                                       $this->time_from,
                                       $this->time_to)) { 
	for($i = 0; $i < count($data); $i++) {
	  $this->metar_arch[$i] = array('metar' => $data[$i][0], 
					'time'  => $data[$i][2]);
	}
      }
    }

    return $tmp_metar;
  }
  

  /**
   * Fetches a METAR from the Internet.
   *
   * The METAR is fetched via HTTP from the National Weather Services
   * public server. The files can be found under the
   * http://weather.noaa.gov/pub/data/observations/metar/stations/
   * directory as ICAO.TXT where ICAO is replaced by the actual ICAO.
   *
   * @param boolean   Should the station be inserted into the database,
   * or should we update an already existing entry?
   * @access	public
   * @return	string   The raw METAR.
   */
  function get_metar_from_web($new_station) {
    $metar = '';
    $icao = $this->get_icao();
    
    switch ($this->properties['fetch_method']) {
    case 'file':
      $metar_data = $this->get_metar_file($icao);
      break;
    case 'fsockopen':
    default:
      $metar_data = $this->get_metar_socket($icao);
      break;
    }

    /* Here we test to see if we actually got a METAR. */
    if (!empty($metar_data)) {
      /* The first line in the file is the date */
      $date = trim(array_shift($metar_data));

      /* The remaining lines are the METAR itself. This will merge the
       * remaining lines into one line by removing new-lines:
       */
      $metar = ereg_replace("[\n\r ]+", ' ', trim(implode(' ', $metar_data)));
      
      $date = explode(':', strtr($date, '/ ', '::'));
      if ($date[2] > gmdate('j')) {
        /* The day is greater that the current day of month. This
         * implies, that the report is from last month.  Luckily the
         * gmmktime function can deal with the month being zero, it
         * will then interpret it as December the previous year which
         * is exactly what we want.
         */
        $date[1]--;
      }
      $timestamp = gmmktime($date[3], $date[4], 0,
                            $date[1], $date[2], $date[0]);
      $metar_time =  $timestamp;
      
      if (!ereg('[0-9]{6}Z', $metar)) {
        /* Some reports don't even have a time-part, so we insert the
         * current time. This might not be the time of the report, but
         * it was broken anyway :-)
         */
        $metar = gmdate('dHi', $timestamp) . 'Z ' . $metar;
      }

      if ($timestamp < (time() - $this->properties['cache_timeout'] + 300)) {
        /* The timestamp in the METAR is more than 55 minutes old. We
         * adjust the timestamp, so that we won't try to fetch a new
         * METAR within the next 5 minutes. After 5 minutes, the
         * timestamp will again be more than 1 hour old.
         */
	$timestamp = time() - $this->properties['cache_timeout'] + 300;
      }
    } else {
      /* If we end up here, it means that there was no file. If the
       * station was a new station, we set the metar to an empty
       * string, else we just use the old METAR. We adjust the time
       * stored in the database in both cases, so that the server
       * isn't stressed too much.
       */
      if ($new_station) {
	$metar = '';
      } else {
	$metar = $this->metar;
      }
      $timestamp = time() - $this->properties['cache_timeout'] + 600;
      /* We don't have a METAR, so let's date it way back to 1970. */
      $metar_time = 0;
    }

    /* We then cache the METAR in our database */
    if ($new_station) {
      $this->debug('get_metar_from_web(): Inserting new METAR for <code>' .
                   $this->get_location() . '</code>');
      $this->db->insert_metar($icao, $metar, $timestamp, $metar_time);
    } else {
      $this->debug('get_metar_from_web(): Updating METAR for <code>' .
                   $this->get_location() . '</code>');
      $this->db->update_metar($icao, $metar, $timestamp, $metar_time);
   }
    /* We update and return the METAR */
    $this->metar = $metar;
    $this->metar_time = $metar_time;

    return $metar;
  }

 /**
   * Retrieves a raw TAF, either from the web or from a database.
   *
   * If the TAF is already set, then it just returns that. If it's
   * not set, then it tries to get it from the database.
   *
   * @access	public
   * @return	string   The raw TAF.
   */
  function get_taf() {
    if (empty($this->taf)) {
      /* The TAF is not set - we try to load it */
      $this->debug('The TAF is not set, I\'ll try to find the TAF in the database.');
      return $this->get_taf_from_db();
    } else {
      $this->debug('The TAF was set - I\'ll just use that.');
      return $this->taf;
    }
  }

  /**
   * Sets the TAF directly, for testing etc
   *
   * It loads and decodes the TAF if it is different from the old
   * one. If the new TAF is the same as the old one, nothing is
   * changed.
   *
   * Also sets the ICAO to be correct for this TAF.
   *
   * @access	public
   * @param	string   The TAF we want decoded.
   * @param	string   The icao of the station.
   */
  function set_taf($new_taf) {

    if ($new_taf != $this->get_taf()) {
      $this->debug('Loading a TAF manually.');
      $this->properties['icao'] = strtoupper(substr($new_taf,0,4));
      $this->icao_data = $this->db->lookup_icao($this->get_icao());
      $this->taf = $new_taf;
      $this->decoded_taf = $this->decode_taf();
    }
  }

  /**
   * Retrieves a TAF report using fsockopen().
   *
   * The communication with the proxy (if one is needed) and the NWS
   * is done using fsockopen(). This should be used when the file()
   * function is disabled.
   *
   * @access  private
   * @param   string   The ICAO for which the report will be fetched.
   * @return  array    The raw TAF report line by line in an array.
   * @see     get_taf_file()
   */
  function get_taf_socket($icao) {
    $host = 'weather.noaa.gov';
    $location = "/pub/data/forecasts/taf/stations/$icao.TXT";
    return $this->get_file_socket($host,$location);
  }

  /**
   * Retrieves a TAF report using file().
   *
   * The communication with the NWS is done using file(). This should
   * only be used when a direct connection to the NWS can be
   * established, the proxy settings isn't used with file().
   *
   * @access  private
   * @param   string   The ICAO for which the report will be fetched.
   * @return  array    The raw TAF report line by line in an array.
   * @see     get_taf_socket()
   */
  function get_taf_file($icao) {
    $host = 'weather.noaa.gov';
    $location = "/pub/data/forecasts/taf/stations/$icao.TXT";
    $this->debug("getting TAF from location: http://$host/$location");
    return @file('http://' . $host . $location);
  }

  /**
   * Tries to get a TAF from the database.
   *
   * It looks in the database, and fetches a new TAF if necessary.
   * You do not have to be connected to the database before you call
   * this function, just make sure that you have passed the right
   * properties to the object.
   *
   * If $this->properties['always_use_db'] is True, then it ignores
   * the timestamp of the TAF and just returns it. Otherwise it will
   * try to get a new TAF from the web, if the old one is older than
   * one hour.
   *
   * @access	public
   * @return	string   The raw TAF.
   */
  function get_taf_from_db() {
    if (!$this->db->connect()) {
      return false;
    }
    
    if ($data = $this->db->get_taf($this->get_icao())) { /* found station */
      $this->debug('get_taf_from_db(): Found the TAF in the database');
      list($taf, $timestamp) = $data;

      /* We set the TAF right away, and then count on
       * get_taf_from_web() to set it to something else, if
       * necessary.
       */
      $this->taf = $taf;
      if ($this->properties['always_use_db'] ||
          $timestamp > time() - $this->properties['cache_timeout']) {
  
        /* We have asked explicit for a cached TAF, or the TAF is
         * still fresh. Either way - we return the TAF we found in
         * the database.
         */
        $this->debug('get_taf_from_db(): Using previously cached TAF for <code>' .
                     $this->get_location() . '</code>. The TAF expires in ' .
                     ($timestamp + $this->properties['cache_timeout'] - time()) .
                     ' seconds.');
	return $taf;
      } else {
        /* The TAF is too old, so we fetch new */
	$this->debug('get_taf_from_db(): The TAF for <code>' .
                     $this->get_location() . '</code> was ' . 
                     (time() - $this->properties['cache_timeout'] - $timestamp) .
                     ' seconds too old.');
	return $this->get_taf_from_web(false);
      }
    } else {
      /* We need to get a new TAF from the web. */
      $this->debug('get_taf_from_db(): New station <code>' .
                   $this->get_location() . '</code> - fetching a new TAF.');
      return $this->get_taf_from_web(true);
    }

  }

   /**
   * Fetches a TAF from the Internet.
   *
   * The TAF is fetched via HTTP from the National Weather Services
   * public server. The files can be found under the
   * http://weather.noaa.gov/pub/data/observations/taf/stations/
   * directory as ICAO.TXT where ICAO is replaced by the actual ICAO.
   *
   * @param boolean   Should the station be inserted into the database,
   * or should we update an already existing entry?
   * @access	public
   * @return	string   The raw TAF.
   */
  function get_taf_from_web($new_station) {
 
    $taf = '';
    $icao = $this->get_icao();
    
    switch ($this->properties['fetch_method']) {
    case 'file':
      $taf_data = $this->get_taf_file($icao);
      break;
    case 'fsockopen':
    default:
      $taf_data = $this->get_taf_socket($icao);
      break;
    }
    
    /* Here we test to see if we actually got a TAF. */
    if (!empty($taf_data) && count($taf_data)>0) {
     /* The first line in the file is the date */
      $date = trim(array_shift($taf_data));
      /* The remaining lines are the TAF itself. This will merge the
       * remaining lines into one line by removing new-lines:
       */
      $taf = ereg_replace("[\n\r ]+", ' ', trim(implode(' ', $taf_data)));

      $date = explode(':', strtr($date, '/ ', '::'));
      if ($date[2] > gmdate('j')) {
        /* The day is greater that the current day of month. This
         * implies, that the report is from last month.
         */
        $date[1]--;
      }
      $timestamp = gmmktime($date[3], $date[4], 0,
                            $date[1], $date[2], $date[0]);
      
      if (!ereg('[0-9]{6}Z', $taf)) {
        /* Some reports don't even have a time-part, so we insert the
         * current time. This might not be the time of the report, but
         * it was broken anyway :-)
         */
        $taf = gmdate('dHi', $timestamp) . 'Z ' . $taf;
      }

      /* Set the timeout to 1 hour from now */
      /* Perhaps we could figure the next TAF? */
      $timestamp = time() - $this->properties['cache_timeout'] + 60*60;

    }

    else {
      /* If we end up here, it means that there was no file. If the
       * station was a new station, we set the taf to an empty
       * string, else we just use the old TAF. We adjust the time
       * stored in the database in both cases, so that the server
       * isn't stressed too much.
       */
      if ($new_station) {
	$taf = '';
      } else {
	$taf = $this->taf;
      }
      $timestamp = time() - $this->properties['cache_timeout'] + 600;
    }
    
   $taf_time = $date[0].$date[1].$date[2].$date[3].$date[4]."00";

    /* We then cache the TAF in our database */
    if ($new_station) {
      $this->debug('get_taf_from_web(): Inserting new TAF for <code>' .
                   $this->get_location() . '</code>');
      $this->db->insert_taf($icao, $taf, $timestamp, $taf_time);
    } else {
      $this->debug('get_taf_from_web(): Updating TAF for <code>' .
                   $this->get_location() . '</code>');
      $this->db->update_taf($icao, $taf, $timestamp, $taf_time);

    }
    /* We update and return the TAF */
    $this->taf = $taf;
    return $taf;
  }




  /**
   * Returns the location of the current station.
   *
   * The location is the name of the station followed by the name of
   * the country. If the ICAO cannot be found in the database, then
   * the ICAO is just returned again.
   *
   * @return  string  The location of the station.
   */
  function get_location() {
    if (!empty($this->icao_data)) {
      $location = $this->icao_data[0] . ', ' . $this->icao_data[1];
      $this->debug("get_location(): Using old location: $location");
      return $location;
    } elseif ($this->db->connect()) {
      $this->debug('get_location(): Looking for location in the database');
      $this->icao_data = $this->db->lookup_icao($this->get_icao());
      if (empty($this->icao_data)) {
        return $this->get_icao(); // ICAO not found in database.
      } else {
        return $this->icao_data[0] . ', ' . $this->icao_data[1];
      }
    } else {
      return $this->get_icao();
    }
  }


  /**
   * Returns the name of the station for the current ICAO.
   *
   * @return  string  The name of the station or false if the ICAO
   *                  wasn't found in the database.
   * @access  public
   */
  function get_name() {
    if (!empty($this->icao_data)) {
      $this->debug('get_name(): Using old station name: ' . $this->icao_data[0]);
      return $this->icao_data[0];
    } elseif ($this->db->connect()) {
      $this->debug('get_name(): Looking for station name in the database');
      $this->icao_data = $this->db->lookup_icao($this->get_icao());
      if (empty($this->icao_data)) {
        return false; // ICAO not found in database.
      } else {
        return $this->icao_data[0];
      }
    } else {
      return false;
    }
  }


  /**
   * Returns the name of the country for the current ICAO.
   *
   * @return  string  The name of the country or false if the ICAO
   *                  wasn't found in the database.
   * @access  public
   */
  function get_country() {
    if (!empty($this->icao_data)) {
      $this->debug('get_country(): Using old country name: ' . $this->icao_data[1]);
      return $this->icao_data[1];
    } elseif ($this->db->connect()) {
      $this->debug('get_country(): Looking for country name in the database');
      $this->icao_data = $this->db->lookup_icao($this->get_icao());
      if (empty($this->icao_data)) {
        return false; // ICAO not found in database.
      } else {
        return $this->icao_data[1];
      }
    } else {
      return false;
    }
  }


  /**
   * Returns contry code specified ICAO.
   *
   * @return	string	country code (cc)
   * @author	Ondrej Jombik <nepto@pobox.sk>
   * @access	public
   */
  function get_country_code() {
    if (!empty($this->icao_data)) {
      $this->debug('get_country_code(): Using old country code (cc): ' .
                   $this->icao_data[2]);
      return $this->icao_data[2];
    } elseif ($this->db->connect()) {
      $this->debug('get_country(): Looking for country code (cc) in the database');
      $this->icao_data = $this->db->lookup_icao($this->get_icao());
      if (empty($this->icao_data)) {
        return false; // ICAO not found in database.
      } else {
        return $this->icao_data[2];
      }
    } else {
      return false;
    }
  }


    
}

?>
