<?php
require_once("inc/class.librogd.php");
extract($_POST);

function getGDPeriodo($input,$region)
{
	$objGD = new LibroGD();
	return $objGD->getGDPeriodo($input,$region);
}

function getDetalle($input,$region)
{
	$objGD = new LibroGD();
	return $objGD->getDetalle($input,$region);
}

function getAnulados($input,$region)
{
	$objGD = new LibroGD();
	return $objGD->getAnulados($input,$region);
}

function getTraslados($input,$region)
{
	$objGD = new LibroGD();
	return $objGD->getTraslados($input,$region);
}

function getHistorial($input)
{
	$objGD = new LibroGD();
	return $objGD->getHistorial($input);
}

function getDetalleEnvio($input,$region)
{
	$objGD = new LibroGD();
	return $objGD->getDetalleEnvio($input,$region);
}
?>