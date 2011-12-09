<?php
/* defaults-dist.php,v 1.20 2003/09/30 19:48:00 etienne_t Exp */

/* This file holds the original defaults used by PHP Weather. If you
 * want to change something, you should follow these procedures:
 *
 * Use the script config/make_config.php. If you don't want to use
 * that for some reason, then it's also simple to edit this file
 * manually:
 *
 * 1) save this file as 'defaults.php' in this directory.
 * 2) change the options you want
 * 3) remove everything you didn't change
 *
 * That's it! You can keep your file (defaults.php) with your
 * modifications when upgrading PHP Weather, as the tarball will only
 * contain a new defaults-dist.php.
 */

$this->properties['verbosity']     = 1;             /* base_object.php */

$this->properties['always_use_db'] = false;         /* data_retrieval.php */
$this->properties['cache_timeout'] = 3600;
$this->properties['icao']          = 'KATY';
$this->properties['use_proxy']     = false;
$this->properties['proxy_host']    = '';
$this->properties['proxy_port']    = 3128;
$this->properties['fetch_method']  = 'fsockopen';

$this->properties['db_hostname']   = '';            /* pw_db_common.php */
$this->properties['db_database']   = '';
$this->properties['db_username']   = '';
$this->properties['db_password']   = '';
$this->properties['db_pconnect']   = false;
$this->properties['db_port']       = '';

$this->properties['db_metars']     = 'pw_metars';      /* pw_db_dba.php */
$this->properties['db_tafs']       = 'pw_tafs';
$this->properties['db_stations']   = 'pw_stations';
$this->properties['db_countries']  = 'pw_countries';
$this->properties['archive_metars']= false;           /* archiving of data */
$this->properties['db_metars_arch']= 'pw_metars_arch';
$this->properties['archive_tafs']  = false;
$this->properties['db_tafs_arch']  = 'pw_tafs_arch';

$this->properties['db_type']       = 'null';        /* db_layer.php */

$this->properties['pref_units']    = 'both_metric'; /* locale_common.php */
$this->properties['mark_begin']    = '<b>';
$this->properties['mark_end']      = '</b>';
$this->properties['exclude']       = array();

// Not used at present...
//$this->properties['orientation']   = 'horizontal';  /* pw_text.php */

$this->properties['icons_path']    = 'icons/';      /* pw_images.php */
$this->properties['reverse_dir']   = false;

$this->properties['offset']        = 0;             /* phpweather.php */

?>
