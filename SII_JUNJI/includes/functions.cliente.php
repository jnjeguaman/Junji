<?php
require_once("inc/class.cliente.php");
extract($_POST);

if(isset($_POST["command"]) && $_POST["command"] <> "")
{
	$command = htmlspecialchars($command);
	$command = htmlentities($command);

	switch ($command) {
		case 'getClienteDetalle':
			echo json_encode(getClienteDetalle($_POST));
			break;
	    case 'getClienteDetalleRut':
			echo json_encode(getClienteDetallePorRutUnico($_POST));
			break;
		default:
			# code...
			break;
	}
}

function getClientesGlobal()
{
	$objCliente = new Cliente();
	return $objCliente->getClientesGlobal();
}
function getClientes($tipo)
{
	$objCliente = new Cliente();
	return $objCliente->getClientes($tipo);
}

function getClienteDetalle($input)
{
	$objCliente = new Cliente();
	return $objCliente->getClienteDetalle($input);
}

function getClienteDetallePorRut($input)
{
	$objCliente = new Cliente();
	return $objCliente->getClienteDetallePorRut($input);
}

function getActividadEconomica($input)
{
	$objCliente = new Cliente();
	return $objCliente->getActividadEconomica($input);
}

function getClienteDetallePorRutUnico($input)
{
	$objCliente = new Cliente();
	return $objCliente->getClienteDetallePorRutUnico($input);
}

function getMisClientes()
{
	$objCliente = new Cliente();
	return $objCliente->getMisClientes();
}
?>