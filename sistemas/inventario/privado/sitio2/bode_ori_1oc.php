
<div  style="width:630px; background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">

	<?php 
	$sql2 = "SELECT * FROM bode_orcom WHERE oc_id = ".$_GET["id"];
	?>
	<?php $sql2Resp = mysql_query($sql2) ?>
	<?php $row = mysql_fetch_array($sql2Resp); ?>

	<form name="form2" action="inv_graba_datosunidad.php" method="post"   onSubmit="return validar2()"  enctype="multipart/form-data">
		<table border=0 width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">FICHA ORDEN DE COMPRA</td>
			</tr>
		</table>

		<table border=0 width="100%">
			<tr>
				<td  valign="center" class="Estilo1">GRUPO</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_grupo"] ?>">
				</td>

			</tr>




			<tr>
				<td  class="Estilo1">CANTIDAD TOTAL</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_cantidad"] ?>">
				</td>

				<td  class="Estilo1">MONTO TOTAL C / IVA</td>
				<td  class="Estilo1">
					<input type="text" name="total" id="total" class="Estilo2" size="8"  disabled value="<?php echo $row["oc_monto"] ?>">
				</td>

			</tr>

			<tr>
				<td  class="Estilo1">PROGRAMA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_prog"] ?>">

				</td>

				<td  class="Estilo1">TIPO CAMBIO</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="Pesos" size=8>



				</td>

			</tr>

			<tr>
				<td  class="Estilo1">PROVEEDOR RUT</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveerut"] ?>">-
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveedig"] ?>" size=1>

				</td>

				<td  class="Estilo1">UNIDAD DE MEDIDA</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_umedida"] ?>">
				</td>
			</tr>
			<tr>
				<td  class="Estilo1">PROVEEDOR NOMBRE</td>
				<td  class="Estilo1">
					<input type="text" class="Estilo2" disabled value="<?php echo $row["oc_proveenomb"] ?>" size=30>
				</td>
			</table>

			<table>
				<table border="0" width="100%">
					<tr>
						<td  valign="center" class="Estilo1">Region</td>
						<td  valign="center" class="Estilo1">Descripcion</td>
						<td  valign="center" class="Estilo1">Cant</td>

						<td  valign="center" class="Estilo1">Total</td>
					</tr>

					<form name="form1" action="inv_grabaindexoc2.php" method="post" onsubmit="return validaree()">
						<?
						$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$_GET["id"];
