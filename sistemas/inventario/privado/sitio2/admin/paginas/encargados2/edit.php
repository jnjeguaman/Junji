<?php
$sql = "SELECT * FROM acti_region WHERE region_id = ".$_GET["id"];
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);

if(isset($_POST["cmd"]) && $_POST["cmd"] == "Actualizar")
{
	$update = "UPDATE acti_region SET region_dir_bodega = '".$_POST["region_dir_bodega"]."', region_encargado = '".$_POST["region_encargado"]."' WHERE region_id = ".$_POST["region_id"];
	mysql_query($update,$dbh);
	echo "<script>window.location.href='?page=encargados2';</script>";
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
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					DETALLE DE LA CATEGORIA : <strong><?php echo $detalle["cat_nombre"] ?></strong>
				</div>

				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">ENCARGADO ACTUAL <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" disabled class="form-control col-md-7 col-xs-12" value="<?php echo $row["region_encargado"] ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">DIRECCION ACTUAL <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" disabled class="form-control col-md-7 col-xs-12" value="<?php echo $row["region_dir_bodega"] ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NUEVO ENCARGADO <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="region_encargado" name="region_encargado" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row["region_encargado"] ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NUEVA DIRECCION <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="text" id="region_dir_bodega" name="region_dir_bodega" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $row["region_dir_bodega"] ?>">
						</div>
					</div>


					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-success">Actualizar</button>
						</div>
					</div>

					<input type="hidden" name="cmd" value="Actualizar">
					<input type="hidden" name="region_id" value="<?php echo $row["region_id"] ?>">
				</form>
			</div>
		</div>
	</div>
</div>