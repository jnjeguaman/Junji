<?php
session_start();
$regionSession = $_SESSION["sii"]["usuario_region"];
error_reporting(E_ALL);
// require_once("../../includes/inc/class.FirmaElectronica.php");
// $objFirma = new FirmaElectronica($_POST["emisor_rut"],$_POST["emisor_dv"]);
require_once("../../includes/functions.recibo.php");
$contenido = file_get_contents($_FILES["archivo"]["tmp_name"]);
$tipo_carga = $_POST["tipo_carga"];

try {
	$xml = simplexml_load_string($contenido);

	//TIPO DE CARGA NORMAL
	if($tipo_carga == 0)
	{
		if(count($xml->SetDTE->DTE) > 0)
		{
			$path = 1;
		}else if(count($xml->Documento) > 0)
		{
			$path = 0;
		}
		$respuesta = cargarXML($xml,$path,$_FILES,$regionSession);

		if($respuesta["Respuesta"] === true)
		{
			echo "<script>window.location.href='../../?pagina=dteRecibidos&ori=ver';</script>";
		}else{
			echo "Ha ocurrido un error al cargar. ".$respuesta["Mensaje"];
		}
	}else{
		//CARGA MASIVA DE DTE RECIBIDOS CON FORMATO GENERADO POR S.I.I.
		$respuesta = cargarXMLSII($xml,$_FILES,$regionSession);
		if($respuesta["Respuesta"] === true)
		{
			echo "<script>window.location.href='../../?pagina=dteRecibidos&ori=ver';</script>";
		}else{
			echo "Ha ocurrido un error al cargar. ".$respuesta["Mensaje"];
		}
	}
	
} catch (Exception $e) {
	echo $e->getMessage();
}
?>