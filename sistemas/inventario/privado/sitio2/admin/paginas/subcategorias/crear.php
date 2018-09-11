<?php
if($_POST["cmd"] == "Nuevo")
{
	$sql = "INSERT INTO acti_catsub VALUES(NULL,".$_POST["catsub_cat_id"].",'".$_POST["cat_nombre"]."',".$_POST["catsub_vu"].", ".$_POST["cat_estado"].")";
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
				$sql = "INSERT INTO acti_catsub VALUES (NULL,'".$explode[1]."','".$explode[2]."','".$explode[3]."','".$explode[4]."')";
				mysql_query($sql,$dbh);
			}
		}
		fclose($gestor);
		echo "<script>window.location.href='?page=subcategorias&action=crear'</script>";
	}
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
							<input type="text" id="cat_nombre" name="cat_nombre" required="required" class="form-control col-md-7 col-xs-12">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">VIDA UTIL <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="catsub_vu" id="catsub_vu" required>
								<option value="" selected>Seleccionar...</option>
								<option value="0">GASTO PATRIMONIAL</option>
								<?php for($i=0;$i<100;$i++): ?>
									<option value="<?php echo ($i+1) ?>"><?php echo ($i+1) ?> Años</option>
								<?php endfor ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO <span class="required">*</span></label>
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
							<button type="submit" class="btn btn-success">Crear</button>
						</div>
					</div>

					<input type="hidden" name="cmd" value="Nuevo">
					<input type="hidden" name="catsub_cat_id" value="<?php echo $_POST["cat_id"] ?>">
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

					<div class="clearfix"></div>
				</div>
				<!-- CONTENIDO DE LAS PAGINAS !-->
				<?php
				$categorias = "SELECT * FROM acti_categoria WHERE cat_estado = 1";
				$categorias = mysql_query($categorias,$dbh);
				?>
				<form method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR CATEGORIA</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="cat_id" class="form-control" onchange="this.form.submit()">
								<option>Seleccionar...</option>
								<?php while($row = mysql_fetch_array($categorias)) { ?>
									<option value="<?php echo $row["cat_id"] ?>" <?php if($_POST["cat_id"] == $row["cat_id"]){echo "selected";} ?>><?php echo $row["cat_nombre"] ?></option>
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
						$buscar = "SELECT * FROM acti_catsub WHERE catsub_cat_id = ".$_POST["cat_id"];
						$buscar = mysql_query($buscar,$dbh);
						?>
						<table class="table table-bordered table-condensed table-striped table-hover jambo_table">
							<thead>
								<tr>
									<th>ID</th>
									<th>NOMBRE</th>
									<th>EDITAR</th>
								</tr>
							</thead>

							<tbody>
								<?php while($row = mysql_fetch_array($buscar)) { ?>
									<tr>
										<td><?php echo $row["catsub_id"] ?></td>
										<td><?php echo $row["catsub_nombre"] ?></td>
										<td><a href="?page=subcategorias&action=editar&id=<?php echo $row["catsub_id"] ?>&cat_id=<?php echo $_POST["cat_id"]?>&cmd=Buscar" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
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