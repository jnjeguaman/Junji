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

$sql="update compra_compra set compra_vigente='$vigente' where compra_id=$id";
//echo $sql;
//exit();
mysql_query($sql);

if ($ori2==1) {
   echo "<script>location.href='compra_seguimiento2.php?llave=1&id=$id';</script>";
}
if ($ori2==2) {
   echo "<script>location.href='compra_seguimiento2b.php?llave=1&id=$id';</script>";
}





?>


