<?php
ini_set("display_errors", 1);
require_once("inc/class.procesar.php");
if (isset($_REQUEST["command"]) && $_REQUEST["command"] <> "") {
	$cmd = htmlentities($_REQUEST["command"]);
	$cmd = htmlspecialchars($cmd);

	switch ($cmd) {
		case 'generaXML':
		generaXML($_POST);
		break;
	}
}

function generaXML($input)
{
	$objProcesar = new Procesar($input);
	echo json_encode($objProcesar->GenerarXML());
}

?>
