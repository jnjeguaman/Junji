<?php
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require_once("inc/config.php");
extract($_GET);

$dato = mysql_query("SELECT * FROM bode_ingreso WHERE ing_id = ".$ing_id);
$datos = mysql_fetch_array($dato);
$ruta = "../../../".$datos["ing_rutatc"].$datos["ing_archivotc"];

unlink($ruta);

$sql = "UPDATE bode_ingreso SET ing_rutatc = '', ing_archivotc = ''  WHERE ing_id = ".$ing_id;
mysql_query($sql);

$log = "INSERT INTO log VALUES (NULL,".$ing_id.",0,'ELIMINA DOCUMENTO ADJUNTO','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA' ,'RECEPCION TECNICA / CONFORME')";
mysql_query($log);
?>
<script type="text/javascript">
	opener.location.reload(); window.close();
</script>