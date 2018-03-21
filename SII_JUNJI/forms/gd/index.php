<?php
require_once("includes/functions.referencia.php");
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
require_once("includes/functions.region.php");
extract($_GET);

if(isset($pagina) && $pagina == "gd" && isset($action) && $action == "ver")
{
	require_once("ver.php");
}else if($action == "anularGuia")
{
	require_once("anularguia.php");
}else if($action=="nuevo"){
	require_once("nuevo.php");
}else{
	require_once("404.php");
}


?>