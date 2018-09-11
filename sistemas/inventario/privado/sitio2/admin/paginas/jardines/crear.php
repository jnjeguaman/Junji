<?php
/** Clases necesarias */
require_once('includes/Classes/PHPExcel.php');
require_once('includes/Classes/PHPExcel/Reader/Excel5.php');
// gesparvu
$regiones = array();
$programas = array();
$provincias = array();
$comunas = array();

$region = "SELECT * FROM acti_region WHERE region_estado = 1 and region_id NOT LIKE 16";
$resRegiones = mysql_query($region,$dbh);
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

$programa = "SELECT DISTINCT(jardin_programa) as Programas FROM jardines";
$resPrograma = mysql_query($programa,$dbh);
while ($row = mysql_fetch_array($resPrograma)) {
	$programas[]= $row;
}

if(isset($_POST))
{
	$sql2 = "SELECT DISTINCT(jardin_sector) as Sector FROM jardines WHERE jardin_region = ".$_POST["jardin_region"]." ORDER BY Sector ASC";
	$res2 = mysql_query($sql2);
	$provincia = "SELECT DISTINCT(jardin_provincia) as Provincias FROM jardines WHERE jardin_region = ".$_POST["jardin_region"];
	$resProvincia = mysql_query($provincia,$dbh);
	while($row = mysql_fetch_array($resProvincia))
	{
		$provincias[] = $row;
	}

	$comuna = "SELECT DISTINCT(jardin_comuna) as Comunas FROM jardines WHERE jardin_region = ".$_POST["jardin_region"];
	$resComuna = mysql_query($comuna,$dbh);
	while($row = mysql_fetch_array($resComuna))
	{
		$comunas[] = $row;
	}

}

if(isset($_POST) && $_POST["cmd"] === "Nuevo")
{

	$sql = "INSERT INTO jardines VALUES (NULL,".$_POST["jardin_region"].",".$_POST["jardin_codigo"].",'".$_POST["jardin_provincia"]."','".$_POST["jardin_comuna"]."','".$_POST["jardin_nombre"]."','".$_POST["jardin_direccion"]."','".$_POST["jardin_programa"]."','".$_POST["jardin_telefono"]."',".$_POST["jardin_estado"].",'".$_POST["jardin_sector"]."',0,'".$_POST["jardin_encargado"]."','".$_POST["jardin_email"]."')";
	if(mysql_query($sql,$dbh))
	{
		$acti_zona = "INSERT INTO acti_zona VALUES(null,".$_POST["jardin_region"].",'JI ".$_POST["jardin_codigo"]."',1,'".$_POST["jardin_comuna"]."',".$_POST["jardin_region"].",'".$_POST["jardin_direccion"]."')";
		mysql_query($acti_zona,$dbh);
		// exit;
		echo "<script>window.location.href='?page=jardines';</script>";
	}else{
		echo "<script>alert('Ha ocurrido un error al procesar la informacion : ".mysql_real_escape_string(mysql_error($dbh))."');</script>";
	}
}

