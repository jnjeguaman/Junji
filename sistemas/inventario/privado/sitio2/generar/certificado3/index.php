<?php
require_once("../inc/config.php");
$jardin = trim(str_replace("JI ","",$direccion));
$detalleJardin = mysql_query("SELECT * FROM jardines WHERE jardin_codigo = ".$jardin);
$detalleJardin = mysql_fetch_array($detalleJardin);
$pizza = explode(" ", $direccion);
$sql = "SELECT COUNT(inv_codigo) AS Total,SUM(inv_costo) as Total2, inv_estadocosto, inv_codigo, inv_bien, inv_costo, inv_obs FROM acti_inventario WHERE inv_region = '".$_SESSION["region"]."' AND (inv_direccion = '".$direccion."' OR inv_direccion = '".$pizza[1]."') AND inv_estado2 = 1 AND inv_visible = 1 GROUP BY inv_bien";
?>
<!DOCTYPE html>
<html>
<head>
	<title>CERTIFICADO DE VALORIZACIÓN</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<style type="text/css">
		body{
			margin: 0;
			padding: 0;
		}
	</style>
</head>
<body>
<?php include_once("encabezado.php") ?>
<p style="page-break-before: always">
<?php include_once("anexo.php") ?>
</body>
</html>