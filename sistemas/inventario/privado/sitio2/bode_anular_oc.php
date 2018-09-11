<?php
include("inc/config.php");
session_start();
if($_SESSION["nom_user"] =="" ){

	?><script language="javascript">location.href='sesion_perdida.php';</script><?

}
extract($_POST);

if(isset($cmd))
{
	//$cmd = htmlentities($cmd);
	//$cmd = htmlspecialchars($cmd);

	switch($cmd)
	{
		case "Anular":
		//$existeElementos = existeElementos($oc_id);
		echo json_encode(anularOC($oc_id));
		break;
	}
}


function anularOC($input)
{
	$detalle = getDetalle($input);
	$detingreso = getDetIngreso($detalle);
	$total = totalElementos($detingreso);
	$clasificado = totalClasificado($input);

	if($total >= 1)
	{
		// TIENE DESPACHO ASOCIADO
		return 1;
	}else if($clasificado >= 1)
	{
		// LA ORDEN DE COMPRA TIENE CLASIFICACIONES ASOCIADAS
		return 2;
	}else{
		actualizarOC($input);
		return 3;
	}
	// if($total === 0 && $clasificado === 0)
	// {
	// 	actualizarOC($input);
	// 	return true;
	// }else{
	// 	return false;
	// }
}

function totalClasificado($input)
{
	$total = 0;
	$sql = mysql_query("SELECT count(ing_id) as Total FROM bode_ingreso WHERE ing_oc_id = ".$input." AND ing_clasificacion = 1");
	$row = mysql_fetch_array($sql);
	return intval($row["Total"]);
}

/* VERIFICAMOS SI EL(LOS) PRODUCTOS TIENEN DESPACHO */
function totalElementos($input)
{
	$total = 0;
	for ($i=0; $i < count($input); $i++) { 
		$query = "SELECT COUNT(doc_id) as Total FROM bode_detoc WHERE doc_origen_id = ".$input[$i];
		$res = mysql_query($query);
		$row = mysql_fetch_array($res);
		$total += intval($row["Total"]);
	}
	return $total;
}

/* OBTENEMOS EL ID DEL PRODUCTO */
function getDetIngreso($input)
{
	for ($i=0; $i < count($input); $i++) { 
		$query = "SELECT ding_id FROM bode_detingreso WHERE ding_prod_id = ".$input[$i];
		$res = mysql_query($query);
		$row = mysql_fetch_array($res);
		$ding_id[] = $row["ding_id"];
	}
	return $ding_id;
}

/* OBTENEMOS EL LISTADO DE LOS PRODUCTOS DADA UNA OC */
function getDetalle($input)
{
	$query = "SELECT * FROM bode_orcom a INNER JOIN bode_detoc b ON a.oc_id = b.doc_oc_id WHERE a.oc_id = ".$input;
	$res = mysql_query($query);
	$array = array();
	while ($row = mysql_fetch_array($res)) {
		$array[] = $row["doc_id"];

	}
	
	return $array;
}

function actualizarOC($input)
{
	$query = "UPDATE bode_orcom SET oc_estado = 0 WHERE oc_id = ".$input." AND oc_estado = 1";
	mysql_query($query);
	mysql_query("INSERT INTO log VALUES(NULL,".$input.",0,'ANULA ORDEN DE COMPRA','".$_SESSION["nom_user"]."','".Date("Y-m-d")."','".Date("H:i:s")."','BODEGA','INGRESO BODEGA')");
}
?>