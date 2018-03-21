<?php
require_once("inc/class.provincia.php");
extract($_POST);

if(isset($cmd))
{
	switch ($cmd) {
		case 'getProvincias':
			getProvincias($provincia_region_id);
			break;
		
		default:
			# code...
			break;
	}
}


function getProvincias($input)
{
	$objProvincia = new Provincia($input);
	echo json_encode($objProvincia->getProvincias());
}
?>