<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_output.php');

/**
 * Provides all the function needed to generate text output.
 *
 * This class has the capability to do a pretty-print, if it is
 * provided with the right set of strings. It's up to child-classes to
 * provide these strings, and override the methods in this class, as
 * necessary. The logic in the pretty-print is built around the English
 * output, but it should still be possible to make a good translation, by
 * just translating the strings.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_text.php,v 1.17 2003/03/05 19:53:24 gimpster Exp
 */
class pw_text extends pw_output {

  /**
   * The strings used in the translation are stored here.
   *
   * Each string is identified by its key in the array. Some strings
   * are used between the dynamic parts, and others are used as
   * format-strings in calls to sprintf().
   *
   * @var  array  $strings
   */
  var $strings = array();


  /**
   * Constructor.
   *
   * This class shouldn't be instanced directly, instead you should
   * use one of it's subclasses such as pw_text_en, pw_text_da, or
   * another language.
   *
   * @param   phpweather  The object with the weather.
   * @access  public
   */
  function pw_text($weather, $input = array()) {
    /* We just call the parent constructor. */
    $this->pw_output($weather, $input);
  }

  /**
   * Returns the character encoding used in the current language.
   *
   * This information should be used to send a HTTP header to the
   * browser like this, where $charset has been set by calling this
   * method:
   *
   * header("Content-Type: text/html; charset=$charset");
   *
   * @return  string  The character encoding, e.g. ISO-8859-1 for
   * Western languages, ISO-8859-2 for Central European languages and
   * so on.
   */
  function get_charset() {
    return $this->strings['charset'];
  }
  
  /**
   * Sets the marks (the strings inserted before and after every number)
   *
   * @param  string  The mark used before numbers and other data elements,
   *                 for example '<font color="red">'
   *
   * @param  string  The mark used after numbers and other data
   *                 elements, for example '</font>'. If you use HTML
   *                 tags, it's your responsibility to ensure that
   *                 they match up. If they don't, then your pages
   *                 might not render properly.
   *
   * @access  public
   * @see     get_marks()
   */
  function set_marks($new_mark_begin, $new_mark_end) {
    $this->properties['mark_begin'] = $new_mark_begin;
    $this->properties['mark_end'] = $new_mark_end;
  }
  
  /**
   * Gets the marks.
   *
   * @return  array  The first element is the string that's inserted
   *                 before any number, and the second element is the
   *                 string inserted after. The first element is also
   *                 known as 'mark_begin' and the second as 'mark_end'.
   *
   * @access  public
   * @see     set_marks()
   */
  function get_marks() {
    return array($this->properties['mark_begin'],
		 $this->properties['mark_end']);
  }
  
  /**
   * Specifies which kind of units to display.
   *
   * $new_pref_units can be one of the following strings:
   *
   * --- 'both_metric' if one wants to produce output like this:
   *   '10 kilometers (16.1 miles)'
   *
   * --- 'both_imperial' if one wants to produce output like this:
   *   '16.1 miles (10 kilometers)'
   *
   * --- 'only_metric' if one wants to produce output like this: 
   *   '10 kilometers'
   *
   * --- 'only_imperial' if one wants to produce output like this: 
   *   '16.1 miles'
   *
   * If $new_pref_units isn't recognized, 'both_imperial' will be used.
   *
   * @param   string  The new kind of units one wants to use.
   * @access  public
   * @see     get_pref_units()
   */
  function set_pref_units($new_pref_units) {
    switch ($new_pref_units) {
    case 'both_metric':
    case 'both_imperial':
    case 'only_metric':
    case 'only_imperial':
      $this->properties['pref_units'] = $new_pref_units;
      break;
    default:
      $this->properties['pref_units'] = 'both_imperial';
      $this->error('argument to pref_units() not recognized: <code>' .
		   $new_pref_units .
		   '</code>, using <code>both_imperial</code> instead.');
      break;
    }
  }
  
  /**
   * Gets the preferred units.
   *
   * @return  string  The preferred kind of units. This will be one of
   *                  'both_metric', 'both_imperial', 'only_metric' or
   *                  'only_imperial'.
   *
   * @access  public
   * @see     set_pref_units()
   */
  function get_pref_units() {
    return $this->properties['pref_units'];
  }
  
  /**
   * Used to specify which elements one wants to exclude from the
   * pretty-print.
   *
   * @param  array  The array should contain the names of the sections
   *                one doesn't want to be displayed, like 'wind' or
   *                'time' if one wants to skip the wind or time parts
   *                of the pretty-print.
   *
   * @access  public
   * @see     get_exclude()
   */
  function set_exclude($new_exclude) {
    if (is_array($new_exclude)) {
      $this->properties['exclude'] = $new_exclude;
    } else {
      $this->error("argument to set_exclude() is not an array: $new_exclude");
    }
  }
  
  /**
   * Gets the array of excluded elements of the pretty-print.
   *
   * @return  array   The excluded elements.
   * @access  public
   * @see     set_exclude()
   */
  function get_exclude() {
    return $this->properties['exclude'];
  }
  
