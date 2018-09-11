<?php
session_start();
require("inc/config.php");
extract($_POST);
extract($_SESSION);


$maximo = "SELECT MAX(CAST(inv_codigo AS UNSIGNED)) AS Maximo FROM acti_inventario WHERE inv_region = ".$_SESSION["region"];


// $maximo = mysql_query($maximo);
// $maximo = mysql_fetch_array($maximo);
// $maximo = ($maximo["Maximo"] > 1) ? $maximo["Maximo"]+1 : $_SESSION["region"]."000001" ;

/*******************/
// $maximo = "SELECT MAX(CAST(inv_codigo AS UNSIGNED)) AS Maximo FROM acti_inventario WHERE inv_region = ".$_SESSION["region"]." AND inv_codigo LIKE '".$_SESSION["region"]."%'";
$maximo = "SELECT MAX(inv_codigo) AS Maximo FROM acti_inventario WHERE inv_region = ".$_SESSION["region"]." AND inv_codigo LIKE '".$_SESSION["region"]."%'";
$maximo = mysql_query($maximo);
$maximo = mysql_fetch_array($maximo);
$maximo = ($maximo["Maximo"] > 1) ? $maximo["Maximo"]+1 : $_SESSION["region"]."000001" ;
/*******************/

$exito = 0;


$monto_total = $total * $tipo_cambio;
$unitario = floor($monto_total / $cantidad);
$conversion = $unitario * $cantidad;
$diferencia = $monto_total - $conversion;

$fechamia=date('Y-m-d');
$horaSys = Date("H:i:s");


for ($i=0; $i < $cantidad; $i++) { 
	if($i == 0)
	{
		$valor = $unitario + $diferencia;
		$sql = "INSERT INTO acti_inventario (`inv_id`,`inv_codigo`,`inv_programa`,`inv_bien`,`inv_costo`,`inv_region`,`inv_estadocosto`,`inv_obs`,`inv_responsable`,`inv_calidad`,`inv_vutil`,`inv_direccion`,`inv_zona`,`inv_estado2`) VALUES(0,$maximo,'".$programa."','".$subgrupo."',$valor,$region,'".$inv_estadocosto."','".$inv_obs."','".$inv_responsable."','".$inv_calidad."','".$inv_vutil."','".$responsa."','".$inv_zona."',1) ";
		if(mysql_query($sql))
		{
			$log = "INSERT INTO log VALUES(NULL,".$maximo.",1,'INGRESO NUEVA PRODUCTO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVO PRODUCTO')";
			mysql_query($log);
			$exito++;
		}
	}else{
		$sql = "INSERT INTO acti_inventario (`inv_id`,`inv_codigo`,`inv_programa`,`inv_bien`,`inv_costo`,`inv_region`,`inv_estadocosto`,`inv_obs`,`inv_responsable`,`inv_calidad`,`inv_vutil`,`inv_direccion`,`inv_zona`,`inv_estado2`) VALUES(0,$maximo,'".$programa."','".$subgrupo."',$unitario,$region,'".$inv_estadocosto."','".$inv_obs."','".$inv_responsable."','".$inv_calidad."','".$inv_vutil."','".$responsa."','".$inv_zona."',1) ";
		if(mysql_query($sql))
		{
			$log = "INSERT INTO log VALUES(NULL,".$maximo.",1,'INGRESO NUEVA PRODUCTO','".$_SESSION["nom_user"]."','".$fechamia."','".$horaSys."','INVENTARIO','NUEVO PRODUCTO')";
			mysql_query($log);
			$exito++;
		}
	}
	$maximo++;
}

if($exito === intval($cantidad))
{
	echo "<script>opener.location.reload(); window.close()</script>";
}else{
	echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
}
?>