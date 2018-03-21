<?
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


header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

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
	font-size: 8px;
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
                  document.form1.nombreoc.value=elem[7];
                  document.form1.obs.value=elem[8];
                  document.form1.monto.value=elem[1];
                  document.form1.codigo.value=elem[2];
                  document.form1.obs.value=elem[4];


                  var Date2 = elem[6];
//                alert(Date2);
                  var elem2 = Date2.split('-');
                  document.form1.rut.value=elem2[0];
                  document.form1.dig.value=elem2[1];
                  
                 traerDatos(elem2[0]);
                  

                  
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
      alert ("Direccion presenta problemas ");
      return false;
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
   if (document.form1.documento2.value=='' || document.form1.documento2.value=='xx' ) {
      alert ("Modalida presenta problemas ");
      return false;
  }

   if (document.form1.tipo2.value=='' ) {
      alert ("Centro de Costo presenta problemas ");
      return false;
  }
   if (document.form1.documento.value=='' || document.form1.documento.value=='xx' ) {
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



}

function envia() {
  if (document.form1.accion[0].checked) {
        document.getElementById("cuerpo").style.visibility="visible";
  }
  if (document.form1.accion[1].checked) {
        document.getElementById("cuerpo").style.visibility="hidden";
        if (confirm('¡¡Para continuar debe Crear Actividad en Plan de Compra!!')){
            location.href="compra_ingresa.php?ori=2";
        } else {
            document.getElementById("cuerpo").style.visibility="visible";
            document.form1.accion[0].checked='true';
        }

  }

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

<img src="images/pix.gif" width="1" height="10">
<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1009">
	  <?
	  require("inc/top.php");      
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="165" valign="top">
		  <?
		  require("inc/menu_1.php");
		  ?>		  </td>
          <td valign="top">
           <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="671" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif">
                <table width="460" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO ORDEN DE COMPRA (Mercado Público )</span></td>
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
//    exit();

}


?>


                   <tr>
             			<td height="30" colspan="3">
                    
					<table width="480" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="compra_grabaorden.php" method="post"  onSubmit="return valida()" enctype="multipart/form-data">
                           <tr>
                             <td  valign="center" class="Estilo1">LA ORDEN DE COMPRA ESTÁ EN PLAN DE COMPRAS? </td>
                             <td class="Estilo1" colspan=1>
                              <input type="radio" name="accion" class="Estilo2" value="SI" onclick="envia();"> SI
                              <input type="radio" name="accion" class="Estilo2" value="NO" onclick="envia();"> NO


                              </td>
                           </tr>
                      <tr>
                       <td><hr></td><td><hr></td>
                      </tr>

                    </table>

<div id="cuerpo" style="visibility:hidden" >
					<table width="488" border="0" cellspacing="0" cellpadding="0">


                   <tr>
                             <td  valign="center" class="Estilo1">Fecha Compra</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" >
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
					<table width="488" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?












 if ($regionsession==1) {
     $para1="1877";
 }
 if ($regionsession==2) {
     $para1="1333";
 }
 if ($regionsession==3) {
     $para1="1879";
 }
 if ($regionsession==4) {
     $para1="1880";
 }
 if ($regionsession==5) {
     $para1="2229";
 }
 if ($regionsession==6) {
     $para1="1739";
 }
 if ($regionsession==7) {
     $para1="1881";
 }
 if ($regionsession==8) {
     $para1="2230";
 }
 if ($regionsession==9) {
     $para1="1882";
 }
 if ($regionsession==10) {
     $para1="1740";
 }
 if ($regionsession==11) {
     $para1="1887";
 }
 if ($regionsession==12) {
     $para1="1890";
 }
 if ($regionsession==13) {
     $para1="4342";
 }
 if ($regionsession==14) {
     $para1="4326";
 }
 if ($regionsession==15) {
     $para1="1876";
 }
 if ($regionsession==17) {
     $para1="523524";
 }
 if ($regionsession==18) {
     $para1="523522";
 }


