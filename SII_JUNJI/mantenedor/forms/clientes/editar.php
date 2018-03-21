<?php
extract($_GET);
$cliente = getDetalleCliente($id);
$regiones = getRegiones();
$actividadEconomica = getActividadEconomica();
?>
<form class="form-horizontal" id="frmNuevoCliente">
	<!-- INFORMACION DEL CLIENTE !-->
	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">INFORMACION DEL CLIENTE</h4>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">RAZON SOCIAL <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_razon_social" id="cliente_razon_social" value="<?php echo $cliente[1]["cliente_empresa"] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RUT</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="cliente_rut" id="cliente_rut" value="<?php echo $cliente[1]["cliente_rut"] ?>" readonly>
				</div>

				<div class="col-sm-1">
					<input type="text" class="form-control" name="cliente_dv" id="cliente_dv" value="<?php echo $cliente[1]["cliente_dv"] ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_direccion" id="cliente_direccion" value="<?php echo $cliente[1]["cliente_direccion"] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">REGION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="cliente_region" id="cliente_region" onChange="getComunas(this.value)">
						<option value="" selected>Seleccionar...</option>
						<?php foreach ($regiones as $key => $value): ?>
							<option value="<?php echo $value["region_id"] ?>"><?php echo $value["region_glosa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">PROVINCIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_provincia" id="cliente_provincia" class="form-control" onChange="getCiudades(this.value)">
						<?php if ($cliente[1]["cliente_provincia_id"] <> ""): ?>
							<option value="<?php echo $cliente[1]["cliente_provincia_id"] ?>"><?php echo $cliente[1]["cliente_provincia_id"] ?></option>
						<?php else: ?>
							<option value="" >Seleccionar...</option>
						<?php endif ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_comuna" id="cliente_comuna" class="form-control">
						<?php if ($cliente[1]["cliente_comuna_id"] <> ""): ?>
							<option value="<?php echo $cliente[1]["cliente_comuna_id"] ?>"><?php echo $cliente[1]["cliente_comuna_id"] ?></option>
						<?php else: ?>
							<option value="" >Seleccionar...</option>
						<?php endif ?>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_giro" id="cliente_giro" value="<?php echo $cliente[1]["cliente_giro"] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">ACTIVIDAD ECONOMICA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_actividad_economica" id="cliente_actividad_economica" class="form-control">
						<option value="" selected>Seleccionar...</option>
						<?php foreach ($actividadEconomica as $key => $value): ?>
							<option value="<?php echo $value["acti_codigo"] ?>" <?php if($value["acti_codigo"] == $cliente[1]["cliente_actividad_economica"]){echo"selected";} ?>><?php echo "(".$value["acti_codigo"].") : ".utf8_encode($value["acti_descripcion"]) ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CORREO DE INTERCAMBIO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_correo_intercambio" id="cliente_correo_intercambio" value="<?php echo $cliente[1]["cliente_correo_intercambio"] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CORREO DE CONTACTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_correo_contacto" id="cliente_correo_contacto" value="<?php echo $cliente[1]["cliente_correo_contacto"] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">ESTADO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_estado" id="cliente_estado" class="form-control">
						<option value="">Seleccionar</option>
						<option value="1" <?php if($cliente[1]["cliente_estado"] == 1){echo"selected";}?> >ACTIVO</option>
						<option value="0" <?php if($cliente[1]["cliente_estado"] == 0){echo"selected";}?> >INACTIVO</option>
					</select>
				</div>
			</div>

		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-success mr5">EDITAR <i class="fa fa-pencil"></i></button>
					<button type="reset" class="btn btn-danger">CANCELAR <i class="fa fa-times"></i></button>
				</div>
			</div>
		</div>

	</div>

	<input type="hidden" name="cmd" value="editarCliente">
	<input type="hidden" id="cliente_provincia_id" name="cliente_provincia_id" value="<?php echo $cliente[1]["cliente_provincia_id"] ?>">
	<input type="hidden" id="cliente_id" name="cliente_id" value="<?php echo $cliente[1]["cliente_id"] ?>">
</form>

<script type="text/javascript">
	function getComunas(input)
	{
		var data = ({cmd : "getComunas", region_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.comuna.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				var comunas = '<option value="">Seleccionar...</option>';

				$.each(response,function(index,value){
					comunas += '<option value="'+value.provincia_id+'">'+value.provincia_glosa+'</option>';
				});

				$("#cliente_provincia").html(comunas);
			}
		});
	}

	function getCiudades(input)
	{
		$("#cliente_provincia_id").val($("#cliente_provincia option:selected").text());
		var data = ({cmd : "getCiudades", provincia_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.ciudad.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				var ciudades = '<option value="">Seleccionar...</option>';

				$.each(response,function(index,value){
					ciudades += '<option value="'+value.comuna_glosa+'">'+value.comuna_glosa+'</option>';
				});

				$("#cliente_comuna").html(ciudades);
			}
		});
	}

	$("#frmNuevoCliente").validate({
		rules : {
			cliente_razon_social : { required : true},
			cliente_rut : { required : true},
			cliente_dv : { required : true},
			cliente_direccion : { required : true},
			cliente_provincia : { required : true},
			cliente_comuna : { required : true},
			cliente_giro : { required : true},
			cliente_actividad_economica : { required : true},
			cliente_correo_contacto : { required : true},
			cliente_correo_intercambio : { required : true,email:true},
			cliente_estado : { required : true},
		},
		submitHandler : function ( form )
		{
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.cliente.php",
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
							window.location.href='?pagina=clientes&ori=ver';
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
	})
</script>