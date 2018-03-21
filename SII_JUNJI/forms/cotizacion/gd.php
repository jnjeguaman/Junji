<?php
require_once("includes/functions.cotizacion.php");
require_once("includes/functions.referencia.php");
extract($_POST);
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$cotizacion = getCotizacion($_GET["id"]);
$subtotal = 0;
$iva = 0;
$total = 0;
$referencias = getReferencia();

if($cotizacion[1]["cotizacion_fe"] == 1)
{
	$referencia = buscarReferencia($cotizacion[1]["cotizacion_id"]);
}
$totalAfecto = 0;
?>
<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
		</div><!-- panel-btns -->
		<h4 class="panel-title">INFORMACION DEL CLIENTE</h4>
	</div><!-- panel-heading -->
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">CLIENTE <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="receptor_glosa" id="receptor_glosa" readonly="1" value="<?php echo $cotizacion[1]["cliente_empresa"] ?>" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">RUT</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="receptor_rut" id="receptor_rut" readonly="1" value="<?php echo $cotizacion[1]["cliente_rut"] ?>" />
			</div>

			<div class="col-sm-1">
				<input type="text" class="form-control" name="receptor_dv" id="receptor_dv" readonly="1" value="<?php echo $cotizacion[1]["cliente_dv"] ?>" />
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="receptor_direccion" id="receptor_direccion" readonly="1" value="<?php echo $cotizacion[1]["cliente_direccion"] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">CIUDAD <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="receptor_region" id="receptor_region" readonly="1" value="<?php echo $cotizacion[1]["cliente_provincia_id"] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="receptor_comuna" id="receptor_comuna" readonly="1" value="<?php echo $cotizacion[1]["cliente_comuna_id"] ?>"/>
			</div>
		</div>
	</div><!-- panel-body -->


</div>

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
		</div><!-- panel-btns -->
		<h4 class="panel-title">DETALLE PRODUCTOS / SERVICIOS</h4>
		
	</div><!-- panel-heading -->
	<div class="panel-body">

		<table class="table">
			<thead>
				<th>#</th>
				<th>PRODUCTO</th>
				<th>CANTIDAD</th>
				<th>UNITARIO</th>
				<th>DESCUENTO</th>
				<th>SUBTOTAL</th>
			</thead>

			<tbody>
				<?php foreach ($cotizacion as $key => $value): ?>
					<?php $subtotal += $value["detalle_subtotal"] ?>
					<tr>
						<td><?php echo $value["detalle_id"] ?></td>
						<td><?php echo $value["detalle_producto_id"] ?></td>
						<td><?php echo $value["detalle_cantidad"] ?></td>
						<td>$<?php echo number_format($value["detalle_unitario"],0,".",".") ?></td>
						<td><?php echo $value["detalle_descuento"] ?>%</td>
						<td>$<?php echo number_format($value["detalle_subtotal"],0,".",".") ?></td>
					</tr>

					<?php if($value["detalle_indexe"] == 0){$totalAfecto+=($value["detalle_cantidad"] * $value["detalle_unitario"]);} ?>
				<?php endforeach ?>
			</tbody>

			<?php
			$iva = ceil($subtotal * 0.19);
			if($tipo_dcto <> 34)
			{
				$total = $iva + $subtotal;	
			}else{
				$total = $subtotal;

			}
			?>
			<tfoot>
				<tr>
					<td colspan="4" align="right">SUBTOTAL</td>
					<td colspan="2" align="left">$<?php echo number_format($subtotal,0,".",".") ?></td>
				</tr>
				<?php if ($cotizacion[1]["cotizacion_valordr"] <> ""): ?>
					<tr>
						<td colspan="4" align="right"><?php echo ($cotizacion[1]["cotizacion_tpomov"] == "D") ? "DESCUENTO" : "RECARGO" ?> GLOBLAL ITEMS AFECTOS</td>
						<?php if ($cotizacion[1]["cotizacion_tpovalor"] == "$"): ?>
							<td colspan="2" align="left"><?php echo $cotizacion[1]["cotizacion_valordr"] ?></td>
						<?php else: ?>
							<?php
							$porcentajeDescuento = ($cotizacion[1]["cotizacion_valordr"] / 100);
							$montoDescuento = round($porcentajeDescuento * $totalAfecto);			
							?>
							<td colspan="2" align="left"><?php echo "(".$cotizacion[1]["cotizacion_valordr"].$cotizacion[1]["cotizacion_tpovalor"].") $".number_format($montoDescuento,0,".",".") ?></td>
						<?php endif ?>
					</tr>
				<?php endif ?>
				<tr>
					<td colspan="4" align="right">MONTO NETO</td>
					<td colspan="2" align="left">$<?php echo number_format($cotizacion[1]["cotizacion_neto"],0,".",".") ?></td>
				</tr>

				<?php if ($tipo_dcto <> 34): ?>
					<tr>
						<td colspan="4" align="right">IVA (19%)</td>
						<td colspan="2" align="left">$<?php echo number_format($cotizacion[1]["cotizacion_iva"],0,".",".") ?></td>
					</tr>
				<?php endif ?>


				<tr>
					<td colspan="4" align="right">TOTAL</td>
					<td colspan="2" align="left">$<?php echo number_format($cotizacion[1]["cotizacion_total"],0,".",".") ?></td>
				</tr>
			</tfoot>

		</table>
	</div>
</div>



