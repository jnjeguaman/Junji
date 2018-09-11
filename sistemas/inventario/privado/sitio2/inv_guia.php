<?php 
session_start();
$regionSession = $_SESSION["region"];
require("inc/config.php");
$sqlZona = "SELECT * FROM acti_zona WHERE zona_estado=1 and zona_region = ".$_SESSION["region"];
$sqlZonaResp = mysql_query($sqlZona);

$ultimaGuia = "SELECT guia_numero as Ultimo,guia_id FROM inv_guia_despacho_encabezado WHERE guia_origen = 0 AND guia_region_origen = ".$_SESSION["region"]." ORDER BY guia_id DESC limit 1";
$ultimaGuia = mysql_query($ultimaGuia);
$ultimaGuia = mysql_fetch_array($ultimaGuia);
$ultimaGuia_id = intval($ultimaGuia["guia_id"]);
$ultimaGuia = intval($ultimaGuia["Ultimo"]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>INEDIS</title>
	<meta charset="UTF-8">
	<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<script src="librerias/jquery-1.11.3.min.js"></script>

</head>

<body>
	<div style="background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
		<?php include("inc/menu_1b.php"); ?>
	</div>

	<div style="width:100%;background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">GUIA DE DESPACHO</td>
			</tr>
		</table>
		<hr>

		<form name="form1" action="inv_graba_guia.php" method="post" onsubmit="return validar()">
			<table border="0" width="100%" align="center">
				<tr>
					<td class="Estilo1">ÚLTIMA GUIA </td>
					<?php if ($ultimaGuia === 0): ?>
						<td class="Estilo1" colspan="5">No se han emitido guias</td>
					<?php else: ?>
						<td class="Estilo1" colspan="5"><a href="/sistemas/inventario/privado/sitio2/inv_guia_despacho_detalle.php?id=<?php echo $ultimaGuia_id ?>&guia_origen=0" class="popup"><?php echo $ultimaGuia ?></a></td>
					<?php endif ?>
				</tr>

				<?php if ($regionSession <> 12 && $regionSession <> 13 && $regionSession <> 1 && $regionSession <> 3 && $regionSession <> 4 && $regionSession <> 6 && $regionSession <> 7 && $regionSession <> 15 && $regionSession <> 5 && $regionSession <> 11 && $regionSession <> 16 && $regionSession <> 10): ?>
					<tr>
					<td class="Estilo1">N° GUIA</td>
					<td class="Estilo1">
					<!--<input type="text" name="nro_guia" id="nro_guia" class="Estilo1" value="<?php echo $ultimaGuia+1 ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onBlur="validaFolio(this.value)">
					!-->
					<input type="text" name="nro_guia" id="nro_guia" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onChange="validaFolio(this.value)">
					</td>

					<td class="Estilo1">FECHA EMISION</td>
					<td class="Estilo1"><input type="text" name="fecha" id="fecha" class="Estilo1" value="<?php echo Date("Y-m-d") ?>" readonly style="background-color: rgb(235, 235, 228)"></td>
				</tr>
				<?php endif ?>

				<tr>
					<td class="Estilo1">ABASTECE</td>
					<td class="Estilo1"><input type="text" name="abastece" id="abastece" class="Estilo1"></td>
					<td class="Estilo1">DESTINATARIO</td>
					<td class="Estilo1"><input type="text" name="destinatario" id="destinatario" class="Estilo1"></td>
				</tr>


				<tr class="nuevaZona">
					<td  class="Estilo1">DIRECCION</td>
					<td  class="Estilo1"><input type="text" name="responsa2" id="responsa2" class="Estilo1">
						<a href="#" onClick="volver()">VOLVER</a>
					</td>
				</tr>
				
				<tr class="antiguaZona">
					<td  class="Estilo1">DIRECCION</td>
					<td  class="Estilo1"><input type="text" name="responsa" id="responsa" class="Estilo1 responsa2">
					</td>
				</tr>

				<tr class="antiguaZona">
					<td  class="Estilo1">ZONA</td>
					<td  class="Estilo1">
						<select name="responsa" id="responsa" class="Estilo1" onchange="getSubZona(this.value)">
							<option selected value="">Seleccionar...</option>
							<?php while($row = mysql_fetch_array($sqlZonaResp)) { ?>
								<option value="<?php echo $row["zona_glosa"] ?>"><?php echo $row["zona_glosa"] ?></option>
								<?php } ?>
								<option value="OTRO">OTRO</option>
							</select>
						</td>

						<td  class="Estilo1">ZONA</td>
						<td  class="Estilo1"><select name="inv_zona" id="inv_zona" class="Estilo1">
							<?php if ($row["inv_zona"] == ""): ?>
								<option selected value="">Seleccione...</option>
							<?php else: ?>
								<option value="">Seleccione...</option>
								<option selected value="<?php echo $row["inv_zona"] ?>"><?php echo $row["inv_zona"] ?></option>
							<?php endif ?>
						</select></td>
					</tr>


					<tr class="nuevaZona">
						<td class="Estilo1">COMUNA</td>
						<td class="Estilo1"><input type="text" name="comuna2" id="comuna2" class="Estilo1"></td>
					</tr>

					<tr class="antiguaZona">
						<td class="Estilo1">COMUNA</td>
						<td class="Estilo1"><input type="text" name="comuna" id="comuna" class="Estilo1" style="background-color: rgb(235, 235, 228)"></td>

						<td class="Estilo1">RESPONSABLE</td>
						<td class="Estilo1"><input type="text" name="inv_responsable" id="inv_responsable" class="Estilo1"></td>
					</tr>

					<tr>
						<td class="Estilo1">OBSERVACION</td>
						<td class="Estilo1" colspan="5"><textarea name="obs" id="obs" style="margin: 0px; width: 648px; height: 116px;"></textarea></td>
					</tr>

					<tr>
						<td class="Estilo1">EMISOR</td>
						<td class="Estilo1" colspan="5"><?php echo $_SESSION["nombrecom"] ?></td>
					</tr>


					<tr>
						<td></td>
						<td class="Estilo1c" colspan="3"><input type="submit" value="   GRABAR E IMPRIMIR   "/></td>
					</tr>
				</table>

				<input type="hidden" name="emisor" id="emisor" value="<?php echo $_SESSION["nombrecom"] ?>">
				<input type="hidden" name="tipo" id="tipo" value="1">
				<input type="hidden" name="tipoDireccion" id="tipoDireccion">
				<input type="hidden" name="totalItems" id="totalItems">
			</form>

			<br>
			<hr>

			<table border="0" width="100%">
				<tr>
					<td class="Estilo2titulo" colspan="10">PRODUCTO</td>
				</tr>
			</table>

			<table border="0" width="60%">
				<tr>
					<td class="Estilo1">CODIGO DE INVENTARIO</td>
					<td class="Estilo1"><input type="text" name="inv_codigo" id="inv_codigo" class="Estilo1" onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>

					<td class="Estilo1"></td>
					<td class="Estilo1"><button onClick="buscarCodigo()">BUSCAR</button></td>
				</tr>
			</table>
			<br>
			<hr>
			<table border="0" width="100%" align="center" id="productos">
				<tr>
					<td class="Estilo1mc">CODIGO DE INVENTARIO</td>
					<td class="Estilo1mc">PRODUCTO</td>
					<td class="Estilo1mc">RESPONSABLE ACTUAL</td>
					<td class="Estilo1mc">DIRECCION ACTUAL</td>
					<td class="Estilo1mc">ZONA ACTUAL</td>
					<td class="Estilo1mc">VALOR UNITARIO</td>
					<td class="Estilo1mc">ELIMINAR</td>
				</tr>
				<?php 

				for ($i=0; $i < count($_SESSION["items"]); $i++) {

					$resp = "SELECT * FROM acti_inventario WHERE inv_codigo = ".$_SESSION["items"][$i]["inv_codigo"];
					$resp = mysql_query($resp);
					$resp = mysql_fetch_array($resp);
					echo "<tr'>";
					echo "<td class='Estilo1mc' align='center'>".$_SESSION["items"][$i]["inv_codigo"]."</td>";
					echo "<td class='Estilo1mc' align='center'>".$resp["inv_bien"]."</td>";
					echo "<td class='Estilo1mc' align='center'>".$resp["inv_responsable"]."</td>";
					echo "<td class='Estilo1mc' align='center'>".$resp["inv_direccion"]."</td>";
					echo "<td class='Estilo1mc' align='center'>".$resp["inv_zona"]."</td>";
					echo "<td class='Estilo1mc' align='center'>$".number_format($resp["inv_costo"],0,".",".")."</td>";
					echo "<td class='Estilo1mc' align='center'><button type='button' onClick='eliminarItem(".$_SESSION["items"][$i]["inv_codigo"].")'><i class='fa fa-trash-o fa-lg'></i></button></td>";
					echo "</tr>";
				}
				?>
			</table>
		</div>

		<script type="text/javascript">

			jQuery('.popup').click(function(e){
				e.preventDefault();
				window.popup = window.open(jQuery(this).attr('href'), 'importwindow', 'width=900, height=350, top=100, left=200, toolbar=1');
			});

			function eliminarItem(input)
			{
				var data = ({cmd : "eliminarItem", codigo : input});
				$.ajax({
					type:"POST",
					url:"inv_guia_despacho_elimina_producto.php",
					data:data,
					dataType:"JSON",
					success : function ( response ){

						var tabla = "";

						alert("PRODUCTO ELIMINADO EXITOSAMENTE");
						tabla+="<tr>";
						tabla+="<td class='Estilo1mc'>CODIGO DE INVENTARIO</td>";
						tabla+="<td class='Estilo1mc'>PRODUCTO</td>";
						tabla+="<td class='Estilo1mc'>RESPONSABLE ACTUAL</td>";
						tabla+="<td class='Estilo1mc'>DIRECCION ACTUAL</td>";
						tabla+="<td class='Estilo1mc'>ZONA ACTUAL</td>";
						tabla+="<td class='Estilo1mc'>VALOR UNITARIO</td>";
						tabla+="<td class='Estilo1mc'>ELIMINAR</td>";
						tabla+="</tr>";

						$.each(response,function(index,value){
							tabla+="<tr>";
							tabla+="<td class='Estilo1mc' align='center'>"+value.inv_codigo+"</td>";
							tabla+="<td class='Estilo1mc' align='center'>"+value.inv_bien+"</td>";
							tabla+="<td class='Estilo1mc' align='center'>"+value.inv_responsable+"</td>";
							tabla+="<td class='Estilo1mc' align='center'>"+value.inv_direccion+"</td>";
							tabla+="<td class='Estilo1mc' align='center'>"+value.inv_zona+"</td>";
							tabla+="<td class='Estilo1mc' align='center'>$"+value.inv_costo+"</td>";
							tabla+="<td class='Estilo1mc' align='center'><button type='button' onClick='eliminarItem("+value.inv_codigo+")'><i class='fa fa-trash-o fa-lg'></i></button></td>";
							tabla+="</tr>";
						})
						$("#productos").html(tabla);
					}
				});
			}
			$(function(){
				var regionSession = <?php echo $regionSession ?>;
				if(regionSession != 12 && regionSession != 13 && regionSession != 1 && regionSession != 3 && regionSession != 4 && regionSession != 6 && regionSession != 7 && regionSession != 15 && regionSession != 5 && regionSession != 11 && regionSession != 16 && regionSession != 10){
				document.getElementById("nro_guia").focus();
				}
				$("#comuna").prop("readonly",true);
				$(".nuevaZona").hide();
				$('input').keyup(function()
				{
					$(this).val($(this).val().toUpperCase());
				});

				$('textarea').keyup(function()
				{
					$(this).val($(this).val().toUpperCase());
				});

			})
			function getSubZona(input) {

				if(input == "OTRO") {
					$(".antiguaZona").hide();
					$(".nuevaZona").fadeIn("slow");
					$("#comuna").prop("readonly",false);
					$("#comuna").val("");
					$("#tipo").val(0);
					$("#tipoDireccion").val(0);

				}else{
					$("#tipo").val(1);
					$("#tipoDireccion").val(1);
					$("#nuevaDireccion").fadeOut("slow");
					$("#inv_direccion").val($("#responsa option:selected").text());
					var data = ({command : "getSubZona", zona_id : input});
					$.ajax({
						type:"POST",
						url:"inv_getsubzona.php",
						data:data,
						dataType:"JSON",
						cache:false,
						success:function(response) {
							console.log(response);
							$("#comuna").val(response[1].comuna);
							$("#destinatario").val(response[1].jardin);
							var resp = "";
							resp +="<option selected value=''>Seleccionar</option>";
							$.each(response,function(index,value){
								resp +="<option value='"+value.subzona+"'>"+value.subzona+"</option>";
							});
							$(".responsa2").val(response[1].direccion);
							$("#inv_zona").html(resp);

						}
					})
				}
			}


			function validar()
			{
				var tipo = $("#tipoDireccion").val();

				if(tipo == 1)
				{
					if($("#nro_guia").val() == "")
					{
						alert("INGRESE EL NUMERO DE GUIA");
						document.getElementById("nro_guia").focus();
						return false;
					}else if($("#abastece").val() == ""){
						alert("INGRESE CAMPO ABASTECE");
						document.getElementById("abastece").focus();
						return false;
					}else if($("#destinatario").val() == ""){
						alert("INGRESE CAMPO DESTINATARIO");
						document.getElementById("destinatario").focus();
						return false;
					}else if($("#responsa").val() == ""){
						alert("SELECCIONE LA DIRECCION DE DESTINO");
						document.getElementById("responsa").focus();
						return false;
					}else if($("#inv_zona").val() == ""){
						alert("SELECCIONE LA ZONA DE DESTINO");
						document.getElementById("inv_zona").focus();
						return false;
					}else if($("#comuna").val() == ""){
						alert("INGRESE COMUNA DE DESTINO");
						document.getElementById("comuna").focus();
						return false;
					}else if($("#inv_responsable").val() == ""){
						alert("INGRESE NUEVO RESPONSABLE DEL(LOS) PRODUCTO(S)");
						document.getElementById("inv_responsable").focus();
						return false;
					}else{
						if($("#totalItems").val() == 0)
						{
							alert("LA GUIA NO TIENE PRODUCTOS");
							document.getElementById("inv_codigo").focus();
							return false;
						}else{
							if(confirm("¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS?"))
							{
								blockUI();
								return true;
							}else{
								return false;
							}
						}
					}
				}else{
					if($("#nro_guia").val() == "")
					{
						alert("INGRESE EL NUMERO DE GUIA");
						document.getElementById("nro_guia").focus();
						return false;
					}else if($("#abastece").val() == ""){
						alert("INGRESE CAMPO ABASTECE");
						document.getElementById("abastece").focus();
						return false;
					}else if($("#destinatario").val() == ""){
						alert("INGRESE CAMPO DESTINATARIO");
						document.getElementById("destinatario").focus();
						return false;
					}else if($("#responsa2").val() == ""){
						alert("INGRESE LA DIRECCION DE DESTINO");
						document.getElementById("responsa2").focus();
						return false;
					}else if($("#comuna2").val() == ""){
						alert("INGRESE COMUNA DE DESTINO");
						document.getElementById("comuna2").focus();
						return false;
					}else{
						if($("#totalItems").val() == 0)
						{
							alert("LA GUIA NO TIENE PRODUCTOS");
							document.getElementById("inv_codigo").focus();
							return false;
						}else{
							if(confirm("¿ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS?"))
							{
								return true;
							}else{
								return false;
							}
						}
					}
				}
			}

			function buscarCodigo()
			{
				var codigo = parseInt($("#inv_codigo").val());
				var totalItems = 0;
				if($("#inv_codigo").val() == "")
				{
					alert("INGRESE EL CODIGO DE INVENTARIO");
					document.getElementById("inv_codigo").focus();
					return false;
				}else if(isNaN(codigo))
				{
					alert("INGRESE EL CODIGO DE INVENTARIO");
					document.getElementById("inv_codigo").focus();
					return false;
				}else{
					var limite = 22;
					var data = ({cmd : "buscarCodigo", inv_codigo : codigo,limite:limite});
					$.ajax({
						type:"POST",
						url:"inv_busca_codigo.php",
						data:data,
						dataType:"JSON",
						beforeSend : function()
						{
							blockUI();
						},
						success : function ( response ) {
							var tabla = "";

						if(response == 1)
						{
							alert("SE HA SUPERADO EL LIMITE DE "+limite+" ELEMENTOS");
							return false;
						}else if(response == 2)
						{
							alert("EL CODIGO '"+codigo+"' NO EXISTE O NO ESTA DISPONIBLE PARA SU REGION");
							document.getElementById("inv_codigo").focus();
							$("#inv_codigo").val("");
						}else if(response == 3)
						{
							alert("EL CODIGO '"+codigo+"' YA SE ENCUENTRA EN LA LISTA");
							document.getElementById("inv_codigo").focus();
							$("#inv_codigo").val("");
						}else{
							alert("PRODUCTO AÑADIDO EXITOSAMENTE");
							document.getElementById("inv_codigo").focus();
							$("#inv_codigo").val("");
							tabla+="<tr>";
							tabla+="<td class='Estilo1mc'>CODIGO DE INVENTARIO</td>";
							tabla+="<td class='Estilo1mc'>PRODUCTO</td>";
							tabla+="<td class='Estilo1mc'>RESPONSABLE ACTUAL</td>";
							tabla+="<td class='Estilo1mc'>DIRECCION ACTUAL</td>";
							tabla+="<td class='Estilo1mc'>ZONA ACTUAL</td>";
							tabla+="<td class='Estilo1mc'>VALOR UNITARIO</td>";
							tabla+="<td class='Estilo1mc'>ELIMINAR</td>";
							tabla+="</tr>";

							$.each(response,function(index,value){
								totalItems++;
								tabla+="<tr>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_codigo+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_bien+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_responsable+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_direccion+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_zona+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>$"+value.inv_costo+"</td>";
								tabla+="<td class='Estilo1mc' align='center'><button type='button' onClick='eliminarItem("+value.inv_codigo+")'><i class='fa fa-trash-o fa-lg'></i></button></td>";
								tabla+="</tr>";
							})
							$("#totalItems").val(totalItems);
							$("#productos").html(tabla);
						}

						/*if(response === 1){
							alert("EL CODIGO '"+codigo+"' YA SE ENCUENTRA EN LA LISTA");
							document.getElementById("inv_codigo").focus();
							$("#inv_codigo").val("");
						}else if(response === 2){
							alert("EL CODIGO '"+codigo+"' NO EXISTE O NO ESTA DISPONIBLE PARA SU REGION");
							document.getElementById("inv_codigo").focus();
							$("#inv_codigo").val("");
						}else{
							alert("PRODUCTO AÑADIDO EXITOSAMENTE");
							document.getElementById("inv_codigo").focus();
							$("#inv_codigo").val("");
							tabla+="<tr>";
							tabla+="<td class='Estilo1mc'>CODIGO DE INVENTARIO</td>";
							tabla+="<td class='Estilo1mc'>PRODUCTO</td>";
							tabla+="<td class='Estilo1mc'>RESPONSABLE ACTUAL</td>";
							tabla+="<td class='Estilo1mc'>DIRECCION ACTUAL</td>";
							tabla+="<td class='Estilo1mc'>ZONA ACTUAL</td>";
							tabla+="<td class='Estilo1mc'>VALOR UNITARIO</td>";
							tabla+="<td class='Estilo1mc'>ELIMINAR</td>";
							tabla+="</tr>";

							$.each(response,function(index,value){
								totalItems++;
								tabla+="<tr>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_codigo+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_bien+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_responsable+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_direccion+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>"+value.inv_zona+"</td>";
								tabla+="<td class='Estilo1mc' align='center'>$"+value.inv_costo+"</td>";
								tabla+="<td class='Estilo1mc' align='center'><button type='button' onClick='eliminarItem("+value.inv_codigo+")'><i class='fa fa-trash-o fa-lg'></i></button></td>";
								tabla+="</tr>";
							})
							$("#totalItems").val(totalItems);
							$("#productos").html(tabla);
						}*/
					},
					complete : function()
					{
						unBlockUI();
					}
				});
				}

			}

			function volver()
			{
				$("#tipoDireccion").val(1);
				$(".nuevaZona").fadeOut("slow");
				$(".antiguaZona").fadeIn("slow");
				$("#comuna").prop("readonly",true);
				$("#comuna").css("background-color","rgb(235, 235, 228)");
				$("#tipo").val(1);

			}

			function validaFolio(input)
			{
				var data = ({cmd:"validaFolio", folio : input});
				$.ajax({
					type:"POST",
					url:"validaOrden.php",
					data:data,
					dataType:"JSON",
					success : function ( response ) {
					console.log(response);
					if(response)
					{
						alert("EL FOLIO '"+input+"' YA SE ENCUENTRA USADO");
						$("#nro_guia").val('');
						$("#nro_guia").focus();
					}
					}
				});
			}
		</script>


	</body>

	</html>