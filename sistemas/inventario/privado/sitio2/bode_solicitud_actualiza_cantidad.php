<?php
session_start();
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_POST);
$sql = "UPDATE bode_detoc3 SET doc_cantidad = ".$cantidad." WHERE doc_id = ".$producto_id." AND doc_sp_id = ".$solicitud_id;
if(mysql_query($sql,$dbh))
{
echo json_encode(true);
}else{
echo json_encode(false);
}
?>