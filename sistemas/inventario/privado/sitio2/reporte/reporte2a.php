<?php
require_once("../inc/config.php");
error_reporting(0);
session_start();

// PARAMETROS
$arrResumenGuias = array();
$resumenGuias = "SELECT * FROM bode_orcom WHERE oc_despacho_folio = ".$_GET["folio"];
$resResumenGuias = mysql_query($resumenGuias);
while($rowResumenGuias = mysql_fetch_array($resResumenGuias))
{
	$arrResumenGuias[] = $rowResumenGuias;
}

$limite = 25;
$hojas = ceil(count($arrResumenGuias) / $limite);
$newArray = array_chunk($arrResumenGuias, $limite);
$contador = 1;

$totalDistribucion = mysql_query("SELECT SUM(doc_cantidad) as Suma FROM bode_detoc a INNER JOIN bode_orcom b ON a.doc_oc_id = b.oc_id WHERE doc_estado <> 'ELIMINADO' AND oc_despacho_folio = ".$_GET["folio"]);
$totalDistribucion = mysql_fetch_array($totalDistribucion);
$totalDistribucion = intval($totalDistribucion["Suma"]);

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
				<td>FIRMA TRANSPORTISTA</td>
				<td>V&deg; B&deg; LOG&Iacute;STICA</td>
			</tr>
		</table>
	</div>
		<p style="page-break-before: always">
	<?php endfor ?>
	</div>
</body>
</html>