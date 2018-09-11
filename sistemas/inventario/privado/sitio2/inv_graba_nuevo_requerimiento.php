<?
session_start();
require("inc/config.php");
$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$fechaRegistro = Date("d-m-Y");
$hora=date("h:i");
extract($_GET);
extract($_POST);
extract($_SESSION);
$id_compra = 0;

/* Verificamos si es un nuevo producto */
if(isset($compra_id) && $compra_id != "" || $compra_id != NULL)
{
	$compra_id = $_POST["compra_id"];
	$log = "INSERT INTO log VALUES(NULL,".$compra_id.",".$cantidad.",'INGRESO NUEVO PRODUCTO A COMPRA','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVA COMPRA')";
}else{
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
		$log = "INSERT INTO log VALUES(NULL,".$compra_id.",".$cantidad.",'INGRESO NUEVA COMPRA','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVA COMPRA')";

	} else {
		$sqlLast = "SELECT max(compra_id) as compra_id FROM acti_compra";
		$sqlLastResp = mysql_query($sqlLast);
		$row = mysql_fetch_array($sqlLastResp);
		$compra_id = intval($row["compra_id"] + 1);
		$log = "INSERT INTO log VALUES(NULL,".$compra_id.",".$cantidad.",'INGRESO NUEVA COMPRA','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVA COMPRA')";
	}
}
$tipo_cambio = str_replace(",", ".", $tipo_cambio);

$compra_bruto_unitario = floor(($total * $tipo_cambio) / $cantidad);
$visible = 1;
$pendiente = "PENDIENTE";
$estado = 0;
mysql_query($log);
$sql = "INSERT INTO `acti_compra_temporal` (`compra_id`,`compra_glosa`,`rc_subtitulo`,`compra_cantidad`,`compra_bruto_unitario`,`compra_programa`,`compra_moneda`,`compra_proveedor`,`compra_tipo_compra`,`compra_fecha_registro`,`compra_tipo_cambio`,`solicitud_bruto_sc`,`solicitud_cantidad_entregado`,`solicitud_estado`,`oc_estado`,`oc_bruto_oc`,`oc_cantidad_entregado`,`rc_estado`,`compra_item`,`compra_estado`,`compra_region_id`,`compra_grupo`,`compra_monto`,`compra_visible`,`compra_usr`,`compra_fechasys`,`compra_horasys`) VALUES(".$compra_id.",'".$subgrupo."','".$subtitulo."','".$cantidad."','".$compra_bruto_unitario."','".$programa."','".$moneda."','".$proveedor."','".$tipo_compra."','".$fechaRegistro."','".$tipo_cambio."','".$compra_bruto_unitario."','".$cantidad."','".$pendiente."','".$pendiente."','".$compra_bruto_unitario."','".$cantidad."','".$pendiente."','".$item."', ".$estado.",".$_SESSION["region"].",'".$grupo."',".($total * intval($tipo_cambio)).",".$visible.",'".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."')";
if(mysql_query($sql,$dbh))
{
	if(intval($_SESSION["region"]) === 16)
	{
		echo "<script>location.href='inv_nc.php?&ori=3&id=".mysql_insert_id()."&compra_id=".$compra_id."';</script>";
	}else{
		echo "<script>location.href='inv_nc.php?&ori=3&id=".$compra_id."&total=".$cantidad."';</script>";
	}
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>