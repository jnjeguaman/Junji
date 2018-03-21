<?php
require_once("includes/functions.categoria.php");
extract($_GET);

if($pagina == "categorias" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="categorias" && $ori=="ver")
{
	require_once("ver.php");
}elseif($pagina=="categorias" && $ori=="editar")
{
	require_once("editar.php");
}
?>