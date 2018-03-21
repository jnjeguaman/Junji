<?php
require_once("inc/class.correo.php");
extract($_POST);

switch ($cmd) {
	case 'enviarCorreo':
		enviarCorreo($trackid,$region);
		break;
	
	default:
		# code...
		break;
}

function enviarCorreo($trackid,$region)
{
	$objCorreo = new Correo ($trackid,$region);
	echo json_encode($objCorreo->enviarCorreo());
}


?>