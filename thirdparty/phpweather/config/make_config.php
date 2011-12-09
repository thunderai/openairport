<?php

if (ini_get('session.auto_start')) {
  /* Sorry, no configuration builder for you... */
?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../pw_style.css" />
  <title>Configuration Builder for PHP Weather</title>
</head>
<body>

<img src="../icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>Configuration Builder for PHP Weather</h1>

<p>Sorry, but you cannot use the Configurator when PHP is configured
with <code>session.auto_start</code> turned on.</p>

<p>See <a href="http://php.net/manual/ref.session.php">this
page</a> in the <a href="http://php.net/manual/">PHP Manual</a> for
help.</p>

<p>You can of course still make your <code>defaults.php</code> file by
hand, just make a copy of the <code>defaults-dist.php</code> file and
then change the settings to suit your preferences.  Then remove any
unchanged preferences and save it as <code>defaults.php</code>.</p>

<?php
  exit;
}

error_reporting(E_ALL);

require_once('../pw_utilities.php');

/* Require a couple of validators: */
require_once('pw_validator.php');
require_once('pw_validator_ereg.php');
require_once('pw_validator_range.php');

/* Require_once some options: */
require_once('pw_option.php');
require_once('pw_option_text.php');
require_once('pw_option_select.php');
require_once('pw_option_multi_select.php');
require_once('pw_option_boolean.php');
require_once('pw_option_integer.php');

/* We want to group the options: */
require_once('pw_optiongroup.php');

/* A couple of dependencies: */
require_once('pw_dependency_equal.php');
require_once('pw_dependency_or.php');
require_once('pw_dependency_and.php');

/* We have to strip slashes from the GPC variables. */
if (get_magic_quotes_gpc() == 1) {
  
  function recursive_stripslashes(&$array) {
    $keys = array_keys($array);
    foreach($keys as $key) {
      if (is_array($array[$key])) {
        recursive_stripslashes($array[$key]);
      } else {
        $array[$key] = stripslashes($array[$key]);
      }
    }
  }

  recursive_stripslashes($HTTP_POST_VARS);
}

/* Start the session. */
session_start();

/* If $options isn't registered, then we should make the variable and
 * register it: */
