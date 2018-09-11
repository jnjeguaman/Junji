<?php
extract($_POST);
extract($_GET);
$regiones = array();
$region = "SELECT * FROM acti_region WHERE region_estado = 1";
$resRegiones = mysql_query($region,$dbh);
$cont = 0;
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

if(isset($cmd) && $cmd === "Buscar")
{
	// BUSCAMOS TODOS LOS INGRESOS QUE ESTEN APROBADOS

	if($_POST["region"] <> "")
	{
		$where.="a.oc_region = ".$_POST["region"]." AND ";
	}

	if($rt <> "")
	{
		$where.="b.ing_guianumerotc = ".$rt." AND ";
	}else{
		$where.="b.ing_guianumerotc <> 0 AND ";
	}

	if($rc <> "")
	{
		$where.="b.ing_guianumerorc = ".$rc." AND ";
	}else{
		$where.="b.ing_guianumerorc <> 0 AND ";
	}

	if ($_POST["prefijo"] <> "" AND $_POST["correlativo"] <> "" AND $_POST["sufijo"] <> "") {
		$oc = $_POST["prefijo"]."-".$_POST["correlativo"]."-".$_POST["sufijo"];
		$oc = strtoupper($oc);
		$where.="a.oc_id2 LIKE '%".$oc."%' AND ";
	}

	$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON b.ing_oc_id = a.oc_id WHERE ".$where." b.ing_aprobado <> ''";
	$res = mysql_query($sql,$dbh);

	
}

if(isset($id) AND is_numeric($id))
{
	$productos = mysql_query("SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON b.doc_id = a.ding_prod_id WHERE a.ding_ing_id = ".$id,$dbh);
	$productosArray = array();
	while($row = mysql_fetch_array($productos))
	{
		$productosArray[] = $row;
	}	
}

if(isset($cmd) && $cmd == "Anular" AND $anular == 1)
{
	$sql_verifica = "SELECT * FROM bode_ingreso WHERE ing_id = ".$ing_id;
	$res_verifica = mysql_query($sql_verifica,$dbh);
	$row_verifica = mysql_fetch_array($res_verifica);
	if($row_verifica["ing_estado"] == 0)
	{
		echo "<script>alert('EL INGRESO YA HA SIDO ANULADO CON ANTERIORIDAD');window.location.href='?page=rtrc&action=anular';</script>";
	}else{
		$asociados = mysql_query("SELECT * FROM bode_detingreso WHERE ding_ing_id = ".$ing_id,$dbh);
		$asociadosArray = array();
		while($row = mysql_fetch_array($asociados))
		{
			$asociadosArray[] = $row;
		}

		foreach ($asociadosArray as $key => $value) {
			$query = mysql_query("SELECT count(b.doc_id) as Total FROM bode_detingreso a INNER JOIN bode_detoc b ON b.doc_origen_id = a.ding_id WHERE a.ding_id = ".$value["ding_id"]." AND b.doc_estado <> 'ELIMINADO'",$dbh);
			$res = mysql_fetch_array($query);
			$total += intval($res["Total"]);
		}
		if($total === 0)
		{
			foreach ($asociadosArray as $key => $value) {
				mysql_query("UPDATE bode_detoc SET doc_stock = doc_stock - (".$value["ding_cantidad"]." - ".$value[9]."), doc_recibidos = doc_recibidos - (".$value["ding_cantidad"]." - ".$value["ding_cant_rechazo"].") WHERE doc_id = ".$value["ding_prod_id"],$dbh);
			}
			mysql_query("UPDATE bode_ingreso SET ing_estado = 0 WHERE ing_id = ".$ing_id,$dbh);
			echo "<script>alert('EL INGRESO HA SIDO ANULADO EXITOSAMENTE!');window.location.href='?page=rtrc&action=anular';</script>";
		}else{
			echo "<script>alert('EL INGRESO TIENE DESPACHO ASOCIADOS');window.location.href='?page=rtrc&action=anular';</script>";
		}
	}
	
}
?>

<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > ANULAR INGRESO</h3>
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
					<label class="control-label col-md-3 col-sm-3 col-xs-12">RECEPCION TECNICA <span class="required">*</span></label>
					
					<div class="col-md-1 col-sm-12 col-xs-12 form-group">
						<input type="text" name="rt" id="rt" class="form-control" value="<?php echo $_POST["rt"] ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">RECEPCION CONFORME <span class="required">*</span></label>
					
					<div class="col-md-1 col-sm-12 col-xs-12 form-group">
						<input type="text" name="rc" id="rc" class="form-control" value="<?php echo $_POST["rc"] ?>">
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
							<th>ESTADO</th>
							<th>RECEPCION TECNICA</th>
							<th>RECEPCION CONFORME</th>
							<th>APROBADO POR</th>
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
								<td><?php echo ($row["oc_estado"] = 1) ? "ACTIVO" : "ELIMINADO" ?> </td>
								<td><?php echo $row["ing_guianumerotc"] ?> </td>
								<td><?php echo $row["ing_guianumerorc"] ?> </td>
								<td><?php echo $row["ing_aprobado"] ?> </td>
								<td><a href="?page=rtrc&action=anular&id=<?php echo $row["ing_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>

	<?php if (isset($id) AND is_numeric($id)): ?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">PRODUCTOS INGRESADOS</div>
					<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
						<thead>
							<tr class="heading">
								<th>#ID</th>
								<th>FECHA INGRESO</th>
								<th>CANTIDAD</th>
								<th>PRODUCTO</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($productosArray as $key => $value): ?>
								<tr>
									<td><?php echo $value["ding_id"] ?></td>
									<td><?php echo $value["ding_fentrega"] ?></td>
									<td><?php echo $value["ding_cantidad"] ?></td>
									<td><?php echo $value["doc_especificacion"] ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">PRODUCTOS INGRESADOS</div>

					<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">ANULAR <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="anular" id="anular" required>
									<option value="" selected>Seleccionar...</option>
									<option value="1">SI</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success">Buscar</button>
							</div>
						</div>

						<input type="hidden" name="cmd" value="Anular">
						<input type="hidden" name="ing_id" value="<?php echo $id ?>">

					</form>
				</div>
			</div>
		</div>		
	<?php endif ?>