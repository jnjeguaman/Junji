<?php
require_once("inc/class.acceso.php");

function getAcceso($input)
{
	$objAcceso = new Acceso($input);
	return $objAcceso->getAcceso();
}
?>