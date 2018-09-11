<?php
require_once("inc/config.php");
extract($_GET);

$sql = "SELECT * FROM bode_solicitud_rel a INNER JOIN bode_detingreso b ON a.sp_rel_ding_id = b.ding_id INNER JOIN bode_detoc c ON b.ding_prod_id = c.doc_id WHERE a.sp_rel_doc_id = ".$id." AND a.sp_rel_sp_id = ".$sp_id;
$res = mysql_query($sql);
echo $sql;
?>
<table border="1" width="100%">
	<tr>
		<td colspan="3">Historial</td>
	</tr>

	<tr>
		<td>PRODUCTO</td>
		<td>CANTIDAD</td>
		<td>VALOR UNITARIO</td>
	</tr>

	<?php while($row = mysql_fetch_array($res)) { ?>
<tr>
	<td><?php echo $row["doc_especificacion"] ?></td>
	<td><?php echo $row["sp_rel_despachado"] ?></td>
	<td><?php echo $row["doc_conversion"] ?></td>
</tr>
	<?php } ?>
</table>