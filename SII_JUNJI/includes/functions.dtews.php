<?php
require_once("inc/class.dtews.php");
if(isset($_POST["cmd"]) && $_POST["cmd"] <> "")
{
	$cmd = $_POST["cmd"];


	switch ($cmd) {
		case 'consultarDocDteCedible':
		echo json_encode(consultarDocDteCedible($_POST));
		break;

		case 'listarEventosHistDoc':
			echo json_encode(listarEventosHistDoc($_POST));
			break;

			case 'ingresarAceptacionReclamoDoc':
				echo json_encode(ingresarAceptacionReclamoDoc($_POST));
				break;
		
		default:
			# code...
		break;
	}
}

function grabarRecibido($input)
{
	$objRecibido = new dteWS();
	return $objRecibido->grabarRecibido($input);
}

function consultarDocDteCedible($input)
{
	$objRecibido = new dteWS();
	return $objRecibido->consultarDocDteCedible($input);
}

function getDocumentos($periodo_annio,$periodo_mes)
{
	$objRecibido = new dteWS();
	return $objRecibido->getDocumentos($periodo_annio,$periodo_mes);
}

function listarEventosHistDoc($input)
{
	$objRecibido  = new dteWS();
	return $objRecibido->listarEventosHistDoc($input);
}

function getDetalleDocumento($input)
{
	$objRecibido = new dteWS();
	return $objRecibido->getDetalleDocumento($input);
}

function getHistorial($input)
{
	$objRecibido = new dteWS();
	return $objRecibido->getHistorial($input);
}

function ingresarAceptacionReclamoDoc($input)
{
	$objRecibido = new dteWS();
	return $objRecibido->ingresarAceptacionReclamoDoc($input);
}

?>