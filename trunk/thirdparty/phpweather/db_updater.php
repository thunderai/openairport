<?php
/* This is plain text, not HTML: */
header ('Content-type: text/plain');
error_reporting(E_ALL);

function print_usage() {
  echo "Usage:\n";
  echo "  From the commandline: db_updater.php /path/to/new/metars or\n";
  echo "  In a webbrowser:      db_updater.php?filename=/path/to/new/metars\n";
}


if (!empty($filename) &&
    file_exists($filename) &&
    ereg('[012][0-9]Z.TXT', $filename)) {
  $fn = $filename;
} elseif (!empty($argv[0]) &&
           file_exists($argv[0]) &&
           ereg('[012][0-9]Z.TXT', $argv[0])) {
  $fn = $argv[0];
} elseif (!empty($argv[1]) &&
           file_exists($argv[1]) &&
           ereg('[012][0-9]Z.TXT', $argv[1])) {
  $fn = $argv[1];
} else {
  print_usage();
  exit();
}

define('PHPWEATHER_BASE_DIR', dirname(__FILE__));
require_once(PHPWEATHER_BASE_DIR . '/db_layer.php');

$db = new db_layer(array());
if ($db->db->connect()) {
  echo "Connected to database - updating METARs...\n";
  $db->db->update_all_metars($fn);
  echo "Done - database updated.\n";
} else {
  echo "An error occurred while connecting to the database!\n";
}

?>
