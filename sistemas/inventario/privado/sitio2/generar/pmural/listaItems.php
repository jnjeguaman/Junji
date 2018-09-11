<?php
$start = $i *  $limit;
// $sql = "SELECT * FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_zona = '".$zona."' AND inv_direccion = '".$responsa."' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 LIMIT ".$start.",".$limit;
$sql = "SELECT * FROM acti_inventario WHERE inv_estado2 = 1 AND inv_visible = 1 $busca_responsable LIMIT ".$start.",".$limit;
$sql = mysql_query($sql);
$cont = 1;
$em = "0.6";
?>
<div class="wrapper">
	<div class="lista">
		<table width="100%" align="center" style="border-collapse: collapse;" border="1">
			<tr>
				<td style="font-size: <?php echo $em?>em;">N°</td>
				<td style="font-size: <?php echo $em?>em;">CODIGO</td>
				<td style="font-size: <?php echo $em?>em;">BIEN</td>
				<td style="font-size: <?php echo $em?>em;">ESTADO</td>
				<td style="font-size: <?php echo $em?>em;">CALIDAD ADMINISTRATIVA</td>
				<td style="font-size: <?php echo $em?>em;">VALOR UNITARIO</td>
				<td style="font-size: <?php echo $em?>em;">OBSERVACIONES</td>
			</tr>
			
			<?php
			while($row = mysql_fetch_array($sql)) {
				$arrecodigo[$i2]= $row["inv_codigo"];
				?>
				<tr>
					<td style="font-size: <?php echo $em?>em;"><?php echo $cont ?></td>
					<td style="font-size: <?php echo $em?>em;"><?php echo $row["inv_codigo"] ?></td>
					<td style="font-size: <?php echo $em?>em;"><?php echo $row["inv_bien"] ?></td>
					<td style="font-size: <?php echo $em?>em;"><?php echo $row["inv_estadocosto"] ?></td>
					<td style="font-size: <?php echo $em?>em;"><?php echo $row["inv_calidad"] ?></td>
					<td style="font-size: <?php echo $em?>em;">$<?php echo number_format($row["inv_costo"],0,".",".") ?></td>
					<td style="font-size: <?php echo $em?>em;"><?php echo $row["inv_obs"] ?></td>
				</tr>
				<?php $cont++; $i2++; } ?>


				<?php  $restante = ($limit+1) - $cont; ?>

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
