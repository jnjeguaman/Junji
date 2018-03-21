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
$fecha1= substr($fecha1,6,4)."-".substr($fecha1,3,2)."-".substr($fecha1,0,2);
if ($tipo2<>'' and $documento<>'') {

list($tipo2, $tipo2nn) = split('/', $tipo2);



$sql="INSERT INTO compra_detorden (detorden_oc_id, detorden_ccosto, detorden_plan, detorden_monto, detorden_fecha)
                           VALUES ('$id',           '$tipo2',        '$documento',      '$monto'     ,'$fechamia');";
//echo $sql."<br>";
//exit();
mysql_query($sql);


}

if ($archivo1 != "") {
        $archivo1="doc".$annomia."/ocompra/OC".$regionsession."_".$numerooc."_".$annomia.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../archivos/docfac/".$archivo1;
        if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update compra_orden set oc_archivo='$archivo1' where oc_id=$id ";
//            echo $sql2;
            mysql_query($sql2);


        }
}

if ($monto2<>'') {
   $sql="update compra_orden set oc_monto='$monto2',  oc_fechacompra='$fecha1', oc_obs='$obs', oc_estado='$estado22' where oc_id='$id' ";
//   echo $sql."<br>";
//  exit();
   mysql_query($sql);
}

if ($tipo2b<>'' and $estados2<>'') {
   $sql="update compra_orden set oc_tipo='$tipo2b',    oc_modalidad='$documento2' where oc_id='$id' ";
//   echo $sql."<br>";
   //exit();
   mysql_query($sql);


}
//exit();

echo "<script>location.href='compra_ordenb.php?id=$id';</script>";


?>


