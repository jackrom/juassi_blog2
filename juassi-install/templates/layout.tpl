<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $this->steps[$this->step] ?> :: Juassi Blog System Web Installer</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Juan Carlos Reyes">

		<link rel="stylesheet" href="<?php echo URL_INSTALL ?>templates/css/base.css" />

		<link rel="icon" type="image/gif" href="<?php echo URL_HOME ?>favicon.ico" />

		<script src="<?php echo URL_INSTALL ?>templates/js/jquery.js"></script>
		<script src="<?php echo URL_INSTALL ?>templates/js/bootstrap.min.js"></script>
		<script src="<?php echo URL_INSTALL ?>templates/js/application.js"></script>

		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

		<div id="top-bar">
			<div class="container">
				<a class="logo" href="<?php echo URL_INSTALL ?>">
					<img alt="Subrion CMS" src="<?php echo URL_INSTALL ?>templates/img/logo.">
				</a>
				<ul class="nav nav-inventory">
					<li class="contacts"><a href="http://www.juassi.com/soporte/contact.php" title="Contact us if you have any questions." target="_blank">Contacts</a></li>
					<li class="help"><a href="http://www.juassi.com/soporte/ticketsnewguest.php" title="Submit a ticket and get a fast reply." target="_blank">Helpdesk</a></li>
					<li class="forums"><a href="http://www.juassi.com/foro/" title="Ask questions in our user forums." target="_blank">User Forums</a></li>
				</ul>
			</div>
		</div>

		<div id="teaser">
			<div class="container">
				<h1>
					<?php echo $this->layout()->title ?> 
					<?php if ($this->module == 'install' && in_array('upgrade', $this->modules)): ?>
					<small>switch to <a href="<?php echo URL_INSTALL ?>upgrade/">Juassi Installer</a></small>
					<?php endif ?>
					<?php if ($this->module == 'upgrade' && in_array('install', $this->modules)): ?>
					<small>switch to <a href="<?php echo URL_INSTALL ?>install/">Juassi Installer</a></small>
					<?php endif ?>
				</h1>
				<div id="progress-bar">
					<div class="<?php echo $this->step ?>">
						<div class="bar-label">
							<p>Overall progress</p>
							<div class="arrow"></div>
						</div>
						<div class="bar-steps-text">
							<p class="<?php echo $this->step ?>"> <?php echo $this->steps[$this->step] ?></p>
						</div>
						<div class="bar-steps-count">
							<?php if ($this->module == 'install' && in_array('upgrade', $this->modules)): ?>
								<?php if ($this->step == 'check'): ?>
									<p>step 1 of 4</p>
								<?php elseif ($this->step == 'license'): ?>
									<p>step 2 of 4</p>
								<?php elseif ($this->step == 'configuration'): ?>
									<p>step 3 of 4</p>
								<?php elseif ($this->step == 'finish' || ('configuration' == $this->step && isset($_POST) && empty($this->errorList))): ?>
									<p class="done">you're almost done!</p>
								<?php elseif ($this->step == 'plugins'): ?>
									<p class="done">this step is optional</p>
								<?php endif ?>
							<?php endif ?>
							<?php if ($this->module == 'upgrade' && in_array('install', $this->modules)): ?>
								<?php if ($this->step == 'check'): ?>
									<p>step 1 of 3</p>
								<?php elseif ($this->step == 'download'): ?>
									<p>step 2 of 3</p>
								<?php elseif ($this->step == 'finish'): ?>
									<p class="done">you're almost done!</p>
								<?php endif ?>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="content">
			<div class="container">
				<?php if ($this->message): ?>
				<div class="min-height">
					<div class="alert alert-error"><?php echo $this->message ?></div>
				</div>
				<?php endif ?>
				<?php echo $this->layout()->content ?>
			</div>
		</div>

		<footer>
			<div class="container">
				<p>Powered by <a href="http://www.juassi.com/C-Blog" title="Open Source Blog System">C-Blog</a> Version <?php echo JUASSI_VERSION ?><br> Copyright &copy; <?php echo date('Y') ?> <a href="http://www.juassi.com/" title="Desarrollo de aplicaciones web basadas en HTML5">Juassi Studios</a></p>
			</div>
		</footer>

	</body>
</html>