if (empty($HTTP_SESSION_VARS)) {
  
  /* Common dependencies: */
  $sql_dep =  new pw_dependency_or(new pw_dependency_equal('db_type', 'mysql'),
                                   new pw_dependency_equal('db_type', 'pgsql'));
  $dba_dep = new pw_dependency_equal('db_type', 'dba');
  $db_dep  = new pw_dependency_or($sql_dep, $dba_dep);
  
  $fsockopen_dep = new pw_dependency_equal('fetch_method', 'fsockopen');
  $proxy_dep     = new pw_dependency_equal('use_proxy', 'true');

  $adodb_dep     = new pw_dependency_equal('db_type', 'adodb');
  $adodb_ext_dep = new pw_dependency_equal('db_adodb_ext', 'true');

  $not_empty_validator = new pw_validator_ereg("Sorry, the empty string '' cannot be " .
                                               "used here", '^.+$');

  $port_validator = new pw_validator_range("Sorry, '%s' is not a valid port-number " .
                                           "because is't outside the range 1-65536",
                                           1, 65536);
  $port_validator_empty = new pw_validator_range("Sorry, '%s' is not a valid port-number " .
                                                 "because is't outside the range 1-65536",
                                                 1, 65536, true);

  /* This just catches the most obvious errors. */
  $table_validator = new pw_validator_ereg("Sorry, '%s' is not a valid name.",
                                           '^[^./]+$');
  $icao_validator = new pw_validator_ereg("Sorry, '%s' is not a valid ICAO.", 
                                          '^[a-zA-Z0-9]{4}$');

  /* This just catches the most obvious errors. */
  $host_validator = new pw_validator_ereg("Sorry, '%s' is not a valid hostname.",
                                          '^[^/#?~]+$');

  /* Next comes all the options: */
 
  $HTTP_SESSION_VARS['verbosity'] =
    new pw_option_select('verbosity',
                         "The setting of this variable controls the amount of " .
                         "errors, warnings, and debug-information PHP Weather " .
                         "will print. It is suggested that you always include " .
                         "errors in the output and perhaps also warnings.",
                         false,
                         array('1' => 'Errors only',
                               '2' => 'Warnings only',
                               '4' => 'Debug information only',
                               '3' => 'Errors + warnings',
                               '5' => 'Errors + debug information',
                               '6' => 'Warnings + debug information',
                               '7' => 'Everything'));
  
  $HTTP_SESSION_VARS['icao'] =
    new pw_option_text('icao',
                       'This will be the default station used by PHP Weather. ' .
                       'You should enter a valid four-letter ICAO.',
                       false, $icao_validator, 'EKYT');
  
  $HTTP_SESSION_VARS['pref_units'] =
    new pw_option_select('pref_units',
                         'You may choose to display the data in several ' .
                         'formats. Please choose one that fits your need.',
                         false,
                         array('both_metric'   => 'Metric first, then imperial',
                               'both_imperial' => 'Imperial first, then metric',
                               'only_metric'   => 'Only metric',
                               'only_imperial' => 'Only imperial'));
  
  $HTTP_SESSION_VARS['language'] =
    new pw_option_select('language',
                         'PHP Weather can produce textual output using ' .
                         'in several languages - please select your default ' .
                         'from the list.',
                         false,
                         get_languages('text'),
                         'en');
  
  $HTTP_SESSION_VARS['offset'] =
    new pw_option_integer('offset',
                          "Due to a bug in PHP, on some systems the time reported may " .
                          "be incorrect. If you experience this, you specify the " .
                          "offset here. For example, if your times generated are 1 " .
                          "hour too early (so METARs appear an hour older than they " .
                          "are), set this option to be +1.",
                          false, false, 0);

  $HTTP_SESSION_VARS['fetch_method'] =
    new pw_option_select('fetch_method',
                         "PHP Weather can fetch the METAR reports from the NWS using " .
                         "one of two different methods: using either the file() or " .
                         "the fsockopen() function. You should start with file() and " .
                         "then change it to fsockopen() if you discover that file() " .
                         "has been disabled or you need to use a proxy server.",
                         false,
                         array('file' => 'Use the file() function',
                               'fsockopen' => 'Use the fsockopen() function'));
  
  $HTTP_SESSION_VARS['use_proxy'] =
    new pw_option_boolean('use_proxy',
                          "Set this option to 'Yes' to enable support for a " .
                          "proxy server.",
                          $fsockopen_dep,
                          array('false' => 'No',
                                'true'  => 'Yes'));
  
  $HTTP_SESSION_VARS['proxy_host'] =
    new pw_option_text('proxy_host',
                       "This is the hostname of the proxy server.",
                       $proxy_dep, $host_validator);
  
  $HTTP_SESSION_VARS['proxy_port'] =
    new pw_option_integer('proxy_port',
                          "This is the port number of the proxy server. The " .
                          "default is what is used by the Squid proxy server. " .
                          "Another common port number is '8080'",
                          $proxy_dep, $port_validator, 3128);
  
  $HTTP_SESSION_VARS['db_type'] =
    new pw_option_select('db_type',
                         'PHP Weather can use several kinds of databases.',
                         false,
                         array('null'  => 'No database at all',
                               'mysql' => 'A MySQL database',
                               'pgsql' => 'A PostgreSQL database',
                               'dba'   => 'A DBA database',
                               'adodb' => 'The ADOdb wrapper library'));

  $HTTP_SESSION_VARS['db_adodb_path'] =
    new pw_option_text('db_adodb_path',
                       "We need to know where we can find the ADOdb library. " .
                       "The default is for a Debian GNU/Linux system, but " .
                       "you'll probably have to change it.",
                       $adodb_dep,
                       false, // we could try to validate the path...
                       '/usr/share/adodb');
                       
  $HTTP_SESSION_VARS['db_adodb_driver'] =
    new pw_option_text('db_adodb_driver',
                       "Please select a driver to use with the ADOdb " .
                       "wrapper library. You can get a list of drivers from " .
                       '<a href="http://php.weblogs.com/ADODB_Manual#drivers">' .
                       "the ADOdb Manual</a>.",
                       $adodb_dep,
                       $not_empty_validator);

  $HTTP_SESSION_VARS['db_adodb_ext'] =
    new pw_option_boolean('db_adodb_ext',
                          "If you need to load an extension for ADOdb to work, " .
                          "then set this option to 'Yes'. PHP might have been " .
                          "compiled with support for MySQL, but the extension " .
                          "isn't necessarily loaded.",
                          $adodb_dep,
                          array('false' => 'No', 'true'  => 'Yes'));

  $HTTP_SESSION_VARS['db_adodb_ext_name'] =
    new pw_option_text('db_adodb_ext_name',
                       "If you need to load an extension go get your database " .
                       "to work, then specify the name here. For example, if " .
                       "you're using MySQL, then the extension is called " .
                       "'mysql', or if you're using PostgreSQL, then it's " .
                       "called 'pgsql'.",
                       $adodb_ext_dep,
                       $not_empty_validator);

  $HTTP_SESSION_VARS['db_adodb_ext_file'] =
    new pw_option_text('db_adodb_ext_file',
                       "The name of the extension isn't enough to guess the " .
                       "filename to load. For example, if you're using the " .
                       "'mysql' extension with the MySQL database, then the " .
                       "file to load is either 'mysql.so' on a Unix based " .
                       "system, or 'mysql.dll' on a Windows based system.",
                       $adodb_ext_dep,
                       $not_empty_validator);

  $HTTP_SESSION_VARS['db_handler'] =
    new pw_option_select('db_handler',
                         "If you've chosen to use a Berkeley DB style database " .
                         "through the PHP database abstraction layer (DBA), then " .
                         "please select the handler you would like to use.",
                         $dba_dep,
                         array('dbm'  => 'dbm - The oldest (original) type of ' .
                               'Berkeley DB style databases',
                               'ndbm' => 'ndbm - a newer and more flexible type.',
                               'gdbm' => 'gdbm - The GNU database manager',
                               'db2'  => 'db2 - Sleepycat Softwares DB2',
                               'db3'  => 'db3 - Sleepycat Softwares DB3'));
  
  $HTTP_SESSION_VARS['always_use_db'] =
    new pw_option_boolean('always_use_db',
                          "If you set this option to 'Yes', then PHP Weather " .
                          "will always use the data it finds in the database, " .
                          "even if it's too old. But if the data isn't there, " .
                          "it will still fetch new data from the Internet.",
                          $db_dep,
                          array('false' => 'No', 'true'  => 'Yes'));
  
  $HTTP_SESSION_VARS['cache_timeout'] =
    new pw_option_integer('cache_timeout',
                          "This specifies when a METAR in the cache is " .
                          "considered to be old. If a METAR is older than this " .
                          "number of seconds, then an attempt is made to fetch " .
                          "a new METAR from the web. The default value is 3600 " .
                          "seconds (1 hour), but some stations make two " .
                          "reports each hour, so you might want to lower this " .
                          "number to perhaps 2400 or even 1800.",
                          new pw_dependency_and(new pw_dependency_equal('always_use_db', 'false'),
                                                $db_dep),
                          false, '3600');
  
  $HTTP_SESSION_VARS['db_pconnect'] =
    new pw_option_boolean('db_pconnect',
                          "If you want to make a persistent connection to the " .
                          "database, then set this option to 'Yes'.",
                          $sql_dep,
                          array('false' => 'No', 'true' => 'Yes'));
  
  $HTTP_SESSION_VARS['db_port'] =
    new pw_option_integer('db_port',
                          'If you have to use a non-standard port when ' .
                          'connecting to the database, then please specify it ' .
                          'here. If not, then just leave this field blank.',
                          $sql_dep, $port_validator_empty);
  
  $HTTP_SESSION_VARS['db_hostname'] =
    new pw_option_text('db_hostname',
                       'This is the hostname that PHP Weather will use, ' .
                       'if you choose to use a database-backend, that ' .
                       'supports network connections.',
                       $sql_dep, $host_validator);
  
  $HTTP_SESSION_VARS['db_database'] =
    new pw_option_text('db_database',
                       'This is the name of the database that PHP Weather ' .
                       'should use.',
                       $sql_dep, $table_validator);
  
  $HTTP_SESSION_VARS['db_username'] =
    new pw_option_text('db_username',
                       'This is the username that PHP Weather will use ' .
                       'for accessing the database.',
                       $sql_dep);
  
  $HTTP_SESSION_VARS['db_password'] =
    new pw_option_text('db_password',
                       'This is the password that PHP Weather will use when ' .
                       'trying to make a connection to the database. Please ' .
                       "remember to protect the file after you've stored the " .
                       "password in it.",
                       $sql_dep);
  
  $HTTP_SESSION_VARS['db_metars'] =
    new pw_option_text('db_metars',
                       'This is the name of the table that is used ' .
                       'to cache the METARs.',
                       $db_dep, $table_validator, 'pw_metars');

  $HTTP_SESSION_VARS['db_tafs'] =
    new pw_option_text('db_tafs',
                       'This is the name of the table that is used ' .
                       'to cache the TAFs.',
                       $db_dep, $table_validator, 'pw_tafs');

  $HTTP_SESSION_VARS['db_stations'] =
    new pw_option_text('db_stations',
                       'This is the name of the database/table that is used ' .
                       'to store the names of the stations.',
                       $db_dep, $table_validator, 'pw_stations');
  
  $HTTP_SESSION_VARS['db_countries'] =
    new pw_option_text('db_countries',
                       'This is the name of the database that is used to ' .
                       'store the names of the countries together with ' .
                       'country-codes.',
                       $dba_dep, $table_validator, 'pw_countries');
  
  
  $HTTP_SESSION_VARS['mark_begin'] =
    new pw_option_text('mark_begin',
                       'This string will be placed in front of all the ' .
                       "changable parts of the output. If you don't want " .
                       'this to happen, then just use an empty string. ' .
                       "Other good choices include <code>&lt;i&gt;</code>, <code>&lt;font " .
                       'color="red"&gt;</code>, etc.',
                       false, false, '<b>');
  
  $HTTP_SESSION_VARS['mark_end'] =
    new pw_option_text('mark_end',
                       'This string is placed after all the changable parts. ' .
                       'You should make sure that it closes any tags ' .
                       "you've opened in <code>mark_begin</code>.",
                       false, false, '</b>');
  
  $HTTP_SESSION_VARS['icons_path'] =
    new pw_option_text('icons_path',
                       'The path to the directory that stores the icons used in the ' .
                       'output. You should set this to the absolute path from the ' .
                       'server root if you need to use PHP Weather from several ' .
                       'different locations on the server.',
                       false, false, 'icons/');

  $HTTP_SESSION_VARS['reverse_dir'] =
    new pw_option_boolean('reverse_dir',
                          'The wind direction arrows will normally point in the ' .
                          'same direction as the wind blows (so a wind direction ' .
                          'of 45&deg; will result in an arrow pointing up to the ' .
                          'right) but if you want them reversed, then that\'s ' .
                          'possible too.',
                          false, array('false' => 'Normal', 'true' => 'Reversed'));

  $HTTP_SESSION_VARS['exclude'] =
    new pw_option_multi_select('exclude',
                               'You can disable some of the output produced. If ' .
                               "you're not interested in information about " .
                               'runways-visibility, then select it in this list. ' .
                               'You can select several options at once ' .
                               'by holding down Ctrl while clicking on the option.',
                               false,
                               array('time'   => 'Leave out the time part',
                                     'wind'   => 'Leave out the wind part',
                                     'runway' => 'Leave out information about runways'));
}

