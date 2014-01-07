<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

function strip_zeros_from_date( $marked_string="" ) {
  $no_zeros = str_replace('*0', '', $marked_string);
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function generate_id($length = 6) {
	$id = '';
	for ($i=0;$i<$length;$i++){
		$id .= rand(1, 9);
	}
	return $id;
}

function __autoload($class_name) {
  $class_name = strtolower($class_name);
  $path = "{$class_name}.class.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("El archivo {$class_name}.class.php no pudo ser encontrado.");
	}
}

function convert_boolean($boolean) {
	if($boolean == 0) {
		$end = "No";
	} else if($boolean == 1) {
		$end = "Yes";
	}
	return $end;
}

function convert_boolean_full($boolean) {
	if($boolean == 0) {
		$end = "Deactivated";
	} else if($boolean == 1) {
		$end = "Activated";
	}
	return $end;
}

function convert_token_status($enum) {
	if($enum == 'c') {
		$end = "Credited";
	} else if($enum == 'd') {
		$end = "Debited";
	}
	return $end;
}

function convert_user_level($level) {
	global $database;
	
	$sql = "SELECT * FROM user_levels WHERE level_id = '{$level}'";
	$query = $database->query($sql);
	$row = $database->fetch_array($query);
	return $row['level_name'];
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%A %d of %B %Y at %I:%M %p", $unixdatetime);
}

date('l jS \of F Y \a\t h:i:s A');

function date_to_text($date="") {
  $unixdatetime = strtotime($date);
  return strftime("%d %B %Y", $unixdatetime);
}

function date_text_month($date="") {
  $unixdatetime = strtotime($date);
  return strftime("%B", $unixdatetime);
}

function protect($users_level, $group_id, $redirect="index.php") {
	$groups = explode(",", $group_id);
	if (!in_array($users_level, $groups)) {
		redirect_to($redirect);
	}
}

?>