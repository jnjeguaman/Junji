<?php
session_start();
include("inc/config.php");
extract($_GET);
if($region == 16)
{
$sql = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b ON b.ding_prod_id = a.doc_id WHERE a.doc_region = 16 OR a.doc_region = 13";
}else{
	$sql = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b ON b.ding_prod_id = a.doc_id WHERE a.doc_region = ".$region;
}
$res = mysql_query($sql,$dbh);

$filename = Date("YmdHis");
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: max-age=0");
header("content-disposition: attachment;filename=".$filename.".xls");

?>

<table border="1" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>DOC ID</td>
		<td>NOMBRE DEL PRODUCTO</td>
		<td>ORDEN DE COMPRA</td>
		<td>UNIDAD DE MEDIDA</td>
		<td>DING ID</td>
		<td>UBICACION</td>
		<td>STOCK</td>
		<td>STOCK REAL</td>
	</tr>

	<?php while($row = mysql_fetch_array($res))  { ?>
		<tr>
		<td><?php echo $row["doc_id"] ?></td>
		<td><?php echo utf8_decode($row["doc_especificacion"]) ?></td>
		<td><?php echo $row["doc_numerooc"] ?></td>
		<td><?php echo $row["doc_umedida"] ?></td>
		<td><?php echo $row["ding_id"] ?></td>
		<td><?php echo $row["ding_ubicacion"] ?></td>
		<td><?php echo $row["ding_unidad"] ?></td>
		<td></td>
		</tr>
	<?php } ?>
</table>