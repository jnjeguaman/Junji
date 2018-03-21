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

if (1==1) {

$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
$numerooc=$numerooc1."-".$numerooc2."-".$numerooc3;

if ($archivo1<>'') {
   $archivo1="OC".$regionsession."_".$numerooc."_".$annomia.".PDF";
}
if ($archivo2<>'') {
   $archivo2="RES".$regionsession."_".$numerooc."_".$annomia.".PDF";
}

list($tipo2, $tipo2nn) = split('/', $tipo2);

$sql="INSERT INTO compra_orden (oc_numero,      oc_tipo,    oc_modalidad, oc_ccosto, oc_rut, oc_dig, oc_rsocial, oc_direccion, oc_fono, oc_monto, oc_moneda, oc_obs, oc_fechacompra, oc_fechaentrega, oc_compra_id, oc_fechasis, oc_user, oc_region, oc_archivo, oc_nombre, oc_estado, oc_fechalic, oc_nroresolucion, oc_archivores, oc_orden )
                        VALUES (upper('$numerooc'), '$tipo2b', '$estados2', '$tipo2', '$rut',   '$dig', upper('$nombre'), '$direccion','$telefono', '$monto', '$moneda', upper('$obs'), '$fecha1', '$fecha2',          '$estados', '$fechamia', '$usuario', '$region', '$archivo1', '$nombreoc', '$estado22', '$fecha2', '$nroresolucion', '$archivo2', '$numerooc2');";
//echo $sql;
//exit();
mysql_query($sql);



    if ($archivo1 != "") {
        $archivo1="OC".$regionsession."_".$numerooc."_".$annomia.".PDF";
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
        $archivo2="RES".$regionsession."_".$numerooc."_".$annomia.".PDF";
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


$sql="INSERT INTO compra_detorden (detorden_oc_id, detorden_ccosto, detorden_plan, detorden_monto, detorden_fecha)
                           VALUES ('$id',           '$tipo2',        '$estados',      '$monto'     ,'$fechamia');";
//echo $sql;
//exit();
mysql_query($sql);

//echo $id;

}
//exit();

//echo "<script>location.href='compra_ordenb.php?id=$id';</script>";
echo "<script>location.href='compra_orden.php';</script>";

?>



