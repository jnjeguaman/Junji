<?php
$start = $i *  $limit;
$sql = "SELECT * FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_zona = '".$zona."' AND inv_direccion = '".$responsa."' AND inv_region = ".$_SESSION["region"]." LIMIT ".$start.",".$limit;
$sql = mysql_query($sql);
$cont = 1;
?>
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
				<th rowspan="2">OBSERVACIONES</th>
			</tr>
			<tr>
				<th>UNITARIO</th>
				<th>TOTAL</th>
			</tr>
			<?php
             while($row = mysql_fetch_array($sql)) {
                 $arrecodigo[$i2]= $row["inv_codigo"];
       ?>
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
			<?php $cont++; $i2++; } ?>


				<?php  $restante = 21 - $cont; ?>

				<?php for ($q=0; $q < $restante; $q++): ?>
					<tr>
               				<td>&nbsp;</td>
               				<td></td>
               				<td></td>
               				<td></td>
               				<td></td>
               				<td></td>
               				<td></td>
               				<td></td>
               			</tr>
				<?php endfor ?>

		</table>
	</div>
</div>
<p style="page-break-before: always">