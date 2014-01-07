<?php
/*
	SOAP Functions
*/
function juassi_soap_logout() {
	return juassi_logout();
}

//common function used for all soap sites
function juassi_soap_common() {

	$array[] = array('name' => 'site_type', 'value' => 'juassi_blog');
	$array[] = array('name' => 'site_program_version', 'value' => juassi_get_config('program_version'));
	$array[] = array('name' => 'site_database_version', 'value' => juassi_get_config('database_version'));
	$array[] = array('name' => 'site_name', 'value' => juassi_get_config('name'));
	$array[] = array('name' => 'site_address', 'value' => juassi_get_config('address'));

	$array[] = array('name' => 'site_api_version', 'value' => '1.1');

	//version 1.1

	/*
		Supported Functions tells the server what can be called on the remote site
		"Common Name", "SOAP Function"
	*/

	$functions = array(
		array('get_config', 'juassi_get_config'),
	);

	$serialized_functions = serialize($functions);

	$array[] = array('name' => 'supported_functions', 'value' => $serialized_functions);

	/*
		Supported Features tells the server what other features the remote site supports
	*/

	$features = array(
		array('remote_access', '1'),
		array('receive_events', '1'),
		array('push_events', '1'),
	);

	$serialized_features = serialize($features);

	$array[] = array('name' => 'supported_features', 'value' => $serialized_features);


	return $array;
}

//run on SOAP server
function juassi_soap_unregister_site() {
	global $juassi_db, $juassi_tb;

	$soap_client_id = juassi_get_user_data('soap_client_id');

	$query = "UPDATE $juassi_tb->soap_clients SET registered = 0, remote_site_id = '' WHERE soap_client_id = :id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $soap_client_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
	trigger_error('Site Unregistered', E_USER_NOTICE);
	return 1;
}

//run locally (on server)
function juassi_soap_add_site($site_details) {
	global $juassi_db, $juassi_tb;

	$site_id 	= $site_details['site_id'];
	$user_id 	= $site_details['user_id'];
	$nickname 	= $site_details['nickname'];

	$query = "INSERT INTO $juassi_tb->soap_clients (local_site_id, user_id, registered, server, nickname) VALUES (:site_id, :user_id, 0, 0, :nickname)";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':site_id', $site_id);
	$stmt->bindParam(':user_id', $user_id);
	$stmt->bindParam(':nickname', $nickname);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	return true;
}

function juassi_add_sites_config($config_array) {
	global $juassi_db, $juassi_tb;

	$soap_client_id	= $config_array['soap_client_id'];
	$config_type	= $config_array['config_type'];
	$config_name	= $config_array['config_name'];
	$config_value	= $config_array['config_value'];

	if (is_array($config_value)) {
		$config_value = serialize($config_value);
	}

	$query = "INSERT INTO $juassi_tb->sites (soap_client_id, config_type, config_value, config_name) VALUES (:id, :type, :value, :name)";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $soap_client_id);
	$stmt->bindParam(':type', $config_type);
	$stmt->bindParam(':value', $config_value);
	$stmt->bindParam(':name', $config_name);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
}

function juassi_set_sites_config($config_array) {
	global $juassi_db, $juassi_tb;

	$soap_client_id	= $config_array['soap_client_id'];
	$config_type	= $config_array['config_type'];
	$config_name	= $config_array['config_name'];
	$config_value	= $config_array['config_value'];

	$query = "UPDATE $juassi_tb->sites SET config_value = :value WHERE 'soap_client_id' = :id AND 'config_type' = :type AND 'config_name' = :name";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $soap_client_id);
	$stmt->bindParam(':type', $config_type);
	$stmt->bindParam(':name', $config_name);
	$stmt->bindParam(':value', $config_value);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
}

function juassi_get_sites_config($config_array) {
	global $juassi_db, $juassi_tb;

	$query = "SELECT config_value FROM $";
}

