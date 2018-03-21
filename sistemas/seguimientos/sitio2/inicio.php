<?php
require_once("inc/config.php");
$sql = "SELECT * FROM segfac_config";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$estado = intval($row["config_estado"]);
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/mantenimiento.css">
	<title>SIGEJUN</title>
	<meta charset="UTF-8">

	<style type="text/css">
		/*iframe
		{
			width: 100%;
			height: 100vh;
			border: none;
		}

		body{
			padding:0;
			margin:0;
			overflow: hidden;
		}*/

		html, body, div, iframe {
			margin:0;
			padding:0;
			height:100%;
		}
		iframe {
			display:block;
			width:100%;
			border:none; }
			
	</style>
</head>
<body>
	<?php if ($estado === 0): ?>
			<iframe src="inicio2.php" scrolling="yes">
				<p>ESTE NAVEGADOR NO SOPORTA IFRAME</p>
			</iframe>
	<?php else: ?>
		<div class="contenedor">
			<p class="inedis">SIGEJUN</p>
			<p class="glosa">SISTEMA DE CONTROL Y GESTI&Oacute;N JUNJI</p>
			<img src="../../inventario/privado/sitio2/images/logo_junji_alta.jpg" class="logo">
			<p class="mantenimiento">SISTEMA EN MANTENIMIENTO</p>
		</div>
	<?php endif ?>
</body>
</html>