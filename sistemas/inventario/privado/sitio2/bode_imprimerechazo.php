<?php
require_once("inc/config.php");
$numguia=$_GET["numguia"];
$sql5="SELECT * FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where x.ding_ing_id=y.ing_id and (x.ding_recep_tecnica = 'R' OR x.ding_recep_tecnica = 'A') and y.ing_oc_id=z.oc_id and y.ing_guianumerorrchzo='$numguia' AND a.doc_id = x.ding_prod_id AND x.ding_cant_rechazo <> 0 ";
//echo $sql5;
$res5 = mysql_query($sql5);
$row5 = mysql_fetch_array($res5);

//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('../../../seguimientos/sitio2/TCPDF-master/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'ISO-8859-1', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('RECEPCION TECNICA N° '.$numguia);
$pdf->SetSubject('TCPDF Tutorial');
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
$pdf->setFontSubsetting(true);
// set font
$pdf->SetFont('freeserif', '', 10);

// add a page
$pdf->AddPage();

$pdf->Ln(-10);
// Encabezado

$fechas = explode("-", $row5["ding_fentrega"]);
$fechaguia=$fechas[2]."-".$fechas[1]."-".$fechas[0];

$fechas2 = explode("-", $row5["ing_guiafecharrchzo"]);
$fechaguia2=$fechas2[2]."-".$fechas2[1]."-".$fechas2[0];

if ($row5["ding_recep_tecnica"]=='A') {
	$guiaestado="ACEPTADA";
} else {
	$guiaestado="RECHAZADA";
}

$html.='
<table border="0" width="100%">
	<tr>
		<td width="20%"><img src="junji_logo.png" style="width:150px"></td>
		<td align="center" width="80%">
			<table border="0" width="100%" cellpadding="3">
				<tr>
					<td style="font-size:15px;">JUNTA NACIONAL DE JARDINES INFANTILES</td>
				</tr>

				<tr>
					<td>CONTROL DE CALIDAD</td>
				</tr>

				<tr>
					<td>COMPROBANTE DE RECHAZO TÉCNICO</td>
				</tr>

				<tr>
					<td>GUÍA N° '.$numguia.'</td>
				</tr>
			</table>

		</td>
	</tr>

</table>

<br><br>
<br><br>
<table border="1" width="100%" cellpadding="2">
	<tr>
		<td style="font-size:10px;">FECHA RECEPCION</td>
		<td style="font-size:10px;">'.$fechaguia.'</td>
	</tr>
	
	<tr>
		<td style="font-size:10px;">FECHA RECHAZO</td>
		<td style="font-size:10px;">'.$fechaguia2.'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">ESTADO</td>
		<td style="font-size:10px;">'.$guiaestado.'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">PROVEEDOR</td>
		<td style="font-size:10px;">'.$row5["oc_proveenomb"].'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">ORDEN DE COMPRA</td>
		<td style="font-size:10px;">'.$row5["oc_id2"].'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">PROGRAMA</td>
		<td style="font-size:10px;">'.$row5["oc_prog"].'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">RECHAZADO POR</td>
		<td style="font-size:10px;">'.$row5["ing_guiaemisorrrchzo"].'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">N° GUÍA PROVEEDOR</td>
		<td style="font-size:10px;">'.$row5["ing_guia"].'</td>
	</tr>

</table>

<br><br>

<table border="1" width="100%" cellpadding="1">
	<tr>
		<td style="font-size:8px;text-align:center;">REGIÓN</td>
		<td style="font-size:8px;text-align:center;">DESCRIPCIÓN DEL BIEN</td>
		<td style="font-size:8px;text-align:center;">UBICACIÓN</td>
		<td style="font-size:8px;text-align:center;">UNIDAD DE MEDIDA</td>
		<td style="font-size:8px;text-align:center;">CANTIDAD</td>
	</tr>
	';

// DETALLE DE LOS PRODUCTOS
	$res4 = mysql_query($sql5);
	while($row4 = mysql_fetch_array($res4))
	{
		$totallinea=$row4["ding_cant_rechazo"];
		$html.='
		<tr>
			<td style="font-size:8px;text-align:center;">'.$row4["doc_region"].'</td>
			<td style="font-size:8px;text-align:center;">'.$row4["doc_especificacion"].'</td>
			<td style="font-size:8px;text-align:center;">'.$row4["ding_ubicacion"].'</td>
			<td style="font-size:8px;text-align:center;">'.$row4["doc_umedida"].'</td>
			<td style="font-size:8px;text-align:center;">'.number_format($totallinea,0,',','.').'</td>
		</tr>
		';
	}

	$imageSize = 150;
	if($row5["ing_rechazado"] <> "")
	{
		$aprobado = $row5["ing_rechazado"];
	}else{
		$aprobado = "";
	}

	if($row5["ing_rechazado"] <> "" AND $row5["ing_region"] == 16)
	{
		$timbre1 = '<img src="images/rc_tecnica.png" style="width:'.$imageSize.'px;">';
	}else{
		$timbre1 = "";
	}

	if($row5["ing_rechazado"] <> "")
	{
		if($row5["ing_region"] == 16)
		{
			$timbre2 = '<img src="images/rc_cyf.png" style="width:'.$imageSize.'px;">';
		}else{
			$timbre2 = '<img src="images/rc_tecnica.png" style="width:'.$imageSize.'px;">';
		}
	}
	$html.='

</table>

<br><br>
<br><br>
<br><br>
<br><br>
<table border="0" width="100%" align="center">

	<tr>
		<td style="font-size:8px;text-align:center;">'.$timbre1.'</td>
		<td style="font-size:8px;text-align:center;"></td>
		<td style="font-size:8px;text-align:center;">'.$timbre2.'</td>
	</tr>

	<tr>
		<td style="font-size:10px;text-align:center;">'.$row5["ing_guiaemisorrrchzo"].'</td>
		<td style="font-size:10px;text-align:center;">'.$aprobado.'</td>
		<td style="font-size:8px;text-align:center;"></td>
	</tr>

	<tr>
		<td style="font-size:8px;text-align:center;">_________________________________________</td>
		<td style="font-size:8px;text-align:center;">_________________________________________</td>
		<td style="font-size:10px;text-align:center;">TIMBRE</td>
	</tr>

	<tr>
		<td style="font-size:10px;text-align:center;">DOCUMENTO REALIZADO POR</td>
		<td style="font-size:10px;text-align:center;">DOCUMENTO APROBADO POR</td>
		<td style="font-size:8px;text-align:center;"></td>
	</tr>

</table>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Recepcion Tecnica N° '.$numguia.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>