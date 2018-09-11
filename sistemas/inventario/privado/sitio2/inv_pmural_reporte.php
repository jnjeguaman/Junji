<?php
require_once("inc/config.php");

$filename = "pmural".Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

extract($_POST);
$consulta = trim(str_replace("LIMIT 400","",$qry));

$res = mysql_query($consulta);
?>

<table border="1" width="100%" align="center">
	<tr>
		<td>CODIGO</td>
		<td>BIEN</td>
		<td>COSTO ADQUISICION</td>
		<td>DIRECCION</td>
		<td>ZONA</td>
		<td>RESPONSABLE</td>
	</tr>

	<?php while($row = mysql_fetch_array($res))  { ?>
		<tr>
		<td><?php echo $row["inv_codigo"] ?></td>
		<td><?php echo utf8_encode($row["inv_bien"]) ?></td>
		<td>$<?php echo number_format($row["inv_costo"],0,".",".") ?></td>
		<td><?php echo $row["inv_direccion"] ?></td>
		<td><?php echo $row["inv_zona"] ?></td>
		<td><?php echo utf8_encode($row["inv_responsable"]) ?></td>
		</tr>
	<?php } ?>	
</table>