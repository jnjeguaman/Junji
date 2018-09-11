<?php
extract($_POST);

include_once("inc/config.php");
$oc_id = "SELECT oc_id FROM bode_orcom WHERE oc_id2 = '".$oc_numero."' AND oc_estado = 1";
$oc_id = mysql_query($oc_id,$dbh);
$oc_id = mysql_fetch_array($oc_id);
$oc_id = intval($oc_id["oc_id"]);

$sql = "SELECT COUNT(ing_guia) AS Total FROM bode_ingreso WHERE ing_guia = ".$n_guia." AND ing_oc_id = ".$oc_id." AND ing_estado = 1";
$res = mysql_query($sql,$dbh);
$row = mysql_fetch_array($res);

if(intval($row["Total"]) >= 1)
{
	echo json_encode(true);
}else{
	echo json_encode(false);
}
?>