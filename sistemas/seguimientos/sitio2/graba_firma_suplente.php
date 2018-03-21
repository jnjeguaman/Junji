<?php
require_once("inc/config.php");
extract($_POST);

$consulta = "INSERT INTO concilia_suplentes VALUES (NULL,".$region.",'".strtoupper($suplente)."',1)";
mysql_query($consulta);

echo "<script>window.location.href='consolidacion_corriente2.php';</script>";
?>