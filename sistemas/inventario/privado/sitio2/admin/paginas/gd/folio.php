<?php
$regiones = array();
$region = "SELECT * FROM acti_region WHERE region_estado = 1";
$resRegiones = mysql_query($region,$dbh);
while($row = mysql_fetch_array($resRegiones))
{
	$regiones[] = $row;
}

$where = "";
if($_POST["region"] <> "")
{
	$where.=" oc_region2 = ".$_POST["region"]." AND ";
}

if($_POST["folio"] <> "")
{
	$where.=" oc_folioguia LIKE '%".$_POST["folio"]."%' AND ";
}
$gd = "SELECT * FROM bode_orcom WHERE ".$where." oc_guiadestina <> '' AND oc_tipo <> 0";
$gdr = mysql_query($gd,$dbh);

?>
<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > GUIA DE DESPACHO</h3>
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
						<select class="form-control" name="region" id="region" >
							<option value="" selected>Seleccionar...</option>
							<?php foreach ($regiones as $key => $value): ?>
								<option value="<?php echo $value["region_id"] ?>" <?php if($_POST["region"] == $value["region_id"]){echo"selected";}?>><?php echo $value["region_glosa"] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">FOLIO <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<input type="text" name="folio" id="folio" class="form-control" value="<?php echo $_POST["folio"] ?>">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<button type="submit" class="btn btn-success">Buscar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php if (isset($_POST["region"]) OR isset($_POST["folio"])): ?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">REGION DE DESTINO</div>

				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<tr class="headings">
							<th>FOLIO</th>
							<th>DESTINATARIO</th>
							<th>FECHA DESPACHO</th>
							<th>TIPO DE GUIA</th>
							<th>EDITAR</th>
						</tr>
					</thead>

					<tbody>
						<?php while($row = mysql_fetch_array($gdr)) { 
							$tipos = array(1 => "BODEGA REGIONAL",2=>"OFICINA",3=>"JARDIN INFANTIL")
							?>
							<tr>
								<td><?php echo $row["oc_folioguia"] ?> </td>
								<td><?php echo $row["oc_guiadestina"] ?> </td>
								<td><?php echo $row["oc_fecha"] ?> </td>
								<td><?php echo $tipos[$row["oc_tipo_guia"]] ?> </td>
								<td><a href="?page=gd&action=folio_editar&id=<?php echo $row["oc_id"] ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>