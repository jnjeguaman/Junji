
<div  style="width:630px; height:280px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">

	<?php 
	$sql2 = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON b.doc_oc_id = a.oc_id WHERE oc_id = ".$_GET["id"];
	?>
	<?php $sql2Resp = mysql_query($sql2) ?>
	<?php $row = mysql_fetch_array($sql2Resp); ?>

	<form name="form11111" action="bode_inv_grabaori_2oc2.php" method="post" >
		<table border=1 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">FICHA ORDEN DE COMPRA</td>
			</tr>
		</table>

		<table border=1 width="100%">
			<tr>
				<td  valign="center" class="Estilo1">GRUPO</td>
				<td  class="Estilo1">
					<select name="grupo" id="grupo" class="Estilo2">
						<option selected value="">Seleccionar...</option>

						<?php foreach ($grupos as $key => $value): ?>
							<option value="<?php echo $value["param_glosa"] ?>"  <? if ($row["oc_grupo"]==$value["param_glosa"]) { echo "selected";} ?>><?php echo $value["param_desc"] ?></option>
						<?php endforeach ?>

					</select>
					<br>

				</td>

				<td  class="Estilo1">MONTO TOTAL C / IVA</td>
				<td  class="Estilo1">
					<input type="text" name="total" id="total" class="Estilo2" disabled value="<?php echo $row["oc_monto"] ?>">
				</td>
			</tr>

			<tr>
				<td  class="Estilo1">CANTIDAD TOTAL</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_cantidad"] ?>">
				</td>

				<td  class="Estilo1">MONTO TOTAL C / IVA (CLP)</td>
				<td  class="Estilo1">
					<input type="text" name="total" id="total" class="Estilo2" disabled value="$<?php echo number_format($row["oc_conversion"],0,'.','.') ?>">
				</td>

			</tr>

			<tr>
				<td  class="Estilo1">PROGRAMA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_prog"] ?>">

				</td>

				<td  class="Estilo1">TIPO CAMBIO</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["doc_moneda"] ?>" size=8>
				</td>

			</tr>

			<tr>
				<td  class="Estilo1">PROVEEDOR RUT</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveerut"] ?>">-
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveedig"] ?>" size=1>

				</td>

				<td class="Estilo1">VALOR CAMBIO</td>
				<td class="Estilo1"><input type="text" class="Estilo2" disabled value="<?php echo $row["doc_valor_moneda"] ?>"></td>

				<!--<td  class="Estilo1">UNIDAD DE MEDIDA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_umedida"] ?>">
				</td>!-->
			</tr>
			<tr>
				<td  class="Estilo1">PROVEEDOR NOMBRE</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveenomb"] ?>" size=30>
				</td>
				<td  class="Estilo1">GUIA / OC</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_id2"] ?>" size=18>
				</td>
			</table>

				<?php if ($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54): ?>
					<table border="1" width="100%">
					<tr>
						<td class="Estilo1c">
							<input type="hidden" name="id" value="<? echo $id ?>"  >
							<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
							<input type="hidden" name="totallinea2" value="<? echo $i ?>" >
							<input type="submit" name="submit" class="Estilo2" size="11" value="  Modificar  ">
						</td>

					</tr>
				</table>
				<?php endif ?>
			</form>

			<table border="1" width="100%">
				<tr>
					<td class="Estilo1">REGION</td>
					<td class="Estilo1">
						<select class="Estilo1" name="selReg2" id="selReg2">
							<option value="">Seleccionar...</option>
							<?php while($reg = mysql_fetch_array($sqlRegionResp2)) { ?>
								<option value="<?php echo $reg["region_id"]?>"><?php echo $reg["region_glosa"]?></option>
								<?php } ?>
							</select>
						</td>
						<td class="Estilo1"><input type="checkbox" name="selTodo22" id="selTodo22">Seleccionar Todo</td>
						<td><button type="button" onClick="selTodo()">IR</button></td>
					</tr>
				</table>
				<hr>
				<table border="1" width="100%">
					<tr>
						<td  valign="center" class="Estilo1">Region</td>
						<td  valign="center" class="Estilo1">Descripcion</td>
						<td  valign="center" class="Estilo1">Cantidad</td>
						<td  valign="center" class="Estilo1">Total</td>
						<!-- UNIDAD DE MEDIDA !-->
						<td  valign="center" class="Estilo1">U. Medida</td>
						<td  valign="center" class="Estilo1">Factor</td>
						<!-- FIN !-->
					</tr>

					<form name="form11" action="bode_inv_grabaori_2oc.php" method="post" onsubmit="return validarrsdr()">
						<?

						$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$_GET["id"];
