<?php

if(!defined("_JUASSI_PAGE_NAME")){define("_JUASSI_PAGE_NAME", "JUASSI Analytics");}
// Muestra por defecto las estadisticas globales
if (is_readable("show_global.php")) include_once("show_global.php");
echo  '<?php\n'.'define("_JUASSI_DIR", "".dirname(__FILE__)."/");\n'.'define("COUNTER", _JUASSI_DIR."'.'mark_page.php");\n'.'if (is_readable(COUNTER)) include_once(COUNTER);\n'
      .'?>\n'; 
?>
