<?php
extract($_POST);
$regiones = array();
$region = "SELECT * FROM acti_region WHERE region_estado = 1";
$resRegiones = mysql_query($region,$dbh);
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

if (isset($_POST["cmd"]) AND $_POST["cmd"] == "Buscar") {
	if($_POST["region"] <> "")
	{
		$where.= "compra_region_id = ".$_POST["region"]." AND ";
	}

	if ($_POST["prefijo"] <> "" AND $_POST["correlativo"] <> "" AND $_POST["sufijo"] <> "") {
		$oc = $_POST["prefijo"]."-".$_POST["correlativo"]."-".$_POST["sufijo"];
		$oc = strtoupper($oc);
		$where.="oc_numero LIKE '%".$oc."%' AND ";
	}


	if($_POST["ing_guianumerorc"] <> "")
	{
		$where.="compra_rc LIKE '%".$_POST["ing_guianumerorc"]."%' AND ";		
	}

	$sql = "SELECT * FROM acti_compra_temporal WHERE $where compra_visible = 0";
	$res = mysql_query($sql,$dbh);

}

if (isset($_POST["cmd"]) AND $_POST["cmd"] == "Actualizar") {
	$reg = array(1 => "I REGION",2 => "II REGION",3 => "III REGION",4 => "IV REGION",5 => "V REGION",6 => "VI REGION",7 => "VII REGION",8 => "VIII REGION",9 => "IX REGION",10 => "X REGION",11 => "XI REGION",12 => "XII REGION",13 => "REGION METROPOLITANA",14 => "XIV REGION",15 => "XVI REGION",16 => "DIRECCION NACIONAL");
	$glosa = $reg[$_POST["region"]];
	if($tipo == "oc")
	{
		$resp = mysql_query("UPDATE acti_compra_temporal SET compra_region = '".$glosa."', compra_region_id = ".$_POST["region"]." WHERE oc_numero = '".$valor."'",$dbh);
	}

	if($tipo == "id")
	{
		$resp = mysql_query("UPDATE acti_compra_temporal SET compra_region = '".$glosa."', compra_region_id = ".$_POST["region"]." WHERE id = ".$valor,$dbh);
	}

	if($tipo == "rc")
	{
		$resp = mysql_query("UPDATE acti_compra_temporal SET compra_region = '".$glosa."', compra_region_id = ".$_POST["region"]." WHERE compra_rc = ".$valor,$dbh);
		echo $resp;
	}
}
?>
<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > REGION CLASIFICACION</h3>
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
						<select class="form-control" name="region" id="region">
							<option value="" selected>Seleccionar...</option>
							<?php foreach ($regiones as $key => $value): ?>
								<option value="<?php echo $value["region_id"] ?>" <?php if($_POST["region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">ORDEN DE COMPRA <span class="required">*</span></label>
					
					<div class="col-md-1 col-sm-12 col-xs-12 form-group">
						<input type="text" name="prefijo" id="prefijo" class="form-control" value="<?php echo $_POST["prefijo"] ?>">
					</div>

					<div class="col-md-1 col-sm-12 col-xs-12 form-group">
						<input type="text" name="correlativo" id="correlativo" class="form-control" value="<?php echo $_POST["correlativo"] ?>">
					</div>

					<div class="col-md-1 col-sm-12 col-xs-12 form-group">
						<input type="text" name="sufijo" id="sufijo" class="form-control" value="<?php echo $_POST["sufijo"] ?>">
					</div>

				</div>

				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">N° RECEPCION CONFORME <span class="required">*</span></label>
					<div class="col-md-1 col-sm-12 col-xs-12 form-group">
						<input type="text" name="ing_guianumerorc" id="ing_guianumerorc" class="form-control" value="<?php echo $_POST["ing_guianumerorc"] ?>">
					</div>
				</div>

				
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="submit" class="btn btn-success">Buscar</button>
					</div>
				</div>

				<input type="hidden" name="cmd" value="Buscar">

			</form>
		</div>
	</div>
</div>


<?php if (mysql_num_rows($res) > 0): ?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">REGION DE DESTINO</div>

				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<tr class="headings">
							<th>ORDEN DE COMPRA</th>
							<th>PROVEEDOR</th>
							<th>INGRESO AL SISTEMA</th>
							<th>RC</th>
							<th>EDITAR</th>
						</tr>
					</thead>

					<tbody>
						<?php while($row = mysql_fetch_array($res)) { 
							$tipos = array(1 => "BODEGA REGIONAL",2=>"OFICINA",3=>"JARDIN INFANTIL")
							?>
							<tr>
								<td><?php echo $row["oc_numero"] ?> </td>
								<td><?php echo $row["compra_proveedor"] ?> </td>
								<td><?php echo $row["compra_fecha_registro"] ?> </td>
								<td><?php echo $row["compra_rc"] ?> </td>
								<td>
									<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-sm" type="button" aria-expanded="false">ACCIONES <span class="caret"></span></button>
									<ul role="menu" class="dropdown-menu">
										<li><a href="?page=clasificacion&action=region&oc=<?php echo $row["oc_numero"]?>"><i class="fa fa-caret-right"></i> ORDEN DE COMPRA</a></li>
										<li><a href="?page=clasificacion&action=region&id=<?php echo $row["id"]?>"><i class="fa fa-caret-right"></i> INDIVIDUAL</a></li>
										<li><a href="?page=clasificacion&action=region&rc=<?php echo $row["compra_rc"]?>"><i class="fa fa-caret-right"></i> RECEPCION CONFORME</a></li>
									</ul>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php endif ?>
		
		<?php if (isset($oc)): ?>
			<?php $detalle = mysql_query("SELECT * FROM acti_compra_temporal WHERE oc_numero = '".$oc."' AND compra_visible = 0",$dbh) ?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">DETALLE</div>
						<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th>ORDEN DE COMPRA</th>
									<th>REGION</th>
									<th>PROVEEDOR</th>
									<th>PRODUCTO</th>
									<th>CANTIDAD</th>
									<th>RECEPCION CONFORME</th>
								</tr>
							</thead>

							<tbody>
								<?php while($row = mysql_fetch_array($detalle)) { ?>
									<tr>
										<td><?php echo $row["oc_numero"] ?> </td>
										<td><?php echo $row["compra_region_id"] ?></td>
										<td><?php echo $row["compra_proveedor"] ?> </td>
										<td><?php echo $row["compra_glosa"] ?> </td>
										<td><?php echo $row["compra_cantidad"] ?></td>
										<td><?php echo $row["compra_rc"] ?> </td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">REGION DE DESTINO</div>

							<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR REGION DESTINO <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="region" id="region">
											<option value="" selected>Seleccionar...</option>
											<?php foreach ($regiones as $key => $value): ?>
												<option value="<?php echo $value["region_id"] ?>" <?php if($_POST["region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-success">Actualizar</button>
									</div>
								</div>

								<input type="hidden" name="cmd" value="Actualizar">
								<input type="hidden" name="tipo" value="oc">
								<input type="hidden" name="valor" value="<?php echo $oc ?>">

							</form>
						</div>
					</div>
				</div>
			<?php endif ?>

			<?php if (isset($id)): ?>
				<?php $detalle = mysql_query("SELECT * FROM acti_compra_temporal WHERE id = ".$id." AND compra_visible = 0",$dbh) ?>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="x_panel">
							<div class="x_title">DETALLE</div>
							<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
								<thead>
									<tr class="headings">
										<th>ORDEN DE COMPRA</th>
										<th>REGION</th>
										<th>PROVEEDOR</th>
										<th>PRODUCTO</th>
										<th>CANTIDAD</th>
										<th>RECEPCION CONFORME</th>
									</tr>
								</thead>

								<tbody>
									<?php while($row = mysql_fetch_array($detalle)) { ?>
										<tr>
											<td><?php echo $row["oc_numero"] ?> </td>
											<td><?php echo $row["compra_region_id"] ?></td>
											<td><?php echo $row["compra_proveedor"] ?> </td>
											<td><?php echo $row["compra_glosa"] ?> </td>
											<td><?php echo $row["compra_cantidad"] ?></td>
											<td><?php echo $row["compra_rc"] ?> </td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">REGION DE DESTINO</div>

								<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR REGION DESTINO <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="region" id="region">
												<option value="" selected>Seleccionar...</option>
												<?php foreach ($regiones as $key => $value): ?>
													<option value="<?php echo $value["region_id"] ?>" <?php if($_POST["region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<button type="submit" class="btn btn-success">Actualizar</button>
										</div>
									</div>

									<input type="hidden" name="cmd" value="Actualizar">
									<input type="hidden" name="tipo" value="id">
									<input type="hidden" name="valor" value="<?php echo $id ?>">

								</form>
							</div>
						</div>
					</div>
				<?php endif ?>

				<?php if (isset($rc)): ?>
					<?php $detalle = mysql_query("SELECT * FROM acti_compra_temporal WHERE compra_rc = ".$rc." AND compra_visible = 0",$dbh) ?>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">DETALLE</div>
								<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
									<thead>
										<tr class="headings">
											<th>ORDEN DE COMPRA</th>
											<th>REGION</th>
											<th>PROVEEDOR</th>
											<th>PRODUCTO</th>
											<th>CANTIDAD</th>
											<th>RECEPCION CONFORME</th>
										</tr>
									</thead>

									<tbody>
										<?php while($row = mysql_fetch_array($detalle)) { ?>
											<tr>
												<td><?php echo $row["oc_numero"] ?> </td>
												<td><?php echo $row["compra_region_id"] ?></td>
												<td><?php echo $row["compra_proveedor"] ?> </td>
												<td><?php echo $row["compra_glosa"] ?> </td>
												<td><?php echo $row["compra_cantidad"] ?></td>
												<td><?php echo $row["compra_rc"] ?> </td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
									<div class="x_title">REGION DE DESTINO</div>

									<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR REGION DESTINO <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<select class="form-control" name="region" id="region">
													<option value="" selected>Seleccionar...</option>
													<?php foreach ($regiones as $key => $value): ?>
														<option value="<?php echo $value["region_id"] ?>" <?php if($_POST["region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
												<button type="submit" class="btn btn-success">Actualizar</button>
											</div>
										</div>

										<input type="hidden" name="cmd" value="Actualizar">
										<input type="hidden" name="tipo" value="rc">
										<input type="hidden" name="valor" value="<?php echo $rc ?>">

									</form>
								</div>
							</div>
						</div>

					<?php endif ?>