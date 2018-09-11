<?php
require_once("inc/config.php");
extract($_POST);
$rut = trim(str_replace(".", "", $rut));

$sql = mysql_query("SELECT proveedor_glosa FROM acti_proveedor WHERE proveedor_rut = ".$rut." AND proveedor_dv = '".$dv."'");
$row = mysql_fetch_array($sql);
echo json_encode($row["proveedor_glosa"]);
?>