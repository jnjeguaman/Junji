<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];

extract($_POST);
$archivo1 = $_FILES["archivo1"]['name'];
if ($rut<>"" ) {

  $fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
  $fecha2=$dia."-".$mesanno;
  $fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

  /** VALIDACION FECHA SEGUN PERIODO EN CURSO **/
  $fecha_a_validar = explode("-", $fecha2);

  $annio = $fecha_a_validar[0];
  $mes = $fecha_a_validar[1];
  $dia = $fecha_a_validar[2];

  // Comprueba la validez de una fecha formada por los argumentos. Una fecha se considera válida si cada parámetro está propiamente definido.
  if(!checkdate($mes, $dia, $annio)){
    echo "<script>location.href='facturafondofijo.php?llave=2';</script>";
    exit;
  }

  /** FIN VALIDACION **/


  $archivo1="FFFAC".$regionsession."_".$rut."_".$nrofactura.".PDF";
  $sql1="INSERT INTO ff_factura (fffac_tipo, fffac_region, fffac_numero, fffac_fechadoc, fffac_rut, fffac_dig, fffac_nombre, fffac_exento, fffac_neto, fffac_iva, fffac_combustible, fffac_otro, fffac_total, fffac_caja, fffac_responsable, fffac_servicio, fffac_fecharendicion,fffac_user,fffac_fechasis,fffac_idtesoreria,fffac_nrocheque)
  VALUES ('$tipodoc3', '$regionsession', '$nrofactura', '$fecha1', '$rut', '$dig', '$nombre',       '$exento', '$neto', '$iva',  '$impuesto1',        '$impuesto2', '$monto', '$caja', '$responsable', '$obs', '$fecha2', '$usuario','$fechamia','$idtesoreria','$nrocheque' )";
//      echo $sql1."(2)<br>";
//      exit();
  mysql_query($sql1);

  if ($archivo1 != "") {
    $archivo1="FFFAC".$regionsession."_".$rut."_".$nrofactura.".PDF";
        // guardamos el archivo a la carpeta files
    $destino =  "documentosfffac/".$archivo1;
    if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
      $status = "Archivo subido: <b>".$archivo1."</b>";
//            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";
//            echo $sql2;
//            mysql_query($sql2);


    }
  }





}
//exit();
echo "<script>location.href='facturafondofijo.php?llave=1';</script>";


?>


