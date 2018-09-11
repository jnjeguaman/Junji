<?php
require_once("inc/config.php");
extract($_GET);

if($tipo == "jardines")
{
	mysql_query("DELETE FROM bode_orcom2 WHERE oc_mas_id = ".$masid);
}

if($tipo == "productos")
{
	mysql_query("DELETE FROM bode_detoc2 WHERE doc_mas_id = ".$masid);
}

echo "<script>window.location.href='bode_inv_indexguia3.php?ori=3&masid=".$masid."';</script>";
?>