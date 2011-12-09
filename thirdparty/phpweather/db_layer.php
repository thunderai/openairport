<?php

require_once(PHPWEATHER_BASE_DIR . '/base_object.php');

/**
 * This class is used to maintain the database-object.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  db_layer.php,v 1.14 2002/11/10 23:15:40 gimpster Exp
 */
class db_layer extends base_object {

  /** 
   * Variable containing the database-object.
   *
   * The database-object handles all communication with the
   * database. It is created as an object of the appropriate type, like
   * db_mysql, db_pgsql, etc.
   *
   * @var     object db_type
   * @access  public
   */
  var $db;

  /**
   * Creates the database-object based on $input['db_type'].
   *
   * @param  $input  array   Initial properties for the object.
   */
  function db_layer($input = array()) {
    /* We call the parent constructor. */
    $this->base_object($input);
    
  /* We then create our db object */
    $this->set_db_type($this->properties['db_type']);
  }

  /**
   * Sets the database-type and creates the database-object.
   *
   * If the type isn't recognized, then 'null' will be used instead, as
   * this database-type is always available.
   *
   * @param  $type  string   The database-type, like 'null', 'mysql' and so on.
   */
  function set_db_type($type) {
    $this->properties['db_type'] = $type;

    switch ($type) {
    case 'null':
      include_once(PHPWEATHER_BASE_DIR . '/db/pw_db_null.php');
      $this->db = new pw_db_null($this->properties);
      break;
    case 'mysql':
      include_once(PHPWEATHER_BASE_DIR . '/db/pw_db_mysql.php');
      $this->db = new pw_db_mysql($this->properties);
      break;
    case 'pgsql':
      include_once(PHPWEATHER_BASE_DIR . '/db/pw_db_pgsql.php');
      $this->db = new pw_db_pgsql($this->properties);
      break;
    case 'dba':
      include_once(PHPWEATHER_BASE_DIR . '/db/pw_db_dba.php');
      $this->db = new pw_db_dba($this->properties);
      break;
    case 'adodb':
      include_once(PHPWEATHER_BASE_DIR . '/db/pw_db_adodb.php');
      $this->db = new pw_db_adodb($this->properties);
      break;
    default:
      $this->error('db_type not recognized: <code>' .
                   $this->properties['db_type'] .
                   '</code>, using <code>null</code>.');
      $this->set_db_type('null');
      break;
    }
  }

  /**
   * Gets the database-type.
   *
   * @return string   The type of the database used, like 'none', 'mysql'
   * and so on.
   */

  function get_db_type() {
    return $this->properties['db_type'];
  }
  
}


?>
