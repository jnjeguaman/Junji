<?php
extract($_POST);
require_once("inc/class.producto.php");
if(isset($cmd))
{
	switch ($cmd) {
		case 'crearProducto':
			echo json_encode(crearProducto($_POST));
			break;
		case 'getProductos':
			echo json_encode(getProductos($_POST));
			break;

			case 'actualizarProducto':
				echo json_encode(actualizarProducto($_POST));
				break;
	}
}

function crearProducto($input)
{
	$objProducto = new Producto();
	return $objProducto->crearProducto($input);
}

function getProductos($input)
{
	$objProducto = new Producto();
	return $objProducto->getProductos($input);
}

function getDetalleProducto($input)
{
	$objProducto = new Producto();
	return $objProducto->getDetalleProducto($input);
}

function actualizarProducto($input)
{
	$objProducto = new Producto();
	return $objProducto->actualizarProducto($input);
}

?>