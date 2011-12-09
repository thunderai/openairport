<?php

require_once(PHPWEATHER_BASE_DIR . '/db/pw_db_common.php');

/**
 * This class interfaces with the 'adodb' database wrapper library.
 * You'll need to install ADOdb from
 *
 *   http://php.weblogs.com/adodb
 *
 * before you can use this backend with PHP Weather.
 *
 * It implements all the methods necessary to insert, update and
 * retrive METARs using a database wrapped in the ADOdb library.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_db_adodb.php,v 1.2 2003/10/02 22:54:46 etienne_t Exp
 */
class pw_db_adodb extends pw_db_common {
  
  /**
   * This constructor just calls the parent constructor.
   *
   * @param  array  the initial properties of the object
   */
  function pw_db_adodb($input) {
    $this->pw_db_common($input);
  }

  /**
   * Gets the type of the database.
   *
   * @return  string  The type of the database, 'adodb' in this case.
   * @access  public
   */
  function get_type() {
    return 'adodb';
  }


  /**
   * Establishes a connection to the database.
   *
   * If there has already been made a connection to the database, this
   * function just returns true, and nothing will be changed. This
   * means that it is safe to call this instead of testing
   * $is_connected. If $properties['db_pconnect'] is true, then a
   * persistent connection will be established.
   *
   * @return boolean Returns true, if a connection were established,
   * false otherwise.
   * @access  public
   * @see     disconnect()
   */
  function connect() {
    /* Connect to the server */
    if ($this->is_connected) {
      return true;
    }

    if (!empty($this->properties['db_adodb_ext'])) {
      if (!extension_loaded($this->properties['db_adodb_ext_name'])) {
        dl($this->properties['db_adodb_ext_file']);
      }
    }

    include_once($this->properties['db_adodb_path'] . '/adodb.inc.php');

    /* What to do about non-standard port numbers? */

    $this->link_id = &ADONewConnection($this->properties['db_adodb_driver']);

    $this->link_id->SetFetchMode(ADODB_FETCH_BOTH);
      
    if ($this->properties['db_pconnect']) {
      $this->link_id->PConnect($this->properties['db_hostname'],
                               $this->properties['db_username'],
                               $this->properties['db_password'],
                               $this->properties['db_database']);
    } else {
      $this->link_id->Connect($this->properties['db_hostname'],
                              $this->properties['db_username'],
                              $this->properties['db_password'],
                              $this->properties['db_database']);
    }
    if ($this->link_id) {
      $this->is_connected = true;
    } else {
      $this->is_connected = false;
    }
    return $this->is_connected;
  }

  
  /**
   * Disconnects from the database.
   *
   * If we're already disconnected from the database, this function
   * will just return true.
   *
   * @return boolean If the disconnec was succesfull then it returns
   * true, otherwise it returns false.
   * @access  public
   * @see     connect()
   */
  function disconnect() {
    if (!$this->is_connected || $this->link_id->Close()) {
      $this->is_connected = false;
      return true;
    } else {
      return false;
    }
  }


  /**
   * Selects a database.
   *
   * @return  boolean  Returns true, since this is already done in
   *                   connect().
   * @access  public
   */
  function select_db() {
    return true;
  }


  /**
   * Executes a SQL-query.
   *
   * $result_id is updated as well
   *
   * @param   string   The SQL-statement.
   * @return  boolean  True on success, false otherwise.
   * @access  public
   */
  function query($query) {
    $this->result_id = &$this->link_id->Execute($query);
    if (!$this->result_id) {
      $this->error($this->link_id->ErrorMsg());
      return false;
    }
    
    return true;
  }


  /**
   * Fetches a row as an array from the database.
   *
   * @return  array   The next row from the result-set.
   * @access  public
   */
  function fetch_row() {
    return $this->fetch_array();
  }


  /**
   * Fetches a row as an associative array from the database.
   *
   * @return array The next row from the result-set, as an associative
   * array.
   * @access public
   */
  function fetch_array() {
    if ($this->result_id->EOF) {
      return false;
    } else {
      $row = $this->result_id->fields;
      $this->result_id->MoveNext();
      return $row;
    }
  }


