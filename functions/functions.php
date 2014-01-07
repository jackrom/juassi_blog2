<?php
/*
	Juassi 2.0 Core Functions
	Juan Carlos Reyes C Copyright 2012
*/
function juassi_get_config($config_name) {
	global $juassi_config;

	if (isset($juassi_config[$config_name])) {
		$str = 's'; //linea sencilla
		$array = 'a'; //
		$integer = 'i'; // debe ser exacto, mayusculas y minusculas
		$any = '[^}]*?'; // no debe existir unas llaves de cierre ni cero ni otras veces
		$count = '\d+'; // digitos - una o mas veces
		$content = '"(?:\\\";|.)*?";'; // debe ser pasivo, no capturar grupo, ni \ ni " ni ; alternando con (.) y debe coincidir una o mas veces
		$open_tag = '\{'; //llaves de inicio
		$close_tag = '\}'; //llaves de cierre
		$parameter = "($str|$array|$integer|$any):($count)" . "(?:[:]($open_tag|$content)|[;])";
		$preg = "/$parameter|($close_tag)/";
		if(!preg_match_all($preg, $juassi_config[$config_name], $matches)) {
			return $juassi_config[$config_name];
		}
		else {
			return unserialize($juassi_config[$config_name]);
		}
	}
	else {
		return false;
	}
}

function juassi_add_config($config_name, $config_value) {
	global $juassi_config, $juassi_db, $juassi_tb;
 

	if (!isset($juassi_config[$config_name])) {
		if (is_array($config_value)) {
			$juassi_config[$config_name] = serialize($config_value);
		}
		else {
			$juassi_config[$config_name] = $config_value;
		}
		$stmt = $juassi_db->prepare("INSERT INTO $juassi_tb->site (config_value, config_name) VALUES (?, ?)");
		$stmt->bindParam(1, $juassi_config[$config_name]);
		$stmt->bindParam(2, $config_name);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}
	else {
		return false;
	}
}

function juassi_set_config($config_name, $config_value, $update_now = TRUE) {
	global $juassi_config, $juassi_tb, $juassi_db, $juassi_hard_config;

	juassi_run_section('set_config', array('config_name' => &$config_name, 'config_value' => &$config_value, 'update_now' => &$update_now));

	if (isset($juassi_hard_config[$config_name])) return false;

	if (is_array($config_value)) {
		$juassi_config[$config_name] = serialize($config_value);
	}
	else {
		$juassi_config[$config_name] = $config_value;
	}

	if ($update_now) {
		$stmt = $juassi_db->prepare("UPDATE $juassi_tb->site SET config_value = ? WHERE config_name = ?");
		$stmt->bindParam(1, $juassi_config[$config_name]);
		$stmt->bindParam(2, $config_name);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}

	return true;
}

function juassi_hard_set_config($config_name, $config_value) {
	global $juassi_hard_config;

	if (is_array($config_value)) {
		$juassi_hard_config[$config_name] = serialize($config_value);
	}
	else {
		$juassi_hard_config[$config_name] = $config_value;
	}
	return true;
}

function juassi_save_config() {
	global $juassi_db, $juassi_tb, $juassi_config, $juassi_hard_config;

	juassi_run_section('save_config');

	foreach($juassi_config as $config_name => $config_value){
		if (isset($juassi_hard_config[$config_name])) continue;
		$stmt = $juassi_db->prepare("UPDATE $juassi_tb->site SET config_value = ? WHERE config_name = ?");
		$stmt->bindParam(1, $config_value);
		$stmt->bindParam(2, $config_name);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}
	return true;
}

function juassi_delete_config($config_name) {
	global $juassi_db, $juassi_tb, $juassi_config, $juassi_hard_config;

	if (isset($juassi_hard_config[$config_name])) return false;

	if (isset($juassi_config[$config_name])) {
		$stmt = $juassi_db->prepare("DELETE FROM $juassi_tb->site WHERE config_name = ?");
		$stmt->bindParam(1, $config_name);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		return true;
	}
	else {
		return false;
	}

}

function juassi_load_config() {
	global $juassi_db, $juassi_tb, $juassi_config, $juassi_hard_config, $juassi_db_type;

	$juassi_config = $juassi_hard_config;

	try {
		foreach ($juassi_db->query("SELECT config_name, config_value from $juassi_tb->site", PDO::FETCH_ASSOC) as $row) {
			if (isset($juassi_hard_config[$row['config_name']])) {
				$juassi_config[$row['config_name']] = $juassi_hard_config[$row['config_name']];
				continue;
			}
			$juassi_config[$row['config_name']] = $row['config_value'];
		}
	} catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	//generate site address, used for most things
	$port_number = '';
	if ($juassi_config['https']) {
		if ($juassi_config['port_number'] != 443) {
			$port_number = ':'.$juassi_config['port_number'];
		}
		$juassi_config['address'] = 'https://' . $juassi_config['domain'] . $port_number . $juassi_config['script_path'];
	}
	else {
		if ($juassi_config['port_number'] != 80) {
			$port_number = ':'.$juassi_config['port_number'];
		}
		$juassi_config['address'] = 'http://' . $juassi_config['domain'] . $port_number . $juassi_config['script_path'];
	}

	$juassi_hard_config['address']			= $juassi_config['address'];

	//database tyoe
	$juassi_config['database_type'] 		= $juassi_db_type;
	$juassi_hard_config['database_type'] 	= $juassi_db_type;

	return true;
}

