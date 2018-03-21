<?php
require_once("inc/class.login.php");
extract($_POST);

switch ($cmd) {
	case 'login':
		login($_POST);
		break;
	
	default:
		# code...
		break;
}

function login($input)
{
	$objLogin = new Login($input["usuario_rut"],$input["usuario_password"]);
	echo json_encode($objLogin->login());
}
?>