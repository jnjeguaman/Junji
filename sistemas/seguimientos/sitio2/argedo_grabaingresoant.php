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


  $sql2="select * from regiones where codigo=$regionsession ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $mailparte=$row2["mail"];



extract($_POST);


//echo "Stop";
//exit();
if ($tipodoc=='RESOLUCION AFECTA') {
    $ti=2;
}
if ($tipodoc=='RESOLUCION EXENTA') {
    $ti=1;
}
if ($tipodoc=='OFICIO DN' or $tipodoc=='OFICIO DAN' or $tipodoc=='OFICIO DEPTO' or $tipodoc=='OFICIO DAR' or $tipodoc=='OFICIO DR' ) {
    $ti=3;
}



foreach ($_REQUEST AS $indice => $valor){
  if(!is_numeric($valor)) {
     ${$indice}=strtoupper($valor);
  }
}


$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);


$archivo1 = $_FILES["archivo1"]["name"];
$archivo2 = $_FILES["archivo2"]["name"];
$archivo3 = $_FILES["archivo3"]["name"];
$archivo4 = $_FILES["archivo4"]["name"];


//echo "-->".$ti;
//exit();





  if ($ti==1) {
   $prefijo3="RE";
   $subfijo3="resexc";
   $prefijo="RESOLUCIÓN EXENTA";
  }
  if ($ti==2) {
   $prefijo3="RA";
   $subfijo3="resafec";
   $prefijo="RESOLUCIÓN AFECTA";
  }
  if ($ti==3) {
   $prefijo3="O";
   $subfijo3="oficio";
   $prefijo="OFICIO";
  }




if ($ti==1 and ($op1=='PERMISO ADMINISTRATIVO'  or $op1=='FERIADO LEGAL')) {
   $materia="AUTORIZA ".$op1." ".$nombre1." DESDE EL ".$fechaini1." HASTA EL ".$fechater1;
}
if ($ti==1 and $op1=='COMETIDO FUNCIONARIO') {
   $materia="AUTORIZA ".$op1." ".$nombre2." ".$destino2." DESDE EL ".$fechaini2." HASTA EL ".$fechater2;
}

//echo $materia;
$prefijo2=$prefijo;
//exit();


if (1==1 and $ti<>'') {

  $campo="fol_reg".$regionsession."_".$ti;
  $sql2="select $campo as folio from argedo_folios where fol_id=1 ";
//  echo $sql2."<br>";
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $folio=$row2["folio"];
  
//  echo $folio;
  $folio=$numero;


$anno2012=$anno;
$anno2=$anno;
  if ($anno==2011) {
      $anno2.="A";
  }




  $destino1='';
  $destino2='';
  $destino3='';
  $destino4='';
  if ($archivo1 != "") {
    $archivo1b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession."_1.PDF";
    $destino1 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo1b;
  }
  if ($archivo2 != "") {
    $archivo2b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession."_2.PDF";
    $destino2 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo2b;
  }
  if ($archivo3 != "") {
    $archivo3b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession."_3.PDF";
    $destino3 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo3b;
  }
  if ($archivo4 != "") {
    $archivo4b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession."_4.PDF";
    $destino4 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo4b;
  }


 $dia1 = strtotime($fechamia);
// $fechabase =$fechabase;
 $dia2 = strtotime($fecha2);
 $diff=$dia2-$dia1;
// echo "$fechahoy -- $fechabase $diff <br>";
 $diff2=(intval($diff/(60*60*24)))*-1;

  $materia=strtoupper($materia);
  $obs=strtoupper($obs);
  $destinatario=strtoupper($destinatario);

  $sql1="INSERT INTO argedo_documentos (docs_defensoria, docs_fechaparte, docs_horaparte, docs_folio, docs_area, docs_subarea, docs_tramite, docs_fecha, docs_materia, docs_obs, docs_anno, docs_fechasis, docs_user, docs_tipodoc, docs_tipo, docs_documento,docs_destinatario,docs_diferencia, docs_archivo)
                                values ('$regionsession', '$fecha2',    '$hora' ,'$numero','$paises', '$contrato',                 '$tramite', '$fecha2', '$materia',     '$obs', '$anno','$fechamia',  '$usuario', '$tipodoc', '$ti',  '$prefijo', '$destinatario','0','$destino1' )";
 // echo $sql1;
 // exit();
  mysql_query($sql1);
  
  if ($ti==1) {
   $prefijo="RE";
   $subfijo="resexc";
  }
  if ($ti==2) {
   $prefijo="RA";
   $subfijo="resafec";
  }
  if ($ti==3) {
   $prefijo="O";
   $subfijo="oficio";
  }

  $sql2="select max(docs_id) as maximo from argedo_documentos where docs_user='$usuario' ";
//  echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];

  
$anno2=$anno;
//      echo "<br>--------------->".$archivo1;
  if ($archivo1 != "" ) {

      $archivo1b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession."_".$maximo."_1.PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno2."/".$subfijo."/".$archivo1b;
      
      $destino2="fileargedo".$anno2."/".$subfijo3."/".$archivo1b;
//      echo "<br>--------------->".$destino;
      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo1."</b>";
          $archivo1="fileargedo".$anno2."/".$subfijo."/".$archivo1;
          $sql2="update argedo_documentos set docs_archivo ='$destino2' where docs_id=$maximo ";
//          echo $sql2;
          mysql_query($sql2);
      }

   }



//  exit();
  


if (1==2) {
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


$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only

$mail->SetFrom($mailparte, 'Oficina de partes');
$mail->AddReplyTo($mailparte,"First Last");
$materia2=substr($materia,0,50);
$mail->Subject    = "$arreglo[1] $prefijo2 $folio $materia2 ";
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
  $mail->AddAttachment($archivo1); // attachment
}
if ($archivo2<>'') {
  $mail->AddAttachment($archivo2); // attachment
}
if ($archivo3<>'') {
  $mail->AddAttachment($archivo3); // attachment
}
if ($archivo4<>'') {
  $mail->AddAttachment($archivo4); // attachment
}




if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}





// ------------ termina el mail ----------------------





}

}
//exit();
echo "<script>location.href='argedo_ingresoant.php?sw=1&ti=$ti&llave=0';</script>";


?>


