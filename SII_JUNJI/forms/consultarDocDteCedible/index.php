<?php
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
$clientes = getClientesGlobal();
$getDocumentos = getDocumentos();

$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);

?>

<?php if (isset($_GET["recibido_id"]) && $_GET["recibido_id"] <> ""): ?>
	1
<?php else: ?>
	<form class="form-horizontal" id="frmCesionElectronica">
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">CONSULTA CESIÓN ELECTRÓNICA</h4>

			</div>

			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">PROVEEDOR <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select name="cesion_cliente" id="cesion_cliente" class="form-control" onChange="dividirRut(this.value)">
							<option value="" selected>Seleccionar...</option>
							<?php foreach ($clientes as $key => $value): ?>
								<option value="<?php echo $value["cliente_rut"]."-".$value["cliente_dv"] ?>"><?php echo utf8_encode($value["cliente_empresa"]) ?></option>
							<?php endforeach ?>
						</select> 
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select class="form-control" name="cesion_tipoDTE" id="cesion_tipoDTE">
							<option value="">Seleccionar...</option>
							<?php foreach ($getDocumentos as $key => $value): ?>
								<?php if ($value["dcto_codigo"] == 33 || $value["dcto_codigo"] == 34 || $value["dcto_codigo"] == 43): ?>
									<option value="<?php echo $value["dcto_codigo"] ?>"><?php echo $value["dcto_glosa"] ?></option>
								<?php endif ?>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">FOLIO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="cesion_folio" id="cesion_folio" class="form-control">
					</div>
				</div>




			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
						<button class="btn btn-dark mr5">CONSULTAR</button>
						<input type="hidden" name="cesion_rut" id="cesion_rut">
						<input type="hidden" name="cesion_dv" id="cesion_dv">
						<input type="hidden" name="cmd" value="consultarDocDteCedible">
						<input type="hidden" name="emisor_rut" value="<?php echo $rut[0] ?>">
						<input type="hidden" name="emisor_dv" value="<?php echo $rut[1] ?>">

					</div>
				</div>
			</div>
		</div>
	</form>
<?php endif ?>

<script type="text/javascript">
	function dividirRut(input)
	{
		var rut = input.split("-");
		$("#cesion_rut").val(rut[0]);
		$("#cesion_dv").val(rut[1]);
	}

	$("#frmCesionElectronica").validate({
		rules : {
			cesion_cliente : {required:true},
			cesion_tipoDTE : {required:true},
			cesion_folio : {required:true}
		},
		submitHandler : function(form)
		{
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.dtews.php",
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

	})
</script>