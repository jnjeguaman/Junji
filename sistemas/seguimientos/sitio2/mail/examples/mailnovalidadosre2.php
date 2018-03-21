<?
session_start();
 $aux_empresa=$_POST["empresa"];
 $aux_nombre=$_POST["nombre"];
 $aux_apellido=$_POST["apellido"];
 $aux_fono=$_POST["fono"];
 $aux_fax=$_POST["fax"];
 $aux_mail=$_POST["mail"];
 $aux_domicilio=$_POST["domicilio"];
 $aux_comuna=$_POST["comuna"];
 $aux_obs=$_POST["obs"];
 
  $arreglo1=$_SESSION["arreglo1"];
 $arreglo2=$_SESSION["arreglo2"];
 $arreglo3=$_SESSION["arreglo3"];
 $arreglo4=$_SESSION["arreglo4"];
 $contador=$_SESSION["contador"];

 $msg='<table>
       <tr> <td>Empresa     :</td><td>'.$aux_empresa.'</td><tr>
       <tr> <td>Nombres     :</td><td>'.$aux_nombre.'</td><tr>
       <tr> <td>Apellidos   :</td><td>'.$aux_apellido.'</td><tr>
       <tr> <td>Fono        :</td><td>'.$aux_fono.'</td><tr>
       <tr> <td>Fax         :</td><td>'.$aux_fax.'</td><tr>
       <tr> <td>E-mail      :</td><td>'.$aux_mail.'</td><tr>
       <tr> <td>Domicilio   :</td><td>'.$aux_domicilio.'</td><tr>
       <tr> <td>Comuna    :</td><td>'.$aux_comuna.'</td><tr>
       <tr> <td>Observación :</td><td>'.$aux_obs.'</td><tr>
       </table>
 <table width="100%" border="1" cellspacing="2">
      <tr>

        <td colspan="4" bgcolor="#CCCCCC" class="bordetb_azul"><div class="arial12b">Detalle de Carro de Cotizaciones </div></td>

      </tr>
      <tr>
       <td >Item</td>
       <td >Descripción</td>
       <td>Código<b/td>
       <td>Cantidad</td>
       </tr>';
        $cont2=1;
         while ($cont2<=$contador) {

   $msg.='
      <tr>
        <td width="10%" align="left" valign="top" class="bordetb_azul11">'.$cont2.'</td>
        <td width="36%" align="left" valign="top" class="bordetb_azul11">'. $arreglo2[$cont2] .'</td>
        <td  width="10%" align="center" valign="top" class="bordetb_azul11">'. $arreglo1[$cont2] .'</td>
        <td  width="10%" align="center" valign="top" class="bordetb_azul11">'. $arreglo4[$cont2] .'</td>
      </tr>';

        $cont2++;
       }
   $msg.='
    </table> <h4> Gracias por contactarse con nosostros.</h4>';

?>
<html>
<head>
<title>PHPMailer - SMTP (Gmail) basic test</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('America/Toronto');







require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$msg);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "admin@aestudiar.cl";  // GMAIL username
$mail->Password   = "passpass";            // GMAIL password

$mail->SetFrom('c_herrera_m@hotmail.com', 'Systelec');



$mail->Subject    = "Detalle de Carro de Cotizaciones";

$mail->AltBody    = "Mensaje"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "c_herrera_m@hotmail.com";
$mail->AddAddress($address, "Systelec");
$address = $aux_mail;
$mail->AddAddress($address, "Systelec");

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

 

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}
?>

</body>
</html>
