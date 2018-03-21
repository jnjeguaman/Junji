<?
session_start();
require("inc/config.php");
require("inc/querys.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$ori = $_POST["ori"];

$id=$_POST["id"];
$id1b=$_POST["id1b"];
$facfolio=$_POST["facfolio"];
$nroorden=$_POST["nroorden"];
$item=$_POST["item"];
$nroresolucion=$_POST["nroresolucion"];

$nroresolucion2 = $_POST["nroresolucion2"];
$nroresolucion3 = $_POST["nroresolucion3"];
$nroresolucion4 = $_POST["nroresolucion4"];
$nroresolucion5 = $_POST["nroresolucion5"];
$nroresolucion6 = $_POST["nroresolucion6"];

$idargedo2 = $_POST["idargedo2"];
$idargedo3 = $_POST["idargedo3"];
$idargedo4 = $_POST["idargedo4"];
$idargedo5 = $_POST["idargedo5"];
$idargedo6 = $_POST["idargedo6"];

$servicio=$_POST["servicio"];
$modalidad=$_POST["modalidad"];
$monto=$_POST["monto"];
$idargedo=$_POST["idargedo"];
$dos=$_POST["dos"];
$var1=$_POST["var1"];
$mail1=$_POST["mail1"];
$mail2=$_POST["mail2"];
$mail3=$_POST["mail3"];
$mail4=$_POST["mail4"];
$mail5=$_POST["mail5"];
$archivo1b=$_POST["archivo1"];

$eta_item2=$_POST["eta_item2"];
$eta_asig=$_POST["eta_asig"];
$eta_prog=$_POST["eta_prog"];

$oc_sc = $_POST["oc_sc"];

$urgencia = $_POST["eta_urgencia"];

$archivo1 = $_FILES["archivo1"]['name'];
$archivo2 = $_FILES["archivo2"]['name'];
$archivo3 = $_FILES["archivo3"]['name'];
$archivo4 = $_FILES["archivo4"]['name'];
$archivo5 = $_FILES["archivo5"]['name'];
$archivo6 = $_FILES["archivo6"]['name'];

$ant1 = $_FILES["ant1"]['name'];
$ant2 = $_FILES["ant2"]['name'];
$ant3 = $_FILES["ant3"]['name'];
$ant4 = $_FILES["ant4"]['name'];
$ant5 = $_FILES["ant5"]['name'];
$ant6 = $_FILES["ant6"]['name'];

$eta_obs = $_POST["eta_obs"];
// echo $ant1;

$oc_id = $_POST["oc_solicitud"];

// NIVEL DE URGENCIA
if($urgencia <> "")
{
    $sql = "UPDATE dpp_etapas SET eta_urgencia = ".$urgencia." WHERE eta_id = ".$id1b;
    mysql_query($sql);
}

if($oc_sc <> '')
{
$sql = "UPDATE compra_orden SET oc_sc = '".$oc_sc."' WHERE oc_id = ".$oc_id;
mysql_query($sql);
}

if($_POST["vb"] <> "")
{
    mysql_query("UPDATE dpp_etapas SET eta_tipo = '".$_POST["vb"]."' WHERE eta_id = '$var1'");
// if($_POST["vb"] == "SERVICIO")
// {
//  mysql_query("UPDATE dpp_etapas SET eta_dias = ".$_POST["dias"]." WHERE eta_id = '$id2'");
// }
}
$dos= $_SESSION["region"];

// if ($item<>"") {
//     $sql1="update dpp_etapas set eta_estado=3, eta_usu_aprobacion='$usuario', eta_fecha_aprobacion='$fechamia', eta_depto_aprobacion='$dos', eta_item='$item'  where eta_id=$var1 ";
// //            echo $sql1;
// //            exit();
//     mysql_query($sql1);
// }
if($item <> "")
{
    $sql1="update dpp_etapas set eta_item='$item'  where eta_id=$var1 ";
    mysql_query($sql1);
}

if($eta_obs <> "")
{
    mysql_query("UPDATE dpp_etapas SET eta_obs = '".$eta_obs."' WHERE eta_id = ".$id1b);
}
if($nroresolucion2 <> "")
{
    $sql2="update dpp_facturas set fac_res2='$nroresolucion2', fac_doc_id2='$idargedo2' where fac_id=$id ";
    mysql_query($sql2);
}

if($nroresolucion3 <> "")
{
    $sql2="update dpp_facturas set fac_res3='$nroresolucion3', fac_doc_id3='$idargedo3' where fac_id=$id ";
    mysql_query($sql2);
}

if($nroresolucion4 <> "")
{
    $sql2="update dpp_facturas set fac_res4='$nroresolucion4', fac_doc_id4='$idargedo4' where fac_id=$id ";
    mysql_query($sql2);
}

if($nroresolucion5 <> "")
{
    $sql2="update dpp_facturas set fac_res5='$nroresolucion5', fac_doc_id5='$idargedo5' where fac_id=$id ";
    mysql_query($sql2);
}
if($nroresolucion6 <> "")
{
    $sql2="update dpp_facturas set fac_res6='$nroresolucion6', fac_doc_id6='$idargedo6' where fac_id=$id ";
    mysql_query($sql2);
}
// exit;

$sql22="update dpp_facturas set fac_mail1='$mail1',fac_mail2='$mail2',fac_mail3='$mail3',fac_mail4='$mail4',fac_mail5='$mail5' where fac_id=$id ";
 //           echo $sql22;
//            exit();
mysql_query($sql22);

if ($nroorden<>"") {
    $sql2="update dpp_facturas set fac_nroorden='$nroorden' where fac_id=$id ";
//            echo $sql2;
    mysql_query($sql2);
    $sql2="update dpp_etapas set eta_nroorden='$nroorden' where eta_id=$id1b ";
//            echo $sql2;
    mysql_query($sql2);
}
if ($nroresolucion<>"") {
    $sql2="update dpp_facturas set fac_nroresolucion='$nroresolucion', fac_docs_id='$idargedo' where fac_id=$id ";
//            echo $sql2;
    mysql_query($sql2);
    $sql2="update dpp_etapas set eta_nroresolucion='$nroresolucion' where eta_id=$id1b ";
//            echo $sql2;
    mysql_query($sql2);
}
if ($servicio<>"") {
    $sql2="update dpp_facturas set fac_servicio='$servicio' where fac_id=$id ";
            //echo $sql2."<br>";
    mysql_query($sql2);
    $sql2="update dpp_etapas set eta_servicio_final='$servicio' where eta_id=$id1b ";
            //echo $sql2."<br>";
    mysql_query($sql2);

    $sql1b=str_replace("'","''",$sql2);
    $sql2="insert into log (obs,          user,      fecha,           hora,           modulo,                 relacion)
    values ('$servicio, $sql1b', '$usuario', '$fechamia',    '$hora'        ,'grabafacturarchivo.php (servicio)', '$id1b') ";
           // echo "<br>".$sql2;
           // exit();
    mysql_query($sql2);

}

if ($modalidad<>"") {
    $sql2="update dpp_facturas set fac_modalidad='$modalidad' where fac_id=$id ";
//            echo $sql2;
    mysql_query($sql2);
    $sql2="update dpp_etapas set eta_modalidad='$modalidad' where eta_id=$id1b ";
//            echo $sql2;
    mysql_query($sql2);
}
if ($monto<>"") {
    $sql2="update dpp_facturas set fac_monto='$monto' where fac_id=$id ";
 //           echo $sql2;

    mysql_query($sql2);
    $sql2="update dpp_etapas set eta_monto='$monto' where eta_id=$id1b ";
//            echo $sql2;
//            exit();
    mysql_query($sql2);
}

// if ($item==21) {
//     mysql_query($sql2);
//     $sql2="update dpp_etapas set eta_estado=5 where eta_id=$id1b ";
// //            echo $sql2;
// //            exit();
//     mysql_query($sql2);

// }




if ($archivo1 != "") {
    $archivo1=$annomia."/FAC".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        // $destino =  "../../archivos/docfac/".$annomia."/".$archivo1;
    mkdir("../../archivos/docfac/".$annomia,0777,true);
    $destino =  "../../archivos/docfac/".$archivo1;
    if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo1."</b>";
        $sql2="update dpp_facturas set fac_archivo='$archivo1' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);


    }
}
if ($archivo2 != "") {
    $archivo2=$annomia."/ORD".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        // $destino =  "../../archivos/docfac/".$annomia."/".$archivo2;
    $destino =  "../../archivos/docfac/".$archivo2;
    if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo2."</b>";
        $sql2="update dpp_facturas set fac_doc1='$archivo2' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);


    }
}
if ($archivo3 != "") {
    $archivo3=$annomia."/RC".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        // $destino =  "../../archivos/docfac/".$annomia."/".$archivo3;
    $destino =  "../../archivos/docfac/".$archivo3;
    if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo3."</b>";
        $sql2="update dpp_facturas set fac_doc2='$archivo3' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}

if ($archivo4 != "") {
    $archivo4=$annomia."/OTRO".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
    $destino =  "../../archivos/docfac/".$archivo4;
    if (copy($_FILES['archivo4']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo4."</b>";
        $sql2="update dpp_facturas set fac_doc3='$archivo4' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}

if ($archivo5 != "") {
    $extension = strtoupper(pathinfo($archivo5,PATHINFO_EXTENSION));
    $archivo5 = "doc".$annomia."/sccompra/SC".$regionsession."_".$_POST["oc_numero_oc"]."_".$annomia.".".$extension;
    mkdir("../../archivos/docfac/doc".$annomia."/sccompra",0777,true);
        // guardamos el archivo a la carpeta files
    $destino =  "../../archivos/docfac/".$archivo5;
    if (copy($_FILES['archivo5']['tmp_name'],$destino)) {
            // $status = "Archivo subido: <b>".$archivo4."</b>";
            // $sql2="update dpp_facturas set fac_doc3='$archivo4' where fac_id=$id ";
        $sql2 = "UPDATE compra_orden SET oc_solicitud_archivo = '".$archivo5."' WHERE oc_id = ".$_POST["oc_solicitud"];

        mysql_query($sql2);

    }
}

if ($archivo6 != "") {
    $extension = strtoupper(pathinfo($archivo6,PATHINFO_EXTENSION));
    $archivo6 = "doc".$annomia."/occompromiso/CC".$regionsession."_".$_POST["oc_numero_oc"]."_".$annomia."_".$id1b.".".$extension;
    mkdir("../../archivos/docfac/doc".$annomia."/occompromiso",0777,true);
        // guardamos el archivo a la carpeta files
    $destino =  "../../archivos/docfac/".$archivo6;
    if (copy($_FILES['archivo6']['tmp_name'],$destino)) {
            // $status = "Archivo subido: <b>".$archivo4."</b>";
            // $sql2="update dpp_facturas set fac_doc3='$archivo4' where fac_id=$id ";
       // $sql2 = "UPDATE compra_orden SET oc_compromiso_archivo = '".$archivo6."' WHERE oc_id = ".$_POST["oc_solicitud"];
        $sql2 = "UPDATE dpp_etapas SET eta_compromiso_archivo = '".$archivo6."' WHERE eta_id = ".$id1b;
        mysql_query($sql2);
    }
}

if ($ant1 != "") {
    $extension = strtoupper(pathinfo($ant1,PATHINFO_EXTENSION));
    $ant1="ant1_".$regionsession."_".$facfolio."_".$annomia.".".$extension;
        // guardamos el archivo a la carpeta files
    $ruta="../../archivos/docfac/".$annomia."/".$regionsession."/";
    mkdir($ruta,0777,true);
    $destino =  "../../archivos/docfac/".$annomia."/".$regionsession."/".$ant1;
    if (copy($_FILES['ant1']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo4."</b>";
        $sql2="update dpp_facturas set fac_ant1='$ant1', fac_ruta1='$ruta' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}
if ($ant2 != "") {
    $ant2="ant2_".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
    $ruta="../../archivos/docfac/".$annomia."/";
    mkdir($ruta,0777,true);
    $destino =  "../../archivos/docfac/".$annomia."/".$ant2;
    if (copy($_FILES['ant2']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo4."</b>";
        $sql2="update dpp_facturas set fac_ant2='$ant2', fac_ruta2='$ruta' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}
if ($ant3 != "") {
    $ant3="ant3_".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
    $ruta="../../archivos/docfac/".$annomia."/";
     mkdir($ruta,0777,true);
    $destino =  "../../archivos/docfac/".$annomia."/".$ant3;
    if (copy($_FILES['ant3']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo4."</b>";
        $sql2="update dpp_facturas set fac_ant3='$ant3', fac_ruta3='$ruta' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}
if ($ant4 != "") {
    $ant4="ant4_".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
    $ruta="../../archivos/docfac/".$annomia."/";
     mkdir($ruta,0777,true);
    $destino =  "../../archivos/docfac/".$annomia."/".$ant4;
    if (copy($_FILES['ant4']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo4."</b>";
        $sql2="update dpp_facturas set fac_ant4='$ant4', fac_ruta4='$ruta' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}
if ($ant5 != "") {
    $ant5="RT_".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
    $ruta="../../archivos/docfac/".$annomia."/";
     mkdir($ruta,0777,true);
    $destino =  "../../archivos/docfac/".$annomia."/".$ant5;
    if (copy($_FILES['ant5']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo4."</b>";
        $sql2="update dpp_facturas set fac_ant5='$ant5', fac_ruta5='$ruta' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}
if ($ant6 != "") {
    $ant6="ant6_".$regionsession."_".$facfolio."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
    $ruta="../../archivos/docfac/".$annomia."/";
     mkdir($ruta,0777,true);
    $destino =  "../../archivos/docfac/".$annomia."/".$ant6;
    if (copy($_FILES['ant6']['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo4."</b>";
        $sql2="update dpp_facturas set fac_ant6='$ant6', fac_ruta6='$ruta' where fac_id=$id ";
//            echo $sql2;
        mysql_query($sql2);

    }
}

if($eta_item2 <> "")
{
    mysql_query("update dpp_etapas set eta_item2='$eta_item2'  where eta_id=$var1");
}

if($eta_asig <> "")
{
    mysql_query("update dpp_etapas set eta_asig='$eta_asig'  where eta_id=$var1");
}

if($eta_prog <> "")
{
    mysql_query("update dpp_etapas set eta_prog='$eta_prog'  where eta_id=$var1");
}
// if ($item==21) {
//  $sql1="update dpp_etapas set eta_estado=5  where eta_id=$var1 ";
//  mysql_query($sql1);
// }


//        exit();
if($ori == 1)
{
echo "<script>location.href='verdevueltos2.php';</script>";
}else{
echo "<script>location.href='facturasarchivos.php?llave=1&id=".$id."&id1b=".$id1b."';</script>";
}

?>


