
<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >

		<!-- Recupera la ORDEN DE COMPRA SELECCIONADA Y LA MUESTRA 		-->
		<?
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
		$v_oc_observaciones	    = $row2['oc_observaciones'];
		$v_oc_estado            = $row2['oc_estado'];

		$v_pro_rut              = $row2['oc_proveerut'];
		$v_pro_glosa            = $row2['pro_glosa'];

		
		    //     echo $v_oc_region;
		?>

		<form name="f1" method="get" action="bode_inv_indexoc3.php">
			<table border="0"  width="100%">
				<tr>
					<td  class="Estilo2titulo" colspan="10">AGREGAR PRODUCTOS A GUIA DE DESPACHO</td>
				</tr>
				<tr>
					<td class="Estilo1c">Buscar Guia [OC] </td>
					<td class="Estilo2">  <input type="text" name="numoc" size=15 value="<? echo $numoc ?>"> </td>
					<tr>

						<tr>
							<td class="Estilo1c">Especificacion </td>
							<td class="Estilo2">  <input type="text" name="especificacion" size=10  value="<? echo $especificacion ?>"> </td>

							<tr>
								<tr>
									<td class="Estilo2">
                                      <input type="submit" value="Buscar" size=10>
  									<a href="bode_inv_indexoc3.php?ori=<? echo $ori ?>&id=<? echo $id ?>" class="link">Limpiar</a>
                                    </td>
									<tr>

									</table>
									<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
									<input type="hidden" name="ori" value="<? echo $ori ?>"  >
									<input type="hidden" name="id" value="<? echo $id ?>"  >
								</form>

								<hr>

								<!-- COMIENZO DEL FORMULARIO -->


								<form name="f1" method="POST" action="bode_inv_despachos_gr.php" onSubmit="return valida()">

									<table border="0"  width="100%">
										<tr>
											<td  class="Estilo2titulo" colspan="10">RESULTADOS DE LA BUSQUEDA</td>
										</tr>

									</table>
									<table border="0" width="100%">
										<tr>
											<td class="Estilo2" colspan=5>  <input type="submit" value="Agrega Productos a la Guia" size=10> </td>
											<tr>
												<tr>
													<td  valign="center" class="Estilo1"></td>
													<td  valign="center" class="Estilo1">Cantidad</td>
													<td  valign="center" class="Estilo1">Descripcion</td>
													<td  valign="center" class="Estilo1">Stock</td>
													<td  valign="center" class="Estilo1">Precio</td>
												</tr>
<!--
												<form name="form1" action="inv_grabaindexoc2.php" method="get" onsubmit="return validaree()">
												-->
												<?

												if ($numoc<>'') {
													$where1=" d.oc_id2 like  '%$numoc%' and ";
												}
												if ($especificacion<>'') {
													$where2=" a.doc_especificacion like  '%$especificacion%' and ";
												}

												//$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE $where1 $where2  x.oc_id=y.doc_oc_id and y.doc_stock>0 and y.doc_region='$regionsession'; ";
												//$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE $where1 $where2  x.oc_id=y.doc_oc_id and y.doc_stock > 0";
												  
												  //$sql3 = "SELECT * FROM bode_detingreso a INNER JOIN bode_detoc b ON a.ding_prod_id = b.doc_id INNER JOIN bode_ingreso c ON a.ding_ing_id = c.ing_id INNER JOIN bode_orcom d ON b.doc_oc_id = d.oc_id WHERE $where1 $where2 a.ding_recep_conforme = 'C' AND d.oc_tipo = 0 AND b.doc_stock > 0 AND b.doc_estado <> 'ELIMINADO'";
												$sql3 = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b ON b.ding_prod_id = a.doc_id INNER JOIN bode_ingreso c ON c.ing_id = b.ding_ing_id INNER JOIN bode_orcom d ON d.oc_id = a.doc_oc_id where $where1  $where2 1=1  limit 0,15";
												//$sql3 = "SELECT * FROM bode_orcom a  INNER JOIN bode_detoc b ON b.doc_oc_id = a.oc_id INNER JOIN bode_ingreso c ON c.ing_oc_id = a.oc_id INNER JOIN bode_detingreso d ON d.ding_prod_id = b.doc_id WHERE a.oc_tipo = 0 AND d.ding_cantidad > 0";
