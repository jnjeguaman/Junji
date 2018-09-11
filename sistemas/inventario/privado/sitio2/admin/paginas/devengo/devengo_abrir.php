<?php 
require_once("../../../inc/config.php");
extract($_GET);

$sql = "UPDATE acti_compra SET compra_devengado = 0 WHERE id = ".$id;
mysql_query($sql);
 ?>

 <script type="text/javascript">
 	alert("Tarea completada");
 	window.location.href="../../?page=devengo";
 </script>