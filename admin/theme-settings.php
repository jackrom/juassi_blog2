<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Theme Settings');
	juassi_set_in_admin(true);

	if (isset($_GET['run']) && isset($_GET['name'])) {
		$theme_name = juassi_sanitize_theme_name($_GET['name']);
		if (!empty($theme_name)) {
			trigger_error('Theme Changed to "' . juassi_htmlentities($theme_name) . '"', E_USER_NOTICE);
			juassi_set_config('current_theme', $theme_name);
		}
	}

	include('include/html-header.php');
	$juassi_themes = juassi_get_all_themes();
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Configuraci&oacute;n de Temas (Themes)</h2>
	<?php if (!juassi_get_config('themes')) {
		echo juassi_admin_message('<strong>Themes are currently disabled.</strong>');
	} ?>
	<div class="tablecontain">
		<h3 class="heading">Temas Disponibles (<?php echo (int) count($juassi_themes); ?>)</h3>
		<div class="span10">
			<table class="table table-striped" data-rowlink="a">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Versi&oacute;n</th>
					<th>Descripci&oacute;n</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				foreach ($juassi_themes as $juassi_theme) {
				?>
					<tr<?php if ($i % 2 == 0 ) echo ' class="negative"'; ?>>
						<td><a href="<?php echo juassi_htmlentities($juassi_theme['theme_website']); ?>"><?php echo juassi_htmlentities($juassi_theme['theme_name']); ?></a></td>
						<td><?php echo juassi_htmlentities($juassi_theme['theme_version']); ?></td>
						<td><?php echo $juassi_theme['theme_description']; ?></td>
						<?php if (juassi_get_config('current_theme') == ($juassi_theme['theme_file_name'])) { ?>
						<td>Enabled</td>
						<?php } else { ?>
						<td><a href="theme-settings.php?run=enable&amp;name=<?php echo juassi_htmlentities($juassi_theme['theme_file_name']); ?>">Disabled</a></td>
						<?php } ?>
					</tr>
				<?php
				$i++; }
				?>
			</tbody>
		</table>
		</div>
		<br style="clear:both" />
	</div>
</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>