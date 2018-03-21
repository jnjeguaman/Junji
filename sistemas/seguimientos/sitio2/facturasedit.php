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
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 8px;
	color: #003063;
	text-align: right;
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
   if (document.form1.region.value==0 || document.form1.region.value=='') {
      alert ("Region presenta problemas ");
      return false;
  }

   if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.nombre.value=='' || document.form1.nombre.value=='Proveedor No Existe') {
      alert ("Nombre presenta problemas ");
      return false;
  }
   if (document.form1.numero.value=='0' || document.form1.numero.value=='') {
      alert ("Número Factura presenta problemas ");
      return false;
  }
   if (document.form1.numero.value <= 0) {
      alert ("Número Factura debe ser positivo ");
      return false;
  }

   if (document.form1.monto.value=='0' || document.form1.monto.value=='') {
      x=document.form1.numero.value;
      alert ("Total factura presenta problemas "+ x);
      return false;
  }
   if (document.form1.tipodoc[0].checked=='' && document.form1.tipodoc[1].checked==''  && document.form1.tipodoc[2].checked=='') {
      alert ("No ha seleccionado Tipo de Documento ");
      return false;
  }


  
}
//-->

</script>

<body>
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
                    <td height="20" colspan="2"><span class="Estilo7">MODIFICACION DE FACTURAS Y/O BOLETAS DE SERVICIOS</span></td>
                  </tr>
<tr>
                             <td  valign="top" class="Estilo1" colspan="4"><a href="verdevueltos.php" class="link" >VOLVER </a><br>  </td>
                           </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    
<tr>
                         <td width="487" valign="top" class="Estilo1c">
                         
<?

if (isset($_GET["llave"]))
 echo "<p>Registros modificado con Exito !";
 
  $id=$_GET["id2"];
  $sql="select * from dpp_etapas x, dpp_facturas y where x.eta_id=$id and x.eta_id=y.fac_eta_id";
//  echo $sql;
  $res3 = mysql_query($sql);
  $cont=1;

  $row3 = mysql_fetch_array($res3);
 
 
?>
                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>

                   <tr>
             			<td height="50" colspan="3">
                    </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="modfactura.php" method="post"  onSubmit="return valida()" enctype="multipart/form-data">
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="4"></td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="4"><br>  </td>
                           </tr>




<tr>
                             <td  valign="center" class="Estilo1">Fecha Recepción Of. Partes</td>
                             <td class="Estilo1" valign="center">
                            
                            <?
//                            echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)
$fecha_fac1= substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4);
                            ?>
                            
<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $fecha_fac1; ?>" id="f_date_c1" >
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
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">
                                 <?
                                  $codregion=$row3["eta_region"];
                                  $sql2 = "Select * from regiones where codigo=$codregion";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);
                                  $row2 = mysql_fetch_array($res2);
                                  echo $row2["nombre"];
                                 ?>


                             </td>
                        </tr>
                            <tr>
                           <td  valign="center" class="Estilo1">Tipo de Documento</td>
                             <td class="Estilo1" colspan=3>
                              <?
                              $tipodoc=$row3["eta_tipo_doc2"];

                              if ($tipodoc=="f") {
                                  $nombredoc="Factura / Factura Electrónica ";
                              }
                              if ($tipodoc=="b") {
                                  $nombredoc="Boleta Servicio ";
                              }
                              if ($tipodoc=="r") {
                                  $nombredoc="Recibo ";
                              }
                              echo $nombredoc;

                              ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row3["eta_rut"]."-".$row3["eta_dig"]; ?>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Nombre  </td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row3["eta_cli_nombre"]; ?>
                           </td>
                           </tr>
                     <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
                          <tr>
                            <td  valign="center" class="Estilo1">Tipo de Documento</td>
                            <td class="Estilo1" colspan=4>
                              <input type="radio" name="tipodoc" class="Estilo2" value="f" <? if ($tipodoc=="f") { echo "checked"; } ?> >Factura / Factura Electrónica <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="b" <? if ($tipodoc=="b") { echo "checked"; } ?> > Boleta Servicio  <br>
                              <input type="radio" name="tipodoc" class="Estilo2" value="r" <? if ($tipodoc=="r") { echo "checked"; } ?> > Recibo <br>
			                  <input type="radio" name="tipodoc" class="Estilo2" value="n" <? if ($tipodoc=="n") { echo "checked"; } ?> > Nota de Crédito <br>
			                  <input type="radio" name="tipodoc" class="Estilo2" value="d" <? if ($tipodoc=="d") { echo "checked"; } ?> > Nota de Débito <br>
			                  <input type="radio" name="tipodoc" class="Estilo2" value="bh" <? if ($tipodoc=="bh") { echo "checked"; } ?>  > Boleta de Honorario <br>

                             </td>
                           </tr>

                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Documento</td>
                             <td class="Estilo1">
<?
$fecha_fac2= substr($row3["eta_fecha_fac"],8,2)."-".substr($row3["eta_fecha_fac"],5,2)."-".substr($row3["eta_fecha_fac"],0,4);
?>
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha_fac2; ?>" id="f_date_c2" >
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
                             <td  valign="center" class="Estilo1"> Nº Documento  </td>
                             <td class="Estilo1" colspan=3>
                              <input type="hidden" name="rut" class="Estilo2" size="11" onchange="limpiar()" value="<? echo $row3["eta_rut"]; ?>">
                              <input type="text" name="numero" class="Estilo2" size="11" onchange="traerDatos2()" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  value="<? echo $row3["eta_numero"]; ?>">
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Total a Pagar $</td>
                             <td class="Estilo1" colspan=3>
                              <input type="text" name="monto" class="Estilo2" size="11" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"    value="<? echo $row3["eta_monto"]; ?>"   >
                             </td>
                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1">  </td>
                               <td  valign="center" class="Estilo1">Los Valores no deben ser ingresados con puntos y comas </td>

                           </tr>
                           
                            <tr>
                             <td  valign="center" class="Estilo1">Imagen de Factura </td>
                             <td class="Estilo1" colspan=3>
                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>
<?
 if ($row3["fac_archivo"]<>'' ) {
?>

                              <a href="../../archivos/docfac/<? echo $row3["fac_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank">Ver Documento</a>
                              <input type="hidden" name="archivo111" value="<? echo $row3["fac_archivo"]; ?>"  >
<!--
                                <a href="borradocs.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>&doc=1" class="link" onclick="return confirm('Seguro Desasociar Borrar el Archivo ?')" title="Borrar"><img src="imagenes/b_drop.png" border=0></a>
-->
<?
}
?>
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
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"> <input type="submit" value="    MODIFICAR FACTURA    " > </td>
                           <input type="hidden" name="id" class="Estilo2" size="11" value="<? echo $row3["eta_id"]; ?>">
                           </tr>



                        </form>

                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
                      </tr>
                      


                      <tr>
                      <td colspan="8">
                      <table border=1>

<br>



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
