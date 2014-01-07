<?php

function juassi_create_mysql_config($config_array)  {
	$config_data = 
'<?php
/*
	Juassi 2.0 Archivo de Configuración
*/

//host de la base de datos (a menudo localhost)
$juassi_db_host = \'' . $config_array['juassi_db_host'] . '\';

/*
nombre base de datos (e.g. juassi)
Sí (y solo sí) tu estás usando SQlite, entonces debería ser el nombre full de tu archivo de db.
e.g. /home/user/juassi.db
Por favor pon fuera de tu carpeta public html este archivo
*/
$juassi_db_name = \'' . $config_array['juassi_db_name'] . '\';

//usuario de la base de datos
$juassi_db_user = \'' . $config_array['juassi_db_user'] . '\';

//password de la base de datos (contraseña)
$juassi_db_pass = \'' . $config_array['juassi_db_pass'] . '\';

//tipo de base de datos (i.e mysql o sqlite).
$juassi_db_type = \'' . $config_array['juassi_db_type'] . '\';

//charset de la base de datos (i.e. UTF8)
$juassi_db_charset = \'' . $config_array['juassi_db_charset'] . '\';

//prefijo de las tablas. Usado si tienes mas de una version de juassi-blog en una sencilla base de datos
$juassi_tb_prefix = \'' . $config_array['juassi_tb_prefix'] . '\';
	
//id del blog(para futuros usos)
define(\'JUASSI_ID\', 1);

//estamos instalados!!!
define(\'JUASSI_INSTALLED\', true);

?>';
	return $config_data;
}

function juassi_create_sqlite_config($config_array)  {
	$config_data = 
'<?php
/*
	Juassi 2.0 Config File
*/

//host de la base de datos (a menudo localhost)
$juassi_db_host = \'\';

/*
nombre base de datos (e.g. juassi)
Sí (y solo sí) tu estás usando SQlite, entonces debería ser el nombre full de tu archivo de db.
e.g. /home/user/juassi.db
Por favor pon fuera de tu carpeta public html este archivo
*/
$juassi_db_name = \'' . $config_array['juassi_db_path_name'] . '\';

//usuario de la base de datos
$juassi_db_user = \'\';

//password de la base de datos (contraseña)
$juassi_db_pass = \'\';

//tipo de base de datos (i.e mysql o sqlite).
$juassi_db_type = \'' . $config_array['juassi_db_type'] . '\';

//charset de la base de datos (i.e. UTF8)
$juassi_db_charset = \'\';

//prefijo de las tablas. Usado si tienes mas de una version de juassi-blog en una sencilla base de datos
$juassi_tb_prefix = \'' . $config_array['juassi_tb_prefix'] . '\';
	
//id del blog(para futuros usos)
define(\'JUASSI_ID\', 1);

//estamos instalados!!!
define(\'JUASSI_INSTALLED\', true);

?>';
	return $config_data;
}
	
function juassi_write_config($filename, $config_data) {

	if ($handle = fopen($filename, 'x')) { 
  
		if (fwrite($handle, $config_data)) {   
			fclose($handle);
			return true;
		}
		else {
			echo juassi_admin_message('<strong>Lo sentimos,Estamos listos para crear el archivo juassi-config.php, por favor, asegurate de querer crearlo tu mismo.</strong>');
			fclose($handle);
			return false;
		}
	}
	else {
		echo juassi_admin_message('<strong>juassi-config.php ya parece existir o no se tiene privilegios de escritura en su ubicación. Por favor, asegúrese de que tiene los datos correctos.</strong>');
		return false;
	}
}