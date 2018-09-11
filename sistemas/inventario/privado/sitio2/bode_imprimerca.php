<?php
require_once("inc/config.php");
$numguia=$_GET["numguia"];

$sql5="SELECT SUM(ding_cantidad) as ding_cantidad, ding_cant_rechazo, doc_especificacion, doc_region, ding_fentrega,oc_proveenomb, oc_id2, oc_prog, ing_guiaemisorrc,ing_guia,oc_monto,doc_unit,doc_umedida, ing_aprobado,ing_region,doc_valor_moneda FROM bode_detingreso x, bode_ingreso y, bode_orcom z, bode_detoc a where /*x.ding_prod_id = $doc_id and*/ x.ding_ing_id=y.ing_id and x.ding_recep_tecnica = 'A' and y.ing_oc_id=z.oc_id and y.ing_guianumerorc='$numguia' AND a.doc_id = x.ding_prod_id AND x.ding_estado = 1 GROUP BY a.doc_especificacion,a.doc_region";
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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetAutoPageBreak(true, 0);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('RECEPCION CONFORME N° '.$numguia);
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
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

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


$fechas = explode("-",$row5["ding_fentrega"]);
$fechaguia=$fechas[2]."-".$fechas[1]."-".$fechas[0];
$ocid=$row5["oc_id"];

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
					<td>GUÍA DE RECEPCIÓN CONFORME</td>
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
		<td style="font-size:10px;">REVISADO POR</td>
		<td style="font-size:10px;">'.$row5["ing_guiaemisorrc"].'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">N° GUÍA PROVEEDOR</td>
		<td style="font-size:10px;">'.$row5["ing_guia"].'</td>
	</tr>

	<tr>
		<td style="font-size:10px;">VALOR LOTE O/C</td>
		<td style="font-size:10px;">$'.number_format($row5["oc_monto"],0,".",".").'</td>
	</tr>

</table>

<br><br>

<table border="1" width="100%" cellpadding="1">
	<tr>
		<td style="font-size:8px;text-align:center;">REGIÓN</td>
		<td style="font-size:8px;text-align:center;">DESCRIPCIÓN DEL BIEN</td>
		<td style="font-size:8px;text-align:center;">UNIDAD DE MEDIDA</td>
		<td style="font-size:8px;text-align:center;">CANTIDAD</td>
		<td style="font-size:8px;text-align:center;">VALOR UNITARIO</td>

	</tr>
	';


	$res4 = mysql_query($sql5);
	while($row4 = mysql_fetch_array($res4))
	{
		$totallinea=$row4["ding_cantidad"]-$row4[1];
		$html.='
		<tr>
			<td style="font-size:8px;text-align:center;">'.$row4["doc_region"].'</td>
			<td style="font-size:8px;text-align:center;">'.utf8_encode($row4["doc_especificacion"]).'</td>
			<td style="font-size:8px;text-align:center;">'.$row4["doc_umedida"].'</td>
			<td style="font-size:8px;text-align:center;">'.number_format($totallinea,0,',','.').'</td>
			<td style="font-size:8px;text-align:center;">$'.number_format( ($row4["doc_unit"] * $row4["doc_valor_moneda"]),0,',','.').'</td>
		</tr>
		';
	}



	$imageSize = 150;
	if($row5["ing_aprobado"] <> "")
	{
		$aprobado = $row5["ing_aprobado"];
	}else{
		$aprobado = "";
	}

	if($row5["ing_aprobado"] <> "" AND $row5["ing_region"] == 16)
	{
		$timbre1 = '<img src="images/rc_conforme.png" style="width:'.$imageSize.'px;">';
	}else{
		$timbre1 = "";
	}

	if($row5["ing_aprobado"] <> "")
	{
		if($row5["ing_region"] == 16)
		{
			$timbre2 = '<img src="images/rc_cyf.png" style="width:'.$imageSize.'px;">';
		}else{
			$timbre2 = '<img src="images/rc_conforme.png" style="width:'.$imageSize.'px;">';
		}
	}

	$html.='

</table>

<br><br>

<table border="0" width="100%" align="center">

	<tr>
		<td style="font-size:8px;text-align:center;">'.$timbre1.'</td>
		<td style="font-size:8px;text-align:center;"></td>
		<td style="font-size:8px;text-align:center;">'.$timbre2.'</td>
	</tr>

	<tr>
		<td style="font-size:10px;text-align:center;">'.$row5["ing_guiaemisorrc"].'</td>
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
$pdf->Output('Recepcion Conforme N° '.$numguia.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>