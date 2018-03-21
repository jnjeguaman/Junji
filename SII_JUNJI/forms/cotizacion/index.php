<?php

if(isset($_GET["pagina"]) && $_GET["pagina"] == "cotizacion" && isset($_GET["action"]) && $_GET["action"] == "nuevo" && isset($_GET["id"]))
{
	require_once("paso2.php");
}elseif(isset($_GET["pagina"]) && $_GET["pagina"] == "cotizacion" && isset($_GET["action"]) && $_GET["action"] == "nuevo")
{
	require_once("nuevo.php");
}elseif(isset($_GET["pagina"]) && $_GET["pagina"] == "cotizacion" && isset($_GET["action"]) && $_GET["action"] == "ver")
{
	require_once("ver.php");
}elseif(isset($_GET["pagina"]) && $_GET["pagina"] == "cotizacion" && isset($_GET["action"]) && $_GET["action"] == "facturar")
{
	require_once("facturar.php");
}elseif(isset($_GET["pagina"]) && $_GET["pagina"] == "cotizacion" && isset($_GET["action"]) && $_GET["action"] == "gd")
{
	require_once("gd.php");
}
?>