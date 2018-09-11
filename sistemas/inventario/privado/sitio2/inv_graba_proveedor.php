<?php
session_start();
extract($_POST);
if(isset($_REQUEST["cmd"]))
{
	switch ($_REQUEST["cmd"]) {
		case 'grabarProveedor':
		return grabarProveedor($_POST);
		break;
	}
}


function grabarProveedor($input)
{
	require("inc/config.php");
	$rutTemp = explode("-",$input["proveedor_rut"]);
	$rut = $rutTemp[0];
	$rut = str_replace(".", "", $rut);
	$dv = $rutTemp[1];
	$respuesta = existeProveedor($rut);
	if($respuesta == false)
	{
		$sql = "INSERT INTO `acti_proveedor`(`proveedor_id`, `proveedor_glosa`, `proveedor_rut`,`proveedor_dv`, `proveedor_contacto`, `proveedor_email`, `proveedor_telefono`, `proveedor_estado`) VALUES (0,'".strtoupper($input["proveedor_glosa"])."','".$rut."','".$dv."','".strtoupper($input["proveedor_contacto"])."','".$input["proveedor_email"]."','".$input["proveedor_telefono"]."',".$input["proveedor_estado"].")";

		if (mysql_query($sql,$dbh)) {

			$fechamia=date('Y-m-d');
			$horaSys = Date("H:i:s");
			$log = "INSERT INTO log VALUES(NULL,".mysql_insert_id().",0,'NUEVO PROVEEDOR','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVA COMPRA')";
			mysql_query($log);

			echo json_encode(true);
		}else{
			echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
		}
	}else{
		echo json_encode(false);
	}
}

function existeProveedor($input){
	$respuesta = false;
	$sql = "SELECT COUNT(proveedor_id) as Total FROM acti_proveedor WHERE proveedor_rut = '".$input."'";
	$sql = mysql_query($sql);
	$sql = mysql_fetch_array($sql);
	$sql = intval($sql["Total"]);
	if($sql > 0){
		$respuesta = true;
	}
	return $respuesta;
}
?>