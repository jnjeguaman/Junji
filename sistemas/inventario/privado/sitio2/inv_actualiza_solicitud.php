<?php
session_start();
$fechamia = Date("d-m-Y");
require("inc/config.php");
extract($_POST);
extract($_SESSION);
$update = "UPDATE acti_compra SET solicitud_numero = '".$solicitud_numero."' WHERE compra_id = ".$id;
mysql_query($update,$dbh);

$sql = "UPDATE acti_compra SET solicitud_fecha = '".$solicitud_fecha."', solicitud_estado = 'OK', solicitud_cantidad = ".$_POST["solicitud_cantidad"].", solicitud_bruto = ".$_POST["solicitud_bruto"].", solicitud_neto = ".$_POST["solicitud_neto"].", solicitud_fecha_registro = '".$fechamia."', solicitud_bruto_sc = ".$_POST["solicitud_bruto"].", solicitud_cantidad_entregado = ".$_POST["solicitud_cantidad"].", solicitud_usr = '".$nom_user."', solicitud_fechasys = '".Date("Y-m-d")."', solicitud_horasys = '".Date("H:i:s")."' WHERE compra_id = ".$id;
if(mysql_query($sql,$dbh))
{
	$fechamia=date('Y-m-d');
	$horaSys = Date("H:i:s");
	$log = "INSERT INTO log VALUES(NULL,".$id2.",0,'ACTUALIZACION S/C','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','RECEPCION')";
	mysql_query($log);

	echo "<script>window.history.back()</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>
