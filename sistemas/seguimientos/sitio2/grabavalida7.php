<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];





$cont=$_POST["cont"];
$var=$_POST["var"];
$var2=$_POST["var2"];
$var3=$_POST["var3"];
$var5=$_POST["var5"];
$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
   $var12=$var2[$cont2];
   $var13=$var3[$cont2];
   $var15=$var5[$cont2];

//   echo $var1."----".$uno;

   if ($var1<>"" and $var15<>"" and $var12<>"" ) {
      $sql1="update dpp_etapas set eta_estado=8,  eta_usu_pagado='$usuario', eta_fecha_pagado='$fechamia', eta_retira='$var12', eta_fecha_retira='$var13', eta_forma='$var15'  where eta_id=$var1 ";
 //     echo $sql1;
 //     exit();
      mysql_query($sql1);
   }
   if ($var1<>"" and $uno==22) {
      $sql1="update dpp_etapas set eta_estado=11, eta_usu_cheque='$usuario',  eta_fecha_cheque='$fechamia'  where eta_id=$var1 ";
      echo $sql1;
      mysql_query($sql1);
   }

   $cont2++;
}

echo "<script>location.href='valida7.php?llave=1';</script>";


?>


