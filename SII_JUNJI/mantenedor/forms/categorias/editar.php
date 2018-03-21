<?php
extract($_GET);
$categoria = getDetalleCategoria($id);
?>
<form id="frmCategoria" class="form-horizontal">
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">AGREGAR CATEGORIAS</h4>
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-3 control-label">CATEGORIA <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="categoria_glosa" id="categoria_glosa" class="form-control" value="<?php echo $categoria[1]["categoria_glosa"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">ESTADO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select name="categoria_estado" id="categoria_estado" class="form-control">
							<option value="" selected>Seleccionar...</option>
							<option value="1" <?php if($categoria[1]["categoria_estado"] == 1){echo"selected";} ?> >ACTIVO</option>
							<option value="0" <?php if($categoria[1]["categoria_estado"] == 0){echo"selected";} ?> >INACTIVO</option>
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
		<input type="hidden" name="cmd" value="editarCategoria">
		<input type="hidden" name="categoria_id" value="<?php echo $categoria[1]["categoria_id"] ?>">
	</form>


	<script type="text/javascript">
		$("#frmCategoria").validate({
			rules : {
				categoria_nombre : { required : true},
				categoria_estado : { required : true}
			},
			submitHandler : function ( form )
			{
				var data = $(form).serializeArray();
				console.log(data);
				$.ajax({
					type:"POST",
					url:"includes/functions.categoria.php",
					data:data,
					dataType:"JSON",
					success : function ( response ) {
						console.log(response);
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
								window.location.href='?pagina=categorias&ori=ver';
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