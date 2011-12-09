<?php
class pw_option_integer extends pw_option_text {

  function pw_option_integer($name, $description, $dependency = false,
                          $validator = false, $default = false) {
    if (!$validator) {
      $validator = new pw_validator_ereg("Sorry, '%s' is not an integer.",
                                         '^[-+]?[0-9]+$');
    }
    $this->pw_option_text($name, $description, $dependency,
                          $validator, $default);
  }

  function get_config() {
    if ($this->is_ready() && $this->is_valid() &&
        $this->value != $this->default) {
      return "/* $this->name */\n\$this->properties['$this->name'] = " .
        "$this->value;\n\n";
    } else {
      return '';
    }
  }



}
?>