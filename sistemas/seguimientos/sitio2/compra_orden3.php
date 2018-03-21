<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
if ($regionsession==15 and 1==2) {
    echo "<script>location.href='compra_orden3b.php';</script>";
}

$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$date_in=date("d-m-Y");
$date_in2=date("Y-m-d");
?>
<html>
<head>
<title>Compras</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
	font-size: 9px;
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
  <script type="text/javascript" src="librerias/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />


  <script type="text/javascript" src="select_dependientes2.js"></script>
  
<script language="JavaScript1.2">

// Script Source: CodeLifter.com
// Copyright 2003
// Do not remove this header

isIE=document.all;
isNN=!document.all&&document.getElementById;
isN4=document.layers;
isHot=false;

function ddInit(e){
  topDog=isIE ? "BODY" : "HTML";
  whichDog=isIE ? document.all.theLayer : document.getElementById("theLayer");
  hotDog=isIE ? event.srcElement : e.target;
  while (hotDog.id!="titleBar"&&hotDog.tagName!=topDog){
    hotDog=isIE ? hotDog.parentElement : hotDog.parentNode;
  }
  if (hotDog.id=="titleBar"){
    offsetx=isIE ? event.clientX : e.clientX;
    offsety=isIE ? event.clientY : e.clientY;
    nowX=parseInt(whichDog.style.left);
    nowY=parseInt(whichDog.style.top);
    ddEnabled=true;
    document.onmousemove=dd;
  }
}

function dd(e){
  if (!ddEnabled) return;
  whichDog.style.left=isIE ? nowX+event.clientX-offsetx : nowX+e.clientX-offsetx;
  whichDog.style.top=isIE ? nowY+event.clientY-offsety : nowY+e.clientY-offsety;
  return false;
}

function ddN4(whatDog){
  if (!isN4) return;
  N4=eval(whatDog);
  N4.captureEvents(Event.MOUSEDOWN|Event.MOUSEUP);
  N4.onmousedown=function(e){
    N4.captureEvents(Event.MOUSEMOVE);
    N4x=e.x;
    N4y=e.y;
  }
  N4.onmousemove=function(e){
    if (isHot){
      N4.moveBy(e.x-N4x,e.y-N4y);
      return false;
    }
  }
  N4.onmouseup=function(){
    N4.releaseEvents(Event.MOUSEMOVE);
  }
}

function hideMe(){
  if (isIE||isNN) whichDog.style.visibility="hidden";
  else if (isN4) document.theLayer.visibility="hide";
}

function showMe(){
  if (isIE||isNN) whichDog.style.visibility="visible";
  else if (isN4) document.theLayer.visibility="show";
}

document.onmousedown=ddInit;
document.onmouseup=Function("ddEnabled=false");

</script>


<script language="javascript">
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
//            document.form1.direccion.value = elem[2];
//            document.form1.telefono.value = elem[3];
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
    uno=document.form33.uno.value;
    dos=document.form33.dos.value;
    rut=document.form1.rut.value;
