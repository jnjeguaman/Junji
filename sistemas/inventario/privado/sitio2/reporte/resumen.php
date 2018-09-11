<div class="resumenGuias">
	<table>
		<tr>
			<td colspan="2" align="center"><strong>LISTADO DE GUIAS</strong></td>
		</tr>
	</table>

	<table id="resumenGuias" cellpadding="0" cellspacing="0" style="border: 1px solid black">
		<tr bgcolor="#4CAF50">
			<td align="center" style="border: 1px solid #000;"><b>N&deg;</b></td>
			<td align="center" style="border: 1px solid #000;"><b>N&deg; GUIA</b></td>
			<td align="center" style="border: 1px solid #000;"><b>DESTINO</b></td>
			<td align="center" style="border: 1px solid #000;"><b>NOMBRE JARDIN</b></td>
			<td align="center" style="border: 1px solid #000;"><b>DIRECCION</b></td>
		</tr>
		<?php for ($j=0;$j<$limite;$j++): ?>
			<?php

			include_once("../inc/config.php");
			if($j % 2 == 0)
			{
				$class = "fondo1";
			}else{
				$class = "fondo2";
			}

			// VERIFICAMOS EL TIPO DE GUIA REALIZADA
			$tipo = $newArray[$i][$j]["oc_tipo_guia"];

			if($tipo == 1)
			{
				$query = "SELECT * FROM acti_region WHERE region_id = ".$newArray[$i][$j]["oc_guiadestina"];
				$rs = mysql_query($query);
				$row = mysql_fetch_array($rs);
				$nombre = "BODEGA ".$row["region_glosa"];
				$direccion = $row["region_dir_bodega"];
			}else if($tipo == 2)
			{
				$query = "SELECT * FROM bode_orcom WHERE oc_folioguia = ".$newArray[$i][$j]["oc_folioguia"];
				$rs = mysql_query($query);
				$row = mysql_fetch_array($rs);
				$nombre = $row["oc_region"];
				$direccion = $row["oc_region"];
			}else if($tipo == 3)
			{
				$query = "SELECT * FROM jardines WHERE jardin_codigo = ".$newArray[$i][$j]["oc_guiadestina"];
				$rs = mysql_query($query);
				$row = mysql_fetch_array($rs);
				$nombre = $row["jardin_nombre"];
				$direccion = $row["jardin_direccion"];
			}

			
			?>
			<?php if ($newArray[$i][$j]["oc_folioguia"] <> ""): ?>
				<tr class="<?php echo $class ?>">
					<td align="center" style="border: 1px solid #000;font-size: 0.8em;"><?php echo $contador ?></td>
					<td align="center" style="border: 1px solid #000;font-size: 0.8em;"><?php echo $newArray[$i][$j]["oc_folioguia"] ?></td>
					<td align="center" style="border: 1px solid #000;font-size: 0.8em;"><?php echo $newArray[$i][$j]["oc_guiadestina"] ?></td>
					<td align="center" style="border: 1px solid #000;font-size: 0.8em;"><?php echo $nombre ?></td>
					<td align="center" style="border: 1px solid #000;font-size: 0.8em;"><?php echo $direccion ?></td>
				</tr>
				<?php $contador++; ?>

			<?php endif ?>
		<?php endfor ?>
	</table>
</div>
