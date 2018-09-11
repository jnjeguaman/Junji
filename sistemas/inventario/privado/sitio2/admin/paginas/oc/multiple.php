<?php
extract($_POST);
$regiones = array();
$region = "SELECT * FROM acti_region WHERE region_estado = 1";
$resRegiones = mysql_query($region,$dbh);
$cont = 0;
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

// RESULTADOS DE LA BUSQUEDA
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

$productos = array();
if (isset($_GET["id"]) AND is_numeric($_GET["id"])) {
	$prod = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$_GET["id"]." AND doc_estado <> 'B'";
	$resProd = mysql_query($prod,$dbh);
	while($row = mysql_fetch_array($resProd))
	{
		$productos[] = $row;
	}
}


if(isset($_POST["cmd"]) && $_POST["cmd"] == "Aperturar")
{
	$sumaBienes = array_sum($_POST["doc_cantidad"]);
	mysql_query("UPDATE bode_detoc SET doc_cantidad = doc_cantidad - ".$sumaBienes." WHERE doc_id = ".$_POST["doc_id"],$dbh);

	$detalleProducto = mysql_query("SELECT * FROM bode_detoc WHERE doc_id = ".$_POST["doc_id"],$dbh);
	$detalleProducto = mysql_fetch_array($detalleProducto);

	for ($i=1; $i <= $_POST["totalElementos"]; $i++) { 
		mysql_query("INSERT INTO bode_detoc VALUES (null,
		".$detalleProducto["doc_oc_id"].",
		".$detalleProducto["doc_prod_id"].",
		'".$_POST["doc_especificacion"][$i]."',
		".$_POST["doc_cantidad"][$i].",
		".$_POST["doc_unit"][$i] * $_POST["doc_cantidad"][$i].",
		".$_POST["doc_unit"][$i] * $_POST["doc_cantidad"][$i].",
		".$detalleProducto["doc_recibidos"].",
		".$detalleProducto["doc_tecnicos"].",
		".$detalleProducto["doc_final"].",
		".$detalleProducto["doc_stock"].",
		".$detalleProducto["doc_rechazados"].",
		".$detalleProducto["doc_despachados"].",
		".$detalleProducto["doc_region"].",
		".$detalleProducto["doc_origen_id"].",
		'".$detalleProducto["doc_estado"]."',
		".$detalleProducto["doc_estadocierre"].",
		'".$detalleProducto["doc_numerooc"]."',
		".$_POST["doc_unit"][$i].",
		'".$detalleProducto["doc_moneda"]."',
		".$detalleProducto["doc_valor_moneda"].",
		".$_POST["doc_unit"][$i].",
		'".$detalleProducto["doc_umedida"]."',
		".$detalleProducto["doc_factor"].",
		".$detalleProducto["doc_mas_id"].",
		'".$detalleProducto["doc_especificacion2"]."',
		".$detalleProducto["doc_clasificacion"].",
		'".$detalleProducto["doc_cta_contable"]."',
		'".$detalleProducto["doc_item"]."',
		'".$detalleProducto["doc_activo"]."',
		'".$detalleProducto["doc_gasto"]."',
		'".$detalleProducto["doc_sp_rel_doc_id"]."',
		'".$detalleProducto["doc_id_mercado_publico"]."'
		)",$dbh);
	}
}


if (isset($_POST["cmd"]) AND $_POST["cmd"] == "paso1"){ 
		unset($_SESSION["doc_id"]);
		$_SESSION["doc_id"] = array();
		for ($i=0; $i < $_POST["totalElementos"]; $i++) { 
			if($_POST["var1"][$i] <> "")
			{

				$detalleProducto = mysql_query("SELECT * FROM bode_detoc WHERE doc_id = ".$_POST["var1"][$i],$dbh);
				$detalleProducto = mysql_fetch_array($detalleProducto);

				$_SESSION["doc_id"][] = array(
				"doc_id" => $detalleProducto["doc_id"],
				"doc_especificacion" => $detalleProducto["doc_especificacion"],
				"doc_cantidad" => $detalleProducto["doc_cantidad"],
				"doc_unit" => $detalleProducto["doc_conversion"]
				);
			}

		}
	}
	
?>

