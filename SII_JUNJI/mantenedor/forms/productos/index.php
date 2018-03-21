<?php
require_once("includes/functions.producto.php");
require_once("includes/functions.categoria.php");
extract($_GET);

if($pagina == "productos" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="productos" && $ori=="ver")
{
	require_once("ver.php");
}elseif($pagina=="productos" && $ori=="editar")
{
	require_once("editar.php");
}
?>