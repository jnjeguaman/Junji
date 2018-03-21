<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}




$id=$_POST["id"];
$id2=$_POST["id2"];
$tipo=$_POST["tipo"];
$obs=$_POST["obs"];

      $sql1="insert into dpp_acciones (acc_eta_id , acc_tipo, acc_texto, acc_fecha, acc_user ) values  ('$id2','$tipo','$obs','$fechamia','$usuario') ";
      echo $sql1;
      //exit();
      mysql_query($sql1);

echo "<script>location.href='verdoccontab.php?llave=1&id2=$id2';</script>";


?>


