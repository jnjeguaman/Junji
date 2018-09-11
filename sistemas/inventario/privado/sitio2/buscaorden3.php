<?php
/**
* 
*/
class OrdendeCompra
{
  
  function __construct()
  {
    # code...
  }

  public function getEstadoOC($input)
  {
    require_once("../../../configuracion.php");
    
    $client = new SoapClient("http://www.mercadopublico.cl/wsoc/wsGetOc.asmx?WSDL", array('login' => $mercadoPublico[0], 'password' => $mercadoPublico[1], 'trace' => 1));
    $codigo = strtoupper($input);
    $params = array('trace' => 0, "porCode" => $codigo, 'login' => "16574870-0", 'password' => "Mcastrol1234");
    $respuesta=$client->GenerateXMLOCbyCode($params);
    $vars=$client->__getLastResponse();
    $contenido=$vars;
    $contenido = str_replace("&lt;","<",$contenido);
    $contenido = str_replace('&quot;','"',$contenido);
    $contenido = str_replace('&gt;',">",$contenido);
    $contenido = str_replace('&gt;&lt;',"/>",$contenido);
    $contenido = str_replace("Ó","O",$contenido);
    $contenido = str_replace('<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><GenerateXMLOCbyCodeResponse xmlns="wsGetOC"><GenerateXMLOCbyCodeResult>',"",$contenido);
    $contenido = str_replace('</GenerateXMLOCbyCodeResult></GenerateXMLOCbyCodeResponse></soap:Body></soap:Envelope>',"",$contenido);
  
    $xmlObject = simplexml_load_string($contenido);
    return $xmlObject->OrdersList->Order->OrderSummary->SummaryNote;
  }
}
?>