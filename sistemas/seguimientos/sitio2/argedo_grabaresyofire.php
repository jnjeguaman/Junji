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
$year=date("Y");
?>
<html>
<head>
<title>CONTRATOS</title>
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
.Estilo2 {
	font-family: Verdana;
	font-size: 10px;
	text-align: left;
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
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
text-align: center;}
-->
</style>



</head>
<script type="text/javascript" src="select_dependientes_3_nivelesa.js"></script>
<script type="text/javascript" src="select_dependientes_3_nivelesb.js"></script>
<script type="text/javascript" src="select_dependientes_3_nivelesc.js"></script>
<script type="text/javascript" src="select_dependientes_3_nivelesd.js"></script>
<script type="text/javascript" src="select_dependientes.js"></script>
<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>
  
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

if (digito == 11) {
	digito = 0;
}
if (digito == 10) {
	digito = "k";
}
if (dig!=digito) {
  alert('Rut incorrecto, es  '+digito);
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


function valida() {
   if (document.form1.fecha1.value=='' ) {
      alert ("Fecha Creación presenta problemas ");
      return false;
  }
   if (document.form1.idlicitacion.value=='' ) {
      alert ("Id licitacion presenta problemas ");
      return false;
  }

   if (document.form1.rut.value=='') {
      alert ("Rut presenta problemas ");
      return false;
  }
   if (document.form1.dig.value=='') {
      alert ("Digito presenta problemas ");
      return false;
  }

   if (document.form1.nombre.value=='') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.region.value=='') {
      alert ("Region presenta problemas ");
      return false;
  }
   if (document.form1.tipo.value=='') {
      alert ("Tipo presenta problemas ");
      return false;
  }

   if (document.form1.contrato.value=='') {
      alert ("Contrato presenta problemas ");
      return false;
  }
   if (document.form1.nroresolucion.value=='') {
      alert ("Nº Resolucion presenta problemas ");
      return false;
  }
   if (document.form1.unidad.value=='') {
      alert ("Unidad presenta problemas ");
      return false;
  }
   if (document.form1.rutadmin.value=='') {
      alert ("Rut Administrador presenta problemas ");
      return false;
  }
   if (document.form1.nombre1.value=='') {
      alert ("Nombre Contrato presenta problemas ");
      return false;
  }
   if (document.form1.fecha2.value=='' ) {
      alert ("Fecha Suscripcion presenta problemas ");
      return false;
  }
   if (document.form1.fecha3.value=='' ) {
      alert ("Fecha Vencimiento presenta problemas ");
      return false;
  }
   if (document.form1.antiguedad.value=='') {
      alert ("Antiguedad presenta problemas ");
      return false;
  }
   if (document.form1.anual.value=='') {
      alert ("Monto anual presenta problemas ");
      return false;
  }
   if (document.form1.total.value=='') {
      alert ("Total presenta problemas ");
      return false;
  }
   if (document.form1.termino[0].checked=='' && document.form1.termino[1].checked=='' ) {
      alert ("No ha seleccionado Termino ");
      return false;
  }
   if (document.form1.renovacion[0].checked=='' && document.form1.renovacion[1].checked=='' ) {
      alert ("No ha seleccionado renovacion");
      return false;
  }
  
   if (document.form1.anticipado[0].checked=='' && document.form1.anticipado[1].checked=='' ) {
      alert ("No ha seleccionado renovacion");
      return false;
  }

   if (document.form1.ahorro[0].checked=='' && document.form1.ahorro[1].checked=='' ) {
      alert ("No ha seleccionado Ahorro Anual");
      return false;
  }
   if (document.form1.energia[0].checked=='' && document.form1.energia[1].checked=='' ) {
      alert ("No ha seleccionado Ahorro de Energia");
      return false;
  }
   if (document.form1.propiedad[0].checked=='' && document.form1.propiedad[1].checked=='' ) {
      alert ("No ha seleccionado Propiedad de Servicio ");
      return false;
  }
   if (document.form1.habilidad[0].checked=='' && document.form1.habilidad[1].checked=='' ) {
      alert ("No ha seleccionado Control Mensual ");
      return false;
  }
   if (document.form1.usogarantia[0].checked=='' && document.form1.usogarantia[1].checked=='' ) {
      alert ("No ha seleccionado Uso Garantia ");
      return false;
  }
   if (document.form1.multas[0].checked=='' && document.form1.multas[1].checked=='' ) {
      alert ("No ha seleccionado Aplicado Multas");
      return false;
  }
   if (document.form1.aplicado.value=='') {
      alert ("Total _Multas presenta problemas ");
      return false;
  }
   if (document.form1.inspector[0].checked=='' && document.form1.inspector[1].checked=='' ) {
      alert ("No ha seleccionado Inspector Tecnico ");
      return false;
  }
   if (document.form1.variabilidad[0].checked=='' && document.form1.variabilidad[1].checked=='' ) {
      alert ("No ha seleccionado Variabilidad ");
      return false;
  }
   if (document.form1.ejecuta[0].checked=='' && document.form1.ejecuta[1].checked=='' ) {
      alert ("No ha seleccionado Plazos Establecidos");
      return false;
  }
   if (document.form1.adjunto[0].checked=='' && document.form1.adjunto[1].checked=='' ) {
      alert ("No ha seleccionado Subido ");
      return false;
  }
   if (document.form1.adjunto2[0].checked=='' && document.form1.adjunto2[1].checked=='' ) {
      alert ("No ha seleccionado Subido Modificado ");
      return false;
  }
   if (document.form1.conexos.value=='') {
      alert ("Total _Multas presenta problemas ");
      return false;
  }
   if (document.form1.evaluara[0].checked=='' && document.form1.evaluara[1].checked=='' ) {
      alert ("No ha seleccionado Tipo de Documento ");
      return false;
  }
   if (document.form1.justifica.value==false) {
      alert ("Justificacion uno presenta problemas ");
      return false;
  }
   if (document.form1.justifica2.value==false) {
      alert ("Justificacion dos presenta problemas ");
      return false;
  }



  
}



