<?php
session_start();
// PARAMETROS
$limite = 20;
$hojas = round(count($_SESSION["lista"]) / $limite);
$contador = 1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>REPORTE GUIAS DE DESPACHO</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<div class="encabezado">
		<table>
			<thead>
				<th><img src="../junji_logo.png"></th>
				<th>
					<h2>JUNTA NACIONAL DE JARDINES INFANTILES</h2>
					<h3>RESUMEN DE GUIAS</h3>
				</th>
				<th>
					<ul>
						<li>FECHA EMISION : <?php echo Date("d-m-Y") ?></li>
					</ul>
				</th>
			</thead>
		</table>
	</div>

	<div class="datos">
		<table>
			<tr>
				<td colspan="3" align="center"><b>DATOS DEL TRANSPORTISTA</b></td>
			</tr>

			<tr>
				<td>NOMBRE CHOFER</td>
				<td>:</td>
				<td><?php echo $_SESSION["datos"]["chofer"] ?></td>
			</tr>

			<tr>
				<td>PATENTE</td>
				<td>:</td>
				<td><?php echo $_SESSION["datos"]["patente"] ?></td>
			</tr>

			<tr>
				<td>OBSERVACIÓN</td>
				<td>:</td>
				<td><?php echo $_SESSION["datos"]["obs"] ?></td>
			</tr>

			<tr>
				<td>TOTAL GUIAS</td>
				<td>:</td>
				<td>4</td>
			</tr>
		</table>
	</div>

	<div class="resumenGuias">
		<table>
			<tr>
				<td colspan="2" align="center"><b>LISTADO DE GUIAS</b></td>
			</tr>

			<tr>
				<td></td>
				<td>N° GUIA</td>
			</tr>
			<?php for ($i=0;$i<count($_SESSION["lista"]);$i++): ?>
				<tr>
					<td><?php echo $contador ?></td>
					<td><?php echo $_SESSION["lista"][$i]["oc_folioguia"] ?></td>
				</tr>
				<?php $contador++; ?>
			<?php endfor ?>
		</table>
	</div>

	<p style="page-break-before: always">
		<div class="footer">
			<table>
				<tr>
					<td></td>
					<td></td>
				</tr>

				<tr>
					<td>___________________________</td>
					<td>___________________________</td>
				</tr>

				<tr>
					<td>FIRMA TRANSPORTISTA</td>
					<td>V° B° LOGÍSTICA</td>
				</tr>
			</table>
		</div>
	</body>
	</html>