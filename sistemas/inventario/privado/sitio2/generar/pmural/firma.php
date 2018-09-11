<?php
require_once("../inc/config.php");
session_start();
$sql = "SELECT * FROM acti_region WHERE region_id = ".$_SESSION["region"];
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$em = "0.9";
?>
<div class="wrapper">
<div class="lista2">
	<table border="0" width="100%" style="border-collapse: collapse;">
		<tr>
			<td height="10px" style="font-size: <?php echo $em?>em;"><?php echo $row["region_envinv"] ?></td>
			<td></td>
			<td></td>
			<td style="font-size: <?php echo $em?>em;"><?php echo $responsable ?></td>
		</tr>

		<tr>
			<td>_________________________________________</td>
			<td></td>
			<td></td>
			<td>_________________________________________</td>
		</tr>

		<tr>
			<td style="font-size: <?php echo $em?>em;">ENCARGADO/A DE INVENTARIO</td>
			<td></td>
			<td></td>
			<td style="font-size: <?php echo $em?>em;">RESPONSABLE</td>
		</tr>
	</table>

	<br><br><br>

	<table border="0" width="50%" align="right" style="border-collapse: collapse;">
		<tr>
			<td style="font-size: <?php echo $em?>em;"><?php echo $jefatura ?></td>
		</tr>

		<tr>
			<td>_________________________________________</td>
		</tr>

		<tr>
			<td style="font-size: <?php echo $em?>em;">JEFATURA/DEPTO/SECCION/OFICINA</td>
		</tr>

	</table>
</div>
</div>