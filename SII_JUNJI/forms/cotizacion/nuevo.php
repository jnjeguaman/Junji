<?php
require_once("includes/functions.cliente.php");
$getClientes = getClientes();
?>

<div class="panel panel-dark">
	<div class="panel-heading">
		<div class="panel-btns">
			<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
		</div><!-- panel-btns -->
		<h4 class="panel-title">SELECCION DE CLIENTE</h4>
		<p>Seleccione el cliente al cual se le desea realizar la cotización</p>
	</div><!-- panel-heading -->
	<div class="panel-body">

		<form class="form-horizontal" id="frmCotizacion">
			<div class="form-group">
				<label class="col-sm-3 control-label">SELECCIONAR CLIENTE <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="cliente_id" id="cliente_id">
						<option value="">Seleccionar...</option>
						<?php foreach ($getClientes as $key => $value): ?>
							<option value="<?php echo $value["cliente_id"] ?>"><?php echo $value["cliente_empresa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<input type="hidden" name="cmd" value="crearCotizacion">

			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button type="submit" class="btn btn-sm btn-dark">CREAR</button>
				</div>
				<input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$("#frmCotizacion").validate({
		rules : {
			cliente_id : { required : true}
		},
		submitHandler : function (form)
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
							window.location.href='?pagina=cotizacion&action=nuevo&id='+response.id;
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