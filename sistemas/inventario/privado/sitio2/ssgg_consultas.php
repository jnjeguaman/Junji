<?
session_start();
require("inc/config.php");
include("Includes/FusionCharts.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$fechamia2=date('d-m-Y');
$hora=date("H:i");
extract($_GET);
extract($_POST);
//exit();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>bienvenidos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/stylo_defensoriapenal.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="Javascript" SRC="grafico/FusionCharts.js"></SCRIPT>

</head>

<body>

<!-- calendar stylesheet -->
  <link rel="stylesheet" type="text/css" media="all" href="librerias/calendar-win2k-cold-1.css" title="win2k-cold-1" />

  <!-- main calendar program -->
  <script type="text/javascript" src="librerias/calendar.js"></script>

  <!-- language for the calendar -->
  <script type="text/javascript" src="librerias/lang/calendar-en.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

<script>
<!--



function validar() {

  if (document.form1.rut.value=='') {
      alert("Rut Presenta Problemas");
      return false;
  }
  if (document.form1.dig.value=='')  {
      alert("Digito Presenta Problemas");
      return false;
  }
  if (document.form1.nombre.value=='') {
      alert("Nombre Presenta Problemas");
      return false;
  }
  if (document.form1.mail.value=='') {
      alert("Email Presenta Problemas");
      return false;
  }
  if (document.form1.tipo.value=='') {
      alert("Tipo Presenta Problemas");
      return false;
  }
  if (document.form1.requerimiento.value=='') {
      alert("Requerimiento Presenta Problemas");
      return false;
  }




}



function limpiar() {
    document.form1.dig.value="";
    document.form1.id.value="";
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
//            nombre2.innerText=elem[0];
            document.form1.nombre.value=elem[0];
            document.form1.mail.value = elem[1];
            document.form1.id.value = elem[2];



		}
	}
}


-->
</script>


<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
<?
include("inc/menu_1b.php");
?>
</div>

<div  style="width:700px; height:530px; background-color:#E0F8F7; position:absolute; top:120px; left:00px;" id="div1">
<?




?>

<table border=0 width="100%">
  <tr>
   <td  class="Estilo2titulo" colspan="10">INGRESO NUEVO REQUERIMIENTO
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   </td>
 </tr>
</table>
 
 <form name="form1" action="ssgg_consultas.php" method="post"   onSubmit="return validar()"  enctype="multipart/form-data">


<table border=0 width="100%">
                         <tr>
<!--
   <td  class="Estilo1">RUT</td>
   <td  class="Estilo1">
   <input type="text" name="rut" class="Estilo2" size="11" onchange="limpiar()" > -
   <input type="text" name="dig" class="Estilo2" size="2" onChange="verificador()">
   </td>

                             <td  valign="center" class="Estilo1">FECHA </td>
                             <td class="Estilo1" valign="center">
<input type="text" name="fecha2" class="Estilo2" size="12" value="<? echo $fechamia; ?>" id="f_date_c2" readonly="1">
<img src="calendario.gif" id="f_trigger_c2" style="cursor: pointer; border: 1px solid red;" title="Date selector"
      onmouseover="this.style.background='red';" onMouseOut="this.style.background=''" />

 <script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c2",     // id of the input field
        ifFormat       :    "%d-%m-%Y",      // format of the input field
        button         :    "f_trigger_c2",  // trigger for the calendar (button ID)
        align          :    "Bl",           // alignment (defaults to "Bl")
        singleClick    :    true
    });
</script>


                             </td>
                           </tr>
-->
 <tr>
   <td  class="Estilo1">NOMBRE</td>
   <td  class="Estilo1">
   <input type="text" name="nombre" class="Estilo2" size="20" value="<? echo $row2["ate_nombres"] ?>" >
  </td>
   </td>
 </tr>
 <tr>
   <td  class="Estilo1">TIPO</td>
   <td  class="Estilo1">
          <select name="tipo" class="Estilo2">
               <option value="">Seleccione...</option>
               <option value="Reparaciones Varias">Reparaciones Varias</option>
               <option value="Inspeccion General">Inspeccion General</option>
               <option value="Emergencias o Urgencias">Emergencias o Urgencias</option>
               <option value="Otros">Otros</option>
          </select>
   </td>
 </tr>
  <tr>
   <td  class="Estilo1">REQUERIMIENTO</td>
   <td  class="Estilo1" colspan=3><textarea name="requerimiento" rows="2" cols="60"><? echo $row["cont_nombre1"]; ?></textarea> </td>
 </tr>

 <tr>
   <td  class="Estilo1c" colspan=4 >
   <input type="submit" name="submit" class="Estilo2" size="11" value="    Buscar    " >
   </td>
 </tr>


 </table>


<BR>



<BR>


      <input type="hidden" name="ori" value="1" >

</form>

<hr>
   <div id="seccion1" style="background-color:#E0F8F7;" >
