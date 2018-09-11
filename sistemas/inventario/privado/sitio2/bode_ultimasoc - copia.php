	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
								<div id="seccion1" style="background-color:#E0F8E0;" >
									<table border=0 width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="10">ULTIMAS ORDENES DE COMPRA</td>
										</tr>

										<tr>
											<td  class="Estilo1mc">ID<i class="fa fa-eye"></i></td>
											<td  class="Estilo1mc">Orden de Compra</td>
											<td  class="Estilo1mc">VER</td>
											<td  class="Estilo1mc">EDITAR</td>
											<td  class="Estilo1mc">ESTADO</td>

										</tr>

										<?
		                                $sql2 = "SELECT * FROM bode_orcom x WHERE x.oc_region = ".$_SESSION["region"]." or x.oc_id2 like '599%' and 0=( SELECT doc_estadocierre FROM bode_detoc y WHERE y.doc_estadocierre = 0 and x.oc_id=y.doc_oc_id group by x.oc_id)  ORDER by x.oc_id desc limit 0,200";
//                                         echo $sql2;
//										$sql2 = "SELECT * FROM acti_compra_temporal WHERE (estado = 0 or estado=1) ORDER by compra_id desc limit 0,20";
										$res2 = mysql_query($sql2);
										$cont=1;
										while ($row2 = mysql_fetch_array($res2)) {
											$estilo=$cont%2;
											if ($estilo==0) {
												$estilo2="Estilo1mc";
												if ($row2["soli_tipo"]=='Emergencias o Urgencias') {
													$estilo2="Estilo1mcRojo";
												}
											} else {
												$estilo2="Estilo1mcblanco";
												if ($row2["soli_tipo"]=='Emergencias o Urgencias') {
													$estilo2="Estilo1mcblancoRojo";
												}

											}

											$asterico="";
											if ($row2["soli_rut"]==2) {
												$asterico="*";
											}

											?>
											<tr>
												<td  class="<? echo $estilo2 ?>"><? echo $astericos ?> <? echo $row2["oc_id"] ?></td>
												<td  class="<? echo $estilo2 ?>"><? echo $row2["oc_id2"] ?></td>
												<td  class="<? echo $estilo2 ?>"><a href="bode_inv_indexoc2.php?ori=1&id=<? echo $row2["oc_id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
												<td  class="<? echo $estilo2 ?>"><a href="bode_inv_indexoc2.php?ori=2&id=<? echo $row2["oc_id"] ?>" class="link"><i class="fa fa-pencil-square"></i></a></td>
												<?php if (intval($row2["estado"]) === 1): ?>
													<td  class="<? echo $estilo2 ?>"><i class="fa fa-check fa-lg"></i></a></td>
												<?php else: ?>
													<td  class="<? echo $estilo2 ?>"><i class="fa fa-warning fa-lg"></i></td>
												<?php endif ?>
												
											</tr>

											<?
											$cont++;
										}
										?>

									</table>
								</div>
