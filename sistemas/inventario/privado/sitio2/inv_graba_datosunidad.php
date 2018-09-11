<?php 
session_start();
require("inc/config.php");
extract($_GET);
extract($_POST);

$solicitante = str_replace("Ñ", "N", $solicitante);
$solicitante = str_replace("Á", "A", $solicitante);
$solicitante = str_replace("É", "E", $solicitante);
$solicitante = str_replace("Í", "I", $solicitante);
$solicitante = str_replace("Ó", "O", $solicitante);
$solicitante = str_replace("Ú", "U", $solicitante);

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$compra_id.",'0','ACTUALIZACION','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','UNIDAD REQUIRENTE')";
mysql_query($log);
$sql = "UPDATE `acti_compra` SET `compra_responsable` = '".$solicitante."', `compra_zona` = '".$zona."', `compra_dpto` = '".$unidad_o_seccion."', `compra_direccion` = '".$responsa."' WHERE compra_id = ".$compra_id;
$sql2 = "UPDATE `acti_compra_temporal` SET `compra_responsable` = '".$solicitante."', `compra_zona` = '".$zona."', `compra_dpto` = '".$unidad_o_seccion."', `compra_direccion` = '".$responsa."' WHERE compra_id = ".$compra_id;
mysql_query($sql2);

if(mysql_query($sql,$dbh))
{
	echo "<script>location.href='inv_recepcion.php?&ori=6&id=".$id."&compra_id=".$compra_id."&ing_id=".$ing_id."&compra_ding_id=".$compra_ding_id."';</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>
