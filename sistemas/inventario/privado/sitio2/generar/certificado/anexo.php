<table border="0" width="<?php echo $porcentaje ?>%" align="center" style="border-collapse: collapse;">
	<tr>
		<td><img src="../junji_logo.png"></td>
	</tr>

</table>

<br>

<table border="0" width="<?php echo $porcentaje ?>%" align="center" style="border-collapse: collapse;">
	<tr>
		<td><h4>Anexo Detalle de Valorización de Bienes:</h4></td>
	</tr>

	<tr>
		<td><h5>1.- Mobiliario y Equipamiento</h5></td>
	</tr>
</table>
<table border="0" width="<?php echo $porcentaje ?>%" style="border-collapse: collapse;" align="center">
<tr>
	<td style="font-size: 0.7em;text-align: center;font-weight: bold;">N°</td>
	<td style="font-size: 0.7em;text-align: center;font-weight: bold;">PRODUCTO</td>
	<td style="font-size: 0.7em;text-align: center;font-weight: bold;">CANTIDAD</td>
	<td style="font-size: 0.7em;text-align: center;font-weight: bold;">TOTAL</td>
</tr>

<tbody>
	<?php foreach ($nuevoArreglo[$i] as $key => $value): ?>
		<tr>
			<td align="center" style="font-size:0.6em;"><?php echo $contador ?></td>
			<td align="center" style="font-size:0.6em;"><?php echo $value["inv_bien"] ?></td>
			<td align="center" style="font-size:0.6em;"><?php echo $value["Total"] ?></td>
			<td align="center" style="font-size:0.6em;">$<?php echo number_format(($value["Total2"]),0,".",".") ?></td>
		</tr>
		<?php $contador++ ?>
	<?php endforeach ?>
</tbody>
</table>
