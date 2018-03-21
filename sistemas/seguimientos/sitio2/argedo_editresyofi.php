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

$read1= rand(0,1000000);

$read2= rand(0,1000000);

$read3= rand(0,1000000);

$read4= rand(0,1000000);

?>

<html>

<head>

<title>Facturas y/o Boletas</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/estilos.css" rel="stylesheet" type="text/css">
  <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="librerias/bootstrap/js/bootstrap.min.js"></script>
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

text-align: center; 



}

.Estilo7a {font-family: Geneva, Arial, Helvetica, sans-serif;

font-size: 12px;

font-weight: bold;

text-align: left; 



}

.Estilo8 {font-family: Geneva, Arial, Helvetica, sans-serif; 

font-size: 10px; font-weight: bold; text-align: left; 

color: #009900;}



-->

</style>







</head>

<script type="text/javascript" src="select_dependientesargedo.js"></script>

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

   if (document.form1.tipodoc[0].checked=='' && document.form1.tipodoc[1].checked==''  && document.form1.tipodoc[2].checked=='' && document.form1.tipodoc[3].checked=='' && document.form1.tipodoc[4].checked=='') {

      alert ("No ha seleccionado Tipo de Documento ");

      return false;

  }





  

}

//-->



</script>

<?



function generaPaises()

