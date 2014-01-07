<?php
include('includes/common.php');

if (!isset($_SESSION['pass']) || $_SESSION['pass'] < 4) {
	$juassi_page_title = 'Cuenta de Administrado';
	include('includes/header.php');
	?>
	<div id="content">
		<div class="container">
			<div class="min-height">
				<p>Por favor reinicia el proceso de instalaci&oacute;n desde <a href="index.php">aqu&iacute;</a>.</p>
			</div>
		</div>
	</div>
	<?php
	include('includes/footer.php');
	exit;
}

$pass = false;

if (isset($_POST['submit'])) {

	$user_name = $_POST['user_name'];
	$user_name = strtolower($user_name);
	$user_name = preg_replace('([^a-z0-9_-])', '', $user_name);
	$display_name_saved = $_POST['display_name'];

	if (empty($user_name)) {
		$output = '<strong>Please enter a username with allowed characters.</strong>';
	}
	elseif (!juassi_check_email_address($_POST['email'])) {
		$output = '<strong>Please enter a valid email address.</strong>';
	}
	elseif (empty($display_name_saved)) {
		$output = '<strong>Please enter a display name.</strong>';
	}
	elseif (($_POST['password'] === $_POST['password2']) && !empty($_POST['password'])) {
		$_SESSION['user_name'] = $user_name;
		$_SESSION['display_name'] = $_POST['display_name'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['password'] = md5($_POST['password']);
		$_SESSION['pass'] = 5;
		$pass = true;
	}
	else {
		$output = '<strong>Your passwords do not match or you have left a blank password field.</strong>';
	}

	$user_name_saved = $user_name;
	$email_saved = $_POST['email'];

	if ($_SESSION['pass'] > 4) {
		$user_name_saved = $_SESSION['user_name'];
		$display_name_saved = $_SESSION['display_name'];
		$email_saved = $_SESSION['email'];
		$pass = true;
	}
	else {
		$user_name_saved = '';
		$display_name_saved = '';
		$email_saved = '';
	}
}else{
	$user_name_saved = '';
	$display_name_saved = '';
	$email_saved = '';
}

$juassi_page_title = 'Admin Account';
include('includes/header.php');

if (isset($output)) echo juassi_admin_message($output); 

?>
<div id="teaser">
	<div class="container">
		<h1>
			Asistente para la instalaci&oacute;n  
		</h1>
		<div id="progress-bar">
			<div class="configuration">
				<div class="bar-label">
					<p>progreso</p>
					<div class="arrow"></div>
				</div>
				<div class="bar-steps-text">
					<p class="configuration"> Configuraci&oacute;n</p>
				</div>
				<div class="bar-steps-count"></div>
			</div>
		</div>
	</div>
</div>

<div id="content">
	<div class="container">
		<div class="min-height">
			<?php 
					if (isset($output)){
						echo '<div class="alert alert-error">';
						echo juassi_admin_message($output); 
						echo '</div>';
					}
					
					if(isset($_POST['submit'])){
						echo '<div class="alert alert-error">Por favor verifique que todos los datos sean correctos</div>';
					}
			?>
		</div>
		<form action="admin-account.php" method="post" class="form-horizontal">
	
			<div class="row">
				<div class="span4">
					<h3>Cuenta de Administrador</h3>
					<p>Por favor ingrese el nombre de usuario que ser&aacute; usado para loguearse dentro del panel de administraci&oacute;n.</p>
					<p>Ingresa el password del usuario. Asegurese de que los password introducidos coincidan uno con el otro para evitar errores.</p>
					<p>Ingrese su direcci&oacute;n de email. Todas las notificaciones ser&aacute;n enviadas a este email y ser&aacute;n caragadas en el panel de administraci&oacute;n.</p>
				</div>
				<div class="span8">
					<div class="well">
						<div class="control-group" id="err_admin_username">
							<label class="control-label">Usuario:</label>
							<div class="controls">
								<input type="text" name="user_name" id="admin_username" value="<?php echo juassi_htmlentities($user_name_saved); ?>" />
								<span class="help-inline" style="display: none;">Please input correct username.</span>
							</div>
						</div>
						<div class="control-group" id="err_admin_username">
							<label class="control-label">Nombre para mostrar:</label>
							<div class="controls">
								<input type="text" name="display_name" id="admin_username" value="<?php echo juassi_htmlentities($display_name_saved); ?>" />
								<span class="help-inline" style="display: none;">Please input correct username.</span>
							</div>
						</div>
						<div class="control-group" id="err_admin_password">
							<label class="control-label">Password:</label>
							<div class="controls">
								<input type="password" name="password" id="admin_password" />
								<span class="help-inline" style="display: none;">Please input password.</span>
							</div>
						</div>
						<div class="control-group" id="err_admin_password2">
							<label class="control-label">Repetir Password:</label>
							<div class="controls">
								<input type="password" name="password2" id="admin_password2" />
								<span class="help-inline" style="display: none;">Passwords no coinciden.</span>
							</div>
						</div>
						<div class="control-group" id="err_admin_email">
							<label class="control-label">Email:</label>
							<div class="controls">
								<input type="text" name="email" id="admin_email" value="<?php echo juassi_htmlentities($email_saved); ?>" />
								<span class="help-inline" style="display: none;">Por favor ingrese un email v&aacute;lido.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		<div class="form-actions">
				<div class="form-actions">
				<a href="site-details.php" class="btn btn-large"><i class="icon-arrow-left"></i> Regresar</a>
				<?php if (isset($pass) && $pass == TRUE) { 
					echo '<a href="create-config.php" class="btn btn-large btn-primary">Siguiente <i class="icon-chevron-right icon-white"></i></a>';
			   }else{
					echo '<input class="btn btn-large btn-primary" name="submit" type="submit" value="Submit" />';
				} ?>
			</div>
		</div>	
		</form>

	</div>
</div>


<?php include('includes/footer.php'); ?>