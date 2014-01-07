<?php

function juassi_current_file() {

	return substr($_SERVER['PHP_SELF'], strlen(juassi_get_config('script_path') . JUASSI_ADMIN . '/'));

}

function juassi_admin_message($message) {

	$output = '<div class="tablecontain">' . $message . '</div>';

	return $output;
}

function juassi_total_comment_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->comments WHERE comment_approved = 1";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(*)'];

}
/*
function juassi_total_eventCalendar_count(){
    global $juassi_db, $juassi_tb;
    
    $query = "SELECT count(*) FROM blog_eventer WHERE status = 1";
    $stmt = $juassi_db->prepare($query);
    
    try {
            $stmt->execute();
    }
    catch (Exception $e) {
            juassi_die($e->getMessage());
    }
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return (int) $count['count(*)'];
    
}


*/


function juassi_total_listMail_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(MessageId) FROM juassi2_messages WHERE FolderId=1";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(MessageId)'];

}

function juassi_total_mail_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(MessageId) FROM juassi2_messages WHERE FolderId=1 and Unread=1";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(MessageId)'];

}

function juassi_total_mailTrash_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(MessageId) FROM juassi2_messages WHERE FolderId=2";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(MessageId)'];

}

function juassi_total_post_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->posts WHERE post_type = 'published'";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(*)'];

}

function juassi_total_mod_comment_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->comments WHERE comment_approved = 0";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(*)'];

}

function juassi_total_event_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->events";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(*)'];

}

function juassi_total_users_count() {
	global $juassi_db, $juassi_tb;

	$query = "SELECT count(*) FROM $juassi_tb->users";
	$stmt = $juassi_db->prepare($query);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	return (int) $count['count(*)'];

}

function juassi_last_10_events() {
	global $juassi_log;

	$array['limit'] = 10;

	$events = $juassi_log->get($array);

	return $events;
}

function juassi_admin_upgrade_message() {
	global $juassi_database_version, $juassi_program_version;

	try {
		if (juassi_get_config('database_version') == $juassi_database_version && juassi_get_config('program_version') == $juassi_program_version) {
			$xml = new SimpleXMLElement(juassi_get_config('last_update_response'));
			$version = juassi_get_config('program_version');
			$version = explode('-', $version);
			if (version_compare($version[0], $xml->version, '<')) {
				$message = 'There is a new version of Juassi available, ' . juassi_htmlentities($xml->version) . '.';
				if ($xml->download) {
					$message .= ' It can be downloaded from <strong><a href="'.juassi_htmlentities($xml->download).'">here</a></strong>.';
					$message .= ' Please make sure you read upgrade.txt contained within the package before you upgrade.';
				}
				return $message;
			}
		}
		else {
			$message = 'Your database needs updating click <a href="upgrade.php">here</a> to upgrade.';
			return $message;
		}
	}
	catch (Exception $e) {
		//echo($e->getMessage());
	}
	return false;

}

function juassi_return_site() {

	$site_length = strlen(juassi_get_config('address'));
	if (isset($_SERVER['HTTP_REFERER']) && !strncmp($_SERVER['HTTP_REFERER'], juassi_get_config('address'), $site_length)) {
		$return = juassi_htmlentities($_SERVER['HTTP_REFERER']);
	}
	else {
		$return = false;
	}

	return $return;
}

//displays a back link. If HTTP_REFERER is disabled then redirect to $url,
//otherwise back to admin index
function juassi_admin_url_back($url = '') {
	$return_site = juassi_return_site();
	if ($return_site) {
		$url_array = parse_url($return_site);
		if (!array_key_exists('query', $url_array)) $url_array['query'] = '';
		if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']) && $url_array['query'] == $_SERVER['QUERY_STRING']) {
			if (!empty($url)) {
				return '<a href="'. $url .'">&laquo; Back</a>';
			}
			else {
				return '<a href="'. juassi_get_config('address'). JUASSI_ADMIN . '/">&laquo; Back</a>';
			}
		}
		else {
			return '<a href="'. $return_site .'">&laquo; Back</a>';
		}
	}
	elseif (!empty($url)) {
		return '<a href="'. $url .'">&laquo; Back</a>';
	}
	else {
		return '<a href="'. juassi_get_config('address'). JUASSI_ADMIN . '/">&laquo; Back</a>';
	}
}

function customerDate(){
    return '
        <script language="javascript">
    var Hoy=new Date()
    var Dias=new Array(
      "Domingo","Lunes","Martes",
      "Mi&eacute;rcoles","Jueves",
      "Viernes","S&aacute;bado")
    var Meses=new Array(
      "Ene","Feb","Mar",
      "Abr","May","Jun",
      "Jul","Ago","Sep",
      "Oct","Nov","Dic")
    document.write(
                   Hoy.getDate() + " " +
                   Meses[Hoy.getMonth()] + " " +
                   Hoy.getFullYear())
  </script>';
}

function customerTime(){
    return '
        <script language="javascript">
    var Hoy=new Date()
    document.write(
                   Hoy.getHours() + ":" +
                   Hoy.getMinutes())
  </script>';
}

?>