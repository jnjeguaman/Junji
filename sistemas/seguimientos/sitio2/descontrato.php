<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];





$cont=$_GET["cont"];
$numfac=$_GET["numfac"];
$id1b=$_GET["id1b"];
$var=$_GET["var"];
$ori2=$_GET["ori2"];
$cont2=1;


   $var1=$var[$cont2];
//   echo $var1."----".$uno;


      $sql1="delete from dpp_cont_fac where confa_eta_id='$id1b' and confa_tipodoc='f' ";
//      echo $sql1."<br>";
//      exit();
      mysql_query($sql1);

//      exit();
//      mysql_query($sql2);

      $sql2="update dpp_facturas set fac_nroresolucion='', fac_doc2='', fac_servicio='', fac_valortipo='', fac_fechatipo='',  fac_montotipo='', fac_valortipo2='', fac_fechatipo2='',  fac_montotipo2='', fac_valortipo3='', fac_fechatipo3='',  fac_montotipo3='' where fac_id=$numfac ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);
      
      $sql2="update dpp_etapas set eta_nroresolucion='' where eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);




   $cont2++;
   
//exit();

if ($ori2=='f') {
  echo "<script>location.href='facturasarchivos.php?id=$numfac&llave=1&id1b=$id1b';</script>";
}
if ($ori2=='h') {
  echo "<script>location.href='honorarioarchivos.php?id=$numfac&llave=1&id1b=$id1b';</script>";
}


?>


