<?php
require_once("inc/class.empresa.php");
extract($_POST);

switch ($cmd) {
	case 'actualizarEmpresa':
		actualizarEmpresa($_POST);
		break;

		case 'getDetalleEmpresa':
			getDetalleEmpresa($_POST);
			break;
	
	default:
		# code...
		break;
}
function getDetalleEmpresa($input)
{
	$objEmpresa = new Empresa();
	echo json_encode($objEmpresa->getDetalleEmpresa($input));
}
function getEmpresa($input,$origen=null)
{
	$objEmpresa = new Empresa();
	return $objEmpresa->getEmpresa($input,$origen);
}

function actualizarEmpresa($input)
{
	$objEmpresa = new Empresa();
	echo json_encode($objEmpresa->actualizarEmpresa($input));
}

function getEmpresas($input)
{
	$objEmpresa = new Empresa();
	return $objEmpresa->getEmpresas($input);
}
?>