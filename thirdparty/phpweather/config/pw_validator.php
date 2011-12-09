<?php

/**
 * This is the baseclass for all validators.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_validator.php,v 1.4 2002/04/13 13:11:53 gimpster Exp
 * @package  PHP Weather Configurator
 * @abstract
 */
class pw_validator {

  /**
   * The message displayed when the input is invalid.
   *
   * @var string
   * @access private
   */
  var $error;

  /**
   * The last value validated.
   *
   * @var string
   * @access private
   */
  var $value;

  /**
   * Constructs a new validator.
   *
   * @param  string  $error  The message displayed when the input is
   *                         invalid.
   */
  function pw_validator($error) {
    $this->error = $error;
  }

  /**
   * Validate some input.
   *
   * This method should be overridden by the subclasses so that they
   * can validate the input according to their type.
   *
   * @param  string  $value  The new value that should be validated.
   * @return boolean Returns true if the input it valid, false otherwise.
   *
   */
  function validate($value) {
    $this->value = $value;
    return true;
  }

  /**
   * Returns the error message.
   *
   * The message is fed to sprintf() so that '%s' in the messages is
   * replaced by the last value that was validated using this
   * validator.
   *
   * @return  string  The error message.
   */
  function get_error() {
    return sprintf($this->error, $this->value);
  }

  /**
   * Returns code for the keyup event in input fields.
   *
   * @param string $id The name that should be passed to the
   * Javascript as an ID. The ID is used by the Javascript to change
   * the right paragraph at runtime.
   * @return  string  A string suitable for the keyup event on an text
   *                  input field.
   */
  function get_javascript($id) {
    return '';
  }

}


?>