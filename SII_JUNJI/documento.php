<?php
ini_set("display_error", 0);
session_start();
extract($_GET);
require_once("library/vendor/autoload.php");
require_once("includes/inc/class.xml.php");
require_once("includes/TCPDF-master/tcpdf.php");
require_once("includes/TCPDF-master/tcpdf_barcodes_2d.php");
require_once("includes/functions.referencia.php");
require_once("includes/functions.cliente.php");
require_once("includes/functions.empresa.php");
require_once("includes/functions.documentos.php");


use BigFish\PDF417\PDF417;
use BigFish\PDF417\Renderers\ImageRenderer;
use BigFish\PDF417\Renderers\SvgRenderer;

$regionSession = (!isset($_SESSION["sii"]["usuario_region"])) ? $_GET["regionSession"] : $_SESSION["sii"]["usuario_region"];
echo $regionSession;
$empresa = getEmpresa($regionSession);

$html = "";
$htmlnocedible = "";

$fecha_resolucion  = explode("-",$empresa[1]["empresa_fecha"]);
$numero_resolucion = $empresa[1]["empresa_resolucion"];
						
// PARAMETROS
$logo = array(
	0 => "images/logo.png",
	);
$logo = $logo[0];

$detalleDTE = getDetalleDTE($dte_id);
echo "<pre>";
var_dump($detalleDTE);
echo "<pre>";
exit();
$tipo = $detalleDTE[1]["dte_dcto_id"];
$archivoXML = "../sistemas/archivos/SII/".$detalleDTE[1]["dte_ruta"].$detalleDTE[1]["dte_archivo"].".xml";

$contenido = file_get_contents($archivoXML);
$doc = new XML();
$doc->loadXML($contenido);

$TED = new XML();
$TED->loadXML($doc->getElementsByTagName("TED")->item(0)->C14N());
$TED->documentElement->removeAttributeNS('http://www.w3.org/2001/XMLSchema-instance', 'xsi');
$TED->documentElement->removeAttributeNS('http://www.sii.cl/SiiDte', '');
$TED = $TED->getFlattened2('/');

$pdf417 = new PDF417();
$data = $pdf417->encode($TED);
// Create a PNG image
$renderer = new ImageRenderer([
    'format' => 'data-url',
    'scale' => 10,
    'ratio' => 1.3
]);

$image = $renderer->render($data);

$archivoXML = utf8_encode($contenido);
/*$archivoXML = str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>", "", $archivoXML);*/
$xml = new SimpleXMLElement($archivoXML);

$detalleCliente = getClienteDetallePorRut($xml->SetDTE->DTE->Documento->Encabezado->Receptor->RUTRecep);

$FchEmis = explode("-",$xml->SetDTE->DTE->Documento->Encabezado->IdDoc->FchEmis);
$rutCaratula = explode("-",$xml->SetDTE->Caratula->RutEmisor);
$monto_escrito =  strtoupper(num2letras($xml->SetDTE->DTE->Documento->Encabezado->Totales->MntTotal,false,false));

if(isset($origen) && $origen <> "")
{
	$enlace = new mysqli("localhost","inventario","inventario.","junji_inventario");
	// VERIFICAMOS EL ORIGEN SI ES LOGISTICA O INVENTARIO
	if($origen == 1)
	{
		$sql = "SELECT * FROM bode_orcom WHERE oc_dte_id = ".$dte_id;
		$res = $enlace->query($sql);
		$row = $res->fetch_assoc();

		if($row["oc_tipo_guia"] == 3)
		{
			$sql2 = "SELECT * FROM jardines WHERE jardin_codigo = '".$row["oc_region"]."' AND jardin_estado = 1";
			$res2 = $enlace->query($sql2);
			$row2 = $res2->fetch_assoc();
		}
	}else if($origen == 2)
	{
		$sql = "SELECT * FROM  inv_guia_despacho_encabezado WHERE guia_dte_id = ".$dte_id;
		$res = $enlace->query($sql);
		$row = $res->fetch_assoc();
	}
}
$tipoDocumento = [
	33 => "FACTURA ELECTRÓNICA",
	34 => "FACTURA NO AFECTA O EXENTA ELECTRÓNICA",
	43 => "LIQUIDACION-FACTURA ELECTRÓNICA",
	46 => "FACTURA DE COMPRA ELECTRÓNICA",
	52 => "GUIA DE DESPACHO ELECTRÓNICA",
	56 => "NOTA DE DÉBITO ELECTRÓNICA",
	61 => "NOTA DE CRÉDITO ELECTRÓNICA",
	110 => "FACTURA DE EXPORTACIÓN",
	111 => "NOTA DE DÉBITO DE EXPORTACIÓN",
	112 => "NOTA DE CRÉDITO DE EXPORTACIÓN"
	];

