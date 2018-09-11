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

	$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON b.ing_oc_id = a.oc_id WHERE ".$where." a.oc_tipo = 0 AND b.ing_estado = 1";
	$res = mysql_query($sql,$dbh);
}

?>

<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > CLASIFICAR PRODUCTOS</h3>
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
							<th>ID</th>
							<th>ORDEN DE COMPRA</th>
							<th>N° RECEPCION TÉCNICA</th>
							<th>N° RECEPCION CONFORME</th>
							<th>EDITAR</th>
						</tr>
					</thead>
					<tbody>
						<?php

						while($row = mysql_fetch_array($res)) { ?>
						<tr>
							<td><?php echo $row["ing_id"] ?></td>
							<td><?php echo $row["oc_id2"] ?></td>
							<td><?php echo $row["ing_guianumerotc"] ?></td>
							<td><?php echo $row["ing_guianumerorc"] ?></td>
							<td><a href="?page=clasificacion&action=productos&id=<?php echo $row["ing_id"] ?>" class="btn btn-warning">EDITAR</a></td>
						</tr>

						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php elseif($_GET["id"] <> ""): ?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">PRODUCTOS ASOCIADOS AL INGRESO N° <?php echo $_GET["id"] ?></div>
				<form action="paginas/clasificacion/productos_reclasificar.php" method="POST" onsubmit="return valida()">
				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<tr class="headings">
						<td>OP</td>
							<th>ID</th>
							<th>PRODUCTO</th>
							<th>CANTIDAD</th>
							<th>UBICACION</th>
							<th>CLASIFICACION</th>
							<th>RECLASIFICACION</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$contador = 1;
						$sql3 = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON b.doc_id = a.ding_prod_id WHERE a.ding_ing_id = ".$_GET["id"];
						$res3 = mysql_query($sql3);
						while($row3 = mysql_fetch_array($res3)) { ?>
					<tr>
					<td><input type="checkbox" name="var1[<?php echo $contador ?>]" id="var1_<?php echo $contador ?>" value="<?php echo $row3["ding_id"] ?>" onClick="setRequerido(<?php echo $contador ?>)"></td>
						<td><?php echo $row3["ding_id"] ?></td>
						<td><?php echo mb_convert_encoding($row3["doc_especificacion"], "UTF-8") ?></td>
						<td><?php echo $row3["ding_unidad"] ?></td>
						<td><?php echo $row3["ding_ubicacion"] ?></td>
						<td>
							<?php if ($row3["ding_clasificacion"] == ""): ?>
								SIN CLASIFICACION
							<?php elseif($row3["ding_clasificacion"] == 1): ?>
								INVENTARIABLE
							<?php elseif($row3["ding_clasificacion"] == 0): ?>
								EXISTENCIA
							<?php endif ?>
						</td>
						<td>
							<select name="var2[<?php echo $contador ?>]" id="clasificacion_<?php echo $contador?>" class="form-control">
								<option value="">Seleccionar...</option>
								<option value="1">INVENTARIABLE</option>
								<option value="0">EXISTENCIA</option>
							</select>
						</td>
					</tr>
						<?php $contador++;} ?>
					</tbody>

					<tfoot>
						<tr>
							<td colspan="7" align="right"><button type="submit" class="btn btn-success">Enviar</button></td>
						</tr>
					</tfoot>
				</table>
				<input type="hidden" name="ding_ing_id" value="<?php echo $_GET["id"] ?>">
				<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
				</form>

			</div>
		</div>
	</div>

<?php else: ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<strong>ERROR.</strong> LA ORDEN DE COMPRA SEÑALADA / RECEPCION CONFORME O TECNICA NO SE PUEDE UBICAR:
				<ul>
					<li>EL INGRESO EN INVENTARIO HA SIDO PROCESADO.</li>
					<li>INGRESO ANULADO</li>
				</ul>
			</div>
		</div>
	</div>
<?php endif ?>

<script type="text/javascript">
	function valida()
	{
		var numberOfChecked = $("input:checkbox:checked").length;
		if(numberOfChecked == 0)
		{
			alert("Favor de marcar almenos 1 item a modificar");
			return false;
		}else{

		}
		
	}

	function setRequerido(posicion)
	{
		console.log(posicion);
		if($("#var1_"+posicion).is(":checked"))
		{
			$("#clasificacion_"+posicion).prop("required",true);
		}else{
			$("#clasificacion_"+posicion).prop("required",false);
		}
	}
</script>