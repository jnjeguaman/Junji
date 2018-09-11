<form action="bode_inv_indexoc4.php?cmd=WMS&ori=3" method="POST" enctype="multipart/form-data">
	<table border="1" width="100%" cellpadding="1" cellspacing="1">
		<tr>
			<td class="Estilo2titulo" colspan="2">CARGA DE ARCHIVO DE INEDIS - OPENBOX [RECIBIDO]</td>
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
	<form action="bode_wms_graba_ori3.php" method="POST">
		<table border="1" width="100%">
			<tr>
				<td class="Estilo2titulo">PREVISUALIZACION</td>
			</tr>
		</table>

		<br>
		<?php
		require_once("buscaorden3.php");
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
				?>

				<hr>
				<table border="1" width="100%">
					<tr>
						<td class="Estilo1mc" colspan="11" align="center">DETALLE PRODUCTOS</td>
					</tr>

					<tr>
						<td class="Estilo1mc"><?php echo $csv[0][0] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][1] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][2] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][3] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][4] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][5] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][6] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][7] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][8] ?></td>
						<td class="Estilo1mc"><?php echo $csv[0][9] ?></td>
						<td class="Estilo1mc">VALIDACIÓN ID</td>
					</tr>


					<?php
					$objOC = new OrdenDeCompra();
					$estado = $objOC->getEstadoOC(strtoupper($csv[1][5]));
					$validacionID = array();
					$validacionStock = array();
					for($i=1;$i<$totalElementos;$i++) { 
						$estilo=$contador%2;
						if ($estilo==0) {
							$estilo2="Estilo1mc";
						} else {
							$estilo2="Estilo1mcblanco";
						}

						// VALIDAMOS LOS ID DE MARCADO PUBLICO CON LOS DE LA BASE DE DATOS INEDIS
						$sql_oc = "SELECT * FROM bode_orcom WHERE oc_id2 = '".$csv[1][5]."' AND oc_estado = 1 AND oc_tipo = 0";
						$res_oc = mysql_query($sql_oc);
						$row_oc = mysql_fetch_array($res_oc);

						$pizza = explode("-", $csv[1][5]);
						if($pizza[0] == "599")
						{
							$region = 16;
						}
						if($pizza[0] == "856")
						{
							$region = 13;
						}

						
						$sql_doc = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$row_oc["oc_id"]." AND doc_id_mercado_publico = '".$csv[1][1]."' AND doc_region = '".$region."'";
						$res_doc = mysql_query($sql_doc);
						$row_doc = mysql_fetch_array($res_doc);
						if(mysql_num_rows($res_doc) == 0)
						{
							$validacionID["MAL"]++;
							$estadoID = 0;
						}

						$sql_stock = "SELECT * FROM bode_detingreso a INNER JOIN bode_ingreso b ON b.ing_id = a.ding_ing_id WHERE a.ding_prod_id = ".$row_doc["doc_id"]." AND a.ding_ubicacion = 'CD - DIRNAC' AND b.ing_estado = 1 AND a.ding_unidad > 0";
						$res_stock = mysql_query($sql_stock);
						$row_oc = mysql_fetch_array($res_oc);
						if(mysql_num_rows($res_stock) == 0)
						{
							$validacionStock["MAL"]++;
							$estadoStock = 0;
						}
						?>

						<tr class="<?php echo $estilo2 ?> trh">
							<td class="Estilo1mc"><input type="hidden" name="var1[<?php echo $contador ?>]" value="<?php echo $csv[$i][0] ?>"><?php echo $csv[$i][0] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $csv[$i][1] ?>"><?php echo $csv[$i][1] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var3[<?php echo $contador ?>]" value="<?php echo $csv[$i][2] ?>"><?php echo $csv[$i][2] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var4[<?php echo $contador ?>]" value="<?php echo $csv[$i][3] ?>"><?php echo $csv[$i][3] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var5[<?php echo $contador ?>]" value="<?php echo $csv[$i][4] ?>"><?php echo $csv[$i][4] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var6[<?php echo $contador ?>]" value="<?php echo $csv[$i][5] ?>"><?php echo $csv[$i][5] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var7[<?php echo $contador ?>]" value="<?php echo $csv[$i][6] ?>"><?php echo $csv[$i][6] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var8[<?php echo $contador ?>]" value="<?php echo $csv[$i][7] ?>"><?php echo $csv[$i][7] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var9[<?php echo $contador ?>]" value="<?php echo $csv[$i][8] ?>"><?php echo $csv[$i][8] ?></td>
							<td class="Estilo1mc"><input type="hidden" name="var9[<?php echo $contador ?>]" value="<?php echo $csv[$i][10] ?>"><?php echo $csv[$i][10] ?></td>
							<td class="Estilo1mc"><?php echo ($validacionID["MAL"] > 0) ? "<font color='#EA2525'><i class='fa fa-ban fa-lg'></i></font>" : "<font color='#23C213'><i class='fa fa-check'></i></font>" ?></td>
						</tr>
						<?php $contador++;} ?>
						<tr>
							<td colspan="11" align="right">
								<?php 
								$validaWMS = "SELECT count(ing_id) as Total FROM bode_ingreso WHERE ing_wms = '".$csv[1][8]."'";
								$resValidaWMS = mysql_query($validaWMS);
								$rowValidaWMS = mysql_fetch_array($resValidaWMS);

								$mensaje = "";


								if($validacionID["MAL"] > 0)
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Los ID'S de mercado publico proporcionados (".$validacionID["MAL"].") no concuerdan con los registrados o no corresponde a la region.</li>";
								}

								if($validacionStock["MAL"] > 0)
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>No se han encontrado stock disponibles para (".$validacionStock["MAL"].") productos.</li>";
								}

								if($rowValidaWMS["Total"] > 0)
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>El identificador del WMS ya se encuentra registrado en INEDIS</li>";
								}

								if($estado == "OC Cancelada")
								{
									// $mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>La orden de compra <i><u><strong>".$csv[1][5]."</strong></u></i> ha sido cancelada en el portal.</li>";
								}

								if($estado == "En Proceso")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>La orden de compra <i><u><strong>".$csv[1][5]."</strong></u></i> está en proceso.</li>";
								}


								if($csv[1][1] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Falta el ID de mercado publico.</li>";
								}

								if($csv[1][2] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Falta la descripcion del producto a ingresar.</li>";
								}

								if($csv[1][3] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Falta la cantidad a ingresar.</li>";
								}

								if($csv[1][4] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Falta incluir el factor de conversion.</li>";
								}

								if($csv[1][5] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>No se ha especificado la orden de compra.</li>";
								}

								if($csv[1][6] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Falta la fecha de recepcion en bodega.</li>";
								}

								if($csv[1][7] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Falta el tipo de documento recibido.</li>";
								}

								if($csv[1][8] == "")
								{
									$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Falta incluir el identificador unico de WMS</li>";
								}
								if(strlen($mensaje) > 0)
								{
									echo "<ul>".$mensaje."</ul>";

									if(1==2){
										if(ftp_rename($ftp, "openbox/nuevos/".$archivo, "openbox/errores/".$archivo))
										{
											echo "El archivo '".$_POST["wmsCSV"]."' ha sido movido a carpeta errores.";
										}else{
											$error = error_get_last();
											echo "Ha ocurrido un error : ".$error["message"];
										}
									}

								}else{ ?>
								<button style="background: azure;border-radius: 5px;width: 150px;height: 40px;color: #003063;font-weight: bold" onClick="return valida();">GRABAR DATOS</button>
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
			<input type="hidden" name="ing_oc" value="<?php echo $csv[1][5] ?>">
			<input type="hidden" name="ing_wms" value="<?php echo $csv[1][8] ?>">
			<input type="hidden" name="ing_fecha" value="<?php echo date("Y-m-d",strtotime(str_replace("/","-",$csv[1][6]))) ?>">
			<input type="hidden" name="ing_usuario" value="<?php echo $_SESSION["nom_user"] ?>">
			<input type="hidden" name="ing_emisor" value="<?php echo $_SESSION["nombrecom"] ?>">
			<input type="hidden" name="ing_region" value="<?php echo $_SESSION["region"] ?>">
			<input type="hidden" name="totalElementos" value="<?php echo $contador ?>">
			<input type="hidden" name="ing_guia" value="<?php echo $csv[1][10] ?>">
		</form>
	<?php endif ?>

	<script type="text/javascript">
				function valida()
				{
					if(confirm('¿ESTÁ SEGURO DE REALIZAR LA CARGA DE DATOS?'))
					{
						blockUI();
						return true;
					}else{
						return false;
					}
				}
			</script>