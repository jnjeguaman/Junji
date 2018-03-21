<?php
require_once("inc/config.php");
extract($_GET);

if(isset($_GET["ori"]))
{
	$sql = "UPDATE dpp_boletasg SET boleg_estado = '".$ori."' WHERE boleg_id = ".$id;
	mysql_query($sql);
}
?>

<script type="text/javascript">
	alert("Información actualizada con Exito");
	window.location.href="valida3g.php";
</script>