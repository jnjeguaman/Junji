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

</head>

<body>



<script>
<!--
function valida() {
    if (document.form1.nueva1.value!=document.form1.nueva2.value) {
       alert("Error en Contraseña Nueva y Repeticion de Contrañsea");
       return false;
    }
    if (document.form1.actual.value=='') {
       alert("Error en Contraseña Actual");
       return false;
    }
    if (document.form1.nueva1.value=='') {
       alert("Error en Contraseña Nueva");
       return false;
    }
    if (document.form1.nueva2.value=='') {
       alert("Error en Repetir Contraseña");
       return false;
    }

}
-->
</script>



<div style=" background-color:#FFFFFF; position:absolute; content:''; z-index:3;">
<?
include("inc/menu_1b.php");
?>
</div>

<div  style="width:700px; height:530px; background-color:#E0F8E0; position:absolute; top:120px; left:00px;" id="div1">
<?




?>

<table border=0 width="100%">
  <tr>
   <td  class="Estilo2titulo" colspan="10">CAMBIO DE CONTRASEÑA
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

   </td>
 </tr>
</table>
 <table border=0 width="100%">
 <form name="form1" action="inv_grabacambioclave.php" method="post"  onSubmit="return valida()">
 <tr>
   <td  class="Estilo1">Contraseña Actual</td>
   <td  class="Estilo1"><input type="text" name="actual" class="Estilo2" size="40" value="<? echo $row2["ate_nombres"] ?>" > </td>
 </tr>
 <tr>
   <td  class="Estilo1">Contraseña Nuevo</td>
   <td  class="Estilo1"><input type="text" name="nueva1" class="Estilo2" size="40" value="<? echo $row2["ate_nombres"] ?>" > </td>
 </tr>
 <tr>
   <td  class="Estilo1">Repetir Contraseña</td>
   <td  class="Estilo1"><input type="text" name="nueva2" class="Estilo2" size="40" value="<? echo $row2["ate_nombres"] ?>" > </td>
 </tr>
 <tr>
   <td  class="Estilo1c" colspan=4><input type="submit" class="Estilo1C" value="          REALIZAR CAMBIO       " > </td>
   </tr>


 </form>

</table>
<?
$llave=$_GET["llave"];
if ($llave==1) {
    $aviso="Operacion Realizada Con Éxito !";
}
if ($llave==2) {
    $aviso="No se puedo Realizar La Operación !";
}
?>
<table border=0 width="100%">
 <tr>
   <td  class="Estilo1rojo"><? echo $aviso ?></td>
 </tr>
 





 </div>





</body>
</html>