  /**
   * Returns the number of rows in the result-set.
   *
   * @return  integer  The number of rows in the current result-set.
   * @access  public
   */
  function num_rows() {
    return $this->result_id->RecordCount();
  }


  /**
   * Inserts a METAR into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @param   string   The time of the report
   * @access  public
   * @see update_metar()
   */
  function insert_metar($icao, $metar, $timestamp, $time) {
    $this->query(sprintf('INSERT INTO %s SET icao = "%s", time = "%s", ' .
			 'metar = "%s", timestamp = FROM_UNIXTIME(%d)',
			 $this->properties['db_metars'], $icao, $time, 
			 addslashes($metar), intval($timestamp)));
    $this->insert_metar_arch($icao, $metar, $time);
  }


  /**
   * Updates an existing METAR in the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @param   string   The time of the report
   * @access  public
   * @see insert_metar()
   */
  function update_metar($icao, $metar, $timestamp, $time) {
    $this->query(sprintf('UPDATE %s' .
                         ' SET metar = "%s", timestamp = FROM_UNIXTIME(%d)' .
                         ' WHERE icao = "%s"',
                         $this->properties['db_metars'], addslashes($metar),
                         intval($timestamp), $icao));
    $this->insert_metar_arch($icao, $metar, $time);
  }


  /**
   * Inserts an archive METAR into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  The time of the report.
   * @access  public
   */
  function insert_metar_arch($icao, $metar, $time) {
    if(isset($this->properties['archive_metars']) && 
       $this->properties['archive_metars']==true) {
      $this->query(sprintf('SHOW TABLES LIKE "%s"',
			   $this->properties['db_metars_arch']));
      if ($this->num_rows()==1) {
	$this->query(sprintf('DELETE FROM %s WHERE icao = "%s" AND ' .
			     'time = "%s"' ,
			     $this->properties['db_metars_arch'], 
			     $icao,$time));
	$this->query(sprintf('INSERT IGNORE INTO %s SET icao = "%s", ' .
			     'time = "%s", ' .
			     'metar = "%s"',
			     $this->properties['db_metars_arch'], $icao,
			     $time,
			     addslashes($metar)));
      }
    }
  }


  /**
   * Gets a METAR form the database.
   *
   * @param   string  The ICAO of the station.
   * @return  string  The raw METAR as an array from the database.
   * @access  public
   */
  function get_metar($icao, $time_from=false, $time_to=false) {
//     $this->query(sprintf('SELECT metar, UNIX_TIMESTAMP(timestamp)' .
//                          ' FROM %s WHERE icao = "%s"',
//                          $this->properties['db_metars'], $icao));
//     return $this->fetch_row();

    /* Set num fetch mode */
    $tmp_fetch_mode = $this->link_id->SetFetchMode(ADODB_FETCH_NUM);

    if($time_from===false || $this->properties['archive_metars']===false) {
      /* fetch the current metar */
      $query = sprintf('SELECT metar, UNIX_TIMESTAMP(timestamp) AS timestamp, time' .
		       ' FROM %s WHERE icao = "%s" LIMIT 1',
		       $this->properties['db_metars'], $icao);
    }
    else if ($time_to!==false) {
      /* fetch archived metars between $time_from and $time_to */
      $query = sprintf('SELECT metar, UNIX_TIMESTAMP(time) AS timestamp, time' .
		       ' FROM %s WHERE icao = "%s" AND time>="%s" AND time<"%s" ORDER BY time ASC',
 		       $this->properties['db_metars_arch'], $icao, $time_from, $time_to);
    }
    else {
      /* fetch archived metars from $time_from */
      $query = sprintf('SELECT metar, UNIX_TIMESTAMP(time) AS timestamp, time' .
		       ' FROM %s WHERE icao = "%s" AND time>="%s" ORDER BY time ASC',
 		       $this->properties['db_metars_arch'], $icao,$time_from);
    }

    $this->query($query);

    if($this->num_rows()==0) $metar_array = false;
    else {
      $metar_array = array();
      while($row = $this->fetch_row()) {
	$metar_array[] = $row;
      }
    }

    /* Set old fetch mode */
    $this->link_id->SetFetchMode($tmp_fetch_mode);
    
    return $metar_array;
  }


