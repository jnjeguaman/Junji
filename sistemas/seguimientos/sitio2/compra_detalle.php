<!DOCTYPE html>
<html>
<head>
	<title>DETALLE SET DE PAGO</title>
	<meta charset="UTF-8">
	<link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

	<?php
	extract($_GET);
	session_start();
	require_once("inc/config.php");
	$regionSession = $_SESSION["region"];

	$date_in=date("Y-m-d");

	$sql = "SELECT * FROM dpp_etapas WHERE eta_id = ".$eta_id;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);

	$fechahoy = $date_in;
	$dia1 = strtotime($fechahoy);
	$fechabase =$row["eta_fecha_recepcion"];
	$dia2 = strtotime($fechabase);
	$diff=$dia1-$dia2;
	$diff=intval($diff/(60*60*24));
	if ($etapa2a>=$diff)
		$clase="Estilo1cverde";
	if ($etapa2a<$diff and $etapa2b>=$diff )
		$clase="Estilo1camarrillo";
	if ( $etapa2b<$diff)
		$clase="Estilo1crojo";

	$sql2 = "SELECT * FROM dpp_facturas WHERE fac_eta_id = ".$row["eta_id"];
	$res2 = mysql_query($sql2);
	$row2 = mysql_fetch_array($res2);

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

	?>
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title" id="myModalLabel">DETALLE SET DE PAGO</h4>
			</div>
			<div class="modal-body">
				<table border="2" class="table table-striped">

					<tr>
						<td>D&iacute;as transcurridos desde recepci&oacute;n Oficina de Partes</td>
						<td class="<?php echo $clase ?>"><?php echo $diff ?> D&iacute;as</td>
					</tr>

					<tr>
						<td>Ejecutivo Asignado</td>
						<td><?php echo $row["eta_asignado"] ?></td>
					</tr>

					<tr>
						<td>Estado del Set de Pago</td>
						<td></td>
					</tr>

					<tr>
						<td>Orden de Compra asociada</td>
						<td><?php echo $row["eta_nroorden"] ?></td>
					</tr>

					<tr>
						<td>Solicitud de Compra asociada</td>
						<td></td>
					</tr>

					<tr>
						<td>Unidad Requirente</td>
						<td></td>
					</tr>

					<tr>
						<td>&Iacute;tem presupuestario</td>
						<td><?php echo $row["eta_item"].".".$row["eta_item2"].".".$row["eta_asig"] ?></td>
					</tr>

					<tr>
						<td>Programa</td>
						<td><?php echo $row["eta_prog"] ?></td>
					</tr>

					<tr>
						<td>Proveedor</td>
						<td><?php echo $row["eta_cli_nombre"] ?></td>
					</tr>

					<tr>
						<td>Rut</td>
						<td><?php echo number_format($row["eta_rut"],0,".",".")."-".$row["eta_dig"] ?></td>
					</tr>

					<tr>
						<td>N&deg; de pagos Asociados a OC</td>
						<td></td>
					</tr>

					<tr>
						<td>Saldo OC</td>
						<td></td>
					</tr>

					<tr>
						<td>Tipo Documento</td>
						<td><?php echo $vartipodoc ?></td>
					</tr>

					<tr>
						<td>N&uacute;mero Documento</td>
						<td><?php echo $row2["fac_numero"] ?></td>
					</tr>

					<tr>
						<td>Monto Documento</td>
						<td>$<?php echo number_format($row2["fac_monto"],0,".",".") ?></td>
					</tr>

					<tr>
						<td>Fecha Emisi&oacute;n Factura</td>
						<td><?php echo substr($row2["fac_fecha_fac"], 8,2)."-".substr($row2["fac_fecha_fac"], 5,2)."-".substr($row2["fac_fecha_fac"], 0,4) ?></td>
					</tr>

					<tr>
						<td>Fecha Recepci&oacute;n OP</td>
						<td><?php echo substr($row["eta_fecha_recepcion"], 8,2)."-".substr($row["eta_fecha_recepcion"], 5,2)."-".substr($row["eta_fecha_recepcion"], 0,4) ?></td>
					</tr>

					<tr>
						<td>Fecha Recepci&oacute;n SYC</td>
						<td><?php echo substr($row["eta_fecha_recepcion2"], 8,2)."-".substr($row["eta_fecha_recepcion2"], 5,2)."-".substr($row["eta_fecha_recepcion2"], 0,4) ?></td>
					</tr>

					<tr>
						<td>Fecha Env&iacute;o a Contabilidad</td>
						<td><?php echo substr($row["eta_fechaguia2"], 8,2)."-".substr($row["eta_fechaguia2"], 5,2)."-".substr($row["eta_fechaguia2"], 0,4) ?></td>
					</tr>

					<tr>
						<td>Fecha de Env&iacute;o a Tesorer&iacute;a</td>
						<td><?php echo substr($row["eta_fechaguia3"], 8,2)."-".substr($row["eta_fechaguia3"], 5,2)."-".substr($row["eta_fechaguia3"], 0,4) ?></td>
					</tr>

					<tr>
						<td>Fecha de Pago</td>
						<td><?php echo substr($row["eta_fechache"], 8,2)."-".substr($row["eta_fechache"], 5,2)."-".substr($row["eta_fechache"], 0,4) ?></td>
					</tr>

					<tr>
						<td>Observaciones</td>
						<td><?php echo $row["eta_obs"] ?></td>
					</tr>

				</table>
				
			</div>
		</div>
	</div>
</body>
</html>