<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo">PRODUCTOS YA INGRESADOS</td>
	</tr>
</table>

<form name="frm4" id="frm4" action="bode_bajas_gr2.php" method="POST" onsubmit="return validaUpload()">
	<table border="1" width="100%">
		<tr class="Estilo1mc">
			<td class="Estilo1mc"></td>
			<td class="Estilo1mc">BIEN</td>
			<td class="Estilo1mc">OC</td>
			<td class="Estilo1mc">ACCION</td>
		</tr>

		<?php 
		$query3 = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id INNER JOIN bode_detingreso c ON b.doc_origen_id = c.ding_prod_id WHERE c.ding_recep_tecnica = 'A' AND a.oc_id = ".$ocid;
		//echo $query3;
		$res3 = mysql_query($query3);
		$cont3 = 1;
		while($row3 = mysql_fetch_array($res3)) {
			$estilo=$cont3%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}
			?>
			<tr class="<?php echo $estilo2 ?> trh">
				<td><?php echo $cont3 ?></td>
				<td><?php echo $row3["doc_especificacion"] ?></td>
				<td><?php echo $row3["doc_numerooc"] ?></td>
				<td><a href="bode_bajas_br.php?pid=<?php echo $row3["doc_id"]?>&ocid=<?php echo $ocid ?>" class="link" onClick="return confirm('¿ DESEA ELIMINAR ESTE ITEM DE LA LISTA ?')"><i class="fa fa-remove fa-lg"></i></a></td>
			</tr>
			<?php $cont3++;} ?>
			<input type="hidden" name="ocid" value="<?php echo $ocid ?>">
			<?php if ($cont3 > 1): ?>

				<tr>
					<td class="Estilo1">ABASTECE</td>
					<td class="Estilo1" colspan="3"><input type="text" name="abastece" id="abastece"></td>
				</tr>

				<tr>
					<td class="Estilo1">FOLIO</td>
					<td class="Estilo1" colspan="3"><input type="text" name="folio" id="folio" value="<?php echo $ultimo ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
				</tr>

				<tr>
					<td class="Estilo1">DESTINATARIO</td>
					<td class="Estilo1" colspan="3"><input type="text" name="destinatario" id="destinatario"></td>
				</tr>

				<tr>
					<td class="Estilo1">EMISOR</td>
					<td class="Estilo1" colspan="3">
						<?php echo $_SESSION["nombrecom"] ?><br>
						<input type="hidden" name="emisor" value="<?php echo $_SESSION["nombrecom"] ?>">
						<input type="hidden" name="usuario" value="<?php echo $_SESSION["nom_user"] ?>">
						<input type="hidden" name="region" value="<?php echo $_SESSION["region"] ?>">
					</td>
				</tr>

				<tr>
					<td class="Estilo1">OBSERVACIONES</td>
					<td class="Estilo1" colspan="3"><textarea name="obs" id="obs" style="margin: 0px; width: 465px; height: 153px;"></textarea></td>
				</tr>

				<tr>
					<td></td>	
					<td colspan="3"><button type="submit" ><i class="fa fa-cloud-upload fa-lg"></i></button>
					</td>
				</tr>
			<?php endif ?>
		</table>
	</form>		