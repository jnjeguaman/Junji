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

if ($id<>'') {

  $archivo1="OC".$regionsession."_".$numerooc."_".$annomia.".PDF";

  if ($tipo2<>'' and $estados<>'') {
     $sql="update compra_orden set oc_ccosto='$tipo2', oc_compra_id='$estados' where oc_id=$id";
     //echo $sql;
     //exit();
     mysql_query($sql);
  }

  if ($estado<>'') {
     $sql="update compra_orden set oc_estado='$estado' where oc_id=$id";
     //echo $sql;
     //exit();
     mysql_query($sql);
  }


  if ($archivo1 != "") {
     $archivo1="OC".$regionsession."_".$numerooc."_".$annomia.".PDF";
     // guardamos el archivo a la carpeta files
     $destino =  "../../archivos/docfac/".$archivo1;
     if (copy($_FILES["archivo1"]['tmp_name'],$destino)) {
        $status = "Archivo subido: <b>".$archivo1."</b>";
        $sql2="update compra_orden set oc_archivo='$archivo1' where oc_id=$id ";
//        echo $sql2;
        mysql_query($sql2);
     }
  }


}
//exit();

if ($ori==1) {
  echo "<script>location.href='compra_fichaorden.php?llave=1&id=$id';</script>";
}
if ($ori==2) {
  echo "<script>location.href='compra_fichaorden3.php?llave=1&id=$id';</script>";
}



?>


