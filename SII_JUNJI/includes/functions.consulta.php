<?php
require_once("inc/class.consulta.php");

if(isset($_REQUEST["command"]))
{
	$cmd = htmlspecialchars($_REQUEST["command"]);
	$cmd = htmlentities($cmd);

	switch ($cmd) {
		case 'QueryEstDteAv':
			QueryEstDteAv($_POST);
			break;
		
		case 'QueryEstDte':
			QueryEstDte($_POST);
			break;

			case 'QueryEstUp':
				QueryEstUp($_POST);
				break;
		default:
			# code...
			break;
	}
}

function QueryEstDteAv($input)
{
	$objConsulta = new Consulta($input["consultante_rut"],$input["consultante_dv"]);
	echo json_encode($objConsulta->QueryEstDteAv($input));
}

function QueryEstDte($input)
{
	$objConsulta = new Consulta($input["consultante_rut"],$input["consultante_dv"]);
	echo json_encode($objConsulta->QueryEstDte($input));
}

function QueryEstUp($input)
{
	$objConsulta = new Consulta($input["consultante_rut"],$input["consultante_dv"]);
	echo json_encode($objConsulta->QueryEstUp($input));
}
?>