<?php
$filename = "reporte".Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

extract($_POST);
require("../inc/config.php");
$consulta = mysql_query($qry);
?>
<!DOCTYPE html>
<html>
<head>
	<title>EXCEL</title>
</head>
<body>

	<table border="1" width="100%" cellpadding="0" cellspacing="0">

	<tr>
		<td colspan="6"><center><font color="red"><strong><?php echo utf8_decode($art) ?></strong></font></center></td>
	</tr>
	 <!-- bgcolor="#00b8ff" -->
		<tr>
			<th style="background-color: #0ba6d1 ">N&deg; G/D</th>
			<th style="background-color: #0ba6d1 ">FECHA EMISION</th>
			<th style="background-color: #0ba6d1 ">EMISOR</th>
			<th style="background-color: #0ba6d1 ">DESTINO</th>
			<th style="background-color: #0ba6d1 ">ABASTECE</th>
			<th style="background-color: #0ba6d1 ">CANTIDAD DESPACHADA</th>
			<th style="background-color: #0ba6d1 ">PRODUCTO</th>
		</tr>

		<tbody>
			<?php while($row = mysql_fetch_array($consulta)) { ?>
			<tr>
				<td style="background-color: #98DDDE"><?php echo $row["oc_folioguia"] ?></td>
				<td style="background-color: #98DDDE"><?php echo $row["oc_fecha"] ?></td>
				<td style="background-color: #98DDDE"><?php echo $row["oc_usu"] ?></td>
				<td style="background-color: #98DDDE"><?php echo $row["oc_guiadestina"] ?></td>
				<td style="background-color: #98DDDE"><?php echo $row["oc_guiaabaste"] ?></td>
				<td style="background-color: #98DDDE"><?php echo $row["doc_cantidad"] ?></td>
				<td style="background-color: #98DDDE"><?php echo utf8_decode($row["doc_especificacion"]) ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>