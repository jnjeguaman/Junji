<?php
session_start();
require("inc/config.php");

if(isset($_REQUEST["cmd"]))
{
	$cmd =  htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch ($cmd) {
		case 'ultimaCompra':
			ultimaCompra($_POST);
			break;
		
		default:
			# code...
			break;
	}
}

function ultimaCompra($input)
{
	$sql = "SELECT * FROM acti_compra_temporal WHERE compra_region_id = ".$input["region_id"]." AND compra_usr = '".$_SESSION["nom_user"]."' ORDER BY compra_id DESC LIMIT 1";
	$sql = mysql_query($sql);
	$sql = mysql_fetch_array($sql);
	$compra_id = intval($sql["compra_id"]);

	if(existeCompra($compra_id)){
		echo json_encode(true);
	}else{
	echo json_encode($sql);

	}
	
}

function existeCompra($input)
{
	$sql = "SELECT count(compra_id) as Total FROM acti_compra WHERE compra_id = ".$input;
	$sql = mysql_query($sql);
	$sql = mysql_fetch_array($sql);
	$sql = intval($sql["Total"]);
	$respuesta = false;
	if($sql > 0){
		$respuesta = true;
	}
	return $respuesta;
}

?>