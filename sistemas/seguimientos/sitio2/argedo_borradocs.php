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
  $sql1="update argedo_documentos set docs_archivo='' where docs_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

}

if ($doc==2) {

  $sql1="update argedo_documentos set docs_archivo2='' where docs_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

}
if ($doc==3) {

  $sql1="update argedo_documentos set docs_archivo3='' where docs_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

}

if ($doc==4) {

  $sql1="update argedo_documentos set docs_archivo4='' where docs_id=$id ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

}

//exit();
if ($ori=='') {
   echo "<script>location.href='argedo_editresyofi.php?sw=1&ti=$ti&id=$id';</script>";
}
if ($ori==2) {
   echo "<script>location.href='argedo_editant.php?sw=1&ti=$ti&id=$id';</script>";
}


?>


