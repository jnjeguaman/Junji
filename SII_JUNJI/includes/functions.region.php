<?php
require_once("inc/class.region.php");

function getRegiones()
{
	$objRegion = new Regiones();
	return $objRegion->getRegiones();

}

function getRegiones2()
{
	$objRegiones = new Regiones();
	return $objRegiones->getRegiones2();
}

?>