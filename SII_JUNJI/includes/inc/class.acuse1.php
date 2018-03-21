<?php
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.recibo.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");

/**
* Clase para trabajar con el acuse de recepcion de envío
* @author Freddy Varas Henriquez (fvaras@pradi.cl)

RecepcionEnvio: Resultados de la Recepción de Envíos de Documentos ( 1 ) ( Acuse Recibo ). 
Respuesta de Recepción de un envío de DTEs  .
-Esta respuesta se utiliza para dar acuse de recibo de los documentos, pero no implica la aceptación comercial de dichos documentos. 
En la misma respuesta al envío es posible detallar la respuesta de recepción individual por cada DTE, 
particularmente útil en el caso de Rechazar la recepción de algún documento en particular.
**/

class AcuseRecibo
{
	private $_siiDatos = NULL;
	private $_timestamp;
	private $Caratula;
	private $RecepcionEnvio;
	private $ResultadoDTE;
	private $token;
	private $_year;
	private $_month;

	private $glosaEnvio = array(
		0 => "Envío Recibido Conforme",
		1 => "Envío Rechazado - Error de Schema",
		2 => "Envío Rechazado - Error de Firma",
		3 => "Envío Rechazado - RUT Receptor No Corresponde",
		90 => "Envío Rechazado - Archivo Repetido",
		91 => "Envío Rechazado - Archivo Ilegible",
		99 => "Envío Rechazado - Otros");

	private $glosaDocumento = array(
		0 => "DTE Recibido OK",
		1 => "DTE No Recibido - Error de Firma",
		2 => "DTE No Recibido - Error en RUT Emisor",
		3 => "DTE No Recibido - Error en RUT Receptor",
		4 => "DTE No Recibido - DTE Repetido",
		99 => "DTE No Recibido - Otros");

	private $respuestaDocumento = array(
		0 => "ACEPTADO OK",
		1 => "ACEPTADO CON DISCREPANCIAS",
		2 => "RECHAZADO");

