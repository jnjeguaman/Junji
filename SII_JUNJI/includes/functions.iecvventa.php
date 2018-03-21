<?php
require_once("inc/class.iecvventa.php");

function getResumenCompra()
{
	$objIECV = new IECV();
	return $objIECV->getResumenCompra();
}

function getDetalleCompra()
{
	$objIECV = new IECV();
	return $objIECV->getDetalleCompra();
}


function getResumenVenta()
{
	$objIECV = new IECV();
	return $objIECV->getResumenVenta();
}

function getDetalleVenta()
{
	$objIECV = new IECV();
	return $objIECV->getDetalleVenta();
}

function cargarXML($input)
{
	$objIECV = new IECV();
	return $objIECV->cargarXML($input);
}

function getIECV()
{
	$objIECV = new IECV();
	return $objIECV->getIECV();
}

function getDTECompras($input,$tipo)
{
	$objIECV = new IECV();
	return $objIECV->getDTECompras($input,$tipo);
}

function getDTEVentas($input)
{
	$objIECV = new IECVVenta();
	return $objIECV->getDTEVentas($input);
}

function getIECVPeriodo($input)
{
	$objIECV = new IECV();
	return $objIECV->getIECVPeriodo($input);
}

function getIECVPeriodoVentas($input)
{
	$objIECV = new IECVVenta();
	return $objIECV->getIECVPeriodoVentas($input);
}

?>