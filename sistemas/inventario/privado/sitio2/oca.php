<?php 
extract($_GET);
require_once("inc/config.php");
$oc = "SELECT * FROM bode_orcom WHERE oc_id = ".$id;
$detalle = "SELECT * FROM bode_detoc a WHERE a.doc_oc_id = ".$id." ORDER BY doc_region ASC";

$res = mysql_query($oc);
$row = mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
	<title>DETALLE OC N&deg; <?php echo $row["oc_id2"] ?></title>
	<style type="text/css">
	html{
		font-size: 12px;
	}

	table{
		text-align:center;
	}
	th{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:8px;
	}
	.Estilo1{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:7px;
	}
	.Estilo1b{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:10px;
	}
	.Estilo1c{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:10px;
	}
	.Estilo1c3{
		text-align:right;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:12px;
	}

	.Estilo1b2{
		text-align:center;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:10px;
	}
	.Estilo1b3{
		text-align:left;
		/*font-style:italic;*/
		font-family:"Times New Roman", Times;
		font-size:12px;
	}


	h1{
		color:#0033CC;
		text-align:center;
		/*font-style:italic;*/
		font-weight:bold;
		/*border-bottom:#003366 solid 3px;*/
	}

	</style>
</head>
<body>


	<!--<table border="1" cellpadding="0" cellspacing="0" width="500" align="center">
		<tr>
			<td colspan="2">NOMBRE ORDEN DE COMPRA : </td>
			<td colspan="2"><?php //echo $row["oc_nombre_oc"] ?></td>
		</tr>

		<tr>
			<td>PROVEEDOR : </td>
			<td><?php //echo $row["oc_proveenomb"] ?></td>

			<td>RUT</td>
			<td><?php //echo $row["oc_proveerut"]."-".$row["oc_proveedig"] ?></td>
		</tr>
	</table>

	<br>!-->

	<table border="1" cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr>
			<td colspan="6" align="center">DETALLE OC N&deg; <?php echo $row["oc_id2"] ?></td>
		</tr>

		<tr>
			<td align="center">N&deg;</td>
			<td align="center">PRODUCTO</td>
			<td align="center">REGION</td>
			<td align="center">UNIDAD MEDIDA</td>
			<td align="center">TOTAL</td>
			<td align="center">RECIBIDO</td>
			<td align="center">FALTAN</td>
		</tr>

		<tbody>
			<?php
			$res2 = mysql_query($detalle);
			$cont = 1;
			while($row2 = mysql_fetch_array($res2)) {
				?>
				<tr>
					<td align="center"><?php echo $cont ?></td>
					<td align="left"><?php echo utf8_decode($row2["doc_especificacion"]) ?></td>
					<td align="center"><?php echo $row2["doc_region"] ?></td>
					<td align="center"><?php echo $row2["doc_umedida"] ?></td>
					<td align="center"><?php echo $row2["doc_cantidad"] ?></td>
					<td align="center"><?php echo $row2["doc_recibidos"] ?></td>
					<td align="center"><?php echo ($row2["doc_cantidad"] - $row2["doc_recibidos"]) ?></td>
				</tr>
				<?php $cont++;} ?>
			</tbody>
		</table>

	</body>
	</html>