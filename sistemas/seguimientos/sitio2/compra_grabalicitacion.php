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
if ($archivo1<>'') {
        $archivo1="LIC_".$regionsession."_".$numero."_".$annomia.".PDF";
}

if ($nombre<>'') {
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
   $sql="INSERT INTO compra_licitacion (lici_numero, lici_nombre, lici_region, lici_fechapub, lici_fechaadju, lici_archivo, lici_estado)
                                VALUES ('$numero',   '$nombre',    '$region',     '$fecha1',     '$fecha2',   '$archivo1', '$estado')";
//   echo $sql;
//   exit();
   mysql_query($sql);
   
   

    if ($archivo1 != "") {
        $archivo1="LIC_".$regionsession."_".$numero."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docfac/".$archivo1;
        if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
//            $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";
//            echo $sql2;
//            mysql_query($sql2);


        }
    }




}
//exit();


  echo "<script>location.href='compra_licitacion.php?llave=1&id=$id';</script>";




?>


