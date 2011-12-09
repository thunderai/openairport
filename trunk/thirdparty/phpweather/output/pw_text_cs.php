<?php // -*- coding: latin-2 -*-

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Czech
 * output.
 *
 * @author   Václav Øíkal <vaclavr@physics.muni.cz>
 * @author   Ondrej Jombík <nepto@platon.sk>
 * @author   Radoslava Fedáková <mortischka@pobox.sk>
 * @link     http://vac.ath.cx/
 * @link     http://nepto.sk/	Ondrej's personal homepage
 * @link     http://platon.sk/	Platon Software Development Group
 *
 * @version  pw_text_cs.php,v 1.0 2002/09/22 21:13:40 gimpster Exp
 */

/* ViM 6.0 indentation used */

class pw_text_cs extends pw_text
{
  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_cs($weather, $input = array())
    {
      $this->strings['charset']                  = 'ISO-8859-2';
      $this->strings['no_data']                  = 'Lituji, nejsou dostupné ¾ádné informace pro %s%s%s.';
      $this->strings['list_sentences_and']       = ' a ';
      $this->strings['list_sentences_comma']     = ', ';
      $this->strings['list_sentences_final_and'] = ' a ';
      $this->strings['location']                 = 'Toto je meterologická zpráva leti¹tì %s%s%s.';
      $this->strings['minutes']                  = ' minutami';
      $this->strings['time_format']              = 'Zpráva byla sestavena pøed %s, v %s%s%s UTC.';
      $this->strings['time_minutes']             = 'a %s%s%s minutami';
      $this->strings['time_one_hour']            = '%sjednou%s hodinou %s';
      $this->strings['time_several_hours']       = '%s%s%s hodinami %s';
      $this->strings['time_a_moment']            = 'právì teï';
      $this->strings['meters_per_second']        = ' metrù za sekundu';
      $this->strings['miles_per_hour']           = ' mil za hodinu';
      $this->strings['meter']                    = ' metrù';
      $this->strings['meters']                   = ' metry';
      $this->strings['feet']                     = ' stop';
      $this->strings['kilometers']               = ' kilometrù';
      $this->strings['miles']                    = ' mil';
      $this->strings['and']                      = ' a ';
      $this->strings['plus']                     = ' plus ';
      $this->strings['with']                     = ' s ';
      $this->strings['wind_blowing']             = 'Rychlost vìtru byla ';
      $this->strings['wind_with_gusts']          = ' se silnými nárazy od ';
      $this->strings['wind_from']                = ' z ';
      $this->strings['wind_variable']            = ' z %srùzných%s smìrù';
      $this->strings['wind_varying']             = ', promìnlivý vítr od %s%s%s (%s%s&deg;%s) a %s%s%s (%s%s&deg;%s)';
      $this->strings['wind_calm']                = 'Bylo %sbezvìtøí%s';
      $this->strings['wind_dir'] =
        array('severu',
              'severu/severovýchodu',
              'severovýchodu',
              'východu/severovýchodu',
              'východu',
              'východu/jihovýchodu',
              'jihovýchodu',
              'jihu/jihovýchodu',
              'jihu',
              'jihu/jihozápadu',
              'jihozápadu',
              'západu/jihozápadu',
              'západu',
              'západu/severozápadu',
              'severozápadu',
              'severu/severozápadu',
              'severu');
      $this->strings['wind_dir_short'] =
        array('S',
              'SSV',
              'SV',
              'VSV',
              'V',
              'VJV',
              'JV',
              'JJV',
              'J',
              'JJZ',
              'JZ',
              'ZJZ',
              'Z',
              'ZSZ',
              'SZ',
              'SSZ',
              'S');
      $this->strings['wind_dir_short_long'] =
        array('S'  => 'sever',
              'SV' => 'severovýchod',
              'V'  => 'východ',
              'JV' => 'jihovýchod',
              'J'  => 'jih',
              'JZ' => 'jihozápad',
              'Z'  => 'západ',
              'SZ' => 'severozápad');
      $this->strings['temperature']     = 'Teplota byla ';
      $this->strings['dew_point']       = ' a rosný bod byl ';
      $this->strings['altimeter']       = 'Atmosférický tlak byl ';
      $this->strings['hPa']             = ' hPa';
      $this->strings['inHg']            = ' inHg';
      $this->strings['rel_humidity']    = 'Relativní vlhkost vzduchu byla ';
      $this->strings['feelslike']       = 'Teplota sa zdála být ';
      $this->strings['cloud_group_beg'] = 'Bylo ';
      $this->strings['cloud_group_end'] = '.';
      $this->strings['cloud_clear']     = 'Obloha byla %sjasná%s.';
      $this->strings['cloud_height']    = ' se základnou mrakù ve vý¹ce ';
      $this->strings['cloud_overcast']  = ' obloha byla %szata¾ená%s od vý¹ky ';
      $this->strings['cloud_vertical_visibility'] = '%svertikální viditelnost%s byla ';
      $this->strings['cloud_condition'] =
        array('SKC' => 'jasno',
              'CLR' => 'jasno',
              'FEW' => 'skorojasno', /*'niekoµko',*/
              'SCT' => 'polojasno',
              'BKN' => 'oblaèno',
              'OVC' => 'zata¾eno');
      $this->strings['cumulonimbus']     = ' cumulonimbus';
      $this->strings['towering_cumulus'] = ' kupovitá oblaènost'; /*tyèíci se nahromadìné - to je pøece blbost*/
      $this->strings['cavok']            = ' ¾ádná oblaènost pod %s ani ¾ádná kupovitá oblaènost';
      $this->strings['currently']        = 'Aktuální poèasí: ';
      $this->strings['weather']          = 
        array(/* Intensity */
              '-' => ' slabý ',
              ' ' => ' støední ',
              '+' => ' silný ',
              /* Proximity */
              'VC' => ' v blízkosti',
              /* Descriptor */
              'PR' => ' pøevá¾nì pokrývající leti¹tì',
              'BC' => ' pásy',
              'MI' => ' pøízemní',
              'DR' => ' nízko zvíøený',
              'BL' => ' zvíøený',
              'SH' => ' pøehánky',
              'TS' => ' bouøka',
              'FZ' => ' námrzající',
              /* Precipitation */
              'DZ' => ' mrholení',
              'RA' => ' dé¹»', /* ' da¾divo', */
              'SN' => ' sníh',
              'SG' => ' zrnitý sníh',
              'IC' => ' ledové krystalky',
              'PL' => ' zmrzlý dé¹»',
              'GR' => ' kroupy',
              'GS' => ' slabé krupobití',
              'UP' => ' neznámé',
              /* Obscuration */
              'BR' => ' kouømo',
              'FG' => ' mlha',
              'FU' => ' kouø',
              'VA' => ' vulkanický popel',
              'DU' => ' pra¹no',
              'SA' => ' písek', /* píseèné */
              'HZ' => ' zákal',
              'PY' => ' mrholení s malými kapkami',
              /* Other */
              'PO' => ' píseèné víry',
              'SQ' => ' húlava',
              'FC' => ' prùtr¾ mraèen',
              'SS' => ' pra¹ná/píseèná bouøe');
      $this->strings['visibility'] = 'Celková viditenost byla ';
      $this->strings['visibility_greater_than']  = 'vìt¹í ne¾ ';
      $this->strings['visibility_less_than']     = 'men¹í ne¾ ';
      $this->strings['visibility_to']            = ' do ';
      /* this is left untranslated, because I have no metar, that use
       * this text -- Nepto [14/07/2002] */
      $this->strings['runway_upward_tendency']   = ' with an %supward%s tendency';
      $this->strings['runway_downward_tendency'] = ' with a %sdownward%s tendency';
      $this->strings['runway_no_tendency']       = ' with %sno distinct%s tendency';
      $this->strings['runway_between']           = 'between ';
      $this->strings['runway_left']              = ' left';
      $this->strings['runway_central']           = ' central';
      $this->strings['runway_right']             = ' right';
      $this->strings['runway_visibility']        = 'Viditeµnos» bola ';
      $this->strings['runway_for_runway']        = ' for runway ';

      /* We run the parent constructor */
      $this->pw_text($weather, $input);
    }