?>
                            <tr>
                             <td  valign="center" class="Estilo1">Número O/C </td>
                             <td class="Estilo1" colspan=3>
                              <input type="hidden" name="numerooc1" value="<? echo $para1 ?>"   ><? echo $para1 ?> -
                              <input type="text" name="numerooc2" class="Estilo2" size="7"  onblur="traerDatos3();"> -
                              <input type="text" name="numerooc3" class="Estilo2" size="7" onblur="traerDatos3();" >
                              <input type="hidden" name="codigo" class="Estilo2" size="7" >

                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nombre O/C </td>
                             <td class="Estilo1" colspan=3>
                               <textarea name="nombreoc" rows="3" class="Estilo2" cols="64"></textarea>
                             </td>
                           </tr>


                            <tr>
                             <td  valign="center" class="Estilo1">Tipo Contratación  </td>
                             <td class="Estilo1">
                             <?php generalista2(); ?>
                              <input type="hidden" name="tipo2b" class="Estilo2" size="40" value="" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Modalidad  </td>
                             <td class="Estilo1">
					            <select disabled="disabled" name="estados2" id="estados2" class="Estilo1">
  						          <option value="0">Seleccione...</option>
					            </select>
                             </td>
                           </tr>

                            <tr id="seccion1" style="display:none;">
                             <td  valign="center" class="Estilo1"><br>Fecha</td>
                             <td class="Estilo1" colspan=3><br>
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        showsTime      :    true,            // will display a time selector
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        singleClick    :    true,           // double-click mode
        step           :    1                // show all years in drop-down boxes (instead of every other year as default)

    });
</script>
                             </td>
                           </tr>
                            <tr id="seccion2" style="display:none;">
                             <td  valign="center" class="Estilo1"><br>N° Resolucion</td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="nroresolucion" class="Estilo2" size="40"  onKeyUp="llenar();">
                             </td>
                           </tr>

                            <tr id="seccion3" style="display:none;">
                             <td  valign="center" class="Estilo1" width="79"> Archivo</td>
                             <td class="Estilo1" colspan=3>
                              <input type="file" name="archivo2" class="Estilo2" size="20"  > <br>
                              <a href="../../archivos/docfac/<? echo $row3["provee_archivo1"]; ?>" class="link" target="_blank"><? echo $row3["provee_archivo1"]; ?></a>
                             </td>
                           </tr>


                           
                           <tr>
                             <td valign="center" class="Estilo1" colspan=10><hr></td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">Centro de Costo</td>
				             <td><?php generalista(); ?>
                              <input type="hidden" name="tipo2" class="Estilo2" size="40" value="" >
                             </td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">Plan de Compra</td>
                             <td>
					            <select disabled="disabled" name="estados" id="estados" class="Estilo1">
  						          <option value="0">Seleccione...</option>
					            </select>

                             </td>


                           <tr>
                                 <input type="hidden" name="documento" class="Estilo2" size="40" value="<? echo $row["cont_contrato"]; ?>">
                                 <input type="hiddenn" name="documento2" class="Estilo2" size="40" value="<? echo $row["cont_contrato"]; ?>">
                                 <input type="hidden" name="programa" class="Estilo2" size="40" value="1">


                            <tr>
                             <td  valign="center" class="Estilo1">Rut Proveedor</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="15" onchange="limpiar()"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" > -
                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()">  Rut sin puntos
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1"><br>Nombre Proveedor</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="64" >
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1"><br>Dirección Proveedor</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="direccion" class="Estilo2" size="64" >
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1"><br>Teléfono Proveedor</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="telefono" class="Estilo2" size="15" >
                             </td>
                           </tr>

                            <tr id="tipopersona2" style="visibility:hidden">
                             <td  valign="center" class="Estilo1">Tipo</td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="tipo" class="Estilo2" value="1" >Persona Natural
                              <input type="radio" name="tipo" class="Estilo2" value="2" >Personalidad Jurídica
                             </td>
                           </tr>



                            <tr>
                             <td  valign="center" class="Estilo1">Monto O.C.</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="monto" class="Estilo2" size="15"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" > Pesos
                              <input type="hidden" name="moneda" class="Estilo2" size="15" value="Pesos" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Observación  </td>
                             <td class="Estilo1" colspan=3>
                             <textarea name="obs" rows="3" class="Estilo2" cols="64"></textarea>
                             </td>
                           </tr>


                   <tr>
                             <td  valign="center" class="Estilo1">Estado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                             <td class="Estilo1" valign="center">
                            <select name="estado22" class="Estilo1">
                                   <option value="">Seleccione...</option>
                                   <option value="ACEPTADO">ACEPTADO</option>
                                   <option value="CANCELADA/ELIMINADA/RECHAZADA">CANCELADA/ELIMINADA/RECHAZADA</option>
                                   <option value="ENVIADA">ENVIADA</option>
                                   <option value="RECEPCION CONFORME">RECEPCION CONFORME</option>
                               </select>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1" width="79"> Archivo</td>
                             <td class="Estilo1" colspan=3>
                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>
                              <a href="../../archivos/docfac/<? echo $row3["provee_archivo1"]; ?>" class="link" target="_blank"><? echo $row3["provee_archivo1"]; ?></a>
                             </td>
                           </tr>



                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR ORDEN DE COMPRA    " > </td>
                           </tr>

