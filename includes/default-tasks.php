<?php
/*
	Juassi 2.0 Default Tasks
	Juan Carlos Reyes C Copyright 2012
*/

if (!defined('JUASSI_ROOT')) exit;

//html filter
juassi_add_task(JUASSI_PLUGIN_NAME, 'common_loaded', 'juassi_load_kses');

//404 handler
juassi_add_task(JUASSI_PLUGIN_NAME, '404', 'juassi_404');

//Cron system
juassi_add_task(JUASSI_PLUGIN_NAME, 'shutdown', 'juassi_run_cron');

//default cron tasks
juassi_add_task(JUASSI_PLUGIN_NAME, 'cron_every_hour', 'juassi_future_post');
juassi_add_task(JUASSI_PLUGIN_NAME, 'cron_every_hour', 'juassi_session_garbage_collection');
juassi_add_task(JUASSI_PLUGIN_NAME, 'cron_every_day', 'juassi_update_check');
juassi_add_task(JUASSI_PLUGIN_NAME, 'cron_every_day', 'juassi_update_check_plugins');
juassi_add_task(JUASSI_PLUGIN_NAME, 'cron_every_month', 'juassi_monthly_maintenance');

//text editor
juassi_add_task(JUASSI_PLUGIN_NAME, 'admin_text_editor', 'juassi_text_editor');

/*
	Default Themed Content Support
*/
//blog
juassi_add_task(JUASSI_PLUGIN_NAME, 'theme_type_blog', 'juassi_theme_handle');
//404
juassi_add_task(JUASSI_PLUGIN_NAME, 'theme_type_404', 'juassi_theme_handle');
//cms
juassi_add_task(JUASSI_PLUGIN_NAME, 'theme_type_cms', 'juassi_theme_handle');

function juassi_load_kses() {
	/*
		Note: Filters for kses are stored in default-filters.php
	*/
	include(JUASSI_ROOT . JUASSI_INCLUDE . '/kses.functions.php');
	include(JUASSI_ROOT . JUASSI_INCLUDE . '/kses.tasks.php');

	return true;
}

function juassi_404() {
	global $juassi_content_identifier;

	juassi_set_header('HTTP/1.0 404 Not Found');
	juassi_set_404();
	$juassi_content_identifier['theme_type'] = '404';

	return true;
}

function juassi_run_cron() {

	if (defined('JUASSI_RUNNING_CRON')) return false;
	if (juassi_datetime() < juassi_get_config('next_cron_run')) return false;

	juassi_set_config('next_cron_run', juassi_datetime(3600));

	$domain = juassi_get_config('domain');

	//IPv6 not working under vista
	//$domain = '127.0.0.1';

	if (juassi_get_config('https')) {
		$domain = 'ssl://' . $domain;
	}

	$socket = @fsockopen($domain, juassi_get_config('port_number'), $errno, $errstr, 0.01);

	if ($socket) {
		$request =
		"GET " . juassi_get_config('script_path') . "/juassi-cron.php HTTP/1.0\r\n"
		. "Host: " . juassi_get_config('domain') . "\r\n"
		. "User-Agent: Juassi/" . juassi_get_config('program_version')
		. "\r\n\r\n";
		@fwrite($socket, $request);
		@fclose($socket);
		return true;
	}
	else {
		trigger_error('Unable to start cron', E_USER_ERROR);
		return false;
	}
}

function juassi_future_post() {
	global $juassi_db, $juassi_tb;

	$query = "UPDATE $juassi_tb->posts SET post_type = 'published' WHERE post_type = 'future' AND post_date <= ?";

	$now = juassi_datetime();
	$stmt = $juassi_db->prepare($query);
	$stmt->bindParam(1, $now);

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die($e->getMessage());
	}
}

function juassi_update_check() {

	$options = array(
		'http' => array(
			'user_agent'    => 'Juassi/' . juassi_get_config('program_version'),
			'timeout'       => 5
		)
	);

	$context = stream_context_create($options);
	$url = 'http://www.juassi.org/juassi-blog2/update_check.php';
	$update_feed = file_get_contents($url, false, $context);
	if ($update_feed) {
		juassi_set_config('last_update_response', $update_feed);
		return true;
	}
	else {
		trigger_error('Unable to contact update server', E_USER_WARNING);
		return false;
	}

}

function juassi_update_check_plugins() {

	$plugins = juassi_get_all_plugins();

	$options = array(
		'http' => array(
			'user_agent'    => 'Juassi/' . juassi_get_config('program_version'),
			'timeout'       => 5
		)
	);
	$plugin_update_array = juassi_get_config('plugin_update_data');
	foreach ($plugins as $plugin) {
		if (!empty($plugin['plugin_update_checker_url'])) {
			$context = stream_context_create($options);
			$url = $plugin['plugin_update_checker_url'];
			$update_feed = file_get_contents($url, false, $context);
			if ($update_feed) {
				$plugin_update_array[$plugin['plugin_file_name']] = $update_feed;
			}
			else {
				trigger_error('Unable to contact update server for plugin "' . juassi_htmlentities($plugin['plugin_file_name']) . '"', E_USER_WARNING);
			}
		}
	}
	juassi_set_config('plugin_update_data', $plugin_update_array);
	return true;
}

function juassi_monthly_maintenance() {

	//optimise tables
	juassi_optimise_tables();
}

function juassi_session_garbage_collection() {
	global $juassi_session;

	//if (!defined('JUASSI_RUNNING_CRON')) {
		$juassi_session->gc();
	//}

}

function juassi_theme_handle() {
	global $juassi_post_array, $juassi_db, $juassi_tb, $juassi_error, $juassi_post, $juassi_comment_array, $juassi_input_error, $juassi_comment;

	include(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/' . JUASSI_CURRENT_THEME . '/' . JUASSI_CURRENT_THEME_TYPE . '/index.php');
}

function juassi_text_editor($array) {

	$name = $array['name'];
	$value = $array['value'];
?>
	<textarea name="<?php echo $name; ?>" style="width: 100%" rows="20" id="<?php echo juassi_htmlentities($name); ?>"><?php echo juassi_htmlentities($value); ?></textarea>
<?php
}

?>