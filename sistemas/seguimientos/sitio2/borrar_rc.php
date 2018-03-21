<?php
require_once("inc/config.php");
extract($_GET);
$sql = "UPDATE compra_doc_inedis SET doc_estado = 0 WHERE doc_id = ".$doc_id;
mysql_query($sql,$dbh);
echo "<script>window.location.href='facturasarchivos.php?id=".$id."&id1b=".$eta_id."';</script>";
?>