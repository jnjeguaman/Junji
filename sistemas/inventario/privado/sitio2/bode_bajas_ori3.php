<div  style="width:750px; background-color:#E0F8E0; position:absolute; top:160px; left:755px;" id="div2">
	<?php
	$query6 = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id WHERE a.oc_id = ".$ocid;
	//echo $query6;
	$res6 = mysql_query($query6);
	$datos6 = mysql_fetch_array($res6);
	
	?>
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo">INGRESO NUEVO REQUERIMIENTO</td>
		</tr>
	</table>

	<hr>

	<table border="0" cellpadding="0" cellspacing="0" width="60%">
		<tr>
			<td class="Estilo1">FECHA</td>
			<td class="Estilo1"><input type="text" disabled value="<?php echo $datos6["oc_fecha"] ?>"></td>
		</tr>

		<tr>
			<td class="Estilo1">ABASTECE</td>
			<td class="Estilo1"><input type="text" disabled value="<?php echo $datos6["oc_guiaabaste"] ?>"></td>
		</tr>

		<tr>
			<td class="Estilo1">FOLIO</td>
			<td class="Estilo1"><input type="text" disabled value="<?php echo $datos6["oc_folioguia"] ?>"></td>
		</tr>

		<tr>
			<td class="Estilo1">DESTINATARIO</td>
			<td class="Estilo1"><input type="text" disabled value="<?php echo $datos6["oc_guiadestina"] ?>"></td>
		</tr>

		<tr>
			<td class="Estilo1">EMISOR</td>
			<td class="Estilo1">
				<?php echo $datos6["oc_usu"] ?><br>

			</td>
		</tr>

		<tr>
			<td class="Estilo1">OBSERVACIONES</td>
			<td><textarea disabled style="margin: 0px; width: 465px; height: 153px;"><?php echo $datos6["oc_obs"] ?></textarea></td>
		</tr>

	</table>

	<hr>
	
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo">PRODUCTOS</td>
		</tr>
	</table>

	<table border="1" width="100%">
		<tr class="Estilo1mc">
			<td class="Estilo1mc"></td>
			<td class="Estilo1mc">BIEN</td>
			<td class="Estilo1mc">OC</td>
		</tr>

		<?php
		$cont6 = 1;
		while($row6 = mysql_fetch_array($res6))
		{
			$estilo=$cont6%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}
			?>
			<tr class="<?php echo $estilo2 ?> trh">
				<td><?php echo $cont6 ?></td>
				<td><?php echo $row6["doc_especificacion"] ?></td>
				<td><?php echo $row6["doc_numerooc"] ?></td>
			</tr>
			<?php $cont6++;} ?>
		</table>
	</div>