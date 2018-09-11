<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$fechaRegistro = Date("d-m-Y H:i:s");
$hora=date("h:i");
extract($_GET);
extract($_POST);

/* Verificamos si existen registros en acti_compra_temportal */
$sqlTemportal = "SELECT count(*) as total FROM acti_compra_temporal";
$sqlTemportalResp = mysql_query($sqlTemportal);
$respTemporal = mysql_fetch_array($sqlTemportalResp);
$respTemporal = intval($respTemporal["total"]);

/* Verificamos si existen registros en acti_compra_temportal */
if ($respTemporal >= 1) {

	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra_temporal";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);


} else {
	$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra";
	$sqlLastResp = mysql_query($sqlLast);
	$row = mysql_fetch_array($sqlLastResp);
	$compra_id = intval($row["compra_id"] + 1);

}

$compra_bruto_unitario = round($total / $cantidad);
$pendiente = "PENDIENTE";
$estado = 0;
$sql = "INSERT INTO `acti_compra_temporal` (`compra_id`,`compra_glosa`,`rc_subtitulo`,`compra_cantidad`,`compra_bruto_unitario`,`compra_programa`,`compra_moneda`,`compra_proveedor`,`compra_tipo_compra`,`compra_plazo_entrega`,`compra_fecha_registro`,`compra_tipo_cambio`,`solicitud_bruto_sc`,`solicitud_cantidad_entregado`,`solicitud_estado`,`oc_estado`,`oc_bruto_oc`,`oc_cantidad_entregado`,`rc_estado`,`compra_item`,`tipo_activo`,`estado`) VALUES(".$compra_id.",'".$subgrupo."','".$subtitulo."','".$cantidad."','".$compra_bruto_unitario."','".$programa."','".$moneda."','".$proveedor."','".$tipo_compra."','".$plazo_entrega."','".$fechaRegistro."','".$tipo_cambio."','".$compra_bruto_unitario."','".$cantidad."','".$pendiente."','".$pendiente."','".$compra_bruto_unitario."','".$cantidad."','".$pendiente."','".$item."', ".$tipo_activo.", ".$estado.")";
if(mysql_query($sql,$dbh))
{
	echo "<script>location.href='inv_index.php?ori=1&id=".mysql_insert_id()."&ok=1';</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
   

//-------------- Envio de mail   ----------------

//include("ssgg_enviamail.php");

//-------------- FIN Envio de mail   ----------------


//echo "<script>location.href='ssgg_index.php?exito=1';</script>";
?>

