function juassi_get_sites_common($soap_client_id) {
	global $juassi_db;
	global $juassi_tb;
	
	//$query = "SELECT * FROM $juassi_tb->sites WHERE soap_client_id = '5' AND config_type = 'common'";
	
	$query = "SELECT * 
			  FROM jb2_sites
			  WHERE soap_client_id =  '$soap_client_id'
			  AND config_type =  'common'";

	$stmt = $juassi_db->prepare($query);

	//$stmt->bindParam(':id', $soap_client_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$common = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($common as $result) {
		$config[$result['config_name']] = $result['config_value'];
	}

	return $config;

}

function juassi_update_sites_config($config_array) {
	global $juassi_db, $juassi_tb;

	$soap_client_id	= $config_array['soap_client_id'];
	$config_type	= $config_array['config_type'];
	$config_name	= $config_array['config_name'];
	$config_value	= $config_array['config_value'];

	$query = "SELECT count(*) as 'count' FROM $juassi_tb->sites WHERE soap_client_id = :id AND config_type = :type AND config_name = :name";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $soap_client_id);
	$stmt->bindParam(':type', $config_type);
	$stmt->bindParam(':name', $config_name);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($count['count'] == 1) {
		juassi_set_sites_config($config_array);
	}
	else {
		juassi_add_sites_config($config_array);
	}

}

function juassi_soap_delete_site($soap_client_id) {
	global $juassi_db, $juassi_tb, $juassi_log;

	//delete account
	$query = "DELETE FROM $juassi_tb->soap_clients WHERE soap_client_id = :soap_client_id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':soap_client_id', $soap_client_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	//delete settings
	$query = "DELETE FROM $juassi_tb->sites WHERE soap_client_id = :soap_client_id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':soap_client_id', $soap_client_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	//delete events
	$juassi_log->clear($soap_client_id);

	return true;
}

//run locally
function juassi_soap_update_server($server_details) {
	global $juassi_db, $juassi_tb;

	$site_id 	= $server_details['site_id'];
	$id			= $server_details['soap_client_id'];

	$query = "UPDATE $juassi_tb->soap_clients SET local_site_id = :site_id";

	if (isset($server_details['nickname'])) {
		$query .= ", nickname = :nickname";
	}

	if (isset($server_details['remote_site_id'])) {
		$query .= ", remote_site_id = :remote_site_id";
	}
	if (isset($server_details['site_soap_url'])) {
		$query .= ", site_soap_url = :site_soap_url";
	}

	$query .= " WHERE soap_client_id = :id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':site_id', $site_id);
	$stmt->bindParam(':id', $id);

	if (isset($server_details['nickname'])) {
		$stmt->bindParam(':nickname', $server_details['nickname'], PDO::PARAM_STR);
	}
	if (isset($server_details['remote_site_id'])) {
		$stmt->bindParam(':remote_site_id', $server_details['remote_site_id'], PDO::PARAM_STR);
	}
	if (isset($server_details['site_soap_url'])) {
		$stmt->bindParam(':site_soap_url', $server_details['site_soap_url'], PDO::PARAM_STR);
	}

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}


}

