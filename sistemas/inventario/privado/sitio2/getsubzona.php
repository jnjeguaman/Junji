<?php
require("inc/config.php");
$sql = "SELECT * FROM acti_subzona WHERE acti_subzona_zona_id = ".$_POST["zona_id"];
$resp = mysql_query($sql);
$arrayName = array();
$max = 0;
while($row = mysql_fetch_array($resp))
{
	$max++;
	$arrayName[$max] = $row["acti_subzona_glosa"];
}
echo json_encode($arrayName);
?>