<div class="wrapper">
	<div class="lista">
		<table border="1" width="100%" cellpadding="0" cellspacing="0" align="center">
			<thead>
				<th colspan="10">RESUMEN DE CODIGOS</th>
			</thead>
			<tbody>
				<?
				$j2=0;
				$cont2=1;
				while ($j2<=$i2) {
					if ($cont2==10 or $j2==0) {
						echo "<tr>";
						$cont2=0;
					}

					?>
					<td><? echo $arrecodigo[$j2]; ?></td>
					<?
					$j2++;
					$cont2++;
				}
				?>
			</tbody>
		</table>
		<br>
		<!-- <p style="page-break-before: always"> -->
			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="20">NOMBRE:</td>
					<td width="20"></td>
					<td width="20" rowspan="2">CONTROL 1</td>
				</tr>
				<tr>
					<td>FECHA</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3" align="left">
						<textarea style="margin: 0px; width: 876px; height: 181px;">OBS:</textarea>
					</td>
				</tr>
			</table>

			<table border="1" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="20">NOMBRE:</td>
					<td width="20"></td>
					<td width="20" rowspan="2">CONTROL 2</td>
				</tr>
				<tr>
					<td>FECHA</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="3" align="left">
						<textarea style="margin: 0px; width: 876px; height: 181px;">OBS:</textarea>
					</td>
				</tr>
			</table>
		</div>
	</div>
