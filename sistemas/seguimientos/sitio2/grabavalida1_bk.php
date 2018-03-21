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
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$cont2=1;


while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;

   if ($var1<>"" and $uno==1) {
      if($_SESSION["pfl_user"] == 7 || $_SESSION["pfl_user"] == 38)
      {
         if($dos <> "")
         {
            $sql1="update dpp_etapas set eta_estado=2,  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia',eta_asignado = '$dos',eta_rechaza_motivo4 = '' where eta_id=$var1 ";
         }else{
            $sql1="update dpp_etapas set eta_estado=2,  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia',eta_asignado = '$usuario', eta_rechaza_motivo4 ='', eta_destinatario2 = '' where eta_id=$var1 ";
         }
         
      }
      // echo $sql1;
      mysql_query($sql1);
   }
   if ($var1<>"" and $uno==2) {
      $sql1="update dpp_etapas set eta_estado=11, eta_usu_recepcion2='$usuario',  eta_fecha_recepcion2='$fechamia', eta_rechaza_motivo='$justifica'  where eta_id=$var1 ";
//      echo $sql1;
      // mysql_query($sql1);


   }
   if ($var1<>"" and $uno==3) {
      $sql1="update dpp_etapas set eta_estado=12, eta_destinatario2 = '', eta_rechaza_motivo4='',  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia', eta_rechaza_motivo='$justifica' where eta_id=$var1 ";
//      echo $sql1;
       mysql_query($sql1);

      $sql2="insert into dpp_etapa_log (log_usr,log_fechasys,log_horasys,log_dpp_eta_id,log_origen,log_destino,log_motivo,log_estado,log_folio) values ('$usuario','$fechamia2','$horamia','$var1','$nivelmio','3','$justifica','Devuelto','".$_POST["folio"][$cont2]."')";
      mysql_query($sql2);
   }

   $cont2++;
}
if($uno == 1)
{
   if($_SESSION["pfl_user"] == 7)
   {
      echo "<script>location.href='valida2asignacion.php';</script>";
   }else{
      echo "<script>location.href='valida2.php';</script>";
   }
}else{
   echo "<script>location.href='valida1.php?llave=1';</script>";   
}









?>


