<?php
if (!defined('JUASSI_ROOT')) exit;
define("_JUASSI_PAGE_NAME", juassi_get_title());
define("_JUASSI_DIR", $_SERVER['DOCUMENT_ROOT']);
define("COUNTER", _JUASSI_DIR."/admin/mark_page.php");
if (is_readable(COUNTER)) include_once(COUNTER);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Juassi :: 404</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<style type="text/css" media="screen">@import url(<?php echo juassi_get_config('address'); ?>/juassi-resources/css/admin-layout.css);</style>
	</head>

	<body>
	<div class="header">
		<div class="headerimg"></div>
	</div>
	<div class="body">
			<div class="contain">
				<h1>Juassi :: 404</h1>
				<h3>Not Found.</h3>
				<pre>If you believe this is an error please contact the webmaster of this site.</pre>
				<a href="<?php echo juassi_get_config('address'); ?>/">&laquo; Home</a>
			</div>
			<br />
			<div class="copyright">
				<p>Powered by <a href="http://www.juassi.com/">Juassi</a>.</p><?php echo $_SERVER['SERVER_SIGNATURE']; ?>
			</div>
	</div>
	</body>
</html>
