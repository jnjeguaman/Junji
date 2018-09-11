								<div id="seccion1" style="background-color:#E0F8E0;" >
									<table border=0 width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="10">TOMAS DE INVENTARIO</td>
										</tr>

										<tr>
											<td  class="Estilo1mc">NUMERO</td>
											<td  class="Estilo1mc">F.INVENTARIO</td>
											<td  class="Estilo1mc">TIPO</td>
											<td  class="Estilo1mc">Forma</td>
											<td  class="Estilo1mc">Cantidad</td>
											<td  class="Estilo1mc">VER</td>
											<td  class="Estilo1mc">ESTADO</td>

										</tr>

										<?
		                                $sql2 = "SELECT * FROM bode_inventario y WHERE y.inv_region = ".$_SESSION["region"] ;
//		                                $sql2 = "SELECT * FROM bode_orcom y WHERE y.oc_region2 = ".$_SESSION["region"]." and oc_swdespacho='1' and  oc_guiafecha='0000-00-00' ORDER by oc_id desc limit 0,200";
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

											?>
											<tr class="<? echo $estilo2 ?> trh">
												<td><? echo $row2["inv_id"] ?></td>
            									<td><? echo $row2["inv_fecha"] ?></td>
            									<td><? echo $row2["inv_descripcion"] ?></td>
            									<td><? echo $row2["inv_forma"] ?></td>
            									<td><? echo $row2["inv_cantidad"] ?></td>
												<td><a href="bode_inv_indexoc6.php?ori=1&inv_id=<? echo $row2["inv_id"] ?>&forma=<? echo $row2["inv_forma"] ?>&cod=<?php echo $cod ?>" class="link"><i class="fa fa-eye"></i></a></td>
												<td><i class="fa fa-warning fa-lg"></i></td>

											</tr>

											<?
											$cont++;
										}
										?>

									</table>
								</div>
