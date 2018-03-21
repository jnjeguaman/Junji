<?
require("inc/config.php");
$id=$_POST["a"];


$sql= "select * from dpp_etapas where eta_id=$id ";
//echo $sql;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$fpago=$row["eta_fpago"];
if ($fpago=="Cheque") {
    $fpago2="Tr";
    $sql2= "update dpp_etapas set eta_fpago='Transferencia'  where eta_id=$id ";
     mysql_query($sql2);
}
if ($fpago=="Transferencia") {
    $fpago2="Ch";
    $sql2= "update dpp_etapas set eta_fpago='Cheque'  where eta_id=$id ";
    mysql_query($sql2);
}
if ($fpago=="") {
    $fpago2="Ch";
    $sql2= "update dpp_etapas set eta_fpago='Cheque'  where eta_id=$id ";
    mysql_query($sql2);
}


echo $fpago2;

?>