//echo $sql3;
						$res3 = mysql_query($sql3);
						$i=1;
						while ($row3 = mysql_fetch_array($res3)) {

							$doc_id=$row3["doc_id"];

							?>
							<tr>
								<td class="Estilo1" colspan=1>
									<input type="text" name="var[<? echo $i ?>]" class="Estilo2" size="15" disabled value="<? echo $row3["doc_region"]  ?>" >
								</td>

								<td class="Estilo1" colspan=1>
									<input type="text" name="var[<? echo $i ?>]" class="Estilo2" size="40"  disabled value="<? echo $row3["doc_especificacion"] ?>" >

								</td>
								<td class="Estilo1" colspan=1>
									<input type="text" name="var2[<? echo $i ?>]" class="Estilo2" size="5"  disabled value="<? echo number_format($row3["doc_cantidad"],0,',','.'); ?>" >
								</td>
								<td class="Estilo1" colspan=1>
									<input type="text" name="var3[<? echo $i ?>]" class="Estilo2" size="7" disabled value="<? echo number_format($row3["doc_valor_unit"],0,',','.'); ?>" >
								</td>
							</tr>
							<tr>
								<td class="Estilo1" colspan=4>

									<!--- Inicio de la recepcion tecnica   -->
									<table border="1"  width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="10">Recepcion Tecnica</td>
										</tr>
										<tr>
											<td class="Estilo2">Id Ing. </td>
											<td class="Estilo2">N° Guia </td>
											<td class="Estilo2">Cantidad </td>
											<td class="Estilo2">Nro. OC</td>
											<td class="Estilo2">Estado</td>
											<td class="Estilo2">Guia</td>
										</tr>
										<?

										$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and (x.ding_recep_tecnica = '0' or  x.ding_recep_tecnica = 'A')  and y.ing_oc_id=z.oc_id and (y.ing_estado = 1 OR y.ing_estado = 2)";
//		    $sql2 = "SELECT * FROM bode_ingreso x, bode_detoc, bode_orcom where ing_oc_id = $oc_id ";
//			echo $sql2;
										$res2 = mysql_query($sql2);
										$sw_color=0;
										while ($row2 = mysql_fetch_array($res2)) {

											$v_ing_id           = $row2['ing_id'];
											$v_ing_guia	        = $row2['ing_guia'];
											$v_ing_oc_id        = $row2['ing_oc_id'];
											$v_ing_fecha        = $row2['ing_fecha'];
											$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];

											$v_ding_cantidad          = ($row2['ding_cantidad']-$row2["ding_cant_rechazo"]);
											$v_ding_id          = $row2['ding_id'];


											$v_oc_id	            = $row2['oc_id'];
											$v_oc_id2	            = $row2['oc_id2'];
											$v_oc_region	        = $row2['oc_region'];
											$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
											$v_oc_prog_id	        = $row2['oc_prog_id'];
											$v_oc_fecha	            = $row2['oc_fecha'];
											$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
											$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
											$v_oc_proveerut	        = $row2['oc_proveerut'];
											$v_oc_proveedig         = $row2['oc_proveedig'];
											$v_oc_observaciones	    = $row2['oc_observaciones'];
											$v_oc_estado            = $row2['oc_estado'];

											$v_pro_rut              = $row2['pro_rut'];
											$v_pro_glosa            = $row2['pro_glosa'];

											if ($sw_color==0){
												$estilo2 = "Estilo1mc";
												$sw_color = 1;
											}else{
												$estilo2 = "Estilo1mcblanco";
												$sw_color = 0;
											}

											?>

											<tr>
												<td class="<? echo $estilo2 ?>"><? echo $v_ing_id       ?> </td>
												<td class="<? echo $estilo2 ?>"><? echo $v_ing_guia     ?> </td>
												<td class="<? echo $estilo2 ?>"><? echo $v_ding_cantidad    ?> </td>
												<td class="<? echo $estilo2 ?>"><? echo $v_oc_id2   ?> </td>
												<td class="<? echo $estilo2 ?>"><? echo $row2["ding_recep_tecnica"] ?> </td>
												<td class="<? echo $estilo2 ?>">
													<?php if($row2["ing_guianumerotc"] == 0): ?>
													<?php if($_SESSION["pfl_user"] <> 53  && $_SESSION["pfl_user"] <> 54): ?>
													<a href="bode_inv_indexoc2.php?ori=4&oc_id=<?php echo $v_ing_oc_id?>&ing_id=<?php echo $v_ing_id ?>"><font color="red"><i class="fa fa-warning fa-lg"></i></font></a>
												<?php endif ?>
											<?php else: ?>
											<?php echo $row2["ing_guianumerotc"] ?>
										<?php endif ?>
									</td>
								</tr>



								<? } ?>





							</table>


							<!--    Fin de la recepcion tecnica -->




						</td>

					</tr>
					<tr>
						<td class="Estilo1" colspan=4>
							<!--- Inicio de la recepcion conforme   -->

							<table border="1"  width="100%">
								<tr>
									<td  class="Estilo2titulo" colspan="10">Recepcion Conforme</td>
								</tr>
								<tr>
									<td class="Estilo2">Id Ing. </td>
									<td class="Estilo2">N° Guia </td>
									<td class="Estilo2">Cantidad </td>
									<td class="Estilo2">Nro. OC</td>
									<td class="Estilo2">Guia</td>
								</tr>
								<?

								$sql2 = "SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z where x.ding_prod_id = $doc_id and x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and (x.ding_userf='' or x.ding_userf<>'') and y.ing_estado = 1";
