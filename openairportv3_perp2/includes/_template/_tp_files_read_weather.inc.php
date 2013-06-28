<?php
// This function will load the weather.txt file into a string for use by another form
function readweathertxt() {

		$myFile = "reports_weather\weather.txt";
		$fh = fopen($myFile, 'r');
		
		$weatherDatastring = fread($fh, filesize($myFile));
		fclose($fh);
		
		//echo $weatherDatastring;
		
		return $weatherDatastring;

	}
?>
