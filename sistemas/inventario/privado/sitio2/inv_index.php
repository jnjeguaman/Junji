<?php $jQueryTheme = array(1 => "black-tie", 2 => "blitzer", 3 => "cupertino", 4 => "dark-hive", 5 => "dot-luv", 6 => "eggplant", 7 => "excite-bike", 8 => "flick", 9 => "hot-sneaks", 10 => "humanity", 11 => "le-frog", 12 => "mint-choc", 13 => "overcast", 14 => "pepper-grinder", 15 => "redmond", 16 => "smoothness", 17 => "south-street", 18 => "start", 19 => "sunny", 20 => "swank-purse", 21 => "trontastic", 22 => "ui-darkness", 23 => "ui-lightness", 24 => "vader");


if (!isset($_GET['ori'])) {
	$ori="";
}
if (!isset($_GET['cod'])) {
	$cod="";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

	<script src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>
	<script type="text/javascript" src="librerias/jquery.Rut.js"></script>
	<link rel="stylesheet" href="librerias/jquery-ui-1.11.4.custom/themes/<?php echo $jQueryTheme[18] ?>/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.11.4.custom/themes/<?php echo $jQueryTheme[18] ?>/theme.css">
	<script src="librerias/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<?php
	$atributo = intval($_SESSION["pfl_user"]);
	$sqlCategoria = "SELECT * FROM acti_categoria ORDER BY cat_nombre";
	$sqlCategoriaResp = mysql_query($sqlCategoria);

	$sqlSubtitulo = "SELECT DISTINCT(acti_subtitulo),acti_subtitulo_dec_item FROM acti_subtitulo";
	$sqlSubtituloResp = mysql_query($sqlSubtitulo);

	$sqlZona = "SELECT * FROM acti_zona WHERE zona_region = ".$_SESSION["region"];
	$sqlZonaResp = mysql_query($sqlZona);

	$sqlProveedor = "SELECT proveedor_glosa FROM acti_proveedor ORDER BY proveedor_glosa ASC";
	$sqlProveedorResp = mysql_query($sqlProveedor);

	$sqlRegion = "SELECT * FROM acti_region";
	$sqlRegionResp = mysql_query($sqlRegion);
	?>

	<?php if (intval($cod) === 1): ?>
		<?php include("inv_nuevo_requerimiento.php") ?>
		<?php  require("ultimas_compras.php") ?>
	<?php endif ?>

	<?php if (intval($ori) === 1): ?>
		<?php include("inv_nuevo_requerimiento.php") ?>
		<?php include("ori_1.php") ?>
	<?php endif ?>

	<?php if (intval($ori) === 2): ?>
		<?php include("inv_nuevo_requerimiento.php") ?>
		<?php include("ori_2.php") ?>
	<?php endif ?>

	<?php if (intval($ori) === 3): ?>
		<?php include("inv_nuevo_requerimiento.php") ?>
		<?php include("ori_3.php") ?>
	<?php endif ?>

	<?php if (intval($ori) === 4): ?>
		<?php include("inv_nuevo_requerimiento.php") ?>
		<?php include("ori_4.php") ?>
	<?php endif ?>

	<?php if ($ori == ""): ?>
		<?php include("bienvenida.php") ?>
	<?php endif ?>


	<script type="text/javascript">

		function getSubCat(input) {
			var data = ({command : "getSubCat", catsub_cat_id : input});
			$.ajax({
				type:"POST",
				url:"inv_getsubcat.php",
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
				url:"inv_getsubtitulo.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar...</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+value.Subtitulo+"'>"+value.Subtitulo+" : "+value.Descripcion+"</option>";
					});
					$("#item").html(resp);

				}
			})
		}

		function getSubZona(input) {
			var data = ({command : "getSubZona", zona_id : input});
			$.ajax({
				type:"POST",
				url:"inv_getsubzona.php",
				data:data,
				dataType:"JSON",
				cache:false,
				success:function(response) {
					var resp = "";
					resp +="<option selected value=''>Seleccionar</option>";
					$.each(response,function(index,value){
						resp +="<option value='"+value.subzona+"'>"+value.subzona+"</option>";
					});
					$("#zona").html(resp);

				}
			})
		}

	</script>

</body>
</html>
