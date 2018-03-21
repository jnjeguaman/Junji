<?
session_start();
ini_set(sendmail_from,'admin@aestudiar.cl');
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$full_date = date("Y-m-d H:i:s");

$sql32 = "SELECT nombre FROM regiones WHERE codigo = ".$regionsession;
$res32 = mysql_query($sql32);
$row32 = mysql_fetch_array($res32);

$sql33 = "SELECT nombrecom FROM usuarios WHERE nombre = '".$usuario."'";
$res33 = mysql_query($sql33);
$row33 = mysql_fetch_array($res33);

$cont=$_POST["cont"];
$var=$_POST["var"];
$uno=$_POST["uno"];
$dos=$_POST["dos"];
$justifica=$_POST["justifica"];
$destinatario=$_POST["destinatario"];
$cont2=1;


//         $sql21="select max(eta_folioguia2) as foliomio from dpp_etapas where eta_region='$regionsession' ";
$sql21="select max(eta_folioguia2) as foliomio from dpp_etapas where eta_region='$regionsession' and year(eta_fecha_ing)='$annomia'";
//         echo $sql21;
//         exit();
$result21=mysql_query($sql21);
$row21=mysql_fetch_array($result21);
$foliomio=$row21["foliomio"];
$foliomio=$foliomio+1;

while ($cont2<=$cont) {

   $var1=$var[$cont2];
//   echo $var1."----".$uno;


   if ($var1<>"" and $uno==1) {
     $sql1="update dpp_etapas set eta_estado=5, eta_usu_jefatura='$usuario', eta_fecha_jefatura ='$fechamia', eta_folioguia2='$foliomio',eta_destinatario2='$destinatario', eta_fechaguia2='$full_date'  where eta_id=$var1 ";
         // echo $sql1;
     mysql_query($sql1);
 }

 if ($var1<>"" and $uno==2) {
     $sql1="update dpp_etapas set eta_estado=11, eta_usu_jefatura='$usuario', eta_fecha_jefatura ='$fechamia', eta_rechaza_motivo3='$justifica' where eta_id=$var1 ";
         // echo $sql1;
     mysql_query($sql1);
 }
//         exit();


 $cont2++;

}

$enviarEmail = 1;
if($enviarEmail)
{
    // BUSCAR SET GENERADOS
    $msg = 'Estimados, se ha enviado el siguiente set de pago : <br><br><table border="1" width="70%" cellpadding="3" cellspacing="0">';
    $msg.='<tr>';
    $msg.='<td style="text-align:center;" colspan="53">SET DE PAGOS</td>';
    $msg.='</tr>';

    $msg.='<tr>';
    $msg.='<td style="text-align:center;">FOLIO</td>';
    $msg.='<td style="text-align:center;">RUT</td>';
    $msg.='<td style="text-align:center;">PROVEEDOR</td>';
    $msg.='<td style="text-align:center;">N&deg; DOCUMENTO</td>';
    $msg.='<td style="text-align:center;">VALOR</td>';
    $msg.='</tr>';

    $sql31="select * from dpp_etapas where eta_region='$regionsession' and year(eta_fechaguia2)='$annomia' and eta_folioguia2=$foliomio order by eta_folio desc";
    $res31 = mysql_query($sql31);
    while($row31 = mysql_fetch_array($res31))
    {
        $msg.='<tr>';
        $msg.='<td style="text-align:center;">'.$row31["eta_folio"].'</td>';
        $msg.='<td style="text-align:center;">'.$row31["eta_rut"].'-'.$row31["eta_dig"].'</td>';
        $msg.='<td style="text-align:center;">'.$row31["eta_cli_nombre"].'</td>';
        $msg.='<td style="text-align:center;">'.$row31["eta_numero"].'</td>';
        $msg.='<td style="text-align:center;">$'.number_format($row31["eta_monto"],0,".",".").'</td>';
        $msg.='</tr>';
    }
    $msg.='<tr>';
    $msg.='<td colspan="2">ENVIADO POR : </td>';
    $msg.='<td colspan="3">'.$row33["nombrecom"].'</td>';
    $msg.='</tr>';

    $msg.='<tr>';
    $msg.='<td colspan="2">FECHA Y HORA ENV&Iacute;O : </td>';
    $msg.='<td colspan="3">'.$full_date.'</td>';
    $msg.='</tr>';
    $msg.='</table>';

    $msg.='<br><br>Atentamente, Seguimiento y Control<br>'.$row32["nombre"];


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

$mail->SetFrom("inedis_junji@junji.cl", 'SIGEJUN');
// $mail->AddReplyTo($mailparte,"First Last");
$mail->Subject    = utf8_decode("Envíos set de pagos");
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);
// $mail->AddAddress("fvaras@pradi.cl", "Freddy Varas");
// $mail->AddAddress("contabilidad_dirnac@junji.cl", "Contabilidad Direccion Nacional");

$sql4 = "SELECT * FROM usuarios WHERE (atributo1 = 5 OR atributo1 = 34) AND sistema = 1 AND estado = 'A' AND region = ".$regionsession;
$res4 = mysql_query($sql4);
while($row4 = mysql_fetch_array($res4))
{
  $mail->AddAddress($row4["correo"], utf8_decode($row4["nombrecom"]));
}


if(!$mail->Send()) {
  // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  // echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}    

}
echo "<script>location.href='valida4reg.php?llave=1';</script>";


?>


