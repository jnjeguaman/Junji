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


$sql2 = "Select * from compra_fecha where fecha_id=1";
//echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$date_in3=$row2["fecha_fecha"];

include("cinco.php");

$sql2 = "update compra_fecha set fecha_fecha='$date_in2' where fecha_id=1";
//echo $sql;
mysql_query($sql2);


header ("Expires: Thu, 27 Mar 1980 23:59:00 GMT"); //la pagina expira en una fecha pasada
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
header ("Pragma: no-cache");

?>
<html>
<head>
<title>Compras</title>
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
	color: #003063;

}
.Estilo2c {
	font-family: Verdana;
	font-size: 10px;
	color: #003063;
	text-align: center;
}
.Estilo2d {
	font-family: Verdana;
	font-size: 10px;
	text-align: right;
	color: #003063;
}
.Estilo2b {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	color: #003063;
}
.Estilo3 {
	font-family: Verdana;
	font-size: 9px;
	text-align: left;
	font-weight: bold;
	color: #003063;
}
.Estilo3c {
	font-family: Verdana;
	font-size: 8px;
	font-weight: bold;
	text-align: center;
	color: #003063;
}
.Estilo3d {
	font-family: Verdana;
	font-size: 9px;
	font-weight: bold;
	text-align: right;
	color: #003063;
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
  <script type="text/javascript" src="librerias/lang/calendar-es.js"></script>

  <!-- the following script defines the Calendar.setup helper function, which makes
       adding a calendar a matter of 1 or 2 lines of code. -->
  <script type="text/javascript" src="librerias/calendar-setup.js"></script>

  <script type="text/javascript" src="select_dependientes2.js"></script>
  <script type="text/javascript" src="select_dependientes2b.js"></script>
  
    <script src="librerias/js/jscal2.js"></script>
    <script src="librerias/js/lang/es.js"></script>
    <link rel="stylesheet" type="text/css" href="librerias/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="librerias/css/steel/steel.css" />

  
<SCRIPT LANGUAGE ="JavaScript">



</script>
<script language="javascript">

</script>

<body>
<?php

if (isset($_GET["anno2"])) {
    $anno2=$_GET["anno2"];
} else {
    $anno2=date("Y");
}



?>
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
          <div class="col-sm-3 col-lg-3">
            <div class="dash-unit2">

		  <?
		  require("inc/menu_1.php");
		  ?>

            </div>
      </div>

        <div class="col-sm-9 col-lg-9">
                    <div class="dash-unit2">

            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">INGRESO ORDEN DE COMPRA (Mercado Público)</span></td>
                  </tr>
                       <tr>
                       <td></td><td></td>
                      </tr>
                    <tr>
                         <td width="480" valign="top" class="Estilo1c">
                         
<?

if (isset($_GET["llave"])) {
 if ($_GET["llave"]==1)
   echo "<p>Registros Insertados con Exito !";
 if ($_GET["llave"]==2)
 echo "<p>Registros NO insertados !";
}

?>
                         </td>
                      </tr>
                       <tr>
                       <td><a href="compra_menuoc.php" class="link" >Volver</a></td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>
<?
$id=$_GET["id"];
if ($_GET["ori"]==1)  {
    $sql2 = "delete from compra_orden where oc_id=$id";
//    echo $sql2;
    mysql_query($sql2);
//    exit();

}


?>


                   <tr>
             			<td height="30" colspan="3">
                    </table>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
<?












 if ($regionsession==1) {
     $para1="1877";
 }
 if ($regionsession==2) {
     $para1="1333";
 }
 if ($regionsession==3) {
     $para1="1879";
 }
 if ($regionsession==4) {
     $para1="1880";
 }
 if ($regionsession==5) {
     $para1="2229";
 }
 if ($regionsession==6) {
     $para1="1739";
 }
 if ($regionsession==7) {
     $para1="1881";
 }
 if ($regionsession==8) {
     $para1="2230";
 }
 if ($regionsession==9) {
     $para1="1882";
 }
 if ($regionsession==10) {
     $para1="1740";
 }
 if ($regionsession==11) {
     $para1="1887";
 }
 if ($regionsession==12) {
     $para1="1890";
 }
 if ($regionsession==13) {
     $para1="4342";
 }
 if ($regionsession==14) {
     $para1="4326";
 }
 if ($regionsession==15) {
     $para1="1876";
 }
 if ($regionsession==17) {
     $para1="523524";
 }
 if ($regionsession==18) {
     $para1="523522";
 }


?>



<tr></tr>


<br>
<table border=1>
<tr class="Estilo8"></tr>

                        <tr>
                    <td class="Estilo1c">N°</td>
                    <td class="Estilo1c">Nº O.C. </td>
                    <td class="Estilo1c">Rut</td>
                    <td class="Estilo1c">Nombre Proveedor</td>
                    <td class="Estilo1c">Fecha </td>
                    <td class="Estilo1c">Nombre</td>
                  	<td class="Estilo1c">Descripcion</td>
                    <td class="Estilo1c">Monto</td>
                    <td class="Estilo1c"></td>
                        </tr>
<?

  $sql="select * from compra_chcompra where chc_estado=1 and chc_numero like '$para1%' and chc_estado2<>'OC Guardada' order by chc_fecha desc LIMIT 0 , 30 ";
//  $sql="select * from compra_orden where oc_region=$regionsession and oc_fpago='' and  oc_emitidapor='' and oc_nombre<>'' and year(oc_fechacompra)='$anno2' order by oc_orden desc LIMIT 0 , 1000 ";

//echo $sql;
$res3 = mysql_query($sql);
$cont=1;

$cont2=mysql_num_rows($res3);
while($row3 = mysql_fetch_array($res3)){

$octipo=$row3["oc_tipo"];

if ($octipo>=14 and $octipo<=17) {
  $sql33="Select cat_nombre, cat_id from compra_categoria where cat_id =$octipo";
//  echo $sql33;
  $consulta=mysql_query($sql33);
  $registro=mysql_fetch_array($consulta);
  $octipo2=$registro["cat_nombre"];
} else {
  $octipo2=$octipo;
}

?>


    <tr>
     <td class="Estilo3c"><? echo $cont2 ?> </td>
     <td class="Estilo3c"><? echo $row3["chc_numero"] ?> </td>
     <td class="Estilo3c"><? echo $row3["chc_rut"] ?> </td>
     <td class="Estilo3c" title="<? echo $row3["chc_empresa"]  ?>"><? echo $row3["chc_empresa"]  ?></td>
     <td class="Estilo3c" ><? echo substr($row3["chc_fecha"],8,2)."-".substr($row3["chc_fecha"],5,2)."-".substr($row3["chc_fecha"],0,4)   ?></td>
     <td class="Estilo3c"><? echo $row3["chc_descripcion3"] ?> </td>
     <td class="Estilo3c"><? echo $row3["chc_descripcion2"] ?> </td>
     <td class="Estilo2d"><? echo number_format($row3["chc_monto"],0,',','.');  ?></td>
     <td class="Estilo2d"><a href="compra_orden.php?idmp=<? echo $row3["chc_id"]; ?>" class="link" >Ingresa</a></td>
    </tr>





<?

   $cont++;
   $cont2--;

}
?>


                      <tr>
                       <input type="hidden" name="cont" value="<? echo $cont ?>" >

                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