//		    $sql2 = "SELECT * FROM bode_ingreso x, bode_detoc, bode_orcom where ing_oc_id = $oc_id ";
//			echo $sql2;
								$res2 = mysql_query($sql2);
								$sw_color=0;
								while ($row2 = mysql_fetch_array($res2)) {

									$v_ing_id           = $row2['ing_id'];
									$v_ing_guia	        = $row2['ing_guia'];
									$v_ing_oc_id        = $row2['ing_oc_id'];
									$v_ing_fecha        = $row2['ing_fecha'];
									$v_ing_recib_usu_id = $row2['ing_recib_usu_id'];

									$v_ding_cantidad          = ($row2['ding_cantidad']-$row2["ding_cant_rechazo"]);
									$v_ding_id          = $row2['ding_id'];


									$v_oc_id	            = $row2['oc_id'];
									$v_oc_id2	            = $row2['oc_id2'];
									$v_oc_region	        = $row2['oc_region'];
									$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
									$v_oc_prog_id	        = $row2['oc_prog_id'];
									$v_oc_fecha	            = $row2['oc_fecha'];
									$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
									$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
									$v_oc_proveerut	        = $row2['oc_proveerut'];
									$v_oc_proveedig         = $row2['oc_proveedig'];
									$v_oc_observaciones	    = $row2['oc_observaciones'];
									$v_oc_estado            = $row2['oc_estado'];

									$v_pro_rut              = $row2['pro_rut'];
									$v_pro_glosa            = $row2['pro_glosa'];

									if ($sw_color==0){
										$estilo2 = "Estilo1mc";
										$sw_color = 1;
									}else{
										$estilo2 = "Estilo1mcblanco";
										$sw_color = 0;
									}

									?>

									<tr>
										<td class="<? echo $estilo2 ?>"><? echo $v_ing_id       ?> </td>
										<td class="<? echo $estilo2 ?>"><? echo $v_ing_guia     ?> </td>
										<td class="<? echo $estilo2 ?>"><? echo $v_ding_cantidad    ?> </td>
										<td class="<? echo $estilo2 ?>"><? echo $v_oc_id2   ?> </td>
										<td class="<? echo $estilo2 ?>">
											<?php if($row2["ing_guianumerorc"] == 0): ?>
											<?php if($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54): ?>
											<a href="bode_inv_indexoc2.php?ori=6&doc_id=<?php echo $row3["doc_id"]?>"><font color="red"><i class="fa fa-warning fa-lg"></i></font></a>
										<?php endif ?>
									<?php else: ?>
									<?php echo $row2["ing_guianumerorc"] ?>
								<?php endif ?>
							</td>
						</tr>



						<? } ?>





					</table>


					<!-- Fin recepcion conforme  -->
				</td>
			</tr>
			<?

			$i++;
		}

		?>



	</table>

<hr>
<?php $gdint = mysql_query("SELECT * FROM bode_orcom a WHERE a.oc_tipo_guia = 4 AND a.oc_id2 = ".$_GET["id"]) ?>
<table border="1" width="100%">
<tr>
<td class="Estilo2titulo" colspan="6">G/D INTERNO</td>
</tr>

<tr>
<td class="Estilo1">ID</td>
<td class="Estilo1">FECHA INGRESO</td>
<td class="Estilo1">ABASTECE</td>
<td class="Estilo1">EMISOR</td>
<td class="Estilo1">DESTINATARIO</td>
<td class="Estilo1">VER</td>
</tr>

<?php while($gd = mysql_fetch_array($gdint)){ ?>
<tr>
<td class="Estilo1mc"><?php echo $gd["oc_id"] ?></td>
<td class="Estilo1mc"><?php echo $gd["oc_fecha"] ?></td>
<td class="Estilo1mc"><?php echo $gd["oc_guiaabaste"] ?></td>
<td class="Estilo1mc"><?php echo $gd["oc_usu"] ?></td>
<td class="Estilo1mc"><?php echo $gd["oc_guiadestina"] ?></td>
<td class="Estilo1mc"><a href="bode_guia_despacho.php?ori=4&id=<?php echo $gd["oc_id"] ?>" target="_blank"> VER </a></td>
</tr>
<?php } ?>	
</table>
<!--

								<table border=0 width="100%">
									<tr>
										<td  class="Estilo1c">
											<input type="submit" name="submit" class="Estilo2" size="11" value="    Grabar    " >
										</td>
									</tr>
								</table>
							-->

						</form>
					</div>

