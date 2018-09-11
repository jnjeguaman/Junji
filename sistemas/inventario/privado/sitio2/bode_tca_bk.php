<?php
//$id2=$_GET["id2"];
//$id=$_GET["id"];
//$tipo=$_GET["tipo"];
$anno=date('Y');

    ob_start();
    ob_implicit_flush(0);
    require('bode_tc.php');
    $html= ob_get_clean();
//se incluye la libreria de dompdf
require_once("dompdf/dompdf_config.inc.php");
//Obtenemos codigo HTML pasado por el form
//se crea una nueva instancia al DOMPDF
$dompdf = new DOMPDF();
//se carga el codigo html
$dompdf->load_html($html);
//aumentamos memoria del servidor si es necesario
ini_set("memory_limit","32M"); 
//lanzamos a render
$dompdf->render();
//guardamos a PDF
$pdf=$dompdf->stream("guiatecnica_".$numguia.".pdf");
$pdf = $dompdf->output();
//file_put_contents("documentoscaducado/archivo222.pdf", $pdf);

/*
if ($tipo=='Arriendo' or $tipo=='Consumos Basicos' or $tipo=='Reembolso'  ) {
   $archivo1="OC2_".$regionsession."_".$id."_".$anno.".PDF";
   
   $sql1="update compra_orden set oc_archivo='$archivo1' where oc_id='$id' ";
// echo $sql1;
// exit();
//   mysql_query($sql1);

// $pdf = $dompdf->output();
   $archivonombre="../../archivos/docfac/".$archivo1;
   file_put_contents($archivonombre, $pdf);

}
*/





?>