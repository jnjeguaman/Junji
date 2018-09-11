<?php
session_start();
require_once("inc/config.php");
extract($_GET);
extract($_SESSION);
$fechaSys = Date("Y-m-d");
$horaSys = Date("H:i:s");
// Encabezado de la G/D

/*
JUNJI
usii
ubnaeCFXqd4735PE
junji_sii
*/

/* 
LOCAL
usii
b9GMA5VaPqsThHh6
sii_junji
*/

if($dte_id <> "") {
// ANULAMOS DE MANERA ELECTRONICA LA GUIA DE DESPACHO
	$dbsii = mysql_connect ("localhost", "usii", "ubnaeCFXqd4735PE") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db("junji_sii",$dbsii);
	$query = "UPDATE sii_dte SET dte_gd_estado = 2, dte_gd_tipo_anulacion = 2 WHERE dte_id = ".$dte_id;
	mysql_query($query,$dbsii);
}
$update = "UPDATE  bode_orcom SET oc_guiadestina = 'NULO', oc_region = 'NULO' WHERE oc_id = ".$id;
mysql_query($update,$dbh);
// Productos de la G/D
$detoc = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$id." AND doc_estado <> 'ELIMINADO'";
$resDetoc = mysql_query($detoc,$dbh);

$oc = "SELECT * FROM bode_orcom WHERE oc_id = ".$id;
$oc = mysql_query($oc,$dbh);
$oc = mysql_fetch_array($oc);

while($row = mysql_fetch_array($resDetoc))
{
	$update2 = "UPDATE bode_detingreso SET ding_unidad = ding_unidad + ".$row["doc_cantidad"]." WHERE ding_id = ".$row["doc_origen_id"];
	$update3 = "UPDATE bode_detoc SET doc_estado = 'ELIMINADO' WHERE doc_id = ".$row["doc_id"];
	$update4 = "UPDATE acti_inventario SET inv_direccion = '' WHERE inv_gd = ".$oc["oc_folioguia"];
	$log = 	"INSERT INTO log VALUES(NULL,".$row["doc_origen_id"].",".$row["doc_cantidad"].",'ANULACION GUIA DE DESPACHO (DETALLE)','".$nom_user."','".$fechaSys."','".$horaSys."','BODEGA','DESPACHOS')";
	mysql_query($update2,$dbh);
	mysql_query($update3,$dbh);
	mysql_query($update4,$dbh);
	mysql_query($log,$dbh);
}
mysql_query("INSERT INTO log VALUES(NULL,".$id.",1,'ANULACION GUIA DE DESPACHO (GUIA)','".$nom_user."','".$fechaSys."','".$horaSys."','BODEGA','DESPACHOS')",$dbh);
echo "<script>window.location.href='bode_inv_indexoc3.php?cod=22'</script>";
?>
