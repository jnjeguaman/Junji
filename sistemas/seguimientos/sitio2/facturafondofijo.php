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



$sql21 = "Select * from parametros";

$res21 = mysql_query($sql21);

$row21 = mysql_fetch_array($res21);

$mes21=$row21["para_mes"];

$ano21=$row21["para_anno"];



$ori=$_GET["ori"];

$id=$_GET["id"];

if ($ori==1 and $id<>'') {

     $sql="delete from ff_factura where fffac_id='$id' ";

//     echo $sql;

     mysql_query($sql);

}



?>

<html>

<head>

<title>CHEQUES CADUCADOS</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/estilos.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="librerias/jquery.blockUI.js"></script>
<link rel="stylesheet" type="text/css" href="../../inventario/privado/sitio2/css/font-awesome.min.css">
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

.Estilo7c {font-family: Geneva, Arial, Helvetica, sans-serif;

font-size: 12px;

font-weight: bold; }



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

            var Date = document.form1.nombre.value;

            var elem = Date.split('/');

            document.form1.nombre.value=elem[0];

//            document.form1.fpago.value = elem[1];

            if (elem[0]=='Proveedor No Existe') {

                alert("entra");

               document.getElementById("tipopersona2").style.visibility="visible";

//             document.getElementById("checkbox3").style.visibility="hidden";



            } else {

               document.getElementById("tipopersona2").style.visibility="hidden";

            }







		}

	}

}







function valida2() {

   if (document.form1.caja.value==0 ) {

      alert ("Nombre presenta problemas ");

      return false;

  }

   if (document.form1.responsable.value==0 ) {

      alert ("Responsable presenta problemas ");

      return false;

  }



   if (document.form1.region.value==0 ) {

      alert ("Region presenta problemas ");

      return false;

  }

   if (document.form1.fecha1.value=='') {

      alert ("Fecha Documento presenta problemas ");

      return false;

  }

  //  if (document.form1.fecha2.value=='') {

  //     alert ("Fecha Rendicion presenta problemas ");

  //     return false;

  // }



   if (document.form1.rut.value=='') {

      alert ("RUT presenta problemas ");

      return false;

  }

   if (document.form1.dig.value=='') {

      alert ("Digito Verificador presenta problemas ");

      return false;

  }

   if (document.form1.nombre.value=='') {

      alert ("Nombre Proveedor presenta problemas ");

      return false;

  }

  //  if (document.form1.idtesoreria.value=='') {

  //     alert ("ID Tesoreria presenta problemas ");

  //     return false;

  // }



  //  if (document.form1.nrocheque.value=='') {

  //     alert ("Nº Cheque presenta problemas ");

  //     return false;

  // }

   if (document.form1.nrofactura.value=='') {

      alert ("Nº Factura presenta problemas ");

      return false;

  }

if(document.form1.neto.value=='' && $("#tipodoc3:checked").val() != "FEX" && $("#tipodoc3:checked").val() != "FELEX")
{
  alert("Neto presenta problemas");
  return false;
}
if(document.form1.iva.value=='' && $("#tipodoc3:checked").val() != "FEX" && $("#tipodoc3:checked").val() != "FELEX")
{
  alert("Iva presenta problemas");
  return false;
}
   if (document.form1.monto.value=='') {

      alert ("Monto presenta problemas ");

      return false;

  }

  if(document.form1.tipodoc3[0].checked == '' && document.form1.tipodoc3[1].checked == '' && document.form1.tipodoc3[2].checked == '' && document.form1.tipodoc3[3].checked == '' && document.form1.tipodoc3[4].checked == '' && document.form1.tipodoc3[5].checked == '' && document.form1.tipodoc3[6].checked == '' && document.form1.tipodoc3[7].checked == '')
  {
    alert("Tipo documento presenta problemas");
    return false;
  }

  //  if (document.form1.archivo1.value=='') {

  //     alert ("Documento Adjunto presenta problemas ");

  //     return false;

  // }



  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
    blockUI();
  }
  else{
    return false;
  }


}



