<?php 
$regionSession = $_SESSION["sii"]["usuario_region"];
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);

?>
<form class="form-horizontal" id="frmNueva">
	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<button class="btn btn-dark">Generar SET</button>
			</div>
		</div>
	</div>
	<input type="hidden" name="tipo_dcto" value="generaSET">
	<input type="hidden" name="usuario_region" id="usuario_region" value="<?php echo $regionSession ?>">
	<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
	<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
	<a href="includes/SET_DTE.xml" download id="download" hidden></a>
</form>


<script type="text/javascript">
	$("#frmNueva").validate({

		submitHandler : function ( form ){
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
							document.getElementById('download').click();
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
				complete : function()
				{
					unBlockUI();
				}
			});
		}
	})
</script>