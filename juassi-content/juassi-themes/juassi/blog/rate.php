<?php
header("Cache-Control: no-cache");
header("Pragma: nocache");
include 'settings.php';

$id_sent = preg_replace("/[^0-9]/","",$_REQUEST['id']);
$vote_sent = preg_replace("/[^0-9]/","",$_REQUEST['stars']);
$ip =$_SERVER['REMOTE_ADDR'] ;
connect();

$q=mysql_num_rows(mysql_query("SELECT id FROM ratings WHERE id=$id_sent"));
if(!$q)
	mysql_query("INSERT INTO ratings (id,date) VALUES ($id_sent,curdate())");
if ($vote_sent > $units) 
	die("Lo sentimos, pero tu voto parece ser inv&aacute;lido."); // destruir el script porque los usuarios normales no deben ver esto


//conectamos a la base de datos para obtener informaci—n
$query = mysql_query("SELECT total_votes, total_value, used_ips FROM $rating_dbname.$rating_tableName WHERE id='$id_sent' ")or die(" Error: ".mysql_error());
$numbers = mysql_fetch_assoc($query);
$checkIP = unserialize($numbers['used_ips']);
$count = $numbers['total_votes']; //Cuantos votos en total
$current_rating = $numbers['total_value']; //la cantidad total de valoraci—n se sumar‡n y se almacenaran
$sum = $vote_sent+$current_rating; // sumar el valor de voto actual y el valor total de votos
$tense = ($count==1) ? "voto" : "votos"; //definir la palabra cuando sea singular o plural

// comprobando si la primera votaci—n ha sido contabilizada
// o aumentar el nœmero actual de votos
($sum==0 ? $added=0 : $added=$count+1);

// si esto es un array i.e. ya las entradas se han colocado en otro valor
((is_array($checkIP)) ? array_push($checkIP,$ip) : $checkIP=array($ip));
$insertip=serialize($checkIP);

//chequeamos la IP cuando se vota
if(!isset($_COOKIE['rating_'.$id_sent])){
$voted=mysql_num_rows(mysql_query("SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND id='".$id_sent."' "));
									}
else $voted=1;									
if(!$voted) {     //si el usuario no ha realizado su voto aœn, entonces lo hara normalmente...

	if (($vote_sent >= 1 && $vote_sent <= $units)) { // Mantener los votos dentro del rango, aseguramos que las iP coinciden
	
		$update = "UPDATE $rating_tableName SET total_votes='".$added."', total_value='".$sum."', used_ips='".$insertip."' WHERE id='$id_sent'";
		$result = mysql_query($update);	
		if($result)	setcookie("rating_".$id_sent,1, time()+ 2592000);
	} 
} //final del "if(!$voted)"
// Estas son las nuevas consultas para tomar los nuevos valores!
$newtotals = mysql_query("SELECT total_votes, total_value, used_ips FROM $rating_tableName WHERE id='$id_sent' ")or die(" Error: ".mysql_error());
$numbers = mysql_fetch_assoc($newtotals);
$count = $numbers['total_votes'];//cuantos votos en total
$current_rating = $numbers['total_value'];//la cantidad total de valoraci—n se sumar‡n y se almacenaran
$tense = ($count==1) ? "voto" : "votos"; //definir la palabra cuando sea singular o plural

// $new_back is what gets 'drawn' on your page after a successful 'AJAX/Javascript' vote
if($voted){$sum=$current_rating; $added=$count;}
	$new_back = array();
	for($i=0;$i<5;$i++){
		$j=$i+1;
		if($i<@number_format($current_rating/$count,1)-0.5) 
			$class="ratings_stars ratings_vote";
		else 
			$class="ratings_stars";
		$new_back[] .= '<div class="star_'.$j.' '.$class.'"></div>';
    }

	$new_back[] .= ' <div class="total_votes"><p class="voted"> Resultados: <strong>'.@number_format($sum/$added,1).'</strong>/'.$units.' ('.$count.' '.$tense.' emitidos) ';
	if(!$voted)
		$new_back[] .= '<span class="thanks">Gracias por valorar!</span></p>';
	else {
		$new_back[] .= '<span class="invalid">Ya has valorado este art&iacute;culo</span></p></div>';
}
$allnewback = join("\n", $new_back);

// ========================


$output = $allnewback;
echo $output;
?>