  /**
   * Used to format strings with regard to the preferred units.
   *
   * If 'pref_units' isn't recognized, the function will set it to
   * 'both_imperial', and try again.
   *
   * @param   string   This string should always contain the metric value.
   * @param   string   This string should always contain the imperial value.
   *
   * @return string   The two arguments in the correct order with regard
   *                  to the preferred units.
   *
   * @see     set_pref_units()
   * @access  private
   */
  function pref_units($str1, $str2) {
    switch ($this->properties['pref_units']) {
    case 'both_metric':
      return "$str1 ($str2)";
      break;
    case 'both_imperial':
      return "$str2 ($str1)";
      break;
    case 'only_metric':
      return $str1;
      break;
      case 'only_imperial';
      return $str2;
      break;
    default:
      $this->error('<code>pref_units</code> not recognized: ' .
		   $this->properties['pref_units']);
      $this->set_pref_units('both_imperial');
      return $this->pref_units($str1, $str2);
      break;
    }
  }
  
  /**
   * Builds sentences from smaller bits.
   *
   * Takes an arbitrary number of strings as its arguments, and
   * returns them with commas between. The strings used between the
   * arguments are controlled by these variables:
   *
   * - $strings['list_sentences_and']
   *
   * - $strings['list_sentences_comma']
   *
   * - $strings['list_sentences_final_and']
   *
   * Only non-empty arguments are used, so it's safe to call this
   * function with empty strings. But if you try to call it with
   * uninitialized variables, then PHP might warn you about it anyway.
   *
   * @access  private
   * @return  string   The arguments put together.
   */
  function list_sentences () {
    $num_args = func_num_args();
    
    if ($num_args == 0) {   /* No arg, return */
      return;
    }
    
    $args      = func_get_args();
    $real_args = array();
    
    while (list($i, $val) = each($args)) {
      if (!empty($val)) {
	$real_args[] = $val;
      }
    }
    
    $num_real_args = count($real_args);
    if ($num_real_args == 0) {
      return;
    } elseif ($num_real_args == 1) {
      return $real_args[0];
    } elseif ($num_real_args == 2) {
      return $real_args[0] . $this->strings['list_sentences_and'] . $real_args[1];
    } else {
      $output = $real_args[0];
      
      for ($i = 1; $i < $num_real_args - 1; $i++) {
	$output .= $this->strings['list_sentences_comma']. $real_args[$i];
      }
      $output .= $this->strings['list_sentences_final_and'] . $real_args[$i];
      return $output;
    }
  }
  
  /**
   * Used to parse precipitation.
   *
   * @param   integer   The amount of precipitation measured in inches.
   * @param   integer   The amount of precipitation measured in millimeters.
   * @access  private
   * @return  string    A formatted string with information about the
   *                    precipitation.
   */
  function parse_precip($in, $mm) {
    
    if (!empty($in)) {
      if ($in < 0) {
	$amount = $this->properties['mark_begin'] .
	  $this->strings['precip_a_trace' ] .
	  $this->properties['mark_end'];
      } else {
	$amount = $this->pref_units($this->properties['mark_begin'] . $mm .
				    $this->properties['mark_end'] .
				    $this->strings['mm'],
				    $this->properties['mark_begin'] . $in .
				    $this->properties['mark_end'] .
				    $this->strings['inches']);
      }
      return $amount;
    }
  }
  
  /**
   * Function used to parse a cloud-group.
   *
   * @param   array    The cloud-group to be parsed. This should be a group
   *                   as parse_metar() would return it.
   * @access  private
   * @return  string   The string used in the pretty-print.
   */
  function parse_cloud_group($cloud_group) {
    if (empty($cloud_group) || !is_array($cloud_group)) {
      return;
    }
    
    extract($cloud_group);
    
    if (isset($prefix) && $prefix == -1) {
      $prefix = $this->strings['less_than'];
    } else {
      $prefix = '';
    }
    
    if ($condition == 'OVC') {
      /* 'OVC' means that the sky is overcast. This is a special case,
       * since the sentence starts with 'The sky was...' instead of
       * 'There was...' in English.
       */
      $output = sprintf($this->strings['cloud_overcast'],
			$this->properties['mark_begin'],
			$this->properties['mark_end']) .
	$this->pref_units($this->properties['mark_begin'] . $meter .
			  $this->properties['mark_end'] . $this->strings['meter'],
			  $this->properties['mark_begin'] . $ft .
			  $this->properties['mark_end'] . $this->strings['feet']);
    } elseif ($condition == 'VV') {
      /* This is for vertical visibility - another special case. */
      $output = sprintf($this->strings['cloud_vertical_visibility'],
			$this->properties['mark_begin'],
			$this->properties['mark_end']) .
	$this->pref_units($this->properties['mark_begin'] . $meter .
			  $this->properties['mark_end'] . $this->strings['meter'],
			  $this->properties['mark_begin'] . $ft .
			  $this->properties['mark_end'] . $this->strings['feet']);
    } elseif($condition == 'CAVOK') {
      /* 'CAVOK' means 'Ceiling And Visibility OK' - again we have a
       * special case.
       */
      $output = sprintf($this->strings['cavok'],
			$this->pref_units($this->properties['mark_begin'] .
					  '1500' .
					  $this->properties['mark_end'] .
					  $this->strings['meter'],
					  $this->properties['mark_begin'] .
					  '5000' .
					  $this->properties['mark_end'] .
					  $this->strings['feet']));
    } else {
      /* We're dealing with a 'normal' cloud-group.
       * We start by checking weather or not there are any
       * comulonimbus clouds. The string will be inserted later in the
       * output.
       */
      if (empty($cumulus)) {
	$cumulus = '';
      } elseif ($cumulus == 'CB') {
	$cumulus = $this->strings['cumulonimbus'];
      } elseif ($cumulus == 'TCU') {
	$cumulus = $this->strings['towering_cumulus'];
      } else {
	$cumulus = '';
	$this->error("\$cumulus not recognized: $cumulus");
      }
      
      /* Here comes the output. We start with the description of the
       * clouds ('few', 'broken' etc) and then append $cumulus, which
       * might be an empty string. Then comes the height of the
       * cloud-layer.
       */
      $output = $this->properties['mark_begin'] .
	$this->strings['cloud_condition'][$condition] . 
	$cumulus . $this->properties['mark_end'] . $this->strings['cloud_height'] .
	$this->pref_units($this->properties['mark_begin'] . $meter .
			  $this->properties['mark_end'] . $this->strings['meters'],
			  $this->properties['mark_begin'] . $ft .
			  $this->properties['mark_end'] . $this->strings['feet']);
      
    }
    return $output;
  }
  
