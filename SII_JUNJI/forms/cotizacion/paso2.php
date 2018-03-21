<?php
require_once("includes/functions.categoria.php");
require_once("includes/functions.producto.php");
require_once("includes/functions.cotizacion.php");
$categorias = getCategorias();
// $productos = getProductos($_POST["categoria_id"]);

if(isset($_POST["cmd"]) && $_POST["cmd"] == "agregarProducto")
{
	agregarProducto($_POST);
}
$detalleCotizacion = getDetalleCotizacion($_GET["id"]);
$subtotal = 0;
$iva = 0;
$total = 0;

$neto=0;
$exento=0;
?>

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
			
		</div><!-- panel-btns -->
		<h4 class="panel-title">AGREGAR PRODUCTOS /  SERVICIOS</h4>
	</div><!-- panel-heading -->
	<div class="panel-body">
		<form class="form-horizontal" id="frmCotizacion" method="POST">
			<div class="form-group">
				<label class="col-sm-3 control-label">CATEGORIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="categoria_id" id="categoria_id" onChange="getProductos(this.value)"> 
						<option value="">Seleccionar...</option>
						<?php foreach ($categorias as $key => $value): ?>
							<option value="<?php echo $value["categoria_id"] ?>"><?php echo $value["categoria_glosa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">PRODUCTOS <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="producto_id" id="producto_id" onChange="getUnitario(this.value)"> 
						<option value="">Seleccionar...</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CANTIDAD <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<input type="number" class="form-control" name="producto_cantidad" id="producto_cantidad" min="1" max="1000">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">UNIDAD DE MEDIDA <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<select name="umedida" id="umedida" class="form-control">
						<option value="TON">TONELADA</option>
						<option value="KG">KILOGRAMO</option>
						<option value="UNID" selected>UNIDADES</option>
						<option value="QTAL">QUINTAL (100 KG.)</option>
						<option value="M3">METRO CÚBICO</option>
						<option value="MR">METRO RUMA</option>
						<option value="TBDM">TONELADA BDMT</option>
						<option value="TBDU">TONELADA BDU</option>
						<option value="PP">PULGADA PINERA</option>
						<option value="PM">PULGADA MADERERA</option>
						<option value="HORA">HORA HOMBRE</option>
					</select>
				</div>
			</div>

			<input type="hidden" name="cmd" value="agregarProducto">
			<input type="hidden" name="cotizacion_id" value="<?php echo $_GET["id"] ?>">
			<input type="hidden" name="unitario_neto" id="unitario_neto">
			<input type="hidden" name="unitario_glosa" id="unitario_glosa">
			<input type="hidden" name="unitario_indexe" id="unitario_indexe">

			
			<!-- <div class="panel-footer"> -->
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-sm btn-dark">AÑADIR</button>
				</div>
			</div>
			<!-- </div> -->

		</form>
	</div>
</div>

<form class="form-horizontal" id="frmCotizacionCerrar" method="POST">
	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				
			</div><!-- panel-btns -->
			<h4 class="panel-title">PRODUCTOS / SERVICIOS AÑADIDOS</h4>
			
		</div><!-- panel-heading -->
		<div class="panel-body">
			<table class="table">
				<thead>
					<th>PRODUCTO</th>
					<th>CANTIDAD</th>
					<th>U.M</th>
					<th>VALOR UNITARIO</th>
					<th>% DESCUENTO</th>
					<th>SUBTOTAL</th>
					<th>ELIMINAR</th>
				</thead>

				<tbody>
					<?php $contador = 0 ?>
					<?php foreach ($detalleCotizacion as $key => $value): ?>
						<?php 
						if($value["detalle_indexe"] == 1)
						{
							$exento += $value["detalle_unitario"] * $value["detalle_cantidad"];
						}else{
							$neto += $value["detalle_unitario"] * $value["detalle_cantidad"];
						}
						?>
						<?php $subtotal += $value["detalle_unitario"] * $value["detalle_cantidad"] ?>
						<tr>

							<td><input type="text" readonly value="<?php echo $value["detalle_producto_id"] ?>" class="form-control"></td>
							<td><input class="form-control" name="var9[<?php echo $contador ?>]" id="var9_<?php echo $contador ?>" type="number" min="0" max="1000" value="<?php echo $value["detalle_cantidad"] ?>" onChange="actualiza1(this.value,<?php echo $contador ?>)"></td>
							<td>
								<select name="umedida[<?php echo $contador ?>]" id="umedida_<?php echo $contador ?>" class="form-control">
								<option value="TON" <?php if($value["detalle_umedida"] == "TON"){echo"selected";} ?>>TONELADA</option>
								<option value="KG" <?php if($value["detalle_umedida"] == "KG"){echo"selected";} ?>>KILOGRAMO</option>
								<option value="UNID" <?php if($value["detalle_umedida"] == "UNID"){echo"selected";} ?> selected>UNIDADES</option>
								<option value="QTAL" <?php if($value["detalle_umedida"] == "QTAL"){echo"selected";} ?>>QUINTAL (100 KG.)</option>
								<option value="M3" <?php if($value["detalle_umedida"] == "M3"){echo"selected";} ?>>METRO CÚBICO</option>
								<option value="MR" <?php if($value["detalle_umedida"] == "MR"){echo"selected";} ?>>METRO RUMA</option>
								<option value="TBDM" <?php if($value["detalle_umedida"] == "TBDM"){echo"selected";} ?>>TONELADA BDMT</option>
								<option value="TBDU" <?php if($value["detalle_umedida"] == "TBDU"){echo"selected";} ?>>TONELADA BDU</option>
								<option value="PP" <?php if($value["detalle_umedida"] == "PP"){echo"selected";} ?>>PULGADA PINERA</option>
								<option value="PM" <?php if($value["detalle_umedida"] == "PM"){echo"selected";} ?>>PULGADA MADERERA</option>
								<option value="HORA" <?php if($value["detalle_umedida"] == "HORA"){echo"selected";} ?>>HORA HOMBRE</option>
					</select>
							</td>
							<td><input type="text" value="$<?php echo number_format($value["detalle_unitario"],0,".",".") ?>" class="form-control" readonly></td>
							<td><input class="form-control" type="number" min="0" max="100" name="var1[<?php echo $contador ?>]" id="var1_<?php echo $contador ?>" onChange="dcto(<?php echo $contador ?>,(<?php echo ($value["detalle_unitario"] * $value["detalle_cantidad"]) ?>))" value="0"></td>
							<td><input class="form-control" type="text" name="var2[<?php echo $contador ?>]" id="var2_<?php echo $contador ?>" value="<?php echo ($value["detalle_unitario"] * $value["detalle_cantidad"]) ?>" readonly></td>
							<td><button class="btn btn-danger" onClick="eliminarProducto(<?php echo $value["detalle_id"] ?>)">ELIMINAR <i class="fa fa-ban"></i></button></td>
							<input type="hidden" name="detalle_id[<?php echo $contador ?>]" value="<?php echo $value["detalle_id"] ?>">
							<input type="hidden" name="var3[<?php echo $contador ?>]" id="var3_<?php echo $contador ?>" value="<?php echo $value["detalle_unitario"] ?>">
							<input type="hidden" name="var4[<?php echo $contador ?>]" value="<?php echo $value["detalle_cantidad"] ?>">
							<input type="hidden" name="var5[<?php echo $contador ?>]" value="<?php echo $value["detalle_producto_id"] ?>">
							<input type="hidden" name="var6[<?php echo $contador ?>]" id="var6_<?php echo $contador ?>" value="<?php echo $value["detalle_descuento_monto"] ?>">
							<input type="hidden" name="var8[<?php echo $contador ?>]" value="<?php echo ($value["detalle_unitario"] * $value["detalle_cantidad"]) ?>">
						</tr>
						<?php $contador++ ?>
					<?php endforeach ?>
				</tbody>

				<?php
				$iva = round($neto * 0.19);
				$total = $iva + $subtotal;
				?>

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
					<td><input type="text" class="form-control" name="DscRcgGlobalValorDR"></td>
					<td>
						<div class="ckbox ckbox-success">
							<input type="checkbox" id="DscRcgGlobal" name="DscRcgGlobal">
							<label for="DscRcgGlobal">APLICAR DESCUENTO/RECARGO</label>
						</div>
					</td>
				</tr>
				
				<tfoot>
					<tr>
						<td colspan="3" align="right">SUBTOTAL</td>
						<td colspan="3" align="left"><input class="form-control" type="text" id="subtotal" name="subtotal" value="<?php echo $subtotal ?>" readonly></td>
					</tr>

					<tr>
						<td colspan="3" align="right">MONTO NETO</td>
						<td colspan="3" align="left"><input class="form-control" type="text" id="cotizacion_neto" name="cotizacion_neto" value="<?php echo $neto ?>" readonly></td>
					</tr>

					<tr>
						<td colspan="3" align="right">MONTO EXENTO</td>
						<td colspan="3" align="left"><input class="form-control" type="text" id="cotizacion_neto" name="cotizacion_exento" value="<?php echo $exento ?>" readonly></td>
					</tr>


					<tr>
						<td colspan="3" align="right">IVA (19%)</td>
						<td colspan="3" align="left"><input class="form-control" type="text" id="cotizacion_iva" name="cotizacion_iva" value="<?php echo $iva ?>" readonly></td>
					</tr>

					<tr>
						<td colspan="3" align="right">TOTAL</td>
						<td colspan="3" align="left"><input class="form-control" type="text" id="cotizacion_total" name="cotizacion_total" value="<?php echo $total ?>" readonly></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<button class="btn btn-dark mr5">ENVIAR</button>
				
				<input type="hidden" name="cotizacion_id" value="<?php echo $_GET["id"] ?>">
				<input type="hidden" name="cmd" value="cerrarCotizacion">
			</div>
		</div>
	</div>
	<input type="hidden" name="totalElementos" id="totalElementos" value="<?php echo $contador ?>">
</form>


<script type="text/javascript">

	$("#frmCotizacionCerrar").validate({
		submitHandler : function ( form )
		{
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.cotizacion.php",
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
							window.location.href='?pagina=cotizacion&action=ver';
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
	function eliminarProducto(input)
	{
		var data = ({cmd:"eliminarProducto",detalle_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.cotizacion.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				if(response)
				{
					window.location.reload();
				}
			}
		});
	}
	function getProductos(input)
	{
		var data = ({cmd:"getProductos",categoria_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.producto.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				var tabla = '<option value="">Seleccionar..</option>';
				$.each(response,function(index,value){
					tabla += '<option value="'+value.producto_id+'">'+value.producto_glosa+'</option>';
				})
				
				$("#producto_id").html(tabla);
			}
		});
	}


	function actualiza1(input,id)
	{
		var dctoProducto = (parseInt($("#var1_"+id).val())) / 100;
		var subtotalProducto = parseInt($("#var9_"+id).val()) * parseInt($("#var3_"+id).val());
		var monto2 = Math.round(dctoProducto * subtotalProducto);
		var totalElementos = $("#totalElementos").val();
		var descuento = (100 - parseInt($("#var1_"+id).val())) / 100;
		var subtotal = $("#var3_"+id).val() * $("#var9_"+id).val();
		var total = Math.round(descuento * subtotal);

		$("#var4_"+id).val(input);
		$("#var2_"+id).val(total);
		$("#var6_"+id).val(monto2);

		setTotales();

	}

	function setTotales()
	{
		var totalElementos = parseInt($("#totalElementos").val());
		var subtotal = 0;
		var monto = 0;
		var iva = 0;
		var total = 0;

		for(i=0;i<totalElementos;i++)
		{
			subtotal += parseInt($("#var2_"+i).val());
		}

		// var dcto_global = Math.round((parseInt($("#dcto_global").val()) / 100) * subtotal);
		var dcto_global = 0;
		$("#monto").val(dcto_global);
		$("#subtotal").val(subtotal);

		monto = subtotal - dcto_global;
		$("#cotizacion_neto").val(monto);

		iva = Math.round(monto * 0.19);
		$("#cotizacion_iva").val(iva);

		total = iva + monto;
		$("#cotizacion_total").val(total);

	}
	function descuentoGlobal(input)
	{
		if($("#afecto").is(":checked"))
		{
			
		}else{
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

	function getUnitario(input)
	{
		var data = ({cmd:"getUnitario", producto_id : input});
		console.log(data);
		$.ajax({
			type:"POST",
			url:"includes/functions.producto.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				console.log(response);
				$("#unitario_neto").val(response[1].producto_neto);
				$("#unitario_glosa").val(response[1].producto_glosa);
				$("#unitario_indexe").val(response[1].producto_indexe);
			}
		});
	}

</script>