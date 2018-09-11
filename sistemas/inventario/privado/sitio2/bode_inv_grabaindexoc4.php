<?php
session_start();
extract($_POST);
require_once("inc/config.php");

$fechamia=date('Y-m-d');
//$maximoUsuario = "SELECT MAX(oc_id) as Ultimo FROM bode_orcom WHERE oc_usu = '".$_SESSION["nom_user"]."'";
$maximoUsuario = "SELECT MAX(oc_id) as Ultimo FROM bode_orcom";
$maximoUsuario = mysql_query($maximoUsuario,$dbh);
$maximoUsuario = mysql_fetch_array($maximoUsuario);

if($maximoUsuario["Ultimo"] === NULL)
{
	$ultimo = 1;
}else{
	$ultimo = $maximoUsuario["Ultimo"] + 1;
}

$fecha2= substr($fecha_orden_compra,6,4)."-".substr($fecha_orden_compra,3,2)."-".substr($fecha_orden_compra,0,2);

/**** bode_orcom ****/
$bode_orcom = "INSERT INTO bode_orcom (oc_id2, oc_region,   oc_nombre_oc, oc_prog,        oc_fecha,    oc_fecha_recep,     oc_usu, oc_pro_id, oc_observaciones, oc_proveerut,   oc_proveedig, oc_proveenomb, oc_cantidad, oc_monto, oc_umedida,oc_numerooc,oc_grupo,oc_estado,oc_descuento)
VALUES ($ultimo, ".$_SESSION["region"].",'$descripcion','$programa','$fecha2','$fechamia','".$_SESSION["nom_user"]."','0','0','$proveedor','$proveedor2','$proveedornomb','$cantidad','$total','$tipo_compra','$ultimo','".$grupo."',1,'$descuento');";

/********************/

$vunitario = intval($total) / intval($cantidad);
if(mysql_query($bode_orcom))
{

if($tipo_compra == "CAJA" || $tipo_compra == "BALDE" || $tipo_compra == "PAQUETE" || $tipo_compra == "SET" || $tipo_compra == "TARRO"){
   	$factor = $factor;
   }else{
   	$factor = 1;
   }
   $doc_conversion = $tipo_cambio * $vunitario;
	/**** bode_orcom ****/
	$bode_detoc = "INSERT INTO bode_detoc (doc_oc_id, doc_prod_id, doc_especificacion, doc_cantidad, doc_valor_unit, doc_valor_unit2, doc_recibidos, doc_region, doc_origen_id, doc_numerooc,doc_umedida,doc_factor,doc_valor_moneda,doc_conversion,doc_moneda,doc_unit)
	VALUES ( '$ultimo', '0','$descripcion','$cantidad',$total,'$total','0',".$_SESSION["region"].",'',$ultimo,'$tipo_compra',$factor,$tipo_cambio,$doc_conversion,'$moneda',$vunitario)";
	if(mysql_query($bode_detoc,$dbh))
	{
		echo "<script>window.location.href='bode_inv_indexoc2.php?cod=20';</script>";
	}else{
		echo "Ha ocurrido un error";
	}
	/********************/

}else{
	echo "Ha ocurrido un error";
}
?>
