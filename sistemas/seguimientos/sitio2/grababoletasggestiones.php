<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"]=="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$id=$_POST["id"];
$fecha1=$_POST["fecha1"];
$gestion=$_POST["gestion"];

$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

if ($id<>'' and $fecha1<>'' and $gestion<>'') {

  $sql2="INSERT INTO dpp_boletasggestiones (bgestion_boleg_id, bgestion_fecha, bgestion_gestion)
                                    VALUES ('$id','$fecha1','$gestion')";
  //echo $sql2;
   mysql_query($sql2);
  //exit();
   

}

echo "<script>alert('Registros operados con exito !');location.href='boletasgarchivos3.php?llave=1&id=$id';</script>";


?>


