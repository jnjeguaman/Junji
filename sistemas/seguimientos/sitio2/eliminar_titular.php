<?php
require_once("inc/config.php");
extract($_GET);

$consulta = "UPDATE concilia_titulares SET titular_estado = 0 WHERE titular_id = ".$id;
mysql_query($consulta);
echo "<script>window.location.href='consolidacion_corriente2.php';</script>";
?>