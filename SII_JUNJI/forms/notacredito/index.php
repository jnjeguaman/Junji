<?php
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
require_once("includes/functions.referencia.php");
require_once("includes/functions.region.php");
extract($_GET);

if($pagina == "notacredito" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="notacredito" && $ori=="ver")
{
	require_once("ver.php");
}elseif($pagina=="notacredito" && $ori=="paso2")
{
	require_once("paso2.php");
}
?>