<?php
require_once("class.empresa.php");
require_once("class.token.php");
/**
* Clase que permite solicitar en forma automática al SII 
* el reenvío de los correos con diagnostico de validación DTE para trackids específicos
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/

class Correo
{
	private $_trackid;
	private $_region;
	private $client = NULL;
	private $wsdl_url = array(
		0 => "https://maullin.sii.cl/DTEWS/services/wsDTECorreo?wsdl");

	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);

	function __construct($trackid,$region)
	{
		$this->_trackid = $trackid;
		$this->_region = $region;
	}


	public function enviarCorreo()
	{
		$objEmpresa = new Empresa();
		$detalleEmpresa = $objEmpresa->getEmpresa($this->_region);

		$objTOKEN = new Token();
		$token = trim($objTOKEN->getToken());
		try {
			if($token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" =>"El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($token);
					if(trim($token->GLOSA == "Token Creado"))
					{
						try {
							$this->client = $this->getConnection($this->wsdl_url[0]);
							$wsDTECorreo = $this->client->reenvioCorreo($token->TOKEN,$detalleEmpresa[1]["empresa_rut"],$detalleEmpresa[1]["empresa_dv"],$this->_trackid);
							try {
								$xml = new SimpleXMLElement($wsDTECorreo);

								$xml->registerXPathNamespace('SII', 'http://www.sii.cl/XMLSchema');
								$estado = $xml->xpath('SII:RESP_HDR//SII:ESTADO');
								$glosa = $xml->xpath("SII:RESP_HDR//SII:GLOSA");
								if(intval($estado[0]) === 0)
								{
									return array("Respuesta" => true,"Mensaje" => "Correo enviado correctamente");
								}else if(intval($estado[0]) > 0)
								{
									return array("Respuesta" => false,"Mensaje" => (string)$glosa[0]);
								}else{
									return array("Respuesta" => false,"Mensaje" => "Error al procesar la solicitud.");
								}
							} catch (Exception $e) {
								return array("Respuesta" => false,"Mensaje" => $e->getMessage());
							}	
						} catch (Exception $e) {
							return array("Respuesta" => false,"Mensaje" => $e->getMessage());
						}
						
					}
				} catch (Exception $e) {
					return array("Respuesta" => false,"Mensaje" => $e->getMessage());
				}
			}
		} catch (Exception $e) {
			return array("Respuesta" => false,"Mensaje" => $e->getMessage());
		}
	}

	/**
	* Método que permite conectarse al WebService solicitado
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Object
	* @param String con la URL del WebService SOAP
	**/
	private function getConnection ($wsdl) {
		try {
			return $this->client = new SoapClient($wsdl,$this->options);
		} catch (SoapFault $e) {
			return array("Respuesta" => false,"Mensaje" => "La Conexion ha fallado. ".$e->getMessage());
		}
	}

		/**
	* Método que permite limpiar los XML resultantes.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function Extrae($xml)
	{
		$reemplazo = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		return trim(str_replace($reemplazo,"",$xml));
	}

}
?>