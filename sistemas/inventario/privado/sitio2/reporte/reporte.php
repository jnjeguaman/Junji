<?php
error_reporting(0);
session_start();
// PARAMETROS
$limite = 25;
$hojas = ceil(count($_SESSION["lista"]) / $limite);
$newArray = array_chunk($_SESSION["lista"], $limite);
$contador = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>REPORTE GUIAS DE DESPACHO</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
<div class="contenedor">
	<?php for($i=0;$i<$hojas;$i++): ?>
		<?php include("encabezado.php") ?>
		<?php include("datos.php") ?>
		<?php include("resumen.php") ?>

		<div class="footer">
		<table id="footer">
			<tr>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td>________________________________________________________</td>
				<td>________________________________________________________</td>
			</tr>

			<tr>
				<td style="text-align: center">FIRMA TRANSPORTISTA</td>
				<td style="text-align: center">V° B° LOGÍSTICA</td>
			</tr>
		</table>
	</div>

		<p style="page-break-before: always">
	<?php endfor ?>
	</div>
</body>
</html>