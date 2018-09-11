<?php
session_start();
require_once("inc/config.php");
extract($_POST);
extract($_SESSION);
$fechaSys = Date("Y-m-d");
$horaSys = Date("H:i:s");
$fechamia = Date("Y-m-d");

// RESCATAMOS EL ULTIMO FOLIO DE LA REGION
$folio = mysql_query("SELECT max(folio_reg_".$_SESSION["region"].") as Folio from inv_folio_traslado");
$folio = mysql_fetch_array($folio);
$folio = intval($folio["Folio"])+1;

mysql_query("UPDATE inv_folio_traslado SET folio_reg_".$_SESSION["region"]." = ".$folio." WHERE folio_id = 1");

$logg = "INSERT INTO log VALUES(NULL,".$nro_guia.",0,'GENERACION G/D TRASLADO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','GUIA - TRASLADO')";
mysql_query($logg);

$Encabezado = "INSERT INTO `inv_guia_despacho_encabezado`(`guia_id`, `guia_numero`, `guia_emision`, `guia_abastece`, `guia_destinatario`, `guia_direccion`, `guia_zona`, `guia_comuna`, `guia_responsable`,`guia_emisor`,`guia_obs`,`guia_estado`,`guia_origen`,`guia_region_origen`) VALUES (0,'".$folio."','".$fecha."','".$abastece."','".$destinatario."','".$responsa."','".$inv_zona."','','','".$emisor."','".$obs."',2,1,".$_SESSION["region"].")";
mysql_query($Encabezado);
$ultimo_id = mysql_insert_id($dbh);

$rs=mysql_query("select @@identity as id");
if ($row=mysql_fetch_row($rs)) {
	$id = trim($row[0]);
}

	//RECORREMOS LOS ELEMENTOS ENVIADOS
for ($i=1; $i <= $totalElementos ; $i++) { 

		//BUSCAMOS INFORMACION DEL PRODUCTO SEGUN CODIGO DE INVENTARIO
	$detalle = "SELECT * FROM acti_inventario WHERE inv_id = ".$var1[$i];
	$detalle = mysql_query($detalle);
	$detalle = mysql_fetch_array($detalle);

	$ingresa = "INSERT INTO `inv_guia_despacho_detalle`(`detalle_id`, `detalle_guia_numero`, `detalle_inv_codigo`, `detalle_cantidad`,`detalle_responsable_anterior`,`detalle_direccion_anterior`,`detalle_zona_anterior`,`detalle_origen`,`detalle_region_origen`,`detalle_res_alta`,`detalle_res_baja`,`detalle_fecha_alta`,`detalle_fecha_baja`,`detalle_inv_id`,`detalle_dest`,`detalle_guia_id`) VALUES (0,'".$ultimo_id."','".$var2[$i]."','1','".$detalle["inv_responsable"]."','".$detalle["inv_direccion"]."','".$detalle["inv_zona"]."',1,".$trasladoRegionOrigen.",'".$detalle["inv_altares"]."','".$detalle["inv_baja"]."','".$detalle["inv_altafecha"]."','".$detalle["inv_baja"]."',".$var1[$i].",".$trasladoRegionDestino.",".$id.")";
	mysql_query($ingresa);

	$log = "INSERT INTO acti_traslado VALUES (NULL,".$detalle["inv_codigo"].",'".$detalle["inv_oc"]."',".$trasladoRegionOrigen.",".$trasladoRegionDestino.",'".$fechaSys."','".$horaSys."','".$nom_user."')";
	mysql_query($log);

		//DAMOS DE BAJA LOS BIENES EN LA REGION DE ORIGEN
	// $actualizar = "UPDATE acti_inventario SET inv_baja ='".$trasladoResolucion."', inv_bajafecha = '".$trasladoFecha."', inv_estado2 = 0 WHERE inv_id = ".$var1[$i];
	// mysql_query($actualizar);
		//DAMOS DE ALTA LOS BIENES EN LA REGION DE DESTINO
	$nuevo = "INSERT INTO acti_inventario(`inv_id`, `inv_codigo`, `inv_programa`, `inv_bien`, `inv_costo`, `inv_region`, `inv_estadocosto`, `inv_obs`, `inv_altares`, `inv_altafecha`, `inv_baja`, `inv_bajafecha`, `inv_anno`, `inv_oc`, `inv_recepcionfecha`, `inv_responsable`, `inv_calidad`, `inv_vutil`, `inv_direccion`, `inv_zona`, `inv_vutilconsumida`, `inv_devengofecha`, `inv_ccontable`, `inv_vfinal`, `inv_correcion`, `inv_acumulada`, `inv_depreciaanno`, `inv_total`, `inv_user`, `inv_fechasys`, `inv_horasys`, `inv_estado2`, `inv_alta_en_transito`, `inv_comprobante_egreso`, `inv_num_factura`, `inv_fecha_factura`, `inv_nro_rece`,`inv_doc_id`) VALUES (NULL,'".$detalle["inv_codigo"]."','".$detalle["inv_programa"]."','".$detalle["inv_bien"]."','".$detalle["inv_costo"]."','".$trasladoRegionDestino."','".$detalle["inv_estadocosto"]."','".$detalle["inv_obs"]."',NULL,NULL,'','','".$detalle["inv_anno"]."','".$detalle["inv_oc"]."','".$detalle["inv_recepcionfecha"]."','".$detalle["inv_responsable"]."','".$detalle["inv_calidad"]."','".$detalle["inv_vutil"]."','".$detalle["inv_direccion"]."','".$detalle["inv_zona"]."','".$detalle["inv_vutilconsumida"]."','".$detalle["inv_devengofecha"]."','".$detalle["inv_ccontable"]."','".$detalle["inv_vfinal"]."','".$detalle["inv_correcion"]."','".$detalle["inv_acumulada"]."','".$detalle["inv_depreciaanno"]."','".$detalle["inv_total"]."','".$nom_user."','".$fechaSys."','".$horaSys."','1','".$detalle["inv_alta_en_transito"]."','".$detalle["inv_comprobante_egreso"]."','".$detalle["inv_num_factura"]."','".$detalle["inv_fecha_factura"]."','".$detalle["inv_nro_rece"]."',".$detalle["inv_doc_id"].")";
	mysql_query($nuevo);
}
unset($_SESSION["Actualizacion"]);
	//ENVIAMOS AL USUARIO A LA PAGINA PARA LA IMPRESION DE LA GUIA DE DESPACHO
// echo "<script>window.open('imprimir_guia_despacho.php?guia=".$nro_guia."&destino=".$trasladoRegionDestino."');</script>";

echo "<script>window.location.href='inv_actualizacion.php?cod=44';</script>";	
?>