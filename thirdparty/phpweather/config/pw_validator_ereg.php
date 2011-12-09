<?php
/**
 * Validates input against a regular expression.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_validator_ereg.php,v 1.4 2003/04/20 13:12:43 gimpster Exp
 * @package  PHP Weather Configurator
 */
class pw_validator_ereg extends pw_validator {

  /**
   * The regular expression used when validating.
   *
   * @var string A regular expression.
   */
  var $regex;

  /**
   * Constructs a new ereg_validator.
   *
   * @param  string  $error  The message displayed when the input is
   *                         invalid.
   * @param  string  $regex  The regular expression used when validating.
   */
  function pw_validator_ereg($error, $regex) {
    $this->pw_validator($error);
    $this->regex = $regex;
  }
  
  /**
   * Validates input agains a regular expression.
   *
   * Validates some input.
   *
   * @param mixed $value The input that should be matched agains the
   * regular expression.
   *
   * @return boolean True if the regular expression matched the input,
   * false otherwise.
   * @access public
   */
  function validate($value) {
    $this->value = $value;
    return ereg($this->regex, $value);
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
    return "validate_ereg('" . addslashes($this->error) .
      "', '$this->regex', '$id', this)";
  }


}
?>