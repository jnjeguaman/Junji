<?php
extract($_GET);
$producto = getDetalleProducto($id);
$categoria = getCategorias();
?>
<form id="frmProducto" class="form-horizontal">
	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">AGREGAR CATEGORIAS</h4>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">CATEGORIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="producto_categoria_id" id="producto_categoria_id" class="form-control">
						<option value="" selected>Seleccionar...</option>
						<?php foreach ($categoria as $key => $value): ?>
							<option value="<?php echo $value["categoria_id"] ?>" <?php if($value["categoria_id"] == $producto[1]["producto_categoria_id"]){echo"selected";} ?> ><?php echo $value["categoria_glosa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">PRODUCTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="producto_glosa" id="producto_glosa" value="<?php echo $producto[1]["producto_glosa"] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">AFECTO / EXENTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="producto_indexe" id="producto_indexe" class="form-control">
						<option value="" selected>Seleccionar...</option>
						<option value="0" <?php if($producto[1]["producto_indexe"] == 0){echo"selected";} ?>>AFECTO</option>
						<option value="1" <?php if($producto[1]["producto_indexe"] == 1){echo"selected";} ?>>EXENTO</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">NETO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="producto_neto" id="producto_neto" onChange="getIvaTotal(this.value)" value="<?php echo $producto[1]["producto_neto"] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">IVA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="producto_iva" id="producto_iva" readonly value="<?php echo $producto[1]["producto_iva"] ?>"">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">TOTAL <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="producto_total" id="producto_total" readonly value="<?php echo $producto[1]["producto_total"] ?>"">
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label">ESTADO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="producto_estado" id="producto_estado" class="form-control">
						<option value="" selected>Seleccionar...</option>
						<option value="1" <?php if($producto[1]["producto_estado"] == 1){echo"selected";}?> >ACTIVO</option>
						<option value="0" <?php if($producto[1]["producto_estado"] == 0){echo"selected";}?> >INACTIVO</option>
					</select>
				</div>
			</div>


		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">CREAR <i class="fa fa-plus"></i></button>
				</div>
			</div>
		</div>

	</div>
	<input type="hidden" name="cmd" value="actualizarProducto">
	<input type="hidden" name="producto_id" value="<?php echo $producto[1]["producto_id"] ?>">
</form>


<script type="text/javascript">
	function getIvaTotal(input)
	{
		var iva = Math.round(parseInt(input) * 0.19);
		var total = parseInt(iva) + parseInt(input);
		$("#producto_iva").val(iva);
		$("#producto_total").val(total);
	}

	$("#frmProducto").validate({
		rules : {
			producto_categoria_id : { required : true},
			producto_indexe : { required : true},
			producto_neto : { required : true},
			producto_estado : { required : true},
		},
		submitHandler : function ( form )
		{
			var data = $(form).serializeArray();
			console.log(data);
			$.ajax({
				type:"POST",
				url:"includes/functions.producto.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					if(response.Respuesta)
					{
						jQuery.gritter.add({
							title: 'This is a regular notice!',
							text: 'This will fade out after a certain amount of time.',
							class_name: 'growl-success',
								// image: 'images/logo.png',
								sticky: false,
								time: ''
							});
						setTimeout(function(){
							// window.location.href='?pagina=productos&ori=nuevo';
							window.location.reload();
						},1500);
					}else{
						jQuery.gritter.add({
							title: 'This is a regular notice!',
							text: 'This will fade out after a certain amount of time.',
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