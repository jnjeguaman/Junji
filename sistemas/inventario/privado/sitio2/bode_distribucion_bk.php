								<?php 
								extract($_POST);
								if($submit == "ACTUALIZAR")
								{

									$totalIds = count($arrid);
									$totalJardines = count($arrid[$totalIds]);

									for ($i=1; $i <= $totalIds; $i++) { 
										for ($k=1; $k <= $totalJardines; $k++) { 
											//$arrcantidad[$i][$k] = $arrcantidad[$i][$k];
											$_SESSION["arrCantidad"][$i][$k] = rand(1,100);
										}
									}
								}
								?>
								<div id="seccion1" style="background-color:#E0F8E0;" >
									<form name="f1" method="POST" action="bode_inv_dist_gr.php" onSubmit="return validaMatriz()">
										<?php 
									  //$sql2 = "SELECT * FROM bode_orcom x WHERE  x.oc_estado=100 and x.oc_mas_id=$masid";
										$sql2 = "SELECT * FROM bode_orcom2 x WHERE  x.oc_estado=100 and x.oc_mas_id=$masid";
										//echo $sql2;
//										$sql2 = "SELECT * FROM acti_compra_temporal WHERE (estado = 0 or estado=1) ORDER by compra_id desc limit 0,20";
										$res2 = mysql_query($sql2);
										$colspan = mysql_num_rows($res2);
										?>
										<table border=1 width="100%">
											<tr>
												<td  class="Estilo2titulo" colspan="10">GUIAS EN TRANSITO</td>
											</tr>

											<tr>
												<td></td>
												<td  class="Estilo1mc" colspan="<?php echo $colspan ?>">JARDIN</td>
											</tr>

											<tr>
												<td></td>
												<td  class="Estilo1mc">PRODUCTO</td>

												<?

												$cont=1;
												while ($row2 = mysql_fetch_array($res2)) {
													$estilo=$cont%2;
													if ($estilo==0) {
														$estilo2="Estilo1mc";
													} else {
														$estilo2="Estilo1mcblanco";
													}

													?>

													<td  class="<? echo $estilo2 ?>">
														<div style="width: 10px; word-wrap: break-word; text-align: center">
															<? // echo $row2["oc_id"] ?>
															<? echo $row2["oc_region"] ?>
														</div>
													</td>

													<?
													$arrjandin[$cont]=$row2["oc_id"];
													$cont++;
												}
												?>
												<td class="Estilo1mc">Solicitado</td>
												<td class="Estilo1mc">Disponible</td>
												<td class="Estilo1mc">Estado</td>
											</tr>


											<?

											$sql2 = "SELECT * FROM  bode_detoc2 x WHERE  x.doc_mas_id = $masid order by doc_especificacion ";
                                         //echo $sql2."<br>";
//										$sql2 = "SELECT * FROM acti_compra_temporal WHERE (estado = 0 or estado=1) ORDER by compra_id desc limit 0,20";
											$res2 = mysql_query($sql2);
											$cont2=1;
											$col=0;
											while ($row2 = mysql_fetch_array($res2)) {
												$nuevo=$row2["doc_especificacion"];

												if ($nuevo<>$antiguo) {
													$col++;
													$cont2=1;
												}
												$arrid[$col][$cont2]=$row2["doc_id"];
                                          //$arrcantidad[$col][$cont2]=$row2["doc_cantidad"];
												//$arrcantidad[$col][$cont2]=$row2["doc_cantidad"];
												$antiguo=$row2["doc_especificacion"];

//                                          echo $arrid[$col][$cont2]." ".$arrcantidad[$col][$cont2]."--> $col -- $cont2<br>";
												$cont2++;
											}

											$sql2 = "SELECT * FROM  bode_detoc2 x inner join bode_detingreso y on y.ding_prod_id = x.doc_origen_id WHERE  x.doc_mas_id =$masid AND y.ding_recep_tecnica = 'A' /*group by x.doc_especificacion*/ ";
                                         //echo $sql2;
											$res2 = mysql_query($sql2);
											$cont3=1;
											$solicitado = 0;
											while ($row2 = mysql_fetch_array($res2)) {
												//$solicitado = $row2["doc_cantidad"] *  ($cont - 1);
												$estilo=$cont2%2;
												if ($estilo==0) {
													$estilo2="Estilo1mc";
												} else {
													$estilo2="Estilo1mcblanco";
												}

												?>
												<tr>
													<td></td>
													<td  class="<? echo $estilo2 ?>">
														<? // echo $row2["oc_id"] ?>
														<? echo $row2["doc_especificacion"] ?>
													</td>

													<?
													$erros = 0;
													for ($i=1;$i<$cont;$i++) {
														$solicitado += $arrcantidad[$cont3][$i];
														?>
														<td  class="<? echo $estilo2 ?>">
															<input type="hidden" name="arrid[<? echo $cont3 ?>][<? echo $i ?>]" size=6 value="<? echo $arrid[$cont3][$i] ?>">
															<input type="number" min="1" name="arrcantidad[<? echo $cont3//$row2["doc_cantidad"] ?>][<? echo $i ?>]" size=6 value="<? echo $_SESSION["arrCantidad"][$cont3][$i] ?>">
														</td>

														<?
//                                            		$arrjandin[$cont]=$row2["oc_id"];
														
													}

													$extra ="<td class='".$estilo2."'>".$solicitado."</td>";
													$extra .="<td class='".$estilo2."'>".$row2["ding_unidad"]."</td>";
													if($solicitado <= $row2["ding_unidad"])
													{
														$extra .="<td class='".$estilo2."'><i class='fa fa-check fa-lg'></i></td>";
													}else{
														$erros++;
														$extra .="<td class='".$estilo2."'><i class='fa fa-warning fa-lg'></i></td>";
													}
													echo $extra;
													$cont3++;
													
												}
												?>

											</tr>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><input type="submit" name="update" id="update" value="ACTUALIZAR"></td>
												<td colspan="<?php echo $colspan ?>" align="center"><input type="submit" value="GRABAR"></td>
											</tr>
										</table>
										<input type="hidden" name="masid" value="<? echo $masid ?>"  >
										<input type="hidden" name="col" value="<? echo $col ?>"  >
										<input type="hidden" name="cont2" value="<? echo $cont//$cont3 ?>"  >
										<input type="text" name="erros" id="erros" value="<?php echo $erros ?>">
									</form>
									<hr>
								</div>							

								<script type="text/javascript">
									function validaMatriz(){
										var erros = $("#erros").val();
										if(erros == 0)
										{
											if(confirm(("NO SE HAN ENCONTRADO ERRORES, ¿ PROSEGUIR ?"))
											{
												return true;
											}else{
												return false;
											}
										}else{
										return false;
									}
									}
								</script>