$meses = [
	1 => "Enero",
	2 => "Febrero",
	3 => "Marzo",
	4 => "Abril",
	5 => "Mayo",
	6 => "Junio",
	7 => "Julio",
	8 => "Agosto",
	9 => "Septiembre",
	10 => "Octubre",
	11 => "Noviembre",
	12 => "Diciembre"
	];

$indTraslado = [
	1 => "OPERACIÓN CONSTITUYE VENTA",
	2 => "VENTAS POR EFECTUAR",
	3 => "CONSIGNACIONES",
	4 => "ENTREGA GRATUITA",
	5 => "TRASLADOS INTERNOS",
	6 => "OTROS TRASLADOS NO VENTA",
	7 => "GUÍA DE DEVOLUCIÓN",
	8 => "TRASLADO PARA EXPORTACIÓN (NO VENTA)",
	9 => "VENTA PARA EXPORTACIÓN"
	];

$limite = 14;

$totalElementos = count($xml->SetDTE->DTE->Documento->Detalle);
$diferencia = $limite - $totalElementos;

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('JUNTA NACIONAL DE JARDINES INFANTILES');
$pdf->SetTitle('Documento Electrónico Tributario');
$pdf->SetPrintHeader(false);
$pdf->setFontSubsetting(false);
$timbre = 0;

// ENCABEZADO
$html.='
<table border="0" width="100%" align="center">
	<tr>
		<td align="left" width="20%"><img src="'.$logo.'"></td>
		<td width="43%">
			<table style="font-size:0.7em;margin-left:100px;" width="100%" align="center">
				<tr>
					<td>'.$empresa[1]["empresa_glosa"].'</td>
				</tr>
				<tr>
					<td>GIRO : '.$empresa[1]["empresa_giro"].'</td>
				</tr>

				<tr>
					<td>DIRECCIÓN : '.$xml->SetDTE->DTE->Documento->Encabezado->Emisor->DirOrigen.', '.$xml->SetDTE->DTE->Documento->Encabezado->Emisor->CmnaOrigen.'. '.$xml->SetDTE->DTE->Documento->Encabezado->Emisor->CiudadOrigen.'</td>
				</tr>
			</table>

		</td>
		<td width="37%">
			<table width="100%" style="border:2px solid red;padding:5px;color:red;font-weight:bold;font-family:Helvetica;font-size:10px;">
				<tr>
					<td>R.U.T.: '.number_format($rutCaratula[0],0,".",".").'-'.$rutCaratula[1].'</td>
				</tr>

				<tr>
					<td>'.$tipoDocumento[intval($xml->SetDTE->Caratula->SubTotDTE->TpoDTE)].'</td>
				</tr>

				<tr>
					<td>N° 00'.$xml->SetDTE->DTE->Documento->Encabezado->IdDoc->Folio.'</td>
				</tr>
			</table>

			<table style="color:red;font-size:0.8em;">
				<tr>
					<td>S.I.I.  SANTIAGO CENTRO</td>
				</tr>
			</table>

		</td>
	</tr>
