<?php
require_once("includes/functions.recibo.php");
require_once("includes/functions.empresa.php");
$recibo = getDetalleRecibo($_GET["folio"]);
$regionSession = $_SESSION["sii"]["usuario_region"];
$empresa = getEmpresa($regionSession);
$empresa_rut = $empresa[1]["empresa_rut"];
$empresa_dv = $empresa[1]["empresa_dv"];
$nombre = $_SESSION["sii"]["usuario_nombre"]." ".$_SESSION["sii"]["usuario_apellido_paterno"]." ".$_SESSION["sii"]["usuario_apellido_materno"];
$estados = array(
	"DOK" => "Documento Recibido por el SII. DatosCoinciden con los Registrados.",
	"DNK" => "Documento Recibido por el SII pero Datos NO Coinciden con los registrados.",
	"FAU" => "Documento No Recibido por el SII.",
	"FNA" => "Documento No Autorizado.",
	"FAN" => "Documento Anulado.",
	"EMP" => "Empresa no autorizada a Emitir DocumentosTributarios Electrónicos.",
	"TMD" => "Existe Nota de Debito que Modifica TextoDocumento.",
	"TMC" => "Existe Nota de Crédito que Modifica TextosDocumento.",
	"MMD" => "Existe Nota de Debito que Modifica MontosDocumento.",
	"MMC" => "Existe Nota de Crédito que Modifica MontosDocumento.",
	"AND" => "Existe Nota de Debito que Anula Documento.",
	"ANC" => "Existe Nota de Crédito que Anula Documento."
	);

$glosaEnvio = array(
	0 => "Envío Recibido Conforme",
	1 => "Envío Rechazado - Error de Schema",
	2 => "Envío Rechazado - Error de Firma",
	3 => "Envío Rechazado - RUT Receptor No Corresponde",
	90 => "Envío Rechazado - Archivo Repetido",
	91 => "Envío Rechazado - Archivo Ilegible",
	99 => "Envío Rechazado - Otros");

$glosaDocumento = array(
	0 => "DTE Recibido OK",
	1 => "DTE No Recibido - Error de Firma",
	2 => "DTE No Recibido - Error en RUT Emisor",
	3 => "DTE No Recibido - Error en RUT Receptor",
	4 => "DTE No Recibido - DTE Repetido",
	99 => "DTE No Recibido - Otros");

$contador = 1;
$duplicidadRecibido = verificaDuplicidad($recibo[1]["recibido_tipo_dcto"],$recibo[1]["recibido_folio"],$recibo[1]["recibido_rut"],$recibo[1]["recibido_dv"],$recibo[1]["recibido_archivo"]);
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);
?>
<div class="alert alert-warning" role="alert" style="text-align: center;">
	<i class="fa fa-warning fa-4x"></i><br>
	Recuerde que de acuerdo a la nueva Ley N° 20.727, publicada en el Diario Oficial el 31 de enero de 2014, el uso del Crédito Fiscal estará condicionado a dar el Acuse de recibo de la Ley N° 19.983, desde el 31 de julio de 2014.
