<?php
require_once("../../../../inc/config.php");
$sql = str_replace("DESC LIMIT 10","",$_POST["query"]);
$res = mysql_query($sql);

$filename = "reporte1_".Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");


?>

<table border="1" width="100%">
	<tr>
		<td>ACCION</td>
		<td>USUARIO</td>
		<td>REGION</td>
		<td>ORIGEN</td>
		<td>MODULO</td>
		<td>FECHA</td>
		<td>HORA</td>
	</tr>

	<?php while($row = mysql_fetch_array($res)) { 
		$fecha = $row["log_fechasys"];
		$fecha = explode("-", $fecha);
		$fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
		?>
		<tr>
			<td><?php echo $row["log_tipo"]?> </td>
			<td><?php echo $row["log_usr"]?> </td>
			<td><?php echo $row["region"]?> </td>
			<td><?php echo $row["log_origen"]?> </td>
			<td><?php echo $row["log_tipo"]?> </td>
			<td><?php echo $fecha?> </td>
			<td><?php echo $row["log_horasys"]?> </td>
		</tr>
		<?php } ?>
	</table>