<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Plugin');

	$juassi_found_plugin = false;
	if (isset($_GET['juassi_plugin_name']) && !empty($_GET['juassi_plugin_name'])) {
		$juassi_plugin_name = juassi_sanitize_plugin_name($_GET['juassi_plugin_name']);
		if (juassi_plugin_loaded($juassi_plugin_name)) {
			$juassi_found_plugin = true;
		}
	}
	juassi_set_in_admin(true);
	$juassi_ln->add_lower_link($juassi_ln->plugins, 'Plugin Settings', 'plugin.php');
	if ($juassi_found_plugin) {
		juassi_run_section('page_plugin_header_' . $juassi_plugin_name);
		juassi_set_admin_title('Plugin :: ' . $juassi_plugin_name);
	}

	include('include/html-header.php');

	if ($juassi_found_plugin) {
		juassi_run_section('page_plugin_body_' . $juassi_plugin_name);
	}
	else {
		?>
		<div class="contain">
		<?php
		echo juassi_admin_message('No Plugin Found');
		?>
		</div>
		<?php
	}

	include('include/html-footer.php');
?>