<?php
session_start();
require_once("inc/config.php");
extract($_GET);

//INFORMACION DE LA TABLA
// $sql = "SELECT * FROM compra_orden WHERE oc_id = ".$oc_id;
// $res = mysql_query($sql,$dbh);
// $row = mysql_fetch_array($res);
$sql = "SELECT * FROM dpp_etapas WHERE eta_id = ".$id1b;
$res = mysql_query($sql);
$row = mysql_fetch_array($res);

//ACTUALIZAMOS LA TABLA
// $sql2 = "UPDATE compra_orden SET oc_compromiso_archivo = '' WHERE oc_id = ".$oc_id;
$sql2 = "UPDATE dpp_etapas SET eta_compromiso_archivo = '' WHERE eta_id = ".$id1b;
mysql_query($sql2,$dbh);

// BORRAMOS EL ARCHIVO DEL SERVIDOR
$raiz = "../../archivos/docfac";
$ruta = $raiz."/".$row["eta_compromiso_archivo"];
// unlink($ruta);
echo "<script>window.location.href='facturasarchivos.php?id=".$id."&id1b=".$id1b."'</script>";
?>