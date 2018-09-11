<div  style="height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >

		<!-- Recupera la ORDEN DE COMPRA SELECCIONADA Y LA MUESTRA 		-->
		<?

		//$sql2 = "SELECT * FROM bode_orcom where  oc_id = '$id'";
		 //$sql2="select * from bode_detoc a, bode_orcom b where doc_oc_id = '$id' AND b.oc_id = a.doc_oc_id";
		$sql2="select * from bode_detoc a, bode_orcom b where doc_oc_id = '$id' AND b.oc_id = a.doc_oc_id AND a.doc_estado <> 'ELIMINADO'";
//		    $sql2 = "SELECT * FROM bode_orcom,bode_proveedor where oc_pro_id = pro_id and oc_id = '$id_oc'";
            //echo $sql2;
		$res2 = mysql_query($sql2);

		$sw_color=0;
		$oc_id=$id;
		$row2 = mysql_fetch_array($res2);
		$v_oc_id	            = $row2['oc_id'];
		$v_oc_id2	            = $row2['oc_id2'];
		$v_oc_region	        = $row2['oc_region'];
		$v_oc_nombre_oc	        = $row2['oc_nombre_oc'];
		//$v_oc_prog_id	        = $row2['oc_prog_id'];
		$v_oc_fecha	            = $row2['oc_fecha'];
		$v_oc_fecha_recep	    = $row2['oc_fecha_recep'];
		//$v_oc_recibido_usu_id	= $row2['oc_recibido_usu_id'];
		$v_oc_pro_id	        = $row2['oc_pro_id'];
		$v_oc_observaciones	    = $row2['oc_observaciones'];
		$v_oc_estado            = $row2['oc_estado'];
		//$v_oc_guiafecha         = $row2['oc_guiafechaad'];
		$v_oc_guiaabaste        = $row2['oc_guiaabaste'];
		$v_oc_guiadestina       = $row2['oc_guiadestina'];
		$v_oc_guiaemisor        = $row2['oc_guiaemisor'];

		$v_pro_rut              = $row2['oc_proveerut'];
		//$v_pro_glosa            = $row2['pro_glosa'];

		$v_oc_obs 				= $row2["oc_obs"];
		    //     echo $v_oc_region;
		$v_ruta 				= $row2["oc_rutatc"];
		$v_ocarchivo			= $row2["oc_archivotc"];

		$sqlMatriz = mysql_query("SELECT * FROM bode_masiva WHERE mas_id = ".$row2["oc_mas_id"]);
		$sqlMatrizResp = mysql_fetch_array($sqlMatriz);
		$matrizRuta = $sqlMatrizResp["mas_ruta"].$sqlMatrizResp["mas_archivo"];

		?>

	<?php 
	$transporte = "SELECT * FROM acti_proveedor a INNER JOIN transporte b ON a.proveedor_id = b.transporte_empresa_id WHERE b.transporte_patente = '".$row2["oc_patente"]."'";
	$transporte = mysql_query($transporte);
	$transporte = mysql_fetch_array($transporte);
	?>


		<hr>


		<table border="0"  width="100%">

		</table>
		<form action="bode_guia_despacho.php" method="POST">
			<table border="0" width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">PRODUCTOS YA INGRESADOS A GUIA <? echo $row2["oc_folioguia"]; ?></td>
				</tr>
				<tr>

					<td  valign="center" class="Estilo1">Descripcion</td>
					<td  valign="center" class="Estilo1">Cantidad</td>
					<td  valign="center" class="Estilo1">Precio</td>

				</tr>

				<form name="form1" action="inv_grabaindexoc2.php" method="post" onsubmit="return validaree()">
					<?


//$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE x.oc_id=$id and  x.oc_id=y.doc_oc_id ; ";
					$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y, bode_detingreso z WHERE x.oc_id=".$_REQUEST["id"]." and x.oc_id=y.doc_oc_id AND y.doc_origen_id = z.ding_prod_id and y.doc_estado <> 'ELIMINADO' AND x.oc_estado = 1";
