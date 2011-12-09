<?php

class pw_option_select extends pw_option {

  var $choices = array();

  function pw_option_select($name, $description, $dependency = false,
                            $choices, $default = false) {
    if ($default && isset($choices[$default])) {
      $this->pw_option($name, $description, $dependency, false, $default);
    } else {
      $this->pw_option($name, $description, $dependency, false, key($choices));
    }
    $this->choices = $choices;
  }

  function is_valid() {
    return in_array($this->value, array_keys($this->choices));
  }

  function show() {

    if ($this->is_ready()) {
      echo "<dt>Option <code>$this->name</code>: "; 
      echo '<select name="' . $this->name . '_value">';
      
      foreach ($this->choices as $choice => $label) {
        if ($choice == $this->value) {
          echo '<option selected="selected" value="' .
            htmlentities($choice) . "\">$label</option>\n";
        } else {
          echo '<option value="' . htmlentities($choice) . "\">$label</option>\n";
        }
      }
      echo "</select>\n</dt>\n";
      echo '<dd><p>' . $this->description . "</p>\n";
      if ($this->is_valid()) {
        echo '<p style="color: green">Input accepted.</p>';
      } else {
        echo '<p style="color: red">Please correct your input: &quot;' .
          $this->value . '&quot; is not among your choices.</p>';
      }
      echo "\n</dd>\n";
    }
  }
  
}

?>