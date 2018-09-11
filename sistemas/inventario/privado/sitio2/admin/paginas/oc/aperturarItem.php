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

if(isset($_POST["cmd"]) AND $_POST["cmd"] == "proceder")
{
	$total = $_POST["total"];

	for ($i=0; $i < $total; $i++) {
		$data = mysql_query("SELECT * FROM bode_detoc WHERE doc_id = ".$var6[$i],$dbh);
		$row = mysql_fetch_array($data);
		// echo "DOC_ID : ".$var6[$i]."<br>REGION : ".$var4[$i]."<br>CANTIDAD : ",$var5[$i]."<br>";

		// PASO N° 1 : RESTAMOS LA CANTIDAD ENVIADA AL PRODUCTO ORIGINAL
		$paso1 = "UPDATE bode_detoc SET 
		doc_cantidad = doc_cantidad - ".$var5[$i].",
		doc_valor_unit = ".$var5[$i] * $row["doc_unit"].",
		doc_valor_unit2 = ".$var5[$i] * $row["doc_unit"]." 
		WHERE doc_id =  ".$var6[$i];
		mysql_query($paso1,$dbh);
		
		// PASO N° 2 : AGREGAMOS LA NUEVA LINEA A LA BASE DE DATOS
		$paso2 = "INSERT INTO bode_detoc VALUES(
		NULL,
		".$row["doc_oc_id"].",
		".$row["doc_prod_id"].",
		'".$row["doc_especificacion"]."',
		".$var5[$i].",
		".$var5[$i] * $row["doc_unit"].",
		".$var5[$i] * $row["doc_unit"].",
		".$row["doc_recibidos"].",
		".$row["doc_tecnicos"].",
		".$row["doc_final"].",
		".$row["doc_stock"].",
		".$row["doc_rechazados"].",
		".$row["doc_despachados"].",
		".$var4[$i].",
		".$row["doc_origen_id"].",
		'".$row["doc_estado"]."',
		".$row["doc_estadocierre"].",
		'".$row["doc_numerooc"]."',
		".$row["doc_unit"].",
		'".$row["doc_moneda"]."',
		".$row["doc_valor_moneda"].",
		".$row["doc_conversion"].",
		'".$row["doc_umedida"]."',
		".$row["doc_factor"].",
		".$row["doc_mas_id"].",
		'".$row["doc_especificacion2"]."',
		".$row["doc_clasificacion"].",
		'".$row["doc_cta_contable"]."',
		".$row["doc_item"].",
		".$row["doc_activo"].",
		".$row["doc_gasto"].",
		".$row["doc_sp_rel_doc_id"].",
		'".$row["doc_id_mercado_publico"]."'
		)";
		mysql_query($paso2,$dbh);
	}

	echo "<script>alert('PROCESO REALIZADO CON EXITO'); window.location.href='?page=oc&action=aperturarItem';</script>";
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
								<td><a href="?page=oc&action=aperturarItem&id=<?php echo $row["oc_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>
	
	<!-- SE HA SELECCIONADO UNA O/C -->
	<?php if (isset($_GET["id"]) AND mysql_num_rows($resProd) > 0): ?>
		<?php 
		$total = mysql_query("SELECT COUNT(ing_id) as Total FROM bode_ingreso WHERE ing_oc_id = ".$_GET["id"],$dbh);
		$total = mysql_fetch_array($total);
		$total = intval($total["Total"]);
		?>
		<div class="row">
		<?php if ($total === 0 || 1==1): ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">REGION DE DESTINO</div>
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
										<input type="checkbox" name="var[<?php echo $cont ?>]" value="<?php echo $value["doc_id"] ?>">
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
<?php endif ?>

<?php if (isset($_POST["cmd"]) AND $_POST["cmd"] == "paso1"): ?>

	<?php
	extract($_POST);
	$_SESSION["doc_id"] = array();
	for ($i=0; $i < $_POST["totalElementos"]; $i++) { 
		if($var[$i] <> "")
		{
			$_SESSION["doc_id"][] = array(
				"doc_id" =>$var[$i],
				"doc_especificacion" =>$var2[$i],
				"doc_cantidad" =>$var3[$i]
				);
		}
	}

	?>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">REGION DE DESTINO</div>
				<form action="<?php echo $_SESSION["REQUEST_URI"] ?>" method="POST">
					<?php for($x=0;$x<1;$x++): ?>
						<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
							<thead>
								<tr class="headings">
									<td>REGION DESTINO</td>
									<td>PRODUCTO</td>
									<td>CANTIDAD</td>
								</tr>
							</thead>
							<?php for($z=0;$z<count($_SESSION["doc_id"]);$z++): ?>
								<tr class="headings">
									<td>
										<select name="var4[<?php echo $z ?>]" required>
											<option value="">Seleccionar...</option>
											<?php foreach ($regiones as $key => $value): ?>
												<option value="<?php echo $value["region_id"] ?>"><?php echo $value["region_glosa"] ?></option>
											<?php endforeach ?>
										</select>
									</td>

									<td><?php echo $_SESSION["doc_id"][$z]["doc_especificacion"] ?></td>

									<td>
										<input type="number" name="var5[<?php echo $z ?>]" id="" min="0" max="<?php echo $_SESSION["doc_id"][$z]["doc_cantidad"] ?>" value="<?php echo $_SESSION["doc_id"][$z]["doc_cantidad"] ?>" required>
										<input type="hidden" name="var6[<?php echo $z ?>]" id="" value="<?php echo $_SESSION["doc_id"][$z]["doc_id"] ?>"
									</td>
								</tr>	
							<?php endfor ?>
						</table>
					<?php endfor ?>	
					<tfoot>
						<tr>
							<td colspan="5"><button class="btn btn-success">Enviar</button></td>
						</tr>
					</tfoot>
					<input type="hidden" name="cmd" value="proceder">
					<input type="hidden" name="inicio" value="<?php echo $x ?>">
					<input type="hidden" name="total" value="<?php echo count($_SESSION["doc_id"]) ?>">
				</form>
			</div>
		</div>
	</div>		
<?php endif ?>

<script type="text/javascript">
	function valida()
	{
		var numberOfChecked = $('input:checkbox:checked').length;
		numberOfChecked = parseInt(numberOfChecked);
		if(numberOfChecked == 0)
		{
			alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA");
			return false;
		}else{
			return true;
		}
	}
</script>