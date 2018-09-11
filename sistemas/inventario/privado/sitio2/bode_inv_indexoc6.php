<?php
session_start();
require("inc/config.php");
extract($_GET);
extract($_POST);
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

</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<?php if (intval($cod) === 43): ?>
		<?php  include("bode_nuevo_requerimiento6.php") ?>
	<?php endif ?>

	<?php if (intval($ori) === 1): ?>
		<?php include("bode_nuevo_requerimiento6.php") ?>
		<?php include("bode_listainventario.php"); ?>
	<?php endif ?>

</body>
</html>
