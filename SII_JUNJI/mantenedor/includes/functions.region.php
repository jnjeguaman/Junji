<?php
require_once("inc/class.region.php");

function getRegiones()
{
	$objRegiones = new Regiones();
	return $objRegiones->getRegiones();
}

function getRegiones2()
{
	$objRegiones = new Regiones();
	return $objRegiones->getRegiones2();
}

?>