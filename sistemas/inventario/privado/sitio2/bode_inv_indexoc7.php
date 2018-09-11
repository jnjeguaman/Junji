<?php
session_start();
require_once("inc/config.php");
extract($_GET);
extract($_POST);
$regionsession = $_SESSION["region"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>INEDIS</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	
	<script type="text/javascript" src="librerias/calendar.js"></script>
	<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>
	<script type="text/javascript" src="librerias/calendar-setup.js"></script>

</head>
<body>
	<div style="background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>
	<div class="container">
		<?php if ($cod == 50): ?>
			<?php require_once("bode_nuevo_requerimiento7.php") ?>
			<?php require_once("bode_nuevo_requerimiento73.php") ?>
		<?php endif ?>

		<?php if ($ori == 2): ?>
			<?php require_once("bode_nuevo_requerimiento72.php") ?>
			<?php require_once("bode_nuevo_requerimiento73.php") ?>
		<?php endif ?>
	</div>

	<script type="text/javascript">
		function getOficina(input){
			var data = ({region_id : input});
			$.ajax({
				type:"POST",
				url:"buscaOficinas.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					$("#destino").html(response);
				}
			});
		}

		function getJardinesRegion(input){
			var data = ({cmd : "getJardinesRegion", region_id : input});
			$.ajax({
				type:"POST",
				url:"bode_getJardines.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					$("#destino").html(response);
				}
			});
		}
	</script>
</body>
</html>