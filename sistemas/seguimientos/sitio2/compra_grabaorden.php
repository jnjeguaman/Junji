<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$fechamia=date('Y-m-d');

$hora=date("h:i:s");

$annomia=date('Y');

$regionsession = $_SESSION["region"];

$usuario=$_SESSION["nom_user"];







extract($_POST);

$archivo1 = $_FILES["archivo1"]['name'];

$archivo2 = $_FILES["archivo2"]['name'];

$distribucion = $_FILES["distribucion"]["name"];

if (1==1) {



  $fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

  $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

  $fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);

  $numerooc=$numerooc1."-".$numerooc2."-".$numerooc3;

  if ($archivo1<>'') {

   $archivo1="doc".$annomia."/ocompra/OC".$regionsession."_".$numerooc."_".$annomia.".PDF";

 }

 if ($archivo2<>'') {
  $extension = strtoupper(pathinfo($archivo2,PATHINFO_EXTENSION));
  $archivo2="doc".$annomia."/sccompra/SC".$regionsession."_".$numerooc."_".$annomia.".".$extension;
}

if($distribucion <> '')
{
  $archivo = $_FILES["distribucion"]['name'];
  $extensionesPeritidas =  array("xlsx","xls","csv");
  $extension = pathinfo($archivo,PATHINFO_EXTENSION);
  
  if(in_array($extension, $extensionesPeritidas))
  {
    $distribucion = "doc".$annomia."/ocompra/dist/OC".$regionsession."_".$numerooc."_".$annomia.".".$extension;
  }  

}
list($tipo2, $tipo2nn) = split('/', $tipo2);

$sql="INSERT INTO compra_orden (oc_numero,      oc_tipo,    oc_modalidad, oc_ccosto, oc_rut, oc_dig, oc_rsocial, oc_direccion, oc_fono, oc_monto, oc_moneda, oc_obs, oc_fechacompra, oc_fechaentrega, oc_compra_id, oc_fechasis, oc_user, oc_region, oc_archivo, oc_nombre, oc_estado, oc_fechalic, oc_nroresolucion, oc_archivores, oc_orden, oc_item, oc_compromiso,oc_dist,oc_activo,oc_gasto,oc_solicitud_archivo,oc_sc,oc_prog ) VALUES (upper('$numerooc'), '$tipo2b', '$documento2', '$tipo2', '$rut',   '$dig', upper('$nombre'), '$direccion','$telefono', '$monto', '$moneda', upper('$obs'), '$fecha1', '$fecha2',          '$documento', '$fechamia', '$usuario', '$region', '$archivo1', '$nombreoc', '$estado22', '$fecha2', '$nroresolucion', '', '$numerooc2','$item','$montob','$distribucion','$oc_activo','$oc_gasto','".$archivo2."','".$sc."','".$programa."');";
// echo $sql;
// exit();
// mysql_query($sql);
$res = mysql_query($sql);
$ultima_oc_id = mysql_insert_id();






if($distribucion <> '')
{
  $archivo1 = $_FILES["distribucion"]['name'];
  $extensionesPeritidas =  array("xlsx","xls","csv");
  $extension = pathinfo($archivo1,PATHINFO_EXTENSION);
  
  if(in_array($extension, $extensionesPeritidas))
  {
    // $distribucion = "doc".$annomia."/ocompra/dist/OC".$regionsession."_".$numerooc."_".$annomia.".".$extension;
    // $destino = "../../archivos/docfac/".$distribucion;
    $ruta = "archivos/docfac/doc".$annomia."/ocompra/dist/";
    $distribucion = "OC".$regionsession."_".$numerooc."_".$annomia.".".$extension;
    $destino = "../../".$ruta.$distribucion;
    mkdir("../../".$ruta,0777,true);
    if(copy($_FILES["distribucion"]["tmp_name"], $destino))
    {
      $status = "Archivo subido: <b>".$distribucion."</b>";
    }
  }  
}

if ($archivo1 != "") {
$ruta = "archivos/docfac/doc".$annomia."/ocompra";
mkdir("../../".$ruta,0777,true);
  $archivo1="doc".$annomia."/ocompra/OC".$regionsession."_".$numerooc."_".$annomia.".PDF";

        // guardamos el archivo a la carpeta files

  $destino =  "../../archivos/docfac/".$archivo1;

  if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {

    $status = "Archivo subido: <b>".$archivo1."</b>";

//            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";

//            echo $sql2;

//            mysql_query($sql2);





  }

}




if ($archivo2 != "") {
  $extension = strtoupper(pathinfo($archivo2,PATHINFO_EXTENSION));
  $ruta = "archivos/docfac/doc".$annomia."/sccompra";
  mkdir("../../".$ruta,0777,true);
  $archivo2="doc".$annomia."/sccompra/SC".$regionsession."_".$numerooc."_".$annomia.".".$extension;
        // guardamos el archivo a la carpeta files

  $destino =  "../../archivos/docfac/".$archivo2;

//        echo $_FILES["archivo2"]['tmp_name'];

  if (copy($_FILES['archivo2']['tmp_name'],$destino)) {

    $status = "Archivo subido: <b>".$archivo2."</b>";

//                    echo $status."------------";

//            $sql2="update dpp_facturas set fac_doc2='$archivo3' where fac_id=$id ";

//            echo $sql2;

//            mysql_query($sql2);



  }

}