</table>
';
// DETALLE RECEPTOR
$rutReceptor = explode("-",$xml->SetDTE->DTE->Documento->Encabezado->Receptor->RUTRecep);
$html.='
<br><br>
<table border="0" width="100%" style="border:1px solid black;padding:3px;">
	<tr>
		<td colspan="6" style="font-size:0.5em;">Fecha emisión : Santiago '.$FchEmis[2].' de '.$meses[intval($FchEmis[1])].' del '.$FchEmis[0].'</td>
	</tr>

	<tr>
		<td style="font-size:0.5em;">SEÑOR(ES) : </td>';
		
		// <td colspan="2" style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->RznSocRecep.'</td>
		if($origen == 1)
		{
			if($row["oc_tipo_guia"] == 3)
			{
				$html.='<td colspan="2" style="font-size:0.5em;">'.$row2["jardin_codigo"].' / '.$row2["jardin_nombre"].'</td>';
			}else{
				$html.='<td colspan="2" style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->RznSocRecep.'</td>';
			}
		}else{
			$html.='<td colspan="2" style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->RznSocRecep.'</td>';
		}


		$html.='<td style="font-size:0.5em;">R.U.T. : </td>
		<td colspan="2" style="font-size:0.5em;">'.number_format($rutReceptor[0],0,".",".").'-'.$rutReceptor[1].'</td>
	</tr>

	<tr>
		<td style="font-size:0.5em;">DIRECCION : </td>
		<td style="font-size:0.5em;">'.utf8_decode($xml->SetDTE->DTE->Documento->Encabezado->Receptor->DirRecep).'</td>
		<td style="font-size:0.5em;">COMUNA : </td>
		<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->CmnaRecep.'</td>
		<td style="font-size:0.5em;">CIUDAD : </td>
		<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->CiudadRecep.'</td>
	</tr>

	<tr>
		<td style="font-size:0.5em;">GIRO : </td>
		<td style="font-size:0.5em;" colspan="2">'.$detalleCliente[1]["cliente_giro"].'</td>';
		if($tipo == 52)
		{
			$html.='
			<td style="font-size:0.5em;">TIPO TRASLADO : </td>
			<td style="font-size:0.5em;" colspan="3">'.$indTraslado[intval($xml->SetDTE->DTE->Documento->Encabezado->IdDoc->IndTraslado)].'</td>
			';
		}

		$html.='</tr>
	</table>
	';

// COMPROBAMOS SI HAY REFERENCIAS
	$totalReferencia = count($xml->SetDTE->DTE->Documento->Referencia);
	if($totalReferencia > 0)
	{
		$html.='<br><br>
		<table border="0" width="100%" style="border:1px solid black;padding:2px;" align="center">
			<tr>
				<td colspan="4" align="center" style="font-size:0.5em;">REFERENCIAS</td>
			</tr>
			<tr>
				<td style="font-size:0.5em;align:center;">TIPO DE REFERENCIA</td>
				<td style="font-size:0.5em;align:center;">FOLIO REFERENCIA</td>
				<td style="font-size:0.5em;align:center;">FECHA REFERENCIA</td>
				<td style="font-size:0.5em;align:center;">RAZON REFERENCIA</td>
			</tr>';

			for($i=0;$i<$totalReferencia;$i++)
			{
				$timbre++;
				$html.='
				<tr>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->TpoDocRef.' / '.getDetalleReferencia($xml->SetDTE->DTE->Documento->Referencia[$i]->TpoDocRef)[1]["ref_glosa"].'</td>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->FolioRef.'</td>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->FchRef.'</td>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->RazonRef.'</td>
				</tr>
				';
			}
			$html.='</table>';
		}

// DETALLE DE LOS PRODUCTOS


		$html.='<br><br>
		<table border="1" width="100%">
			<tr>
				<td colspan="7" align="center" style="font-size:0.6em;">DETALLE DE PRODUCTOS</td>
			</tr>
			<tr align="center">
				<td style="font-size:0.5em;width:20px">#</td>
				<td style="font-size:0.5em;width:59px">CODIGO</td>
				<td style="font-size:0.5em;width:270px">DETALLE</td>
				<td style="font-size:0.5em;width:40px">CANTIDAD</td>
				<td style="font-size:0.5em;width:40px">U.M</td>
				<td style="font-size:0.5em;width:40px">UNITARIO</td>
				<td style="font-size:0.5em;width:70px">SUBTOTAL</td>
			</tr>
		</table>

		<table border="0" width="100%" style="border:1px solid black;">
			';

			for($i=0;$i<$totalElementos;$i++){
				$html.='
				<tr align="center">
					<td style="font-size:0.5em;width:20px">'.$xml->SetDTE->DTE->Documento->Detalle[$i]->NroLinDet.'</td>
					<td style="font-size:0.5em;width:59px">'.$xml->SetDTE->DTE->Documento->Detalle[$i]->CdgItem->VlrCodigo.'</td>
					<td style="font-size:0.5em;width:270px">'.utf8_decode($xml->SetDTE->DTE->Documento->Detalle[$i]->NmbItem).'</td>
					<td style="font-size:0.5em;width:40px">'.$xml->SetDTE->DTE->Documento->Detalle[$i]->QtyItem.'</td>
					<td style="font-size:0.5em;width:40px">'.$xml->SetDTE->DTE->Documento->Detalle[$i]->UnmdItem.'</td>
					<td style="font-size:0.5em;width:40px">$'.number_format(intval($xml->SetDTE->DTE->Documento->Detalle[$i]->PrcItem),0,".",".").'</td>
					<td style="font-size:0.5em;width:70px">$'.number_format(intval($xml->SetDTE->DTE->Documento->Detalle[$i]->MontoItem),0,".",".").'</td>
				</tr>';
			}
			for($i=0;$i<$diferencia;$i++) {
				$html.='
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>';
			}
			$html.='</table>';


