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
	$res = mysql_query($consulta);
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
		$v_oc_observaciones	= $arr['oc_obs'];
		$v_oc_proveerut	    = $arr['oc_proveerut'];
		$v_oc_proveedig	    = $arr['oc_proveedig'];
		$v_oc_proveenomb    = $arr['oc_proveenomb'];	
		$v_oc_estado        = $arr['oc_estado'];
		$v_oc_folioguia     = $arr["oc_folioguia"];
		$v_oc_observaciones2= $arr["oc_observaciones"];
		$v_oc_bulto = $arr["oc_bulto"];
		$v_oc_chofer = $arr["oc_chofer"];
		$v_oc_patente = $arr["oc_patente"];
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
				    <a href="ver_oc.php">Guias de Despacho</a>
					<i class="icon-angle-right"></i>
				</li>
				<li>
				    <a href="#">Guia: <? echo $v_oc_id2 ?></a>
				
				</li>
			</ul>
            
			
			<!-- ************************************ -->
			<!-- AQUI COMIENZA EL CUERPO DEL PROGRAMA -->
			<!-- ************************************ -->
			
			<div class="row-fluid">
			    <div class="box span12">
				    
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Guias de despacho</h2>
						
					</div>
					<div class="box-content">
					    <table class="table table-bordered">
							 
							  <tbody>
								<tr>
									<td>N° Guia</td>
									<td class="center"><span class="label"><h2><? echo $v_oc_folioguia ?></h2></span></td>
									<td class="center">Id</td>
									<td class="center"><strong>	<? echo $v_oc_id ?></strong></td>                                   
								</tr>
								<tr>
									<td>Region Origen</td>
									<td class="center"><strong><? echo $v_oc_region2  ?></strong></td>
									<td class="center">Destino</td>
									<td class="center"><strong><? echo $v_oc_region ?></strong>	</td>                                       
								</tr>
								
								<tr>
									<td class="center">Usuario</td>
									<td class="center" colspan="3"><strong><? echo $v_oc_usu ?></strong>	</td>                                       
								</tr>
								
								<tr>
									<td>Observaciones</td>
									<td class="center" colspan="3"><strong><? echo $v_oc_observaciones ?></strong></td>
								</tr>
								          	
								<tr>
									<td>G/D</td>
									<td class="center" colspan="3"><a class="btn btn-success" href="../bode_imprimirguia.php?id=<? echo $v_oc_id ?>">
										<i class="fa fa-download fa-lg"></i>  
									</a></td>
								</tr>  

								<tr>
									<td>Observacion interna</td>
									<td colspan="3"><?php echo $v_oc_observaciones2 ?></td>
								</tr> 

								<tr>
									<td>Chofer</td>
									<td><?php echo $v_oc_chofer ?></td>

									<td>Patente</td>
									<td><?php echo $v_oc_patente ?></td>
								</tr>      	                     
							  </tbody>
						 </table> 
						 <hr>
						 <h1> Detalle > </h1>
						<table class="table table-striped table-bordered">
						  <thead>
							  <tr>
								  <th>Id</th>
								  <th>Especif.</th>
								  <th>Cantidad</th>
								  <th>V.Unit</th>
								  <th>Destino</th>
								  <th>Estado</th>
							  </tr>
						  </thead>   
						  <tbody>
						    <?
							    $consulta="select * from bode_detoc where doc_oc_id = '$id_oc'";
								$res = mysql_query($consulta);
								while ($arr=mysql_fetch_array($res)){
								    $v_doc_id	          = $arr['doc_id'];
									$v_doc_oc_id	      = $arr['doc_oc_id'];
									$v_doc_prod_id	      = $arr['doc_prod_id'];
									$v_doc_especificacion = $arr['doc_especificacion'];
									$v_doc_cantidad	      = $arr['doc_cantidad'];
									$v_doc_valor_unit     = $arr['doc_valor_unit'];	
									$v_doc_valor_unit2	  = $arr['doc_valor_unit2'];
									$v_doc_unit           = $arr["doc_unit"];
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
								<td  class="center">$<? echo number_format($v_doc_unit,0,".",".") ?></td>
								<td  class="center"><? echo $v_doc_region ?></td>
								<td  class="center"><? if($v_doc_estado == "") { echo "DESPACHADO";}else { echo $v_doc_estado; } ?></td>
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
									     </tr>
										 
										 <? } ?>
								<? 
								    $con2="select * from bode_detingreso,bode_ingreso where ding_ing_id = ing_id and ding_prod_id=$v_doc_id";
									$res2=mysql_query($con2);
									while($arr2=mysql_fetch_array($res2)){
									     $v_ding_id	            = $arr2['ding_id'];
										 $v_ding_ing_id         = $arr2['ding_ing_id'];	
										 $v_ding_prod_id	    = $arr2['ding_prod_id'];
										 $v_ding_cantidad	    = $arr2['ding_cantidad'];
										 $v_ding_region_id	    = $arr2['ding_region_id'];
										 $v_ding_recep_tecnica	= $arr2['ding_recep_tecnica'];
										 $v_ding_cant_conf	    = $arr2['ding_cant_conf'];
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
										 
										 															
									
									?>
									    <tr>
										     <td><? echo $v_ding_fecha ?></td>
											 <td><? echo $v_ing_guia ?></td>
										     <td><? echo $v_ding_cantidad ?></td>
											 <td><? echo $v_ding_region_id ?></td>
											 <td><? echo $v_ding_recep_tecnica ?></td>
											 <td><? echo $v_ding_cant_rechazo ?></td>
											 <td><? echo $v_ding_cant_conf ?></td>
											 <td><? echo $v_ding_cant_despacho ?></td>
											 <td><? echo $v_ding_cant_final ?></td>
											 <td><? echo $v_ding_ubicacion ?></td>
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
											 <td colspan="4"><? echo $v_ding_glosa_rechazo ?></td>
											 
											 <td> </td>
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
	
</body>
</html>
