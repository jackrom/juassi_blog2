<?php
$root = getcwd().'/server/php/files/';
$sitemap_file = "sitemap.xml.gz";
$expire = 60; //segundos
$stime = gettimeofday();

$excludedir[] = "temp";
$excludedir[] = "tmp";
/* Array de archivos que no ser‡n visualizados. */
$excludefile[] = "index.php";

/* Array de tipos de archivos visualizados y sus respectivos iconos.
 * Sintaxis: $display[filetype] = "picture"; */
$display['php'] = "php.gif";
$display['html'] = "html.gif";
$display['htm'] = "html.gif";
$display['shtml'] = "html.gif";

$directorio = opendir($root); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if(is_dir($archivo) || $archivo == '.htaccess' || $archivo == '.gitignore'){//verificamos si es o no un directorio
        
    }elseif(is_file($archivo)&&  array_key_exists(get_extension($archivo),$display) && !in_array($archivo,$excludefile)){
    	echo $archivo;
    }else{
        
       echo $archivo.'<br/>';
    }
}

function get_extension($name)
{
	$array = explode(".", $name);
	$retval = strtolower(array_pop($array));
	return $retval;
}

function generateSitemap($chdir){//genera el sitemap retornando un xml
	global $display, $excludefile, $sitemap_file;
	
	
	$file = "sitemap.xml.gz";
	
	$sitemap="<?xml version='1.0' encoding='UTF-8'?>
    <urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'
    xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'
    xsi:schemaLocation='http://www.sitemaps.org/schemas/sitemap/0.9

	http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd'>";
	
	
	$directorio = opendir($chdir); //ruta actual
	while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
	{
		if(is_dir($archivo) || $archivo == '.htaccess' || $archivo == '.gitignore'){//verificamos si es o no un directorio
	
		}elseif(is_file($archivo)&&  array_key_exists(get_extension($archivo),$display) && !in_array($archivo,$excludefile)){
			$sitemap.= $archivo;
		}else{
			$sitemap.= '<url><br/>';
			$sitemap.= '<loc>'.$archivo.'</loc><br/>';
			$sitemap.= '</url><br/>';
		}
	}
	
	
	
	$sitemap.="</urlset>";
	
	if (file_exists($file)){
		unlink ($file);
	}
	$gzdata = gzencode($sitemap, 9);
	$fp = fopen($sitemap_file, "w");
	fwrite($fp, $gzdata);
	fclose($fp);
	
	return $sitemap;
}

if (time()>(filemtime($sitemap_file)+$expire)){
	generateSitemap('../');// El sitemap esta expirado entonces lo generamos
}




generateSitemap($root);// El sitemap esta expirado entonces lo generamos
?>