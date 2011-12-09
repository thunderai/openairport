<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../pw_style.css" />
  <title>PHP Weather Speed Test</title>
</head>
<body>

<img src="../icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>PHP Weather Speed Test</h1>

<p>If you've configured PHP Weather to use a database, then you might
be interested in knowing how long it takes to access the data in the
database. This is what this page is for, it will meassure the time it
takes for PHP Weather to retrieve and display a large number of
METARs.</p>

<p>If you have several different databases available to you, then you
can compare them using this page.</p>

<?php
if (empty($HTTP_GET_VARS['batches'])) {
  $batches = 1;
} else {
  $batches = $HTTP_GET_VARS['batches'];
}
$count = $batches*32;
?>

<p>We will now time PHP Weather while it retrieves and parses <?php
echo $count ?> different METARs. This will take a long time at first
because PHP Weather has to retrieve the METARs from the Internet, but
the second time you use this page it should go much faster because the
METARs can be retrieved from the database - that is, if you've
configured PHP Weather to use a database.</p>

<p>Select the number of METARs to use:
<a href="<?php echo $PHP_SELF ?>?batches=1">32</a>,
<a href="<?php echo $PHP_SELF ?>?batches=2">64</a>,
<a href="<?php echo $PHP_SELF ?>?batches=4">128</a>, or
<a href="<?php echo $PHP_SELF ?>?batches=8">256</a>.</p>

<?php
error_reporting(E_ALL);

/* This is 256 more or less randomly picked ICAOs from stations.csv.
   The ICAOs are grouped in batches of 32: */
$icaos = array(
  array('DABS', 'SARC', 'SARE', 'UGEE', 'YSDU', 'LOWG', 'VGZR', 'EBCV',
        'TXKF', 'SLRY', 'SLVM', 'FBTE', 'SBBR', 'SBFN', 'SBLO', 'SBPP',
        'SBSC', 'SBUR', 'VDPP', 'CYZS', 'CYGL', 'CYZT', 'CYYN', 'MWCR',
        'SCTE', 'ZGSZ', 'SKCG', 'FZAA', 'LDSP', 'MUMZ', 'LKMT', 'EKSN'),
  array('HDAM', 'SEQU', 'MSSS', 'EFKK', 'LFSB', 'LFLB', 'LFOH', 'LFSF',
        'LFPO', 'LFCG', 'SOCA', 'EDDT', 'EDFH', 'EDLN', 'LXGB', 'LGKR',
        'LGZA', 'MGGT', 'MHCA', 'MHYR', 'VECC', 'WRRR', 'OIMM', 'LIEA',
        'LIMU', 'LIPK', 'LIBN', 'LIMN', 'LIMH', 'LIPQ', 'LIPI', 'RJCA'),
  array('RJFF', 'RJDB', 'RJSU', 'RJOM', 'ROAH', 'RJKB', 'RJNY', 'RJOR',
        'RJTY', 'HKGA', 'HKMB', 'HKWJ', 'RKPK', 'RKPU', 'HLLT', 'WMKK',
        'FIMP', 'MMCS', 'MMHO', 'MMMY', 'MMSD', 'MMPN', 'GMMN', 'EHKD',
        'EHVL', 'NZWN', 'ENAN', 'ENFL', 'ENLI', 'ENFB', 'ENZV', 'OOSA'),
  array('MPMG', 'SPEO', 'SPJA', 'EPGD', 'LPLA', 'OTBD', 'UHMD', 'ULLI',
        'FPST', 'OEGN', 'OERY', 'GOTT', 'AGGH', 'FAPB', 'LEGE', 'LEMG',
        'LEZL', 'FDMS', 'ESSB', 'LSZH', 'RCFN', 'RCDC', 'HTIR', 'HTSO',
        'TTCP', 'DTTX', 'LTBG', 'LTBJ', 'LTBQ', 'UKLL', 'EGAA', 'EGSC'),
  array('EGLF', 'EGKK', 'EGHD', 'EGBJ', 'KABI', 'KALS', 'KAIA', 'PAKP',
        'KAIG', 'KHZY', 'KAUO', 'KBFL', 'KBOW', 'KBPT', 'KVBT', 'KBHM',
        'KBNW', 'KBDR', 'KBCE', 'KBRL', 'KP38', 'PACZ', 'KCID', 'KCRW',
        'KPWK', 'KLUK', 'KCQC', 'KCOS', 'KCCR', 'KCVO', 'K0V1', 'KDMA'),
  array('KDFI', 'KDET', 'KDOV', 'KDYR', 'KECG', 'PAEM', 'KEVM', 'KFNB',
        'KFIT', 'KFNL', 'KFLV', 'KFSM', 'KFKL', 'KGAG', 'KAKH', 'KGLD',
        'KGPZ', 'KGMU', 'PAGS', 'K4HV', 'KHDN', 'KHKY', 'KHDO', 'KHOU',
        'KHCD', 'KEYE', 'KJAC', 'KJHW', 'PHOG', 'KEAR', 'KNQX', 'KTYS'),
  array('KLCH', 'KLNS', 'KLWM', 'KLWS', 'KLIT', 'KLAX', 'KHFF', 'KP75',
        'KMWA', 'KMHR', 'KMCB', 'KP28', 'PAMR', 'KMIV', 'KMIB', 'KMLI',
        'KMXO', 'KVAY', 'KMIE', 'KAPC', 'KHVN', 'KEWR', 'PAOM', 'PAQT',
        'KPWA', 'KORE', 'KOWA', 'KPAO', 'KSFZ', 'PAPG', 'KPIB', 'KPIH'),
  array('PAAP', 'KPTW', 'KPGD', 'KRWL', 'KRIC', 'KRKS', 'KROX', 'KE74',
        'K27U', 'KMYF', 'KSFM', 'PASA', 'KSEG', 'PASY', 'KBFW', 'KU78',
        'KSPF', 'KPHN', 'KSBS', 'KTCM', 'KTPL', 'PATG', 'KTVC', 'KTCL',
        'PAVD', 'KVEL', 'PAFB', 'KRYV', 'KWYS', 'PAWR', 'KILL', 'KINK'));

echo "<h2>Processing " . ($batches * 32) . " METARs</h2>\n";
flush();

$start_time = explode(' ', microtime());

require_once('../phpweather.php');
require_once(PHPWEATHER_BASE_DIR . '/output/pw_text_en.php');

for ($i = 0; $i < $batches; $i++) {
  for ($j = 0; $j < 32; $j++) {
    /* We create two new objects: */
    $weather = new phpweather(array('always_use_db' => true,
                                    'icao'          => $icaos[$i][$j],
                                    'db_pconnect'   => true));
    $text = new pw_text_en($weather);
    /* We play a little with the objects - the output is just
       discarded: */
    $output = "\n<!-- " . $weather->get_metar() . " -->\n";
    $output = "\n<!-- " . $text->print_pretty() . " -->\n";
  }
  echo "<p>Processed " . (($i+1) * 32) . " METARs...</p>\n";
  flush();
}

$end_time = explode(' ', microtime());

$diff = ($end_time[0] + $end_time[1]) - ($start_time[0] + $start_time[1]);

echo "<p>Total time used to process $count METARs: <b>" .
  number_format($diff * 1000, 0) . " ms</b>.</p>\n";

echo '<p>Time used per METAR: <b>' .
  number_format($diff * 1000 / ($batches*32), 1) . " ms</b>.</p>\n"; 

?>

</body>
</html>
