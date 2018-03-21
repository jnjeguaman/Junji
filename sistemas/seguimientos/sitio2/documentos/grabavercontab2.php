<?
session_start();
require("../inc/config.php");
require("../inc/querys.php");
$fechamia=date('Y-m-d');
$usuario=$_SESSION["nom_user"];
if($_SESSION["nom_user"] =="" ){
	?><script language="javascript">location.href='sesion_perdida.php';</script><?
}

$id=$_POST["id"];
$id2=$_POST["id2"];
$id1b=$_POST["id1b"];
$nroorden=$_POST["nroorden"];
$nroresolucion=$_POST["nroresolucion"];
$servicio=$_POST["servicio"];
$modalidad=$_POST["modalidad"];
$dos=$_POST["dos"];
$var1=$_POST["var1"];
$mail1=$_POST["mail1"];
$mail2=$_POST["mail2"];
$mail3=$_POST["mail3"];
$mail4=$_POST["mail4"];
$mail5=$_POST["mail5"];
$eta_numero=$_POST["eta_numero"];
$eta_negreso=$_POST["eta_negreso"];
$eta_folio=$_POST["eta_folio"];
$eta_tipo_doc=$_POST["eta_tipo_doc"];


if ($eta_tipo_doc=='Factura')
  $pre="PF";
if ($eta_tipo_doc=='Honorario')
  $pre="PH";


$archivo1 = $_FILES["archivo1"]['name'];
$archivo2 = $_FILES["archivo2"]['name'];
$archivo3 = $_FILES["archivo3"]['name'];

  echo "----".$archivo1;

  

    if ($archivo1 != "") {
        $archivo1=$pre."_".$eta_numero."_".$eta_negreso.".PDF";
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
            $sql2="update dpp_etapas set eta_archivorecibo ='$archivo1' where eta_id=$id2 ";
            echo $sql2;

            mysql_query($sql2);

            
        }
    }
    
//  exit();

    if ($archivo2 != "") {
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo2;
        if (copy($_FILES['archivo2']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo2."</b>";
            $sql2="update dpp_facturas set fac_doc1='$archivo2' where fac_id=$id ";
//            echo $sql2;
//            mysql_query($sql2);


        }
    }
    if ($archivo3 != "") {
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo3;
        if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo3."</b>";
            $sql2="update dpp_facturas set fac_doc2='$archivo3' where fac_id=$id ";
//            echo $sql2;
//            mysql_query($sql2);

        }
    }


       // exit();
echo "<script>location.href='../verdoc2contab.php?llave=1&id=$id&id2=$id2';</script>";


?>


