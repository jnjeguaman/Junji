<?
$reg2 = array(
	1 => "I REGION",
	2 => "II REGION",
	3 => "III REGION",
	4 => "IV REGION",
	5 => "V REGION",
	6 => "VI REGION",
	7 => "VII REGION",
	8 => "VIII REGION",
	9 => "IX REGION",
	10 => "X REGION",
	11 => "XI REGION",
	12 => "XII REGION",
	13 => "REGION METROPOLITANA",
	14 => "DIRECCION NACIONAL",
	15 => "XV REGION",
	16 => "XIV REGION"
	);
session_start();

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

$usuario=$_SESSION["nom_user"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}

$date_in=date("d-m-Y");

$date_in2=date("Y-m-d");

extract($_GET);

extract($_POST);



header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada

header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos

header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE

header ("Pragma: no-cache");

$itemPresupuestario = "SELECT DISTINCT(CONCAT(cuenta_item,'.',cuenta_subitem,'.',cuenta_asignacion)) AS item_presupuestario FROM compra_cuentas WHERE cuenta_subitem <> '' AND cuenta_asignacion <> '' ORDER BY cuenta_item,cuenta_subitem,cuenta_asignacion ASC";
$resItemPresupuestario = mysql_query($itemPresupuestario);
$arrayItemPresupuestario = array();

while($rowItemPresupuestario = mysql_fetch_array($resItemPresupuestario))
{
	$arrayItemPresupuestario[] = $rowItemPresupuestario;
}

$xml_indicadores = "http://indicadoresdeldia.cl/webservice/indicadores.xml";
$xml_parse = simplexml_load_file($xml_indicadores);
$reemplazo = array("$",".");
?>

<html>

<head>

	<title>Compras</title>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
	<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
	<link href="css/estilos.css" rel="stylesheet" type="text/css">

	<style type="text/css">

		<!--

		body {

			margin-left: 0px;

			margin-top: 0px;

			margin-right: 0px;

			margin-bottom: 0px;

		}

		.Estilo1 {

			font-family: Verdana;

			font-weight: bold;

			font-size: 10px;

			color: #003063;

			text-align: left;

		}

		.Estilo1c {

			font-family: Verdana;

			font-weight: bold;

			font-size: 10px;

			color: #003063;

			text-align: center;

		}

		.Estilo1d {

			font-family: Verdana;

			font-weight: bold;

			font-size: 10px;

			color: #003063;

			text-align: right;

		}

		.Estilo2 {

			font-family: Verdana;

			font-size: 10px;

			text-align: left;

			color: #003063;



		}

		.Estilo2c {

			font-family: Verdana;

			font-size: 10px;

			color: #003063;

			text-align: center;

		}

		.Estilo2d {

			font-family: Verdana;

			font-size: 10px;

			text-align: right;

			color: #003063;

		}

		.Estilo2b {

			font-family: Verdana;

			font-size: 9px;

			text-align: left;

			color: #003063;

		}

		.Estilo3 {

			font-family: Verdana;

			font-size: 9px;

			text-align: left;

			font-weight: bold;

			color: #003063;

		}

		.Estilo3c {

			font-family: Verdana;

			font-size: 8px;

			font-weight: bold;

			text-align: center;

			color: #003063;

		}

		.Estilo4c {

			font-family: Verdana;

			font-size: 7px;

			font-weight: bold;

			text-align: center;

			color: #003063;

		}

		.Estilo3d {

			font-family: Verdana;

			font-size: 9px;

			font-weight: bold;

			text-align: right;

			color: #003063;

		}

		.Estilo1cverde {

			font-family: Verdana;

			font-weight: bold;

			font-size: 8px;

			color: #009900;

			text-align: right;

		}

		.Estilo1camarrillo {

			font-family: Verdana;

			font-weight: bold;

			font-size: 8px;

			color: #CCCC00;

			text-align: right;

		}

		.Estilo1crojo {

			font-family: Verdana;

			font-weight: bold;

			font-size: 8px;

			color: #CC0000;

			text-align: right;

		}

		.Estilo1crojoc {

			font-family: Verdana;

			font-weight: bold;

			font-size: 12px;

			color: #CC0000;

			text-align: center;

		}

		.link {

			font-family: Geneva, Arial, Helvetica, sans-serif;

			font-size: 10px;

			font-weight: bold;

			color: #00659C;

			text-decoration:none;

			text-transform:uppercase;

		}

		.link:over {

			font-family: Geneva, Arial, Helvetica, sans-serif;

			font-size: 10px;

			color: #0000cc;

			text-decoration:none;

			text-transform:uppercase;

		}

		.Estilo4 {

			font-size: 10px;

			font-weight: bold;

		}

		.Estilo7 {font-family: Geneva, Arial, Helvetica, sans-serif;

			font-size: 14px;

			font-weight: bold;

			text-align: center; }



		}

		.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif;

			font-size: 10px; font-weight: bold; text-align: left;

			color: #009900;}



		-->

	</style>







</head>

<!-- calendar stylesheet -->

<link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />



<!-- main calendar program -->

<script type="text/javascript" src="librerias/calendar.js"></script>



<!-- language for the calendar -->

