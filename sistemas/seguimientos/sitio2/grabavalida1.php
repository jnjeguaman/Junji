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
$mensaje = NULL;
$devueltos = NULL;
$contador = 0;


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

      $contador++;

      $sql4 = "SELECT * FROM dpp_etapas WHERE eta_id = ".$var1;
      $res4 = mysql_query($sql4,$dbh);
      $row4 = mysql_fetch_array($res4);

      $devueltos.="
      <tr>
      <td style='font-size:0.8em;text-align:center;'>".$row4["eta_folio"]."</td>
      <td style='font-size:0.8em;text-align:center;'>".number_format($row4["eta_rut"],0,".",".")."-".$row4["eta_dig"]."</td>
      <td style='font-size:0.8em;text-align:center;'>".$row4["eta_cli_nombre"]."</td>
      <td style='font-size:0.8em;text-align:center;'>".utf8_encode($justifica)."</td>
      </tr>
      ";


      $sql1="update dpp_etapas set eta_estado=12, eta_destinatario2 = '', eta_rechaza_motivo4='',  eta_usu_recepcion2='$usuario', eta_fecha_recepcion2='$fechamia', eta_rechaza_motivo='$justifica' where eta_id=$var1 ";
//      echo $sql1;
       mysql_query($sql1);

      $sql2="insert into dpp_etapa_log (log_usr,log_fechasys,log_horasys,log_dpp_eta_id,log_origen,log_destino,log_motivo,log_estado,log_folio) values ('$usuario','$fechamia2','$horamia','$var1','$nivelmio','3','$justifica','Devuelto','".$_POST["folio"][$cont2]."')";
      mysql_query($sql2);
   }

   $cont2++;
}

$mensaje.="Estimado/a, informo a usted que se ha devuelto documentación a su unidad : <br>";
   $mensaje.="<br><br>
   <table border='1' width='100%' style='border-collapse:collapse'>

   <tr>
   <th colspan='4' style='text-align:center;'>LISTADO DE DOCUMENTOS DEVUELTOS</th>
   </tr>
   <tr>
   <th style='font-size:0.9em;'>N° FOLIO</th>
   <th style='font-size:0.9em;'>RUT PROVEEDOR</th>
   <th style='font-size:0.9em;'>PROVEEDOR</th>
   <th style='font-size:0.9em;'>RAZÓN / MOTIVO</th>
   </tr>";

   $mensaje.=$devueltos;
   $mensaje.="</table>";
   $mensaje = utf8_decode($mensaje);
$enviarEmail = 1;

if($uno==3 && $contador > 0)
{
require_once('mail/class.phpmailer.php');

$mail = new PHPMailer();
$body = file_get_contents('mail/examples/contents.html');
$body = eregi_replace("[\]",'',$body);

$mail->isSMTP();
$mail->Host = '192.168.100.34';
// $mail->SMTPAuth = true;
$mail->Username = 'inedis_junji@junji.cl';      // SMTP username
$mail->Password = '';                           // SMTP password
// $mail->SMTPSecure = 'tls';
$mail->Port = 25;
$mail->SMTPDebug  = 1;

$mail->SetFrom("inedis_junji@junji.cl", 'Seguimiento y Control');
// $mail->AddReplyTo($mailparte,"First Last");
$materia2=substr($materia,0,50);
$mail->Subject    = utf8_decode("Devolución documentos (NO RESPONDER)");
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($mensaje);

$sql4 = "SELECT * FROM usuarios WHERE (atributo1 = 3 || atributo1 = 5 || atributo1 = 34) AND sistema = 1 AND estado = 'A' AND region = ".$_SESSION["region"];
$res4 = mysql_query($sql4,$dbh);
while($row4 = mysql_fetch_array($res4))
{
  $mail->AddAddress($row4["correo"], utf8_decode($row4["nombrecom"]));
}
if($enviarEmail)
{
   $mail->Send();
}

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


