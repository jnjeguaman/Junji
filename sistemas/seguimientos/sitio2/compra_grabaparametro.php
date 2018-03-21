<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];



extract($_POST);

if ($categoria<>'') {

$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$sql="INSERT INTO compra_categoria (cat_nombre )
                            VALUES ('$categoria')";
//echo $sql;
//exit();
mysql_query($sql);



}

echo "<script>location.href='compra_parametro.php?llave=1';</script>";


?>


