<script type="text/javascript" src="librerias/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" type="text/css" href="librerias/select2/dist/css/select2.min.css">
<script>
	<!--

	function nuevoAjax()
	{
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }

	return xmlhttp;
}

function traerDatos()  {
	var ajax=nuevoAjax();
	bodega=document.form12.bodega.value;
//    alert("Entra 1"+bodega);
if (bodega!=''  ) {
//    alert (" dato "+codigo);
ajax.open("POST", "bode_buscajardin.php", true);
ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
ajax.send("d="+bodega);

ajax.onreadystatechange=function()	{
	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			   // Respuesta recibida. Coloco el texto plano en la capa correspondiente
			   //capa.innerHTML=ajax.responseText;

			   var separar = ajax.responseText;
//               alert(separar);
var elem = separar.split('/');
jnombre.innerText=elem[0];
jcomuna.innerText=elem[1]+"\n"+elem[2];
//               document.form1.nombre.value=elem[0];
//               document.form1.fpago.value = elem[1];
}
}
}
}
}



-->
</script>

<div style="width:800px; height:530px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<?php if ($_SESSION["pfl_user"] <> 52): ?>
		
		<table border="0" width="100%">
			<tr>
				<td class="Estilo2titulo" colspan="10">INGRESO NUEVO REQUERIMIENTO</td>
			</tr>
		</table>

		<?
		if ($regionsession==1) {
			$para1="845";
		}
		if ($regionsession==2) {
			$para1="1573";
		}
		if ($regionsession==3) {
			$para1="846";
		}
		if ($regionsession==4) {
			$para1="1574";
		}
		if ($regionsession==5) {
			$para1="847";
		}
		if ($regionsession==6) {
			$para1="1575";
		}
		if ($regionsession==7) {
			$para1="848";
		}
		if ($regionsession==8) {
			$para1="1576";
		}
		if ($regionsession==9) {
			$para1="852";
		}
		if ($regionsession==10) {
			$para1="853";
		}
		if ($regionsession==11) {
			$para1="854";
		}
		if ($regionsession==16) {
			$para1="599";
		}
		if ($regionsession==12) {
			$para1="855";
		}
		if ($regionsession==13) {
			$para1="856";
		}
		if ($regionsession==14) {
			$para1="5538";
		}
		if ($regionsession==15) {
			$para1="1572";
		}
 /*
 if ($regionsession==17) {
     $para1="523524";
 }
 if ($regionsession==18) {
     $para1="523522";
 }
 */
 if (!isset($_POST['tipo'])) {
 	$tipo="";
 }

  if (!isset($_POST['codigo']) || !isset($_GET['codigo'])) {
 	$codigo="";
 }


 ?>

 <form name="form11" action="bode_inv_indexoc3.php" method="post" onsubmit="return validaree()">
 	<table border="0" width="100%">
 		<tr>
 			<td class="Estilo1">TIPO DESPACHO</td>
 			<td class="Estilo1">
 				<input type="radio" name="tipo" class="Estilo2 tipo" value="Bodega" onclick="this.form.submit();" <? if ($tipo=="Bodega") { echo "checked"; }  ?> >Bodega
 				<input type="radio" name="tipo" class="Estilo2 tipo" value="Oficina" onclick="this.form.submit();" <? if ($tipo=="Oficina") { echo "checked"; }  ?>>Oficina
 				<input type="radio" name="tipo" class="Estilo2 tipo" value="Jardines" onclick="this.form.submit();" <? if ($tipo=="Jardines") { echo "checked"; }  ?>>Jardines
 				<input type="radio" name="tipo" class="Estilo2 tipo" value="Consumo" onclick="this.form.submit();" <? if ($tipo=="Consumo") { echo "checked"; }  ?>>Consumo
 				<input type="radio" name="tipo" class="Estilo2 tipo" value="Traslado" onclick="this.form.submit();" <? if ($tipo=="Traslado") { echo "checked"; }  ?>>Traslado
 			</td>
 		</tr>



 		<input type="hidden" name="cod" value="22"  >
 	</form>
 	<form name="form12" action="bode_inv_grabaindexoc3.php" method="post" onsubmit="return validaree()">
 		<?
 		if ($tipo=="Bodega") {
 			?>
 			<input type="hidden" value="1" name="tipo_guia">
 			<table border="0" width="100%">
 				<tr>
 					<td class="Estilo1">BODEGA DESTINO</td>
 					<td class="Estilo1" colspan=1>

 						<select name="bodega" id="region2" class="Estilo2" onChange="getBodega(this.value)">
 							<option value="">Seleccionar...</option>
 							<?php
 							$j=1;
 							while($j<$ii) {
 								?>
 								<option value="<? echo  $regionN[$j] ?>" <? if ($row3["doc_region"]==$regionN[$j]) { echo  "selected=selected"; } ?> > <? echo $regionG[$j] ?></option>
 								<?php
 								$j++;
 							}
 							?>
 						</select>
 					</td>
 					<input type="hidden"
 				</tr>
 				<tr>
 					<td  valign="center" class="Estilo1">FECHA DESPACHO</td>
 					<td class="Estilo1" valign="center">
 						<input type="text" name="fecha_orden_compra" class="Estilo2" size="12" value="<? echo $fechamia2; ?>" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">
 						<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
 						onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 						<script type="text/javascript">
 							Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

</td>
</tr>
<tr>
	<td  valign="center" class="Estilo1">DIRECCION BODEGA</td>
	<td class="Estilo1"><div id="dirbode"></div></td>
</tr>

<tr>
	<td  valign="center" class="Estilo1">ENCARGADO BODEGA</td>
	<td class="Estilo1"><div id="encbode"></div></td>
</tr>
</table>

<?
}
?>
<?
if ($tipo=="Oficina") {
	?>
	<input type="hidden" value="2"  name="tipo_guia">
	<table border="0" width="100%">

		<tr>
			<td class="Estilo1">REGION DESTINO</td>
			<td class="Estilo1" colspan=1>

				<select class="Estilo2" onChange="getOficina(this.value)" name="region_destino">
					<option value="">Seleccionar...</option>
					<?php
					$j=1;
					while($j<$ii) {
						?>
						<option value="<? echo  $regionN[$j] ?>" <? if ($row3["doc_region"]==$regionN[$j]) { echo  "selected=selected"; } ?> > <? echo $regionG[$j] ?></option>
						<?php
						$j++;
					}
					?>
				</select>
			</td>
		</tr>

		<tr>
			<td class="Estilo1">OFICINA DESTINO</td>
			<td class="Estilo1" colspan=1>

				<select name="bodega" id="region2" class="Estilo2" required>
					<option value="">Seleccionar...</option>
				</select>
			</td>

		</tr>
		<tr>
			<td  valign="center" class="Estilo1">FECHA DESPACHO</td>
			<td class="Estilo1" valign="center">
				<input type="text" name="fecha_orden_compra" class="Estilo2" size="12" value="<? echo $fechamia2; ?>" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">
				<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
				onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

				<script type="text/javascript">
					Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

</td>
</tr>


</table>

<?
}
?>
<?
if ($tipo=="Jardines") {
	?>
	<input type="hidden" value="3" name="tipo_guia">
	<?php if (intval($regionsession) === 16 ): ?>
		<table border="0" width="100%">
			<tr>
				<td class="Estilo1">SELECCIONAR REGION</td>
				<td class="Estilo1" colspan="1">
					<select id="jardin_region" class="Estilo2" onChange="getJardinesRegion(this.value)"  name="region_destino">
						<option value="">Seleccionar...</option>
						<?php
						$listaRegion = "SELECT * FROM acti_region";
						$listaResp = mysql_query($listaRegion,$dbh);
						while($regiones = mysql_fetch_array($listaResp)) {
							?>
							<option value="<?php echo $regiones["region_id"] ?>"><?php echo $regiones["region_glosa"] ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>

				<tr>
					<td class="Estilo1">JARDIN DESTINO</td>
					<td class="Estilo1" colspan="1">
						<select name="bodega" id="region2" class="Estilo select2" onChange="traerDatos();" style="width:350px;" tabindex="1">
							<option value="">Seleccionar...</option>
						</select>
					</td>
				</tr>
			</table>
			<table  width="100%" border=1>
				<tr>
					<td width="50%">Nombre</td>
					<td width="50%">Ubicacion</td>
				</tr>
				<tr>
					<td id="jnombre"  width="50%"></td>
					<td id="jcomuna"  width="50%"></td>
				</tr>
			</table>
		<?php else: ?>
			<table border="0" width="100%">
				<tr>
					<td class="Estilo1">JARDIN DESTINO</td>
					<td class="Estilo1" colspan=1>

						<select name="bodega" id="region2" class="Estilo1mc select2" onChange="traerDatos();" style="width:350px;" tabindex="1">
							<option value="">Seleccionar...</option>
							<?php
							$sqlZona = "SELECT * FROM jardines where jardin_region='$regionsession' AND jardin_estado = 1 order by jardin_codigo";
							$sqlZonaResp = mysql_query($sqlZona);
							while ($row2 = mysql_fetch_array($sqlZonaResp)) {
								?>
								<option value="<? echo  $row2["jardin_codigo"] ?>" > <? echo  $row2["jardin_codigo"]." : ".$row2["jardin_nombre"] ?></option>
								<?php
								$j++;
							}
							?>
						</select>
					</td>
				</tr>
			</table>
			<table  width="100%" border=1>
				<tr>
					<td width="50%">Nombre</td>
					<td width="50%">Ubicacion</td>
				</tr>

				<tr>
					<td id="jnombre"  width="50%"></td>
					<td id="jcomuna"  width="50%"></td>
				</tr>
			</table>
		<?php endif ?>
		<table border="0" width="100%">
			<tr>
				<td  valign="center" class="Estilo1">FECHA DESPACHO</td>
				<td class="Estilo1" valign="center">
					<input type="text" name="fecha_orden_compra" class="Estilo2" size="12" value="<? echo $fechamia2; ?>" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">
					<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

					<script type="text/javascript">
						Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

</td>
</tr>
</table>

<?
}
?>

<?php if ($tipo == "Consumo"): ?>
	<input type="hidden" value="5" name="tipo_guia">
	<table border="1" width="100%">
		<tr>
				<td  valign="center" class="Estilo1">FECHA DESPACHO</td>
				<td class="Estilo1" valign="center">
					<input type="text" name="fecha_orden_compra" class="Estilo2" size="12" value="<? echo $fechamia2; ?>" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">
					<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

					<script type="text/javascript">
						Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

</td>
</tr>
	</table>
<?php endif ?>

<?php if ($tipo == "Traslado"): ?>
	<input type="hidden" value="6" name="tipo_guia">
	<table border="1" width="100%">
		<tr>
				<td  valign="center" class="Estilo1">FECHA DESPACHO</td>
				<td class="Estilo1" valign="center">
					<input type="text" name="fecha_orden_compra" class="Estilo2" size="12" value="<? echo $fechamia2; ?>" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)" required>
					<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
					onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

					<script type="text/javascript">
						Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>

