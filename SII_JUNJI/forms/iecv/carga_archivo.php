<?php
require_once("../../includes/functions.iecv.php");

$contenido = file_get_contents($_FILES["archivo"]["tmp_name"]);
$xml = simplexml_load_string($contenido);


if(count($xml->DTE) > 0)
{
	$path = 1;
}else if(count($xml->Documento) > 0)
{
	$path = 0;
}

$respuesta = cargarXML($xml);

if($respuesta["Respuesta"] === true)
{
	echo "<script>window.location.href='../../?pagina=iecv&ori=ver';</script>";
}else{
	echo "Ha ocurrido un error al cargar. ".$respuesta["Mensaje"];
}

?>