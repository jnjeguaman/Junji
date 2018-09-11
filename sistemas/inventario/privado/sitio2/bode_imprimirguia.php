<?php
ob_start();
ob_implicit_flush(0);
require_once("bode_guia_despacho.php");
$html= ob_get_clean();
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html($html);
ini_set("memory_limit","32M"); 
$dompdf->render();
$dompdf->stream("guiadespacho.pdf");
?>