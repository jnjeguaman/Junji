<?php
require_once("../inc/config.php");

$query = "SELECT * FROM menu WHERE menu_perfil".$_POST["perfil"]." = 1";
$res = mysql_query($query,$dbh);
$arreglo = array();

while($row = mysql_fetch_array($res))
{
  $arreglo[] = $row["menu_nombre"];
}

echo json_encode($arreglo);
?>
