<?php
session_start();
include("inc/config.php");
$fecha = Date("Y-m-d");
$hora = Date("H:i:s");
extract($_POST);
$rut = explode("-", $rut);
$sql = "INSERT INTO dpp_proveedores (provee_id,provee_rut,provee_dig,provee_nombre,provee_paterno,provee_materno) VALUES (0,'".$rut[0]."','".$rut[1]."','".$p_nombre."','".$apaterno."','".$amaterno."')";
mysql_query($sql);
echo "<script>window.location.href='argedo_agregafuncionario.php';</script>";

?>