  /**
   * Function used to parse a weather-group.
   *
   * @param   array    The weather-group to be parsed. The keys of the
   *                   weather-group tells you which kind of weather
   *                   you're dealing with. The value of the array is
   *                   the unparsed codes, like 'RA' for 'rain' etc.
   *
   * @access  private
   * @return  string   The string used in the pretty-print.
   */
  function parse_weather_group($weather_group) {
    if (empty($weather_group)) {
      return;
    }
    
    $output = '';
    
    if (!empty($weather_group['descriptor'])) {
      
      /* The descriptor should be filled in */
      
      if ($weather_group['descriptor'] == 'TS' &&
	  !empty($weather_group['precipitation'])) {
	
        /* Special case for thunderstorms. They use the extra
         * word 'with' between the descriptor (which would be
         * 'thunderstorm' in this case) and the precipitation. 
         * But this is only true if there's also precipitation. 
         */
	
	$output .= $this->strings['weather'][$weather_group['descriptor']] .
	  $this->strings['with'];
      } else {
	$output .= $this->strings['weather'][$weather_group['descriptor']];
      }
    }
    
    /* If the intensity is non-empty, we just add it. If not, it could
     * mean that we're dealing with some 'moderate' precipitation. 
     * If so, 'precipitation' can't be empty. 
     */
    if (!empty($weather_group['intensity'])) {
      $output .= $this->strings['weather'][$weather_group['intensity']];
    } elseif (!empty($weather_group['precipitation'])) {
      $output .= $this->strings['weather'][' '];
    }
    
    /* There can only be one of the next three items. */
    if (!empty($weather_group['precipitation'])) {
      // precipitation can be more than one kind - need to check for
      // this. explode precipitation into chunks of length 2
      $precip = explode(' ', trim(chunk_split($weather_group['precipitation'], 2, ' ')));
      foreach($precip AS $ppnow){
        $output .= $this->strings['weather'][$ppnow] . ', ';
      }
      $output = substr($output,0,-2); // trim off last comma
    } elseif (!empty($weather_group['obscuration'])) {
      $output .= $this->strings['weather'][$weather_group['obscuration']];
    } elseif (!empty($weather_group['other'])) {
      $output .= $this->strings['weather'][$weather_group['other']];
    }
    
    /* 'proximity' can only be 'VC'. We test for it here instead of
     *  earlier because it should be put last. 
     */
    if (!empty($weather_group['proximity'])) {
      $output .= $this->strings['weather'][$weather_group['proximity']];
    }
    return $output;
  }
  
  /**
   * Function used to parse the tendency in a runway-group.
   *
   * @param   string   The tendency. Should be one of the characters
   *                   'U', 'D', or 'N' for an upward, downward, or no
   *                   distinct tendency, respectively.
   *
   *                   If the tendency isn't recognized, an error will
   *                   be raised.
   *
   * @access  private
   * @return  string   The string used in the pretty-print.
   */
  function runway_tendency($tendency) {
    if (empty($tendency)) {
      return;
    } elseif ($tendency == 'U') {
      return sprintf($this->strings['runway_upward_tendency'],
		     $this->properties['mark_begin'],
		     $this->properties['mark_end']);
    } elseif ($tendency == 'D') {
      return sprintf($this->strings['runway_downward_tendency'],
		     $this->properties['mark_begin'],
		     $this->properties['mark_end']);
    } elseif ($tendency == 'N') {
      return sprintf($this->strings['runway_no_tendency'],
		     $this->properties['mark_begin'],
		     $this->properties['mark_end']);
    } else {
      $this->error("\$tendency is out of range: '$tendency'");
      return;
    }
  }

