<?php
/**
* 
*/
libxml_use_internal_errors(true);
class validateSCHEMA
{

    private $archivo;
    private $tipoDCTO;
    private $Schemas = array(
        0 => "inc/schema/DTE_v10.xsd",
        1 => "inc/schema/EnvioDTE_v10.xsd",
        2 => "inc/schema/SiiTypes_v10.xsd",
        3 => "inc/schema/xmldsignature_v10.xsd",
        4 => "inc/schema/RespuestaEnvioDTE_v10.xsd",
        5 => "inc/schema/Recibos_v10.xsd",
        6 => "inc/schema/EnvioRecibos_v10.xsd");

    function __construct($referencia,$tipoDCTO)
    {
        $this->tipoDCTO = $tipoDCTO;
        $this->archivo = $referencia.".xml";
    }

    /*******************/
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
    }//libxml_display_error

    public function libxml_display_errors() {
        $msg = "";
        $errors = libxml_get_errors();
        foreach ($errors as $error) {
            $msg .= $this->libxml_display_error($error);
        }
        libxml_clear_errors();
        return $msg;
    }//libxml_display_errors

    public function validateSCHEMA()
    {
  // Enable user error handling

        $ruta = "../Documentos/".$this->tipoDCTO."/".$this->archivo;

        $xml = new DOMDocument(); 
        $xml->load($ruta);

        if (!$xml->schemaValidate($this->Schemas[1])) {
            // print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
            return $this->libxml_display_errors();
        }  
    }

    public function validateSCHEMA2($ruta,$archivo,$tipo)
    {
  // Enable user error handling

        // $ruta = "../Documentos/".$this->tipoDCTO."/".$this->archivo;
        $ruta = $ruta."/".$archivo.".xml";


        $contenido = file_get_contents($ruta);

        $xml = new DOMDocument(); 
        $xml->loadXML($contenido);

        if (!$xml->schemaValidate($this->Schemas[4])) {
            // print '<b>DOMDocument::schemaValidate() Generated Errors!</b>';
            return $this->libxml_display_errors();
        }  
    }

        private function Extrae($xml)
    {
        $reemplazo = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
        return trim(str_replace($reemplazo,"",$xml));
    }

    /*************************/
}
?>
