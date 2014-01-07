<?php
define('JUASSI_REL_ROOT', './../');
include('../functions/juassi_common.php');

if (juassi_is_logged_in()) {
	juassi_logout();
}

juassi_set_header('Location: login.php');
juassi_send_headers();

?>