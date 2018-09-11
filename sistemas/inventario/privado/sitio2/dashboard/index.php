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
	<link rel="stylesheet" href="js/jqueryui/jquery-ui.min.css">
	<!-- end: CSS -->
	

	
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
	
	
</head>

<body>
	<? 
	include ("config.php");
	$opcion= isset($_GET["opcion"]) ? $_GET['opcion'] : "";
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
					<li><a href="#">Dashboard</a></li>
				</ul>

				<div class="row-fluid">
					<!-- Muestra el resumen de las ordenes de compra -->
					<?
				   // Recupera datos de las ordenes de compra
					$consulta ="Select * from bode_orcom";
					$res=mysql_query($consulta);
					$numero_oc=mysql_num_rows($res);
					
				    // Recupera datos del detalle de  las ordenes de compra
					$consulta ="Select * from bode_detoc";
					$res=mysql_query($consulta);
					$numero_det=mysql_num_rows($res);
					?>
					
					<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
						<div>Prod.<? echo $numero_det ?> </div>
						<div class="number"><? echo $numero_oc ?><i class="icon-list-alt"></i></div>
						<div class="title">O.Compra</div>
						<div class="footer">
							<a href="ver_oc.php"> Ver Detalles</a>
						</div>	
					</div>
					<!-- FIN: Muestra el resumen de las ordenes de compra -->
					
					
					<!-- Muestra el resumen de los Recibidos  -->
					<?
				   // Recupera datos de las ordenes de compra recibidas 
					$consulta ="Select * from bode_ingreso";
					$res=mysql_query($consulta);
					$numero_ing=mysql_num_rows($res);
					
				    // Recupera datos del detalle de  las ordenes de compra recibidas
					$consulta ="Select * from bode_detingreso";
					$res=mysql_query($consulta);
					$numero_deting=mysql_num_rows($res);
					?>
					
					<div class="span3 statbox green" onTablet="span6" onDesktop="span3">
						<div>Prod.<? echo $numero_deting ?></div>
						<div class="number"><? echo $numero_ing ?><i class="icon-ok"></i></div>
						<div class="title">Recibidos</div>
						<div class="footer">
							<a href="ver_ing.php"> Ver Detalles</a>
						</div>
					</div>
					<!-- Muestra el resumen de las Recepciones Técnicas  -->
					
					

					<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
						
						<div class="number"><? echo $numero_rc_a ?><i class="icon-share-alt"></i></div>
						<div class="title">Seguimiento O.C.</div>
						<div class="footer">
							<a href="ver_seguimiento_oc.php"> Consultar</a>
						</div>
					</div>	
					
				</div>		

				
				
				<hr>
				
				
				
				<div class="row-fluid">	
					
					<!-- RESCATA LOS DATOS DESDE LA BASE DE DATOS -->
					
					<?
					$consulta ="Select * from acti_proveedor";
					$res=mysql_query($consulta);
					$numero_prov=mysql_num_rows($res);
					
					
					?>

					<a class="quick-button metro yellow span2" href="index.php?opcion=prov">
						<i class="icon-group"></i>
						<p>Proveedores</p>
						<span class="badge"><? echo $numero_prov ?></span>
					</a>
					<a class="quick-button metro red span2" href="index.php?opcion=arti">
						<i class="icon-barcode"></i>
						<p>Artículos</p>
						<span class="badge">46</span>
					</a>
					<a class="quick-button metro blue span2"  href="index.php?opcion=prog">
						<i class="icon-th-list"></i>
						<p>Programas</p>
						<span class="badge">13</span>
					</a>
					<a class="quick-button metro green span2" href="index.php?opcion=desp">
						<i class="icon-share-alt"></i>
						<p>Despachos</p>
					</a>
					
					
					<div class="clearfix"></div>
					
				</div><!--/row-->
				
				<!-- ************************************ -->
				<? if ($opcion=="prov"){ ?>
				<br><br>
				<div class="row-fluid sortable">
					<div class="box span12">
						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon edit"></i><span class="break"></span>Consulta por Proveedor</h2>
							
						</div>
						<div class="box-content">
							<form class="form-horizontal" method="POST" action="ver_prov.php">
								<fieldset>
									
									
									<div class="control-group">
										<label class="control-label" for="f_prov">Proveedor</label>
										<div class="controls">
											<select id="f_prov" data-rel="chosen" name="f_prov" class="span6">
												<? 
												$consulta="select * from acti_proveedor order by proveedor_glosa";
												$res=mysql_query($consulta);
												while($arr=mysql_fetch_array($res)){
													$v_proveedor_id	    = $arr['proveedor_id'];
													$v_proveedor_glosa	    = $arr['proveedor_glosa'];
													$v_proveedor_rut	    = $arr['proveedor_rut'];
													$v_proveedor_contacto	= $arr['proveedor_contacto'];
													$v_proveedor_email	    = $arr['proveedor_email'];
													$v_proveedor_telefono	= $arr['proveedor_telefono'];
													$v_proveedor_estado    = $arr['proveedor_estado'];
													
													
													
													
													?>
													<option value="<? echo $v_proveedor_rut ?>"><? echo $v_proveedor_rut," ",$v_proveedor_glosa ?></option>
													<? } ?>
													
												</select>
											</div>
										</div>
										
										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Consultar</button>
											<button class="btn">Cancelar</button>
										</div>
									</fieldset>
								</form>
								
							</div>
						</div><!--/span-->
						
					</div><!--/row-->
					<br><br><br><br><br><br><br><br><br><br>
					<? } ?>
					
					<!-- ************************************* -->
					
					
					
					<!-- *******BUSQUEDA POR ARTICULO ***************************** -->
					<? if ($opcion=="arti"){ ?>
					<br><br>
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header" data-original-title>
								<h2><i class="halflings-icon edit"></i><span class="break"></span>Consulta por Articulo</h2>
								
							</div>
							<div class="box-content">
								<form class="form-horizontal" method="GET" action="ver_articulos.php">
									<fieldset>
										<?php 
										$sql = "SELECT * FROM acti_region";
										$res = mysql_query($sql,$dbh);
										?>
										<div class="control-group">
											<label class="control-label" for="f_arti">Region</label>
											<div class="controls">
												<select id="f_region" name="f_region" class="span6" required>
													<option value="" selected>Seleccionar...</option>
													<?php while($row = mysql_fetch_array($res)){ ?>
													<option value="<?php echo $row["region_id"] ?>" <?php if($f_region == $row["region_id"]){echo"selected";} ?> ><?php echo $row["region_glosa"] ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label" for="f_arti">Orden de Compra</label>
											<div class="controls">
												<input type="text" id="f_oc" name="f_oc" class="span6" value="<?php echo $f_oc ?>">
											</div>
										</div>


										<div class="control-group">
											<label class="control-label" for="f_filtro">Producto</label>
											<div class="controls">
												<input type="text" id="f_arti" name="f_arti" class="form-control" value="<?php echo $f_arti ?>">
											</div>
										</div>

										<div class="control-group">
											<label class="control-label" for="f_filtro">Filtro</label>
											<div class="controls">
												<select id="f_filtro" data-rel="chosen" name="f_filtro" class="span6">
													<option value="" selected>Selecionar...</option>
													<option value="GUIA">GUIA DE DESPACHO</option>
												</select>
											</div>
										</div>

										<div class="form-actions">
											<button type="submit" class="btn btn-primary">Buscar</button>
											<button class="btn">Cancelar</button>
										</div>
									</fieldset>
								</form>

							</div>
						</div><!--/span-->

					</div><!--/row-->
					<br><br><br><br><br><br><br><br><br><br>
					<? } ?>

					<!-- ************************************* -->


					<!-- ************************************ -->
					<? if ($opcion=="prog"){ ?>
					<br><br>
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header" data-original-title>
								<h2><i class="halflings-icon edit"></i><span class="break"></span>Consulta por Programa</h2>

							</div>
							<div class="box-content">
								<a href="ver_prog.php?f_prog=P1" class="btn btn-primary"> <i class="halflings-icon white play"></i> P1 </a>&nbsp;
								<a href="ver_prog.php?f_prog=P2" class="btn btn-primary"> <i class="halflings-icon white play"></i> P2 </a>&nbsp;
								<a href="ver_prog.php?f_prog=CECI" class="btn btn-primary"> <i class="halflings-icon white play"></i> CECI </a>&nbsp;
								<a href="ver_prog.php?f_prog=PMI" class="btn btn-primary"> <i class="halflings-icon white play"></i> PMI </a>&nbsp;
								<a href="ver_prog.php?f_prog=CASH" class="btn btn-primary"> <i class="halflings-icon white play"></i> CASH </a>&nbsp;
								<a href="ver_prog.php?f_prog=VTF" class="btn btn-primary"> <i class="halflings-icon white play"></i> VTF </a>


							</div>
						</div><!--/span-->

					</div><!--/row-->
					<br><br><br><br><br><br><br><br><br><br>
					<? } ?>

					<!-- ************************************* -->


					<!-- ************************************ -->
					<!-- ********** REGIONES      *********** -->
					<!-- ************************************ -->
					<? if ($opcion=="desp"){ ?>
					<br><br>
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header" data-original-title>
								<h2><i class="halflings-icon edit"></i><span class="break"></span>Consulta Despachos por Regiones</h2>

							</div>
							<div class="box-content">
								<? 
								$consulta = "select * from acti_region";
								$res=mysql_query($consulta);
								while ($arr=mysql_fetch_array($res)){
									$v_region_id	   = $arr['region_id'];
									$v_region_glosa = $arr['region_glosa'];

									?>
									<a href="ver_region.php?id_region=<? echo $v_region_id ?>" class="btn btn-primary"> <i class="halflings-icon white play"></i> <? echo $v_region_glosa ?> </a>&nbsp;
									<? } ?>



								</div>
							</div><!--/span-->

						</div><!--/row-->
						<br><br><br><br><br><br><br><br><br><br>
						<? } ?>

						<!-- ************************************* -->

						<!-- ************************************ -->
						<!-- ********* SEGUIMIENTO OC *********** -->
						<!-- ************************************ -->
						<? if ($opcion=="oc"){ ?>
						<br><br>
						<div class="row-fluid sortable">
							<div class="box span12">
								<div class="box-header" data-original-title>
									<h2><i class="halflings-icon edit"></i><span class="break"></span>Seguimiento por OC</h2>

								</div>
								<div class="box-content">
									<form class="form-horizontal" method="POST" action="ver_seg_oc.php">
										<fieldset>


											<div class="control-group">
												<label class="control-label" for="selectError">Orden de Compra</label>
												<div class="controls">
													<select id="selectError" data-rel="chosen" name="f_oc" class="span6">
														<? 
														$consulta="select * from bode_orcom order by oc_id2";
														$res=mysql_query($consulta);
														while($arr=mysql_fetch_array($res)){
															$v_oc_id	        = $arr['oc_id'];
															$v_oc_id2	        = $arr['oc_id2'];
															$v_oc_nombre_oc    = $arr['oc_nombre_oc'];





															?>
															<option value="<? echo $v_oc_id ?>"><? echo $v_oc_id2," ",$v_oc_nombre_oc ?></option>
															<? } ?>

														</select>
													</div>
												</div>

												<div class="form-actions">
													<button type="submit" class="btn btn-primary">Generar</button>
													<button class="btn">Cancel</button>
												</div>
											</fieldset>
										</form>

									</div>
								</div><!--/span-->

							</div><!--/row-->
							<br><br><br><br><br><br><br><br><br><br>
							<? } ?>

							<!-- ************************************* -->

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
				<script src="js/jqueryui/jquery-ui.min.js"></script>
				<!-- end: JavaScript-->

				<script type="text/javascript">
					$(function(){
						$("#f_arti").keyup(function(){
							var texto = $("#f_arti").val();
							var region = $("#f_region").val();
							var oc = $("#f_oc").val();
							var availableTags = $.get("buscar_articulo.php?s="+texto);
							// var availableTags = ["Hola"];
							var f_arti = $("#f_arti").val();
							$("#f_arti").autocomplete({
								source : "buscar_articulo.php?s="+texto+"&region="+region+"&oc="+oc
							})
						})
					})
				</script>
			</body>
			</html>
