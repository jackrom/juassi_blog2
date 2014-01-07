<?php if (!defined('JUASSI_ROOT')) exit; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<title><?php echo juassi_get_title(); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php if (juassi_get_config('rss')) { ?>
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 news feed" href="<?php echo juassi_get_config('address'); ?>/feed/" />
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 comments feed" href="<?php echo juassi_get_config('address'); ?>/feed/comments/" />
	<?php } ?>
	<style type="text/css" media="screen">@import url(<?php echo juassi_get_config('address'); ?>/juassi-content/juassi-themes/classic/blog/style/style.css);</style>
	<script type="text/javascript" src="<?php echo juassi_get_config('address'); ?>/juassi-resources/javascript/jquery.js"></script>
	<script type="text/javascript">
	jQuery.noConflict();

	jQuery(document).ready(function($){
			$("div.help_button").click(function(){
				$("div.help").addClass("show_help").show("slow");
			});
	});
    </script>
   </head>

<body>
<?php
define("_JUASSI_PAGE_NAME", juassi_get_title());
define("_JUASSI_DIR", "/juassi/admin/");
define("COUNTER", _JUASSI_DIR."mark_page.php");
if (is_readable(COUNTER)) include_once(COUNTER);
?>
	<div class="header">
		<?php if (juassi_is_logged_in()) { ?>
			<span style="float:right; padding-right: 4px;"><a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/logout.php'; ?>">Logout: <?php echo juassi_htmlentities(juassi_get_user_data('display_name')); ?> &raquo;</a></span>
		<?php } else {?>
			<span style="float:right; padding-right: 4px;"><a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN .  '/login.php'; ?>">Login &raquo;</a></span>
		<?php } ?>
		<h1>
			<?php echo juassi_get_config('name'); ?>
		</h1>

		<div class="links">
			<span style="float:right">&laquo;<a href="<?php echo juassi_posts_previous_page(); ?>">Previous Page</a>
			<a href="<?php echo juassi_posts_next_page(); ?>">Next Page</a>&raquo;</span>
			<a href="<?php echo juassi_get_config('address'); ?>/">Home</a> <?php if (juassi_plugin_loaded('contact_form')) { ?>| <a href="<?php echo juassi_get_config('address'); ?>/contact/">Contact</a> <?php } ?>| <a href="<?php echo juassi_get_config('address') . JUASSI_ADMIN . '/'; ?>">Admin</a>
		</div>

	</div>

	<div class="contain">
		<div class="sidebar">
			<ul>
				<li><a href="http://www.juassi.com/weblog/">Juassi Weblog</a></li>
			</ul>
		</div>
		<div class="sidebar2">
			<ul>
				<?php echo juassi_get_links('standard'); ?>
			</ul>
			<strong>Categories</strong>
			<p><?php echo juassi_post_all_cat(); ?></p>
		</div>
