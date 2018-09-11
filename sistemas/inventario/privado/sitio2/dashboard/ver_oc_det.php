<?php

session_start();

function getWorkingDays($startDate, $endDate)
{
	$begin = strtotime($startDate);
	$end   = strtotime($endDate);
	if ($begin > $end) {
		// echo "startdate is in the future! <br />";

		return 0;
	} else {
		$no_days  = 0;
		$weekends = 0;
		while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
            	$weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

?>

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
	
	$id_oc = $_GET['id_oc'];
	
	$consulta="select * from bode_orcom where oc_id = '$id_oc'";
	$res = mysql_query($consulta,$dbh);
	while ($arr=mysql_fetch_array($res)){
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
		$v_oc_usu	        = $arr['oc_usu'];
		$v_oc_pro_id	    = $arr['oc_pro_id'];
		$v_oc_observaciones	= $arr['oc_observaciones'];
		$v_oc_proveerut	    = $arr['oc_proveerut'];
		$v_oc_proveedig	    = $arr['oc_proveedig'];
		$v_oc_proveenomb    = $arr['oc_proveenomb'];	
		$v_oc_estado        = $arr['oc_estado'];
		$v_oc_sc 		    = $arr["oc_sc"];
		$v_oc_ruta			= $arr["oc_rutatc"];
		$v_oc_archivo		= $arr["oc_archivotc"];
	}
	
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
						<a href="ver_oc.php">Ordenes de Compra</a>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<a href="#">Orden de Compra: <? echo $v_oc_id2 ?></a>
						
					</li>
				</ul>


				<!-- ************************************ -->
				<!-- AQUI COMIENZA EL CUERPO DEL PROGRAMA -->
				<!-- ************************************ -->

				<div class="row-fluid">
					<div class="box span12">

						<div class="box-header" data-original-title>
							<h2><i class="halflings-icon user"></i><span class="break"></span>Ordenes de Compra</h2>
						</div>
						<div class="box-content">
							<table class="table table-bordered" border="1">

								<tbody>
									<tr>
										<td>N° OC</td>
										<td class="center"><span class="label"><h2><? echo $v_oc_id2 ?></h2></span>
											<a class="btn btn-success" href="../oc.php?id=<?php echo $id_oc ?>" target="_blank"><i class="fa fa-cloud-download"></i></a>
										</td>
										<td class="center">Id</td>
										<td class="center"><strong>	<? echo $v_oc_id ?></strong></td>                                   
									</tr>
									<tr>
										<td>Región</td>
										<td class="center"><strong><? echo $v_oc_region ?></strong></td>
										<td class="center">Region 2</td>
										<td class="center"><strong><? echo $v_oc_region ?></strong>	</td>                                       
									</tr>
									<tr>
										<td>Nombre OC</td>
										<td class="center" colspan="3"><strong><? echo $v_oc_nombre_oc ?></strong></td>
									</tr>
									<tr>
										<td>Programa</td>
										<td class="center"><strong><? echo $v_oc_prog ?></strong></td>
										<td class="center">Usuario</td>
										<td class="center"><strong><? echo $v_oc_usu ?></strong>	</td>                                       
									</tr>
									<tr>
										<td>Proveedor </td>
										<td class="center" colspan="3"><strong><? echo $v_oc_proveerut,"-",$v_oc_proveedig," ",$v_oc_proveenomb ?></strong></td>
									</tr>
									<tr>
										<td>Monto</td>
										<td class="center"><strong>$<? echo number_format($v_oc_monto,0,".",".") ?></strong></td>
										<td class="center">Descuento</td>
										<td class="center"><strong>$<? echo number_format($v_oc_descuento,0,".",".")?></strong>	</td>                                       
									</tr>
									<tr>
										<td>Observaciones</td>
										<td class="center" colspan="3"><strong><? echo $v_oc_observaciones ?></strong></td>
									</tr>

									<tr>
										<td>Documentos Adjuntos</td>
										<td>
											<?php
											$ultimas = "SELECT * FROM bode_ingreso WHERE ing_oc_id = ".$id_oc." AND (ing_estado = 1 OR ing_estado = 2)";
											$resUltimas = mysql_query($ultimas,$dbh);
											while($rowUltimas = mysql_fetch_array($resUltimas)){
												if($rowUltimas["ing_rutatc"] <> ''){
													echo "<a href='../../../../".$rowUltimas["ing_rutatc"].$rowUltimas["ing_archivotc"]."' target='_blank' title='".$rowUltimas["ing_id"]."'><i class='fa fa-download'></i> </a>";
												}
											}
											/*$consulta="select * from bode_detoc where doc_oc_id = '$id_oc'";
											$resConsulta = mysql_query($consulta);

											while ($rconsulta = mysql_fetch_array($resConsulta))
											{
												$ultimas = "SELECT * FROM bode_ingreso WHERE ing_oc_id = ".$id_oc;
												$resUltimas = mysql_query($ultimas);
												while($rowUltimas = mysql_fetch_array($resUltimas)){
													if($rowUltimas["ing_rutatc"] <> ''){
														echo "<a href='../../../../".$rowUltimas["ing_rutatc"].$rowUltimas["ing_archivotc"]."' target='_blank' title='".$rowUltimas["ing_id"]."'><i class='fa fa-download'></i> </a>";
													}
												}
											}*/
											?>
										</td>

										<td>ABACO (<?php echo $v_oc_sc ?>)</td>
										<td><a href='http://abaco.junji.gob.cl/_layouts/FormServer.aspx?XmlLocation=/Solicitudes%20de%20Compra/<?php echo $v_oc_sc ?>.xml&ClientInstalled=false&Source=http%3A%2F%2Fabaco%2Ejunji%2Egob%2Ecl%2FSolicitudes%2520de%2520Compra%2FForms%2FAllItems%2Easpx&DefaultItemOpen=1' target="_blank"><i class="fa fa-external-link-square"></i></a></td>
									</tr>

									<tr>
										<td>Distribucion</td>

										<?php

											$sql_dist = "SELECT * FROM compra_orden WHERE oc_numero = '".$v_oc_id2."'";
											$res_dist = mysql_query($sql_dist,$dbh2);
											$row_dist = mysql_fetch_array($res_dist);

										?>
										<td>
											<?php if ($v_oc_archivo <> ""): ?>
												<a href="../../../../archivos/docfac/<?php echo $row_dist["oc_dist"] ?>" target="_blank"><i class='fa fa-download'></i></a>
											<?php else: ?>
												<?php if ($_SESSION["nom_user"] == "sebastian" || $_SESSION["nom_user"] == "mcantillana" || $_SESSION["nom_user"] == "pcastillo" || $_SESSION["nom_user"] == "jdvaldes"): ?>
													<a href="#" onclick="abreVentana2(<?php echo $v_oc_id ?>)"><i class='fa fa-upload'></i></a>
												<?php else: ?>
													<i class="fa fa-warning"></i>
												<?php endif ?>
												
											<?php endif ?>
										</td>
									</tr>

								</tbody>
							</table> 
							<hr>
							<h1> Detalle  </h1>
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Id</th>
										<th>Especif.</th>
										<th>Cantidad</th>
										<th>V.Unit</th>
										<th>Recibidos</th>
										<th>R.Técnica</th>
										<th>Final</th>
										<th>Stock</th>
										<th>Desp.</th>
										<th>Region</th>
										<th>Estado</th>
									</tr>
								</thead>   
								<tbody>
									<?
									$consulta="select * from bode_detoc where doc_oc_id = '$id_oc'";
          							// echo $consulta;
									$res = mysql_query($consulta,$dbh);
									while ($arr=mysql_fetch_array($res)){
										$v_doc_id	          = $arr['doc_id'];
										$v_doc_oc_id	      = $arr['doc_oc_id'];
										$v_doc_prod_id	      = $arr['doc_prod_id'];
										$v_doc_especificacion = $arr['doc_especificacion'];
										$v_doc_cantidad	      = $arr['doc_cantidad'];
										$v_doc_valor_unit     = $arr['doc_valor_unit'];	
										$v_doc_valor_unit2	  = $arr['doc_valor_unit2'];
										$v_doc_recibidos      = $arr['doc_recibidos'];
										$v_doc_tecnicos	      = $arr['doc_tecnicos'];
										$v_doc_final	      = $arr['doc_final'];
										$v_doc_stock	      = $arr['doc_stock'];
										$v_doc_despachados	  = $arr['doc_despachados'];
										$v_doc_region	      = $arr['doc_region'];
										$v_doc_origen_id	  = $arr['doc_origen_id'];
										$v_doc_estado         = $arr['doc_estado'];
										?>

										<tr>

											<td  class="center"><? echo $v_doc_id ?></td>
											<td  class="center"><? echo $v_doc_especificacion ?></td>
											<td  class="center"><? echo $v_doc_cantidad ?></td>
											<td  class="center">$<? echo number_format($v_doc_valor_unit,0,".",".") ?></td>
											<td  class="center"><? echo $v_doc_recibidos ?></td>
											<td  class="center"><? echo $v_doc_tecnicos ?></td>
											<td  class="center"><? echo $v_doc_final ?></td>
											<td  class="center"><? echo $v_doc_stock ?></td>
											<td  class="center"><? echo $v_doc_despachados ?></td>
											<td  class="center"><? echo $v_doc_region ?></td>
											<td  class="center"><? echo $v_doc_estado ?></td>
										</tr>
										<tr>
											<td> </td>
											<td> </td>
											<td colspan="10"> 
												<table class="table condensed">
													<?
													if ($v_doc_recibidos!=0){
														?>
														<tr>
															<td width="150">Fecha</td>
															<td>Guía</td>
															<td>cantidad</td>
															<td>region</td>
															<td>Rec.Tec.</td>
															<td>C.Rechazo</td>
															<td>Rec.Conf.</td>
															<td>Despacho</td>
															<td>Final</td>
															<td>Ubic.</td>
															<td>Imp. RT</td>
															<td>Imp. RC</td>
															<td>Estadistica</td>

														</tr>

														<? } ?>
														<? 
														//$con2="select * from bode_detingreso,bode_ingreso where ding_ing_id = ing_id and ding_prod_id=$v_doc_id";
														$con2="select * from bode_detingreso,bode_ingreso,bode_detoc where ding_ing_id = ing_id and ding_prod_id=$v_doc_id AND ding_recep_tecnica = 'A' AND (ing_estado = 1 OR ing_estado = 2) AND doc_id = ding_prod_id";
														// echo $con2;
														$res2=mysql_query($con2,$dbh);
														while($arr2=mysql_fetch_array($res2)){
															$v_ding_id	            = $arr2['ding_id'];
															$v_ding_ing_id         = $arr2['ding_ing_id'];	
															$v_ding_prod_id	    = $arr2['ding_prod_id'];
															$v_ding_cantidad	    = $arr2['ding_cantidad'];
															$v_ding_region_id	    = $arr2['doc_region'];
															$v_ding_recep_tecnica	= $arr2['ding_recep_tecnica'];
															$v_ding_cant_conf	    = $arr2['ding_recep_conforme'];
															$v_ding_cant_despacho	= $arr2['ding_cant_despacho'];
															$v_ding_cant_final	    = $arr2['ding_cant_final'];
															$v_ding_cant_rechazo	= $arr2['ding_cant_rechazo'];
															$v_ding_glosa_rechazo	= $arr2['ding_glosa_rechazo'];
															$v_ding_ubicacion	    = $arr2['ding_ubicacion'];
															$v_ding_user	        = $arr2['ding_user'];
															$v_ding_fecha	        = $arr2['ding_fecha'];
															$v_ding_userf	        = $arr2['ding_userf'];
															$v_ding_fechaf         = $arr2['ding_fechaf'];

															$v_ing_guia            = $arr2['ing_guia'];
															$v_ing_guianumerotc    = $arr2['ing_guianumerotc'];
															$v_ing_guianumerorc    = $arr2['ing_guianumerorc'];
															$v_ing_aprueba		   = $arr2["ing_aprobado"];
															$v_ing_guianumerorrchzo=$arr2["ing_guianumerorrchzo"];
															//$v_fentrega = substr($arr2["ding_fentrega"], 6,4)."-".substr($arr2["ding_fentrega"], 3,2)."-".substr($arr2["ding_fentrega"], 0,2);
															$v_fentrega = $arr2["ding_fentrega"];
															$diasHabiles = getWorkingDays($v_fentrega,Date("Y-m-d"));
															$v_ding_unidad			= $arr2["ding_unidad"];
															?>
															<tr>
																<td><? echo $v_fentrega ?></td>
																<td><? echo $v_ing_guia ?></td>
																<td><? echo $v_ding_cantidad ?></td>
																<td><? echo $v_ding_region_id ?></td>
																<td><? echo $v_ding_recep_tecnica ?></td>
																<td><? echo $v_ding_cant_rechazo ?></td>
																<td><? echo $v_ding_cant_conf ?></td>
																<td><? echo $v_ding_cant_despacho ?></td>
																<td><? echo $v_ding_cant_final ?></td>
																<td><? echo $v_ding_ubicacion ?></td>
																<td class="center">
																	<?php if($v_ing_aprueba <> ""): ?>
																		<a class="btn btn-success" href="../bode_tca.php?doc_id=<? echo $v_doc_id ?>&numguia=<? echo $v_ing_guianumerotc ?>">
																			<i class="halflings-icon white zoom-in"></i>
																		</a>

																	<?php endif ?> 
																</td>
																<td class="center">
																	<?php if ($v_ing_aprueba <> ""): ?>
																		<a class="btn btn-success" href="../bode_imprimerca.php?doc_id=<? echo $v_doc_id ?>&numguia=<? echo $v_ing_guianumerorc ?>">
																			<i class="halflings-icon white zoom-in"></i>
																		</a>
																	<?php endif ?>
																</td>
																<td>
																	
																	<?php if ($v_fentrega >= "2016-04-01"): ?>
																		<?php if ($v_ing_aprueba == ""): ?>
																			<font color="red"><strong><i class="fa fa-warning"></i></strong></font>
																		<?php elseif($v_ding_unidad > 0 && $diasHabiles >= 5 && $v_ing_aprueba <> ""): ?>
																			<font color="red"><strong><?php echo $diasHabiles ?></strong></font>/<?php echo $v_ding_unidad ?>
																		<?php elseif($v_ding_unidad > 0 && $diasHabiles < 5 && $v_ing_aprueba <> ""): ?>
																			<font color="green"><strong><?php echo $diasHabiles ?></strong></font>/<?php echo $v_ding_unidad ?>
																		<?php elseif($v_ding_unidad == 0 && $v_ing_aprueba <> ""): ?>
																			<font color="green"><strong><i class="fa fa-check"></i></strong></font>
																		<?php endif ?>
																	<?php endif ?>
																</td>
																
															</tr>
															<?
															if ($v_ding_cant_rechazo!=0){
																?>
																<tr>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td><font color="red"><? echo $v_ding_cant_rechazo ?></font></td>
																	<td colspan="5"><? echo $v_ding_glosa_rechazo ?></td>
																	<td><a class="btn btn-success" href="../bode_imprimerechazo.php?doc_id=<?php echo $v_doc_id ?>&numguia=<? echo $v_ing_guianumerorrchzo ?>&ding_id=<?php echo $v_ding_id ?>">
																		<i class="halflings-icon white zoom-in"></i></td>

																	</tr>
																	<?
																}
															}
															?>
														</table>
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

				<script>
					<!--
					function abreVentana2(oc_id){
						miPopup = window.open("subirarchivo.php?oc_id="+oc_id,"miwin","width=500,height=200,scrollbars=yes,toolbar=0")
						miPopup.focus()
					}

				-->
			</script>

		</body>
		</html>
