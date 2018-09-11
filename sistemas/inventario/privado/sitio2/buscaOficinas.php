<?php
require_once("inc/config.php");
extract($_POST);
$sql = "SELECT * FROM acti_zona where zona_region='$region_id' and not zona_glosa like 'JI%'";
// ECHO $sql;
$res = mysql_query($sql);
$options = "<option value=''>Selecionar...</option>";
while ($row = mysql_fetch_array($res)) {
	$options .="<option value='".$row["zona_glosa"]."'>".$row["zona_glosa"]."</option>";
}
echo json_encode($options);
?>
