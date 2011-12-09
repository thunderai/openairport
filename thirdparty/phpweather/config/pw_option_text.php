<?php
class pw_option_text extends pw_option {

  function pw_option_text($name, $description, $dependency,
                          $validator = false, $default = false) {
    $this->pw_option($name, $description, $dependency, $validator, $default);
  }

  function show() {

    if ($this->is_ready()) {
      echo "<dt>Option <code>$this->name</code>: ";
      echo '<input type="text" name="' . $this->name .
        '_value" value="' . htmlentities($this->value) .
        '" onkeyup="' . $this->validator->get_javascript($this->name) .
        "\" /></dt>\n";
      
      echo '<dd><p>' . $this->description . "</p>\n";
      if ($this->is_valid()) {
        echo '<p id="' . $this->name . '"><font color="green">Input accepted.</font></p>';
      } else {
        echo '<p id="' . $this->name . '"><font color="red">' .
          $this->validator->get_error() . '</font></p>';
      }
      echo "\n</dd>\n";
    }
  }

}
?>