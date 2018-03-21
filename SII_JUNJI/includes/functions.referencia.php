<?php
require_once("inc/class.referencia.php");

if(isset($_POST['iddoc'])){

	//var_dump(Referencia::getImpuestosAsociadosDocumento($_GET['iddoc']));
	//exit();
	$response = array();
	$data = Referencia::getImpuestosAsociadosDocumento($_POST['iddoc']);
	foreach ($data as $key => $value) {
		$response[]  = json_encode($value);
	}
 echo json_encode($response);
}

function getDetalleReferencia($input)
{
	$objReferencia = new Referencia();
	return $objReferencia->getDetalleReferencia($input);
}

function getReferencias($input)
{
	$objReferencia = new Referencia();
	return $objReferencia->getReferencias($input);
}

function getReferencia()
{
$objReferencia = new Referencia();
	return $objReferencia->getReferencia($input);	
}

function buscarReferencia($input)
{
$objReferencia = new Referencia();
	return $objReferencia->buscarReferencia($input);	
}

function getImpuestosAsociadosDocumento($input)
{
 return Referencia::getImpuestosAsociadosDocumento($input);
}

?>