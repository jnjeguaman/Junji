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
?>
<html>
<head>
<title>Facturas y/o Boletas</title>
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
.Estilo7 {font-size: 12px; font-weight: bold; }
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
            nombre2.innerText=ajax.responseText;

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

   if (document.form1.nombre.value=='0' || document.form1.nombre.value=='') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.numero.value=='0' || document.form1.numero.value=='') {
      alert ("Numero Factura presenta problemas ");
      return false;
  }
   if (document.form1.monto.value=='0' || document.form1.monto.value=='') {
      alert ("Total factura presenta problemas ");
      return false;
  }


  
}
//-->

</script>

<body>
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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE FACTURAS Y/O BOLETAS DE SERVICIOS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                         <a href="mantenedor/" class="link" target="_blank">Crear nuevo Proveedor</a>
<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";
?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>


                   <tr>
                    <td height="50" colspan="3">
                    
					<table width="488" border="0" cellspacing="0" cellpadding="0">
					  <form name="form1" action="grabafactura.php" method="post"  onSubmit="return valida()">
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Recepcion</td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c1" readonly="1">
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
                             <td  valign="center" class="Estilo1">Fecha Factura</td>
                             <td class="Estilo1">
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" readonly="1">
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
                             <td  valign="center" class="Estilo1">Tipo de Doc.</td>
                             <td class="Estilo1" colspan=3>
                              <input type="radio" name="tipodoc" class="Estilo2" value="f" >Factura  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="b" > Boleta Servicio
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" > -
                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()">  Rut sin puntos
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1"><br>Nombre  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="hidden" name="nombre" class="Estilo2" size="40" >
                              <label id="nombre2"></label>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br> Nº Factura  </td>
                             <td class="Estilo1" colspan=3><br>
                              <input type="text" name="numero" class="Estilo2" size="11" onchange="traerDatos2()" >
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Total a Pagar </td>
                             <td class="Estilo1" colspan=3>
                              $<input type="text" name="monto" class="Estilo2" size="11"  >
                             </td>
                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1">  </td>
                               <td  valign="center" class="Estilo1">Los Valores no deben ser ingresados con puntos y comas </td>

                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br><br><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR FACTURA    " > </td>
                           </tr>



                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">
                         <table border=1>
                             <tr>
                               <td class="Estilo1">Folio</td><td class="Estilo1">Rut</td><td class="Estilo1" width="10">Nombre</td><td class="Estilo1" width="30">Monto</td><td class="Estilo1">Numero</td><td class="Estilo1">Fecha_Recepcion</td>
                              </tr>

                              <?


                                  $sql2 = "Select * from dpp_facturas where fac_usu_recepcion='$usuario' order by fac_id desc limit 0,10";
                                  //echo $sql2;
                                  $res2 = mysql_query($sql2);
                                   $cont=1;
                                   while($row2 = mysql_fetch_array($res2)){
                              ?>
                                  <tr>
                                  <td class="Estilo1"><? echo $row2["fac_folio"] ?> </td>
                                  <td class="Estilo1"><? echo $row2["fac_rut"] ?></td>
                                  <td class="Estilo1"><? echo $row2["fac_cli_nombre"] ?></td>
                                  <td class="Estilo1d"><? echo $row2["fac_monto"] ?></td>
                                  <td class="Estilo1d"><? echo $row2["fac_numero"] ?></td>
                                  <td class="Estilo1"><? echo substr($row2["fac_fecha_recepcion"],8,2)."-".substr($row2["fac_fecha_recepcion"],5,2)."-".substr($row2["fac_fecha_recepcion"],0,4) ?></td>
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
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
                      <tr>
                      <td><br></tr>
                      </tr>
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
