<?php 
session_start();
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
extract($_POST);
require_once("inc/config.php");

for($i=0;$i<$contador;$i++)
{
	if($var[$i] <> "")
	{
		$sql = "UPDATE dpp_etapas SET eta_asignado2 = '".$dos."' WHERE eta_id = ".$var[$i];
		mysql_query($sql);
	}
}
?>
<script type="text/javascript">
	window.location.href='valida5asignacion.php';
</script>