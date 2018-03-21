<?php
extract($_POST);
$getClientes = getClientes();
$getDocumentos = getDocumentos();
$tipoDocumento = "";
foreach ($getDocumentos as $key => $value) {
	$tipoDocumento[$value["dcto_codigo"]] = $value["dcto_glosa"];
}
if(isset($cmd) && $cmd == "archivoXML")
{
	$extension = strtoupper(pathinfo($_FILES["archivo"]["name"],PATHINFO_EXTENSION));
	if($extension == "XML")
	{
		try {
			$informacion = array();
			$archivoXML = file_get_contents($_FILES["archivo"]["tmp_name"]);
			$contenido = simplexml_load_string($archivoXML);

			if(count($contenido->SetDTE->DTE) > 0)
			{	
				$TipoDTE = intval($contenido->SetDTE->DTE->Documento->Encabezado->IdDoc->TipoDTE);
				if($TipoDTE == 33 || $TipoDTE == 34 || $TipoDTE == 54 || $TipoDTE == 61)
				{

					$RUTEmisor = explode("-",$contenido->SetDTE->DTE->Documento->Encabezado->Emisor->RUTEmisor);
					$informacion = array(
						"iecv_tipo_dcto" => intval($contenido->SetDTE->DTE->Documento->Encabezado->IdDoc->TipoDTE),
						"iecv_folio" => intval($contenido->SetDTE->DTE->Documento->Encabezado->IdDoc->Folio),
						"iecv_rut" => $RUTEmisor[0],
						"iecv_dv" => $RUTEmisor[1],
						"iecv_cliente" => (string)$contenido->SetDTE->DTE->Documento->Encabezado->Emisor->RznSoc,
						"iecv_iva" => intval($contenido->SetDTE->DTE->Documento->Encabezado->Totales->IVA),
						"iecv_neto" => intval($contenido->SetDTE->DTE->Documento->Encabezado->Totales->MntNeto),
						"iecv_total" => intval($contenido->SetDTE->DTE->Documento->Encabezado->Totales->MntTotal),
						"iecv_exento" => intval($contenido->SetDTE->DTE->Documento->Encabezado->Totales->MntExe),
						"iecv_femision" => (string)$contenido->SetDTE->DTE->Documento->Encabezado->IdDoc->FchEmis,
						"iecv_direccion" => (string)$contenido->SetDTE->DTE->Documento->Encabezado->Emisor->DirOrigen,
						"iecv_ciudad" => (string)$contenido->SetDTE->DTE->Documento->Encabezado->Emisor->CiudadOrigen,
						"iecv_comuna" => (string)$contenido->SetDTE->DTE->Documento->Encabezado->Emisor->CmnaOrigen,
						"iecv_giro" => (string)$contenido->SetDTE->DTE->Documento->Encabezado->Emisor->GiroEmis,
						);
				}else{
					echo '
					<div class="alert alert-danger">
						<strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again. Tipo DTE INcorrecto
					</div>
					';
				}
			}else if(count($contenido->Documento) > 0)
			{
				$TipoDTE = intval($contenido->Documento->Encabezado->IdDoc->TipoDTE);
				if($TipoDTE == 33 || $TipoDTE == 34 || $TipoDTE == 54 || $TipoDTE == 61)
				{
					
					$RUTEmisor = explode("-",$contenido->Documento->Encabezado->Emisor->RUTEmisor);
					$informacion = array(
						"iecv_tipo_dcto" => intval($contenido->Documento->Encabezado->IdDoc->TipoDTE),
						"iecv_folio" => intval($contenido->Documento->Encabezado->IdDoc->Folio),
						"iecv_rut" => $RUTEmisor[0],
						"iecv_dv" => $RUTEmisor[1],
						"iecv_cliente" => (string)$contenido->Documento->Encabezado->Emisor->RznSoc,
						"iecv_iva" => intval($contenido->Documento->Encabezado->Totales->IVA),
						"iecv_neto" => intval($contenido->Documento->Encabezado->Totales->MntNeto),
						"iecv_total" => intval($contenido->Documento->Encabezado->Totales->MntTotal),
						"iecv_exento" => intval($contenido->Documento->Encabezado->Totales->MntExe),
						"iecv_femision" => (string)$contenido->Documento->Encabezado->IdDoc->FchEmis,
						"iecv_direccion" => (string)$contenido->Documento->Encabezado->Emisor->DirOrigen,
						"iecv_ciudad" => (string)$contenido->Documento->Encabezado->Emisor->CiudadOrigen,
						"iecv_comuna" => (string)$contenido->Documento->Encabezado->Emisor->CmnaOrigen,
						"iecv_giro" => (string)$contenido->Documento->Encabezado->Emisor->GiroEmis,
						);
				}else{
					echo '
					<div class="alert alert-danger">
						<strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again. Tipo DTE INcorrecto
					</div>
					';
				}
			}else{
				echo '
				<div class="alert alert-danger">
					<strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again.
				</div>
				';
			}
		} catch (Exception $e) {
			echo "Ha ocurrido un error : ".$e->getMessage();
		}
	}
}
?>
<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="post" enctype="multipart/form-data">
	<div class="panel panel-dark">
		<div class="panel-heading">
			<div class="panel-btns">
				<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>

			</div>
			<h4 class="panel-title">PREVISUALIZAR XML</h4>

		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">Archivo XML <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="file" name="archivo" id="archivo" class="form-control">
				</div>
			</div>


			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">CARGAR</button>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="cmd" value="archivoXML">
