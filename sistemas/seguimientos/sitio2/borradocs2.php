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

if ($ant==1) {
  $sql1="update dpp_facturas set fac_ant1='', fac_ruta1='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($ant==2) {
  $sql1="update dpp_facturas set fac_ant2='', fac_ruta2='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($ant==3) {
  $sql1="update dpp_facturas set fac_ant3='', fac_ruta3='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($ant==4) {
  $sql1="update dpp_facturas set fac_ant4='', fac_ruta4='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($ant==5) {
  $sql1="update dpp_facturas set fac_ant5='', fac_ruta5='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}
if ($ant==6) {
  $sql1="update dpp_facturas set fac_ant6='', fac_ruta6='' where fac_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
}



   echo "<script>location.href='facturasarchivos.php?id=$id&id1b=$id1b';</script>";



?>


