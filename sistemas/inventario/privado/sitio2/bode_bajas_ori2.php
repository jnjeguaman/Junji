<?php
require_once("inc/config.php");
extract($_POST);
extract($_GET);

$ubicacion = "SELECT * FROM bode_ubicacion WHERE ubi_estado = 1";
$resUbi = mysql_query($ubicacion);
while($rowUbi = mysql_fetch_array($resUbi))
{
	$ubi[] = $rowUbi["ubi_glosa"];
}

?>
<div  style="width:750px; background-color:#E0F8E0; position:absolute; top:160px; left:755px;" id="div2">
	<!-- FORMULARIO DE BUSQUEDA !-->
	<table border="0" width="100%">
	<tr>
		<td class="Estilo2titulo">BUSQUEDA DE PRODUCTOS</td>
	</tr>
</table>
	<form name="frm2" id="frm2" action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
		<table border="0" width="50%">
			<tr class="Estilo1">
				<td>ORDEN DE COMPRA</td>
				<td><input type="text" name="oc" id="oc" value="<?php echo $oc; ?>"></td>
			</tr>

			<tr class="Estilo1">
				<td <?php echo $class ?>>BIEN</td>
				<td><input type="text" name="bien" id="bien" value="<?php echo $bien; ?>"></td>
			</tr>

			<tr class="Estilo1">
				<td <?php echo $class ?>>UBICACION</td>
				<td>
					<?php if ($_SESSION["region"] == 16 OR $_SESSION["region"] == 13): ?>
						<select class="Estilo1" name="rack" id="rack">
						<option value="">Seleccionar...</option>
						<?php foreach ($ubi as $key => $value): ?>
							<option value="<?php echo $value ?>" <?php if($rack == $value){ echo "selected";} ?>><?php echo $value ?></option>
						<?php endforeach ?>
					</select>
				<?php else: ?>
					<input type="text" name="rack" id="rack">
					<?php endif ?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit"><i class="fa fa-search"></i></button></td>
			</tr>
		</table>
	</form>
	<!-- FIN BUSQUEDA DE PRODUCTOS !-->

	<?php

	if($_SESSION["region"] == 16)
	{
		$wherer = "(b.doc_region = 16 or b.doc_region = 13) AND ";
	}else{
		$wherer = "b.doc_region = ".$_SESSION["region"]." AND ";
	}

	if($oc <> '')
	{
		$where = "a.oc_id2 LIKE '%".$oc."%' AND ";
	}

	if($bien <> '')
	{
		$where2 = "b.doc_especificacion LIKE '%".$bien."%' AND ";
	}

	if($rack <> '')
	{
		$where3 = "c.ding_ubicacion LIKE '%".$rack."%' AND ";
	}
	$query2 = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id INNER JOIN bode_detingreso c ON c.ding_prod_id = b.doc_id WHERE $wherer $where $where2 $where3 (a.oc_tipo = 0 OR a.oc_tipo = 1) AND c.ding_recep_tecnica = 'A' AND b.doc_estado <> 'B' AND c.ding_unidad <> 0 AND a.oc_estado = 1 LIMIT 20";
	//echo $query2;
	$res2 = mysql_query($query2);
	$totalRegistros = mysql_num_rows($res2);
	?>

	<hr>
	<!-- RESULTADO !-->
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo">RESULTADO</td>
		</tr>
	</table>

		<form name="frm3" id="frm3" action="bode_bajas_gr3.php" method="POST" onSubmit="return valOri2()">
			<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center">
				<tr class="Estilo1mc">
					<td></td>
					<td colspan="5" align="left"><input type="checkbox" name="toggle" id="toggle">Seleccionar Todo</td>
				</tr>
				<tr class="Estilo1mc">
					<td></td>
					<td></td>
					<td>OC</td>
					<td>BIEN</td>
					<td>DISPONIBLE</td>
					<td>UBICACION</td>
				</tr>

				<?php 
				$cont2=1;
				$cont22=0;
				while($row2 = mysql_fetch_array($res2)) {
					$estilo=$cont2%2;
					if ($estilo==0) {
						$estilo2="Estilo1mc";
					} else {
						$estilo2="Estilo1mcblanco";
					}
					?>
					<tr class="trh <?php echo $estilo2 ?>">
						<td><?php echo $cont2 ?></td>
						<td><input type="checkbox" name="var1[<?php echo $cont22 ?>]" id="var1" value="<?php echo $row2["doc_id"] ?>">
						</td>
						<td><?php echo $row2["oc_id2"] ?></td>
						<td><?php echo $row2["doc_especificacion"] ?></td>
						<td><?php echo $row2["ding_unidad"] ?></td>
						<td><?php echo $row2["ding_ubicacion"] ?></td>
					</tr>
					<?php $cont2++;$cont22++; ?>
					<?php } ?>

					<tr>
						<td></td>
						<td colspan="5">
							<input type="hidden" name="totalItems" value="<?php echo $cont22 ?>">
							<input type="hidden" name="oc" value="<?php echo $oc ?>">
							<input type="hidden" name="bien" value="<?php echo $bien ?>">
							<input type="hidden" name="rack" value="<?php echo $rack ?>">
							<button type="submit"><i class="fa fa-plus"></i></button>
						</td>
					</tr>
				</table>

		<input type="hidden" name="ocid" value="<?php echo $ocid ?>">
	</form>

<hr>

<?php include("bode_bajas_ingresadas.php") ?>
</div>