/* The options should now be ready - they might come from a restored
 * session, or they might just have been created. */

/* We update the options with the latest information. We have to be
   carefull when we do this, because we have to operate directly on the
   options in $HTTP_SESSION_VARS and not on a copy. */
$keys = array_keys($HTTP_SESSION_VARS);
foreach ($keys as $option) {
  $HTTP_SESSION_VARS[$option]->update_value($HTTP_POST_VARS);
}

/* Grouping */ 
$general_group = 
  new pw_optiongroup('general_group', 'General Options',
                     'This is some general options for PHP Weather.',
                     array('verbosity', 'icao', 'pref_units', 'language', 'offset',
                           'fetch_method',
                           'use_proxy', 'proxy_host', 'proxy_port'),
                     !empty($HTTP_POST_VARS['general_group_visible']));

$db_group =
  new pw_optiongroup('db_group', 'Database Options',
                     'These options deal with the database. PHP Weather ' .
                     'can use a database for caching the METARs it ' .
                     'retrieves. This is very nice, since it takes at ' .
                     'least a second or two to fetch a METAR from the ' .
                     'National Weather Service.',
                     array('db_type', 'db_adodb_path', 'db_adodb_driver',
                           'db_adodb_ext', 'db_adodb_ext_name', 'db_adodb_ext_file',
                           'db_handler', 'db_pconnect', 'always_use_db',
                           'cache_timeout', 'db_hostname', 'db_port',
                           'db_username', 'db_password', 'db_database',
                           'db_metars', 'db_tafs', 'db_stations', 'db_countries'),
                     !empty($HTTP_POST_VARS['db_group_visible']));