<script type="text/javascript" src="librerias/lang/calendar-en.js"></script>



	<!-- the following script defines the Calendar.setup helper function, which makes

	adding a calendar a matter of 1 or 2 lines of code. -->

	<script type="text/javascript" src="librerias/calendar-setup.js"></script>



	<script type="text/javascript" src="select_dependientes2.js"></script>

	<script type="text/javascript" src="select_dependientes2b.js"></script>



	<script src="librerias/js/jscal2.js"></script>

	<script src="librerias/js/lang/es.js"></script>

	<link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />

	<link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />

	<link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />





	<SCRIPT LANGUAGE ="JavaScript">







	</script>

	<script language="javascript">
		function selTodo(){
			var reg = $("#selReg option:selected").val();
			var regText = $("#selReg option:selected").text();
			var totallinea = $("#totallinea").val();

			if($("#selTodo2").is(":checked")){

				for(i=0;i<totallinea;i++){
					$("#region2_"+i+" option:selected").text(regText);
					$("#region2_"+i+" option:selected").val(reg);
				}
			}
		}

		function selItem()
		{
			var item = $("#itemPresupuestario option:selected").val();
			var itemTexto = $("#itemPresupuestario option:selected").text();
			var totallinea = $("#totallinea").val();

			if($("#selTodo3").is(":checked")){

				for(i=0;i<totallinea;i++){
					$("#var6_"+i+" option:selected").text(itemTexto);
					$("#var6_"+i+" option:selected").val(item);
				}
			}

		}
		<!--

		function limpiar() {

			document.form1.dig.value="";

		}

		function verificador() {

			var rut = document.form1.rut.value;

			var dig = document.form1.dig.value;

			var count = 0;

			var count2 = 0;

			var factor = 2;

			var suma = 0;

			var sum = 0;

			var digito = 0;

			count2 = rut.length - 1;

			while(count < rut.length) {



				sum = factor * (parseInt(rut.substr(count2,1)));

				suma = suma + sum;

				sum = 0;



				count = count + 1;

				count2 = count2 - 1;

				factor = factor + 1;



				if(factor > 7) {

					factor=2;

				}



			}

			digito = 11 - (suma % 11);

			digito2 = 11 - (suma % 11);



			if (digito == 11) {

				digito = 0;

				digito2 = 0;

			}

			if (digito == 10) {

				digito = "k";

				digito2 = "K";

			}

			if (dig!=digito && dig!=digito2) {

				alert('Rut incorrecto, es  '+digito);

				document.form1.dig.value=''

				document.form1.dig.focus();

			} else {

				traerDatos(rut);

			//  alert('estoy en el else');

			//  llamado();



		}

		//form.dig.value = digito;

	}



	function llamado() {

		alert('llamando al un alerta de otra funcion');

	}



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



	function traerDatos(tipoDato)  {

		var ajax=nuevoAjax();

		//    alert (" dato "+tipoDato);

		ajax.open("POST", "buscaclient.php", true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		ajax.send("d="+tipoDato);



		ajax.onreadystatechange=function()	{

			if (ajax.readyState==4) {

				// Respuesta recibida. Coloco el texto plano en la capa correspondiente

				//capa.innerHTML=ajax.responseText;

				document.form1.nombre.value=ajax.responseText;

				var Date = document.form1.nombre.value;

				var elem = Date.split('/');

				document.form1.nombre.value=elem[0];

				//            document.form1.fpago.value = elem[1];

				document.form1.direccion.value = elem[2];

				document.form1.telefono.value = elem[3];

				if (elem[0]=='Proveedor No Existe') {

					//                alert("entra");

					document.getElementById("tipopersona2").style.visibility="visible";

					//             document.getElementById("checkbox3").style.visibility="hidden";

				} else {

					document.getElementById("tipopersona2").style.visibility="hidden";

				}

			}

		}

	}


	function validaOrdenCompra()
	{

		var numerooc1 = $("#numerooc1").val();
		var numerooc2 = $("#numerooc2").val();
		var numerooc3 = $("#numerooc3").val();

		if(numerooc1 == "")
		{
			alert("SELECCIONE EL PREFIJO");
			return false;
		}

		if(numerooc2 == "")
		{
			alert("INGRESE CORRELATIVO DE LA OC");
			return false;
		}

		if(numerooc3 == "")
		{
			alert("INGRESE EL SUFIJO DE LA OC");
			return false;
		}

		var oc = numerooc1+"-"+numerooc2+"-"+numerooc3;
		var data = ({cmd : "validaOC", oc : oc});

		var dataStore = $.ajax({
			type:"POST",
			url:"validaOrden.php",
			data:data,
			global: false,
			async:false,
			dataType:"html",
			success : function ( response ) {
				return response;
			}
		}).responseText;

		if(dataStore == "true")
		{
			alert("LA ORDEN DE COMPRA '"+oc+"' YA SE ENCUENTRA REGISTRADA");
			return false;
		}else{
			return true;
		}

	}


	function traerDatos2()  {

		var ajax=nuevoAjax();

		tipoDato1=document.form1.numero.value;

		tipoDato2=document.form1.rut.value;

		rut=document.form1.rut.value;

		//alert (" dato "+c);

		ajax.open("POST", "buscaclient2.php", true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		//ajax.send("d="+tipoDato,"e="+rut);

		ajax.send("d="+tipoDato1+"&e="+tipoDato2);



		ajax.onreadystatechange=function()	{

			if (ajax.readyState==4) {

				// Respuesta recibida. Coloco el texto plano en la capa correspondiente

				//capa.innerHTML=ajax.responseText;

				//b=ajax.responseText;

				if (ajax.responseText == 1) {

					//  alert (" No Existe "+b);

				}

				if (ajax.responseText == 0) {

					alert ("Numero de Boleta Existe Para esta proveedor ");

					document.form1.numero.value=ajax.responseText;

					//                    document.getElementById(c).value =ajax.responseText;

					//                    document.getElementById(c).value =0;



				}



			}

		}



	}



	function traerDatos3()  {

		var ajax=nuevoAjax();

		tipoDato1=document.form1.numerooc1.value;

		tipoDato2=document.form1.numerooc2.value;

		tipoDato3=document.form1.numerooc3.value;

		tipoDato3=tipoDato3.toUpperCase();

		codigo2=document.form1.codigo.value;

		codigo=tipoDato1+"-"+tipoDato2+"-"+tipoDato3;



		if (tipoDato2!='' && tipoDato3!='' && codigo!=codigo2 ) {

			//    alert (" dato "+codigo);

			ajax.open("POST", "buscaorden.php", true);

			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

			ajax.send("d="+tipoDato1+"&e="+tipoDato2+"&f="+tipoDato3);



			ajax.onreadystatechange=function()	{

				if (ajax.readyState==4) {

					// Respuesta recibida. Coloco el texto plano en la capa correspondiente

					//capa.innerHTML=ajax.responseText;

					//b=ajax.responseText;

					if (ajax.responseText == 0) {

						// alert (" No Existe ");

					}

					if (ajax.responseText == 1) {

						alert ("Numero de Orden de Compra Existe 1");

						document.form1.para.value='1';

						document.form1.numerooc2.value='';

						document.form1.numerooc3.value='';

						document.form1.nombreoc.value='';

						document.form1.obs.value='';

						document.form1.monto.value='';

						document.form1.codigo.value='';

						document.form1.rut.value='';

						document.form1.dig.value='';

						document.form1.nombre.value='';

						document.form1.direccion.value='';

						document.form1.telefono.value='';

						return ajax.responseText;

					}

					if (ajax.responseText == "Se ha producido un error||||||||") {

						alert ("Numero de Orden No Existe ");

						document.form1.para.value='1';

						document.form1.numerooc2.value='';

						document.form1.numerooc3.value='';

						document.form1.nombreoc.value='';

						document.form1.obs.value='';

						document.form1.monto.value='';

						document.form1.codigo.value='';

						document.form1.rut.value='';

						document.form1.dig.value='';

						document.form1.nombre.value='';

						document.form1.direccion.value='';

						document.form1.telefono.value='';

						return ajax.responseText;

					}



					if (ajax.responseText != 1) {

						//                  alert ("Numero de Orden de Completado "+ajax.responseText);

						var Date = ajax.responseText;

						var elem = Date.split('|');

						document.form1.nombreoc.value=elem[8];

						//                  document.form1.obs.value=elem[8];

						document.form1.monto.value=elem[1];

						document.form1.montob.value=elem[1];

						document.form1.codigo.value=elem[2];

						document.form1.obs.value=elem[4];

						document.form1.monedatraida.value=elem[7];

						document.form1.nombre.value=elem[9];

						if (document.form1.monedatraida.value!='CLP') {

							document.form1.monto.value="";

							document.form1.montob.value="";

						}





						var Date2 = elem[6];

						//                alert(Date2);

						var elem2 = Date2.split('-');

						document.form1.rut.value=elem2[0];

						document.form1.dig.value=elem2[1];



						//                traerDatos(elem2[0]);







					}







				}

			}

		}



	}



	function traerDatos4()  {

		var ajax=nuevoAjax();

		tipoDato1=document.form1.numerooc1.value;

		tipoDato2=document.form1.numerooc2.value;

		tipoDato3=document.form1.numerooc3.value;



		//alert (" dato "+c);

		ajax.open("POST", "buscaorden.php", true);

		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		ajax.send("d="+tipoDato1+"&e="+tipoDato2+"&f="+tipoDato3);



		ajax.onreadystatechange=function()	{

			if (ajax.readyState==4) {

				// Respuesta recibida. Coloco el texto plano en la capa correspondiente

				//capa.innerHTML=ajax.responseText;

				//b=ajax.responseText;

				if (ajax.responseText == 0) {

					// alert (" No Existe ");

				}

				if (ajax.responseText == 1) {

					alert ("Numero de Orden de Compra Existe 2");

					document.form1.para.value='1';

					document.form1.numerooc2.value='';

					document.form1.numerooc3.value='';

					document.form1.numerooc2.focus();

					return ajax.responseText;



				}



			}

		}

	}





	function ChequearTodos(chkbox)

	{

		for (var i=0;i < document.forms[0].elements.length;i++){

			var elemento = document.forms[0].elements[i];

			alert("aqui "+chkbox);

			if (elemento.type == "checkbox"){

				elemento.checked = chkbox.checked

			}

		}

	}



	function valida() {

		var archivo1 = document.form1.archivo1.value;
		var archivo2 = document.form1.archivo2.value;
		var distribucion = document.form1.distribucion.value;

		if(archivo1 != "")
		{
			var extension = archivo1.split(".").pop().toUpperCase();
			if(extension != "PDF")
			{
				alert("La extension permitida es : .PDF");
				document.form1.archivo1.focus();
				return false;
			}
		}

		if(archivo2 != "")
		{
			var extension = archivo2.split(".").pop().toUpperCase();
			if(extension != "PDF")
			{
				alert("La extension permitida es : PDF");
				document.form1.archivo2.focus();
				return false;
			}
		}


		if(distribucion != "")
		{
			var extension = distribucion.split(".").pop().toUpperCase();
			if(extension != "XLSX" && extension != "XLS" && extension != "CSV")
			{
				alert("Las extensiones permitidas son : .XLSX .XLS y .CSV");
				document.form1.distribucion.focus();
				return false;
			}
		}

		var x = $("#accion2:checked").val();

		if(x == null)
		{
			alert("SELECCIONE BIEN O SERVICIO");
			$("#accion2").focus();
			return false;
		}

		if(document.form1.numerooc1.value==0 || document.form1.numerooc1.value=='')
		{
			alert("SELECCIONE EL PREFIJO LA O/C");
			return false;
		}

		if(document.form1.numerooc2.value==0 || document.form1.numerooc2.value=='')
		{
			alert("INGRESE EL CORRELATIVO DE LA O/C");
			return false;
		}

		if(document.form1.numerooc3.value==0 || document.form1.numerooc3.value=='')
		{
			alert("INGRESE EL SUFIJO DE LA O/C");
			return false;
		}

		if (document.form1.rut.value==0 || document.form1.rut.value=='') {
			alert ("Rut presenta problemas ");
			return false;
		}

		if (document.form1.dig.value=='') {
			alert ("Dig presenta problemas ");
			return false;
		}

		if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
			alert ("Nombre presenta problemas ");
			return false;
		}

		if (document.form1.direccion.value=='') {
//			alert ("Direccion presenta problemas ");
//			return false;
}

if (document.form1.numerooc2.value=='' || document.form1.numerooc3.value==''  ) {
	alert ("Numero OC presenta problemas ");
	return false;
}

if (document.form1.nombreoc.value=='' ) {
	alert ("Nombre OC presenta problemas ");
	return false;
}

if (document.form1.tipo2b.value=='' ) {
	alert ("Tipo Contratacion presenta problemas ");
	return false;
}

if (document.form1.documento2.value=='' ) {
	alert ("Modalida presenta problemas ");
	return false;
}

if (document.form1.tipo2.value=='' ) {
	alert ("Centro de Costo presenta problemas ");
	return false;
}

if (document.form1.documento.value=='' ) {
	alert ("Plan de Compra presenta problemas ");
	return false;
}

if (document.form1.monto.value=='' ) {
	alert ("Monto presenta problemas ");
	return false;
}

if (document.form1.obs.value=='' ) {
	alert ("Observacion presenta problemas ");
	return false;
}

if (document.form1.estado22.value=='' ) {
	alert ("Estado presenta problemas ");
	return false;
}

if (document.form1.archivo1.value=='' ) {
	alert ("Archivo presenta problemas ");
	return false;
}

if(document.form1.tcompra.value=='')
{
	alert("Tipo compra presenta problemas");
	return false;
}

if(x == "BIEN")
{
	if (document.form1.grupo.value == 0 || document.form1.grupo.value =='') {
		alert("DEBE SELECCIONAR EL GRUPO");
		return false;
	}

	if(document.form1.f_date_c2.value == 0 || document.form1.f_date_c2.value ==''){
		alert("DEBE INGRESAR LA FECHA DE ENTREGA");
		return false;
	}

	if(document.form1.programa.value == 0 || document.form1.programa.value ==''){
		alert("DEBE SELECCIONAR EL PROGRAMA");
		return false;
	}

	if(document.form1.tipo_cambio.value == 0 || document.form1.tipo_cambio.value ==''){
		alert("DEBE INGRESAR EL VALOR DEL CAMBIO");
		return false;
	}

	if(document.form1.tipo_compra.value == 0 || document.form1.tipo_compra.value ==''){
		alert("DEBE SELECCIONAR LA UNIDAD DE MEDIDA");
		return false;
	}

	if(document.form1.distribucion.value=='')
	{
		alert("Falta archivo de distribucion");
		return false;
	}
}

if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?'))
{
	blockUI();
}else{
	return false;
}

}

function envia() {

	if (document.form1b.accion[0].checked) {

		document.getElementById("cuerpo").style.visibility="visible";

	}

	if (document.form1b.accion[1].checked) {

		document.getElementById("cuerpo").style.visibility="hidden";

		if (confirm('¡¡Para continuar debe Crear Actividad en Plan de Compra!!')){

			location.href="compra_ingresa.php?ori=2";

		} else {

			document.getElementById("cuerpo").style.visibility="visible";

			document.form1b.accion[0].checked='true';

		}

	}
}
$(function(){
	$(".bbyss").hide();
})
function envia3(tipo) {

	if(tipo == "B")
	{
		$("#tipo").val("BIEN");
			// document.getElementById("bbyss").style.visibility="visible";
			$(".bbyss").show();
		}else{
			$("#tipo").val("SERVICIO");
			// document.getElementById("bbyss").style.visibility="hidden";
			$(".bbyss").hide();
		}
		// if (document.form2b.accion2[0].checked) {
		// 	document.getElementById("cuerpo3").style.visibility="visible";
		// }

		// if (document.form2b.accion2[1].checked) {
		// 	document.getElementById("cuerpo3").style.visibility="hidden";
		// }
	}

	function envia2() {

		document.getElementById("cuerpo").style.visibility="visible";

		document.form1b.accion[0].checked='true';

	}



	//-->



</script>



<body>

	<?php



	if (isset($_GET["anno2"])) {

		$anno2=$_GET["anno2"];

	} else {

		$anno2=date("Y");

	}





	function generalista()

	{

		$regionsession = $_SESSION["region"];

		if (( 1==1)  ) {

			$consulta=mysql_query("Select compra_depto,compra_depto, compra_anno from compra_compra where compra_region='$regionsession' and compra_estado='PENDIENTE' and compra_cierre=1  group by compra_anno, compra_depto order by compra_anno desc");

		} else {

			$consulta=mysql_query("Select compra_depto,compra_depto, compra_anno from compra_compra where compra_region='$regionsession' and compra_anno='2013'  group by compra_depto");

		}

			//	$consulta=mysql_query("Select compra_depto,compra_depto from compra_compra where compra_region='$regionsession'  group by compra_depto");

			//	$consulta=mysql_query("Select subcat_nombre,subcat_nombre from compra_subcat  where subcat_cat_id =4");



			// Voy imprimiendo el primer select compuesto por los paises

		echo "<select name='paises' id='paises' onChange='cargaContenido2(this.id)' class='Estilo1'>";

		echo "<option value='0'>Seleccione...</option>";

		while($registro=mysql_fetch_row($consulta))

		{

			echo "<option value='".$registro[0]."/".$registro[2]."'>".$registro[1]."-".$registro[2]."</option>";

		}

		echo "</select>";

	}

	function generalista2()

	{

		$consulta=mysql_query("Select cat_nombre, cat_id from compra_categoria where cat_estado =2");



			// Voy imprimiendo el primer select compuesto por los paises

		echo "<select name='paises2' id='paises2' onChange='cargaContenido2b(this.id)' class='Estilo1'>";

		echo "<option value='0'>Seleccione...</option>";

		while($registro=mysql_fetch_row($consulta))

		{

			echo "<option value='".$registro[1]."'>".$registro[0]."</option>";

		}

		echo "</select>";

	}

	?>



	<div class="navbar-nav ">

		<div class="container">

			<div class="navbar-header">







				<?

				require("inc/top.php");

				?>



			</div>

		</div>

	</div>





	<div class="container">

		<div class="row">

			<div class="col-sm-2 col-lg-2">

				<div class="dash-unit2">



					<?

					require("inc/menu_1.php");

					?>



				</div>

			</div>



			<div class="col-sm-10 col-lg-10">

				<div class="dash-unit2">



					<table width="100%" border="0" cellspacing="0" cellpadding="0">

						<tr>

							<td height="20" colspan="2"><span class="Estilo7">INGRESO ORDEN DE COMPRA (Mercado P&uacute;lico )</span></td>

						</tr>

						<tr>

							<td></td><td></td>

						</tr>

						<tr>

							<td width="480" valign="top" class="Estilo1c">



								<?



								if (isset($_GET["llave"])) {

									if ($_GET["llave"]==1)

										echo "<p>Registros Insertados con Exito !";

									if ($_GET["llave"]==2)

										echo "<p>Registros NO insertados !";

								}



								?>

							</td>

						</tr>

						<tr>

							<td><a href="compra_menuoc.php" class="link" >Volver</a></td>

						</tr>



						<tr>

							<td><hr></td><td><hr></td>





						</tr>

						<?

						$id=$_GET["id"];

						if ($_GET["ori"]==1)  {

							$sql2 = "delete from compra_orden where oc_id=$id";

								//    echo $sql2;

							mysql_query($sql2);

										$oc_inedis = "UPDATE bode_orcom SET oc_estado = 0 WHERE oc_id2 = '".$_GET["oc"]."'";
						mysql_query($oc_inedis,$dbh6);
						
								//    exit();



						}

						$sqlRegion = "SELECT * FROM regiones";

						$sqlRegionResp = mysql_query($sqlRegion);



						// while($row = mysql_fetch_array($sqlRegionResp)) {

						// 	$regionG[$ii]=$row["nombre"];

						// 	$regionN[$ii]=$row["codigo"];

						// 	$ii++;

						// }
						$ii = 1;
						foreach ($reg2 as $key => $value) {
							$regionG[$ii] = $value;
							$regionN[$ii] = $key;
							$ii++;
						}

						$sqlRegion = "SELECT * FROM regiones";

						$sqlRegionResp = mysql_query($sqlRegion);





						?>





						<tr>

							<td height="30" colspan="3">

							</table>

							<!-- ESTA O NO EN PLAN DE COMPRAS !-->
							<form name="form1b" action="compra_grabaorden.php" method="post" enctype="multipart/form-data">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td  valign="center" class="Estilo1">&iquest;LA ORDEN DE COMPRA EST&Aacute; EN PLAN DE COMPRAS? </td>
										<td class="Estilo1" colspan=1>
											<input type="radio" name="accion" class="Estilo2" value="SI" onclick="envia();"> SI
											<input type="radio" name="accion" class="Estilo2" value="NO" onclick="envia();"> NO
										</td>
									</tr>
									<tr>
										<td><hr></td>
										<td><hr></td>
									</tr>
								</table>
							</form>
							<!-- FIN ESTA O NO EN PLAN DE COMPRAS !-->




							<div id="cuerpo" style="visibility:hidden" >
								<?
								$prefijos = array(1 => 845,2 => 1573,3 => 846,4 => 1574,5 => 847,6 => 1575,7 => 848,8 => 1576,9 => 852,10 => 853,11 => 854,12 => 855,13 => 856,14 => 599,15 => 1572,16 => 5538);
								$para1 = $prefijos[$regionsession];
								?>




								<!-- BUSQUEDA DE O/C -->
								<table border="0" width="100%">
									<form name="form11" action="compra_orden.php" method="post" onsubmit="return validaOrdenCompra()">
										<tr>
											<td  valign="center" class="Estilo1">N&uacute;mero O/C </td>
											<td class="Estilo1" colspan=3>
												<?php if($regionsession == 14): ?>
													<select name="numerooc1" id="numerooc1">
														<option value="">Seleccionar...</option>
														<option value="599" <?php if($numerooc1 == 599){echo"selected";}?>>599</option>
														<option value="856" <?php if($numerooc1 == 856){echo"selected";}?>>856</option>
													</select>
												<?php else: ?>
													<input type="hidden" name="numerooc1" id="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -
												<?php endif ?>
												<input type="text" name="numerooc2" id="numerooc2" class="Estilo2" size="7"  value="<? echo $numerooc2 ?>"> -
												<input type="text" name="numerooc3" id="numerooc3" class="Estilo2" size="7" value="<? echo $numerooc3 ?>" >
												<input type="hidden" name="codigo" class="Estilo2" size="7" >
												<input type="hidden" name="cod" value="20" >
												<input type="submit" name="boton" id="boton" class="Estilo2" value="OK">
											</td>
										</tr>
									</form>
								</table>
								<!-- FIN BUSQUEDA O/C -->

								<hr>
								<!-- ESTA O NO EN PLAN DE COMPRAS !-->
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td valign="center" class="Estilo1">&iquest; BIEN O SERVICIO ? </td>
										<td class="Estilo1" colspan=1>
											<input type="radio" name="accion2" id="accion2" class="Estilo2" value="BIEN" onclick="envia3('B');"> BIEN
											<input type="radio" name="accion2" id="accion2" class="Estilo2" value="SERVICIO" onclick="envia3('S');"> SERVICIO
										</td>
									</tr>
									<tr>
										<td><hr></td>
										<td><hr></td>
									</tr>
								</table>
								<!-- FIN ESTA O NO EN PLAN DE COMPRAS !-->
								<?

								if ($numerooc3<>'') {
									include("bode_buscaorden2.php");
									$error = $xmlObject->ListSummary->OrdersQuantity;
									$oc_estado = $xmlObject->OrdersList->Order->OrderSummary->SummaryNote;
									$oc_nombre = $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->QuoteReference->RefNum;
									$oc 	   = $xmlObject->OrdersList->Order->OrderHeader->OrderNumber->BuyerOrderNumber;
									$sc        = $xmlObject->OrdersList->Order->OrderHeader->OrderReferences->ListOfCostCenter->CostCenter->CostCenterNumber;
									$sc = explode(" ", $sc);
									$sc = trim(str_replace(".","",$sc[1]));
									$emisionOC = substr($xmlObject->OrdersList->Order->OrderHeader->OrderDates->PromiseDate, 0,10);
								}
									// $file = fopen("archivo.xml","w");
 								// 	fwrite($file, $contenido);
 								// 	fclose($file);
								?>
								
								<?php
								if($oc_estado == "OC Aceptada" || $oc_estado == "OC Enviada a Proveedor" || $oc_estado == "OC en Proceso" || $oc_estado=="Recepción Conforme")
								{
									$proceder = "SI";
								}else{
									$proceder == "NO";
								}
								?>

								<?php 
								if($proceder == "SI") { ?>

								<!-- RESULTADO OC -->
								<table border="0" width="100%"  class="table table-striped">

									<tr>
										<td class="Estilo1">REGION</td>
										<td class="Estilo1">
											<?php if ($_SESSION["region"] <> 14): ?>
												<select class="Estilo1" name="selReg" id="selReg">
													<option value="">Seleccionar...</option>
													<?php if ($_SESSION["region"] == 1): ?>
														<option value="1">I REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 2): ?>
														<option value="2">II REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 3): ?>
														<option value="3">III REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 4): ?>
														<option value="4">IV REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 5): ?>
														<option value="5">V REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 6): ?>
														<option value="6">VI REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 7): ?>
														<option value="7">VII REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 8): ?>
														<option value="8">VIII REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 9): ?>
														<option value="9">IX REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 10): ?>
														<option value="10">X REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 11): ?>
														<option value="11">XI REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 12): ?>
														<option value="12">XII REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 13): ?>
														<option value="13">REGION METROPOLITANA</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 14): ?>
														<option value="14">XIV REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 15): ?>
														<option value="15">XV REGION</option>
													<?php endif ?>

													<?php if ($_SESSION["region"] == 16): ?>
														<option value="16">XIV REGION</option>
													<?php endif ?>

												</select>

											<?php else: ?>

												<select class="Estilo1" name="selReg" id="selReg">
													<option value="">Seleccionar...</option>
													<?php foreach ($reg2 as $key => $value): ?>
														<option value="<?php echo $key ?>"><?php echo $value?></option>
													<?php endforeach ?>
												</select>

											<?php endif ?>



										</td>

										<td class="Estilo1"><input type="checkbox" name="selTodo2" id="selTodo2">Seleccionar Todo</td>

										<td><button type="button" onClick="selTodo()">IR</button></td>

									</tr>

									<tr>
										<td class="Estilo1">ITEM</td>
										<td class="Estilo1">
											<select name="itemPresupuestario" id="itemPresupuestario" onChange="getCtaActivoGasto2(this.value)">
												<option value="" selected>Seleccionar...</option>
												<?php foreach ($arrayItemPresupuestario as $key => $value): ?>
													<option value="<?php echo $value["item_presupuestario"] ?>"><?php echo $value["item_presupuestario"] ?></option>
												<?php endforeach ?>
											</select>

										</td>
										<td class="Estilo1"><input type="checkbox" name="selTodo3" id="selTodo3">Seleccionar Todo</td>

										<td><button type="button" onClick="selItem()">IR</button></td>
									</tr>

									<tr>
										<td valign="center" class="Estilo1">NOMBRE O/C:</td>
										<td valign="center" class="Estilo1" colspan="3">

											<?php if($oc_estado == "OC Enviada a Proveedor") { echo "<font color='red'>La Orden De Compra '$oc' Ha sido enviada al proveedor</font>"; }?>
											<?php if($oc_estado == "OC Removida") { echo "<font color='red'>La Orden De Compra '$oc' Ha sido removida</font>"; }?>
											<?php if($oc_estado == "OC No Aceptada") { echo "<font color='red'>La Orden De Compra '$oc' no ha sido aceptada por el proveedor</font>"; }?>
											<?php if($oc_estado == "OC en Proceso"){ echo "<font color='red'>La Orden De Compra '$oc' Esta en proceso</font>"; }?>
											<?php if($oc_estado == "OC Cancelada"){ echo "<font color='red'>La Orden De Compra '$oc' ha sido cancelada</font>"; }?>
											<?php if($oc_estado == "OC Aceptada") { echo $oc_nombre;} ?>

										</td>
									</tr>

									<tr>
										<td valign="center" class="Estilo1">ESTADO O/C:</td>
										<td valign="center" class="Estilo1" colspan="3">
											<?php echo $oc_estado ?>
										</td>
									</tr>

									<tr>
										<td valign="center" class="Estilo1">S/C : </td>
										<td valign="center" class="Estilo1">
											<a href='http://abaco.junji.gob.cl/_layouts/FormServer.aspx?XmlLocation=/Solicitudes%20de%20Compra/<?php echo $sc ?>.xml&ClientInstalled=false&Source=http%3A%2F%2Fabaco%2Ejunji%2Egob%2Ecl%2FSolicitudes%2520de%2520Compra%2FForms%2FAllItems%2Easpx&DefaultItemOpen=1' target="_blank" title="N&deg; SOLICITUD DE COMPRA (ABACO)"><?php echo utf8_decode($sc) ?></a>
										</td>
									</tr>
								</table>


								<!-- graba formulario -->

								<table border="0" width="100%">

									<tr>
										<td  valign="center" class="Estilo1">Item</td>
										<td  valign="center" class="Estilo1">Region</td>
										<td  valign="center" class="Estilo1">Descripcion</td>
										<td  valign="center" class="Estilo1">Cantidad</td>
										<td  valign="center" class="Estilo1">Total Neto</td>
										<td  valign="center" class="Estilo1">Unitario</td>
									</tr>

									<!-- GRABA BODE ORCOM -->
									<form name="form1" id="form1" action="compra_grabaorden.php" method="post" onsubmit="return valida()" enctype="multipart/form-data">

										<?
										$i=0;

										while ($i<$totallinea) {

													//  $totallinea=$xmlObject->OrdersList->Order->OrderSummary->NumberOfLines;



													//    /OrdersResults/OrdersList/Order/OrderDetail/ListOfItemDetail/ItemDetail[1]/PricingDetail/LineItemTotal/MonetaryAmount

													//     /OrdersResults/OrdersList/Order/OrderDetail/ListOfItemDetail/ItemDetail[1]/BaseItemDetail/ItemIdentifiers/ItemDescription



											$cantidad2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->BaseItemDetail->TotalQuantity->QuantityValue;

											$total2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->PricingDetail->LineItemTotal->MonetaryAmount;

											$descrip2=$xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->BaseItemDetail->ItemIdentifiers->ItemDescription;

											$unit = $xmlObject->OrdersList->Order->OrderDetail->ListOfItemDetail->ItemDetail[$i]->PricingDetail->ListOfPrice->Price->UnitPrice->UnitPriceValue;

											$moneda = $xmlObject->OrdersList->Order->OrderSummary->OrderTotal->Currency->CurrencyCoded;

											?>

											<tr>
												<td class="Estilo1" colspan=1>
													<select name="var6[<?php echo $i ?>]" id="var6_<?php echo $i ?>" required onChange="getCtaActivoGasto3(this.value,<?php echo $i ?>)">
														<option value="" selected>Seleccionar...</option>
														<?php foreach ($arrayItemPresupuestario as $key => $value): ?>
															<option value="<?php echo $value["item_presupuestario"] ?>"><?php echo $value["item_presupuestario"] ?></option>
														<?php endforeach ?>
													</select>

													<input type="hidden" name="cta_activo[<?php echo $i ?>]" id="cta_activo_<?php echo $i ?>">
													<input type="hidden" name="cta_gasto[<?php echo $i ?>]" id="cta_gasto_<?php echo $i ?>">

												</td>
												<td class="Estilo1" colspan=1>

													<select name="var4[<? echo $i ?>]" id="region2_<?php echo $i?>" class="Estilo2" required>
														<option value="">Seleccionar...</option>
														<?php
														$j=1;
														while($j<$ii) {

															?>

															<option value="<? echo  $regionN[$j] ?>" > <? echo $regionG[$j] ?></option>

															<?php

															$j++;

														}

														?>
													</select>

												</td>

												<td class="Estilo1" colspan=1>

													<input type="text" name="var[<? echo $i ?>]" class="Estilo2" size="40"  value="<? echo $descrip2 ?>" required >

												</td>

												<td class="Estilo1" colspan=1>

													<input type="text" name="var3[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $cantidad2 ?>" readonly style="background-color: rgb(235, 235, 235)" >

												</td>

												<td class="Estilo1" colspan=1>

													<input type="text" name="var2[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $total2 ?>" readonly style="background-color: rgb(235, 235, 235)">

												</td>

												<td class="Estilo1" colspan=1>
													<input type="text" name="var5[<? echo $i ?>]" class="Estilo2" size="7"  value="<? echo $unit ?>" readonly style="background-color: rgb(235, 235, 235)">
												</td>

											</tr>

											<?

											$montototal=$montototal+$cantidad2;

											$i++;

												}// Fin while



												//OrdersResults/OrdersList/Order/OrderSummary/OrderTotal/MonetaryAmount

												$cantidadtotal=$xmlObject->OrdersList->Order->OrderSummary->OrderTotal->MonetaryAmount;

												?>

											</table>
											<!-- FIN RESULTADO O/C -->
											<!-- INFORMCION OC -->
											<table border="0" width="100%"  class="table table-striped bbyss">
												<hr>

												<tr>

													<td valign="center" class="Estilo1">GRUPO</td>

													<td class="Estilo1">
														<select name="grupo" id="grupo" class="Estilo2">
															<option  value="" selected>Seleccionar...</option>
															<?php foreach ($grupos as $key => $value): ?>
																<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
															<?php endforeach ?>
														</select>
													</td>

													<td  valign="center" class="Estilo1">FECHA ENTREGA</td>

													<td class="Estilo1" valign="center">

														<input type="text" name="fecha_orden_compra" class="Estilo2" size="12"  id="f_date_c2" readonly="1" style="background-color: rgb(235, 235, 235)">

														<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"

														onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



														<script type="text/javascript">

															Calendar.setup({

																inputField : "f_date_c2",

																trigger    : "f_trigger_c2",

																onSelect   : function() { this.hide() },

																showTime   : 12,

																dateFormat : "%d-%m-%Y"

															});

														</script>

													</td>



												</tr>



												<tr>

													<td class="Estilo1">CANTIDAD TOTAL</td>

													<td class="Estilo1">

														<input type="text" name="cantidad" id="cantidad" class="Estilo2" size="12" value="<? echo $montototal ?>" reaadonly style="background-color: rgb(235, 235, 235)">

													</td>



													<td class="Estilo1">MONTO TOTAL C / IVA</td>

													<td class="Estilo1" colspan="3">

														<input type="text" name="total" id="total" class="Estilo2" size="8" value="<? echo $cantidadtotal ?>" readonly style="background-color: rgb(235, 235, 235)">

													</td>



												</tr>



												<tr>

													<td class="Estilo1">PROGRAMA</td>

													<td class="Estilo1">
														<select name="programa" id="programa" class="Estilo2">
															<option  value="" selected>Seleccionar...</option>
															<?php foreach ($programas as $key => $value): ?>
																<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
															<?php endforeach ?>
															<option value="P1P2">P1 + P2 </option>
														</select>
													</td>



													<td class="Estilo1">TIPO CAMBIO</td>

													<td class="Estilo1">

														<select name="moneda" id="moneda" class="Estilo2" onChange="tipoCambio(this.value)">

															<?php if ($moneda == "CLP"): ?>

																<option value="PESO" selected>PESO</option>

															<?php elseif($moneda == "USD"): ?>

																<option value="DOLAR" selected>DOLAR</option>

															<?php elseif($moneda == "UF"): ?>

																<option value="UF" selected>UF</option>

															<?php endif ?>

														</select>

													</td>



													<td class="Estilo1">

														<?php if ($moneda == "USD"): ?>

															<input type="text" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="6" size="5" value="<?php echo str_replace(",",".",trim(str_replace($reemplazo,"",$xml_parse->moneda->dolar))) ?>">

														<?php endif ?>

														<?php if ($moneda == "UF"): ?>

															<input type="text" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="6" size="5" value="<?php echo str_replace(",",".",trim(str_replace($reemplazo,"",$xml_parse->indicador->uf))) ?>">

														<?php endif ?>




														<?php if ($moneda == "CLP"): ?>

															<input type="hidden" name="tipo_cambio" id="tipo_cambio" class="Estilo2" maxlength="1" size="2" value="1">

														<?php endif ?>



													</td>



												</tr>



												<tr>

													<!--

													<td class="Estilo1">PROVEEDOR RUT</td>

													<td class="Estilo1">

														<input type="hidden" name="proveedor" id="proveedor" class="Estilo2" size="12" value="<? //echo $rut ?>" readonly style="background-color: rgb(235, 235, 235)">

														<input type="hidden" name="proveedor2" id="proveedor2" class="Estilo2" size="1" value="<? //echo $dig ?>" readonly style="background-color: rgb(235, 235, 235)">

													</td>



												-->


												<td class="Estilo1">UNIDAD DE MEDIDA</td>

												<td class="Estilo1" colspan="3">
													<select name="tipo_compra" id="tipo_compra" class="Estilo2">
														<option value="" selected>Seleccionar...</option>
														<?php foreach ($uMedida as $key => $value): ?>
															<option value="<?php echo $value["param_glosa"] ?>"><?php echo $value["param_desc"] ?></option>
														<?php endforeach ?>
													</select>
												</td>

											</tr>



											<tr>

											<!--

											<td class="Estilo1">PROVEEDOR NOMBRE</td>

											<td class="Estilo1">

										</td>

									-->

									<input type="hidden" name="proveedor" id="proveedor" class="Estilo2" size="12" value="<? echo $rut ?>" readonly style="background-color: rgb(235, 235, 235)">
									<input type="hidden" name="proveedor2" id="proveedor2" class="Estilo2" size="1" value="<? echo $dig ?>" readonly style="background-color: rgb(235, 235, 235)">

									<input type="hidden" name="proveedornomb" id="proveedornomb" class="Estilo2" size="40" value="<? echo $nombreproveedor ?>" readonly style="background-color: rgb(235, 235, 235)">





									<?php if (45 == $nivel): ?>

										<td class="Estilo1">DISTRIBUCION</td>

										<td class="Estilo1"><input type="file" name="distribucion" id="distribucion"></td>

									<?php endif ?>


									<tr>
										<td colspan="5"></td>
									</tr>
								</tr>
							</table>
							<!-- FIN INFO ADICIONAL -->


							<table border="0" width="100%">

								<tr>

									<td class="Estilo1c">

										<input type="hidden" name="oc" value="<? echo $codigo ?>"  >

										<input type="hidden" name="totallinea" id="totallinea" value="<? echo $totallinea ?>" >

										<input type="hidden" name="descuento" value="<? echo $descuento ?>" >

										<!-- <input type="hidden" name="nombreoc" value="<? //echo $nombreoc ?>" > -->

										<input type="hidden" name="sc" value="<? echo $sc ?>" >

										<input type="hidden" name="f_oc" value="<? echo $emisionOC ?>" >

									</td>

								</tr>
							</table>
							<!-- FIN GRABA BODE ORCOM -->

							<!--  =================================== -->


							<table width="100%" border="0" cellspacing="0" cellpadding="0">

								<tr>

									<td  valign="center" class="Estilo1">Fecha Compra</td>

									<td class="Estilo1" valign="center">

										<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" >

										<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"

										onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



										<script type="text/javascript">

											Calendar.setup({

												inputField : "f_date_c1",

												trigger    : "f_trigger_c1",

												onSelect   : function() { this.hide() },

												showTime   : 12,

												dateFormat : "%d-%m-%Y"

											});

										</script>


									</td>

									<td  valign="center" class="Estilo1">Regi&oacute;n</td>

									<td class="Estilo1">

										<select name="region" class="Estilo1">



											<?

											if ($regionsession==0) {

												$sql2 = "Select * from regiones order by codigo";

												echo '<option value="">Select...</option>';

											} else

											$sql2 = "Select * from regiones where codigo=$regionsession";

											//echo $sql;

											$res2 = mysql_query($sql2);



											while($row2 = mysql_fetch_array($res2)){



												?>

												<option value="<? echo $row2["codigo"] ?>"><? echo $row2["nombre"] ?></option>



												<?

											}

											?>





										</select>





									</td>

								</tr>

							</table>

							<hr>

							<table width="100%" border="0" cellspacing="0" cellpadding="0"   class="table table-striped">



								<?

							/*if ($regionsession==1) {

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

							if ($regionsession==15) {

								$para1="856";

							}

							if ($regionsession==12) {

								$para1="855";

							}

							if ($regionsession==14) {

								$para1="599";

							}

							if ($regionsession==15) {

								$para1="5538";

							}

							if ($regionsession==16) {

								$para1="1572";

							}*/





							?>

							<tr>

								<td  valign="center" class="Estilo1">N&uacute;mero O/C </td>

								<td class="Estilo1" colspan=3>

									<input type="hidden" name="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -

									<input type="text" name="numerooc2"  value="<? echo $numerooc2 ?>" class="Estilo2" size="7"  onblur="traerDatos3();"> -

									<input type="text" name="numerooc3" value="<? echo $numerooc3 ?>" class="Estilo2" size="7" onblur="traerDatos3();" >

									<input type="hidden" name="codigo" class="Estilo2" size="7" >



								</td>

							</tr>

							<tr>

								<td  valign="center" class="Estilo1">Nombre O/C </td>

								<td class="Estilo1" colspan=2>

									<textarea name="nombreoc" rows="3" class="Estilo2" cols="64" ><? echo $oc_nombre ?></textarea>

								</td>

							</tr>

							<tr>

								<td  class="Estilo1">Rut Proveedor</td>

								<td class="Estilo1" colspan=3>

									<input type="text" name="rut" class="Estilo2" size="15" value="<? echo $rut ?>" onchange="limpiar()"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" > -

									<input type="text" name="dig" class="Estilo2" size="2"  value="<? echo $dig ?>" onChange="verificador()">  Rut sin puntos

								</td>

							</tr>

							<tr>

								<td  class="Estilo1">Nombre Proveedor</td>

								<td class="Estilo1" colspan=2>

									<input type="text" name="nombre" class="Estilo2" size="64" value="<? echo $nombreproveedor ?>">

								</td>

							</tr>

							<tr>

								<td  class="Estilo1">Direcci&oacute;n Proveedor</td>

								<td class="Estilo1" colspan=1>

									<input type="text" name="direccion" class="Estilo2" size="40">

								</td>



								<td   class="Estilo1">Tel&eacute;fono Proveedor</td>

								<td class="Estilo1" colspan=1>

									<input type="text" name="telefono" class="Estilo2" size="15">

								</td>

							</tr>

							<tr>

								<td  valign="center" class="Estilo1">Monto O.C.</td>

								<td class="Estilo1" colspan=1>

									<input type="text" name="monto" class="Estilo2" size="15"  value="<? echo $cantidadtotal ?>" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" > <?php echo $moneda ?>

									<?php if ($moneda == "CLP"): ?>
										<input type="hidden" name="moneda" class="Estilo2" size="15" value="PESO" >
									<?php elseif($moneda == "USD"): ?>
										<input type="hidden" name="moneda" class="Estilo2" size="15" value="DOLAR" >
									<?php elseif($moneda == "UF"): ?>
										<input type="hidden" name="moneda" class="Estilo2" size="15" value="UF" >
									<?php endif ?>

								</td>



								<td  valign="center" class="Estilo1">Comprometido <? echo $anno2 ?> Abaco</td>

								<td class="Estilo1" colspan=1>

									<input type="text" name="montob" class="Estilo2" size="15"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" > Pesos

									<input type="hidden" name="monedab" class="Estilo2" size="15" value="Pesos" >

								</td>

							</tr>

