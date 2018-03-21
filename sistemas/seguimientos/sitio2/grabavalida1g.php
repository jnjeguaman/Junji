<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}




$cont=$_POST["cont"];
$var=$_POST["var"];
$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;

   if ($var1<>"" and $uno==1) {
      $sql1="update dpp_boletasg set boleg_estado=2  where boleg_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);
   }
   if ($var1<>"" and $uno==2) {
      $sql1="update dpp_boletasg set boleg_estado=9, boleg_rechazo='$justifica', boleg_fecha_rech='$fechamia', boleg_usu_rech='$usuario'  where boleg_id=$var1 ";

//      echo $sql1;
      mysql_query($sql1);
   }

   $cont2++;
}

echo "<script>alert('Registros operados con exito !');location.href='valida1g.php?llave=1';</script>";


?>


