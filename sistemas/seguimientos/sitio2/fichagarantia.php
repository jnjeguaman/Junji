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

		}
	}
}

function traerDatos2(a,b,c)  {
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
                    <td height="20" colspan="2"><span class="Estilo7">FICHA CONSULTA GARANTIA</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>


<?

if (isset($_GET["llave"]))
 echo "<p>Registros Operados con Exito !";

$id=$_GET["id"];
$id2=$_GET["id2"];
$ori=$_GET["ori"];
$rut=$_GET["rut"];
$id2=$_GET["id2"];
$sql5="select * from dpp_boletasg where boleg_id=$id";
//echo $sql;
$res5 = mysql_query($sql5);
$row5=mysql_fetch_array($res5);
$boleg_id=$row5["boleg_id"];

if ($ori=='') {
    $volver="consultasgarantia.php";
}
if ($ori=='2') {
    $volver="buscarboletasg.php?id=$id2&rut=$rut";
}
?>
                         <td width="487" valign="top" class="Estilo1"><br>
                         <a href="<? echo $volver ?>" class="link">VOLVER</a>
                         </td>
                      </tr>
                       <tr>
                       
                      </tr>


                   <tr>
                    <td height="50" colspan="3">
                    </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped bbyss">

                           
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=8><hr></td>
                           </tr>
                            <input type="hidden" name="id" value="<? echo $id  ?>">
                       </form>
					  <form name="form1" action="documentosg/grababoletasgarchivo.php" method="post"  onSubmit="return valida()"  enctype="multipart/form-data">


                           <tr>
                             <td  valign="center" class="Estilo1">Fecha Recepción</td>
                             <td class="Estilo1" valign="center">
                               <? echo $row5["boleg_fecha_recep"] ?>

                                 Folio  <? echo $row5["boleg_folio"] ?>
<?
$hora=substr($row5["boleg_hora_recep"],0,2);
$min=substr($row5["boleg_hora_recep"],3,2);
//echo "$hora : $min ";
//$row5["boleg_hora"]
?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1" width="180">Hora de Recepción  </td>
                             <td class="Estilo1" colspan=3>Hora:
                              <? echo $row5["boleg_hora_recep"] ?>

                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Tipo de Documento</td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row5["boleg_tipo2"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=8><hr></td>
                           </tr>


                           <tr>
                             <td  valign="center" class="Estilo1">Tipo de Garantía </td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row5["boleg_tipo"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Número Documento </td>
                             <td class="Estilo1" colspan=3>
                              <? echo $row5["boleg_numero"] ?>
                             </td>
                            </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Institución Emisora</td>
                             <td class="Estilo1" colspan=3>
                                <? echo $row5["boleg_emisora"] ?>
                             </td>
                            </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Monto</td>
                             <td class="Estilo1" colspan=3>
                               <? echo $row5["boleg_monto"] ?>
                             </td>
                            </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Emisión</td>
                             <td class="Estilo1" valign="center">
                                <? echo $row5["boleg_fecha_emision"] ?>
                             </td>
                           </tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Vencimiento</td>
                             <td class="Estilo1" valign="center">
                               <? echo $row5["boleg_fecha_vence"] ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1">Rut  </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row5["boleg_rut"] ?> -<? echo $row5["boleg_dig"] ?>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="top" class="Estilo1">Razón Social </td>
                             <td class="Estilo1" colspan=3>
                               <? echo $row5["boleg_nombre"] ?>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="top" class="Estilo1">Glosa de la Garantía  </td>
                             <td class="Estilo1" colspan=3>
                                 <? echo $row5["boleg_glosa"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Dirección </td>
                             <td class="Estilo1" colspan=3>
                                <? echo $row5["boleg_direccion"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Fono </td>
                             <td class="Estilo1" colspan=3>
                                <? echo $row5["boleg_fono2"] ?>
                             </td>
                           </tr>
                           
                           <tr>
                             <td  valign="top" class="Estilo1">Correo Electrónico</td>
                             <td class="Estilo1" colspan=3>
                               <? echo $row5["boleg_correo"] ?>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="top" class="Estilo1">Nombre Unidad Contacto </td>
                             <td class="Estilo1" colspan=3>
                                <? echo $row5["boleg_unidad"] ?>
                             </td>
                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=8><hr></td>
                           </tr>
       
                            <tr>
                             <td  valign="center" class="Estilo1">Imagen Boleta </td>
                             <td class="Estilo1" colspan=3>
                             
                              <a href="../../archivos/docgarantia/<? echo $row5["boleg_archivo"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["boleg_archivo"]; ?></a>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Formulario(Registro y Control) </td>
                             <td class="Estilo1" colspan=3>

                              <a href="../../archivos/docgarantia/<? echo $row5["boleg_archivo2"]; ?>?read2=<? echo $read2 ?>" class="link" target="_blank"><? echo $row5["boleg_archivo2"]; ?></a>
                             </td>
                           </tr>
                           <tr>
                               <td  valign="center" class="Estilo1"><br><br><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <input type="hidden" name="id" value="<? echo $id  ?>">
                             <input type="hidden" name="sw" value="3">
                           </tr>


 <tr>
                             <td  valign="top" class="Estilo1">Comentario </td>
                             <td class="Estilo1" colspan=3>
                                <? echo $row5["boleg_comentario"] ?>
                             </td>
                           </tr>

<tr>
                             <td  valign="top" class="Estilo1">Estado </td>
                             <td class="Estilo1" colspan=3>
                                <? echo $row5["boleg_estado"] ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Documento </td>
                             <td class="Estilo1" colspan=3>
                              <a href="../../archivos/docgarantia/<? echo $row5["boleg_archivocierre"]; ?>?read1=<? echo $read1 ?>" class="link" target="_blank"><? echo $row5["boleg_archivocierre"]; ?></a>
                             </td>
                           </tr>


                        </form>




                           <tr>
                             <td  valign="center" class="Estilo1" colspan=8><hr></td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Email 1 </td>
                             <td class="Estilo1" colspan=3>
                              <input type="checkbox" name="envia1" class="Estilo2" value="1">
                              <input type="hidden" name="mail1" class="Estilo2" size="40" value="<? echo $row5["boleg_mail1"] ?>"><? echo $row5["boleg_mail1"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Email 2 </td>
                             <td class="Estilo1" colspan=3>
                              <input type="checkbox" name="envia2" class="Estilo2" value="1">
                              <input type="hidden" name="mail2" class="Estilo2" size="40" value="<? echo $row5["boleg_mail2"] ?>"><? echo $row5["boleg_mail2"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Email 3 </td>
                             <td class="Estilo1" colspan=3>
                              <input type="checkbox" name="envia3" class="Estilo2" value="1">
                              <input type="hidden" name="mail3" class="Estilo2" size="40" value="<? echo $row5["boleg_mail3"] ?>"><? echo $row5["boleg_mail3"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Email 4 </td>
                             <td class="Estilo1" colspan=3>
                              <input type="checkbox" name="envia4" class="Estilo2" value="1">
                              <input type="hidden" name="mail4" class="Estilo2" size="40" value="<? echo $row5["boleg_mail4"] ?>"><? echo $row5["boleg_mail4"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1">Email 5 </td>
                             <td class="Estilo1" colspan=3>
                              <input type="checkbox" name="envia5" class="Estilo2" value="1">
                              <input type="hidden" name="mail5" class="Estilo2" size="40" value="<? echo $row5["boleg_mail5"] ?>"><? echo $row5["boleg_mail5"] ?>
                             </td>
                           </tr>
                           
                           
				<tr>
                               <td  valign="center" class="Estilo1"><br></td>
                                </tr>


                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2">1° Envío(20 días): <? echo $row5["boleg_fecha1"] ?>

                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2">2° Envío(10 días): <? echo $row5["boleg_fecha2"] ?>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2">3° Envío(05 días): <? echo $row5["boleg_fecha3"] ?>

                             </td>
                           </tr>
                           <tr>
                             <td  valign="top" class="Estilo1" colspan="2">4° Envío(01 días): <? echo $row5["boleg_fecha4"] ?>
                             </td>
                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br><br><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                             <input type="hidden" name="id" value="<? echo $id  ?>">
                             <input type="hidden" name="sw" value="3">
                           </tr>




                      </td>


                       <tr>
                       <td><hr></td><td><hr></td><td><hr></td><td><hr></td>
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