if($_POST["cmd"] === "archivoCSV")
{

	// Cargando la hoja de cálculo
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load($_FILES["zona_file"]["tmp_name"]);
	$objPHPExcel->setActiveSheetIndex(0);
	$highestRow =  $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

	for ($i = 2; $i <= $highestRow; $i++) {
		$_DATOS_EXCEL[$i]['a2'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue(); // REGION
		$_DATOS_EXCEL[$i]['a3'] = $objPHPExcel-> getActiveSheet()->getCell('C' . $i)->getCalculatedValue(); // CODIGO
		$_DATOS_EXCEL[$i]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue(); // PROVINCIA
		$_DATOS_EXCEL[$i]['a5'] = $objPHPExcel-> getActiveSheet()->getCell('E' . $i)->getCalculatedValue(); // COMUNA
		$_DATOS_EXCEL[$i]['a6'] = $objPHPExcel-> getActiveSheet()->getCell('F' . $i)->getCalculatedValue(); // NOMBRE
		$_DATOS_EXCEL[$i]['a7'] = $objPHPExcel-> getActiveSheet()->getCell('G' . $i)->getCalculatedValue(); // DIRECCION
		$_DATOS_EXCEL[$i]['a8'] = $objPHPExcel-> getActiveSheet()->getCell('H' . $i)->getCalculatedValue(); // PROGRAMA
		$_DATOS_EXCEL[$i]['a9'] = $objPHPExcel-> getActiveSheet()->getCell('I' . $i)->getCalculatedValue(); // TELEFONO
		$_DATOS_EXCEL[$i]['a11'] = $objPHPExcel-> getActiveSheet()->getCell('J' . $i)->getCalculatedValue(); // SECTOR
		$_DATOS_EXCEL[$i]['a12'] = $objPHPExcel-> getActiveSheet()->getCell('K' . $i)->getCalculatedValue(); // ORDEN DE DESPACHO
		$_DATOS_EXCEL[$i]['a13'] = $objPHPExcel-> getActiveSheet()->getCell('L' . $i)->getCalculatedValue(); // ENCARGADO
		$_DATOS_EXCEL[$i]['a14'] = $objPHPExcel-> getActiveSheet()->getCell('M' . $i)->getCalculatedValue(); // EMAIL
	}
	for ($x=2; $x <= $highestRow; $x++) { 
		$sql = "INSERT INTO jardines VALUES (NULL,'".$_DATOS_EXCEL[$x]["a2"]."','".$_DATOS_EXCEL[$x]["a3"]."','".strtoupper($_DATOS_EXCEL[$x]["a4"])."','".strtoupper($_DATOS_EXCEL[$x]["a5"])."','".strtoupper($_DATOS_EXCEL[$x]["a6"])."','".strtoupper($_DATOS_EXCEL[$x]["a7"])."','".strtoupper($_DATOS_EXCEL[$x]["a8"])."','".strtoupper($_DATOS_EXCEL[$x]["a7"])."',1,'".$_DATOS_EXCEL[$x]["a11"]."','".$_DATOS_EXCEL[$x]["a12"]."','".$_DATOS_EXCEL[$x]["a13"]."','".$_DATOS_EXCEL[$x]["a13"]."');";
		mysql_query($sql,$dbh);
		$sql2 = "INSERT INTO acti_zona VALUES (NULL,".$_DATOS_EXCEL[$x]["a2"].",'JI ".$_DATOS_EXCEL[$x]["a3"]."',1,'".$_DATOS_EXCEL[$x]["a5"]."',".$_DATOS_EXCEL[$x]["a2"].",'".$_DATOS_EXCEL[$x]["a7"]."')";
		mysql_query($sql2,$dbh);
	}
	// echo "<script>window.location.href='?page=jardines'</script>";

	// $start = 1;
	// $filePath = $_FILES["zona_file"]["tmp_name"];
	// $fila = 1;
	// if (($gestor = fopen($filePath, "r")) !== FALSE) {
	// 	$datos = fgetcsv($gestor,100,";");
	// 	while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
	// 		$numero = count($datos);
	// 		$fila++;
	// 		for ($c=0; $c < $numero; $c++) {
	// 			$explode = explode(";", $datos[$c]);
	// 			$sql = "INSERT INTO jardines VALUES (NULL,'".$explode[1]."','".$explode[2]."','".$explode[3]."','".$explode[4]."','".$explode[5]."','".$explode[6]."','".$explode[7]."','".$explode[8]."','".$explode[9]."')";
	// 			mysql_query($sql);
	// 		}
	// 	}
	// 	fclose($gestor);
	// 	echo "<script>window.location.href='?page=jardines&action=crear'</script>";
	// }
}
?>
<div class="">

	<div class="page-title">
		<div class="title_left">
			<h3><?php echo $texto ?> > JARDINES</h3>
		</div>

		<div class="title_right">
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">REGION DE DESTINO</div>

				<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR REGION DESTINO <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="jardin_region" id="jardin_region" required onChange="this.form.submit()">
								<option value="" selected>Seleccionar...</option>
								<?php foreach ($regiones as $key => $value): ?>
									<option value="<?php echo $value["region_id"] ?>" <?php if($_POST["jardin_region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						SUBIR ARCHIVO EXCEL 
					</div>

					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return checkFile()" enctype="multipart/form-data">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">EXCEL <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" id="zona_file" name="zona_file" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<a href="files/formato_jardines.xlsx">BAJAR FORMATO <i class"fa fa-file-excel-o"></i></a>
									</div>
								</div>


						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success">Subir</button>
							</div>
						</div>
						<input type="hidden" name="cmd" value="archivoCSV">
					</form>
				</div>
			</div>
		</div>	

	<?php if (isset($_POST) && is_numeric($_POST["jardin_region"])): ?>
		<!-- FORMULARIO -->
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						INGRESO NUEVO JARDIN
					</div>

					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">CODIGO GESPARVU <span class="required">*</span></label>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<span class="form-control-feedback left" aria-hidden="true">JI</span>
								<input type="text" id="jardin_codigo" name="jardin_codigo" required="required" class="form-control has-feedback-left col-md-7 col-xs-12" placeholder="131313">
							</div>
						</div>

						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">PROVINCIA <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_provincia" id="jardin_provincia" required>
									<option value="" selected>Seleccionar...</option>
									<?php foreach ($provincias as $key => $value): ?>
										<option><?php echo $value["Provincias"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">COMUNA <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_comuna" id="jardin_comuna" required>
									<option value="" selected>Seleccionar...</option>
									<?php foreach ($comunas as $key => $value): ?>
										<option><?php echo $value["Comunas"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="jardin_nombre" name="jardin_nombre" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">DIRECCION <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="jardin_direccion" name="jardin_direccion" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">PROGRAMA <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_programa" id="jardin_programa" required>
									<option value="" selected>Seleccionar...</option>
									<?php foreach ($programas as $key => $value): ?>
										<option><?php echo $value["Programas"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">TELEFONO <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="jardin_telefono" name="jardin_telefono" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">SECTOR <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_sector" id="jardin_sector">
									<option value="" selected>Seleccionar...</option>
									<?php while($row2 = mysql_fetch_array($res2)) { ?>
									<option value="<?php echo $row2["Sector"] ?>"><?php echo $row2["Sector"] ?></option>
									<? } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Encargado/a <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="jardin_encargado" name="jardin_encargado"  class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Correo Electrónico <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="email" id="jardin_email" name="jardin_email"  class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">VISIBLE <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="jardin_estado" id="jardin_estado" required>
									<option value="" selected>Seleccionar...</option>
									<option value="1">SI</option>
									<option value="0">NO</option>
								</select>
							</div>
						</div>


							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<!--<button type="submit" class="btn btn-primary">Cancel</button>1-->
									<button type="submit" class="btn btn-success">Crear</button>
								</div>
							</div>

						<input type="hidden" name="cmd" value="Nuevo">
						<input type="hidden" name="jardin_region" value="<?php echo $_POST["jardin_region"] ?>">
					</form>
				</div>
			</div>
		</div>
		<!-- FIN FORMULARIO -->

	<?php endif ?>
</div>

		<script type="text/javascript">
			function checkFile()
			{
				return true;
				// var extensionPermitida = "csv";
				
				// var extension = $("#zona_file").val().split(".").pop();

				// if(extension === extensionPermitida)
				// {
				// 	return true;
				// }else{
				// 	return false;
				// }
			}
		</script>