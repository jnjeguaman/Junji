<?
session_start();
ini_set('memory_limit', '64M');
extract($_POST);

require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$regionsession = $_SESSION["region"];
// $anno=date('Y');
if($regionsession <> 13 && $regionsession <> 6 && $regionsession <> 10 && $regionsession <> 7 && $regionsession <> 15 && $regionsession <> 2 && $regionsession <> 1 && $regionsession <> 5 && $regionsession <> 12 && $regionsession <> 3 && $regionsession <> 11 && $regionsession <> 9 && $regionsession <> 14)
{
	//$fecha2 = "29-12-2017";
}
$anno = substr($fecha2, 6,4);
$hora=date("h:i");
$usuario=$_SESSION["nom_user"];
$regionnombre=$_SESSION["regionnom"];
$deptonom=$_SESSION["deptonom"];

$emailPersonal = mysql_query("SELECT correo FROM usuarios WHERE nombre = '".$usuario."'",$dbh);
$emailPersonal = mysql_fetch_array($emailPersonal);
$emailPersonal = $emailPersonal["correo"];


$sql2="select * from regiones where codigo=$regionsession ";
//  echo $sql2."<br>";
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);
$mailparte=$row2["mail"];







foreach ($_REQUEST AS $indice => $valor){
  if(!is_numeric($valor)) {
   ${$indice}=strtoupper($valor);
 }
}




$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

if($op1 <> "RESERVADO" && $op1 <> "SECRETA")
{
  $archivo1 = $_FILES["archivo1"]["name"];
  $archivo2 = $_FILES["archivo2"]["name"];
  $archivo3 = $_FILES["archivo3"]["name"];
  $archivo4 = $_FILES["archivo4"]["name"];
}


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
 $prefijo3="OO";
 $subfijo3="oficio";
}
if ($ti==6) {
//   $prefijo3="RE";
//   $subfijo3="resexc";
 $prefijo3="RE";
 $subfijo3="resexcrrhh";
 $rrhh="_tra";
}
if ($ti==7) {
 $prefijo3="OC";
 $subfijo3="oficio";
 $rrhh="_of";
}
//     echo "-->".$cantidad."<--";
if($op1 == "NORMAL"){
  if($_POST["paises2"] <> "OTRO")
  {
    $x = $_POST["paises2"];
  }else{
   // mysql_query("INSERT INTO argedo_materia  VALUES (NULL,'".strtoupper($_POST["materia"])."',1)");
   $x = $_POST["materia"];
 }
 $materiacompuesta=$x." ";

}else{
  $x = $op1;
  $materiacompuesta="AUTORIZA ".$x." ";

}

/*
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
*/

$sql4="select * from argedo_funcionario where func_user='$usuario' and func_estado=1 ";
$res2 = mysql_query($sql4);
while($row = mysql_fetch_array($res2)){
 $fecha111= substr($row["func_fechaini"],8,2)."-".substr($row["func_fechaini"],5,2)."-".substr($row["func_fechaini"],0,4);
 $fecha222= substr($row["func_fechater"],8,4)."-".substr( $row["func_fechater"],5,2)."-".substr($row["func_fechater"],0,4);
 $materiacompuesta.=$row["func_nombre"]." DESDE EL ".$fecha111." HASTA EL ".$fecha222.". ";
}


//echo $materiacompuesta;
//exit();


if (($ti==6 ) and ($op1=='PERMISO ADMINISTRATIVO'  or $op1=='FERIADO LEGAL'  or $op1=='AUTORIZA PAGO'  or $op1=='PRORROGA ASIGNACION FAMILAR')) {
  $materia=$materiacompuesta;
//   $materiacompuesta="AUTORIZA ".$op1." ".$nombre1." DESDE EL ".$fechaini1." HASTA EL ".$fechater1;
}
if (($ti==6 ) and $op1=='COMETIDO FUNCIONARIO') {
   // $materia="AUTORIZA ".$op1." ".$nombre222." ".$destino22." DESDE EL ".$fechaini2." HASTA EL ".$fechater2;
  $materia=$materiacompuesta;
}
if (($ti==6 ) and ($op1=='POSTERGUESE FERIADO LEGAL' )) {
//   $materia=$op1." ".$nombre1." DESDE EL ".$fechaini1." HASTA EL ".$fechater1;
  $materia=$materiacompuesta;
}

