<?php
require("inc/config.php");
$sql = "SELECT * FROM acti_catsub WHERE catsub_cat_id = ".$_POST["catsub_cat_id"];
$resp = mysql_query($sql);
$arrayName = array();
$max = 0;
while($row = mysql_fetch_array($resp))
{
	$max++;
	$arrayName[$max] = $row["catsub_nombre"];
}
echo json_encode($arrayName);
?>