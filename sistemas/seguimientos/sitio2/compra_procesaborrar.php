<?
session_start();
require("inc/config.php");
require("inc/querys.php");

$sql21="select * from compra_orden where oc_eta_id<>0 ";
//  echo $sql21;
  $result21=mysql_query($sql21);
  while ($row21=mysql_fetch_array($result21)) {
     $uno=$row21["oc_id"];
     $dos=$row21["oc_eta_id"];
     $sql22="insert into compra_oceta (oceta_oc_id, oceta_eta_id) values ('$uno','$dos')";
     mysql_query($sql22);
  }
?>


