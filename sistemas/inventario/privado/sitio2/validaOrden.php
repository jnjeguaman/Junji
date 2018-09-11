<?php
require("inc/config.php");
session_start();
if(isset($_REQUEST["cmd"]))
{
	$cmd =  htmlentities($_REQUEST["cmd"]);
	$cmd = htmlspecialchars($cmd);

	switch ($cmd) {
		case 'validaOrden':
		validaOrden($_POST);
		break;
		
		case 'validaOC':
		validaOC($_POST);
		break;

		case 'valJardin':
		echo json_encode(valJardin($_POST));
		break;

		case 'validaFolio':
		echo json_encode(validaFolio($_POST));
		break;
	}
}

function valJardin($input)
{
	$qry = "SELECT count(oc_region) As Total FROM bode_orcom WHERE oc_region = ".$input["jardin"]." AND oc_mas_id = ".$input["masid"];
	$res = mysql_query($qry);
	$row = mysql_fetch_array($res);
	$total = $row["Total"];
	if($total == 0)
	{
		return true;
	}else{
		return false;
	}
}

function validaOrden($input)
{
	$valida = "SELECT COUNT(DISTINCT(compra_id)) as Total FROM acti_compra WHERE oc_numero = '".$input["oc_numero"]."' AND compra_region_id = ".$_SESSION["region"]." AND (oc_estado = 1 OR oc_estado = 'OK')";
	$valida = mysql_query($valida);
	$valida = mysql_fetch_array($valida);
	$valida = intval($valida["Total"]);
// 0 no existe, pasa
// 1 ya tiene	
	if($valida >= 1)
	{
		echo json_encode(true);
	}
}

function validaOC($input)
{
	require("inc/config.php");
	$valida = "SELECT COUNT(DISTINCT(oc_id)) as Total FROM bode_orcom WHERE oc_id2 = '".$input["oc"]."' AND oc_estado = 1";
	$valida = mysql_query($valida,$dbh);
	$valida = mysql_fetch_array($valida);
	$valida = intval($valida["Total"]);
	if($valida >= 1)
	{
		echo json_encode(true);
	}else{
		echo json_encode(false);
	}
}

function validaFolio($input)
{
	$res = mysql_query("SELECT COUNT(guia_id) as Total FROM inv_guia_despacho_encabezado WHERE guia_numero = ".$input["folio"]);
	$row = mysql_fetch_array($res);
	$total = intval($row["Total"]);
	if($total >= 1)
	{
		return true;
	}else{
		return false;
	}
}
?>