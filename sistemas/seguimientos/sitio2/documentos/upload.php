<?
$status = "";
//if ($_POST["action"] == "upload") {
    // obtenemos los datos del archivo
    $tamano = $_FILES["archivo1"]['size'];
    $tipo = $_FILES["archivo1"]['type'];
    $archivo1 = $_FILES["archivo1"]['name'];
//    $prefijo = substr(md5(uniqid(rand())),0,6);

    if ($archivo1 != "") {
        // guardamos el archivo a la carpeta files
        $destino =  "../../../archivos/docfac/".$archivo;
        if (copy($_FILES['archivo1']['tmp_name'],$destino)) {
            $status = "Archivo subido: <b>".$archivo1."</b>";
        } else {
            $status = "Error al subir el archivo";
        }
    } else {
        $status = "Error al subir archivo";
    }
}
?>
