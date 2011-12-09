<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce Spanish
 * output.
 *
 * @author   Jess Peas <jpc@educaplus.org>
 * @link     http://www.educaplus.org/  My homepage.
 * @version  pw_text_es.php,v 1.4 2002/08/28 21:13:40 gimpster Exp
 */
class pw_text_es extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_es($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Datos no disponibles para %s%s%s.';
    $this->strings['list_sentences_and']       = ' y ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', y ';
    $this->strings['location']                 = 'Informe meteorol&oacute;gico para %s%s%s.';
    $this->strings['minutes']                  = ' minutos';
    $this->strings['time_format']              = ' El informe se hizo hace %s, a las %s%s%s UTC.';
    $this->strings['time_minutes']             = 'y %s%s%s minutos';
    $this->strings['time_one_hour']            = '%suna%s hora %s';
    $this->strings['time_several_hours']       = '%s%s%s horas %s';
    $this->strings['time_a_moment']            = 'un momento';
    $this->strings['meters_per_second']        = ' m/s';
    $this->strings['miles_per_hour']           = ' millas por hora';
    $this->strings['meter']                    = ' metros';
    $this->strings['meters']                   = ' metros';
    $this->strings['feet']                     = ' pies';
    $this->strings['kilometers']               = ' kil&oacute;metros';
    $this->strings['miles']                    = ' millas';
    $this->strings['and']                      = ' y ';
    $this->strings['plus']                     = ' adem&aacute; de ';
    $this->strings['with']                     = ' con ';
    $this->strings['wind_blowing']             = ' El viento soplaba a una velocidad de ';
    $this->strings['wind_with_gusts']          = ' con r&aacute;agas de ';
    $this->strings['wind_from']                = ' del ';
    $this->strings['wind_variable']            = ' con %sdirecci&oacute;n variable%s';
    $this->strings['wind_varying']             = ', variando entre %s%s%s (%s%s%s) y %s%s%s (%s%s%s)';
    $this->strings['wind_calm']                = ' El aire estaba en %scalma%s';
    $this->strings['wind_dir'] = array(
      'norte',
      'norte-noreste',
      'noreste',
      'este-noreste',
      'este',
      'este-sureste',
      'sureste',
      'sur-sureste',
      'sur',
      'sur-suroeste',
      'suroeste',
      'oeste-suroeste',
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
      'NE' => 'noreste',
      'E'  => 'este',
      'SE' => 'sureste',
      'S'  => 'sur',
      'SW' => 'suroeste',
      'W'  => 'oeste',
      'NW' => 'noroeste'
      );
    $this->strings['temperature']     = ' La temperatura era ';
    $this->strings['dew_point']       = ', con un punto de roc&iacute;o de ';
    $this->strings['altimeter']       = ' La presi&oacute;n atmosf&eacute;rica era ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = ' Hab&iacute;a una humedad relativa del ';
    $this->strings['feelslike']       = ' La sensaci&oacute;n t&eacute;rmica era de ';
    $this->strings['cloud_group_beg'] = ' En cuanto a la nubosidad, ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = ' El cielo estaba %sdespejado%s.';
    $this->strings['cloud_height']    = ' a una altitud de ';
    $this->strings['cloud_overcast']  = 'cielo %snublado%s a partir de los ';
    $this->strings['cloud_vertical_visibility'] = 'la %svisibilidad vertical%s era ';
    $this->strings['cloud_condition'] =
      array(
            'SKC' => 'despejado',
            'CLR' => 'despejado',
            'FEW' => 'algunas nubes',
            'SCT' => 'nubes dispersas',
            'BKN' => 'nubosidad discontinua',
            'OVC' => 'nublado');
    $this->strings['cumulonimbus']     = ' tipo cumulonimbos';
    //towering_cumulus son nubes de desarrollo vertical (cumulus congestus)
    $this->strings['towering_cumulus'] = ' tipo c&uacute;mulos';
    $this->strings['cavok']            = ' sin nubes por debajo de %s y sin presencia de cumulusnimbos';
    $this->strings['currently']        = ' Actualmente ';
    $this->strings['weather']          =
      array(
            '-' => ' leve',
            ' ' => ' moderada ',
            '+' => ' fuerte ',
            'VC' => '  en las proximidades',
            'PR' => ' parcial',
            'BC' => ' bancos de',
            'MI' => ' baja',
            'DR' => ' de tendencia descendente',
            'BL' => ' soplando',
            'SH' => ' chubascos,',
            'TS' => ' tormenta',
            'FZ' => ' helada',
            'DZ' => ' gar&uacute;a',
            'RA' => ' lluvia',
            'SN' => ' nieve',
            'SG' => ' cinarra',
            'IC' => ' cristales de hielo',
            'PL' => ' hielo granulado',
            'GR' => ' granizo',
            'GS' => ' granizo peque&ntilde;o',
            'UP' => ' desconocido',
            'BR' => ' neblina',
            'FG' => ' niebla',
            'FU' => ' humo',
            'VA' => ' ceniza volc�ica',
            'DU' => ' polvareda',
            'SA' => ' arena',
            'HZ' => ' calima',
            'PY' => ' roc&iacute;o',
            'PO' => ' probable aparici&oacute;n de remolinos de polvo o arena',
            'SQ' => ' turbonadas',
            'FC' => ' trombas/tornados/huracanes',
            'SS' => ' tempestad de arena o polvo');
    $this->strings['visibility'] = ' En aquel momento la visibilidad global era ';
    $this->strings['visibility_greater_than']  = 'mayor de ';
    $this->strings['visibility_less_than']     = 'menor de ';
    $this->strings['visibility_to']            = ' de ';
    $this->strings['runway_upward_tendency']   = ' con tendencia a %subir%s';
    $this->strings['runway_downward_tendency'] = ' con tendencia a %sbajar%s';
    $this->strings['runway_no_tendency']       = ' %ssin%s tendencia marcada';
    $this->strings['runway_between']           = 'entre ';
    $this->strings['runway_left']              = ' izquierda';
    $this->strings['runway_central']           = ' central';
    $this->strings['runway_right']             = ' derecha';
    $this->strings['runway_visibility']        = ' La visibilidad era ';
    $this->strings['runway_for_runway']        = ' para la pista ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
 /**
   * Function used to parse a weather-group. This one puts adjective after noun.
   *
   * @param   array    The weather-group to be parsed. The keys of the
   *                   weather-group tells you which kind of weather
   *                   you're dealing with. The value of the array is
   *                   the unparsed codes, like 'RA' for 'rain' etc.
   *
   * @access  private
   * @return  string   The string used in the pretty-print.
   */
  function parse_weather_group($weather_group) {
    if (empty($weather_group)) {
      return;
    }

    $output = '';

    if (!empty($weather_group['descriptor'])) {

      /* The descriptor should be filled in */

      if ($weather_group['descriptor'] == 'TS' &&
          !empty($weather_group['precipitation'])) {

        /* Special case for thunderstorms. They use the extra
         * word 'with' between the descriptor (which would be
         * 'thunderstorm' in this case) and the precipitation.
         * But this is only true if there's also precipitation.
         */

        $output .= $this->strings['weather'][$weather_group['descriptor']] .
          $this->strings['with'];
      } else {
        $output .= $this->strings['weather'][$weather_group['descriptor']];
      }
    }

    /* There can only be one of the next three items. */
    if (!empty($weather_group['precipitation'])) {
      // precipitation can be more than one kind - need to check for
      // this. explode precipitation into chunks of length 2
      $precip = explode(' ', trim(chunk_split($weather_group['precipitation'], 2, ' ')));
      foreach($precip AS $ppnow){
        $output .= $this->strings['weather'][$ppnow] . ', ';
      }
      $output = substr($output,0,-2); // trim off last comma
    } elseif (!empty($weather_group['obscuration'])) {
      $output .= $this->strings['weather'][$weather_group['obscuration']];
    } elseif (!empty($weather_group['other'])) {
      $output .= $this->strings['weather'][$weather_group['other']];
    }

    /* If the intensity is non-empty, we just add it. If not, it could
     * mean that we're dealing with some 'moderate' precipitation.
     * If so, 'precipitation' can't be empty.
     */
    if (!empty($weather_group['intensity'])) {
      $output .= $this->strings['weather'][$weather_group['intensity']];
    } elseif (!empty($weather_group['precipitation'])) {
      $output .= $this->strings['weather'][' '];
    }


    /* 'proximity' can only be 'VC'. We test for it here instead of
     *  earlier because it should be put last.
     */
    if (!empty($weather_group['proximity'])) {
      $output .= $this->strings['weather'][$weather_group['proximity']];
    }
    return $output;
  }

}

?>
