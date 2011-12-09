<?php // -*- coding: latin-9 -*-

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Turkish
 * output.
 *
 * @author   Ferhat Bingol <s021183@student.dtu.dk>
 * @version  pw_text_en.php,v 1.9 2002/10/20 15:57:15 gimpster Exp
 */
class pw_text_tr extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_tr($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-9';
    $this->strings['no_data']                  = 'Üzgünüz! %s%s%s için veri bulunmuyor.';
    $this->strings['list_sentences_and']       = ' ve ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', ve ';
    $this->strings['location']                 = '%s%s%s için hazýrlanan rapor.';
    $this->strings['minutes']                  = ' dakika';
    $this->strings['time_format']              = 'Rapor %s önce saat %s%s%s UTC de hazýrlanmýþ.';
    $this->strings['time_minutes']             = 've %s%s%s dakika';
    $this->strings['time_one_hour']            = '%sone%s saat %s';
    $this->strings['time_several_hours']       = '%s%s%s saat %s';
    $this->strings['time_a_moment']            = 'a moment';
    $this->strings['meters_per_second']        = ' metre / saniye';
    $this->strings['miles_per_hour']           = ' mil / saat';
    $this->strings['meter']                    = ' metre';
    $this->strings['meters']                   = ' metre';
    $this->strings['feet']                     = ' feet';
    $this->strings['kilometers']               = ' kilometre';
    $this->strings['miles']                    = ' mil';
    $this->strings['and']                      = ' ve ';
    $this->strings['plus']                     = ' artý ';
    $this->strings['with']                     = ' ile ';
    $this->strings['wind_blowing']             = 'Rüzgarýn esme hýzý  ';
    $this->strings['wind_with_gusts']          = ' deðerine kadar ulaþan gust ';
    $this->strings['wind_from']                = ' , yönü ';
    $this->strings['wind_variable']            = ' %svariable% yönünde.';
    $this->strings['wind_varying']             = ', %s%s%s (%s%s&deg;%s) ve %s%s%s (%s%s&deg;%s) arasýnda deðiþken';
    $this->strings['wind_calm']                = 'Rüzgar %scalm%';
    $this->strings['wind_dir'] = array(
      'kuzey',
      'kuzey/kuzeydoðu',
      'kuzeydoðu',
      'batý/kuzeydoðu',
      'doðu',
      'doðu/güneydoðu',
      'güneydoðu',
      'güney/güneydoðu',
      'güney',
      'güney/güneybatý',
      'güneybatý',
      'batý/güneybatý',
      'batý',
      'batý/kuzeybatý',
      'kuzeybatý',
      'kuzey/kuzeybatý',
      'kuzey');
    $this->strings['wind_dir_short'] = array(
      'K',
      'KKD',
      'KD',
      'DKD',
      'D',
      'DGD',
      'GD',
      'GGD',
      'G',
      'GGB',
      'GB',
      'BGB',
      'B',
      'BKB',
      'KB',
      'KKB',
      'K');
    $this->strings['wind_dir_short_long'] = array(
      'K'  => 'kuzey',
      'KD' => 'kuzeydoðu',
      'D'  => 'doðu',
      'GDE' => 'güneydoðu',
      'G'  => 'güney',
      'GB' => 'güneybatý',
      'B'  => 'batý',
      'KB' => 'kuzeybatý'
      );
    $this->strings['temperature']     = 'Sýcaklýk ';
    $this->strings['dew_point']       = ', mevcut dew-point ';
    $this->strings['altimeter']       = 'Atmosferýk basýnç ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'Relativ humidity ';
    $this->strings['feelslike']       = 'Hissedilen sýcaklýk ';
    $this->strings['cloud_group_beg'] = 'Bulunan ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'Gökyüzü %sclear%s.';
    $this->strings['cloud_height']    = ' bulutlarýn yüksekliði ';
    $this->strings['cloud_overcast']  = 'Gökyüzü %sovercast% olduðu yükselik ';
    $this->strings['cloud_vertical_visibility'] = 'görüþ mesafesi %svertical visibility% ';
    $this->strings['cloud_condition'] =
      array(
	    'SKC' => 'açýk',
	    'CLR' => 'açýk',
	    'FEW' => 'az',
	    'SCT' => 'scattered',
	    'BKN' => 'yer yer bulutlu',
	    'OVC' => 'overcast');
    $this->strings['cumulonimbus']     = ' kumulonimbus';
    $this->strings['towering_cumulus'] = ' towering kumulus';
    $this->strings['cavok']            = ' %s altýnda bulut bulunmuyor ve kumulonimbus bulutlarý yok';
    $this->strings['currently']        = 'Þu anda ';
    $this->strings['weather']          = 
      array(
	    '-' => ' light',
	    ' ' => ' moderate ',
	    '+' => ' heavy ',
	    'VC' => ' bölgede',
	    'PR' => ' kýsmi',
	    'BC' => ' patches of',
	    'MI' => ' sýð',
	    'DR' => ' düþük yoðunlukta',
	    'BL' => ' esen',
	    'SH' => ' saðnak',
	    'TS' => ' fýrtýna',
	    'FZ' => ' dondurucu',
	    'DZ' => ' çiseleyen',
	    'RA' => ' yaðmur',
	    'SN' => ' kar',
	    'SG' => ' parça karlý',
	    'IC' => ' buz kristalleri',
	    'PL' => ' buz parçalý',
	    'GR' => ' dolu',
	    'GS' => ' az dolulu',
	    'UP' => ' bilinmeyen',
	    'BR' => ' sis',
	    'FG' => ' sisli',
	    'FU' => ' parçalý sisli',
	    'VA' => ' volkanik dumanlý',
	    'DU' => ' widespread dust',
	    'SA' => ' kum',
	    'HZ' => ' puslu',
	    'PY' => ' sprey',
	    'PO' => ' well-developed dust/sand whirls',
	    'SQ' => ' bora',
	    'FC' => ' (funnel cloud tornado waterspout)',
	    'SS' => ' kur/kil fýrtýnasý');
    $this->strings['visibility'] = 'Görüþ mesafesi ';
    $this->strings['visibility_greater_than']  = 'deðerinden büyük  ';
    $this->strings['visibility_less_than']     = 'deðerinden düþük ';
    $this->strings['visibility_to']            = '  ';
    $this->strings['runway_upward_tendency']   = ' with an %supward%s tendency';
    $this->strings['runway_downward_tendency'] = ' with a %sdownward%s tendency';
    $this->strings['runway_no_tendency']       = ' with %sno distinct%s tendency';
    $this->strings['runway_between']           = 'arasýnda ';
    $this->strings['runway_left']              = ' sol';
    $this->strings['runway_central']           = ' merkez';
    $this->strings['runway_right']             = ' sað';
    $this->strings['runway_visibility']        = 'Görüþ ';
    $this->strings['runway_for_runway']        = ' uçak pisti için ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
}

?>