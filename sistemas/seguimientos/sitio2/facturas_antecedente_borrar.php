<?php
require_once("inc/config.php");
$sql = "UPDATE dpp_facturas_antecedente SET ant_estado = 0 WHERE ant_id = ".$_GET["id"];
mysql_query($sql);
?>
<script type="text/javascript">
	window.location.href="facturas.php";
</script>