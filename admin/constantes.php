<?php

global $JUASSI_ROOT_PATH, $JUASSI_VERSION, $JUASSI_CACHE_PATH, $JUASSI_CONF_PATH,
  $JUASSI_CSS_PATH, $JUASSI_IMAGES_PATH, $JUASSI_LANGUAGE_PATH, $JUASSI_LIB_PATH,
  $JUASSI_PLUGIN_PATH, $JUASSI_IP2EXT_PATH, $JUASSI_ACCESS_FILE, $JUASSI_LAST_FILE,
  $JUASSI_CONFIG_FILE, $JUASSI_TIMESTAMP, $JUASSI_COUNTER_FILES, $JUASSI_COUNTER_PREFIX,
  $JUASSI_COUNTER_SUFFIX, $JUASSI_LOCK, $JUASSI_SEP, $JUASSI_COUNTER_COLUMNS,
  $JUASSI_COUNTER_COLUMN_NAMES, $JUASSI_LOG_PROCESSOR;

// JUASSI Analytics es la ubicación relativa de donde se le ha llamado
$JUASSI_ROOT_PATH = defined("_JUASSI_DIR") ? $_SERVER['DOCUMENT_ROOT']."/juassi/admin/" : "";
// JUASSI Analytics version
$JUASSI_VERSION = "1.0";
// Ruta del Directorio
$JUASSI_CACHE_PATH  = $JUASSI_ROOT_PATH."var/";
$JUASSI_CONF_PATH = $JUASSI_ROOT_PATH."conf/";
$JUASSI_CSS_PATH = "css/";
$JUASSI_IMAGES_PATH = "images/";
$JUASSI_LANGUAGE_PATH = $JUASSI_ROOT_PATH."language/";
$JUASSI_LIB_PATH = $JUASSI_ROOT_PATH."lib/";
$JUASSI_PLUGIN_PATH = $JUASSI_LIB_PATH."plugin/";
$JUASSI_IP2EXT_PATH = $JUASSI_ROOT_PATH."ip2ext/";
// Ruta de Archivos
$JUASSI_ACCESS_FILE = $JUASSI_CACHE_PATH."access.php";
$JUASSI_LAST_FILE = $JUASSI_CACHE_PATH."last.php";
$JUASSI_CONFIG_FILE = $JUASSI_CONF_PATH."config.php";
// Timestamp at run-time
$JUASSI_TIMESTAMP = time();
// Cantidad de archivos en el contador
$JUASSI_COUNTER_FILES = 8;
// Nombre del contador de archivos
$JUASSI_COUNTER_PREFIX = "counter";
$JUASSI_COUNTER_SUFFIX = ".inc";
$JUASSI_LOCK = $JUASSI_CACHE_PATH.".htalock";
// Separador global (esta funcion devuelve una cadena de un caracter que contiene el carácter especificado por ascii)
//en este caso signo de exclamacion
$JUASSI_SEP = chr(173);
// Cuantas columnas contienen
$JUASSI_COUNTER_COLUMNS = 8;
// Que titulos estan asignados a estos
$JUASSI_COUNTER_COLUMN_NAMES = array("time", "prx_ip", "ip", "dns", "agent", "referer", "uri", "page");
// Ruta del archivo procesador de los registros (logs)
$JUASSI_LOG_PROCESSOR = $JUASSI_ROOT_PATH."log_processor.php";

///////////////////////////////////////////////////////////////////////
// Do not touch the stuff below if you have no clue what it's doing! //
///////////////////////////////////////////////////////////////////////

// Manejador de los mensajes, es necesario que este disponible globalmente
function juassi_msg($item, $state = "r") {
	return "<div style=\"border: solid 2px red; background-color: yellow; padding: 4px; font-weight: bold;\">Error juassi_msg; item: " . $item . " / state: " . $state . "</div>";
}

// PHP version number
define("_JUASSI_PHP", substr(str_replace(".", "", PHP_VERSION), 0, 3));

?>
