<hr>

	<form action="devengo.php" method="POST">
	<table border="1" width="100%">
		<tr>
			<td class="Estilo1mc"><input type="checkbox" name="toggle" id="toggle"></td>
			<td class="Estilo1mc">Seleccionar todo2</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td class="Estilo1mc"></td>
			<td class="Estilo1mc">ORDEN DE COMPRA</td>
			<td class="Estilo1mc">RECEPCION CONFORME</td>
			<td class="Estilo1mc">DETALLE</td>
		</tr>
			<?php
			$cont=1;
			while($row2 = mysql_fetch_array($res2)) { 
				$oc = $row2["oc_id2"];
				$oc_id = $row2["oc_id"];
				$estilo=$cont%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}
			?>
			<tr <?php echo $estilo ?> class="<?php echo $estilo2 ?> trh">
			<td><input type="checkbox" name="var1[<?php echo $cont?>]" value="<?php echo $cont ?>"></td>
			<td><?php echo $row2["oc_numero"] ?></td>
			<td><?php echo $row2["rc_numero"] ?></td>
			<td><a href="devengo.php?ori=4&oc_id=<?php echo $row2["id"]?>&ing_id=<?php echo $row2["ing_id"]?>&rc=<?php echo $row2["rc_numero"]?>&oc1=<?php echo $oc1 ?>&oc2=<?php echo $oc2 ?>&oc3=<?php echo $oc3 ?>">VER</a></td>
			</tr>
			<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $row2["ing_guianumerorc"] ?>">
			<?php $cont++;} ?>
			<input type="hidden" name="oc1" value="<?php echo $oc1 ?>">
			<input type="hidden" name="oc2" value="<?php echo $oc2 ?>">
			<input type="hidden" name="oc3" value="<?php echo $oc3 ?>">
			<input type="hidden" name="oc" value="<?php echo $oc ?>">
			<input type="hidden" name="oc_id" value="<?php echo $oc_id ?>">
			<input type="hidden" name="ori" value="3">
			<input type="hidden" name="totalLineas" value="<?php echo $cont-1 ?>">
			<tr>
				<td class="Estilo1mc"><button type="submit"><i class="fa fa-plus"></i></button></td>
				<td colspan="3"></td>
			</tr>
	</table>	
</form>
