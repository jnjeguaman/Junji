<?php
require_once("inc/class.dte.php");
if(isset($_POST["cmd"]) && $_POST["cmd"] <> "")
{
	$cmd = $_POST["cmd"];
	$datos = [
	0 => $_POST["ruta"],
	1 => $_POST["archivo"]
	];
	switch ($cmd) {
		case 'reenviarSII':
			echo json_encode(reenviarSII($datos));
			break;
		
		default:
			# code...
			break;
	}
}


function reenviarSII($input)
{
	$objDTE = new DTE();
	return $objDTE->reenviarSII($input);
}
?>