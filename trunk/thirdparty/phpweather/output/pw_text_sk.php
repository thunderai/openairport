<?php // -*- coding: latin-2 -*-

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Slovak
 * output.
 *
 * @author   Ondrej Jombík <nepto@platon.sk>
 * @author   Radoslava Fedáková <mortischka@pobox.sk>
 * @link     http://nepto.sk/	Ondrej's personal homepage
 * @link     http://platon.sk/	Platon Software Development Group
 * @version  pw_text_sk.php,v 1.7 2003/09/16 22:57:11 gimpster Exp
 */

/* ViM 6.0 indentation used */

class pw_text_sk extends pw_text
{
  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_sk($weather, $input = array())
    {
      $this->strings['charset']                  = 'ISO-8859-2';
      $this->strings['no_data']                  = '¥utujem, momentálne nie sú dostupné ¾iadne informácie pre %s%s%s.';
      $this->strings['list_sentences_and']       = ' a ';
      $this->strings['list_sentences_comma']     = ', ';
      $this->strings['list_sentences_final_and'] = ' a ';
      $this->strings['location']                 = 'Toto je meterologický report pre %s%s%s.';
      $this->strings['minutes']                  = ' minútami';
      $this->strings['time_format']              = 'Report bol zostavený pred %s, o %s%s%s UTC.';
      $this->strings['time_minutes']             = 'a %s%s%s minútami';
      $this->strings['time_one_hour']            = '%sjednou%s hodinou %s';
      $this->strings['time_several_hours']       = '%s%s%s hodinami %s';
      $this->strings['time_a_moment']            = 'práve teraz';
      $this->strings['meters_per_second']        = ' metrov za sekundu';
      $this->strings['miles_per_hour']           = ' míµ za hodinu';
      $this->strings['meter']                    = ' metrov';
      $this->strings['meters']                   = ' metre';
      $this->strings['feet']                     = ' stôp';
      $this->strings['kilometers']               = ' kilometrov';
      $this->strings['miles']                    = ' míl';
      $this->strings['and']                      = ' a ';
      $this->strings['plus']                     = ' plus ';
      $this->strings['with']                     = ' s ';
      $this->strings['wind_blowing']             = 'Rýchlos» vetra bola ';
      $this->strings['wind_with_gusts']          = ' so silným závanom od ';
      $this->strings['wind_from']                = ' z ';
      $this->strings['wind_variable']            = ' z %srôznych%s smerov';
      $this->strings['wind_varying']             = ', meniaca sa medzi smerom z %s%s%s (%s%s&deg;%s) a %s%s%s (%s%s&deg;%s)';
      $this->strings['wind_calm']                = 'Vietor bol %spokojný%s';
      $this->strings['wind_dir'] =
        array('severu',
              'severu/severovýchodu',
              'severovýchodu',
              'východu/severovýchodu',
              'východu',
              'východu/juhovýchodu',
              'juhovýchodu',
              'juhu/juhovýchodu',
              'juhu',
              'juhu/juhozápadu',
              'juhozápadu',
              'západu/juhozápadu',
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
              'JV' => 'juhovýchod',
              'J'  => 'juh',
              'JZ' => 'juhozápad',
              'Z'  => 'západ',
              'SZ' => 'severozápad');
      $this->strings['temperature']     = 'Teplota bola ';
      $this->strings['dew_point']       = ' s rosným bodom ';
      $this->strings['altimeter']       = 'Atmosférický tlak bol ';
      $this->strings['hPa']             = ' hPa';
      $this->strings['inHg']            = ' inHg';
      $this->strings['rel_humidity']    = 'Relatívna vlhkos» vzduchu bola ';
      $this->strings['feelslike']       = 'Teplota sa zdala by» ';
      $this->strings['cloud_group_beg'] = 'Na oblohe boli ';
      $this->strings['cloud_group_end'] = '.';
      $this->strings['cloud_clear']     = 'Obloha bola %sjasná%s.';
      $this->strings['cloud_height']    = ' oblaky vo vý¹ke ';
      $this->strings['cloud_overcast']  = ' obloha bola %szamraèená%s od vý¹ky ';
      $this->strings['cloud_vertical_visibility'] = '%svertikálna viditeµnos»%s bola ';
      $this->strings['cloud_condition'] =
        array('SKC' => 'priehµadné',
              'CLR' => 'jasné',
              'FEW' => 'niektoré', /*'niekoµko',*/
              'SCT' => 'rozptýlené',
              'BKN' => 'zatiahnuté',
              'OVC' => 'zamraèené');
      $this->strings['cumulonimbus']     = ' nahromadené búrkové';
      $this->strings['towering_cumulus'] = ' týèiace sa nahromadené';
      $this->strings['cavok']            = ' ¾iadne oblaky pod %s a ani ¾iadne iné nahromadené oblaky';
      $this->strings['currently']        = 'Aktuálnym poèasím bolo ';
      $this->strings['weather']          = 
        array(/* Intensity */
              '-' => ' riedky ',
              ' ' => ' stredný ',
              '+' => ' hustý ',
              /* Proximity */
              'VC' => ' v priµahlých oblastiach',
              /* Descriptor */
              'PR' => ' èiastoèný',
              'BC' => ' areály',
              'MI' => ' plytký',
              'DR' => ' slabé prúdenie vzduchu',
              'BL' => ' veterno',
              'SH' => ' prehánky',
              'TS' => ' búrka s bleskami',
              'FZ' => ' mrznutie',
              /* Precipitation */
              'DZ' => ' mrholenie s veµkými kvapkami',
              'RA' => ' dá¾ï', /* ' da¾divo', */
              'SN' => ' sne¾enie',
              'SG' => ' zrnité sne¾enie',
              'IC' => ' µadové kry¹táliky',
              'PL' => ' µadovec',
              'GR' => ' krupobytie',
              'GS' => ' slabé krupobytie',
              'UP' => ' neznáme',
              /* Obscuration */
              'BR' => ' hmlový opar nad vodami',
              'FG' => ' hmlisto',
              'FU' => ' dymno',
              'VA' => ' sopeèný popol',
              'DU' => ' popra¹ok',
              'SA' => ' piesoèno', /* piesoèné */
              'HZ' => ' opar nad pohorím',
              'PY' => ' mrholenie s malými kvapôèkami',
              /* Other */
              'PO' => ' piesoèné výry',
              'SQ' => ' prudký závan vetra',
              'FC' => ' prietr¾ mraèien',
              'SS' => ' pra¹ná priesoèná búrka');
      $this->strings['visibility'] = 'Celková viditeµnos» bola ';
      $this->strings['visibility_greater_than']  = 'väè¹ia ako ';
      $this->strings['visibility_less_than']     = 'men¹ia ako ';
      $this->strings['visibility_to']            = ' do ';
      /* this is left untranslated, because I have no metar, that use
       * this text -- Nepto [14/07/2002] */
      $this->strings['runway_upward_tendency']   = ' so %sstúpajúcou%s tendenciou';
      $this->strings['runway_downward_tendency'] = ' s %sklesajúcou%s tendenciou';
      $this->strings['runway_no_tendency']       = ' s %snejednoznaènou%s tendenciou';
      $this->strings['runway_between']           = 'medzi ';
      $this->strings['runway_left']              = ' left';
      $this->strings['runway_central']           = ' central';
      $this->strings['runway_right']             = ' right';
      $this->strings['runway_visibility']        = 'Viditeµnos» bola ';
      $this->strings['runway_for_runway']        = ' pre pristávaciu dráhu èíslo ';

      /* We run the parent constructor */
      $this->pw_text($weather, $input);
    }

