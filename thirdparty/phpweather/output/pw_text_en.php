<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text_en_US.php');

/**
 * Alias for the English output.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @link     http://www.gimpster.com/  My homepage.
 * @version  pw_text_en.php,v 1.10 2004/02/11 14:08:16 gimpster Exp
 */
class pw_text_en extends pw_text_en_US {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text_en_US().
   */
  function pw_text_en($weather, $input = array()) {
    /* We run the parent constructor, this gives us American English
     * output strings --- change this to pw_get_en_GB for British
     * English strings. */
    $this->pw_text_en_US($weather, $input);
  }
}

?>
