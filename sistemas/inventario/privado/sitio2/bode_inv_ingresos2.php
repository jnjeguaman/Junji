<?php
extract($_GET);
if($regionsession == 13 || $regionsession == 16 || $regionsession == 2)
{
	$array_ubi = array();
	$sql_ubi = "SELECT * FROM bode_ubicacion WHERE ubi_estado = 1 AND ubi_region = ".$regionsession." ORDER BY ubi_glosa ASC";
	$res_ubi = mysql_query($sql_ubi);
	while($row_ubi = mysql_fetch_array($res_ubi))
	{
		$array_ubi[] = $row_ubi;
	}
}
?>
<div  style="width:630px; height:210px; background-color:#E0F8E0; position:absolute; top:120px; left:810px;" id="div2">
	<div id="seccion1" style="background-color:#E0F8E0;" >
		<!-- Recupera la ORDEN DE COMPRA SELECCIONADA Y LA MUESTRA 		-->
		<?
		if($_SESSION["region"] == 16)
		{
			$jardines = mysql_query("SELECT * FROM jardines WHERE jardin_region = 13");
		}else{
			$jardines = mysql_query("SELECT * FROM jardines WHERE jardin_region = ".$_SESSION["region"]);
		}
		// $jardines = mysql_query("SELECT * FROM jardines WHERE jardin_region = 13");

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
			$v_oc_tipo							= intval($row2["oc_tipo"]); //0:OC / 1:GD
			$v_folioguia 						= $row2["oc_folioguia"];

			$v_chofer = $row2["oc_chofer"];
			$v_patente = $row2["oc_patente"];
		}//while

		?>

		<table border="0"  width="100%">
			<tr>
				<td  class="Estilo2titulo" colspan="10">INGRESO DE ORDEN DE COMPRA</td>
			</tr>
			<tr>
				<td class="Estilo1c">Id OC </td>
				<td class="Estilo2"><? echo $v_oc_id ?> </td>
				<td class="Estilo1c">Nro. OC</td>
				<td  class="Estilo2"><? echo ($v_oc_tipo == 0) ? $v_oc_id2 : $v_folioguia ?></td>
			</tr>

			<tr>
				<td class="Estilo1c">Proveedor </td>
				<td  class="Estilo2"><? echo $v_pro_rut ?> </td>
				<td colspan="2"  class="Estilo2"><? echo $v_pro_glosa ?></td>
			</tr>

			<tr>
				<td class="Estilo1c">Fecha </td>
				<td  class="Estilo2"><? echo $v_oc_fecha ?> </td>
				<td class="Estilo1c">Region</td>
				<td  class="Estilo2"><? echo $v_oc_region ?></td>
			</tr>

			<tr>
				<td class="Estilo1c">Nombre OC </td>
				<td colspan="3"  class="Estilo2"><? echo $v_oc_nombre_oc ?> </td>
			</tr>

		</table>
		<hr>
		<!-- BUSQUEDA DEL ESTADO DE LA OC ACTUAL -->
		<?php
		$tmp_oc = explode("-",$v_oc_id2);
		if($v_oc_tipo == 0)
		{
			$oc = $v_oc_id2;
			include("buscaorden3.php");
			$objOC = new OrdenDeCompra();
			$estado = $objOC->getEstadoOC($oc);

			if($estado == "OC Aceptada")
			{
				$texto = "<font color='green'>".$estado."</font>";
			}else if($estado == "OC Enviada a Proveedor" || $estado == "Recepción Conforme"){
				$texto = "<font color='orange'>".$estado."</font>";
			}else{
				$texto = "<font color='red'>".$estado."</font>";
			}

			echo "
			<table border='1' width='70%' align='center' cellspacing='0' cellpadding='10'>
				<tr>
					<td class='Estilo1'>ESTADO DE LA ORDEN DE COMPRA</td>
					<td class='Estilo1'>".$texto."</td>
				</tr>

				<tr>
					<td class='Estilo1'>HORA DE LA CONSULTA</td>
					<td class='Estilo1'>".Date("H:i:s")."
					</table>
					";
				}else{
					$transporte = mysql_query("SELECT * FROM bode_transporte a INNER JOIN acti_proveedor b ON b.proveedor_id = a.transporte_empresa_id INNER JOIN bode_chofer c ON c.chofer_empresa_id = a.transporte_empresa_id WHERE c.chofer_nombre LIKE '%".$v_chofer."%' LIMIT 1");
					$rsTransporte = mysql_fetch_array($transporte);
					$v_transporte = $rsTransporte["proveedor_glosa"];

					echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
					<tr>
						<td class='Estilo2titulo' colspan='2'>INFORMACION DE TRANSPORTE</td>
					</tr>

					<tr>
						<td class='Estilo1'>TRANSPORTE</td>
						<td class='Estilo1'>".$v_transporte."</td>
					</tr>

					<tr>
						<td class='Estilo1'>CHOFER</td>
						<td class='Estilo1'>".$v_chofer."</td>
					</tr>

					<tr>
						<td class='Estilo1'>PATENTE VEHICULO</td>
						<td class='Estilo1'>".$v_patente."</td>
					</tr>


				</table>";
			}

			?>



			<?php if ($estado == "OC Aceptada" || $estado == "OC Enviada a Proveedor" || $estado == "Recepción Conforme" || $estado == "OC en Proceso" || $v_oc_tipo == 1 || $tmp_oc[0] == "DTT"): ?>

				<!-- FIN BUSQUEDA DE LA OC -->
				<hr>
				<!-- COMIENZO DEL FORMULARIO -->

				<form name="f1" method="POST" action="bode_inv_ingresos_gr.php" onSubmit="return valida()">

					<table border="0"  width="100%">
						<TR>
							<td class="Estilo1"> Nro. Guia o Factura</td>
							<td colspan="2"><input type="text" name="f_guia" id="f_guia" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onBlur="valGuia(this.value)" <?php echo ($v_oc_tipo == 1) ? "readonly class='bloqueado' value='".$v_folioguia."'" :'' ?>></td>
						</TR>

						<TR>
							<td class="Estilo1">Fecha Entrega</td>
							<td colspan="2">
								<input type="text" class="Estilo1" size="9" id="f_fentrega" name="f_fentrega" value="<?php echo ($v_oc_tipo == 1) ? $v_oc_fecha : ''?>" readonly style="background-color: rgb(235, 235, 235)">
								<img src="calendario.gif" id="f_trigger_c" style="cursor: pointer; border: 1px solid red;" title="Date selector"
								onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
								<script type="text/javascript">
									Calendar.setup({
										inputField  : "f_fentrega",
										ifFormat  : "%Y-%m-%d",
										button   : "f_trigger_c",
										align   : "Bl",
										singleClick : true
									});
								</script>

							</td>
						</TR>
						
						<?php if($v_oc_tipo <> 1): ?>
							<tr>
								<td class="Estilo1">Lugar de Entrega</td>
								<td colspan="2">
									<select class="Estilo1" name="lentrega" id="lentrega" onChange="mostrar(this.value)" required="">
										<option value="">Seleccionar...</option>
										<option value="1">JARDIN INFANTIL</option>
										<option value="2">BODEGA</option>
										<option value="3">DIRECCION REGIONAL</option>
									</select>
								</td>	
							</tr>
							<tr id="jardines">
								<td class="Estilo1">Seleccionar Jardin</td>
								<td>
									<select class="Estilo1" name="gesparvu" id="gesparvu" >
										<option value="">Seleccionar...</option>
										<?php while($rj = mysql_fetch_array($jardines))
										{
											echo "<option value='JI ".$rj["jardin_codigo"]."'>".$rj["jardin_codigo"]." : ".$rj["jardin_nombre"]."</option>";
										}
										?>
									</select>
								</td>
							</tr>

							<tr id="dr">
								<td class="Estilo1">Seleccionar Direccion</td>
								<td>
									<select class="Estilo1" name="direccionRegional" id="direccionRegional" >
										<option value="">Seleccionar...</option>
										<?php 
										$dr = "SELECT * FROM acti_zona WHERE zona_glosa NOT LIKE '%JI %' AND zona_region = ".$_SESSION["region"];
										$dr = mysql_query($dr);
										while($rj = mysql_fetch_array($dr))
										{
											echo "<option value='".$rj["zona_glosa"]."'>".$rj["zona_glosa"]."</option>";
										}
										?>
									</select>
								</td>
							</tr>

							<tr>
								<td class="Estilo1">Ubicación</td>
								<td>
									<?php if ($regionsession == 13 || $regionsession == 16 || $regionsession == 2): ?>
										<select name="toggle_ubi" id="toggle_ubi" class="Estilo1" onChange="unToggle()">
											<option value="">Seleccionar</option>
											<?php foreach ($array_ubi as $key => $value): ?>
												<option value="<?php echo $value["ubi_glosa"] ?>"><?php echo $value["ubi_glosa"] ?></option>
											<?php endforeach ?>
										</select>
									<?php else: ?>
										<input type="text" name="toggle_ubi" id="toggle_ubi" onkeypress="unToggle()">
									<?php endif ?>
									<td class="Estilo1mc" style="text-align: left"><input type="radio" class="Estilo1" id="toggle">Seleccionar todo</td>
								</td>
							</tr>
						<?php endif ?>

					</table>
					<hr>
					<table border="0"  width="100%">
						<tr>
							<td  class="Estilo1mc"></td>
							<td  class="Estilo1mc">id</td>
							<td  class="Estilo1mc">Especificacion</td>
							<?php if ($v_oc_tipo == 1): ?>
								<td class="Estilo1mc">O/C Asociada</td>
							<?php endif ?>
							<td  class="Estilo1mc">Cantidad</td>
							<td  class="Estilo1mc">V. Unit</td>
							<td  class="Estilo1mc">Recibido</td>
							<td  class="Estilo1mc">Pendiente</td>
							<td  class="Estilo1mc">Cant.Ingreso</td>
							<td  class="Estilo1mc">Ubicacion</td>

						</tr>
						<?
		   // Recupera las lineas de la Orden de COMPRA

												//$consulta="select * from bode_detoc where doc_oc_id = '$id' and doc_region='$regionsession' and doc_id='$doc_id'";
						if (intval($regionsession) === 16) {

							$consulta="select * from bode_detoc where doc_oc_id = '$id' and (doc_region = 16 OR doc_region = 13) AND doc_estado <> 'ELIMINADO' order by doc_id asc";
						} else {
							$consulta="select * from bode_detoc where doc_oc_id = '$id' and doc_region='$regionsession' AND doc_estado <> 'ELIMINADO' order by doc_id asc";
						}


