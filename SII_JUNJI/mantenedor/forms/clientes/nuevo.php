<?php
extract($_POST);
$documento = getDocumentos();
$regiones = getRegiones();
$actividadEconomica = getActividadEconomica();
if(isset($cmd) && $cmd == "importarXML")
{
	// COMPROBAMOS LA EXTENSION DEL ARCHIVO ENVIADO
	$extension = strtoupper(pathinfo($_FILES["archivoXML"]["name"],PATHINFO_EXTENSION));
	if($extension === "XML")
	{
		// IMPORTAMOS EL CONTENIDO DEL XML
		$archivoXML = file_get_contents($_FILES["archivoXML"]["tmp_name"]);
		//PARSEAMOS EL CONTENIDO XML A UN ARREGLO
		try {


		$DTE = new SimpleXMLElement($archivoXML);
		if(count($DTE->SetDTE) > 0)
		{
			$RUTEmisor = explode("-", strtoupper($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->RUTEmisor));
			$RznSoc = ($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->RznSoc <> '') ? strtoupper($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->RznSoc) : '';
			$GiroEmis = ($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->GiroEmis <> '') ? strtoupper($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->GiroEmis) : '';
			$Acteco = ($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->Acteco <> '') ? strtoupper($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->Acteco) : '';
			$DirOrigen = ($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->DirOrigen <> '') ? strtoupper($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->DirOrigen) : '';
			$CmnaOrigen = ($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->CmnaOrigen <> '') ? strtoupper($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->CmnaOrigen) : '';
			$CiudadOrigen = ($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->CiudadOrigen <> '') ? strtoupper($DTE->SetDTE->DTE->Documento->Encabezado->Emisor->CiudadOrigen) : '';
		}else if(count($DTE->Documento) > 0)
		{
			$RUTEmisor = explode("-", strtoupper($DTE->Documento->Encabezado->Emisor->RUTEmisor));
			$RznSoc =       ($DTE->Documento->Encabezado->Emisor->RznSoc <> '') ? strtoupper($DTE->Documento->Encabezado->Emisor->RznSoc) : '';
			$GiroEmis =     ($DTE->Documento->Encabezado->Emisor->GiroEmis <> '') ? strtoupper($DTE->Documento->Encabezado->Emisor->GiroEmis) : '';
			$Acteco =       ($DTE->Documento->Encabezado->Emisor->Acteco <> '') ? strtoupper($DTE->Documento->Encabezado->Emisor->Acteco) : '';
			$DirOrigen =    ($DTE->Documento->Encabezado->Emisor->DirOrigen <> '') ? strtoupper($DTE->Documento->Encabezado->Emisor->DirOrigen) : '';
			$CmnaOrigen =   ($DTE->Documento->Encabezado->Emisor->CmnaOrigen <> '') ? strtoupper($DTE->Documento->Encabezado->Emisor->CmnaOrigen) : '';
			$CiudadOrigen = ($DTE->Documento->Encabezado->Emisor->CiudadOrigen <> '') ? strtoupper($DTE->Documento->Encabezado->Emisor->CiudadOrigen) : '';
		}else{
			echo '
			<div class="alert alert-danger">
				<strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again.
			</div>
			';
		}

	} catch (Exception $e) {
		echo '
		<div class="alert alert-danger">
			<strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again. '.$e->getMessage().'
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
}

if(isset($cmd) && $cmd == "importarEXCEL")
{
	require_once('includes/Classes/PHPExcel.php');
	require_once('includes/Classes/PHPExcel/Reader/Excel5.php');

	// Cargando la hoja de cálculo
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load($_FILES["archivoEXCEL"]["tmp_name"]);
	$objPHPExcel->setActiveSheetIndex(0);

	// OBTENEMOS EL N° DE FILAS DEL EXCEL, INCLUYENDO ENCABEZADO
	$highestRow =  $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

	// RECORREMOS EL EXCEL DESDE LA POSICION 2 (NOS SALTAMOS EL ENCABEZADO)
	for ($i = 2; $i <= $highestRow; $i++) {
		$_DATOS_EXCEL[$i]['a2'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue(); // cliente_empresa
		$_DATOS_EXCEL[$i]['a3'] = $objPHPExcel-> getActiveSheet()->getCell('C' . $i)->getCalculatedValue(); // cliente_rut
		$_DATOS_EXCEL[$i]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue(); // cliente_dv
		$_DATOS_EXCEL[$i]['a5'] = $objPHPExcel-> getActiveSheet()->getCell('E' . $i)->getCalculatedValue(); // cliente_direccion
		$_DATOS_EXCEL[$i]['a6'] = $objPHPExcel-> getActiveSheet()->getCell('F' . $i)->getCalculatedValue(); // cliente_provincia_id
		$_DATOS_EXCEL[$i]['a7'] = $objPHPExcel-> getActiveSheet()->getCell('G' . $i)->getCalculatedValue(); // cliente_comuna_id
		$_DATOS_EXCEL[$i]['a8'] = $objPHPExcel-> getActiveSheet()->getCell('H' . $i)->getCalculatedValue(); // cliente_estado
		$_DATOS_EXCEL[$i]['a9'] = $objPHPExcel-> getActiveSheet()->getCell('I' . $i)->getCalculatedValue(); // cliente_giro
		$_DATOS_EXCEL[$i]['a10'] = $objPHPExcel-> getActiveSheet()->getCell('J' . $i)->getCalculatedValue(); // cliente_correo_contacto
		$_DATOS_EXCEL[$i]['a11'] = $objPHPExcel-> getActiveSheet()->getCell('K' . $i)->getCalculatedValue(); // cliente_correo_intercambio
		$_DATOS_EXCEL[$i]['a12'] = $objPHPExcel-> getActiveSheet()->getCell('L' . $i)->getCalculatedValue(); // cliente_actividad_economica
		$_DATOS_EXCEL[$i]['a13'] = $cliente_tipo;
	}

	// RECORREMOS EL ARREGLO Y LO INSERTAMOS EN LA BASE DE DATOS
	$respuesta = cargaExcel($_DATOS_EXCEL);
	echo $respuesta["Mensaje"]."<br>";
	echo "Insertados : ".$respuesta["Correctos"]."<br>";
	echo "Repetidos : ".$respuesta["Incorrectos"];

}
?>

<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data" id="frmArchivoXML" class="form-horizontal">
	<div class="panel panel-dark">
		<div class="panel-heading">
			<!-- <div class="panel-btns"> -->
				<!-- <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title="Minimize Panel"><i class="fa fa-minus"></i></a> -->
				<!-- <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a> -->
			<!-- </div> -->
			<h4 class="panel-title">IMPORTACION DESDE ARCHIVO XML RECIBIDO</h4>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">ARCHIVO XML <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<input type="file" name="archivoXML" id="archivoXML" class="form-control">
				</div>
			</div>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">IMPORTAR DESDE ARCHIVO XML <i class="fa fa-plus"></i></button>
				</div>
			</div>
		</div>

	</div>
	<input type="hidden" name="cmd" value="importarXML">
</form>

<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data" id="frmArchivoEXCEL" class="form-horizontal">
	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">IMPORTACION DESDE PLANTILLA EXCEL</h4>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">ARCHIVO EXCEL <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<input type="file" name="archivoEXCEL" id="archivoEXCEL" class="form-control">
				</div>
			</div>
		</div>

		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label">TIPO PROVEEDOR <span class="asterisk">*</span></label>
				<div class="col-sm-3">
					<select name="cliente_tipo" id="cliente_tipo" class="form-control">
					<option value="" selected>Seleccionar...</option>
						<?php foreach ($documento as $key => $value): ?>
							<option value="<?php echo $value["dcto_codigo"] ?>"><?php echo $value["dcto_codigo"]." : ".$value["dcto_glosa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
		</div>


		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-dark mr5">IMPORTAR DESDE ARCHIVO EXCEL <i class="fa fa-plus"></i></button>
				</div>
			</div>
		</div>

	</div>
	<input type="hidden" name="cmd" value="importarEXCEL">
</form>

<form class="form-horizontal" id="frmNuevoCliente">
	<!-- INFORMACION DEL CLIENTE !-->
	<div class="panel panel-dark">
		<div class="panel-heading">
			<h4 class="panel-title">INFORMACION DEL CLIENTE</h4>
		</div>
		<div class="panel-body">

			<div class="form-group">
				<label class="col-sm-3 control-label">RAZON SOCIAL <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_razon_social" id="cliente_razon_social" value="<?php echo $RznSoc ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">RUT</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" name="cliente_rut" id="cliente_rut" value="<?php echo $RUTEmisor[0] ?>">
				</div>

				<div class="col-sm-1">
					<input type="text" class="form-control" name="cliente_dv" id="cliente_dv" value="<?php echo $RUTEmisor[1] ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">DIRECCION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_direccion" id="cliente_direccion" value="<?php echo $DirOrigen ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">REGION <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select class="form-control" name="cliente_region" id="cliente_region" onChange="getComunas(this.value)">
						<option value="" selected>Seleccionar...</option>
						<?php foreach ($regiones as $key => $value): ?>
							<option value="<?php echo $value["region_id"] ?>"><?php echo $value["region_glosa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">PROVINCIA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_provincia" id="cliente_provincia" class="form-control" onChange="getCiudades(this.value)">
						<?php if ($cmd == "importarXML"): ?>
							<option value="<?php echo $CiudadOrigen ?>"><?php echo $CiudadOrigen ?></option>
						<?php else: ?>
							<option value="" >Seleccionar...</option>
						<?php endif ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">COMUNA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_comuna_id" id="cliente_comuna_id" class="form-control">
						<?php if ($cmd == "importarXML"): ?>
							<option value="<?php echo $CmnaOrigen ?>"><?php echo $CmnaOrigen ?></option>
						<?php else: ?>
							<option value="" >Seleccionar...</option>
						<?php endif ?>
					</select>
				</div>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label">GIRO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_giro" id="cliente_giro" value="<?php echo $GiroEmis ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">ACTIVIDAD ECONOMICA <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_actividad_economica" id="cliente_actividad_economica" class="form-control select2" onchange="getValue(this.value)">
						<option value="" selected>Seleccionar...</option>
						<?php foreach ($actividadEconomica as $key => $value): ?>
							<option value="<?php echo $value["acti_codigo"] ?>" <?php if($value["acti_codigo"] == $Acteco){echo"selected";} ?>><?php echo "(".$value["acti_codigo"].") : ".utf8_encode($value["acti_descripcion"]) ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CORREO DE INTERCAMBIO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_correo_intercambio" id="cliente_correo_intercambio">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">CORREO DE CONTACTO <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cliente_correo_contacto" id="cliente_correo_contacto">
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label">TIPO PROVEEDOR <span class="asterisk">*</span></label>
				<div class="col-sm-9">
					<select name="cliente_tipo" id="cliente_tipo" class="form-control">
					<option value="" selected>Seleccionar...</option>
						<?php foreach ($documento as $key => $value): ?>
							<option value="<?php echo $value["dcto_codigo"] ?>"><?php echo $value["dcto_codigo"]." : ".$value["dcto_glosa"] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					<button class="btn btn-success mr5">CREAR <i class="fa fa-plus"></i></button>
					<button type="reset" class="btn btn-danger">CANCELAR <i class="fa fa-times"></i></button>
				</div>
			</div>
		</div>

	</div>

	<input type="hidden" name="cmd" value="nuevoCliente">
	<input type="hidden" id="cliente_provincia_id" name="cliente_provincia_id" value="<?php echo $CiudadOrigen ?>">
</form>
<script type="text/javascript">

	$('#cliente_rut').Rut({
		digito_verificador: '#cliente_dv',
		on_error: function(){ alert('Rut incorrecto');
		$("#cliente_rut").val("");
		$("#cliente_dv").val("");
		document.getElementById('cliente_rut').focus();}
	});

	function getComunas(input)
	{
		var data = ({cmd : "getComunas", region_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.comuna.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				var comunas = '<option value="">Seleccionar...</option>';

				$.each(response,function(index,value){
					comunas += '<option value="'+value.provincia_id+'">'+value.provincia_glosa+'</option>';
				});

				$("#cliente_provincia").html(comunas);
			}
		});
	}

	function getCiudades(input)
	{
		$("#cliente_provincia_id").val($("#cliente_provincia option:selected").text());
		var data = ({cmd : "getCiudades", provincia_id : input});
		$.ajax({
			type:"POST",
			url:"includes/functions.ciudad.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				var ciudades = '<option value="">Seleccionar...</option>';

				$.each(response,function(index,value){
					ciudades += '<option value="'+value.comuna_glosa+'">'+value.comuna_glosa+'</option>';
				});

				$("#cliente_comuna_id").html(ciudades);
			}
		});
	}

	$("#frmNuevoCliente").validate({
		rules : {
			cliente_razon_social : { required : true},
			cliente_rut : { required : true},
			cliente_dv : { required : true},
			cliente_direccion : { required : true},
			cliente_provincia : { required : true},
			cliente_comuna : { required : true},
			cliente_giro : { required : true},
			cliente_correo_contacto : { required : true},
			cliente_correo_intercambio : { required : true,email:true},
		},
		submitHandler : function ( form )
		{
			var data = $(form).serializeArray();
			$.ajax({
				type:"POST",
				url:"includes/functions.cliente.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
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
							window.location.href='?pagina=productos&ori=nuevo';
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
	})

	$("#frmArchivoEXCEL").validate({
		rules : {
			archivoEXCEL : {required : true},
			cliente_tipo : {required : true},
		},
		messages : {
			archivoEXCEL : "Porfavor adjunte el archivo Excel",
			cliente_tipo : "Porfavor seleccione el tipo de proveedor"
		},
		submitHandler : function ( form )
		{
			blockUI();
			$("#frmArchivoEXCEL").submit();
		}
	})

	function getValue(input)
	{
		var option = $("#cliente_actividad_economica option:selected").text();
		var pizza = option.split(" : ");
		$("#cliente_giro").val(pizza[1]);

	}
</script>
