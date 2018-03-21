<?php
require_once("inc/config.php");
extract($_GET);
$sql = "UPDATE concilia_oficio SET concilia_oficio = '".$oficio."' WHERE concilia_region = ".$concilia_region;
mysql_query($sql);

?>
<script type="text/javascript">
	window.location.href='consolidacion_corriente2.php';
</script>