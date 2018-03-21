
<div style="background-color:#E0F8E0; position:absolute; top:120px; left:805px;" id="div2">

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

		
		    //     echo $v_oc_region;
		?>

		<form name="f1" method="POST" action="bode_inv_indexguia3.php?ori=3&masid=<?php echo $masid ?>">
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
							<td class="Estilo2">  <input type="text" name="especificacion" size=10 value="<?php echo $especificacion ?>"> </td>

							<tr>
								<tr>
									<td class="Estilo2">  <input type="submit" value="Buscar" size=10> </td>
									<tr>

									</table>
									<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
									<input type="hidden" name="ori" value="<? echo $ori ?>"  >
									<input type="hidden" name="id" value="<? echo $id ?>"  >
								</form>

								<hr>

								<!-- COMIENZO DEL FORMULARIO -->


								<form name="f1" method="POST" action="bode_inv_despachos2_gr.php" onSubmit="return valida()">

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
											<td  valign="center" class="Estilo1">Stock</td>
											<td  valign="center" class="Estilo1">Precio</td>
										</tr>

										<?
										if ($numoc<>'') {
											$where1=" b.oc_id2 like  '%$numoc%' and ";
										}
										if ($especificacion<>'') {
											$where2=" d.doc_especificacion like  '%$especificacion%' and ";
										}
										$sql3 = "SELECT * FROM bode_ingreso a INNER JOIN bode_orcom b ON b.oc_id = a.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = a.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE $where1 $where2 c.ding_recep_tecnica = 'A' AND c.ding_cantidad AND ".$region." AND c.ding_unidad <> 0 AND b.oc_estado = 1 AND d.doc_estado <> 'B' LIMIT 20";
											//echo $sql3;
										$i=0;
										$res3 = mysql_query($sql3);
										while ($row3 = mysql_fetch_array($res3)) {

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
													<input type="text" name="var3b[<? echo $i ?>]" class="Estilo2" size="40"  disabled value="<? echo $row3["doc_especificacion"] ?>" >
													<input type="hidden" name="var3[<? echo $i ?>]" class="Estilo2" size="40"   value="<? echo $row3["doc_especificacion"] ?>" >
												</td>
												<td class="Estilo1">
													<input type="text" name="var4b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="<? echo number_format($stock,0,',','.'); ?>" >
													<input type="hidden" name="var4[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["ding_cantidad"]; ?>" >
												</td>
												<td class="Estilo1">
													<input type="text" name="var5b[<? echo $i ?>]" class="Estilo2" size="7"  disabled value="$<? echo number_format($row3["doc_conversion"],0,',','.'); ?>" >
													<input type="hidden" name="var5[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["doc_conversion"]; ?>" >
													<input type="hidden" name="var6[<? echo $i ?>]" class="Estilo2" size="7"   value="<? echo $row3["doc_numerooc"]; ?>" >
												</td>
												<td class="Estilo1">
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
									<input type="hidden" name="tJardines" value="<? echo $tJardines ?>"  >
									<input type="hidden" name="masid" value="<? echo $masid ?>"  >
								</form>


</div>

<script type="text/javascript">
	function check(){
		var totalElementos = $("#totalElementos").val();
		totalElementos = parseInt(totalElementos);
		if(totalElementos == 0){
			alert("DEBE AGREGAR ALMENOS 1 PRODUCTO A LA GUIA DE DESPACHO.");
			return false;
		}else{
			$("#btnCerrar").hide();
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

