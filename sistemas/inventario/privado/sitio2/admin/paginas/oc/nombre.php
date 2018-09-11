<?php
extract($_POST);
extract($_GET);
$regiones = array();
$region = "SELECT * FROM acti_region WHERE region_estado = 1";
$resRegiones = mysql_query($region,$dbh);

while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

if(isset($_POST["cmd"]) AND $_POST["cmd"] == "Buscar")
{
	if($_POST["region"] <> "")
	{
		$where.="oc_region = ".$_POST["region"]." AND ";
	}

	if ($_POST["prefijo"] <> "" AND $_POST["correlativo"] <> "" AND $_POST["sufijo"] <> "") {
		$oc = $_POST["prefijo"]."-".$_POST["correlativo"]."-".$_POST["sufijo"];
		$oc = strtoupper($oc);
		$where.="oc_id2 LIKE '%".$oc."%' AND ";
	}

	$sql = "SELECT * FROM bode_orcom WHERE ".$where." oc_tipo = 0 AND oc_estado = 1";
	$res = mysql_query($sql,$dbh);
}

if(isset($_POST["cmd"]) && $_POST["cmd"] == "Actualizar")
{
	for($i = 0;$i < $totalElementos; $i++)
	{
		if($var2[$i] <> "")
		{
			mysql_query("UPDATE bode_detoc SET doc_especificacion = '".$var[$i]."' WHERE doc_id = ".$var2[$i],$dbh);
		}
	}
}
?>
<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > CAMBIAR NOMBRE</h3>
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
							<th>EDITAR</th>
						</tr>
					</thead>

					<tbody>
						<?php while($row = mysql_fetch_array($res)) { ?>
							<tr>
								<td><?php echo $row["oc_id2"] ?> </td>
								<td><?php echo $row["oc_proveenomb"] ?> </td>
								<td><?php echo $row["oc_fecha_recep"] ?> </td>
								<td><?php echo ($row["oc_estado"] = 1) ? "ACTIVO" : "ELIMINADO" ?> </td>
								<td><a href="?page=oc&action=nombre&id=<?php echo $row["oc_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>

	<?php if ($id <> ""): ?>
		<?php
		// BUSCAMOS LOS PRODUCTOS ASOCIADOS
		$sql2 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$_GET["id"];
		$res2 = mysql_query($sql2,$dbh);
		$cont = 0;
		?>
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">REGION DE DESTINO</div>
					<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
						<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th>NOMBRE DE PRODUCTO</th>
									<th>REGION</th>
									<th>CANTIDAD</th>
								</tr>
							</thead>

							<tbody>
								<?php while($row = mysql_fetch_array($res2)) { ?>
									<tr>
										<td>
											<input type="text" name="var[<?php echo $cont ?>]" value="<?php echo $row["doc_especificacion"] ?>">
											<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $row["doc_id"] ?>">
										</td>
										<td><?php echo $row["doc_region"] ?> </td>
										<td><?php echo $row["doc_cantidad"] ?> </td>
										
									</tr>
									<?php $cont++;} ?>
								</tbody>
							</table>

							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" class="btn btn-success">Actualizar</button>
								</div>
							</div>
							<input type="hidden" name="cmd" value="Actualizar">
							<input type="hidden" name="totalElementos" value="<?php echo $cont ?>">
						</form>
					</div>
				</div>
			</div>
		<?php endif ?>