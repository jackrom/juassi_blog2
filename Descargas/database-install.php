<?php
include_once( 'config.php' );
include_once( 'ez_sql/ez_sql_core.php' );
include_once( 'ez_sql/ez_sql_mysql.php' );

$db = new ezSQL_mysql( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );

$query_result = $db->query(
	'CREATE TABLE `download_keys` (
		`dl_key` varchar(32) NOT NULL,
		`dl_file` varchar(255) NOT NULL,
		`dl_expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`dl_key`));'
);

echo ( is_int( $query_result ) ) ? 'Table "download_keys" successfully created.' : 'An error occured while creating the table "download_keys".';
?>