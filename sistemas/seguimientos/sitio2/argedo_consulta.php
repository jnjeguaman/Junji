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

<title>Argedo Consulta</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="css/estilos.css" rel="stylesheet" type="text/css">

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

$documento=$_GET["documento"];

$region=$_GET["region"];

$fecha2=$_GET["fecha2"];

$fecha3=$_GET["fecha3"];

$materia=$_GET["materia"];

$folio=$_GET["folio"];







  if ($ti==1) {

   $prefijo="RESOLUCI�N EXENTA";



  }

  if ($ti==2) {

   $prefijo="RESOLUCI�N AFECTA";

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

                    <td height="20" colspan="2"><span class="Estilo7">ARGEDO CONSULTAS GENERALES</span></td>

                  </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1">

                       <a href="argedo_menu.php" class="link">VOLVER</a> <br>



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





//$sql22="select count(eta_id) as totaldevueltos from dpp_etapas where eta_estado=12 and eta_region='$regionsession' ";

//  echo $sql21;

//  $result22=mysql_query($sql22);

//  $row22=mysql_fetch_array($result22);

//  $totaldevueltos=$row22["totaldevueltos"];

?>





                   <tr>

             			<td height="50" colspan="3">

                    

					<table  border="0" cellspacing="0" cellpadding="0">

				  <form name="form1" action="argedo_consulta.php" method="get"  onSubmit="return valida()"   enctype="multipart/form-data">





                         <tr>

                             <td  valign="center" class="Estilo1">TIPO DOCUMENTO</td>

                             <td class="Estilo1">

                              <input type="radio" name="documento" class="Estilo2" value="1" <? if ($documento==1 or $documento=='') echo 'checked' ?> >RESOLUCION EXENTA<br>

                              <input type="radio" name="documento" class="Estilo2" value="2" <? if ($documento==2) echo 'checked' ?> >RESOLUCION AFECTA CON TOMA<br>

                              <input type="radio" name="documento" class="Estilo2" value="3" <? if ($documento==3) echo 'checked' ?> >OFICIOS ORDINARIOS<br>

                              <input type="radio" name="documento" class="Estilo2" value="4" <? if ($documento==4) echo 'checked' ?> >CORRESPONDENCIA RECIBIDA<br>

                              <input type="radio" name="documento" class="Estilo2" value="5" <? if ($documento==5) echo 'checked' ?>>CORRESPONDENCIA DESPACHADA<br>

                              <input type="radio" name="documento" class="Estilo2" value="7" <? if ($documento==7) echo 'checked' ?> >OFICIOS CIRCULARES<br>

                           </td>

                      </tr>





                         <tr>

                             <td  valign="center" class="Estilo1">REGI�N</td>

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

                             <td  valign="center" class="Estilo1">FECHA DOCUMENTO</td>

                             <td class="Estilo1">

<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fecha2 ?>" id="f_date_c2" readonly="1">

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

a

<input type="text" name="fecha3" class="Estilo2" size="12" value="<? echo $fecha3 ?>" id="f_date_c3" readonly="1">

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

                             <td  valign="center" class="Estilo1">MATERIA  </td>

                             <td class="Estilo1" colspan=3>

                             <textarea name="materia" rows="2" cols="30"><? echo $materia ?></textarea>

                             </td>



                      </tr>

                            <tr>

                             <td  valign="center" class="Estilo1">FOLIO  </td>

                             <td class="Estilo1" colspan=3><br>

                              <input type="text" name="folio" class="Estilo2" size="20"  value="<? echo $folio ?>">

                             </td>

                           </tr>



                     <tr>

                       <td><br></td><td><br></td>





                      </tr>



                           <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    BUSCAR <? echo $prefijo ?>   " >   <a href="argedo_consulta.php" class="link">Limpiar</a>  </td>

                           </tr>

                          <tr>

                             <td  valign="center" class="Estilo1" colspan="4"><BR><font color="#FF0000"> IMPORTANTE : COMPLETAR A MENOS UN CAMPO ENTRE FECHA, MATERIA O FOLIO </font></td>

                           </tr>





                              <input type="hidden" name="ti" value="<? echo $ti; ?>" >

                              <input type="hidden" name="contrato" >



                        </form>



                      </td>





                       <tr>

                       <td><br></td><td><br></td><td><br></td><td><br></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">

                      <table border=1 class="table table-striped table-hover table-bordered">









<?

  $sql21="select max(eta_folioguia) as foliomio from dpp_etapas where eta_region='$regionsession' ";

//  echo $sql21;

  $result21=mysql_query($sql21);

  $row21=mysql_fetch_array($result21);

  $foliomio=$row21["foliomio"];

  $foliomio=$foliomio+1;

  



?>







                        <tr>

                         <td class="Estilo1" colspan=6>

                      <form name="form2" action="grabaasignaguia.php" method="post"  >





                        <tr>

                         <td class="Estilo1b">FOLIO</td>

                         <td class="Estilo1b">TIPO DOCUMENTO</td>

                         <td class="Estilo1b">FECHA DOCUMENTO</td>

                         <td class="Estilo1b">MATERIA</td>

                         <td class="Estilo1b">DESTINATARIO </td>

                         <td class="Estilo1b">FICHA</td>

                        </tr>



<?

    $sql="select * from argedo_recibida where reci_estado=1 and reci_defensoria ='$regionsession' and ";

if ($documento==1 or $documento==2 or $documento==3 or $documento == 7) {

  if ($documento==1) {

   $prefijo="RESOLUCI�N EXENTA";



  }

  if ($documento==2) {

   $prefijo="RESOLUCI�N AFECTA";

  }

  if ($documento==3) {

   $prefijo="ORDINARIO";

  }

  if ($documento==7) {

   $prefijo="OFICIO CIRCULAR";

  }

    $sql="select docs_folio, docs_documento, docs_fecha, docs_materia, docs_destinatario, docs_id from argedo_documentos where docs_estado=1 and docs_defensoria ='$regionsession' and docs_documento='$prefijo' and ";

    $sw=1;

    if ($fecha2<>'' and $fecha3<>'') {

       $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

       $fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);

       $sql.=" docs_fecha>='$fecha2' and docs_fecha<='$fecha3' and ";

       $sw=1;

    }



    if ($folio<>'') {

       $sql.=" docs_folio='$folio' and";

       $sw=1;

    }

    

    if ($materia<>'') {

       $sql.=" docs_materia like '%$materia%' and ";

       $sw=1;

    }

    $link="argedo_ficharesyofi.php";

}



