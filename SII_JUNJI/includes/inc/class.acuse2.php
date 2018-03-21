<?php
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.recibo.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
require_once("class.iecvcompra.php");
/**
* Clase para trabajar con el acuse de recepcion de envío
* @author Freddy Varas Henriquez (fvaras@pradi.cl)

ResultadoDTE : Respuesta de Aprobación/Rechazo Comercial de DTEs .
- Esta respuesta es para detallar la aceptación o rechazo comercial de uno más documentos electrónicos. 
El formato de esta respuesta debe indicar los datos del documento y en el caso de Rechazos indicar una glosa que describa el motivo.
**/
		class AcuseReciboDoc
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
			$ruta = $this->ruta.$year."/".$month;
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
		self::ResultadoDTE();
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

		$resultadoDTE = new XML();
		$resultadoDTE->loadXML($this->ResultadoDTE);

		$_caratula = new SimpleXMLElement($caratula->saveXML());
		$_resultadoDTE = new SimpleXMLElement($resultadoDTE->saveXML());
		$id = "ACUSE_ResultadoDTE_".str_replace("-","_",$_caratula->RutRecibe)."_".$this->_siiDatos["emisor_region"]."_".$_resultadoDTE->Folio."_".Date("YmdHis");

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
			"ResultadoDTE" => $resultadoDTE->getElementsByTagName("DATA")->item(0),
			]	
			],
			]);
		$arr = array("<DATA>","</DATA>");
		$objFirma = new FirmaElectronica($this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"]);
		$xml = $objFirma->firmarXML(trim(str_replace($arr,"",$EnvioDTE->saveXML())),"#".$id,"Resultado",true);

		$objValidate = new Validate();

		$Schema = $objValidate->validateSCHEMA("ACUSE_2",$xml);
		$Firma = $objValidate->validateSCHEMA("ACUSE_2",$xml);

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->_siiDatos["emisor_region"]);

		$ruta = $this->ruta.$this->_year."/".$this->_month;
		$archivo = $id;
		
		$destino = "Documentos/acuse/".$this->_year."/".$this->_month."/".$id.".xml";
		$folioInterno = $this->_siiDatos["folioInterno"];
		$this->token = trim($this->getToken());
		
		// $token =  simplexml_load_string($this->token);
		// print_r($this->token);
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
							$objRecibo = new Recibo();
							// $objRecibo->actualizaRecibo2($this->_siiDatos["recibido_EstadoDTE"],$this->_siiDatos["recibido_id"]);
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
					$query = "UPDATE sii_dte_recibido SET recibido_ruta_2 = ? WHERE recibido_foliointerno = ?";
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
			"RutRecibe" => $this->_siiDatos["empresa_emisor_rut"]."-".$this->_siiDatos["empresa_emisor_dv"],
			"IdRespuesta" => $this->_siiDatos["folioInterno"],
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
	private function ResultadoDTE()
	{
		$objRecibo = new Recibo();
		$detalle = $objRecibo->getDetalleRecibo($this->_siiDatos["folioInterno"]);

		if(count($xml->SetDTE->DTE) > 0)
		{
			$path = 1;
		}else if(count($xml->Documento) > 0)
		{
			$path = 0;
		}
		$contador = 1;

		$objIECVCompra = new IECVCompra();
		$ResultadoDTE = new XML();
		foreach ($detalle as $key => $value) {
			$objRecibo->actualizaRecibo2($this->_siiDatos["recibido_EstadoDTE"][$contador],$this->_siiDatos["recibido_id2"][$contador]);
			$ResultadoDTE->generate([
				"ResultadoDTE" => [
				"TipoDTE" => $value["recibido_tipo_dcto"],
				"Folio" => $value["recibido_folio"],
				"FchEmis" => $value["recibido_femision"],
				"RUTEmisor" => $value["recibido_rut"]."-".$value["recibido_dv"],
				"RUTRecep" => $value["recibido_rut2"]."-".$value["recibido_dv2"],
				"MntTotal" => $value["recibido_monto"],
				"CodEnvio" => $value["recibido_id"],
				"EstadoDTE" => $this->_siiDatos["recibido_EstadoDTE"][$contador],
				"EstadoDTEGlosa" => utf8_encode($this->respuestaDocumento[$this->_siiDatos["recibido_EstadoDTE"][$contador]]),
				// "CodRchDsc" => ($this->_siiDatos["recibido_estado2"] > 0) ? $this->_siiDatos["recibido_estado2"] : false
				]
				]);

			// INSERTAR AL LIBRO DE COMPRA LOS ACEPTADOS
			if($this->_siiDatos["recibido_EstadoDTE"][$contador] == 0)
			{
				$objIECVCompra->ingresaCompraXML($this->_siiDatos["recibido_id2"][$contador],$this->_siiDatos["emisor_region"]);
			}
			// $objRecibo->actualizaRecibo2($this->_siiDatos["recibido_EstadoDTE"][$contador],$value["recibido_id"]);

			$contador++;

			//ACTUALIZAMOS LA INFORMACION EN LA BD
		}
		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$ResultadoDTE->saveXML()))."</DATA>";
		$this->ResultadoDTE = $xml;
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