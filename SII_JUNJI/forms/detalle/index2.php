<?php
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
require_once("includes/functions.referencia.php");
extract($_GET);
$detalleDTE = getDetalleDTE($id);
$detalleReferencias = getReferencias($detalleDTE[1]["dte_id"]);
$contador = 1;

$datosReceptor = array();
if($detalleDTE[1]["dte_dcto_id"] == 52)
{
	$objEmpresa = new Empresa();
	$datos = $objEmpresa->getEmpresa($detalleDTE[1]["dte_cliente_id"]);
	$datosReceptor = [
		"RazonSocial" => $datos[1]["empresa_glosa"],
		"Rut" => $datos[1]["empresa_rut"],
		"Dv" => $datos[1]["empresa_rut"],
		"Direccion" => $datos[1]["empresa_direccion"],
		"Comuna" => $datos[1]["empresa_comuna"],
		"Ciudad" => $datos[1]["empresa_ciudad"],
		"Giro" => $datos[1]["empresa_giro"],
		"actividadEconomica" => $datos[1]["empresa_acteco"],
	];
}else{
	$objCliente = new Cliente();
	$datos = $objCliente->getClienteDetalle(array("cliente_id" => $detalleDTE[1]["dte_cliente_id"]));

$datosReceptor = [
		"RazonSocial" => $datos[1]["cliente_empresa"],
		"Rut" => $datos[1]["cliente_rut"],
		"Dv" => $datos[1]["cliente_dv"],
		"Direccion" => $datos[1]["cliente_direccion"],
		"Comuna" => $datos[1]["cliente_comuna_id"],
		"Ciudad" => $datos[1]["cliente_provincia_id"],
		"Giro" => $datos[1]["cliente_giro"],
		"actividadEconomica" => $datos[1]["cliente_actividad_economica"],
	];

}
$actividadEconomica = getActividadEconomica($datosReceptor["actividadEconomica"]);
$indTraslado = [
	1 => "OPERACIÓN CONSTITUYE VENTA",
	2 => "VENTAS POR EFECTUAR",
	3 => "CONSIGNACIONES",
	4 => "ENTREGA GRATUITA",
	5 => "TRASLADOS INTERNOS",
	6 => "OTROS TRASLADOS NO VENTA",
	7 => "GUÍA DE DEVOLUCIÓN",
	8 => "TRASLADO PARA EXPORTACIÓN (NO VENTA)",
	9 => "VENTA PARA EXPORTACIÓN"
	];

	$estadoAnulacion = [
1 => "Anulado Previo a su Envio al SII",
2 => "Anulado Posterior a su Envio al SII",
3 => "Productos Recibidos Parcialmente"
];
?>
<!-- INFORMACION DEL CLIENTE !-->
<div class="panel panel-dark">
	<div class="panel-heading">
		<h4 class="panel-title">INFORMACION DEL CLIENTE</h4>
		<p>
			Tipo de Documento : <?php echo "(".$detalleDTE[1]["dte_dcto_id"].") : ".$detalleDTE[1]["dcto_glosa"] ?><br>
			Folio : <?php echo $detalleDTE[1]["dte_folio"] ?><br>
			Fecha de Emisión : <?php echo $detalleDTE[1]["dte_fecha"] ?>
		</p>

	</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">RAZÓN SOCIAL <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="<?php echo $datosReceptor["RazonSocial"] ?>" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">RUT</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" readonly="1" value="<?php echo number_format($datosReceptor["Rut"],0,".",".") ?>"/>
			</div>

			<div class="col-sm-1">
				<input type="text" class="form-control" readonly="1" value="<?php echo $datosReceptor["Dv"] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="<?php echo $datosReceptor["Direccion"] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="<?php echo $datosReceptor["Comuna"] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">CIUDAD <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="<?php echo $datosReceptor["Ciudad"] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="<?php echo $datosReceptor["Giro"] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">ACTIVIDAD ECONOMICA <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="(<?php echo $actividadEconomica[1]["acti_codigo"] ?>) : <?php echo $actividadEconomica[1]["acti_descripcion"] ?> "/>
			</div>
		</div>

		<?php if ($detalleDTE[1]["dte_dcto_id"] == 52): ?>
			<div class="form-group">
			<label class="col-sm-3 control-label">INDICADOR DE TRASLADO <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="<?php echo $indTraslado[$detalleDTE[1]["dte_gd_traslado"]] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">ESTADO DE LA GUÍA <span class="asterisk">*</span></label>
			<div class="col-sm-9">
			<?php 
			if($detalleDTE[1]["dte_gd_estado"] == 1)
			{
				$estado = "FOLIO ANULADO";
			}else if($detalleDTE[1]["dte_gd_estado"] == 2)
			{
				$estado = "GUÍA ANULADA";
			}else{
				$estado = "OK";
			}
			?>
				<input type="text" class="form-control" readonly="1" value="<?php echo $estado ?>"/>
			</div>
		</div>
	<?php if ($estado == "GUÍA ANULADA" || $estado == "FOLIO ANULADO"): ?>
		<div class="form-group">
			<label class="col-sm-3 control-label">ESTADO ANULACION <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" readonly="1" value="<?php echo $estadoAnulacion[$detalleDTE[1]["dte_gd_tipo_anulacion"]] ?>"/>
			</div>
		</div>
	<?php endif ?>
	

		<?php endif ?>
	</div>
