<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$fechamia2=date('d-m-Y');
date_default_timezone_set('America/Santiago');
$horamia=date('H:i:s');
$usuario=$_SESSION["nom_user"];
$nivelmio = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];



$cont=$_POST["cont"];
$var=$_POST["var"];
$var2=$_POST["var2"];
$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;

while ($cont2<=$cont) {

   $var1=$var[$cont2];
   $var22=$var2[$cont2];
//   echo $var1."----".$uno;

   if ($var1<>"" and $uno==1) {
   //   $sql1="update dpp_etapas set eta_estado=6,  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia' where eta_id=$var1 ";
      //$sql1="update dpp_etapas set eta_usu_recepcion22='$usuario', eta_fecha_recepcion3='$fechamia' where eta_id=$var1 ";
      //$sql1="update dpp_etapas set eta_usu_recepcion22='$usuario', eta_fechaguia3 = '".date("Y-m-d H:i:s")."' where eta_id=$var1 ";


      if ($regionsession == 14) {
         $sql1="update dpp_etapas set eta_usu_recepcion22='$usuario', eta_fechaguia3 = '".date("Y-m-d H:i:s")."' where eta_id=$var1 ";
      }
      else{
         $sql1="update dpp_etapas set eta_usu_recepcion22='$usuario', eta_asignado2='$usuario', eta_fechaguia3 = '".date("Y-m-d H:i:s")."' where eta_id=$var1 ";

      }
      mysql_query($sql1);
   }
   if ($var1<>"" and $uno==2) {
      $sql1="update dpp_etapas set eta_estado=2, eta_usu_recepcion22='',  eta_fecha_recepcion2='0000-00-00', eta_rechaza_motivo4='$justifica',eta_peritaje = 0, eta_asignado2=''  where eta_id=$var1 ";
      // echo $sql1;
      mysql_query($sql1);

   $sql2="insert into dpp_etapa_log (log_usr,log_fechasys,log_horasys,log_dpp_eta_id,log_origen,log_destino,log_motivo,log_estado,log_folio) values ('$usuario','$fechamia2','$horamia','$var1','$nivelmio','7','$justifica','Devuelto','".$_POST["folio"][$cont2]."')";
      mysql_query($sql2);
   }
   if ($var1<>"" and $uno==3 and $var22=='Honorario') {

      $sql1="update dpp_etapas set eta_estado=99, eta_numero=concat(eta_folio,eta_numero)  where eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);
      $sql1="update dpp_honorarios set hono_estado=99, hono_nro_boleta =concat(hono_folio,hono_nro_boleta)  where hono_eta_id=$var1 ";
//      echo $sql1;
       mysql_query($sql1);

//      $sql1="update dpp_etapas set eta_estado=14, eta_rechaza_motivo4='$justifica' where eta_id=$var1 ";
//      echo $sql1;
     mysql_query($sql1);
   }
   
   if ($var1<>"" and $uno==3 and $var22=='Factura') {

      $sql1="update dpp_etapas set eta_estado=99, eta_numero=concat(eta_folio,eta_numero)  where eta_id=$var1 ";
//     echo $sql1."<br>";
      mysql_query($sql1);

      $sql1="update dpp_facturas set fac_estado=99, fac_numero =concat(fac_folio,fac_numero)  where fac_eta_id=$var1 ";
//      echo $sql1."<br>";
      mysql_query($sql1);


//      $sql1="update dpp_etapas set eta_estado=14, eta_rechaza_motivo4='$justifica' where eta_id=$var1 ";
//      echo $sql1;
     mysql_query($sql1);
   }

   $cont2++;
}

echo "<script>location.href='valida5.php';</script>";


?>