<?php if ($moneda <> "CLP"): ?>
								<tr>
								<td class="Estilo1">Valor moneda de cambio</td>
								<?php if ($moneda == "USD"): ?>
									<td class="Estilo1"><input type="text" name="oc_moneda" id="oc_moneda" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required value="<?php echo str_replace(",",".",trim(str_replace($reemplazo,"",$xml_parse->moneda->dolar))) ?>"></td>
								<?php endif ?>

								<?php if ($moneda == "UF"): ?>
									<td class="Estilo1"><input type="text" name="oc_moneda" id="oc_moneda" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required value="<?php echo str_replace(",",".",trim(str_replace($reemplazo,"",$xml_parse->indicador->uf))) ?>"></td>
								<?php endif ?>
							</tr>
						<?php else: ?> 
							<input type="hidden" name="oc_moneda" id="oc_moneda" value="1">
							<?php endif ?>

							<tr>

								<td  valign="center" class="Estilo1">Observaci&oacute;n  </td>

								<td class="Estilo1" colspan=3>

									<textarea name="obs" rows="3" class="Estilo2" cols="64"><? echo utf8_decode($obs) ?></textarea>

								</td>

							</tr>









							<tr>

								<td  valign="center" class="Estilo1">Tipo Contrataci&oacute;n  </td>

								<td class="Estilo1">

									<?php generalista2(); ?>

									<input type="hidden" name="tipo2b" class="Estilo2" size="40" value="" >

								</td>



								<td  valign="center" class="Estilo1">Modalidad  </td>

								<td class="Estilo1">

									<select disabled="disabled" name="estados2" id="estados2" class="Estilo1">

										<option value="0">Seleccione...</option>

									</select>

								</td>

							</tr>





							<tr>

								<td valign="center" class="Estilo1">Centro de Costo</td>

								<td><?php generalista(); ?>

									<input type="hidden" name="tipo2" class="Estilo2" size="40" value="" >

								</td>



								<td valign="center" class="Estilo1">Plan de Compra</td>

								<td>

									<select disabled="disabled" name="estados" id="estados" class="Estilo1">

										<option value="0">Seleccione...</option>

									</select>



								</td>



								<input type="hidden" name="documento" class="Estilo2" size="40" value="<? echo $row["cont_contrato"]; ?>">

								<input type="hidden" name="documento2" class="Estilo2" size="40" value="<? echo $row["cont_contrato"]; ?>">

								<!-- <input type="hidden" name="programa" class="Estilo2" size="40" value="1"> !-->



							</tr>



							<!-- <tr>

								<td  valign="center" class="Estilo1">Item</td>

								<td class="Estilo1" colspan=3>

									<select name="item" class="Estilo1" onChange="getCtaActivoGasto(this.value)">

										<option value="">Seleccione...</option>



										<?

										// $sql2 = "Select * from compra_subcat where subcat_cat_id =10 order by subcat_nombre";
										// $sql2 = "SELECT DISTINCT(CONCAT(item01,'.',item02)) as Item FROM paso3 ORDER BY Item ASC";
										// $sql2 = "SELECT DISTINCT(cuenta_asignacion), cuenta_item,cuenta_subitem FROM compra_cuentas WHERE cuenta_asignacion <> ''";
										$sql2 = "SELECT DISTINCT(CONCAT(cuenta_item,'.',cuenta_subitem,'.',cuenta_asignacion)) as item_presupuestario FROM compra_cuentas WHERE cuenta_asignacion <> ''";
											//echo $sql;

										$res2 = mysql_query($sql2);



										while($row2 = mysql_fetch_array($res2)){
											// $itemPresupuestario = explode(".",$row2["subcat_nombre"]);
											// $item = $itemPresupuestario[0].".".$itemPresupuestario[1];
											$item = $row2["item_presupuestario"];



											?>

											<option value="<? echo $item ?>"><? echo $item ?></option>



											<?

										}

										?>

									</select>
									<p id="cuentas"></p>

								</td>

							</tr> -->







							<tr>

								<td  valign="center" class="Estilo1">Estado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

								<td class="Estilo1" valign="center" colspan=3>



									<select name="estado22" class="Estilo1">

										<option value="">Seleccione...</option>

										<option value="ACEPTADO">ACEPTADO</option>

										<option value="CANCELADA/ELIMINADA/RECHAZADA">CANCELADA/ELIMINADA/RECHAZADA</option>

										<option value="ENVIADA">ENVIADA</option>

									</select>



								</td>

							</tr>



							<tr>

								<td  valign="center" class="Estilo1" width="79">Imagen O/C (PDF)</td>

								<td class="Estilo1" colspan=3>

									<input type="file" name="archivo1" class="Estilo2" size="20"  > <br>

									<a href="../../archivos/docfac/<? echo $row3["provee_archivo1"]; ?>" class="link" target="_blank"><? echo $row3["provee_archivo1"]; ?></a>

								</td>

							</tr>

							<tr>
								<td  valign="center" class="Estilo1" width="79">Imagen S/C (PDF)</td>
								<td class="Estilo1" colspan=3>
									<input type="file" name="archivo2" class="Estilo2" size="20"  required> <br>
								</td>

							</tr>

								<!--<tr>

									<td  class="Estilo1">Bienes O Servicios ?</td>

									<td class="Estilo1" colspan=3>

										<input type="radio" name="bsss" class="Estilo2" value="SI" onclick="envia();"> Bienes

										<input type="radio" name="bsss" class="Estilo2" value="NO" onclick="envia();"> Servicios

									</td>

								</tr>!-->
								<tr>

									<td  valign="center" class="Estilo1" width="79">Distribucion<br> (.xlsx, xls, .csv)</td>
									<td class="Estilo1" colspan=3>
										<input type="file" name="distribucion" id="distribucion" class="Estilo2" size="20"  > <br>
									</td>
								</tr>



								<tr>

									<td  class="Estilo1">Tipo de Compra ?</td>

									<td class="Estilo1" colspan=3>

										<input type="radio" name="tcompra" class="Estilo2" value="SI" onclick="envia();"> Regional

										<input type="radio" name="tcompra" class="Estilo2" value="NO" onclick="envia();"> Centralizada

									</td>

								</tr>





								<tr>

									<td colspan=4 align="center"> <input type="submit" value="    GRABAR ORDEN DE COMPRA    "> </td>

								</tr>
								<!--</div>!-->
								<!-- FIN DIV INGRESO !-->
								<input type="hidden" name="occompraid" value="" >
								<input type="hidden" name="occompraid2" value="" >
								<input type="hidden" name="monedatraida" value="" >
								<input type="hidden" name="para" value="" >
								<input type="hidden" name="tipo" id="tipo">
								<input type="hidden" name="oc_activo" id="oc_activo">
								<input type="hidden" name="oc_gasto" id="oc_gasto">
							</form>
							<!-- fin formulario graba oc !-->

						</div>
					</td>





					<tr>

						<td></td><td></td><td></td><td></td>

					</tr>


					<!-- formulario selecciona año -->
					<form name="form111" action="compra_orden.php" method="get"  >
						<tr>
							<td  valign="center" class="Estilo1">A&ntilde;o
								<select name="anno2" class="Estilo1" onchange="this.form.submit()">
									<option value="2013" <? if (2013==$anno2) { echo "selected=selected"; } ?> >2013</option>
									<option value="2014" <? if (2014==$anno2) { echo "selected=selected"; } ?> >2014</option>
									<option value="2015" <? if (2015==$anno2) { echo "selected=selected"; } ?> >2015</option>
									<option value="2016" <? if (2016==$anno2) { echo "selected=selected"; } ?> >2016</option>
									<option value="2017" <? if (2017==$anno2) { echo "selected=selected"; } ?> >2017</option>
									<option value="2018" <? if (2018==$anno2) { echo "selected=selected"; } ?> >2018</option>
									<option value="2019" <? if (2019==$anno2) { echo "selected=selected"; } ?> >2019</option>
									<option value="2020" <? if (2020==$anno2) { echo "selected=selected"; } ?> >2020</option>
									<option value="2021" <? if (2021==$anno2) { echo "selected=selected"; } ?> >2021</option>
								</select>
							</td>
						</tr>

						
					</form>
					<!-- fin formulario -->


					<tr>

						<td colspan="8">

						</table>


						

						<?php }else{
							if($oc_estado == "OC Cancelada"){ echo "<font color='red' class='Estilo2'><strong>La Orden De Compra '$oc' ha sido cancelada.</font></strong>"; }
							if($oc_estado == "OC Removida"){ echo "<font color='red' class='Estilo2'><strong>La Orden De Compra '$oc' ha sido removida de Mercado P&uacute;blico.</font></strong>"; }
							if($oc_estado == "OC No Aceptada"){ echo "<font color='red' class='Estilo2'><strong>La Orden De Compra '$oc' no ha sido aceptada por el proveedor.</font></strong>"; }
							if($oc_estado == "Se ha producido un error"){ echo "<font color='red' class='Estilo2'><strong>".$error."</font></strong>"; }
						} ?>

					</div>
					<table border=1 class="table table-hover table-striped table-bordered">
												<?php 

						$where = "year(oc_fechacompra)='$anno2' and ";
