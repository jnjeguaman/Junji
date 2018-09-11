<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}
require_once("inc/config.php");
extract($_POST);
$fechamia = Date("Y-m-d");
$query = "INSERT INTO bode_orcom (oc_fecha,oc_fecha_recep,oc_tipo_guia,oc_tipo,oc_mas_id,oc_estado,oc_region) VALUES ('".$fecha."','".$fechamia."',4,1,0,99,".$_SESSION["region"].")";

mysql_query($query);
$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".mysql_insert_id().",0,'GENERACION G/D','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','BODEGA','MOVIMIENTOS - BAJAS')";
mysql_query($log);
?>

<script>window.location.href='bode_inv_indexoc4.php?cmd=Bajas&ori=1'</script>