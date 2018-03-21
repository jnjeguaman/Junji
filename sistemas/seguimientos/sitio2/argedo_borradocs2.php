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

if ($ti==4 or $ti=='') {
  $sql1="update argedo_recibida set reci_archivo='' where reci_id=$id ";
  echo $sql1;
//  exit();
  mysql_query($sql1);

}

if ($ti==5) {
  $sql1="update argedo_despachada set despa_archivo='' where recu_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

}

//exit();
if ($ti==4 or $ti=='') {
   echo "<script>location.href='argedo_editrecibida.php?sw=1&ti=$ti&id=$id';</script>";
}
if ($ti==5) {
   echo "<script>location.href='argedo_editdespachada.php?sw=1&ti=$ti&id=$id';</script>";
}


?>


