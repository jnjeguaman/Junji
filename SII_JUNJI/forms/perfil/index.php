<?php
require_once("includes/functions.usuario.php");
$detalleUsuario = getDetalleUsuario(1);
?>

<?php if (count($detalleUsuario) == 1): ?>
	<form class="form-horizontal" id="frmUsuario">
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">MI PERFIL</h4>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">NOMBRE <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="usuario_nombre" id="usuario_nombre" value="<?php echo $detalleUsuario[1]["usuario_nombre"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">APELLIDO PATERNO<span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="usuario_apellido_paterno" id="usuario_apellido_paterno" value="<?php echo $detalleUsuario[1]["usuario_apellido_paterno"] ?>">
					</div>
				</div>

								<div class="form-group">
					<label class="col-sm-3 control-label">APELLIDO MATERNO<span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="usuario_apellido_materno" id="usuario_apellido_materno" value="<?php echo $detalleUsuario[1]["usuario_apellido_materno"] ?>">
					</div>
				</div>


				<div class="form-group">
					<label class="col-sm-3 control-label">CONTRASEÑA <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="password" class="form-control" name="usuario_password" id="usuario_password">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">NUEVA CONTRASEÑA <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="password" class="form-control" name="usuario_password2" id="usuario_password2">
					</div>
				</div>

			</div>

		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">Actualizar</button>
				</div>
			</div>
		</div>


		<input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $detalleUsuario[1]["usuario_id"] ?>">
		<input type="hidden" name="cmd" id="cmd" value="actualizarUsuario">
	</form>
<?php else: ?>
	<div class="alert alert-danger" role="alert">
		USUARIO NO EXISTE
	</div>
<?php endif ?>

<script type="text/javascript">
	$("#frmUsuario").validate({
		rules : {
			usuario_nombre : {required:true},
			usuario_apellido : {required:true}
		},
		submitHandler : function ( form ){
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.usuario.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					if(response.Respuesta)
					{
						if(response.Mensaje == "Password") {
							jQuery.gritter.add({
								title: 'Exito!',
								text: 'Información actualizada con exito!',
								class_name: 'growl-success',
								// image: 'images/logo.png',
								sticky: false,
								time: ''
							});

							setTimeout(function(){
								window.location.href='salir.php';
							},1500);
						}else{
							jQuery.gritter.add({
								title: 'Exito!',
								text: response.Mensaje,
								class_name: 'growl-success',
								// image: 'images/logo.png',
								sticky: false,
								time: ''
							});
						}
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