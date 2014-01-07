<?php if (!defined('JUASSI_ROOT')) exit; ?>
<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="keywords" content="HTML5 Template" />
	<meta name="description" content="Multipress - Responsive Multipurpose HTML5 Template">
	<meta name="author" content="Juan Carlos Reyes">

	<title><?php echo juassi_get_title(); ?></title>

	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicons -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/img/apple-touch-icon.html">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/img/apple-touch-icon-72x72.html">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/img/apple-touch-icon-114x114.html">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/img/apple-touch-icon-144x144.html">

	<!-- Web Fonts  -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100italic,100,300,300italic,400italic,500,700,700italic,900italic,900,500italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,600italic,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
	<script src="js/libs/respond.min.js"></script>
	<![endif]-->

	<!-- Bootstrap core CSS -->
	<link href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/css/bootstrap.css" rel="stylesheet">

	<!-- FontAwesome icons CSS -->
	<link href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Theme Styles CSS-->
	<link href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/css/styles.css" rel="stylesheet">
	<link href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/css/accordion.css" rel="stylesheet">
	<link href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/js/owl-carousel/owl.theme.css" rel="stylesheet">
	<link href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/js/rs-plugin/css/settings.css" rel="stylesheet" />

	<!--[if lt IE 9]>
	<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/js/libs/html5.js"></script>
	<![endif]-->
	
	<?php if (juassi_get_config('rss')) { ?>
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 news feed" href="<?php echo juassi_get_config('address'); ?>/feed/" />
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 comments feed" href="<?php echo juassi_get_config('address'); ?>/feed/comments/" />
	<?php } ?>

</head>
<div class="body">

<!-- Top-wrap -->
<div class="top-wrap">
	<div class="container top-wrap-inner">
		<div class="col-md-12">
			<div class="top-login">
				<?php if (juassi_is_logged_in()) { ?>
					<a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/logout.php'; ?>">Salir: <?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?> &raquo;</a>
				<?php } else {?>
					Bienvenidos! <a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/login.php'; ?>">Entrar &raquo;</a>
				<?php } ?>
			</div>
			<!-- 
			<a href="#">
				<div class="top-language">Select Language</div>
			</a>

			<a href="#">
				<div class="top-cart">Shoping Cart</div>
			</a>
			 -->
		</div>
	</div>
</div>
<!-- Top-wrap -->

<!-- Header -->
<header class="header2">
   <div class="container">
      <div class="col-md-12">
         <!-- Logo -->
         <div class="col-md-2">
            <h1 class="logo"><a href="<?php echo juassi_get_config('address'); ?>"><?php echo juassi_get_config('name'); ?></a></h1>
         </div>
         
         <!-- Navmenu -->
         <div class="col-md-10">
            <div id='topnav2'>
               <ul class="top-menu">
                  <li class='active has-sub'>
                     <a href="<?php echo juassi_posts_previous_page(); ?>"><span>Anterior</span></a>
                  </li>
                  <li class='has-sub'>
					<a href="<?php echo juassi_posts_next_page(); ?>"><span>Siguiente</span></a>
				  </li>
				  <li class='has-sub'>
					<a href="<?php echo juassi_get_config('address'); ?>/"><span>Home</span></a> 
				  </li>
					<?php 
						if (juassi_plugin_loaded('contact_form')) { 
					?>
					<li class='has-sub'><a href="<?php echo juassi_get_config('address'); ?>/contact/"><span>Contacto</span></a></li> 
					<?php } ?>
					<li class='has-sub'><a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN . '/'; ?>"><span>Admin</span></a></li>
				</ul>
            </div>
         </div>
        <!-- Search -->
        <div class="head-search">
            <form id="header-search" action="#">
                <input type="search" name="s" id="s" placeholder="Search">
            </form>
        </div>
      </div>
   </div>
</header>
<!-- Header -->


<div class="space60"></div>