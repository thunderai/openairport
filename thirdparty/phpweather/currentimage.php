<?php
/*
 *    currentimage.php
 *    Return the current weather icon directly. - Can be used from 
 *    HTML rather than PHP files.   
 *
 *    Use: <img src="currentimage.php?icao=abcd" /> in your html
 *
*/

error_reporting(E_NONE);

require('phpweather.php');
require(PHPWEATHER_BASE_DIR . "/output/pw_images.php");

$weather = new phpweather();
$weather->set_icao($icao);

$icons = new pw_images($weather);
header('Content-Type: image/png');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header("Pragma: no-cache");                          // HTTP/1.0
readfile($icons->get_sky_image()); 
?>