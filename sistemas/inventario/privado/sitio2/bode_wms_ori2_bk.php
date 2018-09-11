			<form action="bode_inv_indexoc4.php?cmd=WMS&ori=2" method="POST" enctype="multipart/form-data">
				<table border="1" width="100%" cellpadding="1" cellspacing="1">
					<tr>
						<td class="Estilo2titulo" colspan="2">CARGA DE ARCHIVO DE INEDIS - OPENBOX</td>
					</tr>

					<tr>
						<td class="Estilo1mc">ARCHIVO CSV (DELIMITADO POR COMAS)</td>
						<td><input type="file" name="wmsCSV" id="wmsCSV"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><button class="button" name="wmsPreview" value="wmsPreview">PREVISUALIZAR</button></td>
					</tr>
				</table>
			</form>

			<?php if ($_POST["wmsPreview"] == "wmsPreview"): ?>
				<hr>
				<form action="bode_wms_graba.php" method="POST">
					<table border="1" width="100%">
						<tr>
							<td class="Estilo2titulo">PREVISUALIZACION</td>
						</tr>
					</table>

					<br>
					<table border="1" width="100%">
						<tr>
							<td class="Estilo1mc" colspan="5" align="center">DETALLE ENCABEZADO</td>
						</tr>

						<tr>
							<td class="Estilo1mc">Tipo de Guia</td>
							<td class="Estilo1mc">Destino</td>
							<td class="Estilo1mc">Fecha de Despacho</td>
							<td class="Estilo1mc">Region de Destino</td>
							<td class="Estilo1mc">Identificador WMS</td>
						</tr>

						<?php
