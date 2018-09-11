<?php		
require_once("inc/config.php");
$configuracion = [
"url" =>  "ftp.degesis.cl",
"usuario" => "junji",
"pwd" => "23.junWms"
];

$ftp = ftp_connect($configuracion["url"]);
$ftp_id = ftp_login($ftp, $configuracion["usuario"], $configuracion["pwd"]);

if($ftp_id) {

		//echo "Directorio actual: ".ftp_pwd($ftp)."\n";
		// intenta cambiar el directorio a somedir
	// if (ftp_chdir($ftp, "openbox/nuevos")) {
	// 	    //echo "El directorio actual es: ".ftp_pwd($ftp)."\n";
	// 	$files = ftp_nlist($ftp, ".");

	// } 
	// else {
	// 	echo "No se pudo cambiar al directorio\n";
	// }
	$files = scandir("ftp://junji:23.junWms@ftp.degesis.cl/openbox/nuevos/");
}
$cont = 1;
?>
<?php if(count($files) > 0) { ?>
<form action="bode_inv_indexoc4.php?cmd=WMS&ori=1" method="POST" enctype="multipart/form-data">
	<table border="1" width="100%" style="font-size:0.8em;" cellpadding="5" cellspacing="0">
		<tr>
			<td class="Estilo1" colspan="3">Archivos sin procesar</td>
			<td class="Estilo1" colspan="2"><?php echo sizeof($files) ?></td>
		</tr>
		<tr>
			<td class="Estilo2titulo">#</td>
			<td class="Estilo2titulo">Opción</td>
			<td class="Estilo2titulo">Archivo</td>
			<td class="Estilo2titulo">Fecha Subida</td>
			<td class="Estilo2titulo">Tamaño</td>
		</tr>
		<?php
		foreach ($files as $file) {
			$estilo=$cont%2;
			if ($estilo==0) {
				$estilo2="Estilo1mc";
			} else {
				$estilo2="Estilo1mcblanco";
			}
			$pizza = explode("_", $file);
			if($pizza[2] == "SDC"){
				?>
				<tr class="trh <?php echo $estilo2 ?>">
					<td class="Estilo1mc"><?php echo $cont ?></td>
					<td align="center"><input type="radio" name="wmsCSV" id="wmsCSV" value="<?php echo $file;?>" <?php if($_POST["wmsCSV"] == $file){echo"checked";} ?>></td>
					<td align="center" class="Estilo1"><?php echo $file; ?></td>
					<td class="Estilo1"><?php echo Date("d/m/Y H:i:s",stat("ftp://junji:23.junWms@ftp.degesis.cl/openbox/nuevos/".$file)["mtime"]) ?></td>
					<td class="Estilo1"><?php echo stat("ftp://junji:23.junWms@ftp.degesis.cl/openbox/nuevos/".$file)["size"] ?></td>
				</tr>
				<?php
				$cont++;
			}
		}
		ftp_close($ftp);
		?>
		<tr>
			<td colspan="5" align="center">
				<button class="button" name="wmsPreview" value="wmsPreview" onClick="blockUI()">PREVISUALIZAR</button>
			</td>
		</tr>
	</table>
</form>
<?php } else { ?>
<p style="color:tomato;font-weight: bold;font-family: sans-serif;" align="center"><i class="fa fa-warning"></i> En este momento no existen archivos los cuales procesar.!</p>
<?php } ?>


			<!--<form action="bode_inv_indexoc4.php?cmd=WMS&ori=1" method="POST" enctype="multipart/form-data">
				<table border="1" width="100%" cellpadding="1" cellspacing="1">
					<tr>
						<td class="Estilo2titulo" colspan="2">CARGA DE ARCHIVO DE INEDIS - OPENBOX</td>
					</tr>

					<tr>
						<td class="Estilo1mc">ARCHIVO CSV (DELIMITADO POR COMAS)</td>
						<td><input type="file" name="wmsCSV" id="wmsCSV"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><button class="button" name="wmsPreview" value="wmsPreview">PREVISUALIZAR</button></td>
					</tr>
				</table>
			</form>!-->

			<?php if ($_POST["wmsPreview"] == "wmsPreview"): ?>
				<?php
				$archivo=$_POST['wmsCSV'];
				$ftp = ftp_connect($configuracion["url"]);
				$ftp_id = ftp_login($ftp, $configuracion["usuario"], $configuracion["pwd"]);
				if($ftp_id) {
				//$file = file_get_contents('ftp://junji:23.junWms@ftp.degesis.cl/inedis/prueba_envio/enviado/'.$archivo2);
					$ruta = "ftp://junji:23.junWms@ftp.degesis.cl/openbox/nuevos";

				}
				?>

				<hr>
				<form action="bode_wms_graba_ori1.php" method="POST">
					<table border="0" width="100%">
						<tr>
							<td class="Estilo2titulo">PREVISUALIZACION : <strong><?php echo $_POST["wmsCSV"] ?></strong></td>
						</tr>
					</table>

					<br>
					<table border="1" width="100%">
						<tr>
							<td class="Estilo1mc" colspan="5" align="center">DETALLE ENCABEZADO</td>
						</tr>

						<tr>
							<td class="Estilo1mc">Tipo de Guia</td>
							<td class="Estilo1mc">Destino</td>
							<td class="Estilo1mc">Fecha de Despacho</td>
							<td class="Estilo1mc">Region de Destino</td>
							<td class="Estilo1mc">Identificador WMS</td>
						</tr>

						<?php
