<?php
session_start();
require("inc/config.php");
require_once('TCPDF-master/tcpdf.php');
$guia=$_GET["guia"];
$regionsession = $_SESSION["region"];


$sql2="SELECT * FROM argedo_doc_internos WHERE inte_region='$regionsession' AND inte_numguia='$guia' AND inte_estado='1' GROUP BY inte_numguia ORDER BY inte_numguia DESC";
//echo $sql2;
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);

$destinatario2=$row2["inte_destinatario2"];
//$observacion=$row2["inte_observacion"];
$fechaguia=$row2["inte_fechaguia"];
$region=$row2["inte_region"];

$sql22="SELECT nombre FROM regiones WHERE orden='$region'";
$result22=mysql_query($sql22);
$row22=mysql_fetch_array($result22);
$nombreregion =$row22["nombre"];
$fechaguia=substr($fechaguia,8,2)."-".substr($fechaguia,5,2)."-".substr($fechaguia,0,4);

$dia=substr($row2["inte_fechaguia"],8,2);
$mes=substr($row2["inte_fechaguia"],5,2);
$anno=substr($row2["inte_fechaguia"],0,4);

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SIGEJUN');
$pdf->SetTitle('GUIA DE DESPACHO - CORRESPONDENCIA INTERNA');
$pdf->SetSubject('GUIA DE DESPACHO - CORRESPONDENCIA INTERNA');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
  require_once(dirname(__FILE__).'/lang/eng.php');
  $pdf->setLanguageArray($l);
}

$pdf->SetPrintHeader(false);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 8);

// add a page

$pdf->AddPage();
$pdf->Ln(-22);

// ENCABEZADO
$html.='

<table border="0" width="100%">

  <tr>
  <td width="20%"><img src="images/junji_logo.png" style="width:130px;"></td>

    <td width="60%">
    <br>
     <br>
     <br>
     <br>  
      <table border="0" width="100%">
        <tr>
          <td width="15%"></td>
          <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">GU&Iacute;A DE DESPACHO</td>
          <td width="15%"></td>
        </tr>

        <tr>
          <td width="15%"></td>
          <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;"> CORRESPONDENCIA INTERNA</td>
          <td width="15%"></td>
        </tr>

        <tr>
          <td width="15%"></td>
          <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">N&deg; '.$_GET["guia"].'</td>
          <td width="15%"></td>
        </tr>
      </table>
    </td>

    <td width="20%"></td>
  </tr>

  

</table>';


// DESTINATARIO
$html.='
<br><br>
<table border="1" width="100%" align="center" cellpadding="5">

  <tr>
    <td style="font-size:0.8em;">ORIGEN</td>
    <td style="font-size:0.8em;">OFICINA DE PARTES - '.utf8_encode($nombreregion).'</td>
  </tr>

  <tr>
    <td style="font-size:0.8em;">DESTINATARIO</td>
    <td style="font-size:0.8em;">'.utf8_encode($destinatario2).'</td>
  </tr>

  <tr>
    <td style="font-size:0.8em;">FECHA</td>
    <td style="font-size:0.8em;">'.$dia.' - '.$mes.' - '.$anno.'</td>
  </tr>
</table>
';

// DETALLE
$html.='
<br><br>
<table border="1" width="100%" align="center" cellpadding="5">

  <tr>
    <td style="font-size:8px;">&Iacute;TEM</td>
    
    <td style="font-size:8px;">TIPO DOCUMENTO</td>
    <td style="font-size:8px;">N&deg; DOCUMENTO</td>
    <td style="font-size:8px;">FECHA DOCUMENTO</td>
    <td style="font-size:8px;">REMITENTE DOC.</td>
    <td style="font-size:8px;">DESTINATARIO DOC.</td>
    <td style="font-size:8px;">MATERIA</td>
    <td style="font-size:8px;">OBSERVACI&Oacute;N</td>
  </tr>
  ';

  $sql3="SELECT * FROM argedo_doc_internos WHERE inte_region='$regionsession' AND inte_numguia=$guia AND inte_estado='1' ORDER BY inte_numguia DESC";
  $result3=mysql_query($sql3);
  $cont=1;
while ($row3=mysql_fetch_array($result3)) {
  
    $materia = $row3["inte_materia"];

    $html.='
    <tr>
      <td style="font-size:0.7em;">'.$cont.'</td>
      
      <td style="font-size:0.7em;">'.utf8_encode($row3["inte_tipo_doc"]).'</td>
      <td style="font-size:0.7em;">'.$row3["inte_num_doc"].'</td>
      <td style="font-size:0.7em;">'.substr($row3["inte_fecha_ing"],8,2)."-".substr($row3["inte_fecha_ing"],5,2)."-".substr($row3["inte_fecha_ing"],0,4).'</td>
      <td style="font-size:0.7em;">'.utf8_decode($row3["inte_remitente"]).'</td>
      <td style="font-size:0.7em;">'.utf8_decode($row3["inte_destinatario"]).'</td>
      <td style="font-size:0.7em;">'.utf8_encode($row3["inte_materia"]).'</td>
      <td style="font-size:0.7em;">'.utf8_encode($row3["inte_observacion"]).'</td>
    </tr>
    ';
    $cont++;
  }
  $html.='</table>';


// RECEPCION CONFORME
  $html.='
  <br><br>
  <table border="0" width="100%">

    <tr>

      <td width="20%"></td>

      <td width="60%" align="center" height="200px">

        <table border="1" width="100%" align="center" cellpadding="5">

          <tr>

            <td colspan="2" style="font-size:1.2em;" align="center" height="24px">Recib&iacute; Conforme</td>

          </tr>

          <tr>

            <td style="font-size:1em;" height="22px">Nombre:</td>

            <td></td>

          </tr>

          <tr>

            <td style="font-size:1em;" height="22px">Fecha:</td>

            <td style="font-size:1em;">'.Date("d-m-Y").'</td>

          </tr>

          <tr>

            <td style="font-size:1em;"  height="60px"><br>Firma:</td>

            <td></td>

          </tr>

        </table>

      </td>

      <td width="20%"></td>

    </tr>

  </table>
  ';



// output the HTML content

  $pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page

  $pdf->lastPage();

// ---------------------------------------------------------



//Close and output PDF document

  $pdf->Output('CORRESPONDENCIA_EXPEDIENTE_'.$guia.'_'.$regionsession.'_'.$anno.'.pdf', 'I');



//============================================================+

// END OF FILE

//============================================================+
?>