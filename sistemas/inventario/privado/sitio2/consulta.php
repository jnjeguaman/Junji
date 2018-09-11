<table border="1" width="100%">
<tr>
	<td>#</td>
	<td>ID</td>
	<td>ORDEN DE COMPRA</td>
	<td>PRODUCTO</td>
	<td>CANTIDAD O/C</td>
	<td>CANTIDAD RECIBIDOS</td>
	<td>CANTIDAD RECIBIDOS (UNIDADES)</td>
	<td>UNIDAD DE MEDIDA</td>
	<td>FACTOR</td>
	<td>CANTIDAD DESPACHADOS</td>
	<td>UBICACION</td>
	<td>SALDO / STOCK (UNIDADES)</td>
</tr>
<?php
$filename = "Reporte_".Date("Y-m-d H_i_s");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

$contador = 1;
require_once("inc/config.php");
// LISTADO DE PRODUCTOS
$sql = "SELECT * from bode_detoc a inner join bode_detingreso b on b.ding_prod_id = a.doc_id inner join bode_orcom c on c.oc_id = a.doc_oc_id where c.oc_estado = 1 and c.oc_tipo = 0 and (c.oc_region = 16 or c.oc_region = 13) and (a.doc_region = 16 or a.doc_region = 13) AND b.ding_recep_conforme = 'C' AND b.ding_recep_tecnica = 'A' order by c.oc_id2 desc";
$res = mysql_query($sql);

while($row = mysql_fetch_array($res))
{


	$sql3 = "select SUM(doc_cantidad) as doc_cantidad,doc_estado from bode_detoc where doc_origen_id = ".$row["ding_id"]." and doc_estado <> 'ELIMINADO'";
	$res3 = mysql_query($sql3);
	$row3 = mysql_fetch_array($res3);
?>
<tr>
	<td><?php echo $contador ?></td>
	<td><?php echo $row["ding_id"] ?></td>
	<td><?php echo $row["oc_id2"] ?></td>
	<td><?php echo utf8_decode($row["doc_especificacion"]) ?></td>
	<td><?php echo $row["doc_cantidad"] ?></td>
	<td><?php echo $row["ding_cantidad"] ?></td>
	<td><?php echo $row["ding_cantidad"] * $row["doc_factor"] ?></td>
	<td><?php echo $row["doc_umedida"] ?></td>
	<td><?php echo $row["doc_factor"] ?></td>
	<td><?php echo ($row3["doc_cantidad"] <> "") ? $row3["doc_cantidad"] : 0 ?></td>
	<td><?php echo $row["ding_ubicacion"] ?></td>
	<td><?php echo $row["ding_unidad"] - $row3["Despachados"] ?></td>
</tr>
<?php $contador++;} ?>
</table>