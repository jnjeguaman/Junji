<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// ini_set('memory_limit', '1024'); //your memory limit as string
/** Clases necesarias */
require_once('includes/Classes/PHPExcel.php');
require_once('includes/Classes/PHPExcel/Reader/Excel5.php');

extract($_POST);

$regiones = "SELECT * FROM acti_region";
$regiones = mysql_query($regiones,$dbh);

$comuna = "SELECT DISTINCT(jardin_comuna) AS Comuna FROM jardines WHERE jardin_region = ".$_POST["zona_region"];
$comuna = mysql_query($comuna,$dbh);

$codigosquery = "SELECT DISTINCT(zona_codigo) FROM acti_zona WHERE zona_region = ".$_POST["zona_region"];
$codigosqueryres = mysql_query($codigosquery,$dbh);

if($cmd == "Nuevo")
{
	

	//VERIFICAMOS REGION DE DESTINO
	if($_POST["zona_region"] != 16)
	{
		//Verificamos la Opcion del prefijo
		if($_POST["zona_prefijo"] == "JI" || $_POST["zona_prefijo"] == "BR" || $_POST["zona_prefijo"] == "DR" || $_POST["zona_prefijo"] == "OP")
		{
			// Concatenamos
			$final = $_POST["zona_prefijo"]." ".$_POST["zona_glosa"];
		}else{
			$final = $_POST["zona_glosa"];
		}
	}else{
		$final = $_POST["zona_glosa"];
	}

	$sql = "INSERT INTO acti_zona VALUES (NULL,".$_POST["zona_region"].",'".$final."',".$_POST["zona_estado"].",'".$_POST["zona_comuna"]."','".$_POST["zona_codigo"]."','".$_POST["zona_direccion"]."')";
	mysql_query($sql,$dbh);

}

