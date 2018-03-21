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


if ($materia2<>'') {
    $materia=$materia." ".$materia2;
}

//echo "-->".$_FILES["archivo1"]["name"];




  $rrhh="";
  if ($ti==1) {
   $prefijo3="RE";
   $subfijo3="resexc";
  }
  if ($ti==2) {
   $prefijo3="RA";
   $subfijo3="resafec";
  }
  if ($ti==3) {
   $prefijo3="O";
   $subfijo3="oficio";
  }
  if ($ti==6) {
   $prefijo3="RE";
   $subfijo3="resexc";
   $rrhh="_rrhh";
//   $prefijo="RESOLUCIÓN EXENTA";
  }
//     echo "-->".$cantidad."<--";

   $materiacompuesta="AUTORIZA ".$op1." ";
if ($cantidad>=1) {
   $materiacompuesta.=$nombre1." DESDE EL ".$fechaini1a." HASTA EL ".$fechater1b.", ";
}
if ($cantidad>=2) {
   $materiacompuesta.=$nombre2." DESDE EL ".$fechaini2a." HASTA EL ".$fechater2b.", ";
}
if ($cantidad>=3) {
   $materiacompuesta.=$nombre3." DESDE EL ".$fechaini3a." HASTA EL ".$fechater3b.", ";
}
if ($cantidad>=4) {
   $materiacompuesta.=$nombre4." DESDE EL ".$fechaini4a." HASTA EL ".$fechater4b.", ";
}
if ($cantidad>=5) {
   $materiacompuesta.=$nombre5." DESDE EL ".$fechaini5a." HASTA EL ".$fechater5b.", ";
}
if ($cantidad>=6) {
   $materiacompuesta.=$nombre6." DESDE EL ".$fechaini6a." HASTA EL ".$fechater6b.", ";
}
if ($cantidad>=7) {
   $materiacompuesta.=$nombre7." DESDE EL ".$fechaini7a." HASTA EL ".$fechater7b.", ";
}
if ($cantidad>=8) {
   $materiacompuesta.=$nombre8." DESDE EL ".$fechaini8a." HASTA EL ".$fechater8b.", ";
}
if ($cantidad>=9) {
   $materiacompuesta.=$nombre9." DESDE EL ".$fechaini9a." HASTA EL ".$fechater9b.", ";
}
if ($cantidad>=10) {
   $materiacompuesta.=$nombre10." DESDE EL ".$fechaini10a." HASTA EL ".$fechater10b.", ";
}

   
//echo $materiacompuesta;
//exit();


