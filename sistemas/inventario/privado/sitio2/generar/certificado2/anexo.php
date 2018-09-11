<table border="0" width="<?php echo $porcentaje ?>%" align="center">
	<tr>
		<td><img src="../junji_logo.png"></td>
	</tr>
</table>

<br>

<table border="0" width="<?php echo $porcentaje ?>%" align="center">
	<tr>
		<td><h4>Anexo Detalle de Valorización de Bienes:</h4></td>
	</tr>

	<tr>
		<td><h5>1.- Mobiliario y Equipamiento</h5></td>
	</tr>

<table border="1" width="<?php echo $porcentaje ?>%" align="center" cellpadding="0" cellspacing="0">
<thead>
	<th>N°</th>
	<th>PRODUCTO</th>
	<th>CANTIDAD</th>
	<th>TOTAL</th>
</thead>

<tbody>
	<?php foreach ($data as $key => $value): ?>
		<tr>
			<td align="center" style="font-size:0.8em;"><?php echo $contador ?></td>
			<td align="center" style="font-size:0.8em;"><?php echo $value["inv_bien"] ?></td>
			<td align="center" style="font-size:0.8em;"><?php echo $value["Total"] ?></td>
			<td align="center" style="font-size:0.8em;">$<?php echo number_format(($value["Total2"]),0,".",".") ?></td>
		</tr>
		<?php $contador++ ?>
	<?php endforeach ?>
</tbody>


</table>