if($cmd === "archivoCSV")
{
	try {
	// Cargando la hoja de cálculo
	$objReader = new PHPExcel_Reader_Excel2007();
	$objPHPExcel = $objReader->load($_FILES["zona_file"]["tmp_name"]);
	echo "Memory usage: " . (memory_get_peak_usage(true) / 1024 / 1024) . " MB";
	$objPHPExcel->setActiveSheetIndex(0);
	$highestRow =  $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

	for ($i = 2; $i <= $highestRow; $i++) {
		$_DATOS_EXCEL[$i]['a2'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue(); // REGION
		$_DATOS_EXCEL[$i]['a3'] = $objPHPExcel-> getActiveSheet()->getCell('C' . $i)->getCalculatedValue(); // GLOSA
		$_DATOS_EXCEL[$i]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue(); // ESTADO
		$_DATOS_EXCEL[$i]['a5'] = $objPHPExcel-> getActiveSheet()->getCell('E' . $i)->getCalculatedValue(); // COMUNA
		$_DATOS_EXCEL[$i]['a6'] = $objPHPExcel->getActiveSheet()->getCell('F' . $i)->getCalculatedValue(); // CODIGO
		$_DATOS_EXCEL[$i]['a7'] = $objPHPExcel->getActiveSheet()->getCell('G' . $i)->getCalculatedValue(); // DIRECCION
	}
	for ($x=2; $x <= $highestRow; $x++) { 
		$sql = "INSERT INTO acti_zona VALUES (NULL,'".$_DATOS_EXCEL[$x]["a2"]."','".strtoupper($_DATOS_EXCEL[$x]["a3"])."','".$_DATOS_EXCEL[$x]["a4"]."','".strtoupper($_DATOS_EXCEL[$x]["a5"])."','".$_DATOS_EXCEL[$x]["a6"]."','".$_DATOS_EXCEL[$x]["a7"]."');";
		mysql_query($sql,$dbh);
	}
	echo "<script>window.location.href='?page=zonas&action=crear'</script>";
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>

<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3><?php echo $texto ?> > ZONAS</h3>
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
				<div class="x_title">
					INGRESO NUEVA ZONA
				</div>

				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">REGION DESTINO <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="zona_region" id="zona_region" required onChange="this.form.submit()">
								<option value="" selected>Seleccionar...</option>
								<?php while($row = mysql_fetch_array($regiones)) { ?>
									<option value="<?php echo $row["region_id"] ?>" <?php if($_POST["zona_region"] == $row["region_id"]){echo"selected";} ?> ><?php echo $row["region_glosa"] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<input type="hidden" name="buscar" value="1">
					</form>	
				</div>
			</div>
		</div>

		<?php if (isset($_POST["zona_region"])): ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							INGRESO NUEVA ZONA
						</div>

						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

							<?php if ($_POST["zona_region"] != 16): ?>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">COMUNA DESTINO <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="zona_comuna" id="zona_comuna" required>
											<option value="" selected>Seleccionar...</option>
											<?php while($row2 = mysql_fetch_array($comuna)) { ?>
												<option value="<?php echo $row2["Comuna"] ?>"><?php echo $row2["Comuna"] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								<? endif ?>

									<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">DIRECCION</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="zona_direccion" id="zona_direccion" class="form-control">
								</div>
							</div>
	
		<?php if ($_POST["zona_region"] != 16): ?>
									<div class="form-group prefijo">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">PREFIJO <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="zona_prefijo" id="zona_prefijo" required>
												<option value="" selected>Seleccionar...</option>
												<option value="JI">JARDIN</option>
												<option value="DR">DIRECCION REGIONAL</option>
												<option value="BR">BODEGA REGIONAL</option>
												<option value="OP">OP</option>
												<option value="OTRO">OTRO</option>
											</select>
										</div>
									</div>
								<?php endif ?>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">CODIGO / NOMBRE <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="zona_glosa" name="zona_glosa" required="required" class="form-control col-md-7 col-xs-12">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">CODIGO <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="zona_codigo" id="zona_codigo" required>
											<option value="" selected>Seleccionar...</option>
											<? if(1==2):?>
											<?php while($row = mysql_fetch_array($codigosqueryres)) { ?>
												<option value="<?php echo $row["zona_codigo"]?>"><?php echo $row["zona_codigo"]?></option>
												<?php } ?>
												<? endif ?>	
												<option value="<?php echo $_POST["zona_region"] ?>" selected><?php echo $_POST["zona_region"] ?></option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="zona_estado" id="zona_estado" required>
												<option value="" selected>Seleccionar...</option>
												<option value="1">ACTIVO</option>
												<option value="0">INACTIVO</option>
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
									<input type="hidden" name="zona_region" value="<?php echo $_POST["zona_region"] ?>">
								</form>	
							</div>
						</div>
					</div>
				<?php endif ?>

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
										<a href="files/formato_zona.xlsx">BAJAR FORMATO <i class"fa fa-file-excel-o"></i></a>
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

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">
								<h2>LISTADO ZONAS</h2>
								<div class="clearfix"></div>
							</div>
							<!-- CONTENIDO DE LAS PAGINAS !-->
							<?php
							if(isset($_POST["zona_region"]))
							{
								$categorias = "SELECT * FROM acti_zona WHERE zona_region = ".$_POST["zona_region"];
							}else{
								$categorias = "SELECT * FROM acti_zona";
							}
							if($_POST["buscar"])
							{
							$categorias = mysql_query($categorias,$dbh);
								
							}
							?>
							<table class="table table-bordered table-condensed table-striped table-hover jambo_table bulk_action">
								<thead>
									<tr class="headings">
										<th>ID</th>
										<th>NOMBRE</th>
										<th>REGION</th>
										<th>DIRECCIÓN</th>
										<th>CODIGO</th>
										<th>ESTADO</th>
										<th>EDITAR</th>
									</tr>
								</thead>

								<tbody>
									<?php while($row = mysql_fetch_array($categorias)) { ?>
										<tr>
											<td><?php echo $row["zona_id"] ?> </td>
											<td><?php echo $row["zona_glosa"] ?> </td>
											<td><?php echo $row["zona_region"] ?> </td>
											<td><?php echo $row["zona_direccion"] ?> </td>
											<td><?php echo $row["zona_codigo"] ?> </td>
											<td><?php echo $row["zona_estado"] ?> </td>
											<td><a href="?page=zonas&action=editar&id=<?php echo $row["zona_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<!-- CONTENIDO DE LAS PAGINAS !-->
							</div>
						</div>
					</div>

				</div>

				<script type="text/javascript">

					function prefijo(input)
					{

						if(input == 16)
						{
							$(".prefijo").hide();
						}else{
							$(".prefijo").show();
						}
					}

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