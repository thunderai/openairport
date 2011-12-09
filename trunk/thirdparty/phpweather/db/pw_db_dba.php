<?php

require_once(PHPWEATHER_BASE_DIR . '/db/pw_db_common.php');

/**
 * This class is the 'dba' database-type. This type of database is a
 * wrapper itself, so you have to pass a handler to it as the index
 * 'db_handler', when you create it.
 *
 * It implements all the methods necessary to insert, update and
 * retrive METARs using a Berkeley DB style database. This is a
 * file-based database, so you have to make sure that you have write
 * access to the directory where you place the database.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version pw_db_dba.php,v 1.10 2003/09/02 17:59:44 gimpster Exp
 */
class pw_db_dba extends pw_db_common {

  /**
   * A link ID to the stations database.
   *
   * We have to maintain a different link ID for each database used.
   *
   * @var     integer
   * @access  private
   */
  var $link_stations_id;

  /**
   * A link ID to the countries database.
   *
   * We have to maintain a different link ID for each database used.
   * 
   * @var    integer
   * @access private
   */
  var $link_countries_id;

  /**
   * This constructor makes sure that the DBA extension is loaded and
   * then calls the parent constructor.
   *
   * @param  array  the initial properties of the object
   */
  function pw_db_dba($input) {
    /* We have to load the DBA extension on some systems: */
    if (!extension_loaded('dba')) {
      if (ereg('win', PHP_OS)) {
        dl('php_dba.dll');
      } else {
        dl('dba.so');
      }
    }
    $this->pw_db_common($input);
  }

  /**
   * Gets the type of the database.
   *
   * @return  string  The type of the database, 'dba' in this case.
   * @access  public
   */
  function get_type() {
    return 'dba';
  }

  /**
   * Establishes a connection to the database. It is assumed, that the
   * database is already created.
   *
   * If there has already been made a connection to the database, this
   * function just returns true, and nothing will be changed. This
   * means that it is safe to call this instead of testing
   * $is_connected.
   *
   * If $properties['db_pconnect'] is true, then a persistent
   * connection will be established. $db_hostname is used as the path
   * for the database.
   *
   * @return  boolean  Returns true, if a connection were established,
   *                   false otherwise.
   *
   * @access  public
   *
   * @see     disconnect(), $is_connected
   */
  function connect() {
    if ($this->is_connected) {
      return true;
    }
    if (!$this->properties['db_pconnect']) {
      $this->is_connected = $this->link_id =
	dba_open(PHPWEATHER_BASE_DIR . '/db/files/' .
		 $this->properties['db_metars'] . '.dba',
		 'w',
		 $this->properties['db_handler']);
      $this->link_stations_id = 
	dba_open(PHPWEATHER_BASE_DIR . '/db/files/' .
		 $this->properties['db_stations'] . '.dba',
		 'r',
		 $this->properties['db_handler']);
      $this->link_countries_id = 
	dba_open(PHPWEATHER_BASE_DIR . '/db/files/' .
		 $this->properties['db_countries'] . '.dba',
		 'r',
		 $this->properties['db_handler']);
    } else {
      $this->is_connected = $this->link_id =
	dba_popen(PHPWEATHER_BASE_DIR . '/db/files/' .
		  $this->properties['db_metars'] . '.dba',
		  'w',
		  $this->properties['db_handler']);
      $this->link_stations_id = 
	dba_popen(PHPWEATHER_BASE_DIR . '/db/files/' .
		  $this->properties['db_stations'] . '.dba',
		  'r',
		  $this->properties['db_handler']);
      $this->link_countries_id = 
	dba_popen(PHPWEATHER_BASE_DIR . '/db/files/' .
		  $this->properties['db_countries'] . '.dba',
		  'r',
		  $this->properties['db_handler']);
    }
    return $this->is_connected;
  }
  
  /**
   * Disconnects from the database.
   *
   * If we're already disconnected from the database, this function
   * will just return true.
   *
   * @return boolean Since dba_close() doesn't return any value, this
   * function always returns true.
   * @access  public
   * @see     connect(), $is_connected
   */
  function disconnect() {
    if ($this->is_connected) {
      dba_close($this->link_id);
      $this->is_connected = false;
    }
    return true;
  }

