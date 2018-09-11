<?php
ini_set("display_errors", 0);
session_start();
require("../inc/config.php");
extract($_POST);
extract($_GET);


$regionSession = intval($_SESSION["region"]);

if($regionSession != 16)
{
$claves = array("JI ", "BR ", "DR ");
$codigo = str_replace($claves, "", $responsa);
//$zona = str_replace("ZONA ", "", $zona);
//echo $codigo;
// $totalPaginas = "SELECT count(inv_id) as Total FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_region = ".$regionSession." AND inv_zona = '".$zona."' AND inv_estado2 = 1";
$totalPaginas = "SELECT count(inv_id) as Total FROM acti_inventario WHERE inv_estado2 = 1 $busca_responsable AND inv_region = ".$regionSession;
//echo $totalPaginas;
$totalPaginas = mysql_query($totalPaginas);
$totalPaginas = mysql_fetch_array($totalPaginas);
$totalPaginas = intval($totalPaginas["Total"]);
}else{
// $totalPaginas = "SELECT count(inv_id) as Total FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_zona = '".$zona."' AND inv_estado2 = 1";
	$totalPaginas = "SELECT count(inv_id) as Total FROM acti_inventario WHERE inv_estado2 = 1 $busca_responsable";
$totalPaginas = mysql_query($totalPaginas);
$totalPaginas = mysql_fetch_array($totalPaginas);
$totalPaginas = intval($totalPaginas["Total"]);
}

$limit = 40;
$numeroDePaginas = ceil($totalPaginas/$limit);
$contador = 1;
?>

<!DOCTYPE html>
<html>
<head>
	<title>PLANILLA MURAL DE INVENTARIO</title>
	<meta charset="utf-8">
	<style type="text/css">
		td {
			text-align: center;
		}

		.wrapper{
			width: 100%;
			margin: auto;
			position: relative;
		}

		.fecha{
			padding-top: 60px;
		}

		.lista{
			padding-top: 80px;
		}

	</style>
</head>
<body>

	<?php
	if($numeroDePaginas == 0) 
	{	
		echo "NO EXISTEN REGISTROS PARA LA DIRECCION <strong>".$responsa."</strong>, ZONA <strong>".$zona."</strong> PARA LA PERSONA <strong>".$busca_responsable."</strong>";
	}else{

        $i2=0;
		for ($i=0; $i < $numeroDePaginas; $i++) { 
			include("planillaDeInventario.php");
			include("listaItems.php");
			$contador++;
		}
		include("planillaDeInventario.php");
		include("resumenDeCodigos.php");
		include("firma.php");
	}
	?>
	
</body>
</html>