/*
Only use this function if a serious error has occurred.
If you want to be lazy and stop any processing use juassi_stop()
*/
function juassi_die($die_message = '', $display_error_message = TRUE) {
	global $juassi_config;
	//mail example will be changed.
	if(JUASSI_MAIL_NOTIFY) {
		$email_message = "Tu estas recibiendo este email, porque un error ha ocurrido en tu website en la url / You are receiving this email as an error has occured on your site at the url \"" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "\".\n\r";
		$email_message .= "El Error es el siguiente/The error is as follows:\n\r";
		$email_message .= $die_message . "\n\r";
		$email_message .= "La siguiente informaci&oacute;n puede ayudarte a diagnosticar el error / The following information may help you diagnose the error:\n\r";
		$email_message .= "DEBUG BACKTRACE:\n";
		$email_message .= print_r(debug_backtrace(), TRUE);
		$email_message .= "\n\n------------------\nEl mensaje de error fue registrado desde la direcci&oacute;n IP / Error message was triggered from the IP address: " . juassi_ip_address();
		@mail(JUASSI_MAIL_NOTIFY_EMAIL, JUASSI_MAIL_NOTIFY_SUBJECT, $email_message, 'From: ' . JUASSI_MAIL_NOTIFY_EMAIL . "\r\nContent-Type: text/plain; charset=utf-8\r\n");
	}
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<title>Juassi :: Error</title>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<style type="text/css" media="screen">@import url(<?php echo JUASSI_REL_ROOT; ?>juassi-resources/css/admin-layout.css);</style>
				</head>

				<body>
				<div class="header">
					<div class="headerimg"></div>
				</div>
				<div class="body">
						<div class="contain">
							<h1>Juassi :: Error</h1>
							<h3><?php if ($display_error_message) echo $die_message; ?></h3>
							<pre><?php if(JUASSI_MAIL_NOTIFY) echo 'Un email ha sido enviado al administrador del website informandoles del error. Por favor intente despu&eacute;s / An email has been sent to the administrator of this site informing them of the error. Please try again later.'; ?></pre>
						</div>
						<br />
						<div class="copyright">
							<p>Powered by <a href="http://www.juassi.com/">Juassi</a>.</p><?php echo $_SERVER['SERVER_SIGNATURE']; ?>
						</div>
				</div>
				</body>
			</html>
	<?php
	die();
}

function juassi_stop($stop_message = '') {
	echo '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
						<title>Juassi :: Stop</title>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<style type="text/css" media="screen">@import url(<?php echo JUASSI_REL_ROOT; ?>juassi-resources/css/admin-layout.css)</style>
					</head>

					<body>
					<div class="header">
						<div class="headerimg"></div>
					</div>
					<div class="body">
							<div class="contain">
								<h1>Juassi :: Stop</h1>
								<h3><?php echo $stop_message; ?></h3>
								<p><a href="';
	echo juassi_get_config("address");
	echo '/">&laquo; Home</a> <a href="';
	echo juassi_get_config("address") . JUASSI_ADMIN;
	echo '/">Admin Home &raquo;</a></p>
							</div>
							<br />
							<div class="copyright">
								<p>Powered by <a href="http://www.juassi.com/">Juassi</a>.</p>'.$_SERVER['SERVER_SIGNATURE'].'
							</div>
					</div>
					</body>
				</html>
		<?php';
		exit;
}

// register_globals off
function juassi_unregister_globals() {
	if (!ini_get('register_globals')) {
		return true;
	}

	// Might want to change this perhaps to a nicer error
	if (isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS'])) {
		juassi_die('GLOBALS overwrite attempt detected.');
	}

	// Variables that shouldn't be unset
	$noUnset = array('GLOBALS',  '_GET',
		'_POST',    '_COOKIE',
		'_REQUEST', '_SERVER',
		'_ENV',    '_FILES');

	$input = array_merge($_GET,    $_POST,
	$_COOKIE, $_SERVER,
	$_ENV,    $_FILES,

	isset($_SESSION) && is_array($_SESSION) ? $_SESSION : array());

	foreach ($input as $k => $v) {
		if (!in_array($k, $noUnset) && isset($GLOBALS[$k])) {
			unset($GLOBALS[$k]);
		}
	}

	return true;
}

function juassi_shutdown_function() {
	global $juassi_db;

	juassi_run_section('shutdown');

	$juassi_db = null;
}

//start the timer, works out page generation time
function juassi_start_timer() {
	global $juassi_tstart;

	$starttime = explode(' ', microtime());
	$juassi_tstart = $starttime[1] + $starttime[0];

	return true;
}

//stops the timer and returns the time it took for generation. Level of accuracy can be changed
function juassi_stop_timer($accuracy = 4) {
	global $juassi_tstart;

	$starttime = explode(' ', microtime());
	$tend = $starttime[1] + $starttime[0];
	$totaltime = number_format($tend - $juassi_tstart, $accuracy);

	return $totaltime;
}

function juassi_htmlentities($string) {

	return htmlentities($string, ENT_QUOTES, 'utf-8');
}

//set a header to be sent later
function juassi_set_header($header) {
	global $juassi_headers;

	$juassi_headers[] = $header;
}

//sends HTTP headers
function juassi_send_headers() {
	global $juassi_headers;

	if (is_array($juassi_headers)) {
		foreach ($juassi_headers as $header) {
			header($header);
		}
	}

	return true;
}

//from phpbb3 beta 3
function juassi_memory_usage() {

	if (function_exists('memory_get_usage')) {
		$total_memory = ini_get('memory_limit');
		$memory_usage = memory_get_usage();
		$memory_usage = ($memory_usage >= 1048576) ? round((round($memory_usage / 1048576 * 100) / 100), 2) . ' ' . 'MB' : (($memory_usage >= 1024) ? round((round($memory_usage / 1024 * 100) / 100), 2) . ' ' . 'KB' : $memory_usage . ' ' . 'BYTES');
		return $memory_usage;
	}
	else {
		return false;
	}
}
function juassi_date() {
	$base_time = time() + 3600 * juassi_get_config('time_zone');

	return gmdate('Y-m-d', $base_time);
}

function juassi_time() {
	$base_time = time() + 3600 * juassi_get_config('time_zone');

	return gmdate('H:i:s', $base_time);
}

function juassi_datetime($add_seconds = 0) {

	$base_time = time() + (int) $add_seconds + 3600 * juassi_get_config('time_zone');

	return gmdate('Y-m-d H:i:s', $base_time);
}

function juassi_datetime_utc($add_seconds = 0) {

	$base_time = time() + (int) $add_seconds;

	return gmdate('Y-m-d H:i:s', $base_time);
}

function juassi_datetime_utc_from_datetime($datetime) {

	$date_utc = strtotime($datetime);
	$date_utc = strtotime('-' . juassi_get_config('time_zone') . ' hours', $date_utc);
	return date('Y-m-d H:i:s', $date_utc);

}

function juassi_datetime_user() {

}

function juassi_ip_address() {

	return $_SERVER['REMOTE_ADDR'];
}

