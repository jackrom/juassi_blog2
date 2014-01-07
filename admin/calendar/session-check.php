<?php
	session_start();
	
	//Check if user is logged in
	if( !isset( $user_array['username'])){
		header("Location: index.php");
	}
?>
