<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text_en.php');

/**
 * Provides all the strings needed by pw_text to produce British
 * English output.
 *
 * @author   Nick Crossland <nick@nickcrossland.co.uk>
 * @link     http://www.nickcrossland.co.uk/  My homepage.
 * @version  pw_text_uk.php,v 1.0 2004/02/04 
 */
class pw_text_en_GB extends pw_text_en {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_en_GB($weather, $input = array()) {
    /* We run the parent constructor */
    $this->pw_text_en($weather, $input);

    /* Now override the strings with the British English spellings: */
    $this->strings['meters_per_second']        = ' metres per second';
    $this->strings['meter']                    = ' metre';
    $this->strings['meters']                   = ' metres';
    $this->strings['kilometers']               = ' kilometres';
  }
}

?>