//run locally
function juassi_soap_register_server($server_details) {
	global $juassi_db, $juassi_tb;

	$site_id	= $server_details['site_id'];
	$site_type	= $server_details['site_type'];
	$site_url	= $server_details['site_soap_url'];
	$user_id	= $server_details['user_id'];

	$query = "
		INSERT INTO
		$juassi_tb->soap_clients
		(remote_site_id, site_type, site_soap_url, user_id, registered, server)
		VALUES
		(:site_id, :site_type, :url, :user_id, 1, 1)
	";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':site_id', $site_id);
	$stmt->bindParam(':site_type', $site_type);
	$stmt->bindParam(':url', $site_url);
	$stmt->bindParam(':user_id', $user_id);

	try {
		$stmt->execute();
		$server_id = $juassi_db->lastInsertId();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	juassi_set_config('soap_server_id', $server_id);

	return true;

}

//run locally
function juassi_soap_unregister_server($server_id) {
	global $juassi_db, $juassi_tb;

	juassi_set_config('soap_server_id', '');

	$query = "DELETE FROM $juassi_tb->soap_clients WHERE soap_client_id = :id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $server_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	return true;

}

//run on SOAP server. This allows the server to remotely connect to the client
function juassi_soap_register_client($client_details) {
	global $juassi_db, $juassi_tb;

	$site_id		= $client_details['site_id'];
	$url			= $client_details['site_soap_url'];
	$soap_client_id = juassi_get_user_data('soap_client_id');

	$query = "UPDATE $juassi_tb->soap_clients SET remote_site_id = :site_id, site_soap_url = :url WHERE soap_client_id = :id";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':site_id', $site_id);
	$stmt->bindParam(':url', $url);
	$stmt->bindParam(':id', $soap_client_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
	trigger_error('Client Registered', E_USER_NOTICE);

	$return['success']			= 1;
	$return['message']			= 'Success';

	return $return;

}

//run locally
function juassi_soap_register_client_site($connect_array) {
	$register_client	= new juassi_soap($connect_array['url']);
	unset($connect_array['url']);
	$result = $register_client->call('juassi_soap_register_site', array($connect_array));

	return $result;
}

//run on SOAP server
function juassi_soap_register_site($registration_details) {
	global $juassi_db, $juassi_tb;

	$username 	= $registration_details['username'];
	$password 	= md5($registration_details['password']);
	$site_type	= $registration_details['site_type'];
	$site_id	= $registration_details['site_id'];

	$query = "
		SELECT count(*) as `count`, $juassi_tb->soap_clients.soap_client_id AS `id`
		FROM $juassi_tb->users, $juassi_tb->soap_clients
		WHERE $juassi_tb->users.user_name = :username
		AND $juassi_tb->users.password = :password
		AND $juassi_tb->users.active = 1
		AND $juassi_tb->soap_clients.local_site_id = :site_id
		AND $juassi_tb->soap_clients.user_id = $juassi_tb->users.user_id
		AND $juassi_tb->soap_clients.registered = 0
	";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->bindParam(':site_id', $site_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$count = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($count['count'] == 1) {
		$query = "UPDATE $juassi_tb->soap_clients SET registered = 1, site_type = :site_type, server = 0 WHERE soap_client_id = :id";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(':id', $count['id']);
		$stmt->bindParam(':site_type', $site_type);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		trigger_error('Site Registered', E_USER_NOTICE);

		$registration_results['site_type'] 	= 'juassi_blog';
		$registration_results['success'] 	= 1;
		$registration_results['message']	= 'Registration Successful.';
	}
	else {
		$registration_results['site_type'] 	= '';
		$registration_results['success'] 	= 0;
		$registration_results['message']	= 'Unable to register site.';
	}

	return $registration_results;

}

//either
function juassi_get_soap_site($soap_client_id) {
	global $juassi_db, $juassi_tb;

	$query = "
		SELECT $juassi_tb->soap_clients.*, $juassi_tb->users.user_name as 'username'
		FROM $juassi_tb->soap_clients, $juassi_tb->users
		WHERE $juassi_tb->soap_clients.soap_client_id = :id
		AND $juassi_tb->soap_clients.user_id = $juassi_tb->users.user_id LIMIT 1
	";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':id', $soap_client_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$site = $stmt->fetch(PDO::FETCH_ASSOC);

	return $site;
}

//either
function juassi_get_soap_sites($array) {
	global $juassi_db, $juassi_tb;

	$server = $array['server'];

	//$query = "SELECT $juassi_tb->soap_clients.*,$juassi_tb->users.user_id FROM $juassi_tb->soap_clients, $juassi_tb->users WHERE server = :server AND $juassi_tb->soap_clients.user_id = $juassi_tb->users.user_id ORDER BY last_connected DESC";
	
	
	$query = "SELECT $juassi_tb->soap_clients . * , $juassi_tb->users.user_id
			  FROM $juassi_tb->soap_clients, $juassi_tb->users
			  WHERE server = $server
			  AND $juassi_tb->soap_clients.user_id = $juassi_tb->users.user_id
			  ORDER BY last_connected DESC 
			  LIMIT 0 , 30";
	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':server', $server);
	
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$sites = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $sites;
}

