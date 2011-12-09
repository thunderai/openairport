<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce
 * Norwegian output.
 *
 * @author   Sven-Erik Andersen  <sven_erik@andersen.as>
 * @version  pw_text_no.php,v 1.10 2002/11/10 23:18:43 gimpster Exp
 */
class pw_text_no extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_no($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Beklager! Det var ingen ingen data tilgjengelig for %s%s%s.';
    $this->strings['list_sentences_and']       = ' og ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', og ';
    $this->strings['location']                 = 'Dette er en rapport for %s%s%s.';
    $this->strings['minutes']                  = ' minutter';
    $this->strings['time_format']              = 'Denne rapporten ble laget for %s siden, klokka %s%s%s UTC.';
    $this->strings['time_minutes']             = 'og %s%s%s minutter';
    $this->strings['time_one_hour']            = '%sone%s time %s';
    $this->strings['time_several_hours']       = '%s%s%s timer %s';
    $this->strings['time_a_moment']            = 'et &oslash;yeblikk';
    $this->strings['meters_per_second']        = ' meter per sekund';
    $this->strings['miles_per_hour']           = ' miles per time';
    $this->strings['meter']                    = ' meter';
    $this->strings['meters']                   = ' meter';
    $this->strings['feet']                     = ' fot';
    $this->strings['kilometers']               = ' kilometer';
    $this->strings['miles']                    = ' miles';
    $this->strings['and']                      = ' og ';
    $this->strings['plus']                     = ' plus ';
    $this->strings['with']                     = ' med ';
    $this->strings['wind_blowing']             = 'Vinden hadde en hastighet p&aring; ';
    $this->strings['wind_with_gusts']          = ' med vindkast opp mot ';
    $this->strings['wind_from']                = ' fra ';
    $this->strings['wind_variable']            = ' fra %svariable%s retninger.';
    $this->strings['wind_varying']             = ', varierende mellom ';
    $this->strings['wind_calm']                = 'Vinden var %scalm%s';
    $this->strings['wind_dir'] = array(
      'nord',
      'nord/nord&oslash;st',
      'nord&oslash;st',
      '&oslash;st/nord&oslash;st',
      '&oslash;st',
      '&oslash;st/s&oslash;r&oslash;st',
      's&oslash;r&oslash;st',
      's&oslash;r/s&oslash;r&oslash;st',
      's&oslash;r',
      's&oslash;r/s&oslash;rvest',
      's&oslash;rvest',
      'vest/s&oslash;rvest',
      'vest',
      'vest/nordvest',
      'nordvest',
      'nord/nordvest',
      'nord');
    $this->strings['wind_dir_short'] = array(
      'N',
      'NN&Oslash;',
      'N&Oslash;',
      '&Oslash;N&Oslash;',
      '&Oslash;',
      '&Oslash;S&Oslash;',
      'S&Oslash;',
      'SS&Oslash;',
      'S',
      'SSV',
      'SV',
      'VSV',
      'V',
      'VNV',
      'NV',
      'NNV',
      'N');
    $this->strings['wind_dir_short_long'] = array(
      'N'  => 'nord',
      'NE' => 'nord&oslash;st',
      'E'  => '&oslash;st',
      'SE' => 's&oslash;r&oslash;st',
      'S'  => 's&oslash;r',
      'SW' => 's&oslash;rvest',
      'W'  => 'vest',
      'NW' => 'nordvest'
      );
    $this->strings['temperature']     = 'Temperaturen var ';
    $this->strings['dew_point']       = ', med ett duggpunkt p&aring; ';
    $this->strings['altimeter']       = 'Lufttrykket var ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'Den relative fuktigheten var ';
    $this->strings['feelslike']       = 'The temperature feels like ';
    $this->strings['cloud_group_beg'] = 'Det var ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'Himmelen var %sclear%s.';
    $this->strings['cloud_height']    = ' skyer i en h&oslash;yde av ';
    $this->strings['cloud_overcast']  = 'himmelen var %sovercast%s fra en h&oslash;yde av ';
    $this->strings['cloud_vertical_visibility'] = 'en %svertical visibility%s p&aring; ';
    $this->strings['cloud_condition'] = array(
	    'SKC' => 'skyfri',
	    'CLR' => 'skyfri',
	    'FEW' => 'noen',
	    'SCT' => 'spredte',
	    'BKN' => 'brutte',
	    'OVC' => 'overskyet');
    $this->strings['cumulonimbus']     = ' bygeskyer';
    $this->strings['towering_cumulus'] = ' t&aring;rnende haugskyer';
    $this->strings['cavok']            = ' ingen skyer under %s og ingen bygeskyer';
    $this->strings['currently']        = 'V&aelig;rforholdene er i &oslash;jeblikket ';
    $this->strings['weather']          = 
      array(
	    '-' => 'lett ',
	    ' ' => 'moderat ',
	    '+' => 'kraftig ',
	    'VC' => ' i n&aelig;rheden',
	    'PR' => 'delvis ',
	    'BC' => 'banker ',
	    'MI' => 'shallow ',
	    'DR' => 'lavt drivende ',
	    'BL' => 'bl&aring;ser ',
	    'SH' => 'skur ',
	    'TS' => 'tordenv&aelig;r ',
	    'FZ' => 'frysende ',
	    'DZ' => 'duskregn  ',
	    'RA' => 'regn ',
	    'SN' => 'sn&oslash; ',
	    'SG' => 'sn&oslash; korn ',
	    'IC' => 'is krystaller ',
	    'PL' => 'is korn ',
	    'GR' => 'hagl ',
	    'GS' => 'sm&aring; hagl og/eller sn&oslash; korn ',
	    'UP' => 'ukjent ',
	    'BR' => 'dis ',
	    'FG' => 't&aring;ke ',
	    'FU' => 'r&oslash;yk ',
	    'VA' => 'vulkanisk aske ',
	    'DU' => 'mye st&oslash;v ',
	    'SA' => 'sand ',
	    'HZ' => 'dis ',
	    'PY' => 'duskregn ',
	    'PO' => 'godt utviklede st&oslash;v/sand virvler ',
	    'SQ' => 'vindkast ',
	    'FC' => 'trombe/tornado/skypumpe ',
	    'SS' => 'sandstorm/st&oslash;vstorm ');
    $this->strings['visibility'] = 'Den generelle sikten var ';
    $this->strings['visibility_greater_than']  = 'st&oslash;rre enn ';
    $this->strings['visibility_less_than']     = 'mindre enn ';
    $this->strings['runway_upward_tendency']   = ' med en %supward%s tendens';
    $this->strings['runway_downward_tendency'] = ' med en %sdownward%s tendens';
    $this->strings['runway_no_tendency']       = ' med %sno distinct%s tendens';
    $this->strings['runway_between']           = 'mellom ';
    $this->strings['runway_left']              = ' venstre';
    $this->strings['runway_central']           = ' midtre';
    $this->strings['runway_right']             = ' h&oslash;yre';
    $this->strings['runway_visibility']        = 'Sikten var ';
    $this->strings['runway_for_runway']        = ' for rullebane ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
    
  }
}

?>