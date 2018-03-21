<?php
extract($_POST);
require_once("inc/class.iecvcompra.php");

if(isset($cmd) && $cmd == "cargarXML")
{
	switch ($cmd) {
		case 'cargarXML':
			echo json_encode(cargarXML($_POST));
			break;
		
		default:
			# code...
			break;
	}
}

function getHistorial($input)
{
	$objIECV = new IECVCompra();
	return $objIECV->getHistorial($input);
}
function getResumenCompra()
{
	$objIECV = new IECVCompra();
	return $objIECV->getResumenCompra();
}

function getDetalleCompra()
{
	$objIECV = new IECVCompra();
	return $objIECV->getDetalleCompra();
}


function getResumenVenta()
{
	$objIECV = new IECVCompra();
	return $objIECV->getResumenVenta();
}

function getDetalleVenta()
{
	$objIECV = new IECVCompra();
	return $objIECV->getDetalleVenta();
}

function cargarXML($input)
{
	$objIECV = new IECVCompra();
	return $objIECV->cargarXML($input);
}

function getIECV()
{
	$objIECV = new IECVCompra();
	return $objIECV->getIECV();
}

function getDTECompras($input)
{
	$objIECV = new IECVCompra();
	return $objIECV->getDTECompras($input);
}

function getDTEVentas($input)
{
	$objIECV = new IECVCompra();
	return $objIECV->getDTEVentas($input);
}

function getIECVPeriodo($input)
{
	$objIECV = new IECVCompra();
	return $objIECV->getIECVPeriodo($input);
}

function getIECVPeriodoVentas($input)
{
	$objIECV = new IECVCompra();
	return $objIECV->getIECVPeriodoVentas($input);
}

?>