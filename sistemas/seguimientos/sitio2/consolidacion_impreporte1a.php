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
$dompdf->stream("conciliacionreporte1.pdf");
//    exit();
?>
