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

  $sql1="delete from compra_archivo where arch_id=$id2 ";
 // echo $sql1;
 // exit();
  mysql_query($sql1);
}



   echo "<script>location.href='facturasarchivos.php?id=$id&id1b=$id1b';</script>";



?>


