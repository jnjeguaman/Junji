<?php
session_start();
require_once("inc/config.php");
extract($_GET);
	// BUSCAMOS LOS PRODUCTOS SEGUN EL INGRESO
$sql = "SELECT ding_prod_id,ding_cantidad,ding_cant_rechazo FROM bode_detingreso WHERE ding_ing_id = ".$id_ing;
$res = mysql_query($sql);

while($row = mysql_fetch_array($res))
{
	$update = "UPDATE bode_detoc SET doc_recibidos = doc_recibidos - (".$row["ding_cantidad"]." - ".$row["ding_cant_rechazo"]."), doc_final = doc_final - (".$row["ding_cantidad"]." - ".$row["ding_cant_rechazo"].")  WHERE doc_id = ".$row["ding_prod_id"].";";
	mysql_query($update);
}
$update2 = "UPDATE bode_ingreso SET ing_estado = 0 WHERE ing_id = ".$id_ing;
mysql_query($update2);

$log = "INSERT INTO log VALUES (NULL,".$id_ing.",0,'RECHAZA RECEPCION CONFORME','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA' ,'RECEPCION CONFORME')";
mysql_query($log);
echo json_encode(array("Respuesta" => true,"Mensaje" => "Recepcion Conforme Anulada"));
?>