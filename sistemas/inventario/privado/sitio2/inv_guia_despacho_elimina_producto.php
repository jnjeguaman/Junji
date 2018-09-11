<?php
session_start();
if(isset($_REQUEST["cmd"]))
{
	$cmd = htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch ($cmd) {
		case 'eliminarItem':
		echo json_encode(eliminarItem($_POST));
		break;
	}
}


function eliminarItem($input)
{
	if(isset($_SESSION["items"]) && count($_SESSION["items"]) >= 1)
	{
		foreach ($_SESSION["items"] as $key => $value) {
			if(strcmp($value["inv_codigo"], $input["codigo"]) === 0)
			{
				unset($_SESSION["items"][$key]);
				$_SESSION["items"] = array_values($_SESSION["items"]);
				return rellenar($_SESSION["items"]);
				break;
			}
		}
	}
}


function rellenar($input)
{
	require("inc/config.php");
	$tabla = "";
	$arrayName = array();
	for ($i=0; $i < count($input); $i++) {
		$resp = "SELECT * FROM acti_inventario WHERE inv_codigo = ".$input[$i]["inv_codigo"];
		$resp = mysql_query($resp);
		$resp = mysql_fetch_array($resp);
		$arrayName[$i]["inv_codigo"] = $input[$i]['inv_codigo'];
		$arrayName[$i]["inv_bien"] = $resp['inv_bien'];
		$arrayName[$i]["inv_responsable"] = $resp['inv_responsable'];
		$arrayName[$i]["inv_direccion"] = $resp['inv_direccion'];
		$arrayName[$i]["inv_zona"] = $resp['inv_zona'];
		$arrayName[$i]["inv_costo"] = number_format($resp['inv_costo'],0,".",".");
	}
	return $arrayName;
}
?>