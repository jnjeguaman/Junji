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





$cont=$_POST["cont"];
$var=$_POST["var"];
$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$observacion=$_POST["observacion"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;

   if ($var1<>"" and $uno==1) {
      $sql1="update dpp_etapas set eta_estado=5, eta_usu_recepcion22='', eta_fechaguia2='$fechamia', eta_rechaza_motivo4='' where eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);


      $sql2="update dpp_etapa_log set log_origen='$nivelmio', log_destino='5', log_estado='Reenviado', log_usrenvio='$usuario', log_fechaenvio='$fechamia2', log_horaenvio='$horamia', log_observacion='$observacion'  where log_dpp_eta_id='$var1' and log_usrenvio is null ";

      mysql_query($sql2);

   }
   if ($var1<>"" and $uno==2) {
      $sql1="update dpp_etapas set eta_estado=99, eta_usu_recepcion22='$usuario',  eta_fecha_recepcion2='$fechamia', eta_numero=concat(eta_folio,eta_numero)  where eta_id=$var1 ";
//      $sql1="update dpp_etapas set eta_estado=99, eta_usu_recepcion2='$usuario',  eta_fecha_recepcion2='$fechamia', eta_numero=concat('9999',eta_numero)  where eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);

      $sql1="update dpp_honorarios set hono_estado=99, hono_nro_boleta =concat(hono_folio,hono_nro_boleta)  where hono_eta_id=$var1 ";
//      $sql1="update dpp_honorarios set hono_estado=99, hono_nro_boleta =concat('9999',hono_nro_boleta)  where hono_eta_id=$var1 ";
      
//      echo $sql1;
      mysql_query($sql1);
      
      $sql1="update dpp_facturas set fac_estado=99, fac_numero =concat(fac_folio,fac_numero)  where fac_eta_id=$var1 ";
//      $sql1="update dpp_facturas set fac_estado=99, fac_numero =concat('9999',fac_numero)  where fac_eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);

   }
   if ($var1<>"" and $uno==3) {
      $sql1="update dpp_etapas set eta_estado=99, eta_usu_recepcion22='$usuario',  eta_fecha_recepcion2='$fechamia', eta_rechaza_motivo='$justifica'  where eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);
   }
   if ($var1<>"" and $uno==3) {
      $sql1="update dpp_etapas set eta_estado=12,  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia', eta_rechaza_motivo='$justifica' where eta_id=$var1 ";
//      echo $sql1;
      mysql_query($sql1);

      $sql2="insert into dpp_etapa_log (log_usr,log_fechasys,log_horasys,log_dpp_eta_id,log_origen,log_destino,log_motivo,log_estado) values ('$usuario','$fechamia2','$horamia','$var1','$nivelmio','3','$justifica','Devuelto')";
      mysql_query($sql2);
      mysql_query("update dpp_etapas set eta_rechaza_motivo3 = '',eta_folioguia2='',eta_destinatario2='',eta_fechaguia2='',eta_usu_recepcion22='',eta_destinatario3='',eta_fechaguia3='',eta_folioguia3='' where eta_id = $var1");

   }
   
   $cont2++;
}

//exit();
echo "<script>location.href='verdevueltos2.php?llave=1';</script>";


?>

