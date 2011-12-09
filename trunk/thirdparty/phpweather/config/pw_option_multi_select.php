<?php

class pw_option_multi_select extends pw_option {

  var $choices = array();

  function pw_option_multi_select($name, $description, $dependency = false, $choices) {
    $this->pw_option($name, $description, $dependency);
    $this->choices = $choices;
  }

  function is_valid() {
    foreach ($this->value as $value) {
      if (!in_array($value, array_keys($this->choices))) {
        return false;
      }
    }
    return true;
  }

  function update_value($values) {
    if (isset($values[$this->name . '_value'])) {
      $this->value = $values[$this->name . '_value'];
    } else {
      $this->value = array();
    }
  }

  function show() {
    if ($this->is_ready()) {
      echo "<dt>Option <code>$this->name</code>: " .
        '<select name="' . $this->name . '_value[]" multiple="multiple">';
      foreach ($this->choices as $choice => $label) {
        if (in_array($choice, $this->value)) {
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
        echo '<p style="color: red">Please correct your input.</p>';
      }
      echo "</dd>\n";
    }
  }

  function get_config() {
    if ($this->is_ready() && $this->is_valid() && !empty($this->value)) {
      /* Escape the value using the static pw_option::escape_str
       * method as a callback */
      $escaped = array_map(array('pw_option', 'escape_str'), $this->value);
      return "/* $this->name */\n" .
        "\$this->properties['$this->name'] = array(\n" .
        "  '" . implode("',\n  '", $escaped) . "'\n);\n";
    } else {
      return '';
    }
  }
} /* class multi_select */
?>