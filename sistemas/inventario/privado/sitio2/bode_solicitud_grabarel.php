<?php
session_start();
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
extract($_POST);
require_once("inc/config.php");
for($i=1;$i<=$totalElementos;$i++)
{
	$var = $var1[$i];
	if($var1[$i] <> "")
	{
		$sql = "INSERT INTO bode_solicitud_rel VALUES (NULL,'$doc_id','$var1[$i]','$var2[$i]',1,'$sp_id',NULL,'$var3[$i]')";
		mysql_query($sql,$dbh);
		$sql2 = "UPDATE bode_detingreso SET ding_unidad = ding_unidad - ".$var2[$i]." WHERE ding_id = ".$var1[$i];
		mysql_query($sql2,$dbh);
		
	}
}
echo "<script>window.opener.location.reload();window.close();</script>";
?>
