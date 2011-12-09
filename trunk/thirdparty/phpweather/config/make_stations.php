<?php

if (!empty($HTTP_POST_VARS['make_stations'])) {

  header('Content-type: application/octet-stream');
  header('Content-Disposition: attachment; filename="stations.csv"');

  define('PHPWEATHER_BASE_DIR', dirname(__FILE__) . '/..');
  require_once(PHPWEATHER_BASE_DIR . '/db_layer.php');
  
  $db = new db_layer();

  $countries = $db->db->get_countries();

  echo "# Comments start with *one* hash-mark (#). The countries are\n";
  echo "# surrounded by *two* marks. They start with a ISO 3166-1-Alpha-2 code\n";
  echo "# taken from\n";
  echo "#\n";
  echo "# http://www.iso.org/iso/en/prods-services/iso3166ma/index.html\n";
  echo "#\n";
  echo "# Original list made by Sven-Erik Andersen <sven_erik@andersen.as>.\n\n";

  foreach ($countries as $cc => $country) {
    $icaos = $db->db->get_icaos($cc, $country);
    asort($icaos);

    echo "\n## $cc;$country ##\n";

    foreach ($icaos as $icao => $name) {
      echo "$icao;$name\n";
    }
    
  }
  
  exit();

}
?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../pw_style.css" />
  <title>Stations Database Rebuilder for PHP Weather</title>
</head>
<body>

<img src="../icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>Stations Database Rebuilder for PHP Weather</h1>

<p>You can use this page to regenerate the <code>stations.csv</code>
file for PHP Weather. This file contains the names for the stations
known to PHP Weather in a human-readable format. It's only used when
you build the files/tables with the <a href="make_db.php">Database
Builder</a>.</p>

<p>You'll use this page if you've made massive changes to the list of
stations in your database, but haven't updated the
<code>stations.csv</code> file accordingly. You can then add the
updated <code>stations.csv</code> file as a <a
href="https://sourceforge.net/tracker/?atid=377954&amp;group_id=23245&amp;func=browse">patch</a>.</p>

<p>Click the button below to download the updated
<code>stations.csv</code>:</p>

<form action="make_stations.php" method="post">
<input type="submit" name="make_stations" value="Download stations.cvs" />
</form>

</body>
</html>
