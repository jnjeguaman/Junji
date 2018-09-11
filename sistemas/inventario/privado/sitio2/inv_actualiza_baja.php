<?php 
session_start();

require("inc/config.php");
extract($_POST);

$sql = "UPDATE acti_inventario SET inv_baja = ".$inv_baja.", inv_bajafecha = '".$inv_bajafecha."', inv_estado2 = 0 WHERE inv_id = ".$inv_id;

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$inv_id.",0,'ACTUALIZACION RESOLUCION DE BAJA','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','RESOLUCION DE BAJA')";
mysql_query($log);

if(mysql_query($sql,$dbh))
{
	echo "<script>opener.location.reload(); window.close();</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>