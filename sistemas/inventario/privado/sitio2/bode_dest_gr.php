<?php
require_once("inc/config.php");
extract($_POST);
session_start();
$regionSession = $_SESSION["region"];
// GENERA FOLIO DEL DOCUMENTO
// BUSCAMOS EL ULTIMO FOLIO
$folio = "SELECT MAX(folio_despacho) as Ultimo FROM bode_folios WHERE folio_tipo = '0'";
$folio = mysql_query($folio);
$folio = mysql_fetch_array($folio);
$folio =  $folio["Ultimo"];
if($folio === NULL)
{
	$folio = 1;
}else{
	$folio++;
}

// INGRESAMOS EL FOLIO
$bode_folios = "INSERT INTO bode_folios VALUES (NULL,".$folio.",0,'0','".Date("Y-m-d")."','".Date("H:i:s")."','".$_SESSION["nom_user"]."',1,".$regionSession.")";
mysql_query($bode_folios);

//INFORMACION DEL FORMULARIO
foreach ($_SESSION["lista"] as $key => $value) {
	$sql = "UPDATE bode_orcom SET oc_chofer = '".$chofer."', oc_patente = '".$patente."', oc_observaciones = '".$obs."',oc_despacho_folio = ".$folio." WHERE oc_id = ".$value["oc_id"];
	echo $sql."<br>";
	mysql_query($sql);
	$log = "INSERT INTO log VALUES (NULL,".$value["oc_id"].",0,'AGREGA CHOFER A G/D','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','DESPACHOS')";
	mysql_query($log);
	unset($_SESSION["lista"]);
	echo "<script>window.open('reporte/reporte2.php?folio=$folio','_blank');window.location.href='bode_desp.php?cod=46';</script>";
}
?>