<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text_es.php');

/**
 * Provides all the strings needed by pw_text to produce Portuguese
 * output.
 *
 * @author   Gamboa <gamboa@eth.pt>
 * @link     http://gamboa.eth.pt/  My homepage.
 * @version  pw_text_pt.php,v 1.4 2002/08/28 21:13:40 gimpster Exp
 */
class pw_text_pt extends pw_text_es {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_pt($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Dado não disponiveis para %s%s%s.';
    $this->strings['list_sentences_and']       = ' e ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', e ';
    $this->strings['location']                 = 'Informa&ccedil;&atilde;o meteorol&oacute;gica para %s%s%s.';
    $this->strings['minutes']                  = ' minutos';
    $this->strings['time_format']              = ' A informa&ccedil;&atilde;o foi feita h&aacute; %s, às %s%s%s UTC.';
    $this->strings['time_minutes']             = 'e %s%s%s minutos';
    $this->strings['time_one_hour']            = '%suma%s hora %s';
    $this->strings['time_several_hours']       = '%s%s%s horas %s';
    $this->strings['time_a_moment']            = 'um momento';
    $this->strings['meters_per_second']        = ' m/s';
    $this->strings['miles_per_hour']           = ' milhas por hora';
    $this->strings['meter']                    = ' metros';
    $this->strings['meters']                   = ' metros';
    $this->strings['feet']                     = ' p&eacute;s';
    $this->strings['kilometers']               = ' kil&oacute;metros';
    $this->strings['miles']                    = ' milhas';
    $this->strings['and']                      = ' e ';
    $this->strings['plus']                     = ' adem&aacute; de ';
    $this->strings['with']                     = ' com ';
    $this->strings['wind_blowing']             = ' O vento soprava a uma velocidade de ';
    $this->strings['wind_with_gusts']          = ' com rajadas de ';
    $this->strings['wind_from']                = ' do ';
    $this->strings['wind_variable']            = ' com %sdirec&ccedil;&atilde;o variavel%s';
    $this->strings['wind_varying']             = ', variando entre %s%s%s (%s%s%s) e %s%s%s (%s%s%s)';
    $this->strings['wind_calm']                = ' O ar estava %scalmo%s';
    $this->strings['wind_dir'] = array(
      'norte',
      'norte-nordeste',
      'nordeste',
      'este-nordeste',
      'este',
      'este-sudeste',
      'sudeste',
      'sul-sudeste',
      'sul',
      'sul-sudoeste',
      'sudoeste',
      'oeste-sudoeste',
      'oeste',
      'oeste-noroeste',
      'noroeste',
      'norte-noroeste',
      'norte');
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
      'N'  => 'norte',
      'NE' => 'nordeste',
      'E'  => 'este',
      'SE' => 'sudeste',
      'S'  => 'sul',
      'SW' => 'sudoeste',
      'W'  => 'oeste',
      'NW' => 'noroeste'
      );
    $this->strings['temperature']     = ' A temperatura era ';
    $this->strings['dew_point']       = ', com um ponto de orvalho de ';
    $this->strings['altimeter']       = ' A press&atilde;o atmosf&eacute;rica era ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = ' Havia uma humidade relativa do ';
    $this->strings['feelslike']       = ' A sensa&ccedil;o t&eacute;rmica era de ';
    $this->strings['cloud_group_beg'] = ' Enquanto a nubolosidade, ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = ' O c&eacute;u estava %slimpo%s.';
    $this->strings['cloud_height']    = ' a uma altitude de ';
    $this->strings['cloud_overcast']  = 'c&eacute;u %snublado%s a partir dos ';
    $this->strings['cloud_vertical_visibility'] = 'a %svisibilidade vertical%s era ';
    $this->strings['cloud_condition'] =
      array(
            'SKC' => 'limpo',
            'CLR' => 'limpo',
            'FEW' => 'algumas nuvens',
            'SCT' => 'nuvens dispersas',
            'BKN' => 'nubolosidade descontinua',
            'OVC' => 'nublado');
    $this->strings['cumulonimbus']     = ' tipo cumulonimbos';
    //towering_cumulus son nubes de desarrollo vertical (cumulus congestus)
    $this->strings['towering_cumulus'] = ' tipo c&uacute;mulos';
    $this->strings['cavok']            = ' sem nuvens por baixo de %s e sem presen&ccedil;a de cumulusnimbos';
    $this->strings['currently']        = ' Actualmente ';
    $this->strings['weather']          =
      array(
            '-' => ' leve',
            ' ' => ' moderada ',
            '+' => ' forte ',
            'VC' => '  nas proximidades',
            'PR' => ' parcial',
            'BC' => ' bancos de',
            'MI' => ' baixa',
            'DR' => ' de tendencia descendente',
            'BL' => ' soprando',
            'SH' => ' chuviscos,',
            'TS' => ' trovoada',
            'FZ' => ' geada',
            'DZ' => ' garúa',
            'RA' => ' chuva',
            'SN' => ' neve',
            'SG' => ' neve fina',
            'IC' => ' cristais de gelo',
            'PL' => ' gelo granulado',
            'GR' => ' granizo',
            'GS' => ' granizo pequeno',
            'UP' => ' desconhecido',
            'BR' => ' neblina',
            'FG' => ' nevoa',
            'FU' => ' fumo',
            'VA' => ' cinza vulcanica',
            'DU' => ' poeira',
            'SA' => ' areia',
            'HZ' => ' embaciado',
            'PY' => ' roc&iacute;o',
            'PO' => ' provavel apari&ccedil;&atilde;o de remoinhos de p&oacute; ou areia',
            'SQ' => ' trovoadas',
            'FC' => ' tornados/furac&otilde;es',
            'SS' => ' tempestade de areia ou p&oacute;');
    $this->strings['visibility'] = ' Naquele momento a visibilidade global era ';
    $this->strings['visibility_greater_than']  = 'maior de ';
    $this->strings['visibility_less_than']     = 'menor de ';
    $this->strings['visibility_to']            = ' de ';
    $this->strings['runway_upward_tendency']   = ' com tendencia a %subir%s';
    $this->strings['runway_downward_tendency'] = ' com tendencia a %sbaixar%s';
    $this->strings['runway_no_tendency']       = ' %ssem%s tendencia marcada';
    $this->strings['runway_between']           = 'entre ';
    $this->strings['runway_left']              = ' equerda';
    $this->strings['runway_central']           = ' central';
    $this->strings['runway_right']             = ' direita';
    $this->strings['runway_visibility']        = ' A visibilidade era ';
    $this->strings['runway_for_runway']        = ' para a estrada ';

    /* We run the parent constructor */
    $this->pw_text_es($weather, $input);
  }

}

?>
