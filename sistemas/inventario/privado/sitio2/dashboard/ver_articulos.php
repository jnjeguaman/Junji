<?php extract($_GET) ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
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
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<!-- end: CSS -->
	


	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	


</head>

<body>
	<? 
	include ("config.php");
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
						<a href="#">Ver Articulos</a>

					</li>
				</ul>


				<!-- ************************************ -->
				<!-- AQUI COMIENZA EL CUERPO DEL PROGRAMA -->
				<!-- ************************************ -->

				<?php if ($f_filtro == ""): ?>
					<!-- SIN FILTRO !-->
					<div class="row-fluid">
						<div class="box span12">
							<div class="box-header" data-original-title>
								<h2><i class="halflings-icon user"></i><span class="break"></span>Ingresos por Artículos</h2>
							</div>
							<div class="box-content">
								<table class="table table-striped table-bordered bootstrap-datatable datatable">
									<thead>
										<tr>
											<th>Id</th>
											<th>N° Ing.</th>
											<th>O.C.</th>
											<th>Guia</th>
											<th>Articulo</th>
											<th>Region</th>
											<th>Cantidad</th>
											<th>R.Tec.</th>
											<th>R.Conf.</th>
											<th>Despacho</th>
											<th>Cant. Final</th>
											<th>Rechazo</th>
											<th>Ubicacion</th>
											<th>Fecha</th>
											<th> </th>
										</tr>
									</thead>   
									<tbody>
										<?
										$consulta="select * from bode_ingreso,bode_detingreso,bode_orcom,bode_detoc where ding_ing_id = ing_id and ing_oc_id = oc_id and ding_prod_id=doc_id and doc_especificacion='$f_arti'";
										$res = mysql_query($consulta);
										while ($arr=mysql_fetch_array($res)){
											$v_ding_id	            = $arr['ding_id'];
											$v_ding_ing_id          = $arr['ding_ing_id'];	
											$v_ding_prod_id	        = $arr['ding_prod_id'];
											$v_ding_cantidad	    = $arr['ding_cantidad'];
											$v_ding_region_id	    = $arr['ding_region_id'];
											$v_ding_recep_tecnica	= $arr['ding_recep_tecnica'];
											$v_ding_cant_conf	    = $arr['ding_cant_conf'];
											$v_ding_cant_despacho   = $arr['ding_cant_despacho'];	
											$v_ding_cant_final	    = $arr['ding_cant_final'];
											$v_ding_cant_rechazo    = $arr['ding_cant_rechazo'];
											$v_ding_glosa_rechazo   = $arr['ding_glosa_rechazo'];	
											$v_ding_ubicacion	    = $arr['ding_ubicacion'];
											$v_ding_user	        = $arr['ding_user'];
											$v_ding_fecha	        = $arr['ding_fecha'];
											$v_ding_userf	        = $arr['ding_userf'];
											$v_ding_fechaf          = $arr['ding_fechaf'];

											$v_ing_id	            = $arr['ing_id'];
											$v_ing_guia	            = $arr['ing_guia'];
											$v_ing_oc_id            = $arr['ing_oc_id'];	
											$v_ing_fecha	        = $arr['ing_fecha'];
											$v_ing_recib_usu_id	    = $arr['ing_recib_usu_id'];
											$v_ing_guiafechatc	    = $arr['ing_guiafechatc'];

											$v_oc_id2               = $arr['oc_id2'];															
											$v_doc_especificacion   = $arr['doc_especificacion'];

											?>

											<tr>

												<td><? echo $v_ding_id ?></td>
												<td><? echo $v_ing_id ?></td>
												<td><? echo $v_oc_id2 ?></td>
												<td><? echo $v_ing_guia ?></td>
												<td><? echo $v_doc_especificacion ?></td>
												<td><? echo $v_ding_region_id ?></td>
												<td><? echo $v_ding_cantidad ?></td>
												<td><? echo $v_ding_recep_tecnica ?></td>
												<td><? echo $v_ding_cant_conf ?></td>
												<td><? echo $v_ding_cant_despacho ?></td>
												<td><? echo $v_ding_cant_final ?></td>
												<td><? echo $v_ding_cant_rechazo ?></td>
												<td><? echo $v_ding_ubicacion ?></td>
												<td><? echo $v_ding_fecha ?></td>
												<td class="center">
													<a class="btn btn-success" href="ver_oc_det.php?id_oc=<? echo $v_ing_oc_id ?>">
														<i class="halflings-icon white zoom-in"></i>  
													</a>

												</td>
											</tr>
											<? } ?>


										</tbody>
									</table>            
								</div>
							</div><!--/span-->
							<a href="index.php?opcion=arti&f_region=<?php echo $f_region ?>&f_oc=<?php echo $f_oc ?>&f_arti=<?php echo $f_arti ?>&f_filtro=<?php echo $f_filtro ?>" class="btn btn-success">Volver</a>
						</div>		
						<!-- SIN FILTRO !-->
					<?php else: ?>
						<div class="row-fluid">
							<div class="box span12">
								<div class="box-header" data-original-title>
									<h2><i class="halflings-icon user"></i><span class="break"></span>Ingresos por Artículos "<?php echo $f_arti."-".$f_oc ?>"</h2>
								</div>
								<div class="box-content">
									<table class="table table-striped table-bordered bootstrap-datatable datatable">
										<thead>
											<tr>
												<th>PRODUCTO</th>
												<th>N° G/D</th>
												<th>FECHA EMISION</th>
												<th>EMISOR</th>
												<th>DESTINO</th>
												<th>ABASTECE</th>
												<th>CANTIDAD DESPACHADA</th>
												<th>G/D</th>
											</tr>
										</thead>
										<tbody>
											<?php 

											if($f_oc <> "")
											{
												$where.="a.doc_numerooc LIKE '%".strtoupper($f_oc)."%' AND ";
											}

											if($f_arti <> "")
											{
												$where.="a.doc_especificacion LIKE '%".$f_arti."%' AND ";
											}
											if($f_region <> "")
											{
												// $where.="a.doc_region = ".$f_region." AND ";
												$where.="b.oc_region2 = ".$f_region." AND ";
											}

											$qry = "SELECT DISTINCT(b.oc_folioguia),b.oc_fecha,b.oc_guiaabaste,b.oc_guiadestina,b.oc_usu,b.oc_id,a.doc_cantidad,a.doc_especificacion FROM bode_detoc a,bode_orcom b WHERE a.doc_oc_id = b.oc_id AND b.oc_tipo = 1 AND $where a.doc_estado <> 'ELIMINADO'";
											// echo $qry;
											$resp = mysql_query($qry);
											while($row = mysql_fetch_array($resp)){ ?>
											<tr>
												<td><?php echo $row["doc_especificacion"] ?></td>
												<td><?php echo $row["oc_folioguia"] ?></td>
												<td><?php echo $row["oc_fecha"] ?></td>
												<td><?php echo $row["oc_usu"] ?></td>
												<td><?php echo $row["oc_guiadestina"] ?></td>
												<td><?php echo $row["oc_guiaabaste"] ?></td>
												<td><?php echo $row["doc_cantidad"] ?></td>
												<td><a href="ver_guia_det.php?id_oc=<?php echo $row["oc_id"] ?>" class="btn btn-success"><i class="halflings-icon white zoom-in"></i></a></td>
											</tr>
											<?php } ?>
										</tbody>

										<tfoot>
											<tr>
												<td colspan="6"></td>
												<td colspan="2">
													<form action="reporte.php"  method="POST">
														<button class="btn btn-danger">Exportar a Excel <i class="fa fa-file-excel-o"></i></button>
														<input type="hidden" name="qry" value="<?php echo $qry ?>">
														<input type="hidden" name="art" value="<?php echo $f_arti ?>">
													</form>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
							<a href="index.php?opcion=arti&f_region=<?php echo $f_region ?>&f_oc=<?php echo $f_oc ?>&f_arti=<?php echo $f_arti ?>&f_filtro=<?php echo $f_filtro ?>" class="btn btn-success">Volver</a>
						</div>
					<?php endif ?>



				</div><!--/.fluid-container-->

				<!-- end: Content -->
			</div><!--/#content.span10-->
		</div><!--/fluid-row-->

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
