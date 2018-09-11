<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
extract($_GET);
extract($_POST);

$sql = "UPDATE acti_compra_temporal SET oc_numero = '".$orden_de_compra."', oc_fecha = '".$fecha_orden_compra."' WHERE compra_id = ".$id;
if(mysql_query($sql,$dbh))
{
	echo "<script>location.href='inv_index.php?ori=2&id=".$id."&ok=1';</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>