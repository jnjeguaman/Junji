<?php
	require_once("inc/config.php");
	session_start();
	$regionSession = $_SESSION["region"];
	$filename = "MATRIZ_".$regionSession."_".Date("Y-m-d H_i_s");
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=".$filename.".xls");

	if($_SESSION["region"] == 16 OR $_SESSION["region"] == 13)
	{
		$arrayUBI = [];
		$ubi = "(";
		$sql_ubicacion = "SELECT * FROM bode_ubicacion WHERE ubi_region = 16 AND ubi_estado = 1";
		$res_ubicacion = mysql_query($sql_ubicacion,$dbh);

		while($row_ubicacion = mysql_fetch_array($res_ubicacion))
		{
			$arrayUBI[] = $row_ubicacion["ubi_glosa"];
		}
		$totalUBI = sizeof($arrayUBI);

		foreach ($arrayUBI as $key => $value) {
			if(($totalUBI -1) == $key)
			{
				$ubi.="c.ding_ubicacion = '".$value."'";
			}else{
				$ubi.="c.ding_ubicacion = '".$value."' OR ";
			}
		}
		$ubi.=")";
	}

	if($_SESSION["region"] == 16)
	{
		$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON a.oc_id = b.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = b.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE (a.oc_tipo = 0 OR a.oc_tipo = 1) AND (d.doc_region = 16 OR d.doc_region = 13) AND a.oc_estado = 1 AND d.doc_estado <> 'B' AND c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C' AND b.ing_aprobado <> '' AND c.ding_unidad > 0 AND b.ing_aprobado <> '' AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND b.ing_estado = 1 AND b.ing_clasificacion = 1 AND ".$ubi." ORDER BY c.ding_id DESC";
	}elseif($_SESSION["region"] == 13){
		$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON a.oc_id = b.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = b.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE (a.oc_tipo = 0 OR a.oc_tipo = 1) AND (d.doc_region = 13) AND a.oc_estado = 1 AND d.doc_estado <> 'B' AND c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C' AND b.ing_aprobado <> '' AND c.ding_unidad > 0 AND b.ing_aprobado <> '' AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND b.ing_estado = 1 AND b.ing_clasificacion = 1 AND ".$ubi." ORDER BY c.ding_id DESC";
	}else{
		$sql = "SELECT * FROM bode_orcom a INNER JOIN bode_ingreso b ON a.oc_id = b.ing_oc_id INNER JOIN bode_detingreso c ON c.ding_ing_id = b.ing_id INNER JOIN bode_detoc d ON d.doc_id = c.ding_prod_id WHERE (a.oc_tipo = 0 OR a.oc_tipo = 1) AND d.doc_region = ".$regionSession." AND a.oc_estado = 1 AND d.doc_estado <> 'B' AND c.ding_recep_tecnica = 'A' AND c.ding_recep_conforme = 'C' AND b.ing_aprobado <> '' AND c.ding_unidad > 0 AND b.ing_aprobado <> '' AND (c.ding_clasificacion = '1' OR c.ding_clasificacion = '0') AND b.ing_estado = 1 AND b.ing_clasificacion = 1  ORDER BY c.ding_id DESC";
	}
	// echo $sql;exit;
	$res = mysql_query($sql);
?>

<table width="100%" border="1">
	<tr>
		<td bgcolor="tomato">ID</td>
		<td bgcolor="tomato">PRODUCTO</td>
		<td bgcolor="tomato">VALOR UNITARIO</td>
		<td bgcolor="tomato">UBICACION</td>
		<td bgcolor="tomato">ORDEN DE COMPRA</td>
		<td bgcolor="tomato">STOCK DISPONIBLE</td>
		<td bgcolor="tomato">UNIDAD DE MEDIDA</td>
		<td bgcolor="tomato">FACTOR</td>
		<td bgcolor="tomato">CLASIFICACION</td>
		<td bgcolor="tomato">REGION</td>
	</tr>
	<?php
	while($row = mysql_fetch_array($res)) {
		?>
		<tr>
			<td><?php echo $row["ding_id"] ?></td>
			<td><?php echo mb_convert_encoding(str_replace(",","",$row["doc_especificacion"]),"ISO-8859-1") ?></td>
			<td><?php echo $row["doc_conversion"] ?></td>
			<td><?php echo $row["ding_ubicacion"] ?></td>
			<td><?php echo $row["oc_id2"] ?></td>
			<td><?php echo $row["ding_unidad"] ?></td>
			<td><?php echo $row["doc_umedida"] ?></td>
			<td><?php echo $row["doc_factor"] ?></td>
			<td>
				<?php if (intval($row["ding_clasificacion"]) == 1): ?>
					INVENTARIABLE
				<?php elseif(intval($row["ding_clasificacion"]) == 0): ?>
					EXISTENCIA
				<?php else: ?>
					SIN CLASIFICAR
				<?php endif ?>
			</td>
			<td><?php echo $row["doc_region"] ?></td>
		</tr>
		<?php } ?>
	</table>