function juassi_get_content_identifier() {
	global $juassi_content_type;

	$juassi_content_identifier['year'] = '';
	$juassi_content_identifier['month'] = '';
	$juassi_content_identifier['day'] = '';
	$juassi_content_identifier['x_title'] = '';
	//blog, cms, rss etc
	$juassi_content_identifier['type'] = 'blog';
	//send the user to a 404 unless the content type is picked up
	$juassi_content_identifier['theme_type'] = '404';
	$juassi_content_identifier['id'] = '';
	$juassi_content_identifier['page'] = '';
	$juassi_content_identifier['category'] = '';

	juassi_run_section_ref('content_identifier_defaults', $juassi_content_identifier);

	if (isset($_GET['juassi_year'])) $juassi_content_identifier['year'] = (int) $_GET['juassi_year'];
	if (isset($_GET['juassi_month'])) $juassi_content_identifier['month'] = (int) $_GET['juassi_month'];
	if (isset($_GET['juassi_day'])) $juassi_content_identifier['day'] = (int) $_GET['juassi_day'];
	if (isset($_GET['juassi_x_title'])) $juassi_content_identifier['x_title'] = strtolower($_GET['juassi_x_title']);
	if (isset($_GET['juassi_type'])) $juassi_content_identifier['type'] = strtolower($_GET['juassi_type']);
	if (isset($_GET['juassi_id'])) $juassi_content_identifier['id'] = (int) $_GET['juassi_id'];
	if (isset($_GET['juassi_page'])) $juassi_content_identifier['page'] = (int) $_GET['juassi_page'];
	if (isset($_GET['juassi_category'])) $juassi_content_identifier['category'] = $_GET['juassi_category'];

	if (empty($_GET['juassi_year']) && empty($_GET['juassi_month']) && empty($_GET['juassi_day']) && empty($_GET['juassi_x_title'])
	&& empty($_GET['juassi_id']) && empty($_GET['juassi_page']) && empty($_GET['juassi_category'])) {
		$juassi_content_identifier['empty'] = 1;
	}
	else {
		$juassi_content_identifier['empty'] = 0;
	}

	$juassi_content_identifier['year']  = substr($juassi_content_identifier['year'], 0, 4);
	$juassi_content_identifier['month'] = substr($juassi_content_identifier['month'], 0, 2);
	$juassi_content_identifier['day'] = substr($juassi_content_identifier['day'], 0, 2);

	if (isset($juassi_content_type)) {
		$juassi_content_identifier['type'] = strtolower($juassi_content_type);
	}
	$juassi_content_identifier['type'] = preg_replace('([^0-9a-z_\/])', '', $juassi_content_identifier['type']);

	juassi_run_section_ref('content_identifier', $juassi_content_identifier);

	return $juassi_content_identifier;

}
//makes title into one that works nicely in a url
function juassi_x_title($title) {
	$title = strtolower($title);
	$title = str_replace(' ', '-', $title);
	$title = preg_replace('/&.+?;/', '', $title); // kill entities
	$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
	$title = preg_replace('/\s+/', '-', $title);
	//following line was having issues on ipod touch, need to look into it.
	//$title = preg_replace('|-+|', '-', $title);
	return $title;
}

//adds slashes to a value. This will add slashes to an array too.
function juassi_add_magic_quotes($array) {

	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$array[$key] = juassi_add_magic_quotes($value);
		}
		else {
			$array[$key] = addslashes($value);
		}
	}

	return $array;
}

//removes slashes from a value. This will remove slashes from an array too.
function juassi_remove_magic_quotes($array) {

	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$array[$key] = juassi_remove_magic_quotes($value);
		}
		else {
			$array[$key] = stripslashes($value);
		}
	}

	return $array;
}

//serialize an array and put it into a cookie
function juassi_set_cookie_array($array, $seconds = 31536000) {

	if (juassi_get_config('domain') == 'localhost' || juassi_get_config('domain') == '127.0.0.1') {
		$domain = '';
	}
	else {
		$domain = juassi_get_config('domain');
	}
	if (setcookie(juassi_get_config('cookie_name') . '_data', serialize($array), time() + $seconds, juassi_get_config('script_path') . '/', $domain)) {
		return true;
	}
	else {
		return false;
	}
}
//return the array from the cookie
function juassi_get_cookie_array() {

	if (isset($_COOKIE[juassi_get_config('cookie_name') . '_data'])) {
		return juassi_add_magic_quotes(unserialize(stripslashes($_COOKIE[juassi_get_config('cookie_name') . '_data'])));
	}
	else {
		return false;
	}
}

//deletes a cookie
function juassi_clear_cookie($seconds = 31536000) {

	if (juassi_get_config('domain') == 'localhost' || juassi_get_config('domain') == '127.0.0.1') {
		$domain = '';
	}
	else {
		$domain = juassi_get_config('domain');
	}

	if (setcookie(juassi_get_config('cookie_name') . '_data', '', time() - $seconds, juassi_get_config('script_path') . '/', $domain)) {
		return true;
	}
	else {
		return false;
	}
}

//clears and deletes current session.
function juassi_clear_session() {
	global $juassi_session;

	$juassi_session->destroy(session_id());

	return true;

}

function juassi_load_user_data() {
	global $juassi_db, $juassi_tb;

	if (isset($_SESSION['juassi_user_data']['user_id'])) {
		$user_id = (int) $_SESSION['juassi_user_data']['user_id'];
		$query = "SELECT * FROM $juassi_tb->users WHERE user_id = ? AND active = 1 LIMIT 1";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $user_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		$user_details = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($user_details) {
			$user_array = array(
				'user_id' => $user_details['user_id'],
				'user_name' => $user_details['user_name'],
				'display_name' => $user_details['display_name'],
				'website' => $user_details['website'],
				'email' => $user_details['email'],
				'group_id' => $user_details['group_id'],
				'joined' => $user_details['joined'],
				'contact' => $user_details['contact'],
				'gui_editor' => $user_details['gui_editor']
			);
			$_SESSION['juassi_user_data'] = $user_array;
			return true;
		}
		else {
			$_SESSION['juassi_user_data'] = array();
			return false;
		}
	}
	else {
		return false;
	}

}

