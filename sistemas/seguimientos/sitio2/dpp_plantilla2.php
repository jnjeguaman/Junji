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
                    <td height="20" colspan="2"><span class="Estilo7">CREACION DE PLANTILLA PARA PRORRATEO</span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?
$id=$_GET["id"];
$id1b=$_GET["id1b"];

?>



                   <tr>
                    <td height="50" colspan="3">

                  <a href="facturasarchivos.php?id=<? echo $id ?>&id1b=<? echo $id1b ?>" class="link" >volver </a><br><br>
                  </td>
                  </tr>
            </table>
       <form name="form1" action="grabaplantilla2.php" method="post"  onSubmit="return valida()">
                      <table border=1>






</td>
  </tr>
<?
$sql5="select * from dpp_facturas x, dpp_etapas y where fac_id=$id and fac_eta_id=eta_id ";

//echo $sql5;
$res5 = mysql_query($sql5);
$row5=mysql_fetch_array($res5);
//$archivo5=$row5["fac_"];
$etamonto=$row5["eta_monto"];
$etamonto=$row5["eta_monto"];
$etaprorroid=$row5["eta_prorro_id"];


?>
<table>

                            <tr>
                             <td  valign="center" class="Estilo1">Rut Proveedor </td>
                             <td class="Estilo1" colspan=3><? echo $row5["fac_rut"]."-".$row5["fac_dig"]; ?>
                             </td>
                           </tr>

                           <tr>
                             <td  valign="center" class="Estilo1">Nombre Proveedor </td>
                             <td class="Estilo1" colspan=3><? echo $row5["fac_cli_nombre"] ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Nº Factura </td>
                            <td class="Estilo1" colspan=3><? echo $row5["fac_numero"] ?>
                             </td>
                           </tr>
                            <tr>
                             <td  valign="center" class="Estilo1">Monto </td>
                            <td class="Estilo1" colspan=3><? echo number_format($row5["eta_monto"],0,',','.') ?>
                             </td>
                           </tr>
</table>
<table>

                           <tr>
                             <td  valign="center" class="Estilo1" colspan=4 align="center"><input type="submit" name="boton" class="Estilo2" value="   Asociar    "> </td>


                           </tr>
</table>
                      <table border=1>
<tr></tr>


<br>
<tr class="Estilo8"></tr>

                        <tr>

                         <td class="Estilo1">Nº </td>
                         <td class="Estilo1">Nombre Plantilla </td>
                         <td class="Estilo1">Ver </td>
                        </tr>


                      <tr>

<?

  $sql="select * from dpp_prorroteo where prorro_region='$regionsession' order by prorro_id  ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

while($row3 = mysql_fetch_array($res3)){
$compraorigen=$row3["compra_origen"];
if ($compraorigen==1) {
    $texto="Programado";
} else {
    $texto="No Programado";

}
?>


                       <tr>
    <td class="Estilo1b"><input alt="ok" type="radio" name="valor" value="<? echo $row3["prorro_id"] ?>" class="Estilo2" <? if ($etaprorroid==$row3["prorro_id"]){ echo "checked"; }   ?>> </td>
   <td class="Estilo1" title="<? echo $row3["porro_nombre"]  ?>"><? echo $row3["prorro_nombre"]  ?></td>
   <td class="Estilo1" title="<? echo $row3["porro_nombre"]  ?>"><a href="dpp_plantillaficha2.php?id2=<? echo $row3["prorro_id"] ?>&ori=2&id=<? echo $id ?>&id1b=<? echo $id1b ?>" class="link" >VER </a></td>

                       </tr>


<?


}
?>

                               <input type="hidden" name="id" value="<? echo $id ?>" >
                               <input type="hidden" name="id1b" value="<? echo $id1b ?>" >






           </form>
</table>


 
</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?
//require("inc/func.php");
?>
