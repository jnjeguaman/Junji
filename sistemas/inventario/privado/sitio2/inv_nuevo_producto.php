<?php
session_start();
require("inc/config.php");
$sqlCategoria = "SELECT * FROM acti_categoria";
$sqlCategoriaResp = mysql_query($sqlCategoria);


$zona = "SELECT * FROM acti_zona WHERE zona_region = ".$_SESSION["region"];
$zona = mysql_query($zona);

?>

<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script src="librerias/jquery-1.11.3.min.js"></script>
</head>
<body>

	<div style="background-color:#E0F8E0;" id="div1">

		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="Estilo2titulo">GENERADOR DE CODIGOS</td>
			</tr>
		</table>

		<form action="inv_graba_nuevo_producto.php" onsubmit="return validar()" method="POST">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">

				<tr>
					<td valign="center" class="Estilo1">GRUPO</td>
					<td class="Estilo1" colspan="2">
						<select name="grupo" id="grupo" class="Estilo1" onChange="getSubCat(this.value)">
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
							<select name="subgrupo" id="subgrupo" class="Estilo1" readonly onChange="getVU(this.value)">
								<option value="">Seleccionar...</option>
							</select>
						</td>
					</tr>


					<tr> 
						<td class="Estilo1">CANTIDAD TOTAL</td>
						<td class="Estilo1" colspan="2"><input type="text" name="cantidad" id="cantidad" class="Estilo2" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>

						<td class="Estilo1">MONTO TOTAL C / IVA</td>
						<td class="Estilo1" colspan="3"><input type="text" name="total" id="total" class="Estilo2" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
					</tr>


					<tr> 
						<td class="Estilo1">PROGRAMA</td>
						<td class="Estilo1">
							<select name="programa" id="programa" class="Estilo1">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($programas as $key => $value): ?>
									<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
								<?php endforeach ?>
							</select>
						</td>

						<td class="Estilo1">TIPO CAMBIO</td>
						<td class="Estilo1">
							<select name="moneda" id="moneda" class="Estilo1" onChange="tipoCambio(this.value)">
								<option selected value="">Seleccionar...</option>
								<option value="PESO">PESO</option>
								<option value="DOLAR">DOLAR</option>
								<option value="EURO">EURO</option>
							</select>	
						</td>

						<td class="Estilo1"><input type="text" name="tipo_cambio" id="tipo_cambio" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode==46' class="Estilo2" maxlength="6"></td>
					</tr>

					<tr>
						<td class="Estilo1">CALIDAD ADMINISTRATIVA</td>
						<td class="Estilo1" colspan="2">
							<select class="Estilo1" name="inv_calidad" id="inv_calidad" onChange="verificaCalidad(this.value)">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($calidad as $key => $value): ?>
								<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
							<?php endforeach ?>
							</select>
						</td>

						<td class="Estilo1">ESTADO</td>
						<td class="Estilo1" colspan="3">
							<select class="Estilo1" name="inv_estadocosto" id="inv_estadocosto">
								<option selected value="">Seleccionar...</option>
								<?php foreach ($estados as $key => $value): ?>
								<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_glosa"]." : ".$value["param_desc"] ?></option>
							<?php endforeach ?>
							</select>
						</td>
					</tr>

					<tr>
						<td  class="Estilo1">CENTRO RESPONSA</td>
						<td  class="Estilo1" colspan="2">
							<select name="responsa" id="responsa" class="Estilo1" onchange="getSubZona(this.value)">
								<option value="">Seleccionar...</option>
								<?php while($row = mysql_fetch_array($zona)) { ?>
								<option value="<?php echo $row["zona_glosa"] ?>"><?php echo $row["zona_glosa"] ?></option>
								<?php } ?>
							</select>
						</td>

						<td  class="Estilo1">ZONA</td>
						<td  class="Estilo1" colspan="3">
							<select name="inv_zona" id="inv_zona" class="Estilo1">
								<option value="">Seleccionar...</option>
							</select>
						</td>
					</tr>

					<tr>
						<td class="Estilo1">OBSERVACION</td>
						<td class="Estilo1" colspan="5"><textarea name="inv_obs" id="inv_obs" style="margin: 0px; width: 406px; height: 72px;"></textarea></td>
					</tr>

					<tr>
						<td class="Estilo1">VIDA UTIL</td>
						<td class="Estilo1" colspan="1"><input type="text" name="inv_vutil" id="inv_vutil" readonly style="background-color: rgb(235, 235, 228)"/></td>

						<td class="Estilo1">RESPONSABLE</td>
						<td class="Estilo1" colspan="4"><input type="text" name="inv_responsable" id="inv_responsable" class="Estilo1"></td>

					</tr>
				</table>

				<table border="0" width="100%">
					<tr>
						<td class="Estilo1c">
							<input type="submit" name="submit" class="Estilo2" size="11" value="  CREAR CODIGO  ">
						</td>
					</tr>
				</table>
			</div>
		</form>

		<script type="text/javascript">

			function validar(){
				var cantidad = $("#cantidad").val();

				if($("#grupo").val() == "")
				{
					alert("SELECCIONE UN GRUPO");
					document.getElementById("grupo").focus();
					return false;
				}else if($("#subgrupo").val() == "") {
					alert("SELECCIONE UN SUB-GRUPO");
					document.getElementById("subgrupo").focus();
					return false;
				}else if($("#cantidad").val() == "") {
					alert("INGRESE LA CANTIDAD DE PRODUCTOS");
					document.getElementById("cantidad").focus();
					return false;
				}else if($("#total").val() == "") {
					alert("INGRESE EL TOTAL DE LA COMPRA");
					document.getElementById("total").focus();
					return false;
				}else if($("#programa").val() == "") {
					alert("SELECCIONE UN PROGRAMA");
					document.getElementById("programa").focus();
					return false;
				}else if($("#moneda").val() == "") {
					alert("SELECCIONE EL TIPO DE CAMBIO");
					document.getElementById("moneda").focus();
					return false;
				}else if($("#tipo_cambio").val() == "") {
					alert("INGRESE EL VALOR DEL CAMBIO");
					document.getElementById("tipo_cambio").focus();
					return false;
				}else if($("#inv_calidad").val() == "") {
					alert("SELECCIONE LA CALIDAD ADMINISTRATIVA");
					document.getElementById("inv_calidad").focus();
					return false;
				}else if($("#inv_estadocosto").val() == "") {
					alert("SELECCIONE EL ESTADO DEL BIEN");
					document.getElementById("inv_estadocosto").focus();
					return false;
				}else if($("#responsa").val() == "") {
					alert("SELECCIONE EL CENTRO DE RESPONSA");
					document.getElementById("responsa").focus();
					return false;
				}else if($("#inv_zona").val() == "") {
					alert("SELECCIONE LA ZONA");
					document.getElementById("zona").focus();
					return false;
				}else if($("#inv_obs").val() == "") {
					alert("INGRESE UNA OBSERVACION");
					document.getElementById("inv_obs").focus();
					return false;
				}else if($("#inv_responsable").val() == "") {
					alert("INGRESE EL RESPONSABLE");
					document.getElementById("inv_responsable").focus();
					return false;
				}else{
					// return true;
				return confirm('¿ ESTÁ SEGURO DE CREAR "'+cantidad+'" CODIGOS DE INVENTARIO Y PROCEDER CON LA CARGA DE DATOS ?');
				}
			}

			$(function(){
				$('input').keyup(function()
				{
					$(this).val($(this).val().toUpperCase());
				});

				$('textarea').keyup(function()
				{
					$(this).val($(this).val().toUpperCase());
				});


				$("#tipo_cambio").hide();
			})
			function getSubCat(input) {
				var data = ({command : "getSubCat", catsub_cat_id : input});
				$.ajax({
					type:"POST",
					url:"inv_getsubcat.php",
					data:data,
					dataType:"JSON",
					cache:false,
					success:function(response) {
						var resp = "";
						resp +="<option selected value=''>Seleccionar</option>";
						$.each(response,function(index,value){
							resp +="<option value='"+value+"'>"+value+"</option>";
						});
						$("#subgrupo").html(resp);

					}
				})
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

			function verificaCalidad(input) {
				if(input === "COMODATO") {
					alert("LOS PRODUCTOS EN COMODATO NO TIENEN VALOR PATRIMONIAL");
					$("#total").val("0");
					$("#total").prop("readonly",true);
				}else{
					$("#total").val("");
					$("#total").prop("readonly",false);
				}
			}


			function getSubZona(input) {
				$("#inv_direccion").val($("#responsa option:selected").text());
				var data = ({command : "getSubZona", zona_id : input});
				$.ajax({
					type:"POST",
					url:"inv_getsubzona.php",
					data:data,
					dataType:"JSON",
					cache:false,
					success:function(response) {
						var resp = "";
						resp +="<option selected value=''>Seleccionar</option>";
						$.each(response,function(index,value){
							resp +="<option value='"+value.subzona+"'>"+value.subzona+"</option>";
						});
						$("#inv_zona").html(resp);

					}
				})
			}

			function getVU(input){
				var data = ({cmd : "getVU", grupo : $("#grupo option:selected").val(), subgrupo : input});
				$.ajax({
					type:"POST",
					url:"inv_busca_vd.php",
					data:data,
					dataType:"JSON",
					success : function ( response ) {
						$("#inv_vutil").val(response);
					}
				});
			}

			
		</script>

	</body>
	</html>