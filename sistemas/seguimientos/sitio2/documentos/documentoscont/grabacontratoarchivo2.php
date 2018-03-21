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
$id1b=$_POST["id1b"];
$fecha2=$_POST["fecha2"];
$fecha3=$_POST["fecha3"];
$fecha3= substr($fecha3,6,4)."-".substr($fecha3,3,2)."-".substr($fecha3,0,2);
$fecha2= substr($fecha2,6,4)."-".substr($fecha2,3,2)."-".substr($fecha2,0,2);

$anual=$_POST["anual"];
$moneda1=$_POST["moneda1"];
$descripcion=$_POST["descripcion"];


$archivo1 = $_FILES["archivo1"]['name'];
$archivo2 = $_FILES["archivo2"]['name'];
$archivo3 = $_FILES["archivo3"]['name'];

//echo "----".$archivo1;
//exit();
    

    if ($archivo1 != "") {
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo1;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
             $sql2="insert into dpp_contratoanexo (contanexo_cont_id, contanexo_inicio, contanexo_termino, contanexo_monto, contanexo_moneda, contanexo_descip, contanexo_archivo)
                                                  values ('$id','$fecha2','$fecha3','$anual','$moneda1','$descripcion','$archivo1')";
            //$sql2="update dpp_contratoanexo  set cont_doc1='$archivo1' where cont_id=$id ";
//            echo $sql2;
//            exit();
            mysql_query($sql2);

            
        }
    }
    if ($archivo2 != "") {
        // guardamos el archivo a la carpeta files
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
        $destino =  "../../../archivos/docfac/".$archivo3;
        if (copy($_FILES['archivo3']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo3."</b>";
            $sql2="update dpp_contratos set cont_doc3='$archivo3' where cont_id=$id ";
//            echo $sql2;
            mysql_query($sql2);

        }
    }


       // exit();
echo "<script>location.href='../anexocontrato.php?llave=1&id2=".$id."';</script>";


?>


