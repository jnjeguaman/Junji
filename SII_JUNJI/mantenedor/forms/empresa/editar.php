<?php
extract($_GET);
require_once("includes/functions.empresa.php");
require_once("includes/functions.actividad_economica.php");
require_once("includes/functions.region.php");
$detalleEmpresa = getEmpresa($id);
$actividadEconomica = getActividadEconomica();
$regiones2 = getRegiones2();
?>
<?php if (count($detalleEmpresa) == 1): ?>
	<form class="form-horizontal" id="frmEmpresa">
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">DETALLE EMPRESA : <?php echo $detalleEmpresa[1]["empresa_glosa"] ?></h4>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">RAZÓN SOCIAL <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_glosa" id="empresa_glosa" value="<?php echo $detalleEmpresa[1]["empresa_glosa"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">RUT <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_rut" id="empresa_rut" value="<?php echo $detalleEmpresa[1]["empresa_rut"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">DV <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_dv" id="empresa_dv" value="<?php echo $detalleEmpresa[1]["empresa_dv"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_giro" id="empresa_giro" value="<?php echo $detalleEmpresa[1]["empresa_giro"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">TELÉFONO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_telefono" id="empresa_telefono" value="<?php echo $detalleEmpresa[1]["empresa_telefono"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">CORREO CONTACTO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_correo" id="empresa_correo" value="<?php echo $detalleEmpresa[1]["empresa_correo"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">DIRECCÓN <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_direccion" id="empresa_direccion" value="<?php echo $detalleEmpresa[1]["empresa_direccion"] ?>">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_comuna" id="empresa_comuna" value="<?php echo $detalleEmpresa[1]["empresa_comuna"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">CIUDAD <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_ciudad" id="empresa_ciudad" value="<?php echo $detalleEmpresa[1]["empresa_ciudad"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">FECHA RESOLUCIÓN <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_fecha" id="empresa_fecha" value="<?php echo $detalleEmpresa[1]["empresa_fecha"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">N° RESOLUCIÓN <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_resolucion" id="empresa_resolucion" value="<?php echo $detalleEmpresa[1]["empresa_resolucion"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">ACTIVIDAD ECONÓMICA <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select name="empresa_acteco" id="empresa_acteco" class="form-control select2">
							<option value="" selected>Seleccionar...</option>
							<?php foreach ($actividadEconomica as $key => $value): ?>
								<option value="<?php echo $value["acti_codigo"] ?>" <?php if($value["acti_codigo"] == $detalleEmpresa[1]["empresa_acteco"]){echo"selected";} ?>><?php echo "(".$value["acti_codigo"].") : ".utf8_encode($value["acti_descripcion"]) ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">CODIGO SUCURSAL S.I.I. <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="empresa_sucursal" id="empresa_sucursal" value="<?php echo $detalleEmpresa[1]["empresa_sucursal"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">CENTRO DE COSTO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select class="form-control" name="empresa_region" id="empresa_region">
							<option value="">Seleccionar...</option>
							<?php foreach ($regiones2 as $key => $value): ?>
								<option value="<?php echo $value["codigo"] ?>" <?php if($value["codigo"] == $detalleEmpresa[1]["empresa_region"]){echo"selected";} ?> ><?php echo $value["nombre"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>


			</div>

		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5"><i class="fa fa-refresh fa-spin"></i> Actualizar</button>
					<a href="?pagina=empresa" class="btn btn-danger"><i class="fa fa-list"></i> Listado </a>
				</div>
			</div>
		</div>


		<input type="hidden" name="empresa_id" id="empresa_id" value="<?php echo $detalleEmpresa[1]["empresa_id"] ?>">
		<input type="hidden" name="cmd" id="cmd" value="actualizarEmpresa">
	</form>
<?php else: ?>
	<div class="alert alert-danger" role="alert">
		LA EMPRESA SELECCIONADA NO EXISTE!
	</div>
<?php endif ?>

<script type="text/javascript">
	$("#frmEmpresa").validate({
		rules : {
			usuario_nombre : {required:true},
			usuario_apellido : {required:true}
		},
		submitHandler : function ( form ){
			var data = $(form).serializeArray();
			console.log(data);
			$.ajax({
				type:"POST",
				url:"includes/functions.empresa.php",
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
								window.location.reload();
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
	})
</script>