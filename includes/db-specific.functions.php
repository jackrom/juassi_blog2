<?php
/*
	Juassi 2.0 Database Specific Functions
	Juan Carlos Reyes C Copyright 2012
*/
function juassi_is_installed() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	switch ($juassi_db_type) {
		case 'postgresql':
			$stmt = $juassi_db->prepare("SELECT table_name FROM information_schema.tables WHERE table_schema = '$juassi_tb->site'");
		break;

		case 'sqlite':
			$stmt = $juassi_db->prepare("SELECT * FROM SQLITE_MASTER WHERE tbl_name='$juassi_tb->site'");
		break;

		//mysql
		default:
			$stmt = $juassi_db->prepare("SHOW TABLES LIKE '$juassi_tb->site'");
	}
	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		juassi_die(' database not installed');
	}
	$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if (!isset($array[0])) return false;

	return true;
}

function juassi_optimise_tables() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	switch ($juassi_db_type) {
		case 'mysql':
			$optimise_tables = '';
			foreach ($juassi_tb->tables as $value => $index) {
				$optimise_tables .= $index . ',';
			}
			$optimise_tables = substr($optimise_tables, 0, strlen($optimise_tables) - 1);
			$query = 'OPTIMIZE TABLE ' . $optimise_tables;
			trigger_error('Optimising Tables', E_USER_NOTICE);
			foreach ($juassi_db->query($query, PDO::FETCH_ASSOC) as $row) {
				if ($row['Msg_type'] == 'error') {
					$type = E_USER_WARNING;
				}
				else {
					$type = E_USER_NOTICE;
				}
				trigger_error('Table "' . juassi_htmlentities($row['Table'])  . '"<br />Message "' . juassi_htmlentities($row['Msg_text']) . '"', $type);
			}
			trigger_error('Optimised Tables', E_USER_NOTICE);
		break;

		case 'sqlite':
			trigger_error('Optimise Tables is only available when using a MySQL database', E_USER_NOTICE);
		break;

		case 'postgresql':
			trigger_error('Optimise Tables is only available when using a MySQL database', E_USER_NOTICE);
		break;

	}
}

function juassi_repair_tables() {
	global $juassi_db, $juassi_tb, $juassi_db_type;

	switch ($juassi_db_type) {
		case 'mysql':
			$repair_tables = '';
			foreach ($juassi_tb->tables as $value => $index) {
				$repair_tables .= $index . ',';
			}
			$repair_tables = substr($repair_tables, 0, strlen($repair_tables) - 1);
			$query = 'REPAIR TABLE ' . $repair_tables;
			trigger_error('Repairing Tables', E_USER_NOTICE);
			foreach ($juassi_db->query($query, PDO::FETCH_ASSOC) as $row) {
				if ($row['Msg_type'] == 'error') {
					$type = E_USER_WARNING;
				}
				else {
					$type = E_USER_NOTICE;
				}
				trigger_error('Table "' . juassi_htmlentities($row['Table'])  . '"<br />Message "' . juassi_htmlentities($row['Msg_text']) . '"', $type);
			}
			trigger_error('Repaired Tables', E_USER_NOTICE);

		break;

		case 'sqlite':
			trigger_error('Repair Tables is only available when using a MySQL database', E_USER_NOTICE);
		break;

		case 'postgresql':
			trigger_error('Repair Tables is only available when using a MySQL database', E_USER_NOTICE);
		break;

	}

}

?>