								<div id="seccion1" style="background-color:#E0F8E0;" >
									<table border=0 width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="10">RECEPCIONES PENDIENTES</td>
										</tr>

										<tr>
											<td  class="Estilo1mc">ID</td>
											<td  class="Estilo1mc">F.ENTREGA</td>
											<td  class="Estilo1mc">N OC / GUIA </td>
											<td  class="Estilo1mc">ESPECIFICACION</td>
											<td  class="Estilo1mc">CANTIDAD</td>
											<td  class="Estilo1mc">STOCK</td>
											<td  class="Estilo1mc">RECIBIDO</td>
											<td  class="Estilo1mc">TEC</td>
											<td  class="Estilo1mc">RC</td>
											<td  class="Estilo1mc">ESTADO</td>

										</tr>

										<?
          
          
          
          
		                                $sql2 = "SELECT * FROM bode_detoc x, bode_orcom y WHERE x.doc_region = ".$_SESSION["region"]." and x.doc_oc_id=y.oc_id and doc_tecnicos>0  ORDER by doc_id desc limit 0,200";
//		                                $sql2 = "SELECT * FROM bode_orcom WHERE oc_region = ".$_SESSION["region"]." ORDER by oc_id desc limit 0,200";
                                         echo $sql2."<br>";
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
           
                                           $fechahoy = date('Y-m-d');;
                                           $dia1 = strtotime($fechahoy);
                                           $fechabase =$row2["oc_fecha"];
                                           $dia2 = strtotime($fechabase);
                                           $difff=$dia1-$dia2;
                                           $diff=intval($difff/(60*60*24))*-1;
                                           //echo " $plabode1>=$diff and $diff>$plabode2 ";
                                           $color="";
                                           if($plabode1>=$diff and $diff>$plabode2) {
                                              $color="#088A08";     //Verde
                                           }
                                           if($plabode2>=$diff and $diff>$plabode3) {
                                              $color="#2E2EFE";    //Azul
                                           }
                                           if($plabode3>=$diff ) {
                                              $color="#FE2E2E";     //Rojo
                                           }

                                            //echo $fechahoy."--".$fechabase." $diff <br>";
											?>
											<tr>
												<td  class="<? echo $estilo2 ?>"><font color="<? echo $color?>"> <? echo $row2["doc_id"] ?></font></td>
            									<td  class="<? echo $estilo2 ?>"><font color="<? echo $color?>"><? echo $diff." ".$row2["oc_fecha"] ?></font></td>
            									<td  class="<? echo $estilo2 ?>"><font color="<? echo $color?>"><? echo $row2["oc_id2"] ?></font></td>
												<td  class="<? echo $estilo2 ?>"><font color="<? echo $color?>"><? echo $row2["doc_especificacion"] ?></font></td>
            									<td  class="<? echo $estilo2 ?>"><? echo $row2["doc_cantidad"] ?></td>
            									<td  class="<? echo $estilo2 ?>"><? echo $row2["doc_stock"] ?></td>
            									<td  class="<? echo $estilo2 ?>">
                                                <?
                                                echo $row2["doc_recibidos"];
                                                ?>
                                                </td>
												<td  class="<? echo $estilo2 ?>">
                                                <? echo $row2["doc_tecnicos"] ?>
                                                <a href="bode_inv_indexoc5.php?ori=4&oc_id=<? echo $row2["doc_oc_id"] ?>&doc_id=<? echo $row2["doc_id"] ?>&total=<?php echo $row2["compra_cantidad"] ?>" class="link"><i class="fa fa-plus"></i></a>
                                                </td>
												<td  class="<? echo $estilo2 ?>">
                                                <? echo $row2["doc_final"] ?>
                                                </td>
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
