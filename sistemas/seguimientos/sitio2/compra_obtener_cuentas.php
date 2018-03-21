<?php
session_start();
require_once("inc/config.php");
extract($_POST);
$item = explode(".",$imputacion);
$sql = "SELECT cuenta_activo,cuenta_gasto,cuenta_glosa FROM compra_cuentas WHERE cuenta_item = '".$item[0]."' AND cuenta_subitem = '".$item[1]."' AND cuenta_asignacion = '".$item[2]."' AND cuenta_activo IS NOT NULL AND cuenta_gasto IS NOT NULL";
$res = mysql_query($sql);
$row = mysql_fetch_array($res);
echo json_encode(array(0 => $row["cuenta_activo"],1 => $row[cuenta_gasto],2 => $row["cuenta_glosa"]));
?>