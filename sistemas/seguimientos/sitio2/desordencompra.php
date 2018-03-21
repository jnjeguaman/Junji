<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];





$cont=$_POST["cont"];
$numfac=$_GET["numfac"];
$id1b=$_GET["id1b"];
$var=$_GET["var"];
$ori2=$_GET["ori2"];
$rut=$_GET["rut"];
$cont2=1;



   if ($ori2=='f') {


      $sql2="update dpp_facturas set fac_doc1='', fac_nroorden='', fac_servicio='' where fac_eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);

      $sql2="update dpp_etapas set  eta_nroorden='', eta_item='' where eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);
      
      $sql2="update compra_orden set  oc_eta_id='' where oc_eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);
      
      $sql2="delete from compra_oceta where oceta_eta_id='$id1b' ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);



   }

//exit();
   if ( $ori2=='h') {


      $sql2="update dpp_honorarios  set hono_doc1  ='', hono_nroorden='' where hono_eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);

      $sql2="update dpp_etapas set  eta_nroorden='', eta_servicio_final='', eta_item='' where eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);

      $sql2="update compra_orden set  oc_eta_id='' where oc_eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);

      $sql2="delete from compra_oceta where oceta_eta_id='$id1b' ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);





   }

   $cont2++;


//exit();

if ($ori2=='f') {
  echo "<script>location.href='facturasarchivos.php?id=$numfac&llave=1&id1b=$id1b';</script>";
}
if ($ori2=='h') {
  echo "<script>location.href='honorarioarchivos.php?id=$numfac&llave=1&id1b=$id1b';</script>";
}


?>


