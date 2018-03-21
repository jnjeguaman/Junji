<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];



$cont=$_POST["cont"];
$var=$_POST["var"];
$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;





while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;

   if ($var1<>"" ) {


   	$sql1="update dpp_etapas set  eta_asignado2='$dos' where eta_id=$var1 ";



      //$sql1="update dpp_etapas set eta_usu_recepcion22='$dos' where eta_id=$var1 ";
      // echo $sql1;

      mysql_query($sql1);
   }


   $cont2++;
}
//exit();

echo "<script>location.href='valida5asignacion.php?llave=1';</script>";









?>


