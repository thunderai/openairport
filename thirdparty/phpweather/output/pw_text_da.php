<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Danish
 * output.
 *
 * @author   Martin Geisler <gimpster@gimpster.com>
 * @version  pw_text_da.php,v 1.10 2002/11/10 23:18:43 gimpster Exp
 */
class pw_text_da extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_da($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Desv&aelig;rre! Der er ingen data for %s%s%s.';
    $this->strings['list_sentences_and']       = ' og ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ' og ';
    $this->strings['location']                 = 'Dette er en rapport for %s%s%s.';
    $this->strings['minutes']                  = ' minutter';
    $this->strings['time_format']              = 'Denne rapport blev lavet for %s siden, kl. %s%s%s UTC.';
    $this->strings['time_minutes']             = 'og %s%s%s minutter';
    $this->strings['time_one_hour']            = '%sen%s time %s';
    $this->strings['time_several_hours']       = '%s%s%s timer %s';
    $this->strings['time_a_moment']            = 'et &oslash;jeblik';
    $this->strings['meters_per_second']        = ' meter pr. sekund';
    $this->strings['miles_per_hour']           = ' mil pr. time';
    $this->strings['meter']                    = ' meter';
    $this->strings['meters']                   = ' meter';
    $this->strings['feet']                     = ' fod';
    $this->strings['kilometers']               = ' kilometer';
    $this->strings['miles']                    = ' mil';
    $this->strings['and']                      = ' og ';
    $this->strings['plus']                     = ' plus ';
    $this->strings['with']                     = ' med ';
    $this->strings['wind_blowing']             = 'Vindhastigheden var ';
    $this->strings['wind_with_gusts']          = ' med vindst&oslash;d p&aring; up til ';
    $this->strings['wind_from']                = ' fra ';
    $this->strings['wind_variable']            = ' fra %svarierende%s retninger.';
+    $this->strings['wind_varying']             = ', varierende mellem %s%s%s (%s%s&deg;%s) og %s%s%s (%s%s&deg;%s)';
    $this->strings['wind_calm']                = 'Vinden var %sstille%s';
    $this->strings['wind_dir'] = array(
      'nord',
      'nord/nord&oslash;st',
      'nord&oslash;st',
      '&oslash;st/nord&oslash;st',
      '&oslash;st',
      '&oslash;st/syd&oslash;st',
      'syd&oslash;st',
      'syd/syd&oslash;st',
      'syd',
      'syd/sydvest',
      'sydvest',
      'vest/sydvest',
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
      'N&Oslash;' => 'nord&oslash;st',
      '&Oslash;'  => '&oslash;st',
      'S&Oslash;' => 'syd&oslash;st',
      'S'  => 'syd',
      'SV' => 'sydvest',
      'V'  => 'vest',
      'NV' => 'nordvest'
      );
    $this->strings['temperature']     = 'Temperaturen var ';
    $this->strings['dew_point']       = ', med et dugpunkt p&aring; ';
    $this->strings['altimeter']       = 'Lufttrykket var ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'Den relative luftfugtigheden var ';
    $this->strings['feelslike']       = 'Temperaturen vil føles som ';
    $this->strings['cloud_group_beg'] = 'Der var ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'Himlen var %sskyfri%s.';
    $this->strings['cloud_height']    = ' skyer i en h&oslash;jde af ';
    $this->strings['cloud_overcast']  = 'Himlen var %soverskyet%s i en h&oslash;jde af ';
    $this->strings['cloud_vertical_visibility'] = 'en %svertikale sigtbarhed%s på ';
    $this->strings['cloud_condition'] =
      array(
	    'SKC' => 'skyfri',
	    'CLR' => 'skyfri',
	    'FEW' => 'nogle f&aring;',
	    'SCT' => 'spredte',
	    'BKN' => 'brudte',
	    'OVC' => 'overskyet');
    $this->strings['cumulonimbus']     = ' cumulus skyer';
    $this->strings['towering_cumulus'] = ' stakkede cumulus skyer';
    $this->strings['cavok']            = ' ingen skyer under %s og ingen cumulus skyer';
    $this->strings['currently']        = 'Vejrforholdene er i &oslash;jeblikket ';
    $this->strings['weather']          = 
      array('-' => 'let ',
	    ' ' => 'moderat ',
	    '+' => 'kraftig ',
	    'VC' => ' i n&aelig;rheden',
	    'PR' => ' delvis',
	    'BC' => ' banker af',
	    'MI' => ' lave',
	    'DR' => ' lave drivende',
	    'BL' => ' bl&aelig;sende',
	    'SH' => ' byger med',
	    'TS' => ' tordenvejr',
	    'FZ' => ' frysende',
	    'DZ' => ' finregn',
	    'RA' => ' regn',
	    'SN' => ' sne',
	    'SG' => ' sne korn',
	    'IC' => ' is krystaller',
	    'PL' => ' is kugler',
	    'GR' => ' hagl',
	    'GS' => ' sm&aring; hagl',
	    'UP' => ' ukendt',
	    'BR' => ' dis',
	    'FG' => ' t&aring;ge',
	    'FU' => 'r&oslash;g',
	    'VA' => 'vulkansk aske',
	    'DU' => 'udbredt st&oslash;v',
	    'SA' => 'sand',
	    'HZ' => 't&aring;ge/dis',
	    'PY' => 'byge',
	    'PO' => 'veludviklet st&oslash;v/sand hvirvler',
	    'SQ' => 'vindst&oslash;d',
	    'FC' => 'tornado/skypumpe',
	    'SS' => 'sandstorm/st&oslash;vstorm');
    $this->strings['visibility'] = 'Sigtbarheden var ';
    $this->strings['visibility_greater_than']  = 'st&oslash;rre end ';
    $this->strings['visibility_less_than']     = 'mindre end ';
    $this->strings['runway_upward_tendency']   = ' med en %sstigende%s tendens';
    $this->strings['runway_downward_tendency'] = ' med en %sfaldende%s tendens';
    $this->strings['runway_no_tendency']       = ' uden %snogen distinkt%s tendens';
    $this->strings['runway_between']           = 'mellem ';
    $this->strings['runway_left']              = ' venstre';
    $this->strings['runway_central']           = ' midt';
    $this->strings['runway_right']             = ' h&oslash;jre';
    $this->strings['runway_visibility']        = 'Sigtbarheden var ';
    $this->strings['runway_for_runway']        = ' for bane ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
    
  }
}

?>
