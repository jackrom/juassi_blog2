<?php
define('JUASSI_REL_ROOT', './../');
include('../functions/juassi_common.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/general-admin-template.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/admin.functions.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/admin-links.class.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/file-upload.functions.php');

if (!isset($_SESSION['juassi_page']) || $_SESSION['juassi_page'] != $_SERVER['REQUEST_URI']) {
	$_SESSION['juassi_page'] = $_SERVER['REQUEST_URI'];
}

if (!juassi_is_logged_in()) {
	juassi_set_header('Location: login.php');
	juassi_send_headers();
	exit;
}

if (!juassi_has_permissions()) {
	trigger_error('Unauthorised Access, User "' . juassi_htmlentities(juassi_get_user_data('user_name')) . '" does not have permission to access "' . juassi_htmlentities(juassi_current_file()) . '"', E_USER_WARNING);
	juassi_stop('Unauthorised Access.');
}

$juassi_ln = new juassi_admin_links;
$juassi_users = new juassi_users();

juassi_run_section('admin_header_loaded');
?>
