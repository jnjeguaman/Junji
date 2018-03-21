<?php
session_start();
$regionsession = $_SESSION["region"];
require_once("inc/config.php");
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=Reporte_SYC_".$regionsession."_".date("Y-m-d").".xls");

if ($regionsession==0) {
	$sql="select * from dpp_etapas where $where (eta_estado=2 or eta_estado=3) order by eta_folio desc";
} 
else {
$sql="select * from dpp_etapas where $where (eta_estado=2 or eta_estado=3) and eta_region=$regionsession and eta_destinatario2 = '' and eta_fecha_recepcion2 >='2017-02-01' order by eta_folio desc";
}

$res = mysql_query($sql);
$hoy = date("Y-m-d");
//echo $sql;
?>

<table border="1" width="100%">

	<tr>
		<td style="text-transform: uppercase;">D&iacute;as transcurridos desde recepci&oacute;n Oficina de Partes</td>
		<td style="text-transform: uppercase;">Ejecutivo Asignado</td>
		<td style="text-transform: uppercase;">Estado del Set de Pago</td>
		<td style="text-transform: uppercase;">Orden de Compra asociada</td>
		<td style="text-transform: uppercase;">Solicitud de Compra asociada</td>
		<td style="text-transform: uppercase;">Unidad Requirente</td>
		<td style="text-transform: uppercase;">&iacute;tem presupuestario</td>
		<td style="text-transform: uppercase;">Programa</td>
		<td style="text-transform: uppercase;">Proveedor</td>
		<td style="text-transform: uppercase;">Rut</td>
		<td style="text-transform: uppercase;">N&deg; de pagos Asociados a OC</td>
		<td style="text-transform: uppercase;">Saldo OC</td>
		<td style="text-transform: uppercase;">Tipo Documento</td>
		<td style="text-transform: uppercase;">N&uacute;mero Documento</td>
		<td style="text-transform: uppercase;">Monto Documento</td>
		<td style="text-transform: uppercase;">Fecha Emisi&oacute;n Factura</td>
		<td style="text-transform: uppercase;">Fecha Recepci&oacute;n OP</td>
		<td style="text-transform: uppercase;">Fecha Recepci&oacute;n SYC</td>
		<!-- <td style="text-transform: uppercase;">Fecha Env&iacute;o a Contabilidad</td>
		<td style="text-transform: uppercase;">Fecha de Env&iacute;o a Tesorer&iacute;a</td>
		<td style="text-transform: uppercase;">Fecha de Pago</td> -->
		<td style="text-transform: uppercase;">Observaciones</td>
	</tr>

	<?php while($row = mysql_fetch_array($res)){ 

	// DETALLE DE LA ORDEN DE COMPRA
		$sql2 = "SELECT * FROM compra_orden WHERE oc_numero = '".$row["eta_nroorden"]."'";
		$res2 = mysql_query($sql2);
		$row2 = mysql_fetch_array($res2);

	// TIPO DE DOCUMENTO
		$vartipodoc1=$row["eta_tipo_doc"];
		if ($vartipodoc1=='Factura') {
			$vartipodoc2=$row["eta_tipo_doc2"];
			if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
				$vartipodoc="Factura";
			if ($vartipodoc2=="b")
				$vartipodoc="Boleta Servicio";
			if ($vartipodoc2=="r")
				$vartipodoc="Recibo";
			if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
				$vartipodoc="N.Crédito";
			if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
				$vartipodoc="N.Débito";
			if ($vartipodoc2=="bh" or $vartipodoc2=="BH" )
				$vartipodoc="Honorario";
		}
		if ($vartipodoc1=='Honorario') {
			$vartipodoc="Honorario";
		}

	// DETALLE DE LA FACTURA
		$sql3 = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$row["eta_id"];
		$res3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($res3);

	// DIAS TRANSCURRIDOS DESDE OFICINA DE PARTES
	$dia0 = strtotime($hoy); 
	$dia1 = strtotime($row3["fac_fecha_ing"]); //FECHA DE RECEPCION EN OFICINA DE PARTES
	$diff1 = $dia0 - $dia1;
	$diff1 = intval($diff1/(60*60*24));

	$sql4 = "SELECT COUNT(eta_id) as TotalFacturas, SUM(eta_monto) as TotalMonto FROM dpp_etapas WHERE eta_nroorden = '".$row["eta_nroorden"]."' AND eta_nroorden <> ''";
	$res4 = mysql_query($sql4);
	$row4 = mysql_fetch_array($res4);

	$sql5 = "SELECT nombrecom FROM usuarios WHERE nombre = '".$row["eta_asignado"]."'";
	$res5 = mysql_query($sql5);
	$row5 = mysql_fetch_array($res5);

	?>
	<tr>
		<td style="text-transform: uppercase;"><?php echo $diff1 ?></td>
		<td style="text-transform: uppercase;"><?php echo $row5["nombrecom"] ?></td>
		<td style="text-transform: uppercase;"><?php echo ($row["eta_fechaguia2"] <> '' && $row["eta_fechaguia2"] <> '0000-00-00 00:00:00') ? "ENVIADO" : "SIN ENVIAR" ?></td>
		<td style="text-transform: uppercase;"><?php echo $row["eta_nroorden"] ?></td>
		<td style="text-transform: uppercase;"><?php echo $row2["oc_sc"] ?></td>
		<td style="text-transform: uppercase;"></td>
		<td style="text-transform: uppercase;"><?php echo $row["eta_item"].".".$row["eta_item2"].".".$row["eta_asig"] ?></td>
		<td style="text-transform: uppercase;"><?php echo $row["eta_prog"] ?></td>
		<td style="text-transform: uppercase;"><?php echo $row["eta_cli_nombre"] ?></td>
		<td style="text-transform: uppercase;"><?php echo number_format($row["eta_rut"],0,".",".")."-".$row["eta_dig"] ?></td>
		<td style="text-transform: uppercase;"><?php echo $row4["TotalFacturas"] ?></td>
		<td style="text-transform: uppercase;"></td>
		<td style="text-transform: uppercase;"><?php echo utf8_decode($vartipodoc) ?></td>
		<td style="text-transform: uppercase;"><?php echo $row3["fac_numero"] ?></td>
		<td style="text-transform: uppercase;"><?php echo $row3["fac_monto"] ?></td>
		<td style="text-transform: uppercase;"><?php echo $row3["fac_fecha_fac"] ?></td>
		<td style="text-transform: uppercase;"><?php echo $row3["fac_fecha_recepcion"] ?></td>
		<td style="text-transform: uppercase;"><?php echo ($row["eta_fecha_recepcion2"] <> '' && $row["eta_fecha_recepcion2"] <> '0000-00-00') ? $row["eta_fecha_recepcion2"] : "RECEPCI&Oacute;N PENDIENTE SYC" ?></td>
		<!-- <td style="text-transform: uppercase;"><?php echo ($row["eta_fechaguia2"] <> '' && $row["eta_fechaguia2"] <> '0000-00-00') ? $row["eta_fechaguia2"] : "ENV&Iacute;O PENDIENTE" ?></td>
		<td style="text-transform: uppercase;"><?php echo ($row["eta_fechaguia3"] <> '' && $row["eta_fechaguia3"] <> '0000-00-00') ? $row["eta_fechaguia3"] : "ENV&Iacute;O PENDIENTE" ?></td>
		<td style="text-transform: uppercase;"><?php echo ($row["eta_fechache"] <> '' && $row["eta_fechache"] <> '0000-00-00') ? $row["eta_fechache"] : "PAGO PENDIENTE" ?></td> -->
		<td style="text-transform: uppercase;"><?php echo $row["eta_obs"] ?></td>
	</tr>
	<?php } ?>
</table>