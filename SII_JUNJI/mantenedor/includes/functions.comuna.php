<?php
require_once("inc/class.comuna.php");
extract($_POST);

if(isset($cmd))
{
	switch ($cmd) {
		case 'getComunas':
			echo json_encode(getComunas($_POST));
			break;
	}
}

function getComunas($input)
{
	$objComunas = new Comunas();
	return $objComunas->getComunas($input);
}
?>