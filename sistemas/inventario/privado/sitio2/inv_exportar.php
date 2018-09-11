<?php
$filename = Date("YmdHis");
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename.".xls");

session_start();
extract($_GET);
extract($_POST);
require("inc/config.php");
$sqlInv = "SELECT * FROM acti_inventario WHERE inv_region = ".$_SESSION["region"]." ORDER by inv_id DESC";
$sqlInv = mysql_query($sqlInv);
?>
<!DOCTYPE html>
<html>
<head>
	<title>EXCEL</title>
</head>
<body>

	<table border="1" width="100%">

		<tr>
			<th>CODIGO</th>
			<th>PROGRAMA</th>
			<th>BIEN</th>
			<th>COSTO ADQUISICION</th>
			<th>REGION</th>
			<th>ESTADO</th>
			<th>OBSERVACIONES</th>
			<th>RESOLUCION ALTA</th>
			<th>FECHA ALTA</th>
			<th>RESOLUCION BAJA/TRASLADO</th>
			<th>FECHA BAJA/TRASLADO</th>
			<th>A&Ntilde;O ADQUISICION</th>
			<th>ORDEN DE COMPRA</th>
			<th>FECHA RECEPCION</th>
			<th>FUNCIONARIO RESPONSABLE</th>
			<th>CALIDAD ADMINISTRATIVA</th>
			<th>VIDA UTIL</th>
			<th>DIRECCION ESTABLECIMIENTO</th>
			<th>ZONA</th>
			<th>VIDA UTIL CONSUMIDA</th>
			<th>FECHA DEVENGO</th>
			<th>CUENTA CONTABLE</th>
			<th>VALOR ACTUALIZADO FINAL</th>
			<th>CORRECCION MONETARIA</th>
			<th>DEPRECIACION ACUMULADA ACTUALIZADA</th>
			<th>DEPRECIACION DEL A&Ntilde;O</th>
			<th>DEPRECIACION TOTAL</th>
		</tr>

		<tbody>
			<?php while($row = mysql_fetch_array($sqlInv)) { ?>
			<tr>
				<td><?php echo $row["inv_codigo"] ?></td>
				<td><?php echo $row["inv_programa"] ?></td>
				<td><?php echo utf8_decode($row["inv_bien"]) ?></td>
				<td><?php echo $row["inv_costo"] ?></td>
				<td><?php echo $row["inv_region"] ?></td>
				<td><?php echo $row["inv_estadocosto"] ?></td>
				<td><?php echo $row["inv_obs"] ?></td>
				<td><?php echo $row["inv_altares"] ?></td>
				<td><?php echo $row["inv_altafecha"] ?></td>
				<td><?php echo $row["inv_baja"] ?></td>
				<td><?php echo $row["inv_bajafecha"] ?></td>
				<td><?php echo $row["inv_anno"] ?></td>
				<td><?php echo $row["inv_oc"] ?></td>
				<td><?php echo $row["inv_recepcionfecha"] ?></td>
				<td><?php echo $row["inv_responsable"] ?></td>
				<td><?php echo $row["inv_calidad"] ?></td>
				<td><?php echo $row["inv_vutil"] ?></td>
				<td><?php echo $row["inv_direccion"] ?></td>
				<td><?php echo $row["inv_zona"] ?></td>
				<td><?php echo $row["inv_vutilsonsumida"] ?></td>
				<td><?php echo $row["inv_devengofecha"] ?></td>
				<td><?php echo $row["inv_ccontable"] ?></td>
				<td><?php echo $row["inv_vfinal"] ?></td>
				<td><?php echo $row["inv_correcion"] ?></td>
				<td><?php echo $row["inv_acumulada"] ?></td>
				<td><?php echo $row["inv_depreciaanno"] ?></td>
				<td><?php echo $row["inv_total"] ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>


<script src="librerias/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
	$(function(){
		window.close();
	})
</script>
</body>
</html>
