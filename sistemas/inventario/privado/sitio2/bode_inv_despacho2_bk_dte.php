<style type="text/css">
	.active > a {
		color:white;
	}
	.active{
		background-color: #c3c3c3;
		border-radius: 10px;
	}

	.pagination {
		margin: auto auto;
	}

	.pagination > li {
		display: inline-block;
		padding: 5px;
		font-size: 10px;
		font-weight: bold;
		text-align: center;
		font-family: sans-serif;
	}

	.pagination > li > a{
		color: black;
	}

</style>
<div  style="height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:810px;width: 930px" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >
		<!-- Recupera la ORDEN DE COMPRA SELECCIONADA Y LA MUESTRA 		-->
		<?
		if($_SESSION["region"] == 16)
		{
			$region = "(d.doc_region = 16 OR d.doc_region = 13)";
		}else{
			$region = "d.doc_region = ".$_SESSION["region"];
		}

		$ori=$_GET["ori"];
		$sql2 = "SELECT * FROM bode_orcom where  oc_id = '$id'";
		//echo $sql2;
//		    $sql2 = "SELECT * FROM bode_orcom,bode_proveedor where oc_pro_id = pro_id and oc_id = '$id_oc'";
//            echo $sql2;
		$res2 = mysql_query($sql2);
		$sw_color=0;
		$oc_id=$id;
		$row2 = mysql_fetch_array($res2);
		$v_oc_id	            = $row2['oc_id'];
		$v_oc_id2	            = $row2['oc_id2'];
		$v_oc_region	        = $row2['oc_region'];
		$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
		$v_oc_prog_id	        = $row2['oc_prog_id'];
		$v_oc_fecha	            = $row2['oc_fecha'];
		$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
		$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
		$v_oc_pro_id	        = $row2['oc_pro_id'];
		$v_oc_observaciones	    = $row2['oc_obs'];
		$v_oc_estado            = $row2['oc_estado'];

		$v_pro_rut              = $row2['oc_proveerut'];
		$v_pro_glosa            = $row2['pro_glosa'];

		$v_oc_mas_id = $row2["oc_mas_id"];
		$v_oc_folioguia = $row2["oc_folioguia"];
		$v_oc_tipoguia = $row2["oc_tipo_guia"];

		$v_oc_region_destino = $row2["oc_region_destino"];

		//     echo $v_oc_region;
		?>

		<form name="f1" method="POST" action="bode_inv_indexoc3.php?ori=<?php echo $ori ?>&id=<?php echo $id?>" onSubmit="blockUI();">
			<table border="0"  width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">AGREGAR PRODUCTOS A GUIA DE DESPACHO</td>
				</tr>
				<tr>
					<td class="Estilo1c">Buscar Guia [OC] </td>
					<td class="Estilo2">  <input type="text" name="numoc" size="20" value="<? echo $numoc ?>"> </td>
				</tr>

				<tr>
					<td class="Estilo1c">Especificacion </td>
					<td class="Estilo2">  <input type="text" name="especificacion" size="20" value="<?php echo $especificacion ?>"> </td>
				</tr>

				<tr>
					<td class="Estilo1c">Grupo</td>
					<td class="Estilo2">
						<select name="grupo" id="grupo" class="Estilo2">
							<option  value="" selected>Seleccionar...</option>
							<?php foreach ($grupos as $key => $value): ?>
								<option value="<?php echo $value["param_glosa"] ?>" <?php if($grupo == $value["param_desc"]){echo"selected";} ?>><?php echo $value["param_desc"] ?></option>
							<?php endforeach ?>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1c">Ubicacion</td>
					<td class="Estilo2">
						<?php if ($_SESSION["region"] == 16 || $_SESSION["region"] == 2): ?>
							<select name="ubicacion" id="ubicacion" class="Estilo2">
								<option value="" selected>Seleccionar</option>
								<?php 
								$ubi = mysql_query("SELECT * FROM bode_ubicacion WHERE ubi_estado = 1 AND ubi_region = ".$regionsession." ORDER BY ubi_glosa ASC");
								while($rubi = mysql_fetch_array($ubi)) {
									?>
									<option value="<?php echo $rubi["ubi_glosa"] ?>" <?php if($ubicacion == $rubi["ubi_glosa"]){echo"selected";} ?>><?php echo $rubi["ubi_glosa"] ?></option>
									<?php } ?>
								</select>
							<?php else: ?>
								<input type="text" name="ubicacion" id="ubicacion" class="Estilo2">
							<?php endif ?>
						</td>
					</tr>

					<tr>
						<td class="Estilo1c">Tipo </td>
						<td class="Estilo2">
							<input type="radio" name="tipo" value="Inventariable" <?php if($tipo == "Inventariable"){echo "checked";} ?> onClick="this.form.submit()">INVENTARIABLE
							<input type="radio" name="tipo" value="Existencia" <?php if($tipo == "Existencia"){echo "checked";} ?> onClick="this.form.submit()">EXISTENCIA
						</td>
					</tr>

					<tr>
						<td class="Estilo2" colspan="2">
							<center><input type="submit" value="Buscar" size=10></center>
						</td>
					</tr>

				</table>
				<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
				<input type="hidden" name="ori" value="<? echo $ori ?>"  >
				<input type="hidden" name="id" value="<? echo $id ?>"  >
				<input type="hidden" name="enviar" value="1">
			</form>

			<hr>

			<!-- COMIENZO DEL FORMULARIO -->

			<?php if($enviar) : ?>
				<form name="f1" method="POST" action="bode_inv_despachos_gr.php" onSubmit="return valida()">
					<table border="0"  width="100%">
						<tr>
							<td  class="Estilo2titulo" colspan="10">RESULTADOS DE LA BUSQUEDA</td>
						</tr>
					</table>
					<br>
					<table border="0" width="100%">
						<tr>
							<td class="Estilo2" colspan=6>  <input type="submit" value="Agrega Productos a la Guia" size=10> </td>
						</tr>

						<tr>
							<td  valign="center" class="Estilo1"></td>
							<td  valign="center" class="Estilo1">Cantidad</td>
							<td  valign="center" class="Estilo1">Descripcion</td>
							<?php if ($regionsession == 16 || $regionsession == 13): ?>
								<td class="Estilo1">Región</td>
							<?php endif ?>
							<?php if ($numoc == ""): ?>
								<td class="Estilo1">Orden de Compra</td>
							<?php endif ?>
							<td  valign="center" class="Estilo1">Stock</td>
							<td  valign="center" class="Estilo1">Precio</td>
							<td  valign="center" class="Estilo1">Ubicacion</td>

						</tr>
