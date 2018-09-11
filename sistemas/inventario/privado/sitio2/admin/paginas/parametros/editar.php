<?php
require_once("../inc/config.php");
$paramsArray = array(
	1 => "ESTADO",
	2 => "CALIDAD ADMINISTRATIVA",
	3 => "CUENTA CONTABLE (ACTIVO)",
	4 => "PROGRAMA",
	5 => "TIPO DE COMPRA",
	6 => "GRUPO",
	7 => "UNIDAD DE MEDIDA",
	8 => "CUENTA CONTABLE (EXISTENCIA)"
	);

if(isset($_POST["cmd"]) && $_POST["cmd"] == "Buscar")
{
	$paramResult = array();
	$sql = mysql_query("SELECT * FROM inedis_parametros WHERE param_tipo = ".$_POST["param_id"],$dbh);
	while($row = mysql_fetch_array($sql))
	{
		$paramResult[] = $row;
	}
}

if(isset($_POST["cmd"]) && $_POST["cmd"] == "actualizar")
{
	if(mysql_query("UPDATE inedis_parametros SET param_glosa = '".$_POST["param_glosa"]."', param_desc = '".$_POST["param_desc"]."', param_estado = '".$_POST["param_estado"]."' WHERE param_id = ".$_POST["param_id"],$dbh))
	{
		echo "<script>alert('Actualizado');window.location.href='?page=parametros&action=crear';</script>";
	}
}
?>

<div class="page-title">
	<div class="title_left">
		<h3><?php echo $texto ?> > PARAMETRO</h3>
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
					<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR PARAMETRO <span class="required">*</span></label>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<select class="form-control" name="param_id" id="param_id" onChange="this.form.submit()">
							<option value="" selected>Seleccionar...</option>
							<?php foreach ($paramsArray as $key => $value): ?>
								<option value="<?php echo $key ?>" <?php if($_GET["param_tipo"] == $key){echo"selected";}?>><?php echo $value ?></option>
							<?php endforeach ?>
						</select>
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

<?php if (sizeof($paramResult) > 0): ?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">REGION DE DESTINO</div>

				<table class="table table-striped table-hover table-condensed table-bordered jambo_table bulk_action">
					<thead>
						<tr class="headings">
							<th>GLOSA</th>
							<th>DESCRIPCION</th>
							<th>ESTADO</th>
							<th>EDITAR</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($paramResult as $key => $value): ?>

							<tr>
								<td><?php echo $value["param_glosa"] ?> </td>
								<td><?php echo $value["param_desc"] ?> </td>
								<td><?php echo ($value["param_estado"] == 1) ? "ACTIVO" : "DESHABILITADO" ?> </td>
								<td>
									<a href="?page=parametros&action=editar&id=<?php echo $value["param_id"]?>&param_tipo=<?php echo $value["param_tipo"] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> EDITAR</a>
								</tr>
							<?php endforeach ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>

	<?php if (isset($_GET["id"]) AND is_numeric($_GET["id"])): ?>

		<?php 
		$detalleParametro = mysql_query("SELECT * FROM inedis_parametros WHERE param_id = ".$_GET["id"],$dbh);
		$detalleParametro = mysql_fetch_array($detalleParametro);
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						NUEVO PARAMETRO : <strong><?php echo $paramsArray[$_GET["param_tipo"]] ?></strong>
					</div>
					
					<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">GLOSA <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="param_glosa" name="param_glosa" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $detalleParametro["param_glosa"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">DESCRIPCION <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" id="param_desc" name="param_desc" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $detalleParametro["param_desc"] ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" name="param_estado" id="param_estado" required>
									<option value="" selected>Seleccionar...</option>
									<option value="1" <?php if($detalleParametro["param_estado"] == 1){echo"selected";} ?>>ACTIVO</option>
									<option value="0" <?php if($detalleParametro["param_estado"] == 0){echo"selected";} ?>>INACTIVO</option>
								</select>
							</div>
							
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" class="btn btn-success">Actualizar</button>
								</div>
							</div>

							<input type="hidden" name="param_id" value="<?php echo $detalleParametro["param_id"] ?>">
							<input type="hidden" name="cmd" value="actualizar">
						</form>

					</div>
				</div>
			</div>
		<?php endif ?>