<?php
session_start();
require_once("inc/config.php");
extract($_GET);
$filename = "solicitud_pedido_".date("YmdHis").".xls";
header("Content-Type: text/excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=".$filename);


$regionSession = $_SESSION["region"];

if($regionSession == 16)
{
	$where_region = 13;
}else{
	$where_region = $regionSession;
}

if($tipo == 3)
{
	$join = "INNER JOIN jardines c ON c.jardin_codigo = a.sp_destino";
	if($regionSession == 16)
	{
		$and = "c.jardin_region = 13";
	}else{
		$and = "c.jardin_region = ".$regiondestino;
	}
	$order = "c.jardin_sector";
}
if($tipo == 2)
{
	$join = "INNER JOIN acti_zona c ON c.zona_glosa = a.sp_destino";
	$and = "c.zona_region =".$regiondestino;
	$order = "c.zona_glosa";
}

$sql = "SELECT * FROM bode_solicitud a $join WHERE a.sp_tipo_destino = ".$tipo." AND ".$and." ".$where." AND a.sp_estado = 1 GROUP BY a.sp_destino DESC ORDER BY ".$order." ASC";
// echo $sql;
$res = mysql_query($sql);
?>

<table border="1" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td class="Estilo1mc">N&deg; SOLICITUD</td>
		<td class="Estilo1mc">DESTINO</td>
		<td class="Estilo1mc">DETALLE DEL PRODUCTO</td>
		<td class="Estilo1mc">CANTIDAD SOLICITADA</td>
		<td class="Estilo1mc">TOTAL DESPACHADO</td>
	</tr>

	<?php while($row = mysql_fetch_array($res)) {  ?>


	<?php
					// DETALLE DE LOS PRODUCTOS SOLICITADOS A UN JARDIN ENTRE TODAS LAS SOLICITUDES INGRESADAS
	if($tipo == 3)
	{
		$sql2 = "SELECT * FROM bode_solicitud a INNER JOIN bode_detoc3 b ON b.doc_sp_id = a.sp_id WHERE a.sp_destino = ".$row["sp_destino"]." AND a.sp_estado = 1";
	}

	if($tipo == 2)
	{
		$sql2 = "SELECT * FROM bode_solicitud a INNER JOIN bode_detoc3 b ON b.doc_sp_id = a.sp_id WHERE a.sp_destino LIKE '%".$row["sp_destino"]."%' AND a.sp_estado = 1";
	}

	$res2 = mysql_query($sql2);

	$contador = 1;
	while($row2 = mysql_fetch_array($res2)) { 

					// CANTIDAD DE PRODUCTOS YA ASOCIADOS
		$sql3 = "SELECT SUM(sp_rel_cantidad) as Asociado,sp_rel_id FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row2["doc_id"]." AND sp_rel_estado = 1";
		$res3 = mysql_query($sql3);
		$row3 = mysql_fetch_array($res3);

		$sql4 = "SELECT SUM(sp_rel_despachado) as Despachado FROM bode_solicitud_rel WHERE sp_rel_doc_id = ".$row2["doc_id"]." AND sp_rel_estado = 2";
		$res4 = mysql_query($sql4);
		$row4 = mysql_fetch_array($res4);

		$completado = 0;
		if($row2["doc_cantidad"] == $row4["Despachado"])
		{
			$completado = 1;
			$completados++;
		}
		?>
		<tr>
			<form action="bode_solicitud_generarguia2.php" method="POST" onSubmit="return valida()">
				<td class="Estilo1mc"><?php  echo $row["sp_folio"] ?></td>
				<td class="Estilo1mc"><?php  echo $row["sp_destino"] ?></td>
				<td class="Estilo1mc"><?php echo $row2["doc_especificacion"] ?></td>
				<td class="Estilo1mc"><?php echo $row2["doc_cantidad"] ?></td>
				<td class="Estilo1mc"><?php echo $row4["Despachado"] ?></td>
			</tr>
			<?php $contador++;} ?>

		</td>
	</tr>
	<?php } ?>
</table>