//echo $sql3;
						$i=0;
						$res3 = mysql_query($sql3);
						while ($row3 = mysql_fetch_array($res3)) {



							?>
							<tr>
								<td class="Estilo1" colspan=1>
									<?

									if (($row3["doc_region"]==$regionsession or $row3["doc_region"]=='') or ($regionsession==16))  {
//                           $disabled="";
//                           if (($row3["doc_region"]<>'' and $row3["doc_region"]<>$regionsession) and $regionsession<>16 ) {
//                               $disabled="disabled";
//                           }

										?>

										<select name="var4[<? echo $i ?>]" id="region22_<?php echo $i?>" class="Estilo2" <? echo $disabled ?>>
											<option value="">Seleccionar...</option>
											<?php
											$j=1;
											while($j<$ii) {
												?>
												<option value="<? echo  $regionN[$j] ?>" <? if ($row3["doc_region"]==$regionN[$j]) { echo  "selected=selected"; } ?>  < > <? echo $regionG[$j] ?></option>
												<?php
												$j++;
											}


											?>

										</select>


										<?
									}  else {
										echo $row3["doc_region"];
									}
									?>
								</td>

								<td class="Estilo1" colspan=1>
									<input type="text" name="" class="Estilo2" size="40"  disabled value="<? echo $row3["doc_especificacion"] ?>" >
									<input type="hidden" name="var5[<? echo $i ?>]" class="Estilo2" size="40"  value="<? echo $row3["doc_id"] ?>" >
								</td>
								<td class="Estilo1" colspan=1>
									<input type="text" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_cantidad"],0,',','.'); ?>" >
									<input type="hidden" name="var2[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $row3["doc_cantidad"] ?>" >
								</td>
								<td class="Estilo1" colspan=1>
									<input type="text" name="var3[<? echo $i ?>]" class="Estilo2" size="7" disabled value="<? echo number_format($row3["doc_unit"],0,',','.'); ?>" >
								</td>
								<!-- UNIDAD DE MEDIDA !-->
								<td class="Estilo1">
									<select name="var6[<?php echo $i ?>]" id="tipo_compra" class="Estilo2">
										<option value="">Seleccionar...</option>

										<?php foreach ($uMedida as $key => $value): ?>
											<option value="<?php echo $value["param_glosa"] ?>"  <? if ($row3["doc_umedida"]==$value["param_glosa"]) { echo "selected";} ?>><?php echo $value["param_desc"] ?></option>
										<?php endforeach ?>
									</select>
								</td>
								<td class="Estilo1"><input type="text" size="2" name="var7[<?php echo $i ?>]" value="<?php echo $row3["doc_factor"] ?>"></td>
								<!-- FIN !-->
							</tr>
							<?

							$i=$i+1;
						}

						?>

					</table>
					<?php if ($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54): ?>
						<table border="1" width="100%">
						<tr>
							<td class="Estilo1c">
								<input type="hidden" name="id" value="<? echo $id ?>"  >
								<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
								<input type="hidden" name="totallinea2" id="totallinea2" value="<? echo $i ?>" >
								<input type="submit" name="submit" class="Estilo2" size="11" value="  Modificar  ">
							</td>

						</tr>
					</table>
					<?php endif ?>
				</form>
			</div>

			<script type="text/javascript">
				function selTodo(){
					var reg = $("#selReg2 option:selected").val();
					var regText = $("#selReg2 option:selected").text();
					var totallinea = $("#totallinea2").val();

					if($("#selTodo22").is(":checked")){

						for(i=0;i<totallinea;i++){
							$("#region22_"+i+" option:selected").text(regText);
							$("#region22_"+i+" option:selected").val(reg);
						}
					}
				}

				function validarrsdr()
				{
					return true;
				}
			</script>