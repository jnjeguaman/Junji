<?php
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
require_once("includes/functions.referencia.php");
require_once("includes/functions.region.php");
require_once("includes/inc/class.xml.php");
extract($_GET);

if($pagina == "factura" && $ori == "nuevo")
{
	require_once("nuevo.php");
}elseif($pagina=="factura" && $ori=="ver")
{
	require_once("ver.php");
}else if($pagina=="factura" && $ori=="cargar")
{
	require_once("cargar.php");
}else if($ori == "detalle")
{
	require_once("detalle.php");
}else{
	require_once("404.php");
}

?>