<?php
session_start();
require("inc/config.php");
extract($_POST);
$jQueryTheme = array(
	1 => "black-tie",
	2 => "blitzer",
	3 => "cupertino",
	4 => "dark-hive",
	5 => "dot-luv",
	6 => "eggplant",
	7 => "excite-bike",
	8 => "flick",
	9 => "hot-sneaks",
	10 => "humanity",
	11 => "le-frog",
	12 => "mint-choc",
	13 => "overcast",
	14 => "pepper-grinder",
	15 => "redmond",
	16 => "smoothness",
	17 => "south-street",
	18 => "start",
	19 => "sunny",
	20 => "swank-purse",
	21 => "trontastic",
	22 => "ui-darkness",
	23 => "ui-lightness",
	24 => "vader");
	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>INEDIS</title>
		<meta charset="UTF-8">
		<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.11.4.custom/themes/<?php echo $jQueryTheme[17] ?>/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="librerias/jquery-ui-1.11.4.custom/themes/<?php echo $jQueryTheme[17] ?>/theme.css">

		<script src="librerias/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="librerias/calendar.js"></script>
		<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
		<script type="text/javascript" src="librerias/calendar-setup.js"></script>
		<script type="text/javascript" src="librerias/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>




	</head>
	<body>
		<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
			<?php include("inc/menu_1b.php"); ?>
		</div>

		<?php if (intval($cod) === 41): ?>
			<?php  include("bode_nuevo_requerimiento4a.php") ?>
		<?php endif ?>
		<script type="text/javascript">
			$(function(){
				$( document ).tooltip();
			})

			function validare3()
			{
				var fecha = $("#f_date_c2").val();
				var nombre = $("#nombre").val();
				var sector = $("#sector").val();

				if(fecha == "")
				{
					alert("INGRESE LA FECHA DE DESPACHO");
					$("#f_date_c2").focus();
					return false;
				}else if(nombre == ""){
					alert("INGRESE EL NOMBRE DE LA DISTRIBUCION");
					$("#nombre").focus();
					return false;

				}else if(sector == ""){
					alert("INGRESE EL SECTOR");
					$("#sector").focus();
					return false;

				}else{
					return true;
				}
			}
		</script>

	</body>
	</html>
