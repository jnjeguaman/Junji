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
<title>Defensoria</title>
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
	font-size: 8px;
	color: #003063;
	text-align: center;
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
.Estilo7 {font-size: 12px; font-weight: bold; }
-->
</style>
<link rel="stylesheet" type="text/css" href="select_dependientes.css">
<script type="text/javascript" src="select_dependientes.js"></script>
<script type="text/javascript" src="ajaxclient.js"></script>
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


function ChequearTodos(chkbox)
{
  for (var i=0;i < document.forms[0].elements.length;i++){
      var elemento = document.forms[0].elements[i];
      if (elemento.type == "checkbox"){
          elemento.checked = chkbox.checked
      }
  }
}
function muestra() {
     if (document.form1.uno.value == 2) {
       seccion1.style.display="";
     } else {
       seccion1.style.display="none";
     }
}
function valida() {
   if (document.form1.uno.value==0 || document.form1.uno.value=='') {
      alert ("No ha seleccionado una Accion ");
      return false;
  }
   if (document.form1.uno.value==2 && document.form1.justifica.value=='') {
      alert ("No ha Justificado ");
      return false;
  }
}
</script>
<body>
<img src="images/pix.gif" width="1" height="10">
<table width="752" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#003063">
  <tr>
    <td width="1009">
	  <?
	  require("inc/top.php");
	  ?>
      <table width="750" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="165" valign="top">
		  <?
		  require("inc/menu_1.php");
		  ?>		  </td>
          <td valign="top"><strong>
            <img src="images/pix.gif" width="1" height="10">
                    </strong>            <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
              <tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="4"><span class="Estilo7">ASIGNACION DE EVALUACIONES INTERNAS</span></td>
                  </tr>
<?
$id=$_GET["id2"];
$id=$_GET["id2"];
$id3=$_GET["id3"];
$sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$evaluara=$row["cont_evaluara"];

?>
                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                         <a href="evaexterna.php?id2=<? echo $id ?>&id3=<? echo $id3 ?>" class="link">Volver</a> /

                         </td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>

                   <tr>
                    <td height="50" colspan="6">


					<table width="520" border="1" cellspacing="0" cellpadding="0">
					  <form name="form1" action="graba_asig_evaint.php" method="post"  onSubmit="return valida()">
<?
$sql="select * from dpp_cont_evaint where contevaint_cont_id=$id order by contevaint_nombre ";
//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$suma=0;
while($row3 = mysql_fetch_array($res3)){
  $suma=$suma+$row3["contevaint_porcen"];
    ?>
                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b"><? echo $row3["contevaint_nombre"]  ?></td>
                         <td class="Estilo1c"><? echo $row3["contevaint_porcen"]  ?> </td>
                         <td class="Estilo1c"><a href="modiinterna.php?id2=<? echo $id ?>&id3=<? echo $id3 ?>&id4=<? echo $row3["contevaint_id"] ?>" class="link" >EDITAR</a> </td>
                         <td class="Estilo1c"><a href="del_continternaitem.php?id2=<? echo $id ?>&id3=<? echo $id3 ?>&id4=<? echo $row3["contevaint_id"] ?>" class="link" >ELIMINAR</a> </td>
                       </tr>

<?
   $cont++;
}
if ($suma<>100) {
    $estilo="Estilo1crojo";
} else {
    $estilo="Estilo1c";
}
?>
                      <tr>
                         <td class="Estilo1d" colspan=2>Total Porcentajes</td>
                         <td class="<? echo $estilo ?>"><? echo $suma ?><td>
                      </tr>


                           <table border=1>
                         
                           <tr>
                           
                             <td  valign="center" class="Estilo1" colspan=5 align="center"><br><input type="submit" name="boton" class="Estilo2" value="  Acepta Cambios "> </td>


                           </tr>




                        <tr>
                         <td class="Estilo1b" colspan=4><input type='checkbox' name='checkbox11' value='checkbox' onClick='ChequearTodos(this);'>TODOS</td>
                        </tr>

                        <tr>
                         <td class="Estilo1b">Op. </td>
                         <td class="Estilo1b">Nombre de la Evaluacion</td>
                         <td class="Estilo1b">Puntaje</td>
                         <td class="Estilo1b">Editar</td>
                        </tr>

<?




   $sql="select * from dpp_evainterna order by evaint_nombre ";
   $res3 = mysql_query($sql);
$cont=1;
while($row3 = mysql_fetch_array($res3)){
?>

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?>
                           <input alt="ok" type="checkbox" name="var[<? echo $cont ?>]" value="<? echo $row3["evaint_id"] ?>" class="Estilo2" >
                         </td>
                         <td class="Estilo1b"><? echo $row3["evaint_nombre"]  ?></td>
                         <td class="Estilo1b"><? echo $row3["evaint_nroitem"]  ?> </td>
                       </tr>

                        



<?

   $cont++;

}
?>


                      <tr>

                               <input type="hidden" name="cont" value="<? echo $cont ?>" >
                               <input type="hidden" name="idcont" value="<? echo $id ?>" >
                               <input type="hidden" name="id3" value="<? echo $id3 ?>" >
                           </form>


</td>
  </tr>

 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
