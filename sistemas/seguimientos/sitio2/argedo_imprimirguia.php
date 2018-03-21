<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
require("inc/config.php");
require_once('TCPDF-master/tcpdf.php');
$nivel = $_SESSION["pfl_user"];
$regionsession = $_SESSION["region"];
$guia=$_GET["guia"];
$sw=$_GET["sw"];



if($_SESSION["nom_user"] =="" ){
  ?><script language="javascript">location.href='sesion_perdida.php';</script><?
}
$sql2 = "Select * from regiones where codigo=$regionsession";
//echo $sql;
$res2 = mysql_query($sql2);
$row2 = mysql_fetch_array($res2);
$nombreregion=$row2["nombre"];

$licencias = 0;
// COMPROBACION DE LICENCIAS EN EL DOCUMENTO
$sql31="select * from argedo_recibida where reci_defensoria='$regionsession' and reci_folioguia=$guia order by reci_folio desc";
$res31 = mysql_query($sql31);
$cont=1;
while ($row31 = mysql_fetch_array($res31)) {
  $materia = $row31["reci_materia"];

  if(utf8_encode($row31["reci_tipodoc"]) == "LICENCIA MÉDICA")
  {
   $licencias++;
 }
}
    // FIN

$sql3="select * from argedo_recibida where reci_defensoria='$regionsession' and reci_folioguia=$guia group by reci_folioguia order by reci_folio desc";
$res3 = mysql_query($sql3);
$row3 = mysql_fetch_array($res3);


$destinatario=$row3["reci_destinatario2"];
$fecha=$row3["reci_fechaguia"];
// create new PDF document
$dia=substr($row3["reci_fechaguia"],8,2);
$mes=substr($row3["reci_fechaguia"],5,2);
$anno=substr($row3["reci_fechaguia"],0,4);
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('SIGEJUN');
$pdf->SetTitle('GUIA DE ENTREGA ARGEDO 2.0 - CORRESPONDENCIA RECIBIDA');
$pdf->SetSubject('GUIA DE ENTREGA ARGEDO 2.0 - CORRESPONDENCIA RECIBIDA');
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
<td width="70%" align="center" style="font-size:12px;text-decoracion:underline;">GU&Iacute;A DE ENTREGA ARGEDO 2.0</td>
<td width="15%"></td>
</tr>

<tr>
<td width="15%"></td>
<td width="70%" align="center" style="font-size:12px;text-decoracion:underline;"> CORRESPONDENCIA RECIBIDA</td>
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
<td style="font-size:0.8em;">OFICINA DE PARTES '.utf8_encode($nombreregion).'</td>
</tr>

<tr>
<td style="font-size:0.8em;">DESTINATARIO</td>
<td style="font-size:0.8em;">'.utf8_encode($destinatario).'</td>
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
<table border="1" width="100%" align="center" cellpadding="5"><tr>';

if($licencias > 0)
{
  $html.='
  <td style="font-size:6px;">N° FOLIO LICENCIA</td>
  <td style="font-size:6px;">RUT FUNCIONARIO/A</td>
  <td style="font-size:6px;">NOMBRE FUNCIONARIO/A</td>
  <td style="font-size:6px;">N° DÍAS</td>
  <td style="font-size:6px;">INICIO REPOSO</td>
  <td style="font-size:6px;">FECHA RECEPCION OF. PARTES</td>
  ';
}else{
  $html.='
  <td style="font-size:6px;">&Iacute;TEM</td>
  <td style="font-size:6px;">FOLIO</td>
  <td style="font-size:6px;">TIPO DOCUMENTO</td>
  <td style="font-size:6px;">N&deg; EXTERNO</td>
  <td style="font-size:6px;">FECHA DOCUMENTO</td>
  <td style="font-size:6px;">REMITENTE</td>
  <td style="font-size:6px;">MATERIA</td>
  <td style="font-size:6px;">DESTINATARIO</td>
  <td style="font-size:6px;">OBSERVACIONES</td>
  ';
}

$html.='</tr>';

$sql31="select * from argedo_recibida where reci_defensoria='$regionsession' and reci_folioguia=$guia order by reci_folio desc";
$res31 = mysql_query($sql31);
$cont=1;

while ($row31 = mysql_fetch_array($res31)) {
$materia = $row31["reci_materia"];

if(utf8_encode($row31["reci_tipodoc"]) == "LICENCIA MÉDICA")
  {
    $sql32 = "SELECT * FROM argedo_licencia WHERE lice_reci_id = ".$row31["reci_id"];
    $res32 = mysql_query($sql32);
    $row32 = mysql_fetch_array($res32);
  }

$html.='<tr>';

if($licencias > 0)
{
  $html.='
  <td style="font-size:0.6em;">'.$row32["lice_numfolio2"].'</td>
  <td style="font-size:0.6em;">'.$row32["lice_rut"].'-'.$row32["lice_dig"].'</td>
  <td style="font-size:0.6em;">'.utf8_encode($row32["lice_funcionario"]).'</td>
  <td style="font-size:0.6em;">'.$row32["lice_dias"].'</td>
  <td style="font-size:0.6em;">'.$row32["lice_ini_reposo"].'</td>
  <td style="font-size:0.6em;">'.$row32["lice_fechaparte"].'</td>
  
  ';
}else{
    $html.='
  <td style="font-size:0.6em;">'.$cont.'</td>
  <td style="font-size:0.6em;">'.$row31["reci_folio"].'</td>
  <td style="font-size:0.6em;">'.utf8_encode($row31["reci_tipodoc"]).'</td>
  <td style="font-size:0.6em;">'.$row31["reci_numero"].'</td>
  <td style="font-size:0.6em;">'.substr($row31["reci_fecha_doc"],8,2)."-".substr($row31["reci_fecha_doc"],5,2)."-".substr($row31["reci_fecha_doc"],0,4).'</td>
  <td style="font-size:0.6em;">'.utf8_encode($row31["reci_remite"]).'</td>
  <td style="font-size:0.6em;">'.utf8_encode($materia).'</td>
  <td style="font-size:0.6em;">'.utf8_encode($row31["reci_destinatario"]).'</td>
  <td style="font-size:0.6em;">'.utf8_encode($row31["reci_obs"]).'</td>';
}
$html.='</tr>';
}//WHILE

$html.='</table>';

// RECEPCION CONFORME
$html.='
<br><br>
<table border="1" width="80%" align="center" cellpadding="5">

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
';
// output the HTML content

$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page

$pdf->lastPage();

// ---------------------------------------------------------



//Close and output PDF document

$pdf->Output('CORRESPONDENCIA_RECIBIDA_'.$guia.'_'.$regionsession.'_'.$anno.'.pdf', 'I');



//============================================================+

// END OF FILE

//============================================================+
?>