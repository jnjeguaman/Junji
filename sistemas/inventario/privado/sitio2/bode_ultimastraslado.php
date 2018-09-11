<?php $background = "style='background:lightgreen;'"; ?>
<div id="seccion1" style="background-color:#E0F8E0;" >
	<?php
	require_once("inc/config.php");
	$sqlc = "SELECT * FROM bode_orcom WHERE oc_tipo_guia = 6 AND oc_region2 = ".$_SESSION["region"]." AND oc_archivotc <> '' ORDER BY oc_folioguia DESC";
	$resc = mysql_query($sqlc);
	?>

	<table border=0 width="100%">
		<tr>
			<td  class="Estilo2titulo" colspan="10">GUIAS DE TRASLADO INTERNO</td>
		</tr>

		<tr>
			<td  class="Estilo1mc">ID</td>
			<td  class="Estilo1mc">N° GUIA</td>
			<td  class="Estilo1mc">F.DESPACHO</td>
			<td  class="Estilo1mc">ORIGEN</td>
			<td  class="Estilo1mc">DESTINO</td>
			<td  class="Estilo1mc">VER</td>
			<td  class="Estilo1mc">IMP</td>
			<td  class="Estilo1mc">ESTADO</td>
		</tr>

		<?php 
		while ($rowc = mysql_fetch_array($resc)) {
			$estilo=$cont%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}

			?>
			<tr class="<? echo $estilo2 ?> trh" <?php if($rowc["oc_id"] === $id){echo $background;} ?>>
				<td><? echo $rowc["oc_id"] ?></td>
				<td><? echo $rowc["oc_folioguia"] ?></td>
				<td><? echo $rowc["oc_fecha"] ?></td>
				<td><? echo $rowc["oc_region"] ?></td>
				<td><? echo $rowc["oc_guiadestina"] ?></td>
				<td><a href="bode_inv_indexoc3.php?ori=4&id=<? echo $rowc["oc_id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
				<td>
					<a href="bode_guia_despacho.php?id=<? echo $rowc["oc_id"] ?>" class="link" target="_blank"><i class="fa fa-file"></i></a></td>
					<?php if (intval($rowc["oc_estado"]) === 1): ?>
						<td><i class="fa fa-check fa-lg"></i></a></td>
					<?php else: ?>
						<td><i class="fa fa-warning fa-lg"></i></td>
					<?php endif ?>
				</td>
				<?php $cont++;} ?>
			</table>	
		</div>