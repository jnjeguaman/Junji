<?php
extract($_GET);
$devengoFecha = explode("-", $valorizacion_f_devengo);
$regionSession = $_SESSION["region"];

$oc = "SELECT oc_numero,compra_monto FROM acti_compra WHERE id = ".$oc_id;
$oc = mysql_query($oc);
$oc = mysql_fetch_array($oc);
if($modalidad == 1)
{
	$query2 = "SELECT * FROM acti_inventario WHERE inv_oc = '".$valorizacion_oc."' AND inv_nro_rece = '".$valorizacion_rc."' AND inv_estado2 = 1 AND inv_visible = 1 AND inv_region = ".$region." ORDER BY inv_oc ASC";
	$sql2 = "SELECT DISTINCT(inv_bien) as Bien FROM acti_inventario WHERE inv_oc = '".$valorizacion_oc."' AND inv_nro_rece = '".$valorizacion_rc."' AND inv_estado2 = 1 AND inv_visible = 1 ORDER BY inv_oc ASC";
}

if($modalidad == 2)
{
	$query2 = "SELECT * FROM acti_inventario WHERE inv_oc = '".$valorizacion_oc."' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_nro_rece = '".$valorizacion_rc."' AND inv_visible = 1 AND year(inv_devengofecha) = '".$devengoFecha[0]."' AND month(inv_devengofecha) = '".$devengoFecha[1]."'";
	$sql2 = "SELECT DISTINCT(inv_bien) as Bien FROM acti_inventario WHERE inv_oc = '".$valorizacion_oc."' AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1 AND year(inv_devengofecha) = '".$devengoFecha[0]."' AND month(inv_devengofecha) = '".$devengoFecha[1]."'";
}
$resQuery2 = mysql_query($query2,$dbh);

if(isset($submit) && $submit == "previsualizar")
{
	for ($i=1; $i <= $totalElementos; $i++) { 
		echo $i.":".$var1[$i]."<br>";
	}
}
//VALORES UNICOS DE LA BUSQUEDA
$res2 = mysql_query($sql2,$dbh);
$arregloUnicos = array();
while($row2 = mysql_fetch_array($res2))
{
	$arregloUnicos[] = $row2["Bien"];
}

?>
<div style="width:750px; background-color:#E0F8E0; position:absolute; top:160px; left:710px;" id="div2">
	<form action="inv_valorizacion_actualizacion.php" method="POST" onSubmit="blockUI();">
		<table border='1' width='100%'>
			
			<?php foreach ($arregloUnicos as $key => $value): ?>
				<tr>
				<td class="Estilo1mc">VALOR UNITARIO N° <?php echo ($key+1) ?></td>
				<td class="Estilo1mc" colspan="2">
					<?php echo $value ?>
					<input type="text" name="sugerido" id="sugerido_<?php echo array_search($value, $arregloUnicos) ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					<td class="Estilo1mc" colspan="2"><input type="checkbox" name="toggle" id="toggle" onClick="setValor(<?php echo array_search($value, $arregloUnicos) ?>)">Seleccionar Todo</td>
				</tr>
			<?php endforeach ?>
			<tr>
				<th class='Estilo1mc'></th>
				<th class='Estilo1mc'>PRODUCTO</th>
				<th class='Estilo1mc'>OC</th>
				<th class='Estilo1mc'>CODIGO INVENTARIO</th>
				<th class='Estilo1mc'>VALOR UNITARIO</th>
			</tr>

			<?php 
			$cont = 0; 
			$suma = 0;
			while($row = mysql_fetch_array($resQuery2)) { 
				$estilo=$cont%2;
				if ($estilo==0) {
					$estilo2="Estilo1mc";
				} else {
					$estilo2="Estilo1mcblanco";
				}
				$suma += $row["inv_costo"];
				?>
				<tr class="<?php echo $estilo2 ?> trh">
					<td><?php echo ($cont +1) ?></td>
					<td><?php echo $row["inv_bien"] ?></td>
					<td><?php echo $row["inv_oc"] ?></td>
					<td><?php echo $row["inv_codigo"] ?></td>
					<?php if($modalidad == 1): ?>
						<td><input type="number" name="var1[<?php echo $cont ?>]" class="var1_<?php echo array_search($row["inv_bien"], $arregloUnicos) ?>" value="<?php echo $row["inv_costo"] ?>"></td>
					<?php elseif($modalidad == 2): ?>
						<td><input type="number" name="var1[<?php echo $cont ?>]" class="var1_<?php echo array_search($row["inv_bien"], $arregloUnicos) ?>" value="<?php echo $row["inv_costo"] ?>"></td>
					<?php else: ?>
					<?php endif ?>
				</tr>

				<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $row["inv_id"] ?>">
				<?php $cont++;} ?>
				<tr>
					<td colspan="3"></td>
					<td class="Estilo1mc">SUMATORIA</td>
					<td class="Estilo1mc">$<?php echo number_format($suma,0,".",".") ?></td>
				</tr>

				<tr>
					<td colspan="3"></td>
					<td class="Estilo1mc">DEVENGADO</td>
					<td class="Estilo1mc">$<?php echo number_format($oc["compra_monto"],0,".",".") ?></td>
				</tr>

				<tr>
					<td colspan="3"></td>
					<td class="Estilo1mc">DIFERENCIA</td>
					<td class="Estilo1mc">$<?php echo number_format(($oc["compra_monto"] - $suma),0,".",".") ?></td>
				</tr>

				<tr>
					<td colspan="3"></td>
					<td class="Estilo1mc">UNITARIO SUGERIDO</td>
					<td class="Estilo1mc"><?php echo intval(($oc["compra_monto"] / ($cont-1))) ?></td>
				</tr>

				<tr>
					<td class="Estilo1mc" colspan="5"><button type="submit" name="submit" value="previsualizar">ACTUALIZAR <i class="fa fa-refresh"></button></td>
				</tr>
			</table>
			<input type="hidden" name="rc" value="<?php echo $valorizacion_rc ?>">
			<input type="hidden" name="oc_id" value="<?php echo $oc_id ?>">
			<input type="hidden" name="totalElementos" id="totalElementos" value="<?php echo ($cont-1) ?>">
			<input type="hidden" name="modalidad" value="<?php echo $modalidad ?>">
			<input type="hidden" name="oc" value="<?php echo $valorizacion_oc ?>">
			<input type="hidden" name="clave" value="<?php echo $valorizacion_f_devengo ?>">
		</form>
	</div>

	<script type="text/javascript">

		function setValor(valor)
		{
			var sugerido = parseInt($("#sugerido_"+valor).val());
			$(".var1_"+valor).val(sugerido);
			// var totalElementos = $("#totalElementos").val();
			// if($("#toggle").is(":checked"))
			// {
			// 	for (var i = 1; i <= totalElementos; i++) {
			// 		$("#var1_"+i).val(sugerido);
			// 		$("#var1_"+i).prop({
			// 			"min" : sugerido - 1,
			// 			"max" : sugerido + 1
			// 		});
			// 	}
			// }else{
			// }
		}
	</script>