//---- VER OPCION RESERVADO
if (($ti==6 ) and ($op1=='RESERVADO' )) {
 $materia=$op1;
}

if (($ti==6 )and $op1=='COMPENSACION HORARIA') {
  $materia=$materiacompuesta;
}

if ($ti==6 and ($op1=='CONTRATO A HONORARIOS' )) {
 $materia=" APRUEBANSE EL CONTRATO A HONORARIOS A SUMA ALZADA A ".$nombre555." RUN N° ".$rut555."-".$dig555;
//    $materia=$materiacompuesta;
}

if ($ti==6 and ($op1=='LICENCIA MEDICA' )) {
  $materia = $materiacompuesta;
}

if($ti == 6 and($op1=="NORMAL"))
{
  $materia=$materiacompuesta;
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
  
  /// -------- Cambio de folio para los tra  -------------
  if ($ti==7) {
   // $folio=$numh;
  }



  $anno2= substr($fecha2,0,4);
  $anno2012=substr($fecha2,0,4);
//$anno2="2011";
//$anno2012="2012";


  $destino1='';
  $destino2='';
  $destino3='';
  $destino4='';

  mkdir("../../archivos/docargedo/fileargedo".$anno2."/".$subfijo3,0777,true);
  
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
// if($op1 == "NORMAL")
// {
//   $area = $paises2.", ";
// }else{
//   $area='';
// }
  $rut=$rut.$rut2;
  $dig=$dig.$dig2;
  $sql1="INSERT INTO argedo_documentos (docs_defensoria, docs_fechaparte, docs_horaparte, docs_folio, docs_area, docs_subarea, docs_tramite, docs_fecha, docs_materia, docs_obs, docs_anno, docs_fechasis, docs_user, docs_tipodoc, docs_tipo, docs_documento,docs_destinatario,docs_diferencia, docs_archivo, docs_archivo2, docs_archivo3, docs_archivo4, docs_rut, docs_dig, docs_transparencia, docs_codh, docs_numh, docs_annoh, docs_referencia)
  values ('$regionsession', '$fecha2',     '$hora' ,     '$folio',     '$paises', '$estados',   '$tramite', '$fecha2', '".$area.$materia."', '$obs', '$anno','$fechamia',  '$usuario', '$tipodoc', '$ti',  '$prefijo','$destinatario','$diff2','$destino1','$destino2','$destino3','$destino4','$rut','$dig', '$transparencia', '$codh', '$numh', '$annoh', '$referencia' )";

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
   $prefijo="OO";
   $subfijo="oficio";
 }
 if ($ti==6) {
   $prefijo="RE";
   $subfijo="resexcrrhh";
 }
 if ($ti==7) {
   $prefijo="OC";
   $subfijo="oficio";
 }
 if ($ti==9) {
   $prefijo="RE";
   $subfijo="resexc";
 }


 $sql2="select max(docs_id) as maximo from argedo_documentos where docs_user='$usuario' ";