//    alert (" dato "+dos);
 	ajax.open("POST", "buscakm.php", true);
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("d="+uno+"&e="+dos);

	ajax.onreadystatechange=function()	{
		if (ajax.readyState==4) {
			// Respuesta recibida. Coloco el texto plano en la capa correspondiente
			//capa.innerHTML=ajax.responseText;
			//b=ajax.responseText;
                  document.getElementById("visualizar").innerHTML =ajax.responseText+" x 2";
                  document.form33.ctdakm.value=ajax.responseText*2;

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

function abreVentana(){
	miPopup = window.open("compra_listaresolucion.php?id=<? echo $id ?>&id2=<? echo $id2 ?>","miwin","width=500,height=500,scrollbars=yes,toolbar=0")
	miPopup.focus()
}
function abreVentana2(id,numerooc){
	miPopup = window.open("compra_subirarchivo.php?id="+id+"&numerooc="+numerooc,"miwin","width=500,height=200,scrollbars=yes,toolbar=0")
	miPopup.focus()
}


function valida() {

   if (document.form1.rut.value==0 || document.form1.rut.value=='') {
      alert ("Rut presenta problemas ");
      return false;
  }
   if (document.form1.dig.value=='') {
      alert ("Dig presenta problemas ");
      return false;
  }
   if (document.form1.region.value==0 || document.form1.region.value=='') {
      alert ("Region presenta problemas ");
      return false;
  }

   if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.nombre3.value=='') {
      alert ("Nombre O/C Resolucion presenta problemas ");
      return false;
  }

   if (document.form1.nroresolucion.value=='') {
      alert ("N° Resolucion presenta problemas ");
      return false;
  }
   if (document.form1.ccosto.value=='') {
      alert ("Centro Costo presenta problemas ");
      return false;
  }
   if (document.form1.fpago.value=='') {
      alert ("Forma Pago presenta problemas ");
      return false;
  }
   if (document.form1.modalidad.value=='') {
      alert ("Tipo Pago presenta problemas ");
      return false;
  }
   if (document.form1.item.value=='' && document.form1.modalidad.value!='Reembolso') {
      alert ("Item presenta problemas ");
      return false;
  }
   if (document.form1.obs.value=='') {
      alert ("Observacion presenta problemas ");
      return false;
  }
  if (document.form1.cantidad.value>= 1) {
      if (document.form1.ctda1.value=='') {
         alert ("Cantidad 1 presenta problemas ");
         return false;
      }
      if (document.form1.detalle1.value=='') {
         alert ("Detalle 1 presenta problemas ");
         return false;
      }
      if (document.form1.valor1.value=='') {
         alert ("Valor Unitario 1 presenta problemas ");
         return false;
      }
      if (document.form1.total1.value=='') {
         alert ("Valor total 1 presenta problemas ");
         return false;
      }
      if (document.form1.item31.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 1 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 2) {
      if (document.form1.ctda2.value=='') {
         alert ("Cantidad 2 presenta problemas ");
         return false;
      }
      if (document.form1.detalle2.value=='') {
         alert ("Detalle 2 presenta problemas ");
         return false;
      }
      if (document.form1.valor2.value=='') {
         alert ("Valor Unitario 2 presenta problemas ");
         return false;
      }
      if (document.form1.total2.value=='') {
         alert ("Valor total 2 presenta problemas ");
         return false;
      }
      if (document.form1.item32.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 2 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 3) {
      if (document.form1.ctda3.value=='') {
         alert ("Cantidad 3 presenta problemas ");
         return false;
      }
      if (document.form1.detalle3.value=='') {
         alert ("Detalle 3 presenta problemas ");
         return false;
      }
      if (document.form1.valor3.value=='') {
         alert ("Valor Unitario 3 presenta problemas ");
         return false;
      }
      if (document.form1.total3.value=='') {
         alert ("Valor total 3 presenta problemas ");
         return false;
      }
      if (document.form1.item33.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 3 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 4) {
      if (document.form1.ctda4.value=='') {
         alert ("Cantidad 4 presenta problemas ");
         return false;
      }
      if (document.form1.detalle4.value=='') {
         alert ("Detalle 4 presenta problemas ");
         return false;
      }
      if (document.form1.valor4.value=='') {
         alert ("Valor Unitario 4 presenta problemas ");
         return false;
      }
      if (document.form1.total4.value=='') {
         alert ("Valor total 4 presenta problemas ");
         return false;
      }
      if (document.form1.item34.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 4 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 5) {
      if (document.form1.ctda2.value=='') {
         alert ("Cantidad 5 presenta problemas ");
         return false;
      }
      if (document.form1.detalle5.value=='') {
         alert ("Detalle 5 presenta problemas ");
         return false;
      }
      if (document.form1.valor5.value=='') {
         alert ("Valor Unitario 5 presenta problemas ");
         return false;
      }
      if (document.form1.total5.value=='') {
         alert ("Valor total 5 presenta problemas ");
         return false;
      }
      if (document.form1.item35.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 5 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 6) {
      if (document.form1.ctda6.value=='') {
         alert ("Cantidad 6 presenta problemas ");
         return false;
      }
      if (document.form1.detalle6.value=='') {
         alert ("Detalle 6 presenta problemas ");
         return false;
      }
      if (document.form1.valor6.value=='') {
         alert ("Valor Unitario 6 presenta problemas ");
         return false;
      }
      if (document.form1.total6.value=='') {
         alert ("Valor total 6 presenta problemas ");
         return false;
      }
      if (document.form1.item36.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 6 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 7) {
      if (document.form1.ctda7.value=='') {
         alert ("Cantidad 7 presenta problemas ");
         return false;
      }
      if (document.form1.detalle7.value=='') {
         alert ("Detalle 7 presenta problemas ");
         return false;
      }
      if (document.form1.valor7.value=='') {
         alert ("Valor Unitario 7 presenta problemas ");
         return false;
      }
      if (document.form1.total7.value=='') {
         alert ("Valor total 7 presenta problemas ");
         return false;
      }
      if (document.form1.item37.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 7 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 8) {
      if (document.form1.ctda8.value=='') {
         alert ("Cantidad 8 presenta problemas ");
         return false;
      }
      if (document.form1.detalle8.value=='') {
         alert ("Detalle 8 presenta problemas ");
         return false;
      }
      if (document.form1.valor8.value=='') {
         alert ("Valor Unitario 8 presenta problemas ");
         return false;
      }
      if (document.form1.total8.value=='') {
         alert ("Valor total 8 presenta problemas ");
         return false;
      }
      if (document.form1.item38.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 8 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 9) {
      if (document.form1.ctda9.value=='') {
         alert ("Cantidad 9 presenta problemas ");
         return false;
      }
      if (document.form1.detalle9.value=='') {
         alert ("Detalle 9 presenta problemas ");
         return false;
      }
      if (document.form1.valor9.value=='') {
         alert ("Valor Unitario 9 presenta problemas ");
         return false;
      }
      if (document.form1.total9.value=='') {
         alert ("Valor total 9 presenta problemas ");
         return false;
      }
      if (document.form1.item39.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 9 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 10) {
      if (document.form1.ctda10.value=='') {
         alert ("Cantidad 10 presenta problemas ");
         return false;
      }
      if (document.form1.detalle10.value=='') {
         alert ("Detalle 10 presenta problemas ");
         return false;
      }
      if (document.form1.valor10.value=='') {
         alert ("Valor Unitario 10 presenta problemas ");
         return false;
      }
      if (document.form1.total10.value=='') {
         alert ("Valor total 10 presenta problemas ");
         return false;
      }
      if (document.form1.item310.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 10 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 11) {
      if (document.form1.ctda2.value=='') {
         alert ("Cantidad 11 presenta problemas ");
         return false;
      }
      if (document.form1.detalle11.value=='') {
         alert ("Detalle 11 presenta problemas ");
         return false;
      }
      if (document.form1.valor11.value=='') {
         alert ("Valor Unitario 11 presenta problemas ");
         return false;
      }
      if (document.form1.total11.value=='') {
         alert ("Valor total 11 presenta problemas ");
         return false;
      }
      if (document.form1.item311.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 11 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 12) {
      if (document.form1.ctda12.value=='') {
         alert ("Cantidad 12 presenta problemas ");
         return false;
      }
      if (document.form1.detalle12.value=='') {
         alert ("Detalle 12 presenta problemas ");
         return false;
      }
      if (document.form1.valor12.value=='') {
         alert ("Valor Unitario 12 presenta problemas ");
         return false;
      }
      if (document.form1.total12.value=='') {
         alert ("Valor total 12 presenta problemas ");
         return false;
      }
      if (document.form1.item312.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 12 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 13) {
      if (document.form1.ctda13.value=='') {
         alert ("Cantidad 13 presenta problemas ");
         return false;
      }
      if (document.form1.detalle13.value=='') {
         alert ("Detalle 13 presenta problemas ");
         return false;
      }
      if (document.form1.valor13.value=='') {
         alert ("Valor Unitario 13 presenta problemas ");
         return false;
      }
      if (document.form1.total13.value=='') {
         alert ("Valor total 13 presenta problemas ");
         return false;
      }
      if (document.form1.item313.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 13 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 14) {
      if (document.form1.ctda14.value=='') {
         alert ("Cantidad 14 presenta problemas ");
         return false;
      }
      if (document.form1.detalle2.value=='') {
         alert ("Detalle 14 presenta problemas ");
         return false;
      }
      if (document.form1.valor14.value=='') {
         alert ("Valor Unitario 14 presenta problemas ");
         return false;
      }
      if (document.form1.total14.value=='') {
         alert ("Valor total 14 presenta problemas ");
         return false;
      }
      if (document.form1.item314.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 14 presenta problemas ");
         return false;
      }
  }
  if (document.form1.cantidad.value>= 15) {
      if (document.form1.ctda15.value=='') {
         alert ("Cantidad 15 presenta problemas ");
         return false;
      }
      if (document.form1.detalle15.value=='') {
         alert ("Detalle 15 presenta problemas ");
         return false;
      }
      if (document.form1.valor15.value=='') {
         alert ("Valor Unitario 15 presenta problemas ");
         return false;
      }
      if (document.form1.total15.value=='') {
         alert ("Valor total 15 presenta problemas ");
         return false;
      }
      if (document.form1.item315.value=='' && document.form1.modalidad.value=='Reembolso') {
         alert ("Item 15 presenta problemas ");
         return false;
      }
  }




  
}
function envia() {
  if (document.form1.accion[0].checked) {
        document.getElementById("cuerpo").style.visibility="visible";
  }
  if (document.form1.accion[1].checked) {
        document.getElementById("cuerpo").style.visibility="hidden";
        if (confirm('¿Estas seguro que O/C no esta en Plan de Compra?')){
            location.href="compra_ingresa.php?ori=1";
        } else {
            document.getElementById("cuerpo").style.visibility="visible";
            document.form1.accion[0].checked='true';
        }
        
  }


}
function muestrarete(){
     reten.style.display="";
}
function muestrarete2(){
     document.form1.retencion.value="";
     reten.style.display="none";
}
function muestraitem(){
     if (document.form1.modalidad.value=='Reembolso') {
       item2.style.display="none";
       item21.style.display="";
       item22.style.display="";
       item23.style.display="";
       item24.style.display="";
       item25.style.display="";
       item26.style.display="";
       item27.style.display="";
       item28.style.display="";
       item29.style.display="";
       item210.style.display="";
       item211.style.display="";
       item212.style.display="";
       item213.style.display="";
       item214.style.display="";
       item215.style.display="";
     } else {
       item2.style.display="";
       item21.style.display="none";
       item22.style.display="none";
       item23.style.display="none";
       item24.style.display="none";
       item25.style.display="none";
       item26.style.display="none";
       item27.style.display="none";
       item28.style.display="none";
       item29.style.display="none";
       item210.style.display="none";
       item211.style.display="none";
       item212.style.display="none";
       item213.style.display="none";
       item214.style.display="none";
       item215.style.display="none";


     }
}



  function aparece2(){
     if (document.form1.cantidad.value == 1) {
       seccion12.style.display="none";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula1();
     }
     if (document.form1.cantidad.value == 2) {
       seccion12.style.display="";
       seccion13.style.display="none";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula2();

     }
     if (document.form1.cantidad.value == 3) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="none";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula3();

     }
     if (document.form1.cantidad.value == 4) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="none";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula4();
     }
     if (document.form1.cantidad.value == 5) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="none";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula5();

     }
     if (document.form1.cantidad.value == 6) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="none";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula6();
     }
     if (document.form1.cantidad.value == 7) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="none";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula7();
     }
     if (document.form1.cantidad.value == 8) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="none";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula8();
     }
     if (document.form1.cantidad.value == 9) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="none";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula9();
     }
     if (document.form1.cantidad.value == 10) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="none";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula10();
     }
     if (document.form1.cantidad.value == 11) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="none";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula11();
     }
     if (document.form1.cantidad.value == 12) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="none";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula12();
     }
     if (document.form1.cantidad.value == 13) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="";
       seccion114.style.display="none";
       seccion115.style.display="none";
       calcula13();
     }
     if (document.form1.cantidad.value == 14) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="";
       seccion114.style.display="";
       seccion115.style.display="none";
       calcula14();
     }
     if (document.form1.cantidad.value == 15) {
       seccion12.style.display="";
       seccion13.style.display="";
       seccion14.style.display="";
       seccion15.style.display="";
       seccion16.style.display="";
       seccion17.style.display="";
       seccion18.style.display="";
       seccion19.style.display="";
       seccion110.style.display="";
       seccion111.style.display="";
       seccion112.style.display="";
       seccion113.style.display="";
       seccion114.style.display="";
       seccion115.style.display="";
       calcula15();
     }



 }
 
function calcula1() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total1.value=document.form1.ctda1.value*document.form1.valor1.value;
    document.form1.montototal.value=document.form1.total1.value;
  }
}
function calcula2() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total2.value=document.form1.ctda2.value*document.form1.valor2.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value);
  }

}
function calcula3() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total3.value=document.form1.ctda3.value*document.form1.valor3.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value);
  }
}
function calcula4() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total4.value=document.form1.ctda4.value*document.form1.valor4.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value);
  }
}
function calcula5() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total5.value=document.form1.ctda5.value*document.form1.valor5.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value);
  }
}
function calcula6() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total6.value=document.form1.ctda6.value*document.form1.valor6.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value);
  }
}
function calcula7() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total7.value=document.form1.ctda7.value*document.form1.valor7.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value);
  }
}
function calcula8() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total8.value=document.form1.ctda8.value*document.form1.valor8.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value);
  }
}
function calcula9() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total9.value=document.form1.ctda9.value*document.form1.valor9.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value)+Math.round(document.form1.total9.value);
  }
}
function calcula10() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total10.value=document.form1.ctda10.value*document.form1.valor10.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value)+Math.round(document.form1.total9.value)+Math.round(document.form1.total10.value);
  }
}
function calcula11() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total11.value=document.form1.ctda11.value*document.form1.valor11.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value)+Math.round(document.form1.total9.value)+Math.round(document.form1.total10.value)+Math.round(document.form1.total11.value);
  }
}
function calcula12() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total12.value=document.form1.ctda1.value*document.form1.valor12.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value)+Math.round(document.form1.total9.value)+Math.round(document.form1.total10.value)+Math.round(document.form1.total11.value)+Math.round(document.form1.total12.value);
  }
}
function calcula13() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total13.value=document.form1.ctda13.value*document.form1.valor13.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value)+Math.round(document.form1.total9.value)+Math.round(document.form1.total10.value)+Math.round(document.form1.total11.value)+Math.round(document.form1.total12.value)+Math.round(document.form1.total13.value);
  }
}
function calcula14() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total14.value=document.form1.ctda14.value*document.form1.valor14.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value)+Math.round(document.form1.total9.value)+Math.round(document.form1.total10.value)+Math.round(document.form1.total11.value)+Math.round(document.form1.total12.value)+Math.round(document.form1.total13.value)+Math.round(document.form1.total14.value);
  }
}
function calcula15() {
  if (document.form1.swiva[1].checked || document.form1.swiva[0].checked) {
    document.form1.total15.value=document.form1.ctda15.value*document.form1.valor15.value;
    document.form1.montototal.value=Math.round(document.form1.total1.value)+Math.round(document.form1.total2.value)+Math.round(document.form1.total3.value)+Math.round(document.form1.total4.value)+Math.round(document.form1.total5.value)+Math.round(document.form1.total6.value)+Math.round(document.form1.total7.value)+Math.round(document.form1.total8.value)+Math.round(document.form1.total9.value)+Math.round(document.form1.total10.value)+Math.round(document.form1.total11.value)+Math.round(document.form1.total12.value)+Math.round(document.form1.total13.value)+Math.round(document.form1.total14.value)+Math.round(document.form1.total15.value);
  }
}


