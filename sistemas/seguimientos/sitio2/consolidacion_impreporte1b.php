<?php
//$id2=$_GET["id2"];
//echo "hola";
    ob_start();
    ob_implicit_flush(0);
    require('consolidacion_impreporte1.php');
    $html= ob_get_clean();

//se incluye la libreria de dompdf
require_once("dompdf/dompdf_config.inc.php");
//Obtenemos codigo HTML pasado por el form
//se crea una nueva instancia al DOMPDF
$dompdf = new DOMPDF();
//se carga el codigo html
$dompdf->load_html($html);
//aumentamos memoria del servidor si es necesario
ini_set("memory_limit","128M");
//lanzamos a render
$dompdf->render();
//guardamos a PDF
$archivo = "CONCILIACION_1_".$_GET["numero"]."_".$_GET["mesp"]."_".$_GET["annop"].".pdf";
mkdir("../../archivos/docconciliacion/respaldo/".$_GET["annop"]."/".$_GET["mesp"],0777,true);
$dompdf->stream($archivo);
file_put_contents("../../archivos/docconciliacion/respaldo/".$_GET["annop"]."/".$_GET["mesp"]."/".$archivo, $dompdf->output());
//    exit();
?>