//$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$numoc;
//echo $sql3;
					$i=0;
					$res3 = mysql_query($sql2);
					while ($row3 = mysql_fetch_array($res3)) {



						?>
						<tr>

							<td class="Estilo1" colspan=1>
								<input type="text" name="var3b[<? echo $i ?>]" class="Estilo2" size="40"  disabled value="<? echo $row3["doc_especificacion"] ?>" >
							</td>
							<td class="Estilo1" colspan=1>
								<input type="text" name="var4b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_cantidad"],0,',','.'); ?>" >
							</td>
							<td class="Estilo1" colspan=1>
								<input type="text" name="var5b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_conversion"] ,0,',','.'); ?>" >
							</td>
						</tr>
						<?

						$i=$i+1;
					}

					?>
					<tr>
						<td class="Estilo1">FECHA EMISION</td>
						<td colspan="2" class="Estilo1"><input type="text" disabled name="emision" id="emision" size="8" value="<?php echo $row2["oc_fecha"] ?>" style="background-color: rgb(235, 235, 228)"></td>
					</tr>

					<tr>
						<td class="Estilo1">ABASTECE</td>
						<td colspan="2" class="Estilo1"><input type="text" name="abastece" id="abastece"  value="<?php echo $v_oc_guiaabaste ?>" disabled/></td>
					</tr>

					<tr>
						<td class="Estilo1">DESTINATARIO</td>
						<td colspan="2" class="Estilo1"><input type="text" name="destinatario" id="destinatario"  value="<?php echo $v_oc_guiadestina ?>" disabled/></td>
					</tr>

					<tr>
						<td class="Estilo1">EMISOR</td>
						<td colspan="2" class="Estilo1"><?php  echo $row2["oc_usu"] ?></td>
					</tr>

					<tr>
						<td class="Estilo1">OBS</td>
						<td colspan="2" class="Estilo1"><textarea name="obs" id="obs" style="margin: 0px; width: 465px; height: 153px;" disabled><?php echo $v_oc_obs ?></textarea></td>
					</tr>

					<?php if ($row2["oc_chofer"] <> ""): ?>
						<tr>
						<td class="Estilo1">OBSERVACIÓN INTERNA</td>
						<td colspan="2" class="Estilo1"><textarea name="obsi" id="obsi" style="margin: 0px; width: 465px; height: 153px;" disabled>
						PROVEEDOR : <?php echo $transporte["proveedor_glosa"] ?>
						CHOFER : <?php echo $row2["oc_chofer"] ?>
						PATENTE : <?php echo $row2["oc_patente"] ?>
						OBSERVACION : <?php echo $row2["oc_observaciones"] ?>
						</textarea></td>
					</tr>
					<?php endif ?>
					
					<tr>
					<td class="Estilo1">ARCHIVO ADJUNTO</td>

					<?php if ($row2["oc_mas_id"] <> 0): ?>

						<?php if ($sqlMatrizResp["mas_ruta"] <> '' && $sqlMatrizResp["mas_archivo"] <> ""): ?>
							<td class="Estilo1"><a href="../../../<?php echo $matrizRuta ?>" target="_blank"><i class="fa fa-cloud-download link fa-lg"></i></a></td>
						<?php else: ?>
							<td class="Estilo1">ESTA GUIA NO TIENE ADJUNTO</td>
						<?php endif ?>

					<?php else: ?>
						<?php if($v_ruta <> "" && $v_ocarchivo <> ""): ?>
						<td class="Estilo1"><a href="../../../<?php echo $v_ruta.$v_ocarchivo ?>" target="_blank"><i class="fa fa-cloud-download link fa-lg"></i></a></td>
					<?php else: ?>
						<td class="Estilo1">ESTA GUIA NO TIENE ADJUNTO</td>
					<?php endif ?>
					<?php endif ?>
					
					</tr>

				</table>
				<input type="hidden" name="qry" value="<?php echo $sql3 ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="hidden" name="emisor" value="<?php echo $row2["oc_usu"] ?>">
			</form>

		</div>

	</div>

	<script type="text/javascript">
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
	</script>
