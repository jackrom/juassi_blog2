<?php
  
 define("_JUASSI_DIR", $_SERVER['DOCUMENT_ROOT']."/juassi/");  
 define("COUNTER", _JUASSI_DIR."admin/mark_page.php");  
 if (is_readable(COUNTER)) include_once(COUNTER);  
?>
