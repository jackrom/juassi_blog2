<?php

require_once('webAnalytics/iplocation/ip2location.class.php');
//include '../functions/functions.php';
//include '../functions/juassi_common.php';


function getUserInfo($userip){
	//inicializamos nuestras variables
	$IP= $userip;
	global $juassi_db, $juassi_tb;
	$default = 'Hollywood, CA';
	$usuario = $_SERVER['HTTP_USER_AGENT'];
	$dispositivos = "Android,AvantGo,Blackverry,Blazer,Cellphone,Danger,DoComo,EPOC,EudoraWeb,Handspring,HTC,Kyocera,LG,MMEF20,MMP,MOT-V,Mot,Motorola,NetFront,Newt,Samsung,Small,Smartphone,SonyErickson,SymbianOS,Symbian,TS2li-10,Up.Browser,UP-Link,WAP,WebOS,Windows CE,Hiptop,iPhone,iPod,Portalmmm,Elaine/3.0,OPWV";
	$sistemasOperativos = "AmigaOS,Amoeba,Android,Atari TOS,BeOS,DR-DOS,DragonFly BSD,FreeBSD,FreeDOS,GNU/Linux,GNU Hurd,MacOS,Mac OS X,Haiku,iOS,Maemo,MeeGo,MenuetOS,Minix,MS-DOS,NetBSD,OpenBSD,PC-DOS,Plan 9,OS/2,OZ (Z88),QDOS,QNX,ReactOS,Solaris,Symbian,Microsoft Windows,Sistemas Unix,Xenix";
	$navegadores = "Safari,Firefox/16.0,Mozilla,Explorer,Chrome,Opera,Netscape";
	
	//creamos el objeto
	$ip = new ip2location;
	
	//abrimos la conexion a la base de datos
	$ip->open('webAnalytics/iplocation/databases/IP-COUNTRY-SAMPLE.BIN');
	
	//almacenamos los datos recibidos de la bd en una variable
	$record = $ip->getAll($IP);
	
	//guardamos cada uno de los resultados en una variable
	$IP = $record->ipAddress;
	$IPNumber = $record->ipNumber;
	$countryShort = $record->countryShort;
	$countryLong = $record->countryLong;
	
	
	//detectamos la ciudad
	if (!is_string($IP) || strlen($IP) < 1 || $IP == '127.0.0.1' || $IP == 'localhost')
            $IP = '8.8.8.8';
 
    $curlopt_useragent = $IP;
 
    $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($IP);
    $ch = curl_init();
 
	$curl_opt = array(
		CURLOPT_FOLLOWLOCATION => 1,
		CURLOPT_HEADER => 0,
		CURLOPT_RETURNTRANSFER  => 1,
		CURLOPT_USERAGENT => $curlopt_useragent,
		CURLOPT_URL => $url,
		CURLOPT_TIMEOUT => 1,
		CURLOPT_REFERER => 'http://' . $_SERVER['HTTP_HOST'],
	);
 
        curl_setopt_array($ch, $curl_opt);
 
        $content = curl_exec($ch);
 
        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }
 
        curl_close($ch);
 
        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
            $state = $regs[1];
        }
		
		if( $city!='' && $state!=''){
          $location = $city . ', ' . $state;
        }else{
          $location = $default; 
        }
 
 		
		//detectamos el dispositivo 
        $deviceUser = explode(',', $dispositivos);
        foreach($deviceUser as $tipodevice){
            if(!strpos($usuario, trim($tipodevice))){
				$device = 'unknown';
            }else{
				$device = $tipodevice;
			}
        }
		
		//detectamos el Sistema Operativo
		$SOUser = explode(',', $sistemasOperativos);
        foreach($SOUser as $sistema){
            if(strpos($usuario, trim($sistema))){
                $OS = $sistema;
            }
        }
		
		//detectamos navegador
        $navegadorUser = explode(',', $navegadores);
        foreach($navegadorUser as $navegador){
            if(!strpos($usuario, $navegador)){
                $nav = 'unknown';
            }else{
				$nav = $navegador;
			}
        }
		
	    $query = "INSERT INTO juassi2_logs VALUES ('', :ipaddress, :ipnumber, :countryshort, :countrylong, :city, :device, :sistema_operativo, :navegador)";

		$stmt = $juassi_db->prepare($query);

		$stmt->bindParam(':ipaddress', $IP);
		$stmt->bindParam(':ipnumber', $IPNumber);
		$stmt->bindParam(':countryshort', $countryShort);
		$stmt->bindParam(':countrylong', $countryLong);
		$stmt->bindParam(':city', $location);
		$stmt->bindParam(':device', $device);
		$stmt->bindParam(':sistema_operativo', $OS);
		$stmt->bindParam(':navegador', $nav);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		
		
		
	
}

function userCountries(){
	global $juassi_db, $juassi_tb;
	//select id_c, count(*) from det_ven group by id_c
	
	$query = "SELECT  countrylong, count(*) FROM juassi2_logs group by countrylong";
		$stmt = $juassi_db->prepare($query);

		//$stmt->bindParam(1, $post_id);
		//$stmt->bindParam(2, $category_id);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		$pais = array();
		$userPais = array();
		while($paises = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   
			 	echo '{label:"'.$paises['countrylong'].'",';
			 	echo 'data:'.$paises['count(*)'].'},';
			 
                    
		} 
		             
		
}






