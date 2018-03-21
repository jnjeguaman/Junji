<?php
require_once("includes/functions.autorizacion.php");
require_once("includes/functions.usuario.php");
require_once("includes/functions.region.php");
extract($_GET);

if($ori == "nuevo")
{
	require_once("nuevo.php");
}else if($ori == "ver")
{
	require_once("ver.php");
}else if($ori == "editar")
{
require_once("editar.php");	
}else{
	require_once("404.php");
}
?>