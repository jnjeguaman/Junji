<?php
extract($_POST);
$regiones = "SELECT * FROM acti_region";
$regiones = mysql_query($regiones,$dbh);

if($cmd == "Actualizar")
{
if($_POST["zona_region"] != 16)
{
	if($_POST["zona_prefijo"] == "JI" || $_POST["zona_prefijo"] == "BR" || $_POST["zona_prefijo"] == "DR" || $_POST["zona_prefijo"] == "OP")
	{
		$final = $_POST["zona_prefijo"]." ".$_POST["zona_glosa"];
	}else{
		$final = $_POST["zona_glosa"];
	}
}else{
	$final = $_POST["zona_glosa"];
}
	$sql = "UPDATE acti_zona SET zona_region = ".$_POST["zona_region"].", zona_glosa = '".$final."', zona_estado = ".$_POST["zona_estado"].", zona_comuna = '".$_POST["zona_comuna"]."', zona_direccion = '".$_POST["zona_direccion"]."' WHERE zona_id = ".$_POST["zona_id"];
	mysql_query($sql,$dbh);

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

	<?php if (isset($_REQUEST["id"])): ?>
		<?php
		$detalle = "SELECT * FROM acti_zona WHERE zona_id = ".$_GET["id"];
		$detalle = mysql_query($detalle,$dbh);
		$detalle = mysql_fetch_array($detalle);
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						DETALLE DE LA CATEGORIA : <strong><?php echo $detalle["cat_nombre"] ?></strong>
					</div>

					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="?page=zonas&action=editar&id=<?php echo $_GET["id"] ?>">
						<?php
						$comuna = "SELECT DISTINCT(jardin_comuna) AS Comuna FROM jardines WHERE jardin_region = ".$detalle["zona_region"];
						$comuna = mysql_query($comuna,$dbh);
						?>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">REGION DESTINO</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="zona_region" id="zona_region" required onChange="this.form.submit()">
									<option value="" selected>Seleccionar...</option>
									<?php while($row = mysql_fetch_array($regiones)) { ?>
										<option value="<?php echo $row["region_id"] ?>" <?php if($detalle["zona_region"] == $row["region_id"]){echo"selected";} ?> ><?php echo $row["region_glosa"] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">DIRECCION</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="zona_direccion" id="zona_direccion" class="form-control" value="<?php echo $detalle["zona_direccion"] ?>">
								</div>
							</div>

							<?php if ($detalle["zona_region"] != 16): ?>
								<?php $prefijo = explode(" ",$detalle["zona_glosa"]);?>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">COMUNA DESTINO</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="zona_comuna" id="zona_comuna" required>
											<option value="" selected>Seleccionar...</option>
											<?php while($row2 = mysql_fetch_array($comuna)) { ?>
												<option value="<?php echo $row2["Comuna"] ?>" <?php if($detalle["zona_comuna"] == $row2["Comuna"]){echo"selected";} ?>><?php echo $row2["Comuna"] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

									<div class="form-group prefijo">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">PREFIJO</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="zona_prefijo" id="zona_prefijo" required>
												<option value="" selected>Seleccionar...</option>
												<option value="JI" <?php if($prefijo[0] == "JI"){echo"selected";}?>>JARDIN</option>
												<option value="DR" <?php if($prefijo[0] == "DR"){echo"selected";}?>>DIRECCION REGIONAL</option>
												<option value="BR" <?php if($prefijo[0] == "BR"){echo"selected";}?>>BODEGA REGIONAL</option>
												<option value="OP" <?php if($prefijo[0] == "OP"){echo"selected";}?>>OP</option>
												<option value="OTRO" <?php if($prefijo[0] == ""){echo"selected";}?>>OTRO</option>
											</select>
										</div>
									</div>
								<?php endif ?>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE CATEGORIA <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="zona_glosa" name="zona_glosa" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo ($prefijo[1] == NULL) ? $detalle["zona_glosa"] : $prefijo[1] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="zona_estado" id="zona_estado" required>
									<option value="">Seleccionar...</option>
									<option value="1" <?php if(intval($detalle["zona_estado"]) === 1){echo"selected";}?> >ACTIVO</option>
									<option value="0" <?php if(intval($detalle["zona_estado"]) === 0){echo"selected";}?> >INACTIVO</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<!--<button type="submit" class="btn btn-primary">Cancel</button>1-->
								<button type="submit" class="btn btn-success">Actualizar</button>
							</div>
						</div>

						<input type="hidden" name="zona_id" value="<?php echo $detalle["zona_id"] ?>">
						<input type="hidden" name="cmd" value="Actualizar">
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
				$categorias = "SELECT * FROM acti_zona";
				$categorias = mysql_query($categorias,$dbh);
				?>
				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<tr class="headings">
							<th>ID</th>
							<th>NOMBRE</th>
							<th>REGION</th>
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
