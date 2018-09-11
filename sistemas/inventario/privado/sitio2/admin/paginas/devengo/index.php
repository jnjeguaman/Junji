  <div class="right_col" role="main">

<?php
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
		$where.="(compra_rc LIKE '%".$_POST["ing_guianumerorc"]."%' OR rc_nrc LIKE '%".$_POST["ing_guianumerorc"]."%') AND ";
	}

	$sql = "SELECT * FROM acti_compra WHERE ".$where." 1=1";
	$res = mysql_query($sql,$dbh);

}
	?>
	<div class="page-title">
		<div class="title_left">
			<h3><?php echo $texto ?> > RE-CLASIFICAR INGRESO</h3>
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
								<th>ID</th>
								<th>ORDEN DE COMPRA</th>
								<th>ITEM</th>
								<th>PROVEEDOR</th>
								<th>INGRESO AL SISTEMA</th>
								<th>RC</th>
								<th>DEVENGADO</th>
								<th>EDITAR</th>
							</tr>
						</thead>

						<tbody>
							<?php while($row = mysql_fetch_array($res)) { 
								$tipos = array(1 => "BODEGA REGIONAL",2=>"OFICINA",3=>"JARDIN INFANTIL")
								?>
								<tr>
									<td><?php echo $row["id"] ?></td>
									<td><?php echo $row["oc_numero"] ?> </td>
									<td><?php echo $row["compra_glosa"] ?> </td>
									<td><?php echo $row["compra_proveedor"] ?> </td>
									<td><?php echo $row["compra_fecha_registro"] ?> </td>
									<td><?php echo ($row["rc_nrc"] <> "") ? $row["rc_nrc"] : $row["compra_rc"]  ?> </td>
									<td><?php echo ($row["compra_devengado"] == 1) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-warning'></i>" ?> </td>
									<td><a href="?page=devengo&action=editar&id=<?php echo $row["id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		<?php endif ?>

		<?php if (isset($_GET["id"])): ?>


			<?php  

			$getDetalle = "SELECT * FROM acti_compra WHERE id = ".$_GET["id"];
// echo $getDetalle;
			$getDetaller = mysql_query($getDetalle,$dbh);

			$rowDetalle = mysql_fetch_array($getDetaller);

			$getDetaller = mysql_query($getDetalle,$dbh);
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">ORDEN DE COMPRA : <?php echo $rowDetalle["oc_numero"] ?>.</div>

						<!-- CONTENIDO DE LAS PAGINAS !-->
						<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
							<thead>
								<th>PRODUCTO</th>
								<th>CANTIDAD</th>
								<th>MONTO</th>
								<th>ABRIR</th>
							</thead>

							<tbody>
								<?php while($row=mysql_fetch_array($getDetaller)) { ?>
									<tr>
										<td><?php echo $row["compra_glosa"] ?></td>
										<td><?php echo $row["compra_cantidad"] ?></td>
										<td><?php echo ($row["compra_monto"]) ?></td>
										<td><a href="paginas/devengo/devengo_abrir.php?id=<?php echo $_GET["id"] ?>" class="btn btn-warning">ABRIR</a></td>
									</tr>
									<?php } ?>
								</tbody>

							</table>
							<!-- CONTENIDO DE LAS PAGINAS !-->
						</div>
					</div>
				</div>
			<?php endif ?>
		</div>