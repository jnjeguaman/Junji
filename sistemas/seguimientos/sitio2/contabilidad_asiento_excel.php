	<?php
	extract($_GET);
	require_once("inc/config.php");
	$filename = "Reporte_".$region."_".$item."_".date("Y-m-d");
	header("Content-Type: text/excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=".$filename.".xls");

	$tipos_guias = array(1 => "BODEGA",2 => "OFICINA",3 => "JARDIN INFANTIL",4 => "",5 => "CONSUMO INTERNO",6 => "TRASLADO INTERNO");

	if($region == 14)
	{
		$regionDestino = 16;
	}else if($region == 16)
	{
		$regionDestino = 14;
	}else{
		$regionDestino = $region;
	}

	if($item == "Resumen")
	{
		$sql2 = "SELECT DISTINCT(CONCAT(cuenta_item,'.',cuenta_subitem,'.',cuenta_asignacion)) AS item_presupuestario FROM compra_cuentas WHERE cuenta_subitem <> '' AND cuenta_asignacion <> ''";
		$res2 = mysql_query($sql2);
		$itemPresupuestario = array();

		while($row = mysql_fetch_array($res2))
		{
			$itemPresupuestario[] = $row;
		}

		$totalItems = count($itemPresupuestario);
		$where="(";
		for($i = 0; $i<$totalItems;$i++)
		{
			$where.="a.doc_item = '".$itemPresupuestario[$i]["item_presupuestario"]."' || ";
		}
		$where.=') AND';
		$where = str_replace(" || ) AND", ") AND", $where);

		$sql = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON b.oc_id = a.doc_oc_id where ".$where." b.oc_tipo = 1 AND b.oc_guiaemisor <> '' AND YEAR(b.oc_fecha) = ".$annio." AND MONTH(b.oc_fecha) = ".$mes." AND b.oc_region2 = ".$regionDestino;
	}else{
		$sql = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON b.oc_id = a.doc_oc_id where a.doc_item = '".$item."' AND b.oc_tipo = 1 AND b.oc_guiaemisor <> '' AND b.oc_region2 = ".$regionDestino;
	}
	$res = mysql_query($sql,$dbh6);
	?>
	<table border="1" width="100%">
		<tr>
			<td colspan="9" align="center">REPORTE ASIENTO CONTABLE</td>
		</tr>
		<tr>
			<td>ITEM PRESUPUESTARIO</td>
			<td colspan="9"><?php echo $item ?></td>
		</tr>

		<tr>
			<td>FECHA REPORTE</td>
			<td colspan="9"><?php echo date("Y-m-d") ?> a las <?php echo date("H:i:s") ?></td>
		</tr>

		<tr>
			<td style="text-align: left">PRODUCTO</td>
			<td style="text-align: left">CANTIDAD DESPACHADA</td>
			<td style="text-align: left">ORDEN DE COMPRA</td>
			<td style="text-align: left">N&deg; GUIA</td>
			<td style="text-align: left">TIPO GUIA</td>
			<td style="text-align: left">DESTINATARIO</td>
			<td style="text-align: left">CUENTA ACTIVO</td>
			<td style="text-align: left">CUENTA GASTO</td>
			<td style="text-align: left">TOTAL</td>
		</tr>
		<?php
		while($row = mysql_fetch_array($res)) {
			$valorizacion = $row["doc_cantidad"] * $row["doc_conversion"];
			?>
			<tr>
				<td><?php echo utf8_decode($row["doc_especificacion"]) ?></td>
				<td><?php echo $row["doc_cantidad"] ?></td>
				<td><?php echo $row["doc_numerooc"] ?></td>
				<td><?php echo $row["oc_folioguia"] ?></td>
				<td><?php echo $tipos_guias[$row["oc_tipo_guia"]] ?></td>
				<td><?php echo $row["oc_guiadestina"] ?></td>
				<td><?php echo $row["doc_activo"] ?></td>
				<td><?php echo $row["doc_gasto"] ?></td>
				<td>$<?php echo number_format($valorizacion,0,".",".") ?></td>
			</tr>
			<?php } ?>
		</table>