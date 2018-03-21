<?php
session_start();
require("inc/config.php");
require_once('TCPDF-master/tcpdf.php');

$guia=$_GET["guia"];
$sw=$_GET["sw"];

$regionsession = $_SESSION["region"];
$sql2 = "Select * from regiones where codigo=$regionsession";
    //echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombreregion=$row2["nombre"];


$sql3="select * from argedo_correo where corre_region='$regionsession' and corre_folioguia=$guia group by corre_folioguia order by corre_folioguia desc";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);


$destinatario=$row3["corre_destinatario"];
$fecha=$row3["corre_fechaguia"];
$dia=substr($row3["corre_fechaguia"],8,2);
$mes=substr($row3["corre_fechaguia"],5,2);
$anno=substr($row3["corre_fechaguia"],0,4);


$sql31="select * from argedo_correo where corre_region='$regionsession' and corre_folioguia=$guia order by corre_folioguia desc";
$res31 = mysql_query($sql31);
$cont=1;

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SIGEJUN');
$pdf->SetTitle('GUIA DE DESPACHO INTERNA - CORREO');
$pdf->SetSubject('GUIA DE DESPACHO INTERNA - CORREO');
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
$pdf->Ln(-20);
$html.='
<table border="0" width="100%">

  <tr>
    <td colspan="3"><img src="images/junji_logo.png" style="width:130px;"></td>
  </tr>

  <tr>
    <td width="15%"></td>
    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">GUIA DE ENTREGA ARGEDO 2.0</td>
    <td width="15%"></td>
  </tr>

  <tr>
    <td width="15%"></td>
    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">CORREO</td>
    <td width="15%"></td>
  </tr>

  <tr>
    <td width="15%"></td>
    <td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">N&deg; '.$_GET["guia"].'</td>
    <td width="15%"></td>
  </tr>

</table>
<br><br>
<br><br>
<table border="1" width="100%" align="center" cellpadding="5">
  <tr>
    <td>ORIGEN</td>
    <td>OFICINA DE PARTES '.$nombreregion.'</td>
  </tr>

  <tr>
    <td>DESTINATARIO</td>
    <td>'.$destinatario.'</td>
  </tr>


  <tr>
    <td>FECHA</td>
    <td>'.$dia.' - '.$mes.' - '.$anno.'</td>
  </tr>

</table>
<br><br>
<br><br>
<table border="1" width="100%" align="center" cellpadding="5">
<tr>
  <td style="font-size:8px;">&Iacute;TEM</td>
  <td style="font-size:8px;">FOLIO</td>
  <td style="font-size:8px;">FECHA DOCUMENTO</td>
  <td style="font-size:8px;">CANTIDAD</td>
  <td style="font-size:8px;">PRECIO</td>
  <td style="font-size:8px;">TOTAL</td>
</tr>
';

while($row = mysql_fetch_array($res31))
{
  $subtotal+=$row["corre_precio"] * $row["corre_cantidad"];
  $html.='
  <tr>
    <td>'.$cont.'</td>
    <td>'.$row["corre_folioguia"].'</td>
    <td>'.substr($row["corre_fecha"],8,2).'-'.substr($row["corre_fecha"],5,2).'-'.substr($row["corre_fecha"],0,4).'</td>
    <td>'.$row["corre_cantidad"].'</td>
    <td>$'.$row["corre_precio"].'</td>
    <td>$'.number_format($row["corre_precio"] * $row["corre_cantidad"],0,".",".").'</td>
  </tr>
  ';
  $cont++;
}

$html.='
<tr>
<td colspan="5" align="right">TOTAL</td>
<td>$'.number_format($subtotal,0,".",".").'</td>
</tr>
</table>
';


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// reset pointer to the last page
$pdf->lastPage();
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('doc.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>