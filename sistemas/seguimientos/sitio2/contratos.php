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
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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
  


  <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />





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
            var Date = document.form1.nombre.value;
            var elem = Date.split('/');
//            nombre2.innerText=elem[0];
            document.form1.nombre.value=elem[0];
//            document.form1.fpago.value = elem[1];


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
   if (document.form1.licitacion.value=='') {
      alert ("Licitacion presenta problemas ");
      return false;
  }
   if (document.form1.descripcion.value=='') {
      alert ("Nombre Contrato presenta problemas ");
      return false;
  }
   if (document.form1.tipo.value=='') {
      alert ("Categoria presenta problemas ");
      return false;
  }
   if (document.form1.contrato.value=='') {// select_dependientes.js
      alert ("Subcategoria presenta problemas ");
      return false;
  }
   if (document.form1.fecha2.value=='' ) {
      alert ("Fecha Inicio presenta problemas ");
      return false;
  }
   if (document.form1.fecha3.value=='' ) {
      alert ("Fecha Termino presenta problemas ");
      return false;
  }
   if (document.form1.duracion.value=='') {
      alert ("Duracion presenta problemas ");
      return false;
  }
   if (document.form1.garantia[0].checked=='' && document.form1.garantia[1].checked=='' ) {
      alert ("No ha seleccionado Garantia ");
      return false;
  }
   if (document.form1.total.value=='') {
      alert ("Monto presenta problemas ");
      return false;
  }
   if (document.form1.nrocuotas.value=='') {
      alert ("N° de Cuotas presenta problemas ");
      return false;
  }
   if (document.form1.rea.value=='') {
      alert ("Reajustabilidad presenta problemas ");
      return false;
  }
   if (document.form1.vcuota.value=='') {
      alert ("Valor Cuota presenta problemas ");
      return false;
  }
   if (document.form1.unidad.value=='') {
      alert ("Unidad presenta problemas ");
      return false;
  }
   if (document.form1.anticipado[0].checked=='' && document.form1.anticipado[1].checked=='' ) {
      alert ("No ha seleccionado Termino Anticipado ");
      return false;
  }
   if (document.form1.multas[0].checked=='' && document.form1.multas[1].checked=='' ) {
      alert ("No ha seleccionado Multas ");
      return false;
  }
   if (document.form1.obs.value=='') {
      alert ("Observaciones presenta problemas ");
      return false;
  }

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }

  
}



function muestra1() {
       seccion2.style.display="";

}
function muestra2() {
       seccion2.style.display="none";

}

