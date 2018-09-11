<?php
require_once("inc/config.php");
// BUSCAMOS LOS PRODUCTOS SEGUN EL INGRESO
// 5421
// 5427

$pos = 1;
// $ing_id = array(1 => 5456);
$sql = "SELECT ding_prod_id,ding_cantidad FROM bode_detingreso WHERE ding_ing_id = ".$_GET["ing_id"];
$res = mysql_query($sql);

while($row = mysql_fetch_array($res))
{
	$update = "UPDATE bode_detoc SET doc_recibidos = doc_recibidos - ".$row["ding_cantidad"].", doc_tecnicos = 0,doc_final=0 WHERE doc_id = ".$row["ding_prod_id"].";";
	echo $update."<br>";
}

$delete = "DELETE FROM bode_detingreso WHERE ding_ing_id = ".$_GET["ing_id"].";";
echo $delete."<br>";
$delete2 = "DELETE FROM bode_ingreso WHERE ing_id = ".$_GET["ing_id"].";";
echo $delete2;
?>