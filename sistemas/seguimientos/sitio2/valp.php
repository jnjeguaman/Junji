<?php
require_once("inc/config.php");
$sql = "SELECT count(provee_id) as Total FROM dpp_proveedores where provee_rut = '".$_POST["rut"]."'";
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);
$total = intval($row["Total"]);
if($total > 0)
{
	echo json_encode(1);
}else{
	echo json_encode(0);
}
?>