  /**
   * Inserts a METAR into the database.
   *
   * Any instances of PW_FIELD_SEPERATOR (:) in the METAR is changed
   * into PW_FIELD_REPLACEMENT (;). The colons has nothing to do in
   * the body of the METAR, so this wont effect the parsing as the
   * remarks isn't parsed anyway.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see update_metar()
   */
  function insert_metar($station, $metar, $timestamp) {
    $row = strtr($metar, PW_FIELD_SEPERATOR, PW_FIELD_REPLACEMENT) .
      PW_FIELD_SEPERATOR . $timestamp;
    $this->debug("Inserting this row into the DBA database: <br><code>$row</code>");
    dba_insert($station, $row, $this->link_id);
  }


  /**
   * Updates an existing METAR in the database.
   *
   * Any instances of PW_FIELD_SEPERATOR (:) in the METAR is changed
   * into PW_FIELD_REPLACEMENT (;). The colons has nothing to do in
   * the body of the METAR, so this wont effect the parsing as the
   * remarks isn't parsed anyway.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see insert_metar()
   */
  function update_metar($station, $metar, $timestamp) {
    $row = strtr($metar, PW_FIELD_SEPERATOR, PW_FIELD_REPLACEMENT) .
      PW_FIELD_SEPERATOR . $timestamp;
    $this->debug("Updating this row in the DBA database:<br><code>$row</code>");
    dba_replace($station, $row, $this->link_id);
  }


  /**
   * Gets a METAR form the database.
   *
   * @param   string  The ICAO of the station.
   * @return array The raw METAR and UNIX timestamp as an array, in
   * that order.
   * @access  public
   */
  function get_metar($station) {
    if (dba_exists($station, $this->link_id)) {
      $row = dba_fetch($station, $this->link_id);
      $this->debug("Returning this row from the DBA database:<br><code>$row</code>");
      return explode(PW_FIELD_SEPERATOR, $row);
    } else {
      return false;
    }
  }


  /**
   * Fetches information about an ICAO.
   *
   * @param   string  The ICAO one want's to translate.
   * @return  array   If the ICAO was found, then the array will
   *                  contain three entries: the name of the station,
   *                  the name of the country, the country code of the
   *                  country. If the ICAO wasn't found, then false is
   *                  returned.
   * @access  public
   */
  function lookup_icao($icao) {
    if (dba_exists($icao, $this->link_stations_id)) {
      return explode(PW_FIELD_SEPERATOR,
                     dba_fetch($icao, $this->link_stations_id));
    } else {
      return false;
    }
  }


  /**
   * Creates the necessary files.
   *
   * @return bool Returns true is the files were created, false
   * otherwise.
   * @access  private
   */
  function create_tables() {
    /* The following code is taken from connect(). The difference is,
       that all the databases are created and truncated by this code. */
    if (!$this->properties['db_pconnect']) {
      $this->is_connected = $this->link_id =
	dba_open(PHPWEATHER_BASE_DIR . '/db/files/' .
		 $this->properties['db_metars'] . '.dba',
		 'n',
		 $this->properties['db_handler']);
      $this->link_stations_id = 
	dba_open(PHPWEATHER_BASE_DIR . '/db/files/' .
		 $this->properties['db_stations'] . '.dba',
		 'n',
		 $this->properties['db_handler']);
      $this->link_countries_id = 
	dba_open(PHPWEATHER_BASE_DIR . '/db/files/' .
		 $this->properties['db_countries'] . '.dba',
		 'n',
		 $this->properties['db_handler']);
    } else {
      $this->is_connected = $this->link_id =
	dba_popen(PHPWEATHER_BASE_DIR . '/db/files/' .
		  $this->properties['db_metars'] . '.dba',
		  'n',
		  $this->properties['db_handler']);
      $this->link_stations_id = 
	dba_popen(PHPWEATHER_BASE_DIR . '/db/files/' .
		  $this->properties['db_stations'] . '.dba',
		  'n',
		  $this->properties['db_handler']);
      $this->link_countries_id = 
	dba_popen(PHPWEATHER_BASE_DIR . '/db/files/' .
		  $this->properties['db_countries'] . '.dba',
		  'n',
		  $this->properties['db_handler']);
    }
    return $this->is_connected;
  }

