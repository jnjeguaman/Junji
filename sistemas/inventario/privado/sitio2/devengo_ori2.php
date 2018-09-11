<?php
//BUSCAMOS TODOS LOS PRODUCTOS DE LA O/C QUE TENGAN RECEPCION CONFORME
// $sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON b.ing_oc_id = a.oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = b.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id LEFT JOIN acti_compra e ON e.oc_numero = a.oc_id2 WHERE a.oc_id = ".$oc_id." AND b.ing_id = ".$ing_id." AND b.ing_guianumerorc = ".$rc." AND b.ing_estado = 1 AND b.ing_clasificacion = 1 GROUP BY d.doc_especificacion ORDER BY d.doc_id ASC";
$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON b.ing_oc_id = a.oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = b.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id /*LEFT JOIN acti_compra e ON e.oc_numero = a.oc_id2*/ WHERE a.oc_id = ".$oc_id." AND b.ing_id = ".$ing_id." AND b.ing_guianumerorc = ".$rc." AND (b.ing_estado = 1 OR b.ing_estado = 2) AND b.ing_region = ".$_SESSION["region"]." GROUP BY d.doc_especificacion ORDER BY d.doc_id ASC";
$resInfo = mysql_query($sql,$dbh);
$info = mysql_fetch_array($resInfo);
$res = mysql_query($sql,$dbh);
?>
<form action="devengo_actualizar.php" method="POST" id="frmConta<?php echo $cont?>" onSubmit="return check()">
	<table border="1" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="16">ORDEN DE COMPRA : <?php echo $info["oc_id2"] ?></td>
		</tr>

		<tr>
			<td></td>
			<td class="Estilo1mc">PRODUCTO</td>
			<td class="Estilo1mc">CANTIDAD O/C</td>
			<td class="Estilo1mc">RECIBIDO</td>
			<td class="Estilo1mc">STOCK</td>
			<td class="Estilo1mc">VALOR UNITARIO</td>
			<td class="Estilo1mc">NETO</td>
			<td class="Estilo1mc">SUBTOTAL</td>
			<td class="Estilo1mc">DESCUENTO</td>
			<td class="Estilo1mc">% DESCUENTO</td>
			<td class="Estilo1mc">$ LOTE RECEPCION (NETO)</td>
			<td class="Estilo1mc">$ LOTE RECEPCION (TOTAL CLP)</td>
			<td class="Estilo1mc">CLASIFICACION</td>
			<td class="Estilo1mc">DEVENGO (CLP)</td>
			<td class="Estilo1mc">CTA CONTABLE</td>
			<td class="Estilo1mc">SET DE PAGO(S)</td>
		</tr>
		<?php 
		$cont=0;
		$ok = 0;

		while($row = mysql_fetch_array($res)) { 
			$estilo=$cont%2;
			if ($estilo==0) {
				$estilo2="Estilo1mcblanco";
			} else {
				$estilo2="Estilo1mc";
			}

			$sql2 = "select compra_monto,compra_devengado from acti_compra WHERE compra_doc_id = ".$row["doc_id"]." and compra_ding_id =".$row["ding_id"];
			$res2 = mysql_query($sql2);
			$row2 = mysql_fetch_array($res2);

			//$devengado = "SELECT compra_monto,compra_devengado,compra_doc_id FROM acti_compra WHERE compra_doc_id = ".$row["doc_id"]." AND compra_rc = ".$row["ing_guianumerorc"]." AND oc_numero = '".$row["oc_id2"]."'";
			//$devengado = mysql_query($devengado);
			//$devengado = mysql_fetch_array($devengado);

			//SE BUSCA EL TOTAL RECIBIDO Y STOCK DISPONIBLE
			$sql2 = "SELECT (SUM(ding_cantidad) - SUM(ding_cant_rechazo)) as TotalRecibido, SUM(ding_unidad) as StockDisponible FROM bode_detingreso WHERE ding_prod_id = ".$row["doc_id"]." AND ding_recep_tecnica = 'A' AND ding_recep_conforme = 'C' AND ding_ing_id = ".$ing_id." AND ding_estado = 1";
			$res3 = mysql_query($sql2,$dbh);
			$row3 = mysql_fetch_array($res3);
			$totalRecibido = $row3["TotalRecibido"];
			$stockDisponible = $row3["StockDisponible"];
			?>

			<tr class="<?php echo $estilo2 ?> trh">
				<!-- CLASIFICACION !-->
				<?php $clasificacion = intval($row["ding_clasificacion"]) ?>
				<td>

					<!-- INVENTARIABLE !-->
					<?php if ($clasificacion===1): ?>

					<!-- ESTA O NO DEVENGADO !-->
					<?php if (intval($row2["compra_devengado"])===1): ?>
					<i class="fa fa-check"></i>
				<?php else: ?> 
				<input type="checkbox" name="var1[<?php echo $cont ?>]" id="var1_<?php echo $cont ?>" value="<?php echo $cont ?>" onClick="setRequired(<?php echo $cont ?>)">
			<?php endif ?>

			<!-- EXISTENCIA !-->
		<?php elseif($clasificacion===0): ?> 

		<!-- ESTA O NO DEVENGADO !-->
		<?php if (intval($row["ding_devengado"])===1): ?>
		<i class="fa fa-check"></i>
	<?php else: ?> 
	<input type="checkbox" name="var1[<?php echo $cont ?>]" id="var1_<?php echo $cont ?>" value="<?php echo $cont ?>" onClick="setRequired(<?php echo $cont ?>)">
<?php endif ?>

<!-- PRODUCTO SI CLASIFICACION !-->		
<?php else: ?> 
	<i class="fa fa-warning"></i>
<?php endif ?>
</td>

<td><?php echo $row["doc_especificacion"] ?></td>
<td><?php echo $row["doc_cantidad"] ?></td>
<td><?php echo $totalRecibido ?></td>
<!-- <td><?php echo ($row["ding_cantidad"] - $row["ding_cant_rechazo"]) ?></td> -->
<td><?php echo $stockDisponible ?></td>
<!-- <td><?php echo $row["ding_unidad"] ?></td> -->
<td>$<?php echo ($row["doc_unit"] * $row["doc_valor_moneda"]) ?></td>
<td>$<?php echo ($row["doc_valor_unit2"] * $row["doc_valor_moneda"]) ?></td>
<td>$<?php echo ($row["doc_valor_unit"] * $row["doc_valor_moneda"]) ?></td>
<td>$<?php echo ($row["doc_valor_unit2"]-$row["doc_valor_unit"]) * $row["doc_valor_moneda"] ?></td>
<td><input type="text" size="1" name="dcto[<?php echo $cont ?>]" id="dcto_<?php echo $cont ?>" size="9" onChange="setValue(<?php echo $cont ?>)"></td>
<?php $loteRecepcion = $row["doc_unit"] * $totalRecibido /*$row["ding_cantidad"]*/ ?>
<?php $dcto = ($row["doc_valor_unit2"]-$row["doc_valor_unit"]) * $row["doc_valor_moneda"] ?>
<td>$<?php echo ($row["doc_unit"] * $totalRecibido /*$row["ding_cantidad"]*/) * $row["doc_valor_moneda"] ?></td>


<td>
	<!-- INVENTARIABLE !-->
	<?php if ($clasificacion===1): ?>

	<!-- ESTA O NO DEVENGADO !-->
	<?php if (intval($row2["compra_devengado"])===1): ?>
	<input type="text" size="5" disabled value="<?php echo $row2["compra_monto"] ?>">
<?php else: ?> 
	<input type="text" size="5" disabled name="var5[<?php echo $cont ?>]" id="var5_<?php echo $cont ?>">
<?php endif ?>

<!-- EXISTENCIA !-->
<?php elseif($clasificacion===0): ?> 

	<!-- ESTA O NO DEVENGADO !-->
	<?php if (intval($row["ding_devengado"])===1): ?>
	<input type="text" size="5" disabled value="<?php echo $row["ding_devengo"] ?>">
<?php else: ?> 
	<input type="text" size="5" disabled name="var5[<?php echo $cont ?>]" id="var5_<?php echo $cont ?>">
<?php endif ?>

<!-- PRODUCTO SI CLASIFICACION !-->		
<?php else: ?> 
	<i class="fa fa-warning"></i>
<?php endif ?>
</td>

<td>
	<?php if ($clasificacion === 1): ?>
	INVENTARIABLE
<?php elseif($clasificacion === 0): ?> 
	EXISTENCIA
<?php else: ?> 
	SIN CLASIFICAR
<?php endif ?>
</td>

<td>
	<!-- INVENTARIABLE !-->
	<?php if ($clasificacion===1): ?>

	<!-- ESTA O NO DEVENGADO !-->
	<?php if (intval($row2["compra_devengado"])===1): ?>
	<input type="text" size="5" disabled value="<?php echo $row2["compra_monto"] ?>">
<?php else: ?> 
	<input type="text" size="5" name="var2[<?php echo $cont ?>]" id="var2_<?php echo $cont ?>">
<?php endif ?>

<!-- EXISTENCIA !-->
<?php elseif($clasificacion===0): ?> 

	<!-- ESTA O NO DEVENGADO !-->
	<?php if (intval($row["ding_devengado"])===1): ?>
	<input type="text" size="5" disabled value="<?php echo $row["ding_devengo"] ?>">
<?php else: ?> 
	<input type="text" size="5" name="var2[<?php echo $cont ?>]" id="var2_<?php echo $cont ?>"></td>
<?php endif ?>

<!-- PRODUCTO SI CLASIFICACION !-->		
<?php else: ?> 
	<i class="fa fa-warning"></i>
<?php endif ?>
</td>

<td> 
	<?php if ($clasificacion===1): ?>

	<?php if (intval($row2["compra_devengado"])===1): ?>
	<i class="fa fa-check"></i>
<?php else: ?> 
	<a href="devengo_inventario.php?rc=<?php echo $row["ing_guianumerorc"]?>&oc=<?php echo $row["oc_id2"] ?>" class="link popup"><i class="fa fa-pencil fa-lg"></i></a>
<?php endif ?>

<?php elseif($clasificacion===0): ?> 
	<?php if (intval($row["ding_devengado"])===1): ?>
	<i class="fa fa-check"></i>
<?php else: ?> 
	<select class="Estilo1" name="var3[<?php echo $cont ?>]" id="var3_<?php echo $cont ?>">
		<option value="">Seleccionar...</option>
		<?php foreach ($ctaContableEx as $key => $value): ?> 
		<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"]." - ".$value["param_desc"] ?></option>
	<?php endforeach ?>
</select>
<?php endif ?>
<?php else: ?> 
	<i class="fa fa-warning"></i>
<?php endif ?>
</td>
<td class="Estilo1mc"><a href="inv_setpago.php?oc=<?php echo $row["oc_id2"] ?>" class="link setPago">VER</td>
</tr>
<input type="hidden" name="var4[<?php echo $cont ?>]" id="var4_<?php echo $cont ?>" value="<?php echo intval($row["ding_clasificacion"]) ?>">	
<input type="hidden" name="var6[<?php echo $cont ?>]" id="var6_<?php echo $cont ?>" value="<?php echo $row["doc_valor_moneda"] ?>">
<input type="hidden" name="var7[<?php echo $cont ?>]" id="var7_<?php echo $cont ?>" value="<?php echo $row["ding_id"] ?>">
<input type="hidden" name="var8[<?php echo $cont ?>]" id="var8_<?php echo $cont ?>" value="<?php echo $row["ing_guianumerorc"] ?>">
<input type="hidden" name="var9[<?php echo $cont ?>]" id="var9_<?php echo $cont ?>" value="<?php echo $row["doc_id"] ?>">
<input type="hidden" name="var10[<?php echo $cont ?>]" id="var10_<?php echo $cont ?>" value="<?php echo $loteRecepcion ?>">
<input type="hidden" name="var11[<?php echo $cont ?>]" id="var11_<?php echo $cont ?>" value="<?php echo $row["ding_cantidad"] ?>">
<input type="hidden" name="var12[<?php echo $cont ?>]" id="var12_<?php echo $cont ?>" value="<?php echo $row["oc_id2"] ?>">



</form>
<?php $cont++;} ?>
<input type="hidden" name="totalElementos" value="<?php echo $cont ?>">
<?php if ($cont == $ok): ?>

