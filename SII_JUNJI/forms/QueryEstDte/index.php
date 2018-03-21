<?php
extract($_GET);
require_once("includes/functions.cliente.php");
require_once("includes/functions.documentos.php");
require_once("includes/functions.empresa.php");
$regionSession = $_SESSION["sii"]["usuario_region"];

if($action == "emitido" && $id <> "")
{
	require_once("emitido_1.php");
}else if($action == "emitido" && $id == "")
{
	require_once("emitido_2.php");
}else if($action == "recibido")
{
require_once("recibido.php");
}else{
	require_once("404.php");
}
?>