  /**
   * Function used to parse a runway-group.
   *
   * @param   array    The runway-group to be parsed.
   * @access  private
   * @return  string   The string used in the pretty-print.
   * @see     runway_tendency()
   */
  function parse_runway_group($runway_group) {
    if (empty($runway_group) || !is_array($runway_group)) {
      return;
    }
    
    extract($runway_group);
    
    if (empty($approach)) {
      $approach = '';
    } elseif ($approach == 'L') {
      $approach = $this->strings['runway_left'];
    } elseif ($approach == 'C') {
      $approach = $this->strings['runway_central'];
    } elseif ($approach == 'R') {
      $approach = $this->strings['runway_right'];
    } else {
      $approach = '';
      $this->error("parse_runway_group(): \$approach not recognized: $approach"); 
    }
    
    if (!empty($min_meter)) {
      
      if (!empty($min_tendency)) {
	$min_tendency_str = $this->runway_tendency($min_tendency);
      } else {
	$min_tendency_str = '';
      }
      
      if (!empty($max_tendency)) {
	$max_tendency_str = $this->runway_tendency($max_tendency);
      } else {
	$max_tendency_str = '';
      }
      
      $output = $this->strings['runway_between'] .
	$this->pref_units($this->properties['mark_begin'] . $min_meter .
			  $this->properties['mark_end'] . $this->strings['meters'],
			  $this->properties['mark_begin'] . $min_ft .
			  $this->properties['mark_end'] . $this->strings['feet']) . 
	$min_tendency_str . $this->strings['and'] .  
	$this->pref_units($this->properties['mark_begin'] . $max_meter .
			  $this->properties['mark_end'] . $this->strings['meters'],
			  $this->properties['mark_begin'] . $max_ft .
			  $this->properties['mark_end'] . $this->strings['feet']) .
	$max_tendency_str . $this->strings['runway_for_runway'] . 
	$this->properties['mark_begin'] . $nr . $approach .
	$this->properties['mark_end'];
    } else {
      
      $tendency = $this->runway_tendency($tendency);
      
      $output = $this->pref_units($this->properties['mark_begin'] . $meter .
				  $this->properties['mark_end'] .
				  $this->strings['meters'],
				  $this->properties['mark_begin'] . $ft .
				  $this->properties['mark_end'] .
				  $this->strings['feet']) .
	$tendency . $this->strings['runway_for_runway'] .
	$this->properties['mark_begin'] . $nr . $approach .
	$this->properties['mark_end'];
    }
    return $output;
  }
  
  /**
   * Function used to parse a visibility-group.
   *
   * @param   array    The visibility-group to be parsed.
   * @access  private
   * @return  string   The string used in the pretty-print.
   */
  function parse_visibility_group($visibility_group) {
    if (empty($visibility_group) || !is_array($visibility_group)) {
      return;
    }
    
    extract($visibility_group);
    
    if (empty($prefix)) {
      $prefix = '';
    } elseif ($prefix == -1) {
      $prefix = $this->strings['visibility_less_than'];
    } elseif ($prefix == 1) {
      $prefix = $this->strings['visibility_greater_than'];
    } else {
      $prefix = '';
      error("\$prefix is out of range: $prefix!");
    }
    
    if ($meter < 5000) {
      $metric   = $meter;
      $me_unit  = $this->strings['meter'];
      $imperial = $ft;
      $im_unit  = $this->strings['feet'];
    } else {
      $metric   = $km;
      $me_unit  = $this->strings['kilometers'];
      $imperial = $miles;
      $im_unit  = $this->strings['miles'];
    }
    
    if (empty($dir)) {
      $output = $prefix .
	$this->pref_units($this->properties['mark_begin'] . $metric .
			  $this->properties['mark_end'] . $me_unit,
			  $this->properties['mark_begin'] . $imperial .
			  $this->properties['mark_end'] . $im_unit);
    } else {
      $output = $prefix .
	$this->pref_units($this->properties['mark_begin'] . $metric .
			  $this->properties['mark_end'] . $me_unit,
			  $this->properties['mark_begin'] . $imperial .
			  $this->properties['mark_end'] . $im_unit) .
	$this->strings['visibility_to'] .
        $this->properties['mark_begin'] .
	$this->strings['wind_dir_short_long'][$dir] .
        $this->properties['mark_end'];
    }

    return $output;
  }
  
  function print_pretty_location($location) {
    return sprintf($this->strings['location'],
                   $this->properties['mark_begin'],
                   $location,
                   $this->properties['mark_end']);
  }

  function print_pretty_time($time) {
    $minutes_old = round((time() - $time)/60);
    if ($minutes_old > 60) {
      $hours   = round((time() - $time)/3600);
      $minutes = $minutes_old % 60;
    if ($minutes < 1) {
        $minutes = '';
      } else {
        $minutes = sprintf($this->strings['time_minutes'],
                           $this->properties['mark_begin'],
                           $minutes,
                           $this->properties['mark_end']);
      }
      if ($hours == 1) {
        $time_ago = sprintf($this->strings['time_one_hour'],
                            $this->properties['mark_begin'],
                            $this->properties['mark_end'],
                            $minutes);
      } else {
        $time_ago = sprintf($this->strings['time_several_hours'],
                            $this->properties['mark_begin'],
                            $hours,
                            $this->properties['mark_end'],
                            $minutes);
      }
    } else {
      if ($minutes_old < 5) {
        $time_ago = $this->properties['mark_begin'] .
          $this->strings['time_a_moment'] . $this->properties['mark_end'];
      } else {
        $time_ago = $this->properties['mark_begin'] . $minutes_old .
          $this->properties['mark_end'] . $this->strings['minutes'];
      }
    }
    $gmtime = gmdate('H:i', $time);
    
    return sprintf($this->strings['time_format'],
                   $time_ago,
                   $this->properties['mark_begin'],
                   $gmtime,
                   $this->properties['mark_end']);
    
  }

  
  function print_pretty_wind($wind) {
    extract($wind);
    if (!empty($meters_per_second)) {
      $wind_str = $this->strings['wind_blowing'] .
        $this->pref_units($this->properties['mark_begin'] .
                          $meters_per_second .
                          $this->properties['mark_end'] . 
                          $this->strings['meters_per_second'],
                          $this->properties['mark_begin'] .
                          $miles_per_hour .
                          $this->properties['mark_end'] . 
                          $this->strings['miles_per_hour']);
      if (!empty($gust_meters_per_second)) {
        $wind_str .= $this->strings['wind_with_gusts'] .
          $this->pref_units($this->properties['mark_begin'] .
                            $gust_meters_per_second .
                            $this->properties['mark_end'] .
                            $this->strings['meters_per_second'],
                            $this->properties['mark_begin'] .
                            $gust_miles_per_hour .
                            $this->properties['mark_end'] .
                            $this->strings['miles_per_hour']);
      }
      if ($deg == 'VRB') {
        $wind_str .= sprintf($this->strings['wind_variable'],
                             $this->properties['mark_begin'],
                             $this->properties['mark_end']);
      } else {
        
        $dir_str = $this->strings['wind_dir'][intval(round($deg/22.5))];
        
        $wind_str .= $this->strings['wind_from'] .
          $this->properties['mark_begin'] .
          $dir_str . $this->properties['mark_end'] . ' (' .
          $this->properties['mark_begin'] . $deg . '&deg;' .
          $this->properties['mark_end'] . ')';
        if (!empty($var_beg)) {
          
          $dir_beg_str = $this->strings['wind_dir'][intval(round($var_beg/22.5))];
          $dir_end_str = $this->strings['wind_dir'][intval(round($var_end/22.5))];
          
          $wind_str .= sprintf($this->strings['wind_varying'],
                               $this->properties['mark_begin'],
                               $dir_beg_str,
                               $this->properties['mark_end'],
                               $this->properties['mark_begin'],
                               $var_beg,
                               $this->properties['mark_end'],
                               $this->properties['mark_begin'],
                               $dir_end_str,
                               $this->properties['mark_end'],
                               $this->properties['mark_begin'],
                               $var_end,
                               $this->properties['mark_end']);
        }
      }
    } else {
      $wind_str = sprintf($this->strings['wind_calm'],
                          $this->properties['mark_begin'],
                          $this->properties['mark_end']);
    }
    return $wind_str . '.';
  }


