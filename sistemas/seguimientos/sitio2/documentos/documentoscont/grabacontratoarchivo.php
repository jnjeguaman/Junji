<?
session_start();
require("../inc/config.php");
require("../inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
$regionsession = $_SESSION["region"];
$annomia=date('Y');
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$id=$_POST["id"];
$id1b=$_POST["id1b"];
$nroorden=$_POST["nroorden"];
$nroresolucion=$_POST["nroresolucion"];
$servicio=$_POST["servicio"];
$modalidad=$_POST["modalidad"];

$archivo1 = $_FILES["archivo1"]['name'];
$archivo2 = $_FILES["archivo2"]['name'];
$archivo3 = $_FILES["archivo3"]['name'];

echo "----".$archivo1;
//exit();
    

    if ($archivo1 != "") {
        // guardamos el archivo a la carpeta files
        $archivo1="Ord".$regionsession."_".$id."_".$annomia.".PDF";
        $destino =  "../../../archivos/docfac/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update dpp_contratos set cont_doc1='$archivo1' where cont_id=$id ";
//            echo $sql2;
//            exit();
            mysql_query($sql2);

            
        }
    }
    if ($archivo2 != "") {
        // guardamos el archivo a la carpeta files
        $archivo2="Res".$regionsession."_".$id."_".$annomia.".PDF";
        $destino =  "../../../archivos/docfac/".$archivo2;
        if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo2."</b>";
            $sql2="update dpp_contratos set cont_doc2='$archivo2' where cont_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

            
        }
    }
    if ($archivo3 != "") {
        // guardamos el archivo a la carpeta files
        $archivo3="Res".$regionsession."_".$id."_".$annomia.".PDF";
        $destino =  "../../../archivos/docfac/".$archivo3;
        if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo3."</b>";
            $sql2="update dpp_contratos set cont_doc3='$archivo3' where cont_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

        }
    }


       // exit();
echo "<script>location.href='../vercontrato2.php?llave=1&id2=".$id."';</script>";


?>


