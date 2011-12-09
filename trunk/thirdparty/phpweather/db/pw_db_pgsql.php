<?php

require_once(PHPWEATHER_BASE_DIR . '/db/pw_db_common.php');

/**
 * This class is the 'pgsql' database-type
 *
 * It implements all the methods necessary to insert, update and
 * retrive METARs using a PostgreSQL database.
 *
 * @author   Kristian Kristensen <cookie@zianet.dk>
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_db_pgsql.php,v 1.6 2002/08/28 10:05:55 gimpster Exp
 */
class pw_db_pgsql extends pw_db_common {

  /**
   * The next row that should be fetched in the result set.
   *
   * This is used by the methods fetch_row() and fetch_array() to keep
   * track of how far they have come in the result set.
   *
   * @var    integer
   * @access private
   */
  var $next_row = 0;


  /**
   * This constructor makes sure that the PostgreSQL extension is
   * loaded and then calls the parent constructor.
   *
   * @param  array  the initial properties of the object
   */
  function pw_db_pgsql($input = array()) {
    /* We have to load the PgSQL extension on some systems: */
    if (!extension_loaded('pgsql')) {
      if (ereg('win', PHP_OS)) {
        dl('pgsql.dll');
      } else {
        dl('pgsql.so');
      }
    }
    $this->pw_db_common($input);
  }


  /**
   * Gets the type of the database.
   *
   * @return  string  The type of the database, 'pgsql' in this case.
   * @access  public
   */
  function get_type() {
    return 'pgsql';
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
    /* Connect to the PostgreSQL server */
    if ($this->is_connected) {
      return true;
    }

    if (empty($this->properties['db_port']))
      /* Default PostgreSQL port: */
      $port = 5432;
    else
      $port = $this->properties['db_port'];

    $connect_str = sprintf('host=%s port=%s dbname=%s user=%s password=%s',
                           $this->properties['db_hostname'], $port,
                           $this->properties['db_database'],
                           $this->properties['db_username'],
                           $this->properties['db_password']);
    if (!$this->properties['db_pconnect']) {
      $this->link_id = pg_connect($connect_str);
    } else {
      $this->link_id = pg_pconnect($connect_str);
    }
    if ($this->link_id) {
      $this->is_connected = true;
      $this->select_db();
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
    if (!$this->is_connected || pg_close($this->link_id)) {
      $this->is_connected = false;
      return true;
    } else {
      return false;
    }
  }


  /**
   * Selects a database. This should already have been taken care of
   * when the connection was made to the database, so this will just
   * run connect() and return whatever it returns.
   *
   * @return  boolean  Returns true on success, false otherwise.
   * @access  public
   * @see connect()
   */
  function select_db() {
    return $this->connect();
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
    $this->result_id = pg_exec($this->link_id, $query) or
      $this->error("SQL-statement failed: $query<br>PostgreSQL said " .
                   pg_errormessage());
    /* The next row is the first row: */
    $this->next_row = 0;
    
    return $this->result_id;
  }

  /**
   * Fetches a row as an array from the database.
   *
   * @return  array   The next row from the result-set.
   * @access  public
   */
  function fetch_row() {
    if ($this->next_row < $this->num_rows())
      /* There are still rows left in the result set. We use the
         post-increment operator (++) to increment $this->next_row
         immediately after it has been used. */
      return pg_fetch_row($this->result_id, $this->next_row++);
    else
      return false;
  }

  /**
   * Fetches a row as an associative array from the database.
   *
   * @return  array  The next row from the result-set, as an
   *                 associative array.
   * @access  public
   */
  function fetch_array() {
    if ($this->next_row < $this->num_rows())
      /* There are still rows left in the result set. We use the
         post-increment operator (++) to increment $this->next_row
         immediately after it has been used. */
      return pg_fetch_array($this->result_id, $this->next_row++);
    else
      return false;
  }


  /**
   * Returns the number of rows in the result-set.
   *
   * @return  integer  The number of rows in the current result-set.
   * @access  public
   */
  function num_rows() {
    return pg_numrows($this->result_id);
  }


  /**
   * Inserts a METAR into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see     update_metar()
   */
  function insert_metar($icao, $metar, $timestamp) {
    $this->query('INSERT INTO ' . $this->properties['db_metars'] .
                 '(icao, metar, timestamp) VALUES (' .
                 "'$icao', '" . addslashes($metar) . "', '" .
                 date('r', $timestamp) . "')");
  }


  /**
   * Updates an existing METAR in the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see     insert_metar()
   */
  function update_metar($icao, $metar, $timestamp) {
    $this->query('UPDATE ' . $this->properties['db_metars'] .
                 " SET metar = '" . addslashes($metar) .
                 "', timestamp = '" . date('r', $timestamp) .
                 "' WHERE icao = '$icao'");
  }


  /**
   * Gets a METAR form the database.
   *
   * @param   string  The ICAO of the station.
   * @return  string  The raw METAR as an array from the database.
   * @access  public
   */
  function get_metar($icao) {
    $this->query('SELECT metar, EXTRACT(EPOCH FROM timestamp) FROM ' .
                 $this->properties['db_metars'] .
                 " WHERE icao = '$icao'");
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
    $this->query('DROP TABLE ' . $this->properties['db_metars']);
    $this->query('CREATE TABLE ' . $this->properties['db_metars'] .
                 '(icao char(4) PRIMARY KEY,' .
                 ' metar varchar(255) NOT NULL,' .
                 ' timestamp timestamp with time zone)');

    /* Then we make a table for the stations. */
    $this->query('DROP TABLE ' . $this->properties['db_stations']);
    $this->query('CREATE TABLE ' . $this->properties['db_stations'] .
                 '(icao char(4) PRIMARY KEY,' .
                 ' name varchar(255) NOT NULL,' .
                 ' cc char(2) NOT NULL,' .
                 ' country varchar(128) NOT NULL)');
    $this->query('CREATE INDEX cc_key ON ' .
                 $this->properties['db_stations'] . '(cc)');
   
    return true; // Success!
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
    $this->query(sprintf("SELECT name, country, cc FROM %s WHERE icao = '%s'",
                         $this->properties['db_stations'], addslashes($icao)));
    if ($this->num_rows() == 1) {
      return $this->fetch_row();
    } else {
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
	$this->query('INSERT INTO ' . $this->properties['db_stations'] .
                     '(icao, name, cc, country) VALUES ' . 
                     "('$icao', '$location', '$cc', '$country')");
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
   * @param   string  The country-code.
   * @param string This parameter is passed by reference. The name of
   * the country that corresponds to the country-code is stored here.
   * @return array An associative array with the ICAO as the key and
   * the name of the station as the values. The name of the country is
   * not added to the name of the station.
   * @access  public
   */
  function get_icaos($cc, &$country) {
    if (!$this->connect()) {
      return false;
    }
    
    $this->query('SELECT icao, name, country FROM ' .
                 $this->properties['db_stations'] .
                 " WHERE cc = '$cc' ORDER BY name");
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
