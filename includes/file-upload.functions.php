<?php

function juassi_upload_script() {
	/*
	if the max file size in the form is more than what is set in php.ini then an addition
	needs to be made to the htaccess file to accomodate this

	add this to  your .htaccess file for this diretory
	php_value post_max_size 10M
	php_value upload_max_filesize 10M

	replace 10M to match the value you entered above for $max_file_size
	*/

	// upload dir
	$destination = juassi_get_upload_path();

	if(isset($_FILES)) {
		// initialize error var for processing
		$file_error = array();

		// function to check and move file
		function processFile($file, $destination, $file_error){

			// set full path/name of file to be moved
			$upload_file = $destination. $file['name'];

			if(file_exists($upload_file)) {
				$file_error[] = $file['name'].' - Nombre del archivo ya existe';
			}
			else {
				if(!move_uploaded_file($file['tmp_name'], $upload_file)) {
					// failed to move file
					$file_error[] = 'Fallo la subida del archivo '.$file['name'].' - Por favor intentelo de  nuevo';
				}
				else {
					// upload OK - change file permissions
					chmod($upload_file, 0755);
					trigger_error('Archivo Cargado: ' . $file['name'], E_USER_NOTICE);
				}
			}

			return $file_error;
		}

		// check to make sure files were uploaded
		$no_files = 0;

		foreach($_FILES as $file){

			switch($file['error']) {
				case 0:
					// file found
					if($file['name'] != NULL) {
						// process the file
						$file_error = processFile($file, $destination, $file_error);
					}
				break;

				case (1|2):
					// upload too large
					$file_error[] = 'El archivo subido es demasiado grande '.$file['name'];
				break;

				case 4:
					// no file uploaded
					//$file_error[] = 'No file selected to upload';
				break;

				case (6|7):
					// no temp folder or failed write - server config errors
					$file_error[] = 'Error Interno - sobrecargado el directorio con '.$file['name'];
					trigger_error('No hay carpeta temporal o fallo al escribir (fallo en subir el archivo)' . $file['name'], E_USER_ERROR);
				break;
			}
		}
	}
	return $file_error;
}

function juassi_get_upload_path() {

	$upload_dir = juassi_get_config('upload_path') . '/';
	if (empty($upload_dir)) $upload_dir = '';
	$root_dir = juassi_remove_end_slash(JUASSI_ROOT);

	return $root_dir . $upload_dir;

}
?>