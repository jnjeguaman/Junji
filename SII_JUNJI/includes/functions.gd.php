<?php
require_once("inc/class.gd.php");
extract($_POST);

switch ($cmd) {
	case 'anularFolio':
		anularFolio($_POST);
		break;

		case 'anularGuia':
			anularGuia($_POST);
			break;
	
	default:
		# code...
		break;
}

function anularFolio($input)
{
	$objGD = new GD();
	echo json_encode($objGD->anularFolio($input));
}

function anularGuia($input)
{
	$objGD = new GD();
	echo json_encode($objGD->anularGuia($input));
}

?>