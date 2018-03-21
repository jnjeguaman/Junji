<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];





$cont=$_POST["cont"];
$numfac=$_POST["numfac"];
$id=$_POST["id"];
$var=$_POST["var"];
$ori2=$_POST["ori2"];
$rut=$_POST["rut"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;

   if ($var1<>"") {

//      $sql2="update compra_orden set oc_nrofactura='$numfac' where oc_id=$var1 ";
//    echo $sql2;
//      mysql_query($sql2);



      $sql2="update dpp_boletasg set boleg_cont_id='$id' where boleg_id=$var1 ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);


   }

   $cont2++;
}

//exit();
  echo "<script>location.href='contratosadjuntos.php?id=$id';</script>";



?>


