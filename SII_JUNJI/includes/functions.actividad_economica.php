<?php
require_once("inc/class.actividad_economica.php");

function getActividadEconomica()
{
	$objActividadEconomica = new ActividadEconomica();
	return $objActividadEconomica->getActividadEconomica();
}
?>