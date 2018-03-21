<?
session_start();
ini_set('memory_limit', '64M');

require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$anno=date('Y');
$hora=date("h:i");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$regionnombre=$_SESSION["regionnom"];

  $sql2="select * from regiones where codigo=$regionsession ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $mailparte=$row2["mail"];



extract($_POST);

if (1==1) {




//------------- Comineza el mail  ----------------------

      	$msg=" <br>";
  	    $msg.="<br><br>";
  	    $msg.="<br><br>";
  	    $msg.="Atentamente, <br>";
      	$msg.="Encargado de Compra <br> $regionnombre <br>";
      	$msg.="<br>";
      	$msg.="<table border=1>";

$cont=$_POST["cont"];
$var=$_POST["var"];

$cont2=1;
$where="";
while ($cont2<=$cont) {
   $var1=$var[$cont2];
   if ($var1<>'') {
      $where.= " compra_id=".$var1." or ";
   }
   $cont2++;
}

    $where.=" 2=1 ";

//echo $where;


    
    $sql="select * from compra_compra where $where";
    echo $sql;
    $res3 = mysql_query($sql);
    while($row3 = mysql_fetch_array($res3)){
        	$msg.="<tr><td>".$row3["compra_nombre"]."</td><td>".$row3["compra_ccosto"]."</td><td>".number_format($row3["compra_total"],0,',','.')."</td><tr>";
    }

    echo "---->".$mailparte;
//  exit();

require_once('mail/class.phpmailer.php');

$mail             = new PHPMailer();

$body             = file_get_contents('mail/examples/contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "10.16.25.238"; // SMTP server
//$mail->Host       = "127.0.0.1"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only

$mail->SetFrom($mailparte, 'Plan de Compra');
$mail->AddReplyTo($mailparte,"First Last");
$materia2=substr($materia,0,50);
$mail->Subject    = "Plan de Compra ";
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);




//  $address = $mail1;
//  $address = "cferrada@dpp.cl";
//  $mail->AddAddress($address, "Defensoria");
//  $mail->AddBCC("cferrada@dpp.cl");

//  $address = $mailparte;
  $address = "cferrada@dpp.cl";
  $mail->AddAddress($address, "Defensoria");

//$mail->AddBCC("seggarantia@dpp.cl");





if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}





// ------------ termina el mail ----------------------





}
exit();
echo "<script>location.href='compra_avisos.php?sw=1&ti=$ti&llave=0';</script>";


?>