$rendering_group =
  new pw_optiongroup('rendering_group', 'Rendering Options',
                     'You can customize the looks of PHP Weather using these options.',
                     array('mark_begin', 'mark_end', 'icons_path', 'reverse_dir', 'exclude'),
                     !empty($HTTP_POST_VARS['rendering_group_visible']));

/* We can now generate a configuration file with the options selected so far: */ 

$timestamp = date ('dS of F, Y H:i:s');
$config = "<?php
/* This is a local configuration file for PHP Weather.
   It was generated on the $timestamp. */\n" .
$general_group->get_config() .
$db_group->get_config() .
$rendering_group->get_config() .
"\n?>\n";

if (!empty($HTTP_POST_VARS['download'])) {
  header('Content-type: application/octet-stream');
  header('Content-Disposition: attachment; filename="defaults.php"');
  echo $config;
  exit();
}

?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../pw_style.css" />
  <title>Configuration Builder for PHP Weather</title>
</head>
<body>

<script type="text/javascript">
function update(accepted, error, value, output) {
  if (accepted) {
    document.getElementById(output).innerHTML = "<font color=\"green\">Input accepted.</font>";
  } else {
    while ((index = error.indexOf("%s")) > -1) {
      error = error.substring(0, index) + value + error.substring(index+2);
    }
    document.getElementById(output).innerHTML = "<font color=\"red\">" + error + "</font>";
  }
}

