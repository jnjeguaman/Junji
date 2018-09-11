<?php
$start = $i *  $limit;
// $sql = "SELECT * FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_zona = '".$zona."' AND inv_direccion = '".$responsa."' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 LIMIT ".$start.",".$limit;
$sql = "SELECT * FROM acti_inventario WHERE inv_estado2 = 1 $busca_responsable LIMIT ".$start.",".$limit;
$sql = mysql_query($sql);
$cont = 1;
?>
<div class="wrapper">
	<div class="lista">
		<table border="1" width="100%" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<th>N°</th>
				<th>CODIGO</th>
				<th>BIEN</th>
				<th>ESTADO</th>
				<th>CALIDAD ADMINISTRATIVA</th>
				<th>VALOR UNITARIO</th>
				<th>OBSERVACIONES</th>
			</tr>
			
			<?php
			while($row = mysql_fetch_array($sql)) {
				$arrecodigo[$i2]= $row["inv_codigo"];
				?>
				<tr>
					<td><?php echo $cont ?></td>
					<td><?php echo $row["inv_codigo"] ?></td>
					<td><?php echo $row["inv_bien"] ?></td>
					<td><?php echo $row["inv_estadocosto"] ?></td>
					<td><?php echo $row["inv_calidad"] ?></td>
					<td>$<?php echo number_format($row["inv_costo"],0,".",".") ?></td>
					<td><?php echo $row["inv_obs"] ?></td>
				</tr>
				<?php $cont++; $i2++; } ?>


				<?php  $restante = 41 - $cont; ?>

				<?php for ($q=0; $q < $restante; $q++): ?>
					<tr>
						<td>&nbsp;</td>
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
