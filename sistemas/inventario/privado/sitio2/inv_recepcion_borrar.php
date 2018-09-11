<?php
session_start();
require_once("inc/config.php");
extract($_GET);
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
mysql_query("UPDATE acti_compra SET compra_estado = 1 WHERE id = ".$id,$dbh);
mysql_query("INSERT INTO log VALUES(NULL,$id,0,'ELIMINA RECEPCION','".$usuario."','".Date("Y-m-d")."','".Date("h:i:s")."','INVENTARIO','RECEPCION')",$dbh);
?>
<script type="text/javascript">
	alert("LA RECEPCION HA SIDO ELIMINADA DEL SISTEMA");
	window.location.href='inv_recepcion.php?cod=11';
</script>