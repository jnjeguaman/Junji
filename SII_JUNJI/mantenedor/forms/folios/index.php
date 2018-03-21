<?php
require_once("includes/functions.caf.php");
require_once("includes/functions.region.php");
extract($_GET);

if($pagina == "folios" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="folios" && $ori=="ver")
{
	require_once("ver.php");
}
?>