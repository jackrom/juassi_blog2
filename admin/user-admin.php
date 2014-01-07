<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Administraci&oacute;n de Usuarios');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Administraci&oacute;n de Usuarios</h2>

	<?php
		if (isset($_POST['delete_group_submit'])) {
			if ((int) $_POST['delete_group'] != 1) {
				juassi_delete_group((int) $_POST['delete_group']);
				$group_message = '<strong>Grupo Eliminado</strong>';
			}
		}

		if (isset($_POST['delete_user_submit'])) {
			$juassi_users->delete_user((int) $_POST['delete_user']);
			$message = '<strong>Usuario Eliminado</strong>';
		}

		$groups = juassi_get_groups();

		if (isset($_POST['run']) && ($_POST['run'] == 'add_user')) {
			$juassi_user_name = juassi_sanitize_user_name($_POST['juassi_user_name']);
			if (!empty($juassi_user_name) && !$juassi_users->is_user($juassi_user_name)) {
				if (juassi_check_email_address($_POST['juassi_email']) && !juassi_check_email_address_taken(0, $_POST['juassi_email'])) {
					if (!empty($_POST['juassi_password']) && $_POST['juassi_password'] === $_POST['juassi_password2']) {
						$user_array['user_name'] = $juassi_user_name;
						$user_array['display_name'] = $_POST['juassi_display_name'];
						$user_array['email'] = $_POST['juassi_email'];
						$user_array['website'] = $_POST['juassi_website'];
						$user_array['group_id'] = (int) $_POST['group_id'];
						$user_array['password'] = md5($_POST['juassi_password']);
						$user_array['joined'] = juassi_datetime();
						$user_array['active'] = 1;
						$juassi_users->add_user($user_array);
						$message = '<strong>Usuario "' . juassi_htmlentities($juassi_user_name) . '" Agregado</strong>';
						if (isset($_POST['juassi_email_user'])) {

							$juassi_mailer->create(
								$user_array['email'],
								$user_array['display_name'],
								'no_reply@' . juassi_get_config('domain'),
								'Juassi Administrador de Usuarios',
								juassi_get_config('name') . ' Detalles de la cuenta de nuevo usuario',
								'Hola '.$user_array['display_name'].",\n\nA una nueva cuenta de usuario ha sido creada en " . juassi_get_config('name') . ".\n\nUsuario: " . $user_array['user_name'] . "\nPassword: " . $_POST['juassi_password'] . "\nURL: " . juassi_get_config('address') . JUASSI_ADMIN
							);

							$juassi_mailer->send();
						}
					}
					else {
						$message = '<strong>Tus passwords no coinciden o has dejado un campo en blanco.</strong>';
					}
				}
				else {
					$message = '<strong>Direcci&oacute;n de email invalida o tomada.</strong>';
				}
			}
			else {
				$message = '<strong>Usuario invalido o tomado.</strong>';
			}
			$juassi_form_username = $juassi_user_name;
			$juassi_form_display_name = $_POST['juassi_display_name'];
			$juassi_form_email = $_POST['juassi_email'];
			$juassi_form_website = $_POST['juassi_website'];

		}
		else {
			$juassi_form_username = '';
			$juassi_form_display_name = '';
			$juassi_form_email = '';
			$juassi_form_website = 'http://';
		}
	?>

	<fieldset>
		<?php if (isset($message)) echo juassi_admin_message($message); ?>
		<legend>Agregar Usuario</legend>
		<form action="user-admin.php" method="post">
		<p>Usuario <br /><input name="juassi_user_name" size="30" type="text" value="<?php echo juassi_htmlentities($juassi_form_username); ?>" />
		<br />(los caracteres permitidos incluyen: a-z, 0-9, _ y -)</p>
		<p>Nombre para mostrar <br /><input name="juassi_display_name" size="30"  type="text" value="<?php echo juassi_htmlentities($juassi_form_display_name); ?>" /></p>
		<p>Direcci&oacute;n de email <br /><input name="juassi_email" size="30"  type="text" value="<?php echo juassi_htmlentities($juassi_form_email); ?>" /></p>
		<p>Website <br /><input name="juassi_website" size="30"  type="text" value="<?php echo juassi_htmlentities($juassi_form_website); ?>" /></p>
		<p>Grupo de usuario <br /><select name="group_id">
		<?php foreach ($groups as $group) { ?>
		<option value="<?php echo juassi_htmlentities($group['group_id']); ?>"><?php echo juassi_htmlentities($group['group_name']); ?></option>
		<?php } ?>
		</select></p>
		<p>Password <br /><input name="juassi_password" size="30" type="password" value="" /></p>
		<p>Repetir Password <br /><input name="juassi_password2" size="30"  type="password" value="" /></p>
		<p>Mostrar email a los usuarios? <input type="checkbox" name="juassi_email_user" value="1"  /></p>
		<p><input type="hidden" name="run" value="add_user"/><input type="submit" name="submit" value="Submit"/></p>
		</form>
	</fieldset>

	<fieldset>
		<legend>Administraci&oacute;n de grupos</legend>
		<?php if (isset($group_message)) echo juassi_admin_message($group_message); ?>
		<?php
			foreach($groups as $group) {
			?>
				<a href="group-admin.php?group_id=<?php echo juassi_htmlentities($group['group_id']); ?>"><?php echo juassi_htmlentities($group['group_name']); ?></a><br />
			<?php
			}
		?>
		<form action="group-admin.php" method="post">
		<p>Agregar Grupo <br /><input name="group_name" size="30" type="text" value="" /></p>
		<p><input type="submit" name="add_group" value="Submit"/></p>
		</form>

	</fieldset>

	<fieldset>
		<legend>Administrar usuario</legend>
		<?php
			$users = $juassi_users->get_users();
			foreach($users as $user) {
			?>
				<a href="user-profile.php?user_id=<?php echo juassi_htmlentities($user['user_id']); ?>"><?php echo juassi_htmlentities($user['display_name']); ?> - <?php echo juassi_htmlentities($user['user_name']); ?></a><br />
			<?php
			}
		?>
	</fieldset>

	<br clear="all" />
</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>