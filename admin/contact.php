<?php
define('JUASSI_REL_ROOT', './../');
$juassi_input_error = '';
include('../functions/juassi_common.php');
include(JUASSI_ROOT . JUASSI_INCLUDE . '/general-admin-template.functions.php');



juassi_set_admin_title('Registro');
if (juassi_is_logged_in()) {
	juassi_set_header('Location: ' . $_SESSION['juassi_page']);
	juassi_send_headers();
	exit;
}

if (isset($_POST['submit'])) { 
		
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$subject = trim($_POST['subject']);
	$mess = trim($_POST['mess']);
	
	if ((!$name == '') && (!$email == '') && (!$subject == '') && (!$mess == '')) {
		// $message = "Success";
		
		$headers = "From: {$email}\r\n".
		"Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$current_ip = $_SERVER['REMOTE_ADDR'];
		
		$html_message = nl2br($mess);
		
		$sub = "CONTACT FORM: ".$subject;
		
		//send email
		$to = SUPPORT_EMAIL;
		$the_mess = "IP: ".$current_ip." <br />
				FROM: ".$email."<br />
				MESSAGE: <p />"."$html_message";
					
		mail($to, $sub, $the_mess, $headers);
	
		$message = "<div class='notification-box success-notification-box'><p>Muchas gracias por contactarnos, su mensaje se ha enviado satisfactoriamente, en la brevedad nos pondremos en conntacto con usted.</p><a href='#' class='notification-close success-notification-close'>x</a></div><!--.notification-box .notification-box-success end-->";		
		
	} else {
		$message = "<div class='notification-box error-notification-box'><p>Por favor, rellene todos los campos.</p><a href='#' class='notification-close error-notification-close'>x</a></div><!--.notification-box .notification-box-error end-->";
	}
  
} else {
  $name = "";
  $email = "";
  $subject = "";
  $mess = "";
  $message = "";
}

?>
<?php include('login/header.php'); ?>

<section class="title">&nbsp;&nbsp;&nbsp;&nbsp;Contacto</section>
	<div class="container">	
		

		<form action="<?php echo juassi_htmlentities($_SERVER['PHP_SELF']); ?>" method="post" class="formee">
			<section id="main" class="formee">
		        <div class="grid-6-12">
		                <label>Nombre Completo <em class="formee-req">*</em></label>
		               	<input type="text" id="name" name="name" required="required" value="<?php echo htmlentities($name); ?>" />
		        </div>
		        <div class="grid-6-12">
		                <label>Direcci&oacute;n de email <em class="formee-req">*</em></label>
		               	<input type="email" id="email" name="email" required="required" value="<?php echo htmlentities($email); ?>" />
		        </div>
				<div class="grid-12-12">
		                <label>Asunto <em class="formee-req">*</em></label>
		               	<input type="text" id="subject" name="subject" required="required" value="<?php echo htmlentities($subject); ?>" />
		        </div>
				<div class="grid-12-12">
		                <label>Mensaje <em class="formee-req">*</em></label>
		               	<textarea type="text" id="mess" class="mess" name="mess" required="required"><?php echo htmlentities($mess); ?></textarea>
		        </div>
		        <div class="grid-12-12">
		                <div class="settings_btn"><input class="button" type="submit" name="submit" value="Enviar mensaje" /></div><!--.settings_btn end-->
		        </div>
			</section><!--#main end-->
		</form>
	<div class="clear"></div><!--.clear end-->
</div><!--.container end-->

