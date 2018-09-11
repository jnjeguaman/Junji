<?php
extract($_GET);
require_once("config.php");

if($region <> "")
{
	$where.="a.doc_region = ".$region." AND ";
}

if($oc <> "")
{
	$where.="b.oc_id2 LIKE '%".$oc."%' AND ";
}

if($s <> "")
{
	$where.="a.doc_especificacion LIKE '%".$s."%' AND ";
}
// $sql = "SELECT * FROM bode_detoc a INNER JOIN bode_detingreso b on a.doc_id = b.ding_prod_id WHERE ".$where." b.ding_unidad > 0";
$sql = "SELECT distinct(a.doc_especificacion) AS doc_especificacion FROM bode_detoc a INNER JOIN bode_orcom b on b.oc_id = a.doc_oc_id WHERE ".$where." b.oc_tipo = 0";
$res = mysql_query($sql,$dbh);

while($row = mysql_fetch_array($res))
{
	$data[] = utf8_encode($row["doc_especificacion"]);
}
echo json_encode($data);
?>