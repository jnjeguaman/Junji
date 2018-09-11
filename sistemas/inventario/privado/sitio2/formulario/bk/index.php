<?php
ini_set("display_errors", 0);
session_start();
require("../inc/config.php");
extract($_POST);
extract($_GET);


//$totalPaginas = "SELECT count(inv_id) as Total FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_zona = '".$zona."'";
//$totalPaginas = mysql_query($totalPaginas);
//$totalPaginas = mysql_fetch_array($totalPaginas);
//$totalPaginas = intval($totalPaginas["Total"]);

$regionSession = intval($_SESSION["region"]);

if($regionSession != 16)
{
$claves = array("JI ", "BR ", "DR ");
$codigo = str_replace($claves, "", $responsa);
//$zona = str_replace("ZONA ", "", $zona);
//echo $codigo;
$totalPaginas = "SELECT count(inv_id) as Total FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_region = ".$regionSession." AND inv_zona = '".$zona."'";
//echo $totalPaginas;
$totalPaginas = mysql_query($totalPaginas);
$totalPaginas = mysql_fetch_array($totalPaginas);
$totalPaginas = intval($totalPaginas["Total"]);
}else{
$totalPaginas = "SELECT count(inv_id) as Total FROM acti_inventario WHERE inv_responsable = '".$busca_responsable."' AND inv_zona = '".$zona."'";
$totalPaginas = mysql_query($totalPaginas);
$totalPaginas = mysql_fetch_array($totalPaginas);
$totalPaginas = intval($totalPaginas["Total"]);
}

$limit = 20;
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
	<!--<?php //for ($i=0; $i < $totalPages; $i++) : ?>
		<?php //include("encabezado.php") ?>
		<?php //include("lista1.php") ?>
		<?php //$cont++ ?>
	<? //endfor ?>
	!-->
	<!--
	<?php //require_once("encabezado.php") ?>
	<?php //require_once("lista1.php") ?>
	<br><br><br><br><br><br>
	<?php //require_once("encabezado2.php") ?>
	<?php //require_once("lista2.php") ?>
	<br><br><br><br><br><br>
	<?php //require_once("firma.php") ?>
	!-->

</body>
</html>
