<?php // -*- coding: latin-2 -*-

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Polish
 * output.
 *
 * @author   Michal Margula <alchemyx@uznam.net.pl>
 * @link     http://alchemyx.uznam.net.pl/  My homepage.
 * @version  pw_text_pl.php,v 1.0 2004/09/14 15:57:15 alchemyx Exp
 */
class pw_text_pl extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_pl($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-2';
    $this->strings['no_data']                  = 'Przepraszamy! Nie ma danych dostêpnych dla %s%s%s.';
    $this->strings['list_sentences_and']       = ' i ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', i ';
    $this->strings['location']                 = 'To jest raport dla %s%s%s.';
    $this->strings['minutes']                  = ' minut';
    $this->strings['time_format']              = 'Raport zosta³ utworzony %s temu, o godzinie %s%s%s UTC.';
    $this->strings['time_minutes']             = 'i %s%s%s minut';
    $this->strings['time_one_hour']            = '%sjedn±%s godzinê %s';
    $this->strings['time_several_hours']       = '%s%s%s godzin %s';
    $this->strings['time_a_moment']            = 'chwilê';
    $this->strings['meters_per_second']        = ' metrów na sekundê';
    $this->strings['miles_per_hour']           = ' mil na godzinê';
    $this->strings['meter']                    = ' metrów';
    $this->strings['meters']                   = ' metrów';
    $this->strings['feet']                     = ' stóp';
    $this->strings['kilometers']               = ' kilometrów';
    $this->strings['miles']                    = ' mil';
    $this->strings['and']                      = ' i ';
    $this->strings['plus']                     = ' plus ';
    $this->strings['with']                     = ' z ';
    $this->strings['wind_blowing']             = 'Wiatr wia³ z prêdko¶ci± ';
    $this->strings['wind_with_gusts']          = ' w porywach do ';
    $this->strings['wind_from']                = ' z kierunku ';
    $this->strings['wind_variable']            = ' ze %szmiennego%s kierunku';
    $this->strings['wind_varying']             = ', wahaj±ce siê pomiêdzy %s%s%s (%s%s&deg;%s) a %s%s%s (%s%s&deg;%s)';
    $this->strings['wind_calm']                = 'Wiatr by³ %sspokojny%s';
    $this->strings['wind_dir'] = array(
      'pó³nocnego',
      'pó³nocnego/pó³nocno-wschodniego',
      'pó³nocno-wschodniego',
      'wschodniego/po³nocno-wschodniego',
      'wschodniego',
      'wschodniego/po³udniowo-wschodniego',
      'po³udnioweo-wschodniego',
      'po³udniowego/po³udniowo-wschodniego',
      'po³udniowego',
      'po³udniowego/po³udniowo-zachodniego',
      'po³udniowo-zachodniego',
      'zachodniego/po³udniowo-zachodniego',
      'zachodniego',
      'zachodniego/pó³nocno-zachodniego',
      'pó³nocno-zachodniego',
      'pó³nocnego/pó³nocno-zachodniego',
      'pó³nocnego');
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
    $this->strings['temperature']     = 'Temperatura wynosi³a ';
    $this->strings['dew_point']       = ', punkt rosy ';
    $this->strings['altimeter']       = 'Ci¶nienie QHN wynosi³o ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'Wilgotno¶æ wzglêdna wynosi³a ';
    $this->strings['feelslike']       = 'Temperatura by³a odczuwalna jako ';
    $this->strings['cloud_group_beg'] = 'By³o ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'Niebo by³o %sczyste%s.';
    $this->strings['cloud_height']    = ' na wysoko¶ci ';
    $this->strings['cloud_overcast']  = 'Ca³kowite %szachmurzenie%s o podstawie ';
    $this->strings['cloud_vertical_visibility'] = '%spionowa widzialno¶æ%s ';
    $this->strings['cloud_condition'] =
      array(
	    'SKC' => 'niebo bezchmurne',
	    'CLR' => 'niebo bezchmurne (0/8)',
	    'FEW' => 'zachmurzenie niewielkie (1/8 - 2/8)',
	    'SCT' => 'zachmurzenie rozrzucone (3/8 - 4/8)',
	    'BKN' => 'zachmurzenie poprzerywane (5/8 - 7/8) ',
	    'OVC' => 'zachmurzenie ca³kowite (8/8)');
    $this->strings['cumulonimbus']     = ' cumulonimbus';
    $this->strings['towering_cumulus'] = ' cumulus wypiêtrzony';
    $this->strings['cavok']            = ' brak chmur poni¿ej %s, brak cumulonimbusów oraz brak zjawisk atmosferycznych';
    $this->strings['currently']        = 'Aktualnie ';
    $this->strings['weather']          = 
      array(
	    '-' => ' lekkie',
	    ' ' => ' ¶rednie ',
	    '+' => ' mocne ',
	    'VC' => ' w pobli¿u',
	    'PR' => ' czê¶ciowe',
	    'BC' => ' p³aty',
	    'MI' => ' p³ytkie',
	    'DR' => ' nisko unosz±ce',
	    'BL' => ' podmuchy',
	    'SH' => ' przelotne opady',
	    'TS' => ' burza z piorunami',
	    'FZ' => ' przymrozek',
	    'DZ' => ' m¿awka',
	    'RA' => ' deszcz',
	    'SN' => ' ¶nieg',
	    'SG' => ' gruby ¶nieg',
	    'IC' => ' kryszta³ki lodu',
	    'PL' => ' ice pellets',
	    'GR' => ' grad',
	    'GS' => ' ma³y grad',
	    'UP' => ' nieznany',
	    'BR' => ' zamglenie',
	    'FG' => ' mg³y',
	    'FU' => ' dym',
	    'VA' => ' popió³ wulkaniczny',
	    'DU' => ' widespread dust',
	    'SA' => ' piasek',
	    'HZ' => ' zmêtnienie',
	    'PY' => ' py³ wodny',
	    'PO' => ' mocno rozwijaj±ce siê wiry piaskowe/py³owe',
	    'SQ' => ' nawa³nica',
	    'FC' => ' tr±ba powietrzna, wodna, tornado',
	    'SS' => ' burza piaskowa/py³owa');
    $this->strings['visibility'] = 'Widzialno¶æ pozioma wynosi³a ';
    $this->strings['visibility_greater_than']  = 'wiêcej ni¿ ';
    $this->strings['visibility_less_than']     = 'mniej ni¿ ';
    $this->strings['visibility_to']            = ' do ';
    $this->strings['runway_upward_tendency']   = ' z tendencj± %wzrostow±%s';
    $this->strings['runway_downward_tendency'] = ' z tendencj± %smalej±c±%s';
    $this->strings['runway_no_tendency']       = ' bez %srozró¿nialnej%s tendencji';
    $this->strings['runway_between']           = 'pomiêdzy ';
    $this->strings['runway_left']              = ' lewego';
    $this->strings['runway_central']           = ' ¶rodkowego';
    $this->strings['runway_right']             = ' prawego';
    $this->strings['runway_visibility']        = 'Widoczno¶æ by³a ';
    $this->strings['runway_for_runway']        = ' dla pasa ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
}

?>
