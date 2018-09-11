								<div id="seccion1" style="background-color:#E0F8E0;" >
									<table border="0" width="100%">
										<tr>
											<td class="Estilo2titulo" colspan="10">ULTIMAS COMPRAS INGRESADAS</td>
										</tr>

										<tr>
											<td class="Estilo1mc">ID</td>
											<td class="Estilo1mc">O/C</td>
											<td class="Estilo1mc">GLOSA</td>
											<td class="Estilo1mc">CANTIDAD</td>
											<td class="Estilo1mc">ITEM</td>
											<td class="Estilo1mc">COSTO TOTAL</td>
											<td class="Estilo1mc">VER</td>
											<td class="Estilo1mc">DISTRIBUIR</td>
											<td class="Estilo1mc">ESTADO</td>
											<td class="Estilo1mc">ELIMINAR</td>
										</tr>

										<?
										if($atributo === 23)
										{
											$sql2 = "SELECT * FROM acti_compra_temporal WHERE compra_region_id = ".$_SESSION["region"]." AND compra_visible = 1 ORDER by compra_id";
										}else{
											$sql2 = "SELECT * FROM acti_compra_temporal WHERE compra_region_id = ".$_SESSION["region"]." AND compra_visible = 1 AND compra_estado = 0 ORDER BY compra_id ASC LIMIT 50";
										}
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

											
											$background = "style='background:lightgreen;'";
											?>
											<tr class="<?php echo $estilo2 ?> trh" <?php if($row2["id"] === $id){echo $background;} ?>>
												<td ><? echo $row2["compra_id"] ?></td>
												<td ><? echo $row2["oc_numero"] ?></td>
												<td ><? echo $row2["compra_glosa"] ?></td>
												<td ><? echo $row2["compra_cantidad"] ?></td>
												<td ><? echo $row2["compra_item"] ?></td>
												<td >$<? echo number_format($row2["compra_monto"],0,".",".") ?></td>
												<?php if (intval($row2["compra_estado"]) === 1): ?>
													<td><a href="inv_nc.php?ori=1&id=<? echo $row2["id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
													<td></td>
													<td><i class="fa fa-check fa-lg"></i></td>
													<td></td>
													<td></td>
												<?php else: ?>
													<td ><a href="inv_nc.php?ori=1&id=<? echo $row2["id"] ?>" class="link"><i class="fa fa-eye"></i></a></td>
													<?php if ($atributo != 23): ?>
														<td><a href="inv_nc.php?ori=3&id=<? echo $row2["id"] ?>&total=<?php echo $row2["compra_cantidad"] ?>" class="link"><i class="fa fa-plus"></i></a></td>
													<?php else: ?> 
														<td ></td>
													<?php endif ?>
													<td><i class="fa fa-warning fa-lg"></i></td>
													<?php if ($atributo != 23): ?>
														<td><a href="#" onClick="return eliminarCompra(<?php echo $row2["id"] ?>)"><i class="fa fa-trash fa-lg link"></i></a></td>
													<?php else: ?> 
														<td>
															<?php if($row2["compra_estado"] == 0): ?>
																ELIMINADO
															<?php else:?>

															<?php endif ?>
														</td>
													<?php endif ?>
												<?php endif ?>
											</tr>
											<?
											$cont++;
										}
										?>
									</table>
								</div>

								<script type="text/javascript">

									function eliminarCompra(input){

										if(confirm("¿ESTÁ SEGURO DE ELIMINAR EL REGISTRO?"))
										{
											var data = ({cmd : "eliminarCompra", compra_id : input});

											$.ajax({
												type:"POST",
												url:"inv_eliminarcompra.php",
												data:data,
												dataType:"JSON",
												success : function ( response ) {
													if(response == true) {
														alert("REGISTRO ELIMINADO");
														window.location.reload();
													}
												}
											})
											
										}else{
											return false;
										}
										/**/
									}

								</script>