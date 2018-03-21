<?

//session_start();
require("inc/config.php");
//require("inc/querys.php");
$fechamia=date('Y-m-d');
//$usuario=$_SESSION["nom_user"];
//$nombrecom=$_SESSION["nom_com"];
//$nombrereg=$_SESSION["regionnom"];
$sql5="select * from dpp_plazos ";
//echo $sql;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);
$etapa1=$row5["pla_bolega"];
$etapa2=$row5["pla_bolegb"];
$etapa3=$row5["pla_bolegc"];
$etapa4=$row5["pla_bolegd"];


$sql = "Select * from dpp_boletasg  where  boleg_estado=3 and (boleg_fecha1='0000-00-00' or boleg_fecha2='0000-00-00' or boleg_fecha3='0000-00-00' or  boleg_fecha4='0000-00-00') ";
$res3 = mysql_query($sql);
$cont=1;
$i=1;
$sw3=0;

while($row3 = mysql_fetch_array($res3)){
    $sw3=0;
    $bolegreg=$row3["boleg_reg"];
    $sql5 = "Select * from regiones  where codigo='$bolegreg' ";
    //echo $sql5;
    //exit();
    $res5 = mysql_query($sql5);
    $row5 = mysql_fetch_array($res5);
    $mailgarantia=$row3["mailgarantia"];


    $bolegfecha1=$row3["boleg_fecha1"];
    $bolegfecha2=$row3["boleg_fecha2"];
    $bolegfecha3=$row3["boleg_fecha3"];
    $bolegfecha4=$row3["boleg_fecha4"];



    $dia1 = strtotime($fechamia);
    $fechabase =$row3["boleg_fecha_vence"];

    
    $dia2 = strtotime($fechabase);
    $diff=$dia2-$dia1;
    
    $diff=intval($diff/(60*60*24));

//    $diff=strtotime($fechabase)-strtotime($fechamia))/86400);

    $bolegid =$row3["boleg_id"];
    
    
//    echo $cont.")".$diff." -".$bolegid." -->$etapa1<== ($diff) and ".$row3["boleg_fecha_vence"]."; <br>";
//    exit();
       $numero1="";
       $numero2="";
       $numero3="";
    if ($etapa1>=$diff and $bolegfecha1=='0000-00-00') {
      
      $arrid[$i]=$bolegid;
      $sql22="update dpp_boletasg set boleg_fecha1='$fechamia' where boleg_id=$bolegid  ";
//      echo $sql22."<br>";
       // mysql_query($sql22);
       $sw3=1;
       $numero1="Primer ";
       $numero2="30";
       $array_dias[$i] = 30;
       $array_dias2[$i] = "Primer ";

    }
    if ($etapa2>=$diff and $bolegfecha2=='0000-00-00') {
      
      $arrid[$i]=$bolegid;
      $sql22="update dpp_boletasg set boleg_fecha2='$fechamia' where boleg_id=$bolegid  ";
      //echo $sql22;
       // mysql_query($sql22);
       $sw3=1;
       $numero1="Segundo ";
       $numero2="15";
       $array_dias[$i] = 15;
       $array_dias2[$i] = "Segundo ";
    }
    if ($etapa3>=$diff and $bolegfecha3=='0000-00-00') {
      
      $arrid[$i]=$bolegid;
      $sql22="update dpp_boletasg set boleg_fecha3='$fechamia' where boleg_id=$bolegid  ";
      //echo $sql22;
       // mysql_query($sql22);
       $sw3=1;
       $numero1="Tercero ";
       $numero2="5";
       $array_dias[$i] = 5;
       $array_dias2[$i] = "Tercero ";
    }
    if ($etapa4>=$diff and $bolegfecha4=='0000-00-00') {
      
      $arrid[$i]=$bolegid;
      $sql22="update dpp_boletasg set boleg_fecha4='$fechamia' where boleg_id=$bolegid  ";
//      echo $sql22;
       // mysql_query($sql22);
       $sw3=1;
       $numero1="Ultimo ";
       $numero2=" 1 ";
       $numero3=" La JUNJI no se responsabilizará por la tenencia de la boleta en garantía que no sean retiradas dentro de los 30 dias vencido.<br>";
       /*$numero3=" La JUNJI no se responsabilizará por la tenencia de la boleta en garantía que no sean retiradas dentro de los 30 dias vencido, el documento luego de este plazo se procedera a destruir.<br>";*/
       $array_dias[$i] = 1;
       $array_dias3[$i] = $numero3;
       $array_dias2[$i] = "Ultimo ";
    }
    if ($sw3==1) {
       $i++;
       $sw2=0;
//       echo "$bolegid $diff  $etapa1 $etapa2 $etapa3   <br>";
    }

    $cont++;

}

//exit();


