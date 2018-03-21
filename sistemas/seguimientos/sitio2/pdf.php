<?php
extract($_GET);
require_once("inc/config.php");
$sql = "SELECT * FROM compra_orden a INNER JOIN compra_detoc b ON b.doc_compra_id = a.oc_id WHERE oc_id = ".$id;
$res = mysql_query($sql);
$arregloDatos = array();
while($row = mysql_fetch_array($res))
{
	$arregloDatos[] = $row;
}
$datos = array(
	0 => array (
		0 => "599-1-CM16",
		1 => "30000",
		2 => "MATERIALES DE OFICINA",
		3 => Date("d-m-Y"),
		4 => "01-01-2016 AL 31-01-2016",
		),
	1 => array(
		0 => "COMERCIAL DE PRUEBA SPA",
		1 => "12.345.678-9",
		),
	2 => array(
		0 => "JUAN JOSE VILLAGRA",
		1 => "CARGO N° 1",
		2 => "SECCION DE CONTABILIDAD Y FINANZAS",
		),
	3 => array (
		0 => array(
			0 => "PRODUCTO / SERVICIO 1",
			1 => rand(1,30000)
			),
		1 => array(
			0 => "PRODUCTO / SERVICIO 2",
			1 => rand(1,30000)
			),
		2 => array(
			0 => "PRODUCTO / SERVICIO 3",
			1 => rand(1,30000)
			),
		3 => array(
			0 => "PRODUCTO / SERVICIO 4",
			1 => rand(1,30000)
			),
		4 => array(
			0 => "PRODUCTO / SERVICIO 5",
			1 => rand(1,30000)
			),
		5 => array(
			0 => "PRODUCTO / SERVICIO 6",
			1 => rand(1,30000)
			),
		6 => array(
			0 => "PRODUCTO / SERVICIO 7",
			1 => rand(1,30000)
			),
		7 => array(
			0 => "PRODUCTO / SERVICIO 8",
			1 => rand(1,30000)
			),
		8 => array(
			0 => "PRODUCTO / SERVICIO 9",
			1 => rand(1,30000)
			),
		),

	);
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
require_once('TCPDF-master/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('RECEPCIÓN CONFORME '.$arregloDatos[1]["oc_numero"]);
$pdf->SetSubject('RECEPCIÓN CONFORME');
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
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content

$imagen = array(0 => "http://192.168.100.121/sistemas/inventario/privado/sitio2/junji.png",
	1 => "http://www.junji.cl/wp-content/themes/octano-junji/img/logo-junji-2.png");

$pdf->Ln(-10);
$html = '

<table border="0" width="100%" align="center">
	<tr>
		<td><img src="'.$imagen[0].'"></td>
		<td width="55%">
			<p style="font-size:7px;text-align:center;">SECCION SEGUIMIENTO Y CONTROL - DEPARTAMENTO DE RECURSOS FINANCIEROS '.date("Y").'</p>
			<p style="font-size:14px;text-align:center;letter-spacing:2px;">GUÍA DE RECEPCIÓN CONFORME</p>
		</td>
	</tr>
</table>		
';


$html.='
<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td align="left" style="background-color: #F6F6F6;"><a style="font-size:10px;color:black;text-decoration:none;font-weight:bold;">1. IDENTIFICACIÓN DEL PRODUCTO O SERVICIO ADQUIRIDO</a> <a style="font-size:8px;color:black;text-decoration:none;">(Completar por la Unidad Requirente)</a></td>
	</tr>
</table>

<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">NÚMERO DE LA ORDEN DE COMPRA</td>
		<td style="border:1px solid red;font-size:10px;height:15px;">'.$arregloDatos[0]["oc_numero"].'</td>
	</tr>

	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">NÚMERO DE SOLICITUD DE COMPRA</td>
		<td style="border:1px solid red;font-size:10px;height:15px;">'.utf8_decode(mb_convert_encoding($arregloDatos[0]["oc_sc"],"UTF-8")).'</td>
	</tr>

	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">DESCRIPCIÓN DEL PRODUCTO O SERVICIO</td>
		<td style="border:1px solid red;font-size:10px;height:15px;">'.$arregloDatos[0]["oc_nombre"].'</td>
	</tr>

	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">FECHA DE RECEPCIÓN CONFORME</td>
		<td style="border:1px solid red;font-size:10px;height:15px;"></td>
	</tr>

	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">PERIODO,HITO O CUOTA DEL SERVICIO CONTRATADO</td>
		<td style="border:1px solid red;font-size:10px;height:15px;"></td>
	</tr>

</table>	



<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td align="left" style="background-color: #F6F6F6;"><a style="font-size:10px;color:black;text-decoration:none;font-weight:bold;">2. IDENTIFICACIÓN DEL PROVEEDOR</a> <a style="font-size:8px;color:black;text-decoration:none;">(Completar por la Unidad Requirente)</a></td>
	</tr>
</table>

<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">NOMBRE O RAZÓN SOCIAL</td>
		<td style="border:1px solid red;font-size:10px;height:15px;">'.utf8_decode($arregloDatos[0]["oc_rsocial"]).'</td>
	</tr>

	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">ROL ÚNICO TRIBUTARIO (RUT)</td>
		<td style="border:1px solid red;font-size:10px;height:15px;">'.number_format($arregloDatos[0]["oc_rut"],0,".",".").'-'.strtoupper($arregloDatos[0]["oc_dig"]).'</td>
	</tr>

</table>	


<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td align="left" style="background-color: #F6F6F6;"><a style="font-size:10px;color:black;text-decoration:none;font-weight:bold;">3. RECEPCIÓN CONFORME</a> <a style="font-size:8px;color:black;text-decoration:none;">(Completar por la Unidad Requirente)</a></td>
	</tr>
</table>

<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">NOMBRE</td>
		<td style="border:1px solid red;font-size:10px;height:15px;"></td>
		<td style="border:1px solid red;font-size:6px;" rowspan="3"><br><br><br><br><br><br>FIRMA Y TIMBRE</td>
	</tr>

	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">CARGO</td>
		<td style="border:1px solid red;font-size:10px;height:15px;"></td>
	</tr>

	<tr>
		<td style="font-size:8px;letter-spacing:1px;height:15px;">UNIDAD O DEPARTAMENTO</td>
		<td style="border:1px solid red;font-size:10px;height:15px;"></td>
	</tr>



</table>

<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td align="left" style="background-color: #F6F6F6;"><a style="font-size:10px;color:black;text-decoration:none;font-weight:bold;">4. DETALLE DEL PAGO</a> <a style="font-size:8px;color:black;text-decoration:none;">(Completar por Sección Seguimiento y Control - Departamento de Recursos Financieros)</a></td>
	</tr>
</table>

<br><br>
<table border="0" width="100%" align="center">
	<tr>
		<td style="border:1px solid red;font-size:10px;height:15px;width:5%;">#</td>
		<td style="border:1px solid red;font-size:10px;height:15px;width:75%;">DETALLE DEL PAGO</td>
		<td style="border:1px solid red;font-size:10px;height:15px;width:20%;">MONTO A CANCELAR</td>
	</tr>
</table>
<br>

<table border="0" width="100%" align="center" style="border:1px solid red;border-collapse: collapse;">

<tr>
<td style="font-size:8px;color: #3f3f3f;border-right:1px solid red;width:5%;height:250px"></td>
<td style="font-size:8px;color: #3f3f3f;border-right:1px solid red;width:75%;height:250px"></td>
<td style="font-size:8px;color: #3f3f3f;text-align:center;width:20%;height:250px"></td>
</tr>

	';

	$neto = 0;
	$iva = 0;
	$total = 0;
	$contador = 1;
	if(1==2) {
	foreach ($arregloDatos as $key => $value) {
		// while($row = mysql_fetch_array($res)) {
		$neto += $value["doc_cantidad"] * $value["doc_unitario"];
		$html.='<tr>';
		$html.='<td style="font-size:8px;color: #3f3f3f;border-right:1px solid red;width:5%;">'.$contador.'</td>';
		$html.='<td style="font-size:8px;color: #3f3f3f;border-right:1px solid red;width:75%;">'.$value["doc_especificacion"].'</td>';
		$html.='<td style="font-size:8px;color: #3f3f3f;text-align:center;width:20%;">$'.number_format($value["doc_cantidad"] * $value["doc_unitario"],0,".",".").'</td>';
		$html.='</tr>';
		$contador++;
	}
}
	$html.='</table>

	<br><br>
	<table border="0" width="100%" align="center">
		<tr>
		<td rowspan="3" style="border:1px solid red;font-size: 6px;text-align:center;width:40%"><br><br><br><br><br><br><br><br><br><br>FIRMA Y TIMBRE<br>SECCIÓN SEGUIMIENTO Y CONTROL</td>
		<td style="font-size:8px;"><br><br>TOTAL NETO<br></td>
		<td style="border:1px solid red;font-size:8px;width:26.6%;text-align:left;"><br><br>         $</td>
		</tr>

		<tr>
		<td style="font-size:8px;"><br><br>IMPUESTOS<br></td>
		<td style="border:1px solid red;font-size:8px;width:26.6%;text-align:left;"><br><br>         $</td>
		</tr>

		<tr>
			<td style="font-size:8px;"><br><br>TOTAL A PAGAR<br></td>
			<td style="border:1px solid red;font-size:8px;width:26.6%;text-align:left;"><br><br>         $</td>
		</tr>

	</table>

	';
// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
	$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
	$pdf->Output($arregloDatos[0]["oc_numero"].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
