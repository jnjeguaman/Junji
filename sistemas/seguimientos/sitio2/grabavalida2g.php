<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];



$cont=$_POST["cont"];
$var=$_POST["var"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;
   if ($var1<>"" ) {
      $sql1="update dpp_boletasg set boleg_estado=3  where boleg_id=$var1 ";
    echo $sql1;
      mysql_query($sql1);
   }


   $cont2++;
}


echo "<script>alert('Registros operados con exito !');location.href='valida2g.php?llave=1';</script>";


?>


