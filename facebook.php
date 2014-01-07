<?php
// Incluimos el PHP SDK v.3.0.0 de Facebook    
require 'login/includes/facebook.php';
 
// Creamos un nuevo objeto con los datos de nuestra aplicación (cambia los datos por los de tu App ID y tu App Secret).
$facebook = new Facebook(array(
  'appId'  => '537771372978280',
  'secret' => 'f856f6b9f77ef08e535df168bfdfc8d1',
));

// Obtener el ID del Usuario
$user = $facebook->getUser();
 
// Podemos obtener o no este dato dependiendo de si el usuario se ha identificado en Facebook o no
//
 
if ($user) {
  try {
    // Procedemos a saber si tenemos a un usuario que se ha identificado en Facebook que está autentificado.
    // Si hay algún error se guarda en un archivo de texto (error_log)
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// La url de Login o Logout dependerá del estado actual del usuario, si está autentificado o no en nuestra aplicación
// Aquí obtenemos los permisos del usuario. Por defecto obtenemos una serie de permisos básicos
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl(            
      array(
                'scope' => 'email,publish_stream,user_birthday,user_location,user_about_me,user_hometown'
            ));
}

if (!$user) {
	echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
	exit;
}

// Sustituid esto por la que sea la Canvas Page de vuestra aplicación
    $appBaseUrl =   "index.php";
 
  /* 
     * Facebook dirige al usuario a la Canvas URL  tras autentificarlo
     * Comprobamos si nos ha devuelto un $_GET['code']
     * para redirigirlo en su lugar a la Canvas Page
     */
    if (isset($_GET['code'])){
        header("Location: " . $appBaseUrl);
        exit;
    }

?>
