	<?php
	$datos = "SELECT * FROM bode_orcom WHERE oc_despacho_folio = ".$_GET["folio"];
	$datos = mysql_query($datos);
	$datos = mysql_fetch_array($datos);
	?>

	<div class="datos">
		<table id="datos">
			<tr>
				<td colspan="3" align="center"><strong>DATOS DEL TRANSPORTISTA</strong></td>
			</tr>

			<tr>
				<td>NOMBRE CHOFER</td>
				<td>:</td>
				<td><?php echo $datos["oc_chofer"] ?></td>
			</tr>

			<tr>
				<td>PATENTE</td>
				<td>:</td>
				<td><?php echo $datos["oc_patente"] ?></td>
			</tr>

			<tr>
				<td>OBSERVACI&Oacute;N</td>
				<td>:</td>
				<td><?php echo $datos["oc_observaciones"] ?></td>
			</tr>

			<tr>
				<td>TOTAL GUIAS</td>
				<td>:</td>
				<td><?php echo count($arrResumenGuias) ?></td>
			</tr>

			<tr>
				<td>TOTAL UNIDADES</td>
				<td>:</td>
				<td><?php echo $totalDistribucion ?></td>
			</tr>

		</table>
	</div>