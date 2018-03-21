<?php
session_start();
if(isset($_REQUEST["cmd"]))
{
	$cmd =  htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch ($cmd) {
		case 'validaOC':
			return validaOC($_POST);
			break;

	}
}


function validaOC($input)
{
	require("inc/config.php");
	// $valida = "SELECT COUNT(DISTINCT(oc_id)) as Total FROM compra_orden WHERE oc_numero = '".$input["oc"]."'";
	$valida = "SELECT COUNT(DISTINCT(oc_id)) as Total FROM bode_orcom WHERE oc_id2 = '".$input["oc"]."' AND oc_estado = 1 AND oc_tipo = 0";
	$valida = mysql_query($valida,$dbh6);
	$valida = mysql_fetch_array($valida);
	$valida = intval($valida["Total"]);

	$valida2 = "SELECT count(oc_id) as Total FROM compra_orden WHERE oc_numero = '".$input["oc"]."'";
	$valida2 = mysql_query($valida2,$dbh);
	$valida2 = mysql_fetch_array($valida2);
	$valida2 = intval($valida2["Total"]);
	if( ($valida + $valida2) >= 1)
	{
		echo json_encode(true);
	}else{
		echo json_encode(false);
	}
}
?>