<?php
include("inc/config.php");
extract($_POST);

if(isset($cmd))
{
	$cmd = htmlspecialchars($cmd);
	$cmd = htmlentities($cmd);


	switch ($cmd) {
		case 'getPatente':
			getPatente($_POST);
			break;
		
		default:
			# code...
			break;
	}
}

function getPatente($input)
{
	$arrChoferes = array();
	$arrPatentes = array();

	// $choferes = "SELECT DISTINCT(transporte_chofer), transporte_chofer FROM transporte WHERE transporte_empresa_id = ".$input["empresa_id"];
	$choferes = "SELECT * FROM bode_chofer WHERE chofer_empresa_id = ".$input["empresa_id"]." AND chofer_estado = 1";
	$choferes = mysql_query($choferes);

	// $patentes = "SELECT DISTINCT(transporte_patente), transporte_patente FROM transporte WHERE transporte_empresa_id = ".$input["empresa_id"];
	$patentes = "SELECT * FROM bode_patente WHERE patente_empresa_id = ".$input["empresa_id"]." AND patente_estado = 1";
	$patentes = mysql_query($patentes);


	while ($row = mysql_fetch_array($choferes)) {
		$arrChoferes[] = $row;
	}

	while ($row = mysql_fetch_array($patentes)) {
		$arrPatentes[] = $row;
	}

	$retorno = array();
	$retorno = array("Choferes" => $arrChoferes,"Patentes" => $arrPatentes);
	echo json_encode($retorno);
}
?>