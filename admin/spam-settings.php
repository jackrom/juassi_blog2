<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Configuraci&oacute;n de span');
	juassi_set_in_admin(true);
	include('include/html-header.php');
?>
<div class="row-fluid">
    <div class="span12">
		<h2 class="heading">Configuraci&oacute;n de span</h2>
		<?php
			$akismet_output = '';
			if (isset($_POST['submit'])) {
				juassi_run_section('update_spam_settings');

				juassi_set_config('akismet_weighting', (int) $_POST['akismet_weighting']);
				juassi_set_config('spam_block_weighting', (int) $_POST['spam_block_weighting']);
				juassi_set_config('user_commented_before_weighting', (int) $_POST['user_commented_before_weighting']);
				juassi_set_config('tag_spam_score', (int) $_POST['tag_spam_score']);
				juassi_set_config('max_spam_score', (int) $_POST['max_spam_score']);
				juassi_set_config('spam_level', (int) $_POST['spam_level']);
				juassi_set_config('akismet_api_key', $_POST['akismet_api_key']);
				if (isset($_POST['akismet_delete_trackbacks'])) {
					juassi_set_config('akismet_delete_trackbacks', (int) $_POST['akismet_delete_trackbacks']);
				}
				if (isset($_POST['akismet_api_key'])) {
					if (isset($_POST['akismet'])) {
						juassi_set_config('akismet', 1);
					}
					else {
						juassi_set_config('akismet', 0);
					}
					if (juassi_get_config('akismet') == 1) {
						$akismet = new Akismet(juassi_get_config('address'), juassi_get_config('akismet_api_key'), juassi_get_config('program_version'));
						if ($akismet->get_verify_key()) {
							trigger_error('Key verificada, Akismet esta ahora disponible.', E_USER_NOTICE);
							$akismet_output = '<strong>Key verificada, Akismet esta ahora disponible.</strong>';
						}
						else {
							juassi_set_config('akismet', 0);
							$akismet_output = '<strong>Key es incorrecta, Akismet no esta disponible.</strong>';
						}
					}
				}
				else {
					juassi_set_config('akismet', 0);
				}

				echo juassi_admin_message('<strong>Configuraci&oacute;n de span actualizada</strong>');
 				trigger_error('Configuraci&oacute;n de span actualizada', E_USER_NOTICE);
			}
		?>
		<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

		<fieldset>
			<legend>Acciones Spam</legend>
			<p>Nada <input name="spam_level" type="radio" value="0"<?php if (juassi_get_config('spam_level') == 0) echo ' checked="checked"'; ?>  /></p>
			<p>A la cola de moderaci&oacute;n <input name="spam_level" type="radio" value="1"<?php if (juassi_get_config('spam_level') == 1) echo ' checked="checked"'; ?> /></p>
			<p>Eliminar <input name="spam_level" type="radio" value="2"<?php if (juassi_get_config('spam_level') == 2) echo ' checked="checked"'; ?> /></p>
			<p>Nota: seleccionar "Nada" deshabilita el chequeo de todos los spam.</p>
		</fieldset>

		<fieldset>
			<legend>Akismet Spam Filtering</legend>
			<?php if (!empty($akismet_output)) echo juassi_admin_message($akismet_output); ?>
			<p>Permitir? <input name="akismet" type="checkbox" value="1"<?php if (juassi_get_config('akismet')) echo ' checked="checked" '; ?>/></p>
			<p>Eliminar trackbacks que Akismet sospecha que son spam? <input name="akismet_delete_trackbacks" type="checkbox" value="1"<?php if (juassi_get_config('akismet_delete_trackbacks')) echo ' checked="checked"'; ?> /></p>
			<p>API Key<br /><input name="akismet_api_key" size="35" type="text" value="<?php echo juassi_htmlentities(juassi_get_config('akismet_api_key')); ?>" /></p>
			<p>No compartas tu API key, esto es como un password.</p>
		</fieldset>

		<fieldset>
			<legend>Ponderaci&oacute;n de Spam</legend>
			<p>Puntuaci&oacute;n a&ntilde;adida si Akismet detecta el spam (Akismet debe estar habilitado).<br />
			<input type="text" name="akismet_weighting" value="<?php echo (int) juassi_get_config('akismet_weighting'); ?>" size="5" /></p>
			<p>Puntuaci&oacute;n a&ntilde;adida si falla el "bloqueo de spam".<br />
			<input type="text" name="spam_block_weighting" value="<?php echo (int) juassi_get_config('spam_block_weighting'); ?>" size="5" /></p>
			<p>Puntuaci&oacute;n a&ntilde;adida si el usuario no ha posteado antes.<br />
			<input type="text" name="user_commented_before_weighting" value="<?php echo (int) juassi_get_config('user_commented_before_weighting'); ?>" size="5" /></p>
			<?php juassi_run_section('spam_weightings'); ?>
			<p>Puntuaci&oacute;n en la cual son tomadas acciones Spam.<br /><input type="text" name="tag_spam_score" value="<?php echo (int) juassi_get_config('tag_spam_score'); ?>" size="5" /></p>
			<p>Puntuaci&oacute;n en la cual los comentarios no son aceptados (Eliminados).<br /><input type="text" name="max_spam_score" value="<?php echo (int) juassi_get_config('max_spam_score'); ?>" size="5" /></p>
		</fieldset>

		<?php juassi_run_section('spam_settings_body'); ?>

		<br clear="all" />
		<br />
		<input type="submit" name="submit" value="Submit"/>
		</form>

		<h3>Acerca de la configuraci&oacute;n de spam</h3>

		<p><strong>Nada:</strong> Esto significa que no esta activada la protecci&oacute;n contra spam (no recomendada).</p>
		<p><strong>A la cola de moderaci&oacute;n:</strong> Esto significa que los mensajes que no pasan la verificaci&oacute;n de spam se env&iacute;an a la cola: <a href="comments.php">moderaci&oacute;n de comentarios</a>.</p>
		<p><strong>Eliminar:</strong> Esto significa que los mensajes que no pasan la verificaci&oacute;n de spam se eliminan autom&aacute;ticamente.</p>
		<h3>Otras Informaciones</h3>
		<p><strong>Trackbacks</strong></p><p>Debido a la naturaleza de v&iacute;nculos de referencia, se env&iacute;an autom&aacute;ticamente a la cola de <a href="comments.php">moderaci&oacute;n</a></p>

		<p>Trackbacks pueden ser deshabilitados en la <a href="general-settings.php">configuraci&oacute;n general</a>.</p>
		<p><strong>Akismet</strong></p>
		<p>Akismet es un servicio de bloqueo de spam proporcionada por <a href="http://automattic.com/">Automattic</a>. Si se habilita, cada vez que alguien env&iacute;a un comentario a este blog, el mensaje se env&iacute;a a un servidor de Akismet y es analizada.
		</p><p>El servidor devuelve true (si es spam) o false, Si el mensaje se marca como correo no deseado, este se env&iacute;a ya sea a la cola de moderaci&oacute;n o es eliminado, dependiendo de sus ajustes.</p>
		<p>Akismet es gratuito para uso personal, aunque usted tendr&aacute; que registrarse para poder obtener su clave de API, lo que se puede hacer <a href="http://wordpress.com/api-keys/">here</a>. Las FAQ de Akismet pueden ser encontradas <a href="http://akismet.com/faq/">aqu&iacute;</a>.</p>

		<p><strong>Nota</strong>: Activar esta funci&oacute;n pone un poco de freno tanto a la moderaci&oacute;n de comentarios y la publicaci&oacute;n de comentarios.</p>
		<br />
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>