</td>
</tr>

<tr>
	<td class="Estilo1">ORIGEN</td>
	<td>
		<?php if ($_SESSION["region"] == 16 || $_SESSION["region"] == 2): ?>
							<select name="bodega" id="bodega" class="Estilo2" required>
								<option value="" selected>Seleccionar</option>
								<?php 
								$ubi = mysql_query("SELECT * FROM bode_ubicacion WHERE ubi_estado = 1 AND ubi_region = ".$_SESSION["region"]." ORDER BY ubi_glosa ASC");
								while($rubi = mysql_fetch_array($ubi)) {
									?>
									<option value="<?php echo $rubi["ubi_glosa"] ?>" <?php if($ubicacion == $rubi["ubi_glosa"]){echo"selected";} ?>><?php echo $rubi["ubi_glosa"] ?></option>
									<?php } ?>
								</select>
							<?php else: ?>
								<input type="text" name="bodega" id="bodega" class="Estilo2">
							<?php endif ?>
	</td>
</tr>
	</table>
<?php endif ?>
<table border="0" width="100%">
	<tr>
		<td class="Estilo1c">
			<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
			<input type="hidden" name="tipo" value="<? echo $tipo ?>"  >
			<?php if ($_SESSION["pfl_user"] <> 53 && $_SESSION["pfl_user"] <> 54): ?>
				<input type="submit" name="submit" class="Estilo2" size="11" value="  Crear Guia  ">
			<?php endif ?>

		</td>

	</tr>