$nombre=trim($nombre);

$sql1="insert into dpp_proveedores (provee_rut, provee_dig, provee_cat_juri, provee_nombre, provee_fecha, provee_user, provee_fono, provee_dir)

values    ('$rut','$dig','$tipo',upper('$nombre'),'$fechamia','$usuario','$telefono','$direccion')  ";

// echo $sql1;

// exit();

mysql_query($sql1);





$sql1="update dpp_proveedores set provee_fono='$telefono', provee_dir='$direccion' where provee_rut='$rut' ";



// echo $sql1;

// exit();

mysql_query($sql1);





$sql="select max(oc_id) as id from compra_orden where oc_user='$usuario' ";

//echo $sql;

//exit();

$res=mysql_query($sql);

$row=mysql_fetch_array($res);

$id=$row["id"];


if ($tipo=='SERVICIO' and $monto>=500000 and ($rut<>89862200 and $rut<>88417000)) {
  $sql1="INSERT INTO compra_contrato (ccont_oc_id, ccont_ocnumero, ccont_region, ccont_fechasys)
                           values    ('$id',        upper('$numerooc'),   '$regionsession',  '$fechamia')  ";
// echo $sql1;
// exit();
   mysql_query($sql1);
}




$sql="INSERT INTO compra_detorden (detorden_oc_id, detorden_ccosto, detorden_plan, detorden_monto, detorden_fecha)

VALUES ('$id',           '$tipo2',        '$documento',      '$monto'     ,'$fechamia');";

//echo $sql;

//exit();

mysql_query($sql);

//echo $id;

}

//exit();
//echo "<script>location.href='compra_ordenb.php?id=$id';</script>";
mysql_query("UPDATE compra_orden SET oc_tipo2 = '".$tipo."' WHERE oc_id = ".$ultima_oc_id);
if($tipo == "BIEN")
{
   if($_SESSION["region"] == 14 || $_SESSION["region"] == 13)
 {
   include("compra_wms.php");
 }
  include("bode_inv_grabaindexoc2.php");
}else{
  $totalElementos = count($var);
  for($i=0;$i<$totalElementos;$i++)
  {
    mysql_query("INSERT INTO compra_detoc VALUES (NULL,".$ultima_oc_id.",'".$var[$i]."',".$var3[$i].",".$var5[$i].",".$var2[$i].",'".$var6[$i]."','".$cta_activo[$i]."','".$cta_gasto[$i]."')");
  }

}
$enviarEmail = 1;
if($enviarEmail == 1 && $regionsession == 14)
{
  //RESCATAMOS LA INFORMACION DE LA ORDEN DE COMPRA
  $sql3 = "SELECT * FROM compra_orden WHERE oc_id = ".$ultima_oc_id;
  $res3 = mysql_query($sql3,$dbh);
  $row3 = mysql_fetch_array($res3);

  // SI ES DE DIRECCION NACIONAL
    $imagenOC = $row3["oc_archivo"];
    $imagenCC = $row3["oc_solicitud_archivo"];
    $imagenOD = $row3["oc_dist"];
    // CONSTRUIMOS EL MENSAJE
    $msg.='Estimado/a Paula Stephanie Gomez Riquelme,<br>';
    $msg.='El usuario <strong>'.$usuario.'</strong> ha cargado la siguiente orden de compra al sistema SIGEJUN: <strong>'.$numerooc.'</strong>';
    $msg.='<br><br>TIPO DE ORDEN DE COMPRA : <strong>'.$row3["oc_tipo2"].'</strong><br><br>';

    $msg.="En adjunto se encuentra informacion relevante a la orden de compra señalada.<br><br>";
    $msg.="Atentamente, <br>";
    $msg.="SIGEJUN";
    $msg.="<br>";
    $msg = utf8_decode($msg);

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
$materia2=substr($materia,0,50);
$mail->Subject    = "Ingreso Orden de Compra";
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);

if($regionsession == 14)
{
  $mail->AddAddress("psgomez@junji.cl", "Paula Stephanie Gomez Riquelme");
}
// $mail->AddAddress("fvaras@pradi.cl","Freddy Varas");

if ($imagenCC<>'') {
  // $archivo1="../../archivos/docargedo/".$archivo1;
  $mail->AddAttachment("../../archivos/docfac/".$imagenCC); // attachment
}

if ($imagenOC<>'') {
  // $archivo1="../../archivos/docargedo/".$archivo1;
  $mail->AddAttachment("../../archivos/docfac/".$imagenOC); // attachment
}

//if ($imagenOD<>'') {
  // $archivo1="../../archivos/docargedo/".$archivo1;
//  $mail->AddAttachment("../../archivos/docfac/".$imagenOD); // attachment
//}

  if(!$mail->Send()) {
    // echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    // echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
  }    
}
echo "<script>location.href='compra_orden.php';</script>";

?>
