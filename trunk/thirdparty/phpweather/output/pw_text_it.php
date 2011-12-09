<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Italian
 * output.
 *
 * @author   Renato Gallmetzer <renatogl [at] renatogl [dot] com>
 * @link     http://www.renatogl.com/  My homepage.
 * @version  pw_text_en.php,v 1.9 2002/10/20 15:57:15 gimpster Exp
 */
class pw_text_it extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_it($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Spiacente! Nessun dato disponibile per %s%s%s.';
    $this->strings['list_sentences_and']       = ' e ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', e ';
    $this->strings['location']                 = 'Informazione meteo per %s%s%s.';
    $this->strings['minutes']                  = ' minuti';
    $this->strings['time_format']              = 'La situazione meteo &egrave; di %s fa, delle %s%s%s UTC.';
    $this->strings['time_minutes']             = 'e %s%s%s minuti';
    $this->strings['time_one_hour']            = '%sun\'%sora %s';
    $this->strings['time_several_hours']       = '%s%s%s ore %s';
    $this->strings['time_a_moment']            = 'al momento';
    $this->strings['meters_per_second']        = ' metri al secondo';
    $this->strings['miles_per_hour']           = ' miglia all\'ora';
    $this->strings['meter']                    = ' metro';
    $this->strings['meters']                   = ' metri';
    $this->strings['feet']                     = ' piedi';
    $this->strings['kilometers']               = ' chilometri';
    $this->strings['miles']                    = ' miglia';
    $this->strings['and']                      = ' e ';
    $this->strings['plus']                     = ' pi&ugrave; ';
    $this->strings['with']                     = ' con ';
    $this->strings['wind_blowing']             = 'Vento alla velocit&agrave; di ';
    $this->strings['wind_with_gusts']          = ' con raffiche fino a ';
    $this->strings['wind_from']                = ' da ';
    $this->strings['wind_variable']            = ' da direzioni %svariabili%s.';
    $this->strings['wind_varying']             = ', variabile da %s%s%s (%s%s&deg;%s) a %s%s%s (%s%s&deg;%s)';
    $this->strings['wind_calm']                = 'Vento %scalmo%s';
    $this->strings['wind_dir'] = array(
      'nord',
      'nord/nordest',
      'nordest',
      'est/nordest',
      'est',
      'est/sudest',
      'sudest',
      'sud/sudest',
      'sud',
      'sud/sudwest',
      'sudwest',
      'west/sudwest',
      'west',
      'west/nordwest',
      'nordwest',
      'nord/nordwest',
      'nord');
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
      'N'  => 'nord',
      'NE' => 'nordest',
      'E'  => 'est',
      'SE' => 'sudest',
      'S'  => 'sud',
      'SW' => 'sudovest',
      'W'  => 'ovest',
      'NW' => 'nordovest'
      );
    $this->strings['temperature']     = 'Temperature di ';
    $this->strings['dew_point']       = ', temperatura di rugiada a ';
    $this->strings['altimeter']       = 'Pressione atmosferica di ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'Umidit&agrave; relativa di ';
    $this->strings['feelslike']       = 'Sensazione termica ';
    $this->strings['cloud_group_beg'] = 'Nuvolosit&agrave;: ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'Cielo %schiaro%s.';
    $this->strings['cloud_height']    = ' nubi ad una altitudine di ';
    $this->strings['cloud_overcast']  = 'Cielo %scoperto%s a partire da un\'altitudine di ';
    $this->strings['cloud_vertical_visibility'] = 'una %svisibilit&agrave; verticale%s di ';
    $this->strings['cloud_condition'] =
      array(
	    'SKC' => 'sereno',
	    'CLR' => 'sereno',
	    'FEW' => 'poco nuvoloso',
	    'SCT' => 'nuvolosit&agrave; sparsa',
	    'BKN' => 'nuvolosit&agrave; a tratti',
	    'OVC' => 'novoloso');
    $this->strings['cumulonimbus']     = ' cumulonimbi';
    $this->strings['towering_cumulus'] = ' cumuli';
    $this->strings['cavok']            = ' assenza di nuvole sotto %s ed assenza di cumulonimbi';
    $this->strings['currently']        = 'Attualmente ';
    $this->strings['weather']          = 
      array(
	    '-' => ' leggero',
	    ' ' => ' moderato ',
	    '+' => ' forte ',
	    'VC' => ' nelle vicinanze di',
	    'PR' => ' parziale',
	    'BC' => ' pezzi di',
	    'MI' => ' pianeggiante',
	    'DR' => ' scivolante in piano',
	    'BL' => ' soffiante',
	    'SH' => ' rovesci di',
	    'TS' => ' temporale',
	    'FZ' => ' gelo',
	    'DZ' => ' pioviggine',
	    'RA' => ' pioggia',
	    'SN' => ' neve',
	    'SG' => ' grani di neve',
	    'IC' => ' cristalli di ghiaccio',
	    'PL' => ' ganelli di ghiaccio',
	    'GR' => ' grandine',
	    'GS' => ' leggera grandine',
	    'UP' => ' sconosciuto',
	    'BR' => ' foschia',
	    'FG' => ' nebbia',
	    'FU' => ' fumo',
	    'VA' => ' cenere vulcanica',
	    'DU' => ' polvere sparsa',
	    'SA' => ' sabbia',
	    'HZ' => ' foschia',
	    'PY' => ' pioggerella',
	    'PO' => ' vortici di sabbia o polvere',
	    'SQ' => ' raffiche',
	    'FC' => ' imbuto di tromba d\'aria',
	    'SS' => ' tempesta di sabbia o polvere');
    $this->strings['visibility'] = 'Visibilit&agrave; totale di ';
    $this->strings['visibility_greater_than']  = 'maggiore di ';
    $this->strings['visibility_less_than']     = 'minore di ';
    $this->strings['visibility_to']            = ' fino a ';
    $this->strings['runway_upward_tendency']   = ' con tendenza a %ssalire%s';
    $this->strings['runway_downward_tendency'] = ' con tendenza a %sscendere%s';
    $this->strings['runway_no_tendency']       = ' con tendenza %snon distinguibile%s';
    $this->strings['runway_between']           = 'tra ';
    $this->strings['runway_left']              = ' sinistra';
    $this->strings['runway_central']           = ' centrale';
    $this->strings['runway_right']             = ' destra';
    $this->strings['runway_visibility']        = 'Visibilit&agrave; di ';
    $this->strings['runway_for_runway']        = ' per la pista d\'atterraggio runway ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
}

?>
