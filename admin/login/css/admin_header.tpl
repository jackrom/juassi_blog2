<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Admin Panel - <?php echo SITE_NAME ?></title>
<!-- Main Stylesheet -->
<link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
<!-- Formee Stylesheets-->
<link rel="stylesheet" href="../css/formee-structure.css" type="text/css" media="screen">
<link rel="stylesheet" href="../css/formee-style.css" type="text/css" media="screen">
<!-- Javascript Files -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.1.min.js"></script>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="../js/custom.js"></script>
</head>
<?php if($session->is_logged_in()) { if($admin->suspended == "1") { redirect_to('logout.php?msg=suspended'); } } ?>
<body>

<header>
	<div class="wrapper">
		<!-- logo -->
		<a href="../index.php"><img src="../img/logo.png" class="logo" width="270" height="54" alt="Logo"></a>
		<div class="menu">
			<nav role="navigation">
				<ul>
					<li>
						<a href="../dashboard.php">Dashboard</a>
					</li>

					<li>
						<a href="../account_settings.php">Account Settings</a>
					</li>
					
					<li>
						<a href="contact.php">Contact Us</a>
					</li>
					
					<li>
						<a href="../logout.php">Logout</a>
					</li>
					
				</ul>
			</nav>
		</div><!--.menu end-->
		<div class="clear"></div><!--.clear end-->
	</div><!--.wrapper end-->
</header>

<div class="wrapper">

