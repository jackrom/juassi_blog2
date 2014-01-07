<?php
include('includes/common.php');
$juassi_js_onload = TRUE;
if (!isset($_SESSION['pass']) || $_SESSION['pass'] < 1) {
	$juassi_page_title = 'Database Check';
	include('includes/header.php');
	?>
	<div id="content">
		<div class="container">
			<div class="min-height">
				<p>Por favor inicie el proceso de instalaci&oacute;n desde  <a href="index.php">aqu&iacute;</a>.</p>
			</div>
		</div>
	</div>
	<?php
	include('includes/footer.php');
	exit;
}



if (isset($_POST['submit'])) {

	if (isset($_POST['dbtype'])) {

		switch($_POST['dbtype']) {

			case '1':
				$juassi_db_type = 'sqlite';
				break;

			case '2':
				$juassi_db_type = 'postgresql';
				break;

			default:
				$juassi_db_type = 'mysql';
				break;

		}

	}

	if (isset($_POST['dbhost']) && !empty($_POST['dbhost'])) {
		$juassi_db_host = $_POST['dbhost'];
	}
	else {
		$juassi_db_host = 'localhost';
		echo $juassi_db_host;
	}

	if (isset($_POST['dbname'])) {
		$juassi_db_name = $_POST['dbname'];
	}
	else {
		$juassi_db_name = '';
	}

	if (isset($_POST['dbpathname'])) {
		$juassi_db_path_name = $_POST['dbpathname'];
	}
	else {
		$juassi_db_path_name = '';
	}

	if (isset($_POST['dbusername'])) {
		$juassi_db_user = $_POST['dbusername'];
	}
	else {
		$juassi_db_user = '';
	}

	if (isset($_POST['dbpassword'])) {
		$juassi_db_pass = $_POST['dbpassword'];
	}
	else {
		$juassi_db_pass = '';
	}

	if (isset($_POST['table_prefix'])) {
		$table_prefix = $_POST['table_prefix'];
		$table_prefix = strtolower($table_prefix);
		$juassi_tb_prefix = preg_replace('([^a-z0-9_-])', '', $table_prefix);
		if (empty($juassi_tb_prefix)) $juassi_tb_prefix = 'cb2_';
	}
	else {
		$juassi_tb_prefix = 'cb2_';
	}

	$juassi_db_charset = 'UTF8';

	$database_error = FALSE;

	if (($juassi_db_type == 'mysql' && !empty($juassi_db_name)) || ($juassi_db_type == 'sqlite' && !empty($juassi_db_path_name)) || ($juassi_db_type == 'postgresql' && !empty($juassi_db_name))) {

		switch ($juassi_db_type) {

			case 'mysql':
				try {
					$juassi_install_db = new PDO('mysql:host=' . $juassi_db_host . ';dbname=' . $juassi_db_name, $juassi_db_user, $juassi_db_pass, array(PDO::ATTR_PERSISTENT => true));
				}
				catch (PDOException $e) {
					$database_message = $e->getMessage();
					$database_error = TRUE;
				}
				break;

			case 'sqlite':
				try {
					$juassi_install_db = new PDO('sqlite:' . $juassi_db_path_name);
				}
				catch (PDOException $e) {
					$database_message = $e->getMessage();
					$database_error = TRUE;
				}
				break;

			case 'postgresql':
				try {
					$juassi_install_db = new PDO('pgsql:host=' . $juassi_db_host . ';dbname=' . $juassi_db_name . ';user=' . $juassi_db_user . ';password=' . $juassi_db_pass);
				}
				catch (PDOException $e) {
					$database_message = $e->getMessage();
					$database_error = TRUE;
				}

				break;

		}
		$juassi_install_db = null;
	}
	else {
		$database_message = 'SQLSTATE[3D000]: Invalid catalog name: 1046 No database selected';
		$database_error = TRUE;
	}



	$pass = TRUE;
	$_SESSION['pass'] = 2;

	if ($database_error) {
		$pass = FALSE;
	}
	else {
		//start database connection here
		if ($juassi_db_type == 'mysql' || $juassi_db_type == 'postgresql') {
			$juassi_db = new juassi_db($juassi_db_host, $juassi_db_name, $juassi_db_user, $juassi_db_pass, $juassi_db_type, $juassi_db_charset);
		}
		else {
			$juassi_db = new juassi_db($juassi_db_host, $juassi_db_path_name, $juassi_db_user, $juassi_db_pass, $juassi_db_type, $juassi_db_charset);
		}
		$juassi_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$juassi_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
	}

	$juassi_tb = new tables($juassi_tb_prefix);

	if ($pass && juassi_is_installed()) {
		$already_installed = TRUE;
		$pass = FALSE;
	}
	else {
		$already_installed = FALSE;
	}

	if ($pass && $_SESSION['pass'] == 2) {
		$_SESSION['pass'] = 2;
		$_SESSION['juassi_tb_prefix'] = $juassi_tb_prefix;
		$_SESSION['juassi_db_type'] = $juassi_db_type;
		$_SESSION['juassi_db_host'] = $juassi_db_host;
		$_SESSION['juassi_db_name'] = $juassi_db_name;
		$_SESSION['juassi_db_user'] = $juassi_db_user;
		$_SESSION['juassi_db_pass'] = $juassi_db_pass;
		$_SESSION['juassi_db_path_name'] = $juassi_db_path_name;

		
	}
}else {
	if ($_SESSION['pass'] > 1) {
		$juassi_tb_prefix = $_SESSION['juassi_tb_prefix'];
		$juassi_db_type = $_SESSION['juassi_db_type'];
		$juassi_db_host = $_SESSION['juassi_db_host'];
		$juassi_db_name = $_SESSION['juassi_db_name'];
		$juassi_db_user = $_SESSION['juassi_db_user'];
		$juassi_db_pass = $_SESSION['juassi_db_pass'];
		$juassi_db_path_name = $_SESSION['juassi_db_path_name'];
		$pass = TRUE;
	}
	else {
		$juassi_tb_prefix = 'jb2_';
		$juassi_db_type = '';
		$juassi_db_host = '';
		$juassi_db_name = '';
		$juassi_db_user = '';
		$juassi_db_pass = '';
		$juassi_db_path_name = '';
	}

	$database_error = FALSE;
	$database_message = '';
}


