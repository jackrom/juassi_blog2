<?php
	include('include/admin-header.php');
	juassi_set_admin_title('General Settings');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>

<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Configuraci&oacute;n General</h2>

	<?php
	if (isset($_POST['submit'])) {

		$time_zone = preg_replace('([^\-+0-9])', '', $_POST['juassi_time_zone']);
		juassi_set_config('time_zone', $time_zone);

		//juassi_set_config('gzip', $_POST['juassi_gzip'] ? 1 : 0);
		//juassi_set_config('full_rss', $_POST['juassi_full_rss'] ? 1 : 0);
		juassi_set_config('rss', $_POST['juassi_rss'] ? 1 : 0);
		//juassi_set_config('rewrite', $_POST['juassi_rewrite'] ? 1 : 0);
		juassi_set_config('trackbacks', $_POST['juassi_trackbacks'] ? 1 : 0);
		juassi_set_config('comments', $_POST['juassi_comments'] ? 1 : 0);
		juassi_set_config('name', $_POST['juassi_name']);
		juassi_set_config('description', $_POST['juassi_description']);
		juassi_set_config('domain', strtolower($_POST['juassi_domain']));

		juassi_set_config('https', $_POST['juassi_https'] ? 1 : 0);
		juassi_set_config('themes', $_POST['juassi_themes'] ? 1 : 0);

		$port_number = (int) $_POST['juassi_port_number'];
		if ($port_number > '65535' || $port_number == 0) {
			juassi_set_config('port_number', 80);
		}
		else {
			juassi_set_config('port_number', $port_number);
		}

		$script_path = $_POST['juassi_script_path'];
		if(strlen($script_path) > 1 && substr($script_path, 0, 1) != '/') $script_path = '/' . $script_path;
		$script_path = juassi_remove_end_slash($script_path);
		juassi_set_config('script_path', strtolower($script_path));

		$upload_path = $_POST['juassi_upload_path'];
		if(strlen($upload_path) > 1 && substr($upload_path, 0, 1) != '/') $upload_path = '/' . $upload_path;
		$upload_path = juassi_remove_end_slash($upload_path);
		juassi_set_config('upload_path', strtolower($upload_path));

		juassi_set_config('cookie_name', $_POST['juassi_cookie_name']);

		$limit_posts = (int) $_POST['juassi_limit_posts'];
		if ($limit_posts == 0) $limit_posts = 10;
		juassi_set_config('limit_posts', $limit_posts);

		juassi_set_config('contact_user_id', (int) $_POST['juassi_contact_user_id']);

		echo juassi_admin_message('<strong>Configuraci&oacute;n General Actualizada</strong>');
		trigger_error('Configuraci&oacute;n General Actualizada', E_USER_NOTICE);

	}
	?>
	<form action="" method="post">
		<fieldset>
			<legend>Detalles del Sitio</legend>

			<p>Nombre del Sitio <br /><input name="juassi_name" size="30" type="text" value="<?php echo juassi_htmlentities(juassi_get_config('name')); ?>" /></p>
			<p>Descripci&oacute;n del Sitio <br /><input name="juassi_description" size="35"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('description')); ?>" /></p>
			<p>Dominio <br /><input name="juassi_domain" size="35"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('domain')); ?>" /></p>
			<p>Puerto n&uacute;mero <br /><input name="juassi_port_number" size="5"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('port_number')); ?>" /></p>
			<p>Secure HTTP<br />
			<select name="juassi_https">
			<option value="0">Off</option>
			<option value="1"<?php if (juassi_get_config('https')) { echo ' selected="selected"'; } ?>>On</option>
			</select>
			</p>
			<p>Script Path (La ruta donde juassi-blog esta instalado, relativa al nombre del dominio
			<br /> por ejemplo www.example.com/blog/ ser&iacute;a igual a /blog)<br /><input name="juassi_script_path" size="35"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('script_path')); ?>" /></p>
			<p>Upload Path (La ruta donde los archivos son cargados, esto es relativo al script path
			<br /> por ejemplo www.example.com/blog/images/ ser&iacute;a igual a /images)<br /><input name="juassi_upload_path" size="30"  type="text" value="<?php echo juassi_htmlentities(juassi_get_config('upload_path')); ?>" /></p>
			<p>N&uacute;mero de art&iacute;culos en la p&aacute;gina frontal <br /><input name="juassi_limit_posts" size="5" type="text" value="<?php echo juassi_htmlentities(juassi_get_config('limit_posts')); ?>" /></p>
			<p>Default Time Zone (formato e.g. +10, -5 etc)<br />
			<input name="juassi_time_zone" type="text" size="5" value="<?php echo juassi_htmlentities(juassi_get_config('time_zone')); ?>" />
			</p>
			<p>Juassi versi&oacute;n<br />
			<input name="juassi_version" type="text" disabled="disabled" value="<?php echo juassi_htmlentities(juassi_get_config('program_version')); ?>" />
			</p>
			<p>Instalado<br />
			<input name="juassi_installed" type="text" disabled="disabled" value="<?php echo juassi_htmlentities(juassi_get_config('installed')); ?>" />
			</p>
		</fieldset>

		<fieldset>
			<legend>Opciones del Sitio</legend>
			<p>Permitir comentar (puede globalmente a traves de ajustes posteriores anular o desactivar los comentarios)<br />
			<select name="juassi_comments">
			<option value="0">Off</option>
			<option value="1"<?php if (juassi_get_config('comments')) { echo ' selected="selected"'; } ?>>On</option>
			</select>
			</p>

			<p>Permitir trackbacks entrantes (puede globalmente a traves de ajustes posteriores acivar o desactivar los tracbacks)<br />
			<select name="juassi_trackbacks">
			<option value="0">Off</option>
			<option value="1"<?php if (juassi_get_config('trackbacks')) { echo ' selected="selected"'; } ?>>On</option>
			</select>
			</p>

			<!--<p>Gzip<br />
			<select name="juassi_gzip">
			<option value="0">Off</option>
			<option value="1"<?php if (juassi_get_config('gzip')) { echo ' selected="selected"'; } ?>>On</option>
			</select></p>-->

			<p>RSS Feeds<br />
			<select name="juassi_rss">
			<option value="0">Off</option>
			<option value="1"<?php if (juassi_get_config('rss')) { echo ' selected="selected"'; } ?>>On</option>
			</select>
			</p>

			<p>Temas o plantillas<br />
			<select name="juassi_themes">
			<option value="0">Off</option>
			<option value="1"<?php if (juassi_get_config('themes')) { echo ' selected="selected"'; } ?>>On</option>
			</select>
			</p>

			<p>Formulario de contacto al usuario por defecto<br />
			<select name="juassi_contact_user_id">
				<option value=""></option>
			<?php
			$users = $juassi_users->get_users();
			foreach($users as $user) {
				?>
				<option value="<?php echo juassi_htmlentities($user['user_id']); ?>"<?php if (juassi_get_config('contact_user_id') == $user['user_id']) { echo ' selected="selected"'; } ?>><?php echo juassi_htmlentities($user['display_name']); ?> - <?php echo juassi_htmlentities($user['user_name']); ?></option>
				<?php
			}
			?>
			</select>
			</p>

		</fieldset>

		<fieldset>
			<legend>Configuraci&oacute;n avanzada</legend>
			<p>Nombre de la Cookie <br /><input name="juassi_cookie_name" size="30" type="text" value="<?php echo juassi_htmlentities(juassi_get_config('cookie_name')); ?>" /></p>
		</fieldset>

		<fieldset>
			<legend>Configuraci&oacute;n</legend>
			<p><a href="config.php">Ver configuraci&oacute;n aqu&iacute;</a></p>
		</fieldset>

		<br clear="all" />
		<br />
		<p><input type="submit" name="submit" value="Enviar"/></p>
	</form>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>