<!DOCTYPE html>
<html lang="en">
<head>
	<script type="text/javascript" src="../../../../seguimientos/sitio2/librerias/js/jscal2.js"></script>
	<link rel="stylesheet" type="text/css" href="../../../../seguimientos/sitio2/librerias/css/jscal2.css" />
	<script src="../../../../seguimientos/sitio2/librerias/js/lang/es.js"></script>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Dashboard - Sistema Bodega </title>
	
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<!-- end: CSS -->
	


	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	


</head>

<body>
	<? 
	include ("config.php");
	extract($_GET);
	extract($_POST);
	?>
	<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"><span>JUNJI</span></a>

				
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
	<div class="container-fluid-full">
		<div class="row-fluid">

			<!-- start: Main Menu -->
			<? include("menu.php"); ?>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">


				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="index.php">Home</a> 
						<i class="icon-angle-right"></i>
					</li>

					<li>
						<a href="#">Despachos por Región</a>

					</li>
				</ul>


				<!-- ************************************ -->
				<!-- AQUI COMIENZA EL CUERPO DEL PROGRAMA -->
				<!-- ************************************ -->

				<div class="row-fluid">
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon user"></i><span class="break"></span>Despachos por Región</h2>

						</div>
						<div class="box-content">
							<div class="box-content">
								<? 
								$cod_color="label-info";
								if ($id_region == "") $cod_color="label-success"; 
								?>
								<a href="ver_region.php" class="label <? echo $cod_color ?>">Todas</a>&nbsp;&nbsp;
								<?
								$consulta="select * from acti_region order by region_id";
								$res=mysql_query($consulta);
								while ($arr=mysql_fetch_array($res)){
									$v_region_id	    = $arr['region_id'];
									$v_region_glosa	= $arr['region_glosa'];

									$cod_color="label-info";
									if ($id_region == $v_region_id) $cod_color="label-success"; 
									?>
									<a href="ver_region.php?id_region=<? echo $v_region_id ?>" class="label <? echo $cod_color ?>"><? echo $v_region_glosa ?></a>&nbsp;&nbsp;

									<?				   


								}

								?>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon search"></i><span class="break"></span>Buscador Personalizado</h2>

						</div>
						<div class="box-content">
							<div class="box-content">
								<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
									<table class="table table-bordered">
										<tr>
											<td>FECHA DE INICIO</td>
											<td>
												<div class="input-group">
													<input type="text" name="fecha_inicio" id="fecha_inicio" placeholder="YYYY-MM-DD"  class="form-control" value="<?php echo $fecha_inicio ?>">
													<i class="halflings-icon calendar" id="f_trigger_c1" style="cursor:pointer;" title="Seleccionar Fecha"></i>
												</div>
												<script type="text/javascript">
													Calendar.setup({
														inputField   :  "fecha_inicio",
														trigger     :  "f_trigger_c1",
														onSelect   : function() { this.hide() },
														dateFormat    :  "%Y-%m-%d",
														max : <?php echo date(Ymd) ?>,
														showTime   : 12,
													});
												</script>
											</td>
											<td>FECHA DE TERMINO</td>
											<td>
												<div class="input-group">
													<input type="text" name="fecha_termino" id="fecha_termino" placeholder="YYYY-MM-DD"  class="form-control" value="<?php echo $fecha_termino ?>">
													<i class="halflings-icon calendar" id="f_trigger_c2" style="cursor:pointer;" title="Seleccionar Fecha"></i>
												</div>
												<script type="text/javascript">
													Calendar.setup({
														inputField   :  "fecha_termino",
														trigger     :  "f_trigger_c2",
														onSelect   : function() { this.hide() },
														dateFormat    :  "%Y-%m-%d",
														max : <?php echo date(Ymd) ?>,
														showTime   : 12,
													});
												</script>
											</td>
										</tr>

										<tr>
											<td colspan="4" style="text-align: center;"><button class="btn btn-success" type="submit" name="submit" value="1">BUSCAR</button></td>
										</tr>
									</table>

									<input type="hidden" name="id_region" value="<?php echo $id_region ?>">
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="row-fluid">
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon user"></i><span class="break"></span>Despachos por Región</h2>

						</div>
						<div class="box-content">
							<div class="box-content">

								<table border="1" class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											<td colspan="8"><a href="ver_region_excel.php?region_id=<?php echo $id_region ?>&fecha_inicio=<?php echo $fecha_inicio ?>&fecha_termino=<?php echo $fecha_termino ?>" class="btn btn-info">Exportar Excel</a></td>
										</tr>
										<tr>
											<th>Id</th>
											<th>N° Guia</th>
											<th>Destino</th>
											<th>F. Despacho</th>
											<th>F. Creacion</th>
											<th>Emisor</th>
											<th>Estado</th>
											<th>Acción</th>
										</tr>
									</thead>   
									<tbody>
										<?
										$where = "";
										if(isset($_POST) && $_POST["submit"] == 1)
										{
											if($fecha_inicio <> "")
											{
												$where.= "oc_fecha >= '".$fecha_inicio."' AND ";
											}else{
												$where.=" oc_fecha >= '".date("Y-m-d")."' AND ";
											}

											if($fecha_termino <> "")
											{
												$where.= "oc_fecha <= '".$fecha_termino."' AND ";	
											}else{
												$where.=" oc_fecha <= '".date("Y-m-d")."' AND ";
											}
										}else{
											$where.=" oc_fecha >= '".date("Y-m-d",strtotime("-7 days"))."' AND ";
											$where.=" oc_fecha <= '".date("Y-m-d")."' AND ";

										}

										if ($id_region==""){
											$consulta="select * from bode_orcom where ".$where." oc_tipo = 1 AND oc_guiaemisor <> '' ORDER BY oc_id DESC LIMIT 200";
										} else {
											$consulta="select * from bode_orcom where ".$where." oc_tipo = 1 and oc_guiaemisor <> '' and oc_region2='".$id_region."'";
										}
										$res = mysql_query($consulta);
										while ($arr=mysql_fetch_array($res)){
											if($arr["oc_guiaemisor"] == "")
											{
												$estado = "EN PROCESO";
											}else{
												$estado = "DESPACHADA";
											}
											$v_oc_id	        = $arr['oc_id'];
											$v_oc_id2	        = $arr['oc_id2'];
											$v_oc_region	    = $arr['oc_region'];
											$v_oc_region2	    = $arr['oc_region2'];
											$v_oc_nombre_oc	    = $arr['oc_nombre_oc'];
											$v_oc_prog	        = $arr['oc_prog'];
											$v_oc_fecha	        = $arr['oc_fecha'];
											$v_oc_cantidad	    = $arr['oc_cantidad'];
											$v_oc_monto	        = $arr['oc_monto'];
											$v_oc_descuento	    = $arr['oc_descuento'];
											$v_oc_fecha_recep   = $arr['oc_fecha_recep'];
											$v_oc_usu	        = $arr['oc_guiaemisor'];
											$v_oc_pro_id	    = $arr['oc_pro_id'];
											$v_oc_observaciones	= $arr['oc_observaciones'];
											$v_oc_proveerut	    = $arr['oc_proveerut'];
											$v_oc_proveedig	    = $arr['oc_proveedig'];
											$v_oc_proveenomb    = $arr['oc_proveenomb'];	
											$v_oc_estado        = $arr['oc_estado'];

											?>

											<tr>
												<td><? echo $v_oc_id ?></td>
												<td><? echo $arr["oc_folioguia"] ?></td>
												<td><? echo $v_oc_region ?></td>
												<td><? echo $v_oc_fecha ?></td>
												<td><? echo $v_oc_fecha_recep?></td>
												<td><?php echo $v_oc_usu ?></td>
												<td><?php echo $estado ?></td>
												<td class="center">
													<a class="btn btn-success" href="ver_guia_det.php?id_oc=<? echo $v_oc_id ?>">
														<i class="halflings-icon white zoom-in"></i>  
													</a>

												</td>
											</tr>
											<? } ?>


										</tbody>
									</table>             
								</div>
							</div><!--/span-->

						</div>		











					</div><!--/.fluid-container-->

					<!-- end: Content -->
				</div><!--/#content.span10-->
			</div><!--/fluid-row-->

		</div>
		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<div class="clearfix"></div>

		<?  include ("footer.php"); ?>

		<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery-migrate-1.0.0.min.js"></script>

		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>

		<script src="js/jquery.ui.touch-punch.js"></script>

		<script src="js/modernizr.js"></script>

		<script src="js/bootstrap.min.js"></script>

		<script src="js/jquery.cookie.js"></script>

		<script src='js/fullcalendar.min.js'></script>

		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.pie.js"></script>
		<script src="js/jquery.flot.stack.js"></script>
		<script src="js/jquery.flot.resize.min.js"></script>

		<script src="js/jquery.chosen.min.js"></script>

		<script src="js/jquery.uniform.min.js"></script>

		<script src="js/jquery.cleditor.min.js"></script>

		<script src="js/jquery.noty.js"></script>

		<script src="js/jquery.elfinder.min.js"></script>

		<script src="js/jquery.raty.min.js"></script>

		<script src="js/jquery.iphone.toggle.js"></script>

		<script src="js/jquery.uploadify-3.1.min.js"></script>

		<script src="js/jquery.gritter.min.js"></script>

		<script src="js/jquery.imagesloaded.js"></script>

		<script src="js/jquery.masonry.min.js"></script>

		<script src="js/jquery.knob.modified.js"></script>

		<script src="js/jquery.sparkline.min.js"></script>

		<script src="js/counter.js"></script>

		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
		<!-- end: JavaScript-->

	</body>
	</html>
