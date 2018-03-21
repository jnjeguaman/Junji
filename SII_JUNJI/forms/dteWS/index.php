<?php
extract($_GET);
extract($_POST);
require_once("includes/functions.dtews.php");

if($pagina=="dteWS" && $ori == "cargar")
{
	require_once("cargar.php");
}else if($pagina=="dteWS" && $ori=="ver")
{
	require_once("ver.php");
}else if($pagina == "dteWS" && $ori="aceptaReclama")
{
	require_once("aceptaReclama.php");
}
?>