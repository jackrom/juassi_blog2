<?php 
include('includes/common.php');
include 'classes/helper.php';
$no_include['db.php'] = true;


if (file_exists('../privado/config.php') && !isset($_SESSION['pass'])) {
	juassi_die('config.php existe (esta instalado?). Si es esta una nueva instalaci&oacute;n, por favor borre config.php');
}


define('INSTALL', 'juassi-install');
define('JUASSI_DS', '/');
define('JUASSI_URL_DELIMITER', '/');
define('JUASSI_HOME',dirname(dirname(__FILE__)));
define('JUASSI_INSTALL', JUASSI_HOME .JUASSI_DS. INSTALL . JUASSI_DS);

$checks = array(
	'server' => array()
);

$pass = true;
$juassi_page_title = 'Chequear condiciones  :: Juassi Blog System Web Installer';

include 'includes/header.php';
?>

	<div id="teaser">
		<div class="container">
			<h1>
				Asistente para la instalaci&oacute;n 
			</h1>
			<div id="progress-bar">
				<div class="check">
					<div class="bar-label">
						<p>Progreso</p>
						<div class="arrow"></div>
					</div>
					<div class="bar-steps-text">
						<p class="check">pre-chequeo para instalaci&oacute;n</p>
					</div>
					<div class="bar-steps-count"></div>
				</div>
			</div>
		</div>
	</div>

	<div id="content">
		<div class="container">
	<div class="row">
	<div class="span4">
		<h3>Configuraci&oacute;n del Servidor</h3>
		<p>Si alguno de estos elementos se destacan en rojo, debe tomar medidas para corregirlos, de lo contrario, podr&iacute;a conducir a que la instalaci&oacute;n no funcione correctamente.</p>
	</div>
	<div class="span8">
		<table class="table table-bordered pre-install">
			<tbody>
				<tr>
					<td class="elem" style="width: 220px;">Mysql version<span class="label label-warning">Requerida</span></td>
					<?php 
					if(function_exists('mysql_connect')){
						echo '<td class="success">' . mysql_get_client_info() . '</td>';
					}else{
						echo '<td class="important">MySQL 4.x o mayor requerida</td>';
						$mysql_version = FALSE;
						$pass = FALSE;
					}
					?>		
				</tr>
				<tr>
					<td class="elem" style="width: 220px;">PHP version<span class="label label-warning">Requerida</span></td>
					<?php
						if(version_compare('5.0', PHP_VERSION, '<')){
							echo '<td class="success">' . PHP_VERSION . '</td>';
						}else{
							'<td class="important">La versi&oacute;n PHP no es compatible. PHP 5.x necesaria. (Actual versi&oacute;n ' . PHP_VERSION . ')</td>';
							$pass = FALSE;
							$php_version = FALSE;
						} 
					?>			
				</tr>
				<tr>
					<td style="width: 220px;">Soporte de archivos remotos</td>
					<?php 
					if(Helper::hasAccessToRemote()){
						echo '<td class="success">Disponible</td>';
					}else{
						echo '<td class="important">No disponible (Altamente recomendable la extensi&oacute;n "CURL" o "allow_url_fopen")</td>';
					}
					?>
							
				</tr>
				<tr>
					<td style="width: 220px;">Soporte XML</td>
					<?php 
					if(extension_loaded('xml')){
						echo '<td class="success">Disponible</td>';
					}else{
						echo '<td class="important">No disponible (recomendado)</td>';
					}
					?>			
				</tr>
				<tr>
					<td style="width: 220px;">Soporte MySQL</td>
					<?php 
					if(function_exists('mysql_connect')){
						echo '<td class="success">Disponible</td>';
					}else{
						echo '<td class="important">No Disponible (required)</td>';
					}
					?>
								
				</tr>
				<tr>
					<td style="width: 220px;">GD Extensi&oacute;n</td>
					<?php 
					if(extension_loaded('gd')){
						echo '<td class="success">Disponible</td>';
					}else{
						echo '<td class="important">No disponible (Altamente recomendable)</td>';
					}
					?>
							
				</tr>
				<tr>
					<td style="width: 220px;">Extensi&oacute;n Mbstring</td>
					<?php 
					if(extension_loaded('mbstring')){
						echo '<td class="success">Disponible</td>';
					}else{
						echo '<td class="important">No disponible (no requerido) </td>';
					}
					?>
								
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span4">
		<h3>Configuraci&oacute;n recomendada</h3>
		<p>Se recomienda esta configuraci&oacute;n para PHP con el fin de garantizar la plena compatibilidad con juassi-Blog. Sin embargo, juassi-Blog seguir&aacute; funcionando si la configuraci&oacute;n no se ajusta exactamente con la recomendada.</p>
	</div>
	<div class="span8">
		<table class="table table-bordered pre-install">
			<thead>
				<tr>
					<th>Directiva</th>
					<th>Recomendada</th>
					<th>Actual</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$recommendedSettings = array(
						array ('File Uploads', 'file_uploads', 'ON'),
						array ('Magic Quotes GPC', 'magic_quotes_gpc', 'OFF'),
						array ('Register Globals', 'register_globals', 'OFF')
					);
					
					?>
				<tr>
					<td style="width: 220px;">Subidas de archivos:</td>
					<td>ON</td>
					<?php if(Helper::getIniSetting('file_uploads') == 'ON'){
							echo '<td class="success">';
						  }else{
							echo '<td class="important">';
						  } 
						  echo Helper::getIniSetting('file_uploads') . '</td>';
					  ?>		
				</tr>
				<tr>
					<td style="width: 220px;">Magic Quotes GPC:</td>
					<td>OFF</td>
					<?php if(Helper::getIniSetting('magic_quotes_gpc') == 'OFF'){
							echo '<td class="success">';
						  }else{
							echo '<td class="important">';
						  } 
						  echo Helper::getIniSetting('magic_quotes_gpc') . '</td>';
					  ?>			
				</tr>
				<tr>
					<td style="width: 220px;">Registros globales:</td>
					<td>OFF</td>
					<?php if(Helper::getIniSetting('register_globals') == 'OFF'){
							echo '<td class="success">';
						  }else{
							echo '<td class="important">';
						  } 
						  echo Helper::getIniSetting('register_globals') . '</td>';
					  ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="span4">
		<h3>Archivos y directorios</h3>
		<p>Para que juassi-Blog se instale correctamente, tiene que acceder o escribir en ciertos archivos o directorios. Si ve "unwriteable" necesita cambiar los permisos del archivo o directorio para permitir a juassi-Blog escribir en ellos.</p>
	</div>
	<div class="span8">
		<table class="table table-bordered pre-install">
			<tbody>
				<?php 
				$directory = array(
						array('tmp' . JUASSI_DS, '', true),
						array('archive' . JUASSI_DS, '', true),
						array('juassi-backup' . JUASSI_DS, ' (optional)', false),
						array('juassi-content' . JUASSI_DS, ' (optional)', false),
						array('privado' . JUASSI_DS . 'config.php', ' (optional)', false),
				);
				 
					foreach ($directory as $item){
						$text = '';
						$isWritable = TRUE;
						echo '<tr><td class="elem" style="width: 220px;">'.$item[0].'<span class="label label-warning">Requerido</span></td>';
						if (file_exists(JUASSI_HOME .JUASSI_DS. $item[0]))
						{
							if(is_writable(JUASSI_HOME.JUASSI_DS . $item[0])){
									echo '<td class="success">Leer | Escribir</td>';
							}
							else {
								echo '<td class="' . (empty($item[1]) ? 'importante' : 'opcional') . '">Solo Leer ' . $item[1] . '</td></tr>';
								$pass = FALSE;
								$isWritable = FALSE;
							}
							$isWritable = is_writable(JUASSI_HOME.JUASSI_DS . $item[0]);
						}else{
							if ($item[0] == 'privado' . JUASSI_DS . 'config.php')
							{
								if (!is_writable(JUASSI_HOME.JUASSI_DS . 'privado' . JUASSI_DS))
								{
									echo '<td class="important">No existe y puede ser creado' . $item[1] . '</td>';
									//$pass = TRUE;
									$isWritable = FALSE;
								}
								else
								{
									echo '<td class="success">No existe pero puede ser creado' . $item[1] . '</td>';
								}
							}
							else
							{
								$text = '<td class="important">No existe' . $item[1] . '</td>';
							}
						}
						$checks['directory'][$item[0]] = array(
								'class' => true,
								'name' => $item[0],
								'value' => $text
						);
					
						if ($item[2])
						{
							$checks['directory'][$item[0]]['required'] = $isWritable;
						}
					}
					?>
					
				
			</tbody>
		</table>
	</div>
</div>
<div class="form-actions">
	<a href="pre-check.php" class="btn btn-large btn-success"><i class="icon-refresh icon-white"></i> Chequear</a>
		<?php 
		if ($pass) {
			if (!isset($_SESSION['pass']) || $_SESSION['pass'] < 1 || $php_version = TRUE || $mysql_version = TRUE || $isWritable = FALSE ){
				$_SESSION['pass'] = 1;
				echo '<a href="licencia.php" class="btn btn-large btn-primary">Siguiente <i class="icon-chevron-right icon-white"></i></a>';
			}
		}
		else {
			$_SESSION['pass'] = 0;
			echo '<a href="pre-check.php" class="btn btn-large btn-danger disabled">Siguiente <i class="icon-remove"></i></a>';
		}
		?>
	
</div>			
</div>
</div>

<?php include 'includes/footer.php';?>