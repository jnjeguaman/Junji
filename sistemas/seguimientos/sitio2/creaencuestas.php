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
                    <td height="20" colspan="4"><span class="Estilo7">CREAR ENCUESTAS EXTERNAS</span></td>
                  </tr>
                       <tr>
                       <td><hr></td>
                      </tr>
<?
$id=$_GET["id2"];
$id3=$_GET["id3"];
$sql="select * from dpp_contratos where cont_id=$id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

?>
               <tr>
                      <td>
                          <a href="evaexterna.php?id2=<? echo $id ?>" class="link">Volver Evaluacion Externa</a> /
                          <a href="asignarevalucionesext.php?id2=<? echo $id ?>" class="link">Volver Asigna Evaluaciones</a> /
                       </td>
                     </tr>
                   <tr>
                    <td height="50" colspan="6">





            <table width="488" border="1" cellspacing="0" cellpadding="0">
            
            
                      <tr>
                             <td  valign="center" class="Estilo1">Rut Empresa:  <? echo $row["cont_rut"]."-".$row["cont_dig"]; ?>  </td>
                             <td class="Estilo1" colspan=3>Nombre Empresa :  <? echo $row["cont_nombre"]; ?>       </td>
                           </tr>
                          <tr>
                             <td  valign="center" class="Estilo1">Tipo de Contrato : <? echo $row["cont_tipo"]; ?>  </td>
                             <td class="Estilo1" colspan=3>Contrato :  <? echo $row["cont_contrato"]; ?>            </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Contrato :<? echo $row["cont_nombre1"]; ?></td>
                             <td class="Estilo1" colspan=3>

                             </td>
                           </tr>
            

            </table>
<?

if ($id3=="")
  $id3=0;
$sql2="select * from dpp_cont_evaext where contevaext_id=$id3";
//echo $sql2;
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);

?>
<form name="form1" action="grabacreaencuestas.php" method="post">
            <table width="488" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                             <td   class="Estilo1">Nombre Encuesta  </td>
                             <td class="Estilo1" >
                              <textarea name="nombre" class="Estilo2" rows=3 cols=60><? echo $row2["contevaext_nombre"]  ?></textarea>
                             </td>
                           </tr>



                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Grabar  "> </td>


                           </tr>
                            <input type="hidden" name="id2" value="<? echo $id ?>" >
                            <input type="hidden" name="id3" value="<? echo $id3 ?>" >

                        </form>

                      </td>


                       <tr>
                       <td colspan="2"><hr></td>
                      </tr>
                      <tr>


<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
