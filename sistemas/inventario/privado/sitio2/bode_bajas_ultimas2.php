<?php
$cont4=1;
$query5 = "SELECT * FROM bode_orcom WHERE oc_tipo_guia = 4 AND oc_estado = 4";
//echo $query5;
$res5 = mysql_query($query5);
?>
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo">GUIAS EN TRANSITO</td>
		</tr>
	</table>

	<table border="1" width="100%">
		<tr class="Estilo1mc">
			<td></td>
			<td>ID</td>
			<td>FOLIO</td>
			<td>EMISOR</td>
			<td>VER</td>
			<td>IMPRIMIR</td>
		</tr>

		<?php while($row5 = mysql_fetch_array($res5)) {
			$estilo=$cont4%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}
			?>
			<tr class="<?php echo $estilo2 ?> trh">
				<td><?php echo $cont4 ?></td>
				<td><?php echo $row5["oc_id"] ?></td>
				<td><?php echo $row5["oc_folioguia"] ?></td>
				<td><?php echo $row5["oc_usu"] ?></td>
				<td><a href="bode_inv_indexoc4.php?cmd=Bajas&ori=3&ocid=<?php echo $row5["oc_id"] ?>"><i class="fa fa-eye fa-lg link"></i></a></td>
				<td>
				<a href="bode_bajas_imprimir.php?bid=<?php echo $row5["oc_id"] ?>" target="_blank"><i class="fa fa-print fa-lg link"></i>
				<a href="bode_bajas_imprimira.php?bid=<?php echo $row5["oc_id"] ?>" target="_blank"><i class="fa fa-file fa-lg link"></i></a></td>
			</tr>
			<?php $cont4++;} ?>
		</table>