//												echo $sql3;
//$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$numoc;
//													echo $sql3;
												$i=0;
												$res3 = mysql_query($sql3);
												while ($row3 = mysql_fetch_array($res3)) {

													?>
													<tr>

														<td class="Estilo1" colspan=1>
															<input type="checkbox" name="var1[<? echo $i ?>]" id="var1_<?php echo $i ?>" class="Estilo2" size="40"  value="<? echo $row3["doc_id"] ?>" onClick="setPropiedad(<?php echo $i ?>)">
														</td>
														
														<td class="Estilo1" colspan=1>
															<!--<input type="text" name="var2[<? echo $i ?>]" class="Estilo2" size="6"  value="" >!-->
															<input type="number" name="var2[<? echo $i ?>]" id="var2_<?php echo $i?>" class="Estilo2" size="6" min="1" max="<?php echo $row3["doc_stock"]?>"/>
														</td>
														<td class="Estilo1" colspan=1>
															<input type="text" name="var3b[<? echo $i ?>]" class="Estilo2" size="40"  disabled value="<? echo $row3["doc_especificacion"] ?>" >
															<input type="hidden" name="var3[<? echo $i ?>]" class="Estilo2" size="40"   value="<? echo $row3["doc_especificacion"] ?>" >
														</td>
														<td class="Estilo1" colspan=1>
															<input type="text" name="var4b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_stock"],0,',','.'); ?>" >
															<input type="hidden" name="var4[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["doc_stock"]; ?>" >
														</td>
														<td class="Estilo1" colspan=1>
															<input type="text" name="var5b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_valor_unit"],0,',','.'); ?>" >
															<input type="hidden" name="var5[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["doc_valor_unit"]; ?>" >
															<input type="hidden" name="var6[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["doc_numerooc"]; ?>" >
														</td>
														<td class="Estilo1" colspan=1>
															<a href="#" class="link" onclick='window.open("bode_listaubicacion.php?id=<? echo $row3["doc_id"] ?>","miwin","width=500,height=500,scrollbars=yes,toolbar=0")'><i class="fa fa-eye"></i></a>
														</td>
													</tr>
													<?

													$i=$i+1;
												}

												?>
											</table>
											<input type="hidden" name="ori" value="<? echo $ori ?>"  >
											<input type="hidden" name="id" value="<? echo $id ?>"  >
											<input type="hidden" name="totallinea" value="<? echo $i ?>"  >
										</form>
										<hr>


										<table border="0"  width="100%">

										</table>
										<form action="bode_guia_despacho_gr.php" method="POST">
											<table border="0" width="100%">
												<tr>
													<td  class="Estilo2titulo" colspan="10">PRODUCTOS YA INGRESADOS A GUIA <? echo "numero"; ?></td>
												</tr>
												<tr>
													<td  valign="center" class="Estilo1">Descripcion</td>
													<td  valign="center" class="Estilo1">Cantidad</td>
													<td  valign="center" class="Estilo1">Precio</td>
												</tr>

												<form name="form1" action="inv_grabaindexoc2.php" method="post" onsubmit="return validaree()">
													<?


													$sql3 = "SELECT * FROM bode_orcom x, bode_detoc y WHERE x.oc_id=$id and  x.oc_id=y.doc_oc_id and doc_estado<>'ELIMINADO' ; ";
													//$sql3 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$numoc;
								//echo $sql3;
													$i=0;
													$res3 = mysql_query($sql3);
													while ($row3 = mysql_fetch_array($res3)) {



														?>
														<tr>

															<td class="Estilo1" colsp-an=1>
																<input type="text" name="var3b[<? echo $i ?>]" class="Estilo2" size="40"  disabled value="<? echo $row3["doc_especificacion"] ?>" >
															</td>
															<td class="Estilo1" colspan=1>
																<input type="text" name="var4b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_cantidad"],0,',','.'); ?>" >
															</td>
															<td class="Estilo1" colspan=1>
																<input type="text" name="var5b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($row3["doc_valor_unit"],0,',','.'); ?>" >
															</td>
															<td class="Estilo1" colspan=1>
																<a href="bode_inv_despachos_br.php?ori=<? echo $ori ?>&id=<? echo $id ?>&doc_id=<? echo $row3["doc_id"] ?>&doc_id2=<? echo $row3["doc_origen_id"] ?>&cantidad=<? echo $row3["doc_cantidad"] ?>" class="link" onClick="return confirm('Seguro que desea Cambiar Estado ?')" ><i class="fa  fa-times"></i></a>
															</td>

															

														</tr>
														<?

														$i=$i+1;
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
                                         </table>
											<table border="0" width="100%">
<tr>
	<td class="Estilo1">FECHA EMISION</td>
	<td colspan="2" class="Estilo1"><input type="text" readonly name="emision" id="emision" size="8" value="<?php echo Date("d-m-Y") ?>" style="background-color: rgb(235, 235, 228)"></td>
</tr>

<tr>
	<td class="Estilo1">ABASTECE</td>
	<td colspan="2" class="Estilo1"><input type="text" name="abastece" id="abastece"  value="<? echo $regionglosa1 ?>" /></td>
</tr>

<tr>
	<td class="Estilo1">DESTINATARIO</td>
	<td colspan="2" class="Estilo1"><input type="text" name="destinatario" id="destinatario" value="<? echo $v_oc_region ?>";/></td>
</tr>

<tr>
	<td class="Estilo1">EMISOR</td>
	<td colspan="2" class="Estilo1"><?php echo $_SESSION["nombrecom"] ?></td>
</tr>

<tr>
	<td class="Estilo1">FOLIO</td>
	<td class="Estilo1" colspan="2"><input type="text" name="folio" id="folio"></td>
</tr>

<tr>
	<td class="Estilo1">OBS</td>
	<td class="Estilo1" colspan="2"><textarea name="obs" id="obs" style="margin: 0px; width: 465px; height: 153px;"></textarea></td>
</tr>

<tr>
	<td colspan="3"><input type="submit" value="Cerrar guia">
	</td>
</tr>
</table>
<input type="hidden" name="qry" value="<?php echo $sql3 ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="emisor" value="<?php echo $_SESSION["nombrecom"] ?>">
<input type="hidden" name="ori" value="<? echo $ori ?>"  >
</form>
<table border="0" width="100%">
	<tr>
		<td  class="Estilo2titulo" colspan="10">Guias Generadas</td>
	</tr>
	<tr>
		<td  valign="center" class="Estilo1">Descripcion</td>
		<td  valign="center" class="Estilo1">Cantidad</td>
		<td  valign="center" class="Estilo1">Precio</td>
	</tr>
</table>
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

	function setPropiedad(input){

		if($("#var1_"+input).is(":checked")){
			$("#var2_"+input).prop("required",true);
		}else{
			$("#var2_"+input).prop("required",false);
		}
	}

	function valida(){
		var numberOfChecked = $('input:checkbox:checked').length;
		numberOfChecked = parseInt(numberOfChecked);
		if(numberOfChecked == 0){
			alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA.");
			return false;
		}else{
			return true;
		}
	}
</script>
