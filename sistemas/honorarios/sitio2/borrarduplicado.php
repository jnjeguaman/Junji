<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fecha=date('Y-m-d');
$year1=date('Y');

$usuario=$_SESSION["nom_user"];

$id=$_GET["id"];
$etaid=$_GET["etaid"];

$sql22 = "delete from dpp_honorarios2 where hono2_eta_id=$etaid and hono2_id=$id";
//echo $sql22;
//exit();
mysql_query($sql22);

$sql22 = "update dpp_etapas set eta_swhono='2' where eta_id=$etaid";
//echo $sql22;
//exit();
mysql_query($sql22,$dbh2);



echo "<script>location.href='editconta.php?llave=1';</script>";


?>


