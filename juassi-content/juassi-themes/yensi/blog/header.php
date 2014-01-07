<?php 
if (!defined('JUASSI_ROOT')) exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo juassi_get_title(); ?></title>
    <?php if (juassi_get_config('rss')) { ?>
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 news feed" href="<?php echo juassi_get_config('address'); ?>/feed/" />
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 comments feed" href="<?php echo juassi_get_config('address'); ?>/feed/comments/" />
	<?php } ?>

	<link rel="icon" type="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/images/png" href="images/favicon.ico" />
	<link rel="apple-touch-icon" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/images/apple-touch-icon-114x114.png">

<!--[if lt IE 9]>

<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/scripts/ie9.js">IE7_PNG_SUFFIX=".png";</script>

<![endif]-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/stylesheets/style.css"> 

<link rel="stylesheet" href="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/stylesheets/responsive.css"> 

<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/scripts/jquery.min.js"></script> 
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/scripts/jquery.bxSlider.min.js"></script>
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/scripts/jquery.faq.js"></script>  
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/scripts/jquery.blackandwhite.min.js"></script>
<script src="<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/yensi/blog/scripts/js_func.js"></script>
<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-resources/javascript/jquery.js"></script>

<script>

$(function(){

	$('.clients_slider').bxSlider({

		auto: false,

		controls : false,

		mode: 'fade',

		pager: true

	});	

	$('.post_slider').bxSlider({

		auto: false,

		speed : 1000

	});

	$('.recent_slider').bxSlider({

		auto: false,

		displaySlideQty: 1,

		moveSlideQty: 1,

    	speed : 1000

	});

	$('#faq').dltoggle();

	$("#open").click(function(event){

      $('#faq').dltoggle_show();

      return false;

	});

	$("#close").click(function(event){

      $('#faq').dltoggle_hide();

      return false;

	});

    $('.bwWrapper').BlackAndWhite({

        hoverEffect : true,

        webworkerPath : false,

        responsive:true,

        invertHoverEffect:false

    });

})

</script>
<script type="text/javascript">
	jQuery.noConflict();

	jQuery(document).ready(function($){
			$("div.help_button").click(function(){
				$("div.help").addClass("show_help").show("slow");
			});
	});
</script>

<?php
//require $_SERVER['DOCUMENT_ROOT'].'/juassi/includes/visitCounter.class.php';
//require $_SERVER['DOCUMENT_ROOT'].'/juassi/admin/userInfoGeneral.php';
//$cuentaHits = new visitCount();
//$cuentaHits = visitCount::HIT_OLD_AFTER_SECONDS;
//$cuentaHits = visitCount::AddHit(juassi_get_title(),true);

//getUserInfo('35.1.1.1');

define("_JUASSI_PAGE_NAME", juassi_get_title());
define("_JUASSI_DIR", $_SERVER['DOCUMENT_ROOT']);
define("COUNTER", _JUASSI_DIR."/admin/mark_page.php");
if (is_readable(COUNTER)) include_once(COUNTER);

?>

</head>
<body>
<div class="wraper">
	<header class="header">
		<a class="logo" href="http://www.yensi.com.ve">yensi</a><?php if (juassi_is_logged_in()) { ?>
			<span style="top:80px; position:relative;left:200px;"><a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/logout.php'; ?>">Cerrar sesi&oacute;n: <?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?> &raquo;</a></span>
		<?php } else {?>
			<span style="top:80px; position:relative;left:200px;"><a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/login.php'; ?>">Admin &raquo;</a></span>
		<?php } ?>
        <nav>
            <!-- top menu -->
            <ul>
                <li><a href="http://www.yensi.com.ve">Home</a></li>
                <li><a href="http://www.blog.yensi.com.ve">Blog</a></li>
            </ul>
            <!-- /top menu -->
        </nav>
	</header>
</div> 
<div class="content_block">
	<!-- top_title -->
	<div class="top_title">
		<div class="wraper">
			<h2>El Blog de Yensi <span>Recetas, tips, trucos y mucho mas para deleitar nuestro paladar!</span></h2>
			<ul>
				<li><a href="http://www.yensi.com.ve">Inicio</a></li>
				<li><a href="#">Blog</a></li>
				<li>art&Iacute;culos</li>
			</ul>
		</div>
	</div>
	<!-- /top_title -->
	<div class="wraper">
	<!-- blog entries -->
	<div class="blog_entries">
			