</div>

<?php if ($detalleReferencias["Respuesta"] >= 1): ?>
	
<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">REFERENCIAS</h4>
		</div>
		
		<div class="panel-body">
			 <table class="table table-striped table-bordered responsive">
				<thead>
					<th>TIPO DOCUMENTO</th>
					<th>FOLIO</th>
					<th>RAZÓN REFERENCIA</th>
					<th>FECHA EMISION</th>
					<th>PDF</th>
				</thead>

				<tbody>
					<?php foreach ($detalleReferencias["Mensaje"] as $key => $value): ?>
						<?php
							$ruta = $value["dte_ruta"].$value["dte_archivo"].".xml";
							$xml = simplexml_load_file($ruta);
							$totalReferencias = count($xml->SetDTE->DTE->Documento->Referencia);
						?>

						<tr>
							<td><?php echo $value["dcto_glosa"] ?></td>
							<td><?php echo $value["dte_folio"] ?></td>
							<td>
								<?php 
								for($i=0;$i<$totalReferencias;$i++)
								{
									echo "TIPO DOCUMENTO : ".$xml->SetDTE->DTE->Documento->Referencia[$i]->TpoDocRef."<br>";
									echo "FOLIO REFERENCIA : ".$xml->SetDTE->DTE->Documento->Referencia[$i]->FolioRef."<br>";
									echo "FECHA REFERENCIA : ".$xml->SetDTE->DTE->Documento->Referencia[$i]->FchRef."<br>";
									echo "RAZÓN REFERENCIA : ".$xml->SetDTE->DTE->Documento->Referencia[$i]->RazonRef."<br><br>";
								}
								?>
							</td>
							<td><?php echo $value["dte_fecha"] ?></td>
							<td><a href="documento.php?xml=<?php echo $value["dte_archivo"] ?>&tipo=<?php echo $value["dte_dcto_id"] ?>&dte_id=<?php echo $value["dte_id"] ?>" target="_blank">PDF</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>

		</div>
	</div>	
<?php endif ?>

<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">DETALLE PRODUCTOS Y TOTALES</h4>
		</div>
		
		<div class="panel-body">
			<div class="form-group">
				<table class="table table-striped table-bordered responsive">
					<thead>
						<th>#</th>
						<th>PRODUCTO</th>
						<th>INDICADOR</th>
						<th>CANTIDAD</th>
						<th>U.M</th>
						<th>UNITARIO</th>
						<th>SUBTOTAL</th>
					</thead>

					<tbody>
						<?php foreach ($detalleDTE as $key => $value): ?>
							<tr>
								<td><?php echo $contador ?></td>
								<td><?php echo mb_convert_encoding($value["detalle_producto_id"], "UTF-8") ?></td>
								<td><?php echo ($value["detalle_indexe"] === 1) ? "EXENTO" : "AFECTO" ?></td>
								<td><?php echo $value["detalle_cantidad"] ?></td>
								<td><?php echo $value["detalle_umedida"] ?></td>
								<td>$<?php echo number_format($value["detalle_unitario"],0,".",".") ?></td>
								<td>$<?php echo number_format($value["detalle_subtotal"],0,".",".") ?></td>
							</tr>
							<?php $contador++ ?>
						<?php endforeach ?>
					</tbody>

					<tfoot>	
						<tr>
							<td colspan="6" style="text-align: right">TOTAL NETO</td>
							<td>$<?php echo number_format($detalleDTE[1]["dte_neto"],0,".",".") ?></td>
						</tr>

						<tr>
							<td colspan="6" style="text-align: right">TOTAL EXENTO</td>
							<td>$<?php echo number_format($detalleDTE[1]["dte_exento"],0,".",".") ?></td>
						</tr>

						<tr>
							<td colspan="6" style="text-align: right">TOTAL IVA</td>
							<td>$<?php echo number_format($detalleDTE[1]["dte_iva"],0,".",".") ?></td>
						</tr>
						
						<tr>
							<td colspan="6" style="text-align: right">TOTAL</td>
							<td>$<?php echo number_format($detalleDTE[1]["dte_total"],0,".",".") ?></td>
						</tr>

						<tr>
							<td colspan="6" style="text-align: right">VISUALIZAR</td>
							<td><a href="documento.php?dte_id=<?php echo $detalleDTE[1]["dte_id"] ?>" target="_blank">VER</td>
						</tr>

					</tfoot>
				</table>
			</div>

		</div>
	</div>	
