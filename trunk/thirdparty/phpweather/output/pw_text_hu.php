<?php // -*- coding: latin-2 -*-

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce 
 * Hungarian output.
 * A magyar szövegû idõjárásjelentéshez a pw_text innen
 * veszi a sztringeket.
 *
 * @author   Mihály Gyulai 
 * @link     http://gyulai.freeyellow.com/  The homepage of the author.
 * @version  pw_text_hu.php,v 1.14 2003/09/16 22:57:11 gimpster Exp
 */
class pw_text_hu extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array   This is just passed on to pw_text().
   *		     Ezt a paramétert átadjuk pw_text() -nek.
   */
  function pw_text_hu($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-2';
    $this->strings['no_data']                  = 'Sajnos nincs adat %s%s%s számára.';
    $this->strings['list_sentences_and']       = ' és ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', és ';
    $this->strings['location']                 = 'Idõjárásjelentés %s%s%s számára.';
    $this->strings['minutes']                  = ' ';
    $this->strings['time_format']              = 'A jelentés %s perccel ezelõtt készült, %s%s%s UTC-kor.';
    $this->strings['time_minutes']             = 'és %s%s%s ';
    $this->strings['time_one_hour']            = '%segy%s órával %s';
    $this->strings['time_several_hours']       = '%s%s%s órával %s';
    $this->strings['time_a_moment']            = 'jelenleg';
    $this->strings['meters_per_second']        = ' m/s';
    $this->strings['miles_per_hour']           = ' mérföld/h';
    $this->strings['meter']                    = ' m';
    $this->strings['meters']                   = ' m';
    $this->strings['feet']                     = ' láb';
    $this->strings['kilometers']               = ' km';
    $this->strings['miles']                    = ' mérföld';
    $this->strings['and']                      = ' és ';
    $this->strings['plus']                     = ' és ';
    $this->strings['with']                     = '';
    $this->strings['wind_blowing']             = 'Szélsebesség: ';
    $this->strings['wind_with_gusts']          = ' széllökések: ';
    $this->strings['wind_from']                = ' iránya: ';
    $this->strings['wind_variable']            = ' %skülönbözõ%s irányokból.';
    $this->strings['wind_varying']             = ', változik %s%s%s (%s%s&deg;%s) és %s%s%s (%s%s&deg;%s) között';
    $this->strings['wind_calm']                = 'Szél %snem fújt%s';

  $this->strings['wind_dir'] = array(
  'Észak',
  'Észak/Északkelet',
  'Északkelet',
  'Kelet/Északkelet',
  'Kelet',
  'Kelet/Délkelet',
  'Délkelet',
  'Dél/Délkelet',
  'Dél',
  'Dél/Délnyugat',
  'Délnyugat',
  'Nyugat/Délnyugat',
  'Nyugat',
  'Nyugat/Északnyugat',
  'Északnyugat',
  'Észak/Északnyugat',
  'Észak');

  $this->strings['wind_dir_short'] = array(
  'É',
  'É/ÉK',
  'ÉK',
  'K/ÉK',
  'K',
  'K/DK',
  'DK',
  'D/DK',
  'D',
  'D/DNY',
  'DNY',
  'NY/DNY',
  'NY',
  'NY/ÉNY',
  'ÉNY',
  'É/ÉNY',
  'É'
);

  $this->strings['wind_dir_short_long'] = array(
      'É'  => 'északi',
      'ÉK' => 'északkeleti',
      'K'  => 'keleti',
      'DK' => 'délkeleti',
      'D'  => 'déli',
      'DNY' => 'délnyugati',
      'NY'  => 'nyugati',
      'ÉNY' => 'északnyugati'
      );

    $this->strings['temperature']     = 'A hõmérséklet ';
    $this->strings['dew_point']       = ', a harmatpont ';
    $this->strings['altimeter']       = 'A légköri nyomás ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'A relatív páratartalom ';
    $this->strings['feelslike']       = 'A hõérzet ';
    $this->strings['cloud_group_beg'] = 'Az égbolton';
    $this->strings['cloud_group_end'] = ' magasságban.';
    $this->strings['cloud_clear']     = 'Az égbolt %sfelhõtlen%s volt.';
    $this->strings['cloud_height']    = 'felhõ ';
    $this->strings['cloud_overcast']  = 'az égbolt %sborult%s ';
    $this->strings['cloud_vertical_visibility'] = 'a %sfüggõleges láthatóság%s ';
  
  $this->strings['cloud_condition'] = array(
	    'SKC' => ' derült',
	    'CLR' => ' tiszta',
	    'FEW' => ' néhány ',
	    'SCT' => ' szórványos ',
	    'BKN' => ' szakadozott ',
	    'OVC' => ' borult');
  
    $this->strings['cumulonimbus']     = ' gomoly';
    $this->strings['towering_cumulus'] = ' vihar';
    $this->strings['cavok']            = ' nincsenek felhõk %s magasságban, és nincs gomolyfelhõ';
    $this->strings['currently']        = 'Jellemzõ: ';
  
  $this->strings['weather'] = array(
  '-' => ' könnyû ',
  ' ' => ' enyhe ',
  '+' => ' erõs ',
  'VC' => ' a közelben',
  'PR' => ' részleges',
  'BC' => ' szakadozott',
  'MI' => ' felszínes',
  'DR' => 'enyhe légmozgás',
  'BL' => 'széllökés',
  'SH' => 'zápor',
  'TS' => 'zivatar',
  'FZ' => 'fagy',
  'DZ' => 'szitáló esõ',
  'RA' => 'esõ',
  'SN' => 'hó',
  'SG' => 'szemcsés hó',
  'IC' => 'jégkristály',
  'PE' => 'jégdara',
  'GR' => 'jégesõ',
  'GS' => 'apró jégesõ és/vagy hódara',
  'UP' => 'ismeretlen',
  'BR' => 'köd',
  'FG' => 'sûrû köd',
  'FU' => 'füst',
  'VA' => 'vulkáni hamu',
  'DU' => 'kiterjedt por',
  'SA' => 'homok',
  'HZ' => 'pára',
  'PY' => 'permet',
  'PO' => 'por/homok örvény',
  'SQ' => 'szélroham',
  'FC' => 'felhõtölcsér/tornádó/vízoszlop',
  'SS' => 'homokvihar/porvihar'
);

    $this->strings['visibility'] = 'A láthatóság általában ';
    $this->strings['visibility_greater_than']  = 'nagyobb, mint ';
    $this->strings['visibility_less_than']     = 'kisebb, mint ';
    $this->strings['runway_upward_tendency']   = ' %snövekvõ%s tendenciával';
    $this->strings['runway_downward_tendency'] = ' %scsökkenõ%s tendenciával';
    $this->strings['runway_no_tendency']       = ' határozott %stendencia nélkül%s';
    $this->strings['runway_between']           = 'közötti? ';
    $this->strings['runway_left']              = ' bal';
    $this->strings['runway_central']           = ' középsõ';
    $this->strings['runway_right']             = ' jobb';
    $this->strings['runway_visibility']        = 'A láthatóság ';
    $this->strings['runway_for_runway']        = ' a kifutópályán ';

  /* We run the parent constructor */
  
  $this->pw_text($weather, $input);
    
  }
}

?>
