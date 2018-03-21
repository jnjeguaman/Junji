<?php
extract($_POST);
$documento = getDocumentos();
libxml_use_internal_errors(true);
$regiones = getRegiones2();
$limite = 20;
if($cmd == "previsualizarCAF")
{
	// COMPROBAMOS LA EXTENSION DEL ARCHIVO
	$extension = strtoupper(pathinfo($_FILES["preview"]["name"],PATHINFO_EXTENSION));

	if($extension === "XML")
	{
		// COMPROBAMOS EL CONTENIDO DEL CAF
		$xml = utf8_encode(file_get_contents($_FILES["preview"]["tmp_name"]));
		//PARSEAMOS EL XML A UN ARREGLO
		$CAF = new SimpleXMLElement($xml);
		if(count($CAF->CAF) > 0)
		{
			$folio_inicio = $CAF->CAF->DA->RNG->D;
			$folio_fin = $CAF->CAF->DA->RNG->H;
			$folio_tipo  = $CAF->CAF->DA->TD;
		}else{
			echo '
			<div class="alert alert-danger">
				<strong>Oh snap!</strong> Change a <a href="" class="alert-link">few things</a> up and try submitting again.
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


if($cmd == "importarCAF")
{
	$regionSession = $_SESSION["sii"]["usuario_region"];
	$ruta = "../includes/CAF/";
	$file = date("YmdHis");
	$regionDestino = $_POST["folio_region"];

	// COMPROBAMOS LA EXTENSION DEL ARCHIVO
	$extension = strtoupper(pathinfo($_FILES["archivoCAF"]["name"],PATHINFO_EXTENSION));
	if($extension === "XML")
	{
		// COMPROBAMOS EL CONTENIDO DEL CAF
		$xml = utf8_encode(file_get_contents($_FILES["archivoCAF"]["tmp_name"]));
		//PARSEAMOS EL XML A UN ARREGLO
		$CAF = new SimpleXMLElement($xml);

		if(count($CAF->CAF) > 0)
		{
			$folio_inicio = $CAF->CAF->DA->RNG->D;
			$folio_fin = $CAF->CAF->DA->RNG->H;
			$folio_tipo  = $CAF->CAF->DA->TD;
			$destino = $ruta."/".$folio_tipo."/".$file.".".$extension;
			$folio_archivo_sii = (string)$_FILES["archivoCAF"]["name"];

			// SUBIR EL ARCHIVO A LA RUTA CORRESPONDIENTE
			if (copy($_FILES["archivoCAF"]['tmp_name'],$destino)) {
				// INSERTAR REGISTRO EN LA BASE DE DATOS
				$respuesta = insertarCAF($file.".".$extension,$folio_tipo,$folio_inicio,$folio_fin,$regionDestino,$folio_archivo_sii,$folio_umbral,$folio_umbral2,$folio_umbral3);

				if($respuesta["Respuesta"])
				{
					echo '
				<div class="alert alert-success">
					<strong>Exito</strong> '.$respuesta["Mensaje"].'
				</div>
				';
			}else{
				echo '
				<div class="alert alert-danger">
					<strong>Ha ocurrido un ERROR!</strong> '.$respuesta["Mensaje"].'
				</div>
				';
			}
			}else{
				$error = error_get_last();
				echo '
				<div class="alert alert-danger">
					<strong>Ha ocurrido un ERROR!</strong> '.$error["message"].'
				</div>
				';
			}
		}else{
			echo '
			<div class="alert alert-danger">
				<strong>Ha ocurrido un ERROR!</strong> Formato de archivo inválido
			</div>
			';
		}
	}else{
		echo '
		<div class="alert alert-danger">
			<strong>Ha ocurrido un ERROR </strong> Extensión de archivo inválido!
		</div>
		';
	}
}

?>
<div class="col-sm-6">
	<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data" id="frmArchivoCAF" class="form-horizontal">
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">SUBIR ARCHIVO CAF</h4>

			</div>
			<div class="panel-body">

				<div class="alert alert-warning">
					<strong>ADVERTENCIA!.</strong> Solo cargar el archivo CAF cuando los folios se hayan acabado.
					<p>El sistema leerá y validará automáticamente el archivo <strong>CAF (Código de autorización de folios)</strong> ingresando la información correctamente al sistema de Facturación Electrónica.</p>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">ARCHIVO CAF <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="file" name="archivoCAF" id="archivoCAF" class="form-control">
					</div>
				</div>

				<!-- <div class="form-group">
					<label class="col-sm-3 control-label">TIPO DE DOCUMENTO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select name="folio_tipo" id="folio_tipo" class="form-control">
							<option value="">Seleccionar...</option>
							<?php foreach ($documento as $key => $value): ?>
								<option value="<?php echo $value["dcto_codigo"] ?>" <?php if($folio_tipo == $value["dcto_codigo"]){echo"selected";} ?> ><?php echo "(".$value["dcto_codigo"].") : ".$value["dcto_glosa"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div> -->

				<!-- <div class="form-group">
					<label class="col-sm-3 control-label">FOLIO DE INICIO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="folio_inicio" id="folio_inicio" class="form-control" value="<?php echo $folio_inicio ?>">
					</div>
				</div> -->

				<!-- <div class="form-group">
					<label class="col-sm-3 control-label">FOLIO DE TERMINO <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="text" name="folio_fin" id="folio_fin" class="form-control" value="<?php echo $folio_fin ?>">
					</div>
				</div> -->

				<div class="form-group">
					<label class="col-sm-3 control-label">REGION <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<select class="form-control" name="folio_region" id="folio_region" required>
							<option value="" selected>Seleccionar...</option>
							<?php foreach ($regiones as $key => $value): ?>
								<option value="<?php echo $value["codigo"] ?>"><?php echo $value["nombre"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">AVISO N° 1 <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="number" name="folio_umbral" id="folio_umbral" class="form-control" min="1" max="300" required>
						<span class="label label-success">Al alcanzar este umbral se enviará el primer aviso por correo electrónico</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">AVISO N° 2 <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="number" name="folio_umbral2" id="folio_umbral2" class="form-control" min="1" max="300" required>
						<span class="label label-warning">Al alcanzar este umbral se enviará el segundo aviso por correo electrónico</span>
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">AVISO N° 3 <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="number" name="folio_umbral3" id="folio_umbral3" class="form-control" min="1" max="300" required>
						<span class="label label-danger">Al alcanzar este umbral se enviará el tercer aviso por correo electrónico</span>
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
		<input type="hidden" name="cmd" value="importarCAF">
		
	</form>
</div>

<div class="col-sm-6">
	<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data" id="frmArchivoCAF" class="form-horizontal">
		<div class="panel panel-dark">
			<div class="panel-heading">
				<h4 class="panel-title">PRE-VISUALIZAR CAF</h4>
			</div>
			<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-3 control-label">ARCHIVO CAF <span class="asterisk">*</span></label>
					<div class="col-sm-9">
						<input type="file" name="preview" id="preview" class="form-control">
					</div>
				</div>

			</div>

			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
						<button class="btn btn-dark mr5">PRE VISUALIZAR <i class="fa fa-plus"></i></button>
					</div>
				</div>
			</div>

		</div>
		<input type="hidden" name="cmd" value="previsualizarCAF">
	</form>
</div>