<?php
/*
If you don't want to use themes you can include your template here under the include (make sure themes are disabled)
*/
include('includes/juassi_header.php');
?>

<?php
      define("_JUASSI_DIR", "".$_SERVER['DOCUMENT_ROOT']."/juassi/");
      define("COUNTER", _JUASSI_DIR.""."admin/mark_page.php");
      if (is_readable(COUNTER)) include_once(COUNTER);
?> 