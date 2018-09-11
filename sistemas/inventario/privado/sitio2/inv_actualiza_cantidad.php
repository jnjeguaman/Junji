<?php
session_start();
require("inc/config.php");
extract($_POST);
extract($_SESSION);
$fechaSys = Date("Y-m-d");
$horaSys = Date("H:m:s");

$enviado = intval($qty);
$cantidadRequerida = intval($qtyTotal);
//
$totalParcial = "SELECT SUM(rece_cantidad) as Parcial FROM acti_recepcion WHERE rece_compra_id = ".$compra_id;
$totalParcial = mysql_query($totalParcial);
$totalParcial = mysql_fetch_array($totalParcial);
$totalParcial = intval($totalParcial["Parcial"]);

$respuesta = false;
$temp = $enviado + $totalParcial;

$consulta = "INSERT INTO acti_recepcion (`rece_id`,`rece_compra_id`,`rece_cantidad`,`rece_user`,`rece_fechasys`,`rece_horasys`,`rece_estado`) VALUES(0,".$compra_id.",".$qty.",'$nombrecom','".$fechaSys."','".$horaSys."',0)";
$consulta2 = "UPDATE acti_recepcion SET rece_estado = 1 WHERE rece_compra_id = ".$compra_id;

// Verificamos si las cantidades son iguales
if(($temp) === $cantidadRequerida)
{
	if(mysql_query($consulta,$dbh))
	{
		$respuesta = true;
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}

	if($respuesta)
	{
		if(mysql_query($consulta2,$dbh))
		{
			echo "<script>window.history.back()</script>";
		}else{
			echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
		}
	}
}elseif(($temp) > $cantidadRequerida){
	echo "Error Supera lo permitido.";
}else{
	if(mysql_query($consulta,$dbh))
	{
		echo "<script>window.history.back()</script>";
	}else{
		echo mysql_errno($dbh) . ": " . mysql_error($dbh) . "\n";
	}
}

?>