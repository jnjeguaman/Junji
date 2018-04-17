<?
session_start();

 header("Content-Type: application/vnd.ms-excel; name='listador'");

 header("Content-Disposition: attachment; filename=reportes.xls");


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
$item1=$_GET["item1"];
$item2=$_GET["item2"];
$item3=$_GET["item3"];
$item4=$_GET["item4"];
$item5=$_GET["item5"];
$item6=$_GET["item6"];
$item7=$_GET["item7"];
$anno=$_GET["anno"];
$consolidado=$_GET["consolidado"];
//echo $item1."<br>".$item2."<br>".$item3."<br>".$item4."<br>".$item5."<br>".$item6."<br>".$item7."<br>";
?>


                      <table border=1>
                        <tr>
                         <td class="Estilo1b">Nun</td>
                         <td class="Estilo1b">NºBol</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Bruto</td>
                         <td class="Estilo1b">Reten. </td>
                         <td class="Estilo1b">Neto </td>
                        </tr>

<?
$sw=0;
if ($consolidado<>"")
   $sql="select hono_nombre, hono_rut,hono_dig, count(hono_rut) as cuentarut, sum(hono_bruto) as hono_bruto, sum(hono_retencion) as hono_retencion, sum(hono_liquido) as hono_liquido from dpp_honorarios where ";
else
   $sql="select * from dpp_honorarios where ";
if ($region<>"") {
    if ($region==0)
        $sql.=" hono_region<>'' and ";
    else
        $sql.=" hono_region=$region and ";
    $sw=1;
}
if ($fecha1<>"" and $fecha2<>"" and $fecha1<>$fecha2 ) {
    $sql.=" ( hono_fecha1>='$fecha1' and hono_fecha1<='$fecha2' ) and ";
    $sw=1;
}
if ($rut<>"") {
    $sql.=" hono_rut like '%$rut%' and ";
    $sw=1;
}
if ($anno<>"") {
    $sql.=" year(hono_fecha1) = '$anno' and ";
    $sw=1;
}

if ($item1<>"" || $item2<>"" || $item3<>"" || $item4<>"" || $item5<>"" || $item6<>"" || $item7<>"" ) {
    $sql.=" (hono_item='$item1' or hono_item='$item2' or hono_item='$item3' or hono_item='$item4' or hono_item='$item5' or hono_item='$item6' or hono_item='$item7') and ";
    $sw=1;
}
if ($sw==1){
    if ($consolidado <>"")
      $sql.=" 1=1 group by trim(hono_nombre) order by trim(hono_nombre)";
    else
      $sql.=" 1=1 order by hono_nombre";
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

?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo $cont  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_nro_boleta"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_rut"]  ?>-<? echo $row3["hono_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_nombre"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_bruto"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_retencion"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_liquido"]   ?> </td>
<?
    if ($consolidado<>"") {
?>
                             <td class="Estilo1c"><? echo $row3["cuentarut"]   ?> </td>
<?
    }
?>

                        </tr>

                        



<?

   $sumab=$sumab+$row3["hono_bruto"];
   $sumar=$sumar+$row3["hono_retencion"];
   $sumal=$sumal+$row3["hono_liquido"] ;
   $cont++;
   $cont1++;
}
?>

                       <tr>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1b"> </td>
                         <td class="Estilo1c"><? echo $sumab  ?> </td>
                         <td class="Estilo1c"><? echo $sumar  ?> </td>
                         <td class="Estilo1c"><? echo $sumal  ?> </td>
                        </tr>
                        </td>
                      </tr>

 
 
</table>