//  echo $sql2;
 $result2=mysql_query($sql2);
 $row2=mysql_fetch_array($result2);
 $maximo=$row2["maximo"];

 $sql4="update argedo_funcionario set func_estado=2, func_docs_id=$maximo where func_user='$usuario' and func_estado=1 ";
 mysql_query($sql4);



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
$archivo1b=$archivo1;
if ($archivo1 != "") {

  $archivo1=$prefijo."_".$folio."_".$anno2012."_".$regionsession.$rrhh."_1.PDF";
  $archivo1b=$archivo1;
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


if ($ti<>7 or 1==1)  {
  $sql4="update argedo_folios set $campo='$folio' where fol_id=1 ";
//  echo $sql4."<br>";

  mysql_query($sql4);
//  exit();
  
}

$enviarEmail = 1;
if($enviarEmail == 1)
{

//------------- Comineza el mail  ----------------------

  $msg="<table border='0' width='100%' style='font-family: Calibri;font-size:11px;'>";
  $msg.="<tr><td><p style='font-style:italic;color:#EC0303'>”Debe considerar que en virtud de la Ley N° 19.628 Sobre Protección a la Vida Privada Usted está en la obligación de guardar secreto sobre los datos de carácter personal y/o sensible contenidos en los documentos que se adjuntan para su conocimiento y exclusiva tramitación de acuerdo a las competencias de este Servicio, toda vez que dichos datos provienen y/o han sido recolectados de fuentes no accesibles al público y se requiere del consentimiento del titular del dato para su tratamiento y/o divulgación. Para lo anterior, debe considerar que el tratamiento de datos personales por parte de un organismo público sólo podrá efectuarse respecto de las materias de su competencia y con sujeción a la norma mencionada. En esas condiciones, no necesitará el consentimiento del titular.”</p></td></tr>";
  $msg.="<tr><td>En Archivo adjunto, se encuentra documento oficializado en Oficina de Partes.</td></tr>";
  $msg.="<tr><td>Folio : ".$folio."</td></tr>";
  $msg.="<tr><td>Tipo Documento : ".$prefijo2."</td></tr>";
  $msg.="<tr><td>Materia : ".$materia."</td></tr>";

 // $msg="En Archivo adjunto, se encuentra documento oficializado en Oficina de Partes.<br>";
 // $msg.="<br><br>";
 // $msg.="Folio : $folio <br>";
 // $msg.="Tipo Documento : $prefijo2 <br>";
 // $msg.="Materia : $materia <br>";

 // $msg.="<br><br>";
/*

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

*/

        $msg.="<tr><td>Atentamente,</td></td>";
        $msg.="<tr><td height='10'></td></td>";
        $msg.='<tr><td><p class="MsoNormal"><span style="font-size:24.0pt;font-family:&quot;Arial Black&quot;,&quot;sans-serif&quot;;color:#0168B3;mso-fareast-language:ES-CL">&#8212;&#8212;</span><span style="font-size:24.0pt;font-family:&quot;Arial Black&quot;,&quot;sans-serif&quot;;color:#EE3A43;mso-fareast-language:ES-CL">&#8212;&#8212;&#8212;</span><b><span style="font-size:9.0pt;font-family:&quot;Arial&quot;,&quot;sans-serif&quot;;color:#7F7F7F;mso-fareast-language:ES-CL"><o:p></o:p></span></b></p></td></tr>';
        $msg.="<tr><td><strong>Oficina de Partes</strong></td></tr><tr><td><strong>".$regionnombre."</strong></td></tr>";
        //$msg.="<tr><td><p style='font-style:italic;color:#EC0303'>”Debe considerar que en virtud de la Ley N° 19.628 Sobre Protección a la Vida Privada Usted está en la obligación de guardar secreto sobre los datos de carácter personal y/o sensible contenidos en los documentos que se adjuntan para su conocimiento y exclusiva tramitación de acuerdo a las competencias de este Servicio, toda vez que dichos datos provienen y/o han sido recolectados de fuentes no accesibles al público y se requiere del consentimiento del titular del dato para su tratamiento y/o divulgación. Para lo anterior, debe considerar que el tratamiento de datos personales por parte de un organismo público sólo podrá efectuarse respecto de las materias de su competencia y con sujeción a la norma mencionada. En esas condiciones, no necesitará el consentimiento del titular.”</p></td></tr>";

        // $msg.="<br><br>";
        // $msg.="Atentamente, <br>";
        // $msg.="Encargado de Oficina de Partes <br> $regionnombre <br>";
        // $msg.="<br><br>";
        // $msg.="<p style='font-size:1.2em;font-style:italic;color:#EC0303'>Debe considerar que en virtud de la Ley N° 19.628 Sobre Protección a la Vida Privada Usted está en la obligación de guardar secreto sobre los datos de carácter personal y/o sensible contenidos en los documentos que se adjuntan para su conocimiento y exclusiva tramitación de acuerdo a las competencias de este Servicio, toda vez que dichos datos provienen y/o han sido recolectados de fuentes no accesibles al público y se requiere del consentimiento del titular del dato para su tratamiento y/o divulgación. Para lo anterior, debe considerar que el tratamiento de datos personales por parte de un organismo público sólo podrá efectuarse respecto de las materias de su competencia y con sujeción a la norma mencionada. En esas condiciones, no necesitará el consentimiento del titular.”</p>";
  //     echo $msg;
        $msg.='</table>';
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
$materia2=substr($materia,0,50);
$mail->Subject    = "$arreglo[1] $prefijo2 $folio $materia2 ";
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);



//$mail->MsgHTML($body);


//  $address = $mail1;
  // $address = "admin@aestudiar.cl";
//  $mail->AddAddress($address, "Defensoria");
 $mail->AddAddress("junji@aestudiar.cl"," ");

//  $address = $mailparte;


$mail->AddAddress($emailPersonal, $usuario);

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
  // echo "Mailer Error: " . $mail->ErrorInfo;
$ruta = "../../archivos/respaldos/ARGEDO/".date("Y")."/".date("m");
$fichero = "LOG_CORREO_".$regionsession."_".date("Ymd").".txt";
mkdir($ruta,0777,true);
$fp = fopen($ruta."/".$fichero, "a");
fwrite($fp, $mail->ErrorInfo.",".$_SESSION["nom_user"].",".$regionsession.",".$folio.",".date("Y-m-d H:i:s").",".$_SERVER["REMOTE_ADDR"]."\r");
fclose($fp);
} else {
 // echo "Message sent!";
  // echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}

}




