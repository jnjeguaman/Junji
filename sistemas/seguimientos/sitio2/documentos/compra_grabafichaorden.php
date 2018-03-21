<?
session_start();
require("../inc/config.php");
require("../inc/querys.php");
$fechamia=date('Y-m-d');
$annomia=date('Y');
$hora=date("h:i:s");
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$id=$_POST["id"];
$estado=$_POST["estado"];
$ocnumero=$_POST["ocnumero"];
$archivo1 = $_FILES["archivo1"]['name'];


if ($estado<>"") {
       $sql2="update compra_orden set oc_estado='$estado' where oc_id=$id ";
     echo $sql2;
       mysql_query($sql2);
}

if ($archivo1 != "") {
   $archivo1="ORD".$regionsession."_".$ocnumero."_".$annomia.".PDF";
   // guardamos el archivo a la carpeta files
   $destino =  "../../../archivos/docfac/".$archivo1;
   if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
      $status = "Archivo subido: <b>".$archivo1."</b>";
      $sql2="update compra_orden set oc_archivo='$archivo1' where oc_id=$id ";
    echo $sql2;
      mysql_query($sql2);
   }
}



//exit();
echo "<script>location.href='../facturasarchivos.php?llave=1&id=".$id."';</script>";


?>


