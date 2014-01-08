<?php
/*
	Juassi 2.0 Config File
	Juan Carlos Reyes C Copyright 2012
*/

//database host (often localhost)
$juassi_db_host = '';

/*
database name (e.g. juassi)
If (and only if) you're using SQlite then this should be the full path to your db file.
e.g. /home/user/juassi.db
Please put this database outside your public html area
*/
$juassi_db_name = '';

//database user name
$juassi_db_user = '';

//database password
$juassi_db_pass = '';

//database type (i.e mysql or sqlite).
$juassi_db_type = 'mysql';

//database charset (i.e. UTF8)
$juassi_db_charset = 'UTF8';

//table prefix. Used if you have more than one version of bluetrait running in a single database
$juassi_tb_prefix = 'jb2_';

//blog id (for future use)
define('JUASSI_ID', 1);

//we're installed!
define('JUASSI_INSTALLED', true);

?>