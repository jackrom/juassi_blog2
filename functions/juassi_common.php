<?php
/*
	Juassi 2.0 Common
	Juan Carlos Reyes C Copyright 2012
*/
if (version_compare(PHP_VERSION, '5.2.0', '<')) {
	die('Juassi requires PHP 5.2.0 or higher to run. You\'re running ' . PHP_VERSION . '.');
}
if (!class_exists('PDO')) die('Unable to find the PHP PDO database class. This is required for Juassi to run.');

//Juassi Root Path
define('JUASSI_ROOT', dirname(__DIR__));
//Juassi Relative Path
if (!defined('JUASSI_REL_ROOT')) define('JUASSI_REL_ROOT', './');
define('JUASSI_INCLUDE', '/includes');
//Used for any "internal/core plugins"
define('JUASSI_PLUGIN_NAME', 'Juassi Core');

//stop php from complaining
//date_default_timezone_set(date_default_timezone_get());
date_default_timezone_set('GMT');

include(JUASSI_ROOT .'/functions/functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/db-specific.functions.php');
juassi_start_timer();
include(JUASSI_ROOT . JUASSI_INCLUDE . '/version.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/tables.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/db.php');

if (file_exists(JUASSI_ROOT . '/juassi-settings.php')) {
	include(JUASSI_ROOT . '/juassi-settings.php');
}

include(JUASSI_ROOT . '/juassi-default-settings.php');

if (!file_exists(JUASSI_ROOT . '/privado/config.php')) {
	juassi_die('El archivo de configuraci&oacute;n "config.php" no pudo ser encontrado, por favor inicie el <a href="' . JUASSI_REL_ROOT . 'juassi-install/index.php">instalador</a>.');
}

include(JUASSI_ROOT . '/privado/config.php');

//start database connection here
$juassi_db = new juassi_db($juassi_db_host, $juassi_db_name, $juassi_db_user, $juassi_db_pass, $juassi_db_type, $juassi_db_charset);
$juassi_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$juassi_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

//register_globals off
juassi_unregister_globals();

$juassi_tb = new tables($juassi_tb_prefix);

if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
	$_POST = juassi_remove_magic_quotes($_POST);
	$_GET = juassi_remove_magic_quotes($_GET);
	$_COOKIE = juassi_remove_magic_quotes($_COOKIE);
	$_SERVER = juassi_remove_magic_quotes($_SERVER);
}

if (!juassi_is_installed()) {
	juassi_die('No Instalado. Por favor inicie el <a href="' . JUASSI_REL_ROOT . 'juassi-install/index.php">instalador</a>.');
}

juassi_load_config();
juassi_gzip();

/*
Session Support
*/
include(JUASSI_ROOT . JUASSI_INCLUDE . '/sessions.class.php');

$juassi_session = new juassi_sessions($juassi_db, $juassi_tb->sessions);

include(JUASSI_ROOT . JUASSI_INCLUDE . '/log.class.php');

$juassi_log = new juassi_log();

set_error_handler('juassi_trigger_error');

juassi_load_user_data();

include(JUASSI_ROOT . JUASSI_INCLUDE . '/plugins.functions.php');

//load plugins here
if (JUASSI_LOAD_PLUGINS) {
	juassi_load_plugins();
	juassi_run_section('plugins_loaded');
}

include(JUASSI_ROOT . JUASSI_INCLUDE . '/pluggable.functions.php');

register_shutdown_function('juassi_shutdown_function');

/*
	Nested Set Model Details
*/
include(JUASSI_ROOT . JUASSI_INCLUDE . '/categories.class.php');

/*

*/
include(JUASSI_ROOT . JUASSI_INCLUDE . '/common-content.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/posts.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/comments.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/mailer.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/spam.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/akismet.class.php');

include(JUASSI_ROOT . JUASSI_INCLUDE . '/posts-template.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/content-template.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/general-template.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/comments-template.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/themes.functions.php');

include(JUASSI_ROOT . JUASSI_INCLUDE . '/default-filters.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/default-tasks.php');

include(JUASSI_ROOT . JUASSI_INCLUDE . '/permissions.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/soap.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/users.class.php');

include(JUASSI_ROOT . JUASSI_INCLUDE . '/url.class.php');

if (!class_exists('nusoap_client')) {
	include(JUASSI_ROOT . JUASSI_LIBRARIES . '/nusoap/nusoap.php');
}

include(JUASSI_ROOT . JUASSI_INCLUDE . '/soap.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/soap-server.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/soap-client.class.php');

//phpmailer class
if (juassi_get_config('smtp_client')) {
	include(JUASSI_ROOT . JUASSI_INCLUDE . '/phpmailer.class.php');
}

$juassi_mailer	= new juassi_mailer();
$juassi_url		= new url();

juassi_run_section('common_loaded');
?>
