<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce German
 * output.
 *
 * @author   Konrad Tadesse
 * @link     http://www.tadesse.de/
 * @version  pw_text_de.php,v 1.2 2003/03/05 18:39:04 gimpster Exp
 */
class pw_text_de extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_de($weather, $input = array())
     {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Für  %s%s%s stehen keine DATEN zur Verfügung.';
    $this->strings['list_sentences_and']       = ' und ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', und ';
    $this->strings['location']                 = '%s%s%s:'; //Ortsname
    $this->strings['minutes']                  = ' Minuten';
    $this->strings['time_format']              = 'Neuester Wetterbericht von vor %s um %s%s%s Uhr. ';  // rohe Daten ??
    $this->strings['time_minutes']             = 'und %s%s%s Minuten';
    $this->strings['time_one_hour']            = '%seiner%s Stunde %s';
    $this->strings['time_several_hours']       = '%s%s%s Stunden %s';
    $this->strings['time_a_moment']            = 'im Moment';
    $this->strings['meters_per_second']        = ' m/s '; // Meter pro Sekunde
    $this->strings['miles_per_hour']           = ' Meilen pro Stunde';
    $this->strings['meter']                    = ' m';  // Meter
    $this->strings['meters']                   = ' m';  // Meter
    $this->strings['feet']                     = ' Fuß';
    $this->strings['kilometers']               = ' km'; // Kilometer
    $this->strings['miles']                    = ' Meilen';
    $this->strings['and']                      = ' und ';
    $this->strings['plus']                     = ' plus ';
    $this->strings['with']                     = ' mit ';
    $this->strings['wind_blowing']             = 'Der Wind blies mit ';
    $this->strings['wind_with_gusts']          = ' Böen bis zu ';
    $this->strings['wind_from']                = ' und er kam aus ';
    $this->strings['wind_variable']            = ' aus %sunterschiedlichen Richtungen%s .';
    $this->strings['wind_varying']             = ', variierte zwischen %s%s%s (%s%sº%s) und %s%s%s (%s%sº%s)';
    $this->strings['wind_calm']                = 'Der Wind war %sruhig%s';
    $this->strings['wind_dir'] = array(
      'Nord',
      'Nord/Nordost',
      'Nordost',
      'Ost/Nordost',
      'Ost',
      'Ost/Südost',
      'Südost',
      'Süd/Südost',
      'Süd',
      'Süd/Südwest',
      'Südwest',
      'West/Südwest',
      'West',
      'West/Nordwest',
      'Nordwest',
      'Nord/Nordwest',
      'Nord');
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
      'N'  => 'Nord',
      'NE' => 'Nordost',
      'E'  => 'Ost',
      'SE' => 'Südost',
      'S'  => 'Süd',
      'SW' => 'Südwest',
      'W'  => 'West',
      'NW' => 'Nordwest'
      );
    $this->strings['temperature']     = 'Die Temperatur betrugt ';
    $this->strings['dew_point']       = ' bei einem Taupunkt von ';
    $this->strings['altimeter']       = 'Der Luftdruck stand auf '; // Absatz eingefügt
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'Die relative Luftfeuchtigkeit erreichte ';
    $this->strings['feelslike']       = 'Die gefühlte Temperatur lagt bei  ';
    $this->strings['cloud_group_beg'] = 'Bewölkung: ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'Der Himmel war %sklar%s. ';
    $this->strings['cloud_height']    = ' in der Höhe von  ';
    $this->strings['cloud_overcast']  = ' %sbewölkt%s  ';
    $this->strings['cloud_vertical_visibility'] = ' die %svertikale Sichtweite%s  ';
    $this->strings['cloud_condition'] =
      array(
	    'SKC' => 'wolkenlos',
	    'CLR' => 'heiter ',
	    'FEW' => 'ein wenig bewölkt',
	    'SCT' => 'aufgelockert bewölkt',
	    'BKN' => 'durchbrochene Bewölkung',
	    'OVC' => 'geschlossene Wolkendecke');
    $this->strings['cumulonimbus']     = ' Gewitterwolken';
    $this->strings['towering_cumulus'] = ' Kumuli';
    $this->strings['cavok']            = ' keine Wolken unter %s und keine Kumulunimbus oder Gewitterwolken';
    $this->strings['currently']        = 'Zur Zeit ';
    $this->strings['weather']          = 
      array(
	    '-' => ' leicht',
	    ' ' => ' mittel ',
	    '+' => ' schwer ',
	    'VC' => ' in der Umgebung',
	    'PR' => ' teilweise',
	    'BC' => ' Flecken von',
	    'MI' => ' flach',
	    'DR' => ' niedrig driftend',
	    'BL' => ' treiben',
	    'SH' => ' Schauer von',
	    'TS' => ' Gewitter',
	    'FZ' => ' gefrierend',
	    'DZ' => ' Niesel',
	    'RA' => ' Regen',
	    'SN' => ' Schnee',
	    'SG' => ' Schneekristall',
	    'IC' => ' Eiskristalle',
	    'PL' => ' Eiskugeln',
	    'GR' => ' Hagel',
	    'GS' => ' geringer Hagel',
	    'UP' => ' unbekannt',
	    'BR' => ' dunstig',
	    'FG' => ' Nebel',
	    'FU' => ' Rauch',
	    'VA' => ' vulkanische Asche',
	    'DU' => ' Staub',
	    'SA' => ' Sand',
	    'HZ' => ' Dunst',
	    'PY' => ' Sprühregen',
	    'PO' => ' Staub/Sandwirbel',
	    'SQ' => ' Böen',
	    'FC' => ' Wolkentrichter einer Wasserhose',
	    'SS' => ' Sandsturm/Staubsturm');
    $this->strings['visibility'] = 'Die Sichtweite reichte ';
    $this->strings['visibility_greater_than']  = 'weiter als ';
    $this->strings['visibility_less_than']     = 'weniger als ';
    $this->strings['visibility_to']            = ' zum ';
    $this->strings['runway_upward_tendency']   = ' mit einer %sansteigenden%s Tendenz';
    $this->strings['runway_downward_tendency'] = ' mit einer %sabsinkenden%s Tendenz';
    $this->strings['runway_no_tendency']       = ' keine %smarkante%s Tendenz';
    $this->strings['runway_between']           = 'zwischen ';
    $this->strings['runway_left']              = ' links';
    $this->strings['runway_central']           = ' mitte';
    $this->strings['runway_right']             = ' rechts';
    $this->strings['runway_visibility']        = 'Die Sichtweite betrug ';
    $this->strings['runway_for_runway']        = ' für die Landebahn ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
}

?>