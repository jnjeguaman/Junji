<?php
require_once("inc/config.php");
session_start();
if($_SESSION["nom_user"] == "" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
extract($_POST);
for($i=0;$i<$totalElementos;$i++)
{
	$sql = "UPDATE acti_compra SET compra_devengado = 1,compra_monto = ".$var2[$i]." WHERE id = ".$var12[$i];
	mysql_query($sql);
}
?>
<script type="text/javascript">
	window.location.href="devengo.php";
</script>