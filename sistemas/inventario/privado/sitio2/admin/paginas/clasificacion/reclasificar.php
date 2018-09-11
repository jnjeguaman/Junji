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
		$where.= "a.oc_region = ".$_POST["region"]." AND ";
	}

	if ($_POST["prefijo"] <> "" AND $_POST["correlativo"] <> "" AND $_POST["sufijo"] <> "") {
		$oc = $_POST["prefijo"]."-".$_POST["correlativo"]."-".$_POST["sufijo"];
		$oc = strtoupper($oc);
		$where.="a.oc_id2 LIKE '%".$oc."%' AND ";
	}

	if($_POST["ing_guianumerotc"] <> "")
	{
		$where.="b.ing_guianumerotc LIKE '%".$_POST["ing_guianumerotc"]."%' AND ";
	}

	if($_POST["ing_guianumerorc"] <> "")
	{
		$where.="b.ing_guianumerorc LIKE '%".$_POST["ing_guianumerorc"]."%' AND ";		
	}

	$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON b.ing_oc_id = a.oc_id WHERE ".$where." a.oc_tipo = 0 AND b.ing_clasificacion = 1 AND (b.ing_estado = 1 OR b.ing_estado = 2)";
	$res = mysql_query($sql,$dbh);

}

if(isset($_POST["cmd"]) AND $_POST["cmd"] == "Reclasificar" AND $_POST["reclasificar"] == 1)
{

	// COMPROBAMOS QUE NO ESTEN PROCESADAS EN INVENTARIO
	$acti_compra = mysql_query("SELECT COUNT(id) as Total FROM acti_compra WHERE compra_ing_id = ".$_POST["ing_id"],$dbh);
	$acti_compra = mysql_fetch_array($acti_compra);
	$acti_compra = $acti_compra["Total"];
	/*
	0 : NO HA SIDO DISTRIBUIDO
	1 : FUE DISTRIBUIDO
	*/

	if($acti_compra == 0) {
		// REVERSAMOS EL BODE_INGRESO
		$ing_id = "UPDATE bode_ingreso SET ing_clasificacion = 0 WHERE ing_id = ".$_POST["ing_id"];
		$log .= $ing_id."\r\n";
		mysql_query($ing_id,$dbh);

		// REVERTSAMOS EL BODE_DETINGRESO
		$bode_detingreso = "UPDATE bode_detingreso SET ding_clasificacion = 2 WHERE ding_ing_id = ".$_POST["ing_id"];
		$log .= $bode_detingreso."\r\n";
		mysql_query($bode_detingreso,$dbh);

		$acti_compra_temporal = "UPDATE acti_compra_temporal SET compra_clasificacion = 0, compra_visible = 0 WHERE compra_ing_id = ".$_POST["ing_id"];
		$log.= $acti_compra_temporal."\r\n-------------------------------------\r\n\r\n";
		mysql_query($acti_compra_temporal,$dbh);

		// $fp = fopen("reclasificacion.txt","a+");
		// fwrite($fp, $log);
		// fclose($fp);

		echo "<script>alert('Reclasificacion realizada con exito!');window.location.href='?page=clasificacion&action=reclasificar';</script>";
	}else{ ?>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="row">
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<strong>ERROR.</strong> LA ORDEN DE COMPRA SEÑALADA / RECEPCION CONFORME O TECNICA NO SE PUEDE RECLASIFICAR DEBIDO A LAS SIGUIENTES RAZONES:
					<ul>
						<li>EL INGRESO EN INVENTARIO HA SIDO PROCESADO.</li>
					</ul>
				</div>
			</div>
		</div>
		<?php }
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
						<label class="control-label col-md-3 col-sm-3 col-xs-12">N° RECEPCION TECNICA <span class="required">*</span></label>
						<div class="col-md-1 col-sm-12 col-xs-12 form-group">
							<input type="text" name="ing_guianumerotc" id="ing_guianumerotc" class="form-control" value="<?php echo $_POST["ing_guianumerotc"] ?>">
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
								<th>RT</th>
								<th>RC</th>
								<th>ESTADO</th>
								<th>EDITAR</th>
							</tr>
						</thead>

						<tbody>
							<?php while($row = mysql_fetch_array($res)) { 
								$tipos = array(1 => "BODEGA REGIONAL",2=>"OFICINA",3=>"JARDIN INFANTIL")
								?>
								<tr>
									<td><?php echo $row["oc_id2"] ?> </td>
									<td><?php echo $row["oc_proveenomb"] ?> </td>
									<td><?php echo $row["oc_fecha_recep"] ?> </td>
									<td><?php echo $row["ing_guianumerotc"] ?> </td>
									<td><?php echo $row["ing_guianumerorc"] ?> </td>
									<td><?php echo ($row["oc_estado"] = 1) ? "ACTIVO" : "ELIMINADO" ?> </td>
									<td><a href="?page=clasificacion&action=reclasificar&id=<?php echo $row["oc_id"] ?>&ing_id=<?php echo $row["ing_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
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
			$detalle = "SELECT * FROM bode_orcom WHERE oc_id = ".$_GET["id"]." LIMIT 1";
			$detalleres = mysql_query($detalle,$dbh);
			$rowDetalle = mysql_fetch_array($detalleres);
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">RECLASIFICAR ORDEN DE COMPRA : <?php echo $rowDetalle["oc_id2"] ?>. INGRESO N° <?php echo $_GET["ing_id"] ?></div>

						<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">RECLASIFICAR <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control" name="reclasificar" id="reclasificar" required>
										<option value="" selected>Seleccionar...</option>
										<option value="1">SI</option>
										<option value="2">NO</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" class="btn btn-success">Buscar</button>
								</div>
							</div>

							<input type="hidden" name="oc_id" value="<?php echo $_GET["id"] ?>">
							<input type="hidden" name="ing_id" value="<?php echo $_GET["ing_id"] ?>">
							<input type="hidden" name="cmd" value="Reclasificar">

						</form>
					</div>
				</div>
			</div>

			<?php  
			$getDetalle = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b on a.ding_prod_id = b.doc_id WHERE a.ding_ing_id = ".$_GET["ing_id"];
// echo $getDetalle;
			$getDetaller = mysql_query($getDetalle,$dbh);
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">PRODUCTOS ASOCIADOS A LA ORDEN DE COMPRA : <?php echo $rowDetalle["oc_id2"] ?>. INGRESO N° <?php echo $_GET["ing_id"] ?></div>

						<!-- CONTENIDO DE LAS PAGINAS !-->
						<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
							<thead>
								<th>PRODUCTO</th>
								<th>CANTIDAD</th>
								<th>CLASIFICACION</th>
							</thead>

							<tbody>
								<?php while($row=mysql_fetch_array($getDetaller)) { ?>
									<tr>
										<td><?php echo $row["doc_especificacion"] ?></td>
										<td><?php echo $row["ding_cantidad"] ?></td>
										<td><?php echo ($row["ding_clasificacion"] == 1) ? "INVENTARIABLE" : "EXISTENCIA" ?></td>
									</tr>
									<?php } ?>
								</tbody>

							</table>
							<!-- CONTENIDO DE LAS PAGINAS !-->
						</div>
					</div>
				</div>
			<?php endif ?>