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

.Estilo1b {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: left;

}

.Estilo1ce {

	font-family: Verdana;

	font-weight: bold;

	font-size: 8px;

	color: #003063;

	text-align: center;

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

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA ACCIÓN ?')) {
      blockUI();
  }
  else{
    return false;
  }

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

  if (document.form1.nboleta1.value <= 0 ) {

      alert ("Numero de Boleta debe ser positivo ");

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



   if (document.form1.item[0].checked=='' && document.form1.item[1].checked=='' && document.form1.item[2].checked=='' && document.form1.item[3].checked=='') {

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

                    <td height="20" colspan="2"><span class="Estilo7">MIGRACI&Oacute;N BOLETAS HONORARIOS "SEGFAC"</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1">



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

                    <td height="50" colspan="3">

                    

          <table width="" border="0" cellspacing="0" cellpadding="0">

 <?

 if ($activacion<>0) {



 ?>

            <form name="form1" action="grabacontabilidad.php" method="post"  onSubmit="return valida()">



                           <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR BOLETA    " > </td>

                           </tr>









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

                         <table border=0 class="table table-striped table-bordered">

                             <tr>

        <td class="Estilo1ce">N&#176;</td>

        <td class="Estilo1ce">FOLIO</td>

        <td class="Estilo1ce" width="80px" >RUT</td>

        <td class="Estilo1ce">NOMBRE</td>

        <td class="Estilo1ce">EGRESO</td>

        <td class="Estilo1ce">BRUTO</td>

        <td class="Estilo1ce">N&#176; DOC</td>

        <td class="Estilo1ce">SERVICIO</td>

        <td class="Estilo1ce">FECHA CHEQUE</td>

                              </tr>



                              <?

                                $sql2 = "Select * from parametros";

                                $res2 = mysql_query($sql2);

                                $row2 = mysql_fetch_array($res2);

                                $mes=$row2["para_mes"];

                                $ano=$row2["para_anno"];





                                  if ($regionsession==0) {

//                                    $sql2 = "Select * from dpp_honorarios order by hono_id desc limit 0,10";

                                      $sql2="select * from dpp_etapas where (eta_estado=7 or eta_estado=8 ) and month(eta_fechache)='$mes' and year(eta_fechache)='$ano'  and eta_tipo_doc='Honorario' and eta_swhono=0  order by eta_folio desc ";

                                  } else {

                                      //$sql2 = "Select * from dpp_honorarios where hono_region=$regionsession order by hono_id desc limit 0,10";

                                      $sql2="select * from dpp_etapas where (eta_estado=7 or eta_estado=8 ) and month(eta_fechache)='$mes' and year(eta_fechache)='$ano' and (eta_tipo_doc='Honorario' or eta_tipo_doc2='bh') and eta_region=$regionsession and eta_swhono=0 order by eta_folio desc ";

                                      /*$sql2="select * from dpp_etapas where (eta_estado=7 or eta_estado=8 ) and (eta_tipo_doc='Honorario' or eta_tipo_doc2='bh') and eta_region=$regionsession and eta_swhono=0 order by eta_folio desc "; 
                                      echo "consulta provisoria<br>";*/

                                  }

                                  //echo $sql2;

                                  $res2 = mysql_query($sql2,$dbh2);

                                  $cont=1;

                                  $existedato=0;

                                  while($row3 = mysql_fetch_array($res2)){

                                      ?>

                                     <tr>

                                       <td class="Estilo1b"><input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["eta_id"] ?>" class="Estilo2" > </td>

                                       <td class="Estilo1ce"><? echo $row3["eta_folio"]  ?> </td>

                                       <td class="Estilo1c" title="<? echo $row3["eta_cli_nombre"]  ?>"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>

                                       <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>

                                       <td class="Estilo1c"><? echo $row3["eta_negreso"]   ?> </td>

                                       <td class="Estilo1c"><? echo number_format($row3["eta_monto2"],0,',','.')  ?> </td>

                                       <td class="Estilo1c"><? echo $row3["eta_numero"]   ?> </td>

                                       <td class="Estilo1ce"><? echo $row3["eta_servicio_final"]  ?> </td>

                                       <td class="Estilo1ce"><? echo substr($row3["eta_fechache"],8,2)."-".substr($row3["eta_fechache"],5,2)."-".substr($row3["eta_fechache"],0,4)   ?></td>

                                     </tr>

                                      <?

                                    $cont++;
                                    $existedato++;

                                  }

                              ?>


                              <?
                              if ($existedato==0) {
                                  ?>
                                  <tr>
                                    <td class="Estilo1b text-center" colspan="9">Sin registros</td>
                                  </tr>
                                  <?
                              }

                              ?>





                         </table>

                          <input type="hidden" name="cont" value="<? echo $cont ?>" >

                         </form>

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


                <br>

                <br>

                <? require("inc/pie.php"); ?>


                <img src="images/pix.gif" width="1" height="10">

              </div>

          </div>

        </div>

    </div>



</body>

</html>



<?



?>

