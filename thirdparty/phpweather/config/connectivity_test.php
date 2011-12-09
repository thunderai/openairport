<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../pw_style.css" />
  <title>Connectivity Test for PHP Weather</title>
</head>
<body>

<?php
  
  function success($msg) {
    echo "<p><b><span style=\"color: green\">Success</span>:</b> $msg</p>\n";
  }

  function error($msg) {
    echo "<p><b><span style=\"color: red\">Error</span>:</b> $msg</p>\n";
  }

?>

<img src="../icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>Connectivity Test for PHP Weather</h1>

<p>This page will test the connection from this webserver to the
      NWS.</p>

<h2>Test with <code>file()</code></h2>

<?php

$dir = '/data/observations/metar/stations/EKYT.TXT';

if (@file('http://weather.noaa.gov/pub' . $dir)) {
  success('Fetched METAR from <code>http://weather.noaa.gov</code>.');
} else {
  error('Could not fetch METAR from <code>http://weather.noaa.gov</code>.');
}

if (@file('ftp://weather.noaa.gov' . $dir)) {
  success('Fetched METAR from <code>ftp://weather.noaa.gov</code>.');
} else {
  error('Could not fetch METAR from <code>ftp://weather.noaa.gov</code>.');
}

?>

<h2>Test with <code>fsockopen()</code></h2>

<?php

$host = 'weather.noaa.gov';
$path = "/pub/data/observations/metar/stations/EKYT.TXT";

if (!empty($HTTP_GET_VARS['proxy_host']) &&
    !empty($HTTP_GET_VARS['proxy_port'])) {
  $use_proxy = true;
  $proxy_host = $HTTP_GET_VARS['proxy_host'];
  $proxy_port = $HTTP_GET_VARS['proxy_port'];
  $fp = @fsockopen($proxy_host, $proxy_port);
  $location = 'http://' . $host . $path;
} else {
  $use_proxy = false;
  $proxy_host = '';
  $proxy_port = '';
  $fp = @fsockopen($host, 80);
  $location = $path;
}

$request =
  "GET $location HTTP/1.1\r\n" .
  "If-Modified-Since: Sat, 29 Oct 1994 09:00:00 GMT\r\n" .
  "Pragma: no-cache\r\n".
  "Cache-Control: no-cache\r\n" .
  "Host: $host\r\n" .
  "Content-Type: text/html\r\n" .
  "Connection: Close\r\n\r\n";

if ($fp) {
  if ($use_proxy)
    success("Connection established to <code>$host</code> " .
            "via <code>$proxy_host:$proxy_port</code>.");
  else
    success("Connection established to <code>$host:80</code>.");

  fputs($fp, $request);
  /* We check the status line */
  if (strpos($line = fgets($fp, 1024), '200 ')) {
    success('Got code "200 OK" from server.');
  } else {
    error('Got "' . $line . '" from server.');
  }
  fclose($fp);
} else {

  if ($use_proxy)
    error("Unable to establish connection to <code>$host</code> " .
          "via <code>$proxy_host:$proxy_port</code>.");
  else
    error("Unable to establish connection to <code>$host:80</code>.");

}

?>

<p>If you have to use a proxy for outbound connections, then please
specify the hostname and port to use:</p>

<form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF'] ?>"
method="GET">

<p>Proxy host: <input name="proxy_host" type="text" value="<?php echo
$proxy_host ?>" size="16" />&nbsp;<code>:</code>&nbsp;<input
name="proxy_port" type="text" value="<?php echo $proxy_port ?>"
size="5" /> <input type="submit" value="Update" /> <input type="reset" /></p>

</form>

</body>
</html>
