<?php
session_start();

if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

require_once("inc/config.php");
extract($_GET);
$regionsession = $_SESSION["region"];
$nom_user = $_SESSION["nom_user"];
extract($_POST);
$sql = "INSERT INTO bode_detoc3 (doc_especificacion,	doc_cantidad,	doc_origen_id,doc_sp_id,doc_clasificacion,doc_conversion,doc_item,doc_gasto,doc_factor,doc_activo) 
VALUES ('$item',			    '$cantidad','       $ding_id','$sp_id','$ding_clasificacion','$doc_conversion','$doc_item','$doc_gasto','$doc_factor','$doc_activo')";

if($action == 1)
{
	// $sql = "DELETE FROM bode_detoc3 WHERE doc_id = ".$id;
	$sql = "UPDATE bode_detoc3 SET doc_estado = 'ELIMINADO' WHERE doc_id = ".$id;
	if(mysql_query($sql))
	{
		mysql_query("INSERT INTO log VALUES(NULL,".$np_id.",0,'ELIMINA PRODUCTO NOTA DE PEDIDO','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','SOLICITUD DE PEDIDO')");
		echo "<script>window.location.href='bode_inv_indexoc7.php?ori=2&id=".$np_id."';</script>";	

	}else{
		echo "<script>alert('Hubo un problema al procesar  la solicitud. Intente mas tarde');window.location.href='bode_inv_indexoc7.php?ori=2&id=".$np_id."';</script>";	
	}
}else if($action ==2){
	$sql2 = "SELECT MAX(sp_folio) as Folio FROM bode_solicitud WHERE sp_region = ".$regionsession;
	$res2 = mysql_query($sql2,$dbh);
	$row2 = mysql_fetch_array($res2);
	$ultimo_folio = $row2["Folio"] + 1;

	if($sp_matriz <> "")
	{
		$sql = "UPDATE bode_solicitud SET sp_estado = 1,sp_folio = ".$ultimo_folio." WHERE sp_matriz = ".$sp_matriz;
	}else{
		$sql = "UPDATE bode_solicitud SET sp_estado = 1,sp_folio = ".$ultimo_folio." WHERE sp_id = ".$sp_id;
	}
	if(mysql_query($sql))
	{
		mysql_query("INSERT INTO log VALUES(NULL,".$sp_id.",0,'ENVIA NOTA DE PEDIDO','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','SOLICITUD DE PEDIDO')");
		echo "<script>alert('Solicitud procesada con exito!');window.location.href='bode_inv_indexoc7.php?cod=50';</script>";	
	}else{
		echo "<script>alert('Hubo un problema al procesar  la solicitud. Intente mas tarde');window.location.href='bode_inv_indexoc7.php?ori=2&id=".$np_id."';</script>";	
	}
}else{
	if(mysql_query($sql))
	{
		echo "<script>window.location.href='bode_inv_indexoc7.php?ori=2&id=".$sp_id."';</script>";
	}
}

?>