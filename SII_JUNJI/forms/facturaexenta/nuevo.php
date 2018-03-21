<?php
$getClientes = getClientes(34);
$getDocumentos = getDocumentos();
$getEmpresa = getEmpresa($_SESSION["sii"]["usuario_region"]);
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
$referencias = getReferencia();

$empresas = getEmpresas($_SESSION["sii"]["usuario_region"]);
?>
<form class="form-horizontal" id="frmNueva">

	<!-- INFORMACION DEL CLIENTE !-->
	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div><!-- panel-btns -->
			<h4 class="panel-title">INFORMACION DEL CLIENTE</h4>
			
		</div><!-- panel-heading -->
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">CLIENTE <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="receptor_id" id="receptor_id" onChange="getClienteDetalle(this.value)">
						<option value="">Seleccionar...</option>
						<?php foreach ($getClientes as $key => $value): ?>
							<option value="<?php echo $value["cliente_id"] ?>"><?php echo $value["cliente_empresa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RAZÓN SOCIAL <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="receptor_glosa" id="receptor_glosa" readonly="1" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RUT</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="receptor_rut" id="receptor_rut" readonly="1" />
				</div>

				<div class="col-sm-1">
					<input type="text" class="form-control" name="receptor_dv" id="receptor_dv" readonly="1" />
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="receptor_direccion" id="receptor_direccion" readonly="1"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">REGION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="receptor_region" id="receptor_region" readonly="1"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="receptor_comuna" id="receptor_comuna" readonly="1"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="receptor_giro" id="receptor_giro" readonly="1"/>
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

	<!-- INFORMACION DE LA FACTURA ELECTRONICA AFECTA O EXENTA !-->
	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div><!-- panel-btns -->
			<h4 class="panel-title">TIPO DE DOCUMENTO A EMITIR</h4>
			
		</div><!-- panel-heading -->
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="sii_tipo_dcto" id="sii_tipo_dcto">
						<option value="">Seleccionar...</option>
						<?php foreach ($getDocumentos as $key => $value): ?>
							<?php if ($value["dcto_codigo"] == 34): ?>
								<option value="<?php echo $value["dcto_codigo"] ?>"><?php echo $value["dcto_glosa"] ?></option>
								
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FECHA EMISION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="dcto_fecha_emision" id="dcto_fecha_emision" readonly="1" value="<?php echo Date("Y-m-d") ?>" />
				</div>
			</div>

		</div>
	</div>	

	<!-- INFORMACION DEL EMISOR !-->

	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div><!-- panel-btns -->
			<h4 class="panel-title">INFORMACION DEL EMISOR</h4>
			
		</div><!-- panel-heading -->
		<div class="panel-body">

		<div class="form-group">
				<label class="col-sm-3 control-label">ORIGEN <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="empresa_origen" id="empresa_origen" class="form-control" onchange="getDetalleEmpresa(this.value)" required>
						<option value="" selected>Seleccionar...</option>
						<?php foreach ($empresas as $key => $value): ?>
							<option value="<?php echo $value["empresa_id"] ?>"><?php echo $value["empresa_direccion"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">EMPRESA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="sii_empresa" id="sii_empresa" value="<?php echo $getEmpresa[1]["empresa_glosa"] ?>" readonly/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RUT <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="sii_empresa_rut" id="sii_empresa_rut" value="<?php echo $getEmpresa[1]["empresa_rut"] ?>" readonly/>
				</div>

				<div class="col-sm-3">
					<input type="text" class="form-control" name="sii_empresa_dv" id="sii_empresa_dv" value="<?php echo $getEmpresa[1]["empresa_dv"] ?>" readonly/>
				</div>

			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="sii_giro" id="sii_giro" value="<?php echo $getEmpresa[1]["empresa_giro"] ?>" readonly/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="sii_direccion" id="sii_direccion" readonly/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CIUDAD <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="sii_ciudad" id="sii_ciudad"  readonly/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="sii_comuna" id="sii_comuna" readonly/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FECHA EMISION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="dcto_fecha_emision" id="dcto_fecha_emision" readonly="1" value="<?php echo Date("Y-m-d") ?>" readonly/>
				</div>
			</div>

		</div>
	</div>		

<?php if(1==2): ?>
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
					<input type="radio" name="referencia" id="referencia" value="SI" onChange="setReferencia(this.value)"> SI / <input type="radio" name="referencia" id="referencia" value="NO" onChange="setReferencia(this.value)"> NO
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
				<div class="col-sm-5">
					<select class="form-control" name="TpoDocRef" id="TpoDocRef">
						<option value="">Seleccionar...</option>
						<?php foreach ($referencias as $key => $value): ?>
							<option value="<?php echo $value["ref_codigo"] ?>"><?php echo "(".$value["ref_codigo"].") ".$value["ref_glosa"] ?></option>
						<?php endforeach ?>
						
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FOLIO REFERENCIA <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="FolioRef" id="FolioRef">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">FECHA REFERENCIA <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<div class="input-group">
						<span class="input-group-addon" id="eventoCalendario"><i class="fa fa-calendar"></i></span>
						<input type="text" class="form-control" name="FchRef" id="FchRef" readonly>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RAZON REFERENCIA <span class="asterisk">*</span></label>
				<div class="col-sm-6">
					<textarea name="RazonRef" id="RazonRef" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 206px;"></textarea>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>

	<!-- LISTA DE PRODUCTOS !-->
	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div><!-- panel-btns -->
			<h4 class="panel-title">DETALLE PRODUCTOS / SERVICIOS</h4>
			
		</div><!-- panel-heading -->
		<div class="panel-body">

			<div class="table-responsive">
				<table class="table mb30">

					<tr class="item-row">
						<th></th>
						<th>PRODUCTO</th>
						<th>TIPO</th>
						<th>CANTIDAD</th>
						<th>U. MEDIDA</th>
						<th>VALOR UNITARIO</th>
						<th>% DESCUENTO</th>
						<th>SUBTOTAL</th>
					</tr>

					<tr id="hiderow">
						<td colspan="8"><a id="addrow" href="javascript:;" title="Agregar Item" class="btn btn-success btn-sm">AGREGAR <i class="fa fa-plus"></i></a></td>
					</tr>
<!--
					<tr>
						<td colspan="2">
							<select class="form-control" name="DscRcgGlobalTpoMov">
								<option value="">Seleccionar...</option>
								<option value="D">Descuento</option>
								<option value="R">Recargo</option>
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

						<td colspan="2">
							<div class="ckbox ckbox-success">
								<input type="checkbox" id="DscRcgGlobal" name="DscRcgGlobal">
								<label for="DscRcgGlobal">APLICAR DESCUENTO/RECARGO</label>
							</div>
						</td>

					</tr>
					!-->
					<tr>
						<td colspan="5" class="blank"> </td>
						<td colspan="1" class="total-line">SUB-TOTAL</td>
						<td class="total-value"><input type="text" name="subtotal" id="subtotal" readonly="1" class="form-control"></td>
					</tr>

					<!-- <tr>
						<td colspan="5" class="blank"> </td>
						<td colspan="1" class="total-line">NETO</td>
						<td class="total-value"><input type="text" name="neto" id="neto" readonly="1" class="form-control"></td>
					</tr> -->

					<tr>
						<td colspan="5" class="blank"> </td>
						<td colspan="1" class="total-line">EXENTO</td>
						<td class="total-value"><input type="text" name="exento" id="exento" readonly="1" class="form-control"></td>
					</tr>


					<!-- <tr>
						<td colspan="5" class="blank"> </td>
						<td colspan="1" class="total-line">IVA (19%)</td>
						<td class="total-value"><input type="text" name="iva" id="iva" readonly="1" class="form-control"></td>
					</tr> -->

					<tr>
						<td colspan="5" class="blank"> </td>
						<td colspan="1" class="total-line">TOTAL</td>
						<td class="total-value"><input type="text" name="total" id="total" readonly="1" class="form-control"></td>
					</tr>

				</table>
			</div>

		</div>
	</div>	

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<button class="btn btn-dark mr5">Generar DTE</button>
			</div>
		</div>
	</div>
	<input type="hidden" name="totalElementos" id="totalElementos">
	<input type="hidden" name="command" value="generaXML">
	<input type="hidden" name="dcto_cliente_id" id="dcto_cliente_id">
	<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
	<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
	<input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">
	<input type="hidden" name="tipoDCTO" id="tipoDCTO" value="<?php echo $pagina ?>">
</form>

<script type="text/javascript">

	function setReferencia(input)
	{
		if(input == "SI")
		{
			$("#TpoDocRef").attr("required",true);
			$("#FolioRef").attr("required",true);
			$("#FchRef").attr("required",true);
			$("#RazonRef").attr("required",true);
		}else{
			$("#TpoDocRef").attr("required",false);
			$("#FolioRef").attr("required",false);
			$("#FchRef").attr("required",false);
			$("#RazonRef").attr("required",false);
		}
	}
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
				$("#receptor_glosa").val(response[1]["cliente_empresa"]);
				$("#receptor_direccion").val(response[1]["cliente_direccion"]);
				$("#receptor_rut").val(response[1]["cliente_rut"]);
				$("#receptor_dv").val(response[1]["cliente_dv"]);
				$("#receptor_region").val(response[1]["cliente_provincia_id"]);
				$("#receptor_comuna").val(response[1]["cliente_comuna_id"]);
				$("#receptor_giro").val(response[1]["cliente_giro"]);
			}
		});
	}

	$("#frmNueva").validate({
		rules : {
			receptor_id : { required : true},
			sii_tipo_dcto : { required : true},
		},

		submitHandler : function ( form ){
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.procesar.php",
				data:data,
				dataType:"JSON",
				beforeSend : function(){
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
							window.location.href='?pagina=facturaexenta&ori=ver';
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
	})

	function checkCantidad(valor,id)
	{
		var totalElementos = parseInt($("#totalElementos").val());
		var subtotal = 0;

		subtotal=parseInt($("#sii_producto_costo_"+id).val()) * parseInt($("#sii_producto_qty_"+id).val());
		$("#subtotal_"+id).val(subtotal);

		setTotales();
	}
	function checkCosto(valor,id)
	{
		var totalElementos = parseInt($("#totalElementos").val());
		var subtotal = 0;

		subtotal=parseInt($("#sii_producto_costo_"+id).val()) * parseInt($("#sii_producto_qty_"+id).val());
		$("#var1_"+id).val(subtotal);
		setTotales();
	}

	function checkDescuento(valor,id)
	{
		var descuento = (100 - valor) / 100;
		var descuento_porcentaje = valor / 100;
		var valor = parseInt($("#sii_producto_costo_"+id).val()) * parseInt($("#sii_producto_qty_"+id).val());
		var valorDescuento = Math.round(descuento_porcentaje * valor);
		var valorFinal = Math.round(descuento * valor);
		$("#var1_"+id).val(valorFinal);
		$("#montoDescuento_"+id).val(valorDescuento);
		setTotales();
	}

	function setTotales()
	{
		var totalElementos = parseInt($("#totalElementos").val());
		var exento = 0;
		var descuentoExento = 0;
		var descuentoNeto = 0;
		for(i=1;i<=totalElementos;i++)
		{
			exento += parseInt($("#sii_producto_qty_"+i).val()) * parseInt($("#sii_producto_costo_"+i).val());
			descuentoExento += parseInt($("#montoDescuento_"+i).val());
		}
		var total = 0;
		total = exento - descuentoExento;
		subtotal = exento - descuentoExento;

		$("#exento").val(exento - descuentoExento);
		$("#total").val(total);
		$("#subtotal").val(subtotal);
	}

		function getDetalleEmpresa(input)
	{
		var data = ({cmd:"getDetalleEmpresa",empresa_id:input});
		console.log(data);
		$.ajax({
			type:"POST",
			url:"includes/functions.empresa.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
			// console.log(response);
			$("#sii_direccion").val(response[1]["empresa_direccion"]);
			$("#sii_ciudad").val(response[1]["empresa_ciudad"]);
			$("#sii_comuna").val(response[1]["empresa_comuna"]);
			}
		});
	}
</script>