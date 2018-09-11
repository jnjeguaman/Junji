<?php
session_start();
require_once("../inc/config.php");
$filename = "reporte3_".Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

$sql = str_replace("LIMIT 50", "", $_POST["qry"]);
$res = mysql_query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>REPORTE</title>
</head>
<body>
<table border="1" width="100%" style="border-collapse: collapse;">
<tbody>
	<tr>
		<th>FOLIO</th>
		<th>DESTINO</th>
		<th>REGION EMISORA</th>
		<th>FECHA EMISION</th>
		<th>PRODUCTO</th>
		<th>CLASIFICACION</th>
		<th>CANTIDAD DESPACHADA</th>
		<th>ORDEN DE COMPRA</th>
		<th>ESTADO</th>
	</tr>
</tbody>
	<?php while($row = mysql_fetch_array($res)) { ?>
		<tr>
		<td><?php echo $row["oc_folioguia"] ?></td>
		<td><?php echo $row["oc_region"] ?></td>
		<td><?php echo $row["oc_region2"] ?></td>
		<td><?php echo $row["oc_fecha"] ?></td>
		<td><?php echo utf8_decode($row["doc_especificacion"]) ?></td>
		<td>
			<?php if ($row["ding_clasificacion"] == 1): ?>
				INVENTARIABLE
			<?php elseif($row["ding_clasificacion"] == 0): ?>
				EXISTENCIA
			<?php else: ?>
				SIN CLASIFICACION
			<?php endif ?>
		</td>
		<td><?php echo $row["doc_cantidad"] ?></td>
		<td><?php echo $row["doc_numerooc"] ?></td>
		<td><?php echo $row["doc_estado"] ?></td>
	</tr>
	<?php } ?>
</table>
</body>
</html>