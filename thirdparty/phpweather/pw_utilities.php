<?php

/* Miscellaneous functions that can help you build an interactive site
 * with PHP Weather. */

/**
 * Builds a select box.
 *
 * @param  string  The name assigned to the select tag.
 * @param  array   An associative array with data.
 * @param  string  The key that will be marked as the selected key,
 *                 if any.
 */
function build_select($name, $data, $selected_key = '') {
  $output = '<select name="' . $name . '">';
  
  while (list($k, $v) = each($data)) {
    if ($k == $selected_key) {
      $output .= "\n<option value=\"$k\" selected=\"selected\">$v</option>";
    } else {
      $output .= "\n<option value=\"$k\">$v</option>";
    }
  }
  $output .= "\n</select>\n";
  
  return $output;
}

/**
 * Returns HTML code which makes a select box with names of countries.
 *
 * @param  object  The phpweather object to query for available
 *                 countries.
 * @param  string  The country code that should be selected, if any.
 * @return string  The HTML code.
 */
function get_countries_select($weather, $old_cc = '') {
  $countries = $weather->db->get_countries();
  return build_select('cc', $countries, $old_cc);
}


/**
 * Returns HTML code which makes a select box with the names of
 * stations in a given country.
 *
 * @param  object  The phpweather object to query for available
 *                 stations.
 * @param  string  The country code of the country.
 * @param  string  The ICAO that should be selected, if any.
 * @return string  The HTML code.
 */
function get_stations_select($weather, $cc, $old_icao = '') {
  $country = ''; // Dummy variable.
  $icaos = $weather->db->get_icaos($cc, $country);
  return build_select('icao', $icaos, $old_icao);
}


/**
 * Returns HTML code which makes a select box with available
 * languages for the 'text' output module.
 *
 * @param  string  The language that should be selected, if any.
 * @return string  The HTML code.
 */
function get_languages_select($old_language = '') {
  return build_select('language', get_languages('text'), $old_language);
}


/**
 * Returns a list of available languages.
 *
 * @return array   An associative array with the language codes as the
 * keys and the names of the languages as the values.
 *
 * @param  string  The type of output module you're interested in, eg.
 *                 'text' for the text output module.
 */
function get_languages($type) {
  
  static $output = array();
  
  if (empty($output)) {
    
    /* I use dirname(__FILE__) here instead of PHPWEATHER_BASE_DIR
     * because one might use this function without having included
     * phpweather.php first. */
    require(dirname(__FILE__) . '/languages.php');
    
    $dir = opendir(dirname(__FILE__) . '/output');
    while($file = readdir($dir)) {
      if (ereg("^pw_${type}_([a-z][a-z])(_[A-Z][A-Z])?\.php$", $file, $regs)) {
        $output[$regs[1] . $regs[2]] = $languages[$regs[1] . $regs[2]];
      }
    }
    closedir($dir);
  }
  
  asort($output);

  return $output;
}

?>
