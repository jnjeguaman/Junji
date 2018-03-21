<?php
require_once("inc/class.recibo.php");

function cargarXML($input,$path,$file,$region)
{
	$objRecibo = new Recibo();
	return $objRecibo->cargarXML($input,$path,$file,$region);
}

function cargarXMLSII($input,$file,$region)
{
	$objRecibo = new Recibo();
	return $objRecibo->cargarXMLSII($input,$file,$region);
}


function getDTERecibidos($input)
{
	$objRecibo = new Recibo();
	return $objRecibo->getDTERecibidos($input);
}

function getDTERecibidosCompletados($input)
{
	$objRecibo = new Recibo();
	return $objRecibo->getDTERecibidosCompletados($input);
}
function getDetalleRecibo($input)
{
$objRecibo = new Recibo();
	return $objRecibo->getDetalleRecibo($input);	
}

function getDetalleArchivo($input)
{
$objRecibo = new Recibo();
	return $objRecibo->getDetalleArchivo($input);	
}

function getDetalleArchivo3($input)
{
$objRecibo = new Recibo();
	return $objRecibo->getDetalleArchivo3($input);	
}

function verificaDuplicidad($emisor_tipo_documento,$emisor_folio,$emisor_rut,$emisor_dv,$emisor_archivo)
{
	$objRecibo = new Recibo();
	return $objRecibo->verificaDuplicidad($emisor_tipo_documento,$emisor_folio,$emisor_rut,$emisor_dv,$emisor_archivo);
}

function verificaDuplicidadDTE($recibido_tipo_dcto,$recibido_folio,$recibido_digest,$recibido_dteid)
{
	$objRecibo = new Recibo();
	return $objRecibo->verificaDuplicidadDTE($recibido_tipo_dcto,$recibido_folio,$recibido_digest,$recibido_dteid);
}

function verificaFirma($ruta,$archivo)
{
	$objRecibo = new Recibo();
	return $objRecibo->verificaFirma($ruta,$archivo);
}
?>