// LEEMOS EL ARCHIVO
						// $extension =  strtoupper(pathinfo($_FILES["wmsCSV"]["name"],PATHINFO_EXTENSION));
						$extension =  pathinfo($ruta."/".$archivo);
						$tiposGuias = [
						1 => "BODEGA",
						2 => "OFICINA",
						3 => "JARDÍN INFANTIL"
						];

						if($extension['extension'] === "csv")
						{
							// if($_FILES["wmsCSV"]["type"] == "application/vnd.ms-excel")
							// {

							// -----------------------------------------------
							// LEEMOS EL CONTENIDO Y LO TRANSFORMAMOS A UN ARRAY ASOCIATIVO
								// $csv = array_map("str_getcsv", file($_FILES["wmsCSV"]["tmp_name"]));
							$csv = array_map('str_getcsv', file($ruta."/".$archivo));
								// echo "<pre>";
								// print_r($csv);
								// echo "</pre>";
							$totalElementos = count($csv);
							$contador = 1;
							// FILA N° 2 ENCABEZADO DE LA GUIA
							$tipoDeGuia = $tiposGuias[$csv[1][2]];
							$encabezado = [
							0 => $tipoDeGuia,
							1 => $csv[1][0],
							2 => date("d-m-Y",strtotime($csv[1][1])),
							3 => $csv[1][3]
							];

							?>
							<tr>
								<td class="Estilo1mc"><input type="hidden" name="var[1][1]" value="<?php echo $csv[1][2] ?>"><?php echo $encabezado[0] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var[1][2]" value="<?php echo $encabezado[1] ?>"><?php echo $encabezado[1] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var[1][3]" value="<?php echo $encabezado[2] ?>"><?php echo $encabezado[2] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var[1][4]" value="<?php echo $encabezado[3] ?>"><?php echo $encabezado[3] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var[1][5]" value="<?php echo $csv[1][4] ?>"><?php echo $csv[1][4] ?></td>
							</tr>
						</table>

						<hr>
						<table border="1" width="100%">
							<tr>
								<td class="Estilo1mc" colspan="11" align="center">DETALLE PRODUCTOS</td>
							</tr>

							<tr>
								<td class="Estilo1mc">ID <?php echo $csv[2][0] ?></td>
								<td class="Estilo1mc"><?php echo $csv[2][1] ?></td>
								<td class="Estilo1mc"><?php echo $csv[2][2] ?></td>
								<td class="Estilo1mc"><?php echo $csv[2][3] ?></td>
								<td class="Estilo1mc"><?php echo $csv[2][4] ?></td>
								<td class="Estilo1mc"><?php echo $csv[2][5] ?></td>
								<td class="Estilo1mc"><?php echo $csv[2][6] ?></td>
								<td class="Estilo1mc"><?php echo $csv[2][7] ?></td>
								<td class="Estilo1mc">VALIDACIÓN ID</td>
								<td class="Estilo1mc">ID INEDIS</td>
								<td class="Estilo1mc">EDITAR</td>
							</tr>

							<?php
							for($i=3;$i<$totalElementos;$i++) { ?>

							<tr>
								<?php

								$pizza = explode("-", $csv[$i][4]);
								if($pizza[0] == "599")
								{
									$region = 16;
								}
								if($pizza[0] == "856")
								{
									$region = 13;
								}

								$sql_oc = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b on b.doc_oc_id = a.oc_id INNER JOIN bode_detingreso c ON c.ding_prod_id = b.doc_id WHERE a.oc_id2 = '".$csv[$i][4]."' AND a.oc_estado = 1 AND a.oc_tipo = 0 AND b.doc_id_mercado_publico = '".$csv[$i][0]."'  AND (b.doc_region = 13 OR b.doc_region = 16) LIMIT 1";
								$res_oc = mysql_query($sql_oc);
									// echo $sql_oc."<br>";
								$row_oc = mysql_fetch_array($res_oc);

									// if(mysql_num_rows($res_oc) > 1)
									// {
									// 	$sql_oc = "SELECT * FROM bode_orcom WHERE oc_id2 = '".$csv[$i][4]."' AND oc_estado = 1 AND oc_tipo = 0 AND oc_fecha <> '0000-00-00'";
									// 	$res_oc = mysql_query($sql_oc);
									// }else{
									// 	$res_oc = mysql_query($sql_oc);
									// }
									// 	$row_oc = mysql_fetch_array($res_oc);

									// // $sql2 = "SELECT * FROM bode_detoc WHERE doc_id_mercado_publico = '".$csv[$i][0]."'";
									//    $sql2 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$row_oc["oc_id"]." AND doc_id_mercado_publico = '".$csv[$i][0]."' AND doc_region = '".$region."'";
									// $res2 = mysql_query($sql2);
									// $row2 = mysql_fetch_array($res2);

									// $sql_doc = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$row_oc["oc_id"]." AND doc_id_mercado_publico = '".$csv[$i][0]."' AND doc_region = '".$region."'";
									// $res_doc = mysql_query($sql_doc);
									// $row_doc = mysql_fetch_array($res_doc);


									// echo $row_oc["doc_id_mercado_publico"] ." : " . $csv[$i][0]."<br>";
								if($row_oc["doc_id_mercado_publico"] <> $csv[$i][0]){
									$validacionID["MAL"]++;
									$estadoID = 0;
								}
								

								// $sql_oc = "SELECT * FROM bode_orcom WHERE oc_id2 = '".$csv[$i][4]."' AND oc_estado = 1 AND oc_tipo = 0";
								// $res_oc = mysql_query($sql_oc);
								// $row_oc = mysql_fetch_array($res_oc);

								// // $sql2 = "SELECT * FROM bode_detoc WHERE doc_id_mercado_publico = '".$csv[$i][0]."'";
								// $sql2 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$row_oc["oc_id"]." AND doc_id_mercado_publico = '".$csv[$i][0]."' AND doc_region = '".$region."'";
								// $res2 = mysql_query($sql2);
								// $row2 = mysql_fetch_array($res2);

								// $sql_doc = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$row_oc["oc_id"]." AND doc_id_mercado_publico = '".$csv[$i][0]."' AND doc_region = '".$region."'";
								// $res_doc = mysql_query($sql_doc);
								// $row_doc = mysql_fetch_array($res_doc);
								
								// if($row_doc["doc_id_mercado_publico"] <> $csv[$i][0]){
								// 		$validacionID["MAL"]++;
								// 		$estadoID = 0;
								// 	}

								?>
								<td class="Estilo1mc"><input type="hidden" name="var1[<?php echo $contador ?>]" value="<?php echo $csv[$i][0] ?>"><?php echo $csv[$i][0] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var2[<?php echo $contador ?>]" value="<?php echo $csv[$i][1] ?>"><?php echo $csv[$i][1] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var3[<?php echo $contador ?>]" value="<?php echo $csv[$i][2] ?>"><?php echo $csv[$i][2] ?></td>
								<td class="Estilo1mc">$<input type="hidden" name="var4[<?php echo $contador ?>]" value="<?php echo $row_oc["doc_conversion"] ?>"><?php echo number_format($row_oc["doc_conversion"],0,".",".") ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var5[<?php echo $contador ?>]" value="<?php echo $csv[$i][4] ?>"><?php echo $csv[$i][4] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var6[<?php echo $contador ?>]" value="<?php echo $row_oc["doc_item"] ?>"><?php echo $row_oc["doc_item"] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var7[<?php echo $contador ?>]" value="<?php echo $row_oc["doc_activo"] ?>"><?php echo $row_oc["doc_activo"] ?></td>
								<td class="Estilo1mc"><input type="hidden" name="var8[<?php echo $contador ?>]" value="<?php echo $row_oc["doc_gasto"] ?>"><?php echo $row_oc["doc_gasto"] ?></td>
								<td class="Estilo1mc"><?php echo ($row_doc["doc_id_mercado_publico"] <> $csv[$i][0]) ? "<font color='#EA2525'><i class='fa fa-ban fa-lg'></i></font>" : "<font color='#23C213'><i class='fa fa-check'></i></font>" ?></td>
								<input type="hidden" name="var9[<?php echo $contador ?>]" value="<?php echo $row_oc["ding_id"] ?>">
								<td class="Estilo1mc"><?php echo $row_oc["doc_id_mercado_publico"] ?></td>
								<td class="Estilo1mc">
									<?php if ($row_oc["doc_id_mercado_publico"] <> $csv[$i][0]): ?>
										<a href="#" class="link Estilo1mc" onclick="abrirVentana('<?php echo $csv[$i][4] ?>')">EDITAR</a>
									<?php endif ?>
								</td>
							</tr>
							<?php $contador++;} ?>
							<tr>
								<td colspan="11" align="right">
									<?php 
									$validaWMS = "SELECT count(oc_id) as Total FROM bode_orcom WHERE oc_wms = '".$csv[1][4]."'";
									$resValidaWMS = mysql_query($validaWMS);
									$rowValidaWMS = mysql_fetch_array($resValidaWMS);

									if($contador >= 31)
									{
										$mensaje.="<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Ha superado el limite de productos permitidos. (30)</li>";
									}	

									$mensaje = "";
									if($csv[1][0] == "")
									{
										$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Ha ocurrido un error al detectar la región de destino.</li>";
									}
									if($csv[1][1] == "")
									{
										$mensaje.="<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>No ha sido posible detectar la fecha de emisión de la guía de despacho.</li>";
									}
									if($csv[1][2] < 1 || $csv[1][2] > 3 || $csv[1][2] == "")
									{
										$mensaje.="<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>El tipo de guía presenta problemas.</li>";
									}
									if($csv[1][3] < 1 || $csv[1][3] > 16 || $csv[1][3] == "")
									{
										$mensaje.="<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Se ha encontrado un error en la región de destino.</li>";
									}

									if($rowValidaWMS["Total"] > 0 )
									{
										$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>El identificador WMS <strong>".$csv[1][4]." ya se encuentra registrado en INEDIS o no corresponde a la region.</strong></li>";
									}

									if($csv[1][4] == "")
									{
										$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>El fichero proporcionado viene sin identificador.</strong></li>";
									}

									if($validacionID["MAL"] > 0)
									{
										$mensaje.= "<li style='list-style:none;color:red;font-weight:bold;font-size:0.8em;'>Los ID'S de mercado publico proporcionados (".$validacionID["MAL"].") no concuerdan con los registrados.</li>";
									}

									if(strlen($mensaje) > 0)
									{
										echo "<ul>".$mensaje."</ul>";
										if(1==1){
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

							// }else{
							// 	echo "Formato de archivo no permitido";
							// }
						}else{
							echo "Extension no permitida";
						}
						?>
					</table>
					<input type="hidden" name="wms_file" id="wms_file" value="<?php echo $_POST["wmsCSV"]  ?>">
					<input type="hidden" name="ori" value="<?php echo $_GET["ori"] ?>">
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

				function abrirVentana(oc){
					miPopup = window.open("bode_wms_editar.php?oc="+oc,"miwin","width=1500,height=600,scrollbars=yes,toolbar=0")
					miPopup.focus()
				}
			</script>
