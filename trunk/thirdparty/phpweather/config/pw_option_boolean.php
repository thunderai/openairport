<?php
class pw_option_boolean extends pw_option_select {

  function get_config() {
    if ($this->is_ready() && $this->value != $this->default) {
      return "/* $this->name */\n\$this->properties['$this->name'] = " .
        "$this->value;\n\n";
    } else {
      return '';
    }
  }

}

?>