  /**
   * Inserts the stations into the database.
   *
   * It is assumed that create_tables() has been called previously
   * (and that it returned true).
   *
   * @param  array  This three-dimensional array starts with a list of
   *                contry-codes. For each country-code the ICAOs and
   *                corresponding locations in that particular country
   *                are listed as key => value pairs.
   *
   * @param  array  An associative array with country-codes as the keys
   *                and the names of the countries as the values.
   *
   * @return  bool
   * @access  private
   */
  function insert_stations($data, $countries) {
    while(list($cc, $country) = each($countries)) {
      while(list($icao, $location) = each($data[$cc])) {
	/* We insert all the stations together with the name of the
           country and country code into the database. */
	dba_insert($icao,
                   $location . PW_FIELD_SEPERATOR .
                   $country .  PW_FIELD_SEPERATOR . $cc,
                   $this->link_stations_id);
	$icaos[] = $icao; /* We collect the ICAOs for later. */
      }
      /* Now that we've collected all the ICAOs in the country, lets
	 insert the country with it's data into the database. The name
	 of the country is seperated from the list of ICAOs by
	 PW_FIELD_SEPERATOR (:). The ICAOs are also seperated by
	 PW_FIELD_SEPERATOR. */
      dba_insert($cc,
		 $country . PW_FIELD_SEPERATOR .
                 implode(PW_FIELD_SEPERATOR, $icaos),
		 $this->link_countries_id);
      unset($icaos);  /* We can now forget about the ICAOs. */
    }
    return true;
  }

  /**
   * Returns a list of available countries.
   *
   * @return  array  An associative array with the country-codes as
   *                 the keys and the names of the countries as the
   *                 values.
   * @access  public
   */
  function get_countries() {
    if (!$this->connect()) {
      return false;
    }

    $cc = dba_firstkey($this->link_countries_id); /* We need the first key. */
    while ($data = dba_fetch($cc, $this->link_countries_id)) {
      /* This statement extracts the name of the country. It's
         seperated from the ICAOs by PW_FIELD_SEPERATOR and after it
         comes a list of ICAOs also seperated by the
         PW_FIELD_SEPERATOR character: */
      list($country) = explode(PW_FIELD_SEPERATOR, $data, 2);
      $countries[$cc] = $country;
      $cc = dba_nextkey($this->link_countries_id);
    }

    asort($countries); // Let's sort the countries.

    return $countries;
  }

  /**
   * Returns an array of stations.
   *
   * @param   string  The country-code.
   * @param   string  This parameter is passed by reference. The name
   *                  of the country that corresponds to the
   *                  country-code is stored here.
   * @return  array   An associative array with the ICAO as the key
   *                  and the name of the station as the values. The
   *                  name of the country is not added to the name of
   *                  the station.
   * @access  public
   */
  function get_icaos($cc, &$country) {

    if (!$this->connect()) {
      return false;
    }
    
    /* The name of the country is seperated from the list of ICAOs by
     * PW_FIELD_SEPERATOR (:). The name is followed by a list of ICAOs
     * which are also seperated by PW_FIELD_SEPERATOR. */
    $data = explode(PW_FIELD_SEPERATOR,
                    dba_fetch($cc, $this->link_countries_id));

    /* The first entry is the country: */
    $country = array_shift($data);

    /* The remaining entries are the ICAOs: */
    while (list(, $icao) = each($data)) {
      list($name) =
        explode(PW_FIELD_SEPERATOR,
                dba_fetch($icao, $this->link_stations_id));
      $locations[$icao] = $name;
    }
    
    asort($locations);

    return $locations;
  }

}

?>
