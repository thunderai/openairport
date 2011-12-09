<?php

require_once(PHPWEATHER_BASE_DIR . '/base_object.php');

/**
 * Base class for other classes that produce output.
 *
 * This class is responsible for saving the phpweather object and for
 * initializing the properties from that object.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_output.php,v 1.1 2003/03/05 19:53:23 gimpster Exp
 */
class pw_output extends base_object {

  var $weather = null;

  function pw_output($weather, $input = array()) {
    $this->weather = $weather;
    
    $this->properties = $weather->properties;

    while (list($key, $value) = each($input)) {
      $this->properties[$key] = $value;
    }

    /* No need to call the constructor in base_object, as it will only
     * waste time by calling include() --- we've already gotten our
     * properties form the $weather object. */

  }

}

?>