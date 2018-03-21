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
<title>CONTRATOS</title>
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
.Estilo2c {
	font-family: Verdana;
	font-size: 10px;
	text-align: center;
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
font-size: 14px; font-weight: bold; }

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




//-->

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
          <td valign="top">           <table width="530" border="0" cellspacing="0" cellpadding="0">
            </table>
            <table width="529" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/tab1.gif" width="530" height="23"></td>
              </tr>
               <tr>
<tr>
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">EVALUACIONES POR CONTRATO</span></td>
                  
</tr>
               <tr>
                      <td>
                          <a href="aevaluar.php" class="link" colspan="40">Volver</a>
                       </td>
                     </tr>




<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";

$id=$_GET["id2"];
$sql="select * from dpp_contratos where cont_id=$id";
//$sql="select * from dpp_contratos x, dpp_evaexterna y where x.cont_id=$id and x.cont_id=y.evaext_cont_id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

?>

                           
<tr>
                             <td  valign="center" class="Estilo1">Nombre Contrato  </td>
                             <td class="Estilo1" colspan=3  width="670">
                                 <? echo $row["cont_nombre1"]; ?>
                             </td>
                            </tr>






</table>





<table>


                    <tr>
                         <td width="487" valign="top" class="Estilo1">
                      </td>
                      </tr>



                   <tr>
                    <tr>
                       <td><hr></td><td><hr></td>

                      </tr>

                    <td height="50" colspan="3">
                         <a href="creaencuestas.php?id2=<? echo $id ?>" class="link">Crear Nueva Evaluación</a> /
                    </td>
                   </tr>
                    <tr>
                       <td><hr></td><td><hr></td>

                      </tr>


					<table width="520" border="1" cellspacing="0" cellpadding="0">
					  <form name="form1" action="grabaevaexterna.php" method="post" >

                           </table>
<?
$sql4="select * from dpp_encuestas where encu_cont_id=$id and encu_tipo=1 and encu_estado=1 order by encu_id desc";
//echo $sql4;
$result4=mysql_query($sql4);
$row4=mysql_fetch_array($result4);
$encuid=$row4["encu_id"];



?>
                           <table border="1">
                             <tr>
                               <td  valign="center" class="Estilo1c" rowspan="2">NOMBRE EVALUACIÓN</td>
                               <td  valign="center" class="Estilo1c" rowspan="2">AÑO</td>
                               <td  valign="center" class="Estilo1c" colspan="2"><a href="asignarevalucionesext.php?id2=<? echo $id ?>&id3=<? echo $encuid ?>" class="link">EXTERNA</a> </td>
                               <td  valign="center" class="Estilo1c" colspan="2"><a href="asignarevalucionesint.php?id2=<? echo $id ?>&id3=<? echo $encuid ?>" class="link">INTERNA</a> </td>
                               <td  valign="center" class="Estilo1c" colspan="2"><a href="asignarevalucionesusu.php?id2=<? echo $id ?>&id3=<? echo $encuid ?>" class="link">USUARIO</a> </td>
                               <td  valign="center" class="Estilo1c" rowspan="2">PROME.</td>
                               <td  valign="center" class="Estilo1c" rowspan="2">ANALISIS</td>
                               <td  valign="center" class="Estilo1c" rowspan="2">IMPRIMIR</td>
                               <td  valign="center" class="Estilo1c" rowspan="2">EXCEL</td>
                             </tr>
                             <tr>
                               <td  valign="center" class="Estilo1c" >NOTA</td>
                               <td  valign="center" class="Estilo1c" > % </td>
                               <td  valign="center" class="Estilo1c" >NOTA</td>
                               <td  valign="center" class="Estilo1c" > % </td>
                               <td  valign="center" class="Estilo1c" >NOTA</td>
                               <td  valign="center" class="Estilo1c" > % </td>
                             </tr>
<?
$sql4="select * from dpp_encuestas where encu_cont_id=$id and encu_tipo=1 order by encu_id desc";
//echo $sql2;
$result4=mysql_query($sql4);
while ($row4=mysql_fetch_array($result4)) {
     $encuestado=$row4["encu_estado"];
     if ($row4["encu_estado"]==1) {
        $nombrevig=$row4["encu_nombre"];
        $idvig=$row4["encu_id"];

     }


?>
                           <tr>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_nombre"]; ?></td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_periodo"]; ?> </td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_ext_nota"]; ?> </td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_ext_por"]; ?> </td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_int_nota"]; ?> </td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_int_por"]; ?> </td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_usu_nota"]; ?> </td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_usu_por"]; ?> </td>
                             <td  valign="center" class="Estilo1c" ><? echo $row4["encu_promedio"]; ?> </td>
<?
 if ($encuestado==1) {
?>
                             <td  valign="center" class="Estilo1c" ><a href="edi_evaexterna.php?id2=<? echo $id ?>&id41=<? echo $row4["encu_id"] ?>" class="link">Editar</a></td>
<?
} else {
?>
                             <td  valign="center" class="Estilo1c" ><a href="edi_evaexterna.php?id2=<? echo $id ?>&id41=<? echo $row4["encu_id"] ?>&sw2=1" class="link">Ver</a></td>
<?
}
?>
                             <td  valign="center" class="Estilo1c" ><a href="imp_encuestacontrato.php?id2=<? echo $id ?>&id3=<? echo $row4["encu_id"] ?>" class="link" target="_blank">Imprimir</a></td>
                             <td  valign="center" class="Estilo1c" ><a href="exportexcelcontrato.php?id2=<? echo $id ?>&id3=<? echo $row4["encu_id"] ?>" class="link" target="_blank">Excel</a></td>
                             <td  valign="center" class="Estilo1c" ><a href="evaexterna2.php?id2=<? echo $id ?>&id3=<? echo $row4["encu_id"] ?>" class="link"></a></td>
                           </tr>
<?
}
?>
                           </table>
                           <hr>
                           <hr>




                      <tr>
                      <td colspan="8">
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
