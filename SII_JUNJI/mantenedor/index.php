<?php
ini_set("display_errors", 0);
session_start();
$menu = array("clientes","folios","categorias","productos","empresa","usuario");

$rutas = array(
	"clientes" => "forms/clientes/index.php",
	"folios" => "forms/folios/index.php",
	"categorias" => "forms/categorias/index.php",
	"productos" => "forms/productos/index.php",
	"empresa" => "forms/empresa/index.php",
	"usuario" => "forms/usuario/index.php"
	);

if(isset($_REQUEST["pagina"]))
{
	$pagina = $_REQUEST["pagina"];
	if(in_array($pagina, $menu)){
		$exe = $rutas[$pagina];
	}else{
		$exe = "404.php";
	}
}else{
	$exe = "404.php";
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>FACTURA ELECTRONICA</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="css/style.default.css" rel="stylesheet">
	<link href="css/morris.css" rel="stylesheet">
	<link href="css/select2.css" rel="stylesheet" />

	<link href="css/style.datatables.css" rel="stylesheet">
	<link href="//cdn.datatables.net/responsive/1.0.1/css/dataTables.responsive.css" rel="stylesheet">
	 <link href="css/jquery.gritter.css" rel="stylesheet">

	<!-- CARGA DE SCRIPTS !-->
	<script src="js/jquery-1.11.1.min.js"></script>

	<script src="js/jquery-migrate-1.2.1.min.js"></script>
	<script src="js/editableInvoice.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/modernizr.min.js"></script>
	<script src="js/pace.min.js"></script>
	<script src="js/retina.min.js"></script>
	<script src="js/jquery.cookies.js"></script>
	<script src="js/flot/jquery.flot.min.js"></script>
	<script src="js/flot/jquery.flot.resize.min.js"></script>
	<script src="js/flot/jquery.flot.spline.min.js"></script>
	<script src="js/jquery.sparkline.min.js"></script>
	<script src="js/morris.min.js"></script>
	<script src="js/raphael-2.1.0.min.js"></script>
	<script src="js/bootstrap-wizard.min.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/jquery.Rut.js"></script>
	<script src="js/jquery.gritter.min.js"></script>
	
	 <script src="js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="//cdn.datatables.net/responsive/1.0.1/js/dataTables.responsive.js"></script>
 <!-- <script src="js/dashboard.js"></script> -->
<script src="../js/jquery.blockUI.js"></script>
	<!-- FIN CARGA DE SCRIPTS !-->


</head>
<body>
<?php if (isset($_SESSION["sii"]) AND $_SESSION["sii"]["usuario_conectado"] === true): ?>
	<!-- HEDER !-->
	<?php require_once("views/header.php") ?>
	<!-- FIN HEADER !-->

	<section>
		<div class="mainwrapper">

			<!-- MENU LATERAL !-->
			<?php require_once("views/latera.php") ?>
			<!-- FIN MENU LATERAL !-->

			<!-- CONTENIDO !-->
			<div class="mainpanel">
				<div class="pageheader">
					<div class="media">
						<div class="pageicon pull-left">
							<i class="fa fa-home"></i>
						</div>
						<div class="media-body">
							<ul class="breadcrumb">
								<li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
								<li>Dashboard</li>
							</ul>
							<h4>Dashboard</h4>
						</div>
					</div>
				</div>

				<div class="contentpanel">

					<div class="row row-stat">
						<div class="col-md-12">
							<?php include($exe) ?>

						</div><!-- col-md-4 -->
					</div> 
				</div>

			</div>
		</div>
	</section>
	<!-- FIN CONTENIDO !-->
<?php else: ?> 
	<?php  require_once("forms/login/index.php") ?>
<?php endif ?>
<script>
    jQuery(document).ready(function(){
    	$("#cliente_region,#cliente_provincia,#cliente_comuna_id,#cliente_actividad_economica,#empresa_acteco,#empresa_region,#cliente_tipo").select2();
        jQuery('#basicTable').DataTable({
				responsive: true,
				"aaSorting" : []
			});
    });

    function blockUI() {
			$.blockUI({ css: {
				border: 'none',
				padding: '15px',
				backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: .5,
				color: '#fff'
			},
			message:"Espere un momento porfavor <i class='fa fa-spinner fa-spin'></i>" });
		}

		function unBlockUI() {
			$.unblockUI();
		}
    </script>
</body>
</html>

