<?php
require_once("inc/class.estadistica.php");

function getConsumoFolio()
{
	$objEstadistica = new Estadisticas();
	return $objEstadistica->getConsumoFolio();
}

function getDTEEmitidos($region,$periodo)
{
	$objEstadistica = new Estadisticas();
	return $objEstadistica->getDTEEmitidos($region,$periodo);
}
?>