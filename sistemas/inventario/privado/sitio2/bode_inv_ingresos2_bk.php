<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:850px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >

		<!-- Recupera la ORDEN DE COMPRA SELECCIONADA Y LA MUESTRA 		-->
		<?

		$sql2 = "SELECT * FROM bode_orcom where  oc_id = '$id'";
//		    $sql2 = "SELECT * FROM bode_orcom,bode_proveedor where oc_pro_id = pro_id and oc_id = '$id_oc'";
//            echo $sql2;
		$res2 = mysql_query($sql2);
		$sw_color=0;
		$oc_id=$id;
		while ($row2 = mysql_fetch_array($res2)) {
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
			$v_pro_glosa            = $row2['oc_proveenomb'];
		}
		
		
		?>

		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">INGRESO A ORDEN DE COMPRA</td>
			</tr>
			<tr>
				<td class="Estilo1c">Id OC </td>
				<td class="Estilo2"><? echo $v_oc_id ?> </td>
				<td class="Estilo1c">Nro. OC</td>
				<td  class="Estilo2"><? echo $v_oc_id2 ?></td>
				<tr>

					<tr>
						<td class="Estilo1c">Proveedor </td>
						<td  class="Estilo2"><? echo $v_pro_rut ?> </td>
						<td colspan="2"  class="Estilo2"><? echo $v_pro_glosa ?></td>

						<tr>

							<tr>
								<td class="Estilo1c">Fecha </td>
								<td  class="Estilo2"><? echo $v_oc_fecha ?> </td>
								<td class="Estilo1c">Region</td>
								<td  class="Estilo2"><? echo $v_oc_region ?></td>
								<tr>

									<tr>
										<td class="Estilo1c">Nombre OC </td>
										<td colspan="3"  class="Estilo2"><? echo $v_oc_nombre_oc ?> </td>

										<tr>




										</table>
										<hr>

										<!-- COMIENZO DEL FORMULARIO -->


										<form name="f1" method="POST" action="bode_inv_ingresos_gr.php" onSubmit="return valida()">

											<table border="0"  width="100%">
												<TR>
													<td class="Estilo1"> Nro. Guia o Factura</td>
													<td><input type="text" name="f_guia" id="f_guia" onBlur="valGuia(this.value)"></td>
												</TR>

												<TR>
													<td class="Estilo1">Fecha Entrega</td>
													<td>

														<input type="text" class="Estilo1" size="9" id="f_fentrega" name="f_fentrega" readonly style="background-color: rgb(235, 235, 235)" >
														<img src="calendario.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
														onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
														<script type="text/javascript">
															Calendar.setup({
																inputField  : "f_fentrega",
																ifFormat  : "%d-%m-%Y",
																button   : "f_trigger_c",
																align   : "Bl",
																singleClick : true
															});
														</script>

													</td>
												</TR>

											</table>
											<table border="1"  width="100%">
												<tr>
													<td  class="Estilo1mc"></td>
													<td  class="Estilo1mc">id</td>
													<td  class="Estilo1mc">Especificacion</td>
													<td  class="Estilo1mc">Cantidad</td>
													<td  class="Estilo1mc">V. Unit</td>
													<td  class="Estilo1mc">Recibido</td>
													<td  class="Estilo1mc">Pendiente</td>
													<td  class="Estilo1mc">Cant.Ingreso</td>
													
													<?php if ($regionsession == 16): ?>
														<td class="Estilo1mc">BODEGA</td>
														<td class="Estilo1mc">PASILLO</td>
														<td class="Estilo1mc">UBICACION</td>
													<?php else: ?>
														<td  class="Estilo1mc">Ubicacion</td>
													<?php endif ?>

												</tr>
												<?
		   // Recupera las lineas de la Orden de COMPRA

												//$consulta="select * from bode_detoc where doc_oc_id = '$id' and doc_region='$regionsession' and doc_id='$doc_id'";
												if (intval($regionsession) === 16) {

													$consulta="select * from bode_detoc where doc_oc_id = '$id' and (doc_region = 16 OR doc_region = 13)";
												} else {
													$consulta="select * from bode_detoc where doc_oc_id = '$id' and doc_region='$regionsession'";
												}
												
												
