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
$var4=$_POST["var4"];
//$var5=$_POST["var5"];
$var6=$_POST["var6"];

$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
   $var12=$var2[$cont2];
   $var13=$var3[$cont2];
   $var14=$var4[$cont2];
   $var15=$var5[$cont2];
   $var16=$var6[$cont2];
   $var16=trim($var16);
//   echo " $var1<> and $var12 (<12) and $var13 (<13) $var14<> and $var15 <-and ($var16) (<16) <br>";


   if ($var1<>"" and $var12<>"" and $var13<>"" ) {

     if ($var16=='Ch' or  $var16=='No') {
       $sql1="update compra_orden set oc_usucheque='$usuario', oc_idtesoreria='$var12', oc_nrocheque='$var13', oc_fechache='$var14'  where oc_id=$var1 ";
//       echo $sql1."(1)<br>";
       mysql_query($sql1);
     }

     if ($var16=='Tr') {
       $sql1="update compra_orden set oc_usucheque='$usuario', oc_idtesoreria='$var12', oc_nrocheque='$var13', oc_fechache='$var14'  where oc_id=$var1 ";
//      echo $sql1."(2)<br>";
       mysql_query($sql1);


     }

//   exit();
      

   }
   


   $cont2++;
}
//exit();
echo "<script>location.href='compra_contab2.php?llave=1';</script>";


?>