<form class="form-horizontal" id="frmNueva" method="POST">

	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
			</div><!-- panel-btns -->
			<h4 class="panel-title">REFERENCIAS</h4>

		</div><!-- panel-heading -->
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">AÑADIR REFERENCIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="radio" name="referencia" id="referencia" value="SI" <?php if(count($referencia) == 1){echo"checked";} ?>> SI / <input type="radio" name="referencia" id="referencia" value="NO" <?php if(count($referencia) == 0){echo"checked";} ?>> NO
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="TpoDocRef" id="TpoDocRef">
						<option value="">Seleccionar...</option>
						<?php foreach ($referencias as $key => $value): ?>
							<option value="<?php echo $value["ref_codigo"] ?>" <?php if($referencia[1]["dte_dcto_id"] == $value["ref_codigo"]){echo"selected";} ?>><?php echo "(".$value["ref_codigo"].") ".$value["ref_glosa"] ?></option>
						<?php endforeach ?>
						
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FOLIO REFERENCIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="FolioRef" id="FolioRef" value="<?php echo $referencia[1]["dte_folio"] ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FECHA REFERENCIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="FchRef" id="FchRef" value="<?php echo $referencia[1]["dte_fecha"] ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RAZON REFERENCIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="RazonRef" id="RazonRef">
				</div>
			</div>
		</div>
	</div>


	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
			</div><!-- panel-btns -->
			<h4 class="panel-title">TIPO DE DESPACHO / TRASLADO</h4>

		</div><!-- panel-heading -->
		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">TIPO DE DESPACHO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="TipoDespacho" id="TipoDespacho">
						<option value="">Seleccionar...</option>
						<option value="1" <?php if($TipoDespacho == 1){echo"selected";}?>>Despacho por cuenta del receptor del documento (cliente o vendedor en caso de Facturas de compra.)</option>
						<option value="2" <?php if($TipoDespacho == 2){echo"selected";}?>>Despacho por cuenta del emisor a instalaciones del cliente</option>
						<option value="3" <?php if($TipoDespacho == 3){echo"selected";}?>>Despacho por cuenta del emisor a otras instalaciones (Ejemplo: entrega en Obra)</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">INDICADOR TIPO DE TRASLADO DE BIENES <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="IndTraslado" id="IndTraslado" required>
						<option value="">Seleccionar...</option>
						<option value="1" <?php if($IndTraslado == 1){echo"selected";}?>>Operacion constituye venta</option>
						<option value="2" <?php if($IndTraslado == 2){echo"selected";}?>>Ventas por efectuar</option>
						<option value="3" <?php if($IndTraslado == 3){echo"selected";}?>>Consignaciones</option>
						<option value="4" <?php if($IndTraslado == 4){echo"selected";}?>>Entrega gratuita</option>
						<option value="5" <?php if($IndTraslado == 5){echo"selected";}?>>Traslados internos</option>
						<option value="6" <?php if($IndTraslado == 6){echo"selected";}?>>Otros traslados no venta</option>
						<option value="7" <?php if($IndTraslado == 7){echo"selected";}?>>Guia de devolucion</option>
						<option value="8" <?php if($IndTraslado == 8){echo"selected";}?>>Traslado para exportcion. (no venta)</option>
						<option value="9" <?php if($IndTraslado == 9){echo"selected";}?>>Venta para exportacion</option>
					</select>
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
			</div><!-- panel-btns -->
			<h4 class="panel-title">FECHA DE PAGO</h4>
			<p>Sólo se utiliza si la factura ha sido cancelada antes de la fecha de emisión</p>
		</div><!-- panel-heading -->
		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">DOCUMENTO PAGADO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="radio" name="guiaPagada" id="guiaPagada" value="SI"> SI / <input type="radio" name="guiaPagada" id="guiaPagada" value="NO"> NO
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FECHA DE PAGO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" name="fechaPago" id="fechaPago" class="form-control">
				</div>
			</div>
		</div>
	</div>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<button class="btn btn-dark mr5">ENVIAR</button>
			</div>
		</div>
	</div>


	<input type="hidden" name="cotizacion_id" value="<?php echo $_GET["id"] ?>">
	<input type="hidden" name="cmd" value="generarDTE">
	<input type="hidden" name="tipo_dcto" value="52">
	<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
	<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
	<input type="hidden" name="receptor_rut" value="<?php echo $cotizacion[1]["cliente_rut"] ?>">
	<input type="hidden" name="receptor_dv" value="<?php echo $cotizacion[1]["cliente_dv"] ?>">
	<input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">

</form>

<script type="text/javascript">
	$(function(){
		$("#fechaPago").datepicker({
			dateFormat : 'yy-mm-dd'
		});
	})
	$("#frmNueva").validate({
		rules : {
			tipo_dcto : { required : true}
		},
		submitHandler : function( form )
		{
			var data = $(form).serializeArray();

			$.ajax({
				type:"POST",
				url:"includes/functions.generardte.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					if(response.Respuesta)
					{
						jQuery.gritter.add({
							title: 'Exito!',
							text: response.Mensaje,
							class_name: 'growl-success',
								// image: 'images/logo.png',
								sticky: false,
								time: ''
							});
						setTimeout(function(){
							window.location.href='?pagina=gd&action=ver';
						},1500);
					}else{
						jQuery.gritter.add({
							title: 'Ha ocurrido un error!',
							text: response.Mensaje,
							class_name: 'growl-danger',
								// image: 'images/logo.png',
								sticky: false,
								time: ''
							});
					}
				}
			});
			
		}
	});
</script>