//echo $consulta;
//		   $consulta="select * from bode_detoc,bode_producto where doc_prod_id = prod_id and  doc_oc_id = '$id_oc'";
												$res=mysql_query($consulta);
												$sw_color=0;
												$cont=0;
												while ($arr=mysql_fetch_array($res)){
													$v_doc_id	          = $arr['doc_id'];
													$v_doc_oc_id	      = $arr['doc_oc_id'];
													$v_doc_prod_id	      = $arr['doc_prod_id'];
													$v_doc_especificacion = $arr['doc_especificacion'];
													$v_doc_cantidad	      = $arr['doc_cantidad'];
													$v_doc_valor_unit	  = $arr['doc_valor_unit'];
													$v_doc_recibidos	  = $arr['doc_recibidos'];
													$v_doc_estado         = $arr['doc_estado'];

													$v_prod_nombre         = $arr['prod_nombre'];

													$pendiente = intval($v_doc_cantidad - $v_doc_recibidos);

													if ($sw_color==0){
														$estilo2 = "Estilo1mc";
														$sw_color = 1;
													}else{
														$estilo2 = "Estilo1mcblanco";
														$sw_color = 0;
													}

													$cont++;
													?> 
													<tr>
														<?php if ($pendiente === 0): ?>
															<td></td>
														<?php else: ?>
															<td><input type="checkbox" name="var1[<? echo $cont ?>]" id="var1_<?php echo $cont ?>" class="Estilo2" size="40"  value="<? echo $cont ?>" onClick="setPropiedad(<?php echo $cont ?>)"></td>
														<?php endif ?>
														<td class="<? echo $estilo2 ?>"><? echo $v_doc_id ?></td>
														<td class="<? echo $estilo2 ?>"><? echo $v_doc_especificacion ?></td>
														<td class="<? echo $estilo2 ?>"><? echo $v_doc_cantidad ?></td>
														<td class="<? echo $estilo2 ?>"><? echo $v_doc_valor_unit ?></td>
														<td class="<? echo $estilo2 ?>"><? echo $v_doc_recibidos ?></td>
														<td class="<? echo $estilo2 ?>"><? echo $v_doc_cantidad - $v_doc_recibidos ?></td>

				<?php if ($pendiente === 0): ?>
					<td></td>
				<?php else: ?>
					<td class="<? echo $estilo2 ?>">
						<input type="hidden" name="f_doc_id[<? echo $cont ?>]" value="<? echo $v_doc_id ?>">
						<!--<input type="text" name="f_cant[<?// echo $cont ?>]" size=6>!-->
						<input type="number" name="f_cant[<? echo $cont ?>]" id="f_cant_<?php echo $cont ?>" size="6" min="1" max="<?php echo $pendiente ?>">
					</td>
				<?php endif ?>

				
				<?php if ($pendiente === 0): ?>
				<?php else: ?>
					<?php if ($regionsession <> 16): ?>
						<td class="<? echo $estilo2 ?>">
					<input type="text" name="f_ubica[<? echo $cont ?>]" id="f_ubica_<?php echo $cont ?>" size=6>
					</td>
				<?php else: ?>
					<input type="hidden" name="f_ubica[<? echo $cont ?>]" id="f_ubica_<?php echo $cont ?>" size=6>
					<?php endif ?>
				<?php endif ?>

				<?php if ($regionsession == 16): ?>
					<?php
							// Obtener las bodegas
					$bodegas = "SELECT DISTINCT(ubi_glosa), ubi_bode FROM bode_ubicacion  WHERE ubi_estado = 1";
					$bodegas = mysql_query($bodegas);
					?>
					
					<td>
					<input type="hidden" id="ubi_ubi_<?php echo $cont ?>" name="ubi_ubi">
					<!-- LISTADO DE LAS BODEGAS !-->
						<select class="Estilo1mc" name="ubi_bodega" id="ubi_bodega_<?php echo $cont ?>" onchange="getPasillo(this.value,<?php echo $cont ?>)">
							<option value="" selected>Seleccionar...</option>
							<?php while ($bode = mysql_fetch_array($bodegas)) { ?>
							<option value="<?php echo $bode["ubi_bode"] ?>"><?php echo $bode["ubi_glosa"] ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
					<!-- LISTADO DE LOS PASILLOS !-->
						<select class="Estilo1mc" name="ubi_pasillo" id="ubi_pasillo_<?php echo $cont ?>" onChange='getUbicacion(this.value,<?php echo $cont ?>)'>
							<option value="" selected>Seleccionar...</option>
						</select>
					</td>
					<td>
					<!-- LISTADO DE LAS UBICACIONES !-->
						<select class="Estilo1mc" name="ubi_ubi2" id="ubi_ubi2_<?php echo $cont ?>" onChange="setUbi(<?php echo $cont ?>)">
							<option value="" selected>Seleccionar...</option>
						</select>
					</td>
					
				<?php endif ?>
				
				
			</tr>

			<?
		}
		?>
		<tr>
			<?php if ($regionsession == 16): ?>
				<td colspan="12">
				<?php else: ?>
					<td colspan="9">
					<?php endif ?>
					<input type="hidden" name="f_cont" value="<? echo $cont ?>">
					<input type="hidden" name="id_oc" value="<? echo $id ?>">
					<input type="hidden" name="ori" value="<? echo $ori ?>">
					<input type="hidden" name="oc" id="oc" value="<?php echo $v_oc_id2 ?>">
					<input type="submit" value="Grabar" id="btngrabar">
				</td>
			</tr>
		</table>
	</form>
</div>
</div>

<script type="text/javascript">

function setUbi(input){
	var bodega 		= $("#ubi_bodega_"+input).val();
	var pasillo 	= $("#ubi_pasillo_"+input).val();
	var ubicacion 	= $("#ubi_ubi2_"+input).val();

	var concatena = bodega+"-"+pasillo+"-"+ubicacion;
	if(bodega == "PATIO"){
				$("#f_ubica_"+input).val("PATIO");
			}else if(bodega == "CROSSDOCKING"){
				$("#f_ubica_"+input).val("CROSS DOCKING");
			}else{
				$("#f_ubica_"+input).val(concatena);
			}

	console.log($("#f_ubica_"+input));
	//$("#f_ubica_"+input).val(concatena);
}
	function getUbicacion(input,cont){
		var x = $("#ubi_ubi_"+cont).val();
		var data = ({cmd : "getUbicacion", ubi_pasillo : input, bodega : x});
		console.log(data);
		$.ajax({
			type:"POST",
			url:"ubicaciones.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				$("#ubi_ubi2_"+cont).html(response);
			}
		});
	}

	function getPasillo(input,cont){
		var data = ({cmd : "getPasillo", bode_code : input});
		$.ajax({
			type:"POST",
			url:"ubicaciones.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				$("#ubi_ubi_"+cont).val(input);
				$("#ubi_pasillo_"+cont).html(response);
			}
		});
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

	function valida()
	{



		var numberOfChecked = $('input:checkbox:checked').length;
		numberOfChecked = parseInt(numberOfChecked);
		var region = parseInt("<?php echo $_SESSION["region"] ?>");

		if(region == 16 || region == 13){
			var bodega = $("#ubi_bodega option:selected").val();
			var pasillo = $("#ubi_pasillo option:selected").val();
			var ubicacion = $("#ubi_ubi2 option:selected").val();
			var concatena = bodega+"-"+pasillo+"-"+ubicacion;
			if($("#f_guia").val() == ""){
				alert("INGRESE EL NUMERO DE GUIA DEL PROVEEDOR");
				$("#f_guia").focus();
				return false;
			}else if($("#f_fentrega").val() == ""){
				alert("SELECCIONE LA FECHA DE ENTREGA");
				$("#f_fentrega").focus();
				return false;
			}else if(numberOfChecked === 0){
				alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA.")
				return false;
			}else{
				document.getElementById('btngrabar').style.display = 'none';
				$("#btngrabar").fadeOut("slow");
				$("#carga2").removeAttr("style");
				return true;
			}

		}else{
			if($("#f_guia").val() == ""){
				alert("INGRESE EL NUMERO DE GUIA DEL PROVEEDOR");
				$("#f_guia").focus();
				return false;
			}else if($("#f_fentrega").val() == ""){
				alert("SELECCIONE LA FECHA DE ENTREGA");
				$("#f_fentrega").focus();
				return false;
			}else if(numberOfChecked === 0){
				alert("DEBE SELECCIONAR AL MENOS 1 ITEM DE LA LISTA.")
				return false;
			}else{
				document.getElementById('btngrabar').style.display = 'none';
				$("#btngrabar").hide();
				return true;
			}
		}

	}

	function valGuia(guia){
		var data = ({ oc_numero : $("#oc").val(), n_guia : $("#f_guia").val()});
		$.ajax({
			type:"POST",
			url:"bode_valida_guia.php",
			data:data,
			dataType:"JSON",
			success : function ( response ) {
				if(response){
					alert("LA GUIA DE DESPACHO '"+$("#f_guia").val()+"' YA SE ENCUENTRA ASOCIADA A LA ORDEN DE COMPRA '"+$("#oc").val()+"' ");
					$("#f_guia").focus();
					$("#f_guia").val("");
				}
			}
		});
	}

	function setPropiedad(input){

		if($("#var1_"+input).is(":checked")){
			$("#f_cant_"+input).prop("required",true);
			$("#f_ubica_"+input).prop("required",true);
		}else{
			$("#f_cant_"+input).prop("required",false);
			$("#f_ubica_"+input).prop("required",false);
		}
	}
</script>
