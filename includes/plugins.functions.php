<?php
/*
	Juassi 2.0 Plugin Support
	Juan Carlos Reyes C Copyright 2012
*/
	if (!defined('JUASSI_ROOT')) exit;

	$juassi_installed_plugins = juassi_get_config('plugin_data');
	$juassi_plugin_dir = JUASSI_ROOT . JUASSI_CONTENT . '/juassi-plugins/';
	$juassi_tasks = array();
	$juassi_content_filters = array();

	function juassi_load_plugins() {
		global $juassi_installed_plugins, $juassi_plugin_dir;
		if (is_array($juassi_installed_plugins)) {
			foreach($juassi_installed_plugins as $x) {
				$x = juassi_sanitize_plugin_name($x);
				if (file_exists("$juassi_plugin_dir$x.plugin.php")) {
					include("$juassi_plugin_dir$x.plugin.php");
				}
				else {
					juassi_disable_plugin($x);
				}
			}
		}
	}

	function juassi_plugin_loaded($plugin_name) {
		global $juassi_installed_plugins;
		if (!empty($plugin_name) && is_array($juassi_installed_plugins)) {
			if (in_array($plugin_name, $juassi_installed_plugins)) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	//enable a plugin
	function juassi_enable_plugin($plugin_name) {
		global $juassi_installed_plugins;
		$plugin_name = juassi_sanitize_plugin_name($plugin_name);
		if (!empty($plugin_name)) {
			if (!in_array($plugin_name, $juassi_installed_plugins)) {
				juassi_run_section('enable_plugin_' . $plugin_name);
				$juassi_installed_plugins[] = $plugin_name;
				trigger_error('Plugin enabled: "' . $plugin_name . '"', E_USER_NOTICE);
				juassi_set_config('plugin_data',  $juassi_installed_plugins);
			}
		}
	}

	//disable a plugin
	function juassi_disable_plugin($plugin_name) {
		global $juassi_installed_plugins;
		if (in_array($plugin_name, $juassi_installed_plugins)) {
			juassi_run_section('disable_plugin_' . $plugin_name);
			$key = array_search($plugin_name, $juassi_installed_plugins);
			unset($juassi_installed_plugins[$key]);
			$juassi_installed_plugins = array_values($juassi_installed_plugins);
			trigger_error('Plugin disabled: "' . $plugin_name . '"', E_USER_NOTICE);
			juassi_set_config('plugin_data',  $juassi_installed_plugins);
		}
	}

	function juassi_disable_all() {
		$juassi_installed_plugins;
		foreach ($juassi_installed_plugins as $index => $value) {
			juassi_run_section('disable_plugin_' . $value);
		}
		$installed_plugins = array();
		trigger_error("Plugins Disabled", E_USER_NOTICE);
		juassi_set_config('plugin_data', $installed_plugins);
	}

	function juassi_any_enabled() {
		global $juassi_installed_plugins;
		if (empty($juassi_installed_plugins)) {
			return false;
		}
		else {
			return true;
		}
	}

	function juassi_add_task($plugin_name, $section, $function, $priority = 10, $arguments = 1) {
		global $juassi_tasks;

		//need to fix this for objects
		if (is_object($function[0])) juassi_die('Objects can not currently be used for tasks.');
		$juassi_tasks[$section][$priority][$function] = array($plugin_name, $arguments);

		return true;

	}
	function juassi_has_task($section) {
		global $juassi_tasks;

		if (isset($juassi_tasks[$section])) {
			return true;
		}
		else {
			return false;
		}
	}

	function juassi_remove_task($section, $function, $priority = 10) {
		global $juassi_tasks;

		unset($juassi_tasks[$section][$priority][$function]);

		return true;
	}

	function juassi_add_content_filter($plugin_name, $section, $function, $priority = 10, $arguments = 1) {
		global $juassi_content_filters;

		//need to fix this for objects
		if (is_object($function[0])) juassi_die('Objects can not currently be used for tasks.');
		$juassi_content_filters[$section][$priority][$function] = array($plugin_name, $arguments);

		return;

	}

	function juassi_has_content_filter($section) {
		global $juassi_content_filters;

		if (isset($juassi_content_filters[$section])) {
			return true;
		}
		else {
			return false;
		}
	}


	function juassi_remove_content_filter($section, $function, $priority = 10) {
		global $juassi_content_filters;

		unset($juassi_content_filters[$section][$priority][$function]);

		return;
	}

	//pass by reference
	function juassi_run_section_ref($section, &$args = '') {
		global $juassi_tasks;
		//echo $section . '<br />';
		if (!isset($juassi_tasks[$section])) return false;

		//sorts based on priority, 1 being the highest (first run)
		ksort($juassi_tasks[$section], SORT_NUMERIC);

		//call_user_func_array requires an array
		$arguments = array(&$args);

		foreach($juassi_tasks[$section] as $priority => $functions) {
				foreach($juassi_tasks[$section][$priority] as $function => $task_details) {
					if (!function_exists($function)) {
						trigger_error('Plugin "'. juassi_htmlentities($task_details[0]) .'" called undefined function "' . juassi_htmlentities($function) . '" in section "' . juassi_htmlentities($section) . '".', E_USER_ERROR);
						continue;
					}
					call_user_func_array($function, $arguments);
				}
		}

		return true;
	}

	function juassi_run_section($section, $args = '') {
		return juassi_run_section_ref($section, $args);
	}

	/*

	*/
	function juassi_run_content_filter($section, $content = '') {
		global $juassi_content_filters;
		//echo $section . '<br />';
		if (!isset($juassi_content_filters[$section])) return $content;

		//sorts based on priority, 1 being the highest (first run)
		ksort($juassi_content_filters[$section], SORT_NUMERIC);

		foreach($juassi_content_filters[$section] as $priority => $functions) {
				foreach($juassi_content_filters[$section][$priority] as $function => $task_details) {
					if (!function_exists($function)) {
						trigger_error('Plugin "'. juassi_htmlentities($task_details[0]) .'" called undefined function "' . juassi_htmlentities($function) . '" in section "' . juassi_htmlentities($section) . '".', E_USER_ERROR);
						continue;
					}
					$content = call_user_func($function, $content);
				}
		}

		return $content;
	}

	function juassi_get_all_plugins() {
		global $juassi_plugin_dir, $juassi_general_plugin_warning;

		$plugin_info = array();
		$plugin_info_temp = array();
		$juassi_general_plugin_warning = FALSE;

		if (is_dir($juassi_plugin_dir)) {
			$plugin_folders[] = '';
			$folder = opendir($juassi_plugin_dir);
			while (false !== ($dir_array = readdir($folder))) {
				if ($dir_array != '.' && $dir_array != '..') {
					if(is_dir($juassi_plugin_dir . $dir_array)) {
						if (juassi_sanitize_plugin_name($dir_array) == $dir_array) {
							$plugin_folders[] = $dir_array . '/';
						}
					}
				}
			}
			closedir($folder);
		}
		foreach($plugin_folders as $plugin_folder) {
			$plugin_folder_full = $juassi_plugin_dir . $plugin_folder;
			if (is_dir($plugin_folder_full)) {
				$folder = opendir($plugin_folder_full);
				while (false !== ($file_array = readdir($folder))) {
					if ($file_array != '.' && $file_array != '..') {
						if(filetype($plugin_folder_full . $file_array) == 'file') {
							if(preg_match("/^([a-z0-9_\/]+).plugin.php$/", $file_array, $matches) > 0){
								$plugin_info[$matches[1]] =
										array (
											'plugin_file_name' => $plugin_folder . $matches[1],
											'plugin_name' => $matches[1],
											'plugin_description' => 'Meta File Missing Or Corrupt',
											'plugin_update_checker_url' => '',
											'plugin_author' => '',
											'plugin_author_website' => '',
											'plugin_website' => '',
											'plugin_version' => ''
										);
								if (file_exists($plugin_folder_full . $matches[1] . '.meta.plugin.php')) {
									include_once($plugin_folder_full . $matches[1] . '.meta.plugin.php');
									if (class_exists($matches[1])) {
										$plugin_info_temp[$matches[1]] = new $matches[1];
										if (method_exists($plugin_info_temp[$matches[1]], 'meta_data')) {
											$plugin_info[$matches[1]] = $plugin_info_temp[$matches[1]]->meta_data();
											$plugin_info[$matches[1]]['plugin_file_name'] = $plugin_folder . $matches[1];
										}
										else {

										}
									}
									else {
										$juassi_general_plugin_warning = TRUE;
										trigger_error('The meta file for plugin "' . juassi_htmlentities($matches[1]) . '" does not contain the "' . juassi_htmlentities($matches[1]) . '" class.', E_USER_WARNING);
									}
								}
								else {
									$juassi_general_plugin_warning = TRUE;
									trigger_error('The meta file for plugin "' . juassi_htmlentities($matches[1]) . '" cannot be found.<br />It should be in the plugins folder called "' . juassi_htmlentities($matches[1] . '.meta.plugin.php') . '" but is not.', E_USER_WARNING);
								}
							}
						}
					}
				}
				closedir($folder);
			}
		}

		ksort($plugin_info);

		return $plugin_info;
	}

	function juassi_sanitize_plugin_name($plugin_name) {
		$plugin_name = strtolower($plugin_name);
		$plugin_name = preg_replace('([^0-9a-z_\/])', '', $plugin_name);
		return $plugin_name;
	}

	//function from WordPress
	function juassi_plugin_basename($file) {
		$file = str_replace('\\','/',$file); // sanitize for Win32 installs
		$file = preg_replace('|/+|','/', $file); // remove any duplicate slash
		$file = preg_replace('|^.*' . JUASSI_CONTENT . '/juassi-plugins' . '/|','',$file); // get relative path from plugins dir
		return $file;
	}

	function juassi_plugin_base_url($file) {
		$file = juassi_plugin_basename($file);
		$file = str_replace('.plugin.php','',$file);
		return $file;
	}

	//check if a plugin is out of date
	function juassi_plugin_out_of_date($plugin_name, $plugin_version) {
		static $plugin_update_data_array;
		if (!isset($plugin_update_data_array)) {
			$plugin_update_data_array = juassi_get_config('plugin_update_data');
		}
		$plugin_name = juassi_sanitize_plugin_name($plugin_name);
		if (isset($plugin_update_data_array[$plugin_name])) {
			try {
				$plugin_update_data = $plugin_update_data_array[$plugin_name];
				$current_version = explode('-', $plugin_version);
				$current_version = $current_version[0];
				$xml = new SimpleXMLElement($plugin_update_data);

				if (version_compare($current_version, $xml->version, '<')) {
					//new version
					$array['version'] = $xml->version;
					$array['release_notes'] = $xml->release_notes;
					$array['download'] = $xml->download;
					return $array;
				}
				else {
					return false;
				}
			}
			catch (Exception $e) {
				trigger_error('Unable to read update information for plugin "'.juassi_htmlentities($plugin_name).'"', E_USER_ERROR);
			}
		}
		else {
			return false;
		}
	}
?>