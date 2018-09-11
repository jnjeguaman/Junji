<?php
session_start();
require("inc/config.php");

if ($_SESSION["region"] == 16 or $_SESSION["region"] == 13) {

	$gesparvu = explode("JI ", $_POST["zona_id"]);
	$detalleJardin = "SELECT * FROM jardines WHERE jardin_codigo = " . $gesparvu[1];
	$detalleJardin = mysql_query($detalleJardin);
	$detalleJardin = mysql_fetch_array($detalleJardin);

	$codigo = "SELECT zona_codigo FROM acti_zona WHERE zona_glosa = '" . $_POST["zona_id"] . "'";
	//echo $codigo."<br>";
	
	$codigo = mysql_query($codigo);
	$codigo = mysql_fetch_array($codigo);
	$codigo = $codigo["zona_codigo"];

	if ($detalleJardin["jardin_direccion"] <> "") {
		$direccion = $detalleJardin["jardin_direccion"];
	} else {
		$direccion = $_POST["zona_id"];
	}
	$subzona = "SELECT * FROM acti_subzona a inner join acti_zona b on a.acti_subzona_codigo = b.zona_codigo 
	WHERE a.acti_subzona_codigo = " . $codigo . " AND b.zona_glosa = '" . $_POST["zona_id"] . "' and b.zona_estado=1 
	ORDER BY a.acti_subzona_glosa ASC";
	//echo $subzona."<br>";
	$subzona = mysql_query($subzona);

	$arrayName = array();
	$max = 0;
	while ($row = mysql_fetch_array($subzona)) {
		$max++;
		$arrayName[$max] = array("subzona" => $row["acti_subzona_glosa"], "comuna" => $row["zona_comuna"], "direccion" => $direccion, "jardin" => $detalleJardin["jardin_nombre"]);
	}

	echo json_encode($arrayName);
} else {
	$gesparvu = explode("JI ", $_POST["zona_id"]);
	$detalleJardin = "SELECT * FROM jardines WHERE jardin_codigo = " . $gesparvu[1];
	$detalleJardin = mysql_query($detalleJardin);
	$detalleJardin = mysql_fetch_array($detalleJardin);

	$reemplazo = array("JI ", "BR ");
	$zona = trim(str_replace($reemplazo, "", $_POST["zona_id"]));

	$codigo = "SELECT zona_codigo FROM acti_zona WHERE zona_glosa = '" . $_POST["zona_id"] . "'";
	$codigo = mysql_query($codigo);
	$codigo = mysql_fetch_array($codigo);
	$codigo = $codigo["zona_codigo"];

	$zona_glosa = mysql_query("SELECT * FROM acti_zona WHERE zona_glosa = '" . $zona . "'");
	$zona_glosa = mysql_fetch_array($zona_glosa);

	$subzona = "SELECT * FROM acti_subzona a inner join acti_zona b on a.acti_subzona_codigo = b.zona_codigo WHERE a.acti_subzona_codigo = " . $codigo . " AND b.zona_glosa = '" . $_POST["zona_id"] . "' ORDER BY a.acti_subzona_glosa ASC";
	$subzona = mysql_query($subzona);

	$comuna = "SELECT jardin_comuna FROM jardines WHERE jardin_codigo = " . $zona;
	$comuna = mysql_query($comuna);
	$comuna = mysql_fetch_array($comuna);

	if ($comuna["jardin_comuna"] <> "") {
		$comuna = $comuna["jardin_comuna"];
	} else {
		$comuna = $zona_glosa["zona_comuna"];
	}

	if ($detalleJardin["jardin_direccion"] <> "") {
		$direccion = $detalleJardin["jardin_direccion"];
	} else {
		$direccion = $zona;
	}

	$arrayName = array();
	$max = 0;

	while ($row = mysql_fetch_array($subzona)) {
		$max++;
		$arrayName[$max] = array("subzona" => $row["acti_subzona_glosa"], "comuna" => $comuna, "direccion" => $direccion, "jardin" => $detalleJardin["jardin_nombre"]);
	}
	/*echo $codigo."<br>";
	echo $zona_glosa."<br>";
	echo comuna."<br>";
	echo $subzona."<br>";*/

	echo json_encode($arrayName);
}
?>
