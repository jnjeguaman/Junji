<?php
session_start();
require_once("inc/config.php");
extract($_GET);
$sql = "UPDATE acti_inventario SET inv_visible = 0 WHERE inv_id = ".$inv_id;
mysql_query($sql);

$log = "INSERT INTO log VALUES (NULL,".$inv_id.",0,'ELIMINA ITEM DE INVENTARIO','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','INVENTARIO' ,'INVENTARIO')";
mysql_query($log);
?>

<script type="text/javascript">
	window.location.href="acti_inv.php";
</script>