 /**
   * Inserts a TAF into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw TAF.
   * @param   integer  A standard UNIX timestamp.
   * @param   string   The time of the report
   * @access  public
   * @see update_taf()
   */
  function insert_taf($icao, $taf, $timestamp, $time) {
    $this->query(sprintf('INSERT INTO %s SET icao = "%s", ' .
                         'taf = "%s", timestamp = FROM_UNIXTIME(%d)',
                         $this->properties['db_tafs'], $icao,
                         addslashes($taf), intval($timestamp)));
    $this->insert_taf_arch($icao, $taf, $time);
  }

  /**
   * Updates an existing TAF in the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw TAF.
   * @param   integer  A standard UNIX timestamp.
   * @param   string   The time of the report
   * @access  public
   * @see insert_taf()
   */
  function update_taf($icao, $taf, $timestamp, $time) {
    $this->query(sprintf('UPDATE %s' .
                         ' SET taf = "%s", timestamp = FROM_UNIXTIME(%d)' .
                         ' WHERE icao = "%s"',
                         $this->properties['db_tafs'], addslashes($taf),
                         intval($timestamp), $icao));
    $this->insert_taf_arch($icao, $taf, $time);
  }
 
 /**
   * Inserts an archive TAF into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw TAF.
   * @param   integer  The time of the report.
   * @access  public
   */
  function insert_taf_arch($icao, $taf, $time) {
    if(isset($this->properties['archive_tafs']) && 
       $this->properties['archive_tafs']==true) {
      $this->query(sprintf('SHOW TABLES LIKE "%s"',
			   $this->properties['db_tafs_arch']));
      if ($this->num_rows()==1) {
	$this->query(sprintf('DELETE FROM %s WHERE icao = "%s" AND ' .
			     'time = "%s"' ,
			     $this->properties['db_tafs_arch'], 
			     $icao,$time));
	$this->query(sprintf('INSERT IGNORE INTO %s SET icao = "%s", ' .
			     'time = "%s", ' .
			     'taf = "%s"',
			     $this->properties['db_tafs_arch'], $icao,
			     $time,
			     addslashes($taf)));
      }
    }
  }

  /**
   * Gets a TAF form the database.
   *
   * @param   string  The ICAO of the station.
   * @return  string  The raw TAF as an array from the database.
   * @access  public
   */
  function get_taf($icao) {
    $this->query(sprintf('SELECT taf, UNIX_TIMESTAMP(timestamp)' .
                         ' FROM %s WHERE icao = "%s"',
                         $this->properties['db_tafs'], $icao));
    return $this->fetch_row();
  }


