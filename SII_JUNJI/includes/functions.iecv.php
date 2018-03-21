<?php
require_once("inc/class.iecv.php");

function getHistorialIECV($periodo,$tipo)
{
	$objIECV = new IECV();
	return $objIECV->getHistorialIECV($periodo,$tipo); 
}
?>