  function print_pretty_wind($wind)
    {
      extract($wind);
    
      if (! empty($meters_per_second)) {
        switch ($meters_per_second) {
        case 1:
          $this->strings['meters_per_second'] = ' metr za sekundu';
          break;
        case 2:
        case 3:
        case 4:
          $this->strings['meters_per_second'] = ' metrù za sekundu';
          break;
        default:
          if ($meters_per_second - floor($meters_per_second) > 0)
            $this->strings['meters_per_second'] = ' metru za sekundu';
          break;
        }
      }
      if (! empty($miles_per_hour)) {
        switch ($miles_per_hour) {
        case 1:
          $this->strings['miles_per_hour'] = ' míle za hodinu';
          break;
        case 2:
        case 3:
        case 4:
          $this->strings['miles_per_hour'] = ' mil za hodinu';
          break;
        }
      }
    
      /*
       * Z/ZO grammar handling
       * ze severu, z jihu, ze západu, z východu
       */
      if (isset($deg)) {
        if ($deg == 'VRB') {
        } else {
          $idx = intval(round($deg / 22.5));
          if ($idx <= 2 || $idx >= 11) {
            $this->strings['wind_from'] =
              str_replace(' z ', ' ze ', $this->strings['wind_from']);
          }
        }
      }
    
      if (isset($var_beg)) {
        $idx = intval(round($var_beg / 22.5));
        if ($idx <= 2 || $idx >= 11) {
          $this->strings['wind_varying'] =
            str_replace(' z ', ' ze ', $this->strings['wind_varying']);
        }
      }
    
      return parent::print_pretty_wind($wind);
    }

