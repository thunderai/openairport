<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../pw_style.css" />
  <title>Configuration of PHP Weather</title>
</head>
<body>

<img src="../icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>Configuration of PHP Weather</h1>

<p>This is the place where you configurate PHP Weather. You'll need to
complete two steps to fully utilise PHP Weather: make a local
configuration file with information about which database to use, and
then create the database.</p>

<p>It's save to leave these pages unprotected as they wont do anything
destructive. You cannot actually change the configuration of PHP
Weather using these pages, instead you download a new
configuration-file which you'll have to upload to the webserver before
it becomes effective. The <a href="make_db.php">Database Builder</a>
will also just recreate the existing tables - nothing permanent will
be deleted.</p>

<dl>
  <dt><a href="make_config.php">Configuration Builder</a></dt>
  
  <dd>
    <p>Use this page to build a custom configuration-file for PHP
    Weather.</p>
  </dd>
    
  <dt><a href="make_db.php">Database Builder</a></dt>
  
  <dd>
    <p>After you've made a custom configuration using the link
    above, you'll need to use this page to create the database and fill
    it with data.</p>
  </dd>
  
  <dt><a href="make_stations.php">Regenerate Stations Database</a></dt>

  <dd>
    <p>Use this page to update the file <code>stations.csv</code>
    with the data from your database. This file contains a list of
    stations in a human-readable format and it it used by the <a
    href="make_db.php">Database Builder</a> to populate the database
    with data.</p>
  </dd>
  
  <dt><a href="speed_test.php">Speed Test</a></dt>

  <dd><p>If you've configured PHP Weather to use a database, then you
    might be interested in knowing how long it takes to access the
    data in the database. This is what this page is for, it will
    meassure the time it takes for PHP Weather to retrieve and
    display a large number of METARs.</p>
    
    <p>If you have several different databases available to you, then
    you can compare them using this page.</p>
  </dd>

  <dt><a href="connectivity_test.php">Connectivity Test</a></dt>

  <dd><p>If you're having problems getting data into PHP Weather, then
    this page might help you with the troubleshooting. It will try to
    connect to the NWS to download a METAR the same way PHP Weather
    does, but here you'll get better error messages.</p>
  </dd>

</dl>

</body>
</html>