	private $wsdl_url = array(0 => "https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL",1 => "https://palena.sii.cl/DTEWS/GetTokenFromSeed.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);
	private $ruta = "../Documentos/acuse/";

	function __construct($input)
	{
		$this->_siiDatos = $input;
		$this->_timestamp = date('Y-m-d\TH:i:s');
		$this->_year = Date("Y");
		$this->_month = Date("m");	
		$this->verificaCarpeta($this->_year,$this->_month);
	}

	/**
	* Funcion que permite la creacion de la carpeta de destino si no existe
	* @param Integer $year con el año solicitado
	* @param Intener $month con el mes que se desea crear
	**/	
	private function verificaCarpeta($year,$month)
	{
		try {
			$ruta = "../Documentos/acuse/".$year."/".$month;
			mkdir($ruta,0777,true);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

/**
* Método que permite generar la estructura necesaria del XML
* @return Boolean
**/
public function GenerarXML()
{
	self::GeneraCaratula();
	self::RecepcionEnvio();
	return self::EnvioDTE();
}

	/**
	* Método que permite unir los XML y enviarlo automaticamente al S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return boolean
	**/	
	private function EnvioDTE()
	{
		$caratula = new XML();
		$caratula->loadXML($this->Caratula);

		$recepcionenvio = new XML();
		$recepcionenvio->loadXML($this->RecepcionEnvio);

		$_caratula = new SimpleXMLElement($caratula->saveXML());
		$_recepcionEnvio = new SimpleXMLElement($recepcionenvio->saveXML());

		$id = "ACUSE_RecepcionEnvio_".str_replace("-","_",$_caratula->RutRecibe)."_".$this->_siiDatos["emisor_region"]."_".$_recepcionEnvio->RecepcionDTE->Folio."_".Date("YmdHis");

		$EnvioDTE = new XML();
		$EnvioDTE->generate([
			"RespuestaDTE" => [
			"@attributes" => [
			"version" => "1.0",
			"xsi:schemaLocation" => "http://www.sii.cl/SiiDte RespuestaEnvioDTE_v10.xsd",
			"xmlns" => "http://www.sii.cl/SiiDte",
			"xmlns:xsi" => "http://www.w3.org/2001/XMLSchema-instance"
			],
			"Resultado" => [
			"@attributes" => [
			"ID" => $id
			],
			"Caratula" => $caratula->getElementsByTagName("Caratula")->item(0),
			"RecepcionEnvio" => $recepcionenvio->getElementsByTagName("RecepcionEnvio")->item(0),
			]	
			],
			]);

		$objFirma = new FirmaElectronica($this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"]);
		$arr = array("<DATA>","</DATA>");
		$xml = $objFirma->firmarXML(trim(str_replace($arr, "", $EnvioDTE->saveXML())),"#".$id,"Resultado",true);

		$objValidate = new Validate();

		$Schema = $objValidate->validateSCHEMA("ACUSE_1",$xml);
		$Firma = $objValidate->validateSCHEMA("ACUSE_1",$xml);

		$objEmpresa = new Empresa($this->_siiDatos["emisor_region"]);
		$empresa = $objEmpresa->getEmpresa($this->_siiDatos["emisor_region"]);

		$ruta = $this->ruta.$this->_year."/".$this->_month;
		$archivo = $id;

		$destino = "Documentos/acuse/".$this->_year."/".$this->_month."/".$id.".xml";
		$folioInterno = $this->_siiDatos["folioInterno"];

		if($Schema == "" && $Firma == "")
		{
			$this->token = trim($this->getToken());

			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" => "El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($this->token);
					if(trim($token->GLOSA == "Token Creado"))
					{
						$fp = fopen($ruta."/".$archivo.".xml", "w+");
						fwrite($fp, $xml);
						fclose($fp);
						$objDTE = new DTE($archivo.".xml",$token->TOKEN,$this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"],$empresa[1]["empresa_rut"],$empresa[1]["empresa_dv"],"acuse_1");
						$res = $objDTE->enviarDTE2($this->_year,$this->_month);

						if($res->STATUS == 0)
						{
							$this->actualizarRuta($destino,$folioInterno);
							return array("Respuesta" => true, "Mensaje" => "Documento generado y enviado con exito!");
						}else{
							return array("Respuesta" => false,"Mensaje" => "ESTADO : ".$res->STATUS."\nERROR : ".$res->DETAIL->ERROR);
						}
					}else{
						return array("Respuesta" => false,"Mensaje" => trim($token->GLOSA));
					}
				} catch (Exception $e) {
					return array("Respuesta" => false,"Mensaje" => $e->getMessage());
				}
			}

		}else{
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en el envio del DTE : ".$Schema."\n".$Firma);
		}
	}

private function actualizarRuta($destino,$folioInterno)
{
			try {
					$objDbConnect = new db_connect();
					$null = NULL;
					$query = "UPDATE sii_dte_recibido SET recibido_ruta_1 = ? WHERE recibido_foliointerno = ?";
					$stmt = $objDbConnect->getConnection()->prepare($query);
	
					if($stmt)
					{
	
					$stmt->bind_param("si",$destino,$folioInterno);
					
					if($stmt->execute())
					{
						return array("Respuesta" => true);
					}else{
						return array("Respuesta" => false,"Mensaje" => $stmt->error);
					}
				}else{
					return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en la consulta SQL");
				}
			}catch (Exception $e) {
			return $e->getMessage();
			}
}
	/**
	* Método que permite generar la Carátula del documento segun el esquema
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraCaratula()
	{
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->_siiDatos["emisor_region"]);
		$objRecibo = new Recibo();
		$detalle = count($objRecibo->getDetalleRecibo($this->_siiDatos["folioInterno"]));
		$Caratula = new XML();
		$Caratula->generate([
			"Caratula" => [
			"@attributes" => [
			"version" => "1.0"
			],
			"RutResponde" => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			// "RutRecibe" => $this->_siiDatos["empresa_emisor_rut"]."-".$this->_siiDatos["empresa_emisor_dv"],
			"RutRecibe" => "76535898-1",
			"IdRespuesta" => $this->_siiDatos["recibido_id"],
			"NroDetalles" => $detalle,
			"NmbContacto" => ($this->_siiDatos["recibido_nombre"] == "") ? false : substr($this->_siiDatos["recibido_nombre"],0,40),
			"FonoContacto" => ($this->_siiDatos["recibido_telefono"] == "") ? false : substr($this->_siiDatos["recibido_telefono"],0,40),
			"MailContacto" => ($this->_siiDatos["recibido_correo"] == "") ? false : substr($this->_siiDatos["recibido_correo"],0,40),
			"TmstFirmaResp" => $this->_timestamp,
			]
			]);

		$this->Caratula = self::Extrae($Caratula->saveXML());
	}

	/**
	* Método que permite generar la respuesta de recepcion del envio
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function RecepcionEnvio()
	{
		$objRecibo = new Recibo();
		$detalle = $objRecibo->getDetalleArchivo($this->_siiDatos["recibido_id"]);
		if(count($xml->SetDTE->DTE) > 0)
		{
			$path = 1;
		}else if(count($xml->Documento) > 0)
		{
			$path = 0;
		}
		$r = new XML();
		$r->loadXML($this->setRecepcionDTE());
		$RecepcionEnvio = new XML();
		$RecepcionEnvio->generate([
			"RecepcionEnvio" => [
			"NmbEnvio" => $detalle[1]["recibido_archivo"],
			"FchRecep" => $this->_timestamp,
			"CodEnvio" => $this->_siiDatos["folioInterno"],
			"EnvioDTEID" => $detalle[1]["recibido_dteid"],
			// "Digest" => ($path == 1) ? $xml->Signature->SignedInfo->Reference->DigestValue : $xml->Signature->SignedInfo->Reference->DigestValue,
			"RutEmisor" => $detalle[1]["recibido_rut"]."-".$detalle[1]["recibido_dv"],
			"RutReceptor" => $detalle[1]["recibido_rut2"]."-".$detalle[1]["recibido_dv2"],
			"EstadoRecepEnv" => $this->_siiDatos["recibido_EstadoRecepEnv"],
			"RecepEnvGlosa" => utf8_encode($this->glosaEnvio[$this->_siiDatos["recibido_EstadoRecepEnv"]]),
			"NroDTE" => $this->_siiDatos["totalElementos"],
			"RecepcionDTE" => $r->getElementsByTagName("DATA")->item(0),
			]
			]);
		$this->RecepcionEnvio = self::Extrae($RecepcionEnvio->saveXML());
	}

	/**
	* Método que permite generar la respuesta necesaria segun esquema de el(los) documento(s)
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	public function setRecepcionDTE()
	{
		$objRecibo = new Recibo();
		$detalle = $objRecibo->getDetalleRecibo($this->_siiDatos["folioInterno"]);
		$RecepcionDTE = new XML();
		$contador = 1;

		$objRecibo = new Recibo();
		foreach ($detalle as $key => $value) {
			$objRecibo->actualizaRecibo1($this->_siiDatos["recibido_EstadoRecepDTE"][$contador],$this->_siiDatos["recibido_id2"][$contador]);
			$RecepcionDTE->generate([
				"RecepcionDTE" => [
				"TipoDTE" => $value["recibido_tipo_dcto"],
				"Folio" => $value["recibido_folio"],
				"FchEmis" => $value["recibido_femision"],
				"RUTEmisor" => $value["recibido_rut"]."-".$value["recibido_dv"],
				"RUTRecep" => $value["recibido_rut2"]."-".$value["recibido_dv2"],
				"MntTotal" => $value["recibido_monto"],
				"EstadoRecepDTE" => $this->_siiDatos["recibido_EstadoRecepDTE"][$contador],
				"RecepDTEGlosa" => utf8_encode($this->glosaDocumento[$this->_siiDatos["recibido_EstadoRecepDTE"][$contador]]),
				]
				]);
			$contador++;
		}
		return $xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$RecepcionDTE->saveXML()))."</DATA>";
	}

	/**
	* Método que permite limpiar los XML resultantes.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function Extrae($xml)
	{
		$reemplazo = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		return trim(str_replace($reemplazo,"",$xml));
	}

	/**
	* Método obtener el TOKEN (semilla) desde el WebService del S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	public function getToken() {
		try {

			$this->client = $this->getConnection($this->wsdl_url[0]);
			$getSeed = $this->client->getSeed();
			$xml = simplexml_load_string($getSeed);
			$xml->registerXPathNamespace('SII', 'http://www.sii.cl/XMLSchema');
			$events = $xml->xpath('//SII:RESP_BODY' );
			$semilla = $events[0]->SEMILLA;

			return $this->GetTokenFromSeed($this->firmaSemilla($semilla));
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que permite timbrar el XML de la semilla
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	* @param XML
	**/
	private function firmaSemilla($input)
	{
		try {
			$objFIRMA = new FirmaElectronica($this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"]);
			$semillaFirmada = $objFIRMA->firmarXML(
				(new XML())->generate([
					'getToken' => [
					'item' => [
					'Semilla' => $input
					]
					]
					])->saveXML());
			return $semillaFirmada;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que permite obtener el TOKEN válido como respuesta del WebService
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	* @param XML
	**/
	private function GetTokenFromSeed($signed)
	{
		try {
			$this->client = $this->getConnection($this->wsdl_url[1]);
			$response = $this->client->getToken($signed);

			$replaceArray = array("<SII:RESP_BODY>","</SII:RESP_BODY>","<SII:RESP_HDR>","</SII:RESP_HDR>");
			$response = trim(str_replace($replaceArray, "", $response));
		// echo $response."<--";
			return $response;
		} catch (Exception $e) {
			return $e->getMessage();
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
			throw new Exception ("La Conexion ha fallado");
		}
	}

}
?>