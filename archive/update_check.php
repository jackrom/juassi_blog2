<?php
/*
	Juassi 2.0 Config File
*/

//database host (often localhost)
$juassi_db_host = 'localhost';

/*
database name (e.g. juassi)
If (and only if) you're using SQlite then this should be the full path to your db file.
e.g. /home/user/juassi.db
Please put this database outside your public html area
*/
$juassi_db_name = 'jcarlos_blog';

//database user name
$juassi_db_user = 'jcarlos';

//database password
$juassi_db_pass = '6662115Jc';

//database type (i.e mysql or sqlite).
$juassi_db_type = 'mysql';

//database charset (i.e. UTF8)
$juassi_db_charset = 'UTF8';

//table prefix. Used if you have more than one version of bluetrait running in a single database
$juassi_tb_prefix = 'blog_';
	
//blog id (for future use)
define('JUASSI_ID', 1);

//we're installed!
define('JUASSI_INSTALLED', true);

?>