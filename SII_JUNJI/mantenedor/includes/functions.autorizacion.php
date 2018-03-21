<?php
require_once("inc/class.autorizado.php");
extract($_POST);

if($cmd <> "")
{
	switch ($cmd) {
		case 'actualizarAutorizacion':
		echo json_encode(actualizarAutorizacion($_POST));
		break;
		
		case 'actualizarAutorizacionEstado':
		echo json_encode(actualizarAutorizacionEstado($_POST));
		break;

		default:
			# code...
		break;
	}
}
function getAutorizaciones($input)
{
	$objAutorizado = new Autorizado();
	return $objAutorizado->getAutorizaciones($input);
}

function actualizarAutorizacion($input)
{
	$objAutorizado = new Autorizado();
	return $objAutorizado->actualizarAutorizacion($input);
}

function actualizarAutorizacionEstado($input)
{
	$objAutorizado = new Autorizado();
	return $objAutorizado->actualizarAutorizacionEstado($input);
}
?>