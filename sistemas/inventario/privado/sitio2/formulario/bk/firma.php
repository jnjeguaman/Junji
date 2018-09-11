<?php
session_start();
$region = intval($_SESSION["region"]);

$encargado = array(
	1 => "NILA JIMENEZ",
	2 => "",
	3 => "JORGE CORTES",
	4 => "DANIELA ZEPEDA",
	5 => "",
	6 => "",
	7 => "MONICA AVENDAÑO",
	8 => "",
	9 => "",
	10 => "JARITZA SOTO",
	11 => "GERSON SANCHEZ",
	12 => "ESTRELLA CARDENAS",
	13 => "PAOLA MENESES",
	14 => "MAURICIO SOLIS",
	15 => "LORY ESCUDERO",
	16 => "PAOLA CASTAÑEDA");
?>
<div class="wrapper">
<div class="lista">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">

		<tr>
			<td height="10px"><?php echo $encargado[$region] ?></td>
			<td></td>
			<td></td>
			<td><?php echo $busca_responsable ?></td>
		</tr>

		<tr>
			<td>_________________________________________</td>
			<td></td>
			<td></td>
			<td>_________________________________________</td>
		</tr>

		<tr>
			<td>ENCARGADO/A DE INVENTARIO</td>
			<td></td>
			<td></td>
			<td>RESPONSABLE</td>
		</tr>
	</table>

	<br><br><br><br><br><br>

	<table border="0" width="50%" cellpadding="0" cellspacing="0" align="right">
		<tr>
			<td><?php echo $jefatura ?></td>
		</tr>

		<tr>
			<td>_________________________________________</td>
		</tr>

		<tr>
			<td>JEFATURA/DEPTO/SECCION/OFICINA</td>
		</tr>

	</table>
</div>
</div>