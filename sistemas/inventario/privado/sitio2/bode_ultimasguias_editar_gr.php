<?php 
require_once("inc/config.php");
extract($_POST);

for ($i=1; $i <= $totalLineas ; $i++) { 
	$sql = "UPDATE bode_orcom SET oc_fecha = '".$fentrega."' WHERE oc_id = ".$var1[$i];
	mysql_query($sql);
}
echo "<script>window.location.href='bode_inv_indexoc3.php?cod=22';</script>"
?>
