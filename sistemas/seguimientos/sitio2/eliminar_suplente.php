<?php
require_once("inc/config.php");
extract($_GET);

$consulta = "UPDATE concilia_suplentes SET suplente_estado = 0 WHERE suplente_id = ".$id;
mysql_query($consulta);
echo "<script>window.location.href='consolidacion_corriente2.php';</script>";
?>