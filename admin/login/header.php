<?php if (!defined('JUASSI_ROOT')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo juassi_get_admin_title(); ?></title>
<!-- Hoja de estilo principal -->
<!--<link rel="stylesheet" href="login/css/style.css" type="text/css" media="screen">-->
<link rel="stylesheet" href="login/css/estilos.css" type="text/css" media="screen">
<!-- Formee Stylesheets-->
<link rel="stylesheet" href="login/css/formee-structure.css" type="text/css" media="screen">
<link rel="stylesheet" href="login/css/formee-style.css" type="text/css" media="screen">
<!-- Javascript Files -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="login/js/custom.js"></script>

<!-- redes sociales login -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="login/js/popup.js"></script>
<script src="login/js/common.js"></script>
  
  
  
</head>

<body>

<header>
	<div class="wrapper">
		<!-- logo -->
		<h1 class="logo" style="margin-top:20px; font-size:30px;"><a href="index.php">Juassi Admin</a></h1>
		<div class="menu">
			<nav role="navigation">
				
				<ul>
					<li>
						<a href="login.php">Entrar</a>
					</li>

					<li>
						<a href="register.php">Registrarse</a>
					</li>
					
					<li>
						<a href="contact.php">Contacto</a>
					</li>
				</ul>
			</nav>
		</div><!--.menu end-->
		<div class="clear"></div><!--.clear end-->
	</div><!--.wrapper end-->
</header>

<div class="wrapper">
<!-- <div class="container">
<section id="main"> -->

<?php if (juassi_in_admin()) { ?>
<p class="statsheading">Juassi <strong>Quick</strong>Stats</p>
<ul>
	<li><strong>User:</strong> <?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?></li>
	<li><strong>Time:</strong> <?php echo juassi_datetime(); ?></li>
	<li><strong>Date:</strong> <?php echo ''; ?></li>
</ul>
<ul class="large">
	<li><a href="<?php echo juassi_get_config('address') . '/'; ?>">Inicio &raquo;</a></li>
	<li><a href="logout.php">Salir (<?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?>) &raquo;</a></li>
</ul>
<?php } else {?>
<ul class="large" style="list-style: none;float:left;">
	<li><a href="<?php echo juassi_get_config('address') . '/'; ?>" style="color:black; margin:10px; padding:10px;position:relative;">Ir al Inicio &raquo;</a></li>
</ul>
<?php } ?>

<?php if (juassi_in_admin()) { ?>
<?php $juassi_ln->prepare_links(); ?>
	<div class="nav">
		<ul class="tabnav">
			<?php $juassi_ln->display_top_links(); ?>
		</ul>
		<?php if ($juassi_ln->lower_links()) { ?>
		<ul class="activenav">
			<?php $juassi_ln->display_lower_links(); ?>
		</ul>
		<?php } ?>
	</div>
<?php } ?>
<div class="body">

   
   
   
   
   
   
   
   


			