</div>
<form class="form-horizontal" id="frmAcuse" method="POST">

	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">DAR RESPUESTA A RECEPCIÓN DE ENVÍO</h4>
		</div>
		<div class="panel-body">
			<!-- CONTENIDO -->
			<?php if ($duplicidadRecibido > 1): ?>
				<div class="alert alert-warning">
					<i class="fa fa-warning fa-2x"></i> ATENCIÓN!. La información que está ingresado esta repetida.
				</div>
			<?php endif ?>
			<div class="form-group">
				<label class="col-sm-3 control-label">RECEPCION ENVÍO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="recibido_EstadoRecepEnv" id="recibido_EstadoRecepEnv" required> 
						<option value="">Seleccionar...</option>
						<?php foreach ($glosaEnvio as $key => $value): ?>
							<option value="<?php echo $key ?>"><?php echo $value ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">NOMBRE <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input class="form-control" name="recibido_nombre" id="recibido_nombre" value="<?php echo $nombre ?>"> 
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">TELEFONO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input class="form-control" name="recibido_telefono" id="recibido_telefono"> 
				</div>
			</div>	

			<div class="form-group">
				<label class="col-sm-3 control-label">CORREO ELECTRONICO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input class="form-control" name="recibido_correo" id="recibido_correo"> 
				</div>
			</div>

			<div class="form-group rechazo">
				<label class="col-sm-3 control-label">COMENTARIO O MOTIVO DE DISCREPANCIA O RECHAZO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<textarea name="recibido_comentario" id="recibido_comentario" cols="30" rows="10" class="form-control" required></textarea>
				</div>
			</div>

		</div>
	</div>

	<?php foreach ($recibo as $key => $value): ?>
		<input type="hidden" name="recibido_id2[<?php echo $contador ?>]" value="<?php echo $value["recibido_id"] ?>">
		<?php $duplicidadDTE = verificaDuplicidadDTE($value["recibido_tipo_dcto"],$value["recibido_folio"],$value["recibido_digest"],$value["recibido_dteid"]); ?>
		<?php $verificaFirma = verificaFirma($value["recibido_ruta"],$value["recibido_archivo"]); ?>
		<!-- <pre> -->
		<!-- <?php  print_r($recibo[$contador]) ?> -->
		<!-- </pre> -->
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">DAR RESPUESTA COMERCIAL A DOCUMENTO RECIBIDO</h4>
				<p>Tipo de Documento : <?php echo $value["recibido_tipo_dcto"] ?>. Folio N° : <?php echo $value["recibido_folio"] ?></p>
				<p>Receptor : <?php echo $value["recibido_cliente"] ?>. RUT : <?php echo $value["recibido_rut2"]."-".$value["recibido_dv2"] ?></p>
				<p>Duplicidad : <?php echo ($duplicidadDTE > 1) ? '<i class="fa fa-ban"></i>' : '<i class="fa fa-check"></i>' ?></p>
				<p>Rut Receptor : <?php echo ($value["recibido_rut2"] <> $empresa_rut && $value["recibido_dv2"] <> $empresa_dv) ? '<i class="fa fa-ban"></i>' : '<i class="fa fa-check"></i>' ?></p>
				<!-- <p>Firma : <?php echo ($verificaFirma) ? '<i class="fa fa-check"></i>' : '<i class="fa fa-ban"></i>' ?></p> -->
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-3 control-label">RECEPCION DTE <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select class="form-control" name="recibido_EstadoRecepDTE[<?php echo $contador ?>]" id="recibido_EstadoRecepDTE" required> 
							<option value="">Seleccionar...</option>
							<?php foreach ($glosaDocumento as $key => $value): ?>
								<option value="<?php echo $key ?>"><?php echo $value ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<input type="hidden" name="tipo_dcto" value="acuse_1">
				<input type="hidden" name="acuse_tipo" value="1">
			</div>
		</div>
		<?php $contador++ ?>
	<?php endforeach ?>


	<div class="panel-footer">
		<div class="row">
			<div class="col-sm-9 col-sm-offset-3">
				<button class="btn btn-primary mr5">Enviar</button>
				<input type="hidden" name="recibido_id" value="<?php echo $_GET["id"] ?>">
				<input type="hidden" name="cmd" value="generarDTE">
				<input type="hidden" name="totalElementos" value="<?php echo count($recibo) ?>">
				<input type="hidden" name="folioInterno" value="<?php echo $_GET["folio"] ?>">
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">
<input type="hidden" name="empresa_emisor_rut" value="<?php echo $recibo[1]["recibido_emisor_rut"] ?>">
<input type="hidden" name="empresa_emisor_dv" value="<?php echo $recibo[1]["recibido_emisor_dv"] ?>">
<input type="hidden" name="emisor_region" value="<?php echo $_SESSION["sii"]["usuario_region"] ?>">
</form>


<script type="text/javascript">
	$(".rechazo").hide();
	$(".estado2").hide();

	function check(input)
	{
		if(input == 1 || input == 2)
		{
			$(".estado2").show("slow");
		}else{
			// $(".rechazo").hide("slow");
			$(".estado2").hide("slow");
		}
	}

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