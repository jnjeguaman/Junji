								<?php  $background = "style='background:lightgreen;'"; 

								if (!isset($_GET['id'])) {
									$id="";
								}

								?>
								<div id="seccion1" style="background-color:#E0F8E0;" >
								<form action="bode_inv_indexoc3.php?ori=6" method="POST" onSubmit="return modificar()">
									<table border="0" width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="12">DESPACHO</td>
										</tr>

										<tr>
											<td></td>
											<td class="Estilo1mc">ID</td>
											<td class="Estilo1mc">N° GUIA </td>
											<td class="Estilo1mc">N° SOLICITUD</td>
											<td class="Estilo1mc">F.DESPACHO</td>
											<td class="Estilo1mc">DESTINO</td>
											<td class="Estilo1mc">MATRIZ</td>
											<td class="Estilo1mc">F. CREACION</td>
											<td class="Estilo1mc">AGREGAR</td>
											<td class="Estilo1mc">VER</td>
											<td class="Estilo1mc">ESTADO</td>
											<td class="Estilo1mc">ELIMINAR</td>

										</tr>

										<?
		                                $sql2 = "SELECT * FROM bode_orcom y WHERE y.oc_region2 = ".$_SESSION["region"]." and oc_swdespacho='1' and  oc_guiafecha='0000-00-00' ORDER by oc_id desc limit 0,200";
//		                                $sql2 = "SELECT * FROM bode_orcom WHERE oc_region = ".$_SESSION["region"]." ORDER by oc_id desc limit 0,200";
//                                         echo $sql2;
//										$sql2 = "SELECT * FROM acti_compra_temporal WHERE (estado = 0 or estado=1) ORDER by compra_id desc limit 0,20";
										$res2 = mysql_query($sql2);
										$cont=1;
										while ($row2 = mysql_fetch_array($res2)) {
											$estilo=$cont%2;
											if ($estilo==0) {
												$estilo2="Estilo1mc";
											} else {
												$estilo2="Estilo1mcblanco";
											}

											if($row2["oc_mas_id"] <> "")
											{
												$matriz = mysql_query("SELECT * FROM bode_masiva WHERE mas_id = ".$row2["oc_mas_id"]);
												$matriz = mysql_fetch_array($matriz);
											}

											// COMPROBAMOS SI TIENE ASOCIADA UNA NOTA DE PEDIDO
											if($row2["oc_sp_id"] <> "")
											{
												$sql3 = "SELECT * FROM bode_solicitud WHERE sp_id = ".$row2["oc_sp_id"];
												$res3 = mysql_query($sql3);
												$row3 = mysql_fetch_array($res3);
											}
											?>
											<tr class="trh <? echo $estilo2 ?>" <?php if($row2["oc_id"] === $id){echo $background;} ?>>
												<td><input type="checkbox" name="var1[<?php echo $cont ?>]" value="<?php echo $row2["oc_id"]?>"></td>
												<input type="hidden" name="var2[<?php echo $cont ?>]" value="<?php echo $row2["oc_region"]?>">
												<input type="hidden" name="var3[<?php echo $cont ?>]" value="<?php echo $row2["oc_fecha"]?>">
												<td><? echo $row2["oc_id"] ?></td>
            									<td><? echo $row2["oc_id2"] ?></td>
            									<td><? echo ($row2["oc_sp_id"] == "") ? "S/N" : $row3["sp_folio"] ?></td>
            									<td><? echo $row2["oc_fecha"] ?></td>
            									<td><? echo $row2["oc_region"] ?></td>
            									<td><? echo ($matriz["mas_nombre"] <> "") ? $matriz["mas_nombre"]." - ".$matriz["mas_sector"] : "NO TIENE MATRIZ ASOCIADA" ?></td>
												<td><? echo $row2["oc_fecha_recep"] ?></td>
												<td>
													<?php if($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54):?>
													<a href="bode_inv_indexoc3.php?ori=3&id=<? echo $row2["oc_id"] ?>&oc_sp_id=<?php echo $row2["oc_sp_id"] ?>&oc_wms=<?php echo $row2["oc_wms"] ?>" class="link"><i class="fa fa-plus"></i></a>
													<?php endif ?>
												</td>
												<td>
													<?php if($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54): ?>
													<a href="bode_inv_indexoc2.php?ori=4&oc_id=<? echo $row2["oc_id"] ?>&oc_sp_id=<?php echo $row2["oc_sp_id"] ?>" class="link"><i class="fa fa-eye"></i></a>
													<?php endif ?>
												</td>
												<?php if (intval($row2["oc_estado"]) === 1): ?>
													<td  ><i class="fa fa-check fa-lg"></i></a></td>
												<?php else: ?>
													<td  ><i class="fa fa-warning fa-lg"></i></td>
												<?php endif ?>
												<?php if ($row2["oc_sp_id"] == ""): ?>
												<td><a href="bode_eliminar_guia.php?id=<?php echo $row2["oc_id"] ?>" onclick="return confirm('DESEA ELIMINAR LA GUIA N° <?php echo $row2["oc_id"] ?>')"><i class="fa fa-trash fa-lg link"></i></a></td>
												<?php endif ?>
												
											</tr>

											<?
											$cont++;
										}
										?>
										<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="Estilo1mc" colspan="4">
											<?php if ($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54): ?>
												<button type="submit">Modificar <i class="fa fa-pencil"></i></button>
											<?php endif ?>
										</td>
										</tr>
									</table>
									<input type="hidden" name="totalLineas" value="<?php echo ($cont-1) ?>">
									</form>
								</div>

								<script type="text/javascript">
									
									function modificar()
									{
										var numberOfChecked = $('input:checkbox:checked').length;
										var numerOnLine = "<?php echo ($cont-1) ?>";
										if(numberOfChecked == 0)
										{
											alert("DEBE SELECCIONAR ALMENOS 1 GUÍA A MODIFICAR")
											return false;
										}else{
											if(confirm("¿ ESTÁ SEGURO DE PROCEDER ?"))
											{
												return true;
											}else{
												return false;
											}
										}
									}
								</script>
