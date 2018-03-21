<?php
require_once("inc/config.php");
extract($_GET);
$sql = "UPDATE dpp_etapas_nota SET nota_estado = 0 WHERE nota_id = ".$nota_id;
mysql_query($sql,$dbh);
echo "<script>window.location.href='facturasarchivos.php?id=".$id."&id1b=".$eta_id."';</script>";
?>