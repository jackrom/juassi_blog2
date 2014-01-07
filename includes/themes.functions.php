<?php
/*
	Juassi 2.0 Theme Support and Functions
	Juan Carlos Reyes C Copyright 2012
*/

function juassi_check_current_theme() {
	$theme = juassi_sanitize_theme_name(juassi_get_config('current_theme'));
	if (!file_exists(JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/' . $theme . '/' . $theme . '.theme.php')) {
		juassi_die('Unable to find theme "' . $theme . '".');
	}
	return $theme;
}

function juassi_check_theme_type($theme, $theme_type) {

	$theme_type = juassi_sanitize_theme_name($theme_type);

	if (!juassi_has_task('theme_type_' . $theme_type)) {
		juassi_die('Unable to find theme type "' . $theme_type . '" for theme "' . $theme . '".');
	}

	return $theme_type;
}

function juassi_sanitize_theme_name($theme_name) {
	$theme_name = strtolower($theme_name);
	$theme_name = preg_replace('([^0-9a-z_\/])', '', $theme_name);
	return $theme_name;
}

function juassi_get_all_themes() {

	$juassi_theme_dir = JUASSI_ROOT . JUASSI_CONTENT . '/juassi-themes/';

	if (is_dir($juassi_theme_dir)) {
		$folder = opendir($juassi_theme_dir);
		while (false !== ($dir_array = readdir($folder))) {
			if ($dir_array != '.' && $dir_array != '..') {
				if(is_dir($juassi_theme_dir . $dir_array)) {
					$theme_folders[] = $dir_array . '/';
				}
			}
		}
		closedir($folder);
	}

	foreach($theme_folders as $theme_folder) {
		$theme_folder_full = $juassi_theme_dir . $theme_folder;
		if (is_dir($theme_folder_full)) {
			$folder = opendir($theme_folder_full);
			while (false !== ($file_array = readdir($folder))) {
				if ($file_array != '.' && $file_array != '..') {
					if(filetype($theme_folder_full . $file_array) == 'file') {
						if(preg_match("/^([a-z0-9_\/]+).theme.php$/", $file_array, $matches) > 0){
							$theme_info[$matches[1]] =
								array (
									'theme_file_name' => $matches[1],
									'theme_name' => $matches[1],
									'theme_description' => '',
									'them_author' => '',
									'theme_author_website' => '',
									'theme_website' => '',
									'theme_version' => '',
								);
							if (file_exists($theme_folder_full . $matches[1] . '.theme.php')) {
								include_once($theme_folder_full . $matches[1] . '.theme.php');
								if (class_exists($matches[1])) {
									$theme_info_temp[$matches[1]] = new $matches[1];
									if (method_exists($theme_info_temp[$matches[1]], 'meta_data')) {
										$theme_info[$matches[1]] = $theme_info_temp[$matches[1]]->meta_data();
										$theme_info[$matches[1]]['theme_file_name'] = $matches[1];
									}
								}
							}
						}
					}
				}
			}
			closedir($folder);
		}
	}

	ksort($theme_info);

	return $theme_info;
}

?>