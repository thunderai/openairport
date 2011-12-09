<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="pw_style.css" />
  <title>PHP Weather - Test Page</title>
</head>
<body>

<img src="icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>PHP Weather Test Page</h1>

<p>You can use this page to test a specific METAR report. Enter the
report below, select a language and see how PHP Weather handles the
report:</p>

<?php
//error_reporting(E_ALL);

/* We need the GET variables: */
extract($HTTP_GET_VARS);

/* Load PHP Weather */
require('phpweather.php');
/* Load utilities to make forms */
require('pw_utilities.php');

if (empty($language)) $language = 'en';

$weather = new phpweather();

?>

<form action="test.php" method="GET">
<p>Metar: <input type="text" name="metar" size="60"
 value="<?php if (!empty($metar)) echo $metar; ?>"></p>
<p>Language: <?php echo get_languages_select($language); ?>
<input type="submit"></p>
</form>

<?php
if (!empty($metar)) {

  $weather->set_metar($metar);
  
  require(PHPWEATHER_BASE_DIR . "/output/pw_text_$language.php");
  require(PHPWEATHER_BASE_DIR . "/output/pw_images.php");
  
  $type = 'pw_text_' . $language;
  $text = new $type($weather);

  echo "<h2>Report made by <code>$type</code></h2>\n";
  
  echo "<p>\n" . $text->print_pretty() . "</p>\n";

  echo "<h2>Images selected by <code>pw_images</code></h2>\n";

  $icons = new pw_images($weather);
  echo '<p><img src="'.$icons->get_sky_image().'" /> ';
  echo '<img src="'.$icons->get_winddir_image().'" /> ';
  echo '<img src="'.$icons->get_temp_image().'" /></p>';

  echo "<h2>The decoded METAR follows</h2>\n";

  echo "<pre>\n";
  print_r($weather->decode_metar());
  echo "</pre>\n";

}

?>

</body>
</html>
