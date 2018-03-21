<?php
session_start();
require_once("inc/config.php");
extract($_GET);

$resoluciones = array(
1 => array(0 => 'fac_nroresolucion', 1 => "fac_docs_id"),
2 => array(0 => 'fac_res2', 1 => "fac_doc_id2"),
3 => array(0 => 'fac_res3', 1 => "fac_doc_id3"),
4 => array(0 => 'fac_res4', 1 => "fac_doc_id4"),
5 => array(0 => 'fac_res5', 1 => "fac_doc_id5"),
6 => array(0 => 'fac_res6', 1 => "fac_doc_id6"),
);

$sql = "UPDATE dpp_facturas SET ".$resoluciones[$res][0]." = NULL, ".$resoluciones[$res][1]." = NULL WHERE fac_id = ".$id;
mysql_query($sql);
echo '<script>window.location.href="facturasarchivos.php?llave=1&id='.$id.'&id1b='.$eta_id.'"</script>'
?>
