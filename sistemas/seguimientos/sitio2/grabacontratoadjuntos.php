<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];



$fecha2=$_POST["fecha1"];
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3=$_POST["fecha3"];
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
$total=$_POST["total"];
$moneda4=$_POST["moneda4"];
$nroresolucion=$_POST["nroresolucion"];
$id=$_POST["id"];
$ori=$_POST["ori"];



if ($total<>"" and $id<>"") {

  $sql3 = "update dpp_contratos set cont_fechainicio='$fecha2', cont_vence='$fecha3', cont_total='$total', cont_tipo2='$moneda4', cont_nroresolucion='$nroresolucion' where cont_id='$id' ";

                               

//  echo $sql3;
//  exit();
  mysql_query($sql3);


}
//exit();
echo "<script>location.href='contratosadjuntos.php?id=$id&ori=$ori';</script>";


?>