// TOTALES FINALES
						

			$pdf->setCellPaddings(0,0,0,0);
			// $params = $pdf->serializeTCPDFtagParameters(array($TED, 'PDF417', 10, '', 0, 40, array('border' => 1,'vpadding' => 'auto','hpadding' => 'auto','fgcolor' => array(0,0,0),'bgcolor' => false,'module_width' => 2,'module_height' => 2), 'N'));
			$html.='<br><br>
			<table border="0" width="100%">
				<tr>
					<td style="font-size:0.6em;">SON : '.utf8_encode($monto_escrito).'</td>
				</tr>
			</table>
			<br><br>
			<table border="0" width="100%">
				<tr>
					<td width="43%">';
						// $html .= '<tcpdf method="write2DBarcode" params="'.$params.'" />
						$html.='
						<table border="0" align="center" cellpadding="1">
						<tr>
						<td><img src="'.$image->encoded.'" /></td>
						</tr>
							<tr>
								<td style="font-size:0.6em;">Timbre Electrónico SII</td>
							</tr>

							<tr>	
								<td style="font-size:0.6em;">Res.'.$numero_resolucion.' de '.$fecha_resolucion[0].' Verifique documento: www.sii.cl</td>
							</tr>
						</table>
						';
						$html.='</td>
						<td width="57%">
							<table border="1" width="100%" cellpadding="3">
								
								';

								if(count($xml->SetDTE->DTE->Documento->DscRcgGlobal) > 0)
								{
									$timbre++;
									$tipo = ($xml->SetDTE->DTE->Documento->DscRcgGlobal->TpoMov == "D") ? "DESCUENTO" : "RECARGO";
									$html.='
									<tr style="border:1px solid red;">
										<td style="font-size:0.6em;">'.$tipo.'</td>
										<td style="font-size:0.6em;">'.$xml->SetDTE->DTE->Documento->DscRcgGlobal->TpoValor.' '.$xml->SetDTE->DTE->Documento->DscRcgGlobal->ValorDR.'</td>
									</tr>
									';
								}

								$html.='
								<tr>
									<td style="font-size:0.6em;">NETO</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->MntNeto),0,".",".").'</td>
								</tr>

								<tr>
									<td style="font-size:0.6em;">EXENTO</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->MntExe),0,".",".").'</td>
								</tr>

								<tr>
									<td style="font-size:0.6em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Totales->TasaIVA.' % IVA</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->IVA),0,".",".").'</td>
								</tr>

								<tr>
									<td style="font-size:0.6em;">TOTAL</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->MntTotal),0,".",".").'</td>
								</tr>';
								if($origen == 1)
								{
								$html.='									
								<tr>
									<td style="font-size:0.54em;" colspan="2">OBSERVACIONES : '.$row["oc_obs"].'</td>
								</tr>';
								}else if($origen == 2)
								{
									$html.='									
								<tr>
									<td style="font-size:0.54em;" colspan="2">OBSERVACIONES : '.$row["guia_obs"].'</td>
								</tr>';
								}


								$html.='</table>	
							</td>
						</tr>


					</table>
					';


				// <br><br><br><br><br><br>
					// if($tipo <> 52)
					// {
						
						$html.='
						<br><br>
						<table width="100%" border="0" style="padding:5px;border:0.5px solid black;">
							<tr>
								<td style="font-size:0.6em;">Nombre : ___________________________</td>
								<td style="font-size:0.6em;">R.U.T.: ___________________________</td>
								<td style="font-size:0.6em;"></td>
							</tr>

							<tr>
								<td style="font-size:0.6em;">Recinto : ___________________________</td>
								<td style="font-size:0.6em;">Fecha : ___________________________</td>
								<td style="font-size:0.6em;">Firma : ___________________________</td>
							</tr>

							<tr>
								<td colspan="3" style="font-size:0.6em;">"El acuse de recibo que se declara en este acto, de acuerdo a lo dispuesto en la letra b) del Art. 4º, y la letra c) del Art. 5º de la Ley 19.983, acredita que
									la entrega de mercaderias o servicio(s) prestado(s) ha(n) sido recibido(s)".
								</td>
							</tr>

							<tr>
								<td style="color:red;font-weight:bold;font-size:0.6em;" colspan="3" align="right">CEDIBLE</td>
							</tr>

						</table>';
					// }

