<?php
require_once("inc/class.categoria.php");
extract($_POST);
if(isset($cmd))
{
	switch ($cmd) {
		case 'crearCategoria':
			echo json_encode(crearCategoria($_POST));
			break;
		
		case 'editarCategoria':
			echo json_encode(editarCategoria($_POST));
			break;
	}
}

function crearCategoria($input)
{
	$objCategoria = new Categoria();
	return $objCategoria->crearCategoria($input);
}

function getCategorias()
{
	$objCategoria = new Categoria();
	return $objCategoria->getCategorias();
}

function getDetalleCategoria($input)
{
	$objCategoria = new Categoria();
	return $objCategoria->getDetalleCategoria($input);
}

function editarCategoria($input)
{
	$objCategoria = new Categoria();
	return $objCategoria->editarCategoria($input);
}

?>