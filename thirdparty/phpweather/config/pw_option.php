<?php

/**
 * This is the baseclass for all options.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_option.php,v 1.5 2003/07/01 10:15:36 gimpster Exp
 * @package  PHP Weather Configurator
 * @abstract
 */
class pw_option {

  /**
   * The name of this option.
   *
   * It's important that this name correspond to an object in a global
   * array called $options. If this option is called 'icao', then the
   * object must be saved to $HTTP_SESSION_VARS['icao']
   *
   * @var string
   */
  var $name = '';

  /**
   * A description of the option.
   * 
   * This should be a note that explains what this option does.
   *
   * @var string
   */
  var $description = '';

  /**
   * The dependency of this option.
   *
   * @var object
   */
  var $dependency = null;

  /**
   * The current value of the option.
   *
   * @access private
   * @var string
   */
  var $value = '';

  /**
   * The default value of the option.
   *
   * This will be used to determine if the option has changed. A call
   * to get_config() will only return a non-empty string if the option
   * is changed.
   *
   * @access private
   * @var string
   */
  var $default = '';

  /**
   * The validator used by this option.
   *
   * The validator will be asked to validate the value of the option
   * to determine if the input is valid. If not, then a call to
   * get_config() will return an empty string.
   *
   * @access private
   * @var pw_validator
   */
  var $validator;

  function pw_option($name, $description, $dependency = false,
                     $validator = false, $default = false) {
    $this->name = $name;
    $this->description = $description;
    $this->dependency = $dependency;
    if ($validator) {
      $this->validator = $validator;
    } else {
      $this->validator = new pw_validator('Please correct your input');
    }
    if ($default !== false) {
      $this->default = $default;
      $this->update_value(array($name . '_value' => $default));
    }

  }

  /**
   * Get the name of this option.
   *
   * @return the name of the option.
   */
  function get_name() {
    return $this->name;
  }

  /**
   * Get the description of this option.
   *
   * @return the description of the option.
   */
  function get_description() {
    return $this->description;
  }

  /**
   * Get the value of this option.
   *
   * @return the value of the option.
   */
  function get_value() {
    return $this->value;
  }

  /**
   * Checks to see if this option is ready to be displayed.
   *
   * @return  boolean  Returns true if the option is ready to be
   * displayed, false otherwise.
   */
  function is_ready() {
    if (empty($this->dependency))
      return true;
    else
      return $this->dependency->check();
  }

  /**
   * Checks to see if this option has a valid value.
   *
   * The validator that was supplied when the option was created is
   * asked to validate the current value of the option.
   *
   * @return boolean True if the option has a valid value false
   * otherwise.
   */
  function is_valid() {
    return $this->validator->validate($this->value);
  }

  /**
   * Updates the current value.
   *
   * @param array New values. This array should have the same
   * structure as $HTTP_POST_VARS which means that it should contain
   * option_name_value => value pairs where option_name is the name of
   * an option.
   */
  function update_value($values) {
    if (isset($values[$this->name . '_value'])) {
      $this->value = $values[$this->name . '_value'];
    }
  }

  /**
   * Escapes a string.
   *
   * The string can then be can be wrapped in single quotes and safely
   * read back using PHP to get the original string.
   *
   * @param   string  The string that should be escaped.
   * @return  string  The escaped string.
   */
  function escape_str($str) {
    $str = str_replace('\\', '\\\\', $str);
    $str = str_replace('\'', '\\\'', $str);
    return $str;
  }

  /**
   * Returns the configuration.
   *
   * @return  string  A string suitable for inclusion in the
   * defaults.php file. If the option isn't ready yet or it's invalid
   * an empty string is returned.
   */
  function get_config() {
    if ($this->is_ready() && $this->is_valid() &&
        $this->value != $this->default) {
      return "/* $this->name */\n\$this->properties['$this->name'] = " .
        "'" . $this->escape_str($this->value) . "';\n\n";
    } else {
      return '';
    }
  }


}

?>