</table>
<input type="hidden" name="compra_id" id="compra_id">
</form>
<hr>
<?php include("bode_ultimasguias.php") ?>
<hr>
<?php endif ?>

<?php 
if($tipo == "Consumo")
{
include("bode_ultimasconsumo.php");
}else if($tipo == "Traslado"){
	include("bode_ultimastraslado.php");
}else{
	include("bode_ultimasguias2.php");;
}


?>
<hr>
<?php // include("bode_ultimasoc.php") ?>
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
		$(".select2").select2({
			allowClear : true,
			placeholder: "Seleccionar...",
			tags : true,
		});
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

								function getJardines(input)
								{
									var data = ({cmd : "getJardines", comuna : input});
									$.ajax({
										type:"POST",
										url:"bode_getJardines.php",
										data:data,
										dataType:"JSON",
										success : function ( response ) {
											$("#region2").html(response);
										}
									});
								}

								function validaree ()
								{
									var tipoDespacho = $(".tipo").is(":checked");

									if(tipoDespacho == false)
									{
										alert("SELECCIONE UN TIPO DE DESPACHO");
										$(".tipo").focus();
										return false;

									}else if($("#jardin_region").val() == ""){
										alert("SELECCIONE UNA REGION");
										$("#jardin_region").focus();
										return false;
									}else if($("#region2").val() == "")
									{
										alert("SELECCIONE JARDIN DE DESTINO");
										document.getElementById("region2").focus();
										return false;
									}else if($("#f_date_c2").val() == "")
									{
										alert("INGRESE LA FECHA DE DESPACHO");
										document.getElementById("f_date_c2").focus();
										return false;
									}
									blockUI();
									return true;
								}

								function getJardinesRegion(input){
									var data = ({cmd : "getJardinesRegion", region_id : input});
									$.ajax({
										type:"POST",
										url:"bode_getJardines.php",
										data:data,
										dataType:"JSON",
										success : function ( response ) {
											$("#region2").html(response);
										}
									});
								}

								function getBodega(input){
									var data = ({region_id : input, cmd : "buscaBodega"});
									$.ajax({
										type:"POST",
										url:"buscaBodega.php",
										data:data,
										dataType:"JSON",
										success : function ( response ) {
											$("#dirbode").html(response.region_dir_bodega);
											$("#encbode").html(response.region_encargado);
										}
									});
								}

								function getOficina(input){
									var data = ({region_id : input});
									$.ajax({
										type:"POST",
										url:"buscaOficinas.php",
										data:data,
										dataType:"JSON",
										success : function ( response ) {
											$("#region2").html(response);
										}
									});
								}
							</script>
