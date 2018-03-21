<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$anno=date('Y');
$hora=date("h:i");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$regionnombre=$_SESSION["regionnom"];


extract($_POST);
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
$fecha4= substr($fecha4,6,4)."-".substr($fecha4,3,2)."-".substr($fecha4,0,2);
  $sql2="select * from regiones where codigo=$regionsession ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $mailparte=$row2["mail"];



$archivo1 = $_FILES["archivo1"]['name'];

if (1==1) {

  $campo="fol_reg".$regionsession."_4";
  $sql2="select $campo as folio from argedo_folios where fol_id=1 ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $folio=$row2["folio"];
  
//  echo $folio;
  $folio=$folio+1;



  $sql1="INSERT INTO argedo_recibida (reci_defensoria, reci_folio, reci_tipodoc, reci_numero, reci_fecha_doc, reci_fecha_recep, reci_hora,   reci_materia, reci_remite, reci_obs, reci_destinatario, reci_jornada, reci_anno, reci_fechasys, reci_user,reci_int)
                              values ('$regionsession', '$folio', '$tipodoc1',  '$numeroext',  '$fecha2',    '$fecha1',    '$hora' ,         '$materia', '$remite',  '$obs',    '$destinatario', '$jornada',    '$anno',     '$fechamia', '$usuario','$numeroint' )";
//  echo $sql1."<br>";
//  exit();
  mysql_query($sql1);
  

  $prefijo="recibida";
  $subfijo="recibida";


  $sql2="select max(reci_id) as maximo from argedo_recibida where reci_user='$usuario' ";
//  echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
  
  if ($tipodoc1=="LICENCIA MÉDICA") {
    list($t1, $t2) = split('[/]', $tipolicencia);
    list($c1, $c2) = split('[/]', $carareposo);
    $sql22="  INSERT INTO argedo_licencia (lice_reci_id, lice_tipo, lice_numfolio1, lice_numfolio2, lice_rut, lice_dig, lice_funcionario, lice_fecha, lice_dias, lice_tipo2, lice_tipo2num ,lice_caracter, lice_caracternum, lice_region, lice_fechaparte,lice_ini_reposo)
                                   VALUES ($maximo, '$tipodoc1', '$numfolio1',      '$numfolio2',   '$rut',   '$dig',   '$nombre1',       '$fecha3',     '$dias', '$t2', '$t1',    '$c2', '$c1', '$regionsession','$fecha1','$fecha4'); ";
//    echo $sql22;
//    exit();
    mysql_query($sql22);
  }
  
  $anno=$anno;
  $anno2012=$anno;

  if ($archivo1 != "") {

      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession.".PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/".$archivo1;
      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo1."</b>";
           $archivo1="fileargedo".$anno."/".$subfijo."/".$archivo1;
          $sql2="update argedo_recibida set reci_archivo ='$archivo1' where reci_id=$maximo ";
//          echo $sql2;
          mysql_query($sql2);
      }

   }

//        exit();
  

  $sql2="update argedo_folios set $campo='$folio' where fol_id=1 ";
//  echo $sql2."<br>";

  $result2=mysql_query($sql2);
//  exit();

}

  if ($tipodoc1=="LICENCIA MÉDICA") {
    $prefijo2="LICENCIA MÉDICA";
//------------- Comineza el mail  ----------------------

      	$msg="En Archivo adjunto, se encuentra documento oficializado en Oficina de Partes de su Defensoría, <br>";
  	    $msg.="<br><br>";
  	    $msg.="Folio : $folio <br>";
  	    $msg.="Tipo Documento : $prefijo2 <br>";
  	    $msg.="Materia : $materia <br>";
  	    $msg.="<br><br>";
  	    $msg.="Atentamente, <br>";
      	$msg.="Encargado de Oficina de Partes <br> $regionnombre <br>";
      	$msg.="<br>";

$nombrereg2=$regionnombre;
if ($nombrereg2<>'Defensoria Nacional') {
    $arreglo = explode("Defensoria Regional", $nombrereg2);

} else {
    $arreglo[1]=$nombrereg2;
}


require_once('mail/class.phpmailer.php');


$mail             = new PHPMailer();

$body             = file_get_contents('mail/examples/contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "10.16.25.238"; // SMTP server
//$mail->Host       = "localhost"; // SMTP server
//$mail->Host       = "COLOSSUS"; // SMTP server
//$mail->Host       = "127.0.0.1"; // SMTP server


$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only

$mail->SetFrom($mailparte, 'Oficina de partes');
$mail->AddReplyTo($mailparte,"First Last");
$materia2=substr($materia,0,50);
//$mail->Subject    = "$arreglo[1] $prefijo2 $folio $materia2 ";
$mail->Subject    = "$arreglo[1]  $materia2 ";
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);



//$mail->MsgHTML($body);


//  $address = $mail1;
//  $address = "cferrada@dpp.cl";
//  $mail->AddAddress($address, "Defensoria");
//  $mail->AddBCC("cferrada@dpp.cl");

  $address = $mailparte;
  $mail->AddAddress($address, "Defensoria");

//$mail->AddBCC("seggarantia@dpp.cl");

if ($archivo1<>'') {
  $archivo1="../../archivos/docargedo/".$archivo1;
  $mail->AddAttachment($archivo1); // attachment
}
if ($archivo2<>'') {
  $archivo2="../../archivos/docargedo/".$archivo2;
  $mail->AddAttachment($archivo2); // attachment
}
if ($archivo3<>'') {
  $archivo3="../../archivos/docargedo/".$archivo3;
  $mail->AddAttachment($archivo3); // attachment
}
if ($archivo4<>'') {
  $archivo4="../../archivos/docargedo/".$archivo4;
  $mail->AddAttachment($archivo4); // attachment
}




if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  // echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}





// ------------ termina el mail ----------------------


}

//exit();
echo "<script>location.href='argedo_recibida.php?sw=1';</script>";


?>


