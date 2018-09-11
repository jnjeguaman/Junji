<?php 
session_start();
$regionSession = $_SESSION["region"];
require("inc/config.php");
extract($_GET);
extract($_POST);
extract($_SESSION);

$fechaSys = Date("Y-m-d");
$horaSys = Date("H:i:s");

$tipoActualizacion = intval($tipoActualizacion);


$inv_responsable = str_replace(["Ñ","Á","É","Í","Ó","Ú","Ü","°","\""],["N","A","E","I","O","U","U","",""], $inv_responsable);
$lote = "UPDATE acti_inventario SET inv_user = '".$nom_user."', inv_fechasys = '".$fechaSys."', inv_horasys = '".$horaSys."', inv_calidad = '".$inv_calidad."', inv_vutil = '".$inv_vutil."', inv_vutilconsumida = '".$inv_vutilconsumida."', inv_estadocosto = '".$inv_estadocosto."', inv_responsable = '".$inv_responsable."', inv_obs = '".$inv_obs."', inv_direccion = '".$responsa."', inv_zona = '".$inv_zona."' WHERE inv_oc = '".$inv_oc."' AND inv_region = ".$regionSession;
$individual = "UPDATE acti_inventario SET inv_user = '".$nom_user."', inv_fechasys = '".$fechaSys."', inv_horasys = '".$horaSys."', inv_calidad = '".$inv_calidad."', inv_vutil = '".$inv_vutil."', inv_vutilconsumida = '".$inv_vutilconsumida."', inv_estadocosto = '".$inv_estadocosto."', inv_responsable = '".$inv_responsable."', inv_obs = '".$inv_obs."', inv_direccion = '".$responsa."', inv_zona = '".$inv_zona."' WHERE inv_id = ".$inv_id."  AND inv_region = ".$regionSession;
$loteRecepcion = "UPDATE acti_inventario SET inv_user = '".$nom_user."', inv_fechasys = '".$fechaSys."', inv_horasys = '".$horaSys."', inv_calidad = '".$inv_calidad."', inv_vutil = '".$inv_vutil."', inv_vutilconsumida = '".$inv_vutilconsumida."', inv_estadocosto = '".$inv_estadocosto."', inv_responsable = '".$inv_responsable."', inv_obs = '".$inv_obs."', inv_direccion = '".$responsa."', inv_zona = '".$inv_zona."' WHERE inv_nro_rece = '".$inv_rc."' AND inv_oc = '".$inv_oc."' AND inv_region = ".$regionSession;

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$inv_id.",0,'ACTUALIZACION FICHA PRODUCTO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','FICHA PRODUCTO')";
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

