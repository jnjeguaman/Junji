<?php
require_once("inc/config.php");
extract($_GET);
$sql = "UPDATE argedo_doc_internos SET inte_estado = 0 WHERE inte_id = ".$id;
mysql_query($sql);
?>

<script type="text/javascript">
	alert("Documento eliminado con exito");
	window.location.href='argedo_cartolaregional.php';
</script>