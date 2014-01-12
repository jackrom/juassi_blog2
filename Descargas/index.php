<?php
include_once 'config.php';
include_once 'class-secure-file-download.php';


$download = new Secure_File_Download(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

$dl_key = $download->create_key('../archive/blog_590x300.png', 60*60);

//$download->download($dl_key);



$directorio = getcwd();

$SERVER_NAME = $_SERVER['HTTP_HOST'];
echo 'directorio = '.$directorio.'<br/>';
$display['php'] = "php.gif";
$display['html'] = "html.gif";
$display['htm'] = "html.gif";
$display['shtml'] = "html.gif";
/* Array de directorios que no deben ser visualizados.
 * Sintaxis: $excludedir[] = "directory"; */
$excludedir[] = "temp";
$excludedir[] = "tmp";
/* Array de archivos que no ser‡n visualizados. */
$excludefile[] = "index.php";
$direc = chdir('../functions');
echo 'tomamos este directorio para explorar: '.$direc.'<br/>';


$sfiles = array();
$self = basename($SERVER_NAME);
$archivos = opendir('../functions');


echo $archivos.'<br/>';
while ($file = readdir($archivos)){
	if(is_dir($file) && $file != "." && $file != ".." && !in_array($file,$excludedir)){
		$sdirs[] = $file;
	}elseif(is_file($file)&& $file != "$self" && array_key_exists(get_extension($file),$display) && !in_array($file,$excludefile)){
		$sfiles[] = $file;
	}
}

echo count($sfiles);



function get_extension($name)
{
	$array = explode(".", $name);
	$retval = strtolower(array_pop($array));
	return $retval;
}

//list_dir($_SERVER['PHP_SELF']);