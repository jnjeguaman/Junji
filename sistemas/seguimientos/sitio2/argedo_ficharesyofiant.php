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
<title>Ficha</title>
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
$ori=$_GET["ori"];

  if ($ti==1) {
   $prefijo="Resolucion Afecta";

  }
  if ($ti==2) {
   $prefijo="Resolucion Exenta";
  }
  if ($ti==3) {
   $prefijo="Oficio";
  }
  
  if ($ori==1) {
      $volver="argedo_ingresoant.php";
  }
  if ($ori==2) {
      $volver="argedo_consulta.php";
  }
  if ($ori==3) {
      $volver="argedo_resyofi2.php";
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
                    <td height="20" colspan="2"><span class="Estilo7">FICHA </span></td>
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
  $docsfecha=$row22["docs_fecha"];
?>


                   <tr>
             			<td height="50" colspan="3">
                     </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <form name="form1" action="argedo_grabaeditresyofi.php" method="post"  onSubmit="return valida()"   enctype="multipart/form-data">


                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"><a href="<? echo $volver ?>?ti=<? echo $ti ?>" class="link" >VOLVER</a> <br> </td>
                           </tr>
                            <tr>
                             <td  valign="top" class="Estilo1" colspan="2"> <br> </td>
                           </tr>


                           <tr>
                             <td  valign="center" class="Estilo1">Folio</td>
                             <td class="Estilo1" valign="center" width="700"><? echo $row22["docs_folio"]; ?>


                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Fecha Recepción Of. Partes</td>
                             <td class="Estilo1" valign="center" width="700"><? echo $docsfechaparte ?>


                             </td>
                           </tr>
                          <tr><td><br></td><tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Regi&oacute;n</td>
                             <td class="Estilo1">

                                 <?

                                    $sql2 = "Select * from regiones where codigo=$regionsession";
                                  //echo $sql;
                                  $res2 = mysql_query($sql2);

                                   $row2 = mysql_fetch_array($res2);

                                 ?>
                                    <? echo $row2["nombre"] ?>


                               </select>


                             </td>
                      </tr>
                            <tr><td><br></td><tr>
                         <tr>
                             <td  valign="center" class="Estilo1">Fecha Documento</td>
                             <td class="Estilo1"><? echo $docsfecha ?>


                            </td>
                           </tr>

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
                           <tr>
                             <td  valign="center" class="Estilo1">TIPO DOCUMENTO</td>
                             <td class="Estilo1" valign="center" width="700"><? echo $row22["docs_documento"]; ?>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>AREA</td>
				             <td class="Estilo1"><br><? echo $docsarea; ?>
                             </td>
                           </tr>
                           <tr>
                             <td valign="center" class="Estilo1"><br>SUBAREA</td>
                             <td class="Estilo1"><br><? echo $docssubarea; ?>
                             </td>
                            </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>TRAMITE  </td>
                             <td class="Estilo1" colspan=3> <? echo $row22["docs_tramite"]; ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>MATERIA  </td>
                             <td class="Estilo1" colspan=3><? echo $row22["docs_materia"];  ?>
                             </td>
                           </tr>
<?
if ($ti==3) {
?>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>Tipo de Documento</td>
                             <td class="Estilo1" colspan=4><br><? echo  $row22["docs_tipodoc"]; ?>

                             </td>
                           </tr>
<?
}
?>
                            <tr>
                             <td  valign="center" class="Estilo1" width="340"><br>DESTINATARIO  </td>
                             <td class="Estilo1" colspan=3><br><? echo $row22["docs_destinatario"];  ?>
                             </td>
                           </tr>


                            <tr>
                             <td  valign="center" class="Estilo1"><br>OBSERVACION  </td>
                             <td class="Estilo1" colspan=3><br><? echo $row22["docs_obs"];  ?>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>ARCHIVO 1  </td>
                             <td class="Estilo1" colspan=3><br>
                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo"]; ?>" class="link" target="_blank"><? echo $row22["docs_archivo"]; ?></a></td>
                             </td>
                           </tr>

                            <tr>
                             <td  valign="center" class="Estilo1"><br>ARCHIVO 2 </td>
                             <td class="Estilo1" colspan=3><br>
                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo2"]; ?>" class="link" target="_blank"><? echo $row22["docs_archivo2"]; ?></a></td>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ARCHIVO 3 </td>
                             <td class="Estilo1" colspan=3><br>
                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo3"]; ?>" class="link" target="_blank"><? echo $row22["docs_archivo3"]; ?></a></td>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1"><br>ARCHIVO 4 </td>
                             <td class="Estilo1" colspan=3><br>
                              <a href="../../archivos/docargedo/<? echo $row22["docs_archivo4"]; ?>" class="link" target="_blank"><? echo $row22["docs_archivo4"]; ?></a></td>
                             </td>
                           </tr>


                      </tr>
                     <tr>
                       <td><hr></td><td><hr></td>


                      </tr>


                           <tr>
                               <td  valign="center" class="Estilo1"><br>  </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>

                           <tr>
                               <td  valign="center" class="Estilo1"><br> </td>
                               <td  valign="center" class="Estilo1"> </td>

                           </tr>


                        </form>

                      </td>




                      <tr>
                      <td colspan="8">
                      <table border=1>

<br>



                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
