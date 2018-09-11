<?php
session_start();
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_GET);
$sql = "UPDATE bode_solicitud SET sp_estado = 99 WHERE sp_id = ".$id;
if(mysql_query($sql))
{
	mysql_query("INSERT INTO log VALUES(NULL,".$id.",0,'ELIMINA NOTA DE PEDIDO','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','SOLICITUD DE PEDIDO')");
	echo "<script>window.location.href='bode_inv_indexoc7.php?cod=50';</script>";
}else{
	echo "Ha ocurrido un error : ".mysql_error();
}
?>