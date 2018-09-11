<?php
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

	$sql = "SELECT * FROM bode_orcom WHERE ".$where." oc_tipo = 0 AND oc_aperturado = 0 AND oc_estado = 1";
	$res = mysql_query($sql,$dbh);
}


if($_POST["cmd"] == "Aperturar")
{
	// BUSCAMOS LOS DATOS DE LA ORDEN DE COMPRA ORIGINAL
	$oc = "SELECT * FROM bode_orcom WHERE oc_id = ".$_POST["oc_id"];
	$oc = mysql_query($oc,$dbh);
	$oc = mysql_fetch_array($oc);

	// RECORREMOS LOS PROGRAMAS
	for ($i=0; $i < $_POST["totalElementos"]; $i++) { 
			// INGRESAMOS LA OC EN LA BD
		$nuevaOC ="INSERT INTO bode_orcom VALUES (
		NULL,
		'".$oc["oc_id2"]."',
		'".$oc["oc_region"]."',
		'".$oc["oc_region2"]."',
		'".$oc["oc_nombre_oc"]."',
		'".$_POST["programa"][$i]."',
		'".$oc["oc_fecha"]."',
		'".array_sum($_POST["doc_cantidad"][$i])."',
		'".$oc["oc_monto"]."',
		'".$oc["oc_descuento"]."',
		'".$oc["oc_fecha_recep"]."',
		'".$oc["oc_usu"]."',
		'".$oc["oc_prod_id"]."',
		'".$oc["oc_observaciones"]."',
		'".$oc["oc_proveerut"]."',
		'".$oc["oc_proveedig"]."',
		'".$oc["oc_proveenomb"]."',
		'".$oc["oc_swdespacho"]."',
		'".$oc["oc_folioguia"]."',
		'".$oc["oc_grupo"]."',
		'".$oc["oc_umedida"]."',
		'".$oc["oc_guiafecha"]."',
		'".$oc["oc_guiaabaste"]."',
		'".$oc["oc_guiadestina"]."',
		'".$oc["oc_emisor"]."',
		'".$oc["oc_estado"]."',
		'".$oc["oc_numerooc"]."',
		'".$oc["oc_tipo_guia"]."',
		'".$oc["oc_obs"]."',
		'".$oc["oc_tipo"]."',
		'".$oc["oc_mas_id"]."',
		'".$oc["oc_sc"]."',
		'".$oc["oc_envio_fecha"]."',
		'".$oc["oc_rutatc"]."',
		'".$oc["oc_archivotc"]."',
		'".$oc["oc_chofer"]."',
		'".$oc["oc_patente"]."',
		'".$oc["oc_conversion"]."',
		'".$oc["oc_despacho_folio"]."',
		0,
		'".$oc["oc_activo"]."',
		'".$oc["oc_gasto"]."',
		'".$oc["oc_region_destino"]."',
		'".$oc["oc_dte_id"]."',
		'".$oc["oc_sp_id"]."',
		'".$oc["oc_wms"]."',
		'".$oc["oc_usuario"]."'
		);";
		mysql_query($nuevaOC,$dbh);
		$ultimo = mysql_insert_id();

		// INGRESAMOS LOS PRODUCTOS ASOCIADOS
		for ($x=0; $x < $_POST["totalProductos"]; $x++) { 

			// VERIFICAMOS QUE NO TENGA VALOR 0 O VACIO
			if($_POST["doc_cantidad"][$i][$x] <> 0 AND $_POST["doc_cantidad"][$i][$x] <> "")
			{
				$prodDet = "SELECT * FROM bode_detoc WHERE doc_id = ".$_POST["doc_id"][$i][$x];
				$prodDet = mysql_query($prodDet,$dbh);
				$prodDet = mysql_fetch_array($prodDet);

				$nuevoDetOC = "INSERT INTO bode_detoc VALUES (
				NULL,
				'".$ultimo."',
				'".$prodDet["doc_prod_id"]."',
				'".$prodDet["doc_especificacion"]."',
				'".$_POST["doc_cantidad"][$i][$x]."',
				'".$prodDet["doc_valor_unit"]."',
				'".$prodDet["doc_valor_unit2"]."',
				'".$prodDet["doc_recibidos"]."',
				'".$prodDet["doc_tecnicos"]."',
				'".$prodDet["doc_final"]."',
				'".$prodDet["doc_stock"]."',
				'".$prodDet["doc_rechazados"]."',
				'".$prodDet["doc_despachados"]."',
				'".$prodDet["doc_region"]."',
				'".$prodDet["doc_origen_id"]."',
				'".$prodDet["doc_estado"]."',
				'".$prodDet["doc_estadocierre"]."',
				'".$prodDet["doc_numerooc"]."',
				'".$prodDet["doc_unit"]."',
				'".$prodDet["doc_moneda"]."',
				'".$prodDet["doc_valor_moneda"]."',
				'".$prodDet["doc_conversion"]."',
				'".$prodDet["doc_umedida"]."',
				'".$prodDet["doc_factor"]."',
				'".$prodDet["doc_mas_id"]."',
				'".$prodDet["doc_especificacion2"]."',
				'".$prodDet["doc_clasificacion"]."',
				'".$prodDet["doc_cta_contable"]."',
				'".$prodDet["doc_item"]."',
				'".$prodDet["doc_activo"]."',
				'".$prodDet["doc_gasto"]."',
				'".$prodDet["doc_sp_rel_doc_id"]."',
				'".$prodDet["doc_id_mercado_publico"]."'

				);";
				mysql_query($nuevoDetOC,$dbh);
			}
		}
	}
	mysql_query("UPDATE bode_orcom SET oc_estado = 0,oc_aperturado = 1 WHERE oc_id = ".$_GET["id"],$dbh);
}

