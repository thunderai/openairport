<?php

/*
Call with a icao parameter i.e. test2.php?icao=KSFO

You can add time_from and time_to to get only parts of the taf 
i.e. test2.php?icao=CYUL&time_from=20030920220000&time_to=20030920230000
*/

//error_reporting(E_ALL);

/* We need the GET variables: */
//extract($HTTP_GET_VARS);

/* Load PHP Weather */
require('phpweather.php');

if (empty($language)) $language = 'en';

$weather = new phpweather();
// $weather->properties['verbosity'] = 5;
//$icao = "KATY";

if (!empty($icao)) {

    $weather->set_icao($icao);   

    $language = 'en';
    require("/output/pw_text_$language.php");
    $type = 'pw_text_' . $language;
    $text = new $type($weather);
  
    require("/output/pw_images.php");
    $icons = new pw_images($weather);


    echo "METAR for $icao : ".$weather->get_metar()."<br>\n";
 echo "<br>Decoded METAR:<pre>";
 $weather->decode_metar();
print_r( $weather->decoded_metar );
echo "</pre><br>\n";

   //  echo "time:".$weather->decoded_metar["time"]."<br>";
    // echo "time:".tms_unix2date($weather->decoded_metar["time"])."<br>";


   // echo "TAF for $icao : ".$weather->get_taf()."<br>\n";   
   // echo "<br>Print TAF:<br><br>";
  //  if(empty($time_from) || empty($time_to) || $time_from=="" ||  $time_to=="") 
  //    $text->print_taf();
  //  else $text->print_taf($time_from,$time_to);
   // echo "<br>\n";

  //  echo "taf: <pre>";print_r($weather->taf);echo "</pre><br>";
   //       $weather->decode_taf();
  //  echo "decoded_taf: <pre>";print_r($weather->decoded_taf);echo "</pre><br>";

  
}

?>

</body>
</html>