// echo $consulta;
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
							$v_doc_numerooc		  = $arr["doc_numerooc"];

							$v_prod_nombre         = $arr['prod_nombre'];

							$v_origen_id	      =$arr["doc_origen_id"];

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
								<?php if ($pendiente == 0): ?>
									<td></td>
								<?php else: ?>
									<td>
										<?php if($v_oc_tipo == 1): ?>

											<?php
											$sql_clasificacion = "SELECT * FROM bode_detingreso WHERE ding_id = ".$v_origen_id;
											$res_clasificacion = mysql_query($sql_clasificacion);
											$row_clasificacion = mysql_fetch_array($res_clasificacion);
											$clasificacion = $row_clasificacion["ding_clasificacion"];
											
											?>
											<input type="checkbox" name="var1[<? echo $cont ?>]" id="var1_<?php echo $cont ?>" class="Estilo2" size="40"  value="<? echo $cont ?>" onClick="setPropiedad(<?php echo $cont ?>)" checked></td>
										<?php else: ?>
											<input type="checkbox" name="var1[<? echo $cont ?>]" id="var1_<?php echo $cont ?>" class="Estilo2" size="40"  value="<? echo $cont ?>" onClick="setPropiedad(<?php echo $cont ?>)"></td>
										<?php endif ?>

										<input type="hidden" name="var2[<? echo $cont ?>]" value="<?php echo $clasificacion ?>">
										<input type="hidden" name="var3[<? echo $cont ?>]" value="<?php echo $sql_clasificacion ?>">

									<?php endif ?>
									<td class="<? echo $estilo2 ?>"><? echo $v_doc_id ?></td>
									<td class="<? echo $estilo2 ?>"><? echo $v_doc_especificacion ?></td>
									<?php if ($v_oc_tipo == 1): ?>
										<td class="<? echo $estilo2 ?>"><?php echo $v_doc_numerooc ?></td>
									<?php endif ?>
									<td class="<? echo $estilo2 ?>"><? echo $v_doc_cantidad ?></td>
									<td class="<? echo $estilo2 ?>"><? echo $v_doc_valor_unit ?></td>
									<td class="<? echo $estilo2 ?>"><? echo $v_doc_recibidos ?></td>
									<td class="<? echo $estilo2 ?>"><? echo $v_doc_cantidad - $v_doc_recibidos ?></td>

									<?php if ($pendiente === 0): ?>
										<td></td>
									<?php else: ?>
										<td class="<? echo $estilo2 ?>">
											<input type="hidden" name="f_doc_id[<? echo $cont ?>]" value="<? echo $v_doc_id ?>">
											<?php if($v_oc_tipo == 1): ?>
												<input type="number" name="f_cant[<? echo $cont ?>]" id="f_cant_<?php echo $cont ?>" size="6" min="1" max="<?php echo $pendiente ?>" value="<?php echo $pendiente ?>">
											<?php else:?>
												<input type="number" name="f_cant[<? echo $cont ?>]" id="f_cant_<?php echo $cont ?>" size="6" min="1" max="<?php echo $pendiente ?>">
											<?php endif ?>
										</td>
									<?php endif ?>


									<?php if ($pendiente === 0): ?>
									<?php else: ?>
										<td>
											<?php if ($regionsession == 16 || $regionsession == 13 || $regionsession == 2): ?>
												
												<select class="Estilo1" name="f_ubica[<?php echo $cont?>]" id="f_ubica_<?php echo $cont ?>">
													<option value="" selected>Seleccionar...</option>
													<?php foreach ($array_ubi as $key => $value): ?>
														<option value="<?php echo $value["ubi_glosa"] ?>"><?php echo $value["ubi_glosa"] ?></option>
													<?php endforeach ?>
												</select>
											<?php else: ?>
												<input type="text" name="f_ubica[<? echo $cont ?>]" id="f_ubica_<?php echo $cont ?>" <?php if($v_oc_tipo == 1){echo"required ";} ?>size=10>
											<?php endif ?>
										</td>
									<?php endif ?>


								</tr>

								<?
							}
							?>
							<tr>
								<td colspan="9">
									<input type="hidden" name="f_cont" value="<? echo $cont ?>">
									<input type="hidden" name="id_oc" value="<? echo $id ?>">
									<input type="hidden" name="ori" value="<? echo $ori ?>">
									<input type="hidden" name="oc" id="oc" value="<?php echo $v_oc_id2 ?>">
									<input type="hidden" name="oc_tipo" id="oc_tipo" value="<?php echo $v_oc_tipo ?>">
									<input type="submit" value="Grabar" id="btngrabar">
									<input type="hidden" name="proveedor" value="<?php echo $v_pro_glosa ?>">
								</td>
							</tr>
						</table>
					</form>
				<?php endif ?>
			</div>
		</div>

		<script type="text/javascript">
			$(function(){
				$("#jardines").hide();
				$("#dr").hide();
			})
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

				var fecha2 = "<?php echo Date("Y-m-d")?>";
				var miFecha = new Date("<?php echo Date("Y-m-d")?>").getTime();
				var fecha = new Date($("#f_fentrega").val()).getTime();

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
				}else if(fecha > miFecha){
					alert("DEBE SELECCIONAR UNA FECHA INFERIOR O IGUAL A "+fecha2);
					$("#f_fentrega").focus();
					return false;

				}else{
					if(confirm("¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?"))
					{
						document.getElementById('btngrabar').style.display = 'none';
						$("#btngrabar").hide();
						blockUI();
						return true;
					}else{
						return false;
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

			function verificaFecha(input)
			{
				console.log(input);
			}

			function mostrar(input)
			{
		// 1 : JARDIN INFANTIL
		// 2 : BODEGA
		// 3 : DIRECCION REGIONAL

		if(input == 1)
		{
			$("#jardines").show(); // SELECT DE LOS JARDINES
			$("#gesparvu").prop("required",true);
			$("#dr").hide();
			$("#direccionRegional").prop("required",false);
		}

		if(input == 2)
		{
			$("#jardines").hide();
			$("#dr").hide();
			$("#gesparvu").prop("required",false);
			$("#direccionRegional").prop("required",false);
		}

		if(input == 3)
		{
			$("#dr").show();
			$("#direccionRegional").prop("required",true);
			$("#jardines").hide();
			$("#gesparvu").prop("required",false);
		}
		// if(input == 1)
		// {
		// 	$("#jardines").fadeIn("slow");
		// 	$("#gesparvu").prop("required",true);
		// 	$("#dr").hide();
		// }
		// // else{
		// 	// $("#jardines").fadeOut("slow");
		// 	// $("#gesparvu").prop("required",false);
		// // }

		// if(input == 3)
		// {
		// 	$("#dr").show();
		// 	$("#jardines").hide("slow");
		// }else{
		// }

		// if(input == 2)
		// {
		// 	$("#jardines").show();
		// 	$("#gesparvu").hide();
		// 	$("#dr").hide();
		// }
	}


	var totalElementos = <?php echo $cont ?>;
	var regionsession = <?php echo $regionsession ?>;

	$("#toggle").click(function(event){
		// COMPROBAMOS LA REGION DEL USUARIO
		if(regionsession == 13 || regionsession == 16)
		{
			// VERIFICAMOS SI EL BOTON SELECCIONAR TODO FUE CLICKEADO
			if($("#toggle").is(":checked"))
			{
				var ubi_id = $("#toggle_ubi option:selected").val();
				var ubi_texto = $("#toggle_ubi option:selected").text();
				for (var i = 1; i <= totalElementos; i++) {
					$("#f_ubica_"+i+" option:selected").text(ubi_texto);
					$("#f_ubica_"+i+" option:selected").val(ubi_id);
				}
			}else{
				for (var i = 1; i <= totalElementos; i++) {
					$("#f_ubica_"+i+" option:selected").text('Seleccionar...');
					$("#f_ubica_"+i+" option:selected").val('');
				}
			}
		}else{
			if($("#toggle").is(":checked"))
			{
				for (var i = 1; i <= totalElementos; i++) {
					$("#f_ubica_"+i).val($("#toggle_ubi").val());
				}
			}else{
				for (var i = 1; i <= totalElementos; i++) {
					$("#f_ubica_"+i).val('');
				}
			}
		}
	});

	function unToggle()
	{
		$('#toggle').prop('checked',false);
	}
</script>
