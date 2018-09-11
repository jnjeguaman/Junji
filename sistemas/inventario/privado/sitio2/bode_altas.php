<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
}

if (!isset($_POST['numeroElementos'])) {
	$numeroElementos="";
}
if (!isset($_POST['cantidadtotal']) || !isset($_GET['cantidadtotal'])) {
	$cantidadtotal="";
}
if (!isset($_POST['fecha']) || !isset($_GET['fecha'])) {
	$fecha="";
}
if (!isset($_POST['rut']) || !isset($_GET['rut'])) {
	$rut="";
}
if (!isset($_POST['dig']) || !isset($_GET['dig'])) {
	$dig="";
}
if (!isset($_POST['nombreproveedor']) || !isset($_GET['nombreproveedor'])) {
	$nombreproveedor="";
}

$colspan = 9;
if($_SESSION["region"] == 16)
{
	$regiones = "SELECT * FROM acti_region WHERE region_estado = 1";
}else{
	$regiones = "SELECT * FROM acti_region WHERE region_estado = 1 AND region_id = ".$_SESSION["region"];
}
$regiones = mysql_query($regiones);
?>
<div style="width:100%;background-color:#E0F8E0; position:absolute; top:160px; left:0px;" id="div1">
	<script type="text/javascript" src="librerias/jquery.Rut.js"></script>

	<!-- INDICAMOS CUATOS ITEMS SE INGRESARAN A LA ORDEN DE COMPRA FICTICIA -->
	<form name="form1" action="bode_inv_indexoc4.php?cmd=Altas" method="post">
		<table border="1" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="<?php echo $colspan+1 ?>">INGRESO NUEVO REQUERIMIENTO</td>
			</tr>
			<tr>
				<td class="Estilo1">N° DE ELEMENTOS A INGRESAR</td>
				<td class="Estilo1" colspan="<?php echo $colspan ?>">
					<select id="numeroElementos" class="Estilo1" name="numeroElementos" onChange="this.form.submit();">
						<option value="">Seleccionar...</option>
						<?php for($i=0;$i<100;$i++) { ?>
							<option value="<?php echo ($i+1) ?>" <?php if($numeroElementos == ($i+1)){echo"selected";}?>><?php echo ($i+1) ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>

			</form>
			<!-- FIN -->

			<!-- INDICAMOS EL DETALLE A INGRESARAR -->
			<form name="form1" action="bode_altas_gr.php" method="post" onsubmit="return validar()">

			<tr>
				<td class="Estilo1">ORDEN DE COMPRA ASOCIADA</td>
				<td class="Estilo1" colspan="<?php echo $colspan ?>">
				<input type="text" name="oc" id="oc" class="Estilo1" placeholder="XXXX-XXXX-XXXX">
				* Opcional
				</td>
				</tr>

				<tr>
					<td class="Estilo1">REGION DE DESTINO</td>
					<td colspan="<?php echo $colspan ?>">
						<select name="region" id="region" class="Estilo1">
							<option value="">Seleccionar...</option>
							<?php while($row = mysql_fetch_array($regiones)) { ?>
								<option value="<?php echo $row["region_id"] ?>"><?php echo $row["region_glosa"] ?></option>
								<?php } ?>
							</select>	
						</td>
					</tr>

					<?php for($i=0;$i<$numeroElementos;$i++) { ?>
						<tr>
							<td class="Estilo1">DESCRIPCION N° <?php echo ($i+1) ?></td>
							<td><input type="text" name="descripcion[<?php echo $i ?>]" size="40" required/></td>

							<td class="Estilo1">STOCK</td>
							<td><input type="text" name="stock[<?php echo $i ?>]" size="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required/></td>

							<td class="Estilo1">VALOR UNITARIO</td>
							<td class="Estilo1"><input type="text" name="valor[<?php echo $i ?>]" size="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required></td>

							<td class="Estilo1">UNIDAD DE MEDIDA</td>
							<td class="Estilo1">
								<select name="tipo_compra[<?php echo $i ?>]" class="Estilo2" required>
									<option value="" selected>Seleccionar...</option>
									<?php foreach ($uMedida as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"] ?></option>
								<?php endforeach ?>
							</select>
						</td>

						<td class="Estilo1">FACTOR</td>
						<td class="Estilo1"><input type="text" name="factor[<?php echo $i ?>]" size="3" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required></td>
					</tr>
					<?php } ?>

					<tr>
						<td class="Estilo1">FECHA ENTREGA</td>
						<td class="Estilo1" colspan="<?php echo $colspan ?>">
							<input type="text" value="<?php echo $fecha ?>" name="fecha_orden_compra" class="Estilo2" size="12" id="f_date_c2" readonly style="background-color: rgb(235, 235, 235)">
							<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
							onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

							<script type="text/javascript">
								Calendar.setup({
									inputField     :    "f_date_c2",
									ifFormat       :    "%d-%m-%Y",
									button         :    "f_trigger_c2",
									align          :    "Bl",
									singleClick    :    true
								});
							</script>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">GRUPO</td>
						<td class="Estilo1" colspan="<?php echo $colspan ?>">
							<select name="grupo" id="grupo" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($grupos as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"] ?></option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>

					<tr> 
						<td class="Estilo1">MONTO TOTAL C / IVA</td>
						<td class="Estilo1" ><input type="text" name="total" id="total" class="Estilo2" size="15" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<? echo $cantidadtotal ?>"></td>

						<td class="Estilo1">DESCUENTO</td>
						<td class="Estilo1"><input type="text" name="descuento" id="descuento" size="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>

					<tr> 
						<td class="Estilo1">PROGRAMA</td>
						<td class="Estilo1">
							<select name="programa" id="programa" class="Estilo2">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($programas as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"] ?></option>
								<?php endforeach ?>
							</select>
						</select>
					</td>

					<td class="Estilo1">TIPO CAMBIO</td>
					<td class="Estilo1" colspan="2">
						<select name="moneda" id="moneda" class="Estilo2" onChange="tipoCambio(this.value)">
							<option selected value="">Seleccionar...</option>
							<option value="PESO">PESO</option>
							<option value="DOLAR">DOLAR</option>
							<option value="EURO">EURO</option>
							<option value="UF">UF</option>
						</select>
						<input type="text" name="tipo_cambio" id="tipo_cambio" class="Estilo2" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="6" size="6">	
					</td>

				</tr>
				
				<tr>
					<td class="Estilo1">NOMBRE O/C</td>
					<td class="Estilo1" colspan="4"><input type="text" name="nombre_oc" id="nombre_oc" class="Estilo2" size="50"></td>
				</tr>

				<tr>
					<td class="Estilo1">PROVEEDOR RUT</td>
					<td class="Estilo1"colspan="4">
						<input type="text" name="proveedor" id="proveedor" class="Estilo2" size="12" value="<? echo $rut ?>"> -
						<input type="text" name="proveedor2" id="proveedor2" class="Estilo2" size="1" value="<? echo $dig ?>" onBlur="validaRut()">
					</td>
				</tr>
				<tr>
					<td class="Estilo1">PROVEEDOR NOMBRE</td>
					<td class="Estilo1" colspan="<?php echo $colspan ?>">
						<input type="text" name="proveedornomb" id="proveedornomb" class="Estilo2" size="40" value="<? echo $nombreproveedor ?>">
					</td>
				</tr>

				<tr>
					<td class="Estilo1c" colspan="<?php echo $colspan+1 ?>">
						<input type="submit" name="submit" class="Estilo2" size="11" value="  Grabar  ">
					</td>

				</tr>
				<input type="hidden" name="totalElementos" value="<?php echo $numeroElementos ?>">
			</form>
			<!-- FIN -->
		</table>

	</div>

	<script type="text/javascript">

		$(function(){
			$("#tipo_cambio").hide();
		});

		function tipoCambio(input) {
			if(input === "PESO") {
				$("#tipo_cambio").fadeOut("slow");
				$("#tipo_cambio").val(1);

			}else if(input === "") {
				$("#tipo_cambio").fadeOut("slow");
				$("#tipo_cambio").val("");
			}else{
				$("#tipo_cambio").fadeIn("slow");
				$("#tipo_cambio").val("");
			}
		}

		function validar(){

			if($("#region").val() == ""){
				alert("SELECCIONE UNA REGION");
				$("#region").focus();
				return false;
			}else if($("#descripcion").val() == ""){
				alert("INGRESE UNA DESCRIPCION");
				$("#descripcion").focus();
				return false;
			}else if($("#f_date_c2").val() == ""){
				alert("INGRESE LA FECHA DE ENTREGA");
				$("#f_date_c2").focus();
				return false;
			}else if($("#grupo").val() == ""){
				alert("SELECCIONE UN GRUPO");
				$("#grupo").focus()
				return false;
			}else if($("#cantidad").val() == ""){
				alert("INGRESE LA CANTIDAD TOTAL");
				$("#cantidad").focus()
				return false;
			}else if($("#total").val() == ""){
				alert("INGRESE EL MONTO DE LA COMPRA C/IVA");
				$("#total").focus()
				return false;
			}else if($("#programa").val() == ""){
				alert("SELECCIONE UN PROGRAMA");
				$("#programa").focus()
				return false;
			}else if($("#moneda").val() == ""){
				alert("SELECCIONE EL TIPO DE CAMBIO");
				$("#moneda").focus()
				return false;
			}else if($("#tipo_cambio").val() == ""){
				alert("INGRESE EL VALOR DEL CAMBIO");
				$("#tipo_cambio").focus()
				return false;
			}else if($("#nombre_oc").val() == ""){
				alert("INGRESE NOMBRE DE LA ORDEN DE COMPRA / DESCRIPCION");
				$("#nombre_oc").focus()
				return false;
			}else if($("#proveedor").val() == ""){
				alert("INGRESE EL RUT DEL PROVEEDOR");
				$("#proveedor").focus()
				return false;
			}else if($("#proveedor2").val() == ""){
				alert("INGRESE EL DIGITO VERIFICADOR");
				$("#proveedor2").focus()
				return false;
			}else if($("#tipo_compra").val() == ""){
				alert("SELECCIONE LA UNIDAD DE MEDIDA");
				$("#tipo_compra").focus()
				return false;
			}else if($("#proveedornomb").val() == ""){
				alert("INGRESE EL NOMBRE DEL PROVEEDOR");
				$("#proveedornomb").focus();
				return false;
			}else{
				return true;
			}
		}

		function validaRut(){
			$('#proveedor').Rut({
				digito_verificador: '#proveedor2',
				on_error: function(){ alert('Rut incorrecto');
				$("#proveedor").val("");
				$("#proveedor2").val("");
				$("#proveedor").focus();
			}
		});
			var data = ({rut : $("#proveedor").val(), dv : $("#proveedor2").val()});
			$.ajax({
				type:"POST",
				url:"obtenerProveedor.php",
				data:data,
				dataType:"JSON",
				success : function ( response ) {
					$("#proveedornomb").val(response);
				}
			});
		}
	</script>