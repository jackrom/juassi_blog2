<?php
include('includes/common.php');

if (!isset($_SESSION['pass']) || $_SESSION['pass'] == 1) {
	$juassi_page_title = 'Site Details';
	include('includes/header.php');
	?>
	<div id="content">
		<div class="container">
			<div class="min-height">
				<p>Por favor inicie el proceso de instalaci&oacute;n desde <a href="index.php">aqu&iacute;</a>.</p>
			</div>
		</div>
	</div>
	<?php
	include('includes/footer.php');
	exit;
}


$pass = false;

if (isset($_POST['submit'])) {
	$juassi_port = (int) $_POST['juassi_site_port'];
	$juassi_script_path = juassi_remove_end_slash($_POST['juassi_site_script_path']);
	$juassi_site_name = $_POST['juassi_site_name'];
	$juassi_site_description = $_POST['juassi_site_description'];
	$juassi_site_domain = strtolower($_POST['juassi_site_domain']);
	if ($_POST['juassi_rewrite'] == 1) {
		$juassi_rewrite = true;
	}
	else {
		$juassi_rewrite = false;
	}

	if (empty($juassi_site_name)) {
		$output = '<strong>Por favor ingresa un nombre para tu blog.</strong>';
	}
	elseif (empty($juassi_site_domain)) {
		$output = '<strong>Por favor ingresa un dominio para tu blog.</strong>';
	}
	else {
		$pass = true;
		if ($_SESSION['pass'] < 4) {
			$_SESSION['pass'] = 4;
		}
		$_SESSION['juassi_site_port'] = $juassi_port;
		$_SESSION['juassi_site_script_path'] = $juassi_script_path;
		$_SESSION['juassi_site_name'] = $juassi_site_name;
		$_SESSION['juassi_site_description'] = $juassi_site_description;
		$_SESSION['juassi_site_domain'] = $juassi_site_domain;
		$_SESSION['juassi_rewrite'] = $juassi_rewrite;
	}

	if ($_SESSION['pass'] > 3) {
		$juassi_port = (int) $_SESSION['juassi_site_port'];
		$juassi_script_path = $_SESSION['juassi_site_script_path'];
		$juassi_site_name = $_SESSION['juassi_site_name'];
		$juassi_site_description = $_SESSION['juassi_site_description'];
		$juassi_site_domain = $_SESSION['juassi_site_domain'];
		$juassi_rewrite = $_SESSION['juassi_rewrite'];
		$pass = true;
	}
	else {
		$juassi_script_path = str_replace('/juassi-install/site-details.php', '',  strtolower($_SERVER['PHP_SELF']));
		$juassi_port = (int) $_SERVER['SERVER_PORT'];
		$juassi_site_domain = strtolower($_SERVER['SERVER_NAME']);
		$juassi_site_name = '';
		$juassi_site_description = '';
		$juassi_rewrite = true;
		$pass = false;
	}
}else{
	$juassi_script_path = str_replace('/juassi-install/site-details.php', '',  strtolower($_SERVER['PHP_SELF']));
	$juassi_port = (int) $_SERVER['SERVER_PORT'];
	$juassi_site_domain = strtolower($_SERVER['SERVER_NAME']);
	$juassi_site_name = '';
	$juassi_site_description = '';
	$juassi_rewrite = true;
	$pass = false;
}
$juassi_page_title = 'Site Details';
include('includes/header.php');

?>
<div id="teaser">
	<div class="container">
		<h1>
			Asistente para la instalaci&oacute;n  
		</h1>
		<div id="progress-bar">
			<div class="configuration">
				<div class="bar-label">
					<p>progreso</p>
					<div class="arrow"></div>
				</div>
				<div class="bar-steps-text">
					<p class="configuration"> Configuraci&oacute;n</p>
				</div>
				<div class="bar-steps-count"></div>
			</div>
		</div>
	</div>
</div>

