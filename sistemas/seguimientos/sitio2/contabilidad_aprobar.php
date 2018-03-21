<?php
require_once("inc/config.php");
extract($_GET);
$sql = "UPDATE dpp_etapas SET eta_peritaje = 1 WHERE eta_id = ".$id;
mysql_query($sql);
?>
<script type="text/javascript">
	window.location.href="valida5.php";
</script>