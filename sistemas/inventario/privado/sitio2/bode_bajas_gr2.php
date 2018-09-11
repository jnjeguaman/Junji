<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}
require_once("inc/config.php");
extract($_POST);
extract($_SESSION);

$sql = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$ocid;
$res = mysql_query($sql);
$fechaSys = Date("Y-m-d");
$horaSys = Date("H:m:s");

$update = "UPDATE bode_orcom SET oc_usu = '".$emisor."',oc_guiaabaste = '".$abastece."',oc_guiadestina = '".$destinatario."',oc_id2 = ".$folio.",oc_folioguia = ".$folio.", oc_obs = '".$obs."' WHERE oc_id = ".$ocid;
mysql_query($update);

$log = "INSERT INTO log VALUES(NULL,".$ocid.",0,'CIERRA G/D','".$_SESSION["nom_user"]."','".$fechaSys."','".$horaSys."','BODEGA','MOVIMIENTOS - BAJA')";
mysql_query($log);

while($rowProd = mysql_fetch_array($res))
{
	$upBaja = "UPDATE bode_detoc SET doc_estado = 'B' WHERE doc_id = ".$rowProd["doc_origen_id"];
	mysql_query($upBaja);

	$log = "INSERT INTO log VALUES (NULL,".$rowProd["doc_origen_id"].",0,'BAJA','".$nom_user."','".$fechaSys."','".$horaSys."')";
	mysql_query($log);
	
}

$bode_orcom22 = "UPDATE bode_orcom SET oc_estado = 4 WHERE oc_id = ".$ocid;
mysql_query($bode_orcom22);
?>
<script>window.location.href='bode_inv_indexoc4.php?cmd=Bajas&ori=1';</script>