function exenta() {

    if (document.form1.neto.value!=0) {

      document.form1.iva.value='0';

      document.form1.monto.value=document.form1.monto.value;

      document.form1.exento.value=document.form1.monto.value;

      document.form1.neto.value='0';

    }

}

function noexenta() {

    if (document.form1.neto.value==0) {

      document.form1.neto.value=Math.round(document.form1.monto.value/1.19);

      document.form1.iva.value=Math.round(document.form1.neto.value*0.19);

      document.form1.monto.value=Math.round(document.form1.neto.value)+Math.round(document.form1.iva.value);

      document.form1.exento.value=0;

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
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO FACTURAS FONDO FIJO</span></td>
                  </tr>

                  <?php if (isset($_REQUEST["llave"])): ?>
          <tr>
            <?php if ($_REQUEST["llave"] == 1): ?>
              <td>Registros insertados con exito!</td>
            <?php endif ?>                    

            <?php if ($_REQUEST["llave"] == 2): ?>
              <td><font color="red">Ha ocurrido un error al ingresar el registro, Verifique la fecha de rendicion.</font></td>
            <?php endif ?>
          </tr>
        <?php endif ?>
        

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1c">



<?





?>

                         </td>

                      </tr>

                      <tr>

                        <td><a href="menucontabilidad3.php" class="link" > Volver </a></td>

                      </tr>



                       <tr>

                       <td><hr></td><td><hr></td>





                      </tr>



                   <tr>

             			<td height="50" colspan="3">

                   </table>

					<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <form name="form1" action="grabafacturafondofijo.php" method="post"  onSubmit="return valida2()"   enctype="multipart/form-data">

                         <tr>

                             <td  valign="top" class="Estilo1">Region</td>

                             <td class="Estilo1">

                                <select name="region" class="Estilo1">



                                 <?

                                  if ($regionsession==0) {

                                    $sql2 = "Select * from regiones ";

                                    echo '<option value="0">Todas</option>';

                                  } else

                                    $sql2 = "Select * from regiones where codigo=$regionsession";

                                  //echo $sql;

                                  $res2 = mysql_query($sql2);



                                   while($row2 = mysql_fetch_array($res2)){



                                 ?>

                                    <option value="<? echo $row2["codigo"] ?>" <? if ($row2["codigo"]==$region) echo "selected=selected" ?> ><? echo $row2["nombre"] ?></option>



                                 <?

                                   }

                                 ?>





                               </select>





                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Nombre Caja  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="caja" class="Estilo2" size="20"  >

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Responsable  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="responsable" class="Estilo2" size="20"  >

                             </td>

                           </tr>



                         <tr>

                             <td  valign="center" class="Estilo1">Fecha Rendicion</td>

                             <td class="Estilo1" valign="center">

                                <select name="dia" class="Estilo1">

                                    <option value="01" >01</option>

                                    <option value="02" >02</option>

                                    <option value="03" >03</option>

                                    <option value="04" >04</option>

                                    <option value="05" >05</option>

                                    <option value="06" >06</option>

                                    <option value="07" >07</option>

                                    <option value="08" >08</option>

                                    <option value="09" >09</option>

                                    <option value="10" >10</option>

                                    <option value="11" >11</option>

                                    <option value="12" >12</option>

                                    <option value="13" >13</option>

                                    <option value="14" >14</option>

                                    <option value="15" >15</option>

                                    <option value="16" >16</option>

                                    <option value="17" >17</option>

                                    <option value="18" >18</option>

                                    <option value="19" >19</option>

                                    <option value="20" >20</option>

                                    <option value="21" >21</option>

                                    <option value="22" >22</option>

                                    <option value="23" >23</option>

                                    <option value="24" >24</option>

                                    <option value="25" >25</option>

                                    <option value="26" >26</option>

                                    <option value="27" >27</option>

                                    <option value="28" >28</option>

                                    <option value="29" >29</option>

                                    <option value="30" >30</option>

                                    <option value="31" >31</option>

                               </select>





                          MES : <? echo $mes21."-".$ano21 ?>   </td>

                          <input type="hidden" name="mesanno" value="<? echo $mes21."-".$ano21 ?>">

                           </tr>



                         <tr>

                             <td  valign="center" class="Estilo1">Fecha Documento</td>

                             <td class="Estilo1" valign="center">

<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $row["eta_recepcion"]; ?>" id="f_date_c1" readonly="1">

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

                             <td  valign="center" class="Estilo1">Rut  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" > -

                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()">  Rut sin puntos

                             </td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1"><br>Nombre  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nombre" class="Estilo2" size="40" >

                             </td>

                           </tr>

                            <tr id="tipopersona2" style="visibility:hidden">

                             <td  valign="center" class="Estilo1">Tipo</td>

                             <td class="Estilo1" colspan=3>

                              <input type="radio" name="tipo" class="Estilo2" value="1" >Persona Natural

                              <input type="radio" name="tipo" class="Estilo2" value="2" >Personalidad Juridica

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1">ID Tesoreria </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="idtesoreria" class="Estilo2" size="20"  >

                             </td>

                           </tr>

                           

                            <tr>

                             <td  valign="center" class="Estilo1">Nº Cheque  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nrocheque" class="Estilo2" size="20"  >

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Servicio  </td>

                             <td class="Estilo1" colspan=3>

                             <textarea name="obs" rows="3" cols="40"></textarea>

                             </td>

                           </tr>



                           <tr>

                               <td><br></td>

                             </tr>



           			       <tr>

                             <td  valign="center" class="Estilo7c" colspan="4">DESGLOCE LIBRO DE COMPRAS:</td>



                             </td>

                           </tr>

                           <tr>

                               <td><hr></td><td><hr></td>

                             </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">Nº Factura </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nrofactura" class="Estilo2" size="20"  >

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1">NETO</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="neto" class="Estilo2r" size="10" value="<? echo $row5["eta_neto"]; ?>"  > <? echo number_format($row5["eta_neto"],0,',','.') ?>

                             </td>

                           </tr>





                            <tr>

                             <td  valign="center" class="Estilo1">IVA</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="iva" class="Estilo2r" size="10" value="<? echo $row5["eta_iva"]; ?>"  > <? echo number_format($row5["eta_iva"],0,',','.') ?>

                             </td>

                           </tr>







                            <tr>

                             <td  valign="center" class="Estilo1">TOTAL A PAGAR</td>

                             <td class="Estilo1" colspan=3>

                             <input type="text" name="monto" class="Estilo2r" size="10" value="<? echo $row5["fac_monto"] ?>"  > <? echo number_format($row5["fac_monto"],0,',','.') ?>



                           </tr>

                           <tr>

                               <td><hr></td><td><hr></td>

                             </tr>







                            <tr>

                             <td  valign="center" class="Estilo1">IMPUESTO ESPECIFICO COMBUSTIBLE</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="impuesto1" class="Estilo2r" size="10" value="<? echo $row5["eta_impuesto1"]; ?>"  > <? echo number_format($row5["eta_impuesto1"],0,',','.') ?>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">EXENTO</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="exento" class="Estilo2r" size="10" value="<? echo $row5["eta_exento"]; ?>"  > <? echo number_format($row5["eta_exento"],0,',','.') ?>

                             </td>

                           </tr>









                            <tr>

                             <td  valign="center" class="Estilo1">IMPUESTO ADICIONAL</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="impuesto2" class="Estilo2r" size="10" value="<? echo $row5["eta_impuesto2"]; ?>"  > <? echo number_format($row5["eta_impuesto2"],0,',','.') ?>

                             </td>

                           </tr>

                            <tr>

                               <td><hr></td><td><hr></td>

                             </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">TIPO DE DOCUMENTO A DECLARAR SII</td>

                             <td class="Estilo1" colspan=4>

                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="FAF" <? if($row5["eta_tipo_doc3"]=='FAF') echo 'checked' ?> onclick="noexenta();">Factura Afecta<br>
                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="FEX" <? if($row5["eta_tipo_doc3"]=='FEX') echo 'checked' ?> onclick="exenta();">Factura Exenta<br>
                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="FEL" <? if($row5["eta_tipo_doc3"]=='FEL') echo 'checked' ?> onclick="noexenta();">Factura Electrónica<br>
                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="FELEX" <? if($row5["eta_tipo_doc3"]=='FELEX') echo 'checked' ?>  onclick="exenta();">Factura Electrónica Exenta<br>
                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="NC" <? if($row5["eta_tipo_doc3"]=='NC') echo 'checked' ?> onclick="noexenta();">Nota de Crédito<br>
                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="NCEL" <? if($row5["eta_tipo_doc3"]=='NCEL') echo 'checked' ?> onclick="noexenta();">Nota de Crédito Electronica<br>
                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="ND" <? if($row5["eta_tipo_doc3"]=='ND') echo 'checked' ?> onclick="noexenta();">Nota de Débito<br>
                              <input type="radio" id="tipodoc3" name="tipodoc3" class="Estilo2" value="NDEL" <? if($row5["eta_tipo_doc3"]=='NDEL') echo 'checked' ?> onclick="noexenta();">Nota de Débito Electrónica<br>





                             </td>

                           </tr>





                            <tr>

                             <td  valign="center" class="Estilo1">Imagen del Documento</td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>

                              <a href="documentocaducado/<? echo $row3["provee_archivo1"]; ?>" class="link" target="_blank"><? echo $row3["provee_archivo1"]; ?></a>

                             </td>

                           </tr>





                       <tr>

                       <td><hr></td><td><hr></td>

                    </table>

                     <tr>

                       <td><Br></td>

                      </tr>



                             <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR  FACTURA   " > </td>

                           </tr>











                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      

                      

                         <table border=1>

                             <tr>

                               <td class="Estilo1">FECHA DOC.</td>

                               <td class="Estilo1">RUT</td>

                               <td class="Estilo1">NOMBRE</td>

                               <td class="Estilo1">Nº Documento</td>

                               <td class="Estilo1">Monto</td>

                               <td class="Estilo1">Eliminar</td>

                              </tr>

<?

     $sql="select * from ff_factura where fffac_region='$regionsession' order by fffac_id desc";

//     echo $sql;

     $res2 = mysql_query($sql);

     while ($row2 = mysql_fetch_array($res2)) {



?>

    <tr>

      <td  class="Estilo1" width="70"><? echo substr($row2["fffac_fechadoc"],8,2)."-".substr($row2["fffac_fechadoc"],5,2)."-".substr($row2["fffac_fechadoc"],0,4)   ?></td>

      <td  class="Estilo1"><? echo number_format($row2["fffac_rut"],0,',','.')."-".$row2["fffac_dig"]; ?></td>

      <td  class="Estilo1"><? echo $row2["fffac_nombre"]; ?></td>

      <td  class="Estilo1"><? echo $row2["fffac_numero"]; ?></td>

      <td  class="Estilo1"><? echo number_format($row2["fffac_total"],0,',','.'); ?> </td>

<?

if ((substr($row2["fffac_fechadoc"],5,2)==$mes21) or 1==1) {

?>

      <td class="Estilo11"><a href="facturafondofijo.php?id=<? echo $row2["fffac_id"] ?>&ori=1" class="link" onclick="return confirm('Seguro que desea Borrar o Eliminar?')">Eliminar</a></td>

<?

 } else {

     echo " <td  class='Estilo1'></td>";

 }

?>

    </tr>

 <?

}

 ?>









                         </table>



                      <tr>

                      <td colspan="8">



                      <table border=1>

<tr></tr>







                      <tr>



                        











</td>

  </tr>





</table>



<img src="images/pix.gif" width="1" height="10">

</body>

</html>



<?



?>





