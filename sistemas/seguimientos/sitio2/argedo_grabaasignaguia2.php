<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];





$cont=$_POST["cont2"];
$var=$_POST["var"];
$destinatario=$_POST["destinatario2"];
$cont2=1;

$sw2=$_POST["sw2"];

$sql21="select max(despa_folioguia) as foliomio from argedo_despachada where despa_defensoria='$regionsession' ";
//echo $sql21;
$result21=mysql_query($sql21);
$row21=mysql_fetch_array($result21);
$foliomio=$row21["foliomio"];
$foliomio=$foliomio+1;


  
while ($cont2<=$cont) {

   $var1=$var[$cont2];
   //echo $var1."----".$destinatario;

   if ($var1<>"" ) {



      $sql1="update argedo_despachada set despa_folioguia='$foliomio', despa_destinatario2='$destinatario', despa_fechaguia='$fechamia' where despa_id=$var1 ";
//      echo $sql1."<br>";
      mysql_query($sql1);
   }

   $cont2++;
}
//exit();

  echo "<script>location.href='argedo_despachada.php?llave=1';</script>";


?>


