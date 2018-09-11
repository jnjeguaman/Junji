<?php
require_once("inc/config.php");
extract($_POST);

$sql = mysql_query("SELECT COUNT(oc_folioguia) as Total FROM bode_orcom WHERE oc_estado = 1 AND oc_folioguia = ".$folio);
$row = mysql_fetch_array($sql);
$total = $row["Total"];
echo json_encode($total);

?>