<div id="content">
	<div class="container">
		<div class="min-height">
			
			<?php 
					if (isset($output)){
						echo '<div class="alert alert-error">';
						echo juassi_admin_message($output); 
						echo '</div>';
					}
					
					if(isset($_POST['submit'])){
						echo '<div class="alert alert-error">Por favor verifique que todos los datos sean correctos</div>';
					}
			?>
			
		</div>
		<form action="site-details.php" method="post" class="form-horizontal">
			<div class="row">
				<div class="span4">
					<h3>Configuraci&oacute;n com&uacute;n</h3>
					<p>Configure correctamente la direcci&oacute;n URL donde ser&aacute; instalado tu juassi-Blog.</p>
					<p>Por favor selecciona la plantilla desde las opciones disponibles para ser cargadas al directorio de plantillas de tu juassi-Blog.</p>
				</div>
				<div class="span8">
					<div class="well">
						<div class="control-group">
							<label class="control-label">URL de Instalaci&oacute;n:</label>
							<div class="controls">
								<?php 
								$host = str_replace($_SERVER['DOCUMENT_ROOT'],'http://'.$_SERVER['SERVER_NAME'],dirname(__DIR__));
								?>
								<input type="text" name ="juassi_site_domain" value="<?php echo juassi_htmlentities($juassi_site_domain); ?>" />
							</div>
						</div>
						
						<div class="control-group" id="juassi_site_name">
							<label class="control-label">Nombre de tu blog:</label>
							<div class="controls">
								<input type="text" name="juassi_site_name"  id="juassi_site_name" value="<?php echo juassi_htmlentities($juassi_site_name); ?>" />
								
							</div>
						</div>
						
						<div class="control-group" id="juassi_site_description">
							<label class="control-label">Descripci&oacute;n:</label>
							<div class="controls">
								<input type="text" name="juassi_site_description" id="juassi_site_description" value="<?php echo juassi_htmlentities($juassi_site_description); ?>" />
								
							</div>
						</div>
						
						<div class="control-group" id="err_admin_username">
							<label class="control-label">Puerto el Sitio:</label>
							<div class="controls">
								<input type="text" name="juassi_site_port"  id="admin_username" value="<?php echo  (int) $_SERVER['SERVER_PORT']; ?>" />
							</div>
						</div>
						
						<div class="control-group" id="err_admin_username">
							<label class="control-label">Script Path:</label>
							<div class="controls">
								<input name="juassi_site_script_path" type="text" value="<?php echo juassi_htmlentities($juassi_script_path); ?>" />
								<p>Script Path (La direcci&oacute;n relative al nombre del dominio donde ser&aacute; instalado juassi-blog<br />
por ejemplo www.ejemplo.com/blog/ es igual a /blog)</p>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label">URL rewriting:</label>
							<div class="controls">
								<select name="juassi_rewrite">
									<option value="1">On</option>
									<option value="0"<?php if (!$juassi_rewrite) { echo ' selected="selected"'; } ?>>Off</option>
								</select>
								<p>requiere mod_rewrite</p>
							</div>
						</div>
		
						<div class="control-group">
							<label class="control-label">Plantilla por defecto:</label>
							<div class="controls">
								<select disabled="disabled">
									<option value="default">Por defecto</option>
								</select>
								<strong>Plantilla por defecto</strong>
								<input type="hidden" name="tmpl" id="tmpl" value="default" />
							</div>
						</div>
		
						<div class="control-group">
							<label class="control-label">Modo Debug:</label>
							<div class="controls">
								<select name="debug" id="debug">
									<option value="0" selected="selected">No mostrar errores</option>
									<option value="1">Mostrar errores en un cajon de textos</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<a href="pre-db-check.php" class="btn btn-large"><i class="icon-arrow-left"></i> Regresar</a>
				<?php if (isset($pass) && $pass == TRUE) { 
					echo '<a href="admin-account.php" class="btn btn-large btn-primary">Siguiente <i class="icon-chevron-right icon-white"></i></a>';
			   }else{
					echo '<input class="btn btn-large btn-primary" name="submit" type="submit" value="submit" />';
				} ?>
			</div>		
		</form>

	</div>
</div>


<?php include('includes/footer.php'); ?>