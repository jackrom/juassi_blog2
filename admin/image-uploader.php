<?php

	require_once("calendar/eventer-config.php");
	
	$storage = "calendar/images/";
	$file = basename($_FILES['uploadfile']['name']);
	
	if ( move_uploaded_file($_FILES['uploadfile']['tmp_name'] , $storage.''.$file ) ) {
		
		$query = "INSERT INTO juassi2_images(`path`) VALUES('$file')";
		$result = mysql_query($query);
		if ($result) {
			echo "1";
		}
		else {
			echo "0";
		}
	}
	else{
		echo "0";
	}

?>
