<?php

require_once(PHPWEATHER_BASE_DIR . '/output/pw_text.php');

/**
 * Provides all the strings needed by pw_text to produce French
 * output.
 * Contient toutes les chaines nécessaires à pw_text
 * pour produire un texte en Français.
 *
 * @author   Guillaume Petit <gpetit@fr.st>
 * @link     http://gpetit.fr.st  My homepage.
 * @version  pw_text_fr.php,v 1.1 2002/10/23 16:53:40 gimpster Exp
 */
class pw_text_fr extends pw_text {

  /**
   * This constructor provides all the strings used.
   *
   * @param  array  This is just passed on to pw_text().
   */
  function pw_text_fr($weather, $input = array()) {
    $this->strings['charset']                  = 'ISO-8859-1';
    $this->strings['no_data']                  = 'Désolé! Pas d\'infos disponibles pour %s%s%s.';
    $this->strings['list_sentences_and']       = ' et ';
    $this->strings['list_sentences_comma']     = ', ';
    $this->strings['list_sentences_final_and'] = ', et ';
    $this->strings['location']                 = 'Voici le bulletin pour %s%s%s.';
    $this->strings['minutes']                  = ' minutes';
    $this->strings['time_format']              = 'Le bulletin a été fait il y a %s , à %s%s%s UTC.';
    $this->strings['time_minutes']             = 'et %s%s%s minutes';
    $this->strings['time_one_hour']            = '%sune%s heure %s';
    $this->strings['time_several_hours']       = '%s%s%s heures %s';
    $this->strings['time_a_moment']            = 'un moment';
    $this->strings['meters_per_second']        = ' mètres par seconde';
    $this->strings['miles_per_hour']           = ' miles par heure';
    $this->strings['meter']                    = ' mètres';
    $this->strings['meters']                   = ' mètres';
    $this->strings['feet']                     = ' pieds';
    $this->strings['kilometers']               = ' kilomètres';
    $this->strings['miles']                    = ' miles';
    $this->strings['and']                      = ' et ';
    $this->strings['plus']                     = ' plus ';
    $this->strings['with']                     = ' avec ';
    $this->strings['wind_blowing']             = 'Le vent soufflait à la vitesse de ';
    $this->strings['wind_with_gusts']          = ' avec des rafales jusq\'à ';
    $this->strings['wind_from']                = ' de ';
    $this->strings['wind_variable']            = ' de direction %svariable%.';
    $this->strings['wind_varying']             = ', variant entre %s%s%s (%s%s&deg;%s) et %s%s%s (%s%s&deg;%s)';
    $this->strings['wind_calm']                = 'Le vent était %scalme%s';
    $this->strings['wind_dir'] = array(
	'Nord',
	'Nord/Nord-est',
	'Nord-est',
	'Est/Nord-est',
	'Est',
	'Est/Sud-est',
	'Sud-est',
	'Sud/Sud-est',
	'Sud',
	'Sud/Sud-ouest',
	'Sud-ouest',
	'Ouest/Sud-ouest',
	'Ouest',
	'Ouest/Nord-ouest',
	'Nord-ouest',
	'Nord/Nord-ouest',
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
      'SSO',
      'SO',
      'OSO',
      'O',
      'ONO',
      'NO',
      'NNO',
      'N');
    $this->strings['wind_dir_short_long'] = array(
      'N'  => 'nord',
      'NE' => 'nord-est',
      'E'  => 'est',
      'SE' => 'sud-est',
      'S'  => 'sud',
      'SO' => 'sud-ouest',
      'O'  => 'ouest',
      'NO' => 'nord-ouest'
      );
    $this->strings['temperature']     = 'La température était de ';
    $this->strings['dew_point']       = ', avec un point de rosée à ';
    $this->strings['altimeter']       = 'La pression atmosphérique était de ';
    $this->strings['hPa']             = ' hPa';
    $this->strings['inHg']            = ' inHg';
    $this->strings['rel_humidity']    = 'L\'humidité relative était de ';
    $this->strings['feelslike']       = 'La température ressentie était de ';
    $this->strings['cloud_group_beg'] = 'Il y avait ';
    $this->strings['cloud_group_end'] = '.';
    $this->strings['cloud_clear']     = 'Le ciel était %sclear%s.';
    $this->strings['cloud_height']    = ' de nébulosité à une hauteur de ';
    $this->strings['cloud_overcast']  = 'Le ciel était %snuageux%s à partir d\'une hauteur de ';
    $this->strings['cloud_vertical_visibility'] = 'La %svisibilité verticale%s était de ';
    $this->strings['cloud_condition'] =
      array(
	    'SKC' => 'clair',
	    'CLR' => 'clair',
	    'FEW' => '1 à 2/8è',
	    'SCT' => '3 à 4/8è',
	    'BKN' => '5 à 7/8è',
	    'OVC' => '8/8è');
    $this->strings['cumulonimbus']     = ' cumulonimbus';
    $this->strings['towering_cumulus'] = ' cumulus congestus';
    $this->strings['cavok']            = ' pas de nuages en-dessous de %s et pas de cumulonimbus';
    $this->strings['currently']        = 'Actuellement ';
    $this->strings['weather']          =
      array(
	    '-' => ' léger/legère',
	    ' ' => ' moderé(e) ',
	    '+' => ' fort(e) ',
	    'VC' => ' à proximité',
	    'PR' => ' partiel(le)',
	    'BC' => ' bancs',
	    'MI' => ' peu dense',
	    'DR' => ' dérivant',
	    'BL' => ' se développant',
	    'SH' => ' averses de',
	    'TS' => ' orage',
	    'FZ' => ' givrant',
	    'DZ' => ' bruine',
	    'RA' => ' pluie',
	    'SN' => ' neige',
	    'SG' => ' grésil',
	    'IC' => ' cristaux de glace',
	    'PL' => ' granules de glace',
	    'GR' => ' grêle',
	    'GS' => ' grêle fine',
	    'UP' => ' inconnu',
	    'BR' => ' brume',
	    'FG' => ' bruillard',
	    'FU' => ' fumée',
	    'VA' => ' cendre volcanique',
	    'DU' => ' poussière répandue',
	    'SA' => ' sable',
	    'HZ' => ' brume',
	    'PY' => ' gouttes',
	    'PO' => ' tourbillons de sable',
	    'SQ' => ' grains',
	    'FC' => ' tornade',
	    'SS' => ' tempête de sable/poussière');
    $this->strings['visibility'] = 'La visibilité globale était de ';
    $this->strings['visibility_greater_than']  = 'supérieure à ';
    $this->strings['visibility_less_than']     = 'inférieure à ';
    $this->strings['visibility_to']            = ' à ';
    $this->strings['runway_upward_tendency']   = ' avec tendance à l\'%amélioration%s';
    $this->strings['runway_downward_tendency'] = ' avec tendance à la %sdéterioration%s';
    $this->strings['runway_no_tendency']       = ' sans tendance %sdistinctive%s';
    $this->strings['runway_between']           = 'entre ';
    $this->strings['runway_left']              = ' gauche';
    $this->strings['runway_central']           = ' centrale';
    $this->strings['runway_right']             = ' droite';
    $this->strings['runway_visibility']        = 'La visibilité était de ';
    $this->strings['runway_for_runway']        = ' pour la piste ';

    /* We run the parent constructor */
    $this->pw_text($weather, $input);
  }
}

?>