function muestra1() {
       seccion2.style.display="";

}
function muestra2() {
       seccion2.style.display="none";

}
//-->

</script>

<body>
<?php
function generaSelecta()
{
	//include 'conexion.php';
	//conectar();
	$consulta=mysql_query("SELECT id, opcion FROM select_1 where estado=1");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1a' id='select1' onChange='cargaContenidoa(this.id)' class='Estilo1'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}
	echo "</select>";
}
function generaSelectb()
{
	//include 'conexion.php';
	//conectar();
	$consulta=mysql_query("SELECT id, opcion FROM select_1 where estado=1");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1b' id='select1b' onChange='cargaContenidob(this.id)' class='Estilo1'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}
	echo "</select>";
}

function generaSelectc()
{
	//include 'conexion.php';
	//conectar();
	$consulta=mysql_query("SELECT id, opcion FROM select_1 where estado=1");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1c' id='select1c' onChange='cargaContenidoc(this.id)' class='Estilo1'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}
	echo "</select>";
}
function generaSelectd()
{
	//include 'conexion.php';
	//conectar();
	$consulta=mysql_query("SELECT id, opcion FROM select_1 where estado=1");
	//desconectar();

	// Voy imprimiendo el primer select compuesto por los paises
	echo "<select name='select1d' id='select1d' onChange='cargaContenidod(this.id)' class='Estilo1'>";
	echo "<option value='0'>Elige</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		echo "<option value='".$registro[0]."'>".$registro[0]."</option>";
	}
	echo "</select>";
}
function generaPaises()
{
//	include 'conexion.php';
//	conectar();
	$consulta=mysql_query("SELECT id, opcion FROM tipocontrato");
    //echo $consulta;
//	desconectar();

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
          <td valign="top">           <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">CREACIÓN DE NUEVO CONTRATO</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                         <a href="mantenedor/" class="link" target="_blank">Crear nuevo Proveedor</a>

                    <tr>
                         <td width="487" valign="top" class="Estilo1">

<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";

$id=$_GET["id2"];
/*
$sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$evaluara=$row["cont_evaluara"];
*/
?>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>


                   <tr>
                    <td height="50" colspan="3">
                    
					<table width="520" border="1" cellspacing="0" cellpadding="0">
					  <form name="form1" action="grabacontrato.php" method="post"  onSubmit="return valida()">
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Creación</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $row["cont_recepcion"]; ?>" id="f_date_c1" readonly="1">
<img src="calendario.gif" id="f_trigger_c1" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c1",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c1",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Id Licitación  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="idlicitacion" class="Estilo2" size="20" value="<? echo $row["cont_licitacion"]; ?>">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Rut Empresa  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" value="<? echo $row["cont_rut"]; ?>"> -
                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()" value="<? echo $row["cont_dig"]; ?>">  Rut sin puntos
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Proveedor Adjudicado </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $row["cont_nombre"]; ?>">
                             </td>
                           </tr>



                         <tr>
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

                            <tr>
                             <td  valign="center" class="Estilo1">Tipo</td>
				             <td><?php generaPaises(); ?>
                              <input type="hidden" name="tipo" class="Estilo2" size="40" value="<? echo $row["cont_tipo"]; ?>" >
                             </td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">Contrato</td>
                             <td>
					            <select disabled="disabled" name="estados" id="estados">
  						          <option value="0">Seleccione...</option>
					            </select>

                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nº de Resolución</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nroresolucion" class="Estilo2" size="40" value="<? echo $row["cont_nroresolucion"]; ?>">
                                <input type="hidden" name="contrato" class="Estilo2" size="40" value="<? echo $row["cont_contrato"]; ?>">
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Unidad que Genera Contrato  </td>
                             <td class="Estilo1" colspan=3>
                                  <select name="unidad" class="Estilo1">

                                 <?
                                  if ($regionsession==0) {
                                    $sql2 = "Select * from dpp_deptos2 order by depto_id";
                                    echo '<option value="">Select...</option>';
                                  } else
                                    $sql2 = "Select * from dpp_deptos2 where depto2_region=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["depto_id"] ?>"><? echo $row2["depto_nombre"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>

                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Rut de Admininistrador del Contrato  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rutadmin" class="Estilo2" size="40" value="<? echo $row["cont_rutadmin"]; ?>" >
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Contrato </td>
                             <td class="Estilo1" colspan=3>
                              <textarea name="nombre1" rows="3" cols="30"><? echo $row["cont_nombre1"]; ?></textarea>
                             </td>
                           </tr>


                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Suscripción</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $row["cont_suscrip"]; ?>" id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


                             </td>
                           </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Vencimiento</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $row["cont_vence"]; ?>" id="f_date_c3" readonly="1">
<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c3",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c3",  // trigger for the calendar (button ID)
        align          :    "Tl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Antiguedad en Años </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="antiguedad" class="Estilo2" size="40" value="<? echo $row["cont_antiguedad"]; ?>">
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Monto Anual </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="anual" class="Estilo2" size="20" value="<? echo $row["cont_anual"]; ?>">
                              <select name="moneda1" class="Estilo1">

                                 <?
                                    $sql2 = "Select * from dpp_monedas ";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["mone_id"] ?>"><? echo $row2["mone_tipo"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Monto total </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="total" class="Estilo2" size="20" value="<? echo $row["cont_total"]; ?>">
                              <select name="moneda2" class="Estilo1">

                                 <?
                                    $sql2 = "Select * from dpp_monedas ";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["mone_id"] ?>"><? echo $row2["mone_tipo"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Moneda a Pagar Mensual</td>
                             <td class="Estilo1" colspan=3>
                              <select name="moneda3" class="Estilo1">

                                 <?
                                    $sql2 = "Select * from dpp_monedas ";
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["mone_id"] ?>"  <? if ($row2["mone_id"]==$row["cont_tipo3"]) echo "selected=selected" ?>><? echo $row2["mone_tipo"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Término año <? echo $year ?> </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="termino" class="Estilo1c" value="SI" <? if ($row["cont_termino"]=="SI") echo "checked" ?>  >Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="termino" class="Estilo1c" value="NO" <? if ($row["cont_termino"]=="NO") echo "checked" ?> > No
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Cláusulas de Renovación Automática </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="renovacion" class="Estilo1c" value="SI"  <? if ($row["cont_renovacion"]=="SI") echo "checked" ?>  >Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="renovacion" class="Estilo1c" value="NO"  <? if ($row["cont_renovacion"]=="NO") echo "checked" ?> > No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Cláusulas de Término Anticipado </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="anticipado" class="Estilo2" value="SI" <? if ($row["cont_anticipado"]=="SI") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="anticipado" class="Estilo2" value="NO" <? if ($row["cont_anticipado"]=="NO") echo "checked" ?>> No
                             </td>
                           </tr>
                           
                           <tr>
                             <td  valign="center" class="Estilo1c" colspan="2" align="center">CONDICIONES ESPECIALES </td>
                           </tr>
                           
                            <tr>
                             <td  valign="center" class="Estilo1">Ahorro Estimado Anual</td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="ahorro" class="Estilo2" value="SI" <? if ($row["cont_ahorro"]=="SI") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="ahorro" class="Estilo2" value="NO" <? if ($row["cont_ahorro"]=="NO") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Clásula de Ahorro de Energía </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="energia" class="Estilo2" value="SI" <? if ($row["cont_energia"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="energia" class="Estilo2" value="NO" <? if ($row["cont_energia"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Derecho de Propiedad del Servicio </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="propiedad" class="Estilo2" value="SI" <? if ($row["cont_propiedad"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="propiedad" class="Estilo2" value="NO" <? if ($row["cont_propiedad"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Control Mensual de Habilidad </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="habilidad" class="Estilo2" value="SI" <? if ($row["cont_habilidad"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="habilidad" class="Estilo2" value="NO" <? if ($row["cont_habilidad"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Uso de Garantía (Fiel Cumplimiento) </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="usogarantia" class="Estilo2" value="SI" <? if ($row["cont_usogarantia"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="usogarantia" class="Estilo2" value="NO" <? if ($row["cont_usogarantia"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Aplicación de Multas en el Periodo </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="multas" class="Estilo2" value="SI" <? if ($row["cont_multas"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="multas" class="Estilo2" value="NO" <? if ($row["cont_multas"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Se han aplicados multas </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="text" name="aplicado" class="Estilo2" size="10" value="<? echo $row["cont_aplicado"]; ?>" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">El contrato es ejecutado y evaluado por un inspector tecnico o administrador </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="inspector" class="Estilo2" value="SI" <? if ($row["cont_inspector"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="inspector" class="Estilo2" value="NO" <? if ($row["cont_inspector"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Ha existido variabilidad en la entrega de bienes y servicios </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="variabilidad" class="Estilo2" value="SI" <? if ($row["cont_variabilidad"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="variabilidad" class="Estilo2" value="NO" <? if ($row["cont_variabilidad"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">El contrato se ejecuta dentro de los plazos establecidos </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="ejecuta" class="Estilo2" value="SI" <? if ($row["cont_ejecuta"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="ejecuta" class="Estilo2" value="NO" <? if ($row["cont_ejecuta"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">El contrato se a subido a mecado público como adjunto</td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="adjunto" class="Estilo2" value="SI" <? if ($row["cont_adjunto"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="adjunto" class="Estilo2" value="NO" <? if ($row["cont_adjunto"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">El contrato se a subido a mecado publico como adjunto (modificado) </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="adjunto2" class="Estilo2" value="SI" <? if ($row["cont_adjunto2"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="adjunto2" class="Estilo2" value="NO" <? if ($row["cont_adjunto2"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">El contrato a tenido servicios conexos ¿Cuántos? </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="text" name="conexos" class="Estilo2" size="10"  value="<? echo $row["cont_conexos"]; ?>"  >
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">De acuerdo a la variables anteriores ¿evaluará éste contrato? </td>
                             <td class="Estilo1c" colspan=3>
                              <input type="radio" name="evaluara" class="Estilo2" value="SI" <? if ($row["cont_evaluara"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="evaluara" class="Estilo2" value="NO" <? if ($row["cont_evaluara"]=="no") echo "checked" ?>  > No
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">En caso que los contratos no sean Evaluados, Justifique </td>
                             <td class="Estilo1c" colspan=3>
                              <textarea rows="4" cols="30" name="justifica" ></textarea>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Justifique </td>
                             <td class="Estilo1" colspan=3>
                              <textarea rows="4" cols="30" name="justifica2" ></textarea>
                             </td>
                           </tr>


                             </table>
                             
   <table border=1>
     <tr>
      <td  valign="center" class="Estilo1">
       Item
      </td>
      <td  valign="center" class="Estilo1">
       Sub Item
      </td>
      <td  valign="center" class="Estilo1">
       Glosa
      </td>
      <td  valign="center" class="Estilo1">
       Porcentaje
      </td>


      </tr>

    <tr>
    <td class="Estilo1">
				<?php generaSelecta(); ?>

   </td>
    <td class="Estilo1">
					<select disabled="disabled" name="select2a" id="select2a" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>

    <td class="Estilo1">
					<select disabled="disabled" name="select3a" id="select3" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>

    <td>
      <input type="text" name="ejecutaa" class="Estilo2" size="10" >
      <input type="text" name="ejecutaah"  >
    </td>
   </tr>
    <tr>
    <td class="Estilo1">
			<?php generaSelectb(); ?>
   </td>
    <td class="Estilo1">
					<select disabled="disabled" name="select2b" id="select2b" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>

    <td class="Estilo1">
					<select disabled="disabled" name="select3b" id="select3b" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>
    <td>
      <input type="text" name="ejecutab"  id="ejecutab" class="Estilo2" size="10" >
      <input type="hidden" name="ejecutabh"  >
    </td>

   </tr>
    <tr>
    <td class="Estilo1">
			<?php generaSelectc(); ?>
   </td>
    <td class="Estilo1">
					<select disabled="disabled" name="select2c" id="select2c" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>

    <td class="Estilo1">
					<select disabled="disabled" name="select3c" id="select3c" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>
    <td>
      <input type="text" name="ejecutac" class="Estilo2" size="10" >
      <input type="hidden" name="ejecutach"  >
    </td>

   </tr>
    <tr>
    <td class="Estilo1">
			<?php generaSelectd(); ?>
   </td>
    <td class="Estilo1">
					<select disabled="disabled" name="select2d" id="select2d" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>

    <td class="Estilo1">
					<select disabled="disabled" name="select3d" id="select3d" class="Estilo1">
						<option value="0">Elegir</option>
					</select>
    </td>
    <td>
      <input type="text" name="ejecutad" class="Estilo2" size="10" >
      <input type="hidden" name="ejecutadh"  >
    </td>

   </tr>
   </table>
 					          <table width="488" border="1" cellspacing="0" cellpadding="0">
                               <input type="hidden" name="id" value="<? echo $id ?>" >






                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR CONTRATO    " > </td>
                           </tr>



                        </form>

                      </td>


                       <tr>
                       <td colspan="8"><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">
                         <table border=1>
                             <tr>
                               <td class="Estilo1">Nº</td><td class="Estilo1">Rut</td><td class="Estilo1" width="10">Nombre Proveedor</td><td class="Estilo1">Nombre Contrato</td><td class="Estilo1">ID_Lic</td>
                              </tr>

                              <?
                                  if ($regionsession==0) {
                                     $sql2 = "Select * from dpp_contratos order by cont_id desc limit 0,10";
                                  } else {
                                    $sql2 = "Select * from dpp_contratos  where cont_region='$regionsession' order by cont_id desc limit 0,10";
                                  }



                                  //$sql2 = "Select * from dpp_facturas where fac_usu_recepcion='$usuario' order by fac_id desc limit 0,10";
                                  //echo "--->".$sql2;
                                  $res2 = mysql_query($sql2);
                                   $cont=1;
                                   while($row2 = mysql_fetch_array($res2)){
                              ?>
                                  <tr>
                                  <td class="Estilo1"><? echo $cont ?> </td>
                                  <td class="Estilo1"><? echo $row2["cont_rut"] ?></td>
                                  <td class="Estilo1"><? echo $row2["cont_nombre"] ?></td>
                                  <td class="Estilo1"><? echo $row2["cont_nombre1"] ?></td>
                                  <td class="Estilo1"><? echo $row2["cont_licitacion"] ?></td>
                              <?
                                    $cont++;
                                  }
                              ?>

                              </tr>
                         </table>
                      <tr>
                      <td><br></tr>
                      </tr>

                      <tr>



</td>
  </tr>
 
 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
