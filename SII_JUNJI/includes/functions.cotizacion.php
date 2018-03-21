<?php
require_once("inc/class.cotizacion.php");
extract($_POST);

switch ($cmd) {
	case 'crearCotizacion':
	crearCotizacion($_POST);
	break;

	case 'eliminarProducto':
	eliminarProducto($_POST["detalle_id"]);
	break;

	case 'cerrarCotizacion':
	cerrarCotizacion($_POST);
	break;
	
	default:
		# code...
	break;
}

function crearCotizacion($input)
{
	$objCotizacion = new Cotizacion();
	echo json_encode($objCotizacion->crearCotizacion($input));
}

function agregarProducto($input)
{
	$objCotizacion = new Cotizacion();
	return $objCotizacion->agregarProducto($input);
}

function getDetalleCotizacion($input)
{
	$objCotizacion = new Cotizacion();
	return $objCotizacion->getDetalleCotizacion($input);
}

function eliminarProducto($input)
{
	$objCotizacion = new Cotizacion();
	echo json_encode($objCotizacion->eliminarProducto($input));
}

function cerrarCotizacion($input)
{
	$objCotizacion = new Cotizacion();
	echo json_encode($objCotizacion->cerrarCotizacion($input));
}

function getCotizaciones($region)
{
	$objCotizacion = new Cotizacion();
	return $objCotizacion->getCotizaciones($region);
}

function getCotizacion($input)
{
	$objCotizacion = new Cotizacion();
	return $objCotizacion->getCotizacion($input);
}
?>