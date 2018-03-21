<?php 
require_once("inc/class.usuario.php");
extract($_POST);

switch ($cmd) {
	case 'actualizarUsuario':
		actualizarUsuario($_POST);
		break;
	
	default:
		# code...
		break;
}

function actualizarUsuario($input)
{
$objUsuario = new Usuario($input["usuario_id"]);
echo json_encode($objUsuario->actualizarUsuario($input));
}

function getDetalleUsuario($input)
{
	$objUsuario = new Usuario($input);
	return $objUsuario->getDetalleUsuario();
}
?>