//-->

</script>

<body>
<?php
function generalista()
{
	$consulta=mysql_query("Select subcat_nombre,subcat_nombre from compra_subcat  where subcat_cat_id =4");

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='paises' id='paises' onChange='cargaContenido2(this.id)'>";
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-9 col-lg-9">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO ORDEN DE PAGO REEMBOLSO</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}

?>
                         </td>
                      </tr>
                       <tr>
                       <td><a href="compra_menuoc.php" class="link" ></a> </td>
                       <td> <a href="#" class="link" onClick="mostrarcon();">CALCULO COMBUSTIBLE</a></td>
                      </tr>

<?

if (isset($_GET["anno2"])) {
    $anno2=$_GET["anno2"];
} else {
    $anno2=date("Y");
}


$id=$_GET["id"];
if ($_GET["ori"]==1)  {
    $sql2 = "delete from compra_orden where oc_id=$id";
    //echo $sql;
    mysql_query($sql2);

    $sql2 = "delete from compra_ordendet where ocdet_oc_id=$id";
    //echo $sql;
    mysql_query($sql2);

}




$sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession'  ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  $row21=mysql_fetch_array($result21);
  $foliomio=$row21["foliomio"];
  $foliomio2=$foliomio+1;
  
$sql22="select count(eta_id) as totaldevueltos from dpp_etapas where eta_estado=12 and eta_region='$regionsession' ";
//  echo $sql21;
  $result22=mysql_query($sql22);
  $row22=mysql_fetch_array($result22);
  $totaldevueltos=$row22["totaldevueltos"];
  
  
  
  $sql="select * from cometido_funcionario where come_id=$id ";
//  $sql="select * from compra_orden where oc_region=$regionsession and oc_nombre<>'' and oc_fpago<>'' and  oc_emitidapor<>'' and oc_modalidad='Reembolso' and year(oc_fechacompra)='$anno2' order by oc_id desc LIMIT 0 , 300 ";

//echo $sql;
$res3 = mysql_query($sql);
$row3 = mysql_fetch_array($res3);

$comerut=$row3["come_rut"];
$comedig=$row3["come_dig"];
$comenombre=$row3["come_nombre"];
$comenres=$row3["come_nres"];
$comefechares=$row3["come_fechares"];
$comedocsid=$row3["come_docs_id"];
?>


                   <tr>
                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>

             			<td height="50" colspan="3">
                      </table>
					<table width="488" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_grabaorden2.php" method="post"  onSubmit="return valida()">

                    </table>
<div id="cuerpo" style="visibility:visible" >
					<table width="488" border="0" cellspacing="0" cellpadding="0">

                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Reembolso</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c1",
        trigger    : "f_trigger_c1",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>



                             </td>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                <select name="region" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from regiones order by codigo";
                                    echo '<option value="">Seleccione...</option>';
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
					<table width="500" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nombre Reembolso</td>
                             <td class="Estilo1" colspan=3>
                              <textarea name="nombre3" rows="3" class="Estilo2" cols="60"></textarea>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">N° Resolución </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nroresolucion" class="Estilo2" size="18" value="<? echo $comenres ?>" >
                              <input type="hidden" name="idargedo" class="Estilo2" size="8" value="<? echo $comedocsid ?>" >
                                     <a href="#?id=<? echo $id ?>&id2=<? echo $id2 ?>" class="link" onclick="abreVentana()">Asociar Resolucion</a>
                             </td>
                           </tr>
                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Resolución</td>
                             <td class="Estilo1" valign="center">
                                <input type="text" name="fecha4" value="<? echo $comefechares ?>" class="Estilo2" size="12" value="" id="f_date_c4" readonly="1">


                  </tr>
<?
//$comedocsid=$row3["come_docs_id"];
$sql2="select * from argedo_documentos where  docs_id=$comedocsid ";

//echo $sql2;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);


if ($row2["docs_archivo"]<>''){
  $docsarchivo="../../archivos/docargedo/".$row2["docs_archivo"];
  $docsarchivo2="Ver Archivo";
}
?>
                  
                   <tr>
                             <td  valign="center" class="Estilo1">Archivo Resolución</td>
                             <td class="Estilo1" valign="center">
                                 <a href="<? echo $docsarchivo ?>" class="link" id="linkarchivo2" target="_blank"><div id="verlink2"><? echo $docsarchivo2 ?></div></a>
                                 <a href="" class="link" id="linkarchivo" target="_blank"><div id="verlink"></div></a>


                  </tr>

                  

                            <tr>
                             <td  valign="center" class="Estilo1">Certificado </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="certificado" class="Estilo2" value="SI" >Si
                              <input type="radio" name="certificado" class="Estilo2" value="NO" >No


                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Centro de Costo </td>
                             <td class="Estilo1" colspan=3>
                                <select name="ccosto" class="Estilo1" >
                                       <option value="">Seleccione...</option>
<?
                                   $cadena = strlen($regionsession);
                                   if ($cadena==1) {
                                       $where="SUBSTRING(num,1,1)='$regionsession' and character_length(num)=3 ";

                                   } else {
                                       $where="SUBSTRING(num,1,2)='$regionsession' and character_length(num)=4 ";
                                   }

                                   $sql4="select * from defensorias  where $where order by nombre";
                                  //echo $sql;
                                   $res4 = mysql_query($sql4);
                                    while($row=mysql_fetch_array($res4)) {
?>
                                        <option value="<? echo $row["nombre"]; ?>" <? if ($row["num"]==$seleccion) { echo "selected=selected"; } ?> ><? echo $row["nombre"]; ?></option>
<?
                                   }
?>
                                  </select>
                             </td>
                           </tr>


                            <tr>
                             <td  valign="center" class="Estilo1">Forma Pago </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="fpago" class="Estilo2" value="Contado" >Contado
                              <input type="radio" name="fpago" class="Estilo2" value="Cheque" >Cheque
                              <input type="radio" name="fpago" class="Estilo2" value="Transferencia" >Transferencia
                              <input type="radio" name="fpago" class="Estilo2" value="Deposito" >Deposito
                              <input type="hidden" name="modalidad" class="Estilo2" value="Reembolso" >
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" value="<? echo $comerut ?>" size="11" onChange="limpiar()" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  > -
                              <input type="text" name="dig" class="Estilo2" value="<? echo $comedig ?>" size="2" onChange="verificador()">  Rut sin puntos
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1"><br>Nombre  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="60" value="<? echo $comenombre ?>" >
                             </td>
                           </tr>
                              <input type="hidden" name="direccion" class="Estilo2" size="50" >
                              <input type="hidden" name="telefono" class="Estilo2" size="50" >

                            <tr id="tipopersona2" style="visibility:hidden">
                             <td  valign="center" class="Estilo1">Tipo</td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="tipo" class="Estilo2" value="1" >Persona Natural
                              <input type="radio" name="tipo" class="Estilo2" value="2" >Personalidad Juridica
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Observación</td>
                             <td class="Estilo1" colspan=3>
                             <textarea name="obs" rows="3" class="Estilo2" cols="60" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "></textarea>
                             </td>
                           </tr>
<input type="hidden" name="fecha2" class="Estilo2" size="12" value="" id="f_date_c2" readonly="1">
<input type="hidden" name="fecha3" class="Estilo2" size="12" value="" id="f_date_c3" readonly="1">
                            <tr>
                             <td  valign="center" class="Estilo1">Moneda </td>
                             <td class="Estilo1" colspan=3>
                                <select name="moneda" class="Estilo1">
                                   <option value="">Seleccione...</option>

                                 <?
                                    $sql2 = "Select * from dpp_monedas order by mone_tipo ";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){
                                       $monetipo=$row2["mone_tipo"];

                                 ?>
                                    <option value="<? echo $row2["mone_tipo"] ?>" <? if ($monetipo=='Pesos') { echo 'selected=selected'; } ?>  ><? echo $row2["mone_tipo"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>

                             </td>
                           </tr>

                          <tr>
                             <td  valign="top" class="Estilo1"> Cantidad</td>
                             <td class="Estilo1">
                                <select name="cantidad" class="Estilo1" onChange="aparece2()" >
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 <option value="6">6</option>
                                 <option value="7">7</option>
                                 <option value="8">8</option>
                                 <option value="9">9</option>
                                 <option value="10">10</option>
                                 <option value="11">11</option>
                                 <option value="12">12</option>
                                 <option value="13">13</option>
                                 <option value="14">14</option>
                                 <option value="15">15</option>
                               </select>
                             </td>
                            </tr>
                            <tr>

                         <table>
                             <td  valign="top" class="Estilo1">
                              <input type="radio" name="swiva" class="Estilo2" value="3" onClick="muestrarete2();" checked> Sin Impuesto
                              <input type="hidden" name="swiva" class="Estilo2" value="1" onclick="muestrarete2();">
                              <input type="hidden" name="swiva" class="Estilo2" value="2" onClick="muestrarete();">

                             </td>

                           </tr>

                         </TABLE>

                         <TABLE>
                           <TR>
                            <td  valign="top" class="Estilo1" colspan=3>
                              <table border=1 width="500">
                           <tr>
                            <td  valign="top" class="Estilo1c" colspan="6">DETALLE ORDEN DE REEMBOLSO</td>
                           </TR>

                                <tr>
                                  <td class="Estilo1" width="8">N&#186;</td>
<td class="Estilo1c" width="25">CANT</td>
<td class="Estilo1c" width="245">DETALLE PRODUCTO O SERVICIO</td>
<td class="Estilo1c" width="50">VALOR UNITARIO</td>
<td class="Estilo1c" width="50">VALOR TOTAL</td>

                                </tr>

                                <tr>
                                   <td class="Estilo1" >1<input type="hidden" name="item1" class="Estilo2" size="10" value="1" >
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="ctda1" class="Estilo2d" size="3"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula1();">
                                  </td>
                                   <td class="Estilo1" >
                                    <textarea name="detalle1" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor1" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula1();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" id="total1" name="total1" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item21" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 1
                                <select name="item31" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>

                                </table>
                                <div id="seccion12" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >2&nbsp;&nbsp;<input type="hidden" name="item2" class="Estilo2d" size="10" value="2"  >
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="ctda2" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula2();">
                                  </td>
                                   <td class="Estilo1" width="275" >
                                    <textarea name="detalle2" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="valor2" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula2();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total2" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item22" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 2
                                <select name="item32" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>

                                </table>
                                </div>
                                <div id="seccion13" style="display:none">
                                <table border=1>
                                <tr>
                                   <td class="Estilo1" >3&nbsp;&nbsp;<input type="hidden" name="item3" class="Estilo2d" size="10" value="3"   >
                                  </td>
                                   <td class="Estilo1" >
                                    <input type="text" name="ctda3" class="Estilo2d" size="3"   onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula3();">
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle3" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor3" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula3();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total3" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item23" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 3
                                <select name="item33" class="Estilo1">
                                 <?
                                  echo '<option value="">SeleccioneSeleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>

                                </table>
                                </div>
                                <div id="seccion14" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >4&nbsp;&nbsp;<input type="hidden" name="item4" class="Estilo2" size="10" value="4"   >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda4" class="Estilo2d" size="3"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula4();">
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle4" class="Estilo2" rows="3" cols="50" ></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor4" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula4();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total4" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item24" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 4
                                <select name="item34" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion15" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >5&nbsp;&nbsp;<input type="hidden" name="item5" class="Estilo2" size="10" value="5"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda5" class="Estilo2d" size="3"    onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula5();">
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle5" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor5" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula5();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total5" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item25" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 5
                                <select name="item35" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion16" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >6&nbsp;&nbsp;<input type="hidden" name="item6" class="Estilo2" size="10" value="6"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda6" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula6();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle6" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor6" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula6();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total6" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item26" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 6
                                <select name="item36" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion17" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >7&nbsp;&nbsp;<input type="hidden" name="item7" class="Estilo2" size="10" value="7"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda7" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula7();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle7" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor7" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula7();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total7" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item27" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 7
                                <select name="item37" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion18" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >8&nbsp;&nbsp;<input type="hidden" name="item8" class="Estilo2" size="10" value="8"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda8" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula8();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle8" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor8" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula8();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total8" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item28" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 8
                                <select name="item38" class="Estilo1">
                                 <?
                                  echo '<option value="">Select...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion19" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >9&nbsp;&nbsp;<input type="hidden" name="item9" class="Estilo2" size="10" value="9"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda9" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula9();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle9" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor9" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula9();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total9" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item29" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 9
                                <select name="item39" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion110" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >10&nbsp;&nbsp;<input type="hidden" name="item10" class="Estilo2" size="10" value="10"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda10" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula10();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle10" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor10" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula10();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total10" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item210" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 10
                                <select name="item310" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion111" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >11&nbsp;&nbsp;<input type="hidden" name="item11" class="Estilo2" size="10" value="11"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda11" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula11();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle11" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor11" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula11();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total11" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item211" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 11
                                <select name="item311" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion112" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >12&nbsp;&nbsp;<input type="hidden" name="item12" class="Estilo2" size="10" value="12"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda12" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula12();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle12" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor12" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula12();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total12" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item212" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 12
                                <select name="item312" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion113" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >13&nbsp;&nbsp;<input type="hidden" name="item13" class="Estilo2" size="10" value="13"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda13" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula13();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle13" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor13" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula13();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total13" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item213" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 13
                                <select name="item313" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion114" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >14&nbsp;&nbsp;<input type="hidden" name="item14" class="Estilo2" size="10" value="14"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda14" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula14();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle14" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor14" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula14();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total14" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item214" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 14
                                <select name="item314" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>
                                <div id="seccion115" style="display:none">
                                <table border=1>

                                <tr>
                                   <td class="Estilo1" >15&nbsp;&nbsp;<input type="hidden" name="item15" class="Estilo2" size="10" value="15"  >
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="ctda15" class="Estilo2d" size="3" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula15();" >
                                  </td>
                                   <td class="Estilo1" width="275">
                                    <textarea name="detalle15" class="Estilo2" rows="3" cols="50"></textarea>
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="valor15" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calcula15();">
                                  </td>
                                   <td class="Estilo1d" >
                                    <input type="text" name="total15" class="Estilo2d" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >
                                  </td>
                                </tr>
                            <tr id="item215" style="display:">
                             <td  valign="center" class="Estilo1" colspan=5>Item 15
                                <select name="item315" class="Estilo1">
                                 <?
                                  echo '<option value="">Seleccione...</option>';
                                  $sql2 = "select * from ff_tipogasto where tipog_estado=1 order by tipog_codigo";
          //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
>                                        <option value="<? echo $row2["tipog_nombre"]."/".$row2["tipog_codigo"]."/".$row2["tipog_codigo2"]; ?>"  ><? echo $row2["tipog_codigo"]."/".$row2["tipog_nombre"]; ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>


                              </table>
                              </div>

                                <table border=0>
                                <tr id="reten" style="display:none">
                                   <td class="Estilo1" width="375"></td>
                                   <td class="Estilo1d" width="75" >$ Retención</td>
                                   <td class="Estilo1d" ><input type="text" name="retencion" class="Estilo2d" size="10"  >  </td>
                                </tr>

                                <tr>
                                   <td class="Estilo1" width="375"></td>
                                   <td class="Estilo1d" width="75" >Total</td>
                                   <td class="Estilo1d" ><input type="text" name="montototal" class="Estilo2d" size="10"  >  </td>
                                </tr>

                              </table>
                            </td>
                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR ORDEN DE REEMBOLSO    " > </td>
                           </tr>

                             <input type="hidden" name="origen" value="1">

                        </form>
</div>
                      </td>


                       <tr>
                       <td></td><td></td><td></td><td></td>
                      </tr>
                      
				  <form name="form111" action="compra_orden3.php" method="get"  >
                            <tr>
                             <td  valign="center" class="Estilo1">Año
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


                      <tr>
                      <td colspan="8">



                      <table border=1>
<tr></tr>


<br>


                        <tr>
                         <td class="Estilo3c">Nº </td>
                         <td class="Estilo3c">Nombre Orden de Reembolso</td>
                         <td class="Estilo3c">Fecha </td>
                         <td class="Estilo3c">Tipo de Pago</td>
                         <td class="Estilo3c">Nombre Proveedor</td>
                         <td class="Estilo3c">Monto</td>
                         <td class="Estilo3c">Formato</td>
                         <td class="Estilo3c">Archivo</td>
                         <td class="Estilo3c">ELIMINAR</td>
                        </tr>
<?

  $sql="select * from compra_orden where oc_region=$regionsession and oc_nombre<>'' and oc_fpago<>'' and  oc_emitidapor<>'' and oc_modalidad='Reembolso' and year(oc_fechacompra)='$anno2' order by oc_id desc LIMIT 0 , 300 ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){

if ($row3["oc_archivo"]=='') {
    $imagen="punt_rojo.jpg";
    $titulo="Subir Archivo";
    $href="<a href='#' class='link' onclick='abreVentana2(".$row3["oc_id"].",".$row3["oc_id"].")' title='".$titulo."'>";
} else {
    $imagen="punt_verde.jpg";
    $titulo="Ver Archivo";
    $href="<a href='../../archivos/docfac/".$row3["oc_archivo"]."' class='link' target='_blank' title='".$titulo."'>";
}


?>


                       <tr>
<td class="Estilo3c"><? echo $row3["oc_numero"] ?> </td>
<td class="Estilo3c"><? echo $row3["oc_nombre"] ?> </td>
<td class="Estilo3c" ><? echo substr($row3["oc_fechacompra"],8,2)."-".substr($row3["oc_fechacompra"],5,2)."-".substr($row3["oc_fechacompra"],0,4)   ?></td>
<td class="Estilo3c"><? echo $row3["oc_modalidad"] ?> </td>
<td class="Estilo3c"><? echo $row3["oc_rsocial"] ?> </td>
<td class="Estilo2d"><? echo number_format($row3["oc_monto"],0,',','.');  ?></td>
<td class="Estilo3c"><a href="compra_imprimiroca.php?id=<? echo $row3["oc_id"]; ?>&tipo=<? echo $row3["oc_modalidad"]  ?>" class="link" >IMPRIMIR</a></td>
<td class="Estilo3c"><? echo $href ?><img src="images/<? echo $imagen ?>" width="20" height="20" border=0></a></td>
<td class="Estilo3c"><a href="compra_orden3.php?id=<? echo $row3["oc_id"] ?>&ori=1" class="link" onClick="return confirm('Seguro que desea Borrar o Eliminar?')">Eliminar</a></td>
                       </tr>





<?

   $cont++;

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
<script>
  function  calculocombustible() {
       document.form33.totalc.value=Math.round((document.form33.ctdakm.value/document.form33.kmlitro.value)*document.form33.precio.value);
       document.form33.diferencia.value=Math.round(document.form33.totalc.value-document.form33.total.value);
  }
  function  ocultarcon() {
       theLayer.style.display="none";
  }
  function  mostrarcon() {
       theLayer.style.display="";
  }

</script>

<div  style="width:300px; height:400px; background-color:#E0F8F7; position:absolute;  top:72px; left:910px; z-index:1; display:none;" id="theLayer" >
<form name="form33" action="compra_grabaorden2.php" method="post"  >
   <table border=0>
<tr>
<td width="100%">
  <table border="0" width="100%" cellspacing="0" cellpadding="0" height="36">
  <tr>
  <td id="titleBar" style="cursor:move" width="100%">
  <ilayer width="100%" onSelectStart="return false">
  <layer width="100%" onMouseover="isHot=true;if (isN4) ddN4(theLayer)" onMouseout="isHot=false">
        &nbsp;
  </layer>
  </ilayer>
  </td>
  <td style="cursor:hand" valign="top">

  </td>
  </tr>

       <tr>
         <td class="Estilo1" colspan="2" ><a href="#" class="link" onClick="ocultarcon();" >OCULTAR</a></td>
       </tr>
   </table>

   <table border=0>
       <tr>
         <td class="Estilo1" width="120" ></td>
         <td class="Estilo1" >
           <select name="uno" class="Estilo1"  size="25" onChange="traerDatos3();">
                                 <?
                                  $sql2 = "select * from chile2013 order by nombre";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                        <option value="<? echo $row2["codigo"]; ?>" > <? echo $row2["nombre"]; ?></option>

                                 <?
                                   }
                                 ?>



           </select>
         </td>
         <td width="100">
         </td>
         <td class="Estilo1" >
           <select name="dos" class="Estilo1"  size="25" onChange="traerDatos3();">
                                 <?
                                  $sql2 = "select * from chile2013 order by nombre";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                        <option value="<? echo $row2["codigo"]; ?>" > <? echo $row2["nombre"]; ?></option>

                                 <?
                                   }
                                 ?>



           </select>
           </td>
       </tr>

   </table>

   <table border=0>
       <tr>
         <td class="Estilo1" width="120" >Cantidad de Km.</td>
         <td class="Estilo1" ><input type="text" name="ctdakm" class="Estilo2d" size="14"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();"> </td><td class="Estilo1" id="visualizar"> </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Km por Litro</td>
         <td class="Estilo1" ><input type="text" name="kmlitro" class="Estilo2d" size="14" onKeyPress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();" value="10">  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Precio Combustible</td>
         <td class="Estilo1" ><input type="text" name="precio" class="Estilo2d" size="14"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();">  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Total Informado</td>
         <td class="Estilo1" ><input type="text" name="total" class="Estilo2d" size="14"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" onKeyUp="calculocombustible();">  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" ></td>
         <td class="Estilo1" >_____________</td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Total Calculado</td>
         <td class="Estilo1" ><input type="text" name="totalc" class="Estilo2d" size="14"  >  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >Diferencia</td>
         <td class="Estilo1" ><input type="text" name="diferencia" class="Estilo2d" size="14"  >  </td>
       </tr>
       <tr>
         <td class="Estilo1" width="120" >&nbsp;</td>
       </tr>
       <tr>
         <td class="Estilo1" colspan=2  >
         &nbsp;&nbsp;&nbsp;
         <input type="button" name="boton1" class="Estilo2c" value="Calcular" onClick="calculocombustible();" >
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="reset"  name="boton2" class="Estilo2c" value="Limpiar"  >
         </td>
       </tr>

  </table>



</form>


</div>