  function print_pretty_wind($wind)
    {
      extract($wind);
    
      if (! empty($meters_per_second)) {
        switch ($meters_per_second) {
        case 1:
          $this->strings['meters_per_second'] = ' meter za sekundu';
          break;
        case 2:
        case 3:
        case 4:
          $this->strings['meters_per_second'] = ' metre za sekundu';
          break;
        default:
          if ($meters_per_second - floor($meters_per_second) > 0)
            $this->strings['meters_per_second'] = ' metra za sekundu';
          break;
        }
      }
      if (! empty($miles_per_hour)) {
        switch ($miles_per_hour) {
        case 1:
          $this->strings['miles_per_hour'] = ' míµa za hodinu';
          break;
        case 2:
        case 3:
        case 4:
          $this->strings['miles_per_hour'] = ' míle za hodinu';
          break;
        }
      }
    
      /*
       * Z/ZO grammar handling
       * zo severu, z juhu, zo zapadu, z vychodu
       */
      if (isset($deg)) {
        if ($deg == 'VRB') {
        } else {
          $idx = intval(round($deg / 22.5));
          if ($idx <= 2 || $idx >= 11) {
            $this->strings['wind_from'] =
              str_replace(' z ', ' zo ', $this->strings['wind_from']);
          }
        }
      }
    
      if (isset($var_beg)) {
        $idx = intval(round($var_beg / 22.5));
        if ($idx <= 2 || $idx >= 11) {
          $this->strings['wind_varying'] =
            str_replace(' z ', ' zo ', $this->strings['wind_varying']);
        }
      }
    
      return parent::print_pretty_wind($wind);
    }

  function print_pretty_clouds($clouds) {
	for ($i = 0; $i < count($clouds); $i++) {
		if ($i == 0 && $clouds[$i]['condition'] == 'OVC') {
			if (1) {
				$this->strings['cloud_group_beg'] .= ' oblaky, ';
			} else { // another solution, nicer but incomplete (see TODO below)
				$this->strings['cloud_group_beg'] = '';
				$this->strings['cloud_overcast']  =
					ucfirst(ltrim($this->strings['cloud_overcast']));
			}
		}
		if ($i < count($clouds) - 1) {
			// TODO: Obloha bola zamracena od vysky XX metrov, ... oblaky.
		}
	}
	return parent::print_pretty_clouds($clouds);
  }