<!--
												<form name="form1" action="inv_grabaindexoc2.php" method="post" onsubmit="return validaree()">
												-->
												<?
												$limite = 50; //CANTIDAD MAXIMA DE RESULTADOS POR PAGIMA
												if ($numoc<>'') {
													$where.=" (b.oc_id2 like  '%$numoc%' OR b.oc_folioguia LIKE '%$numoc%') and ";
												}
												if ($especificacion<>'') {
													$where.=" d.doc_especificacion like  '%$especificacion%' and ";
													// $where." MATCH(d.doc_especificacion) AGAINST ('".$especificacion."') AND ";
												}
												if($grupo <> "")
												{
													$where.="b.oc_grupo LIKE '%".$grupo."%' AND";
												}

												if($ubicacion <> "")
												{
													$where.="c.ding_ubicacion LIKE '%".$ubicacion."%' AND";
												}

												if($tipo=="Inventariable")
												{
													$sql3 = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id /*INNER JOIN acti_inventario e ON e.inv_oc = b.oc_id2*/ WHERE $where c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C' AND ".$region." AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND c.ding_unidad > 0 AND d.doc_estado <> 'B' AND c.ding_clasificacion = '1' AND b.oc_estado = 1 AND (a.ing_estado = 1 OR a.ing_estado = 3) AND a.ing_aprobado <> '' AND a.ing_clasificacion = 1 ORDER BY c.ding_id DESC";
													// $sql3="SELECT * FROM bode_ingreso a INNER JOIN bode_detingreso b ON b.ding_ing_id = a.ing_id INNER JOIN acti_inventario c ON c.inv_doc_id = b.ding_prod_id INNER JOIN bode_detoc d ON d.doc_id = b.ding_prod_id WHERE $where1 $where2 GROUP BY b.ding_id";
													// echo $sql3;
												}else{
												//$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE $where1 $where2  x.oc_id=y.doc_oc_id and y.doc_stock>0 and y.doc_region='$regionsession'; ";
												//OK $sql3 = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON a.doc_oc_id = b.oc_id INNER JOIN bode_detingreso c ON c.ding_prod_id = a.doc_id WHERE  $where1 $where2 a.doc_stock > 0 LIMIT 20";
													$sql3 = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE $where c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C' AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND ".$region." AND c.ding_unidad > 0 AND d.doc_estado <> 'B' AND c.ding_clasificacion = '0' AND b.oc_estado = 1 AND (a.ing_estado = 1 OR a.ing_estado = 3) AND a.ing_aprobado <> '' AND a.ing_clasificacion = 1 ORDER BY c.ding_id DESC";
												}
												// echo $sql3;

												//PAGINACION
												if($page <> "")
												{
													$page = $page;
												}else{
													$page = 1;
												}
												

												$i=0;
												$res3 = mysql_query($sql3);

												$numRows = mysql_num_rows($res3);
												$start = ($page -1 ) * $limite;
												$paginas = ceil($numRows / $limite);

												if($tipo=="Inventariable")
												{
													$sql3 = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id /*INNER JOIN acti_inventario e ON e.inv_oc = b.oc_id2*/ WHERE $where c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C' AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND ".$region." AND c.ding_unidad > 0 AND d.doc_estado <> 'B' AND c.ding_clasificacion = '1' AND b.oc_estado = 1 AND (a.ing_estado = 1 OR a.ing_estado = 3) AND a.ing_aprobado <> ' AND a.ing_clasificacion = 1 ' ORDER BY c.ding_id DESC limit $start,$limite";
													// $sql3="SELECT * FROM bode_ingreso a INNER JOIN bode_detingreso b ON b.ding_ing_id = a.ing_id INNER JOIN acti_inventario c ON c.inv_doc_id = b.ding_prod_id INNER JOIN bode_detoc d ON d.doc_id = b.ding_prod_id WHERE $where1 $where2 GROUP BY b.ding_id";
													// echo $sql3;
												}else{
												//$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE $where1 $where2  x.oc_id=y.doc_oc_id and y.doc_stock>0 and y.doc_region='$regionsession'; ";
												//OK $sql3 = "SELECT * FROM bode_detoc a INNER JOIN bode_orcom b ON a.doc_oc_id = b.oc_id INNER JOIN bode_detingreso c ON c.ding_prod_id = a.doc_id WHERE  $where1 $where2 a.doc_stock > 0 LIMIT 20";
													$sql3 = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE $where c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C' AND (b.oc_tipo = 0 OR b.oc_tipo = 1) AND ".$region." AND c.ding_unidad > 0 AND d.doc_estado <> 'B' AND c.ding_clasificacion = '0' AND b.oc_estado = 1 AND (a.ing_estado = 1 OR a.ing_estado = 3) AND a.ing_aprobado <> '' AND a.ing_clasificacion = 1  ORDER BY c.ding_id DESC limit $start,$limite";
												}
												// echo $sql3;
												if($enviar == 1){
													$res4 = mysql_query($sql3);
													while ($row3 = mysql_fetch_array($res4)) {

														?>
														<?php  $stock = $row3["ding_unidad"]?>

														<tr>

															<td class="Estilo1">
																<input type="checkbox" name="var1[<? echo $i ?>]" id="var1_<?php echo $i ?>" class="Estilo2" size="40"  value="<? echo $row3["ding_id"] ?>" onClick="setPropiedad(<?php echo $i ?>)">
															</td>

															<td class="Estilo1">
																<!--<input type="text" name="var2[<? echo $i ?>]" class="Estilo2" size="6"  value="" >!-->
																<input type="number" name="var2[<? echo $i ?>]" id="var2_<?php echo $i?>" class="Estilo2" size="6" min="1" max="<?php echo $stock ?>"/>
															</td>
															<td class="Estilo1">
																<input type="text" name="var3b[<? echo $i ?>]" class="Estilo2" size="80"  disabled value="<? echo $row3["doc_especificacion"] ?>" >
																<input type="hidden" name="var3[<? echo $i ?>]" class="Estilo2" size="80"   value="<? echo $row3["doc_especificacion"] ?>" >
															</td>
															<?php if ($regionsession == 16 || $regionsession == 13): ?>
																<td class="Estilo1"><?php echo $row3["doc_region"] ?></td>
															<?php endif ?>
															<?php if ($numoc == ""): ?>
																<td class="Estilo1"><?php echo $row3["doc_numerooc"] ?></td>
															<?php endif ?>

															<td class="Estilo1">
																<input type="text" name="var4b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($stock,0,',','.'); ?>" >
																<input type="hidden" name="var4[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["ding_cantidad"]; ?>" >
															</td>
															<td class="Estilo1">
																<input type="text" name="var5b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="$<? echo number_format($row3["doc_conversion"] / $row3["doc_factor"],0,',','.'); ?>" >
																<input type="hidden" name="var5[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["doc_conversion"]/$row3["doc_factor"]; ?>" >
																<input type="hidden" name="var6[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["doc_numerooc"]; ?>" >
															</td>
															<td class="Estilo1">
																<input type="text" size="10" disabled value="<?php echo $row3["ding_ubicacion"] ?>">
																<a href="#" class="link" onclick='window.open("bode_listaubicacion.php?id=<? echo $row3["doc_id"] ?>","miwin","width=500,height=500,scrollbars=yes,toolbar=0")'><i class="fa fa-eye"></i></a>
															</td>
														</tr>
														<?

														$i=$i+1;
													}

												/*
													numoc
													especificacion
													grupo
													ubicacion
													tipo
												*/

													echo "<tr><td colspan='6'>";
													$paginator ="<ul class='pagination pull-right'>";
													$paginator .="<li><a href='bode_inv_indexoc3.php?ori=".$ori."&id=".$id."&page=1&numoc=".$numoc."&especificacion=".$especificacion."&grupo=".$grupo."&ubicacion=".$ubicacion."&tipo=".$tipo."&enviar=1'><i class='fa fa-angle-double-left'></i></a></li>";

													if($page - 1 == 0)
													{
													}else if($page - 1 < 1){
														$paginator .="<li><a href='bode_inv_indexoc3.php?ori=".$ori."&id=".$id."&page=".($page-1)."&numoc=".$numoc."&especificacion=".$especificacion."&grupo=".$grupo."&ubicacion=".$ubicacion."&tipo=".$tipo."&enviar=1'><i class='fa fa-angle-left'></i></a></li>";
													}else{
														$paginator .="<li><a href='bode_inv_indexoc3.php?ori=".$ori."&id=".$id."&page=".($page-1)."&numoc=".$numoc."&especificacion=".$especificacion."&grupo=".$grupo."&ubicacion=".$ubicacion."&tipo=".$tipo."&enviar=1'><i class='fa fa-angle-left'></i></a></li>";
													}

													for ($j=1; $j<=$paginas; $j++) { 
														$paginator .="<li id='pagination_".$j."'><a href='bode_inv_indexoc3.php?ori=".$ori."&id=".$id."&page=".$j."&numoc=".$numoc."&especificacion=".$especificacion."&grupo=".$grupo."&ubicacion=".$ubicacion."&tipo=".$tipo."&enviar=1'>".$j."</a></li>"; 
													}; 

													if($page + 1 > $paginas)
													{

													}else{
														$paginator .="<li><a href='bode_inv_indexoc3.php?ori=".$ori."&id=".$id."&page=".($page+1)."&numoc=".$numoc."&especificacion=".$especificacion."&grupo=".$grupo."&ubicacion=".$ubicacion."&tipo=".$tipo."&enviar=1'><i class='fa fa-angle-right'></i></a></li>";
													}
												$paginator .="<li><a href='bode_inv_indexoc3.php?ori=".$ori."&id=".$id."&page=$paginas'&numoc=".$numoc."&especificacion=".$especificacion."&grupo=".$grupo."&ubicacion=".$ubicacion."&tipo=".$tipo."&enviar=1'><i class='fa fa-angle-double-right'></i></a></li></ul>"; // Goto last page
												echo $paginator;
												echo "</td></tr>";
											}
											?>
										</table>
										<input type="hidden" name="ori" value="<? echo $ori ?>"  >
										<input type="hidden" name="id" value="<? echo $id ?>"  >
										<input type="hidden" name="totallinea" value="<? echo $i ?>"  >
										<input type="hidden" name="tipo" value="<?php echo $tipo ?>">
										<input type="hidden" name="numoc" value="<?php echo $numoc ?>">
										<input type="hidden" name="grupo" value="<?php echo $grupo ?>">
										<input type="hidden" name="ubicacion" value="<?php echo $ubicacion ?>">
										<input type="hidden" name="especificacion" value="<?php echo $especificacion ?>">
									</form>
									<hr>
								<?php endif ?>
								<form action="bode_inv_despachos_gr_multi.php" method="POST">

									<table border="0" width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="5">PRODUCTOS YA INGRESADOS</td>
										</tr>
										<tr>
											<td  valign="center" class="Estilo1"N°></td>
											<td></td>
											<td  valign="center" class="Estilo1">Descripcion</td>
											<td  valign="center" class="Estilo1">Cantidad</td>
											<td  valign="center" class="Estilo1">Precio</td>
											<td  valign="center" class="Estilo1"></td>
										</tr>

										<?
										$sql6 = "SELECT COUNT(doc_id) as Inventariables FROM bode_detoc a INNER JOIN bode_orcom b ON b.oc_id = a.doc_oc_id INNER JOIN bode_detingreso c ON c.ding_id = a.doc_origen_id WHERE b.oc_id = ".$id." AND a.doc_estado <> 'ELIMINADO' and c.ding_clasificacion = 1";
										$res6 = mysql_query($sql6);
										$row6 = mysql_fetch_array($res6);
										$totalInventariables2 = intval($row6["Inventariables"]);	

										$contador = 1;
										$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE x.oc_id=$id and  x.oc_id=y.doc_oc_id and doc_estado<>'ELIMINADO'";
													//$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$numoc;
													// echo $sql3;
										$i=0;
										$res3 = mysql_query($sql3);
										$r3=mysql_query($sql3);

										$array_id = array();
										while($row5 = mysql_fetch_array($r3))
										{
											$doc_id = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON b.doc_id = a.ding_prod_id WHERE a.ding_id = ".$row5["doc_origen_id"];
														// echo $doc_id."<br>";
											$doc_id = mysql_query($doc_id);
											$doc_id = mysql_fetch_array($doc_id);
											$array_id[] = array("doc_id" => $doc_id["ding_prod_id"],"doc_cantidad" => $row5["doc_cantidad"],"doc_especificacion" => $doc_id["doc_especificacion2"]);

										}

										for($i = 0; $i < count($array_id); $i++)
										{
											$inv = "SELECT * FROM acti_inventario WHERE inv_doc_id = ".$array_id[$i]["doc_id"]." AND (inv_direccion IS NULL OR inv_direccion = '') ORDER BY inv_id LIMIT ".$array_id[$i]["doc_cantidad"];
											$inv = mysql_query($inv);
											$ar=array();
											while($r2 = mysql_fetch_array($inv))
											{
												$arr[$i][]=$r2;
											}
										}

										while ($row3 = mysql_fetch_array($res3)) {

											?>
											<tr>
												<td class="Estilo1" colspan="1"><?php echo $contador;?></td>
												<td>
													<input type="checkbox" name="var7[<?php echo $contador ?>]" value="<?php echo $row3["doc_origen_id"] ?>">
													<input type="hidden" name="var8[<?php echo $contador ?>]" value="<?php echo $row3["doc_cantidad"] ?>">
													<input type="hidden" name="var9[<?php echo $contador ?>]" value="<?php echo $row3["doc_id"] ?>">

												</td>
												<td class="Estilo1" colspan=1><input type="text" name="var3b[<? echo $i ?>]" class="Estilo2" size="80"  disabled value="<? echo $row3["doc_especificacion"] ?>" ></td>
												<td class="Estilo1" colspan=1><input type="text" name="var4b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_cantidad"],0,',','.'); ?>" ></td>
												<td class="Estilo1" colspan=1><input type="text" name="var5b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_conversion"] / $row3["doc_factor"],0,',','.'); ?>" ></td>
												<td class="Estilo1" colspan=1><a href="bode_inv_despachos_br.php?ori=<? echo $ori ?>&id=<? echo $id ?>&doc_id=<? echo $row3["doc_id"] ?>&doc_id2=<? echo $row3["doc_origen_id"] ?>&cantidad=<? echo $row3["doc_cantidad"] ?>" class="link" onClick="return confirm('Seguro que desea Cambiar Estado ?')" ><i class="fa  fa-times"></i></a></td>

											</tr>
											<?

											$i=$i+1;
											$contador++;
										}


										$sql4 = "SELECT * FROM acti_region where region_id='$regionsession'";
										$res4 = mysql_query($sql4);
										$row4 = mysql_fetch_array($res4);
										$regionglosa1=$row4["region_glosa"];

