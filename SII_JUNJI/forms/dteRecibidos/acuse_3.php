<?php
require_once("includes/functions.recibo.php");
require_once("includes/functions.empresa.php");
require_once("includes/functions.recinto.php");
$regionSession = $_SESSION["sii"]["usuario_region"];
$recibo = getDetalleArchivo3($_GET["folio"]);
$empresa = getEmpresa($regionSession);
$contador = 1;
if($regionSession == 14)
{
	$region = 16;
}else{
	$region = $regionSession;
}
$nombre = $_SESSION["sii"]["usuario_nombre"]." ".$_SESSION["sii"]["usuario_apellido_paterno"]." ".$_SESSION["sii"]["usuario_apellido_materno"];
$recintos = getRecintos($region);
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
?>
<div class="alert alert-warning" role="alert" style="text-align: center;">
	<strong>Acuse de Recibo de Mercaderias (Ley 19.983)</strong><br>
	En este sector puede dar el acuse de recibo de la ley 19.983, siempre y cuando haya 
	enviado respuesta comercial Aceptando o Aceptando con reparos el documento recibido.
</div>
<form class="form-horizontal" id="frmAcuse" method="POST">
	<?php foreach ($recibo as $key => $value): ?>
		<input type="hidden" name="recibido_id[<?php echo $contador ?>]" value="<?php echo $value["recibido_id"] ?>">
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">DAR RESPUESTA COMERCIAL A DOCUMENTO RECIBIDO</h4>
				<p>Tipo de Documento : <?php echo $value["recibido_tipo_dcto"] ?>. Folio N° : <?php echo $value["recibido_folio"] ?></p>
				<p>Receptor : <?php echo $value["recibido_cliente"] ?>. RUT : <?php echo $value["recibido_rut2"]."-".$value["recibido_dv2"] ?></p>
				<p>Duplicidad : <?php echo ($duplicidadDTE > 1) ? '<i class="fa fa-ban"></i>' : '<i class="fa fa-check"></i>' ?></p>
				<p>Rut Receptor : <?php echo ($value["recibido_rut2"] <> $empresa[1]["empresa_rut"] && $value["recibido_dv2"] <> $empresa[1]["empresa_dv"]) ? '<i class="fa fa-ban"></i>' : '<i class="fa fa-check"></i>' ?></p>
			</div>
			<div class="panel-body">
				<!-- CONTENIDO -->

				<div class="form-group">
					<label class="col-sm-3 control-label">NOMBRE <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input class="form-control" name="recibido_nombre[<?php echo $contador ?>]" id="recibido_nombre" value="<?php echo $nombre ?>"> 
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">TELEFONO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input class="form-control" name="recibido_telefono[<?php echo $contador ?>]" id="recibido_telefono"> 
					</div>
				</div>	

				<div class="form-group">
					<label class="col-sm-3 control-label">CORREO CONTACTO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input class="form-control" name="recibido_correo[<?php echo $contador ?>]" id="recibido_correo"> 
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">RECINTO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select class="form-control" name="recibido_recinto[<?php echo $contador ?>]" id="recibido_recinto" required> 
							<option value="">Seleccionar...</option>
							<?php foreach ($recintos as $key => $value): ?>
								<option value="<?php echo utf8_encode($value["recinto_glosa"]) ?>"><?php echo utf8_encode($value["recinto_glosa"]) ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<input type="hidden" name="tipo_dcto" value="acuse_3">
				<input type="hidden" name="acuse_tipo" value="3">
				
			</div>
		</div>
		<?php $contador++ ?>
	<?php endforeach ?>

	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<button class="btn btn-primary mr5">Enviar</button>
				<!-- <input type="hidden" name="recibido_id" value="<?php echo $_GET["id"] ?>"> -->
				<input type="hidden" name="cmd" value="generarDTE">
			</div>
		</div>
	</div>
	<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
	<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">

	<input type="hidden" name="empresa_rut" value="<?php echo $empresa[1]["empresa_rut"] ?>">
	<input type="hidden" name="empresa_dv" value="<?php echo $empresa[1]["empresa_dv"] ?>">

	<input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">
	<input type="hidden" name="folioInterno" id="folioInterno" value="<?php echo $folio ?>">
</form>


<script type="text/javascript">
	$("#frmAcuse").validate({
		rules : {
			recibido_estado : { required : true},
			recibido_comentario : { required : true}
		},
		submitHandler : function( form )
		{
			var data = $(form).serializeArray();

			$.ajax({
				type:"POST",
				url:"includes/functions.generardte.php",
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
							window.location.href='?pagina=dteRecibidos&ori=ver';
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
				complete : function(){
					unBlockUI();
				}
			});

		}
	});
</script>