if ($ti==6 and ($op1=='PERMISO ADMINISTRATIVO'  or $op1=='FERIADO LEGAL')) {
    $materia=$materiacompuesta;
//   $materiacompuesta="AUTORIZA ".$op1." ".$nombre1." DESDE EL ".$fechaini1." HASTA EL ".$fechater1;
}
if ($ti==6 and $op1=='COMETIDO FUNCIONARIO') {
   $materia="AUTORIZA ".$op1." ".$nombre222." ".$destino22." DESDE EL ".$fechaini2." HASTA EL ".$fechater2;
}
if ($ti==6 and ($op1=='POSTERGUESE FERIADO LEGAL' )) {
//   $materia=$op1." ".$nombre1." DESDE EL ".$fechaini1." HASTA EL ".$fechater1;
    $materia=$materiacompuesta;
}
if ($ti==6 and ($op1=='RESERVADO' )) {
   $materia=$op1;
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
  $folio=$folio+1;


$anno2= substr($fecha2,0,4);
$anno2012=substr($fecha2,0,4);
//$anno2="2011";
//$anno2012="2012";


  $destino1='';
  $destino2='';
  $destino3='';
  $destino4='';

  
  if ($archivo1 != "") {
    $archivo1b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_1.PDF";
    $destino1 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo1b;
  }
  if ($archivo2 != "") {
    $archivo2b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_2.PDF";
    $destino2 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo2b;
  }
  if ($archivo3 != "") {
    $archivo3b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_3.PDF";
    $destino3 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo3b;
  }
  if ($archivo4 != "") {
    $archivo4b=$prefijo3."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_4.PDF";
    $destino4 =  "fileargedo".$anno2."/".$subfijo3."/".$archivo4b;
  }


 $dia1 = strtotime($fechamia);
// $fechabase =$fechabase;
 $dia2 = strtotime($fecha2);
 $diff=$dia2-$dia1;
// echo "$fechahoy -- $fechabase $diff <br>";

 $diff2=(intval($diff/(60*60*24)))*-1;


$rut=$rut.$rut2;
$dig=$dig.$dig2;
  $sql1="INSERT INTO argedo_documentos (docs_defensoria, docs_fechaparte, docs_horaparte, docs_folio, docs_area, docs_subarea, docs_tramite, docs_fecha, docs_materia, docs_obs, docs_anno, docs_fechasis, docs_user, docs_tipodoc, docs_tipo, docs_documento,docs_destinatario,docs_diferencia, docs_archivo, docs_archivo2, docs_archivo3, docs_archivo4, docs_rut, docs_dig)
                                values ('$regionsession', '$fecha1',     '$hora' ,     '$folio',     '$paises', '$estados',   '$tramite', '$fecha2', '$materia', '$obs', '$anno','$fechamia',  '$usuario', '$tipodoc', '$ti',  '$prefijo','$destinatario','$diff2','$destino1','$destino2','$destino3','$destino4','$rut','$dig' )";
  echo $sql1;
//  exit();
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
  if ($ti==6) {
   $prefijo="RE";
   $subfijo="resexc";
  }

  $sql2="select max(docs_id) as maximo from argedo_documentos where docs_user='$usuario' ";
//  echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];


//$rut3=$rut.$rut2;
//$dig3=$dig.$dig2;
$rut3=$rut;
$dig3=$dig;
$nombre3=$nombre1.$nombre2;
$calidad3=$calidad.$calidad2;
$estamento3=$estamento.$estamento2;
//$destinacion=$destinacion.$destinacion2;
$destinacion3=$destino22;

//------------- insertar datos del funcionario para resoluciones de RRHH   -----------------

$fechaini2b= substr($fechaini2,6,4)."-".substr($fechaini2,3,2)."-".substr($fechaini2,0,2);
$fechater2b= substr($fechater2,6,4)."-".substr($fechater2,3,2)."-".substr($fechater2,0,2);
if ($ti==6 and $op1=='COMETIDO FUNCIONARIO') {
  $sql2b="INSERT INTO reembolso_funcionario (func_docs_id, func_rut, func_dig, func_nombre, func_calidad, func_estamento, func_grado, func_cargo, func_region, func_unidad, func_destinacion, func_tipo, func_ndias, func_fechaini, func_fechater)
                                  VALUES ($maximo,       '$rut222',   '$dig222',  '$nombre222',    '$calidad222',   '$estamento222', '$grado222',    '$cargo222',    '$region222', '$unidad222' , '$destinacion3', '$op1', '$ndias', '$fechaini2b' ,'$fechater2b'); ";
// echo $sql2b;
// exit();
  $result2=mysql_query($sql2b);
}


//--------------- Termina la insercion de datos del funcionario
//exit();
//$anno2="2011";
  if ($archivo1 != "") {

      $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_1.PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno2."/".$subfijo."/".$archivo1;
      if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo1."</b>";
           $archivo1="fileargedo".$anno2."/".$subfijo."/".$archivo1;
//          $sql2="update argedo_documentos set docs_archivo ='$destino' where docs_id=$maximo ";
//          echo $sql2;
//          mysql_query($sql2);
      }

   }

  if ($archivo2 != "") {

      $archivo2=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_2.PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno2."/".$subfijo."/".$archivo2;
      if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo2."</b>";
           $archivo2="fileargedo".$anno2."/".$subfijo."/".$archivo2;
//          $sql2="update argedo_documentos set docs_archivo2 ='$archivo2' where docs_id=$maximo ";
//          echo $sql2;
//          mysql_query($sql2);
      }

   }

  if ($archivo3 != "") {

      $archivo3=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_3.PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno2."/".$subfijo."/".$archivo3;
      if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo3."</b>";
           $archivo3="fileargedo".$anno2."/".$subfijo."/".$archivo3;
//          $sql2="update argedo_documentos set docs_archivo3 ='$archivo3' where docs_id=$maximo ";
//          echo $sql2;
//          mysql_query($sql2);
      }

   }
  if ($archivo4 != "") {

      $archivo4=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_4.PDF";
      // guardamos el archivo a la carpeta files
      $destino =  "../../archivos/docargedo/fileargedo".$anno2."/".$subfijo."/".$archivo4;
      if (copy($_FILES['archivo4']['tmp_name'],$destino)) {
          $status = "Archivo subido: <b>".$archivo4."</b>";
           $archivo4="fileargedo".$anno2."/".$subfijo."/".$archivo4;
//          $sql2="update argedo_documentos set docs_archivo4 ='$archivo4' where docs_id=$maximo ";
//          echo $sql2;
//          mysql_query($sql2);
      }

   }


//        exit();
  

  $sql4="update argedo_folios set $campo='$folio' where fol_id=1 ";
//  echo $sql4."<br>";

  mysql_query($sql4);
//  exit();
  



//------------- Comineza el mail  ----------------------


}


      	$msg="En Archivo adjunto, se encuentra documento oficializado en Oficina de Partes de su Defensoría, <br>";
  	    $msg.="<br><br>";
  	    $msg.="Folio : $folio <br>";
  	    $msg.="Tipo Documento : $prefijo2 <br>";
  	    $msg.="Materia : $materia <br>";
        $msg.="<br><br>";
        
        if ($archivo1<>'') {
//             $linkarchivo1="../../archivos/docargedo/".$archivo1;
             $msg.="Ver archivo1 (pinche aquí): <a href='http://10.16.25.63/sistemas/archivos/docargedo/".$archivo1."'>Ver Archivo 1</a><br><br>";
        }
        if ($archivo2<>'') {
//             $linkarchivo2="../../archivos/docargedo/".$archivo2;
             $msg.="Ver archivo2 (pinche aquí): <a href='http://10.16.25.63/sistemas/archivos/docargedo/".$archivo2."'>Ver Archivo 1</a><br><br>";
        }
        if ($archivo3<>'') {
//             $linkarchivo3="../../archivos/docargedo/".$archivo3;
             $msg.="Ver archivo3 (pinche aquí): <a href='http://10.16.25.63/sistemas/archivos/docargedo/".$archivo3."'>Ver Archivo 1</a><br><br>";
        }
        
        if ($archivo4<>'') {
//             $linkarchivo4="../../archivos/docargedo/".$archivo4;
             $msg.="Ver archivo4 (pinche aquí): <a href='http://10.16.25.63/sistemas/archivos/docargedo/".$archivo4."'>Ver Archivo 1</a><br><br>";
        }


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
//$mail->Host       = "10.16.25.238"; // SMTP server
$mail->Host       = "localhost"; // SMTP server
//$mail->Host       = "COLOSSUS"; // SMTP server
//$mail->Host       = "127.0.0.1"; // SMTP server


$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
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
if ($ti==6) {
   echo "<script>location.href='argedo_resyofi2.php?sw=1&ti=$ti&llave=0';</script>";
} else {
   echo "<script>location.href='argedo_resyofi.php?sw=1&ti=$ti&llave=0';</script>";
}


?>