function meses() {
//  f1 = "03/02/2007";
//  f2 = "04/06/2008";
  f1 = document.form1.fecha2.value;
  f2 = document.form1.fecha3.value;

  aF1 = f1.split("-");
  aF2 = f2.split("-");

  numMeses = ((aF2[2]*12) + parseInt(aF2[1])) - ((aF1[2]*12) + parseInt(aF1[1]));

  if (aF2[0]<aF1[0]){
    numMeses = numMeses - 1;
  }
//  document.form1.duracion.value=numMeses;
//  alert(numMeses);
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
                    <td height="20" colspan="2"><span class="Estilo7">CREACIÓN DE NUEVO CONTRATO</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="100%" valign="top" class="Estilo1">
                         <a href="proveedores.php" class="link" target="_blank">Crear nuevo Proveedor</a>

                    <tr>
                         <td width="480" valign="top" class="Estilo1">

<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";

$id=$_GET["id"];
$id2=$_GET["id2"];
//  ------------ consulta orden de compra que cumple criterio -------------->

$sql="select * from compra_orden where oc_id=$id2";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$ocrsocial=$row["oc_rsocial"];
$ocmonto=$row["oc_monto"];
$ocrut=$row["oc_rut"];
$ocdig=$row["oc_dig"];

?>



                   <tr>
                    <td height="50" colspan="3">
                    
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
					  <form name="form1" action="grabacontrato.php" method="post"  onSubmit="return valida()">
                            <tr>
                             <td  valign="center" class="Estilo1" width="110"  >Rut Empresa  </td>
                             <td class="Estilo1" colspan=3 width="400" >
                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" value="<? echo $ocrut; ?>"> -
                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()" value="<? echo $ocdig; ?>">  Rut sin puntos
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Proveedor Adjudicado </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nombre" class="Estilo2" size="40" value="<? echo $ocrsocial; ?>">
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Id Licitación </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="licitacion" class="Estilo2" size="40" value="">
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Contrato </td>
                             <td class="Estilo1" colspan=3>
                              <textarea name="descripcion" rows="3" cols="25"><? echo $row["cont_nombre1"]; ?></textarea>
                             </td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1">Tipo de Contrato</td>
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
                             <td  valign="center" class="Estilo1">Fecha Inicio</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" readonly="1" >
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" onclick="meses();"/>

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c2",
        trigger    : "f_trigger_c2",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>


                             </td>
                           </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Término</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c3" readonly="1" onchange="meses();">
<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" onclick="meses();"/>

    <script type="text/javascript">//<![CDATA[
      Calendar.setup({
        inputField : "f_date_c3",
        trigger    : "f_trigger_c3",
        onSelect   : function() { this.hide() },
        showTime   : 12,
        dateFormat : "%d-%m-%Y"
      });
    //]]></script>


                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Duración</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="duracion" class="Estilo2" size="12" value="<? echo $row["cont_nroresolucion"]; ?>"  >Meses
                                <input type="hidden" name="contrato" class="Estilo2" size="40" value="<? echo $row["cont_contrato"]; ?>">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">¿Tiene Garantía? </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="garantia" class="Estilo1c" value="SI"  >Si  &nbsp;
                              <input type="radio" name="garantia" class="Estilo1c" value="NO" > No
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Monto total Contrato</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="total" class="Estilo2" size="20" value="<? echo $ocmonto; ?>">
                              <select name="moneda4" class="Estilo1">

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
                             <td  valign="center" class="Estilo1">Nº de Cuotas</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="nrocuotas" class="Estilo2" size="20" value="<? echo $row["cont_nroresolucion"]; ?>">

                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Reajustabilidad</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rea" class="Estilo2" size="20" value="<? echo $row["cont_nroresolucion"]; ?>">
                              <select name="moneda4" class="Estilo1">

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
                             <td  valign="center" class="Estilo1">Valor Cuota (Bruto) </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="vcuota" class="Estilo2" size="20" value="<? echo $row["cont_total"]; ?>">
                              <select name="moneda3" class="Estilo1">

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
                             <td  valign="center" class="Estilo1">Unidad que Genera Contrato  </td>
                             <td class="Estilo1" colspan=3>
                                  <select name="unidad" class="Estilo1">

                                 <?

                                 if($_SESSION["region"] == 14)
                {
                    $sql2 = "SELECT id,opcion FROM area WHERE codigo = 'SIAPERDEST' AND region = 14 ORDER BY opcion ASC";
                    echo '<option value="">Seleccionar...</option>';
                }else{
                    $sql2 = "SELECT id,opcion FROM area WHERE codigo = 'SIAPERREGDEST' AND region = 15 ORDER BY opcion ASC";
                    echo '<option value="">Seleccionar...</option>';
                }
//                                   if ($regionsession==0) {
//                                     $sql2 = "Select * from dpp_deptos2 order by depto_id";
//                                     echo '<option value="">Select...</option>';
//                                   } else
//                                    $cadena = strlen($regionsession);
//                                    if ($cadena==1) {
//                                        $where="SUBSTRING(num,1,1)='$regionsession' and character_length(num)=3 ";

//                                    } else {
//                                        $where="SUBSTRING(num,1,2)='$regionsession' and character_length(num)=4 ";
//                                    }

//                                    $sql2="select * from defensorias  where $where order by nombre";

// //                                    $sql2 = "Select * from defensorias where depto2_region=$regionsession";
//                                   //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   while($row2 = mysql_fetch_array($res2)){

                                 ?>
                                    <option value="<? echo $row2["id"] ?>"><? echo $row2["opcion"] ?></option>

                                 <?
                                   }
                                 ?>


                               </select>

                             </td>
                           </tr>
                           
                           <tr>
                             <td  valign="center" class="Estilo1c" colspan="2" align="center">Otras Claúsulas: </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Término Anticipado </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="anticipado" class="Estilo2" value="SI" <? if ($row["cont_anticipado"]=="SI") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="anticipado" class="Estilo2" value="NO" <? if ($row["cont_anticipado"]=="NO") echo "checked" ?>> No
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Aplicación de Multas </td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="multas" class="Estilo2" value="SI" <? if ($row["cont_multas"]=="si") echo "checked" ?>>Si  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" name="multas" class="Estilo2" value="NO" <? if ($row["cont_multas"]=="no") echo "checked" ?>> No
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Observaciones </td>
                             <td class="Estilo1" colspan=3>
                              <textarea name="obs" rows="3" cols="25"><? echo $row["cont_nombre1"]; ?></textarea>
                             </td>
                           </tr>



                             </table>
                             


                               <input type="hidden" name="id" value="<? echo $id ?>" >
                               <input type="hidden" name="id2" value="<? echo $id2 ?>" >






                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    PASO  2: Agregar Archivos y datos anexos    " > </td>
                           </tr>



                        </form>

                      </td>


                       <tr>
                       <td colspan="8"><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">

                         <table border=1 class="table table-striped" width="100%">
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
                                  <td class="Estilo1"><a href="contratosadjuntos.php?id=<? echo $row2["cont_id"]; ?>" class="link" >Editar</a></td>
                                  
                                  

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
