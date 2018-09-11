<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_POST);
if(mysql_query("DELETE FROM bode_orcom2 WHERE oc_id = ".$oc_id))
{
	echo "true";
}else{
	echo "false";
}
?>