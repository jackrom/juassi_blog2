<?php  
session_start();
if($_SERVER['REQUEST_METHOD']=='POST') {
  move_uploaded_file($_FILES["first_file_element"]["tmp_name"], 
  "c:\\sw\\wamp\\www\\" . $_FILES["first_file_element"]["name"]);
  echo "<p>File uploaded.  Thank you!</p>";
}

?>