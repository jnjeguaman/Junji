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
$cont2=1;

/*
   1 : envio a tesoreria
   2 : envio a seguimiento y control
*/

while ($cont2<=$cont) {

   $var1=$var[$cont2];
  // echo $var1."----".$uno;
   if($var1 <> "" AND $uno == 1)
   {
      $sql1 = "update dpp_etapas set eta_fechaguia3 = '".date("Y-m-d H:i:s")."', eta_rechaza_motivo3 = '',eta_estado = 5 where eta_id = ".$var1;
      mysql_query($sql1);

      $sql2="update dpp_etapa_log set log_origen='$nivelmio', log_destino='31', log_estado='Reenviado', log_usrenvio='$usuario', log_fechaenvio='$fechamia2', log_horaenvio='$horamia'  where log_dpp_eta_id='$var1' and log_usrenvio is null ";

      mysql_query($sql2);
   }

   if($var1 <> "" AND $uno ==2)
   {
      $sql1="update dpp_etapas set eta_estado=2, eta_fechaguia2='0000-00-00 00:00:00',  eta_fecha_recepcion2='$fechamia', eta_rechaza_motivo4='$justifica'  where eta_id=$var1 ";
      mysql_query($sql1);

      $sql2="insert into dpp_etapa_log (log_usr,log_fechasys,log_horasys,log_dpp_eta_id,log_origen,log_destino,log_motivo,log_estado) values ('$usuario','$fechamia2','$horamia','$var1','$nivelmio','7','$justifica','Devuelto')";
      mysql_query($sql2);
   }
   
   $cont2++;
}
// exit;
echo "<script>location.href='verdevueltos3.php?llave=1';</script>";


?>