//AQUI COMIENZA EL HTMLNOCEDIBLE
// ENCABEZADO
$htmlnocedible.='
<table border="0" width="100%" align="center">
	<tr>
		<td align="left" width="20%"><img src="'.$logo.'"></td>
		<td width="43%">
			<table style="font-size:0.7em;margin-left:100px;" width="100%" align="center">
				<tr>
					<td>'.$empresa[1]["empresa_glosa"].'</td>
				</tr>
				<tr>
					<td>GIRO : '.$empresa[1]["empresa_giro"].'</td>
				</tr>

				<tr>
					<td>DIRECCIÓN : '.$empresa[1]["empresa_direccion"].', '.$empresa[1]["empresa_comuna"].'. '.$empresa[1]["empresa_ciudad"].'</td>
				</tr>
			</table>

		</td>
		<td width="37%">
			<table width="100%" style="border:2px solid red;padding:5px;color:red;font-weight:bold;font-family:Helvetica;font-size:10px;">
				<tr>
					<td>R.U.T.: '.number_format($rutCaratula[0],0,".",".").'-'.$rutCaratula[1].'</td>
				</tr>

				<tr>
					<td>'.$tipoDocumento[intval($xml->SetDTE->Caratula->SubTotDTE->TpoDTE)].'</td>
				</tr>

				<tr>
					<td>N° 00'.$xml->SetDTE->DTE->Documento->Encabezado->IdDoc->Folio.'</td>
				</tr>
			</table>

			<table style="color:red;font-size:0.8em;">
				<tr>
					<td>S.I.I.  SANTIAGO CENTRO</td>
				</tr>
			</table>

		</td>
	</tr>
</table>
';
// DETALLE RECEPTOR
$rutReceptor = explode("-",$xml->SetDTE->DTE->Documento->Encabezado->Receptor->RUTRecep);
$htmlnocedible.='
<br><br>
<table border="0" width="100%" style="border:1px solid black;padding:3px;">
	<tr>
		<td colspan="6" style="font-size:0.5em;">Fecha emisión : Santiago '.$FchEmis[2].' de '.$meses[intval($FchEmis[1])].' del '.$FchEmis[0].'</td>
	</tr>

	<tr>
		<td style="font-size:0.5em;">SEÑOR(ES) : </td>
		<td colspan="2" style="font-size:0.5em;">'.$detalleCliente[1]["cliente_empresa"].'</td>

		<td style="font-size:0.5em;">R.U.T. : </td>
		<td colspan="2" style="font-size:0.5em;">'.number_format($rutReceptor[0],0,".",".").'-'.$rutReceptor[1].'</td>
	</tr>

	<tr>
		<td style="font-size:0.5em;">DIRECCION : </td>
		<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->DirRecep.'</td>
		<td style="font-size:0.5em;">COMUNA : </td>
		<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->CmnaRecep.'</td>
		<td style="font-size:0.5em;">CIUDAD : </td>
		<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Receptor->CiudadRecep.'</td>
	</tr>

	<tr>
		<td style="font-size:0.5em;">GIRO : </td>
		<td style="font-size:0.5em;" colspan="2">'.$detalleCliente[1]["cliente_giro"].'</td>';
		if($tipo == 52)
		{
			$htmlnocedible.='
			<td style="font-size:0.5em;">TIPO TRASLADO : </td>
			<td style="font-size:0.5em;" colspan="3">'.$indTraslado[intval($xml->SetDTE->DTE->Documento->Encabezado->IdDoc->IndTraslado)].'</td>
			';
		}

		$htmlnocedible.='</tr>
	</table>
	';

