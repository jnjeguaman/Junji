<?php
// BUSCAMOS EL DETALLE DE LA ORDEN DE COMPRA DADA
$detalleOC = "SELECT * FROM bode_orcom WHERE oc_id = ".$oc_id;
$detalleOC = mysql_query($detalleOC,$dbh);
$detalleOC = mysql_fetch_array($detalleOC);
?>
<form action="devengo_actualizar.php" method="POST" id="frmConta<?php echo $cont?>">
	<table border="1" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="16">ORDEN DE COMPRA : <?php echo $detalleOC["oc_id2"] ?></td>
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
			<td class="Estilo1mc">CUENTA CONTABLE</td>
		</tr>
		<?php
		extract($_POST);
// BUSCAMOS TODO LO RELACIONADO CON LO SELECCIONADO
		
		$sql = "SELECT * FROM bode_ingreso a INNER JOIN bode_detingreso b ON b.ding_ing_id = a.ing_id INNER JOIN bode_detoc c ON c.doc_id = b.ding_prod_id INNER JOIN bode_orcom d ON d.oc_id = a.ing_oc_id LEFT JOIN acti_compra e ON e.oc_numero = d.oc_id2 WHERE a.ing_oc_id = ".$oc_id." AND (";
		for ($i=1; $i <= $totalLineas ; $i++) { 
			if($var1[$i] <> "")
			{
				$part0 .= "a.ing_guianumerorc = ".$var2[$i];

				if($i <> $totalLineas)
				{
					$part0.=" OR ";
				}else{
				}
			}
		}
		$sql.=$part0;
		$sql.=") GROUP BY a.ing_guianumerorc";
	//echo $sql;
		$totalRecibidos = 0;
		$neto = 0;
		$res = mysql_query($sql,$dbh);

		$cont = 0;
		$ok = 0;
		while($row = mysql_fetch_array($res))
		{
			$monedaOrigen = $row["doc_moneda"];
			$valorMoneda = $row["doc_valor_moneda"];
			$totalRecibidos+=$row["ding_cantidad"];
			$neto+=$row["doc_valor_unit2"];
			$estilo=$cont%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}
			
			
			?>
			<tr class="<?php echo $estilo2 ?> trh">
				<!-- CLASIFICACION !-->
				<?php $clasificacion = intval($row["ding_clasificacion"]) ?>
				<td>

					<!-- INVENTARIABLE !-->
					<?php if ($clasificacion===1): ?>

						<!-- ESTA O NO DEVENGADO !-->
						<?php if (intval($row["compra_devengado"])===1): ?>
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
				<td><?php echo ($row["ding_cantidad"] - $row["ding_cant_rechazo"]) ?></td>
				<td><?php echo ($row["ding_unidad"] * $row["doc_valor_moneda"]) ?></td>
				<td>$<?php echo ($row["doc_unit"] * $row["doc_valor_moneda"]) ?></td>
				<td>$<?php echo ($row["doc_valor_unit2"] * $row["doc_valor_moneda"]) ?></td>
				<td>$<?php echo ($row["doc_valor_unit"] * $row["doc_valor_moneda"]) ?></td>
				<td>$<?php echo ($row["doc_valor_unit2"]-$row["doc_valor_unit"]) * $row["doc_valor_moneda"] ?></td>
				<td><input type="text" size="1" name="dcto[<?php echo $cont ?>]" id="dcto_<?php echo $cont ?>" size="9" onChange="setValue(<?php echo $cont ?>)"></td>
				<?php $loteRecepcion = $row["doc_unit"] * $row["ding_cantidad"] ?>
				<?php $dcto = $row["doc_valor_unit2"]-$row["doc_valor_unit"] ?>
				<td>$<?php echo ($row["doc_unit"] * $row["doc_valor_moneda"]) * $row["ding_cantidad"] ?></td>


				<td>
					<!-- INVENTARIABLE !-->
					<?php if ($clasificacion===1): ?>

						<!-- ESTA O NO DEVENGADO !-->
						<?php if (intval($row["compra_devengado"])===1): ?>
							<input type="text" size="5" disabled value="<?php echo $row["compra_monto"] ?>">
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
						<?php if (intval($row["compra_devengado"])===1): ?>
							<input type="text" size="5" disabled value="<?php echo $row["compra_monto"] ?>">
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

							<?php if (intval($row["compra_devengado"])===1): ?>
								<i class="fa fa-check"></i>
							<?php else: ?> 
								<a href="devengo_inventario.php?rc=<?php echo $row["ing_guianumerorc"]?>&oc=<?php echo $row["oc_id2"] ?>" class="link popup"><i class="fa fa-pencil fa-lg"></i></a>
							<?php endif ?>
							
							<?php elseif($clasificacion===0): ?> 
							<?php if (intval($row["ding_devengado"])===1): ?>
								<i class="fa fa-check"></i>
							<?php else: ?> 
								<select class="Estilo1" name="var3[<?php echo $cont ?>]" id="var3_<?php echo $cont ?>">
							<option selected value="">Seleccionar...</option>
								<?php foreach ($ctaContableEx as $key => $value): ?> 
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"]." - ".$value["param_desc"] ?></option>
								<?php endforeach ?>
						</select>
							<?php endif ?>
							<?php else: ?> 
								<i class="fa fa-warning"></i>
						<?php endif ?>
				</td>
				</tr>
						<input type="hidden" name="var4[<?php echo $cont ?>]" id="var4_<?php echo $cont ?>" value="<?php echo intval($row["ding_clasificacion"]) ?>">	
						<input type="hidden" name="var6[<?php echo $cont ?>]" id="var6_<?php echo $cont ?>" value="<?php echo $row["doc_valor_moneda"] ?>">
						<input type="hidden" name="var7[<?php echo $cont ?>]" id="var7_<?php echo $cont ?>" value="<?php echo $row["ding_id"] ?>">
						<input type="hidden" name="var8[<?php echo $cont ?>]" id="var8_<?php echo $cont ?>" value="<?php echo $row["ing_guianumerorc"] ?>">
						<input type="hidden" name="var9[<?php echo $cont ?>]" id="var9_<?php echo $cont ?>" value="<?php echo $row["doc_id"] ?>">
						<input type="hidden" name="var10[<?php echo $cont ?>]" id="var10_<?php echo $cont ?>" value="<?php echo $loteRecepcion ?>">
						<input type="hidden" name="var11[<?php echo $cont ?>]" id="var11_<?php echo $cont ?>" value="<?php echo $row["ding_cantidad"] ?>">
						<input type="hidden" name="var12[<?php echo $cont ?>]" id="var12_<?php echo $cont ?>" value="<?php echo $row["oc_id2"] ?>">
						<?php $cont++;} ?>
						<input type="hidden" name="totalElementos" value="<?php echo $cont ?>">
						<?php if ($cont == $ok): ?>
							
						<?php else: ?>
							<tr>
								<td class="Estilo1" align="left" colspan="15"><button type="submit">ACTUALIZAR</button></td>
							</tr>
						<?php endif ?>
					</table>

					<hr>
					<table border="1" width="50%" align="center">
						<tr>
							<td class="Estilo2titulo" colspan="15">ORDEN DE COMPRA : <?php echo $detalleOC	["oc_id2"] ?></td>
						</tr>
						<tr>
							<td class="Estilo1mcR">TOTAL RECIBIDOS</td>
							<td class="Estilo1mc"><?php echo $totalRecibidos ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">TOTAL O/C</td>
							<td class="Estilo1mc"><?php echo $detalleOC["oc_cantidad"] ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">ELEMENTOS POR RECIBIR</td>
							<td class="Estilo1mc"><font color="red"><?php echo $detalleOC["oc_cantidad"] - $totalRecibidos ?></font></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">NETO O/C</td>
							<td class="Estilo1mc">$<?php echo number_format($neto,0,".",".") ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">DESCUENTO</td>
							<td class="Estilo1mc">$<?php echo number_format($detalleOC["oc_descuento"],0,".",".") ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">SUB-TOTAL</td>
							<td class="Estilo1mc">$<?php echo number_format($neto-$detalleOC["oc_descuento"],0,".",".") ?></td>
							<?php $subtotal = $neto-$detalleOC["oc_descuento"] ?>
						</tr>

						<tr>
							<td class="Estilo1mcR">IVA</td>
							<td class="Estilo1mc">$<?php echo number_format($subtotal * 0.19,0,".",".") ?></td>
							<?php $iva = intval($subtotal * 0.19) ?>
						</tr>

						<tr>
							<td class="Estilo1mcR">TOTAL O/C ($)</td>
							<td class="Estilo1mc">$<?php echo number_format($detalleOC["oc_monto"],0,".",".") ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">MONEDA ORIGEN</td>
							<td class="Estilo1mc"><?php echo $monedaOrigen ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">VALOR MONEDA</td>
							<td class="Estilo1mc">$<?php echo number_format($valorMoneda,0,".",".") ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">CONVERSION CLP</td>
							<td class="Estilo1mc">$<?php echo number_format($valorMoneda * $detalleOC["oc_monto"],0,".",".") ?></td>
						</tr>

						<tr>
							<td class="Estilo1mcR">ESTADO O/C</td>
							<td class="Estilo1mc">
								<?php if ($detalleOC["oc_cantidad"] == $totalRecibidos): ?>
									COMPLETA
								<?php else: ?>
									INCOMPLETA
								<?php endif ?>
							</td>
						</tr>

					</table>
				</form>
				<script type="text/javascript">

					jQuery('.popup').click(function(e){
						e.preventDefault();
						window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=900, height=150, top=100, left=200, toolbar=1');
					});

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
				</script>