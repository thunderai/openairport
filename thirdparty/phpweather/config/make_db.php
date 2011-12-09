<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../pw_style.css" />
  <title>Database Builder for PHP Weather</title>
</head>
<body>

<img src="../icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>Database Builder for PHP Weather</h1>

<p>This is the tool you use to create the tables used by PHP Weather.
PHP Weather uses the tables for several things: the lists of countries
and the stations in each country is stored in two tables, and then the
METARs are cached in a third table.</p>

<p>If you want to use a different database than the default
<code>null</code> database, then you should start by making a
<code>defaults.php</code> file using the <a
href="make_config.php">Configuration Builder</a>. After you've made
the file and uploaded it to your webserver, then you can proceed on
this page.</p>

<h2>Create Tables</h2>

<p>If you're installing PHP Weather for the first time, then you'll
need to make the tables. <b>This will delete any tables with the same
name in the database!</b></p>

<p>You can also use this button to update the list of stations from
<code>stations.cvs</code>. The list changes from time to time as we
discover new stations and when old stations disappear. This will
remove any cached METARs from the database, but they would have been
removed sooner or later anyway, so this isn't a problem.</p>

<form action="make_db.php" method="post">
<input type="submit" name="do_sql" value="Create or Recreate Tables" />
</form>

<?php

if (!empty($HTTP_POST_VARS['do_sql'])) {
  echo "<blockquote>\n";
  define('PHPWEATHER_BASE_DIR', realpath(dirname(__FILE__) . '/..'));
  require_once(PHPWEATHER_BASE_DIR . '/db_layer.php');
  
  $db = new db_layer();
  if ($db->db->create_tables()) {
    $num_rows = 0;
    $num_countries = 0;
    echo "<p>The tables have been created. They will now be " .
      "filled with data, please wait...</p>\n";
    flush();
    $fp = fopen(PHPWEATHER_BASE_DIR . '/stations.csv', 'r');
    while ($row = fgets($fp, 1024)) {
      $row = trim($row);
      if (substr($row, 0, 2) == '##' && substr($row, -2) == '##') {
        /* We've found a country */
        $cc = substr($row, 3, 2); // The country-code.
        $country = substr($row, 6, -3); // The name of the country.
        $countries[$cc] = $country;
        $num_countries++;
        //echo "<p>Now processing stations in $country.</p>\n";
      } elseif (!empty($row) && $row[0] != '#') {
        list($icao, $name) = explode(';', $row, 2);
        $num_rows++;
        $data[$cc][$icao] = $name;
      }
    }
    $db->db->insert_stations($data, $countries);
    
    echo "<p>Data about <b>$num_rows</b> stations from " .
      "<b>$num_countries</b> countries were inserted.</p>\n";
  } else {
    echo "<p>There was a problem with the creation of the tables!</p>\n"; 
  }
  echo "</blockquote>\n";
}
?>

</body>
</html>
