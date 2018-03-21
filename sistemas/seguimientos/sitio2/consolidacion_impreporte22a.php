<?php
//$id2=$_GET["id2"];
//echo "hola";
    ob_start();
    ob_implicit_flush(0);
    require('consolidacion_impreporte22.php');
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
// $dompdf->stream("ANEXO_2_".$numero."_".$mesp."_".$annop.".pdf");
$archivo = "ANEXO_2_".$numero."_".$mesp."_".$annop.".pdf";
$dompdf->stream($archivo);
file_put_contents("../../archivos/docconciliacion/respaldo/".$annop."/".$mesp."/".$archivo, $dompdf->output());
//    exit();
?>