?>

<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > APERTURAR ORDEN DE COMPRA</h3>
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
								<td><a href="?page=oc&action=aperturar&id=<?php echo $row["oc_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
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
		// BUSCAMOS LOS PRODUCTOS ASOCIADOS
		$sql2 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$_GET["id"];
		$res2 = mysql_query($sql2,$dbh);

		// RECORREMOS LOS PRODUCTOS ENCONTRADOS
		$resp = false;
		while($row2 = mysql_fetch_array($res2))
		{
			// COMPROBAMOS QUE NINGUN PRODUCTO HALLA SIDO INGRESADO
			$check = "SELECT COUNT(ding_id) as Total FROM bode_detingreso WHERE ding_prod_id = ".$row2["doc_id"];
			$resCheck = mysql_query($check,$dbh);
			$rowCheck = mysql_fetch_array($resCheck);
			if($rowCheck["Total"] > 0)
			{
				$resp = true;
				break;
			}
		}
		?>
		<?php if ($resp): ?>
			<div class="row">
				<div class="alert alert-danger alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
					<strong>ERROR.</strong> LA ORDEN DE COMPRA SEÑALADA NO SE PUEDE APERTURAR DEBIDO A LAS SIGUIENTES RAZONES:
					<ul>
						<li>LA ORDEN DE COMPRA TIENE INGRESOS ASOCIADOS.</li>
					</ul>
				</div>
			</div>
			<?php //mysql_query("UPDATE bode_orcom SET oc_aperturado = 1 WHERE oc_id = ".$_GET["id"]) ?>
		<?php else: ?>

			<?php
			$detalle = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$_GET["id"];
			$detalleRes = mysql_query($detalle,$dbh);
			$arrDet = array();
			while($rowDet = mysql_fetch_array($detalleRes)){
				$arrDet[] = $rowDet;
			}
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">APERTURAR</div>
						<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">N° DE PROGRAMAS <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control" name="n_programa" id="n_programa" onChange="this.form.submit()">
										<option value="" selected>Seleccionar...</option>
										<?php for ($i=0;$i<3;$i++): ?>
											<option value="<?php echo $i ?>" <?php if($_POST["n_programa"] == $i){echo"selected";}?>><?php echo $i ?></option>
										<?php endfor ?>
									</select>
								</div>
							</div>
						</form>
					</div>
					
					<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">

					<!-- MOSTRAMOS LOS PROGRAMAS SOLICITADOS -->
						<?php for ($i=0;$i<$_POST["n_programa"];$i++): ?>
							<div class="x_panel">
								<div class="x_title">APERTURA N° <?php echo ($i+1) ?></div>

								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR EL PROGRAMA <span class="required">*</span></label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control" name="programa[<?php echo $i ?>]" required>
											<option value="" selected>Seleccionar...</option>
											<option value="P1">P1</option>
											<option value="P2">P2</option>
										</select>
									</div>
								</div>
								<hr>
								<!-- CONTENIDO -->

								<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
									<thead>

										<tr>
											<th>PRODUCTO</th>
											<th>CANTIDAD</th>
											<th>VALOR UNITARIO</th>
										</tr>
									</thead>

									<tbody>
										<?php $contador = 0 ?>
										<?php foreach ($arrDet as $key => $value): ?>
											<tr>
												<td><input type="hidden" name="doc_id[<?php echo $i ?>][<?php echo $contador ?>]" value="<?php echo $value["doc_id"] ?>"><?php echo $value["doc_especificacion"] ?></td>
												<td><input type="number" name="doc_cantidad[<?php echo $i ?>][<?php echo $contador ?>]" min="0" max="<?php echo $value["doc_cantidad"] ?>" value="<?php echo $value["doc_cantidad"] ?>"></td>
												<td><?php echo $value["doc_unit"] ?></td>
											</tr>
											<?php $contador++ ?>
										<?php endforeach ?>

									</tbody>
								</table>
								<!-- FIN CONTENIDO -->
							</div>
						<?php endfor ?>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success">Aperturar</button>
							</div>
						</div>

					</div>
				</div>
			</div>


			<input type="hidden" name="cmd" value="Aperturar">
			<input type="hidden" name="oc_id" value="<?php echo $_GET["id"] ?>">
			<input type="hidden" name="totalElementos" value="<?php echo $_POST["n_programa"] ?>">
			<input type="hidden" name="totalProductos" value="<?php echo count($arrDet) ?>">

		</form>
	<?php endif ?>

<?php endif ?>