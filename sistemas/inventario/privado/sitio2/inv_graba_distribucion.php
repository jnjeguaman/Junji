	<?php
session_start();
extract($_GET);
extract($_POST);
extract($_SESSION);

require("inc/config.php");
$sql = "SELECT * FROM acti_compra_temporal WHERE id = " . $compra_id;
$sql = mysql_query($sql);
$sql = mysql_fetch_array($sql);
$prueba = 0;

$resp = false;
$query =  "INSERT INTO `acti_compra`(`compra_id`, `compra_lote_id`, `compra_region`, `compra_cantidad`, `compra_glosa`, `compra_vlote`, `compra_programa`, `compra_proveedor`, `compra_responsable`, `compra_moneda`, `compra_tipo_cambio`, `compra_bruto_unitario`, `compra_item`, `compra_tipo_compra`, `compra_plazo_entrega`, `compra_dpto`, `compra_direccion`, `compra_zona`, `compra_fecha_registro`, `solicitud_id`, `solicitud_numero`, `solicitud_fecha`, `solicitud_cantidad`, `solicitud_bruto`, `solicitud_neto`, `solicitud_fecha_registro`, `solicitud_bruto_sc`, `solicitud_cantidad_entregado`, `solicitud_estado`, `oc_id`, `oc_numero`, `oc_fecha`, `oc_cantidad`, `oc_bruto`, `oc_neto`, `oc_fecha_registro`, `oc_estado`, `oc_bruto_oc`, `oc_cantidad_entregado`, `rc_tipo`, `rc_fecha`, `rc_contacto`, `rc_obs`, `rc_fecha_registro`, `rc_estado`, `rc_unidad`, `rc_numero`, `rc_nrc`, `rc_subtitulo`, `compra_estado`,`compra_region_id`,`compra_grupo`,`compra_monto`,`compra_usr`,`compra_fechasys`,`compra_horasys`,`compra_ing_id`,`compra_ding_id`,`compra_doc_id`,`compra_rc`) VALUES (".$sql["compra_id"].",".$sql["compra_id"].$prueba.",'".$_POST["region"]."','".$total."','".$sql["compra_glosa"]."','".(intval($sql["compra_bruto_unitario"]) * intval($total))."','".$sql["compra_programa"]."','".$sql["compra_proveedor"]."','".$sql["compra_responsable"]."','".$sql["compra_moneda"]."','".$sql["compra_tipo_cambio"]."','".$sql["compra_bruto_unitario"]."','".$sql["compra_item"]."','".$sql["compra_tipo_compra"]."','".$sql["compra_plazo_entrega"]."','".$sql["compra_dpto"]."','".$sql["compra_direccion"]."','".$sql["compra_zona"]."','".$sql["compra_fecha_registro"]."','".$sql["compra_id"].$sql["compra_id"].$prueba."','".$sql["solicitud_numero"]."','".$sql["solicitud_fecha"]."','".$sql["solicitud_cantidad"]."','".$sql["solicitud_bruto"]."','".$sql["solicitud_neto"]."','".$sql["solicitud_fecha_registro"]."','".$sql["solicitud_bruto_sc"]."','".$sql["solicitud_cantidad_entregado"]."','".$sql["solicitud_estado"]."','".$sql["compra_id"].$sql["compra_id"].$prueba."','".$sql["oc_numero"]."','".$sql["oc_fecha"]."','".$sql["oc_cantidad"]."','".$sql["oc_bruto"]."','".$sql["oc_neto"]."','".$sql["oc_fecha_registro"]."','".$sql["oc_estado"]."','".$sql["oc_bruto_oc"]."','".$sql["oc_cantidad_entregado"]."','".$sql["rc_tipo"]."','".$sql["rc_fecha"]."','".$sql["rc_contacto"]."','".$sql["rc_obs"]."','".$sql["rc_fecha_registro"]."','".$sql["rc_estado"]."','".$sql["rc_unidad"]."','".$sql["rc_numero"]."','".$sql["rc_nrc"]."','".$sql["rc_subtitulo"]."','".$sql["compra_estado"]."',".$region.",".$sql["compra_grupo"].",".$sql["compra_monto"].",'".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','".$sql["compra_ing_id"]."','".$sql["compra_ding_id"]."','".$sql["compra_doc_id"]."','".$sql["compra_rc"]."')";
$query2 = "UPDATE acti_compra_temporal SET compra_estado = 1 WHERE id = " . $compra_id;

if(mysql_query($query,$dbh))
{

	$resp = true;
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}

if($resp)
{
	if(mysql_query($query2,$dbh))
	{
		$fechamia=date('Y-m-d');
		$horaSys = Date("H:i:s");
		$log = "INSERT INTO log VALUES(NULL,".$compra_id.",".$total.",'GRABA DISTRIBUCION','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVA COMPRA')";
		mysql_query($log);
		echo "<script>location.href='inv_recepcion.php?cod=11';</script>";
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}
?>