// COMPROBAMOS SI HAY REFERENCIAS
	$totalReferencia = count($xml->SetDTE->DTE->Documento->Referencia);
	if($totalReferencia > 0)
	{
		$htmlnocedible.='<br><br>
		<table border="0" width="100%" style="border:1px solid black;padding:2px;" align="center">
			<tr>
				<td colspan="4" align="center" style="font-size:0.5em;">REFERENCIAS</td>
			</tr>
			<tr>
				<td style="font-size:0.5em;align:center;">TIPO DE REFERENCIA</td>
				<td style="font-size:0.5em;align:center;">FOLIO REFERENCIA</td>
				<td style="font-size:0.5em;align:center;">FECHA REFERENCIA</td>
				<td style="font-size:0.5em;align:center;">RAZON REFERENCIA</td>
			</tr>';

			for($i=0;$i<$totalReferencia;$i++)
			{
				$timbre++;
				$htmlnocedible.='
				<tr>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->TpoDocRef.' / '.getDetalleReferencia($xml->SetDTE->DTE->Documento->Referencia[$i]->TpoDocRef)[1]["ref_glosa"].'</td>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->FolioRef.'</td>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->FchRef.'</td>
					<td style="font-size:0.5em;">'.$xml->SetDTE->DTE->Documento->Referencia[$i]->RazonRef.'</td>
				</tr>
				';
			}
			$htmlnocedible.='</table>';
		}

// DETALLE DE LOS PRODUCTOS


		$htmlnocedible.='<br><br>
		<table border="1" width="100%">
			<tr>
				<td colspan="7" align="center" style="font-size:0.6em;">DETALLE DE PRODUCTOS</td>
			</tr>
			<tr align="center">
				<td style="font-size:0.6em;">#</td>
				<td style="font-size:0.6em;">DETALLE</td>
				<td style="font-size:0.6em;">CANTIDAD</td>
				<td style="font-size:0.6em;">U.M</td>
				<td style="font-size:0.6em;">UNITARIO</td>
				<td style="font-size:0.6em;">% DESCUENTO</td>
				<td style="font-size:0.6em;">SUBTOTAL</td>
			</tr>
		</table>

		<table border="0" width="100%" style="border:1px solid black;">
			';

			for($i=0;$i<$totalElementos;$i++){
				$htmlnocedible.='
				<tr align="center">
					<td style="font-size:0.6em;">'.$xml->SetDTE->DTE->Documento->Detalle[$i]->NroLinDet.'</td>
					<td style="font-size:0.6em;">'.utf8_decode($xml->SetDTE->DTE->Documento->Detalle[$i]->NmbItem).'</td>
					<td style="font-size:0.6em;">'.$xml->SetDTE->DTE->Documento->Detalle[$i]->QtyItem.'</td>
					<td style="font-size:0.6em;">'.$xml->SetDTE->DTE->Documento->Detalle[$i]->UnmdItem.'</td>
					<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Detalle[$i]->PrcItem),0,".",".").'</td>
					<td style="font-size:0.6em;">'.(floatval($xml->SetDTE->DTE->Documento->Detalle[$i]->DescuentoPct) * 100).'</td>
					<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Detalle[$i]->MontoItem),0,".",".").'</td>
				</tr>';
			}
			for($i=0;$i<$diferencia;$i++) {
				$htmlnocedible.='
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>';
			}
			$htmlnocedible.='</table>';