/*
$sql4 = "SELECT * FROM acti_region where region_id='$regionsession'";
$res4 = mysql_query($sql4);
$row4 = mysql_fetch_array($res4);
$regionglosa2=$row4["region_glosa"];
*/

?>
<tr>
	<td colspan="6" align="right"><button>Eliminar Seleccionados</button></td>
</tr>
</table>
<input type="hidden" name="ori" value="<?php echo $ori ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
</form>

<hr>
<form action="bode_guia_despacho_gr.php" method="POST" onSubmit="return check()" enctype="multipart/form-data" name="form1" id="form1">
	<?php 
	$hoy = date("d-m-Y");
	$proximo = time() + (48 * 60 * 60);
	$anterior = time() - (48 * 60 * 60);

	$fechaFuturo = date("Y-m-d",strtotime($hoy.'+2 days'));
	$fechaPasada = date("Y-m-d",strtotime($hoy.'-2 days'));
	$fechaHoy = date("Y-m-d");
	?>
	<table>
		<tr>
			<td  class="Estilo2titulo" colspan="4">DETALLE GUÍA</td>
		</tr>
		<tr>
			<td class="Estilo1">FECHA EMISION</td>
			<td colspan="2" class="Estilo1"><input type="text" readonly name="emision" id="emision" size="8" value="<?php echo $hoy ?>" style="background-color: rgb(235, 235, 228)"></td>
		</tr>

		<tr>
			<td class="Estilo1">ABASTECE</td>
			<td colspan="2" class="Estilo1"><input type="text" name="abastece" id="abastece"  value="<? if($_SESSION["region"] == 16){echo "CENTRAL DE ABASTECIMIENTO";}else{echo $regionglosa1;} ?>" size="50"/></td>
		</tr>

		<tr>
			<td class="Estilo1">DESTINATARIO</td>
			<td colspan="2" class="Estilo1">
				<?php if ($v_oc_tipoguia <> 6): ?>
					<input type="text" name="destinatario" id="destinatario" size="30" value="<? echo $v_oc_region ?>" readonly style="background-color: rgb(235, 235, 228)"/>
				<?php else: ?>
					<?php if ($_SESSION["region"] == 16 || $_SESSION["region"] == 2): ?>
						<select name="destinatario" id="destinatario" class="Estilo2" required>
							<option value="" selected>Seleccionar</option>
							<?php 
							$ubi = mysql_query("SELECT * FROM bode_ubicacion WHERE ubi_estado = 1 and ubi_region = ".$_SESSION["region"]." ORDER BY ubi_glosa ASC");
							while($rubi = mysql_fetch_array($ubi)) {
								?>
								<option value="<?php echo $rubi["ubi_glosa"] ?>"><?php echo $rubi["ubi_glosa"] ?></option>
								<?php } ?>
							</select>
						<?php else: ?>
							<input type="text" name="ubicacion" id="ubicacion" class="Estilo2">
						<?php endif ?>
					<?php endif ?>
				</td>
			</tr>

			<tr>
				<td class="Estilo1">EMISOR</td>
				<td colspan="2" class="Estilo1"><?php echo $_SESSION["nombrecom"] ?></td>
			</tr>
			<?php
	// $max = "SELECT MAX(oc_id) AS Max FROM bode_orcom WHERE oc_estado = 1 AND oc_region2 = ".$_SESSION["region"];
	// $max = mysql_query($max);
	// $max = mysql_fetch_array($max);
	// $max = intval($max["Max"]);
	// $folio = "SELECT oc_folioguia as Folio FROM bode_orcom WHERE oc_id = ".$max;
	// $folio = mysql_query($folio);
	// $folio = mysql_fetch_array($folio);
	// $folio = intval($folio["Folio"] + 1);
			?>
			<tr>
				<td class="Estilo1">FOLIO</td>
				<td class="Estilo1" colspan="2"><input type="text" name="folio" id="folio" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php if($v_oc_tipoguia == 5){echo $v_oc_folioguia;} ?>" onBlur="validaFolio(this.value)" <?php if($v_oc_tipoguia == 5){echo"readonly class='bloqueado'";}?> ></td>
			</tr>
			
			<?php if($totalInventariables2 > 0): ?>
				<?php for($i=1;$i<=$totalInventariables2;$i++) { ?>
				<tr>
					<td class="Estilo1">RANGO N° <?php echo $i ?></td>
					<td class="Estilo1">DESDE : <input type="text" name="desde[<?php echo $i ?>]" id="desde_<?php echo $i ?>" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> - HASTA <input type="text" name="hasta[<?php echo $i ?>]" id="hasta_<?php echo $i ?>" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
				</tr>
				<?php } ?>
				
				<tr>
					<td class="Estilo1">INDIVIDUALES</td>
					<td class="Estilo1"><input type="text" name="separados" id="separados" class="Estilo1" size="60" placeholder="Para separar los bienes usar la coma (,)"></td>
				</tr>
			<?php endif ?>

			<!-- SI VIENE DE UNA NOTA DE PEDIDO, VERIFICAR LOS INVENTARIABLES -->
			<?php
			$sql5 = "SELECT COUNT(doc_id) as Total FROM bode_detoc WHERE doc_clasificacion = 1 AND doc_oc_id = ".$id;
			$res5 = mysql_query($sql5);
			$row5 = mysql_fetch_array($res5);
			$totalInventariables = intval($row5["Total"]);
			if($totalInventariables > 0)
			{
				$tipo = "Inventariable";
			}
			?>

			<?php if ($totalInventariables > 0): ?>
				<?php for($i=1;$i<=$totalInventariables;$i++) { ?>			
				<tr>
					<td class="Estilo1">RANGO N° <?php echo $i ?></td>
					<td class="Estilo1">DESDE : <input type="text" name="desde[<?php echo $i ?>]" id="desde_<?php echo $i ?>" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> - HASTA <input type="text" name="hasta[<?php echo $i ?>]" id="hasta_<?php echo $i ?>" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
				</tr>
				<?php } ?>
				<tr>
					<td class="Estilo1">INDIVIDUALES</td>
					<td class="Estilo1"><input type="text" name="separados" id="separados" class="Estilo1" size="60" placeholder="Para separar los bienes usar la coma (,)"></td>
				</tr>
			<?php endif ?>
			<!-- FIN NOTA DE PEDIDO -->

			<!--
			<?php if ($tipo == "Inventariable"): ?>
				<?php for($i=1;$i<$contador;$i++) { ?>
				<tr>
					<td class="Estilo1">RANGO N° <?php echo $i ?></td>
					<td class="Estilo1">DESDE : <input type="text" name="desde[<?php echo $i ?>]" id="desde_<?php echo $i ?>" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'> - HASTA <input type="text" name="hasta[<?php echo $i ?>]" id="hasta_<?php echo $i ?>" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
				</tr>
				<?php } ?>

				<tr>
					<td class="Estilo1">INDIVIDUALES</td>
					<td class="Estilo1"><input type="text" name="separados" id="separados" class="Estilo1" size="60" placeholder="Para separar los bienes usar la coma (,)"></td>
				</tr>
			<?php endif ?>
			!-->


			<tr>
				<td class="Estilo1">OBSERVACIÓN</td>
				<td class="Estilo1" colspan="2">
					<?php if ($tipo=="Inventariable"): ?>
						<?php
						echo "<textarea name=\"obs\" id=\"obs\" style=\"margin: 0px; padding:0px;width: 465px; height: 153px;\">";
						for($z = 0; $z < count($arr); $z++)
						{
							echo "PRODUCTO : ".$array_id[$z]["doc_especificacion"].". ";
							echo "DESDE : ".$arr[$z][0]["inv_codigo"]." ";
							echo "HASTA : ".$arr[$z][$array_id[$z]["doc_cantidad"]-1]["inv_codigo"]."\n";
						}		
						$_SESSION["inv_id"] = array();
						for($j = 0; $j < count($array_id); $j++)
						{
							for($k=0;$k<count($arr[$j]);$k++)
							{
								$_SESSION["inv_id"][] = $arr[$j][$k]["inv_id"]; 
							}
						}
						echo "MERCADERÍA EN TRASLADO PROPIEDAD DE JUNJI. OPERACIÓN NO CONSTITUYE VENTA</textarea>";
						?>
					<?php else: ?>
						<textarea name="obs" id="obs" style="margin: 0px; padding:0px;width: 465px; height: 153px;">MERCADERÍA EN TRASLADO PROPIEDAD DE JUNJI. OPERACIÓN NO CONSTITUYE VENTA</textarea
						<?php endif ?>
					</td>
				</tr>

				<?php if ($v_oc_mas_id <> 0): ?>

				<?php else: ?>
					<tr>
						<td class="Estilo1">ARCHIVO<br>(PDF,XLSX,XLS y MSG)</td>
						<td><input type="file" name="archivo" required></td>
					</tr>
				<?php endif ?>
				<?php if ($contador > 1): ?>

					<tr>
						<td colspan="3"><input type="submit" value="Cerrar guia" id="btnCerrar">
						</td>
					</tr>
				<?php endif ?>

			</table>
			<input type="hidden" name="qry" value="<?php echo $sql3 ?>">
			<input type="hidden" name="id" id="id" value="<?php echo $id ?>">
			<input type="hidden" name="emisor" value="<?php echo $_SESSION["nombrecom"] ?>">
			<input type="hidden" name="ori" value="<? echo $ori ?>"  >
			<input type="hidden" name="totalElementos" id="totalElementos" value="<?php echo mysql_num_rows($res3) ?>">

			<!-- NUEVO !-->
			<input type="hidden" name="tipo" id="tipo" value="<?php echo $tipo ?>">
			<input type="hidden" name="qty" value="<?php echo $r["doc_cantidad"] ?>">
			<input type="hidden" name="inv_doc_id" value="<?php echo $doc_id ?>">
			<input type="hidden" name="inv_ding_id" value="<?php echo $r["doc_origen_id"] ?>">
			<input type="hidden" name="imprimir" id="imprimir">
			<input type="hidden" name="v_oc_tipoguia" id="v_oc_tipoguia" value="<?php echo $v_oc_tipoguia ?>">

			<input type="hidden" name="region_destino" value="<?php echo $v_oc_region_destino ?>">
		</form>
	<!-- <table border="0" width="100%">
		<tr>
			<td  class="Estilo2titulo" colspan="10">Guias Generadas</td>
		</tr>
		<tr>
			<td  valign="center" class="Estilo1">Descripcion</td>
			<td  valign="center" class="Estilo1">Cantidad</td>
			<td  valign="center" class="Estilo1">Precio</td>
		</tr>
	</table> -->