</DIV>
                           <input type="hidden" name="occompraid" value="" >
                           <input type="hidden" name="occompraid2" value="" >
                           <input type="hidden" name="para" value="" >

                        </form>

                      </td>


                       <tr>
                       <td></td><td></td><td></td><td></td>
                      </tr>
                      
				  <form name="form111" action="compra_orden.php" method="get"  >
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
                      </table>



                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8"></tr>

                        <tr>
                    <td class="Estilo1c">N°</td>
                    <td class="Estilo1c">Nº O.C. </td>
                    <td class="Estilo1c">Nombre</td>
                    <td class="Estilo1c">Fecha </td>
                    <td class="Estilo1c">Tipo</td>
                  	<td class="Estilo1c">Nombre Proveedor</td>
                    <td class="Estilo1c">Centro Costo</td>
                    <td class="Estilo1c">Monto</td>
                    <td class="Estilo1c">Ver</td>
                    <td class="Estilo1c">Eli</td>
                    <td class="Estilo1c">Mod</td>
                        </tr>
<?

  $sql="select * from compra_orden where oc_region=$regionsession and oc_fpago='' and  oc_emitidapor='' and oc_nombre<>'' and year(oc_fechacompra)='$anno2' order by oc_orden desc LIMIT 0 , 1000 ";

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
     <td class="Estilo3c"><? echo $row3["oc_numero"] ?> </td>
     <td class="Estilo3c" title="<? echo $row3["oc_nombre"]  ?>"><? echo $row3["oc_nombre"]  ?></td>
     <td class="Estilo3c" ><? echo substr($row3["oc_fechacompra"],8,2)."-".substr($row3["oc_fechacompra"],5,2)."-".substr($row3["oc_fechacompra"],0,4)   ?></td>
	 <td class="Estilo3c"><? echo $octipo2 ?> </td>
     <td class="Estilo3c" title="<? echo $row3["oc_nombre"]  ?>"><? echo $row3["oc_rsocial"]  ?></td>
	 <td class="Estilo3c" title="<? echo $row3["oc_ccosto"]  ?>"><? echo $row3["oc_ccosto"]  ?></td>
     <td class="Estilo2d"><? echo number_format($row3["oc_monto"],0,',','.');  ?></td>
	 <td class="Estilo3c"><a href="compra_fichaorden2.php?id=<? echo $row3["oc_id"]  ?>&ori=1" class="link" ><img src="imagenes/ico_buscar.gif" border=0></a></td>
     <td class="Estilo3c"><a href="compra_orden.php?id=<? echo $row3["oc_id"] ?>&ori=1" class="link" onclick="return confirm('Seguro que desea Borrar para siempre?')"><img src="imagenes/b_drop.png" border=0></a></td>
     <td class="Estilo3c"><a href="compra_ordenb.php?id=<? echo $row3["oc_id"] ?>&ori=1" class="link" ><img src="imagenes/ico_editar.png" border=0></a></td>
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

?>
