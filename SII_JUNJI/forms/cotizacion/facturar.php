<?php
require_once("includes/functions.cotizacion.php");
require_once("includes/functions.referencia.php");
extract($_POST);
$cotizacion = getCotizacion($_GET["id"]);
$subtotal = 0;
$iva = 0;
$total = 0;
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);

$referencias = getReferencia();
if($cotizacion[1]["cotizacion_gd"] == 1)
{
	$referencia = buscarReferencia($cotizacion[1]["cotizacion_id"]);
}
$totalAfecto = 0;

$uMedida = array(
"TON" => "TONELADA",
"KG" => "KILOGRAMO",
"UNID" => "UNIDADES",
"QTAL" => "QUINTAL (100 KG.)",
"M3" => "METRO CÚBICO",
"MR" => "METRO RUMA",
"TBDM" => "TONELADA BDMT",
"TBDU" => "TONELADA BDU",
"PP" => "PULGADA PINERA",
"PM" => "PULGADA MADERERA",
"HORA" => "HORA HOMBRE"
);

?>
<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			
		</div>
		<h4 class="panel-title">INFORMACIÓN DEL RECEPTOR</h4>
	</div>
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

		<!--
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-primary mr5">Submit</button>
					<button type="reset" class="btn btn-dark">Reset</button>
				</div>
			</div>
		</div>
		!--> 
	</div>

	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div>
			<h4 class="panel-title">DETALLE DE PRODUCTOS / SERVICIOS</h4>
		</div>
		<div class="panel-body">

			<table class="table">
				<thead>
					<th>#</th>
					<th>PRODUCTO</th>
					<th>CANTIDAD</th>
					<th>UNIDAD MEDIDA</th>
					<th>UNITARIO</th>
					<th>% DESCUENTO</th>
					<th>SUBTOTAL</th>
				</thead>

				<tbody>
					<?php foreach ($cotizacion as $key => $value): ?>
						<?php $subtotal += $value["detalle_subtotal"] ?>
						<tr>
							<td><?php echo $value["detalle_id"] ?></td>
							<td><?php echo $value["detalle_producto_id"] ?></td>
							<td><?php echo $value["detalle_cantidad"] ?></td>
							<td><?php echo $uMedida[$value["detalle_umedida"]] ?></td>
							<td>$<?php echo number_format($value["detalle_unitario"],0,".",".") ?></td>
							<td><?php echo $value["detalle_descuento"] ?></td>
							<td>$<?php echo number_format($value["detalle_subtotal"],0,".",".") ?></td>
						</tr>
						<?php if($value["detalle_indexe"] == 0){$totalAfecto+=($value["detalle_cantidad"] * $value["detalle_unitario"]);} ?>
					<?php endforeach ?>
				</tbody>

				<?php
				// VERIFICAMOS SI HAY DESCUENTOS
				if($cotizacion[1]["cotizacion_valordr"] <> "")
				{
					// COMPROBAMOS SI ES DESCUENTO O RECARGO
					if($cotizacion[1]["cotizacion_tpomov"] == "D")
					{
						// DESCUENTO
						// VERIFICAMOS SI ES % O $
						if($cotizacion[1]["cotizacion_tpovalor"] == "%")
						{
							$neto = $cotizacion[1]["cotizacion_neto"] - (round($cotizacion[1]["cotizacion_neto"] * ($cotizacion[1]["cotizacion_valordr"] / 100)));
						}else if($cotizacion[1]["cotizacion_tpovalor"] == "$")
						{
							$neto = $cotizacion[1]["cotizacion_neto"] - $cotizacion[1]["cotizacion_valordr"];
						}else{
							$neto = $cotizacion[1]["cotizacion_neto"];
						}
					}else{
						// RECARGO
						// VERIFICAMOS SI ES % O $
						if($cotizacion[1]["cotizacion_tpovalor"] == "%")
						{
							$neto = $cotizacion[1]["cotizacion_neto"] + (round($cotizacion[1]["cotizacion_neto"] * ($cotizacion[1]["cotizacion_valordr"] / 100)));
						}else if($cotizacion[1]["cotizacion_tpovalor"] == "$")
						{
							$neto = $cotizacion[1]["cotizacion_neto"] + $cotizacion[1]["cotizacion_valordr"];
						}else{
							$neto = $cotizacion[1]["cotizacion_neto"];
						}
					}
				}else{
					$neto = $cotizacion[1]["cotizacion_neto"];
				}

				$iva = round($neto * 0.19);

				$total = $neto + $iva + $cotizacion[1]["cotizacion_exento"];
				?>
				<tfoot>
					<tr>
						<td colspan="6" align="right">SUBTOTAL</td>
						<td colspan="1" align="left">$<?php echo number_format($subtotal,0,".",".") ?></td>
					</tr>
					
					<?php if ($cotizacion[1]["cotizacion_valordr"] <> "" && $cotizacion[1]["cotizacion_tpovalor"] <> "" && $cotizacion[1]["cotizacion_tpomov"] <> ""): ?>
						<tr>
							<td colspan="6" align="right"><?php if($cotizacion[1]["cotizacion_valordr"] <> ""){ echo ($cotizacion[1]["cotizacion_tpomov"] == "D") ? "DESCUENTO" : "RECARGO"; } ?> GLOBAL ITEMS AFECTOS</td>
							<!-- <td colspan="1" align="left"><?php echo $cotizacion[1]["cotizacion_tpovalor"]." ".$cotizacion[1]["cotizacion_valordr"] ?></td> -->
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
						<td colspan="6" align="right">MONTO NETO</td>
						<td colspan="1" align="left">$<?php echo number_format($cotizacion[1]["cotizacion_neto"],0,".",".") ?></td>
					</tr>

					<tr>
						<td colspan="6" align="right">MONTO EXENTO</td>
						<td colspan="1" align="left">$<?php echo number_format($cotizacion[1]["cotizacion_exento"],0,".",".") ?></td>
					</tr>

					<?php if ($tipo_dcto <> 34): ?>
						<tr>
							<td colspan="6" align="right">IVA (19%)</td>
							<td colspan="1" align="left">$<?php echo number_format($cotizacion[1]["cotizacion_iva"],0,".",".") ?></td>
						</tr>
					<?php endif ?>
					
					<tr>
						<td colspan="6" align="right">TOTAL</td>
						<td colspan="1" align="left">$<?php echo number_format(($tipo_dcto == 34) ? $cotizacion[1]["cotizacion_exento"] : $cotizacion[1]["cotizacion_total"],0,".",".") ?></td>
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
				</div>
				<h4 class="panel-title">REFERENCIAS</h4>
			</div>
			
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
					
				</div>
				<h4 class="panel-title">TIPO DE DOCUMENTO</h4>
				
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select class="form-control" name="tipo_dcto" id="tipo_dcto" onChange="this.form.submit()">
							<option value="">Seleccionar...</option>
							<option value="33" <?php if($tipo_dcto == 33){echo"selected";}?>>FACTURA ELECTRÓNICA</option>
							<!-- <option value="34" <?php if($tipo_dcto == 34){echo"selected";}?>>FACTURA NO AFECTA O EXENTA ELECTRÓNICA</option> -->
						</select>
					</div>
				</div>
			</div>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-primary mr5">GENERAR DTE</button>
					<button type="reset" class="btn btn-dark">Reset</button>
				</div>
			</div>
		</div>

		<input type="hidden" name="cotizacion_id" value="<?php echo $_GET["id"] ?>">
		<input type="hidden" name="cmd" value="generarDTE">

		<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
		<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
		<input type="hidden" name="receptor_rut" value="<?php echo $cotizacion[1]["cliente_rut"] ?>" />
		<input type="hidden" name="receptor_dv" value="<?php echo $cotizacion[1]["cliente_dv"] ?>" />

		<input type="hidden" name="neto" value="<?php echo $cotizacion[1]["cotizacion_neto"] ?>">
		<input type="hidden" name="iva" value="<?php echo $cotizacion[1]["cotizacion_iva"] ?>">
		<input type="hidden" name="exento" value="<?php echo $cotizacion[1]["cotizacion_exento"] ?>">
		<input type="hidden" name="total" value="<?php echo $cotizacion[1]["cotizacion_total"] ?>">
		<input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">

	</form>

	<script type="text/javascript">
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
						// setTimeout(function(){
						// 	window.location.href='?pagina=factura&ori=ver';
						// },1500);
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
	