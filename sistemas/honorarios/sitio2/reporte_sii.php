<?
require("inc/config.php");
session_start();
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=reporte_sii_".$_GET["anno"].".xls");
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


$anno=$_GET["anno"];
$retenciones = array();
$sw=0;
$year=date("Y");
  // $sql="select * from dpp_honorarios where (hono_estado = 1 or hono_estado = 3) and year(hono_fecha1)='$anno' order by hono_fecha1 ";
$sql="select * from dpp_honorarios a inner join dpp_proveedores b on a.hono_rut = b.provee_rut where (a.hono_estado = 1 or a.hono_estado = 3) and year(a.hono_fecha1)='$anno' order by a.hono_fecha1";


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

}

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
<table width="100%" style="border-collapse: collapse;" border="1">
	<tr>
		<th>Rut</th>
		<th>Suma total Anual Retenciones</th>
		<th>01</th>
		<th>02</th>
		<th>03</th>
		<th>04</th>
		<th>05</th>
		<th>06</th>
		<th>07</th>
		<th>08</th>
		<th>09</th>
		<th>10</th>
		<th>11</th>
		<th>12</th>
		<th>Certificado</th>
	</tr>

	<?php foreach ($sums as $key => $value): ?>

		<?php 
		$partes = explode("-",$key);
		$rut = $partes[0];
		$dv = $partes[1];
		// $sql2 = "SELECT MONTH(a.hono_fecha1) AS Mes FROM dpp_honorarios a INNER JOIN dpp_proveedores b ON a.hono_rut = b.provee_rut WHERE (a.hono_estado = 1 OR a.hono_estado = 3) AND YEAR(a.hono_fecha1)='".$anno."' AND a.hono_rut = '".$key."' ORDER BY a.hono_fecha1";
		$sql2 = "SELECT DISTINCT(MONTH(a.hono_fecha1)) AS Mes FROM dpp_honorarios a inner join dpp_proveedores b on a.hono_rut = b.provee_rut WHERE (a.hono_estado = 1 OR a.hono_estado = 3) AND YEAR(a.hono_fecha1)='".$anno."' AND a.hono_rut = '".$rut."' ORDER BY a.hono_fecha1 limit 100";
		// echo $sql2."<br>";
		$res2 = mysql_query($sql2);
		$array_meses = array();
		while($row2 = mysql_fetch_array($res2)) {
				$array_meses[$row2["Mes"]] = 1;
		}
		?>
		<tr align="center">
			<td><?php echo $key ?></td>
			<td><?php echo $value ?></td>
			<td><?php echo ($array_meses[1] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[2] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[3] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[4] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[5] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[6] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[7] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[8] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[9] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[10] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[11] == 1) ? "X" : "" ?></td>
			<td><?php echo ($array_meses[12] == 1) ? "X" : "" ?></td>
			<td></td>
		</tr>
	<?php endforeach ?>
</table>