  function print_pretty_temperature($temperature) {
    extract($temperature);
    $output = $this->strings['temperature'] . 
      $this->pref_units($this->properties['mark_begin'] . $temp_c .
                        $this->properties['mark_end'] . '&nbsp;&deg;C',
                        $this->properties['mark_begin'] . $temp_f .
                        $this->properties['mark_end'] . '&nbsp;&deg;F');
    if (!empty($dew_c)) {
      $output .= $this->strings['dew_point'] . 
        $this->pref_units($this->properties['mark_begin'] . $dew_c .
                          $this->properties['mark_end'] . '&nbsp;&deg;C',
                          $this->properties['mark_begin'] . $dew_f .
                          $this->properties['mark_end'] . '&nbsp;&deg;F') . '.';
    }
    return $output;
  }

  function print_pretty_altimeter($altimeter) {
    extract($altimeter);
    return $this->strings['altimeter'] . 
      $this->pref_units($this->properties['mark_begin'] . $hpa .
                        $this->properties['mark_end'] .
                        $this->strings['hPa'],
                        $this->properties['mark_begin'] . $inhg .
                        $this->properties['mark_end'] .
                        $this->strings['inHg']) . '.';
  }

  function print_pretty_rel_humidity($rel_humidity) {
    return $this->strings['rel_humidity'] .
      $this->properties['mark_begin'] . $rel_humidity . '%' .
      $this->properties['mark_end'] . '.';
  }

  function print_pretty_windchill($windchill) {
    extract($windchill);
    $output = $this->strings['windchill'] .
                $this->pref_units($this->properties['mark_begin'] . $windchill_c .
                $this->properties['mark_end'] . '&nbsp;&deg;C',
                $this->properties['mark_begin'] . $windchill_f .
                $this->properties['mark_end'] . '&nbsp;&deg;F') . '.';
     return $output;
  }
  function print_pretty_heatindex($heatindex) {
    extract($heatindex);
    $output = $this->strings['heatindex'] .
                $this->pref_units($this->properties['mark_begin'] . $heatindex_c .
	        $this->properties['mark_end'] . '&nbsp;&deg;C',
		$this->properties['mark_begin'] . $heatindex_f .
		$this->properties['mark_end'] . '&nbsp;&deg;F') . '.';
     return $output;
  }
  
  function print_pretty_feelslike($feelslike) {
      extract($feelslike);
    $output = $this->strings['feelslike'] .
                $this->pref_units($this->properties['mark_begin'] . $feelslike_c .
	        $this->properties['mark_end'] . '&nbsp;&deg;C',
		$this->properties['mark_begin'] . $feelslike_f .
		$this->properties['mark_end'] . '&nbsp;&deg;F') . '.';
     return $output;
  }
  
  function print_pretty_clouds($clouds) {
    if (empty($clouds[0]) ||
        $clouds[0]['condition'] == 'CLR' ||
        $clouds[0]['condition'] == 'SKC') {
      /* Nice, clear weather: */
      return sprintf($this->strings['cloud_clear'],
                     $this->properties['mark_begin'],
                     $this->properties['mark_end']);
    } else {
      /* We have up to three cloud groups: */
      $cloud_str0 = $cloud_str1 = $cloud_str2 = $ovc = '';
      

      if ($clouds[0]['condition'] == 'OVC') {
        /* The first layer is overcast so we can return
         * immediately: */
        return $this->parse_cloud_group($clouds[0]);
      } else {
        $cloud_str0 = $this->parse_cloud_group($clouds[0]);
      }

      if (!empty($clouds[1])) {
        if ($clouds[1]['condition'] == 'OVC') {
          $ovc = $this->parse_cloud_group($clouds[1]);
        } else {
          $cloud_str1 = $this->parse_cloud_group($clouds[1]);
        }
      }
      
      if (!empty($clouds[2])) {
        if ($clouds[2]['condition'] == 'OVC') {
          $ovc = $this->parse_cloud_group($clouds[2]);
        } else {
          $cloud_str2 = $this->parse_cloud_group($clouds[2]);
        }
      }

      return $this->strings['cloud_group_beg'] .
        $this->list_sentences($cloud_str0, $cloud_str1, $cloud_str2) .
        $this->strings['cloud_group_end'] . ' ' . $ovc;
    }
  }


