<?php

require_once(PHPWEATHER_BASE_DIR . '/base_object.php');

/**
 * The character used to seperate values in combined fields, if the
 * database uses combined fields. The pw_db_null and pw_db_dba
 * databases use this.
 *
 * @const   PW_FIELD_SEPERATOR  The field seperator.
 * @access  private
 * @see     PW_FIELD_REPLACEMENT
 */
define('PW_FIELD_SEPERATOR', ':');


/**
 * The character used to replace PW_FIELD_SEPERATOR in combined
 * fields, if the database uses combined fields. The pw_db_null and
 * pw_db_dba databases use this.
 *
 * @const   PW_FIELD_REPLACEMENT  The field seperator replacement.
 * @access  private
 * @see     PW_FIELD_SEPERATOR
 */
define('PW_FIELD_REPLACEMENT', ';');


/**
 * Common class for all the database-types.
 *
 * It contains some properties most database-types need, like
 * $is_connected, $link_id and $result_id.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_db_common.php,v 1.13 2002/08/28 10:05:55 gimpster Exp
 */
class pw_db_common extends base_object {

  /**
   * Maintains the status of the database-connection, if needed by the
   * database backend.
   *
   * @var     boolean
   * @access  public
   */
  var $is_connected;

  /**
   * Contains the link ID used when querying, if the database backend
   * knows about a link ID.
   *
   * @var     integer
   * @access  private
   */
  var $link_id;
  
  /**
   * Contains the result ID used when fetching rows from a result-set
   * if the database backend knows about a result ID.
   *
   * @var     integer
   * @access  private
   */
  var $result_id;

  /**
   * Initializes the database-object.
   *
   * $is_connected, $link_id and $result_id is set to false, to
   * indicate that we're not connected.
   * 
   * @param  array  the initial properties of the object
   * @see    $is_connected, $link_id, $result_id
   */
  function pw_db_common($input) {
    /* We start by calling the parent constructor. */
    $this->base_object($input);
    
    /* We're not connected at first, so we set these variables to
       indicate that. */
    $this->is_connected = false;
    $this->link_id      = false;
    $this->result_id    = false;
  }


  /**
   * Updates the database with new data from a cycle file.
   *
   * This method is used when a new cycle-file has received. The idea
   * is, that it is run periodically to update the database with fresh
   * data. This should be done from a different script than the main
   * script (the script the uses see), as this can take some time.
   *
   * @param  string  The filename of the new cycle file. The filename
   * should be an absolute filename.
   *
   * Or would it be better, if it was relative to PHPWEATHER_BASE_DIR?
   *
   * @see insert_metar(), update_metar()
   */ 
  function update_all_metars($file) {

    $fp = fopen($file, 'r');

    $inserted = 0;
    $updated = 0;
    $skipped = 0;

    while (!feof($fp)) {
      
      $line = trim(fgets($fp, 256));
      if ($line == '') {
        continue;
      }
      
      /* We have now moved past one or more blank lines, next is the
       * date: */
      $date = explode(':', strtr($line, '/ ', '::'));
      $timestamp = gmmktime($date[3], $date[4], 0,
                            $date[1], $date[2], $date[0]);
      
      /* The next lines are the METAR: */
      $metar = trim(fgets($fp, 256));
      while (!feof($fp) && ($line = trim(fgets($fp, 256))) != '') {
        $metar .= ' ' . $line;
      }
      
      /* The ICAO is always the first four characters in the METAR: */
      $icao = substr($metar, 0, 4);

      if (list($db_metar, $db_timestamp) = $this->get_metar($icao)) {
        if ($db_timestamp < $timestamp && $db_metar != $metar) {
          /* The METAR in the database is older than the new METAR, so
           * we go ahead with the update: */
          $this->update_metar($icao, $metar, $timestamp);
          $updated++;
        } else {
          $skipped++;
        }
      } else {
        /* There's no timestamp to check against in this case: */
        $this->insert_metar($icao, $metar, $timestamp);
        $inserted++;
      }

      if (($inserted + $updated + $skipped) % 100 == 0) {
        printf("Inserted: %5d, Updated: %5d, Skipped: %5d\n",
               $inserted, $updated, $skipped);
        flush();
      }

    } /* while (!feof($fp)) */

    printf("Inserted: %5d, Updated: %5d, Skipped: %5d\n",
           $inserted, $updated, $skipped);
    
    fclose($fp);
  }


  /**
   * Returns the name of the station associated with an ICAO.
   *
   * @param   string  ICAO of the station.
   * @return  string  the name of the station, i.e 'Tirstrup' for
   *                  EKAH. If the ICAO doesn't exist in the database
   *                  false is returned.
   * @access  public
   */
  function get_name($icao) {
    $data = $this->lookup_icao($icao);
    if (empty($data)) {
      return false;
    } else {
      return $data[0];
    }
  }


  /**
   * Returns the name of the country associated with an ICAO.
   *
   * @param   string  ICAO of the station.
   * @return  string  the name of the associated country, if it's
   *                  available, otherwise return false.
   * @access  public
   */
  function get_country($icao) {
    $data = $this->lookup_icao($icao);
    if (empty($data)) {
      return false;
    } else {
      return $data[1];
    }
  }


  /**
   * Returns country code associated with an ICAO.
   *
   * @param   string  ICAO of the station.
   * @return  string  country code (cc) for passed station (ICAO) if
   *                  available, false otherwise
   * @access  public
   */
  function get_country_code($icao) {
    $data = $this->lookup_icao($icao);
    if (empty($data)) {
      return false;
    } else {
      return $data[2];
    }
  }
    

}

?>
