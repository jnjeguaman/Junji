<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];





$cont=$_POST["cont"];
$var=$_POST["var"];
$destinatario=$_POST["destinatario"];
$cont2=1;

$sw2=$_POST["sw2"];

$sql21="select max(eta_folioguia) as foliomio from dpp_etapas where eta_region='$regionsession' ";
//echo $sql21;
$result21=mysql_query($sql21);
$row21=mysql_fetch_array($result21);
$foliomio=$row21["foliomio"];
$foliomio=$foliomio+1;


  
while ($cont2<=$cont) {

   $var1=$var[$cont2];
   //echo $var1."----".$destinatario;

   if ($var1<>"" ) {



      $sql1="update dpp_etapas set eta_folioguia='$foliomio', eta_destinatario='$destinatario', eta_fechaguia='$fechamia' where eta_id=$var1 ";
   //   echo $sql1;
      mysql_query($sql1);
   }

   $cont2++;
}
//exit();

if ($sw2==1)
  echo "<script>location.href='facturas.php?llave=1';</script>";
if ($sw2==2)
  echo "<script>location.href='honorario.php?llave=1';</script>";


?>


