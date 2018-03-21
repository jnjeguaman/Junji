<?php
require_once("inc/class.empresa.php");
extract($_POST);

switch ($cmd) {
	case 'actualizarEmpresa':
		actualizarEmpresa($_POST);
		break;
	
	default:
		# code...
		break;
}
function getEmpresa($input)
{
	$objEmpresa = new Empresa();
	return $objEmpresa->getEmpresa($input);
}

function actualizarEmpresa($input)
{
	$objEmpresa = new Empresa();
	echo json_encode($objEmpresa->actualizarEmpresa($input));
}

function getEmpresas()
{
	$objEmpresa = new Empresa();
	return $objEmpresa->getEmpresas();
}
?>