//echo "-----------".$i;
$j=1;
while ($j<$i ) {

      $arrid2=$arrid[$j];
      $numero2 = $array_dias[$j];
      $numero3 = $array_dias3[$j];
      $numero1 = $array_dias2[$j];
//      echo $arrid2,"<br>";
      $sql2="select * from dpp_boletasg where boleg_id=$arrid2";
//      echo "--".$sql2."<br>";
//      exit();
      $result2=mysql_query($sql2);
      $row2=mysql_fetch_array($result2);
      $boleg_reg=$row2["boleg_reg"];
      $boleg_tipo=$row2["boleg_tipo"];
      $boleg_tipo2=$row2["boleg_tipo2"];
      $boleg_folio=$row2["boleg_folio"];
      $boleg_glosa=$row2["boleg_glosa"];
      $boleg_doc1=$row2["boleg_archivo"];
      $boleg_doc2=$row2["boleg_archivo2"];
      $boleg_nombre=$row2["boleg_nombre"];
    $boleg_fecha_vence=$row2["boleg_fecha_vence"];
    $boleg_monto=$row2["boleg_monto"];
    $boleg_tipomoneda=$row2["boleg_tipomoneda"];
    $boleg_emisora=$row2["boleg_emisora"];
    $boleg_numero=$row2["boleg_numero"];
    $mail1=$row2["boleg_mail1"];
    $mail2=$row2["boleg_mail2"];
    $mail3=$row2["boleg_mail3"];
    $mail4=$row2["boleg_mail4"];
    $mail5=$row2["boleg_mail5"];


      $sql22="select * from regiones where codigo='$boleg_reg'";
//      echo "--".$sql2."<br>";
//      exit();
      $result22=mysql_query($sql22);
      $row22=mysql_fetch_array($result22);
    $regionnombre=$row22["nombre"];



      //echo "---------------->>>".$boleg_doc1;
      
      $mail="c_herrera_m@hotmail.com";
        $msg="";

        $msg.="De acuerdo a nuestros registros,<br> 
Se informa que se encuentra dentro de los proximos ".$numero2." dias, pronta a vencer una <strong>".$boleg_tipo2."</strong> por un monto de <strong>".$boleg_monto." ".$boleg_tipomoneda."</strong> del proveedor <strong>".$boleg_nombre."</strong> cuya copia se adjunta.<br>
Se solicita informar vía memorando si éste documento corresponde devolver o en caso contrario informar la renovación. Para lo último, debe contactarse con proveedor 
y gestionar la renovación del documento. <br><strong>".$numero3."</strong>
Es importante mencionar que todo este proceso debe ser gestionado antes del vencimiento de la garantía.<br><br> ";

  $msg.="Atentamente, <br>";
        $msg.=$nombrecom." <br>";
        $msg.="Encargado de Custodia de Garantías <br>";



        $msg.=$regionnombre."<br>";

//        $msg.=$nombrereg." <br>";
        $msg.="<br>";
      

$msg=utf8_decode($msg);
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

$mail->SetFrom("inedis_junji@junji.cl", utf8_decode('Boletas de Garantía JUNJI'));
// $mail->AddReplyTo("seggarantia@dpp.cl","First Last");
$mail->Subject    = utf8_decode("$numero1 Aviso de Vencimiento Boleta de Garantía JUNJI, folio $boleg_folio(NO RESPONDER) $nombrereg ");
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);


//$mail->MsgHTML($body);

//  $address = "cferrada@dpp.cl";
//  $mail->AddAddress($address, "Defensoria");
$region = $_SESSION["region"];
// ENVIAR A TODOS LOS CONTABLES Y TESOREROS
$sql3 = "SELECT * FROM usuarios where (atributo1 = 31 or atributo1 = 36) and sistema = 1 and estado = 'A' and region = ".$boleg_reg;
$res3 = mysql_query($sql3);

while($row3 = mysql_fetch_array($res3))
{
  // if($row3["correo"] <>  '' && $row3["nombrecom"] <> '')
  // $mail->AddAddress($row3["correo"],utf8_encode($row3["nombrecom"]));
}
$mail->AddAddress("fvaras@pradi.cl","Freddy Varas");
// $mail->AddAddress("emarzan@junji.cl","Enzo Marzan");
// $mail->AddAddress("jvillagra@junji.cl","Juan Villagra");
// if ($mail1<>"") {
//   $address = $mail1;
//   $mail->AddAddress($address, "Defensoria");
// }
// if ($mail2<>"") {
//   $address = $mail2;
//   $mail->AddAddress($address, "Defensoria");
// }
// if ($mail3<>"") {
//   $address = $mail3;
//   $mail->AddAddress($address, "Defensoria");
// }
// if ($mail4<>"") {
//   $address = $mail4;
//   $mail->AddAddress($address, "Defensoria");
// }
// if ($mail5<>"") {
//   $address = $mail5;
//   $mail->AddAddress($address, "Defensoria");
// }

// $mail->AddBCC("seggarantia@dpp.cl");


//$archivo1="../../archivos/docgarantia/$boleg_doc1";
//echo "------------->".$archivo1;
//$mail->AddAttachment($archivo1);      // attachment
if($boleg_doc1 <> "")
{
$mail->AddAttachment("../../archivos/docgarantia/".$boleg_doc1); // attachment
}
if($boleg_doc2 <> "")
{
$mail->AddAttachment("../../archivos/docgarantia/".$boleg_doc2); // attachment
}

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment


$mail->Send();

// if(!$mail->Send()) {
//   echo "Mailer Error: " . $mail->ErrorInfo;
// } else {
//  // echo "Message sent!";
//   echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
// }




// exit();


    

   $cont2++;
   $j++;
}



?>


