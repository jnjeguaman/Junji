<?php
require_once("inc/class.usuario.php");
extract($_POST);
switch ($cmd) {
	case 'crearUsuario':
	crearUsuario($_POST,$_FILES);
	break;

	case 'actualizarUsuario':
	actualizarUsuario($_POST);
	break;

	case 'actualizarPassword':
	actualizarPassword($_POST);
	break;

	case 'actualizarCertificado':
	actualizarCertificado($_POST,$_FILES);
	break;
}

function crearUsuario($input,$archivo)
{
	$objUsuario = new Usuario();
	echo json_encode($objUsuario->crearUsuario($input,$archivo));
}

function actualizarUsuario($input)
{
	$objUsuario = new Usuario();
	echo json_encode($objUsuario->actualizarUsuario($input));
}

function getUsuarios()
{
	$objUsuario = new Usuario();
	return $objUsuario->getUsuarios();
}

function getDetalleUsuario($input)
{
	$objUsuario = new Usuario();
	return $objUsuario->getDetalleUsuario($input);
}

function actualizarPassword($input)
{
	$objUsuario = new Usuario();
	echo json_encode($objUsuario->actualizarPassword($input));
}

function actualizarCertificado($input,$archivo)
{
	$objUsuario = new Usuario();
	echo json_encode($objUsuario->actualizarCertificado($input,$archivo));
}

?>