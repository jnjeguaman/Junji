<?php
extract($_POST);

if($cmd == "Nuevo")
{
	$sql = "INSERT INTO acti_categoria VALUES (NULL,'".$cat_nombre."',".$cat_estado.")";
	mysql_query($sql,$dbh);
}

if($_POST["cmd"] === "archivoCSV")
{
	$start = 1;
	$filePath = $_FILES["zona_file"]["tmp_name"];
	$fila = 1;
	if (($gestor = fopen($filePath, "r")) !== FALSE) {
		$datos = fgetcsv($gestor,100,";");
		while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
			$numero = count($datos);
			$fila++;
			for ($c=0; $c < $numero; $c++) {
				$explode = explode(";", $datos[$c]);
				$sql = "INSERT INTO acti_categoria VALUES (NULL,'".$explode[1]."','".$explode[2]."')";
				mysql_query($sql,$dbh);
			}
		}
		fclose($gestor);
		echo "<script>window.location.href='?page=categorias&action=crear'</script>";
	}
}

?>

<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>CATEGORIAS > EDITAR</h3>
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
						DETALLE DE LA CATEGORIA : <strong><?php echo $detalle["cat_nombre"] ?></strong>
					</div>

					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE CATEGORIA <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="cat_nombre" name="cat_nombre" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="cat_estado" id="cat_estado" required>
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
					</form>
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
					<h2>LISTADO CATEGORIAS</h2>

					<div class="clearfix"></div>
				</div>
				<!-- CONTENIDO DE LAS PAGINAS !-->
				<?php
				$categorias = "SELECT * FROM acti_categoria";
				$categorias = mysql_query($categorias,$dbh);
				?>
				<table class="table table-bordered table-condensed table-striped table-hover jambo_table bulk_action">
					<thead>
						<tr class="headings">
							<th>ID</th>
							<th>NOMBRE</th>
							<th>ESTADO</th>
							<th>EDITAR</th>
						</tr>
					</thead>

					<tbody>
						<?php while($row = mysql_fetch_array($categorias)) { ?>
							<tr>
								<td><?php echo $row["cat_id"] ?> </td>
								<td><?php echo $row["cat_nombre"] ?> </td>
								<td><?php echo $row["cat_estado"] ?> </td>
								<td><a href="<?php echo $_SERVER["REQUEST_URI"]?>&id=<?php echo $row["cat_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
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
				function checkFile()
				{
					var extensionPermitida = "csv";
					
					var extension = $("#zona_file").val().split(".").pop();

					if(extension === extensionPermitida)
					{
						return true;
					}else{
						return false;
					}
				}
			</script>