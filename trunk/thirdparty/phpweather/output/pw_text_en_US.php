<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce American
 * English output.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @link     http://www.gimpster.com/  My homepage.
 * @version  pw_text_en_US.php,v 1.2 2004/02/22 12:18:35 iridium Exp
 */
class pw_text_en_US extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_en_US($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Sorry! There\'s no data available for %s%s%s.';
    $this->strings['list_sentences_and']       = ' and ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', and ';
    $this->strings['location']                 = 'This is a report for %s%s%s.';
    $this->strings['minutes']                  = ' minutes';
    $this->strings['time_format']              = 'The report was made %s ago, at %s%s%s UTC.';
    $this->strings['time_minutes']             = 'and %s%s%s minutes';
    $this->strings['time_one_hour']            = '%sone%s hour %s';
    $this->strings['time_several_hours']       = '%s%s%s hours %s';
    $this->strings['time_a_moment']            = 'a moment';
    $this->strings['meters_per_second']        = ' meters per second';
    $this->strings['miles_per_hour']           = ' miles per hour';
    $this->strings['meter']                    = ' meter';
    $this->strings['meters']                   = ' meters';
    $this->strings['feet']                     = ' feet';
    $this->strings['kilometers']               = ' kilometers';
    $this->strings['miles']                    = ' miles';
    $this->strings['and']                      = ' and ';
    $this->strings['plus']                     = ' plus ';
    $this->strings['with']                     = ' with ';
    $this->strings['wind_blowing']             = 'The wind was blowing at a speed of ';
    $this->strings['wind_with_gusts']          = ' with gusts up to ';
    $this->strings['wind_from']                = ' from ';
    $this->strings['wind_variable']            = ' from %svariable%s directions.';
    $this->strings['wind_varying']             = ', varying between %s%s%s (%s%s&deg;%s) and %s%s%s (%s%s&deg;%s)';
    $this->strings['wind_calm']                = 'The wind was %scalm%s';
    $this->strings['wind_dir'] = array(
      'north',
      'north/northeast',
      'northeast',
      'east/northeast',
      'east',
      'east/southeast',
      'southeast',
      'south/southeast',
      'south',
      'south/southwest',
      'southwest',
      'west/southwest',
      'west',
      'west/northwest',
      'northwest',
      'north/northwest',
      'north');
    $this->strings['wind_dir_short'] = array(
      'N',
      'NNE',
      'NE',
      'ENE',
      'E',
      'ESE',
      'SE',
      'SSE',
      'S',
      'SSW',
      'SW',
      'WSW',
      'W',
      'WNW',
      'NW',
      'NNW',
      'N');
    $this->strings['wind_dir_short_long'] = array(
      'N'  => 'north',
      'NE' => 'northeast',
      'E'  => 'east',
      'SE' => 'southeast',
      'S'  => 'south',
      'SW' => 'southwest',
      'W'  => 'west',
      'NW' => 'northwest'
      );
    $this->strings['temperature']     = 'The temperature was ';
    $this->strings['dew_point']       = ', with a dew-point at ';
    $this->strings['altimeter']       = 'The atmospheric pressure was ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'The relative humidity was ';
    $this->strings['feelslike']       = 'The temperature felt like ';
    $this->strings['cloud_group_beg'] = 'There were ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'The sky was %sclear%s.';
    $this->strings['cloud_height']    = ' clouds at a height of ';
    $this->strings['cloud_overcast']  = 'The sky was %sovercast%s from a height of ';
    $this->strings['cloud_vertical_visibility'] = 'a %svertical visibility%s of ';
    $this->strings['cloud_condition'] =
      array(
	    'SKC' => 'clear',
	    'CLR' => 'clear',
	    'FEW' => 'a few',
	    'SCT' => 'scattered',
	    'BKN' => 'broken',
	    'OVC' => 'overcast');
    $this->strings['cumulonimbus']     = ' cumulonimbus';
    $this->strings['towering_cumulus'] = ' towering cumulus';
    $this->strings['cavok']            = ' no clouds below %s and no cumulonimbus clouds';
    $this->strings['currently']        = 'Currently ';
    $this->strings['weather']          = 
      array(
	    '-' => ' light',
	    ' ' => ' moderate ',
	    '+' => ' heavy ',
	    'VC' => ' in the vicinity',
	    'PR' => ' partial',
	    'BC' => ' patches of',
	    'MI' => ' shallow',
	    'DR' => ' low drifting',
	    'BL' => ' blowing',
	    'SH' => ' showers of',
	    'TS' => ' thunderstorm',
	    'FZ' => ' freezing',
	    'DZ' => ' drizzle',
	    'RA' => ' rain',
	    'SN' => ' snow',
	    'SG' => ' snow grains',
	    'IC' => ' ice crystals',
	    'PL' => ' ice pellets',
	    'GR' => ' hail',
	    'GS' => ' small hail',
	    'UP' => ' unknown',
	    'BR' => ' mist',
	    'FG' => ' fog',
	    'FU' => ' smoke',
	    'VA' => ' volcanic ash',
	    'DU' => ' widespread dust',
	    'SA' => ' sand',
	    'HZ' => ' haze',
	    'PY' => ' spray',
	    'PO' => ' well-developed dust/sand whirls',
	    'SQ' => ' squalls',
	    'FC' => ' funnel cloud tornado waterspout',
	    'SS' => ' sandstorm/duststorm');
    $this->strings['visibility'] = 'The overall visibility was ';
    $this->strings['visibility_greater_than']  = 'greater than ';
    $this->strings['visibility_less_than']     = 'less than ';
    $this->strings['visibility_to']            = ' to the ';
    $this->strings['runway_upward_tendency']   = ' with an %supward%s tendency';
    $this->strings['runway_downward_tendency'] = ' with a %sdownward%s tendency';
    $this->strings['runway_no_tendency']       = ' with %sno distinct%s tendency';
    $this->strings['runway_between']           = 'between ';
    $this->strings['runway_left']              = ' left';
    $this->strings['runway_central']           = ' central';
    $this->strings['runway_right']             = ' right';
    $this->strings['runway_visibility']        = 'The visibility was ';
    $this->strings['runway_for_runway']        = ' for runway ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
}

?>
