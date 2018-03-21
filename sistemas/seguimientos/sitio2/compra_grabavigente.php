<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$hora=date("h:i:s");
$annomia=date('Y');
$regionsession = $_SESSION["region"];
$usuario=$_SESSION["nom_user"];

extract($_POST);

$sql="update compra_vigentedet set cvig_vigente='$vigente', cvig_total='$total', cvig_meses='$meses' where cvig_id=$id2";
//echo $sql;
//exit();
mysql_query($sql);

echo "<script>location.href='compra_vigente.php?llave=1&id=$id&id2=$id2&ori=$ori';</script>";



?>


