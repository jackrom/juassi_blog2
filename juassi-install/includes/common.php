<?php
define('JUASSI_REL_ROOT', './../');
define('JUASSI_ROOT', '');
include('../includes/db-specific.functions.php');
include('../functions/functions.php');
if (file_exists('../juassi-settings.php')) {
	include('../juassi-settings.php');
}
include('../juassi-default-settings.php');
include('../includes/tables.class.php');
if (!isset($no_include['db.php'])) {
	include('../includes/db.php');
}
include('../includes/categories.class.php');
include('../includes/common-content.class.php');
include('../includes/posts.class.php');
include('../includes/permissions.functions.php');
include('../includes/users.class.php');
include('../includes/admin.functions.php');
include('../includes/log.class.php');
include('functions.php');

session_name('juassi_install_sid');
ini_set('session.use_only_cookies', 1);
session_start();
?>
