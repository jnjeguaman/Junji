<?php 
session_start();
$regionSession = $_SESSION["region"];
require("inc/config.php");
extract($_POST);

$tipoActualizacion = intval($tipoActualizacion);

$lote = "UPDATE acti_inventario SET inv_altares = '".$inv_altares."', inv_altafecha = '".$inv_altafecha."' WHERE inv_oc = '".$inv_oc."' AND inv_region = ".$regionSession;
$individual = "UPDATE acti_inventario SET inv_altares = ".$inv_altares.", inv_altafecha = '".$inv_altafecha."' WHERE inv_id = ".$inv_id." and inv_region = ".$regionSession;
$loteRecepcion= "UPDATE acti_inventario SET inv_altares = ".$inv_altares.", inv_altafecha = '".$inv_altafecha."' WHERE inv_nro_rece = '".$inv_rc."' AND inv_oc = '".$inv_oc."' AND inv_region = ".$regionSession;

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$inv_id.",0,'ACTUALIZACION RESOLUCION DE ALTA','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','RESOLUCION DE ALTA')";
mysql_query($log);


if($tipoActualizacion === 0)
{
	if(mysql_query($lote,$dbh))
	{
		echo "<script>opener.location.reload(); window.close();</script>";
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}else if($tipoActualizacion === 1){
	if(mysql_query($individual,$dbh))
	{
		echo "<script>opener.location.reload(); window.close();</script>";
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}else if($tipoActualizacion === 2){
	if(mysql_query($loteRecepcion,$dbh))
	{
		echo "<script>opener.location.reload(); window.close();</script>";
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}
?>