// TOTALES FINALES
			$pdf->setCellPaddings(0,0,0,0);
			$params = $pdf->serializeTCPDFtagParameters(array($TED, 'PDF417', 10, '', 0, 40, array('border' => 1,'vpadding' => 'auto','hpadding' => 'auto','fgcolor' => array(0,0,0),'bgcolor' => false,'module_width' => 2,'module_height' => 2), 'N'));
			$htmlnocedible.='<br><br>
			<table border="0" width="100%">
				<tr>
					<td style="font-size:0.6em;">SON : '.utf8_encode($monto_escrito).'</td>
				</tr>
			</table>
			<br><br>
			<table border="0" width="100%">
				<tr>
					<td width="43%">';
						// $htmlnocedible .= '<tcpdf method="write2DBarcode" params="'.$params.'" />
						$htmlnocedible.='
						<table border="0" align="center" cellpadding="1">
						<tr>
						<td><img src="'.$image->encoded.'" /></td>
						</tr>
							<tr>
								<td style="font-size:0.6em;">Timbre Electrónico SII</td>
							</tr>

							<tr>	
								<td style="font-size:0.6em;">Res.'.$numero_resolucion.' de '.$fecha_resolucion[0].' Verifique documento: www.sii.cl</td>
							</tr>
						</table>
						';
						$htmlnocedible.='</td>
						<td width="57%">
							<table border="1" width="100%" cellpadding="3">
								
								';

								if(count($xml->SetDTE->DTE->Documento->DscRcgGlobal) > 0)
								{
									$timbre++;
									$tipo = ($xml->SetDTE->DTE->Documento->DscRcgGlobal->TpoMov == "D") ? "DESCUENTO" : "RECARGO";
									$htmlnocedible.='
									<tr style="border:1px solid red;">
										<td style="font-size:0.6em;">'.$tipo.'</td>
										<td style="font-size:0.6em;">'.$xml->SetDTE->DTE->Documento->DscRcgGlobal->TpoValor.' '.$xml->SetDTE->DTE->Documento->DscRcgGlobal->ValorDR.'</td>
									</tr>
									';
								}

								$htmlnocedible.='
								<tr>
									<td style="font-size:0.6em;">NETO</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->MntNeto),0,".",".").'</td>
								</tr>

								<tr>
									<td style="font-size:0.6em;">EXENTO</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->MntExe),0,".",".").'</td>
								</tr>

								<tr>
									<td style="font-size:0.6em;">'.$xml->SetDTE->DTE->Documento->Encabezado->Totales->TasaIVA.' % IVA</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->IVA),0,".",".").'</td>
								</tr>

								<tr>
									<td style="font-size:0.6em;">TOTAL</td>
									<td style="font-size:0.6em;">$'.number_format(intval($xml->SetDTE->DTE->Documento->Encabezado->Totales->MntTotal),0,".",".").'</td>
								</tr>
								';

								$htmlnocedible.='</table>	
							</td>
						</tr>
					</table>
					';
               		//TERMINA HTMLNOCEDIBLE
					//$pdf->AddPage();
					//$pdf->writeHTML($htmlnocedible, true, 0, true, 0);
					$pdf->AddPage();
					// $pdf->writeHTML($htmlnocedible, true, 0, true, 0);
					// $pdf->AddPage();
					$pdf->writeHTML($html, true, 0, true, 0);
					ob_end_clean();
					$pdf->Output("F".$xml->SetDTE->DTE->Documento->Encabezado->IdDoc->Folio."T".$xml->SetDTE->Caratula->SubTotDTE->TpoDTE.".pdf", 'I');

					function num2letras($num, $fem = false, $dec = true) { 
						$matuni[2]  = "dos"; 
						$matuni[3]  = "tres"; 
						$matuni[4]  = "cuatro"; 
						$matuni[5]  = "cinco"; 
						$matuni[6]  = "seis"; 
						$matuni[7]  = "siete"; 
						$matuni[8]  = "ocho"; 
						$matuni[9]  = "nueve"; 
						$matuni[10] = "diez"; 
						$matuni[11] = "once"; 
						$matuni[12] = "doce"; 
						$matuni[13] = "trece"; 
						$matuni[14] = "catorce"; 
						$matuni[15] = "quince"; 
						$matuni[16] = "dieciseis"; 
						$matuni[17] = "diecisiete"; 
						$matuni[18] = "dieciocho"; 
						$matuni[19] = "diecinueve"; 
						$matuni[20] = "veinte"; 
						$matunisub[2] = "dos"; 
						$matunisub[3] = "tres"; 
						$matunisub[4] = "cuatro"; 
						$matunisub[5] = "quin"; 
						$matunisub[6] = "seis"; 
						$matunisub[7] = "sete"; 
						$matunisub[8] = "ocho"; 
						$matunisub[9] = "nove"; 

						$matdec[2] = "veint"; 
						$matdec[3] = "treinta"; 
						$matdec[4] = "cuarenta"; 
						$matdec[5] = "cincuenta"; 
						$matdec[6] = "sesenta"; 
						$matdec[7] = "setenta"; 
						$matdec[8] = "ochenta"; 
						$matdec[9] = "noventa"; 
						$matsub[3]  = 'mill'; 
						$matsub[5]  = 'bill'; 
						$matsub[7]  = 'mill'; 
						$matsub[9]  = 'trill'; 
						$matsub[11] = 'mill'; 
						$matsub[13] = 'bill'; 
						$matsub[15] = 'mill'; 
						$matmil[4]  = 'millones'; 
						$matmil[6]  = 'billones'; 
						$matmil[7]  = 'de billones'; 
						$matmil[8]  = 'millones de billones'; 
						$matmil[10] = 'trillones'; 
						$matmil[11] = 'de trillones'; 
						$matmil[12] = 'millones de trillones'; 
						$matmil[13] = 'de trillones'; 
						$matmil[14] = 'billones de trillones'; 
						$matmil[15] = 'de billones de trillones'; 
						$matmil[16] = 'millones de billones de trillones'; 

   //Zi hack
						$float=explode('.',$num);
						$num=$float[0];

						$num = trim((string)@$num); 
						if ($num[0] == '-') { 
							$neg = 'menos '; 
							$num = substr($num, 1); 
						}else 
						$neg = ''; 
						while ($num[0] == '0') $num = substr($num, 1); 
						if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
						$zeros = true; 
						$punt = false; 
						$ent = ''; 
						$fra = ''; 
						for ($c = 0; $c < strlen($num); $c++) { 
							$n = $num[$c]; 
							if (! (strpos(".,'''", $n) === false)) { 
								if ($punt) break; 
								else{ 
									$punt = true; 
									continue; 
								} 

							}elseif (! (strpos('0123456789', $n) === false)) { 
								if ($punt) { 
									if ($n != '0') $zeros = false; 
									$fra .= $n; 
								}else 

								$ent .= $n; 
							}else 

							break; 

						} 
						$ent = '     ' . $ent; 
						if ($dec and $fra and ! $zeros) { 
							$fin = ' coma'; 
							for ($n = 0; $n < strlen($fra); $n++) { 
								if (($s = $fra[$n]) == '0') 
									$fin .= ' cero'; 
								elseif ($s == '1') 
									$fin .= $fem ? ' una' : ' un'; 
								else 
									$fin .= ' ' . $matuni[$s]; 
							} 
						}else 
						$fin = ''; 
						if ((int)$ent === 0) return 'Cero ' . $fin; 
						$tex = ''; 
						$sub = 0; 
						$mils = 0; 
						$neutro = false; 
						while ( ($num = substr($ent, -3)) != '   ') { 
							$ent = substr($ent, 0, -3); 
							if (++$sub < 3 and $fem) { 
								$matuni[1] = 'una'; 
								$subcent = 'as'; 
							}else{ 
								$matuni[1] = $neutro ? 'un' : 'uno'; 
								$subcent = 'os'; 
							} 
							$t = ''; 
							$n2 = substr($num, 1); 
							if ($n2 == '00') { 
							}elseif ($n2 < 21) 
							$t = ' ' . $matuni[(int)$n2]; 
							elseif ($n2 < 30) { 
								$n3 = $num[2]; 
								if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
								$n2 = $num[1]; 
								$t = ' ' . $matdec[$n2] . $t; 
							}else{ 
								$n3 = $num[2]; 
								if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
								$n2 = $num[1]; 
								$t = ' ' . $matdec[$n2] . $t; 
							} 
							$n = $num[0]; 
							if ($n == 1) { 
								$t = ' ciento' . $t; 
							}elseif ($n == 5){ 
								$t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
							}elseif ($n != 0){ 
								$t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
							} 
							if ($sub == 1) { 
							}elseif (! isset($matsub[$sub])) { 
								if ($num == 1) { 
									$t = ' mil'; 
								}elseif ($num > 1){ 
									$t .= ' mil'; 
								} 
							}elseif ($num == 1) { 
								$t .= ' ' . $matsub[$sub] . 'on'; 
							}elseif ($num > 1){ 
								$t .= ' ' . $matsub[$sub] . 'ones'; 
							}   
							if ($num == '000') $mils ++; 
							elseif ($mils != 0) { 
								if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
								$mils = 0; 
							} 
							$neutro = true; 
							$tex = $t . $tex; 
						} 
						$tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   // $end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
						if(count($float)>1){
							$end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
						}else{
// $end_num=ucfirst($tex).' pesos 00/100 M.N.';
							$end_num=ucfirst($tex).' pesos.';
						}
						return $end_num; 
					}

					?>