</form>

<form id="frmIECV" class="form-horizontal">
	<div class="row">
		<div class="col-md-8">
			<!-- INFORMACION DEL CLIENTE !-->
			<div class="panel panel-dark">
				<div class="panel-heading">
					<div class="panel-btns">
						<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>

					</div>
					<h4 class="panel-title">INFORMACION DEL CLIENTE</h4>
					<p>Tipo de Documento : (<?php echo $TipoDTE ?>) <?php echo $tipoDocumento[$TipoDTE] ?>
						<br>Folio : <?php echo $informacion["iecv_folio"] ?>
						<br>Emitida el : <?php echo substr($informacion["iecv_femision"], 8,2)."-".substr($informacion["iecv_femision"], 5,2)."-".substr($informacion["iecv_femision"], 0,4) ?>
						<p></p>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label class="col-sm-3 control-label">RAZÓN SOCIAL <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_cliente" id="iecv_cliente" readonly="1" value="<?php echo $informacion["iecv_cliente"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">RUT</label>
							<div class="col-sm-3">
								<input type="text" class="form-control" name="iecv_rut" id="iecv_rut" readonly="1" value="<?php echo $informacion["iecv_rut"] ?>">
							</div>

							<div class="col-sm-1">
								<input type="text" class="form-control" name="iecv_dv" id="iecv_dv" readonly="1" value="<?php echo $informacion["iecv_dv"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_direccion" id="iecv_direccion" readonly="1" value="<?php echo $informacion["iecv_direccion"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">CIUDAD <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_ciudad" id="iecv_ciudad" readonly="1" value="<?php echo $informacion["iecv_ciudad"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_comuna" id="iecv_comuna" readonly="1" value="<?php echo $informacion["iecv_comuna"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_giro" id="iecv_giro" readonly="1" value="<?php echo $informacion["iecv_giro"] ?>">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel panel-dark">
					<div class="panel-heading">
						<div class="panel-btns">
							<a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a>
						</div>
						<h4 class="panel-title">TOTALES</h4>
					</div>
					<div class="panel-body">

						<div class="form-group">
							<label class="col-sm-3 control-label">NETO <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_neto" id="iecv_neto" readonly="1" value="<?php echo $informacion["iecv_neto"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">IVA <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_iva" id="iecv_iva" readonly="1" value="<?php echo $informacion["iecv_iva"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">EXENTO <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_exento" id="iecv_exento" readonly="1" value="<?php echo $informacion["iecv_exento"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">TOTAL <span class="asterisk">*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="iecv_total" id="iecv_total" readonly="1" value="<?php echo $informacion["iecv_total"] ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">CARGAR</button>
				</div>
			</div>
		</div>
		<input type="hidden" name="iecv_tipo_dcto" value="<?php echo $informacion["iecv_tipo_dcto"] ?>">
		<input type="hidden" name="iecv_femision" value="<?php echo $informacion["iecv_femision"] ?>">
		<input type="hidden" name="iecv_folio" value="<?php echo $informacion["iecv_folio"] ?>">
		<input type="hidden" name="cmd" value="cargarXML">
	</form>

	<script type="text/javascript">
		
		$("#frmIECV").validate({
			rules : {
				iecv_cliente_id : { required : true},
			},
			submitHandler : function ( form )
			{
				var data = $(form).serializeArray();
				
				$.ajax({
					type:"POST",
					url:"includes/functions.iecvcompra.php",
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
		})

	</script>