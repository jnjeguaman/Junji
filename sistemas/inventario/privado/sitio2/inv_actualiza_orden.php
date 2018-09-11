<?php
session_start();
$fechamia = Date("d-m-Y");
require("inc/config.php");
extract($_POST);
extract($_SESSION);
if($oc1 <> "")
{
$oc_numero = $oc1."-".$oc2."-".$oc3;
}

$update = "UPDATE acti_compra SET oc_numero = '".$oc_numero."' WHERE compra_id = ".$id;
mysql_query($update,$dbh);

$sql = "UPDATE acti_compra SET oc_fecha = '".$oc_fecha."', oc_estado = 'OK', oc_cantidad = ".$_POST["oc_cantidad"].", oc_bruto = ".$_POST["oc_bruto"].", oc_neto = ".$_POST["oc_neto"].", oc_fecha_registro = '".$fechamia."', oc_bruto_oc = ".$_POST["oc_bruto"].",oc_cantidad_entregado = ".$_POST["oc_cantidad"].", oc_usr = '".$nom_user."', oc_fechasys = '".Date("Y-m-d")."', oc_horasys = '".Date("H:i:s")."' WHERE compra_id = ".$id;
if(mysql_query($sql,$dbh))
{
	$fechamia=date('Y-m-d');
	$horaSys = Date("H:i:s");
	$log = "INSERT INTO log VALUES(NULL,".$id2.",0,'ACTUALIZACION O/C','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','RECEPCION')";
	mysql_query($log);
	echo "<script>window.history.back()</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>