
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
	<link rel="stylesheet" href="librerias/jquery-ui-1.11.4.custom/themes/start/jquery-ui.min.css">
	<script src="librerias/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
</head>
<body>
	<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>
	<div style="background-color:#E0F8E0; position:absolute; top:120px; left:00px; width:100%" id="div1">
	<table border="0" cellpadding="0" cellspacing="0" width="50%" align="center">
		<tr>
			<td>
				<a href="bode_movimiento.php?cod=41&cmd=Aprobaciones" class="button" id="menu_junji_39" >Aprobaciones</a>
			</td>
		</tr>
	</table>

	<?php
extract($_POST);
if(isset($cmd))
{
	$cmd = htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch($cmd)
	{
	case "Aprobaciones":
	require_once("bode_aprobaciones.php");
	}
	
}

?>
	</div>
</body>

</html>