<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > APERTURAR ITEM</h3>
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
						<?php while($row = mysql_fetch_array($res)) { 
							$tipos = array(1 => "BODEGA REGIONAL",2=>"OFICINA",3=>"JARDIN INFANTIL")
							?>
							<tr>
								<td><?php echo $row["oc_id2"] ?> </td>
								<td><?php echo $row["oc_proveenomb"] ?> </td>
								<td><?php echo $row["oc_fecha_recep"] ?> </td>
								<td><?php echo ($row["oc_estado"] = 1) ? "ACTIVO" : "ELIMINADO" ?> </td>
								<td><a href="?page=oc&action=multiple&id=<?php echo $row["oc_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>
	
	<div class="row">
		<?php if (count($productos) > 0 && isset($_GET["id"])): ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">SELECCIONAR PRODUCTO</div>
					<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" onSubmit="return valida()">
						<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<th></th>
									<th>ID</th>
									<th>PRODUCTO</th>
									<th>REGION DE DESTINO</th>
									<th>CANTIDAD</th>
								</tr>
							</thead>

							<?php foreach ($productos as $key => $value): ?>
								<tr>
									<td>
										<input type="checkbox" name="var1[<?php echo $cont ?>]" value="<?php echo $value["doc_id"] ?>" <?php if($_SESSION["doc_id"][0]["doc_id"] == $value["doc_id"]){echo"checked";}?>>
										<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $value["doc_especificacion"] ?>">
										<input type="hidden" name="var3[<?php echo $cont ?>]" value="<?php echo $value["doc_cantidad"] ?>">
									</td>
									<td><?php echo $value["doc_id"] ?></td>
									<td><?php echo $value["doc_especificacion"] ?></td>
									<td><?php echo $value["doc_region"] ?></td>
									<td><?php echo $value["doc_cantidad"] ?></td>
								</tr>
								<?php $cont++; ?>
							<?php endforeach ?>
							<tfoot>
								<tr>
									<td colspan="5"><button class="btn btn-success">Enviar</button></td>
								</tr>
							</tfoot>
						</table>
						<input type="hidden" name="cmd" value="paso1">
						<input type="hidden" name="totalElementos" value="<?php echo $cont ?>">
					</form>
				</div>
			</div>
		<?php else: ?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<strong>ERROR.</strong> LA ORDEN DE COMPRA SEÑALADA NO SE PUEDE APERTURAR DEBIDO A LAS SIGUIENTES RAZONES:
				<ul>
					<li>LA ORDEN DE COMPRA TIENE INGRESOS ASOCIADOS.</li>
				</ul>
			</div>
		<?php endif ?>
	</div>

	<?php if (isset($_POST["cmd"]) && $_POST["cmd"] == "paso1"): ?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">APERTURAR</div>
				<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">N° DE LINEAS <span class="required">*</span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select class="form-control" name="n_linea" id="n_linea" onChange="this.form.submit()">
								<option value="" selected>Seleccionar...</option>
								<?php for ($i=1;$i<=30;$i++): ?>
									<option value="<?php echo $i ?>" <?php if($_POST["n_linea"] == $i){echo"selected";}?>><?php echo $i ?></option>
								<?php endfor ?>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (isset($_POST["n_linea"]) && $_POST["n_linea"] > 0): ?>
		<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
			<div class="x_panel">
				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<tr>
							<th>APERTURA N°</th>
							<th>PRODUCTO</th>
							<th>CANTIDAD</th>
							<th>VALOR UNITARIO</th>
						</tr>
					</thead>
					<?php for ($i=1;$i<=$_POST["n_linea"];$i++): ?>
						<tbody>
							<?php $contador = 0 ?>
							<?php foreach ($_SESSION["doc_id"] as $key => $value): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><input type="text" name="doc_especificacion[<?php echo $i ?>]" value="<?php echo $value["doc_especificacion"] ?>" class="col-md-12"></td>
									<td><input type="number" name="doc_cantidad[<?php echo $i ?>]" min="0"  value="<?php echo $value["doc_cantidad"] ?>"></td>
									<td><input type="text" name="doc_unit[<?php echo $i ?>]" value="<?php echo $value["doc_unit"] ?>"></td>
								</tr>
								<?php $contador++ ?>
							<?php endforeach ?>
						</tbody>
					<?php endfor ?>
				</table>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<button type="submit" class="btn btn-success">Aperturar</button>
				</div>
			</div>
			<input type="hidden" name="cmd" value="Aperturar">
			<input type="hidden" name="oc_id" value="<?php echo $_GET["id"] ?>">
			<input type="hidden" name="totalElementos" value="<?php echo $_POST["n_linea"] ?>">
			<input type="hidden" name="doc_id" value="<?php echo $_SESSION["doc_id"][0]["doc_id"] ?>">
		</form>
	<?php endif ?>


