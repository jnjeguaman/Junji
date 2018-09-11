<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_GET);
// BUSCAMOS SI HAY PRODUCTOS EN LA GUIA DE DESPACHO
$sql = "SELECT count(doc_id) as Total FROM bode_detoc WHERE doc_oc_id = ".$id." AND doc_estado <> 'ELIMINADO'";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

if($row["Total"] > 0)
{
	// SI TIENE PRODUCTOS MOSTRAR MENSAJE DE ERROR
	echo "<script>alert('LA GUIA SELECCIONADA TIENE ".$row["Total"]." PRODUCTOS QUE ELIMINAR');</script>";
	echo "<script>window.location.href='bode_inv_indexoc3.php?cod=22';</script>";
}else{
	// SI NO TIENE PRODUCTOS, ACTUALIZAR EL ESTADO
	$sql = "UPDATE bode_orcom SET oc_swdespacho = 0 WHERE oc_id = ".$id;
	$res = mysql_query($sql);
	echo "<script>alert('PRE-GUÍA DE DESPACHO ELIMINADA');</script>";
	echo "<script>window.location.href='bode_inv_indexoc3.php?cod=22';</script>";
}
?>