$juassi_page_title = 'Database Check';
include('includes/header.php');
?>
<script type="text/javascript">
function ShowType(type)
        {
			   if (type == 0 || type == 2) {
				document.getElementById('mysql').style.display = 'block';
				document.getElementById('sqlite').style.display = 'none';
			   }
			   else {
			   	document.getElementById('mysql').style.display = 'none';
				document.getElementById('sqlite').style.display = 'block';
			   }
        }
</script>

	
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
			<?php if ($database_error) {
				echo '<div class="alert alert-error">'.juassi_admin_message.'(' . $database_message . ')'.'</div>';
				if (isset($already_installed) && $already_installed == TRUE) {
					echo juassi_admin_message('<strong>Parece que juassi-blog ya esta instalado. Si estas tratando de migrar desde juassi-blog v1.0 por favor lee la gu&iacute;a de migraci&oacute;n.</strong>');
				}
			}
			if(isset($_POST['submit'])){
				echo '<div class="alert alert-error">Por favor verifique que todos los datos sean correctos</div>';
			}
			?>
		</div>
		<form action="pre-db-check.php" method="post" class="form-horizontal">
			

			<div class="row">
				<div class="span4">
					<h3>Configuraci&oacute;n bade de datos</h3>
					<p>Configurar juassi-Blog en tu servidor solo requiere tres sencillos pasos...</p>
					<p>Por favor ingrese el nombre del servidor (hostname) donde ser&aacute; instalado juassi-Blog.</p>
					<p>Ingrese el username de la base de datos seleccionada, password y nombre de la base de datos, que deseas usar para la instalaci&oacute;n de juassi-Blog.</p>
					<p>Ingrese un nombre si desea un prefijo diferente al establecido para las tablas de la base de datos de juassi-Blog y selecciona que hacer con las tablas existentes de las antiguas instalaciones (si las hay).</p>
				</div>
				<div class="span8">
					<div class="well">
						<div class="control-group">
							<label class="control-label">Base de datos</label>
							<div class="controls">
								<select name="dbtype" id="dbtype" onChange="ShowType(document.getElementById('dbtype').value);">
										<option value="0">MySQL</option>
										<option value="1"<?php if ($juassi_db_type == 'sqlite') echo ' selected="selected"' ?>>SQLite</option>
										<option value="2"<?php if ($juassi_db_type == 'postgresql') echo ' selected="selected"' ?>>PostgreSQL</option>
								</select>
							</div>
						</div>
						<div class="control-group" id="err_dbhost">
							<label class="control-label">Servidor BD:</label>
							<div class="controls">
								<input type="text" name="dbhost" id="dbhost" value="<?php echo juassi_htmlentities($juassi_db_host); ?>" />
								<span class="help-inline" style="display: none;">Por favor ingrese el nombre del host correcto.</span>
							</div>
						</div>
						<div class="control-group" id="err_dbuser">
							<label class="control-label">Usuario BD:</label>
							<div class="controls">
								<input type="text" name="dbusername" id="dbuser" value="<?php echo juassi_htmlentities($juassi_db_user); ?>" />
								<span class="help-inline" style="display: none;">Por favor ingrese el usuario correcto.</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Password BD:</label>
							<div class="controls">
								<input type="password" name="dbpassword" id="dbpwd" value="<?php echo juassi_htmlentities($juassi_db_pass); ?>" />
							</div>
						</div>
						<div class="control-group" id="err_dbname">
							<label class="control-label">Nombre BD:</label>
							<div class="controls">
								<input type="text" name="dbname" id="dbname" value="<?php echo juassi_htmlentities($juassi_db_name); ?>" />
								<span class="help-inline" style="display: none;">Por favor ingrese el nombre de la base de datos correcta.</span>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Puerto BD:</label>
							<div class="controls">
								<input type="text" name="dbport" id="dbport" value="3306" />
							</div>
						</div>
						<div class="control-group" id="err_prefix">
							<label class="control-label">Prefijo de tablas:</label>
							<div class="controls">
								<input type="text" name="table_prefix" id="prefix" value="<?php echo juassi_htmlentities($juassi_tb_prefix); ?>" />
								<span class="help-inline" style="display: none;">por favor especifique el prefijo para las tablas.</span>
								<p>(caracteres permitidos incluye: a-z, 0-9, _ y -)</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="delete_tables">Eliminar tablas: </label>
							<div class="controls">
								<label class="checkbox">
									<input type="checkbox" id="delete_tables" name="delete_tables" />
									Las tablas existentes ser&aacute;n eliminadas si se activa.
								</label>
							</div>
						</div>
						<div id="sqlite" style="display: none;">
							<p>Path Name de la base de datos<br />
								<input name="dbpathname" type="text" value="<?php echo juassi_htmlentities($juassi_db_path_name); ?>" size="55" />
								<br />(ubicaci&oacute;n full  de tu base de datos SQLite; ser&aacute; creada si es requerida. Nota: Por razones de seguridad es mejor mantener este archivo fuera de tu carpeta de archivos publica)
							</p>
							<p>Note: Tu actual path es <?php echo juassi_htmlentities(dirname(__FILE__)); ?></p>
						</div>
						
					</div>
				</div>
			</div>
			<div class="form-actions">
				<a href="licencia.php" class="btn btn-large"><i class="icon-arrow-left"></i> Regresar</a>
				<?php if (isset($pass) && $pass == TRUE) { 
					echo '<a href="site-details.php" class="btn btn-large btn-primary">Siguiente <i class="icon-chevron-right icon-white"></i></a>';
			   }else{
					echo '<input class="btn btn-large btn-primary" name="submit" type="submit" value="Submit" />';
				} ?>
			</div>	
			
		</form>
	
		
	</div>
</div>

<?php include 'includes/footer.php';?>