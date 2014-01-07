<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Plugins');
	juassi_set_in_admin(true);
?>
<?php
	/*
	Enable/disable plugins here
	*/
	if (isset($_GET['run'])) {
		if ($_GET['run'] == 'enable') {
			if (isset($_GET['name'])) {
				juassi_enable_plugin($_GET['name']);
				header('Location: plugins.php');
			}
		}
		elseif ($_GET['run'] == 'disable') {
			if (isset($_GET['name'])) {
				juassi_disable_plugin($_GET['name']);
				header('Location: plugins.php');
			}
		}
	}
	elseif (isset($_POST['enable_selected'])) {
		foreach($_POST as $index => $value){
			if(strncasecmp($index, 'plugin_', 7) === 0) {
				$plugin = substr($index, 7);
				juassi_enable_plugin($plugin);
			}
		}
		header('Location: plugins.php');
	}
	elseif (isset($_POST['disable_selected'])) {
		foreach($_POST as $index => $value){
			if(strncasecmp($index, 'plugin_', 7) === 0) {
				$plugin = substr($index, 7);
				juassi_disable_plugin($plugin);
			}
		}
		header('Location: plugins.php');
	}
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Plugins</h2><p style="display:inline;"><input type="submit" name="enable_selected" value="Enable Selected"/> <input type="submit" name="disable_selected" value="Disable Selected"/></p>

				<?php
				if (!JUASSI_LOAD_PLUGINS) {
					echo juassi_admin_message('<strong>Plugins are currently disabled as per the settings in bt-settings.php.</strong>');
				}
				$plugins = juassi_get_all_plugins();
				$plugins_count = count($plugins);
				if ($juassi_general_plugin_warning) {
					echo juassi_admin_message('<strong>Unable to retrieve all plugin information. Please check the <a href="event-viewer.php">event viewer</a> for more information.</strong>');
				}
				?>
				<div class="tablecontain">
					<h3 class="heading">Plugins Disponibles (<?php echo (int) $plugins_count; ?>)</h3>
					<table class="table table-striped" data-rowlink="a">
                                            
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Versi&oacute;n</th>
								<th>Descripci&oacute;n</th>
								<th>Status</th>
								<th><a href="#" onclick="juassi_select_plugins()">Activar Todos</a></th>
							</tr>
						</thead>
						<tbody>
							<form name="juassi_plugins_list" action="plugins.php" method="post">
							
							<?php
							$i = 0;
							foreach ($plugins as $plugin_info) {
							?>
								<?php
									$juassi_plugin_array = juassi_plugin_out_of_date($plugin_info['plugin_file_name'], $plugin_info['plugin_version']);
									if ($juassi_plugin_array !== false) { ?>
									<tr<?php echo ' class="upgrade"'; ?>>
									<?php $plugin_info['plugin_description'] .= ' <i>There is a new version of this plugin available ('.juassi_htmlentities($juassi_plugin_array['version']).'). <a href="'.juassi_htmlentities($juassi_plugin_array['download']).'">Download &raquo;</a></i>'; ?>
								<?php } else { ?>
									<tr<?php if ($i % 2 == 0 ) echo ' class="negative"'; ?>>
								<?php } ?>
									<td><a href="<?php echo juassi_htmlentities($plugin_info['plugin_website']); ?>"><?php echo juassi_htmlentities($plugin_info['plugin_name']); ?></a></td>
									<td><?php echo juassi_htmlentities($plugin_info['plugin_version']); ?></td>
									<td><?php echo $plugin_info['plugin_description']; ?></td>
									<?php if (juassi_plugin_loaded($plugin_info['plugin_file_name'])) { ?>
									<td><a href="plugins.php?run=disable&amp;name=<?php echo juassi_htmlentities($plugin_info['plugin_file_name']); ?>">Enabled</a></td>
									<?php } else { ?>
									<td><a href="plugins.php?run=enable&amp;name=<?php echo juassi_htmlentities($plugin_info['plugin_file_name']); ?>">Disabled</a></td>
									<?php } ?>
									<td><input type="checkbox" name="plugin_<?php echo juassi_htmlentities($plugin_info['plugin_file_name']); ?>" value="1" /></td>
								</tr>
							<?php
							$i++; }
							?>
							</form>
						</tbody>
					</table>
				<br style="clear:both" />
				</div>
			</div>
		</div>
<script src="../juassi-resources/javascript/gebo_dashboard.js"></script>
<script src="../juassi-resources/javascript/jquery.min.js"></script>
<!-- smart resize event -->
<script src="../juassi-resources/javascript/jquery.debouncedresize.min.js"></script>
<!-- hidden elements width/height -->
<script src="../juassi-resources/javascript/jquery.actual.min.js"></script>
<!-- js cookie plugin -->
<script src="../juassi-resources/javascript/jquery.cookie.min.js"></script>
<!-- main bootstrap js -->
<script src="../juassi-resources/bootstrap/js/bootstrap.min.js"></script>
<!-- tooltips -->
<script src="../juassi-resources/lib/qtip2/jquery.qtip.min.js"></script>
<?php
	include('include/sidebar.php');
	//include('include/html-footer.php');
?>