  function parse_cloud_group($cloud_group)
    {
      extract($cloud_group);
    
      if (isset($condition)) {
		  if ($condition == 'CAVOK') {
			  $this->strings['cloud_group_beg'] =
				  str_replace(' boli ', ' neboli ', $this->strings['cloud_group_beg']);
		  }
      }
    
      return parent::parse_cloud_group($cloud_group);
    }
  
  function parse_runway_group($runway_group)
    {
      if (empty($runway_group) || !is_array($runway_group)) {
        return;
      }
	  // Supposing, that runway visibility will always greter than 4 metres.
	  // I cannot imagine airport runway with visibility under 5 metres. :-)
      $old_meters = $this->strings['meters'];
      $this->strings['meters'] = ' metrov';
      $ret = parent::parse_runway_group($runway_group);
      $this->strings['meters'] = $old_meters;
      return $ret;
    }
  
  function print_pretty_time($time)
    {
      $minutes_old = round((time() - $time)/60);
      if ($minutes_old > 60) {
        $minutes = $minutes_old % 60;
        if ($minutes == 1) {
          $this->strings['time_minutes']  = 'a %s%s%s minútou';
        }
      } else {
        if ($minutes_old < 5) {
          /* we must remove word 'pred', because we wanted string:
           * 'Report bol zostavený prave teraz, ...' */
          $this->strings['time_format'] =
            str_replace(' pred ', ' ', $this->strings['time_format']);
        }
      }
    
      return parent::print_pretty_time($time);
    }
  
  function print_pretty_weather($weather)
  {
	  $ret_str = '';
	  for ($k = 0; $k < count($weather); $k++) {

		  if ($weather[$k]['descriptor'] == 'SH') { // prehánky ... da¾ïa
			  $k == 0 && $this->strings['currently'] =
				  str_replace(' bolo ', ' boli ', $this->strings['currently']);
			  if ($weather[$k]['precipitation'] == 'RA') {
				  $this->strings['weather']['-']  = ' riedkeho ';
				  $this->strings['weather'][' ']  = ' stredného ';
				  $this->strings['weather']['+']  = ' hustého ';
				  $this->strings['weather']['RA'] = ' da¾ïa';
			  }
		  } elseif ($weather[$k]['descriptor'] == 'TS') { // búrka
			  $k == 0 && $this->strings['currently'] =
				  str_replace(' bolo ', ' bola ', $this->strings['currently']);
			  $this->strings['weather']['-']  = ' riedkym ';
			  $this->strings['weather'][' ']  = ' stredným ';
			  $this->strings['weather']['+']  = ' hustým ';
			  $this->strings['weather']['RA'] = ' da¾ïom';
			  $this->strings['with']          = ' a ';
		  } elseif ($weather[$k]['precipitation'] == 'DZ' // mrholenie
				  || $weather[$k]['precipitation'] == 'SN') { // sne®enie
			  $this->strings['weather']['-']  = ' riedke ';
			  $this->strings['weather'][' ']  = ' stredné ';
			  $this->strings['weather']['+']  = ' husté ';
		  } elseif ($weather[$k]['precipitation'] == 'RA' // dá¾ï
				  || $weather[$k]['obscuration'] == 'HZ'
				  || $weather[$k]['obscuration'] == 'BR' // hmlový opar
				  ) { 
			  $k == 0 && $this->strings['currently'] =
				  str_replace(' bolo ', ' bol ', $this->strings['currently']);
		  } elseif ($weather[$k]['obscuration'] == 'FG') { // ... hmlisto
			  $this->strings['weather']['PR'] = ' èiastoèné';
			  $this->strings['weather']['MI'] = ' plytké';
		  }

		  // One part of weather parsing
		  $ret_str .= $this->properties['mark_begin']
			  . $this->parse_weather_group($weather[$k])
			  . $this->properties['mark_end'];

		  // Deliminators
		  $k <= count($weather) - 3 && $ret_str .= ',';
		  $k == count($weather) - 2 && $ret_str .= ' a ';
	  }

	  return $this->strings['currently'].$ret_str.'.';
  }
}

/*

Some advanced (problematic?) metars to test:

EFKK 281950Z 18008KT 150V220 9999 -SHRA FEW012 SCT016 BKN020 BKN075 12/12 Q0998
VDPP 281030Z 23008KT 9000 FEW015 FEW025CB SCT300 33/26 Q1008 CB:S/NW/E
LZIB 150730Z 10005MPS 1200 R31/P1500N R22/P1500N -SN BR OVC006 M03/M04 Q1026 NOSIG
201530Z VABB 24012KT 5000 FU FEW018 SCT025 28/22 Q1004 NOSIG
MWCR 2820000Z 12016KT 9999 HZ FEW016 BKN200 32/25 Q1015 NOSIG
CYZT 281900Z 10019G26KT 20SM VCSH FEW025 BKN050 OVC110 13/09 A2956 RMK SC1SC6AC2 SLP009

*/

?>
