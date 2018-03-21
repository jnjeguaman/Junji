<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$anno=date('Y');
$hora=date("h:i");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];



extract($_GET);

if ($doc==1) {
  $sql1="update dpp_facturas set fac_archivo='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($doc==2) {
  $sql1="update dpp_facturas set fac_doc3='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($doc==3 and 1==2) {
  $sql1="update dpp_facturas set fac_doc1='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($doc==4) {
  $sql1="update dpp_facturas set fac_doc2='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}



   echo "<script>location.href='facturasarchivos.php?id=$id&id1b=$id1b';</script>";



?>