// LEEMOS EL ARCHIVO
						$extension =  strtoupper(pathinfo($_FILES["wmsCSV"]["name"],PATHINFO_EXTENSION));

						$tiposGuias = [
						1 => "BODEGA",
						2 => "OFICINA",
						3 => "JARDÍN INFANTIL"
						];

						if($extension === "CSV")
						{
							if($_FILES["wmsCSV"]["type"] == "application/vnd.ms-excel")
							{

							// -----------------------------------------------
							// LEEMOS EL CONTENIDO Y LO TRANSFORMAMOS A UN ARRAY ASOCIATIVO
								$csv = array_map("str_getcsv", file($_FILES["wmsCSV"]["tmp_name"]));
								// echo "<pre>";
								// print_r($csv);
								// echo "</pre>";
								$totalElementos = count($csv);
								$contador = 1;
							// FILA N° 2 ENCABEZADO DE LA GUIA
								$tipoDeGuia = $tiposGuias[$csv[1][2]];
								$encabezado = [
								0 => $tipoDeGuia,
								1 => $csv[1][0],
								2 => date("d-m-Y",strtotime($csv[1][1])),
								3 => $csv[1][3]
								];

								?>
								<tr>
									<td class="Estilo1mc"><input type="hidden" name="var[1][1]" value="<?php echo $csv[1][2] ?>"><?php echo $encabezado[0] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var[1][2]" value="<?php echo $encabezado[1] ?>"><?php echo $encabezado[1] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var[1][3]" value="<?php echo $encabezado[2] ?>"><?php echo $encabezado[2] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var[1][4]" value="<?php echo $encabezado[3] ?>"><?php echo $encabezado[3] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var[1][5]" value="<?php echo $csv[1][4] ?>"><?php echo $csv[1][4] ?></td>
								</tr>
							</table>

							<hr>
							<table border="1" width="100%">
								<tr>
									<td class="Estilo1mc" colspan="9" align="center">DETALLE PRODUCTOS</td>
								</tr>

								<tr>

									<td class="Estilo1mc">ID <?php echo $csv[2][0] ?></td>
									<td class="Estilo1mc"><?php echo $csv[2][1] ?></td>
									<td class="Estilo1mc"><?php echo $csv[2][2] ?></td>
									<td class="Estilo1mc"><?php echo $csv[2][3] ?></td>
									<td class="Estilo1mc"><?php echo $csv[2][4] ?></td>
									<td class="Estilo1mc"><?php echo $csv[2][5] ?></td>
									<td class="Estilo1mc"><?php echo $csv[2][6] ?></td>
									<td class="Estilo1mc"><?php echo $csv[2][7] ?></td>

								</tr>

								<?php
								for($i=3;$i<$totalElementos;$i++) { ?>

								<tr>
									<?php 
									$sql2 = "SELECT * FROM bode_detoc WHERE doc_id_mercado_publico = '".$csv[$i][0]."'";
									$res2 = mysql_query($sql2);
									$row2 = mysql_fetch_array($res2);
									?>
									<td class="Estilo1mc"><input type="hidden" name="var1[<?php echo $contador ?>]" value="<?php echo $csv[$i][0] ?>"><?php echo $csv[$i][0] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $csv[$i][1] ?>"><?php echo $csv[$i][1] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var3[<?php echo $contador ?>]" value="<?php echo $csv[$i][2] ?>"><?php echo $csv[$i][2] ?></td>
									<td class="Estilo1mc">$<input type="hidden" name="var4[<?php echo $contador ?>]" value="<?php echo $row2["doc_conversion"] ?>"><?php echo number_format($row2["doc_conversion"],0,".",".") ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var5[<?php echo $contador ?>]" value="<?php echo $csv[$i][4] ?>"><?php echo $csv[$i][4] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var6[<?php echo $contador ?>]" value="<?php echo $row2["doc_item"] ?>"><?php echo $row2["doc_item"] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var7[<?php echo $contador ?>]" value="<?php echo $row2["doc_activo"] ?>"><?php echo $row2["doc_activo"] ?></td>
									<td class="Estilo1mc"><input type="hidden" name="var8[<?php echo $contador ?>]" value="<?php echo $row2["doc_gasto"] ?>"><?php echo $row2["doc_gasto"] ?></td>
								</tr>
								<?php $contador++;} ?>
								<tr>
									<td colspan="8" align="right">
										<?php 
										$validaWMS = "SELECT count(oc_id) as Total FROM bode_orcom WHERE oc_wms = '".$csv[1][4]."'";
										$resValidaWMS = mysql_query($validaWMS);
										$rowValidaWMS = mysql_fetch_array($resValidaWMS);
										

										$mensaje = "";
										if($csv[1][0] == "")
										{
											$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Ha ocurrido un error al detectar la región de destino.</li>";
										}
										if($csv[1][1] == "")
										{
											$mensaje.="<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>No ha sido posible detectar la fecha de emisión de la guía de despacho.</li>";
										}
										if($csv[1][2] < 1 || $csv[1][2] > 3 || $csv[1][2] == "")
										{
											$mensaje.="<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>El tipo de guía presenta problemas.</li>";
										}
										if($csv[1][3] < 1 || $csv[1][3] > 16 || $csv[1][3] == "")
										{
											$mensaje.="<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Se ha encontrado un error en la región de destino.</li>";
										}

										if($rowValidaWMS["Total"] > 0 )
										{
											$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>El identificador WMS <strong>".$csv[1][4]." ya se encuentra registrado en INEDIS.</strong></li>";
										}

										if($csv[1][4] == "")
										{
											$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>El fichero proporcionado viene sin identificador.</strong></li>";
										}

										if(strlen($mensaje) > 0)
										{
											echo "<ul>".$mensaje."</ul>";
										}else{ ?>
										<button style="background: azure;border-radius: 5px;width: 150px;height: 40px;color: #003063;font-weight: bold">GRABAR DATOS</button>
										<?php }

										?>
									</td>
								</tr>
								<?php	
							// FILA 3 EN ADELANTE EL DETALLE DE LOS PRODUCTOS QUE SE AÑADIRAN

							// -----------------------------------------------

							}else{
								echo "Formato de archivo no permitido";
							}
						}else{
							echo "Extension no permitida";
						}
						?>
					</table>
				<?php endif ?>
