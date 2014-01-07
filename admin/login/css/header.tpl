<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo SITE_NAME ?></title>
<!-- Main Stylesheet -->
<!--<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">-->
<link rel="stylesheet" href="css/estilos.css" type="text/css" media="screen">
<!-- Formee Stylesheets-->
<link rel="stylesheet" href="css/formee-structure.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/formee-style.css" type="text/css" media="screen">
<!-- Javascript Files -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<!-- redes sociales login -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="js/popup.js"></script>
<script src="js/common.js"></script>
  
  
  
</head>

<body>

<header>
	<div class="wrapper">
		<!-- logo -->
		<a href="index.php"><img src="../assets/img/logo.png" class="logo" width="200" alt="Logo"></a>
		<div class="menu">
			<nav role="navigation">
				<!-- if the user is logged in -->
				<?php if($session->is_logged_in()) { ?>
				<ul>
					<?php if ($session->is_logged_in()) { $level = $user->user_level; } else { $level = ''; } if(($level == '293847') || ($level == '527387')) { echo '<li><a href="'.ADMINDIR.'">Admin Area</a></li>'; } else { echo ''; } ?>
					<li>
						<a href="../admin/index.php">Admin</a>
					</li>

					<li>
						<a href="../admin/account_settings.php">Configuraci&oacute;n de la cuenta</a>
					</li>
					
					<li>
						<a href="contact.php">Contacto</a>
					</li>
					
					<li>
						<a href="logout.php">Salir</a>
					</li>
				</ul>
				<?php } else { ?>
				<ul>
					<li>
						<a href="index.php">Entrar</a>
					</li>

					<li>
						<a href="register.php">Registrarse</a>
					</li>
					
					<li>
						<a href="contact.php">Contacto</a>
					</li>
				</ul>
				<?php } ?>
			</nav>
		</div><!--.menu end-->
		<div class="clear"></div><!--.clear end-->
	</div><!--.wrapper end-->
</header>

<div class="wrapper">
<!-- <div class="container">
<section id="main"> -->
   