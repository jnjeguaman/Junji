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

<script type="text/javascript" src="librerias/jquery-1.11.3.min.js"></script>
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

.Estilo1b {

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



function aparece1(){

       seccion1.style.display="none";

       seccion2.style.display="";

}

function aparece2(){

       seccion1.style.display="";

       seccion2.style.display="none";

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


function validaGrabar() {

  if(confirm('¿ ESTÁ SEGURO DE PROCEDER CON LA CARGA DE DATOS ?')) {
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

                <table width="500" border="0" cellspacing="0" cellpadding="0">

                  <tr>

                    <td height="20" colspan="2"><span class="Estilo7">COMPROBATE DE PAGO TRANSFERENCIAS</span></td>

                  </tr>

                       <tr>

                       <td><hr></td><td><hr></td>

                      </tr>

                    <tr>

                         <td width="487" valign="top" class="Estilo1c">



<?



if (isset($_GET["llave"]))

 echo "<p>Registros insertados con Exito !";

 

 $id=$_GET["id"];

 $rut=$_GET["rut"];

 

$var=$_GET["var"];



if ($var==1) {

   $sql2 = "delete from dpp_comprobantetrans where cotran_id=$id";

   //echo $sql;

   mysql_query($sql2);





}



 

?>

                         </td>

                      </tr>

                      <tr>

                        <td>

                          <?php if ($_SESSION["pfl_user"] == 31): ?>
                    <a href="menutesoreria.php?cod=124" class="link">Volver</a>
                    <?php else: ?>
                      <a href="menucontabilidad.php?cod=7" class="link">Volver</a>
                  <?php endif ?>
                  
                         </td>

                      </tr>



                       <tr>

                       <td><hr></td><td><hr></td>





                      </tr>



                   <tr>

                  <td height="50" colspan="3">

                    

          <table width="488" border="0" cellspacing="0" cellpadding="0">

          <form name="form1" action="grabacomprobantetranferencia.php" method="post"    enctype="multipart/form-data" onsubmit="return validaGrabar()">

                         <tr>

                             <td  valign="center" class="Estilo1">Fecha Transferencia</td>

                             <td class="Estilo1" valign="center">

<input type="text" name="fecha1" class="Estilo2" size="12" value="<? echo $date_in; ?>" id="f_date_c1" readonly="1">

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

                             <td  valign="center" class="Estilo1">Nº Transferencia</td>

                             <td class="Estilo1" colspan=3>

                              <input type="text" name="nrocomprobante" class="Estilo2" size="10" value="">

                              </td>

                           </tr>



                            <tr>

                             <td  valign="center" class="Estilo1">Subir Archivo Comprobante </td>

                             <td class="Estilo1" colspan=3>

                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <br>

                              <a href="documentosprovee/<? echo $row3["provee_archivo1"]; ?>" class="link" target="_blank"><? echo $row3["provee_archivo1"]; ?></a>

                             </td>

                           </tr>

                           <tr>

                             <td  valign="center" class="Estilo1">Tipo</td>

                             <td class="Estilo1" colspan=3>

                              <input type="radio" name="tipo" class="Estilo2" value="PROVEEDOR" checked>Proveedor

                              <!-- <input type="radio" name="tipo" class="Estilo2" value="FUNCIONARIO">Funcionario -->

                              </td>

                           </tr>





                       <tr>

                       <td><hr></td><td><hr></td>

                    </table>

                     <tr>

                       <td><Br></td>

                      </tr>



                     <tr>

                       <td><Br></td>

                      </tr>





                           <tr>

                             <td colspan=4 align="center"> <input type="submit" value="    GRABAR COMPROBANTE   " > </td>

                           </tr>

                       <input type="hidden" name="id" value="<? echo $id ?>" >

                       <input type="hidden" name="rut" value="<? echo $rut ?>" >







                        </form>



                      </td>





                       <tr>

                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>

                      </tr>

                      





                      <tr>

                      <td colspan="8">

                      

                      

                 <table width="488" border="1" cellspacing="0" cellpadding="0" class="table table-striped table-hover">

                             <tr>

                               <th class="Estilo1b">FECHA</th>

                               <th class="Estilo1b">TIPO</th>

                               <th class="Estilo1b">Nº COMPRABANTE.</th>

                               <th class="Estilo1b">TOTAL</th>

                               <th class="Estilo1b">ARCHIVO ADJUNTO</th>

                               <th class="Estilo1b">VER RELACIONES</th>

                               <td class="Estilo3c"></td>

                              </tr>

<?



$sql3="select cotran_archivo1, cotran_fecha, cotran_nrocomprobante, year(cotran_fecha) as cotrananno, cotran_tipo, cotran_id from dpp_comprobantetrans where cotran_region='$regionsession' order by cotran_id desc LIMIT 0 , 15";

//echo $sql3."<br>";

$result3=mysql_query($sql3);

while ($row3=mysql_fetch_array($result3)) {

    $cotrannrocomprobante=$row3["cotran_nrocomprobante"];

    $cotrananno=$row3["cotrananno"];

    $sql3b="select sum(eta_monto) as total1 from dpp_etapas where eta_ncheque='$cotrannrocomprobante' and eta_region='$regionsession' and eta_fpago='Transferencia' and (eta_tipo_doc3<>'NC' and eta_tipo_doc3<>'NCEL') and year(eta_fechache)='$cotrananno' ";

//   echo $sql3b."<br>";

    $result3b=mysql_query($sql3b);

    $row3b=mysql_fetch_array($result3b);

    $total1=$row3b["total1"];

    $sql3c="select sum(eta_monto) as total2 from dpp_etapas where eta_ncheque='$cotrannrocomprobante' and eta_region='$regionsession' and eta_fpago='Transferencia' and (eta_tipo_doc3='NC' or eta_tipo_doc3='NCEL') and year(eta_fechache)='$cotrananno' ";

//   echo $sql3c."<br>";

    $result3c=mysql_query($sql3c);

    $row3c=mysql_fetch_array($result3c);

    $total2=$row3c["total2"];

    $total1=$total1-$total2;



$read1= rand(0,1000000);





?>

                             <tr>

                               <td class="Estilo1b"><? echo substr($row3["cotran_fecha"],8,2)."-".substr($row3["cotran_fecha"],5,2)."-".substr($row3["cotran_fecha"],0,4)   ?></td>

                               <td class="Estilo1b"><? echo $row3["cotran_tipo"] ?></td>

                               <td class="Estilo1b"><? echo $row3["cotran_nrocomprobante"] ?></td>

                               <td class="Estilo1b"><? echo number_format($total1,0,',','.') ?></td>

                               <td class="Estilo1b"><a href="../../archivos/documentostrans/<? echo $row3["cotran_archivo1"] ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row3["cotran_archivo1"] ?> </a></td>

                               <td class="Estilo1b"><a href="verdoctrans.php?nrocomprobante=<? echo $row3["cotran_nrocomprobante"];  ?>&cotrananno=<? echo $row3["cotrananno"]; ?>" class="link" >Ver Documentos </a></td>

                               <td class="Estilo1c"><a href="comprobantetransferencia.php?id=<? echo $row3["cotran_id"] ?>&var=1" class="link" onclick="return confirm('Seguro que desea Eliminar  ?')"><img src="imagenes/b_drop.png" border=0></a> </td>

                              </tr>





<?





}



?>



</table>







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