  function print_pretty_visibility($visibility) {

    $output[0] = $this->parse_visibility_group($visibility[0]);

    if (!empty($visibility[1])) {
      if( $visibility[1]['meter'] != $visibility[0]['meter'])  {
        $output[1] = $this->parse_visibility_group($visibility[1]);
      }
    } else {
      $output[1] = '';
    }

    if (!empty($visibility[2])) {
      $output[2] = $this->parse_visibility_group($visibility[2]);
    } else {
      $output[2] = '';
    }

    return $this->strings['visibility'] .
      $this->list_sentences($output[0], $output[1], $output[2]) . '.';
  }


  function print_pretty_precipitation($precipitation) {

    extract($precipitation);
    
    $prec_str1 = $this->parse_precip($in, $mm) .
      $this->strings['precip_last_hour'];

    $prec_str2 = $this->parse_precip($in_6h, $mm_6h) .
      $this->strings['precip_last_6_hours'];

    $prec_str3 = $this->parse_precip($in_24h, $mm_24h) .
      $this->strings['precip_last_24_hours'];

    $prec_str4 = $this->parse_precip($snow_in, $snow_mm) .
      $this->strings['precip_snow'];
    
    return $this->strings['precip_there_was'] .
      $this->list_sentences($prec_str1, $prec_str2, $prec_str3, $prec_str4);
  }


  function print_pretty_temp_min_max($temp_min_max) {
    
    extract($temp_min_max);
    $temp_str = '';
    if (isset($max6h_c) && isset($min6h_c)) {
      $temp_str .= $this->strings['temp_min_max_6_hours'] .
        $this->pref_units($this->properties['mark_begin'] . $temp_max6h_c .
                          $this->properties['mark_end'] . 
                          $this->strings['and'] .
                          $this->properties['mark_begin'] .
                          $temp_min6h_c .
                          $this->properties['mark_end'] . ' &deg;C',
                          $this->properties['mark_begin'] . $temp_max6h_f .
                          $this->properties['mark_end'] .
                          $this->strings['and'] .
                          $this->properties['mark_begin'] .
                          $temp_min6h_f .
                          $this->properties['mark_end'] . ' &deg;F') . '.';
    } else {
      if (isset($max6h_c)) {
        if (!empty($temp_str)) {
          $temp_str .= ' ';
        }
        $temp_str .= $this->strings['temp_max_6_hours'] . 
          $this->pref_units($this->properties['mark_begin'] . $max6h_c .
                            $this->properties['mark_end'] . ' &deg;C',
                            $this->properties['mark_begin'] . $max6h_f .
                            $this->properties['mark_end'] . ' &deg;F') . '.';
      }
      if (isset($min6h_c)) {
        if (!empty($temp_str)) {
          $temp_str .= ' ';
        }
        $temp_str .= $this->strings['temp_min_6_hours'] . 
          $this->pref_units($this->properties['mark_begin'] . $min6h_c .
                            $this->properties['mark_end'] . ' &deg;C',
                            $this->properties['mark_begin'] . $min6h_f .
                            $this->properties['mark_end'] . ' &deg;F') . '.';
      }
    }
    if (isset($max24h_c)) {
      if (!empty($temp_str)) {
        $temp_str .= ' ';
      }
      $temp_str .= $this->strings['temp_min_max_24_hours'] .
        $this->pref_units($this->properties['mark_begin'] . $max24h_c .
                          $this->properties['mark_end'] .
                          $this->strings['and'] .
                          $this->properties['mark_begin'] . $min24h_c .
                          $this->properties['mark_end'] . ' &deg;C',
                          $this->properties['mark_begin'] . $max24h_f .
                          $this->properties['mark_end'] .
                          $this->strings['and'] .
                          $this->properties['mark_begin'] . $min24h_f .
                          $this->properties['mark_end'] . ' &deg;F') . '.';
    }

    return $temp_str;
  }
 
  function print_pretty_runway($runway) { 
    
    $runway_str1 = $runway_str2 = $runway_str3 = $runway_str4 = '';
    
    $runway_str1 = $this->parse_runway_group($runway[0]);
    if (!empty($runway[1])) {
      $runway_str2 = $this->parse_runway_group($runway[1]);
      if (!empty($runway[2])) {
        $runway_str3 = $this->parse_runway_group($runway[2]);
        if (!empty($runway[3])) {
          $runway_str4 = $this->parse_runway_group($runway[3]);
        }
      }
    }
    
    return $this->strings['runway_visibility'] .
      $this->list_sentences($runway_str1,
                            $runway_str2,
                            $runway_str3,
                            $runway_str4) . '.';
  }


