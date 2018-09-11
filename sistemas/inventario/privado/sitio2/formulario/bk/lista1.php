<div class="wrapper">
<div class="lista">
	<table border="1" width="100%" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<th rowspan="2">N°</th>
			<th rowspan="2">CODIGO</th>
			<th rowspan="2">BIEN</th>
			<th rowspan="2">CANTIDAD</th>
			<th rowspan="2">ESTADO</th>
			<th colspan="2">VALOR</th>
			<th rowspan="2">OBSERVAIONES</th>
		</tr>
		<tr>
			<th>UNITARIO</th>
			<th>TOTAL</th>
		</tr>
		<?php while($row = mysql_fetch_array($sql)) { ?>
		<tr>
			<td><?php echo $cont ?></td>
			<td><?php echo $row["inv_codigo"] ?></td>
			<td><?php echo $row["inv_bien"] ?></td>
			<td>1</td>
			<td><?php echo $row["inv_estadocosto"] ?></td>
			<td>$<?php echo number_format($row["inv_costo"],0,".",".") ?></td>
			<td>$<?php echo number_format($row["inv_costo"] * 1,0,".",".") ?></td>
			<td><?php echo $row["inv_obs"] ?></td>
		</tr>
		<?php $cont++; } ?>
	</table>
</div>
</div>