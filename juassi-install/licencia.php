<?php
include('includes/common.php');
$juassi_js_onload = TRUE;
if (!isset($_SESSION['pass']) || $_SESSION['pass'] < 1) {
	$juassi_page_title = 'Licencia  :: juassi- Blog System Web Installer';
	include('includes/header.php');
	?>
	<div id="teaser">
		<div class="container">
			<h1>
				Asistente para la instalaci&oacute;n 
			</h1>
			<div id="progress-bar" style = "margin-bottom:20px;">
				<div>
					<div class="bar-label">
						<p>Progreso</p>
						<div class="arrow"></div>
					</div>
					<div class="bar-steps-text">
						<p class="check">problemas con el inicio de session</p>
					</div>
					<div class="bar-steps-count"></div>
				</div>
			</div>
			<p style="text-align:center;">Por favor reinicia el proceso de instalaci&oacute;n desde<a href="index.php">aqu&iacute;</a>.</p>
		</div>
	</div>
	
	<?php
	include('includes/footer.php');
	exit;
}

$juassi_page_title = 'Terminos de uso  :: Juassi Blog System Web Installer';
include 'includes/header.php';
?>
<div id="teaser">
	<div class="container">
		<h1>
			Asistente para la instalaci&oacute;n 
		</h1>
		<div id="progress-bar">
			<div class="license">
				<div class="bar-label">
					<p>Progreso</p>
					<div class="arrow"></div>
				</div>
				<div class="bar-steps-text">
					<p class="license"> Acuerdo de Licencia juassi-Blog</p>
				</div>
				<div class="bar-steps-count"></div>
			</div>
		</div>
	</div>
</div>

<div id="content">
	<div class="container">
		<iframe style="width: 100%" src="../LICENSE.htm" class="license" frameborder="0" scrolling="auto"></iframe>

		<div class="form-actions">
			<a href="../index.php" class="btn btn-large"><i class="icon-arrow-left"></i> Rechazo</a>
			<a href="pre-db-check.php" class="btn btn-large btn-primary">Acepto <i class="icon-arrow-right icon-white"></i></a>
		</div>			
	</div>
</div>

<?php include 'includes/footer.php';?>