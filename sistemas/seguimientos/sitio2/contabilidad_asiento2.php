<hr>
<table border="" width="100%" class="table table-striped table-bordered table-hover">
	<tr>
		<td class="Estilo1" colspan="9"><a href="contabilidad_asiento_excel.php?item=<?php echo $item ?>&region=<?php echo $region ?>&annio=<?php echo $annio ?>&mes=<?php echo $mes ?>" class="link">EXPORTAR A EXCEL</a></td>
	</tr>
	<tr>
		<th class="Estilo1" style="text-align: left">PRODUCTO</th>
		<th class="Estilo1" style="text-align: left">CANTIDAD DESPACHADA</th>
		<th class="Estilo1" style="text-align: left">ORDEN DE COMPRA</th>
		<th class="Estilo1" style="text-align: left">N&deg; GUIA</th>
		<th class="Estilo1" style="text-align: left">TIPO GUIA</th>
		<th class="Estilo1" style="text-align: left">DESTINATARIO</th>
		<th class="Estilo1" style="text-align: left">CUENTA ACTIVO</th>
		<th class="Estilo1" style="text-align: left">CUENTA GASTO</th>
		<th class="Estilo1" style="text-align: left">TOTAL</th>
	</tr>
	<?php
	//ARREGLO CON LOS TIPOS DE GUIAS
	$tipos_guias = array(
		1 => "BODEGA",
		2 => "OFICINA",
		3 => "JARDIN INFANTIL",
		4 => "ENTREGA DIRECTO JARDIN",
		5 => "CONSUMO INTERNO",
		6 => "TRASLADO INTERNO");

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

		$totalItems = count($itemPresupuestario);
		$where="(";
		for($i = 0; $i<$totalItems;$i++)
		{
			$where.="a.doc_item = '".$itemPresupuestario[$i]["item_presupuestario"]."' || ";
		}
		$where.=') AND';
		$where = str_replace(" || ) AND", ") AND", $where);
	}
	//PRODUCTOS CON ITEM ASIGNADO EN GUIA DE DESPACHO
	if($item == "Resumen")
	{
		$sql2 = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON b.oc_id = a.doc_oc_id where ".$where." b.oc_tipo = 1 AND b.oc_guiaemisor <> '' AND YEAR(b.oc_fecha) = ".$annio." AND MONTH(b.oc_fecha) = ".$mes." AND b.oc_region2 = ".$regionDestino;
	}else{
		$sql2 = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON b.oc_id = a.doc_oc_id where a.doc_item = '".$item."' AND b.oc_tipo = 1 AND b.oc_guiaemisor <> '' AND YEAR(b.oc_fecha) = ".$annio." AND MONTH(b.oc_fecha) = ".$mes." AND b.oc_region2 = ".$regionDestino;
	}
	$res2 = mysql_query($sql2,$dbh6);

	while($row2 = mysql_fetch_array($res2)) {
		$valorizacion = $row2["doc_cantidad"] * $row2["doc_conversion"];
		?>
		<tr>
			<td class="Estilo1"><?php echo utf8_decode($row2["doc_especificacion"]) ?></td>
			<td class="Estilo1"><?php echo $row2["doc_cantidad"] ?></td>
			<td class="Estilo1"><?php echo $row2["doc_numerooc"] ?></td>
			<td class="Estilo1"><?php echo $row2["oc_folioguia"] ?></td>
			<td class="Estilo1"><?php echo $tipos_guias[$row2["oc_tipo_guia"]] ?></td>
			<td class="Estilo1"><?php echo utf8_decode($row2["oc_guiadestina"]) ?></td>
			<td class="Estilo1"><?php echo $row2["doc_activo"] ?></td>
			<td class="Estilo1"><?php echo $row2["doc_gasto"] ?></td>
			<td class="Estilo1">$<?php echo number_format($valorizacion,0,".",".") ?></td>
		</tr>
		<?php } ?>
	</table>