{

//	include 'conexion.php';

//	conectar();

	$consulta=mysql_query("SELECT id, opcion FROM area");

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



$ti=$_GET["ti"];

$id=$_GET["id"];
$doctipo=$_GET["doc_tipo"];
$docstipo=$_GET["docstipo"];



  if ($ti==1 or $ti==6) {

   $prefijo="RESOLUCIÓN EXENTA";

    if ($doctipo==6 or $docstipo==6) {
       $prefijo="SIAPER";
    }

  }

  if ($ti==2) {

   $prefijo="RESOLUCIÓN AFECTA";

  }

  if ($ti==3) {

   $prefijo="OFICIO";

  }





?>

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

                    <td height="20" colspan="2"><span class="Estilo7">MODIFICA (<? echo $prefijo ?>)</span></td>

                  </tr>



                    <tr>

                         <td width="487" valign="top" class="Estilo1">

                       <a href="argedo_listaresyofi.php?ti=<? echo $ti ?>" class="link">VOLVER</a> <br>



                         </td>

                      </tr>



                       <tr>

                       <td></td><td></td>

                      </tr>







                       <tr>

                       <td></td><td></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1c">

                         

<?











if (isset($_GET["llave"]))

 echo "<p>Registros insertados con Exito !";

?>

                         </td>

                      </tr>



                       <tr>

                       <td><hr></td><td><hr></td>





                      </tr>

<?

  $campo="fol_reg".$regionsession."_".$ti;

  $sql2="select $campo as folio from argedo_folios where fol_id=1 ";

//  echo $sql2."<br>";

  $result2=mysql_query($sql2);

  $row2=mysql_fetch_array($result2);

  $foliomio=$row2["folio"];

  $foliomio2=$foliomio+1;





$sql22="select * from argedo_documentos where docs_id=$id ";

//  echo $sql21;

  $result22=mysql_query($sql22);

  $row22=mysql_fetch_array($result22);

  $docsfechaparte=$row22["docs_fechaparte"];
  $docsfechasiaper=$row22["docs_fechasiaper"];

  $docsfecha=$row22["docs_fecha"];

  $docsanno=$row22["docs_anno"];

  

  $docsfechaparte=substr($docsfechaparte,8,2)."-".substr($docsfechaparte,5,2)."-".substr($docsfechaparte,0,4);
  $docsfechasiaper=substr($docsfechasiaper,8,2)."-".substr($docsfechasiaper,5,2)."-".substr($docsfechasiaper,0,4);
  $docsfecha=substr($docsfecha,8,2)."-".substr($docsfecha,5,2)."-".substr($docsfecha,0,4);

  $docscodh=$row22["docs_codh"];



?>





                   <tr>

             			<td height="50" colspan="3">

                    

					<table width="100%" border="0" cellspacing="0" cellpadding="0">

				  <form name="form1" action="argedo_grabaeditresyofi.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">



                            <tr>

                             <td  valign="left" class="Estilo7a">FOLIO</td>

		             <td class="Estilo7a"><? echo $row22["docs_folio"] ?> </td>

                             </td>

                           </tr>
 <tr><td><br></td><tr>






<tr>

                             <td  valign="center" class="Estilo1">FECHA RECEPCIÓN OFICINA PARTES</td>

                             <td class="Estilo1" valign="center">

<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $docsfechaparte ?>" id="f_date_c1" readonly="1">

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

                           </tr>
 <tr><td><br></td><tr>
<tr>

                             <td  valign="center" class="Estilo1">FECHA CERTIFICADO SIAPER</td>

                             <td class="Estilo1" valign="center">

<input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $docsfechasiaper ?>" id="f_date_c3" readonly="1">

<img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"

      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />



    <script type="text/javascript">

      Calendar.setup({

        inputField : "f_date_c3",

        trigger    : "f_trigger_c3",

        onSelect   : function() { this.hide() },

        showTime   : 12,

        dateFormat : "%d-%m-%Y"

      });

    </script>







                             </td>

                           </tr>
                          <tr><td><br></td><tr>

                         <tr>

                             <td  valign="center" class="Estilo1">REGIÓN</td>

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

                             <td  valign="center" class="Estilo1">FECHA DOCUMENTO</td>

                             <td class="Estilo1">

<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $docsfecha ?>" id="f_date_c2" readonly="1">

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
                           <?php
                           //FORMATEAR FECHAS
                           $docs_feccontra = substr($row22["docs_feccontra"],8,2)."-".substr($row22["docs_feccontra"],5,2)."-".substr($row22["docs_feccontra"],0,4);
                           $docs_fectoma = substr($row22["docs_fectoma"],8,2)."-".substr($row22["docs_fectoma"],5,2)."-".substr($row22["docs_fectoma"],0,4);
                           $docs_fecing = substr($row22["docs_fecing"],8,2)."-".substr($row22["docs_fecing"],5,2)."-".substr($row22["docs_fecing"],0,4);
                           $docs_fecdevo = substr($row22["docs_fecdevo"],8,2)."-".substr($row22["docs_fecdevo"],5,2)."-".substr($row22["docs_fecdevo"],0,4);
                           $docs_fecaretiro = substr($row22["docs_fecaretiro"],8,2)."-".substr($row22["docs_fecaretiro"],5,2)."-".substr($row22["docs_fecaretiro"],0,4);
                           $docs_obs2fecha = substr($row22["docs_obs2fecha"],8,2)."-".substr($row22["docs_obs2fecha"],5,2)."-".substr($row22["docs_obs2fecha"],0,4);
                           $docs_derivadofec = substr($row22["docs_derivadofec"],8,2)."-".substr($row22["docs_derivadofec"],5,2)."-".substr($row22["docs_derivadofec"],0,4);
                           ?>
<?php if ($ti==2): ?>

                    <!-- INTERVENCION FREDDY !-->
                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Ingreso CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_feccontra" class="Estilo2" size="12" value="<? echo $docs_feccontra ?>" id="docs_feccontra" >
                        <img src="calendario.gif" id="f_trigger_c3" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_feccontra",
                            trigger    : "f_trigger_c3",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Toma Razón CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fectoma" class="Estilo2" size="12" value="<? echo $docs_fectoma ?>" id="docs_fectoma" >
                        <img src="calendario.gif" id="f_trigger_c4" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fectoma",
                            trigger    : "f_trigger_c4",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Ingreso JUNJI por CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fecing" class="Estilo2" size="12" value="<? echo $docs_fecing ?>" id="docs_fecing" >
                        <img src="calendario.gif" id="f_trigger_c5" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fecing",
                            trigger    : "f_trigger_c5",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Devolución desde CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fecdevo" class="Estilo2" size="12" value="<? echo $docs_fecdevo ?>" id="docs_fecdevo" >
                        <img src="calendario.gif" id="f_trigger_c6" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fecdevo",
                            trigger    : "f_trigger_c6",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>

                    <tr>
                      <td  valign="center" class="Estilo1">Fecha Retiro sin tramitar desde CGR <font color="#FF0000">* </font></td>
                      <td class="Estilo1">
                        <input type="text" name="docs_fecaretiro" class="Estilo2" size="12" value="<? echo $docs_fecaretiro ?>" id="docs_fecaretiro" >
                        <img src="calendario.gif" id="f_trigger_c7" style="cursor: pointer; border: 1px solid red;" title="Date selector"
                        onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
                        <script type="text/javascript">
                          Calendar.setup({
                            inputField : "docs_fecaretiro",
                            trigger    : "f_trigger_c7",
                            onSelect   : function() { this.hide() },
                            showTime   : 12,
                            dateFormat : "%d-%m-%Y"
                          });
                        </script>
                      </td>
                    </tr>
                    <!-- FIN INTERVENCION !-->
                  <?php endif ?>


                      <tr>

<?

    $docsarea22=$row22["docs_area"];

    $docssubarea22=$row22["docs_subarea"];

    $sql25="select * from area where id='$docsarea22' ";

    $result25=mysql_query($sql25);

    $row25=mysql_fetch_array($result25);

    $docsarea=$row25["opcion"];



    $sql35="select * from subarea where id='$docssubarea22' ";

    $result35=mysql_query($sql35);

    $row35=mysql_fetch_array($result35);

    $docssubarea=$row35["opcion"];



?>

                       <td><hr></td><td><hr></td>

<?

if ($docscodh<>'' ) {

?>

                           <tr>

                             <td  valign="top" class="Estilo1">CODIGO HACIENDA</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="codh" class="Estilo2" size="4" value="<? echo $row22["docs_codh"]; ?>" >

                              <input type="text" name="numh" class="Estilo2" size="4" value="<? echo $row22["docs_numh"]; ?>" >

                              <input type="text" name="annoh" class="Estilo2" size="4" value="<? echo $row22["docs_annoh"]; ?>" >  <br>  <br>

                             </td>

                          </tr>

<?

}

?>

                       

                            <tr>

                             <td  valign="center" class="Estilo1">ÁREA</td>

				             <td class="Estilo1"><?php generaPaises(); ?>

                              <input type="hidden" name="tipo" class="Estilo2" size="40" value="<? echo $row["cont_tipo"]; ?>" > <br>

                              <? echo $docsarea; ?>

                             </td>

                           </tr>

<!--

                           <tr>

                             <td valign="center" class="Estilo1">SUBÁREA</td>

                             <td class="Estilo1">

					            <select disabled="disabled" name="estados" id="estados">

  						          <option value="0">Seleccione...</option>

					            </select>  <br>





                             </td>

                            </tr>



                            <tr>

                            <td>

                            </td>

                             <td class="Estilo1">

                                <? echo $docssubarea; ?>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1"><br>EN TRÁMITE</td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="radio" name="tramite" class="Estilo2" value="SI" <? if ($sino=='SI') echo "checked"?> > Si<br>

                              <input type="radio" name="tramite" class="Estilo2" value="NO" <? if ($sino=='NO') echo "checked"?> > No <br>

                             </td>

                           </tr>

-->

                              <?

                              $sino=$row22["docs_tramite"];

                              $trans=$row22["docs_transparencia"];







if ($ti==1 and $docscodh=='' ) {

?>

                            <tr>

                             <td  valign="center" class="Estilo1"><br>LEY TRANSPARENCIA  <font color="#FF0000">* </font></td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="checkbox" name="transparencia" class="Estilo2" value="1" <? if ($trans=='1') echo "checked"?>> Si<br>



                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1"><br>TIPO RESOLUCIÓN EXENTA</td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="radio" name="op1" class="Estilo2" value="NORMAL" checked onclick="mostrar();">Res. Exenta "Normal"<br>

                              <input type="radio" name="op1" class="Estilo2" value="RESERVADO" onclick="mostrar();">Res. Exenta "Reservado"<br>

                              <input type="radio" name="op1" class="Estilo2" value="SECRETA" onclick="mostrar();">Res. Exenta "Secreta"<br>



                             </td>

                           </tr>



<?

}

?>







                           

                            <tr>

                             <td  valign="center" class="Estilo1"><br>MATERIA</td>

                             <td class="Estilo1" colspan=3><br>

                             <textarea name="materia" rows="3" cols="40" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "   onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "  onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "><? echo $row22["docs_materia"];  ?></textarea>

                             </td>

                           </tr>

<?

if ($ti==3) {

?>

                            <tr>

                             <td  valign="center" class="Estilo1">TIPO DOCUMENTO </td>

                             <td class="Estilo1" colspan=4>

                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DN" <? if ($row22["docs_tipodoc"]=='OFICIO DN') echo "checked"?> > Oficio DN <br>

                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DAN" <? if ($row22["docs_tipodoc"]=='OFICIO DAN') echo "checked"?> > Oficio DAN  <br>

                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DEPTO" <? if ($row22["docs_tipodoc"]=='OFICIO DEPTO') echo "checked"?> > Oficio DEPTO  <br>

                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DAR" <? if ($row22["docs_tipodoc"]=='OFICIO DAR') echo "checked"?> > Oficio DAR  <br>

                              <input type="radio" name="tipodoc" class="Estilo2" value="OFICIO DR" <? if ($row22["docs_tipodoc"]=='OFICIO DR') echo "checked"?> > Oficio DR  <br>



                             </td>

                           </tr>

<?

}

?>

                            <tr>

                             <td  valign="center" class="Estilo1" width="340"><br>DESTINATARIO  </td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="text" name="destinatario" id="destinatario" class="Estilo2" size="40" value="<? echo $row22["docs_destinatario"];  ?>" >
                              <a href="#" data-target="#myModal"  data-toggle="modal">Seleccionar</a>
                             </td>

                           </tr>





                            <tr>

                             <td  valign="center" class="Estilo1"><br>OBSERVACIÓN  </td>

                             <td class="Estilo1" colspan=3><br>

                             <textarea name="obs" id="obs" rows="3" cols="40"  onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "><? echo $row22["docs_obs"];  ?></textarea><p></p>

                             </td>

                           </tr>

<?

if ($docscodh<>'') {

?>



                            <tr>

                             <td  valign="center" class="Estilo1"><br>REFERENCIA  </td>

                             <td class="Estilo1" colspan=3><br>

                             <textarea name="referencia" rows="3" cols="40"  onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "><? echo $row22["docs_referencia"];  ?></textarea>

                             </td>

                           </tr>



<?

}

?>



                            <tr>

                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF</td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="file" name="archivo1" class="Estilo2" size="40"  > &nbsp;&nbsp;&nbsp;<a href="argedo_borradocs.php?ti=<? echo $ti ?>&id=<? echo $id ?>&doc=1" class="link" >BORRAR</a><br>

                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row22["docs_archivo"]; ?></a>

                             </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 2</td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="file" name="archivo2" class="Estilo2" size="40"  > <a href="argedo_borradocs.php?ti=<? echo $ti ?>&id=<? echo $id ?>&doc=2" class="link" >BORRAR</a> <br>

                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo2"]; ?>?read2=<? echo $read2 ?>" class="link" target="_blank"><? echo $row22["docs_archivo2"]; ?></a>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 3</td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="file" name="archivo3" class="Estilo2" size="40"  > <a href="argedo_borradocs.php?ti=<? echo $ti ?>&id=<? echo $id ?>&doc=3" class="link" >BORRAR</a> <br>

                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo3"]; ?>?read3=<? echo $read3 ?>" class="link" target="_blank"><? echo $row22["docs_archivo3"]; ?></a>

                             </td>

                           </tr>

                            <tr>

                             <td  valign="center" class="Estilo1"><br>ADJUNTO PDF 4</td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="file" name="archivo4" class="Estilo2" size="40"  > <a href="argedo_borradocs.php?ti=<? echo $ti ?>&id=<? echo $id ?>&doc=4" class="link" >BORRAR</a> <br>

                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo4"]; ?>?read4=<? echo $read4 ?>" class="link" target="_blank"><? echo $row22["docs_archivo4"]; ?></a>

                             </td>

                           </tr>









                      </tr>

                     <tr>

                       <td><hr></td><td><hr></td>





                      </tr>


<?php if ($ti==2): ?>
            <tr>
             <td  valign="center" class="Estilo1">Deribado a <font color="#FF0000">* </font></td>
             <td><input type="text" name="docs_derivado" id="docs_derivado" value="<?php echo $row22["docs_derivado"] ?>"class="Estilo2"></td>
           </tr>

           <tr>
             <td  valign="center" class="Estilo1">Fecha Dericavión <font color="#FF0000">* </font></td>
             <td><input type="text" name="docs_derivadofec" id="docs_derivadofec" class="Estilo2" value="<? echo $docs_derivadofec ?>">
              <img src="calendario.gif" id="f_trigger_c8" style="cursor: pointer; border: 1px solid red;" title="Date selector"
              onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
              <script type="text/javascript">
                Calendar.setup({
                  inputField : "docs_derivadofec",
                  trigger    : "f_trigger_c8",
                  onSelect   : function() { this.hide() },
                  showTime   : 12,
                  dateFormat : "%d-%m-%Y"
                });
              </script>
            </td>
          </tr>

          <tr>
           <td  valign="center" class="Estilo1">Observaciones <font color="#FF0000">* </font></td>
           <td class="Estilo1">

            <textarea name="docs_obs2" id="docs_obs2" rows="3" cols="40" onKeypress=" if (event.keyCode==39) { event.returnValue = false; } ; "><?php echo $row22["docs_obs2"] ?></textarea><p></p>

           </td>
         </tr>

         <tr>
           <td  valign="center" class="Estilo1">Fecha Observacions <font color="#FF0000">* </font></td>
           <td><input type="text" name="docs_obs2fecha" id="docs_obs2fecha" class="Estilo2" value="<? echo $docs_obs2fecha ?>">
            <img src="calendario.gif" id="f_trigger_c9" style="cursor: pointer; border: 1px solid red;" title="Date selector"
            onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />
            <script type="text/javascript">
              Calendar.setup({
                inputField : "docs_obs2fecha",
                trigger    : "f_trigger_c9",
                onSelect   : function() { this.hide() },
                showTime   : 12,
                dateFormat : "%d-%m-%Y"
              });
            </script>
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

                             <td colspan=4 align="center"> <input type="submit" value="    MODIFICAR   <? echo $prefijo ?>    " > </td>

                           </tr>



                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >

                              <input type="hidden" name="area" value="<? echo $docsarea22; ?>" >

                              <input type="hidden" name="subarea" value="<? echo $docssubarea22; ?>" >

                              <input type="hidden" name="id" value="<? echo $row22["docs_id"]; ?>" >

                              <input type="hidden" name="folio" value="<? echo $row22["docs_folio"]; ?>" >

                              <input type="hidden" name="fechasis" value="<? echo $row22["docs_fechasis"]; ?>" >

                              <input type="hidden" name="docstipo" value="<? echo $row22["docs_tipo"]; ?>" >

                              <input type="hidden" name="docsanno" value="<? echo $docsanno; ?>" >

                              <input type="hidden" name="contrato" >



                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">

                      <table border=1>



<br>







                        











</td>

  </tr>





</table>



<img src="images/pix.gif" width="1" height="10">
<!-- Modal -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">SELECCIONE LAS REGIONES</h4>
        </div>
        <div class="modal-body">
          <center>
            <select class="regiones" id="regiones" multiple style="width: 40%; height:100px;">
              <option selected value="">Seleccionar...</option>
              <?php 
              $sql = "SELECT * FROM regiones";
              echo $sql;
              $res = mysql_query($sql,$dbh);
              $cont=0;
              while($row = mysql_fetch_array($res)){
               ?>
               <option value="<?php echo $row["nombre"] ?>"><?php echo $row["nombre"] ?></option>
               <?php $cont++;} ?>
             </select>
           </center>
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onClick="getRegiones()">Aplicar</button>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
    
    $('#obs').keypress(function(e) {
      var tval = $('#obs').val(),
      tlength = tval.length,
      set = 300,
      remain = parseInt(set - tlength);
      $('p').text("Caracteres restantes: "+remain);
      if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('#obs').val((tval).substring(0, tlength - 1))
      }
    })

$('#docs_obs2').keypress(function(e) {
      var tval = $('#docs_obs2').val(),
      tlength = tval.length,
      set = 300,
      remain = parseInt(set - tlength);
      $('p').text("Caracteres restantes: "+remain);
      if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('#docs_obs2').val((tval).substring(0, tlength - 1))
      }
    })

    function getRegiones()
    {
      var regionesSeleccionadas="";
      var totalElementos = $("#regiones :selected").length;
      console.log($("#regiones :selected").length);
      var contador = 1;
      $('#regiones :selected').each(function(i, selected){ 
        if(contador == totalElementos)
        {
          regionesSeleccionadas+=$(selected).val();
        }else{
          regionesSeleccionadas+=$(selected).val()+",";
        }
        contador++;
      });
      $("#destinatario").val(regionesSeleccionadas);
      $("#myModal").modal("hide");
    }
  </script>
</html>



