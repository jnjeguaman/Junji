	<?php 
session_start();

require("inc/config.php");
extract($_POST);
$tipoActualizacion = intval($tipoActualizacion);

$lote = "UPDATE acti_inventario SET inv_comprobante_egreso = ".$inv_comprobante_egreso.", inv_devengofecha = '".$inv_devengofecha."',inv_ccontable = ".$inv_cta_contable.",inv_num_factura = ".$inv_num_factura.",inv_fecha_factura = '".$inv_fecha_factura."', inv_anno = '".$inv_anno."' WHERE inv_oc = '".$inv_oc."'";
$individual = "UPDATE acti_inventario SET inv_comprobante_egreso = ".$inv_comprobante_egreso.", inv_devengofecha = '".$inv_devengofecha."',inv_ccontable = ".$inv_cta_contable.",inv_num_factura = ".$inv_num_factura.",inv_fecha_factura = '".$inv_fecha_factura."', inv_anno = '".$inv_anno."' WHERE inv_id = ".$inv_id;
$loteRecepcion = "UPDATE acti_inventario SET inv_comprobante_egreso = ".$inv_comprobante_egreso.", inv_devengofecha = '".$inv_devengofecha."',inv_ccontable = ".$inv_cta_contable.",inv_num_factura = ".$inv_num_factura.",inv_fecha_factura = '".$inv_fecha_factura."', inv_anno = '".$inv_anno."' WHERE inv_nro_rece = '".$inv_rc."' AND inv_oc = '".$inv_oc."'";

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$inv_id.",0,'ACTUALIZACION CONTABILIDAD','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','CONTABILIDAD')";
mysql_query($log,$dbh6);

if($tipoActualizacion === 0)
{
	if(mysql_query($lote,$dbh6))
	{
	}else{
		echo mysql_errno($dbh6) . ": " . mysql_error($dbh6) . "\n";
	}
}else if($tipoActualizacion === 1){
	if(mysql_query($individual,$dbh6))
	{
	}else{
		echo mysql_errno($dbh6) . ": " . mysql_error($dbh6) . "\n";
	}
}else if($tipoActualizacion === 2){
	if(mysql_query($loteRecepcion,$dbh6))
	{
	}else{
		echo mysql_errno($dbh6) . ": " . mysql_error($dbh6) . "\n";
	}
}
		echo "<script>window.location.href='inv_contaedit.php?ori=1&oc_id=".$oc_id."&rc=".$inv_rc."';</script>";

?>
