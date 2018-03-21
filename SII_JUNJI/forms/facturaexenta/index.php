<?php
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
require_once("includes/functions.referencia.php");
require_once("includes/functions.region.php");
extract($_GET);

if($pagina == "facturaexenta" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="facturaexenta" && $ori=="ver")
{
	require_once("ver.php");
}
?>