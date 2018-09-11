<?php
$filename = "tomaInventario_".Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

extract($_POST);
require("inc/config.php");
$consulta = mysql_query($qry);
$cont=1;
?>
<!DOCTYPE html>
<html>
<head>
	<title>EXCEL</title>
</head>
<body>

	<table border="1" width="100%" cellpadding="0" cellspacing="0">

		<tr>
			<td class="Estilo2">N° </td>
			<td class="Estilo2">INPUT</td>
			<td class="Estilo2">DESCRIPCION </td>
			<?php if ($forma != "Oculto"): ?>
				<td class="Estilo2">PRECIO</td>
				<td class="Estilo2">STOCK</td>
			<?php endif ?>
			<td class="Estilo2">TOMA</td>
			<td class="Estilo2">DIF.</td>
			<td class="Estilo2">UBI.</td>
		</tr>

		<tbody>
			<?php while($row = mysql_fetch_array($consulta)) { ?>
			<tr>
				<td><? echo  $cont  ?> </td>
				<td><? echo  $row['doci_toma']?></td>
				<td><? echo  $row['doci_especificacion']  ?> </td>
				<?php if ($forma != "Oculto"): ?>
					<td><? echo  $row['doci_valor_unit']  ?> </td>
					<td><? echo  $row['doci_stock']  ?> </td>
				<?php endif ?>
				<td><? echo  $row['doci_toma']  ?> </td>
				<td><? echo  $row['doci_diferencia']  ?> </td>
				<td><? echo  $row['doci_ubi']  ?> </td>
			</tr>
			<?php $cont++;} ?>
		</tbody>
	</table>

</body>
</html>