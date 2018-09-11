<?php
require_once("../../../inc/config.php");
extract($_POST);

for($i=1;$i<$totalElementos;$i++){
	if($var1[$i] <> ""){
	$sql = "UPDATE bode_detingreso SET ding_clasificacion = '".$var2[$i]."' WHERE ding_id = ".$var1[$i];
	// echo $sql."<br>";
	mysql_query($sql);

	}
}
?>

<script type="text/javascript">
	window.location.href="../../?page=clasificacion&action=productos&id=<?php echo $ding_ing_id ?>"
</script>