<?php
ini_set("display_errors", 0);
session_start();
$menu = array("factura","notacredito","QueryEstDteAv","QueryEstDte","QueryEstUp","cotizacion","gd","facturaexenta","notadebito","estadisticas","dashboard","iecv","dteRecibidos","generaSET","librogd","perfil","empresa","detalle","dteWS","consultarDocDteCedible");

$rutas = array(
	"factura" => "forms/factura/index.php",
	"notacredito" => "forms/notacredito/index.php",
	"QueryEstDteAv" => "forms/QueryEstDteAv/index.php",
	"QueryEstDte" => "forms/QueryEstDte/index.php",
	"QueryEstUp" => "forms/QueryEstUp/index.php",
	"cotizacion" => "forms/cotizacion/index.php",
	"gd" => "forms/gd/index.php",
	"facturaexenta" => "forms/facturaexenta/index.php",
	"notadebito" => "forms/notadebito/index.php",
	"estadisticas" => "forms/estadisticas/index.php",
	"dashboard" => "forms/dashboard/index.php",
	"iecv" => "forms/iecv/index.php",
	"dteRecibidos" => "forms/dteRecibidos/index.php",
	"generaSET" => "forms/generaSET/index.php",
	"librogd" => "forms/librogd/index.php",
	"perfil" => "forms/perfil/index.php",
	"empresa" => "forms/empresa/index.php",
	"detalle" => "forms/detalle/index.php",
	"dteWS" => "forms/dteWS/index.php",
	"consultarDocDteCedible" => "forms/consultarDocDteCedible/index.php"
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

$jQueryTheme = array(1 => "black-tie", 2 => "blitzer", 3 => "cupertino", 4 => "dark-hive", 5 => "dot-luv", 6 => "eggplant", 7 => "excite-bike", 8 => "flick", 9 => "hot-sneaks", 10 => "humanity", 11 => "le-frog", 12 => "mint-choc", 13 => "overcast", 14 => "pepper-grinder", 15 => "redmond", 16 => "smoothness", 17 => "south-street", 18 => "start", 19 => "sunny", 20 => "swank-purse", 21 => "trontastic", 22 => "ui-darkness", 23 => "ui-lightness", 24 => "vader");
$selectedTheme = rand(1,24);

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
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-themes-1.12.1/themes/<?php echo $jQueryTheme[$selectedTheme] ?>/theme.css">
	<link rel="stylesheet" href="js/select2/dist/css/select2.min.css">
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
	<!-- <script src="js/dashboard.js"></script> -->
	<script src="js/jquery.gritter.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="//cdn.datatables.net/responsive/1.0.1/js/dataTables.responsive.js"></script>
	<script src="js/jquery.blockUI.js"></script>
	<script src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="js/select2/dist/js/select2.full.min.js"></script>
	<script src="js/jquery.Rut.js"></script>
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
		<?php  print_r($_SESSION["sii"]) ?>
		<?php  require_once("forms/login/index.php") ?>
	<?php endif ?>

	<script>
		jQuery(document).ready(function(){
			$("#receptor_id , #TpoDocRef, #cliente_id,#periodo_annio,#periodo_mes,#periodo_tipo_envio,#periodo_tipo_libro,#iecv_tipo_dcto,#iecv_otros_imp,#iecv_iva_norec,#sii_tipo_dcto,#periodo_region,#periodo_tipo").select2({
				theme : "classic",
				allowClear : true,
			});
			jQuery('#basicTable').DataTable({
				responsive: true,
				"aaSorting" : []
			});

		});

		$("#dcto_fecha_emision,#FchRef").datepicker({
			dateFormat : 'yy-mm-dd'
		});

		$("#eventoCalendario").click(function(event){
			event.preventDefault();
			$("#dcto_fecha_emision, #FchRef").click();
		})

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

		function setReferencia(input)
		{
			if(input == "SI")
			{
				$("#TpoDocRef").attr("required",true);
				$("#FolioRef").attr("required",true);
				$("#FchRef").attr("required",true);
				$("#RazonRef").attr("required",true);
			}else{
				$("#TpoDocRef").attr("required",false);
				$("#FolioRef").attr("required",false);
				$("#FchRef").attr("required",false);
				$("#RazonRef").attr("required",false);
			}
		}

		function enviarCorreo(trackid,region)
		{
			var data = ({cmd : "enviarCorreo",trackid : trackid,region:region});

			$.ajax({
				type:"POST",
				url:"includes/functions.correo.php",
				data:data,
				dataType:"JSON",
				beforeSend : function (){
					blockUI();
				},
				success : function ( response ) {
					if(response.Respuesta)
					{
						jQuery.gritter.add({
							title: 'Exito!',
							text: response.Mensaje,
							class_name: 'growl-success',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                        // setTimeout(function(){
                        //  window.location.href='?pagina=factura&ori=ver';
                        // },1500);
                    }else{
                    	jQuery.gritter.add({
                    		title: 'Ha ocurrido un error!',
                    		text: response.Mensaje,
                    		class_name: 'growl-danger',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                    }
                },
                complete : function ()
                {
                	unBlockUI();
                }
            });
		}

		$(".enviarcorreo").click(function(){
			var idfactura = $(this).attr("fact_id");
			var idcliente = $(this).attr("cliente_id");
			$.ajax({
				type:"GET",
				url:"documentocorreo.php",
				data:{ "idcli": idcliente , "idfact" : idfactura},
				dataType:"JSON",
				beforeSend:function(){
					blockUI();
				},
				success : function ( response ) {
					unBlockUI();
					console.log(response);
					if(response.Respuesta)
					{
						jQuery.gritter.add({
							title: 'Exito!',
							text: response.Mensaje,
							class_name: 'growl-success',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                        // setTimeout(function(){
                        //  window.location.href='?pagina=factura&ori=ver';
                        // },1500);
                    }else{
                    	jQuery.gritter.add({
                    		title: 'Ha ocurrido un error!',
                    		text: response.Mensaje,
                    		class_name: 'growl-danger',
                                // image: 'images/logo.png',
                                sticky: false,
                                time: ''
                            });
                    }
                }
            });
		});
	</script>
</body>
</html>