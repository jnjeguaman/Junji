<?
session_start();

require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$nombrecom=$_SESSION["nom_com"];
$nombrereg=$_SESSION["regionnom"];



$id=$_POST["id"];
$envia1=$_POST["envia1"];
$envia2=$_POST["envia2"];
$envia3=$_POST["envia3"];
$envia4=$_POST["envia4"];
$envia5=$_POST["envia5"];
$mail1=$_POST["mail1"];
$mail2=$_POST["mail2"];
$mail3=$_POST["mail3"];
$mail4=$_POST["mail4"];
$mail5=$_POST["mail5"];



   if ($envia1<>"" or 1==1) {



      $sql2="select * from dpp_boletasg where boleg_id=$id";
      //echo "--".$sql2;
      $result2=mysql_query($sql2);
      $row2=mysql_fetch_array($result2);
      $boleg_tipo=$row2["boleg_tipo"];
      $boleg_tipo2=$row2["boleg_tipo2"];
      $boleg_folio=$row2["boleg_folio"];
      $boleg_glosa=$row2["boleg_glosa"];
      $boleg_doc1=$row2["boleg_archivo"];
      $boleg_doc2=$row2["boleg_archivo2"];
      //echo "---------------->>>".$boleg_doc1;
      
      // $mail="c_herrera_m@hotmail.com";


      $msg ="Adjunto a este correo, se envía una copia digitalizada de : ".$boleg_tipo2." y una copia de la ficha de ingreso correspondiente a: ".$boleg_tipo.", de la licitación: ".$boleg_glosa."<br>";
      $msg.="Atentamente, <br>";
	  $msg.="<br>";
      $msg.=$nombrecom." <br>";
      $msg.="Encargado de Custodia de Garantías <br>";
      $msg.=$nombrereg." <br>";
      $msg.="<br>";
  

//    $mail->addAttachment(new fileAttachment('../../archivos/docgarantia/'.$boleg_doc1));
//    $mail->addAttachment(new fileAttachment('../../archivos/docgarantia/'.$boleg_doc2));
 ;

require_once('mail/class.phpmailer.php');

//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

/*
$mail             = new PHPMailer();
$body             = file_get_contents('mail/examples/contents.html');
$body             = eregi_replace("[\]",'',$msg);
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "10.16.25.238"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "10.16.25.238"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "inedis_junji@junji.cl"; // SMTP account username
$mail->Password   = "";        // SMTP account password
*/

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

$mail->SetFrom("inedis_junji@junji.cl", 'Boletas de Garantía JUNJI');
$mail->Subject    = "Custodia Boletas de Garantía DPP, FOLIO $boleg_folio (NO RESPONDER)";
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);



//$mail->MsgHTML($body);


if ($envia1<>"") {
  $address = $mail1;
  $mail->AddAddress($address, "Oficina de Partes");
}
if ($envia2<>"") {
$address = $mail2;
$mail->AddAddress($address, "Oficina de Partes");
}
if ($envia3<>"") {
$address = $mail3;
$mail->AddAddress($address, "Oficina de Partes");
}
if ($envia4<>"") {
$address = $mail4;
$mail->AddAddress($address, "Oficina de Partes");
}
if ($envia5<>"") {
  $address = $mail5;
  $mail->AddAddress($address, "Oficina de Partes");
}

// $mail->AddBCC("seggarantia@dpp.cl");

$archivo1="../../archivos/docgarantia/$boleg_doc1";
//echo "------------->".$archivo1;
$mail->AddAttachment($archivo1);      // attachment
$mail->AddAttachment("../../archivos/docgarantia/".$boleg_doc2); // attachment

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment




if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}




// exit();


    

   $cont2++;
}


echo "<script>location.href='boletasgarchivos.php?id=$id&llave=1';</script>";


?>


