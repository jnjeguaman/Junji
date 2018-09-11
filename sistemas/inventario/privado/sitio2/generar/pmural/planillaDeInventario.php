<?php
$em = "0.6";
?>
<div class="wrapper">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">

		<tr>
			<td><img src="../junji_logo.png"></td>
			<td><strong>PLANILLA MURAL DE INVENTARIO<br>OFICINA DE INVENTARIO</strong></td>
		</tr>
	</table>

	<br><br><br>
	<table border="1" width="65%" align="left" style="border-collapse: collapse;">
		<tr>
			<td style="font-size: <?php echo $em?>em;">DEPENDENCIA</td>
			<td style="font-size: <?php echo $em?>em;"><?php echo $direccion ?></td>
		</tr>

		<tr>
			<td style="font-size: <?php echo $em?>em;">ZONA</td>
			<td style="font-size: <?php echo $em?>em;"><?php echo $zona ?></td>
		</tr>

		<tr>
			<td style="font-size: <?php echo $em?>em;">DEPTO./SECCION/OFICINA</td>
			<td style="font-size: <?php echo $em?>em;"><?php echo $depto ?></td>
		</tr>

		<tr>
			<td style="font-size: <?php echo $em?>em;">JEFE: DEPTO./SECCION/OFICINA</td>
			<td style="font-size: <?php echo $em?>em;"><?php echo $jefatura ?></td>
		</tr>

		<tr>
			<td style="font-size: <?php echo $em?>em;">RESPONSABLE</td>
			<td style="font-size: <?php echo $em?>em;"><?php echo $responsable ?></td>
		</tr>
	</table>

	<table border="1" width="20%" align="right" style="border-collapse: collapse;">
		<tr>
			<td style="font-size: <?php echo $em?>em;">HOJA</td>
			<td style="font-size: <?php echo $em?>em;">DE</td>
		</tr>

		<tr>
			<td style="font-size: <?php echo $em?>em;"><?php echo $contador ?></td>
			<td style="font-size: <?php echo $em?>em;"><?php echo $numeroDePaginas+1 ?></td>
		</tr>

	</table>

	<div class="fecha">

		<table border="1" width="20%" align="right" style="border-collapse: collapse;">

			<tr>
				<td style="font-size: <?php echo $em?>em;">FECHA EMISION</td>
			</tr>

			<tr>
				<td style="font-size: <?php echo $em?>em;"><?php echo Date("d-m-Y") ?></td>
			</tr>

		</table>
	</div>

	</div>