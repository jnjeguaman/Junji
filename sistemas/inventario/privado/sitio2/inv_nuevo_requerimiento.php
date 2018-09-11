<div style="width:800px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">INGRESO NUEVO REQUERIMIENTO</td>
		</tr>
	</table>

	<form name="form1" action="inv_graba_nuevo_requerimiento.php" method="post" onsubmit="return validar()">
		<table border="0" width="100%">
			<tr>
				<td valign="center" class="Estilo1">GRUPO</td>
				<td class="Estilo1">
					<select name="grupo" id="grupo" class="Estilo2" onChange="getSubCat(this.value)">
						<option selected value="">Seleccionar...</option>
						<?php
						while($row = mysql_fetch_array($sqlCategoriaResp)) {
							?>
							<option value="<?php echo $row["cat_id"] ?>"><?php echo utf8_decode($row["cat_nombre"]) ?></option>
							<?php } ?>
						</select>
					</td>

					<td valign="center" class="Estilo1">SUB-GRUPO</td>
					<td class="Estilo1" colspan="3">
						<select name="subgrupo" id="subgrupo" class="Estilo2" readonly>
							<option value="">Seleccionar...</option>
						</select>
					</td>
				</tr>

				<tr>
					<td valign="center" class="Estilo1">SUBTITULO</td>
					<td class="Estilo1">
						<select name="subtitulo" id="subtitulo" class="Estilo2" onChange="getSubtitulo(this.value)">
							<option selected value="">Seleccionar...</option>
							<?php
							while($row = mysql_fetch_array($sqlSubtituloResp)) {
								?>
								<option value="<?php echo $row["acti_subtitulo"] ?>"><?php echo $row["acti_subtitulo"]." : ".$row["acti_subtitulo_dec_item"] ?></option>
								<?php } ?>
							</select>
						</td>

						<td valign="center" class="Estilo1">ITEM</td>
						<td class="Estilo1" colspan="3">
							<select name="item" id="item" class="Estilo2">
								<option selected value="">Seleccionar...</option>
							</select>
						</td>
					</tr>


					<tr> 
						<td class="Estilo1">CANTIDAD TOTAL</td>
						<td class="Estilo1">
							<input type="text" name="cantidad" id="cantidad" class="Estilo2" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
						</td>

						<td class="Estilo1">MONTO TOTAL C / IVA</td>
						<td class="Estilo1" colspan="3">
							<input type="text" name="total" id="total" class="Estilo2" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
						</td>
					</tr>

					<tr> 
						<td class="Estilo1">PROGRAMA</td>
						<td class="Estilo1">
							<select name="programa" id="programa" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($programas as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
								<?php endforeach ?>
							</select>
						</td>

						<td class="Estilo1">TIPO CAMBIO</td>
						<td class="Estilo1">
							<select name="moneda" id="moneda" class="Estilo2" onChange="tipoCambio(this.value)">
								<option selected value="">Seleccionar...</option>
								<option value="PESO">PESO</option>
								<option value="DOLAR">DOLAR</option>
								<option value="EURO">EURO</option>
							</select>	
						</td>

						<td class="Estilo1">
							<input type="text" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="6" size="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46'>
						</td>

					</tr>

					<tr>
						<td class="Estilo1">TIPO COMPRA</td>
						<td class="Estilo1" colspan="5">
							<select name="tipo_compra" id="tipo_compra" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($tCompras as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">PROVEEDOR</td>
						<td class="Estilo1" colspan="5">
							<select name="proveedor" id="proveedor" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<?php
								while($row = mysql_fetch_array($sqlProveedorResp)) {
									?>
									<option value="<?php echo $row["proveedor_glosa"] ?>"><?php echo $row["proveedor_glosa"] ?></option>
									<?php } ?>
								</select>
								<?php if ($atributo != 23): ?>
									<a href="#" id="nuevoProveedor">NUEVO PROVEEDOR</a>
								<?php endif ?>

							</td>
						</tr>

					</table>

					<br>
					<?php if ($atributo != 23): ?>
						<table border="0" width="100%">
							<tr>
								<td class="Estilo1c">
									<input type="submit" name="submit" class="Estilo2" size="11" value="  GRABAR  ">
								</td>
								<td class="Estilo1c">
									<input type="button" class="Estilo2" size="11" value="  NUEVO PRODUCTO  " onClick="nuevoProducto(<?php echo $_SESSION["region"] ?>)">
								</td>

							</tr>
						</table>
					<?php endif ?>

					<input type="hidden" name="compra_id" id="compra_id">
				</form>
				<hr>
				<?php include("ultimas.php") ?>

				<div class="muestraProveedor" style="visibility:hidden;overflow">
					<fieldset>
						<legend>INGRESO NUEVO PROVEEDOR</legend>
						<form id="frmProveedor">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td>(*) NOMBRE EMPRESA</td>
									<td><input type="text" name="proveedor_glosa" id="proveedor_glosa" required></td>
								</tr>

								<tr>
									<td>(*) RUT</td>
									<td><input type="text" name="proveedor_rut" id="proveedor_rut" required></td>
								</tr>

								<tr>
									<td>(*) NOMBRE CONTACTO</td>
									<td><input type="text" name="proveedor_contacto" id="proveedor_contacto" required></td>
								</tr>

								<tr>
									<td>(O) EMAIL</td>
									<td><input type="text" name="proveedor_email" id="proveedor_email"></td>
								</tr>

								<tr>
									<td>(O) TELEFONO</td>
									<td><input type="text" name="proveedor_telefono" id="proveedor_telefono"></td>
								</tr>

							</table>

							<br>

							<table border="0" width="100%">
								<tr>

									<td class="Estilo1c">
										<input type="button" value="   INGRESAR PROVEEDOR   " onClick="graba_proveedor()"/>
									</td>

								</tr>
							</table>

							<input type="hidden" name="proveedor_estado" id="proveedor_estado" value="1"/>
							<input type="hidden" name="cmd" id="cmd" value="grabarProveedor"/>
						</form>
					</fieldset>
				</div>
			</div>

			<script type="text/javascript">

				$("#nuevoProveedor").click(function(){
					$(".muestraProveedor").css("visibility","visible");
					$(".muestraProveedor").dialog({
						width:600,
						height:300,
						modal: true,
						resizable: true,
						autoResize: true
					});
				})

				function graba_proveedor()
				{
					var respuesta = false;
					if($("#proveedor_glosa").val() == "")
					{
						alert("INGRESE EL NOMBRE DE LA EMPRESA.");
						document.getElementById("proveedor_glosa").focus();
						respuesta = false;
					}else if($("#proveedor_rut").val() == ""){
						alert("INGRESE EL RUT DE LA EMPRESA.");
						document.getElementById("proveedor_rut").focus();
						respuesta = false;
					}else if($("#proveedor_contacto").val() == ""){
						alert("INGRESE EL CONTACTO DE LA EMPRESA.");
						document.getElementById("proveedor_contacto").focus();
						respuesta = false;
					}else{
						respuesta = true;
					}

					if(respuesta == true){
						var data = $("#frmProveedor").serializeArray();
						$.ajax({
							type:"post",
							url:"inv_graba_proveedor.php",
							data:data,
							dataType:"JSON",
							success : function(response){
								if(response == true)
								{
									$("#proveedor_glosa").val("");
									$("#proveedor_rut").val("");
									$("#proveedor_contacto").val("");
									$("#proveedor_email").val("");
									$("#proveedor_telefono").val("");
									getProveedores();
									$(".muestraProveedor").dialog( "close" );
								}else{
									alert("EL PROVEEDOR YA SE ENCUENTRA REGISTRADO EN NUESTRA BASE DE DATOS");
								}
							}
						});
					}

				}

				function getProveedores()
				{
					var data = ({cmd : "getProveedores"});
					$.ajax({
						type:"POST",
						url:"proveedor.php",
						data:data,
						dataType:"JSON",
						success : function ( response ) {

							var proveedor = "<option selected value=''>Seleccionar...</option>";
							$.each(response,function(index,value){
								proveedor += "<option value="+value+">"+value+"</option>";
							})
							$("#proveedor").html(proveedor);
						}
					})
				}

				$(function(){
					$("#proveedor_rut").Rut({
						on_error: function(){ alert('RUT INCORRECTO.'); 
						$("#proveedor_rut").val("");
						document.getElementById('proveedor_rut').focus();}
					});
					$("#tipo_cambio").hide();
					$(".muestraProveedor").hide();
				})

				function nuevoProducto(region_id)
				{
					var data = ({cmd : "ultimaCompra", region_id : region_id});
									// Buscamos la ultima de la region
									$.ajax({
										type:"POST",
										url:"ultimaCompra.php",
										data:data,
										dataType:"JSON",
										cache:false,
										success : function ( response ) {
											if(response == true){
												alert("NO SE HA PODIDO UTILIZAR LA INFORMACION DE LA COMPRA ANTERIOR DEBIDO A QUE YA FUE PROCESADA");
											}else{
												$("#compra_id").val(response.compra_id);
												$("#programa").val(response.compra_programa);
												$("#proveedor").val(response.compra_proveedor);
												$("#proveedor option:selected").text(response.compra_proveedor);
												$("#tipo_compra").val(response.compra_tipo_compra);
												$("#plazo_entrega").val(response.compra_plazo_entrega);
											}

										}
									});
								}
								function tipoCambio(input) {
									if(input === "PESO") {
										$("#tipo_cambio").val(1);
										$("#tipo_cambio").fadeOut("slow");

									}else if(input === "") {
										$("#tipo_cambio").val("");
										$("#tipo_cambio").fadeOut("slow");
									}else{
										$("#tipo_cambio").val("");
										$("#tipo_cambio").fadeIn("slow");
									}
								}

								function validar(){
									if(document.getElementById("grupo").value == ""){
										alert("SELECCIONE UN GRUPO");
										document.getElementById("grupo").focus();
										return false;
									}else if(document.getElementById("subgrupo").value == ""){
										alert("SELECCIONE UN SUB-GRUPO");
										document.getElementById("subgrupo").focus();
										return false;
									}else if(document.getElementById("subtitulo").value == ""){
										alert("SELECCIONE UN SUBTITULO");
										document.getElementById("subtitulo").focus();
										return false;
									}else if(document.getElementById("item").value == ""){
										alert("SELECCIONE UN ITEM");
										document.getElementById("item").focus();
										return false;
									}else if(document.getElementById("cantidad").value == ""){
										alert("INGRESE LA CANTIDAD DE PRODUCTOS");
										document.getElementById("cantidad").focus();
										return false;
									}else if(document.getElementById("total").value == ""){
										alert("INGRESE EL TOTAL DE LA COMPRA");
										document.getElementById("total").focus();
										return false;
									}else if(document.getElementById("programa").value == ""){
										alert("SELECCIONE UN PROGRAMA");
										document.getElementById("programa").focus();
										return false;
									}else if(document.getElementById("moneda").value == ""){
										alert("SELECCIONE EL TIPO DE MONEDA");
										document.getElementById("moneda").focus();
										return false;
									}else if(document.getElementById("tipo_cambio").value == ""){
										alert("INGRESE EL VALOR DEL CAMBIO");
										document.getElementById("tipo_cambio").focus();
										return false;
									}else if(document.getElementById("proveedor").value == ""){
										alert("SELECCIONE UN PROVEEDOR");
										document.getElementById("proveedor").focus();
										return false;
									}else if(document.getElementById("tipo_compra").value == ""){
										alert("SELECCIONE UN TIPO DE COMPRA");
										document.getElementById("tipo_compra").focus();
										return false;
									}else{
										if(confirm("¿ ESTA SEGURO DE PROSEGUIR ?"))
										{
											blockUI();
											return true;
										}else{
											return false;
										}
									}
								}
							</script>