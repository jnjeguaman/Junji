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
.Estilo1c {
	font-family: Verdana;
	font-weight: bold;
	font-size: 10px;
	color: #003063;
	text-align: center;
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
	font-size: 10px;
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
font-weight: bold;}

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

function calcular(){
    document.form1.promedio.value=(Math.round(document.form1.nota1.value*document.form1.por1.value/100)+Math.round(document.form1.nota2.value*document.form1.por2.value/100)+Math.round(document.form1.nota3.value*document.form1.por3.value/100));

}



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
                <td align="center" background="images/tabfon.gif"><table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">EVALUACIÓN FINAL</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";

$id=$_GET["id2"];
$id41=$_GET["id41"];
$sw2=$_GET["sw2"];
$sql="select * from dpp_contratos where cont_id=$id";
//$sql="select * from dpp_contratos x, dpp_evaexterna y where x.cont_id=$id and x.cont_id=y.evaext_cont_id";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


?>

               <tr>
                      <td>
                          <a href="evaexterna.php?id2=<? echo $id ?>" class="link" colspan="40">Volver</a>
                       </td>
                     </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Contrato  </td>
                             <td class="Estilo1" colspan=3  width="670">
                                 <? echo $row["cont_nombre1"]; ?>
                             </td>
                            </tr>
</table>
<hr>
<table>


                   <tr>
                   
                    <td height="50" colspan="3">

					<table width="540" border="1" cellspacing="0" cellpadding="0">
					  <form name="form1" action="documentoscont/grabaedi_evaexterna.php" method="post"  enctype="multipart/form-data" >

                           </table>
                           <table border="1">
                             <tr>
                               <td  valign="center" class="Estilo1c" rowspan="2" width="350">Periodo </td>
                               <td  valign="center" class="Estilo1c" colspan="2">Externa </td>
                               <td  valign="center" class="Estilo1c" colspan="2">Interna </td>
                               <td  valign="center" class="Estilo1c" colspan="2">Usuario </td>
                               <td  valign="center" class="Estilo1c" rowspan="2">Promedio</td>
                             </tr>
                             <tr>
                               <td  valign="center" class="Estilo1c" >Not </td>
                               <td  valign="center" class="Estilo1c" > % </td>
                               <td  valign="center" class="Estilo1c" >Not </td>
                               <td  valign="center" class="Estilo1c" > % </td>
                               <td  valign="center" class="Estilo1c" >Not </td>
                               <td  valign="center" class="Estilo1c" > % </td>
                             </tr>


