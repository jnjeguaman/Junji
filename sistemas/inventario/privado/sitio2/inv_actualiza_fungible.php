<?php
session_start();
require("inc/config.php");
extract($_POST);
$sql = "UPDATE acti_compra SET f_responsable = '" . $responsable."', f_fecha = '".$recepcion_fecha2."', f_obs = '".$fungible_obs."', f_acepta = ".$recepcion." WHERE id = ".$id;
if(mysql_query($sql,$dbh))
{
echo "<script>location.href='inv_recepcion.php?ori=6&id=$id&compra_id=$compra_id'</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>
