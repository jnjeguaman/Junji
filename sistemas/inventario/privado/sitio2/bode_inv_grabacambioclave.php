<?
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
require("inc/config.php");
require("inc/querys.php");
$fecha=date('Y-m-d');
$hora=date("h:i");

$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);

//echo "$rut2<> and $nombres<> and $paterno<> and $materno<>";
if ($nueva1<>"" and $nueva2<>"" ) {

  $nueva1=md5($nueva1);
  $sql2="update usuarios set password='$nueva1' where nombre='$usuario' and password='$actual' ";
  echo $sql2;
  if (!(mysql_query($sql2,))){
      $sw=2;
  } else {
      $sw=1;
  }

}

exit();


echo "<script>location.href='inv_cambioclave.php?llave=$sw&rut=$rut2';</script>";


?>