</div>

</div>

<script type="text/javascript">
	$(function(){
		$("#pagination_<? echo  $page ?>").addClass("active");
	})

	function validaFolio(input)
	{
		$("#btnCerrar").hide();
		var data = ({cmd:"validaFolio", folio:input});
		$.ajax({
			type:"POST",
			url:"bode_valida_folio.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				if(response > 0)
				{
					alert("EL FOLIO INGRESADO ("+$("#folio").val()+") YA SE ENCUENTRA OCUPADO.");
					$("#folio").val("");
					$("#folio").focus();
					return false;
				}else{
					$("#btnCerrar").show();
				}
			}
		});
	}
	function check(){
		var fechaFuturo = "<?php echo $fechaFuturo ?>";
		var fechaPasada = "<?php echo $fechaPasada ?>";
		var fechaHoy = "<?php echo $fechaHoy ?>";

		var totalInventariables = "<?php echo $totalInventariables2 ?>";
		
		if(fechaHoy > fechaFuturo || fechaHoy < fechaPasada)
		{
			alert("La fecha de emision de la guia está fuera del rango permitido.");
			return false;
		}

		if($("#folio").val() == "")
		{
			alert("Ingrese folio por favor.");
			$("#folio").focus();
			return false;
		}

		var totalElementos = $("#totalElementos").val();

		if(totalInventariables > 0)
		{
		for(i=1;i<=totalInventariables;i++)
		{
			if($("#desde_"+i).val() != '' && $("#hasta_"+i).val() != '')
			{
				if(parseInt($("#desde_"+i).val()) > parseInt($("#hasta_"+i).val()))
				{
					alert("'Desde' no puede ser menor que el 'Hasta'");
					$("#desde_"+i).val("");
					$("#hasta_"+i).val("");
					return false;
					break;
				}else{
					var totalRango = parseInt($("#hasta_"+i).val()) - parseInt($("#desde_"+i).val()) + 1;
					if(confirm('PARA EL RANGO N° '+i+' SE ACTUALIZARÁN '+totalRango+' CODIGOS DE INVENTARIO, ¿ES CORRECTA LA INFORMACIÓN ?'))
					{

					}else{
						return false;
					}
				}			
			}
		}
	}
		/*
		for(i=1;i<=totalElementos;i++)
		{
			if($("#desde_"+i).val() != '' && $("#hasta_"+i).val() != '')
			{
				if(parseInt($("#desde_"+i).val()) > parseInt($("#hasta_"+i).val()))
				{
					alert("'Desde' no puede ser menor que el 'Hasta'");
					$("#desde_"+i).val("");
					$("#hasta_"+i).val("");
					return false;
					break;
				}
			}
		}
*/
		totalElementos = parseInt(totalElementos);

		//VALIDAMOS LA EXTENSION DEL ARCHIVO
		var archivo1 = document.form1.archivo.value;
		if(archivo1 != "")
		{
			var extension = archivo1.split(".").pop().toUpperCase();
			if(extension != "PDF" && extension != "XLSX" && extension != "XLS" && extension != "CSV" && extension != "MSG") 
			{
				alert("La extension permitida es : PDF,XLSX,XLSX,CSV y MSG");
				document.form1.archivo.focus();
				return false;
			}
		}
		if(totalElementos == 0){
			alert("DEBE AGREGAR ALMENOS 1 PRODUCTO A LA GUIA DE DESPACHO.");
			return false;
		}

		if(totalElementos > 24)
		{
			alert("SE HA LLEGADO AL LIMITE DE PRODUCTOS (24)");
			return false;
		}

		if($("#folio").val() == 0 || $("#folio").val() == ""){
			alert("INGRESE EL FOLIO");
			$("#folio").focus();
			return false;
		}

		if(confirm('¿ DESEA IMPRIMIR INMEDIATAMENTE LA GUIA GENERADA ?'))
		{
			$("#btnCerrar").hide();
			$("#imprimir").val("SI");
			return true;
		}else{
			$("#btnCerrar").hide();
			blockUI();
			return true;
		}
	}
	function eliminarItem(input) {
		var data = ({cmd : "eliminarItem", compra_id : input});

		$.ajax({
			type:"POST",
			url:"inv_eliminar_compra.php",
			data:data,
			dataType:"JSON",
			cache:false,
			success : function ( response ) {
				console.log(response);
			}
		});
	}

	function setPropiedad(input){

		if($("#var1_"+input).is(":checked")){
			$("#var2_"+input).prop("required",true);
		}else{
			$("#var2_"+input).prop("required",false);
		}
	}

	function valida(){
		var totalElementos = $("#totalElementos").val();
		totalElementos = parseInt(totalElementos);

		var numberOfChecked = $('input:checkbox:checked').length;
		numberOfChecked = parseInt(numberOfChecked);
		if(numberOfChecked == 0){
			alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA.");
			return false;
		}else if(totalElementos > 22){
			alert("SE HA SUPERADO EL LIMITE DE 23 ELEMENTOS");
			return false;
		}else{
			blockUI();
			return true;
		}
	}
</script>