if ($documento==4) {

    $sql="select reci_folio, reci_tipodoc, reci_fecha_doc, reci_materia, reci_destinatario, reci_id from argedo_recibida where reci_estado=1 and reci_defensoria ='$regionsession' and ";

    $sw=0;

    if ($fecha2<>'' and $fecha3<>'') {

       $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

       $fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);

       $sql.=" reci_fecha_recep>='$fecha2' and reci_fecha_recep<='$fecha3' and ";

       $sw=1;

    }



    if ($folio<>'') {

       $sql.=" reci_folio='$folio' and";

       $sw=1;

    }



    if ($materia<>'') {

       $sql.=" reci_materia like '%$materia%' and ";

       $sw=1;

    }

    $link="argedo_ficharecibida.php";

}



if ($documento==5) {

    $sql="select despa_folio, despa_tipodoc, despa_fecha_doc, despa_materia, despa_destinatario, despa_id from argedo_despachada where despa_estado=1 and despa_defensoria ='$regionsession' and ";

    $sw=0;

    if ($fecha2<>'' and $fecha3<>'') {

       $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

       $fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);

       $sql.=" despa_fecha_recep>='$fecha2' and despa_fecha_recep<='$fecha3' and";

       $sw=1;

    }



    if ($folio<>'') {

       $sql.=" despa_folio='$folio' and";

       $sw=1;

    }



    if ($materia<>'') {

       $sql.=" despa_materia like '%$materia%' and ";

       $sw=1;

    }

   $link="argedo_fichadespachada.php";

}





    if ($sw==1) {

       $sql.=" 1=1 ";

    }

    if ($sw==0) {

       $sql.=" 1=2 ";

    }







echo $sql;

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





   $sql5="select * from dpp_plazos ";

   //echo $sql;

   $res5 = mysql_query($sql5);

   $row5 = mysql_fetch_array($res5);

   $etapa1a=$row5["pla_etapa1a"];

   $etapa1b=$row5["pla_etapa1b"];







?>





                       <tr>

                         <td class="Estilo1b"><? echo $row3["0"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["1"]  ?> </td>

                         <td class="Estilo1b"><? echo substr($row3["2"],8,2)."-".substr($row3["2"],5,2)."-".substr($row3["2"],0,4)   ?></td>

                         <td class="Estilo1b"><? echo $row3["3"]  ?> </td>

                         <td class="Estilo1b"><? echo $row3["4"]  ?> </td>

                         <td class="Estilo1b"><a href="<? echo $link ?>?id=<? echo $row3["5"]; ?>&ti=<? echo $documento; ?>&ori=2" class="link" > VER  </a> </td>

                       </tr>











<?



   $cont++;



}

?>

                      </form>

                           </tr>







                      <tr>

                       <tr>

                       

                      </tr>





                      <table border=1>

<tr></tr>





<br>



</table>



<img src="images/pix.gif" width="1" height="10">

</body>

</html>



<?



?>

