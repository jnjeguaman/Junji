<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$id=$_POST["id"];
$accion=$_POST["accion"];
$comentario=$_POST["comentario"];


if ($accion<>"") {


  $sql3="  update dpp_boletasg set boleg_estado='$accion', boleg_comentario='$comentario' where boleg_id='$id' ";
//  echo $sql3;
//  exit();
  mysql_query($sql3);

}



echo "<script>alert('Registros operados con exito !');location.href='boletasgarchivos2.php?llave=2&id=$id';</script>";


?>


