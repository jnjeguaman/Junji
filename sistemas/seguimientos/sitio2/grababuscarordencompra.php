<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];



$cont=$_POST["cont"];
$numfac=$_POST["numfac"];
$id1b=$_POST["id1b"];
$var=$_POST["var"];
$var2=$_POST["var2"];
$ori2=$_POST["ori2"];
$rut=$_POST["rut"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
   $var22=$var2[$cont2];
   list($tipo11, $tipo22, $tipo33) = split('[.]', $var22);
//   echo $var1."----".$var22."---".$tipo11;

   if ($var1<>"" and $ori2=='f') {


      $sql2="update compra_orden y, dpp_facturas x set x.fac_doc1=y.oc_archivo, x.fac_nroorden=y.oc_numero, x.fac_servicio=y.oc_nombre  where x.fac_eta_id=$id1b and y.oc_id=$var1 ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);

      $sql2="update compra_orden y, dpp_etapas x set  x.eta_nroorden=y.oc_numero, x.eta_item='$tipo11' where x.eta_id=$id1b and y.oc_id=$var1 ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);
      
      $sql2="update compra_orden set  oc_eta_id='$id1b' where oc_id=$var1 ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);
      
      
      $sql2="insert into compra_oceta (oceta_oc_id, oceta_eta_id, oceta_region, oceta_user, oceta_fecha)
                               values ('$var1',    '$id1b', '$regionsession','$usuario', '$fechamia') ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);



   }
   
   if ($var1<>"" and $ori2=='h') {

      $sql2="update compra_orden y, dpp_honorarios x set x.hono_doc1=y.oc_archivo, x.hono_nroorden=y.oc_numero where x.hono_eta_id=$id1b and y.oc_id=$var1 ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);

      $sql2="update compra_orden y, dpp_etapas x set  x.eta_nroorden=y.oc_numero, x.eta_servicio_final=y.oc_nombre, x.eta_item='$tipo11' where x.eta_id=$id1b and y.oc_id=$var1 ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);

      $sql2="update compra_orden set  oc_eta_id='$id1b' where oc_id=$var1 ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);

      $sql2="insert into compra_oceta (oceta_oc_id, oceta_eta_id, oceta_region, oceta_user, oceta_fecha)
                               values ('$var1',    '$id1b', '$regionsession','$usuario', '$fechamia') ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);


   }

   $cont2++;
}

//exit();

if ($ori2=='f') {
  echo "<script>location.href='facturasarchivos.php?id=$numfac&llave=1&id1b=$id1b';</script>";
}
if ($ori2=='h') {
  echo "<script>location.href='honorarioarchivos.php?id=$numfac&llave=1&id1b=$id1b';</script>";
}


?>


