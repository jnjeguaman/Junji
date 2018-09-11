<?php
session_start();
ini_set("display_errors", 0);
error_reporting(0);
include_once("inc/config.php");
$query = "SELECT * FROM inedis_config";
$rs = mysql_query($query);
$row = mysql_fetch_array($rs);

/*	ESTADOS
0 : SITIO HABILITADO
1 : SITIO EN MANTENIMIENTO
*/
$estado = intval($row["inedis_estado"]);


// CAMBIAMOS DE SISTEMA
if(isset($_POST["perfil"]))
{
	$_SESSION["pfl_user"] = $_REQUEST["perfil"];
}

// CAMBIAMOS DE REGION
if(isset($_POST["ur"]))
{
	$_SESSION["region"] = $_POST["ur"];
}

if(isset($_POST["ns"]))
{
	$_SESSION["pfl_user"] = $_POST["ns"];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="mantenimiento.css">
	<title>INEDIS</title>
	<style type="text/css">
		iframe
		{
			width: 100%;
			height: 100vh;
			border: none;
		}

		body{
			padding:0;
			margin:0;
		}
		html{
			overflow: hidden;
		}
	</style>
</head>
<body>
	<?php if ($estado === 0 || $_SESSION["nom_user"] == "INEDIS"): ?>
		
		<?php if ($_SESSION["pfl_user"] == 50 || $_SESSION["pfl_user"] == 48): ?>
			<?php include("selector.php") ?>
		<?php else: ?>
			<iframe src="inv_index.php" scrolling="yes">
			<p>ESTE NAVEGADOR NO SOPORTA IFRAME</p>
		</iframe>
		<?php endif ?>

	<?php else: ?>
		<div class="contenedor">
				<p class="inedis">INEDIS</p>
				<p class="glosa">INVENTARIO EXISTENCIA Y DISTRIBUCIÓN</p>
			<img src="images/logo_junji_alta.jpg" class="logo">
			<p class="mantenimiento">SITIO EN MANTENIMIENTO</p>
		</div>
	<?php endif ?>
</body>
</html>