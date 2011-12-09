<?php

/**
 * Provides some basic capabilities like error-handling and handling
 * of defaults.
 *
 * This class handles various messages. By using this class, you'll 
 * get a set of standard methods to generate messages. You can make 
 * error-messages, notices and print debug-information.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  base_object.php,v 1.14 2003/03/05 19:56:57 gimpster Exp
 * @package  PHP Weather
 */
class base_object {
  
  /**
   * All the objects properties are stored in this array.
   *
   * @var  array
   */
  var $properties = array();

  /**
   * The version.
   *
   * @var  string
   */
  var $version = '2.2.2';


  /**
   * Sets up the properties by overriding the defaults with the actual input.
   *
   * First it includes the file 'defaults-dist.php'. Next it includes
   * 'defaults.php'. You should place your local customizations in 
   * 'defaults.php' file, since it will never be overridden. 
   * Finally it runs through $input and overrides the properties defined there.
   * 
   * @param  $input  array   The initial properties of the object
   * @see    $properties
   */
  function base_object($input = array()) {

    include(PHPWEATHER_BASE_DIR . '/defaults-dist.php');

    if(file_exists(PHPWEATHER_BASE_DIR . '/defaults.php')) {
      include(PHPWEATHER_BASE_DIR . '/defaults.php');
    }
    
    /* Then we override the defaults with the actual properties */
    while (list($key, $value) = each($input)) {
      $this->properties[$key] = $value;
    }
  }
  
  /**
   * Changed the verbosity level.
   *
   * @param   integer  The new level of verbosity.
   * @return  void     There's no need to return anything here.
   * @see     get_verbosity(), $verbosity
   */
  function set_verbosity($new_verbosity) {
    $this->verbosity = $new_verbosity;
    return;
  }

  /**
   * Get the level of verbosity.
   *
   * @see  set_verbosity(), $verbosity
   */
  function get_verbosity() {
    return $this->verbosity;
  }
  
  /**
   * Prints an error-message and halts execution.
   *
   * If the first bit is set in $this->verbosity, this function will
   * print the message, prefixed with the word 'Error:' in bold. If
   * you supply it with the optional arguments $file and $line, these
   * will also be printed.
   *
   * The script will be terminated after the message has been shown.
   *
   * @param  string  The error-message.
   * @param  string  The name of the file where the error occurred.
   * @param  string  The line where the error occurred.
   */
  function error($msg, $file = '', $line = '') {
    if ($this->properties['verbosity'] & 1) {
      if (!empty($line)) {
        echo "<p><b>Fatal error:</b> $msg.\n<br>Line <b>$line</b> in file <b>$file</b>.</p>\n";
      } else {
        echo "<p><b>Fatal error:</b> $msg.</p>\n";
      }
      exit;
    }  
  }


  /**
   * Issues a warning.
   *
   * If the second bit is set in $this->properties['verbosity'], this
   * function will print the message, prefixed with the word
   * 'Warning:' in bold. If you supply it with the optional arguments
   * $file and $line, these will also be printed.
   *
   * Execution of the script continues.
   *
   * @param  string  The warning.
   * @param  string  The name of the file where the error occurred.
   * @param  string  The line where the error occurred.
   */
  function warning($msg, $file = '', $line = '') {
    if ($this->properties['verbosity'] & 2) {
      if (!empty($line)) {
        die("<p><b>Warning:</b> $msg.\n<br>Line <b>$line</b> in file <b>$file</b>.</p>\n");
      } else {
        die("<p><b>Warning:</b> $msg.</p>\n");
      }
    }  
  }

  
  /**
   * Prints a message for debugging.
   *
   * The message is only printed if the third bit is set in
   * $this->properties['verbosity']. The word 'Debug:' in bold will be
   * prefixed the message.
   * 
   * @param  string  The debug-message.
   * @param  string  The name of the file where the message comes from.
   * @param  string  The line where the message comes from.
   */
  function debug($msg, $file = '', $line = '') {
    if ($this->properties['verbosity'] & 4) {
      if (!empty($line)) {
        echo "<p><b>Debug:</b> $msg. Line <b>$line</b> in file <b>$file</b>.</p>\n";
      } else {
        echo "<p><b>Debug:</b> $msg.</p>\n";
      }
    }  
  }

  /**
   * Prints properties.
   *
   * This method prints all the properties, of this object. It is only 
   * used as a tool for debugging.
   */
  function print_properties() {
    echo "<pre>\n";
    print_r($this->properties);
    echo "</pre>\n";
  }
  
}

?>
