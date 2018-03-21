<?php
require_once("inc/config.php");
extract($_GET);
$sql = "SELECT * FROM compra_orden WHERE oc_region=$region AND oc_fpago='' AND  oc_emitidapor='' AND oc_nombre<>'' AND year(oc_fechacompra)='$anno2' AND (oc_monto<>'0' or (oc_estado='CANCELADA/ELIMINADA/RECHAZADA' AND oc_monto='0' )) order by oc_id DESC";
$res = mysql_query($sql);
$contador = 1;

$filename = "ORDEN_COMPRA_".date("d-m-Y");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

?>

<table width="100%" style="border-collapse: collapse;" border="1">
	<tr align="center">
		<th>#</th>
		<th>ORDEN DE COMPRA</th>
		<th>NOMBRE O/C</th>
		<th>TIPO</th>
		<th>MODALIDAD</th>
		<th>MONTO</th>
		<th>MONEDA</th>
		<th>CLASIFICACIÓN</th>
		<th>FECHA O/C</th>
		<th>RUT</th>
		<th>PROVEEDOR</th>
		<th>ESTADO</th>
	</tr>
	<?php while($row = mysql_fetch_array($res)) { 
		$sql_tipo = "SELECT * FROM compra_categoria WHERE cat_id = ".$row["oc_tipo"];
		$res_tipo = mysql_query($sql_tipo);
		$row_tipo = mysql_fetch_array($res_tipo);

		$sql_modalidad = "SELECT * FROM compra_subcat WHERE subcat_id = ".$row["oc_modalidad"];
		$res_modalidad = mysql_query($sql_modalidad);
		$row_modalidad = mysql_fetch_array($res_modalidad);
	?>
		<tr align="center">
			<td><?php echo $contador ?></td>
			<td><?php echo $row["oc_numero"] ?></td>
			<td><?php echo $row["oc_nombre"] ?></td>
			<td><?php echo $row_tipo["cat_nombre"] ?></td>
			<td><?php echo $row_modalidad["subcat_nombre"] ?></td>
			<td>$<?php echo number_format($row["oc_monto"],0,".",".") ?></td>
			<td><?php echo $row["oc_moneda"] ?></td>
			<td><?php echo $row["oc_tipo2"] ?></td>
			<td><?php echo date("d-m-Y",strtotime($row["oc_fechacompra"])) ?></td>
			<td><?php echo $row["oc_rut"]."-".$row["oc_dig"] ?></td>
			<td><?php echo $row["oc_rsocial"] ?></td>
			<td><?php echo $row["oc_estado"] ?></td>
		</tr>
	<?php $contador++;} ?>
</table>