//bug - se agrega esta linea por problemas en la busqueda de fechas fecha15012018
                                                        if((isset($_POST["f_inicio"]) && $_POST["f_inicio"] <> "") OR isset($_POST["f_termino"]) && $_POST["f_termino"] <> "")
                                                        {
                                                                $where="";
                                                        }
						if(isset($_POST["Enviar"]) && $_POST["Enviar"] == 1)
						{
							if(isset($_POST["f_inicio"]) && $_POST["f_inicio"] <> "")
							{
								$where.="oc_fechacompra >= '".$_POST["f_inicio"]."' AND ";
							}

							if(isset($_POST["f_termino"]) && $_POST["f_termino"] <> "")
							{
								$where.="oc_fechacompra <= '".$_POST["f_termino"]."' AND ";
							}

							if($_POST["f_inicio"] == "" && $_POST["f_termino"] == "")
							{
								$where.="oc_fechacompra <= '".date("Y-m-d")."' AND ";
							}
						}else{
							$where.="oc_fechacompra <= '".date("Y-m-d")."' AND ";
						}

						if(isset($_POST["ultimas"]) && $_POST["ultimas"] <> "")
						{
							$ultimas = $_POST["ultimas"];
						}else{
							$ultimas = 20;
						}

						if(isset($_POST["clasificador"]) && $_POST["clasificador"] <> "")
						{
							$where.="oc_tipo2 = '".$_POST["clasificador"]."' AND ";
						}

						if($mis_ordenes)
						{
							$where.="oc_user = '".$_SESSION["nom_user"]."' AND ";
						}

						$sql_region = "SELECT region_numero FROM acti_region WHERE region_prefijo = ".$_SESSION["region"];
						$res_region = mysql_query($sql_region,$dbh6);
						$row_region = mysql_fetch_array($res_region);
						$sql="select * from compra_orden where oc_region=".$regionsession." and ".$where." oc_fpago='' and  oc_emitidapor='' and oc_nombre<>'' and (oc_monto<>'0' or (oc_estado='CANCELADA/ELIMINADA/RECHAZADA' and oc_monto='0' )) order by oc_id desc LIMIT 0 , $ultimas ";

						$totales="select * from compra_orden where oc_region=".$regionsession." and oc_fpago='' and  oc_emitidapor='' and oc_nombre<>'' and year(oc_fechacompra)='$anno2' and (oc_monto<>'0' or (oc_estado='CANCELADA/ELIMINADA/RECHAZADA' and oc_monto='0' ))";
						$res_totales = mysql_query($totales);

						?>
						<tr></tr>



						<br>
	<tr class="Estilo8">
							<td colspan="14">
								<form action="compra_orden.php" method="POST" name="frmBuscar" id="frmBuscar">
									<table border="0" style="border-collapse: collapse;" width="100%" class="table table-bordered">
										<tr>
											<td class="Estilo1c">FECHA INICIO</td>
											<td class="Estilo1c">

												<input type="text" name="f_inicio" class="Estilo2" size="12" value="<? echo $f_inicio ?>" id="f_inicio" readonly="1">
												<img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
												<script type="text/javascript">
													Calendar.setup({
														inputField   :  "f_inicio",
														trigger     :  "f_trigger_c4",
														onSelect   : function() { this.hide() },
														dateFormat    :  "%Y-%m-%d",
														showTime   : 12,
														max : <?php echo Date("Ymd") ?>
													});
												</script>


											</td>
											<td class="Estilo1c">FECHA TERMINO</td>
											<td class="Estilo1c">

												<input type="text" name="f_termino" class="Estilo2" size="12" value="<? echo $f_termino ?>" id="f_termino" readonly="1">
												<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
												<script type="text/javascript">
													Calendar.setup({
														inputField   :  "f_termino",
														trigger     :  "f_trigger_c3",
														onSelect   : function() { this.hide() },
														dateFormat    :  "%Y-%m-%d",
														showTime   : 12,
														max : <?php echo Date("Ymd") ?>
													});
												</script>


											</td>
										</tr>

										<tr>
											<td class="Estilo1c">Ver &uacute;ltimos</td>
											<td class="Estilo1c">
												<select name="ultimas" id="ultimas">
													<option value="5" <?php if($ultimas == "5"){echo"selected";} ?>>5</option>
													<option value="10" <?php if($ultimas == "10"){echo"selected";} ?>>10</option>
													<option value="15" <?php if($ultimas == "15"){echo"selected";} ?>>15</option>
													<option value="20" <?php if($ultimas == "20"){echo"selected";} ?>>20</option>
													<option value="25" <?php if($ultimas == "25"){echo"selected";} ?>>25</option>
													<option value="50" <?php if($ultimas == "50"){echo"selected";} ?>>50</option>
													<option value="100" <?php if($ultimas == "100"){echo"selected";} ?>>100</option>
													<option value="<?php echo mysql_num_rows($res_totales) ?>" <?php if($ultimas == mysql_num_rows($res_totales)){echo"selected";} ?>>Todos</option>
												</select>
												Registros
											</td>
											<td class="Estilo1c">TIPO</td>
											<td class="Estilo1c">
												<select name="clasificador" id="clasificador" class="Estilo1c">
													<option value="">Seleccionar...</option>
													<option value="BIEN" <?php if($clasificador == "BIEN"){echo"selected";} ?>>BIEN</option>
													<option value="SERVICIO" <?php if($clasificador == "SERVICIO"){echo"selected";} ?>>SERVICIO</option>
												</select>
											</td>
										</tr>

										<tr>
											<td class="Estilo1c">Mis Ingresos</td>
											<td class="Estilo1c">
												<input type="radio" name="mis_ordenes" id="mis_ordenes" value="1" <?php if($mis_ordenes ==1){echo"checked";} ?>>SI
												<input type="radio" name="mis_ordenes" id="mis_ordenes" value="0" <?php if($mis_ordenes ==0){echo"checked";} ?>>NO
											</td>
										</tr>

										<tr>
											<td colspan="4" align="center">
												<button class="btn btn-success">BUSCAR</button>
												<a href="compra_orden.php" class="btn btn-danger">LIMPIAR</a>
											</td>
										</tr>


									</table>
									<input type="hidden" name="Enviar" value="1">
								</form>
							</td>
						</tr>
						<tr class="Estilo8">
							<td colspan="14"><a href="compra_orden_excel.php?f_inicio=<?php echo $f_inicio ?>&f_termino=<?php echo $f_termino ?>&region=<?php echo $regionsession ?>&anno2=<?php echo $anno2 ?>&clasificador=<?php echo $clasificador?>&mis_ordenes=<?php echo $mis_ordenes ?>" class="btn btn-primary" target="_blank">Exportar a Excel</a></td>
						</tr>
						<!-- <tr class="Estilo8">
							<td colspan="12"><a href="compra_exportar.php?anno2=<?php echo $anno2 ?>&region=<?php echo $regionsession ?>" class="link" target="_blank">EXPORTAR EXCEL</a></td>
						</tr> -->



						<tr>

							<td class="Estilo1c">N&deg;</td>

							<td class="Estilo1c">N&deg; O.C. </td>

							<td class="Estilo1c" width="5">Nombre</td>

							<td class="Estilo1c">Fecha </td>

							<td class="Estilo1c">Tipo</td>

							<td class="Estilo1c">Nombre Proveedor</td>

							<td class="Estilo1c">C. Costo</td>

							<td class="Estilo1c">Monto</td>

							<td class="Estilo1c">Estado</td>

							<td class="Estilo1c">Ver</td>

							<td class="Estilo1c">Eli</td>

							<td class="Estilo1c">Mod</td>

						</tr>

						<?



						// $sql="select * from compra_orden where oc_region=$regionsession and oc_fpago='' and  oc_emitidapor='' and oc_nombre<>'' and year(oc_fechacompra)='$anno2' and (oc_monto<>'0' or (oc_estado='CANCELADA/ELIMINADA/RECHAZADA' and oc_monto='0' )) order by oc_id desc LIMIT 0 , 1000 ";



							//echo $sql;

						$res3 = mysql_query($sql);

						$cont=1;



						$cont2=mysql_num_rows($res3);

						while($row3 = mysql_fetch_array($res3)){



							$octipo=$row3["oc_tipo"];



							if ($octipo>=14 and $octipo<=17) {

								$sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$octipo";

									//  echo $sql33;

								$consulta=mysql_query($sql33);

								$registro=mysql_fetch_array($consulta);

								$octipo2=$registro["cat_nombre"];

							} else {

								$octipo2=$octipo;

							}



							?>





							<tr>

								<td class="Estilo3c"><? echo $cont2 ?> </td>

								<td class="Estilo4c"><? echo $row3["oc_numero"] ?> </td>

								<td class="Estilo4c" title="<? echo utf8_decode($row3["oc_nombre"])  ?>" ><? echo utf8_decode($row3["oc_nombre"])  ?></td>

								<td class="Estilo3c" ><? echo substr($row3["oc_fechacompra"],8,2)."-".substr($row3["oc_fechacompra"],5,2)."-".substr($row3["oc_fechacompra"],0,4)   ?></td>

								<td class="Estilo3c"><? echo $octipo2 ?> </td>

								<td class="Estilo4c" title="<? echo $row3["oc_nombre"]  ?>"><? echo $row3["oc_rsocial"]  ?></td>

								<td class="Estilo4c" title="<? echo $row3["oc_ccosto"]  ?>"><? echo $row3["oc_ccosto"]  ?></td>

								<td class="Estilo2d"><? echo number_format($row3["oc_monto"],0,',','.');  ?></td>

								<td class="Estilo4c"><? echo substr($row3["oc_estado"],0,6);  ?></td>

								<td class="Estilo4c"><a href="compra_fichaorden2.php?id=<? echo $row3["oc_id"]  ?>&ori=1" class="link" ><img src="imagenes/ico_buscar.gif" border=0></a></td>

								<!-- <td class="Estilo4c"><a href="compra_orden.php?id=<? echo $row3["oc_id"] ?>&ori=1&oc=<?php echo $row3["oc_numero"] ?>" class="link" onclick="return confirm('Seguro que desea Borrar para siempre?')"><img src="imagenes/b_drop.png" border=0></a></td> -->
						<td class="Estilo4c">
									<?php if ($row3["oc_user"] == $_SESSION["nom_user"]): ?>
										<a href="compra_orden.php?id=<? echo $row3["oc_id"] ?>&ori=1&oc=<?php echo $row3["oc_numero"] ?>" class="link" onclick="return confirm('Seguro que desea Borrar para siempre?')"><img src="imagenes/b_drop.png" border=0></a>
									<?php else: ?>
										<font color="red" style="font-weight: bold;"><i class="fa fa-ban fa-2x" title="NO TIENE LOS ATRIBUTOS PARA ELIMINAR"></i></font>
									<?php endif ?>
								</td>
								<!-- <td class="Estilo4c"><a href="compra_ordenb.php?id=<? echo $row3["oc_id"] ?>&ori=1" class="link" ><img src="imagenes/ico_editar.png" border=0></a></td> -->
								<td class="Estilo4c">
									<?php if ($row3["oc_user"] == $_SESSION["nom_user"]): ?>
										<a href="compra_ordenb.php?id=<? echo $row3["oc_id"] ?>&ori=1" class="link" ><img src="imagenes/ico_editar.png" border=0></a>
									<?php else: ?>
										<font color="red" style="font-weight: bold;"><i class="fa fa-ban fa-2x" title="NO TIENE LOS ATRIBUTOS PARA ELIMINAR"></i></font>
									<?php endif ?>
								</td>

							</tr>











							<?



							$cont++;

							$cont2--;



						}

						?>





						<tr>

							<input type="hidden" name="cont" value="<? echo $cont ?>" >















						</td>

					</tr>





				</table>
				<img src="images/pix.gif" width="1" height="10">

			</body>

			</html>



			<?

			if ($numerooc2<>'') {

				echo "<script>envia2();</script>";

			}

			?>


			<script type="text/javascript">
				function getCtaActivoGasto(input)
				{
					var data = ({cmd : "getCtaActivoGasto",imputacion : input});
					$.ajax({
						type:"POST",
						url:"compra_obtener_cuentas.php",
						data:data,
						dataType:"JSON",
						success : function ( response ) {
							if(response[0] != '' || response[1] != ''){
								$("#cuentas").html("Descripcion : "+response[2]+"<br>Cuenta Activo : "+response[0]+"<br>Cuenta Gasto : "+response[1]);
								$("#oc_activo").val(response[0]);
								$("#oc_gasto").val(response[1]);
							}else{
								$("#cuentas").html("");
							}

						}
					});
				}

				function getCtaActivoGasto2(input)
				{
					var data = ({cmd : "getCtaActivoGasto",imputacion : input});
					$.ajax({
						type:"POST",
						url:"compra_obtener_cuentas.php",
						data:data,
						dataType:"JSON",
						success : function ( response ) {
							var totalEmentos = $("#totallinea").val();
							for (i=0;i<totalEmentos;i++)
							{
								$("#cta_activo_"+i).val(response[0]);
								$("#cta_gasto_"+i).val(response[1]);
							}

						}
					});
				}

				function getCtaActivoGasto3(input,id)
				{
					var data = ({cmd : "getCtaActivoGasto",imputacion : input});
					$.ajax({
						type:"POST",
						url:"compra_obtener_cuentas.php",
						data:data,
						dataType:"JSON",
						success : function ( response ) {
								$("#cta_activo_"+id).val(response[0]);
								$("#cta_gasto_"+id).val(response[1]);
						}
					});
				}
			</script>
