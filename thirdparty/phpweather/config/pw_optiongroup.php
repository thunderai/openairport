<?php

/**
 * A group of options.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_optiongroup.php,v 1.6 2002/12/28 14:15:47 gimpster Exp
 * @package  PHP Weather Configurator
 */
class pw_optiongroup {

  /**
   * A unique identifier for this group.
   *
   * This is used in the Javascript for collapsing and expanding the
   * group.
   *
   * @var string The ID of this group.
   */
  var $id;

  /**
   * Is this group visible?
   * 
   * @var boolean true if the group is visible, false otherwise.
   */
  var $visible;

  /**
   * The title of this group.
   *
   * @var string The title of this group.
   */
  var $title;

  /**
   * The description of this group.
   *
   * @var string The description of this group.
   */
  var $description;

  /**
   * The options which are part of this group.
   *
   * @var array The names of the options which are part of this group.
   */
  var $options;

  /**
   * Constructs a new group of options.
   *
   * Optiongroups are used to - well - group similar options. By
   * grouping the options, you can provide a broad description of the
   * them before the individual options presnet their own description.
   *
   * @param  string  $title The title of the group.
   * @param  string  $description  The description of the group.
   * @param  array   $options  The names of the options in the group.
   *
   */
  function pw_optiongroup($id, $title, $description, $options, $visible = true) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->options = $options;
    $this->visible = $visible;
  }

  /**
   * Shows the group and the options it contains.
   *
   * It is assumed that the call to this method is wrapped in a
   * description-list (<dl>...</dl>). The options of this group will
   * be inserted in their own description-list.
   */
  function show() {
    global $HTTP_SESSION_VARS;

    if ($this->visible) {
      $style = 'block';
      $text = 'Hide options.';
      echo '<input id="' . $this->id . '_input" type="hidden" name="' .
        $this->id . '_visible" value="1" />' . "\n";
    } else {
      $style = 'none';
      $text = 'Show options.';
      echo '<input id="' . $this->id . '_input" type="hidden" name="' .
        $this->id . '_visible" value="0" />' . "\n";
    }
    echo "<dt>$this->title <input type=\"submit\" value=\"Update options\" /></dt>\n";
    echo "<dd><p>$this->description</p>\n";
    echo "<p><a href=\"javascript:toggle_group('$this->id')\" id=\"" .
      $this->id . "_text\">$text</a></p>\n";
    echo "<dl id=\"$this->id\" style=\"display: $style\">\n";
    
    foreach($this->options as $option) {
      $HTTP_SESSION_VARS[$option]->show();
    }
    
    echo "</dl>\n";
    echo "</dd>\n";

  }

  /**
   * Returns the configuration.
   *
   * The configuration is ready to be inserted into the defaults.php
   * file. It includes a header with the title of the group followed
   * by the configuration of the options.
   *
   * @return  string  The configuration of the options in the group.
   */
  function get_config() {
    global $HTTP_SESSION_VARS;

    $config = '';
    foreach($this->options as $option) {
      $config .= $HTTP_SESSION_VARS[$option]->get_config();
    }

    $stars = "\n/*" . str_repeat('*', 64) . "*/\n";
    $top = $stars . '/*' . str_pad($this->title, 64, ' ', STR_PAD_BOTH) . "*/" . $stars;

    if ($config == '') {
      return $top . '/* ' . str_pad('All options are at their default values.', 63) . "*/\n";
    } else {
      return $top . '/* ' . str_pad('The following options have been changed:', 63) . "*/\n" .
        "\n$config\n";
    }
  }

}

?>