  function parse_cloud_group($cloud_group)
    {
      extract($cloud_group);
    
      if (isset($condition) && $condition == 'CAVOK') {
        $this->strings['cloud_group_beg'] =
          str_replace('Bylo ', 'Nebyla ', $this->strings['cloud_group_beg']);
      }
    
      return parent::parse_cloud_group($cloud_group);
    }
  
  function print_pretty_time($time)
    {
      $minutes_old = round((time() - $time)/60);
      if ($minutes_old > 60) {
        $minutes = $minutes_old % 60;
        if ($minutes == 1) {
          $this->strings['time_minutes']  = 'a %s%s%s minutou';
        }
      } else {
        if ($minutes_old < 5) {
          /* we must remove word 'pøed', because we wanted string:
           * 'Report bol zostavený prave teraz, ...' */
          $this->strings['time_format'] =
            str_replace(' pøed ', ' ', $this->strings['time_format']);
        }
      }
    
      return parent::print_pretty_time($time);
    }
  
  function print_pretty_weather($weather)
    {
      if ($weather[0]['descriptor'] == 'SH') {
        $this->strings['currently'] = str_replace(' bylo ', ' byly ',
                                                  $this->strings['currently']);
        if ($weather[0]['precipitation'] == 'RA') {
          $this->strings['weather']['-']  = ' slabého ';
          $this->strings['weather'][' ']  = ' støedního ';
          $this->strings['weather']['+']  = ' hustého ';
          $this->strings['weather']['RA'] = ' de¹tì';
        }
      } elseif ($weather[0]['precipitation'] == 'RA'
                || $weather[0]['obscuration'] == 'HZ') {
        $this->strings['currently'] = str_replace(' bylo ', ' byl ',
                                                  $this->strings['currently']);
      }

      return parent::print_pretty_weather($weather);
    }
}

?>
