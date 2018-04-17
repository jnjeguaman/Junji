<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$nivel = $_SESSION["pfl_user"];

$regionsession = $_SESSION["region"];

if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}

$date_in=date("Y-m-d");

?>

<html>

<head>

<title>Honorarios</title>

<link href="../../seguimientos/sitio2/librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript" src="../../seguimientos/sitio2/librerias/bootstrap/js/bootstrap.min.js"></script>

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

.Estilo7 {

font-family: Verdana; 

font-size: 12px; 

font-weight: bold; 

}

tfoot input {
  width: 120px;
}

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

  function aparece(){

     if (document.form1.commodity.value == 'Other') {

       document.form1.specifications.style.display='';

     } else {

       document.form1.specifications.style.display='none';

     }

     if (document.form1.commodity.value == 'Fishmeal') {

       seccion1.style.display="";

     } else {

       seccion1.style.display="none";

    }

     if (document.form1.commodity.value == 'Fishoil') {

       seccion2.style.display="";

     } else {

       seccion2.style.display="none";

    }

 }

 

  function aparece2(){

     if (document.form1.cantidad.value == 1) {

       seccion12.style.display="none";

       seccion13.style.display="none";

       seccion14.style.display="none";

       seccion15.style.display="none";

       seccion16.style.display="none";

     }

     if (document.form1.cantidad.value == 2) {

       seccion12.style.display="";

       seccion13.style.display="none";

       seccion14.style.display="none";

       seccion15.style.display="none";

       seccion16.style.display="none";



     }

     if (document.form1.cantidad.value == 3) {

       seccion12.style.display="";

       seccion13.style.display="";

       seccion14.style.display="none";

       seccion15.style.display="none";

       seccion16.style.display="none";



     }

     if (document.form1.cantidad.value == 4) {

       seccion12.style.display="";

       seccion13.style.display="";

       seccion14.style.display="";

     }

     if (document.form1.cantidad.value == 5) {

       seccion12.style.display="";

       seccion13.style.display="";

       seccion14.style.display="";

       seccion15.style.display="";

       seccion16.style.display="none";



     }

     if (document.form1.cantidad.value == 6) {

       seccion12.style.display="";

       seccion13.style.display="";

       seccion14.style.display="";

       seccion15.style.display="";

       seccion16.style.display="";



     }



 }

 function calcula1(){

     document.form1.retencion1.value=Math.round(document.form1.bruto1.value * 10 / 100) ;

     document.form1.liquido1.value= Math.round(document.form1.bruto1.value)- Math.round(document.form1.retencion1.value);

 }

 function calcula2(){

     document.form1.retencion2.value=Math.round(document.form1.bruto2.value * 10 / 100) ;

     document.form1.liquido2.value= Math.round(document.form1.bruto2.value)- Math.round(document.form1.retencion2.value);

 }

 function calcula3(){

     document.form1.retencion3.value=Math.round(document.form1.bruto3.value * 10 / 100) ;

     document.form1.liquido3.value= Math.round(document.form1.bruto3.value)- Math.round(document.form1.retencion3.value);

 }

 function calcula4(){

     document.form1.retencion4.value=Math.round(document.form1.bruto4.value * 10 / 100) ;

     document.form1.liquido4.value= Math.round(document.form1.bruto4.value)- Math.round(document.form1.retencion4.value);

 }

 function calcula5(){

     document.form1.retencion5.value=Math.round(document.form1.bruto5.value * 10 / 100) ;

     document.form1.liquido5.value= Math.round(document.form1.bruto5.value)- Math.round(document.form1.retencion5.value);

 }

 function calcula6(){

     document.form1.retencion6.value=Math.round(document.form1.bruto6.value * 10 / 100) ;

     document.form1.liquido6.value= Math.round(document.form1.bruto6.value)- Math.round(document.form1.retencion6.value);

 }





 



</script>

<script language="javascript">

<!--

