<?php
/**
 * Validates an integer.
 *
 * This class checks that an interger is in a given range. This is
 * usefull for testing port-numbers (range 1--65536) or peoples age
 * (range 1--120) etc.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_validator_range.php,v 1.5 2003/04/20 13:12:43 gimpster Exp
 * @package  PHP Weather Configurator
 */
class pw_validator_range extends pw_validator {

  /**
   * The lower bound in the range
   * @var integer
   * @access private
   */
  var $low;

  /**
   * The upper bound in the range
   * @var integer
   * @access private
   */
  var $high;

  /** You might want to allow the empty string as valid input.
   * @var boolean
   * @access private
   */
  var $empty_ok;
  
  /**
   * Constructs a new validator.
   *
   * @param  string   $error     The message displayed when invalid input is given.
   * @param  integer  $low       The lower bound of the range.
   * @param  integer  $high      The upper bound of the range.
   * @param  boolean  $empty_ok  Is the empty string valid?
   */
  function pw_validator_range($error, $low, $high, $empty_ok = false) {
    $this->pw_validator($error);
    $this->low = $low;
    $this->high = $high;
    $this->empty_ok = $empty_ok;
  }

  /**
   * Validate an integer.
   *
   * The input is validated to see if it's within the range specified
   * when the validator was created.
   *
   * @param integer $value The new integer that should be validated.
   * @return boolean Returns true if the integer is within the correct
   * range, false otherwise.
   */
  function validate($value) {
    $this->value = $value;
    
    if ($this->empty_ok && empty($value)) return true;

    return (ereg('^[-+]?[0-9]+$', $value) && $this->low <= $value && $value <= $this->high);
  }

  /**
   * Returns code for the keyup event in input fields.
   *
   * @param string $id The name that should be passed to the
   * Javascript as an ID. The ID is used by the Javascript to change
   * the right paragraph at runtime.
   * @return string A string suitable for the keyup event on an text
   * input field.
   */
  function get_javascript($id) {
    $empty_ok = $this->empty_ok ? '1' : '0';
    return "validate_range('" . addslashes($this->error) .
      "', $this->low, $this->high, $empty_ok, '$id', this)";
  }

}
?>