<?
$sql41="select * from dpp_encuestas where encu_cont_id =$id and encu_id=$id41";
//echo $sql2;
$result41=mysql_query($sql41);
while ($row41=mysql_fetch_array($result41)) {
    $decision=$row41["encu_decision"];
?>
                             <tr>
                               <td  valign="center" class="Estilo1c" ><? echo $row41["eva_periodo"] ?> </td>
                               <td  valign="center" class="Estilo1c" ><input type="text" name="nota1" class="Estilo2" size="4" value="<? echo $row41["encu_ext_nota"] ?>" onKeyUp="calcular()" ></td>
                               <td  valign="center" class="Estilo1c" ><input type="text" name="por1" class="Estilo2" size="4" value="<? echo $row41["encu_ext_por"] ?>" onKeyUp="calcular()"></td>
                               <td  valign="center" class="Estilo1c" ><input type="text" name="nota2" class="Estilo2" size="4" value="<? echo $row41["encu_int_nota"] ?>" onKeyUp="calcular()"> </td>
                               <td  valign="center" class="Estilo1c" ><input type="text" name="por2" class="Estilo2" size="4" value="<? echo $row41["encu_int_por"] ?>" onKeyUp="calcular()"></td>
                               <td  valign="center" class="Estilo1c" ><input type="text" name="nota3" class="Estilo2" size="4" value="<? echo $row41["encu_usu_nota"] ?>" onKeyUp="calcular()"> </td>
                               <td  valign="center" class="Estilo1c" ><input type="text" name="por3" class="Estilo2" size="4" value="<? echo $row41["encu_usu_por"] ?>" onKeyUp="calcular()"></td>
                               <td  valign="center" class="Estilo1c" ><input type="text" name="promedio" class="Estilo2" size="4" value="<? echo $row41["encu_promedio"] ?>" > </td>
                             </tr>

                           
                           
                           <tr>
                             <td  valign="center" class="Estilo1">Obs. Externa</td>
                             <td class="Estilo1" colspan="17">
                              <textarea name="analisisext" rows="4" cols="52"><? echo $row41["encu_analisisext"]; ?></textarea>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Obs. Interna</td>
                             <td class="Estilo1" colspan="17">
                              <textarea name="analisisint" rows="4" cols="52"><? echo $row41["encu_analisisint"]; ?></textarea>
                             </td>
                           </tr>
                           <tr>
                             <td  valign="center" class="Estilo1">Obs. Usuario</td>
                             <td class="Estilo1" colspan="17">
                              <textarea name="analisisusu" rows="4" cols="52"><? echo $row41["encu_analisisusu"]; ?></textarea>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Decisión </td>
                               <td  valign="center" class="Estilo1c" colspan="7">
                               <input type="radio" name="decision" class="Estilo2" value="Renovar" <? if ($decision=='Renovar') echo "checked" ?> > Renovar
                               <input type="radio" name="decision" class="Estilo2" value="Terminar"   <? if ($decision=='Terminar') echo "checked" ?>  >  Terminar
                               </td>
                            </tr>




                           <tr>
                             <td  valign="center" class="Estilo1">Análisis Final</td>
                             <td class="Estilo1" colspan="17">
                              <textarea name="analisis" rows="4" cols="52"><? echo $row41["encu_analisis"]; ?></textarea>
                             </td>
                           </tr>


                           <tr>
                             <td  valign="center" class="Estilo1">Antecedentes Medio de Verificación</td>
                             <td class="Estilo1" colspan="17">
                              <textarea name="analisisotro" rows="4" cols="52"><? echo $row41["encu_analisisotro"]; ?></textarea>
                             </td>
                           </tr>

                           
                           
                           
                          <tr>
                             <td  valign="center" class="Estilo1">Archivo EXT </td>
                             <td class="Estilo1" colspan=3>
                              <input type="file" name="archivo1" class="Estilo2" size="20"  > <BR>
                               <a href="documentoscont/filesencu/<? echo $row41["encu_archivo"] ?>" class="link" target="_blank" ><? echo $row41["encu_archivo"] ?></a>
                             </td>
                           </tr>


                          <tr>
                             <td  valign="center" class="Estilo1" >Archivo INT</td>
                             <td class="Estilo1" colspan=6>
                              <input type="file" name="archivo2" class="Estilo2" size="20"  > <BR>
                               <a href="documentoscont/filesencu/<? echo $row41["encu_archivo2"] ?>" class="link" target="_blank" ><? echo $row41["encu_archivo2"] ?></a>
                             </td>
                           </tr>
                          <tr>
                             <td  valign="center" class="Estilo1">Archivo USU</td>
                             <td class="Estilo1" colspan=6>
                              <input type="file" name="archivo3" class="Estilo2" size="20"  > <BR>
                               <a href="documentoscont/filesencu/<? echo $row41["encu_archivo3"] ?>" class="link" target="_blank" ><? echo $row41["encu_archivo3"] ?></a>
                             </td>
                           </tr>

<?
}
?>

                           </table>
                           

<?
if ($sw2<>1)  {
?>
                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="  Grabar  "> </td>
<?
}
?>

                           </tr>

                           <tr>
                             <td colspan=4 align="center"><br></td>
                           </tr>


                               <input type="hidden" name="id" value="<? echo $id ?>"  >
                               <input type="hidden" name="id41" value="<? echo $id41 ?>"  >
                        </form>

                      </td>





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
