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

<div style="width:800px; background-color:#E0F8E0; position:absolute; top:120px; left:0px;" id="div1">
	<table border="0" width="100%">
		<tr>
			<td class="Estilo2titulo" colspan="10">INGRESO NUEVA GUIA MASIVA</td>
		</tr>
	</table>

 	<form name="form12" action="bode_inv_grabaindexguia3a.php" method="post" onsubmit="return validare3()" enctype="multipart/form-data">
 		<?
 		if (!isset($_GET['tipo']) || !isset($_POST['tipo'])) {
 			$tipo="";
 		}


 		if ($tipo=="Bodega" OR 1==1) {
 			?>
 			<input type="hidden" value="1" name="tipo_guia">
 			<table border="0" width="100%">

 				<tr>
 					<td  valign="center" class="Estilo1">FECHA DESPACHO</td>
 					<td class="Estilo1" valign="center">
 						<input type="text" name="fecha2" class="Estilo2" size="12" value="" id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)" required>
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
 					<td  valign="center" class="Estilo1">NOMBRE DISTRIBUCIÓN</td>
 					<td class="Estilo1"><input type="text" name="nombre" id="nombre" required></div></td>
 				</tr>

 				<tr>
 					<td  valign="center" class="Estilo1">SECTOR</td>
 					<td class="Estilo1"><input type="text" name="sector" id="sector" required></div></td>
 				</tr>

 				<tr>
 				<td class="Estilo1">ARCHIVO</td>
 				<td><input type="file" name="archivo" required></td>
 				</tr>
 			</table>

 			<?
 		}
 		?>


 			<table border="0" width="100%">
 				<tr>
 					<td class="Estilo1c">
 						<input type="hidden" name="oc" value="<? echo $codigo ?>"  >
 						<input type="hidden" name="tipo" value="<? echo $tipo ?>"  >
 						<input type="submit" name="submit" class="Estilo2" size="11" value="  Crear Matriz  ">
 					</td>

 				</tr>
 			</table>
 			<input type="hidden" name="compra_id" id="compra_id">
 		</form>
 		<hr>
 		<?php include("bode_ultimasguiasa.php") ?>
 	</div>