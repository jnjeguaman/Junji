<?php
require_once("inc/class.producto.php");
extract($_POST);

switch ($cmd) {
	case 'getProductos':
		getProductos($_POST["categoria_id"]);
		break;

		case 'getUnitario':
			getUnitario($_POST);
			break;
	
	default:
		# code...
		break;
}


function getProductos($input)
{
	$objProductos = new Productos();
	echo json_encode($objProductos->getProductos($input));
}

function getUnitario($input)
{
	$objProductos = new Productos();
	echo json_encode($objProductos->getUnitario($input));
}
?>