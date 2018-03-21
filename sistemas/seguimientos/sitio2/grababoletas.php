<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
$fecha3=$_POST["fecha3"];
//$folio=$_POST["folio"];
$hora=$_POST["hora"];
$min=$_POST["min"];
$hora=$hora.":".$min;
$region=$_POST["region"];
$tipo=$_POST["tipo"];
$tipo2=$_POST["tipo2"];
$monto=$_POST["monto"];
$tipomoneda=$_POST["tipomoneda"];
$rut=$_POST["rut"];
$dig=$_POST["dig"];
$nombre=$_POST["nombre"];
$nrogarantia=$_POST["nrogarantia"];
$emisora=$_POST["emisora"];
$glosa=$_POST["glosa"];
$depto=$_POST["depto"];

$emailPersonal = mysql_query("SELECT correo FROM usuarios WHERE nombre = '".$usuario."'",$dbh);
$emailPersonal = mysql_fetch_array($emailPersonal);
$emailPersonal = $emailPersonal["correo"];

$tipoLicitacion = $_POST["tipoLicitacion"];
if($tipoLicitacion == 1)
{
  $idlicitacion = $_POST["publica_sufijo"]."-".$_POST["publica_correlativo"]."-".$_POST["publica_tipo"];
}else if($tipoLicitacion == 2)
{
  $idlicitacion = $_POST["privada_sufijo"]."-".$_POST["privada_correlativo"]."-".$_POST["privada_tipo"];
}else if($tipoLicitacion == 3)
{
  $idlicitacion = $_POST["licitacion_otro"];
}
// $idlicitacion=$_POST["idlicitacion"];
// $idlicitacion = $_POST["licitacion_prefijo"]."-".$_POST["licitacion_correlativo"]."-".$_POST["licitacion_sufijo"];
$annomia=date('Y');

$archivo1 = $_FILES["archivo1"]['name'];
if ($archivo1 != "") {

        $archivo1=date("Y")."/boletag_".$_SESSION["region"]."_".$nrogarantia."_".$annomia.".PDF";
          mkdir("../../archivos/docgarantia/".date("Y"),0777,true);
        // guardamos el archivo a la carpeta files

        $destino =  "../../archivos/docgarantia/".$archivo1;


        if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {

            $status = "Archivo subido: <b>".$archivo1."</b>";

//            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";

//            echo $sql2;

//            mysql_query($sql2);

        }

    }

if ($rut<>"") {

  $sql1="insert into dpp_etapas (eta_tipo_doc,eta_fecha_ing,eta_fecha_recepcion, eta_usu_recepcion, eta_folio, eta_rut,eta_dig,eta_cli_nombre)
                           values   ('Boleta Grantia','$fechamia',  '$fecha1',          '$usuario', '$folio',  '$rut', '$dig',     '$nombre')  ";
 // echo $sql1;
 // mysql_query($sql1);

  $sql2="select max(boleg_folio) as maximo from dpp_boletasg where boleg_reg='$region' ";
//  echo $sql2;
  $result2=mysql_query($sql2);
  $row2=mysql_fetch_array($result2);
  $maximo=$row2["maximo"];
  $folio=$maximo+1;
//  echo $folio;
//  exit();

    $mail1="";
if ($region==15) {
    $mail1="garantias@dpp.cl";
}


  $sql3="  INSERT INTO dpp_boletasg (boleg_fecha_ing,boleg_fecha_recep, boleg_fecha_vence ,  boleg_fecha_emision    ,boleg_hora_recep, boleg_reg, boleg_tipo,   boleg_tipo2      , boleg_numero,boleg_emisora,boleg_monto, boleg_tipomoneda ,boleg_rut,boleg_dig,boleg_nombre,boleg_glosa,boleg_folio, boleg_mail1, boleg_idlicitacion,boleg_archivo)
                    VALUES          ('$fechamia'    ,'$fecha1',             '$fecha2',      '$fecha3'               ,     '$hora'    , $region  , '$tipo'   ,'$tipo2'           ,'$nrogarantia', '$emisora', '$monto'   , '$tipomoneda'  ,'$rut'   ,'$dig'   , '$nombre'  ,'$glosa'    ,'$folio', '$mail1', '$idlicitacion','$archivo1'    )";
//  echo $sql3;
  mysql_query($sql3);


}

$enviarEmail = 1;
if($enviarEmail == 1)
{

      $msg ="Adjunto a este correo, se envía una copia digitalizada de : ".$tipo2." por ".$tipo." y una copia de la ficha de ingreso correspondiente a la licitacion: ".$idlicitacion.".<br>";
      $msg.="Atentamente, <br>";
      $msg.="<br>";
      $msg.=$_SESSION["nombrecom"]." <br>";
      $msg.="Oficina de Partes <br>";
      $msg.=$_SESSION["regionnom"]." <br>";
      $msg.="<br>";
      
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

$mail->SetFrom("inedis_junji@junji.cl", 'Oficina de partes');
// $mail->AddReplyTo($mailparte,"First Last");
$mail->Subject    = utf8_decode("Ingreso Boleta de Garantía.");
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML(utf8_decode($msg));

$sql4 = "SELECT * FROM usuarios WHERE (atributo1 = 31 OR atributo1 = 35 OR atributo1 = 33) AND estado = 'A' AND region = ".$region;
$res4 = mysql_query($sql4);
while($row4 = mysql_fetch_array($res4))
{
  if($row4["nombrecom"] <> "" && $row4["correo"] <> "")
  {
    $mail->AddAddress($row4["correo"],$row4["nombrecom"]);
  }
}
$mail->AddAddress($emailPersonal,$_SESSION["nombrecom"]);
// $mail->AddAddress("fvaras@pradi.cl","Freddy Varas");

 if ($archivo1<>'') {
  // $archivo1="../../archivos/docargedo/".$archivo1;
  $mail->AddAttachment($destino); // attachment
}
if(!$mail->Send()) {
  // echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  // echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}   
}


echo "<script>location.href='boletas.php?llave=1';</script>";


?>