<?php else: ?>
	<tr>
		<td class="Estilo1" align="left" colspan="16"><center><button type="submit">ACTUALIZAR</button></center></td>
	</tr>
<?php endif ?>

					<!--<tr>
						<td class="Estilo1mc">TOTAL ORDEN DE COMPRA</td>
						<td class="Estilo1mc">$<?php echo $info["oc_monto"]?></td>
					</tr>

					<tr>
						<td class="Estilo1mc">MONEDA</td>
						<td class="Estilo1mc"><?php echo $info["doc_moneda"]?></td>
					</tr>

					<tr>
						<td class="Estilo1mc">VALOR MONEDA (<?php echo $info["doc_moneda"] ?>)</td>
						<td class="Estilo1mc"><?php echo $info["doc_valor_moneda"]?></td>
					</tr>

					<tr>
						<td class="Estilo1mc">CONVERSION (CLP) <?php  echo $info["oc_monto"] ?></td>
						<td class="Estilo1mc"><?php echo $info["doc_valor_moneda"] * $info["doc_valor_unit"]?> ($UNI : <?php echo ($info["doc_valor_moneda"] * $info["doc_valor_unit"]) / $info["doc_cantidad"] ?>)</td>
					</tr>!-->

				</table>

				<script type="text/javascript">
					function setValue(input)
					{
						var loteRecepcion = $("#var10_"+input).val();
						var dcto = $("#dcto_"+input).val() / 100;
						var dcto2 = loteRecepcion * dcto;
						var valorMoneda = $("#var6_"+input).val();
						var total = Math.round(((loteRecepcion - dcto2) * 1.19) * valorMoneda);

						console.log(input);
						$("#var5_"+input).val(total);
						$("#var2_"+input).val(total);
					}

					function setRequired(input)
					{
						if($("#var1_"+input).is(":checked"))
						{
							$("#dcto_"+input).prop("required",true);
							$("#var2_"+input).prop("required",true);
							$("#var6_"+input).prop("required",true);
							$("#var3_"+input).prop("required",true);
						}else{
							$("#dcto_"+input).prop("required",false);
							$("#var2_"+input).prop("required",false);
							$("#var6_"+input).prop("required",false);
							$("#var3_"+input).prop("required",false);
						}
					}

					jQuery('.popup').click(function(e){
						e.preventDefault();
						console.log($(this).attr("href"));
						window.open($(this).attr("href"), 'importwindow', 'width=900, height=300, top=100, left=200');
						// window.open($(this).attr("href"),"ventana1","width=120,height=300,scrollbars=NO");
					});

										jQuery('.setPago').click(function(e){
						e.preventDefault();
						console.log($(this).attr("href"));
						window.open($(this).attr("href"), 'importwindow', 'width=900, height=300, top=100, left=200');
						// window.open($(this).attr("href"),"ventana1","width=120,height=300,scrollbars=NO");
					});

					function check()
					{
						var numberOfChecked = $('input:checkbox:checked').length;
						numberOfChecked = parseInt(numberOfChecked);
						if(numberOfChecked == 0){
							alert("SELECCIONE ALMENOS 1 ITEM");
							return false;
						}else{
							blockUI();
						}
					}
				</script>