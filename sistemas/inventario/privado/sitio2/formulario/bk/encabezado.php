<?php 
$sql = "SELECT * FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_zona = '".$zona."' AND inv_direccion = '".$responsa."' AND inv_region = ".$_SESSION["region"]." LIMIT $limit,$total";
echo $sql;
$sql = mysql_query($sql);



 ?>
<div class="wrapper">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">

		<tr>
			<td><img src="../junji_logo.png"></td>
			<td><strong>PLANILLA MURAL DE INVENTARIO<br>OFICINA DE INVENTARIO</strong></td>
		</tr>
	</table>

	<br><br><br>
	<table border="1" width="65%" cellpadding="0" cellspacing="0" align="left">
		<tr>
			<td>DEPENDENCIA</td>
			<td><?php echo $responsa ?></td>
		</tr>

		<tr>
			<td>ZONA</td>
			<td><?php echo $zona ?></td>
		</tr>

		<tr>
			<td>DEPTO./SECCION/OFICINA</td>
			<td><?php echo $depto ?></td>
		</tr>

		<tr>
			<td>JEFE: DEPTO./SECCION/OFICINA</td>
			<td><?php echo $jefatura ?></td>
		</tr>

		<tr>
			<td>RESPONSABLE</td>
			<td><?php echo $busca_responsable ?></td>
		</tr>
	</table>

	<table border="1" width="20%" cellpadding="0" cellspacing="0" align="right">
		<tr>
			<td>HOJA</td>
			<td>DE</td>
		</tr>

		<tr>
			<td><?php echo $contador ?></td>
			<td><?php echo $totalPages ?></td>
		</tr>

	</table>

	<div class="fecha">

		<table border="1" width="20%" cellpadding="0" cellspacing="0" align="right">

			<tr>
				<td>FECHA EMISION</td>
			</tr>

			<tr>
				<td><?php echo Date("d-m-Y") ?></td>
			</tr>

		</table>
	</div>

	</div>