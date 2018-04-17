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
$anno=$_GET["anno"];
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
$consolidado=$_GET["consolidado"];

?>


                      <table border=1>
                        <tr>
                         <td class="Estilo1b">MES</td>
                         <td class="Estilo1b">RUN</td>
                         <td class="Estilo1b">DV</td>
                         <td class="Estilo1b">AP PATERNO_AP MATERNO_NOMBRES</td>
                         <td class="Estilo1b">HONORARIO BRUTO</td>
                         <td class="Estilo1b">RETENCION </td>
                        </tr>

<?
$sw=0;

//   $sql="select * from dpp_honorarios  where hono_estado = 1 order by hono_fecha1 ";
   $sql="SELECT hono_fecha1, hono_nombre, hono_rut, hono_dig, sum( hono_bruto ) AS hono_bruto, sum( hono_retencion ) AS hono_retencion FROM dpp_honorarios where (hono_estado=1 or hono_estado=3)  and year(hono_fecha1)='$anno'  GROUP BY month( hono_fecha1 ), hono_rut ORDER BY  month(hono_fecha1), hono_nombre";

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
                         <td class="Estilo1b"><? echo substr($row3["hono_fecha1"],5,2); ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_rut"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_nombre"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_bruto"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_retencion"]   ?> </td>

                        </tr>

                        



<?


}
?>

                        </td>
                      </tr>

 
 
</table>