//run on SOAP server
function juassi_soap_login($authentication_details) {
	global $juassi_db, $juassi_tb, $juassi_session;

	$username 	= $authentication_details['username'];
	$site_id 	= $authentication_details['site_id'];

	$query = "
		SELECT $juassi_tb->users.*, $juassi_tb->soap_clients.soap_client_id AS 'soap_client_id'
		FROM $juassi_tb->users, $juassi_tb->soap_clients
		WHERE $juassi_tb->users.user_name = :username
		AND $juassi_tb->users.active = 1
		AND $juassi_tb->soap_clients.local_site_id = :site_id
		AND $juassi_tb->soap_clients.user_id = $juassi_tb->users.user_id
		AND $juassi_tb->soap_clients.registered = 1
	";

	$stmt = $juassi_db->prepare($query);

	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':site_id', $site_id);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}

	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if (!empty($user)) {
		$juassi_session->regenerate_id();
		trigger_error('Connector Login Successful "' . juassi_htmlentities($username) . '"', E_USER_NOTICE);

		//setup session here
		$user_array = array(
			'user_id' 			=> $user[0]['user_id'],
			'soap_client_id'	=> $user[0]['soap_client_id'],
			'site_id'			=> $site_id
		);

		$_SESSION['juassi_user_data'] = $user_array;

		$date = juassi_datetime();

		$query = "UPDATE $juassi_tb->soap_clients SET last_connected = :date WHERE soap_client_id = :soap_client_id";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(':soap_client_id', $user[0]['soap_client_id']);
		$stmt->bindParam(':date', $date);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$logged_in = true;
	}
	else {
		trigger_error('Connector Login Failed (Unknown User or Unknown Site ID) "' . juassi_htmlentities($user_name) . '"', E_USER_WARNING);
		$logged_in = false;
	}

	if ($logged_in) {
		$return['session_id'] 		= session_id();
		$return['session_name'] 	= 'soap_sid';
		$return['success']			= 1;
		$return['message']			= 'Welcome, please remember to logout when you are finished.';
	}
	else {
		$return['session_id'] 		= '';
		$return['session_name'] 	= '';
		$return['success']			= 0;
		$return['message']			= 'Incorrect Username/Password or Site ID.';
	}

	return $return;

}
//client side
function juassi_soap_push_events() {
	//push events to remove server
	$juassi_soap_connection		= new juassi_soap_client();
	if ($juassi_soap_connection->is_connected()) {
		$result = $juassi_soap_connection->push_events();
		return $result;
	}
	return false;
}
//client side
function juassi_soap_push_common() {
	//push common to remove server
	$juassi_soap_connection		= new juassi_soap_client();
	if ($juassi_soap_connection->is_connected()) {
		$result = $juassi_soap_connection->push_common();
		return $result;
	}
	return false;
}
//server side
function juassi_soap_receive_events($events) {
	global $juassi_log;

	$client_id = juassi_get_user_data('soap_client_id');

	if (is_array($events)) {
		foreach ($events as $event) {
			$event['server_id'] = $client_id;
			$juassi_log->add($event);
		}
		$return['success']			= 1;
		$return['message']			= count($events) . ' Events Received';
	}
	else {
		$return['success']			= 0;
		$return['message']			= 'Error Receiving Events';
	}

	$event_array['event_file'] = __FILE__;
	$event_array['event_file_line'] = __LINE__;
	$event_array['event_type'] = 'success';
	$event_array['event_number'] = E_USER_NOTICE;
	$event_array['event_source'] = 'soap_client';
	$event_array['event_severity'] = 'notice';
	$event_array['event_description'] = 'Events Received "' . count($events) . '"';

	$juassi_log->add($event_array);

	return $return;

}
//server side
function juassi_soap_receive_common($result_array) {
	global $juassi_log;

	if (is_array($result_array)) {

		foreach ($result_array as $result) {
				$common_array[$result['name']] = $result['value'];
		}

		$client_id = juassi_get_user_data('soap_client_id');

		foreach ($common_array as $index => $value) {
			$config_array['soap_client_id'] = $client_id;
			$config_array['config_type']	= 'common';
			$config_array['config_name']	= $index;
			$config_array['config_value']	= $value;
			juassi_update_sites_config($config_array);
		}
		$return['success']			= 1;
		$return['message']			= 'Common Received';

	}
	else {
		$return['success']			= 0;
		$return['message']			= 'Error Receiving Common';
	}

	return $return;
}
?>