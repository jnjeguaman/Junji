<?php
session_start();
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
extract($_POST);
require_once("inc/config.php");
for($i=1;$i<=$totalElementos;$i++)
{
	if($var1[$i] <> "")
	{
		$sql = "DELETE FROM bode_solicitud_rel WHERE sp_rel_id = ".$var1[$i];
		mysql_query($sql,$dbh);
		$sql2 = "UPDATE bode_detingreso SET ding_unidad = ding_unidad + ".$var2[$i];
		mysql_query($sql2);
	}
}
echo "<script>window.opener.location.reload();alert('Solicitud procesada con exito!');window.close();</script>";
?>
