<?
require("inc/config.php");
session_start();
/*
header("Content-Type: application/vnd.ms-excel; name='listador'");

header("Content-Disposition: attachment; filename=reportes.xls");
*/
$sql = "SELECT * FROM factor_sii WHERE factor_ano = ".$_GET["anno"];
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
$factor = [
"01" => $row["factor_1"],
"02" => $row["factor_2"],
"03" => $row["factor_3"],
"04" => $row["factor_4"],
"05" => $row["factor_5"],
"06" => $row["factor_6"],
"07" => $row["factor_7"],
"08" => $row["factor_8"],
"09" => $row["factor_9"],
"10" => $row["factor_10"],
"11" => $row["factor_11"],
"12" => $row["factor_12"]
];

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
                         <td class="Estilo1b">NOMBRE</td>
                         <td class="Estilo1b">AP PAT</td>
                         <td class="Estilo1b">AP MAT</td>
                         <td class="Estilo1b">HONORARIO BRUTO</td>
                         <td class="Estilo1b">RETENCION </td>
                         <td class="Estilo1b">ACTUALIZADO </td>
                         <td class="Estilo1b">FACTOR</td>
                        </tr>

<?
$retenciones = array();
$sw=0;
$year=date("Y");
  // $sql="select * from dpp_honorarios where (hono_estado = 1 or hono_estado = 3) and year(hono_fecha1)='$anno' order by hono_fecha1 ";
$sql="select * from dpp_honorarios a inner join dpp_proveedores b on a.hono_rut = b.provee_rut where (a.hono_estado = 1 or a.hono_estado = 3) and year(a.hono_fecha1)='$anno' order by a.hono_fecha1";


//echo $sql;
$res3 = mysql_query($sql);
$cont=1;
$cont1=0;
$sumab=0;
$sumar=0;
$sumal=0;
while($row3 = mysql_fetch_array($res3)){
$actualizado = round(($row3["hono_retencion"] * $factor[substr($row3["hono_fecha1"],5,2)]));
// $retenciones[] = array("Rut" =>($row3["hono_rut"]."-".$row3["hono_dig"]), "Total" => $actualizado);
$retenciones[][($row3["hono_rut"]."-".$row3["hono_dig"])] = $actualizado;
if(1==1){
?>
                      

                       <tr>
                         <td class="Estilo1b"><? echo substr($row3["hono_fecha1"],5,2); ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_rut"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["hono_dig"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["provee_nombre"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["provee_paterno"]  ?> </td>
                         <td class="Estilo1b"><? echo $row3["provee_materno"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_bruto"]  ?> </td>
                         <td class="Estilo1c"><? echo $row3["hono_retencion"]   ?> </td>
                         <td class="Estilo1c"><?php echo $actualizado ?></td>
                         <td class="Estilo1c"><?php echo $factor[substr($row3["hono_fecha1"],5,2)] ?></td>

                        </tr>

                        



<?
}

}
?>

                        </td>
                      </tr>

 
 
</table>

<hr>

<?php 
$sums = array();

// $retenciones = array(
//     1 => array('great' => 5),
//     2 => array('great' => 3),
//     4 => array('bad' => 5),
//     5 => array('calling' => 40),
//     6 => array('great' => 3),
//     6 => array('great' => 3),
// );

$totalElementos = count($retenciones);
foreach ($retenciones as $key => $value) {
	foreach ($value as $label => $count) {
		if (!array_key_exists($label, $sums)) {
            $sums[$label] = 0;
        }
        // Add the value to the corresponding node
        $sums[$label] += $count;
	}
}

arsort($sums);

?>

<table border="1" width="100%">
	<tr>
		<td class="Estilo1b">Rut</td>
		<td class="Estilo1b">Suma total Anual Retenciones</td>
		<td class="Estilo1b">01</td>
		<td class="Estilo1b">02</td>
		<td class="Estilo1b">03</td>
		<td class="Estilo1b">04</td>
		<td class="Estilo1b">05</td>
		<td class="Estilo1b">06</td>
		<td class="Estilo1b">07</td>
		<td class="Estilo1b">08</td>
		<td class="Estilo1b">09</td>
		<td class="Estilo1b">10</td>
		<td class="Estilo1b">11</td>
		<td class="Estilo1b">12</td>
		<td class="Estilo1b">Certificado</td>
	</tr>

	<?php foreach ($sums as $key => $value): ?>

		<?php 
		$partes = explode("-",$key);
		$rut = $partes[0];
		$dv = $partes[1];
		// $sql2 = "SELECT MONTH(a.hono_fecha1) AS Mes FROM dpp_honorarios a INNER JOIN dpp_proveedores b ON a.hono_rut = b.provee_rut WHERE (a.hono_estado = 1 OR a.hono_estado = 3) AND YEAR(a.hono_fecha1)='".$anno."' AND a.hono_rut = '".$key."' ORDER BY a.hono_fecha1";
		$sql2 = "SELECT DISTINCT(MONTH(a.hono_fecha1)) AS Mes FROM dpp_honorarios a inner join dpp_proveedores b on a.hono_rut = b.provee_rut WHERE (a.hono_estado = 1 OR a.hono_estado = 3) AND YEAR(a.hono_fecha1)='".$anno."' AND a.hono_rut = '".$rut."' ORDER BY a.hono_fecha1";
		// echo $sql2."<br>";
		$res2 = mysql_query($sql2);
		$array_meses = array();
		while($row2 = mysql_fetch_array($res2)) {
				$array_meses[$row2["Mes"]] = 1;
		}
		?>
		<tr>
			<td class="Estilo1c"><?php echo $key ?></td>
			<td class="Estilo1c"><?php echo $value ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[1] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[2] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[3] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[4] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[5] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[6] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[7] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[8] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[9] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[10] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[11] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"><?php echo ($array_meses[12] == 1) ? "X" : "" ?></td>
			<td class="Estilo1c"></td>
		</tr>
	<?php endforeach ?>
</table>

