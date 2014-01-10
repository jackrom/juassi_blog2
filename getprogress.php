<?php
if(isset($_GET['progress_key'])) {
  $status = apc_fetch('upload_'.$_GET['progress_key']);
  echo $status['current']/$status['total']*100;
}
?>