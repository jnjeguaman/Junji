<?php
ini_set("max_execution_time", 600);
ini_set("memory_limit", "1024M");
header('Content-type: text/plain; charset=utf-8');
session_start();
extract($_POST);
$porcentaje = 90;
ob_start();
ob_implicit_flush(0);
if($tipoDCTO == "pmural")
{
	require("pmural/index.php");
}else if($tipoDCTO == "certificado")
{
	require("certificado/index.php");
}
$html= ob_get_clean();

//se incluye la libreria de dompdf
require_once("../dompdf/dompdf_config.inc.php");
//Obtenemos codigo HTML pasado por el form
//se crea una nueva instancia al DOMPDF
$dompdf = new DOMPDF();
//se carga el codigo html
$dompdf->load_html($html);
//aumentamos memoria del servidor si es necesario
ini_set("memory_limit","4096M");
//lanzamos a render
$dompdf->render();
//guardamos a PDF
$dompdf->stream("DOCUMENTO.pdf",array('Attachment'=>0));
//    exit();
?>