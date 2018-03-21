<?php 
require_once("inc/class.bodega.php");


function getDatosBodega($input)
{
	$objBodega = new Bodega();
	return $objBodega->getDatosBodega($input);
}
?>