<?php
$limite = 10;

?>
<div class="wrapper">
	<div class="lista">
		<table border="1" width="100%" align="center" style="border-collapse: collapse;">
			<tr>
				<td colspan="<?php echo $limite ?>" style="font-size: <?php echo $em ?>em;">RESUMEN DE CODIGOS</td>
			</tr>
			<tbody>
				<?
				$nuevoArray = array_chunk($arrecodigo, $limite);
				$totalFragmentos = count($nuevoArray);

				for($i=0;$i<$totalFragmentos;$i++)
				{
					$totalCodigos = count($nuevoArray[$i]);
					echo "<tr>";
					for($x=0;$x<$totalCodigos;$x++)
					{
						$resto = $limite - $totalCodigos;
						echo "<td style='font-size: ".$em."em;'>".$nuevoArray[$i][$x]."</td>";
					}
					if($resto > 0)
					{
						for($z=0;$z<$resto;$z++)
						{
							echo "<td></td>";
						}
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		</div>
		</div>
		<?php $em = "0.8"; ?>
		<br><br>
		<!-- <p style="page-break-before: always"> -->
		<table border="1" width="100%" style="border-collapse: collapse;">
			<tr>
				<td style="font-size: <?php echo $em?>em;">NOMBRE:</td>
				<td style="font-size: <?php echo $em?>em;" width="40%"></td>
				<td rowspan="2" style="font-size: <?php echo $em?>em;">CONTROL 1</td>
			</tr>
			<tr>
				<td style="font-size: <?php echo $em?>em;">FECHA</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" align="left" height="60px">
					<textarea style="margin: 0px; height: 181px;font-size: <?php echo $em?>em;">OBS:</textarea>
				</td>
			</tr>
		</table>
		<br><br>
		<table border="1" width="100%" style="border-collapse: collapse;">
			<tr>
				<td style="font-size: <?php echo $em?>em;">NOMBRE:</td>
				<td style="font-size: <?php echo $em?>em;" width="40%"></td>
				<td rowspan="2" style="font-size: <?php echo $em?>em;">CONTROL 2</td>
			</tr>
			<tr>
				<td style="font-size: <?php echo $em?>em;">FECHA</td>
				<td></td>
			</tr>
			<tr>
				<td colspan="3" align="left" height="60px">
					<textarea style="margin: 0px; height: 181px;font-size: <?php echo $em?>em;">OBS:</textarea>
				</td>
			</tr>
		</table>
	</div>
</div>
