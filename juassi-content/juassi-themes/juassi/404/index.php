<?php if (!defined('JUASSI_ROOT')) exit; ?>
<!DOCTYPE html>
<html lang="en">
<head> 
	<meta charset="utf-8"> 
	<title>Juassi-Blog :: 404</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/404/css/app.v1.css"> 
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/404/css/font.css" cache="false"> 
	<!--[if lt IE 9]> 
	<script src="js/ie/respond.min.js" cache="false"></script> 
	<script src="js/ie/html5.js" cache="false"></script> 
	<script src="js/ie/fix.js" cache="false"></script> 
	<![endif]-->
</head>
<body> 
	<section id="content"> 
		<div class="row m-n"> 
			<div class="col-sm-4 col-sm-offset-4"> 
				<div class="text-center m-b-lg"> 
					<h1 class="h text-white animated bounceInDown">404</h1> 
				</div> 
				<div class="list-group m-b-sm bg-white m-b-lg"> 
					<a href="<?php echo juassi_get_config('address'); ?>/" class="list-group-item"> 
						<i class="icon-chevron-right"></i> 
						<i class="icon-home"></i> Ir a la pagina principal 
					</a> 
					<a href="#" class="list-group-item"> 
						<i class="icon-chevron-right"></i> 
						<i class="icon-question"></i> Envianos un comentario
					</a> 
					<a href="#" class="list-group-item"> 
						<i class="icon-chevron-right"></i> 
						<span class="badge">0212-2155841</span> 
						<i class="icon-phone"></i> Llamanos 
					</a> 
				</div> 
			</div> 
		</div> 
	</section> 
	<!-- footer --> 
	<footer id="footer"> 
		<div class="text-center padder clearfix"> 
			<p> 
				<small>Powered by <a href="http://www.juassi.com/">Juassi</a><br>&copy; 2013</small> <?php echo $_SERVER['SERVER_SIGNATURE']; ?>
			</p> 
		</div> 
	</footer> 
	<!-- / footer -->
	<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/404/css/app.v1.js"></script> 
	<!-- Bootstrap --> 
	<!-- app --> 
</body>