function juassi_get_user_data($index_name) {
	global $juassi_db, $juassi_tb;

	if (isset($_SESSION['juassi_user_data']) && !empty($_SESSION['juassi_user_data'])) {
		$array = $_SESSION['juassi_user_data'];

		if (isset($array[$index_name])) {
			return $array[$index_name];
		}
		elseif ($index_name == 'password') {
			$user_id = juassi_get_user_data('user_id');
			$query = "SELECT * FROM $juassi_tb->users WHERE user_id = :user_id LIMIT 1";
			$stmt = $juassi_db->prepare($query);
			$stmt->bindParam(':user_id', $user_id);

			try {
				$stmt->execute();
			}
			catch (Exception $e) {
				juassi_die($e->getMessage());
			}
			$user_details = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($user_details) {
				return $user_details['password'];
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}

}

//can probably replace a lot of this with $juassi_users->edit_user()
function juassi_set_user_data($index_name, $value) {
	global $juassi_db, $juassi_tb;

	if (isset($_SESSION['juassi_user_data']) && !empty($_SESSION['juassi_user_data'])) {
		$user_id = (int) juassi_get_user_data('user_id');
		switch ($index_name) {
			case 'gui_editor':
				$value = (int) $value;
				$query = "UPDATE $juassi_tb->users SET gui_editor = :gui_editor WHERE user_id = :user_id";
				$stmt = $juassi_db->prepare($query);
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':gui_editor', $value);
				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}
				$_SESSION['juassi_user_data'][$index_name] = $value;
			break;

			case 'contact':
				$value = (int) $value;
				$query = "UPDATE $juassi_tb->users SET contact = :contact WHERE user_id = :user_id";
				$stmt = $juassi_db->prepare($query);
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':contact', $value);
				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}
				$_SESSION['juassi_user_data'][$index_name] = $value;

			break;

			case 'email':
				$query = "UPDATE $juassi_tb->users SET email = :email WHERE user_id = :user_id";
				$stmt = $juassi_db->prepare($query);
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':email', $value);
				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}
				$_SESSION['juassi_user_data'][$index_name] = $value;

			break;

			case 'website':
				$query = "UPDATE $juassi_tb->users SET website = :website WHERE user_id = :user_id";
				$stmt = $juassi_db->prepare($query);
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':website', $value);
				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}
				$_SESSION['juassi_user_data'][$index_name] = $value;

			break;

			case 'display_name':
				$query = "UPDATE $juassi_tb->users SET display_name = :display_name WHERE user_id = :user_id";
				$stmt = $juassi_db->prepare($query);
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':display_name', $value);
				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}
				$_SESSION['juassi_user_data'][$index_name] = $value;

			break;

			case 'password':
				$value = md5($value);
				$query = "UPDATE $juassi_tb->users SET password = :password WHERE user_id = :user_id";
				$stmt = $juassi_db->prepare($query);
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':password', $value);
				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}

			break;
		}
		return true;
	}
	else {
		return false;
	}

}

function juassi_is_logged_in() {

	if (juassi_get_user_data('user_name')) {
		return true;
	}
	else {
		return false;
	}

}

