<?php
require_once("inc/class.recinto.php");

function getRecintos($input)
{
	$objRecintos = new Recinto($input);
	return $objRecintos->getRecintos();
}
?>