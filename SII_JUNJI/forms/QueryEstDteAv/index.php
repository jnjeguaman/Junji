<?php
extract($_GET);
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
$regionSession = $_SESSION["sii"]["usuario_region"];
$getClientes = getClientes();
$getDocumentos = getDocumentos();
$getEmpresa = getEmpresa($regionSession);
$detalleDTE = getDetalleDTE($id);
$rut = explode("-",$_SESSION["sii"]["usuario_rut"]);

if(isset($id) && $id <> "")
{
	$ruta = "../sistemas/archivos/SII/".$detalleDTE[1]["dte_ruta"].$detalleDTE[1]["dte_archivo"].".xml";
	$xml = file_get_contents($ruta);
	$xml_parse = simplexml_load_string($xml);
	// $rutReceptor = explode("-", (string)$xml_parse->SetDTE->DTE->Documento->Encabezado->Receptor->RUTRecep);
	$rutReceptor = explode("-", (string)$xml_parse->SetDTE->Caratula->RutReceptor);
}

?>

<?php if ($id <> "" && is_numeric($id)): ?>

	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
				<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
			</div>
			<h4 class="panel-title">CONSULTA AVANZADA</h4>
			<p>El objetivo de este servicio es entregar una herramienta que permita consultar por el estado de un DTE y corroborar los datos asociados a dicho DTE.</p>
			</div>

			<div class="panel-body">

			</div>
		</div>

		
		<form class="form-horizontal" id="frmConsulta">
			<div class="panel panel-dark">
				<div class="panel-heading">
					<div class="panel-btns">
						<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
						<a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">DETALLE DEL DOCUMENTO</h4>
					<p>
						Cliente : <?php echo (string)$xml_parse->SetDTE->DTE->Documento->Encabezado->Receptor->RznSocRecep ?>
						<br>Rut : <?php echo $detalleDTE[1]["cliente_rut"]."-".$detalleDTE[1]["cliente_dv"] ?>
						<br>Giro : <?php echo $detalleDTE[1]["cliente_giro"] ?>
						<br>Tipo de Documento : (<?php echo $detalleDTE[1]["dcto_codigo"] ?>) <?php echo $detalleDTE[1]["dcto_glosa"] ?>
						<br>Folio : <?php echo $detalleDTE[1]["dte_folio"] ?>
						<br>Fecha de Emision : <?php echo substr($detalleDTE[1]["dte_fecha"], 8,2)."-".substr($detalleDTE[1]["dte_fecha"], 5,2)."-".substr($detalleDTE[1]["dte_fecha"], 0,4) ?>
					</p>
				</div>

				<div class="panel-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="sii_tipo_dcto" id="sii_tipo_dcto" value="<?php echo $detalleDTE[1]["dte_dcto_id"] ?>" readonly>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">FOLIO <span class="asterisk">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="dcto_folio" id="dcto_folio" value="<?php echo $detalleDTE[1]["dte_folio"] ?>" readonly>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">FECHA EMISION <span class="asterisk">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="dcto_fecha_emision" id="dcto_fecha_emision" value="<?php echo $detalleDTE[1]["dte_fecha"] ?>" readonly>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">MONTO <span class="asterisk">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="dcto_monto" id="dcto_monto" value="<?php echo $detalleDTE[1]["dte_total"] ?>" readonly>
						</div>
					</div>
				</div>

				<div class="panel-footer">
					<div class="row">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="submit" class="btn btn-dark mr5">Consultar</button>
						</div>
					</div>
				</div>
			</div>

			<input type="hidden" name="command" value="QueryEstDteAv">
			<input type="hidden" name="rutEmisor" id="rutEmisor" value="<?php echo $getEmpresa[1]["empresa_rut"] ?>">
			<input type="hidden" name="dvEmisor" id="dvEmisor" value="<?php echo $getEmpresa[1]["empresa_dv"] ?>">
			<input type="hidden" name="receptor_rut" id="receptor_rut" value="<?php echo $rutReceptor[0] ?>">
			<input type="hidden" name="receptor_dv" id="receptor_dv" value="<?php echo $rutReceptor[1] ?>">
			<input type="hidden" name="ruta" value="<?php echo $detalleDTE[1]["dte_ruta"] ?>">
			<input type="hidden" name="archivo" value="<?php echo $detalleDTE[1]["dte_archivo"] ?>">
			<input type="hidden" name="consultante_rut" id="consultante_rut" value="<?php echo $rut[0] ?>">
			<input type="hidden" name="consultante_dv" id="consultante_dv" value="<?php echo $rut[1] ?>">
			<input type="hidden" name="tipo_dte" id="tipo_dte" value="<?php echo (string)$xml_parse->SetDTE->Caratula->SubTotDTE->TpoDTE ?>">

		</form>
	<?php else: ?>
		<div class="alert alert-danger">
			<strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again.
		</div>
	<?php endif ?>

	<script type="text/javascript">
		$("#frmConsulta").validate({
			rules : {
				receptor_id : { required : true},
				sii_tipo_dcto : { required : true},
				dcto_folio : { required : true},
				dcto_fecha_emision : { required : true},
				dcto_monto : { required : true}
			},
			submitHandler : function ( form ) {
				var data = $(form).serializeArray();
				$.ajax({
					type:"POST",
					url:"includes/functions.consulta.php",
					data:data,
					dataType:"JSON",
					beforeSend : function()
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
						// setTimeout(function(){
						// 	window.location.href='?pagina=factura&ori=ver';
						// },1500);
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
		});

		function getClienteDetalle(input)
		{
			var data = ({command : "getClienteDetalle", cliente_id : input});
			$.ajax({
				type:"POST",
				url:"includes/functions.cliente.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					console.log(response);
					$("#rutEmisor").val(response[1]["cliente_rut"]);
					$("#dvEmisor").val(response[1]["cliente_dv"]);
				}
			});
		}
	</script>