function limpiar() {

    document.form1.dig.value="";

    document.form1.nombre.value="";

    nombre2.innerText="";

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

function vaciorut() {

    if (document.form1.rut.value=='') {

        document.form1.nboleta1.value=''

        document.form1.nboleta2.value=''

        document.form1.nboleta3.value=''

        document.form1.nboleta4.value=''

        document.form1.nboleta5.value=''

        document.form1.nboleta6.value=''

    }

}



function traerDatos2(a,b,c)  {

    vaciorut();

	var ajax=nuevoAjax();

    tipoDato1=a;

    tipoDato2=b;

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

                  alert ("Numero de Boleta Existe Para esta proveedor "+c);

//                  document.form1.nboleta1.value=ajax.responseText;

                    document.getElementById(c).value =ajax.responseText;

//                    document.getElementById(c).value =0;



            }



		}

	}



}



function valida() {

    if (document.form1.rut.value=='') {

        document.form1.nboleta1.value=''

        document.form1.nboleta2.value=''

        document.form1.nboleta3.value=''

        document.form1.nboleta4.value=''

        document.form1.nboleta5.value=''

        document.form1.nboleta6.value=''

    }



   if (document.form1.rut.value==0 || document.form1.rut.value=='') {

      alert ("Rut presenta problemas ");

      return false;

  }

   if (document.form1.dig.value=='') {

      alert ("Dig presenta problemas ");

      return false;

  }

   if (document.form1.nboleta1.value==0 || document.form1.nboleta1.value=='') {

      alert ("Numero de Boleta 1 Presenta problemas ");

      return false;

  }



   if (document.form1.cantidad.value>=2 && (document.form1.nboleta2.value==0 || document.form1.nboleta2.value=='')) {

      alert ("Numero de Boleta 2 Presenta problemas ");

      return false;

  }

   if (document.form1.cantidad.value>=3 && (document.form1.nboleta3.value==0 || document.form1.nboleta3.value=='')) {

      alert ("Numero de Boleta 3 Presenta problemas ");

      return false;

  }

   if (document.form1.cantidad.value>=4 && (document.form1.nboleta4.value==0 || document.form1.nboleta4.value=='')) {

      alert ("Numero de Boleta 4 Presenta problemas ");

      return false;

  }

   if (document.form1.cantidad.value>=5 && (document.form1.nboleta5.value==0 || document.form1.nboleta5.value=='')) {

      alert ("Numero de Boleta 5 Presenta problemas ");

      return false;

  }

   if (document.form1.cantidad.value>=6 && (document.form1.nboleta6.value==0 || document.form1.nboleta6.value=='')) {

      alert ("Numero de Boleta 6 Presenta problemas ");

      return false;

  }

   if (document.form1.codigo.value==0 || document.form1.codigo.value=='') {

      alert ("Egreso presenta problemas ");

      return false;

  }

   if (document.form1.dia.value==0 || document.form1.dia.value=='') {

      alert ("dia presenta problemas ");

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



   if (document.form1.item[0].checked=='' && document.form1.item[1].checked=='' && document.form1.item[2].checked=='' && document.form1.item[3].checked=='' && document.form1.item[4].checked==''  && document.form1.item[5].checked=='' && document.form1.item[6].checked=='') {

      alert ("No ha seleccionado Subtitulos ");

      return false;

  }



  if (document.form1.nboleta1.value!='' && (document.form1.nboleta1.value==document.form1.nboleta2.value || document.form1.nboleta1.value==document.form1.nboleta3.value || document.form1.nboleta1.value==document.form1.nboleta4.value || document.form1.nboleta1.value==document.form1.nboleta5.value || document.form1.nboleta1.value==document.form1.nboleta6.value)) {

      alert ("Numero de boletas repetidos 1");

      return false;

  }

  if (document.form1.nboleta2.value!='' && (document.form1.nboleta2.value==document.form1.nboleta3.value || document.form1.nboleta2.value==document.form1.nboleta4.value || document.form1.nboleta2.value==document.form1.nboleta5.value || document.form1.nboleta2.value==document.form1.nboleta6.value)) {

      alert ("Numero de boletas repetidos 2");

      return false;

  }

  if (document.form1.nboleta3.value!='' && (document.form1.nboleta3.value==document.form1.nboleta4.value || document.form1.nboleta3.value==document.form1.nboleta5.value || document.form1.nboleta3.value==document.form1.nboleta6.value)) {

      alert ("Numero de boletas repetidos 3");

      return false;

  }

  if (document.form1.nboleta4.value!='' && (document.form1.nboleta4.value==document.form1.nboleta5.value || document.form1.nboleta4.value==document.form1.nboleta6.value)) {

      alert ("Numero de boletas repetidos 4");

      return false;

  }

  if (document.form1.nboleta5.value!='' && (document.form1.nboleta5.value==document.form1.nboleta6.value)) {

      alert ("Numero de boletas repetidos 5");

      return false;

  }


  if(confirm('\u00BF EST\u00c1 SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
      blockUI();
  }
  else{
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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

          <?
          require("inc/menu_1.php");
          ?>

                </div>
          </div>

            <div class="col-sm-9 col-lg-9">
               <div class="dash-unit2">

                <table width="500" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">INGRESO DE BOLETAS DE HONORARIOS</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1">

                         <a href="proveedores.php" class="link" target="_blank">Crear nuevo Proveedor</a>

<?



if (isset($_GET["llave"]))

 echo "<p>Registros insertados con Exito !";

$activacion=1;

if ($regionsession<>0) {

    $sql27 = "Select * from regiones where codigo=$regionsession";

    //echo $sql;

    $res27 = mysql_query($sql27);

    $row27 = mysql_fetch_array($res27);

    $activacion=$row27["activo"];

    

}



?>

                         </td>

                      </tr>



                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>





                   <tr>

                    <td height="50" colspan="3">

                    

          <table width="488" border="0" cellspacing="0" cellpadding="0">

 <?

 if ($activacion<>0) {



 ?>

            <form name="form1" action="grabahonorarios.php" method="post"  onSubmit="return valida()">

                         <tr>

                             <td  valign="top" class="Estilo1">Fecha </td>

                             <td class="Estilo1">

                             <?

                                $mes=date("m");

                                $ano=date("Y");

                                





                                $sql2 = "Select * from parametros";

                                $res2 = mysql_query($sql2);

                                $row2 = mysql_fetch_array($res2);

                                $mes=$row2["para_mes"];

                                $ano=$row2["para_anno"];

                                $tot_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

                             ?>

                                  <select name="dia" class="Estilo1">

                                   <option value="">dia...</option>

                                   <option value="01">01</option>

                                   <option value="02">02</option>

                                   <option value="03">03</option>

                                   <option value="04">04</option>

                                   <option value="05">05</option>

                                   <option value="06">06</option>

                                   <option value="07">07</option>

                                   <option value="08">08</option>

                                   <option value="09">09</option>

                                   <option value="10">10</option>

                                   <option value="11">11</option>

                                   <option value="12">12</option>

                                   <option value="13">13</option>

                                   <option value="14">14</option>

                                   <option value="15">15</option>

                                   <option value="16">16</option>

                                   <option value="17">17</option>

                                   <option value="18">18</option>

                                   <option value="19">19</option>

                                   <option value="20">20</option>

                                   <option value="21">21</option>

                                   <option value="22">22</option>

                                   <option value="23">23</option>

                                   <option value="24">24</option>

                                   <option value="25">25</option>

                                   <option value="26">26</option>

                                   <option value="27">27</option>

                                   <option value="28">28</option>

                                   <option value="29">29</option>

                                   <option value="30">30</option>

                              <? if ($tot_dias>30) { ?>

                                   <option value="31">31</option>

                               <? } ?>

                                  </select>

                                  -<? echo $row2["para_mes"] ?>-<? echo $row2["para_anno"] ?>

                                  <input type="hidden" name="mes" class="Estilo2" size="12" value="<? echo $row2["para_mes"] ?>">

                                  <input type="hidden" name="anno" class="Estilo2" size="12" value="<? echo $row2["para_anno"] ?>">



                             </td>

                           </tr>

                            <tr>

                             <td  valign="top" class="Estilo1">Egreso</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="codigo" class="Estilo2" size="11" >

                             </td>

                           </tr>

                           

                         <tr>

                             <td  valign="top" class="Estilo1">Regi&oacute;n</td>

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

                             <td  valign="top" class="Estilo1">Rut  </td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" > -

                              <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()">

          Rut sin puntos

                             </td>

                           </tr>





                           <tr>

                             <td  valign="top" class="Estilo1"><br>Nombre </td>

                             <td class="Estilo1" colspan=3>

                              <input type="hidden" name="nombre" class="Estilo2" size="40" ><br>

                              <label id="nombre2"></label>



                             </td>

                           </tr>

                          <tr>

                             <td  valign="top" class="Estilo1"><br> Cantidad</td>

                             <td class="Estilo1"><br>

                                <select name="cantidad" class="Estilo1" onChange="aparece2()">

                                 <option value="1">1</option>

                                 <option value="2">2</option>

                                 <option value="3">3</option>

                                 <option value="4">4</option>

                                 <option value="5">5</option>

                                 <option value="6">6</option>

                               </select>

                             </td>

                           </tr>

                           <tr>

                            <td  valign="top" class="Estilo1">Detalles  </td>

                            <td  valign="top" class="Estilo1" colspan=3>

                              <table border=1>

                                <tr>

                                  <td class="Estilo1">N&#186;Boleta</td><td class="Estilo1">Bruto</td><td class="Estilo1">Retencion</td><td class="Estilo1">Liquido</td>

                                </tr>

                                <tr>

                                   <td class="Estilo1" >1

                                    <input type="text" name="nboleta1" class="Estilo2" size="10" onchange="traerDatos2(document.form1.nboleta1.value,document.form1.rut.value,'nboleta1')"   onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="bruto1" class="Estilo2" size="10" onChange="calcula1()"   onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="retencion1" class="Estilo2" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="liquido1" class="Estilo2" size="10"  onkeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">

                                  </td>

                                </tr>

                                </table>

                                <div id="seccion12" style="display:none">

                                <table border=1>



                                <tr>

                                   <td class="Estilo1" >2

                                    <input type="text" name="nboleta2" class="Estilo2" size="10" onchange="traerDatos2(document.form1.nboleta2.value,document.form1.rut.value,'nboleta2')" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="bruto2" class="Estilo2" size="10" onChange="calcula2()" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="retencion2" class="Estilo2" size="10"  >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="liquido2" class="Estilo2" size="10"  >

                                  </td>

                                </tr>

                                </table>

                                </div>

                                <div id="seccion13" style="display:none">

                                <table border=1>

                                <tr>

                                   <td class="Estilo1" >3

                                    <input type="text" name="nboleta3" class="Estilo2" size="10" onchange="traerDatos2(document.form1.nboleta3.value,document.form1.rut.value,'nboleta3')">

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="bruto3" class="Estilo2" size="10" onChange="calcula3()" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="retencion3" class="Estilo2" size="10"  >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="liquido3" class="Estilo2" size="10"  >

                                  </td>

                                </tr>

                                </table>

                                </div>

                                <div id="seccion14" style="display:none">

                                <table border=1>



                                <tr>

                                   <td class="Estilo1" >4

                                    <input type="text" name="nboleta4" class="Estilo2" size="10" onchange="traerDatos2(document.form1.nboleta4.value,document.form1.rut.value,'nboleta4')" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="bruto4" class="Estilo2" size="10" onChange="calcula4()" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="retencion4" class="Estilo2" size="10" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="liquido4" class="Estilo2" size="10"  >

                                  </td>

                                </tr>



                              </table>

                              </div>

                                <div id="seccion15" style="display:none">

                                <table border=1>



                                <tr>

                                   <td class="Estilo1" >5

                                    <input type="text" name="nboleta5" class="Estilo2" size="10" onchange="traerDatos2(document.form1.nboleta5.value,document.form1.rut.value,'nboleta5')">

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="bruto5" class="Estilo2" size="10" onChange="calcula5()" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="retencion5" class="Estilo2" size="10" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="liquido5" class="Estilo2" size="10"  >

                                  </td>

                                </tr>



                              </table>

                              </div>

                                <div id="seccion16" style="display:none">

                                <table border=1>



                                <tr>

                                   <td class="Estilo1" >6

                                    <input type="text" name="nboleta6" class="Estilo2" size="10" onchange="traerDatos2(document.form1.nboleta6.value,document.form1.rut.value,'nboleta6')">

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="bruto6" class="Estilo2" size="10" onChange="calcula6()" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="retencion6" class="Estilo2" size="10" >

                                  </td>

                                   <td class="Estilo1" >

                                    <input type="text" name="liquido6" class="Estilo2" size="10"  >

                                  </td>

                                </tr>



                              </table>

                              </div>

                            </td>

                           </tr>

                           



                           <tr>

                               <td  valign="center" class="Estilo1">  </td>

                               <td  valign="center" class="Estilo1">NOTA: Los valores no deben ser ingresados con puntos y comas </td>



                           </tr>

                           <tr>

                               <td  valign="center" class="Estilo1"><br>  </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Sub T&iacute;tulo  </td>

                             <td class="Estilo1" colspan=3>

                              21<input type="radio" name="item" class="Estilo2" value="21" >

                              22<input type="radio" name="item" class="Estilo2" value="22" >

                              24<input type="radio" name="item" class="Estilo2" value="24" >

                              29<input type="radio" name="item" class="Estilo2" value="29"  >

                              31<input type="radio" name="item" class="Estilo2" value="31"  >

                              34<input type="radio" name="item" class="Estilo2" value="34" >

                              Otro<input type="radio" name="item" class="Estilo2" value="99" >

                              <br>

                             </td>



                           </tr>

                          <tr>

                             <td  valign="top" class="Estilo1"><br> Banco</td>

                             <td class="Estilo1"><br>

                                <select name="banco" class="Estilo1" >

                                 <option value="">Seleccione...</option>

                                 <option value="9549099|Remuneraciones P.01 Dirnac">9549099 - Remuneraciones P.01 Dirnac</option>

                                 <option value="9006028|Bienes y Servicios P.01 Dirnac">9006028 - Bienes y Servicios P.01 Dirnac</option>

                                 <option value="9001824|Convenio MIDEPLAN P.02">9001824 - Convenio MIDEPLAN P.02</option>

                                 <option value="9549218|Remuneraciones P.02 Dirnac">9549218 - Remuneraciones P.02 Dirnac</option>

                                 <option value="9020829|Bienes y Servicios P02 Dirnac">9020829 - Bienes y Servicios P02 Dirnac </option>

                               </select>





                             </td>

                           </tr>

                          <tr>

                             <td  valign="top" class="Estilo1"><br> Programa</td>

                             <td class="Estilo1"><br>

                                <select name="programa" class="Estilo1" >

                                 <option value="">Seleccione...</option>

                                 <option value="CASH">CASH</option>

                                 <option value="PMI">PMI</option>

                                 <option value="CECI">CECI</option>

                                 <option value="CONADI">CONADI</option>

                                 <option value="SENADI">SENADI</option>

                                 <option value="SUMA ALZADA">SUMA ALZADA</option>

                                 <option value="GORE">GORE</option>

                                 <option value="META PRESIDENCIAL">META PRESIDENCIAL</option>

                                 <option value="CAPACITACION A TERCEROS">CAPACITACION A TERCEROS</option>

                               </select>





                             </td>

                           </tr>



                           <tr>

                               <td  valign="center" class="Estilo1"><br><br><br>  </td>

                               <td  valign="center" class="Estilo1"> </td>



                           </tr>



                           <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR BOLETA    " > </td>

                           </tr>







                        </form>

                      <?

                       }  else {

                           echo "PERIODO CERRADO";

                       }

                      ?>

                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      

                      <tr>

                      <td colspan="8">

                          <table border="0" width="100%" class="table table-striped table-bordered"  id="example">
                            <thead>
                              <tr>
                                <th class="Estilo1">N&#186;</th>
                                <th class="Estilo1">Rut</th>
                                <th class="Estilo1">Nombre</th>
                                <th class="Estilo1">Fecha Boleta</th>
                                <th class="Estilo1">Numero</th>
                                <th class="Estilo1">Bruto</th>
                                <th class="Estilo1">Banco</th>
                              </tr>
                            </thead>
                            <tfoot style="display: table-header-group;">
                              <tr>
                                <th class="Estilo1">N&#186;</th>
                                <th class="Estilo1">Rut</th>
                                <th class="Estilo1">Nombre</th>
                                <th class="Estilo1">Fecha Boleta</th>
                                <th class="Estilo1">Numero</th>
                                <th class="Estilo1">Bruto</th>
                                <th class="Estilo1">Banco</th>
                              </tr>
                            </tfoot>
                            <tbody>
                              <?



                                  if ($regionsession==0) {

                                    $sql2 = "Select * from dpp_honorarios order by hono_id desc limit 0,10";

                                  } else {

                                    $sql2 = "Select * from dpp_honorarios where hono_region=$regionsession order by hono_id desc limit 0,10";

                                  }

                                  //echo $sql2;

                                  $res2 = mysql_query($sql2);

                                   $cont=1;

                                   while($row2 = mysql_fetch_array($res2)){

                              ?>

                                  <tr>

                                  <td class="Estilo1"><? echo $cont ?> </td>

                                  <td class="Estilo1"><? echo $row2["hono_rut"] ?></td>

                                  <td class="Estilo1"><? echo $row2["hono_nombre"] ?></td>

                                  <td class="Estilo1"><? echo  date("d-m-Y", strtotime($row2["hono_fecha1"])); ?></td>

                                  <td class="Estilo1d"><? echo $row2["hono_nro_boleta"] ?></td>

                                  <td class="Estilo1d"><? echo $row2["hono_bruto"] ?></td>

                                  <td class="Estilo1d"><? echo $row2["hono_cuenta"] ?>-<? echo $row2["hono_banconombre"] ?></td>

                              <?

                                    $cont++;

                                  }

                              ?>



                              </tr>
                            </tbody>
                          </table>



                      </td>

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

                <br>

                <br>

                <? require("inc/pie.php"); ?>


                <img src="images/pix.gif" width="1" height="10">

              </div>

          </div>

        </div>
        
    </div>


  <script type="text/javascript" src="../../seguimientos/sitio2/librerias/DataTables/media/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="../../seguimientos/sitio2/librerias/DataTables/media/css/dataTables.material.min.css">
  <script type="text/javascript" src="../../seguimientos/sitio2/librerias/DataTables/media/js/dataTables.material.min.js"></script>
  <script>
    $(function(){
      $('#example tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
      } );
      

      // DataTable

      var table = $('#example').DataTable({
        "language": {
          "lengthMenu": "Mostrar _MENU_ registros por p&aacute;gina",
          "zeroRecords": "Sin resultados.",
          "info": "Mostrando p&aacute;gina _PAGE_ de _PAGES_",
          "infoEmpty": "Sin informaci&oacute;n disponible",
          "infoFiltered": "(filtered from _MAX_ total records)",
          "paginate":{
            "first": "Primero",
            "last": "&Uacute;ltimo",
            "next": "Siguiente",
            "previous" : "Anterior"
          },
          "search": "Buscar"
        }
      });
      
      // Apply the search
      table.columns().every( function () {
        var that = this;
        
        $( 'input', this.footer() ).on( 'keyup change', function () {
          if ( that.search() !== this.value ) {
            that
            .search( this.value )
            .draw();
          }
        } );
      } );

    })
  </script>



</body>

</html>



<?



?>



