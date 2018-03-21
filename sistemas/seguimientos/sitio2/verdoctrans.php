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
$nrocomprobante=$_GET["nrocomprobante"];
$cotrananno=$_GET["cotrananno"];


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

<table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="20" colspan="2"><span class="Estilo7">LISTA DE DOCUMENTOS DEL COMPROBANTE <? echo $nrocomprobante ?></span></td>
                  </tr>
                       <tr>
                       <td><hr></td><td><hr></td>
                      </tr>
                    <tr>
                         <td width="487" valign="top" class="Estilo1c">

<?

if (isset($_GET["llave"]))
 echo "<p>Registros insertados con Exito !";
 
 $id=$_GET["id"];
 $rut=$_GET["rut"];
 

 
?>
                         </td>
                      </tr>
                      <tr>
                        <td><a href="comprobantetransferencia.php" class="link" > Volver </a></td>
                      </tr>

                       <tr>
                       <td><hr></td><td><hr></td>


                      </tr>

                   <tr>
             			<td height="50" colspan="3">
                    

                      
 					       <table width="488" border="1" cellspacing="0" cellpadding="0" class="table">
                             <tr>
                               <th class="Estilo1b">NUM</th>
                               <th class="Estilo1b">TIPO DOC.</th>
                               <th class="Estilo1b">FOLIO</th>
                               <th class="Estilo1b">FECHA</th>
                               <th class="Estilo1b">NOMBRE PROVEEDOR</th>
                               <th class="Estilo1b">MONTO</th>
                               <th class="Estilo1b">VER FICHA</th>
                              </tr>
<?


$sql3="select * from dpp_etapas where eta_ncheque='$nrocomprobante' and eta_fpago='Transferencia' and eta_region='$regionsession' and year(eta_fechache)='$cotrananno' order by eta_rut asc ";
// echo $sql3;
$result3=mysql_query($sql3);
$cont=1;
$suma=0;
while ($row3=mysql_fetch_array($result3)) {

    $monto=$row3["eta_monto"];
    if($row3["eta_tipo_doc"]=='Honorario') {
        $archivover="verdoc2.php";
    }
    if($row3["eta_tipo_doc"]=='Factura') {
        $archivover="verdoc.php";
    }
    
 $vartipodoc1=$row3["eta_tipo_doc"];
 if ($vartipodoc1=='Factura') {
     $vartipodoc2=$row3["eta_tipo_doc2"];
   if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
     $vartipodoc="Factura";
   if ($vartipodoc2=="b")
     $vartipodoc="Boleta Servicio";
   if ($vartipodoc2=="r")
     $vartipodoc="Recibo";
   if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
     $vartipodoc="N.Credito";
   if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
     $vartipodoc="N.Débito";

 }
 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }



?>
                             <tr>
                               <td class="Estilo1b"><? echo $cont; ?></td>
                               <td class="Estilo1b"><? echo $vartipodoc; ?></td>
                               <td class="Estilo1b"><? echo $row3["eta_folio"] ?></td>
                               <td class="Estilo1b"><? echo substr($row3["eta_fecha_cheque"],8,2)."-".substr($row3["eta_fecha_cheque"],5,2)."-".substr($row3["eta_fecha_cheque"],0,4)   ?></td>
                               <td class="Estilo1b"><? echo $row3["eta_cli_nombre"] ?></td>
                               <td class="Estilo1b"><? echo number_format($monto,0,',','.') ?></td>
                               <td class="Estilo1b"><a href="<? echo $archivover ?>?ori=3&id2=<? echo $row3["eta_id"] ?>&nrocomprobante=<? echo $nrocomprobante ?>&cotrananno=<?php echo $cotrananno ?>" class="link" >Ver Ficha </a></td>
                              </tr>


<?
    if($row3["eta_tipo_doc3"]=='NC' or $row3["eta_tipo_doc3"]=='NCEL' ) {
        $monto=$monto*-1;
    }

  $suma=$suma+ $monto;
  $cont++;
}

?>
                             <tr>
                               <td class="Estilo1b" colspan=5>Monto Total Transferido :</td>
                               <td class="Estilo1b"><? echo number_format($suma,0,',','.') ?></td>

                              </tr>

</table>



                      <table border=1>
<tr></tr>



                      <tr>

                        





</td>
  </tr>


</table>

<img src="images/pix.gif" width="1" height="10">
</body>
</html>

<?

?>
