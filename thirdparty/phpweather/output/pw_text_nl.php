<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Dutch
 * output.
 *
 * @author   Bas Elshof <bas@elshof.de>
 * @author   Rudy Boedts
 * @link     http://www.elshof.de/
 * @version  pw_text_nl.php,v 1.3 2002/09/26 21:13:40 gimpster Exp
 */

/* ViM 6.0 indentation used */

class pw_text_nl extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_nl($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Sorry! Er is geen informatie beschikbaar voor %s%s%s.';
    $this->strings['list_sentences_and']       = ' en ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', en ';
    $this->strings['location']                 = 'Dit is het bericht voor %s%s%s.';
    $this->strings['minutes']                  = ' minuten';
    $this->strings['time_format']              = 'Dit bericht werd %s geleden gemaakt, om %s%s%s UTC.';
    $this->strings['time_minutes']             = 'en %s%s%s minuten';
    $this->strings['time_one_hour']            = '%seen%s uur %s';
    $this->strings['time_several_hours']       = '%s%s%s uur %s';
    $this->strings['time_a_moment']            = 'een moment';
    $this->strings['meters_per_second']        = ' meter per seconde';
    $this->strings['miles_per_hour']           = ' mijl per uur';
    $this->strings['meter']                    = ' meter';
    $this->strings['meters']                   = ' meter';
    $this->strings['feet']                     = ' voet';
    $this->strings['kilometers']               = ' kilometer';
    $this->strings['miles']                    = ' mijl';
    $this->strings['and']                      = ' en ';
    $this->strings['plus']                     = ' plus ';
    $this->strings['with']                     = ' met ';
    $this->strings['wind_blowing']             = 'De wind waaide met een snelheid van ';
    $this->strings['wind_with_gusts']          = ' met rukwinden tot ';
    $this->strings['wind_from']                = ' uit het ';
    $this->strings['wind_variable']            = ' uit %sverschillende%s richtingen.';
    $this->strings['wind_varying']             = ', varierend tussen het %s%s%s (%s%s&deg;%s) en het %s%s%s (%s%s&deg;%s)';
    $this->strings['wind_calm']                = 'De wind was %rustig%s';
    $this->strings['wind_dir'] = array(
      'noorden',
      'noord/noordoosten',
      'noordoosten',
      'oost/noordoosten',
      'oosten',
      'oost/zuidoosten',
      'zuidoosten',
      'zuid/zuidoosten',
      'zuiden',
      'zuid/zuidwesten',
      'zuidwesten',
      'west/zuidwesten',
      'westen',
      'west/noordwesten',
      'noordwesten',
      'noord/noordwesten',
      'noorden');
    $this->strings['wind_dir_short'] = array(
      'N',
      'NNO',
      'NO',
      'ONO',
      'O',
      'OZO',
      'ZO',
      'ZZO',
      'Z',
      'ZZW',
      'ZW',
      'WZW',
      'W',
      'WNW',
      'NW',
      'NNW',
      'N');
    $this->strings['wind_dir_short_long'] = array(
      'N'  => 'noord',
      'NE' => 'noordoost',
      'E'  => 'oost',
      'SE' => 'zuidoost',
      'S'  => 'zuid',
      'SW' => 'zuidwest',
      'W'  => 'west',
      'NW' => 'noordwest'
      );
    $this->strings['temperature']     = 'De temperatuur was ';
    $this->strings['dew_point']       = ', met het dauwpunt bij ';
    $this->strings['altimeter']       = 'De atmosferische druk was ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'De relative luchtvochtigheid was ';
    $this->strings['feelslike']       = 'De gevoelstemperatuur was ';
    $this->strings['cloud_group_beg'] = 'Er waren ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'De lucht was %shelder%s.';
    $this->strings['cloud_height']    = ' wolken op een hoogte van ';
    $this->strings['cloud_overcast']  = 'De lucht was %sbetrokken%s vanaf een hoogte van ';
    $this->strings['cloud_vertical_visibility'] = 'het %svertikale zicht%s was ';
    $this->strings['cloud_condition'] =
      array(
        'SKC' => 'helder',
        'CLR' => 'helder',
        'FEW' => 'licht',
        'SCT' => 'half',
        'BKN' => 'zwaar',
        'OVC' => 'betrokken');
    $this->strings['cumulonimbus']     = ' cumulonimbus';
    $this->strings['towering_cumulus'] = ' stapelwolken';
    $this->strings['cavok']            = ' geen wolken beneden %s en geen cumulonimbus wolken';
    $this->strings['currently']        = 'Momenteel ';
    $this->strings['weather']          = 
      array(
        '-' => ' lichte',
        ' ' => ' matige ',
        '+' => ' zware ',
        'VC' => ' in de omgeving',
        'PR' => ' gedeeltelijk',
        'BC' => ' banken',
        'MI' => ' laaghangende',
        'DR' => ' laag opwaaiende',
        'BL' => ' hoog opwaaiende',
        'SH' => ' buien',
        'TS' => ' onweer',
        'FZ' => ' aanvriezende',
        'DZ' => ' motregen',
        'RA' => ' regen',
        'SN' => ' sneeuw',
        'SG' => ' motsneeuw',
        'IC' => ' ijsnaalden',
        'PL' => ' ijsregen',

/*        'PE' => ' ijsregen',
change in the METAR code for ice pellets from "PE" to "PL." Observers will be directed to code ice pellets as "PE" prior to 00:00 coordinated universal time November 5, 1998, and "PL" thereafter. */


        'GR' => ' hagel',
        'GS' => ' korrelhagel',
        'UP' => ' onbekend',
        'BR' => ' nevel',
        'FG' => ' mist',
        'FU' => ' rook',
        'VA' => ' vulkanische as',
        'DU' => ' verspreid stof',
        'SA' => ' zand',
        'HZ' => ' heiigheid',
        'PY' => ' opstuivend water',
        'PO' => ' goed ontwikkelde stof- of zandhoosjes',
        'SQ' => ' squalls',
        'FC' => ' slurf of lichte wind- of waterhoos',
        'SS' => ' zandstorm',
        'DS' => ' stofstorm'); /* added according to several infos on the www */
    $this->strings['visibility'] = 'Het algemene zicht was ';
    $this->strings['visibility_greater_than']  = 'meer dan ';
    $this->strings['visibility_less_than']     = 'minder dan ';
    $this->strings['visibility_to']            = ' tot de ';
    $this->strings['runway_upward_tendency']   = ' met een %ssteigende%s tendens';
    $this->strings['runway_downward_tendency'] = ' met een %svallende%s tendens';
    $this->strings['runway_no_tendency']       = ' met %sgeen waarneembare%s tendens';
    $this->strings['runway_between']           = 'tussen ';
    $this->strings['runway_left']              = ' links';
    $this->strings['runway_central']           = ' centraal';
    $this->strings['runway_right']             = ' rechts';
    $this->strings['runway_visibility']        = 'Het zicht was ';
    $this->strings['runway_for_runway']        = ' voor de start- landingsbaan ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
}

?>
