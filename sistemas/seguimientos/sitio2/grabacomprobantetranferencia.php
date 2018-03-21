<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');

$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);
$annomio= substr($fecha1,6,4);
$fecha1=$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);



$archivo1 = $_FILES["archivo1"]["name"];

//echo $monto."---->".$rut."--->".$archivo1;
//exit();
if ($fecha1<>"" and $nrocomprobante<>"") {

 $sql1="INSERT INTO dpp_comprobantetrans (cotran_fecha, cotran_nrocomprobante, cotran_fechasis, cotran_user, cotran_region, cotran_tipo)
 VALUES ('$fecha1',    '$nrocomprobante',    '$fechamia',    '$usuario', '$regionsession', '$tipo');";
// echo $sql1;
// exit();
 mysql_query($sql1);
 
 $sql1="select max(cotran_id) as maximo from dpp_comprobantetrans where cotran_user='$usuario'";
// echo $sql1;
// exit();
 $res1=mysql_query($sql1);
 $row1=mysql_fetch_array($res1);
 $maximo=$row1["maximo"];


 $nombretipo=substr($tipo,0,3);
 if ($archivo1 != "") {
  $archivo1=date("Y")."/trans".$regionsession."_".$nrocomprobante."_".$nombretipo."_".$annomio.".PDF";
  $fecha2 = date("Y-m-d",strtotime($fecha1));
        // guardamos el archivo a la carpeta files
  mkdir("../../archivos/documentostrans/".date("Y"),0777,true);
  $destino =  "../../archivos/documentostrans/".$archivo1;
  if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
    $status = "Archivo subido: <b>".$archivo1."</b>";
    $sql2="update dpp_comprobantetrans set cotran_archivo1='$archivo1' where cotran_id=$maximo ";
//            echo $sql2;

    $sql3 = "UPDATE dpp_etapas SET eta_fecha_egreso = '".$fecha2."', eta_doc_egreso = '".$destino."', eta_num_egreso = '".$nrocomprobante."' WHERE eta_negreso = '".$nrocomprobante."'";
    mysql_query($sql3);
    mysql_query($sql2);


  }
}



}
$enviarEmail = 1;
if($enviarEmail == 1)
{

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

$mail->SetFrom("inedis_junji@junji.cl", 'Oficina de Tesoreria');
// $mail->AddReplyTo($mailparte,"First Last");
$materia2=substr($materia,0,50);
$mail->Subject    = "Pago de documento";
$mail->AltBody    = "Mensaje"; // optional, comment out and test


// IMPLEMENTACION DE CORREO ELECTRONICO A PROVEEDORES
  $sql3 = "SELECT * FROM dpp_etapas WHERE eta_ncheque = '".$nrocomprobante."' AND eta_region = ".$regionsession;
  $res3 = mysql_query($sql3);

// RECORREMOS EL RESULTADO DE LA CONSULTA
  while($row3 = mysql_fetch_array($res3))
  {
  // BUSCAMOS INFORMACION DEL PROVEEDOR
    $sql4 = "SELECT * FROM dpp_proveedores WHERE provee_rut = ".$row3["eta_rut"];
    $res4 = mysql_query($sql4);
    $row4 = mysql_fetch_array($res4);

    $vartipodoc1=$row3["eta_tipo_doc"];
    if ($vartipodoc1=='Factura') {
      $vartipodoc2=$row3["eta_tipo_doc2"];
      if ($vartipodoc2=="f" or $vartipodoc2=="FAF" or $vartipodoc2=="FEX" or $vartipodoc2=="FEL" or $vartipodoc2=="FELEX")
        $vartipodoc="Factura";
      if ($vartipodoc2=="b")
        $vartipodoc="Boleta Servicio";
      if ($vartipodoc2=="r")
        $vartipodoc="Recibo";
      if ($vartipodoc2=="n" or $vartipodoc2=="NC" or $vartipodoc2=="NCEL")
        $vartipodoc="N.Crédito";
      if ($vartipodoc2=="ND" or $vartipodoc2=="NDEL" )
        $vartipodoc="N.Débito";
      if ($vartipodoc2=="bh" or $vartipodoc2=="BH" )
        $vartipodoc="Honorario";
    }
    if ($vartipodoc1=='Honorario') {
      $vartipodoc="Honorario";
    }

    $mensaje = "ESTIMADO/A  <strong>".$row3["eta_cli_nombre"]."</strong><br>";
    $mensaje.= "Se ha realizado el pago del siguiente documento : <br>";
    $mensaje.= "Folio : ".$row3["eta_numero"]."<br>";
    $mensaje.= "Tipo Documento : ".$vartipodoc."<br>";
    $mensaje.= "Monto : $".number_format($row3["eta_monto"],0,".",".")."<br>";
    $mensaje.= "Fecha de la transferencia : ".date("d/m/Y",strtotime($fecha1))."<br>";
    $mensaje.= "<br><br>Atentamente JUNTA NACIONAL DE JARDINES INFANTILES.";

    $mail->MsgHTML($mensaje);

    if($row4["provee_mail"] <> "" && $row4["provee_nombre"] <> "")
    {
    // SE ENVÍA CORREO A PROVEEDOR
      $mail->AddAddress($row4["provee_mail"],$row4["provee_nombre"]);
      $mail->Send();
    }
  }

}// ENVIAR EMAIL

  echo "<script>location.href='comprobantetransferencia.php?llave=1';</script>";


  ?>


