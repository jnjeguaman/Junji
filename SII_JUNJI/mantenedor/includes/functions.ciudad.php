<?php
require_once("inc/class.ciudad.php");
extract($_POST);

if(isset($cmd))
{
	switch ($cmd) {
		case 'getCiudades':
			echo json_encode(getCiudades($_POST));
			break;
	}
}

function getCiudades($input)
{
	$objCiudades = new Ciudades();
	return $objCiudades->getCiudades($input);
}
?>