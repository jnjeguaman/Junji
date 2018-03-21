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

$fech1=$_POST["fech1"];
$fech2=$_POST["fech2"];
$fech3=$_POST["fech3"];
$fech4=$_POST["fech4"];


    $sql2="update dpp_boletasg set boleg_mail1='$mail1', boleg_mail2='$mail2', boleg_mail3='$mail3', boleg_mail4='$mail4', boleg_mail5='$mail5' where boleg_id=$id ";
//    echo "-------".$sql2."<br><br>";
//    exit();
      mysql_query($sql2);

echo "<script>alert('Registros operados con exito !');location.href='boletasgarchivos2.php?id=$id&llave=1';</script>";

exit();

$sql5="update dpp_boletasg set boleg_fecha1='$fech1',boleg_fecha2='$fech2',boleg_fecha3='$fech3',boleg_fecha4='$fech4' where boleg_id=$id ";
//echo $sql5;
//exit();
mysql_query($sql5);



   if ($envia1<>"" ) {



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
	$boleg_fecha_vence=$row2["boleg_fecha_vence"];
	$boleg_monto=$row2["boleg_monto"];
	$boleg_tipomoneda=$row2["boleg_tipomoneda"];
	$boleg_emisora=$row2["boleg_emisora"];
	$boleg_numero=$row2["boleg_numero"];



      //echo "---------------->>>".$boleg_doc1;
      
      $mail="c_herrera_m@hotmail.com";


      	$msg.="Informo a usted(es) que se encuentra pronta a vencer (fecha de vencimiento: '".$boleg_fecha_vence."') la '".$boleg_tipo2."'  N°'".$boleg_numero."' por un monto de '".$boleg_monto."'  '".$boleg_tipomoneda."' extendida por '".$boleg_emisora."', cuya copia se adjunta, la cual garantiza  la: ".$boleg_tipo."´, correspondiente a la licitación: ´".$boleg_glosa."´.<br>
Solicito a usted(es), informar vía memorando dirigido al Departamento de Administración y Finanzas, si corresponde DEVOLVER la garantía o en caso contrario informar que  ésta debe ser RENOVADA. 
Para la renovación debe contactarse con el proveedor y solicitar la renovación, determinando el plazo de la nueva garantía, junto con ello se debe informar en memorando la devolución de la garantía vencida y la renovación de la misma.
Es importante mencionar que, todo este proceso debe ser gestionado antes del vencimiento de la garantía.<br>";

	$msg.="Atentamente, <br>";
      	$msg.=$nombrecom." <br>";
      	$msg.="Encargado de Custodia de Garantías <br>";
      	$msg.=$nombrereg." <br>";
      	$msg.="<br>";
      

//    $mail->addAttachment(new fileAttachment('../../archivos/docgarantia/'.$boleg_doc1))
//    $mail->addAttachment(new fileAttachment('../../archivos/docgarantia/'.$boleg_doc2));;

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
$mail->Username   = "segfactura@dpp.cl"; // SMTP account username
$mail->Password   = "8d866gID";        // SMTP account password
*/

$mail             = new PHPMailer();

$body             = file_get_contents('mail/examples/contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "10.16.25.238"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only

$mail->SetFrom("seggarantia@dpp.cl", 'Boletas de Garantía DPP');
$mail->AddReplyTo("seggarantia@dpp.cl","First Last");
$mail->Subject    = "Aviso de Vencimiento Boleta de Garantía DPP, folio $boleg_folio(NO RESPONDER) $nombrereg ";
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);



//$mail->MsgHTML($body);


if ($envia1<>"") {
  $address = $mail1;
  $mail->AddAddress($address, "Defensoria");
}
if ($envia2<>"") {
  $address = $mail2;
  $mail->AddAddress($address, "Defensoria");
}
if ($envia3<>"") {
  $address = $mail3;
  $mail->AddAddress($address, "Defensoria");
}
if ($envia4<>"") {
  $address = $mail4;
  $mail->AddAddress($address, "Defensoria");
}
if ($envia5<>"") {
  $address = $mail5;
  $mail->AddAddress($address, "Defensoria");
}
$mail->AddBCC("seggarantia@dpp.cl");

$archivo1="../../archivos/docgarantia/$boleg_doc1";
//echo "------------->".$archivo1;
//$mail->AddAttachment($archivo1);      // attachment
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


echo "<script>location.href='boletasgarchivos2.php?id=$id&llave=1';</script>";


?>


