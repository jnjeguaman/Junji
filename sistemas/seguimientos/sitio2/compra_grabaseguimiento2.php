<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];





$idchile=$_POST["idchile"];
$meseje=$_POST["meseje"];
$resultado=$_POST["resultado"];
$saldo=$_POST["saldo"];
$montoeje=$_POST["montoeje"];
$justificacion=$_POST["justificacion"];
$id=$_POST["id"];
$estado=$_POST["estado"];
$fecha1=$_POST["fecha1"];
$gestion=$_POST["gestion"];
$importante=$_POST["importante"];
$mesprograma=$_POST["mesprograma"];
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);


if ($estado<>'') {
    $mesprograma=trim($mesprograma);
   if ($mesprograma=='ENERO') {
      $mesprograma2=1;
   }
   if ($mesprograma=='FEBRERO') {
      $mesprograma2=2;
   }
   if ($mesprograma=="MARZO") {
      $mesprograma2=3;
   }
   if ($mesprograma=='ABRIL') {
      $mesprograma2=4;
   }
   if ($mesprograma=='MAYO') {
      $mesprograma2=5;
   }
   if ($mesprograma=='JUNIO') {
      $mesprograma2=6;
   }
   if ($mesprograma=='JULIO') {
      $mesprograma2=7;
   }
   if ($mesprograma=='AGOSTO') {
      $mesprograma2=8;
   }
   if ($mesprograma=='SEPTTIEMBRE') {
      $mesprograma2=9;
   }
   if ($mesprograma=='OCTUBRE') {
      $mesprograma2=10;
   }
   if ($mesprograma=='NOVIEMBRE') {
      $mesprograma2=11;
   }
   if ($mesprograma=='DICIEMBRE') {
      $mesprograma2=12;
   }

   if ($estado=='PENDIENTE') {
       $mesprograma="";
       $mesprograma2="";

   }

      $sql1="update compra_compra set compra_estado='$estado', compra_mescumple='$mesprograma', compra_mescumple2='$mesprograma2' where compra_id='$id' ";
//      echo $sql1;
//      exit();
      mysql_query($sql1);

}
if ($fecha1<>'' and $gestion<>'') {

      if ($importante=='') {
           $importante="NO";
      }

      $sql1="INSERT INTO compra_ordengestion (orges_compra_id, orges_fecha, orges_gestion, orges_user, orges_fechasis, orges_importante )
                                         VALUES ( '$id',         '$fecha1',      '$gestion',  '$usuario',    '$fechamia', '$importante');  ";
//      echo $sql1;
//      exit();
      mysql_query($sql1);
      
      if ($importante=='SI') {
         $sql1="update compra_compra set compra_gestion='1'  where compra_id='$id' ";
//       echo $sql1;
//       exit();
         mysql_query($sql1);
      }
}
//exit();
echo "<script>location.href='compra_seguimiento2.php?llave=1&id=$id&cajaid=$cajaid';</script>";


?>



