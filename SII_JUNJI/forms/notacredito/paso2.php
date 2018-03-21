<?php
extract($_GET);
require_once("includes/functions.documentos.php");
require_once("includes/functions.cliente.php");
require_once("includes/functions.comuna.php");
require_once("includes/functions.region.php");
$detalle = getDetalleDTE($dte_id);
// $cliente = getClienteDetalle($detalle[1]["dte_cliente_id"]);
$getClientes = getMisClientes();
$contador = sizeof($detalle);
$comunas = getComunas();
$regiones = getRegiones();
$neto=0;
$exento=0;
// echo "<pre>";
// print_r($detalle);
// echo "</pre>";
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$style = 'style="display:none"';
$readonly = "readonly = \"1\"";

if($action == 1)
{
	$referencia = "ANULA DOCUMENTO DE REFERENCIA";
}else if($action == 2)
{
	$referencia = "CORRIGE TEXTO DOCUMENTO DE REFERENCIA";
}else if($action == 3)
{
	$referencia = "CORRIGE MONTOS";
}else if($action == 4){
	$referencia = "NOTA DE CRÉDITO DE ANULACIÓN";
}

?>
<form class="form-horizontal" id="frmCotizacionCerrar" method="POST">
	
	<!-- INFORMACION DEL CLIENTE !-->
	<div class="panel panel-dark" <?php if($action == 1 || $action == 3){echo $style;} ?>>
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div><!-- panel-btns -->
			<h4 class="panel-title"><?php echo $referencia ?></h4>
			
		</div><!-- panel-heading -->
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">CLIENTE <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="receptor_id" id="receptor_id" onChange="getClienteDetalle(this.value)">
						<option value="">Seleccionar...</option>
						<?php foreach ($getClientes as $key => $value): ?>
							<option value="<?php echo $value["cliente_id"] ?>" <?php if($detalle[1]["dte_cliente_id"] == $value["cliente_id"]){echo"selected";} ?>><?php echo $value["cliente_empresa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">EMPRESA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="RznSocRecep" id="RznSocRecep" value="<?php echo $detalle[1]["cliente_empresa"] ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="GiroRecep" id="GiroRecep" value="<?php echo $detalle[1]["cliente_giro"] ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RUT</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="RUTRecep" id="RUTRecep" value="<?php echo $detalle[1]["cliente_rut"] ?>" readonly>
				</div>

				<div class="col-sm-1">
					<input type="text" class="form-control" name="RUTRecepDv" id="RUTRecepDv" value="<?php echo $detalle[1]["cliente_dv"] ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="DirRecep" id="DirRecep" value="<?php echo $detalle[1]["cliente_direccion"] ?>" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">REGION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="region_id" id="region_id"  onChange="getComunas(this.value)"> 
						<option value="">Seleccionar...</option>
						<?php foreach ($regiones as $key => $value): ?>
							<option value="<?php echo $value["region_id"] ?>" <?php if($value["region_id"] == $detalle[1]["cliente_provincia_id"]){echo"selected";} ?>><?php echo utf8_encode($value["region_glosa"]) ?></option>
						<?php endforeach ?>
					</select>	
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CIUDAD <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="CiudadRecep" id="CiudadRecep"  onChange="getCiudades(this.value)"> 
						<?php if ($detalle[1]["cliente_provincia_id"] <> ""): ?>
							<option value="<?php echo $detalle[1]["cliente_provincia_id"] ?>"><?php echo $detalle[1]["cliente_provincia_id"] ?></option>
						<?php else: ?>
							<option value="" >Seleccionar...</option>
						<?php endif ?>
					</select>	
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="CmnaRecep" id="CmnaRecep"> 
						<?php if ($detalle[1]["cliente_comuna_id"] <> ""): ?>
							<option value="<?php echo $detalle[1]["cliente_comuna_id"] ?>"><?php echo $detalle[1]["cliente_comuna_id"] ?></option>
						<?php else: ?>
							<option value="" >Seleccionar...</option>
						<?php endif ?>
					</select>	
				</div>
			</div>
		</div><!-- panel-body -->
		<input type="hidden" name="CiudadRecep2" id="CiudadRecep2" value="<?php echo $detalle[1]["cliente_provincia_id"] ?>">
		<input type="hidden" name="CmnaRecep2" id="CmnaRecep2" value="<?php echo $detalle[1]["cliente_comuna_id"] ?>">

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
	
	<div class="panel panel-dark" <?php if($action == 1 || $action == 2){echo $style;} ?>>
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div><!-- panel-btns -->
			<h4 class="panel-title">Basic Form Validation</h4>
			
		</div><!-- panel-heading -->
		<div class="panel-body">
			<table class="table table-bordered table-striped table-hover table-condenced">
				<thead>
					<th>OP</th>
					<th>PRODUCTO</th>
					<th>CANTIDAD</th>
					<th>U.M</th>
					<th>VALOR UNITARIO</th>
					<th>% DESCUENTO</th>
					<th>SUBTOTAL</th>
					<!-- <th>ELIMINAR</th> -->
				</thead>

				<tbody>
					<?php $contador = 0 ?>
					<?php foreach ($detalle as $key => $value): ?>
						<?php 
						if($value["detalle_indexe"] == 1)
						{
							$exento+=$value["detalle_subtotal"];
						}else{
							$neto+=$value["detalle_subtotal"];
						}

						?>
						<?php $subtotal += $value["detalle_subtotal"] ?>
						<tr>
							<td><input type="checkbox" name="var12[<?php echo $contador ?>]" id="var12_<?php echo $contador?>" onClick="valida(<?php echo $contador ?>)"></td>
							<td><?php echo $value["detalle_producto_id"] ?></td>
							<td><input class="form-control" name="var9[<?php echo $contador ?>]" id="var9_<?php echo $contador ?>" type="number" min="0" max="<?php echo $value["detalle_cantidad"] ?>" value="<?php echo $value["detalle_cantidad"] ?>" onChange="actualiza1(this.value,<?php echo $contador ?>)"></td>
							<!-- <td>$<?php echo number_format($value["detalle_unitario"],0,".",".") ?></td> -->
							<td>
								<select class="form-control umedida" name="var13[<?php echo $contador ?>]" id="var13_<?php echo $contador ?>">
									<option value="" <?php if($value["detalle_umedida"] == ""){echo"selected";} ?> >Seleccionar...</option>
									<option value="TON" <?php if($value["detalle_umedida"] == "TON"){echo"selected";} ?> >TONELADA</option>
									<option value="KG" <?php if($value["detalle_umedida"] == "KG"){echo"selected";} ?> >KILOGRAMO</option>
									<option value="UNID" <?php if($value["detalle_umedida"] == "UNID"){echo"selected";} ?> >UNIDADES</option>
									<option value="QTAL" <?php if($value["detalle_umedida"] == "QTAL"){echo"selected";} ?> >QUINTAL (100 KG.)</option>
									<option value="M3" <?php if($value["detalle_umedida"] == "M3"){echo"selected";} ?> >METRO CÚBICO</option>
									<option value="MR" <?php if($value["detalle_umedida"] == "MR"){echo"selected";} ?> >METRO RUMA</option>
									<option value="TBDM" <?php if($value["detalle_umedida"] == "TBDM"){echo"selected";} ?> >TONELADA BDMT</option>
									<option value="TBDU" <?php if($value["detalle_umedida"] == "TBDU"){echo"selected";} ?> >TONELADA BDU</option>
									<option value="PP" <?php if($value["detalle_umedida"] == "PP"){echo"selected";} ?> >PULGADA PINERA</option>
									<option value="PM" <?php if($value["detalle_umedida"] == "PM"){echo"selected";} ?> >PULGADA MADERERA</option>
									<option value="Hora" <?php if($value["detalle_umedida"] == "Hora"){echo"selected";} ?> >HORA HOMBRE</option></select>
								</td>
								<td><input type="number" min="1" max="<?php echo $value["detalle_unitario"] ?>" class="form-control" value="<?php echo $value["detalle_unitario"] ?>" name="var11[<?php echo $contador ?>]" id="var11_<?php echo $contador ?>" onChange="actualiza1(this.value,<?php echo $contador ?>)"></td>
								<td><input class="form-control" type="number" min="<?php echo $value["detalle_descuento"] ?>" max="100" name="var1[<?php echo $contador ?>]" id="var1_<?php echo $contador ?>" onChange="dcto(<?php echo $contador ?>,<?php echo $value["detalle_unitario"] ?>)" value="<?php echo $value["detalle_descuento"] ?>"></td>
								<td><input class="form-control" type="text" name="var2[<?php echo $contador ?>]" id="var2_<?php echo $contador ?>" value="<?php echo $value["detalle_subtotal"] ?>" readonly></td>
								<!-- <td><button type="button" class="btn btn-info btn-sm" onClick="eliminarProducto(<?php echo $value["detalle_id"] ?>)">ELIMINAR</button></td> -->
								<input type="hidden" name="detalle_id[<?php echo $contador ?>]" value="<?php echo $value["detalle_id"] ?>">
								<input type="hidden" name="var3[<?php echo $contador ?>]" id="var3_<?php echo $contador ?>" value="<?php echo $value["detalle_unitario"] ?>">
								<input type="hidden" name="var4[<?php echo $contador ?>]" id="var4_<?php echo $contador ?>" value="<?php echo $value["detalle_cantidad"] ?>">
								<input type="hidden" name="var5[<?php echo $contador ?>]" value="<?php echo $value["detalle_producto_id"] ?>">
								<input type="hidden" name="var6[<?php echo $contador ?>]" id="var6_<?php echo $contador ?>" value="<?php echo $value["detalle_descuento_monto"] ?>">
								<input type="hidden" name="var7[<?php echo $contador ?>]" value="<?php echo $value["producto_id"] ?>">
								<input type="hidden" name="var8[<?php echo $contador ?>]" value="<?php echo ($value["detalle_unitario"] * $value["detalle_cantidad"]) ?>">
								<input type="hidden" name="var10[<?php echo $contador ?>]" id="var10_<?php echo $contador ?>" value="<?php echo $value["detalle_indexe"] ?>">
							</tr>
							<?php $contador++ ?>
						<?php endforeach ?>

						<tr>
							<td colspan="2">
								<select class="form-control" name="DscRcgGlobalTpoMov">
									<option value="">Seleccionar...</option>
									<option value="D">Descuento</option>
									<!-- <option value="R">Recargo</option> -->
								</select>
							</td>
							<td colspan="2">
								<select class="form-control" name="DscRcgGlobalTpoValor">
									<option value="">Seleccionar...</option>
									<option value="%">%</option>
									<option value="$">$</option>
								</select>
							</td>
							<td>
								<input type="text" class="form-control" name="DscRcgGlobalValorDR">
							</td>

							<td>
								<div class="ckbox ckbox-success">
									<input type="checkbox" id="DscRcgGlobal" name="DscRcgGlobal">
									<label for="DscRcgGlobal">APLICAR DESCUENTO/RECARGO</label>
								</div>
							</td>

						</tr>

					</tbody>

					<?php
					$iva = floor($neto * 0.19);
					$total = $iva + $neto + $exento;
					?>
					<tfoot>
						<tr>
							<td colspan="4" align="right">SUBTOTAL</td>
							<td colspan="2" align="left"><input class="form-control" type="text" id="subtotal" name="subtotal" value="<?php echo $subtotal ?>" readonly></td>
						</tr>

					<!-- <tr>
						<td  colspan="2" align="right">DESCUENTO GLOBAL</td>
						<td  colspan="1" align="left"><input class="form-control" type="number" min="0" max="100" name="dcto_global" id="dcto_global" onChange="descuentoGlobal(this.value)" value="<?php echo $detalle[1]["dte_dcto_global"] ?>"></td>

						<td colspan="1" align="right">MONTO</td>
						<td colspan="2" align="left"><input class="form-control" type="text" id="monto" name="monto" readonly value="<?php echo $detalle[1]["dte_dcto_global_monto"] ?>"></td>
					</tr> -->

					<tr>
						<td colspan="4" align="right">MONTO NETO</td>
						<td colspan="2" align="left"><input class="form-control" type="text" id="cotizacion_neto" name="cotizacion_neto" value="<?php echo $neto ?>" readonly></td>
					</tr>

					<tr>
						<td colspan="4" align="right">MONTO EXENTO</td>
						<td colspan="2" align="left"><input class="form-control" type="text" id="cotizacion_exento" name="cotizacion_exento" value="<?php echo $exento ?>" readonly></td>
					</tr>


					<tr>
						<td colspan="4" align="right">IVA (19%)</td>
						<td colspan="2" align="left"><input class="form-control" type="text" id="cotizacion_iva" name="cotizacion_iva" value="<?php echo $iva ?>" readonly></td>
					</tr>

					<tr>
						<td colspan="4" align="right">TOTAL</td>
						<td colspan="2" align="left"><input class="form-control" type="text" id="cotizacion_total" name="cotizacion_total" value="<?php echo $total ?>" readonly></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label">RAZON DE LA REFERENCIA <span class="asterisk">*</span></label>
		<div class="col-sm-9">
			<textarea name="RazonRef" id="RazonRef" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 143px;"><?php echo $referencia ?></textarea>
		</div>
	</div>

	<!-- SOLO PARA USO EN CERTIFICACION -->
	<!-- <div class="form-group">
		<label class="col-sm-3 control-label">CASO <span class="asterisk">*</span></label>
		<div class="col-sm-3">
			<input required type="text" name="caso" id="caso" class="form-control">
		</div>
	</div> -->
	<!-- FIN -->

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<button class="btn btn-primary mr5">Generar DTE</button>
				<input type="hidden" name="dte_id" value="<?php echo $_GET["dte_id"] ?>">
			</div>
		</div>
	</div>


	<input type="hidden" name="totalElementos" id="totalElementos" value="<?php echo $contador ?>">
	<input type="hidden" name="TpoDocRef" id="TpoDocRef" value="<?php echo $detalle[1]["dte_dcto_id"] ?>">
	<input type="hidden" name="FolioRef" id="FolioRef" value="<?php echo $detalle[1]["dte_folio"] ?>">
	<input type="hidden" name="FchRef" id="FchRef" value="<?php echo $detalle[1]["dte_fecha"] ?>">
	<input type="hidden" name="tipo_dcto" id="tipo_dcto" value="61">
	<input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo $detalle[1]["dte_cliente_id"] ?>">
	<input type="hidden" name="CodRef" value="<?php echo $action ?>">
	<input type="hidden" name="dte_cotizacion_id" value="<?php echo $detalle[1]["dte_cotizacion_id"] ?>">
	<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
	<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
	<input type="hidden" id="cliente_provincia_id" name="cliente_provincia_id" value="<?php echo $detalle[1]["cliente_provincia_id"] ?>">
	<input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">
</form>

<script type="text/javascript">

	function actualiza1(input,id)
	{
		var dctoProducto = (parseInt($("#var1_"+id).val())) / 100;
		var subtotalProducto = parseInt($("#var9_"+id).val()) * parseInt($("#var11_"+id).val());
		var monto2 = Math.round(dctoProducto * subtotalProducto);
		var totalElementos = $("#totalElementos").val();
		var descuento = (100 - parseInt($("#var1_"+id).val())) / 100;
		var subtotal = $("#var11_"+id).val() * $("#var9_"+id).val();
		var total = Math.round(descuento * subtotal);

		$("#var4_"+id).val(input);
		$("#var2_"+id).val(total);
		$("#var6_"+id).val(monto2);

		setTotales();

	}

	// ACTUALIZA EL VALOR UNITARIO
	function actualiza2(input,id)
	{
		console.log(input+"\n"+id);
	}

	function setTotales()
	{
		var totalElementos = parseInt($("#totalElementos").val());
		var subtotal = 0;
		var monto = 0;
		var iva = 0;
		var total = 0;
		var exento = 0;
		var neto = 0;

		for(i=0;i<totalElementos;i++)
		{
			if($("#var12_"+i).is(":checked"))
			{
				if($("#var10_"+i).val() == 1)
				{
					exento += parseInt($("#var2_"+i).val());
				}else{
					neto += parseInt($("#var2_"+i).val());
				}
			}
		}

		$("#cotizacion_neto").val(neto);
		$("#cotizacion_exento").val(exento);

		iva = Math.round(neto * 0.19);
		$("#cotizacion_iva").val(iva);

		total = iva + neto + exento;
		$("#cotizacion_total").val(total);

		subtotal = neto + exento;
		var dcto_global = Math.round((parseInt($("#dcto_global").val()) / 100) * subtotal);
		monto = subtotal - dcto_global;
		$("#monto").val(dcto_global);
		$("#subtotal").val(subtotal);

	}
	function descuentoGlobal(input)
	{
		var subtotal = $("#subtotal").val();
		var monto = Math.round(subtotal * (input / 100));
		$("#monto").val(monto);

		var cotizacion_neto = subtotal - monto;
		var cotizacion_iva = Math.round(cotizacion_neto * 0.19);
		var cotizacion_total = Math.round(cotizacion_iva + cotizacion_neto);
		$("#cotizacion_neto").val(subtotal - monto);
		$("#cotizacion_iva").val(cotizacion_iva);
		$("#cotizacion_total").val(cotizacion_total);
	}


	function dcto(id,subtotal)
	{
		var descuento = (100 - parseInt($("#var1_"+id).val())) / 100;
		var subtotal = parseInt($("#var9_"+id).val()) * parseInt($("#var3_"+id).val());
		var total = Math.round(subtotal * descuento);
		$("#var2_"+id).val(total);

		var descuento2 = parseInt(100 - (descuento * 100)) / 100;
		var monto2 = Math.round(descuento2 * subtotal);
		$("#var6_"+id).val(monto2);

		setTotales();

	}

	$("#frmCotizacionCerrar").validate({
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
				beforeSend : function ()
				{
					blockUI();
				},
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
							window.location.href='?pagina=notacredito&ori=ver';
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
				},
				complete : function (){
					unBlockUI();
				}
			});

		}
	});

	function getClienteDetalle(input)
	{
		$("#dcto_cliente_id").val(input);
		var data = ({command : "getClienteDetalle", cliente_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.cliente.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				$("#RznSocRecep").val(response[1]["cliente_empresa"]);
				$("#DirRecep").val(response[1]["cliente_direccion"]);
				$("#RUTRecep").val(response[1]["cliente_rut"]);
				$("#RUTRecepDv").val(response[1]["cliente_dv"]);
				$("#CmnaRecep").val(response[1]["region_glosa"]);
				$("#CiudadRecep").val(response[1]["comuna_glosa"]);
				$("#GiroRecep").val(response[1]["cliente_giro"]);
			}
		});
	}

	function getComunas(input)
	{
		var data = ({cmd : "getComunas", region_id : input});
		$.ajax({
			type:"POST",
			url:"mantenedor/includes/functions.comuna.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				var comunas = '<option value="">Seleccionar...</option>';

				$.each(response,function(index,value){
					comunas += '<option value="'+value.provincia_id+'">'+value.provincia_glosa+'</option>';
				});

				$("#CiudadRecep").html(comunas);
			}
		});
	}

	function getCiudades(input)
	{
		$("#cliente_provincia_id").val($("#CiudadRecep option:selected").text());
		var data = ({cmd : "getCiudades", provincia_id : input});
		$.ajax({
			type:"POST",
			url:"mantenedor/includes/functions.ciudad.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				var ciudades = '<option value="">Seleccionar...</option>';

				$.each(response,function(index,value){
					ciudades += '<option value="'+value.comuna_glosa+'">'+value.comuna_glosa+'</option>';
				});

				$("#CmnaRecep").html(ciudades);
			}
		});
	}

	function valida(input)
	{
		if($("#var12_"+input).is(":checked"))
		{
			$("#var13_"+input).prop("required",true);
		}else{
			$("#var13_"+input).prop("required",false);
		}
	}
</script>