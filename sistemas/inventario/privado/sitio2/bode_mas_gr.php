<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_POST);
$truncate = "DELETE FROM bode_detoc2 WHERE ddoc_mas_id = ".$masid;
mysql_query("DELETE FROM bode_detoc_2 WHERE ddoc_mas_id = ".$masid);
for ($i=1; $i <=($nprod) ; $i++) { 
	for ($j=1; $j <=$njard ; $j++) { 
		if($arrcantidad[$i][$j] > 0 AND $arrcantidad[$i][$j] <> ""){
			$query = "INSERT INTO bode_detoc_2 VALUES (NULL,".$arrjandin[1][$j].",".$arrid[$i][1].",".$arrcantidad[$i][$j].",".$masid.")";
			mysql_query($query);
		}
	}
}

$log = "INSERT INTO log VALUES(NULL,".$masid.",0,'CIERRA MATRIZ','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','MATRIZ')";
mysql_query($log);
$update2 = "UPDATE bode_masiva SET mas_estado = 0 WHERE mas_id = ".$masid; mysql_query($update2);
?>
<script type='text/javascript'>
	window.location.href='bode_inv_indexguia3a.php?cod=41';
</script>