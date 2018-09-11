<?php
require("inc/config.php");
$sql = "SELECT * FROM acti_subtitulo WHERE acti_subtitulo = ".$_POST["acti_subtitulo"];
$resp = mysql_query($sql);
$arrayName = array();
$max = 0;
while($row = mysql_fetch_array($resp))
{
	$max++;
	$arrayName[$max] = array("Subtitulo" =>$row["acti_subtitulo_glosa"],"Descripcion" => $row["acti_subtitulo_desc"]);
}
echo json_encode($arrayName);
?>