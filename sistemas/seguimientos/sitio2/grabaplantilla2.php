<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
 

$cont=$_POST["cont"];
$id=$_POST["id"];
$id1b=$_POST["id1b"];
$valor=$_POST["valor"];


$sql1="update dpp_etapas set eta_prorro_id='$valor' where eta_id=$id1b ";
//      echo $sql1;
//      exit();
mysql_query($sql1);





//exit();
echo "<script>location.href='dpp_plantilla2.php?id=$id&id1b=$id1b';</script>";








?>



