<?php if (!defined('JUASSI_ROOT')) exit; ?>
<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>

	<!-- Basic Page Needs
	================================================== -->
	<meta charset="utf-8">
	<title><?php echo juassi_get_title(); ?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- CSS
	================================================== -->
	<!-- Normalize default styles -->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/normalize.css" media="screen" />
	<!-- Skeleton grid system -->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/skeleton.css" media="screen" />
	<!-- FontAwesome (Icon Fonts) -->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/font-awesome.min.css" media="screen" />
	<!-- Base Template Styles-->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/base.css" media="screen" />
	<!-- Template Styles-->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/style.css" media="screen" />
	<!-- Superfish -->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/superfish.css" media="screen" />
	<!-- Flexslider -->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/flexslider.css" media="screen" />
	<!-- Magnific popup -->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/magnific-popup.css" media="screen" />
	<!-- Styles for Mobile devices -->
	<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/responsive.css" media="screen" />
	
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/css/ie/ie8.css" media="screen" />
	<![endif]-->
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php if (juassi_get_config('rss')) { ?>
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 news feed" href="<?php echo juassi_get_config('address'); ?>/feed/" />
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 comments feed" href="<?php echo juassi_get_config('address'); ?>/feed/comments/" />
	<?php } ?>
	
	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/images/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/images/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/juassi/blog/images/apple-touch-icon-144x144.png">
	
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css&skin=default"></script>
	
	
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$("div.help_button").click(function(){
				$("div.help").addClass("show_help").show("slow");
			});
		});
	</script>
</head>
<body>
	
<!-- BEGIN WRAPPER -->
<div id="wrapper">

	<div id="top-bar" class="top-bar">
		<div class="container clearfix">
			<div class="grid_6 top-txt hidden-phone">
				Bienvenidos a nuestra website!
			</div>
			<div class="grid_6 acc-txt mobile-nomargin">
				<?php if (juassi_is_logged_in()) { ?>
					<a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/logout.php'; ?>">Logout: <?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?> &raquo;</a>
				<?php } else {?>
					<a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/login.php'; ?>">Login &raquo;</a>
				<?php } ?>
				<?php if (juassi_plugin_loaded('contact_form')) { ?>| <a href="<?php echo juassi_get_config('address'); ?>/contact/">Contact</a> <?php } ?>| <a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN . '/'; ?>">Admin</a>
				<!-- Have an account? <a href="#">Log in</a> or <a href="#">Sign up</a>  -->
			</div>
		</div>
	</div>
		
		
	<div class="main-box">
		<!-- BEGIN HEADER -->
		<header id="header" class="header">
			
			<div class="container clearfix">
				<div class="grid_4 mobile-nomargin">
					<!-- BEGIN LOGO -->
					<div id="logo" class="logo">
						<h1><a href="index.html"><?php echo juassi_get_config('name'); ?></a></h1>
						<p class="tagline">Aplicaciones web basadas en HTML5</p>
					</div>
					<!-- END LOGO -->
				</div>
				
				<div class="grid_8 mobile-nomargin">
				<!-- Navegacion principal -->
				<nav class="primary clearfix">
					<!-- Menu -->
					<ul class="sf-menu">
						<li><a href="http://www.juassi.com/index.php">Home</a></li>
						<li><a href="http://www.juassi.com//tienda/">Tienda</a></li>
						<li class="current-menu-item"><a href="<?php echo juassi_get_config('address'); ?>">Blog</a></li>
						<li><a href="http://www.juassi.com//recursos.php">Recursos</a>
							<ul>
								<li><a href="#">Aplicaciones</a>
									<ul>
										<li><a href="http://www.juassi.com//c-blog">C-Blog</a></li>
										<li><a href="http://www.juassi.com//j-shop">J-Shop</a></li>
										<li><a href="http://www.juassi.com//creagraficos/">creaGraficos</a></li>
										<li><a href="http://www.juassi.com//s-cms">S-CMS</a></li>
									</ul>
								</li>
								<li><a href="#">Temas</a>
									<ul>
										<li><a href="#">C-Blog</a></li>
										<li><a href="#">Wordpress</a></li>
										<li><a href="#">Joomla</a></li>
										<li><a href="#">Drupal</a></li>
										<li><a href="#">J-Shop</a></li>
										<li><a href="#">Magento</a></li>
										<li><a href="#">Prestashp</a></li>
										<li><a href="#">OsCommerce</a></li>
										<li><a href="#">Virtue-Mart</a></li>
									</ul>
								</li>
								<li><a href="#">Libros</a></li>
								<li><a href="#">Tutoriales</a>
									<ul>
										<li><a href="http://www.juassi.com/tutoriales/">Propios</a></li>
										<li><a href="index-layout2.html">De terceros</a></li>
									</ul>
								</li>
								<li><a href="#">Videos</a></li>
							</ul>
						</li>
						<li><a href="http://www.juassi.com/foro/">Foro</a></li>
						<li><a href="http://www.juassi.com/soporte/">Soporte</a>
							<ul>
								<li><a href="http://www.juassi.com/soporte/announcements.php">Anuncios</a></li>
			                    <li><a href="http://www.juassi.com/soporte/ticketsnewguest.php">Soporte t&eacute;cnico</a></li>
			                    <li><a href="http://www.juassi.com/soporte/faq.php">FAQ</a></li>
			                    <li><a href="http://www.juassi.com/soporte/manuals.php">Manuales</a></li>
			                    <li><a href="http://www.juassi.com/soporte/downloads.php">Descargas</a></li>
			                    <li><a href="http://www.juassi.com/soporte/contact.php">Contacto</a></li>
			                </ul>		
						</li>
					</ul>
					<!-- Fin / Menu -->
				</nav>
				<!-- Fin / Navegacion Principal -->
			</div>
			</div>
			
		</header>
		<!-- END HEADER -->


		<!-- BEGIN PAGE TITLE -->
		<div id="page-title" class="page-title">
			<div class="container">
				<div class="clearfix">
					<div class="grid_12">
						<div class="page-title-holder">
							<h1><?php echo juassi_post_all_cat_breadcrumb(); ?></h1>
						</div>
						<!-- Breadcrumbs -->
						<ul class="breadcrumbs">
							<li><a href="index-2.html">Home</a></li>
							<li>Blog Post Formats</li>
						</ul>
						<!-- Breadcrumbs / End -->
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE TITLE -->
