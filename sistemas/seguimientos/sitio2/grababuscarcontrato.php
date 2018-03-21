<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$fecha2=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];




$monto=$_POST["monto"];
$rut=$_POST["rut"];
$cont=$_POST["cont"];
$numfac=$_POST["numfac"];
$id1b=$_POST["id1b"];
$var=$_POST["var"];
$var2=$_POST["var2"];
$var3=$_POST["var3"];
$var4=$_POST["var4"];
$var5=$_POST["var5"];
$var6=$_POST["var6"];
$var7=$_POST["var7"];

$swori=$_POST["swori"];
$ori2=$_POST["ori2"];
$ncuota=$_POST["ncuota"];
$monto=$_POST["tcambio"];
$tpago=$_POST["tpago"];
$cont2=1;


while ($cont2<$cont) {

   $var1=$var[$cont2];
   $var22=$var2[$cont2];
   $var33=$var3[$cont2];
   $var44=$var4[$cont2];
   $var55=$var5[$cont2];
   $var66=$var6[$cont2];
   $var77=$var7[$cont2];


if ($var1<>"") {
//   echo $var1."----".$ori2;
      $sql1="insert into dpp_cont_fac (confa_fac_id,confa_cont_id,confa_fecha,confa_usuario, confa_tipodoc, confa_eta_id, confa_tipo,confa_numcuota )
                               values ('$numfac','$var1','$fechamia','$usuario','$ori2','$id1b','$var66','$var77') ";
//      echo $sql1;
//      exit();
      mysql_query($sql1);
      
      
      
      
      
//--------------- comienza el graba tipo de cambio a la moneda que corresponda  ------------------------

//--- UF
if ($var44<>'') {

  if ($ori2=='f') {
      $sql3=" update dpp_facturas set fac_valortipo='$var44',  fac_fechatipo='$fecha2', fac_montotipo=fac_monto/$var44  where fac_id=$numfac  ";
//    echo $sql3."<br>";
//    exit();
      mysql_query($sql3);
  }
  if ($ori2=='h') {
      $sql3=" update dpp_honorarios set hono_valortipo='$var4',  hono_fechatipo='$fecha2', hono_montotipo=hono_liquido/$var44  where hono_id=$numfac  ";
//    echo $sql3;
//    exit();
      mysql_query($sql3);
  }
}


//--- UTM
if ($var33<>'') {
  if ($ori2=='f') {
           $sql3=" update dpp_facturas set fac_valortipo2='$var33',  fac_fechatipo2='$fecha2', fac_montotipo2=fac_monto/$var33 where fac_id=$numfac  ";
//          echo $sql3."<br>";
//          exit();
           mysql_query($sql3);
       }
  if ($ori2=='h') {
          $sql3=" update dpp_honorarios set hono_valortipo2='$var33',  hono_fechatipo2='$fecha2', hono_montotipo2=hono_liquido/$var33 where hono_id=$numfac  ";
          //   echo $sql3;
          //   exit();
          mysql_query($sql3);
  }
}

//------- DOLAR
if ($var55<>'') {

  if ($ori2=='f') {
     $sql3=" update dpp_facturas set fac_valortipo3='$var55',  fac_fechatipo3='$fecha2', fac_montotipo3=fac_monto/$var55 where fac_id=$numfac  ";
//   echo $sql3."<br>";
//   exit();
     mysql_query($sql3);
  }
  if ($ori2=='h') {
     $sql3=" update dpp_honorarios set hono_valortipo3='$var55',  hono_fechatipo3='$fecha2', hono_montotipo3=hono_liquido/$var55 where hono_id=$numfac  ";
//     echo $sql3;
//   exit();
     mysql_query($sql3);
  }


}




      $sql2="Select max(conres_id), conres_numero, conres_archivo from dpp_contratores where conres_cont_id='$var1' and conres_id=max(conres_id)   ";
//      echo $sql2."<br>";
      $res2=mysql_query($sql2);
      $row2 = mysql_fetch_array($res2);
      $numresolucion=$row2["conres_numero"];
      $archivoresolucion=$row2["conres_archivo"];
//      echo $archivoresolucion."<br>";
      $arreglo = explode("/", $archivoresolucion);
      $totalele = count($arreglo);
      $ultimo = end($arreglo);
      $cantidad="../../".$arreglo[4]."/".$arreglo[5]."/".$arreglo[6]."/".$arreglo[7]."/".$arreglo[8];
//      echo "--->".$arreglo[3]."----".$ultimo."--".$cantidad;
//      exit();
//      mysql_query($sql2);

      $sql2="update dpp_facturas set fac_nroresolucion='$numresolucion', fac_doc2='$cantidad',fac_servicio='$var22' where fac_id=$numfac ";
//      $sql2="update dpp_facturas set fac_nroresolucion='$numresolucion', fac_doc2='$archivoresolucion',fac_servicio='$var22' where fac_id=$numfac ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);
      
      $sql2="update dpp_etapas set eta_nroresolucion='$numresolucion' where eta_id=$id1b ";
//      echo $sql2."<br>";
//      exit();
      mysql_query($sql2);




   }

   $cont2++;
}

