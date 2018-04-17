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
$item=$_GET["item"];
$banco=$_GET["banco"];
$programa=$_GET["programa"];
$consolidado=$_GET["consolidado"];

?>


                      <table border=1>
                        <tr>
                         <td class="Estilo1b">Nun</td>
                         <td class="Estilo1b">NºBol</td>
                         <td class="Estilo1b">Rut</td>
                         <td class="Estilo1b">Nombre</td>
                         <td class="Estilo1b">Apellido Paterno</td>
                         <td class="Estilo1b">Apellido Materno</td>
                         <td class="Estilo1b">Bruto</td>
                         <td class="Estilo1b">Reten. </td>
                         <td class="Estilo1b">Neto </td>
                         <td class="Estilo1b">Cuenta </td>
                         <td class="Estilo1b">Banco </td>
                         <td class="Estilo1b">Programa </td>
                         <td class="Estilo1b">Region </td>
                         <td class="Estilo1b">Item </td>
                         <td class="Estilo1b">Detalle </td>

                        </tr>

<?
$sw=0;
if ($consolidado<>"")
   // $sql="select hono_nombre, hono_rut,hono_dig, count(hono_rut) as cuentarut, sum(hono_bruto) as hono_bruto, sum(hono_retencion) as hono_retencion, sum(hono_liquido) as hono_liquido from dpp_honorarios where ";
  $sql="select b.provee_nombre, b.provee_paterno,b.provee_materno, count(a.hono_rut) as cuentarut, sum(a.hono_bruto) as a.hono_bruto, sum(a.hono_retencion) as a.hono_retencion, sum(a.hono_liquido) as a.hono_liquido from dpp_honorarios a inner join dpp_proveedores b on a.hono_rut = b.provee_rut where ";
else
   $sql="select * from dpp_honorarios a inner join dpp_proveedores b on a.hono_rut = b.provee_rut where ";
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

if ($item<>"") {
    $sql.=" hono_item=$item and ";
    $sw=1;
}
if ($banco<>"") {
list($cuenta, $nombrebanco)=split('[|]', $banco);
    if ($cuenta<>"") {
       $sql.=" hono_cuenta='$cuenta' and ";
       $sw=1;
    }
    if ($nombrebanco<>"") {
       $sql.=" hono_banconombre='$nombrebanco' and ";
       $sw=1;
    }

}
if ($programa<>"") {
    $sql.=" hono_programa='$programa' and ";
    $sw=1;
}

if ($detalle<>"") {
    $sql.=" hono_detalle='$detalle' and ";
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
// echo $sql;
// exit;
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
                         <td class="Estilo1b"><? echo $row3["provee_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["provee_paterno"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["provee_materno"]  ?> </td>
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
                         <td class="Estilo1c"><? echo $row3["hono_cuenta"]   ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_banconombre"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_programa"]   ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_region"]   ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_item"]   ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_detalle"]   ?> </td>


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

