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

?>

<html>

<head>
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="facturas_antecedente.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">

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

.Estilo1ce {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: center;

}

.Estilo1le {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

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





    <style type="text/css">

    input[type=range]

    {

        padding-left: 0px;

        padding-right: 0px;

    }

    </style>

    <script type="text/javascript">

      function abreVentana(){

  miPopup = window.open("facturas_antecedente.php","miwin","width=600,height=300,scrollbars=yes,toolbar=0")

  miPopup.focus()

}


        function changeValue() {

            document.getElementById("progCtrl").value = document.getElementById("rangeCtrl").value;

        }

        document.addEventListener('DOMContentLoaded', function () {

            document.getElementById("rangeCtrl").addEventListener('change', changeValue, false);

        }, false);

    </script>

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

    //alert (" dato "+tipoDato);

 	ajax.open("POST", "buscaclient.php", true);

	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	ajax.send("d="+tipoDato);



	ajax.onreadystatechange=function()	{

		if (ajax.readyState==4) {

			// Respuesta recibida. Coloco el texto plano en la capa correspondiente

			//capa.innerHTML=ajax.responseText;

            //alert (" dato "+ajax.responseText);

			document.form1.nombre.value=ajax.responseText;

            var Date = document.form1.nombre.value;

            var elem = Date.split('/');

            nombre2.innerText=elem[0];

            document.form1.nombre.value=elem[0];

            document.form1.fpago.value = elem[1];







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

                  alert ("Numero de Documento Existe para este proveedor ");

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

  if(document.form1.oc.value==0 || document.form1.oc.value=='')
  {
    //alert("Ingrese la orden de comora ");
    //return false;
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

      alert ("N�mero Factura presenta problemas ");

      return false;

  }

   if (document.form1.numero.value <= 0) {

      alert ("N�mero Factura debe ser positivo ");

      return false;

  }



   if (document.form1.monto.value=='0' || document.form1.monto.value=='') {

      x=document.form1.numero.value;

      alert ("Total factura presenta problemas "+ x);

      return false;

  }

   if (document.form1.tipodoc[0].checked=='' && document.form1.tipodoc[1].checked==''  && document.form1.tipodoc[2].checked=='' && document.form1.tipodoc[3].checked=='' && document.form1.tipodoc[4].checked=='' && document.form1.tipodoc[5].checked=='') {

      alert ("No ha seleccionado Tipo de Documento ");

      return false;

  }



  if(confirm('� EST� SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }

  

}

//-->


function validaGeneraguia() {

  if(confirm('� EST� SEGURO DE PROCEDER CON LA GENERACI�N DE GU�A ?')) {
      blockUI();
    }
    else{
      return false;
    }
}


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

                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE FACTURAS Y/O BOLETAS</span></td>

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

                       <td><hr></td><td><hr></td>





                      </tr>

<?

$sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession'";

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

?>





                   <tr>

             			<td height="50" colspan="3">

               </table>

					<table width="100%" border="0" cellspacing="0" cellpadding="0">



				  <form name="form1" action="grabafactura.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">

                           <tr>

                             <td  valign="top" class="Estilo1" colspan="4"><a href="verdevueltos.php" class="link" >Editar(<? echo $totaldevueltos ?>)</a><br>  </td>

                           </tr>

                           <tr>

                             <td  valign="top" class="Estilo1" colspan="4"><br>  </td>

                           </tr>



<tr class="Estilo8"><td colspan="4">PASO 1: INGRESO DE DOCUMENTO<td></tr>





<tr>

                             <td  valign="center" class="Estilo1">Fecha Recepci�n Of. Partes</td>

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

    </script>







                             </td>

                           </tr>

                          <tr><td><br></td><tr>

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

                            <tr><td><br></td><tr>

                         <tr>

                             <td  valign="center" class="Estilo1">Fecha Documento</td>

                             <td class="Estilo1">

<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $date_in ?>" id="f_date_c2" >

<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"

      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



    <script type="text/javascript">//<![CDATA[

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

                       <td><hr></td><td><hr></td>

                      </tr>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Tipo de Documento</td>

                             <td class="Estilo1" colspan=4>

                              <input type="radio" name="tipodoc" class="Estilo2" value="f" >Factura / Factura Electr�nica <br>

                              <input type="radio" name="tipodoc" class="Estilo2" value="b" > Boleta Servicio  <br>

                              <input type="radio" name="tipodoc" class="Estilo2" value="r" > Recibo <br>

			                  <input type="radio" name="tipodoc" class="Estilo2" value="n" > Nota de Cr�dito <br>

			                  <input type="radio" name="tipodoc" class="Estilo2" value="d" > Nota de D�bito <br>

			                  <input type="radio" name="tipodoc" class="Estilo2" value="bh" > Boleta de Honorario <br>

                             </td>

                           </tr>

                  <tr>

                       <td><hr></td><td><hr></td>





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

                             <td  valign="center" class="Estilo1"><br>Orden de Compra  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="oc" id="oc" class="Estilo2" size="15" placeholder="XXX-XXX-XXXX">

                              <label id="nombre22"></label>

                             </td>

                           </tr>
                           
                            <tr>

                             <td  valign="center" class="Estilo1"><br> N� Documento  </td>

                             <td class="Estilo1" colspan=3><br>





                              <!-- <input type="text" name="numero" class="Estilo2" size="11" onchange="traerDatos2()" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  > -->
                              <input type="text" name="numero" class="Estilo2" size="11" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  onchange="traerDatos2()">

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Total a Pagar $</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="monto" class="Estilo2" size="11" onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"       >

                              <select name="moneda" class="Estilo1">



                                 <?

                                    $sql2 = "Select * from dpp_monedas ";

                                  $res2 = mysql_query($sql2);



                                   while($row2 = mysql_fetch_array($res2)){



                                 ?>

                                    <option value="<? echo $row2["mone_tipo"] ?>"><? echo $row2["mone_tipo"] ?></option>



                                 <?

                                   }

                                 ?>





                               </select>



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
                             </td>
                           </tr>

                           <?php if ($regionsession == 14): ?>
                             <tr>
                             <td class="Estilo1">Otros Antecedentes</td>
                             <td class="Estilo1">
                              <a href="#" class="link" onclick="abreVentana()">Subir</a>
                              
                              <div id="contenido">

                              <div name="timediv" id="timediv">

                              </div>

                            </div>
                              
                              </td>
                           </tr>
                           <?php endif ?>


                           <tr>

                               <td  valign="center" class="Estilo1"><br>  </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>



                           <tr>

                               <td  valign="center" class="Estilo1"><br> </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>

                           <tr>

                             <td colspan=4 align="center" class="Estilo7">�ltimo Correlativo : <? echo $foliomio ?>, el pr�ximo es : <? echo $foliomio2 ?> </td>

                           </tr>

                           <tr>

                               <td  valign="center" class="Estilo1"><br>  </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>



                           <tr>

                             <td colspan=4 align="center"> <input type="submit"  class="btn btn-primary" value="    GRABAR FACTURA    " > </td>

                           </tr>



                            <input type="hidden" name="fpago" >



                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">

                      <table border=0 class="table table-striped">



<br>





<tr class="Estilo8">PASO 2: CONFECCI�N GU�A DESPACHO INTERNO</tr> 



<?

  $sql21="select max(eta_folioguia) as foliomio from dpp_etapas where eta_region='$regionsession' ";

//  echo $sql21;

  $result21=mysql_query($sql21);

  $row21=mysql_fetch_array($result21);

  $foliomio=$row21["foliomio"];

  $foliomio=$foliomio+1;

  



?>

                        <tr>

                         <td class="Estilo1" colspan=4></td>

                        </tr>





                        <tr>

                         <td class="Estilo1" colspan=4>

                      <form name="form2" action="grabaasignaguia.php" method="post" onsubmit="return validaGeneraguia()" >



          <tr>

                             <td  valign="center" class="Estilo1" colspan=8>Destinatario

                                <input type="text" name="destinatario" class="Estilo2" size="50" required>

                              </td>





                           </tr>







                        <tr>

                         <td class="Estilo1ce">Arch.</td>

                         <td class="Estilo1ce">Item</td>

                         <td class="Estilo1ce">Nombre </td>

                         <td class="Estilo1ce">Tipo Documento</td>

                         <td class="Estilo1ce">Fecha Documento</td>

                         <td class="Estilo1ce">Monto</td>

                         <td class="Estilo1ce">N� Documento</td>

                         <td class="Estilo1ce">Fecha Recepci�n</td>

                         <td class="Estilo1ce">Folio</td>

                        </tr>



<?



$sql5="select * from dpp_plazos ";

//echo $sql;

$res5 = mysql_query($sql5);

$row5 = mysql_fetch_array($res5);

$etapa1a=$row5["pla_etapa1a"];

$etapa1b=$row5["pla_etapa1b"];

$etapa2a=$row5["pla_etapa2a"];

$etapa2b=$row5["pla_etapa2b"];





if ($regionsession==0) {

     $sql="select * from dpp_etapas where  eta_estado=1 and eta_folioguia=0 order by eta_folio desc";

} else {

     $sql="select * from dpp_etapas x, dpp_facturas y where x.eta_estado=1 and x.eta_folioguia=0 and x.eta_region='$regionsession' and x.eta_id=y.fac_eta_id order by x.eta_folio desc";

}





//echo $sql;

$res3 = mysql_query($sql);

$cont=1;



while($row3 = mysql_fetch_array($res3)){

    $fechahoy = $date_in2;

    $dia1 = strtotime($fechahoy);

    $fechabase =$row3["eta_fecha_recepcion"];

    $dia2 = strtotime($fechabase);

    $diff=$dia1-$dia2;

    $diff=intval($diff/(60*60*24));

    if ($etapa1a>=$diff)

       $clase="Estilo1cverde";

    if ($etapa1a<$diff and $etapa1b>=$diff )

      $clase="Estilo1camarrillo";

    if ( $etapa1b<$diff)

      $clase="Estilo1crojo";



      $tipodoc=$row3["eta_tipo_doc"];

      $tipodoc2=$row3["eta_tipo_doc2"];

    if ($tipodoc2=="f") {

        $tipodoc3="Factura";

    }

    if ($tipodoc2=="b") {

        $tipodoc3="Boleta Servicio";

    }

    if ($tipodoc2=="") {

        $tipodoc3="Honorario";

}

    if ($tipodoc2=="r") {

        $tipodoc3="Recibo";

    

    }

    if ($tipodoc2=="d") {

        $tipodoc3="Nota de D�bito";

    

    }

    if ($tipodoc2=="n") {

        $tipodoc3="Nota de Cr�dito";



    }

    if ($tipodoc2=="bh") {

        $tipodoc3="Boleta de Honorario";



    }





    $read1= rand(0,1000000);

?>





                       <tr>

                         <td class="Estilo1">

                            <? echo $row2["boleg_folio"] ?>

                                <a href="../../archivos/docfac/<? echo $row3["fac_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><img src="images/attach.gif" width="8" height="14"></a>

                         </td>

                         <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" >  </td>

                         <td class="Estilo1le"><? echo $row3["eta_cli_nombre"]  ?> </td>

                         <td class="Estilo1ce"><? echo $tipodoc3  ?> </td>

                         <td class="Estilo1ce"><? echo substr($row3["eta_fecha_fac"],8,2)."-".substr($row3["eta_fecha_fac"],5,2)."-".substr($row3["eta_fecha_fac"],0,4)   ?></td>



                         <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>



                         <td class="Estilo1c"><? echo $row3["eta_numero"]  ?> </td>

                         <td class="<? echo $clase ?>"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>

                         <td class="Estilo1c"><? echo $row3["eta_folio"]  ?></td>

                       </tr>











<?



   $cont++;



}

?>

                           <tr>

                             <td  valign="center" class="Estilo1" colspan=4 align="center">

                             <input type="submit" name="boton" class="btn btn-primary" value="  Generar Gu�a ">

                             </td>





                       <input type="hidden" name="cont" value="<? echo $cont ?>" >

                       <input type="hidden" name="sw2" value="1" >

                      </form>

                           </tr>







                      <tr>

                       <tr>

                       

                      </tr>





                      <table border=1 class="table-responsive">

<tr></tr>





<br>

<tr class="Estilo8">PASO 3: IMPRIMIR GU�A DESPACHO INTERNO</tr> 



                        <tr>

                         <td class="Estilo1b">N� de Gu�a</td>

                         <td class="Estilo1b">Nombre Destinatario</td>

                         <td class="Estilo1b">Fecha Gu�a</td>

                         <td class="Estilo1b">Ver Gu�a</td>

                        </tr>

<?



  $sql="select * from dpp_etapas where  eta_region='$regionsession' and eta_folioguia<>0 group by eta_folioguia order by eta_folioguia desc LIMIT 0 , 10 ";



//echo $sql;

$res3 = mysql_query($sql);

$cont=1;



while($row3 = mysql_fetch_array($res3)){

    $fechahoy = $date_in;

    $dia1 = strtotime($fechahoy);

    $fechabase =$row3["eta_fecha_recepcion"];

    $dia2 = strtotime($fechabase);

    $diff=$dia1-$dia2;

    $diff=intval($diff/(60*60*24));

    if ($etapa1a>=$diff)

      $clase="Estilo1cverde";

    if ($etapa1a<$diff and $etapa1b>=$diff )

      $clase="Estilo1camarrillo";

    if ( $etapa1b<$diff)

      $clase="Estilo1crojo";



?>





                       <tr>

                         <td class="Estilo1b"><? echo $row3["eta_folioguia"] ?> </td>

                         <td class="Estilo1b" title="<? echo $row3["eta_destinatario"]  ?>"><? echo $row3["eta_destinatario"]  ?></td>

                         <td class="Estilo1b" title="<? echo $row3["eta_fechaguia"]  ?>"><? echo $row3["eta_fechaguia"]  ?></td>

                         <td class="Estilo1c"><a href="imprimirguia.php?guia=<? echo $row3["eta_folioguia"] ?>" class="link" target="_blank">IMPRIMIR</a></td>



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



<?



?>

