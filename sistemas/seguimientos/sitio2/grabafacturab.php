<?

session_start();

require("inc/config.php");

require("inc/querys.php");

$fechamia=date('Y-m-d');

$annomia=date('Y');

$usuario=$_SESSION["nom_user"];

$regionsession = $_SESSION["region"];



if($_SESSION["nom_user"]=="" ){

  ?><script language="javascript">location.href='sesion_perdida.php';</script><?

}





$fecha1=$_POST["fecha1"];

$fecha2=$_POST["fecha2"];

$fecha1b=$_POST["fecha1"];

$fecha2b=$_POST["fecha2"];





$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);

$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);



$folio=$_POST["folio"];

$region=$_POST["region"];

$rut=$_POST["rut"];

$dig=$_POST["dig"];

$nombre=$_POST["nombre"];

$monto=$_POST["monto"];

$moneda=$_POST["moneda"];

$depto=$_POST["depto"];

$numero1=$_POST["numero"];

$tipodoc=$_POST["tipodoc"];

$fpago=$_POST["fpago"];

$iva=$monto*19/119;

$iva=number_format($iva,0,"","");

$neto=$monto-$iva;
$oc = $_POST["oc"];


$archivo1 = $_FILES["archivo1"]["name"];





if ($tipodoc=="n")

 $monto=$monto*1;







//echo substr($a,8,2)."-".substr($a,5,2)."-".substr($a,0,4);









if ($rut<>"" and $nombre<>"" and $usuario<>"") {

//  $sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession' and folio1_usuario='$usuario' ";

  $sql21="select max(folio1_folio) as foliomio from dpp_folio1 where folio1_region='$regionsession'  ";

//  echo $sql21;

  $result21=mysql_query($sql21);

  $row21=mysql_fetch_array($result21);

  $foliomio=$row21["foliomio"];

  $foliomio=$foliomio+1;





  //exit();

//  if ($regionsession<>15) {

//      $fpago="Cheque";

//  }



  $sql1="insert into dpp_etapas (eta_tipo_doc,eta_tipo_doc2,eta_fecha_ing,eta_fecha_recepcion, eta_fecha_fac,eta_usu_recepcion, eta_folio, eta_region ,eta_rut,eta_dig,eta_cli_nombre,eta_numero, eta_monto, eta_moneda, eta_iva, eta_neto, eta_fpago, eta_monto2,eta_nroorden)

  values   ('Factura','$tipodoc','$fechamia',  '$fecha1',   '$fecha2',            '$usuario',    '$foliomio', '$region',       '$rut',    '$dig','$nombre', '$numero1' , '$monto', '$moneda' ,  '$iva',  '$neto', '$fpago', '$monto','".strtoupper($oc)."')  ";

//  echo $sql1;
//7  exit();

  mysql_query($sql1) or die("<script>location.href='facturas.php?llave=2';</script>");


  $sql2="select max(eta_id) as maximo from dpp_etapas where eta_usu_recepcion='$usuario' ";

  //echo $sql2;

  $result2=mysql_query($sql2);

  $row2=mysql_fetch_array($result2);

  $maximo=$row2["maximo"];


  $sql22="insert into dpp_folio1 (folio1_folio, folio1_region, folio1_usuario, folio1_fecha, folio1_tipo) values ('$foliomio','$regionsession','$usuario','$fechamia','fac')";

  //echo $sql22;

  mysql_query($sql22);

  //exit();



  $sql3 = "INSERT INTO dpp_facturas ( fac_eta_id, fac_fecha_ing,fac_fecha_recepcion, fac_fecha_fac, fac_usu_recepcion, fac_folio, fac_region, fac_rut, fac_dig, fac_numero, fac_cli_nombre, fac_monto, fac_moneda, fac_nroorden)

  VALUES   ( '$maximo' , '$fechamia'  , '$fecha1',          '$fecha2',     '$usuario',         '$foliomio', '$region', '$rut', '$dig',    '$numero1', '$nombre', '$monto', '$moneda','".strtoupper($oc)."')";



  //echo $sql3;


  mysql_query($sql3);

  //exit();

  $origen="Factura";

//include("mailfactura.php");



// echo "$archivo1  <--";

  if ($archivo1 != "") {

    $archivo1="doc".$annomia."/factura/".$regionsession."_".$maximo."_".$annomia.".PDF";

        // guardamos el archivo a la carpeta files



    $destino =  "../../archivos/docfac/".$archivo1;

     //   $destino =  "../../../archivos2/".$archivo1;

//        echo "<br>".$_FILES['archivo1']['tmp_name']."--".$archivo1."--".$destino;

    if (copy($_FILES['archivo1']['tmp_name'],$destino)) {

      $status = "Archivo subido: <b>".$archivo1."</b>";

      $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_eta_id=$maximo ";

//            echo "========".$sql2;

      mysql_query($sql2);

    } else {

//            echo "Error en archivo no copiado ";

    }

  }

  

}

