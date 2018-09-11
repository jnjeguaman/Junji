<?php
$regiones = array();
$region = "SELECT * FROM acti_region WHERE region_estado = 1 and region_id NOT LIKE 16";
$resRegiones = mysql_query($region,$dbh);
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

if(isset($_POST) && is_numeric($_POST["jardin_region"]) || is_numeric($_REQUEST["jardin_region"]))
{
	$jardin_region = $_POST["jardin_region"] ? $_POST["jardin_region"] : $_REQUEST["jardin_region"];
	$sql = "SELECT * FROM jardines WHERE jardin_region =".($_POST["jardin_region"] ? $_POST["jardin_region"] : $_REQUEST["jardin_region"]);
	
	$res = mysql_query($sql,$dbh);

}

if(isset($_POST) && $_POST["cmd"] === "Actualizar")
{
	$sql = "UPDATE jardines SET jardin_codigo = '".$_POST["jardin_codigo"]."', jardin_provincia = '".$_POST["jardin_provincia"]."', jardin_comuna = '".$_POST["jardin_comuna"]."', jardin_nombre = '".$_POST["jardin_nombre"]."', jardin_direccion = '".$_POST["jardin_direccion"]."', jardin_programa = '".$_POST["jardin_programa"]."', jardin_telefono = '".$_POST["jardin_telefono"]."', jardin_estado = ".$_POST["jardin_estado"].", jardin_sector = '".$_POST["jardin_sector"]."' WHERE jardin_id = ".$_POST["jardin_id"];
	if(mysql_query($sql,$dbh))
	{
		echo "<script>alert('Actualizacion exitosa');window.location.href='?page=jardines&action=editar&id=".$_GET["id"]."&jardin_region=".$_GET["jardin_region"]."';</script>";
	}else{
		echo "<script>alert('Ha ocurrido un error al procesar la informacion : ".mysql_real_escape_string(mysql_error($dbh))."');</script>";
	}
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

	<?php if (isset($_REQUEST["id"]) && is_numeric($_REQUEST["id"])): ?>
		<?php
		$sql3 = "SELECT DISTINCT(jardin_sector) as Sector FROM jardines WHERE jardin_region = ".$_GET["jardin_region"]." ORDER BY Sector ASC";
		$res3 = mysql_query($sql3);

		$sql = "SELECT * FROM jardines WHERE jardin_id = ".$_REQUEST["id"];
		$res = mysql_query($sql,$dbh);
		$row2 = mysql_fetch_array($res);

		$provincias = array();
		$provincia = "SELECT DISTINCT(jardin_provincia) as Provincias FROM jardines WHERE jardin_region = ".$_GET["jardin_region"];
		$resProvincia = mysql_query($provincia,$dbh);
		while($row = mysql_fetch_array($resProvincia))
		{
			$provincias[] = $row;
		}

		$comunas = array();
		$comuna = "SELECT DISTINCT(jardin_comuna) as Comunas FROM jardines WHERE jardin_region = ".$_GET["jardin_region"];
		$resComuna = mysql_query($comuna,$dbh);
		while($row = mysql_fetch_array($resComuna))
		{
			$comunas[] = $row;
		}

		$programas = array();
		$programa = "SELECT DISTINCT(jardin_programa) as Programas FROM jardines";
		$resPrograma = mysql_query($programa,$dbh);
		while ($row = mysql_fetch_array($resPrograma)) {
			$programas[]= $row;
		}
		?>

		<!-- FORMULARIO -->
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						FORMULARIO DE ACTUALIZACIÓN
					</div>
					<!-- CONTENIDO -->
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">CODIGO GESPARVU <span class="required">*</span></label>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<span class="form-control-feedback left" aria-hidden="true">JI</span>
								<input type="text" id="jardin_codigo" name="jardin_codigo" required="required" class="form-control has-feedback-left col-md-7 col-xs-12" value="<?php echo $row2["jardin_codigo"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">PROVINCIA <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_provincia" id="jardin_provincia" required>
									<option value="" selected>Seleccionar...</option>
									<?php foreach ($provincias as $key => $value): ?>
										<option value="<?php echo $value["Provincias"] ?>" <?php if($value["Provincias"] == $row2["jardin_provincia"]){echo"selected";}?>><?php echo $value["Provincias"] ?></option>
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
										<option value="<?php echo $value["Comunas"] ?>" <?php if($value["Comunas"] == $row2["jardin_comuna"]){echo"selected";}?>><?php echo $value["Comunas"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="jardin_nombre" name="jardin_nombre" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row2["jardin_nombre"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">DIRECCION <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="jardin_direccion" name="jardin_direccion" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row2["jardin_direccion"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">PROGRAMA <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_programa" id="jardin_programa" required>
									<option value="" selected>Seleccionar...</option>
									<?php foreach ($programas as $key => $value): ?>
										<option value="<?php echo $value["Programas"] ?>" <?php if($value["Programas"] == $row2["jardin_programa"]){echo"selected";}?>><?php echo $value["Programas"] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">TELEFONO <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="jardin_telefono" name="jardin_telefono" class="form-control col-md-7 col-xs-12" value="<?php echo $row2["jardin_telefono"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">SECTOR <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_sector" id="jardin_sector">
									<option value="" selected>Seleccionar...</option>
									<?php while($row3 = mysql_fetch_array($res3)) { ?>
									<option value="<?php echo $row3["Sector"] ?>" <?php if($row2["jardin_sector"] == $row3["Sector"]){echo"selected";} ?> ><?php echo $row3["Sector"] ?></option>
									<? } ?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">VISIBLE <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="jardin_estado" id="jardin_estado" required>
									<option value="" selected>Seleccionar...</option>
									<option value="1" <?php if($row2["jardin_estado"] ==1){echo"selected";} ?>>SI</option>
									<option value="0" <?php if($row2["jardin_estado"] ==0){echo"selected";} ?>>NO</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success">Actualizar</button>
							</div>
						</div>

						<input type="hidden" name="cmd" value="Actualizar">
						<input type="hidden" name="jardin_id" value="<?php echo $row2["jardin_id"] ?>">
					</form>
				</div>
			</div>
		</div>
	<?php endif ?>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">REGION DE DESTINO</div>
				<!-- CONTENIDO -->

				<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR REGION DESTINO <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="jardin_region" id="jardin_region" required onChange="this.form.submit()">
								<option value="" selected>Seleccionar...</option>
								<?php foreach ($regiones as $key => $value): ?>
									<option value="<?php echo $value["region_id"] ?>" <?php if($jardin_region == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
				</form>


				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<tr class="headings">
							<th>GESPARVU</th>
							<th>NOMBRE</th>
							<th>COMUNA</th>
							<th>PROVINCIA</th>
							<th>ESTADO</th>
							<th>SECTOR</th>
							<th>EDITAR</th>
						</tr>
					</thead>

					<tbody>
						<?php while($row = mysql_fetch_array($res)) { ?>
						<tr>
							<td><?php echo $row["jardin_codigo"] ?> </td>
							<td><?php echo $row["jardin_nombre"] ?> </td>
							<td><?php echo $row["jardin_comuna"] ?> </td>
							<td><?php echo $row["jardin_provincia"] ?> </td>
							<td><?php echo ($row["jardin_estado"] == 1 ? "VISIBLE" : "OCULTO") ?> </td>
							<td><?php echo $row["jardin_sector"] ?></td>
							<td><a href="?page=jardines&action=editar&id=<?php echo $row["jardin_id"] ?>&jardin_region=<?php echo $jardin_region?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
