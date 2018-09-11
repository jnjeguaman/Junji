<hr>
<table border='0' width='100%'>
	<tr>
		<th class='Estilo1mc'>OC</th>
		<th class='Estilo1mc'>DEVENGADO FINAL</th>
		<th class='Estilo1mc'>SUMA BIENES</th>
		<th class='Estilo1mc'>RECEPCION CONFORME</th>
		<th class='Estilo1mc'>EDITAR</th>
		<!-- <th class='Estilo1mc'>ESTADO</th> -->
		<th class='Estilo1mc'>CUADRATURA SIGFE</th>
		<th class='Estilo1mc'>DEVENGADO</th>
	</tr>

	<?php 
	$cont = 1;
	$devengoFecha  = explode("-", $valorizacion_f_devengo);
	 while($row = mysql_fetch_array($resQuery)) { 
		$estilo=$cont%2;
		if ($estilo==0) {
			$estilo2="Estilo1mc";
		} else {
			$estilo2="Estilo1mcblanco";
		}
		if($modalidad == 1)
		{
			 $final = "SELECT sum(compra_monto) as compra_monto,id,compra_devengado FROM acti_compra WHERE oc_numero = '".$row["inv_oc"]."' AND compra_rc = ".$row["inv_nro_rece"]." AND compra_region_id = ".$_SESSION["region"];
		$final = mysql_query($final,$dbh);
		$final = mysql_fetch_array($final);
		}

		if($modalidad == 2)
		{
			$final = array("compra_monto" =>$row["compra_monto"],"id" => $row["oc_id"]);
			// $final = "SELECT SUM(inv_costo) AS compra_monto FROM acti_inventario WHERE inv_oc = '".$row["inv_oc"]."' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1 AND year(inv_devengofecha) = '".$devengoFecha[0]."' AND month(inv_devengofecha) = '".$devengoFecha[1]."'";
		}
		if($modalidad == 1)
		{
			$suma = "SELECT SUM(inv_costo) as Sumatoria FROM acti_inventario WHERE inv_oc = '".$row["inv_oc"]."' AND inv_nro_rece = '".$row["inv_nro_rece"]."' and inv_visible = 1";
		}
		if($modalidad == 2)
		{
			$suma = "SELECT SUM(inv_costo) as Sumatoria,inv_nro_rece FROM acti_inventario   WHERE inv_oc = '".$row["inv_oc"]."' AND inv_nro_rece = '".$row["inv_nro_rece"]."' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1 AND year(inv_devengofecha) = '".$devengoFecha[0]."' AND month(inv_devengofecha) = '".$devengoFecha[1]."'";
		}
		$suma = mysql_query($suma);
		$suma = mysql_fetch_array($suma);

		if($suma["Sumatoria"] <> $final["compra_monto"])
		{
			$icono = "<i class='fa fa-warning'></i>";
			$estado = 0;
		}else{
			$icono = "<i class='fa fa-check'></i>";
			$estado = 1;
		}

		if($row["compra_devengado"] == 1 || $final["compra_devengado"] == 1)
		{
			$devengado = "<i class='fa fa-check'></i>";
		}else{
			$devengado = "<i class='fa fa-warning'></i>";
		}
		?>
		<tr class="<?php echo $estilo2 ?> trh">
			<td><?php echo $row["inv_oc"] ?></td>
			<td>$<?php echo number_format($final["compra_monto"],0,".",".") ?></td>
			<td>$<?php echo number_format($suma["Sumatoria"],0,".",".") ?></td>
			<td><?php echo $row["inv_nro_rece"] ?></td>
			<td>
			<?php if ($estado): ?>
				<i class="fa fa-ban"></i>
			<?php else: ?>
				<a href="inv_valorizacion.php?ori=2&valorizacion_rc=<?php echo $row["inv_nro_rece"]?>&oc_id=<?php echo $final["id"]?>&valorizacion_f_devengo=<?php echo $valorizacion_f_devengo ?>&modalidad=<?php echo $modalidad ?>&valorizacion_oc=<?php echo $row["inv_oc"]?>"><i class="fa fa-eye"></i></a>
				
			<?php endif ?>
		</td>
		<!-- <td><?php echo $icono ?></td> -->
		<td><?php echo $icono ?></td>
		<td><?php echo $devengado ?></td>
	</tr>
	<?php $cont++;} ?>
</table>