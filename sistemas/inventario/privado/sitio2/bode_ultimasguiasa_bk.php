									<table border=0 width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="10">DESPACHO MASIVO</td>
										</tr>

										<tr>
											<td  class="Estilo1mc">ID</td>
											<td  class="Estilo1mc">FECHA DESPACHO</td>
											<td  class="Estilo1mc">NOMBRE DISTRIBUCION</td>
											<td  class="Estilo1mc">SECTOR</td>
											<td  class="Estilo1mc">AGREGAR</td>
											<!--<td  class="Estilo1mc">VER</td>!-->
											<td  class="Estilo1mc">ESTADO</td>
											<td class="Estilo1mc">ADJUNTO</td>

										</tr>

										<?
										// $sql2 = "SELECT * FROM bode_masiva y WHERE y.mas_region = ".$_SESSION["region"]." and (mas_estado='1' OR mas_estado = 0) "; OK
										$sql2 = "SELECT * FROM bode_masiva WHERE mas_region = ".$_SESSION["region"]." AND (mas_estado = 1 OR mas_publico = 0) AND mas_visible = 1";
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
											<tr class="<?php echo $estilo2 ?> trh">
												<td><? echo $astericos ?> <? echo $row2["mas_id"] ?></td>
												<td><? echo $row2["mas_fecha"] ?></td>
												<td><? echo $row2["mas_nombre"] ?></td>
												<td><? echo $row2["mas_sector"] ?></td>
												<td>
													<?php if ($row2["mas_estado"] == 0): ?>
													<i class="fa fa-check link fa-lg"></i>
												<?php else: ?>
												<a href="bode_inv_indexguia3.php?ori=3&masid=<? echo $row2["mas_id"] ?>&id2=<? echo  $row2["doc_id"] ?>&total=<?php echo $row2["compra_cantidad"] ?>" class="link"><i class="fa fa-plus"></i></a>
											<?php endif ?>
										</td>
												<!--<td>
												<?php if ($row2["mas_estado"] == 0): ?>
												<a href="bode_inv_indexguia3.php?ori=2&masid=<? echo $row2["mas_id"] ?>" class="link"><i class="fa fa-eye"></i></a>
											<?php else: ?>
											<i class="fa fa-warning link fa-lg"></i>
										<?php endif ?>
									</td>!-->
									<td>
										<!-- SI ESTA INCOMPLETO !-->
										<?php if ($row2["mas_estado"] == 1): ?>
										<i class="fa fa-warning link fa-lg"></i>

										<!-- SI ESTA COMPLETO Y PUBLICADO !-->
									<?php elseif($row2["mas_estado"] == 0 && $row2["mas_publico"] == 1): ?>
									<i class="fa fa-check link fa-lg"></i>
								<?php else: ?>
								<a href="bode_mas_gr2.php?masid=<?php echo $row2["mas_id"] ?>" title='CARGAR MASIVAMENTE LAS GUIAS DE DESPACHO' onClick="return confirma()"><i class="fa fa-cloud-upload fa-lg link"></i></a>
							<?php endif ?>
						</td>

						<td>
						<?php if($row2["mas_archivo"] <> "" AND $row2["mas_ruta"] <> ""): ?>
							<a href="../../../<?php echo $row2["mas_ruta"].$row2["mas_archivo"] ?>" target="_blank"><i class="fa fa-cloud-download fa-lg link"></i></a>
						<?php else: ?>
						NO TIENE ADJUNTO
						<?php endif ?>
						</td>
					</tr>

					<?
					$cont++;
				}
				?>

			</table>
			<hr>
			
			
			<table border=0 width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">MATRICES COMPLETADAS</td>
				</tr>	

				<tr>
					<td  class="Estilo1mc">ID</td>
					<td  class="Estilo1mc">FECHA DESPACHO</td>
					<td  class="Estilo1mc">NOMBRE DISTRIBUCION</td>
					<td  class="Estilo1mc">SECTOR</td>
					<td  class="Estilo1mc">AGREGAR</td>
					<!--<td  class="Estilo1mc">VER</td>!-->
					<td  class="Estilo1mc">ESTADO</td>
					<td class="Estilo1mc">ADJUNTO</td>
				</tr>
				
				<?php
					$completadas = "SELECT * FROM bode_masiva WHERE mas_region = ".$_SESSION["region"]." AND mas_estado = 0 AND mas_publico = 1 ORDER BY mas_id DESC";
					$resCompletadas = mysql_query($completadas);
					$cont=1;
					while($rowc = mysql_fetch_array($resCompletadas)) {
						$estilo=$cont%2;
											if ($estilo==0) {
												$estilo2="Estilo1mc";
											} else {
												$estilo2="Estilo1mcblanco";
											}
				?>
				<tr class="<?php echo $estilo2 ?> trh">
												<td><? echo $astericos ?> <? echo $rowc["mas_id"] ?></td>
												<td><? echo $rowc["mas_fecha"] ?></td>
												<td><? echo $rowc["mas_nombre"] ?></td>
												<td><? echo $rowc["mas_sector"] ?></td>
												<td><i class="link fa-lg fa fa-check"></i></td>
												<td><i class="link fa-lg fa fa-check"></i></td>
												<td>
						<?php if($rowc["mas_archivo"] <> "" AND $rowc["mas_ruta"] <> ""): ?>
							<a href="../../../<?php echo $rowc["mas_ruta"].$rowc["mas_archivo"] ?>" target="_blank"><i class="fa fa-cloud-download fa-lg link"></i></a>
						<?php else: ?>
						NO TIENE ADJUNTO
						<?php endif ?>
						</td>
</tr>												
				<?php $cont++;} ?>

				</table>
				<hr>

<script type="text/javascript">
	function confirma()
	{
		if(confirm('¿ DESEA PUBLICAR ESTA CARGA MASIVA ?'))
		{
			blockUI();
			return true;
		}else{
			return false;
		}
	}
</script>