// ------------ termina el mail ----------------------




//------- Para DocMaster, asociar y cerrar documento

$modtraza="";
if ($iddocmaster<>'') {
      $modtraza=", reci_traza=CONCAT(reci_traza,'$deptonom','/') "; // , reci_traza=reci_traza.$deptonom;
      $fechaguia=", reci_fechaguia='$fechamia' ";

      $sql1="update doc_recibidaf set recif_estado='4' where recif_id=$foliocmaster";
//    echo $sql1."<br>";
//    exit();
      mysql_query($sql1,$dbh6);


      $sql1="update doc_recibida set reci_fechamod='$fechamia', reci_horamod='$hora', reci_estado='4' $modtraza where reci_id=$iddocmaster";

//  echo $sql1."<br>";
//  exit();
      mysql_query($sql1,$dbh6);

      $destino2 =  "../../archivos/docargedo/fileargedo".$anno."/".$subfijo."/";
      $sql2="update doc_recibida set reci_ruta ='$destino2', reci_archivo ='$archivo1b' where reci_id=$iddocmaster ";
//    echo $sql2."<br>";
      mysql_query($sql2,$dbh6);



    }

//------- Fin Para DocMaster, asociar y cerrar documento

  }
//exit();
  if(isset($_POST["origen"]) && $_POST["origen"] == "SIAPER")
  {
    echo "<script>location.href='argedo_resyofi2.php?ti=1&prefijo=&llave=0';</script>";
  }

  if ($ti==7) {
   echo "<script>location.href='argedo_resyofi.php?sw=1&ti=$ti&llave=0';</script>";
 }
 if ($ti==6) {
   echo "<script>location.href='argedo_resyofi2.php?sw=1&ti=$ti&llave=0';</script>";
 }
 if ($ti<6 ) {
   echo "<script>location.href='argedo_resyofi.php?sw=1&ti=$ti&llave=0';</script>";
 }

 ?>
