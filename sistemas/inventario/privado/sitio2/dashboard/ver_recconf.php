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
				    <a href="#">Recepción Conforme</a>
					
				</li>
			</ul>
            
			
			<!-- ************************************ -->
			<!-- AQUI COMIENZA EL CUERPO DEL PROGRAMA -->
			<!-- ************************************ -->
			
			<div class="row-fluid">
			    <div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Recepción Conforme</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Id</th>
								  <th>N° OC</th>
								  <th>N° Guia</th>
								  <th>Articulo</th>
								  <th>Region</th>
								  <th>Cantidad</th>
								  <th>Recep.Conforme</th>
								
							  </tr>
						  </thead>   
						  <tbody>
						    <?
							    $consulta="select * from bode_detingreso,bode_detoc,bode_orcom where ding_prod_id = doc_id and doc_oc_id = oc_id";
								$res = mysql_query($consulta);
								while ($arr=mysql_fetch_array($res)){
								    $v_ding_id	            = $arr['ding_id'];
									$v_ding_ing_id	        = $arr['ding_ing_id'];
									$v_ding_prod_id	        = $arr['ding_prod_id'];
									$v_ding_cantidad	    = $arr['ding_cantidad'];
									$v_ding_region_id	    = $arr['ding_region_id'];
									$v_ding_recep_tecnica	= $arr['ding_recep_tecnica'];
									$v_ding_cant_conf	    = $arr['ding_cant_conf'];
									$v_ding_cant_despacho	= $arr['ding_cant_despacho'];
									$v_ding_cant_final	    = $arr['ding_cant_final'];
									$v_ding_cant_rechazo	= $arr['ding_cant_rechazo'];
									$v_ding_glosa_rechazo	= $arr['ding_glosa_rechazo'];
									$v_ding_ubicacion	    = $arr['ding_ubicacion'];
									$v_ding_user	        = $arr['ding_user'];
									$v_ding_fecha	        = $arr['ding_fecha'];
									$v_ding_userf	        = $arr['ding_userf'];
									$v_ding_fechaf          = $arr['ding_fechaf'];
									
                                    $v_oc_id2               = $arr['oc_id2'];
                                    $v_doc_especificacion   = $arr['doc_especificacion'];									
								    
														
							?>
							     
							<tr>
								<td><? echo $v_ding_id ?></td>
								<td><? echo $v_oc_id2 ?></td>
								<td><? echo "*" ?></td>
								<td><? echo $v_doc_especificacion ?></td>
								<td><? echo $v_ding_region_id ?></td>
								<td><? echo $v_ding_cantidad ?></td>
								<td><? echo $v_ding_cant_conf ?></td>
								
								
							
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
