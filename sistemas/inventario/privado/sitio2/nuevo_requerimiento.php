<div style="width:800px; height:530px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">INGRESO NUEVO REQUERIMIENTO</td>
		</tr>
	</table>

	<form name="form1" action="inv_grabaindex.php" method="post" onsubmit="return validar()">
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
								<option value="<?php echo $row["acti_subtitulo"] ?>"><?php echo $row["acti_subtitulo"] ?></option>
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
							<input type="text" name="cantidad" id="cantidad" class="Estilo2" size="12">
						</td>

						<td class="Estilo1">MONTO TOTAL C / IVA</td>
						<td class="Estilo1" colspan="3">
							<input type="text" name="total" id="total" class="Estilo2" size="8">
						</td>

					</tr>

					<tr> 
						<td class="Estilo1">PROGRAMA</td>
						<td class="Estilo1">
							<select name="programa" id="programa" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<option value="P1">P1</option>
								<option value="P2">P2</option>
								<option value="CECI">CECI</option>
								<option value="PMI">PMI</option>
								<option value="CASH">CASH</option>
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
							<input type="text" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="3" size="2">
						</td>

					</tr>

					<tr>
						<td class="Estilo1">PROVEEDOR <a href="/sistemas/inventario/privado/sitio2/nuevoProveedor.php" class="popup">NUEVO</a></td>
						<td class="Estilo1">
							<select name="proveedor" id="proveedor" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<?php
								while($row = mysql_fetch_array($sqlProveedorResp)) {
									?>
									<option value="<?php echo $row["proveedor_glosa"] ?>"><?php echo $row["proveedor_glosa"] ?></option>
									<?php } ?>
								</td>
								
								<td class="Estilo1">TIPO COMPRA</td>
								<td class="Estilo1" colspan="3">
									<select name="tipo_compra" id="tipo_compra" class="Estilo2">
										<option selected value="">Seleccionar...</option>
										<option value="TRATO DIRECTO">TRATO DIRECTO</option>
										<option value="CONVENIO MARCO">CONVENIO MARCO</option>
										<option value="LICITACION">LICITACION</option>
									</select>
								</td>

							</tr>

						</table>

						<table border="0" width="100%">
							<tr>
								<td class="Estilo1c">
									<input type="submit" name="submit" class="Estilo2" size="11" value="  Grabar  ">
								</td>
								<td class="Estilo1c">
									<input type="button" class="Estilo2" size="11" value="  Nuevo Producto  " onClick="nuevoProducto(<?php echo $_SESSION["region"] ?>)">
								</td>

							</tr>
						</table>
						<input type="hidden" name="compra_id" id="compra_id">
					</form>
					<hr>
					<?php include("ultimas.php") ?>
				</div>

				<script type="text/javascript">

					jQuery('.popup').click(function(e){
						e.preventDefault();
						window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=500, height=200, top=100, left=200, toolbar=1');

						window.popup.onload = function() {
							window.popup.onbeforeunload = function(){
							getProveedores();
								
							}
						}

					});

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
						$("#tipo_cambio").hide();
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
											$("#compra_id").val(response.compra_id);
											$("#programa").val(response.compra_programa);
											$("#proveedor").val(response.compra_proveedor);
											$("#tipo_compra").val(response.compra_tipo_compra);
											$("#plazo_entrega").val(response.compra_plazo_entrega);
										}
									});
								}
								function tipoCambio(input) {
									if(input === "PESO") {
										$("#tipo_cambio").val(1);
										$("#tipo_cambio").fadeOut("slow");

									}else if(input === "") {
										$("#tipo_cambio").fadeOut("slow");
									}else{
										$("#tipo_cambio").fadeIn("slow");
									}
								}

								function validar(){
									if(document.getElementById("grupo").value == ""){
										alert("Seleccione un grupo");
										document.getElementById("grupo").focus();
										return false;
									}else if(document.getElementById("subgrupo").value == ""){
										alert("Seleccione un subgrupo");
										document.getElementById("subgrupo").focus();
										return false;
									}else if(document.getElementById("subtitulo").value == ""){
										alert("Seleccione un subtitulo");
										document.getElementById("subtitulo").focus();
										return false;
									}else if(document.getElementById("item").value == ""){
										alert("Seleccione un item");
										document.getElementById("item").focus();
										return false;
									}else if(document.getElementById("cantidad").value == ""){
										alert("Seleccione un cantidad");
										document.getElementById("cantidad").focus();
										return false;
									}else if(document.getElementById("total").value == ""){
										alert("Seleccione un total");
										document.getElementById("total").focus();
										return false;
									}else if(document.getElementById("programa").value == ""){
										alert("Seleccione un programa");
										document.getElementById("programa").focus();
										return false;
									}else if(document.getElementById("moneda").value == ""){
										alert("Seleccione un moneda");
										document.getElementById("moneda").focus();
										return false;
									}else if(document.getElementById("tipo_cambio").value == ""){
										alert("Seleccione un tipo_cambio");
										document.getElementById("tipo_cambio").focus();
										return false;
									}else if(document.getElementById("proveedor").value == ""){
										alert("Seleccione un proveedor");
										document.getElementById("proveedor").focus();
										return false;
									}else if(document.getElementById("tipo_compra").value == ""){
										alert("Seleccione un tipo_compra");
										document.getElementById("tipo_compra").focus();
										return false;
									}else if(document.getElementById("plazo_entrega").value == ""){
										alert("Seleccione un plazo_entrega");
										document.getElementById("plazo_entrega").focus();
										return false;
									}else if(document.getElementById("tipo_activo").value == ""){
										alert("Seleccione un tipo_activo");
										document.getElementById("tipo_activo").focus();
										return false;
									}else{
										return true;
									}
								}
							</script>