<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$anno=date('Y');
$usuario=$_SESSION["nom_user"];


$nombre=$_POST["nombre"];
$id2=$_POST["id2"];
//$tipo=$_POST["tipo"];



if (1==1) {

  $sql1="update dpp_encuestas set encu_estado=2 where encu_cont_id=$id2 and (encu_tipo=1  or encu_tipo=2 or encu_tipo=3) ";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
  
  $sql1="update dpp_encuestas set encu_estado=2 where encu_cont_id=$id2 and encu_tipo=2";
//  echo $sql1;
//  exit();
//  mysql_query($sql1);

 $sql1="update dpp_encuestas set encu_estado=2 where encu_cont_id=$id2 and encu_tipo=3";
//  echo $sql1;
//  exit();
//  mysql_query($sql1);


  $sql1="insert into dpp_encuestas (encu_nombre , encu_cont_id, encu_fecha, encu_user,encu_tipo,encu_periodo) values ('$nombre','$id2','$fechamia','$usuario','1','$anno')";
//  echo $sql1;
//  exit();
  mysql_query($sql1);
  
  $sql1="insert into dpp_encuestas (encu_nombre , encu_cont_id, encu_fecha, encu_user,encu_tipo) values ('$nombre','$id2','$fechamia','$usuario','2')";
//  echo $sql1;
//  exit();
//  mysql_query($sql1);

  $sql1="insert into dpp_encuestas (encu_nombre , encu_cont_id, encu_fecha, encu_user,encu_tipo) values ('$nombre','$id2','$fechamia','$usuario','3')";
//  echo $sql1;
//  exit();
//  mysql_query($sql1);

  
  
  $sql1="insert into dpp_evaluacion (eva_nombre, eva_periodo, eva_cont_id ) values ('$nombre','2011','$id2')";
//  echo $sql1;
//  exit();
  mysql_query($sql1);

}

echo "<script>location.href='evaexterna.php?llave=1&id2=$id2';</script>";


?>


