<?php
session_start();
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_POST);
for($i=1; $i <= $totalElementos; $i++)
{
	if($var11[$i] <> "")
	{
		$sql = "INSERT INTO bode_solicitud_rel VALUES (NULL,'$doc_id','$var11[$i]','$var22[$i]',1,'$sp_id',NULL,'$var33[$i]')";
		$sql2 = "UPDATE bode_detingreso SET ding_unidad = ding_unidad - ".$var22[$i]." WHERE ding_id = ".$var11[$i];
		mysql_query($sql,$dbh);
		mysql_query($sql2,$dbh);
	}
}
echo "<script>window.opener.location.reload();window.close();</script>";
?>