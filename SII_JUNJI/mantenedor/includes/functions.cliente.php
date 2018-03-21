<?php
require_once("inc/class.cliente.php");
extract($_POST);

if(isset($cmd))
{
	switch ($cmd) {
		case 'nuevoCliente':
		echo json_encode(nuevoCliente($_POST));
		break;

		case 'editarCliente':
			echo json_encode(editarCliente($_POST));
			break;
	}
}

function nuevoCliente($input)
{
	$objCliente = new Cliente($input);
	return $objCliente->nuevoCliente();
}

function getClientes()
{
	$objCliente = new Cliente();
	return $objCliente->getClientes();
}

function getDetalleCliente($input)
{
	$objCliente = new Cliente();
	return $objCliente->getDetalleCliente($input);
}

function editarCliente($input)
{
	$objCliente = new Cliente($input);
	return $objCliente->editarCliente($input);
}

function cargaExcel($input)
{
	$objCliente = new Cliente($input);
	return $objCliente->cargaExcel();
}
?>