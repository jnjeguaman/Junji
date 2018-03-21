<?php
require_once("inc/config.php");
extract($_POST);

$consulta = "UPDATE concilia_encargados SET encargado_1 = '".strtoupper($encargado_1)."',encargado_2 = '".strtoupper($encargado_2)."',encargado_3 = '".strtoupper($encargado_3)."',encargado_4 = '".strtoupper($encargado_4)."'WHERE encargado_region = ".$region;
mysql_query($consulta);
echo "<script>window.location.href='consolidacion_corriente2.php';</script>";
?>