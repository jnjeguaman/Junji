<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionSession = $_SESSION["region"];




$id=$_POST["id"];
$id2=$_POST["id2"];
$item=$_POST["item"];
$fecha1=$_POST["fecha1"];
$fecha2=$_POST["fecha2"];
$fecha3=$_POST["fecha3"];
$servicio=$_POST["servicio"];
$monto=$_POST["monto"];
$monto2=$_POST["monto2"];
$iva=$_POST["iva"];
$neto=$_POST["neto"];
$impuesto1=$_POST["impuesto1"];
$impuesto2=$_POST["impuesto2"];
$tipodoc3=$_POST["tipodoc3"];
$exento=$_POST["exento"];
$swfreserva=$_POST["swfreserva"];
$freserva=$_POST["freserva"];
$montonuevo=$_POST["montonuevo"];
$confa_cont_id=$_POST["confa_cont_id"];
$etarut=$_POST["etarut"];

$eta_fdevengo = $_POST["eta_fdevengo"];
$fac_nro_contable = $_POST["fac_nro_contable"];
$fac_devengo_archivo = $_POST["fac_devengo_archivo"];
$annio = date("Y");
$ori = $_POST["ori"];
// print_r($_FILES["fac_devengo_archivo"]);

if($eta_fdevengo <> "")
{
    $sql = "update dpp_etapas SET eta_fdevengo = '".$eta_fdevengo."' WHERE eta_id = '".$id2."'";
    // echo $sql."<br>";
    mysql_query($sql);
}

if($fac_nro_contable <> "")
{
  $sql2 = "UPDATE dpp_facturas SET fac_nro_contable = '".$fac_nro_contable."' WHERE fac_eta_id = ".$id2;
  mysql_query($sql2);
}
// COMPROBANTE DE DEVENGO
if ($_FILES["fac_devengo_archivo"]["name"] != "") {

        $archivo6="DEVENGO_".$fac_nro_contable."_".$id2."_".$id."_".$annio.".PDF";
        // guardamos el archivo a la carpeta files
        mkdir("../../archivos/docfac/".$annio."/".$regionSession,0777,true);
        $ruta = $annio."/".$regionSession."/".$archivo6;
        $destino =  "../../archivos/docfac/".$annio."/".$regionSession."/".$archivo6;
        if (copy($_FILES['fac_devengo_archivo']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo6."</b>";
            $sql2="update dpp_facturas SET fac_devengo_archivo = '".$ruta."', fac_nro_contable = '".$fac_nro_contable."' WHERE fac_eta_id = '".$id2."'";
            // echo $sql2;
            mysql_query($sql2);
        }
//        exit();
    }
// FIN


if ($swfreserva==1) {
   $sql1="delete from dpp_fondoreserva where fres_eta_id=$id2 ";
//     echo $sql1."<br>";
//     exit();
   mysql_query($sql1);

  $fresmes= substr($fecha1,3,2);
  $fresanno= substr($fecha1,6,4);
  
   $sql1="INSERT INTO  dpp_fondoreserva (fres_cont_id, fres_eta_id, fres_monto, fres_user, fres_fechasys, fres_rut, fres_mes, fres_anno, fres_tipo)
                                 VALUES ('$confa_cont_id', '$id2',  '$freserva', '$usuario', '$fechamia', '$etarut', '$fresmes', '$fresanno', 'abono') ";
//     echo $sql1."<br>";
//     exit();
   mysql_query($sql1);
   
   $monto2=$montonuevo;

}



$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);



//echo "--->".$id2;
   if ($id2<>"" ) {
      $sql1="update dpp_etapas set eta_item='$item',  eta_fecha_aprobacionok='$fecha1', eta_servicio_final='$servicio', eta_monto='$monto2', eta_monto2='$monto', eta_iva='$iva', eta_neto='$neto', eta_impuesto1='$impuesto1', eta_exento='$exento', eta_impuesto2='$impuesto2', eta_tipo_doc3='$tipodoc3', eta_tipo_doc2='$tipodoc3', eta_fecha_recepcion='$fecha2', eta_fecha_fac='$fecha3', eta_freserva='$freserva'  where eta_id=$id2 ";
//     echo $sql1."<br>";
//     exit();
       mysql_query($sql1);

      $sql1="update dpp_facturas set fac_monto='$monto', fac_fecha_recepcion='$fecha2', fac_fecha_fac='$fecha3', fac_tipo_doc='$tipodoc3' where fac_id=$id ";
//     echo $sql1;
       mysql_query($sql1);

       $sql2 = "SELECT * FROM dpp_etapas WHERE eta_id = '$id2' ";
        $res2 = mysql_query($sql2);
        while($row2 = mysql_fetch_array($res2)){
          $devengo=$row2["eta_fdevengo"];
            $negreso=$row2["eta_num_egreso"];
            $fegreso=$row2["eta_fecha_egreso"];
            $doc3=$row2["eta_tipo_doc3"];
            
            
        }
        if ($devengo != "" && $devengo != null && $negreso > "0" && $fegreso != "0000-00-00" && $doc3 != "" && $doc3 != null) {
                            
            $sql3="update dpp_etapas set eta_usu_recepcion22='$usuario', eta_fecha_recepcion3='$fechamia'  where eta_id=$id2 ";
            //echo $sql3;
            mysql_query($sql3);
        }
   }


//    exit();

// echo "<script>location.href='verdocedit.php?llave=1&id2=$id2';</script>";
   // echo "<script>location.href='valida5.php';</script>";
   if($ori == 1)
   {
    echo "<script>window.location.href='valida5.php'</script>";
   }else if($ori == 2){
    echo "<script>window.location.href='verdevueltos3.php'</script>";
   }else{

    echo "<script>window.location.href='contabilidad_devengo.php'</script>";
   }








?>


