<?php
require_once("includes/functions.iecv.php");
extract($_GET);

if(isset($ori) && $ori == "compra")
{
	require_once("compra.php");
}else if(isset($ori) && $ori == "venta")
{
	require_once("venta.php");
}else if(isset($ori) && $ori == "historial"){
	require_once("historial.php");
}else{
	require_once("404.php");
}
?>