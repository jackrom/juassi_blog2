<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<title>JUASSI :: Error</title>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<style type="text/css" media="screen">@import url("<?php echo JUASSI_REL_ROOT; ?>juassi-resources/css/admin-layout.css")</style>
				</head>

				<body>
				<div class="header">
					<div class="headerimg"></div>
				</div>
				<div class="body">
						<div class="contain">
							<h1>JUASSI :: Error</h1>
							<h3><?php if ($display_error_message) echo $die_message; ?></h3>
							<pre><?php if(JUASSI_MAIL_NOTIFY) echo 'An email has been sent to the administrator of this site informing them of the error. Please try again later.'; ?></pre>
						</div>
						<br />
						<div class="copyright">
							<p>Powered by <a href="http://www.juassi.com/">Juassi</a>.</p><?php echo $_SERVER['SERVER_SIGNATURE']; ?>
						</div>
				</div>
				</body>
			</html>