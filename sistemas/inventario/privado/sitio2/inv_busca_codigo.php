<?php 

if(isset($_REQUEST["cmd"]))
{
	$cmd = $_REQUEST["cmd"];

	switch ($cmd) {
		case 'buscarCodigo':
		echo json_encode(buscarCodigo($_POST));
		break;
	}
}


function buscarCodigo($input)
{
	session_start();
	require("inc/config.php");
	$limite = $input["limite"];

	// VERIFICAMOS QUE EL PRODUCTO EXISTA
	$sql = "SELECT * FROM acti_inventario WHERE inv_codigo = ".$input["inv_codigo"]." AND inv_region = ".$_SESSION["region"]." AND inv_estado2 = 1 AND inv_visible = 1 LIMIT 1";
	$res = mysql_query($sql);

	if(isset($_SESSION["items"]) && count($_SESSION["items"]) >= $limite)
	{
		//SE SUPERÓ EL LIMITE
		return 1;

	}else{
		// EXISTE EL PRODUCTO?
		if(mysql_num_rows($res) === 1)
		{
				$sql = mysql_fetch_array($res);
			
				// VERIFICAMOS SI EXISTE EN LA LISTA
			if(isset($_SESSION["items"]))
			{	
				if(!existeProducto($input["inv_codigo"]))
				{	
					$max = count($_SESSION["items"]);
					$_SESSION["items"][$max]["inv_id"] = $sql["inv_id"];
					$_SESSION["items"][$max]["inv_codigo"] = $input["inv_codigo"];
					$_SESSION["items"][$max]["inv_qty"] = 1;
					$_SESSION["items"][$max]["inv_responsable"] = $sql["inv_responsable"];
					$_SESSION["items"][$max]["inv_direccion"] = $sql["inv_direccion"];
					$_SESSION["items"][$max]["inv_zona"] = $sql["inv_zona"];
					return rellenaTabla($_SESSION["items"]);
				}else{
					return 3;					
				}
			}else{
				$_SESSION["items"] = array();
				$_SESSION["items"][0]["inv_id"] = $sql["inv_id"];
				$_SESSION["items"][0]["inv_codigo"] = $input["inv_codigo"];
				$_SESSION["items"][0]["inv_qty"] = 1;
				$_SESSION["items"][0]["inv_responsable"] = $sql["inv_responsable"];
				$_SESSION["items"][0]["inv_direccion"] = $sql["inv_direccion"];
				$_SESSION["items"][0]["inv_zona"] = $sql["inv_zona"];
				return rellenaTabla($_SESSION["items"]);
			}

		}else{
			//EL BIEN NO EXISTE
			return 2;
		}
	}

	
}

function existeProducto($input)
{
	try {
		$respuesta = false;
		foreach ($_SESSION["items"] as $key => $value) {
			if($_SESSION["items"][$key]["inv_codigo"] === $input)
			{
				$respuesta = true;
				break;
			}
		}
		return $respuesta;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}


function buscaProducto($input)
{
	require("inc/config.php");
	$sql = "SELECT * FROM acti_inventario WHERE inv_codigo = ".$input." AND inv_estado2 = 1 AND inv_visible = 1 LIMIT 1";
	$sql = mysql_query($sql);
	$respuesta = intval(mysql_num_rows($sql));
	return $respuesta;
}

function rellenaTabla($input)
{
	require("inc/config.php");
	$tabla = "";
	$arrayName = array();
	for ($i=0; $i < count($input); $i++) {
		$resp = "SELECT * FROM acti_inventario WHERE inv_codigo = ".$input[$i]["inv_codigo"]." AND inv_visible = 1";
		$resp = mysql_query($resp);
		$resp = mysql_fetch_array($resp);
		$arrayName[$i]["inv_codigo"] = $input[$i]['inv_codigo'];
		$arrayName[$i]["inv_bien"] = $resp['inv_bien'];
		$arrayName[$i]["inv_responsable"] = utf8_encode($resp['inv_responsable']);
		$arrayName[$i]["inv_direccion"] = $resp['inv_direccion'];
		$arrayName[$i]["inv_zona"] = $resp['inv_zona'];
		$arrayName[$i]["inv_costo"] = number_format($resp['inv_costo'],0,".",".");
	}
	return $arrayName;

}

?>