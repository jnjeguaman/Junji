<?php
require_once("includes/functions.cliente.php");
require_once("includes/functions.region.php");
require_once("includes/functions.actividad_economica.php");
require_once("includes/functions.caf.php");
extract($_GET);

if($pagina == "clientes" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="clientes" && $ori=="ver")
{
	require_once("ver.php");
}elseif($pagina=="clientes" && $ori=="editar")
{
	require_once("editar.php");
}
?>