function juassi_feed_comments_setup() {
	global $juassi_comment_array;

	$juassi_content_identifier['limit'] = 10;
	$juassi_content_identifier['order'] = 1;
	$juassi_content_identifier['get_posts'] = true;

	$juassi_comments = new juassi_comments();
	$juassi_comment_array = $juassi_comments->get_comments($juassi_content_identifier);

}
function juassi_trigger_error($error_number, $error_string, $error_file, $error_line, $error_context = '') {
	global $juassi_log;

	switch ($error_number) {
		case E_USER_ERROR:
			$array['event_severity'] = 'error';
		break;

		case E_USER_WARNING:
			$array['event_severity'] = 'warning';
		break;

		case E_USER_NOTICE:
			$array['event_severity'] = 'notice';
		break;

		default:
			$array['event_severity'] = 'debug';
	}

	$array['event_number'] = $error_number;
	$array['event_description'] = $error_string;
	$array['event_file'] = $error_file;
	$array['event_file_line'] = $error_line;
	$array['event_type'] = 'unknown';
	$array['event_source'] = 'unknown';
	$array['event_version'] = '1';

	if ($array['event_severity'] == 'error') {
		$array['log_backtrace'] = true;
	}

	if (JUASSI_DEBUG && $array['event_severity'] == 'debug') {
		$juassi_log->add($array);
	}
	else if ($array['event_severity'] !== 'debug') {
		$juassi_log->add($array);
	}

	return true;
}
function juassi_error_report($error_number, $error_string, $error_file, $error_line, $error_context) {
		global $juassi_db, $juassi_tb;

		if (JUASSI_DEBUG) {
			echo '<br />' . $error_number . ': ' . $error_string .  ' in <b>' . $error_file . '</b> on line <b>' . $error_line . '</b>';
		}

		$user_id 		= (int) juassi_get_user_data('user_id');
		$datetime		= juassi_datetime();
		$datetime_utc	= juassi_datetime_utc();
		$ip_address		= juassi_ip_address();

		switch ($error_number) {
		  case E_USER_ERROR:

				$type = 'ERROR';

				/*
				Get the backtrace here
				*/
				ob_start();
				debug_print_backtrace();
				$trace = ob_get_contents();
				ob_end_clean();

		  		$stmt = $juassi_db->prepare("INSERT INTO $juassi_tb->events
				(user_id, event_date, event_date_utc, file, file_line, type, ip_address, event_no, description, trace) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bindParam(1, $user_id);
				$stmt->bindParam(2, $datetime, PDO::PARAM_STR);
				$stmt->bindParam(3, $datetime_utc, PDO::PARAM_STR);
				$stmt->bindParam(4, $error_file);
				$stmt->bindParam(5, $error_line);
				$stmt->bindParam(6, $type);
				$stmt->bindParam(7, $ip_address, PDO::PARAM_STR);
				$stmt->bindParam(8, $error_number);
				$stmt->bindParam(9, $error_string);
				$stmt->bindParam(10, $trace);

				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}

		   break;
		  case E_USER_WARNING:

		  		$type = 'WARNING';

				$stmt = $juassi_db->prepare("INSERT INTO $juassi_tb->events
				(user_id, event_date, event_date_utc, file, file_line, type, ip_address, event_no, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bindParam(1, $user_id);
				$stmt->bindParam(2, $datetime, PDO::PARAM_STR);
				$stmt->bindParam(3, $datetime_utc, PDO::PARAM_STR);
				$stmt->bindParam(4, $error_file);
				$stmt->bindParam(5, $error_line);
				$stmt->bindParam(6, $type);
				$stmt->bindParam(7, $ip_address, PDO::PARAM_STR);
				$stmt->bindParam(8, $error_number);
				$stmt->bindParam(9, $error_string);

				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}

			break;
		  case E_USER_NOTICE:

				$type = 'NOTICE';

		  		$stmt = $juassi_db->prepare("INSERT INTO $juassi_tb->events
				(user_id, event_date, event_date_utc, file, file_line, type, ip_address, event_no, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$stmt->bindParam(1, $user_id);
				$stmt->bindParam(2, $datetime, PDO::PARAM_STR);
				$stmt->bindParam(3, $datetime_utc, PDO::PARAM_STR);
				$stmt->bindParam(4, $error_file);
				$stmt->bindParam(5, $error_line);
				$stmt->bindParam(6, $type);
				$stmt->bindParam(7, $ip_address, PDO::PARAM_STR);
				$stmt->bindParam(8, $error_number);
				$stmt->bindParam(9, $error_string);

				try {
					$stmt->execute();
				}
				catch (Exception $e) {
					juassi_die($e->getMessage());
				}

			break;
		  default:
		  		if(JUASSI_LOG_ALL) {
				}
		   break;
		}

}
function juassi_uuid()
/* Copyright 2012 Juan Carlos Reyes C

   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
{
   // version 4 UUID
   return sprintf(
       '%08x-%04x-%04x-%02x%02x-%012x',
       mt_rand(),
       mt_rand(0, 65535),
       bindec(substr_replace(
           sprintf('%016b', mt_rand(0, 65535)), '0100', 11, 4)
       ),
       bindec(substr_replace(sprintf('%08b', mt_rand(0, 255)), '01', 5, 2)),
       mt_rand(0, 255),
       mt_rand()
   );
}

function juassi_check_time($time) {
	$pass = true;

	$time = explode(':', $time);

	if ($time[0] >= 0 && $time[0] <= 24 && $time[1] >= 0 && $time[1] <= 59 && $time[2] >= 0 && $time[2] <= 59) {
	}
	else {
		$pass = false;
	}
	if (array_key_exists(3, $time)) $pass = false;

	return $pass;
}

function juassi_check_date($date) {

	$date = explode('-', $date);
	if (!isset($date[0]) || !isset($date[1]) || !isset($date[2])) return false;
	if (!checkdate($date[1], $date[2], $date[0])) return false;
	if (array_key_exists(3, $date)) return false;

	return true;
}

function juassi_check_datetime($datetime) {

	$pass = true;
	$array = explode(' ', $datetime);

	if (!juassi_check_date($array[0])) $pass = false;
	if(array_key_exists(1, $array)) {
		if (!juassi_check_time($array[1])) $pass = false;
	}
	if (array_key_exists(2, $array)) $pass = false;

	return $pass;
}

function juassi_gzip() {

	if (JUASSI_OUTPUT_BUFFERING) {
		if (juassi_get_config('gzip') && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && extension_loaded('zlib')) {
			ob_start('ob_gzhandler');
			juassi_set_header('Content-Encoding: gzip');
			return true;
		}
		else {
			ob_start();
			return false;
		}
	}
	else {
		return false;
	}
}

function juassi_remove_end_slash($script_path) {

	if(substr($script_path, -1) == '/') {
		$script_path = substr($script_path, 0, strlen($script_path) - 1);
		$script_path = juassi_remove_end_slash($script_path);
	}
	return $script_path;
}

function juassi_check_email_address($email) {

	$email_pattern = '/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i';

	if (preg_match($email_pattern, $email)) {
		return true;
	}
	else {
		return false;
	}
}

function juassi_check_email_address_taken($user_id, $email) {
	global $juassi_db, $juassi_tb;
	$user_id = (int) $user_id;
	$query = "SELECT count(*) FROM $juassi_tb->users WHERE email = :email AND user_id != :user_id";
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(':user_id', $user_id);
	$stmt->bindParam(':email', $email);
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($count['count(*)'] != 0) {
		//already in list
		return true;
	}
	else {
		return false;
	}

}
function juassi_sanitize_user_name($user_name) {

		//converts username to lowercase.
		$user_name = strtolower($user_name);

		//only allow a-z, 0-9 - and _ characters.
		$user_name = preg_replace('([^a-z0-9_-])', '', $user_name);

		return $user_name;

}
function juassi_set_link($link_array) {
	global $juassi_db, $juassi_tb;

	$name = $link_array['link_name'];
	$url = $link_array['link_url'];
	$id = $link_array['link_id'];

	$query = "UPDATE $juassi_tb->links SET link_name = :name, link_url = :url WHERE link_id = :id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':url', $url);
	$stmt->bindParam(':id', $id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
}
function juassi_add_link($link_array) {
	global $juassi_db, $juassi_tb;

	$name = $link_array['link_name'];
	$url = $link_array['link_url'];
	$cat_id = $link_array['category_id'];

	$query = "INSERT INTO $juassi_tb->links (link_name, link_url, category_id) VALUES (:name, :url, :id)";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':url', $url);
	$stmt->bindParam(':id', $cat_id);

	try {
		$stmt->execute();
		return $juassi_db->lastInsertId();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
}
function juassi_add_link_category($category_array) {
	global $juassi_db, $juassi_tb;

	$description	= $category_array['category_name'];
	$name			= $category_array['category_x_name'];

	$query 			= "INSERT INTO $juassi_tb->link_categories (category_name, description) VALUES (:name, :description)";

	$stmt 			= $juassi_db->prepare($query);

	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':description', $description);

	try {
		$stmt->execute();
		return $juassi_db->lastInsertId();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

}

function juassi_delete_link_cateory($category_id) {
	global $juassi_db, $juassi_tb;

	$id				= (int) $category_id;

	$query = "DELETE FROM $juassi_tb->link_categories WHERE category_id = :id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	return true;
}

function juassi_edit_link_category($category_array) {
	global $juassi_db, $juassi_tb;

	$description	= $category_array['category_name'];
	$name			= $category_array['category_x_name'];
	$before			= $category_array['text_before_each'];
	$after			= $category_array['text_after_each'];
	$id				= (int) $category_array['category_id'];

	$query = "
		UPDATE $juassi_tb->link_categories
		SET description = :description, text_before_all = :before, text_after_all = :after, category_name = :name
		WHERE category_id = :id
	";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':description', $description);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':before', $before);
	$stmt->bindParam(':after', $after);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	return true;
}

function juassi_delete_link($link_id) {
	global $juassi_db, $juassi_tb;

	$query = "DELETE FROM $juassi_tb->links WHERE link_id = :id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $link_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
}
function juassi_send_trackback($trackback_array) {
	global $juassi_db, $juassi_tb;

	$trackback_url_temp		= $trackback_array['trackback_url'];
	$excerpt 				= $trackback_array['post_excerpt'];
	$post_url 				= $trackback_array['post_url'];
	$title 					= $trackback_array['post_title'];
	$blogname 				= juassi_get_config('name');

	$title 					= urlencode(stripslashes($title));
	$excerpt 				= urlencode(stripslashes($excerpt));
	$blog_name 				= urlencode(stripslashes($blogname));
	$url 					= urlencode($post_url);

	$query_string 			= "title=$title&url=$url&blog_name=$blog_name&excerpt=$excerpt";

	$trackback_url_array 	= explode(' ', $trackback_url_temp);

	for ($i = 0; $i < count($trackback_url_array); $i++) {

		$trackback_url 			= $trackback_url_array[$i];
		$trackback_url_only		= $trackback_url;

		$trackback_url = parse_url($trackback_url);
		if (!isset($trackback_url['port']) || empty($trackback_url['port'])) {
			$trackback_url['port'] = 80;
		}
		$http_request  = 'POST ' . $trackback_url['path'] . ($trackback_url['query'] ? '?'.$trackback_url['query'] : '') . " HTTP/1.0\r\n";
		$http_request .= 'Host: '. $trackback_url['host'] . "\r\n";
		$http_request .= 'Content-Type: application/x-www-form-urlencoded'."\r\n";
		$http_request .= 'Content-Length: ' . strlen($query_string) . "\r\n";
		$http_request .= 'User-Agent: Juassi/' . juassi_get_config('version') . "\r\n";
		$http_request .= "\r\n";
		$http_request .= $query_string;
		if ($fs = @fsockopen($trackback_url['host'], $trackback_url['port'], $errno, $errstr, 15)) {
			if (@fputs($fs, $http_request) === FALSE) {
				$trackback_error['code'] = 2;
			}
			else {
				$output = '';
				while (!feof($fs)) {
					$output .= fgets($fs, 128);
				}
				$output = juassi_parse_http_response($output);
				$trackback_error['code'] = 0;
			}
			@fclose($fs);
		}
		else {
			$trackback_error['code'] = 1;
		}
		switch ($trackback_error['code']) {

			case 0:
				try {
					$trackback_xml = new SimpleXMLElement($output);
					if (isset($trackback_xml->error)) {
						if ($trackback_xml->error == 0) {
							trigger_error('Trackback Successfully Send To "' . juassi_htmlentities($trackback_url_only) . '"', E_USER_NOTICE);
						}
						elseif ($trackback_xml->error == 1) {
							if (isset($trackback_xml->message)) {
								trigger_error(
									'Trackback Failed To Be Sent To "' . juassi_htmlentities($trackback_url_only) . '"<br />Error "' . juassi_htmlentities($trackback_xml->message) . '"',
									E_USER_WARNING
								);
							}
							else {
								trigger_error(
									'Trackback Failed To Be Sent To "' . juassi_htmlentities($trackback_url_only) . '"<br /> Unknown Error From Receiving Website',
									E_USER_WARNING
								);
							}
						}
						else {
							if (isset($trackback_xml->message)) {
								trigger_error(
									'Trackback Failed To Be Sent To "' . juassi_htmlentities($trackback_url_only) . '"<br /> Unknown Error "' . juassi_htmlentities($trackback_xml->message) . '"',
									E_USER_WARNING
								);
							}
							else {
								trigger_error(
									'Trackback Failed To Be Sent To "' . juassi_htmlentities($trackback_url_only) . '"<br /> Unknown Error From Receiving Website',
									E_USER_WARNING
								);
							}
						}
					}
				}
				catch (Exception $e) {
					trigger_error(
						'Trackback Failed To Be Sent To "' . juassi_htmlentities($trackback_url_only) . '"<br /> Unable To Read XML Response "' . juassi_htmlentities($e->getMessage()) . '"',
						E_USER_WARNING
					);
				}
			break;

			case 1:
				trigger_error(
					'Trackback Failed To Be Sent To "' . juassi_htmlentities($trackback_url_only) . '"<br /> Unable To Connect To Receiving Website',
					E_USER_WARNING
				);
			break;

			case 2:
				trigger_error(
					'Trackback Failed To Be Sent To "' . juassi_htmlentities($trackback_url_only) . '"<br /> Unable To Complete Connection To Receiving Website',
					E_USER_WARNING
				);
			break;

		}
	}
}
/*
	The following code is from http://us3.php.net/manual/en/function.fsockopen.php
*/
//
// Accepts provided http content, checks for a valid http response,
// unchunks if needed, returns http content without headers on
// success, false on any errors.
//
function juassi_parse_http_response($content=null) {
    if (empty($content)) { return false; }
    // split into array, headers and content.
    $hunks = explode("\r\n\r\n",trim($content));
    if (!is_array($hunks) or count($hunks) < 2) {
        return false;
        }
    $header  = $hunks[count($hunks) - 2];
    $body    = $hunks[count($hunks) - 1];
    $headers = explode("\n",$header);
    unset($hunks);
    unset($header);
    if (!juassi_validate_http_response($headers)) { return false; }
    if (in_array('Transfer-Coding: chunked',$headers)) {
        return trim(juassi_unchunk_http_response($body));
        } else {
        return trim($body);
        }
    }

//
// Validate http responses by checking header.  Expects array of
// headers as argument.  Returns boolean.
//
function juassi_validate_http_response($headers=null) {
    if (!is_array($headers) or count($headers) < 1) { return false; }
    switch(trim(strtolower($headers[0]))) {
        case 'http/1.0 100 ok':
        case 'http/1.0 200 ok':
        case 'http/1.1 100 ok':
        case 'http/1.1 200 ok':
            return true;
        break;
        }
    return false;
    }

//
// Unchunk http content.  Returns unchunked content on success,
// false on any errors...  Borrows from code posted above by
// jbr at ya-right dot com.
//
function juassi_unchunk_http_response($str=null) {
    if (!is_string($str) or strlen($str) < 1) { return false; }
    $eol = "\r\n";
    $add = strlen($eol);
    $tmp = $str;
    $str = '';
    do {
        $tmp = ltrim($tmp);
        $pos = strpos($tmp, $eol);
        if ($pos === false) { return false; }
        $len = hexdec(substr($tmp,0,$pos));
        if (!is_numeric($len) or $len < 0) { return false; }
        $str .= substr($tmp, ($pos + $add), $len);
        $tmp  = substr($tmp, ($len + $pos + $add));
        $check = trim($tmp);
        } while(!empty($check));
    unset($tmp);
    return $str;
}


if(!defined("_JUASSI_PAGE_NAME")){
	define("_JUASSI_PAGE_NAME", "Estadist&iacute;cas Globales");
}

// Mostrar Estadisticas Globales //


// START Time Measuring, load-time of the page (see config)
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;


// Functions to calculate Stats
function juassi_histcalc($array) {
        $result = 0;

        if (is_array($array)) {
          foreach ($array as $val) $result += $val;
        }
        return $result;
}

function juassi_rank_head($cat, $i18n, $flag = 0) {
        global $translation;

        return "<div class=\"span5\">
                    <div class=\"heading clearfix\">
                        <h3 class=\"pull-left\">".sprintf($translation[$i18n], $cat)."</h3>
                    </div>
                    <table class=\"table table-striped table-bordered\" id=\"smpl_tbl\">
                        <thead>
                            <tr style=\"background-color:#ebf2f6;\">
                                <td><strong>imagen</strong></td>
                                <td><strong>detalle</strong></td>
                                <td><strong>hits</strong></td>
                                <td><strong>porcentaje</strong></td>
                            </tr>
                        </thead>";
}


function juassi_list_item($icon, $item, $item_score, $total_score) {
        global $JUASSI_IMAGES_PATH;

        return "<tbody><tr>"
              .(!empty($icon) ? "<td><img src=\"".$JUASSI_IMAGES_PATH.$icon
              ."\" alt=\"$item\" title=\"$item\" />&nbsp;&nbsp;</td>" : "<td></td>")
              ."<td>$item&nbsp;</td>"
              ."<td>&nbsp;$item_score</td>"
              ."<td>&nbsp;".sprintf("%.2f%%", (round(10000 * $item_score / $total_score) / 100))."</td>"
              ."</tr></tbody>";
}

function juassi_rank_sum($cat, $flag = 0) {
        global $translation;

        return "<tr>"
              .(!empty($flag) ? "" : "
                <td>&nbsp;</td>")
              ."<td><b>".$translation['gstat_total']."</b>&nbsp;</td>"
              ."<td>&nbsp;<b>$cat</b></td>
                <td></td>"
              ."</tr></table></div>";
}

function juassi_refgen($ref) {
        global $translation;

        if ($ref == "not_specified") return "<i>".$translation['misc_ignored']."</i>";
        $ref_name = (($slash = strpos($ref, "/")) !== false) ? substr($ref, 0, $slash) : $ref;

        return "<script type=\"text/javascript\">"
              ."<!--\n"
              ."document.write('<a href=\"http://$ref\" rel=\"nofollow\" title=\"$ref_name\">$ref_name<\/a>');"
              ."-->"
              ."</script>"
              ."<noscript><span title=\"$ref_name\">$ref_name</span></noscript>";
}

function juassi_sort_page_count($page_a, $page_b) {
        if ($page_a['count'] === $page_b['count']) return 0;
        return (($page_a['count'] > $page_b['count']) ? -1 : 1);
}

// Main functions to generate Stats
function juassi_show_browser() {
        global $JUASSI_IMAGES_PATH, $JUASSI_LIB_PATH, $JUASSI_MAXBROWSER, $translation, $access;

        if (is_readable($JUASSI_LIB_PATH."browser.php")) require($JUASSI_LIB_PATH."browser.php");
        else return juassi_msg($JUASSI_LIB_PATH."browser.php");

        $browser_tab = isset($access['stat']['browser']) ? $access['stat']['browser'] : array();

        for ($browser_total = 0; list(, $browser_score) = each($browser_tab); $browser_total += $browser_score);

        arsort($browser_tab);
        reset($browser_tab);

        $str = juassi_rank_head($JUASSI_MAXBROWSER, "gstat_browsers");

        for ($k = 0; (list($browser_type, $browser_score) = each($browser_tab)) && ($k < $JUASSI_MAXBROWSER); $k++) {
          if (!isset($browser[$browser_type])) {
            $str.= juassi_list_item("browser/question.png", $browser_type, $browser_score, $browser_total, 'browser');
            continue;
          }

          $browser[$browser_type]['title'] = str_replace("other", $translation['misc_other'], $browser[$browser_type]['title']);

          $str.= juassi_list_item("browser/".$browser[$browser_type]['icon'].".png", $browser[$browser_type]['title'],
                           $browser_score, $browser_total, 'browser');
        }

        $str .= juassi_rank_sum($browser_total);
        return $str;
}

function juassi_show_os() {
        global $JUASSI_IMAGES_PATH, $JUASSI_LIB_PATH, $JUASSI_MAXOS, $translation, $access;

        if (is_readable($JUASSI_LIB_PATH."os.php")) require($JUASSI_LIB_PATH."os.php");
        else return juassi_msg($JUASSI_LIB_PATH."os.php");

        $os_tab = isset($access['stat']['os']) ? $access['stat']['os'] : array();

        for ($os_total = 0; list(, $os_score) = each($os_tab); $os_total += $os_score);

        arsort($os_tab);
        reset($os_tab);

        $str = juassi_rank_head($JUASSI_MAXOS, "gstat_operating_systems");

        for ($k = 0; (list($os_type, $os_score) = each($os_tab)) && ($k < $JUASSI_MAXOS); $k++) {
          if (!isset($os[$os_type])) {
            $str.= juassi_list_item("os/question.png", $os_type, $os_score, $os_total, 'os');
            continue;
          }

          $os[$os_type]['title'] = str_replace("other", $translation['misc_other'], $os[$os_type]['title']);

          $str .= juassi_list_item("os/".$os[$os_type]['icon'].".png", $os[$os_type]['title'], $os_score, $os_total, 'os');
        }

        $str .= juassi_rank_sum($os_total);
        return $str;
}

function juassi_show_extension() {
        global $access, $JUASSI_IMAGES_PATH, $JUASSI_MAXEXTENSION, $extensions, $translation;

        $ext_tab = isset($access['stat']['ext']) ? $access['stat']['ext'] : array();

        for ($ext_total = 0; list(, $ext_score) = each($ext_tab); $ext_total += $ext_score);

        arsort($ext_tab);
        reset($ext_tab);

        $str = juassi_rank_head($JUASSI_MAXEXTENSION, "gstat_extensions");

        for ($k = 0; (list($ext, $ext_score) = each($ext_tab)) && ($k < $JUASSI_MAXEXTENSION); $k++) {
          if (isset($extensions[$ext])) $label = $extensions[$ext];
          else $label = $ext;
          $str .= juassi_list_item("ext/".$ext.".png", $label, $ext_score, $ext_total, 'ext');
        }

        $str .= juassi_rank_sum($ext_total);
        return $str;
}

function juassi_show_robot() {
        global $access, $JUASSI_IMAGES_PATH, $JUASSI_LIB_PATH, $JUASSI_MAXROBOT, $translation;

        if (is_readable($JUASSI_LIB_PATH."robot.php")) require($JUASSI_LIB_PATH."robot.php");
        else return juassi_msg($JUASSI_LIB_PATH."robot.php");

        $robot_tab = isset($access['stat']['robot']) ? $access['stat']['robot'] : array();

        for ($robot_total = 0; list(,$robot_score) = each($robot_tab); $robot_total += $robot_score);

        arsort($robot_tab);
        reset($robot_tab);

        $str = juassi_rank_head($JUASSI_MAXROBOT, "gstat_robots");

        for ($k = 0; (list($robot_type, $robot_score) = each($robot_tab)) && ($k < $JUASSI_MAXROBOT); $k++) {
          if (!isset($robot[$robot_type])) {
            $str.= juassi_list_item("robot/robot.png", $robot_type, $robot_score, $robot_total, 'robot');
            continue;
          }

          $str .= juassi_list_item("robot/".$robot[$robot_type]['icon'].".png", $robot[$robot_type]['title'], $robot_score, $robot_total, 'robot');
        }

        $str .= juassi_rank_sum($robot_total);
        return $str;
}

function juassi_show_top_hosts() {
        global $access, $JUASSI_MAXHOST;

        $host_tab = isset($access['host']) ? $access['host'] : array();

        for ($host_total = 0; list(, $host_score) = each($host_tab); $host_total += $host_score);

        arsort($host_tab);
        reset($host_tab);

        $str = juassi_rank_head($JUASSI_MAXHOST, "gstat_hosts", 1);

        for ($k = 0; ($k < $JUASSI_MAXHOST) && (list($host_name, $host_score) = each($host_tab)); $k++) {
          $str .= juassi_list_item("", $host_name, $host_score, $host_total, 'hosts');
        }

        $str .= juassi_rank_sum($host_total);
        return $str;
}

function juassi_show_top_pages() {
        global $JUASSI_MAXPAGE, $translation, $access;

        $page_tab = isset($access['page']) ? $access['page'] : array();

        for ($page_total = 0; list(, $page_elem) = each($page_tab); $page_total += $page_elem['count']);

        uasort($page_tab, "juassi_sort_page_count");
        reset($page_tab);

        $str = juassi_rank_head($JUASSI_MAXPAGE, "gstat_pages", 1);

        for ($k = 0; (list($page_name, $page_elem) = each($page_tab)) && ($k < $JUASSI_MAXPAGE); $k++) {
          $page_name = ($page_name == "index") ? $translation['navbar_main_site'] : $page_name;

          $str .= juassi_list_item("", "<a href=\"".$page_elem['uri']."\">$page_name</a>", $page_elem['count'], $page_total, 'pages');
        }

        $str .= juassi_rank_sum($page_total);
        return $str;
}

function juassi_show_top_origins() {
        global $JUASSI_MAXORIGIN, $translation, $access;

        $referer_tab = isset($access['referer']) ? $access['referer'] : array();

        for ($referer_total = 0; list(, $referer_score) = each($referer_tab); $referer_total += $referer_score);

        arsort($referer_tab);
        reset($referer_tab);

        $str = juassi_rank_head($JUASSI_MAXORIGIN, "gstat_origins", 1);

        for ($k = 0; ($k < $JUASSI_MAXORIGIN) && (list($referer_name, $referer_score) = each($referer_tab)); $k++) {
          $str .= juassi_list_item("", juassi_refgen($referer_name), $referer_score, $referer_total, 'origins');
        }

        $str .= juassi_rank_sum($referer_total);
        return $str;
}

function juassi_show_top_keys() {
        global $JUASSI_MAXKEY, $translation, $access;

        $key_tab = isset($access['key']) ? $access['key'] : array();

        for ($key_total = 0; list(, $key_score) = each($key_tab); $key_total += $key_score);

        arsort($key_tab);
        reset($key_tab);

        $str = juassi_rank_head($JUASSI_MAXKEY, "gstat_keys", 1);

        for ($k = 0; ($k < $JUASSI_MAXKEY) && (list($key_name, $key_score) = each($key_tab)); $k++) {
          $str .= juassi_list_item("", $key_name, $key_score, $key_total, 'keys');
        }

        $str .= juassi_rank_sum($key_total);
        return $str;
}

function juassi_show_access() {
  global $translation, $access;

  return "<div class=\"row-fluid\">
    <div class=\"span12\">
      <h3 class=\"heading clearfix\">".$translation['gstat_accesses']."</h3>
    </div>
         <table class=\"table table-bordered table-striped\" id=\"smpl_tbl\" >
            <thead>
                <tr style=\"background-color:#ebf2f6;\">
                    <td class=\"optional\"><b>".$translation['tstat_last_year']."&nbsp;&nbsp;</b></td>
                    <td class=\"optional\"><b>".$translation['tstat_last_month']."&nbsp;&nbsp;</b></td>
                    <td class=\"optional\"><b>".$translation['tstat_last_week']."&nbsp;&nbsp;</b></td>
                    <td class=\"optional\"><b>".$translation['tstat_last_day']."&nbsp;&nbsp;</b></td>
                    <td class=\"optional\"><b>".$translation['gstat_total_visits']."</b>&nbsp;&nbsp;"."</b></td>
                    <td class=\"optional\"><b>".$translation['gstat_total_unique']."</b>&nbsp;&nbsp;</b></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>".(!empty($access['time']['month']) ? juassi_histcalc($access['time']['month']) : "0")."</td>
                    <td>".((!empty($access['time']['month'])) ? juassi_histcalc($access['time']['day']) : "0")."</td>
                    <td>".(!empty($access['time']['wday']) ? juassi_histcalc($access['time']['wday']) : "0")."</td>
                    <td>".(!empty($access['time']['wday']) ? juassi_histcalc($access['time']['hour']) : "0")."</td>
                    <td><b>".(!empty($access['stat']['totalvisits']) ? $access['stat']['totalvisits'] : "0")."</b></td>
                    <td><b>".(!empty($access['stat']['totalcount']) ? $access['stat']['totalcount'] : "0")."</b></td>
                </tr>
             </tbody>
        </table>
  </div>";
}


function dbAll($query, $key=''){
    $q=dbQuery($query);
    $results = array();
    while($r=$q->fetch(PDO::FETCH_ASSOC))
        $results[] = $r;
    if(!$key)
        return $results;
    $arr = array();
    foreach($results as $r)
        $arr[$r[$key]] = $r;
    return $arr;
}

function dbQuery($query){
    global $juassi_db, $juassi_tb;
    $q=$juassi_db->query($query);
    $juassi_db->num_queries++;
    return $q;
}
?>