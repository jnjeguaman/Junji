<?php
session_start();
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];
//echo $regionsession;
//ini_set("display_errors", 0);
require("inc/config.php");
extract($_GET);
extract($_POST);



$sqlRegion = "SELECT * FROM acti_region order by region_id";
$sqlRegionResp = mysql_query($sqlRegion);
$ii=1;
while($row = mysql_fetch_array($sqlRegionResp)) {
  $regionG[$ii]=$row["region_glosa"];
  $regionN[$ii]=$row["region_id"];
   $ii++;
}



$regionsession = $_SESSION["region"];
$sqlCategoria = "SELECT * FROM acti_categoria";
$sqlCategoriaResp = mysql_query($sqlCategoria);

$sqlSubtitulo = "SELECT DISTINCT(acti_subtitulo) FROM acti_subtitulo";
$sqlSubtituloResp = mysql_query($sqlSubtitulo);

$sqlZona = "SELECT * FROM acti_zona";
$sqlZonaResp = mysql_query($sqlZona);

$sqlProveedor = "SELECT proveedor_glosa FROM acti_proveedor ORDER BY proveedor_glosa ASC";
$sqlProveedorResp = mysql_query($sqlProveedor);

$sqlRegion = "SELECT * FROM acti_region";
$sqlRegionResp = mysql_query($sqlRegion);
?>

<!DOCTYPE html>
<html>
<head>
	<title>SISTEMA DE INVENTARIO - JUNJI</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	
	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	


</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<?php if (intval($cod) === 22): ?>
		<?php  include("nuevo_requerimiento4.php") ?>
		<?php  require("ultimas_comprasoc.php") ?>
		<?php //  require("inv_ingresos.php") ?>
	<?php endif ?>

	<?php if (intval($ori) === 1): ?>
		<?php include("nuevo_requerimiento4.php") ?>
		<?php include("ori_1oc.php"); ?>

	<?php endif ?>

	<?php if (intval($ori) === 2): ?>
		<?php include("nuevo_requerimiento3.php") ?>
		<?php include("ori_2oc.php"); ?>
  		<?php //include("ori_2.php") ?>
		<?php //include("ori_1_1.php") ?>
		
	<?php endif ?>

	<?php if (intval($ori) === 3): ?>
		<?php include("nuevo_requerimiento4.php") ?>
		<?php include("inv_despacho2.php") ?>
	<?php endif ?>

	<?php if (intval($ori) === 4): ?>
		<?php include("nuevo_requerimiento3.php") ?>
		<?php include("inv_rec_tecnica.php") ?>
	<?php endif ?>
	<?php if (intval($ori) === 5): ?>
		<?php include("nuevo_requerimiento3.php") ?>
		<?php include("inv_rec_tecnica.php") ?>
		<?php include("inv_rec_tecnica2.php") ?>
	<?php endif ?>


	<script type="text/javascript">

		function getSubCat(input) {
			var data = ({command : "getSubCat", catsub_cat_id : input});
			$.ajax({
				type:"POST",
				url:"getsubcat.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+value+"'>"+value+"</option>";
					});
					$("#subgrupo").html(resp);

				}
			})

		}


		function getSubtitulo(input) {
			var data = ({command : "getSubtitulo", acti_subtitulo : input});
			$.ajax({
				type:"POST",
				url:"getsubtitulo.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+index+"'>"+value+"</option>";
					});
					$("#item").html(resp);

				}
			})
		}

		function getSubZona(input) {
			var data = ({command : "getSubZona", zona_id : input});
			$.ajax({
				type:"POST",
				url:"getsubzona.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+value+"'>"+value+"</option>";
					});
					$("#zona").html(resp);

				}
			})
		}

		function generarDistribucion()
		{
			console.log(frm4.document.getElementsById('region_distribucion').selectedValue);
		}

	</script>

</body>
</html>