$enviarEmail = 1;
if($enviarEmail == 1)
{

// PROCESO DE ENVIO DE EMAIL Y COMPROBACION

// COMPROBAMOS LA REGION DEL USUARIO
  if($tipodoc == "f")
  {

  // BUSCAMOS SI EXISTE LA ORDEN DE COMPRA EN INEDIS
    $oc_inedis = "SELECT count(oc_id) as Total,oc_id FROM bode_orcom WHERE oc_id2 = '".strtoupper($oc)."'";
    $oc_inedis = mysql_query($oc_inedis,$dbh6);
    $oc_inedis = mysql_fetch_array($oc_inedis);

    $oc_sigejun = "SELECT count(oc_id) as Total, oc_id,oc_item FROM compra_orden WHERE oc_numero = '".strtoupper($oc)."'";
    $oc_sigejun = mysql_query($oc_sigejun,$dbh);
    $oc_sigejun = mysql_fetch_array($oc_sigejun);


    if($oc_inedis["Total"] == 1)
    {
      $msg = "Oficina de Partes ha ingresado la factura N° <strong>".$numero1."</strong><br>";
      $msg .= "correspondiente a la orden de compra : <strong>".strtoupper($oc)."</strong> con el siguiente detalle : <br><br>";
      $msg .= "<table border='1' width='70%' style='font-size:0.8em;text-align:center'>";
      $msg .="<tr><td>N° GUIA</td><td>N° R/T</td><td>N° R/C</td><td>APROBADO CONTABLEMENTE POR</td></tr>";

        // BUSCAMOS SUS INGRESOS
      if($regionsession == 14)
      {
        $region = 16;
      }else if($regionsession == 16){
        $region = 14;
      }else{
        $region = $regionsession;
      }
      $ingresos = mysql_query("SELECT * FROM bode_ingreso WHERE ing_region = ".$region." AND ing_oc_id = ".$oc_inedis["oc_id"],$dbh6);

      while($row = mysql_fetch_array($ingresos))
      {
        $tc = ($row["ing_guianumerotc"] <> 0) ? $row["ing_guianumerotc"] : 0;
        $rt = ($row["ing_guianumerorc"] <> 0) ? $row["ing_guianumerorc"] : 0;
        $aprobado = ($row["ing_aprobado"] <> "") ? $row["ing_aprobado"] : "APROBACIÓN PENDIENTE";
        $msg .="<tr>";
        $msg .="<td>".$row["ing_guia"]."</td>";
        if($tc <> 0)
        {
          $msg .="<td><a style='text-decoration:none' href='http://192.168.100.121/sistemas/inventario/privado/sitio2/bode_tca.php?numguia=".$tc."' target='_blank'>".$tc."</a></td>";
        }else{
          $msg.="<td>PENDIENTE</td>";
        }
        
        if($rt <> 0)
        {
          $msg .="<td><a style='text-decoration:none' href='http://192.168.100.121/sistemas/inventario/privado/sitio2/bode_imprimerca.php?numguia=".$rt."' target='_blank'>".$rt."</a></td>";
        }else{
          $msg.="<td>PENDIENTE</td>";
        }
        $msg .="<td>".$aprobado."</td>";
        $msg .="</tr>";
    }//FIN WHILE
    $msg .="</table>"; 

    //BUSCAMOS LOS PRODUCTOS DE INEDIS
    $productos = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id WHERE a.oc_id = '".$oc_inedis["oc_id"]."'";
    $productos = mysql_query($productos,$dbh6);

    $msg.="<br>";
    $msg.='<table border="1" width="70%" style="font-size:0.8em;text-align:center">';
    $msg.='<tr>';
    $msg.='<td>PRODUCTO</td>';
    $msg.='<td>ITEM PRESUPUESTARIO</td>';
    $msg.='<td>DESCRIPCION</td>';
    $msg.='<td>CUENTA ACTIVO</td>';
    $msg.='<td>CUENTA GASTO</td>';
    $msg.='</tr>';

    while($row = mysql_fetch_array($productos))
    {

      $item = explode(".", $row["doc_item"]);
      $descripcion = mysql_query("SELECT * FROM compra_cuentas WHERE cuenta_item = '".$item[0]."' AND cuenta_subitem = '".$item[1]."' AND cuenta_asignacion = '".$item[2]."'",$dbh);
      $descripcion = mysql_fetch_array($descripcion);
      $msg.='<tr>';
      $msg.='<td>'.$row["doc_especificacion"].'</td>';
      $msg.='<td>'.$row["doc_item"].'</td>';
      $msg.='<td>'.$descripcion["cuenta_glosa"].'</td>';
      $msg.='<td>'.$row["doc_activo"].'</td>';
      $msg.='<td>'.$row["doc_gasto"].'</td>';
      $msg.='</tr>';
    }
    $msg.='</table>';


  }else if($oc_sigejun["Total"] == 1){
    $msg = "La orden de compra señalada ha sido ingresada a SIGEJUN.";

    $productos = "SELECT * FROM compra_orden a INNER JOIN compra_detoc b ON a.oc_id = b.doc_compra_id WHERE a.oc_id = '".$oc_sigejun["oc_id"]."'";
    $productos = mysql_query($productos,$dbh);

    $msg.="<br><br>";
    $msg.='<table border="1" width="70%" style="font-size:0.8em;text-align:center">';
    $msg.='<tr>';
    $msg.='<td>PRODUCTO</td>';
    $msg.='<td>ITEM PRESUPUESTARIO</td>';
    $msg.='<td>DESCRIPCION</td>';
    $msg.='<td>CUENTA ACTIVO</td>';
    $msg.='<td>CUENTA GASTO</td>';
    $msg.='</tr>';
    while($row = mysql_fetch_array($productos))
    {

      $item = explode(".", $row["doc_item"]);
      $descripcion = mysql_query("SELECT * FROM compra_cuentas WHERE cuenta_item = '".$item[0]."' AND cuenta_subitem = '".$item[1]."' AND cuenta_asignacion = '".$item[2]."'",$dbh);
      $descripcion = mysql_fetch_array($descripcion);
      $msg.='<tr>';
      $msg.='<td>'.$row["doc_especificacion"].'</td>';
      $msg.='<td>'.$row["doc_item"].'</td>';
      $msg.='<td>'.$descripcion["cuenta_glosa"].'</td>';
      $msg.='<td>'.$row["doc_activo"].'</td>';
      $msg.='<td>'.$row["doc_gasto"].'</td>';
      $msg.='</tr>';
    }
    $msg.='</table>';
    $detalle = "SELECT * FROM compra_detoc WHERE doc_oc_id = ".$oc_sigejun["oc_id"];
  }else{
    $msg = "La orden de compra señalada no ha sido ingresada al sistema";
  }
  // $item = explode(".", $oc_sigejun["oc_item"]);
  // $detalle_cuenta = mysql_query("SELECT * FROM compra_cuentas WHERE cuenta_item = '".$item[0]."' AND cuenta_subitem = '".$item[1]."' AND cuenta_asignacion = '".$item[2]."'",$dbh);
  // $detalle_cuenta = mysql_fetch_array($detalle_cuenta);

/*if($oc_sigejun["oc_item"] <> "")
{  
  $msg.="
  <br><br>
  <table  width='50%' style='font-size:0.6em;border:1px solid black;'>
    <tr>
      <td colspan='3' align='center'>CUENTA CONTABLE</td>
    </tr>

    <tr>
      <td>ITEM PRESUPUESTARIO</td>
      <td>:</td>
      <td>".$oc_sigejun["oc_item"]."</td>
    </tr>
    <tr>
      <td>DESCRIPCIÓN</td>
      <td>:</td>
      <td>".$detalle_cuenta["cuenta_glosa"]."</td>
    </tr>

    <tr>
      <td>CUENTA DE ACTIVO</td>
      <td>:</td>
      <td>".$detalle_cuenta["cuenta_activo"]."</td>
    </tr>

    <tr>
      <td>CUENTA DE GASTO</td>
      <td>:</td>
      <td>".$detalle_cuenta["cuenta_gasto"]."</td>
    </tr>
  </table>
  ";
}*/

$msg.="<br><br>";
$msg.="Atentamente, <br>";
$msg.="Encargado de Oficina de Partes";
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

$mail->SetFrom("inedis_junji@junji.cl", 'Oficina de Partes');
// $mail->AddReplyTo($mailparte,"First Last");
$materia2=substr($materia,0,50);
$mail->Subject    = "Ingreso Factura Oficina de Partes";
$mail->AltBody    = "Mensaje"; // optional, comment out and test
$mail->MsgHTML($msg);

/*
  BUSCAMOS LOS CORREOS CORRESPONDIENTES
  CONTABILIDAD Y SEGUIMIENTO Y CONTROL
  
  ATRIBUTOS
  5 : CONCILIA
  7 : SEGUIMIENTO Y CONTROL ADMINISTRADOR
  8 : SEGUIMIENTO Y CONTROL EJECUTIVO
  34 : CONTABLE
*/

$sql4 = "SELECT * FROM usuarios WHERE (atributo1 = 5 OR atributo1 = 7 OR atributo1 = 8) AND sistema = 1 AND estado = 'A' AND region = ".$regionsession;
$res4 = mysql_query($sql4);
while($row4 = mysql_fetch_array($res4))
{
  $mail->AddAddress($row4["correo"], utf8_decode($row4["nombrecom"]));
}

// if($regionsession == 1)
// {
//   $mail->AddAddress("contabilidad01@junji.cl", "Contabilidad Tarapacá");
//   $mail->AddAddres('afrojas@junji.cl','Aurora Rojas Barros');
//   $mail->AddAddres('jaraya@junji.cl','Javier Araya Parra');
//   $mail->AddAddres('pcalderon@junji.cl','Patricia Calderon Contreras');

// }
// if($regionsession == 2)
// {
//   $mail->AddAddress("contabilidad02@junji.cl", "Contabilidad Antofagasta");
//   $mail->AddAddres('fvargas@junji.cl','Fernando Vargas Gutierrez');
//   $mail->AddAddres('raperez@junji.cl','Rodrigo Perez Cabello');
//   $mail->AddAddres('larojas@junji.cl','Leopoldo Rojas Fuentes');
//   $mail->AddAddres('dazua@junji.cl','Verónica Azua Flores');

// }
// if($regionsession == 3)
// {
//   $mail->AddAddress("contabilidad03@junji.cl", "Contabilidad Atacama");
//   $mail->AddAddres('mhuerta@junji.cl','Mario Huerta Corrotea');
//   $mail->AddAddres('cgarcia@junji.cl','Carolina Garcia Jofre');
//   $mail->AddAddres('rjortiz@junji.cl','Richard Ortiz Reinoso');

// }
// if($regionsession == 4)
// {
//   $mail->AddAddress("contabilidad04@junji.cl", "Contabilidad Coquimbo");
//   $mail->AddAddres('mabarraza@junji.cl','Mario Barraza Antiquera');
//   $mail->AddAddres('wrojas@junji.cl','Wilson Rojas Gallardo');
//   $mail->AddAddres('cvicencio@junji.cl','Claudio Vicencio');
//   $mail->AddAddres('cdiaz@junji.cl','Cecilia Diaz Castillo');

// }
// if($regionsession == 5)
// {
//   $mail->AddAddress("contabilidad05@junji.cl", "Contabilidad Valparaiso");
//   $mail->AddAddres('jcuevas@junji.cl','Juan Cuevas Fernandez');
//   $mail->AddAddres('rmolina@junji.cl','Rodrigo Molina Araya');
//   $mail->AddAddres('acrojas@junji.cl','Angelica Rojas Gomez');
//   $mail->AddAddres('dborquez@junji.cl','Denise Borquez Sanchez');

// }
// if($regionsession == 6)
// {
//   $mail->AddAddress("contabilidad06@junji.cl", "Contabilidad OHiggins");
//   $mail->AddAddres('msaez@junji.cl','Monica Saez Valenzuela');
//   $mail->AddAddres('gsepulveda@junji.cl','Gladys Sepúlveda Pradena');
//   $mail->AddAddres('mbravo@junji.cl','María Cristina Bravo Bravo');
//   $mail->AddAddres('gcardenas@junji.cl','Gabriela Cardenas Valenzuela');

// }
// if($regionsession == 7)
// {
//   $mail->AddAddress("contabilidad07@junji.cl", "Contabilidad Maule");
//   $mail->AddAddres('gvasquez@junji.cl','Gonzalo Vasquez Contreras');
//   $mail->AddAddres('paherreran@junji.cl','Patricia Herrera Nuñez');
//   $mail->AddAddres('cacevedo@junji.cl','Carlos Acevedo');
//   $mail->AddAddres('eazuniga@junji.cl','Eduardo Zuñiga Faundez');

// }
// if($regionsession == 8)
// {
//   $mail->AddAddress("contabilidad08@junji.cl", "Contabilidad BioBio");
//   $mail->AddAddres('crgonzalez@junji.cl','Carlos Gonzalez Manrique');
//   $mail->AddAddres('apsaez@junji.cl','Anagelina Saez Urrutia');
//   $mail->AddAddres('cmiranda@junji.cl','Cindy Miranda');
//   $mail->AddAddres('nurra@junji.cl','Nixon Urra');

// }
// if($regionsession == 9)
// {
//   $mail->AddAddress("contabilidad09@junji.cl", "Contabilidad Araucania");
//   $mail->AddAddres('cfica@junji.cl','Cristian Fica');
//   $mail->AddAddres('ocardenas@junji.cl','Orlando Cardenas Andrade');

// }
// if($regionsession == 10)
// {
//   $mail->AddAddress("contabilidad10@junji.cl", "Contabilidad Los Lagos");
//   $mail->AddAddres('jcarmona@junji.cl','Jaime Carmona Rosas');
//   $mail->AddAddres('rgomez@junji.cl','Rocio Gomez Villarroel');
//   $mail->AddAddres('marodriguez@junji.cl','Marcelo Rodriguez Rodriguez');

// }
// if($regionsession == 11)
// {
//   $mail->AddAddress("contabilidad11@junji.cl", "Contabilidad Aysen");
//   $mail->AddAddres('acuevas@junji.cl','Andrés Cuevas Cuevas');
//   $mail->AddAddres('hrodriguez@junji.cl','Hugo Rodriguez Olavarria');
//   $mail->AddAddres('mmancilla@junji.cl','Mariela Mancilla Urrutia');
//   $mail->AddAddres('rvargas@junji.cl','Raquel Vargas Fierro');
//   $mail->AddAddres('jchacana@junji.cl','Jose Chacana Arredondo');

// }
// if($regionsession == 12)
// {
//   $mail->AddAddress("contabilidad12@junji.cl", "Contabilidad Magallanes");
//   $mail->AddAddres('stoledo@junji.cl','Silvia Toledo Díaz');
//   $mail->AddAddres('savendano@junji.cl','Silvana Avendano Cerantes');
//   $mail->AddAddres('atellez@junji.cl','Azucena Tellez Almonacid');

// }
// if($regionsession == 13)
// {
//   $mail->AddAddress("contabilidad13@junji.cl", "Contabilidad Metropolitana");
//   $mail->AddAddres('dagutierrez@junji.cl','Daniela Gutierrez Novoa');
//   $mail->AddAddres('pbravo@junji.cl','Patricia Bravo');
//   $mail->AddAddres('svalenzuela@junji.cl','Solange Valenzuela');
//   $mail->AddAddres('rmartinez@junji.cl','Rodrigo Martinez Miranda');

// }
// if($regionsession == 14)
// {
//   $mail->AddAddress("contabilidad_dirnac@junji.cl", "Contabilidad DIRNAC");
//   $mail->AddAddres('mlmartinez@junji.cl','Miguel Martinez Mesina');
//   $mail->AddAddres('scarcamo@junji.cl','Sergio Carcamo ');
//   $mail->AddAddres('cquiroz@junji.cl','Caroline Quiroz');
//   $mail->AddAddres('eavila@junji.cl','Enrique Avila');
//   $mail->AddAddres('rmercader@junji.cl','Ricardo Mercader');
//   $mail->AddAddres('melgueta@junji.cl','Mauricio Elgueta');
//   $mail->AddAddres('gcanelo@junji.cl','Giovanni Canelo Morales');
//   $mail->AddAddres('seguimientoycontrol@junji.cl','Seguimiento y Control DIRNAC');
// }
// if($regionsession == 15)
// {
//   $mail->AddAddress("contabilidad15@junji.cl", "Contabilidad Arica");
//   $mail->AddAddres('otello@junji.cl','Omar Tello Contreras');
//   $mail->AddAddres('jcaro@junji.cl','Jonathan Caro Nuñez');
//   $mail->AddAddres('gerodriguez@junji.cl','German Rodriguez');

// }
// if($regionsession == 16)
// {
//   $mail->AddAddress("contabilidad14@junji.cl", "Contabilidad Los Rios");
//   $mail->AddAddres('bpinot@junji.cl','Blanca Pinot Jara');
//   $mail->AddAddres('abarrientos@junji.cl','Alex Barrientos Quicel');
//   $mail->AddAddres('mmillanao@junji.cl','Marta Millanao Conejeros');
//   $mail->AddAddres('pduhalde@junji.cl','Pablo Duhalde Fuentes');
//   $mail->AddAddres('frosales@junji.cl','Fernando Rosales Morales ');

// }

if ($archivo1<>'') {
  // $archivo1="../../archivos/docargedo/".$archivo1;
  $mail->AddAttachment($destino); // attachment
}
if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
 // echo "Message sent!";
  echo "  <H3> CORREO ENVIADO SATISFACTORIAMENTE </H3>      ";
}        

}//FIN IF
}

echo "<script>location.href='facturasb.php?llave=1';</script>";
?>
