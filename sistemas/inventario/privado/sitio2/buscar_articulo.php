<?php
extract($_GET);
require_once("inc/config.php");

if($sp_region_destino <> "")
{
	$where.="a.doc_region = ".$sp_region_destino." AND ";
}

if($s <> "")
{
	$trozos = explode(" ",$s);
	$where.='(a.doc_especificacion LIKE "%'.$s.'%" ';
	for($i=0;$i<sizeof($trozos);$i++)
	{
			$where.= ' || a.doc_especificacion LIKE "%'.$trozos[$i].'%" ';
	}
	$where.=') AND ';
	// $where.="a.doc_especificacion LIKE '%".$s."%' AND ";
	// $where.="MATCH(a.doc_especificacion) AGAINST('".$s."' IN BOOLEAN MODE) AND ";
}

// $sql = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b on a.doc_id = b.ding_prod_id INNER JOIN bode_ingreso c ON c.ing_id = b.ding_ing_id WHERE ".$where." b.ding_unidad > 0 AND c.ing_aprobado <> '' AND c.ing_clasificacion = 1 AND b.ding_recep_tecnica = 'A' AND b.ding_recep_conforme = 'C' AND b.ding_clasificacion = ".$tipo_bien." AND c.ing_estado = 1 AND a.doc_region = ".$sp_region_destino." limit 50";

if($tipo_bien == 1)
{
	$clasificacion = "AND b.ding_clasificacion = 1";
}else if($tipo_bien == 0)
{
	$clasificacion = "AND b.ding_clasificacion = 0";
}else{
	$clasificacion = "AND (b.ding_clasificacion = 1 OR b.ding_clasificacion = 1)";
}

// $sql = "SELECT a.doc_especificacion as Producto,b.ding_clasificacion as Clasificacion, SUM(b.ding_unidad) as Stock FROM bode_detoc a INNER JOIN bode_detingreso b on a.doc_id = b.ding_prod_id INNER JOIN bode_ingreso c ON c.ing_id = b.ding_ing_id WHERE ".$where." b.ding_unidad > 0 AND c.ing_aprobado <> '' AND c.ing_clasificacion = 1 AND b.ding_recep_tecnica = 'A' AND b.ding_recep_conforme = 'C' ".$clasificacion." AND c.ing_estado = 1 AND a.doc_region = ".$sp_region_destino." GROUP BY b.ding_prod_id LIMIT 100";
$sql = "SELECT a.doc_especificacion as Producto,b.ding_clasificacion as Clasificacion, SUM(b.ding_unidad) as Stock,a.doc_conversion as Unitario,a.doc_item as Item,a.doc_gasto as Gasto,a.doc_factor as Factor,doc_activo as Activo FROM bode_detoc a INNER JOIN bode_detingreso b on a.doc_id = b.ding_prod_id INNER JOIN bode_ingreso c ON c.ing_id = b.ding_ing_id INNER JOIN bode_orcom d ON d.oc_id = a.doc_oc_id WHERE ".$where." b.ding_unidad > 0 AND c.ing_aprobado <> '' AND c.ing_clasificacion = 1 AND b.ding_recep_tecnica = 'A' AND b.ding_recep_conforme = 'C' ".$clasificacion." AND c.ing_estado = 1 AND a.doc_region = ".$sp_region_destino." AND d.oc_tipo = 0 AND d.oc_estado = 1 GROUP BY a.doc_especificacion";
$res = mysql_query($sql,$dbh);
while($row = mysql_fetch_array($res))
{
	// $data[] = array("value" => $row["ding_id"],"label" => mb_convert_encoding($row["doc_especificacion"],"UTF-8") ,"stock" => $row["ding_unidad"],"clasificacion" => $row["ding_clasificacion"],"Stock" => $row["ding_unidad"]);
	$data[] = array("label" => mb_convert_encoding($row["Producto"],"UTF-8") ,"clasificacion" => $row["Clasificacion"],"Stock" => $row["Stock"],"unitario" => $row["Unitario"],"item" => $row["Item"],"gasto" => $row["Gasto"],"factor" => $row["Factor"],"activo" => $row["Activo"]);
}
$obj = new stdClass();
$obj->{"item"} = $data;
echo json_encode($data);
?>