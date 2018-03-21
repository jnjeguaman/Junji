<?php
require_once("inc/class.comuna.php");

function getComunas()
{
	$objComuna = new Comunas();
	return $objComuna->getComunas();

}
?>