function validate(error, value, output, field) {
  update(field.value == value, error, field.value, output);
}

function validate_ereg(error, ereg, output, field) {
  regex = new RegExp(ereg);
  update(regex.test(field.value), error, field.value, output);
}

function validate_range(error, low, high, empty_ok, output, field) {
  update((empty_ok == 1 && field.value == "") ||
         (field.value >= low && field.value <= high),
         error, field.value, output);
}

function toggle_group(id) {
  group = document.getElementById(id);
  text = document.getElementById(id + "_text");
  input = document.getElementById(id + "_input");
  if (group.style.display == "none") {
    text.innerHTML = "Hide options.";
    group.style.display = "block";
    input.value = 1;
  } else {
    text.innerHTML = "Show options.";
    group.style.display = "none";
    input.value = 0;
  }
}
</script>

<img src="../icons/phpweather-long-white.png" width="187" height="50"
alt="PHP Weather" align="right" />

<h1>Configuration Builder for PHP Weather</h1>

<p>This is the Configurator shipped with PHP Weather.</p>

<p>Change the options below - when you're done, then press one of the
'Update Configuration' buttons. Depending on your choices, more
options might appear. Continue to change the options until they all
say <span style="color: green">Input accepted.</span></p>

<form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF'] . '?' . SID ?>" method="post">

<p>You can <input type="submit" name="download"
value="Download the Configuration" /> or <input type="reset"
value="Reset Everything" onclick="document.location='reset_session.php'" /></p>

<dl>
  <?php
  $general_group->show();
  $db_group->show();
  $rendering_group->show();
  ?>
</dl>

<p>This is a configuration file bases on your answers above:</p>

<?php highlight_string($config); ?>

<p>You should copy the above configuration to a file called
<code>defaults.php</code> in the root directory of your PHP Weather
installation. It's very important that the lines with <code><font
color="#0000CC">&lt;?php</font></code> and <code><font
color="#0000CC">?&gt;</font></code> are the very first and very last,
respectively. There should be no blank lines outside these two
tags.</p>

<p>You can also <input type="submit" name="download"
value="Download the Configuration"> or <input type="reset"
value="Reset Everything"
onclick="document.location='reset_session.php'"></p>

</form>

</body>
</html>
