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
</head>

<body>
	<div class="header">
		<h1><?php echo juassi_get_config('name'); ?></h1>
	</div>