<?php
//Estadisticas
$sql = "SELECT COUNT(DISTINCT(cat_nombre)) as Total FROM acti_categoria";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

if($_POST["cmd"] === "archivoCSV")
{
	$start = 1;
	$filePath = $_FILES["zona_file"]["tmp_name"];
	$fila = 1;
	if (($gestor = fopen($filePath, "r")) !== FALSE) {
		$datos = fgetcsv($gestor,10000,";");
		while (($datos = fgetcsv($gestor, 10000, ",")) !== FALSE) {
			$numero = count($datos);
			$fila++;
			for ($c=0; $c < $numero; $c++) {
				$explode = explode(";", $datos[$c]);
				$sql = "INSERT INTO acti_inventario VALUES (NULL,'".$explode[1]."', '".$explode[2]."', '".$explode[3]."', '".$explode[4]."', '".$explode[5]."', '".$explode[6]."', '".$explode[7]."', '".$explode[8]."', '".$explode[9]."', '".$explode[10]."', '".$explode[11]."', '".$explode[12]."', '".$explode[13]."', '".$explode[14]."', '".$explode[15]."', '".$explode[16]."', '".$explode[17]."', '".$explode[18]."', '".$explode[19]."', '".$explode[20]."', '".$explode[21]."', '".$explode[22]."', '".$explode[23]."', '".$explode[24]."', '".$explode[25]."', '".$explode[26]."', '".$explode[27]."', '".$explode[28]."', '".$explode[29]."', '".$explode[30]."', '".$explode[31]."', '".$explode[32]."', '".$explode[33]."', '".$explode[34]."', '".$explode[35]."', '".$explode[36]."', '".$explode[37]."',NULL,NULL)";
				mysql_query($sql);
			}
		}
		fclose($gestor);
		echo "<script>window.location.href='?page=categorias&action=crear'</script>";
	}
}

?>
  <!-- page content -->
  <div class="right_col" role="main">

    <div class="row top_tiles">

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
          </div>
          <div class="count"><a href="?page=categorias&action=crear">CREAR</a></div>

          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>


      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-caret-square-o-right"></i>
          </div>
          <div class="count"><a href="?page=categorias&action=editar">EDITAR</a></div>

          <h3>New Sign ups</h3>
          <p>Lorem ipsum psdea itgum rixt.</p>
        </div>
      </div>
    </div>

    <!-- top tiles -->
    <div class="row tile_count">
      <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
        <div class="left"></div>
        <div class="right">
          <span class="count_top"><i class="fa fa-user"></i> Categorias creadas</span>
          <div class="count"><?php echo $row["Total"] ?></div>
          <span class="count_bottom"><i class="green">4% </i> From last Week</span>
        </div>
      </div>
    </div>
    <!-- /top tiles -->

		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>CATEGORIAS > EDITAR</h3>
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
								<div class="x_title">
									SUBIR ARCHIVO CSV
								</div>

								<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo $_SERVER["REQUEST_URI"] ?>" onSubmit="return checkFile()" enctype="multipart/form-data">

									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12">CSV <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="file" id="zona_file" name="zona_file" required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>


									<div class="form-group">
										<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
											<button type="submit" class="btn btn-success">Subir</button>
										</div>
									</div>
									<input type="hidden" name="cmd" value="archivoCSV">
								</form>
							</div>
						</div>
					</div>

			</div>
  </div>
  <!-- /page content -->

	<script type="text/javascript">
		function checkFile()
		{
			var extensionPermitida = "csv";

			var extension = $("#zona_file").val().split(".").pop();

			if(extension === extensionPermitida)
			{
				return true;
			}else{
				return false;
			}
		}
	</script>
