<?php

require_once(PHPWEATHER_BASE_DIR . '/db/pw_db_common.php');

/**
 * Each line in the stations database will be padded with spaces to
 * this length. to facilitate fast binary search.
 *
 * @const   PW_LINE_LENGTH  The length of lines in the stations database.
 * @access  private
 */
define('PW_LINE_LENGTH', 128);

/**
 * This class is the 'null' database-type
 *
 * It pretends to be a database, but really it isn't :-) It just
 * implements all the functions one would expect from a database, and
 * then returns true or false or with empty strings and arrays as
 * appropriate.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_db_null.php,v 1.7 2004/06/01 20:30:53 gimpster Exp
 */
class pw_db_null extends pw_db_common {

  /**
   * This constructor does nothing besides calling the parent constructor.
   *
   * @param  array  the initial properties of the object
   */
  function pw_db_null($input) {
    $this->pw_db_common($input);
  }

  /**
   * Gets the type of the database.
   *
   * @return  string  The type of the database, 'null' in this case.
   * @access  public
   */
  function get_type() {
    return 'null';
  }

  /**
   * Pretends to establish a connection to the database.
   *
   * Like all the other methods of this database object, this doesn't
   * do anything useful.
   *
   * @return boolean Always returns true, so that other functions that
   * depends on a connection to the database doesn't fail because of
   * this.
   * @access  public
   */
  function connect() {
    return true;
  }


  /**
   * Pretends to insert a METAR into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see     update_metar()
   */
  function insert_metar($station, $metar, $timestamp, $time) {
    ;
  }

  /**
   * Pretends to insert an archive METAR into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  The time of the report.
   * @access  public
   */
  function insert_metar_arch($icao, $metar, $time) {
    ;
  }

  /**
   * Pretends to update an existing METAR in the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw METAR.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see     insert_metar()
   */
  function update_metar($station, $metar, $timestamp, $time) {
    ;
  }

  /**
   * Pretends to return a METAR form the database.
   *
   * @param   string  The ICAO of the station.
   * @return  string  Since we don't have a database, we just return an
   *                  empty string.
   * @access  public
   */
  function get_metar($station) {
    return '';
  }

  /**
   * Pretends to insert a TAF into the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw TAF.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see     update_taf()
   */
  function insert_taf($station, $taf, $timestamp) {
    ;
  }

  /**
   * Pretends to update an existing TAF in the database.
   *
   * @param   string   The ICAO of the station.
   * @param   string   The raw TAF.
   * @param   integer  A standard UNIX timestamp.
   * @access  public
   * @see     insert_taf()
   */
  function update_taf($station, $taf, $timestamp) {
    ;
  }

  /**
   * Pretends to return a TAF form the database.
   *
   * @param   string  The ICAO of the station.
   * @return  string  Since we don't have a database, we just return an
   *                  empty string.
   * @access  public
   */
  function get_taf($station) {
    return '';
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

    $fp = fopen(PHPWEATHER_BASE_DIR . '/db/files/stations.db', 'r');
    $size = filesize(PHPWEATHER_BASE_DIR . '/db/files/stations.db');

    $result = false; // Default result.
    $left  = 0;
    $right = $size / PW_LINE_LENGTH;
    
    /* We make a binary search for the right ICAO. The search
     * terminates when $right >= $left: */
    while ($left < $right) {
      
      fseek($fp, PW_LINE_LENGTH * round(($left+$right)/2));
      
      /* Each line contains four fields seperated by
       * PW_FIELD_SEPERATOR. The fields are: the ICAO, name of
       * station, name of country, and country code. */
      $data = fgetcsv($fp, PW_LINE_LENGTH, PW_FIELD_SEPERATOR);
      if ($data[0] > $icao) {
	$right = floor(($left+$right)/2);
      } elseif ($data[0] < $icao) {
	$left = ceil(($left+$right)/2);
      } else {
	$left = $right;
	$result = array($data[1], $data[2], rtrim($data[3]));
      }
    }
    fclose($fp);
    return $result;
  }



  /**
   * Makes sure that it's possible to create the files.
   *
   * The method doesn't create any files, it just veryfies that it's
   * we have write permission to PHPWEATHER_BASE_DIR/db.
   * @return  bool  True if it's possible to create files.
   * @access  private
   */
  function create_tables() {
    return is_writable(PHPWEATHER_BASE_DIR . '/db/files');
  }

  /**
   * Inserts the stations into the database.
   *
   * It is assumed that create_tables() has been called previously
   * (and that it returned true), so that we can create the necessary
   * files. insert_stations() populates PHPWEATHER_BASE_DIR/db/files/
   * with a file for each country. The files contain PHP code, so that
   * $country and $icaos will be set, if the file is included.
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
    while(list($cc, $country) = each($countries)) {
      $fp = fopen(PHPWEATHER_BASE_DIR . "/db/files/$cc.php", 'w');
      if (!$fp) return false;

      fputs($fp, "<?php\n/* File with stationnames in $countries[$cc] */\n\n");
      fputs($fp, "\$country = '" . addslashes($countries[$cc]) . "';\n\n");
      fputs($fp, "\$icaos   = array(\n");
      /* We do it ourselves the first time */
      list($icao, $location) = each($data[$cc]);
      fputs($fp, "  '$icao' => '" . addslashes($location) . "'");
      $stations[$icao] = array($location, $countries[$cc], $cc);
      
      while(list($icao, $location) = each($data[$cc])) {
	fputs($fp, ",\n  '$icao' => '" . addslashes($location) . "'");
	$stations[$icao] = array($location, $countries[$cc], $cc);
      }
      fputs($fp, "\n);\n\n?>\n");
      fclose($fp);
    }
    /* We write a file with all the stations. Each line is
       PW_LINE_LENGTH bytes long so that it's easy to find a given
       station again. */
    $fp = fopen(PHPWEATHER_BASE_DIR . '/db/files/stations.db', 'w');
    if ($fp) {
      ksort($stations);
      reset($stations);
      while(list($icao, $data) = each($stations)) {
	$str = str_pad($icao . PW_FIELD_SEPERATOR .
                       implode(PW_FIELD_SEPERATOR, $data),
                       PW_LINE_LENGTH - 1) . "\n";
	fputs($fp, $str);
      }
      fclose($fp);
    } else {
      return false;
    }

    return true;
  }

  /**
   * Returns a list of available countries.
   *
   * It uses the file PHPWEATHER_BASE_DIR/db/files/countries.php
   * created by insert_stations().
   *
   * @return array An associative array with the country-codes as the
   * keys and the names of the countries as the values.
   * @access  public
   */
  function get_countries() {
    require_once(PHPWEATHER_BASE_DIR . '/db/files/countries.php');
    return $countries;
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
    include(PHPWEATHER_BASE_DIR . "/db/files/$cc.php");
    return $icaos;
  }

}

?>
