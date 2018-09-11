<?php 
session_start();
require("inc/config.php");
extract($_POST);
$direccion = "SELECT zona_glosa FROM acti_zona WHERE zona_id = '".$responsa."'";
$direccion = mysql_query($direccion);
$direccion = mysql_fetch_array($direccion);
$direccion = $direccion["zona_glosa"];
$contador = 0;
$tipo = intval($tipo);

$abastece 			= reemplazaCaracter($abastece);
$destinatario 		= reemplazaCaracter($destinatario);
$responsa2 			= reemplazaCaracter($responsa2);
$comuna2 			= reemplazaCaracter($comuna2);
$emisor 			= reemplazaCaracter($emisor);
$obs 				= reemplazaCaracter($obs);
$responsa 			= reemplazaCaracter($responsa);
$inv_responsable 	= reemplazaCaracter($inv_responsable);
$obs 				= reemplazaCaracter($obs);


$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");
$log = "INSERT INTO log VALUES(NULL,".$nro_guia.",0,'GENERACION G/D','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','GUIA')";
mysql_query($log);

if($tipo === 0)
{
	$sql = "INSERT INTO `inv_guia_despacho_encabezado`(`guia_id`, `guia_numero`, `guia_emision`, `guia_abastece`, `guia_destinatario`, `guia_direccion`, `guia_comuna`,`guia_emisor`,`guia_obs`,`guia_estado`,`guia_origen`,`guia_region_origen`) VALUES (0,'".$nro_guia."','".$fecha."','".$abastece."','".$destinatario."','".$responsa2."','".$comuna2."','".$emisor."','".$obs."',1,0,".$_SESSION["region"].")";
	if(mysql_query($sql))
	{

		grabarDetalle($_SESSION["items"],$nro_guia,$tipo);

	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}

}else{
	$sql = "INSERT INTO `inv_guia_despacho_encabezado`(`guia_id`, `guia_numero`, `guia_emision`, `guia_abastece`, `guia_destinatario`, `guia_direccion`, `guia_zona`, `guia_comuna`, `guia_responsable`,`guia_emisor`,`guia_obs`,`guia_estado`,`guia_origen`,`guia_region_origen`) VALUES (0,'".$nro_guia."','".$fecha."','".$abastece."','".$destinatario."','".$responsa."','".$inv_zona."','".$comuna."','".$inv_responsable."','".$emisor."','".$obs."',1,0,".$_SESSION["region"].")";
	if(mysql_query($sql))
	{
		grabarDetalle($_SESSION["items"],$nro_guia,$tipo);

	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}


function grabarDetalle($input,$nro_guia,$tipo)
{
	require("inc/config.php");
	$encabezado = $_POST;
	$contador = 0;
	for ($i=0; $i < count($input); $i++) { 
		$ingresa = "INSERT INTO `inv_guia_despacho_detalle`(`detalle_id`, `detalle_guia_numero`, `detalle_inv_codigo`, `detalle_cantidad`,`detalle_responsable_anterior`,`detalle_direccion_anterior`,`detalle_zona_anterior`,`detalle_origen`,`detalle_inv_id`) VALUES (0,'".$nro_guia."','".$input[$i]["inv_codigo"]."','1','".$input[$i]["inv_responsable"]."','".$input[$i]["inv_direccion"]."','".$input[$i]["inv_zona"]."',0,".$input[$i]["inv_id"].")";
		if(mysql_query($ingresa))
		{
			$contador++;
		}
	}

	if($contador === count($input))
	{	
		if(intval($tipo) === 1){
			actualizaResponsable($encabezado,$input);
		}else{
			$_SESSION["encabezado"] = $encabezado;
			echo "<script>alert('SIN MODIFICACION DE INVENTARIO');window.open('imprimir_guia_despacho.php');window.location.href='registro_guias.php?cod=27';</script>";
		}

	}else{
		echo "Ha ocurrido un error. Intente más tarde.";
	}
}

function actualizaResponsable($encabezado,$items)
{
	$_SESSION["encabezado"] = $encabezado;
	$contador = 0;
	for ($i=0; $i < count($items); $i++) { 
		$sql = "UPDATE acti_inventario SET inv_direccion = '".$encabezado["responsa"]."', inv_zona = '".$encabezado["inv_zona"]."', inv_responsable = '".$encabezado["inv_responsable"]."' WHERE inv_codigo = '".$items[$i]["inv_codigo"]."'";
		if(mysql_query($sql))
		{
			$contador++;
		}
	}

	if($contador === count($items))
	{
		//echo "<script>alert('LOS REGISTROS DE INVENTARIO HAN SIDO ACTUALIZADOS');window.open('imprimir_guia_despacho.php');window.location.href='registro_guias.php?cod=27';</script>";
		echo "<script>alert('LOS REGISTROS DE INVENTARIO HAN SIDO ACTUALIZADOS');window.location.href='imprimir_guia_despacho.php';</script>";

	}else{
		echo "HA OCURRIDO UN ERROR";
	}
}

function reemplazaCaracter($input)
{
	$input = str_replace("Ñ", "N", $input);
	$input = str_replace("Á", "A", $input);
	$input = str_replace("É", "E", $input);
	$input = str_replace("Í", "I", $input);
	$input = str_replace("Ó", "O", $input);
	$input = str_replace("Ú", "U", $input);
	return $input;
}

?>