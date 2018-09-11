<?php
/** Clases necesarias */
require_once('includes/Classes/PHPExcel.php');
require_once('includes/Classes/PHPExcel/Reader/Excel5.php');

if($_POST["cmd"] == "Nuevo")
{
	$sql = "INSERT INTO acti_subzona VALUES(NULL,".$_POST["acti_subzona_region"].",'".$_POST["acti_subzona_glosa"]."',".$_POST["acti_subzona_codigo"].",".$_POST["acti_subzona_estado"].")";
	mysql_query($sql,$dbh);
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
		$_DATOS_EXCEL[$i]['a3'] = $objPHPExcel-> getActiveSheet()->getCell('C' . $i)->getCalculatedValue(); // GLOSA
		$_DATOS_EXCEL[$i]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue(); // CODIGO
		$_DATOS_EXCEL[$i]['a5'] = $objPHPExcel-> getActiveSheet()->getCell('E' . $i)->getCalculatedValue(); // ESTADO
	}
	for ($x=2; $x <= $highestRow; $x++) { 
		$sql = "INSERT INTO acti_subzona VALUES (NULL,'".$_DATOS_EXCEL[$x]["a2"]."','".strtoupper($_DATOS_EXCEL[$x]["a3"])."','".$_DATOS_EXCEL[$x]["a4"]."','".$_DATOS_EXCEL[$x]["a5"]."');";
		mysql_query($sql,$dbh);
	}
	echo "<script>window.location.href='?page=subzonas&action=crear'</script>";
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
	// 			$sql = "INSERT INTO acti_subzona VALUES (NULL,'".$explode[1]."','".$explode[2]."','".$explode[3]."','".$explode[4]."')";
	// 			mysql_query($sql);
	// 		}
	// 	}
	// 	fclose($gestor);
	// 	echo "<script>window.location.href='?page=subzonas&action=crear'</script>";
	// }
}
?>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>SUBCATEGORIAS > CREAR</h3>
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

	<?php if ($_POST["cmd"] == "Buscar"): ?>
		<?php
		$query = "SELECT * FROM acti_zona WHERE zona_id = ".$_POST["zona_id"];
		$query = mysql_query($query,$dbh);
		$query = mysql_fetch_array($query);

		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						DETALLE DE LA CATEGORIA : <strong><?php echo $detalle["cat_nombre"] ?></strong>
					</div>

					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE PRODUCTO <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="acti_subzona_glosa" name="acti_subzona_glosa" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="acti_subzona_estado" id="acti_subzona_estado" required>
									<option value="" selected>Seleccionar...</option>
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success">Crear</button>
							</div>
						</div>

						<input type="hidden" name="cmd" value="Nuevo">
						<input type="hidden" name="acti_subzona_codigo" value="<?php echo $query["zona_codigo"] ?>">
						<input type="hidden" name="acti_subzona_region" value="<?php echo $query["zona_region"] ?>">
					</form>
				</div>
			</div>
		</div>
	<?php endif ?>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>LISTADO CATEGORIAS</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a>
								</li>
								<li><a href="#">Settings 2</a>
								</li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<!-- CONTENIDO DE LAS PAGINAS !-->
				<?php
				$categorias = "SELECT * FROM acti_zona WHERE zona_estado = 1";
				$categorias = mysql_query($categorias,$dbh);
				?>
				<form method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR CATEGORIA</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="zona_id" class="form-control" onchange="this.form.submit()">
								<option>Seleccionar...</option>
								<?php while($row = mysql_fetch_array($categorias)) { ?>
									<option value="<?php echo $row["zona_id"] ?>" <?php if($_POST["zona_id"] == $row["zona_id"]){echo "selected";} ?>><?php echo $row["zona_glosa"] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<input type="hidden" name="cmd" value="Buscar">
					</form>
					<br>
					<hr>
					<?php if($_POST["cmd"] == "Buscar"): ?>
						<?php
						$detalle = "SELECT * FROM acti_zona WHERE zona_id = ".$_POST["zona_id"];
						$detalle = mysql_query($detalle,$dbh);
						$detalle = mysql_fetch_array($detalle);
						$buscar = "SELECT * FROM acti_subzona WHERE acti_subzona_codigo = ".$detalle["zona_codigo"];
						$buscar = mysql_query($buscar,$dbh);
						?>
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>NOMBRE</th>
								</tr>
							</thead>

							<tbody>
								<?php while($row = mysql_fetch_array($buscar)) { ?>
									<tr>
										<td><?php echo $row["acti_subzona_id"] ?></td>
										<td><?php echo $row["acti_subzona_glosa"] ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

						<?php endif ?>
						<!-- CONTENIDO DE LAS PAGINAS !-->
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						SUBIR ARCHIVO CSV 
					</div>

					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return checkFile()" enctype="multipart/form-data">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">CSV <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" id="zona_file" name="zona_file" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

					<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<a href="files/formato_subzona.xlsx">BAJAR FORMATO <i class"fa fa-file-excel-o"></i></a>
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


		<script type="text/javascript">
			function checkFile()
			{
				// var extensionPermitida = "csv";
				
				// var extension = $("#zona_file").val().split(".").pop();

				// if(extension === extensionPermitida)
				// {
				// 	return true;
				// }else{
				// 	return false;
				// }
				return true;
			}
		</script>