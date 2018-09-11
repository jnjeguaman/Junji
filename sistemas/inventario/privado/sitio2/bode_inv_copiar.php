<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$regionSession = $_SESSION["region"];
$nom_user = $_SESSION["nom_user"];

require_once("inc/config.php");
extract($_GET);
$fechamia = date("Y-m-d");
$horamia = date("H:i:s");

// RESCATAMOS EL ENCABEZADO DE LA GUIA ORIGINAL
$sql = "SELECT * FROM bode_orcom WHERE oc_id = ".$id;
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);

// COPIAMOS LA GUIA A INEDIS
$sql2 = "INSERT INTO bode_orcom(oc_region,oc_region2,oc_fecha,oc_fecha_recep,oc_tipo_guia,oc_tipo,oc_mas_id,oc_region_destino,oc_swdespacho) 
VALUES('".$row["oc_region"]."','".$row["oc_region2"]."','".$row["oc_fecha"]."','".$fechamia."','".$row["oc_tipo_guia"]."','".$row["oc_tipo"]."','".$row["oc_mas_id"]."','".$row["oc_region_destino"]."',1)";
mysql_query($sql2);

$ultimo_id = mysql_insert_id($dbh);

// ASOCIAMOS A LA NUEVA GUIA LOS PRODUCTOS DE LA ANTERIOR
$sql3 = "UPDATE bode_detoc SET doc_oc_id = ".$ultimo_id." WHERE doc_oc_id = ".$row["oc_id"];
mysql_query($sql3);

// ANULAMOS LA GUIA ORIGINAL
$sql4 = "UPDATE  bode_orcom SET oc_guiadestina = 'NULO', oc_region = 'NULO' WHERE oc_id = ".$row["oc_id"];
mysql_query($sql4);

if($dte_id <> "") {
// ANULAMOS DE MANERA ELECTRONICA LA GUIA DE DESPACHO
	$dbsii = mysql_connect ("localhost", "usii", "ubnaeCFXqd4735PE") or die ('I cannot connect to the database because: ' . mysql_error());
	mysql_select_db("junji_sii",$dbsii);
	$query = "UPDATE sii_dte SET dte_gd_estado = 2, dte_gd_tipo_anulacion = 2 WHERE dte_id = ".$dte_id;
	mysql_query($query,$dbsii);
}

mysql_query("INSERT INTO log VALUES(NULL,'".$row["oc_id"]."',1,'COPIA GUIA DE DESPACHO','".$nom_user."','".$fechamia."','".$horamia."','BODEGA','SOLICITUD DE PEDIDO')");

echo "<script>window.location.href='bode_inv_indexoc3.php?ori=3&id=".$ultimo_id."';</script>";
?>