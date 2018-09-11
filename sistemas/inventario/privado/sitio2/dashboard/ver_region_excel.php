<?php
extract($_GET);
header("Content-Type: application/vnd.ms-excel; name='listador'");
header("Content-Disposition: attachment; filename=Reporte_".$region_id."_REGION_".date("d-m-Y").".xls");
require_once("../inc/config.php");

$where = "";
if($fecha_inicio <> "")
{
	$where.= "oc_fecha >= '".$fecha_inicio."' AND ";
}else{
	$where.=" oc_fecha >= '".date("Y-m-d")."' AND ";
}

if($fecha_termino <> "")
{
	$where.= "oc_fecha <= '".$fecha_termino."' AND ";	
}else{
	$where.=" oc_fecha <= '".date("Y-m-d")."' AND ";
}

if($region_id <> "")
{
	$sql = "SELECT * FROM bode_orcom WHERE oc_region2 = ".$region_id." AND ".$where." oc_guiaemisor <> '' AND oc_tipo = 1";
}else{
	$sql = "SELECT * FROM bode_orcom WHERE ".$where." oc_guiaemisor <> '' AND oc_tipo = 1";
}
$res = mysql_query($sql,$dbh);
$contador = 1;

?>

<table border="1" width="100%" style="border-collapse: collapse;">
	
	<tr style="background: #C3C3C3">
		<td>ID</td>
		<td>FOLIO GUIA</td>
		<td>DESTINO</td>
		<td>EMISOR</td>
		<td>FECHA EMISION</td>
		<td>DETALLE</td>
	</tr>

	<?php 
	while($row = mysql_fetch_array($res)) {
		$sql2 = "SELECT * FROM bode_detoc WHERE doc_oc_id = ".$row["oc_id"]." AND doc_estado <> 'ELIMINADO'";
		$res2 = mysql_query($sql2,$dbh);

		if($contador%2==0)
		{
			$color = "#EBE9E9";
		}else{
			$color = "#C7C7C7";
		}
		?>

		<tr style="background: <?php echo $color ?>">
			<td><?php echo $row["oc_id"] ?></td>
			<td><?php echo $row["oc_folioguia"] ?></td>
			<td><?php echo $row["oc_guiadestina"] ?></td>
			<td><?php echo $row["oc_guiaemisor"] ?></td>
			<td><?php echo date("d-m-Y",strtotime($row["oc_fecha"])) ?></td>
			<td>
				<table border="1" width="100%" style="border-collapse: collapse;">
					<?php while($row2 = mysql_fetch_array($res2)) { ?>
					<tr>
						<td><?php echo utf8_decode($row2["doc_especificacion"]) ?></td>
						<td><?php echo $row2["doc_cantidad"] ?></td>
					</tr>	
					<?php } ?>
				</table>
			</td>
		</tr>
		<?php $contador++;} ?>
	</table>