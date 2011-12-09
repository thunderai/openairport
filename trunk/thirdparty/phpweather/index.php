<?php
//error_reporting(E_ALL);

/* We store the time */
$start_time = explode(' ', microtime());

require('phpweather.php');
require('pw_utilities.php');

$weather = new phpweather();

$output = '<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="pw_style.css" />
  <title>PHP Weather - test</title>
</head>
<body>

<img src="icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>PHP Weather Test Page</h1>

<p>This is the default test page for PHP Weather. For more
information, please visit <a
href="http://www.phpweather.net">http://www.phpweather.net</a>.</p>
<p>Data is taken from the <a href="http://weather.noaa.gov">National
Weather Service</a> at NOAA.</p>

';

/* We should protect ourself against nasty guys passing quoting
 * characters to CGI variables. We also want to allow lowercase
 * icao/cc specification. It should improve direct linking to our
 * weather website. Someone should directly write
 * ``http://example.com/weather.php?icao=lztt'' if he or she knows
 * particular code for airport (icao). */

if (empty($HTTP_GET_VARS['cc'])) {
  $cc = '';
} else {
  $cc = trim(stripslashes($HTTP_GET_VARS['cc']));
}

if (empty($HTTP_GET_VARS['icao'])) {
  $icao = '';
} else {
  $icao = trim(stripslashes($HTTP_GET_VARS['icao']));
}

$languages = get_languages('text');

if (empty($HTTP_GET_VARS['language']) ||
    !in_array($HTTP_GET_VARS['language'], array_keys($languages))) {
  $language = 'en';
} else {
  $language = stripslashes($HTTP_GET_VARS['language']);
}

if ($icao != '') {
  $weather->set_icao($icao);
  /* icao was passed, we resolve country code */
  $cc_temp = $weather->get_country_code();
  if ($cc_temp === false) {
    /* turn icao off, it is not valid */
    $icao = '';
  } else {
    /* use resolved country code */
    $cc = $cc_temp;
  }
}

/* Always display country selection */
$output .= '<form action="index.php" method="get">' . "\n"
	.'<p>' . get_countries_select($weather, $cc)
	.' <input type="submit" value="'
	.($cc == '' ? 'Submit country' : 'Change country').'" />'
	.'<input type="hidden" name="language" value="'.htmlspecialchars($language).'"> '
	. "</p>\n</form>\n";

if (! empty($cc)) {
  /* Show stations selection for particular country ($cc). */
  $output .= '<form action="index.php" method="get">' . "\n<p>"
          . get_stations_select($weather, $cc, $icao)
          . get_languages_select($language)
          . '<input type="submit" value="Submit location">'
          . "</p>\n</form>\n";
}

if (! empty($icao)) {
  /* We should only display the current weather if we have station ($icao) */
  require(PHPWEATHER_BASE_DIR . "/output/pw_text_$language.php");
  $type = 'pw_text_' . $language;
  $text = new $type($weather);
  
  require(PHPWEATHER_BASE_DIR . "/output/pw_images.php");
  $icons = new pw_images($weather);
  
  $output .= '<p>This is the current weather in ' .
          $weather->get_location() . ":</p>\n<blockquote>\n" .
          $text->print_pretty() . "\n</blockquote>\n" .
          "<p>The matching icons are:</p>\n<blockquote>\n" .
          '<img src="' . $icons->get_sky_image() .
          '" height="50" width="80" border="1" alt="Current weather in ' .
          $weather->get_location() . '" /> ' .
          '<img src="' . $icons->get_winddir_image() .
          '" height="40" width="40" border="1" alt="Current wind in ' .
          $weather->get_location() . '" /> ' .
          '<img src="' . $icons->get_temp_image() .
          '" height="50" width="20" border="1" alt="Current temperature in ' .
          $weather->get_location() . '" />' .
          "\n</blockquote>\n" .
          "<p>The raw METAR is <code>" .
          $weather->get_metar() . "</code></p>\n";
}

if (empty($text)) {
  header('Content-Type: text/html; charset=ISO-8859-1');
} else {
  header('Content-Type: text/html; charset=' . $text->get_charset());
}

echo $output;

$end_time = explode(' ', microtime());

$diff = ($end_time[0] + $end_time[1]) - ($start_time[0] + $start_time[1]);

?>

<p>PHP Weather comes with some documentation that you'll probably want
to see. Choose the format:
[<a href="doc/phpweather.html">html</a>]
[<a href="doc/phpweather.pdf">pdf</a>]
[<a href="doc/phpweather.ps">ps</a>]
[<a href="doc/phpweather.txt">txt</a>].</p>

<p>PHP Weather should be configured to get better performance. You'll
find the <a href="config/index.php">configuration tools here</a>.</p>

<p>Total time used to generate page:
<?php echo number_format($diff * 1000, 0) ?> ms.</p>


</body>
</html>
