<?php
extract($_GET);
if($pagina == "dteRecibidos" && $ori == "cargar")
{
	require_once("cargar.php");
}else if($pagina == "dteRecibidos" && $ori == "ver")
{
	require_once("ver.php");
}else if($pagina == "dteRecibidos" && $ori == "acuse")
{
	require_once("acuse.php");
}else if($pagina == "dteRecibidos" && $ori == "formcompra")
{
	require_once("generarcompra.php");
}else{
	require_once("404.php");
}
?>