$link="facturasarchivos.php?id=$numfac&llave=1&id1b=$id1b";

//------------------- Si es no tiene orden de compra  ---------------------

if ($swori==1) {

   //------------------------ Asociacion de Facturas con O/C ---------------

                                   $sw2=2;
                                   $sql21 = "Select * from compra_orden where oc_rut='$rut' and (oc_estado='ACEPTADO' or oc_estado='ENVIADA' ) and oc_region='$regionsession' ";
//                                   echo $sql21;
                                   $res21 = mysql_query($sql21);
                                   $row21 = mysql_fetch_array($res21);
                                   $ocid=$row21["oc_id"];

                                   $sql22 = "select * from compra_oceta where oceta_eta_id='$id1b'  ";
//                                   echo "<br>".$sql21."<br>";
                                   $res22 = mysql_query($sql22);
                                   $row22 = mysql_fetch_array($res22);
                                   $oceta_eta_id=$row22["oceta_eta_id"];


                                   $sw2=0;
                                   if ($ocid<>'')
                                        $sw2=1;
                                   if ($ocid=='')
                                        $sw2=3;
//                                   if ($row5["eta_nroorden"]<>'' and $oceta_eta_id<>'')
                                   if ($row5["eta_nroorden"]<>'' and $oceta_eta_id<>'')
                                        $sw2=2;

                                   if ($sw2==1 and ($row5["eta_nroorden"]=='' or $oceta_eta_id=='') ) {
// ------------ asociar orden de compra -------------------
// ------------ buscara el ultimo ?

/*

      $sql2="update compra_orden y, dpp_facturas x set x.fac_doc1=y.oc_archivo, x.fac_nroorden=y.oc_numero, x.fac_servicio=y.oc_nombre  where x.fac_eta_id=$id1b and oc_cont_id=$var1 ";
//      echo $sql2;
//      exit();
      mysql_query($sql2);
//list($tipo11, $tipo22, $tipo33) = split('[.]', $var22);
      $sql2="update compra_orden y, dpp_etapas x set  x.eta_nroorden=y.oc_numero, x.eta_item='$tipo11' where x.eta_id=$id1b and y.oc_id=$var1 ";
      echo $sql2;
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


      */

//------------------------------ Fin asociar orden de compra


//                                       $link="facturasarchivos.php?id=$numfac&llave=1&id1b=$id1b";
                                       $link="buscarordencompra.php?rut=$rut&numfac=$numfac&id1b=$id1b&ori2=f&monto=".$row5["fac_monto"];
                                  }

                                   if ($sw2==3 or $swori=='') {
                                       $link="facturasarchivos.php?id=$numfac&llave=1&id1b=$id1b";
                                   }

}



//------------------- FIN Si es no tiene orden de compra  ---------------------

//echo "----$sw2==3 or $swori==''--->".$link;
//exit();
if ($ori2=='f') {
  echo "<script>location.href='$link';</script>";
}
if ($ori2=='h' and 1==2) {
  echo "<script>location.href='honorarioarchivos.php?id=$numfac&llave=1&id1b=$id1b';</script>";
}


?>


