<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}
require_once("inc/config.php");
extract($_POST);
extract($_SESSION);

$fechaSys = Date("Y-m-d");
$horaSys = Date("H:i:s");
for ($i=0; $i < $totalItems; $i++) { 
	if($var1[$i] <> '')
	{
		$cant = $var2[$i] - $var3[$i];
		$update = "UPDATE bode_detingreso SET ding_unidad = ".$var2[$i]." WHERE ding_id = ".$var1[$i];
		$log = "INSERT INTO log VALUES(NULL,".$var1[$i].",".$cant.",'AJUSTE','".$_SESSION["nom_user"]."','".$fechaSys."','".$horaSys."','BODEGA','MOVIMIENTOS - AJUSTES')";
		mysql_query($log);
		mysql_query($update);
	}
}
?>
<script>
	window.location.href='bode_inv_indexoc4.php?cmd=Ajustes';
</script>