  function print_pretty_weather($weather){
    $weather_str = $this->strings['currently'] .
      $this->properties['mark_begin'] .
      $this->parse_weather_group($weather[0]) .
      $this->properties['mark_end'];
    if (!empty($weather[1])) {
      $weather_str = $weather_str . $this->strings['plus'] .
        $this->properties['mark_begin'] .
        $this->parse_weather_group($weather[1]) .
        $this->properties['mark_end'];
    }
    if (!empty($weather[2])) {
      $weather_str = $weather_str . $this->strings['plus'] .
        $this->properties['mark_begin'] .
        $this->parse_weather_group($weather[2]) .
        $this->properties['mark_end'];
    }
    
    return $weather_str . '.';
  }
  
  
  /**
   * The pretty-print function.
   *
   * This is the function responsible for making the weather-report,
   * also known as the 'pretty-print'.
   *
   * @access  public
   * @return  string   The pretty-printed output.
   * @see     decode_metar(), parse_weather_group(),
   *          parse_runway_group(), parse_cloud_group(),
   *          parse_visibility_group(), set_exclude() 
   */
  function print_pretty() {
    // We use our own weather-object.
    $data = $this->weather->decode_metar();

    extract($data);
    
    if (empty($metar)) {
      
      /* We don't want to display all sorts of silly things 
       * if the metar is empty. 
       */
      
      return sprintf($this->strings['no_data'],
                     $this->properties['mark_begin'],
                     $location,
                     $this->properties['mark_end']);
    }
    
    /****************
     *   Location   *
     ****************/
    if (!in_array('location', $this->properties['exclude'])) {
      $output['location'] = $this->print_pretty_location($location);
    }
    
    /*********************
     *   Time and date   *
     *********************/
    if (!in_array('time', $this->properties['exclude'])) {
      $output['time'] = $this->print_pretty_time($time);
    }
    
    /*********************
     *   Wind and gust   *
     *********************/
    if (!in_array('wind', $this->properties['exclude']) &&
        !empty($wind)) {
      $output['wind'] = $this->print_pretty_wind($wind);
    }
    
    /*********************************
     *   Temperature and dew-point   *
     *********************************/
    if (!in_array('temperature', $this->properties['exclude']) &&
        !empty($temperature)) {
      $output['temperature'] = $this->print_pretty_temperature($temperature);
    }
    

    /****************************
    *    Feelslike              *
    ****************************/
    if (!in_array('heatindex', $this->properties['exclude']) &&
        !empty($heatindex)) {
        $heatindex['feelslike_c'] = $heatindex['heatindex_c'];
        $heatindex['feelslike_f'] = $heatindex['heatindex_f'];
      $output['feelslike'] = $this->print_pretty_feelslike($heatindex);
    } elseif (!in_array('windchill', $this->properties['exclude']) &&
        !empty($windchill)) {
        $windchill['feelslike_c'] = $windchill['windchill_c'];
        $windchill['feelslike_f'] = $windchill['windchill_f'];
      $output['feelslike'] = $this->print_pretty_feelslike($windchill);
    }
    
    
    /****************************
     *   Altimeter (pressure)   *
     ****************************/
    if (!in_array('altimeter', $this->properties['exclude']) &&
	!empty($altimeter)) {
      $output['altimeter'] = $this->print_pretty_altimeter($altimeter);
    }

    /**************************
     *   Relative humidity    *
     **************************/
    if (!in_array('rel_humidity', $this->properties['exclude']) &&
	!empty($rel_humidity)) {
      $output['rel_humidity'] = $this->print_pretty_rel_humidity($rel_humidity);
    }

    /*******************
     *   Cloudgroups   *
     *******************/
    if (!in_array('clouds', $this->properties['exclude']) &&
        !empty($clouds)) {
      $output['clouds'] = $this->print_pretty_clouds($clouds);
    }

    /******************
     *   Visibility   *
     ******************/
    if (!in_array('visibility', $this->properties['exclude']) &&
	!empty($visibility)) {
      $output['visibility'] = $this->print_pretty_visibility($visibility);
    }

    /*********************
     *   Precipitation   *
     *********************/
    /* Where have the strings gone?! Martin Geisler, 2002-08-28.

    if (!in_array('precip', $this->properties['exclude']) &&
	!empty($precipitation)) {
      $output['precip'] = $this->print_pretty_precipitation($precipitation);
    }

    */

    /********************************
     *   Min and max temperatures   *
     ********************************/
    if (!in_array('temp_min_max', $this->properties['exclude']) &&
	!empty($temp_min_max)) {
      $output['temp_min_max'] = $this->print_pretty_temp_min_max($temp_min_max);
    }


    /**************************
     *   Runway information   *
     **************************/
    if (!in_array('runway', $this->properties['exclude']) &&
        !empty($runway)) {
      $output['runway'] = $this->print_pretty_runway($runway);
    }

    /***********************
     *   Present weather   *
     ***********************/
    if (!in_array('weather', $this->properties['exclude']) &&
	!empty($weather)) {
      $output['weather'] = $this->print_pretty_weather($weather);
    }

    /*
     * This is where we make the HTML output.
     */
    return '<!-- Generated by PHP Weather ' . $this->version . " -->\n" .
      implode("\n", $output);
  }


  /**
   * Just get the time of the last report.
   *
   * @param   array    Data taken from decode_metar()
   * @access  public
   */
  function get_metar_time() {
    // We use our own weather-object.
    $data = $this->weather->decode_metar();
    return  gmdate('H:i \U\T\C', $data['time']);
  }

  /**
   * Extract some value from the metar.
   *
   * @param   array    Data taken from decode_metar()
   * @access  public
   */
  function get_metar_value($index,$index2 = false, $index3 = false) {
    // We use our own weather-object.
    $data = $this->weather->decode_metar();
    if ($index3){
        return $data[$index][$index2][$index3];
    } elseif ($index2) {
        return $data[$index][$index2];
    } else {
        return $data[$index];
    }
  }


