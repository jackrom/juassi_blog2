<?php

	define('JUASSI_REL_ROOT', './../');
	$juassi_input_error = '';
	include('../functions/juassi_common.php');
	include(JUASSI_ROOT . JUASSI_INCLUDE . '/general-admin-template.functions.php');



	juassi_set_admin_title('Login');
	if (juassi_is_logged_in()) {
		juassi_set_header('Location: ' . $_SESSION['juassi_page']);
		juassi_send_headers();
		exit;
	}

	if (isset($_POST['submit'])) {
		if (!juassi_login($_POST['username'], $_POST['password'])) {
			$juassi_input_error = '<strong>Login Failed.</strong>';
		}
		else {
			if (!isset($_SESSION['juassi_page'])) {
				header('Location: ./index.php');
			}
			else {
				header('Location: ' . $_SESSION['juassi_page']);
			}
			$juassi_input_error = '<strong>Alg&uacute;n error ha ocurrido. Por favor, limpie la cache, reinicie el navegador e intentelo de nuevo.</strong>';
			//trigger_error('Login Failed (Failed to Redirect) "' . juassi_htmlentities($_POST['username']) . '"', E_USER_ERROR);
		}
	}
	include('login/header.php');

?>

<!--
<div class="contain" style="width:20%;">
	<h1>Login</h1>
	<form method="post" action="<?php /*echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>">
	<?php echo $juassi_input_error; */?>
	<p>Username<br /><input type="text" name="username" /></p>
	<p>Password <br /><input type="password" name="password" /></p>
	<p><input type="submit" name="submit" value="Submit" /></p>
	<p>Note: All login attempts are logged.</p>
	</form>
</div>
 -->

 <!-- show loading until the all page scripts are fully loaded and cached (use this only on login page) -->

<!-- wrapper -->
<div class="container fullrc">
	<section id="main">
		<div class="login">
			<h2>Admin Login</h2>
			<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" class="formee" method="post" >
				<div class="grid-12-12">
		               	<input id="ck" type="text" name="username" required placeholder="Usuario" value="<?php echo htmlentities('Usuario'); ?>" />
		        </div>
				<div class="grid-12-12">
		               	<input type="password" class="password" name="password" required placeholder="Contrase&ntilde;a" value="<?php echo htmlentities($password); ?>" />
		        </div>
				<div class="grid-12-12">
				<!-- 
		               	<a href="reset_password.php">Olvidastes tu contrase&ntilde;a?</a>
		         -->
		        </div>
				<div class="grid-12-12">
					<div class="login_btn"><input class="button" type="submit" name="submit" value="Entrar" /></div><!--.login_btn end-->
				</div>
			</form>
		</div><!--.login end-->
		
		<div class="register">
			
			<h2>Crea una cuenta</h2>
			<br />
			<p>Los registros est&aacute;n actualmente cerrados, haz click en el link abajo para crear una cuenta.</p>
			<br />
			<!-- 
			<a href="register.php" class="button">Crear una cuenta</a> 
			 -->
		</div><!--.register end-->
		<div class="clear"></div><!--.clear end-->

<!--
	<h2>Entrar con tu red social favorita</h2>
    
     If you don't want a social buttons, delete all of these code -->
        <!-- If you don't want a social buttons, delete all of these code -->
     <!--    <a class='btn-facebook' href="?action=login&type=facebook">&nbsp;Registro con Facebook</a>
        <a class='btn-twitter' href="<?php //echo $login; ?>">&nbsp;Registro con Twitter</a>  -->
    <!--.container end-->
		

<?php
	include('include/html-footer.php');


?>