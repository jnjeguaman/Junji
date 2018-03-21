<?php
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
extract($_GET);

if($pagina == "notadebito" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="notadebito" && $ori=="ver")
{
	require_once("ver.php");
}elseif($pagina=="notadebito" && $ori=="paso2")
{
	require_once("paso2.php");
}
?>