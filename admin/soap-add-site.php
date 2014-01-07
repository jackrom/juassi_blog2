<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Agregar Sitio');
	juassi_set_in_admin(true);
	$juassi_ln->add_lower_link($juassi_ln->connector, 'Add Site', 'soap-add-site.php');
	include('include/html-header.php');
?>
<script type="text/javascript">
<!--
function juassi_confirm() {
	if (confirm("Estas seguro de querer agregar este sitio? Por favor asegurate de confiar en el sitio remoto.")){
		return true;
	}
	else{
		return false;
	}
}
//-->
</script>
<div class="contain">
	<h1>Agregar Sitio</h1>
	<?php
		if (isset($_POST['submit'])) {
			if (!empty($_POST['nickname'])) {
				if (isset($_POST['juassi_email_details']) && ($_POST['juassi_email_details'] == 1)) {
					$user = $juassi_users->get_user($_POST['juassi_soap_user_id']);
					$juassi_mailer->create(
							$user['email'],
							$user['display_name'],
							'no_reply@' . juassi_get_config('domain'),
							' Accesso Juassi Connector',
							juassi_get_config('name') . ' Detalles de la cuenta del nuevo conector',
							'Hola '.$user_array['display_name'].",\n\nA Una nueva cuenta de Juassi Conector ha sido configurada para ti en  " . juassi_get_config('name') . ".\n\nUsername: " . $user['user_name'] . "\Site ID: " . $_SESSION['juassi_add_soap_site_site_id'] . "\nConnector URL: " . juassi_get_config('address') . '/juassi-soap.php'
								);

					$juassi_mailer->send();
				}

				$site_details['site_id']	= $_SESSION['juassi_add_soap_site_site_id'];
				$site_details['user_id']	= (int) $_POST['juassi_soap_user_id'];
				$site_details['nickname']	= $_POST['nickname'];

				juassi_soap_add_site($site_details);
				echo juassi_admin_message('<strong>Sitio Agregado</strong>');
			}
			else {
				echo juassi_admin_message('<strong>Por favor ingrese un nickname.</strong>');
			}
		}
	?>
	<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return juassi_confirm(this);">
		<fieldset>
			<legend>Site Details</legend>
				<?php $_SESSION['juassi_add_soap_site_site_id'] = juassi_uuid(); ?>
				<p>Site Nickname<br /><input type="text" name="nickname" value="" /></p>
				<p>Local user for Connector permissions<br />
					<select name="juassi_soap_user_id">
					<?php
					$users = $juassi_users->get_users();
					foreach($users as $user) {
						?>
						<option value="<?php echo juassi_htmlentities($user['user_id']); ?>"><?php echo juassi_htmlentities($user['user_name']); ?></option>
						<?php
					} ?>
					</select>
				</p>
				<p>ID del Sitio <br /><?php echo juassi_htmlentities($_SESSION['juassi_add_soap_site_site_id']); ?></p>
				<!--<p>Require SSL Connection <input name="juassi_soap_require_ssl" type="checkbox" value="1" /></p>-->
				<p>Mostrar email al usuario? <input name="juassi_email_details" type="checkbox" value="1" /></p>
				<p>Nota: El username debe ser el mismo en ambos, tanto en servidor como en cliente.</p>
				<p>Nota: El URL del servidos de connector esta  <?php echo juassi_htmlentities(juassi_get_config('address')); ?>/juassi-soap.php</p>
		</fieldset>
		<br style="clear:both" />
		<br />
		<input type="submit" name="submit" value="Submit"/>
	</form>
</div>
<?php
	include('include/sidebar.php');
	include('include/html-footer.php');
?>