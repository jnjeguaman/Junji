<?php
extract($_POST);
$regiones = array();
$region2 = "SELECT * FROM acti_region WHERE region_estado = 1";
$resRegiones = mysql_query($region2,$dbh);
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

if(isset($cmd) AND $cmd == "Actualizar")
{
	$update = mysql_query("UPDATE bode_detingreso SET ding_fentrega = '".$ding_fentrega."' WHERE ding_ing_id = ".$id,$dbh);
	echo $update;
}

if(isset($cmd) AND $cmd == "Buscar")
{

	if($region <> "")
	{
		$where.= "b.ing_region = ".$region." AND ";
	}

	if ($_POST["prefijo"] <> "" AND $_POST["correlativo"] <> "" AND $_POST["sufijo"] <> "") {
		$oc = $_POST["prefijo"]."-".$_POST["correlativo"]."-".$_POST["sufijo"];
		$oc = strtoupper($oc);
		$where.="a.oc_id2 LIKE '%".$oc."%' AND ";
	}

	if($ing_guianumerotc <> "")
	{
		$where.="b.ing_guianumerotc = ".$ing_guianumerotc." AND ";
	}

	if($ing_guianumerorc <> "")
	{
		$where.="b.ing_guianumerorc = ".$ing_guianumerorc." AND ";
	}
	$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON b.ing_oc_id = a.oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = b.ing_id WHERE ".$where." a.oc_estado = 1 AND (b.ing_guianumerorc <> 0 || b.ing_guianumerorc <> '') AND (b.ing_guianumerotc <> 0 || b.ing_guianumerotc <> '') GROUP BY b.ing_guianumerotc,b.ing_guianumerorc";

	$res = mysql_query($sql,$dbh);
}
?>
<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > FECHA DE INGRESO</h3>
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
							<th>RECEPCION TECNICA N°</th>
							<th>RECEPCION CONFORME N°</th>
							<th>FECHA DE ENTREGA</th>
							<th>EDITAR</th>
						</tr>
					</thead>

					<tbody>
						<?php while($row = mysql_fetch_array($res)) { ?>
							<tr>
								<td><?php echo $row["oc_id2"] ?></td>
								<td><?php echo $row["ing_guianumerotc"] ?></td>
								<td><?php echo $row["ing_guianumerorc"] ?></td>
								<td><?php echo $row["ding_fentrega"] ?></td>
								<td><a href="?page=rtrc&action=fecha&id=<?php echo $row["ing_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>		
	<?php endif ?>

	<?php if (isset($id) && is_numeric($id)): ?>
		<?php
		$detalle = mysql_query("SELECT * FROM bode_detingreso WHERE ding_ing_id = ".$id." LIMIT 1",$dbh);
		$row1 = mysql_fetch_array($detalle);
		$detalle2 = mysql_query("SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id WHERE ing_id = ".$id." LIMIT 1",$dbh);
		$row2 = mysql_fetch_array($detalle2);
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">REGION DE DESTINO</div>
					<form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">

						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">ORDEN DE COMPRA <span class="required">*</span></label>
							<div class="col-md-4 col-sm-12 col-xs-12 form-group">
								<input type="text" disabled class="form-control" value="<?php echo $row2["oc_id2"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">RECEPCION TECNICA N° <span class="required">*</span></label>
							<div class="col-md-4 col-sm-12 col-xs-12 form-group">
								<input type="text" disabled class="form-control" value="<?php echo $row2["ing_guianumerotc"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">RECEPCION CONFORME N° <span class="required">*</span></label>
							<div class="col-md-4 col-sm-12 col-xs-12 form-group">
								<input type="text" disabled class="form-control" value="<?php echo $row2["ing_guianumerorc"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">FECHA DE ENTREGA <span class="required">*</span></label>
							<div class="col-md-4 col-sm-12 col-xs-12 form-group">
								<input type="text" disabled class="form-control" value="<?php echo $row1["ding_fentrega"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">FECHA DE ENTREGA <span class="required">*</span></label>
							<div class="col-md-2 col-sm-12 col-xs-12 form-group xdisplay_inputx">
								<input type="text" class="form-control has-feedback-left" id="ding_fentrega" name="ding_fentrega" aria-describedby="inputSuccess2Status4">
								<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
							</div>
						</div>


						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<button type="submit" class="btn btn-success">Actualizar</button>
							</div>
						</div>

						<input type="hidden" name="cmd" value="Actualizar">
						<input type="hidden" name="ding_ing_id" value="<?php echo $id ?>">
					</form>

				</div>
			</div>
		</div>		
	<?php endif ?>

	<script type="text/javascript">
		$(function(){
			$("#ding_fentrega").datepicker({
				dateFormat: "yy-mm-dd",
			});
		})
	</script>