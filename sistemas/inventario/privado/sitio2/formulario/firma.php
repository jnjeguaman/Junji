<?php
require_once("../inc/config.php");
session_start();
$sql = "SELECT * FROM acti_region WHERE region_id = ".$_SESSION["region"];
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
?>
<div class="wrapper">
<div class="lista">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">

		<tr>
			<td height="10px"><?php echo $row["region_envinv"] ?></td>
			<td></td>
			<td></td>
			<td><?php echo $responsable ?></td>
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