  function print_taf($time_from=false,$time_to=false) {
    $taf = $this->weather->decode_taf();
    
    echo "<b>icao</b>: ".$taf['icao']."<br>\n";
    echo "<b>time_emit</b>: ".$taf['time_emit']."<br>\n";
    echo "<b>time_use_from</b>: ".$taf['time_use_from']."<br>\n";
    echo "<b>time_use_to</b>: ".$taf['time_use_to']."<br>\n";
    echo "<b>location</b>: ".$taf['location']."<br>\n";

    echo "<b>periods</b>:<br><br>";
    echo "All periods:";
    $this->print_taf_period($taf['periods2']);
    echo "Each hour:";
    if($time_from==false||$time_to===false) 
      $this->print_taf_period($taf['periods3']);
    else {
      $taf2 = $this->weather->get_taf_at_time($time_from,$time_to);
      $this->print_taf_period($taf2);
    }
  }

  function print_taf_period($period_array) {
    echo "<table border=1>\n";
    echo "<tr><th>type</th><th>from</th><th>to</th><th>wind</th><th>visi</th><th>clouds</th><th>other</th></tr>\n";
    while(list($i,$period) = each($period_array)) {
      echo "<tr>\n";
      echo "<td>".$period['type']."</td>\n";
      echo "<td>".substr($period['time_from'],6,6)."</td>\n";
      echo "<td>".substr($period['time_to'],6,6)."</td>\n";
      echo "<td>";
      if(isset($period['desc']['wind'])) {
	if (isset($period['desc']['wind']['gust_knots'])) {
	  echo round($period['desc']['wind']['deg'],1);
	  echo " @ ".round($period['desc']['wind']['knots'],1)."G".round($period['desc']['wind']['gust_knots'],1)." kt";

	}
	else {
	  if($period['desc']['wind']['deg']=='VRB') echo "VRB";
	  else echo round($period['desc']['wind']['deg'],1);
	  echo " @ ".round($period['desc']['wind']['knots'],1)." kt";
	}
      }
      echo "</td>\n";
      echo "<td>";
      if(isset($period['desc']['visibility'])) {
	for($j=0;$j<count($period['desc']['visibility']);$j++) {
	  $visi = & $period['desc']['visibility'][$j];
	  if($visi['prefix']==1) echo " > ";
	  else if($visi['prefix']==-1) echo " < ";
	  else echo " ";
	  echo $visi['miles']." SM";
	}
      }  
      echo "</td>\n";
      echo "<td>";
      if(isset($period['desc']['clouds'])) {
	for($j=0;$j<count($period['desc']['clouds']);$j++) {
	  $cloud = & $period['desc']['clouds'][$j];
	  $condition = $cloud['condition'];
 	  if($j!=0) echo " / ";
	  echo $condition;
	  if($condition=="SKC") {
	  }
	  else if($condition=="VV") {
	    echo " ".$cloud['ft']." ft";
	  }
	  else {
	    echo " at ".$cloud['ft']." ft";
	  }
	}  
      }
      echo "</td>\n";

      echo "<td>";

      if($period['type'] == 'PROB') {
	echo " [ PROB ".$period['prob']."% ] ";
      }

      if(isset($period['desc']['weather'])) { 
	for($j=0;$j<count($period['desc']['weather']);$j++) {
	  $wx = & $period['desc']['weather'][$j];
 	  if($j!=0) echo " / ";
	  echo "weather: ".$wx['proximity']." ".$wx['intensity'].$wx['descriptor']." ".$wx['precipitation']." ".$wx['obscuration']." ".$wx['other']; 
	}  
      }

      if(isset($period['desc']['wind_shear'])) {
	for($j=0;$j<count($period['desc']['wind_shear']);$j++) {
	  $ws = & $period['desc']['wind_shear'][$j];
	  echo " wind shear at ".$ws['ft']." ft "; 
	  echo $ws['wind']['deg']." @ ".$ws['wind']['knots']." kt ";
	}  
      }

      /* do something more with PROB */
      if(isset($period['PROB'])) {
	echo " [ ".$period['PROB']['data']." ] ";
      }
      echo "</td>\n";
      echo "</tr>\n";
    }   			    
    echo "</table><br>\n";
  }      
  


  /**
   * Makes a short weather-report in a table.
   *
   * @param   array    Data taken from decode_metar()
   * @access  public
   */
  function print_table() {
    // We use our own weather-object.
    $data = $this->weather->decode_metar();

    /* This doesn't work yet...

    $location = $data['location'];

    $date = $this->print_pretty_time($data['time']);

    $wind = $this->print_pretty_wind($data['wind']);

    $temperature = $this->print_pretty_temperature($data['temperature']);

    $pressure = $this->print_pretty_altimeter($data['altimeter']);

    $humidity = $this->print_pretty_rel_humidity($data['rel_humidity']);

     if ($this->properties['orientation'] == 'vertical') {

     } else {

      echo "<table border="1">";
      echo "\n  <tr>\n";
      echo "    <th>' . $this->strings['location'] . "</th>\n";
      echo "    <th>' . $this->strings['date'] . "</th>\n";
      echo "    <th>' . $this->strings['wind'] . "</th>\n";
      echo "    <th>' . $this->strings['temperature'] . "</th>\n";
      echo "    <th>' . $this->strings['pressure'] . "</th>\n";
      echo "    <th>' . $this->strings['humidity'] . "</th>\n";
      echo "  </tr>\n";
      echo "    <td>$location</td>
    <td>$date</td>
    <td>$wind</td>
    <td>$temperature</td>
    <td>$pressure</td>
    <td>$humidity%</td>
  </tr>
</table>
";

    }

  */

  }
}


?>
