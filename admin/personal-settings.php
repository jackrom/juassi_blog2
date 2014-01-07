<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Configuraci&oacute;n Personal');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>

<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Configuraci&oacute;n Personal</h2>
		<?php
			if (isset($_POST['submit'])) {

				juassi_set_user_data('contact', $_POST['juassi_contact_form'] ? 1 : 0);
				juassi_set_user_data('gui_editor', $_POST['juassi_gui_editor'] ? 1 : 0);
				juassi_set_user_data('website', $_POST['juassi_website']);
				juassi_set_user_data('display_name', $_POST['juassi_display_name']);

				if (juassi_check_email_address($_POST['juassi_email'])) {
					if(juassi_check_email_address_taken(juassi_get_user_data('user_id'), $_POST['juassi_email'])) {
						echo juassi_admin_message('<strong>La direcci&oacute;n de email ya esta en uso, por favor ingrese otra.</strong>');
					}
					else {
						juassi_set_user_data('email', $_POST['juassi_email']);
					}
				}
				else {
					echo juassi_admin_message('<strong>Por favor ingrese una direcci&oacute;n de email v&aacute;lida.</strong>');
				}

				if (!empty($_POST['juassi_new_password'])) {
					if (md5($_POST['juassi_current_password']) === juassi_get_user_data('password')) {
						if ($_POST['juassi_new_password'] === $_POST['juassi_new_password2']) {
							juassi_set_user_data('password', $_POST['juassi_new_password']);
						}
						else {
							echo juassi_admin_message('<strong>La contrase&ntilde;a no se ha modificado,porque la nueva contrase&ntilde;a no coincide.</strong>');
						}
					}
					else {
						echo juassi_admin_message('<strong>La contrase&ntilde;a no se ha modificado, la contrase&ntilde;a actual no es correcta.</strong>');
					}
				}

				echo juassi_admin_message('<strong>Configuraci&oacute;n personal actualizada.</strong>');
				trigger_error('Personal settings updated.', E_USER_NOTICE);
			}

			$group_id = (int) juassi_get_user_data('group_id');
			$group_name = juassi_get_group_name($group_id);
		?>
<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	<fieldset>
	<legend>Detalles personales</legend>
		<p>Usuario (edici&oacute;n disponible) <br /><input name="juassi_user_name" size="30" type="text" disabled="disabled" value="<?php echo juassi_htmlentities(juassi_get_user_data('user_name')); ?>" /></p>
		<p>Nombre para mostrar <br /><input name="juassi_display_name" size="30"  type="text" value="<?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?>" /></p>
		<p>Direcci&oacute;n de Email <br /><input name="juassi_email" size="30"  type="text" value="<?php echo juassi_htmlentities(juassi_get_user_data('email')); ?>" /></p>

		<p>Website <br /><input name="juassi_website" size="30"  type="text" value="<?php echo juassi_htmlentities(juassi_get_user_data('website')); ?>" /></p>
		<p>Roles <br /><input name="juassi_user_level" size="30" type="text" disabled="disabled"  value="<?php echo juassi_htmlentities($group_name); ?>" /></p>
		<p>Fecha de ingreso <br /><input name="juassi_joined" size="30" type="text" disabled="disabled" value="<?php echo juassi_htmlentities(juassi_get_user_data('joined')); ?>" /></p>
	</fieldset>

	<fieldset>
	<legend>Opciones Personales</legend>
		<p>Permitir formulario de contacto<br />
		<select name="juassi_contact_form">
		<option value="0">Off</option>
		<option value="1"<?php if (juassi_get_user_data('contact')) { echo ' selected="selected" '; } ?>>On</option>
		</select></p>
		<p>Usar el editor WYSIWYG para las entradas de texto<br />
		<select name="juassi_gui_editor">
		<option value="0">Off</option>
		<option value="1"<?php if (juassi_get_user_data('gui_editor')) { echo ' selected="selected" '; } ?>>On</option>
		</select></p>
	</fieldset>
	<fieldset>
	<legend>Cambiar la contrase&ntilde;a</legend>
		<p>Tu puedes dejar esto en blanco, si no vas a cambiar la contrase&ntilde;a.</p>
		<p>Tu Contrase&ntilde;a actual <br /><input name="juassi_current_password" size="30" type="password" value="" /></p>

		<p>Nueva Contrase&ntilde;a <br /><input name="juassi_new_password" size="30"  type="password" value="" /></p>
		<p>Repetir Nueva Contrase&ntilde;a <br /><input name="juassi_new_password2" size="30"  type="password" value="" /></p>
	</fieldset>
	<fieldset>
		<legend>Tu actividad</legend>
		<p>Numero de art&iacute;culos:<strong> 
			<?php echo (int) juassi_user_post_count(); ?> </strong>
			(<a href="edit.php" style="color:red;"> ver</a>)
		</p>
		<p>Numero de comentarios:<strong>   
			<?php echo (int) juassi_user_comment_count(); ?></strong>
			(<a href="your-comments.php" style="color:red;"> ver</a>)
		</p>
	</fieldset>
	<?php juassi_run_section('personal_settings_body'); ?>
	<br clear="all" />
	<p>
		<button class="btn btn-large btn-warning" type="submit" name="submit" value="Submit"><i class="splashy-pencil"></i> Modificar</button>
	</p>
	</form>

	</div>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>