  /**
   * Creates the necessary tables in the database.
   *
   * @return bool Returns true if it could connect to the database,
   * false otherwise.
   * @access private
   */
  function create_tables() {
    if (!$this->connect()) {
      return false; // Failure!
    }
    
    /* First we make a table for the METARs */
    $this->query('DROP TABLE IF EXISTS ' . $this->properties['db_metars']);
    $this->query('CREATE TABLE ' . $this->properties['db_metars'] . '(
   icao char(4) NOT NULL,
   time timestamp(14),
   metar varchar(255) NOT NULL,
   timestamp timestamp(14),
   PRIMARY KEY (icao)');

    /* Then we make a table for the TAFs */
    $this->query('DROP TABLE IF EXISTS ' . $this->properties['db_tafs']);
    $this->query('CREATE TABLE ' . $this->properties['db_tafs'] . '(
   icao char(4) NOT NULL,
   time timestamp(14),
   taf varchar(255) NOT NULL,
   timestamp timestamp(14),
   PRIMARY KEY (icao)');

    /* We make the archival databases */
    $this->query('DROP TABLE IF EXISTS ' . $this->properties['db_metars_arch']); 
    $this->query('CREATE TABLE ' . $this->properties['db_metars_arch'] . '(
   icao char(4) NOT NULL,
   time timestamp(14) NOT NULL,
   metar varchar(255) NOT NULL,
   PRIMARY KEY  (icao,time)');
    $this->query('DROP TABLE IF EXISTS ' . $this->properties['db_tafs_arch']);
    $this->query('CREATE TABLE ' . $this->properties['db_tafs_arch'] . '(
   icao char(4) NOT NULL,
   time timestamp(14) NOT NULL,
   taf varchar(255) NOT NULL,
   PRIMARY KEY  (icao,time)');

    /* Then we make a table for the stations. */
    $this->query('DROP TABLE IF EXISTS ' . $this->properties['db_stations']);
    $this->query('CREATE TABLE ' . $this->properties['db_stations'] . '(
   icao char(4) NOT NULL,
   name varchar(255) NOT NULL,
   cc char(2) NOT NULL,
   country varchar(128) NOT NULL,
   PRIMARY KEY (icao),
   UNIQUE icao (icao),
   KEY cc (cc))');
   
    return true; // Success!
    
  }

  /**
   * Fetches information about an ICAO.
   *
   * The array returned contains three entries: the name of the
   * station, the name of the country, the country code of the
   * country.
   *
   * @param   string  The ICAO one want's to translate.
   * @return  array  Information about the ICAO or false if no
   *                 information is available.
   * @access  public
   */
  function lookup_icao($icao) {
    $this->query(sprintf('SELECT name, country, cc FROM %s WHERE icao = "%s"',
                         $this->properties['db_stations'], addslashes($icao)));
    if ($this->num_rows() == 1) {
      $this->debug("Found ICAO '$icao' in database.");
      return $this->fetch_row();
    } else {
      $this->debug("Could not find ICAO '$icao' in database.");
      return false;
    }
  }

  /**
   * Inserts the stations into the database.
   *
   * It is assumed that create_tables() has been called previously
   * (and that it returned true), so that the necessary tables are
   * already created.
   *
   * @param array This three-dimensional array starts with a list of
   * contry-codes. For each country-code the ICAOs and corresponding
   * locations in that particular country are listed as key => value
   * pairs.
   * @param array An associative array with country-codes as the keys
   * and the names of the countries as the values.
   * @return  bool
   * @access  private
   */
  function insert_stations($data, $countries) {
    if (!$this->connect()) {
      return false;
    }

    while(list($cc, $country) = each($countries)) {
      /* The country names might contain dangerous characters. */
      $country = addslashes($country);
      while(list($icao, $location) = each($data[$cc])) {
	/* The station name might also be dangerous. */
	$location = addslashes($location); 
	$this->query(sprintf('INSERT INTO %s VALUES ("%s", "%s", "%s", "%s")',
                             $this->properties['db_stations'],
                             $icao, addslashes($location),
                             addslashes($cc), addslashes($country)));

      }
    }
    return true;
  }


  /**
   * Returns a list of available countries.
   *
   * @return array An associative array with the country-codes as the
   * keys and the names of the countries as the values.
   * @access  public
   */
  function get_countries() {
    if (!$this->connect()) {
      return false;
    }
    
    $this->query('SELECT DISTINCT cc, country FROM ' .
                 $this->properties['db_stations'] . ' ORDER BY country');
    while($row = $this->fetch_row()) {
      $rows[$row[0]] = $row[1];
    }
    return $rows;
  }
    

  /**
   * Returns an array of stations.
   *
   * @param  string  The country-code.
   * @param  string  This parameter is passed by reference. The name of
   *                 the country that corresponds to the country-code
   *                 is stored here.
   * @return array   An associative array with the ICAO as the key and
   *                 the name of the station as the values. The name
   *                 of the country is not added to the name of the
   *                 station.
   * @access  public
   */
  function get_icaos($cc, &$country) {
    if (!$this->connect()) {
      return false;
    }
    
    $this->query(sprintf('SELECT icao, name, country FROM %s'
                         .' WHERE cc = "%s" ORDER BY name',
                         $this->properties['db_stations'],
                         addslashes($cc)));
    /* We have to do this manually the first time, so that we can set
       $country */
    list($icao, $name, $country) = $this->fetch_row();
    $rows[$icao] = $name;
    while(list($icao, $name) = $this->fetch_row()) {
      $rows[$icao] = $name;
    }
    return $rows;
  }

}

?>
