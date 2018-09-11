<?php
if($_POST["cmd"] == "Actualizar")
{
  $sql = "UPDATE acti_subzona SET acti_subzona_glosa = '".$_POST["acti_subzona_glosa"]."' WHERE acti_subzona_id = ".$_POST["acti_subzona_id"];
  mysql_query($sql,$dbh);
}
?>
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>SUBCATEGORIAS > CREAR</h3>
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

  <?php if (isset($_REQUEST[id])): ?>
    <?php
    $detalle = "SELECT * FROM acti_subzona WHERE acti_subzona_id = ".$_REQUEST["id"];
    $detalle = mysql_query($detalle,$dbh);
    $detalle = mysql_fetch_array($detalle);
    ?>
  	<div class="row">
  		<div class="col-md-12 col-sm-12 col-xs-12">
  			<div class="x_panel">
  				<div class="x_title">
  					DETALLE DE LA CATEGORIA : <strong><?php echo $detalle["acti_subzona_glosa"] ?></strong>
  				</div>

  				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>">

  					<div class="form-group">
  						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cat_nombre">NOMBRE PRODUCTO <span class="required">*</span>
  						</label>
  						<div class="col-md-6 col-sm-6 col-xs-12">
  							<input type="text" id="acti_subzona_glosa" name="acti_subzona_glosa" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $detalle["acti_subzona_glosa"] ?>">
  						</div>
  					</div>


  					<div class="form-group">
  						<label class="control-label col-md-3 col-sm-3 col-xs-12">ESTADO <span class="required">*</span></label>
  						<div class="col-md-6 col-sm-6 col-xs-12">
  							<select class="form-control" name="catsub_estado" id="catsub_estado" required>
  								<option value="" selected>Seleccionar...</option>
  								<option value="1"<?php if($detalle["acti_subzona_estado"] == 1){echo"selected";}?>>ACTIVO</option>
  								<option value="0"<?php if($detalle["acti_subzona_estado"] == 0){echo"selected";}?>>INACTIVO</option>
  							</select>
  						</div>
  					</div>

  					<div class="form-group">
  						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
  							<button type="submit" class="btn btn-success">Crear</button>
  						</div>
  					</div>

  					<input type="hidden" name="cmd" value="Actualizar">
  					<input type="hidden" name="acti_subzona_id" value="<?php echo $detalle["acti_subzona_id"] ?>">
  				</form>
  			</div>
  		</div>
  	</div>
  <?php endif ?>

  <div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>LISTADO CATEGORIAS</h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">Settings 1</a>
								</li>
								<li><a href="#">Settings 2</a>
								</li>
							</ul>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<!-- CONTENIDO DE LAS PAGINAS !-->
				<?php
				$categorias = "SELECT * FROM acti_zona WHERE zona_estado = 1";
				$categorias = ,$dbh($categorias,$dbh);
				?>
				<form method="post" action="?page=subzonas&action=editar">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">SELECCIONAR CATEGORIA</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select name="zona_id" class="form-control" onchange="this.form.submit()">
								<option>Seleccionar...</option>
								<?php while($row = mysql_fetch_array($categorias)) { ?>
									<option value="<?php echo $row["zona_id"] ?>" <?php if($_GET["ori"] == $row["zona_id"] || $_POST["zona_id"] == $row["zona_id"]){echo "selected";} ?>><?php echo $row["zona_glosa"] ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<input type="hidden" name="cmd" value="Buscar">
					</form>
					<br>
					<hr>
					<?php if($_POST["cmd"] == "Buscar" || $_GET["cmd"] == "Buscar"): ?>
						<?php
            $detalle = "SELECT * FROM acti_zona WHERE zona_id = ".$_POST["zona_id"];
						$detalle = mysql_query($detalle,$dbh);
						$detalle = mysql_fetch_array($detalle);

            $value = isset($_POST["zona_id"]) ? $detalle["zona_codigo"] : $_GET["zona_id"];

						$buscar = "SELECT * FROM acti_subzona WHERE acti_subzona_codigo = ".$value;
						$buscar = mysql_query($buscar,$dbh);
						?>
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>NOMBRE</th>
                  <th>EDITAR</th>
								</tr>
							</thead>

							<tbody>
								<?php while($row = mysql_fetch_array($buscar)) { ?>
									<tr>
										<td><?php echo $row["acti_subzona_id"] ?></td>
										<td><?php echo $row["acti_subzona_glosa"] ?></td>
                    <td><a href="?page=subzonas&action=editar&id=<?php echo $row["acti_subzona_id"] ?>&zona_id=<?php echo isset($detalle["zona_codigo"]) ? $detalle["zona_codigo"] : $_GET["zona_id"] ?>&cmd=Buscar&ori=<?php echo ($_POST["zona_id"]) ? $_POST["zona_id"]: $_GET["ori"] ?>" class="btn btn-sm btn-warning">Editar <i class"fa fa-pencil"></i></a></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>

						<?php endif ?>
						<!-- CONTENIDO DE LAS PAGINAS !-->
					</div>
				</div>
			</div>

    </div>
