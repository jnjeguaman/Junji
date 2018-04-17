<?php
require_once("inc/config.php");
extract($_POST);
$sql = "SELECT * FROM factor_sii WHERE factor_ano = ".$factor_anno;
// echo $sql;
$res = mysql_query($sql);
if(mysql_num_rows($res) > 0)
{
	while($row = mysql_fetch_array($res)) {
		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">01</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_1"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">02</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_2"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">03</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_3"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">04</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_4"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">05</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_5"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">06</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_6"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">07</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_7"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">08</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_8"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">09</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_9"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">10</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_10"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">11</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_11"].'</td>';
		$tabla .='</tr>';

		$tabla .='<tr>';
		$tabla .='<td class="Estilo1">12</td>';
		$tabla .='<td class="Estilo1">'.$row["factor_12"].'</td>';
		$tabla .='</tr>';
	}
	echo json_encode(array("Respuesta" => true,"Datos" => $tabla));
}else{
	echo json_encode(array("Respuesta" => false));
}
?>