<table border=0 width="100%">
 <tr>
   <td  class="Estilo2titulo" colspan="10">ULTIMOS REQUERIMIENTOS</td>
 </tr>

 <tr>
   <td  class="Estilo1mc">FOLIO</td>
   <td  class="Estilo1mc">RUT</td>
   <td  class="Estilo1mc">FECHA</td>
   <td  class="Estilo1mc">NOMBRE</td>
   <td  class="Estilo1mc">EMAIL</td>
   <td  class="Estilo1mc">TIPO</td>
   <td  class="Estilo1mc">REQUERIMIENTO</td>
   
   <td  class="Estilo1mc">VER</td>

 </tr>

<?
if ($nombre<>'') {
    $where1=" soli_nombre like '%$nombre%' and ";
}
     $sql2 = "Select * from ssgg_solicitud where $where1  1=1 order by soli_id desc limit 0,120 ";
//     echo $sql2;
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo1mc";
       } else {
          $estilo2="Estilo1mcblanco";
       }
       

?>
 <tr>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["soli_id"] ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo substr($row2["soli_fecha"],8,2)."-".substr($row2["soli_fecha"],5,2)."-".substr($row2["soli_fecha"],0,4) ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["soli_rut"] ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["soli_nombre"] ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["soli_mail"] ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["soli_tipo"] ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["soli_solicitud"] ?></td>
   <td  class="<? echo $estilo2 ?>"><a href="ssgg_consultas.php?ori=2&id=<? echo $row2["soli_id"] ?>" class="link">VER</a></td>
  </tr>

<?
     $cont++;
    }
?>

</table>



 </div>

</div>

<?
if ($id<>"") {
?>

<div  style="width:630px; height:130px; background-color:#E0F8F7; position:absolute; top:120px; left:710px;" id="div2">

<?

    $sql2 = "Select * from ssgg_solicitud where soli_id=$id ";
//     echo $sql2;
     $res2 = mysql_query($sql2);
     $cont=1;
     $row2 = mysql_fetch_array($res2);
     
     $solifecha= substr($row2["soli_fecha"],8,2)."-".substr($row2["soli_fecha"],5,2)."-".substr($row2["soli_fecha"],0,4);

?>

<table border=0 width="100%">
                         <tr>
   <td  class="Estilo1">RUT</td>
   <td  class="Estilo1">
   <? echo  $row2["soli_rut"] ?>- <? echo $row2["soli_dig"]  ?>
   </td>
                             <td  valign="center" class="Estilo1">FECHA </td>
                             <td class="Estilo1" valign="center">
<? echo $solifecha; ?>


                             </td>
                           </tr>
 <tr>
   <td  class="Estilo1">NOMBRE</td>
   <td  class="Estilo1">
  <? echo $row2["soli_nombre"] ?>
   </td>
   <td  class="Estilo1">EMAIL</td>
   <td  class="Estilo1">
<? echo $row2["soli_mail"] ?>
   </td>
 </tr>
 <tr>
   <td  class="Estilo1">TIPO</td>
   <td  class="Estilo1">
  <? echo $row2["soli_tipo"] ?>
   </td>
 </tr>
  <tr>
   <td  class="Estilo1">REQUERIMIENTO</td>
      <td  class="Estilo1">
  <? echo $row2["soli_solicitud"]; ?>
  </td>
 </tr>




 </table>
 

 



 </div>

<div  style="width:630px; height:280px; background-color:#E0F8F7; position:absolute;  top:280px; left:710px;" id="div2">
<?

    $sql2 = "Select * from ssgg_solicitud where soli_id=$id ";
//     echo $sql2;
     $res2 = mysql_query($sql2);
     $cont=1;
     $row2 = mysql_fetch_array($res2);

     $solifecha= substr($row2["soli_fecha"],8,2)."-".substr($row2["soli_fecha"],5,2)."-".substr($row2["soli_fecha"],0,4);

?>


 <hr>
  <form name="form2" action="ssgg_grabaestadoindex.php" method="post"   onSubmit="return validar2()"  enctype="multipart/form-data">


<table border=0 width="100%">
 <tr>
   <td  class="Estilo2titulo" colspan="10">HISTORIAL DE GESTIONES</td>
 </tr>
 <tr>
   <td  class="Estilo1mc">N°</td>
   <td  class="Estilo1mc">FECHA</td>
   <td  class="Estilo1mc">OBSERVACION</td>
 </tr>

<?
     $sql2 = "Select * from ssgg_gestion where ges_soli_id=$id order by ges_id desc ";
//     echo $sql2;
     $res2 = mysql_query($sql2);
     $cont=1;
     while ($row2 = mysql_fetch_array($res2)) {
       $estilo=$cont%2;
       if ($estilo==0) {
          $estilo2="Estilo1mc";
       } else {
          $estilo2="Estilo1mcblanco";
       }

?>
 <tr>
   <td  class="<? echo $estilo2 ?>"><? echo $cont ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo substr($row2["ges_fecha"],8,2)."-".substr($row2["ges_fecha"],5,2)."-".substr($row2["ges_fecha"],0,4) ?></td>
   <td  class="<? echo $estilo2 ?>"><? echo $row2["ges_obs"] ?></td>
  </tr>

<?
     $cont++;
    }
?>


 </table>






 </div>




<?
}
?>




</body>
</html>


