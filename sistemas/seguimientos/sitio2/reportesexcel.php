<?
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reportes.xls");

require("inc/config.php");
$date_in=date("Y-m-d");
?>
<html>
<head>
<title>Defensoria</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

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

</head>


<body>

<?
$region=$_GET["region"];
$fecha1=$_GET["fecha1"];
$fecha2=$_GET["fecha2"];
$rut=$_GET["rut"];
$documento=$_GET["documento"];
$etapa=$_GET["etapa"];
$item=$_GET["item"];
$consolidado=$_GET["consolidado"];


?>


                      <table border=1>
                        <tr>
                        <td class="Estilo1b" style="background: red">ID</td>
                         <td class="Estilo1b">Nun</td>
                         <td class="Estilo1b">Region</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Fecha_Recepcion</td>
                         <td class="Estilo1b">Liquido</td>
                         <td class="Estilo1b">Tipo Doc.</td>
                         <td class="Estilo1b">Nro. Doc.</td>
                         <td class="Estilo1b">Etapa</td>
                        </tr>

<?
$sw=0;

   $sql="select * from dpp_etapas where ";
if ($region<>"") {
    if ($region==0)
        $sql.=" eta_region<>'' and ";
    else
        $sql.=" eta_region=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" ) {
    $sql.=" ( eta_fecha_recepcion>='$fecha1' and eta_fecha_recepcion<='$fecha2' ) and ";
    $sw=1;
}
if ($rut<>"") {
    $sql.=" eta_rut like '%$rut%' and ";
    $sw=1;
}
if ($documento<>"") {
    $sql.=" eta_numero like '%$documento%' and ";
    $sw=1;
}
if ($proveedor<>"") {
    $sql.=" eta_cli_nombre like '%$proveedor%' and ";
    $sw=1;
}
if ($folio<>"") {
    $sql.=" eta_folio like '%$folio%' and ";
    $sw=1;
}
if ($etapa<>"") {
    $sql.=" eta_estado='$etapa' and ";
    $sw=1;
}


if ($sw==1){
    $sql.=" eta_estado<20 and 1=1 order by eta_folio desc ";
}
if ($sw==0){
    $sql.=" 1=2";
}



//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){
    if ($row3["eta_tipo_doc"]=="Factura") {
        $archivo="verdoc.php";
    }
    if ($row3["eta_tipo_doc"]=="Honorario") {
        $archivo="verdoc2.php";
    }


$vartipodoc1=$row3["eta_tipo_doc"];
 if ($vartipodoc1=='Factura') {
     $vartipodoc2=$row3["eta_tipo_doc2"];
   if ($vartipodoc2=="f")
     $vartipodoc="Factura";
   if ($vartipodoc2=="b")
     $vartipodoc="Boleta Servicio";
   if ($vartipodoc2=="r")
     $vartipodoc="Recibo";
   if ($vartipodoc2=="n")
     $vartipodoc="N.Credito";
 }
 if ($vartipodoc1=='Honorario') {
     $vartipodoc="Honorario";
 }






?>


                       <tr>
                       <td class="Estilo1b" style="background: red"><?php echo $row3["eta_id"] ?></td>
                         <td class="Estilo1b"><? echo $row3["eta_folio"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_region"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_rut"]  ?>-<? echo $row3["eta_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_cli_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo substr($row3["eta_fecha_recepcion"],8,2)."-".substr($row3["eta_fecha_recepcion"],5,2)."-".substr($row3["eta_fecha_recepcion"],0,4)   ?></td>
                         <td class="Estilo1c"><? echo number_format($row3["eta_monto"],0,',','.')  ?> </td>
                         <td class="Estilo1b"><? echo $vartipodoc  ?> </td>


                         <td class="Estilo1b"><? echo $row3["eta_numero"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["eta_estado"]  ?> </td>
                       </tr>






<?
 $cont++;
}
?>
                        </td>
                      </tr>
                      <tr>





</td>
  </tr>


</table>

