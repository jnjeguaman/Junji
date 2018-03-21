<?php
libxml_use_internal_errors(true);

/**
* Clase para validar los dte generados con los esquemas proporcionados por el S.I.I.
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
**/

class Validate
{
	private $Schemas = array(
		0 => "inc/schema/DTE_v10.xsd",
		1 => "inc/schema/EnvioDTE_v10.xsd",
		2 => "inc/schema/SiiTypes_v10.xsd",
		3 => "inc/schema/xmldsignature_v10.xsd",
		4 => "inc/schema/RespuestaEnvioDTE_v10.xsd",
		5 => "inc/schema/Recibos_v10.xsd",
		6 => "inc/schema/EnvioRecibos_v10.xsd",
		7 => "inc/schema/LibroCVS_v10.xsd",
		8 => "inc/schema/xmldsignature_v10.xsd",
		9 => "inc/schema/LibroGuia_v10.xsd");

	function __construct(){}

/**
* Método que permite obtener el detalle del error al validar el Esquema
* @return String
* @param Object $error
**/
public function libxml_display_error($error)
{

	$return = "<br/>\n";
	switch ($error->level) {
		case LIBXML_ERR_WARNING:
		$return .= "<b>Warning $error->code</b>: ";
		break;
		case LIBXML_ERR_ERROR:
		$return .= "<b>Error $error->code</b>: ";
		break;
		case LIBXML_ERR_FATAL:
		$return .= "<b>Fatal Error $error->code</b>: ";
		break;
	}
	$return .= trim($error->message);
	if ($error->file) {
		$return .=    " in <b>$error->file</b>";
	}
	$return .= " on line <b>$error->line</b>\n";

	return $return;
}

/**
* Método que permite obtener los errores encontrados
* @return String
**/
public function libxml_display_errors() {
	$msg = "";
	$errors = libxml_get_errors();
	foreach ($errors as $error) {
		$msg .= $this->libxml_display_error($error);
	}
	libxml_clear_errors();
	return $msg;
}

/**
* Método que permite validar el XML segun el tipo de documento enviado
* @return String
* @param String $tipo Tipo de documento que se desea validar
* @param String $archivo Contenido en formato XML para ser validado
**/
public function validateSCHEMA($tipo,$archivo)
{
	if($tipo == "DTE")
	{
		$xml = new DOMDocument(); 
		$xml->loadXML($archivo);
		if (!$xml->schemaValidate($this->Schemas[1])) {
			return $this->libxml_display_errors();
		}  
	}
	if($tipo == "IECV")
	{
		$xml = new DOMDocument(); 
		$xml->loadXML($archivo);
		if (!$xml->schemaValidate($this->Schemas[7])) {
			return $this->libxml_display_errors();
		}  
	}

	if($tipo == "ACUSE_1" || $tipo == "ACUSE_2")
	{
		$xml = new DOMDocument(); 
		$xml->loadXML($archivo);
		if (!$xml->schemaValidate($this->Schemas[4])) {
			return $this->libxml_display_errors();
		}  
	}

	if($tipo == "ACUSE_3")
	{
		$xml = new DOMDocument(); 
		$xml->loadXML($archivo);
		if (!$xml->schemaValidate($this->Schemas[6])) {
			return $this->libxml_display_errors();
		}  
	}

	if($tipo == "ENVIO")
	{
		$xml = new DOMDocument(); 
		$xml->loadXML($archivo);
		if (!$xml->schemaValidate($this->Schemas[1])) {
			return $this->libxml_display_errors();
		}  
	}

	if($tipo == "LibroGD")
	{
		$xml = new DOMDocument(); 
		$xml->loadXML($archivo);
		if (!$xml->schemaValidate($this->Schemas[9])) {
			return $this->libxml_display_errors();
		}  
	}
}

/**
* Método que permite validar la firma de un DTE enviado
* @return String
* @param String $tipo Tipo de documento que se desea validar
* @param String $archivo Contenido en formato XML para ser validado
**/
public function validateFIRMA($tipo,$archivo)
{
	$xml = new DOMDocument(); 
	$xml->loadXML($archivo);
	if (!$xml->schemaValidate($this->Schemas[8])) {
		return $this->libxml_display_errors();
	}  
}

}
?>