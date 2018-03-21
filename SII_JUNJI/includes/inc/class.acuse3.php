<?php
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.recibo.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
/**
* Clase para trabajar con el acuse de recepcion de mercaderia y/o servicio
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
**/
class AcuseMercaderia
{
	private $_siiDatos = NULL;
	private $_timestamp;
	private $Caratula;
	private $Recibo;
	private $token;
	private $_year;
	private $_month;
	private $_filename;

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

		$this->_filename = Date("YmdHis");
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
	* Método que permite generar la respuesta de recepcion de mercaderia y/o servicio segun la ley
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function Recibo()
	{

		$objRecibo = new Recibo();
		$detalle = $objRecibo->getDetalleArchivo($this->_siiDatos["recibido_id"]);
		$contador = 1;
		$Recibo = new XML();
		$Recibo->generate([
			"Recibo" => [
			"@attributes" => [
			"version" => "1.0",
			"xmlns" => "http://www.sii.cl/SiiDte",
			],
			"DocumentoRecibo" => [
			"@attributes" => [
			"ID" => "MiPELey"
			],
			"TipoDoc" => $detalle[$contador]["recibido_tipo_dcto"],
			"Folio" => $detalle[$contador]["recibido_folio"],
			"FchEmis" => $detalle[$contador]["recibido_femision"],
			// "RUTEmisor" => $this->_siiDatos["emisor_rut"]."-".$this->_siiDatos["emisor_dv"],
			"RUTEmisor" => $detalle[$contador]["recibido_emisor_rut"]."-".$detalle[$contador]["recibido_emisor_dv"],
			"RUTRecep" => $detalle[$contador]["recibido_rut2"]."-".$detalle[$contador]["recibido_dv2"],
			"MntTotal" => $detalle[$contador]["recibido_monto"],
			"Recinto" => $this->_siiDatos["recibido_recinto"][$contador],
			"RutFirma" => $this->_siiDatos["emisor_rut"]."-".$this->_siiDatos["emisor_dv"],
			"Declaracion" => "El acuse de recibo que se declara en este acto, de acuerdo a lo dispuesto en la letra b) del Art. 4, y la letra c) del Art. 5 de la Ley 19.983, acredita que la entrega de mercaderias o servicio(s) prestado(s) ha(n) sido recibido(s).",
			"TmstFirmaRecibo" => $this->_timestamp,
			]
			]
			]);
		$objRecibo->actualizaRecibo3(0,$this->_siiDatos["recibido_id"][1]);
		$objFirma = new FirmaElectronica($this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"]);
		$this->Recibo = self::Extrae($objFirma->firmarXML($Recibo->saveXML(),"#MiPELey","DocumentoRecibo",true));
	}

	/**
	* Método que permite generar la estructura necesaria del XML
	* @return Boolean
	**/
	public function GenerarXML()
	{
		self::GeneraCaratula();
		self::Recibo();
		return self::EnvioDTE();
	}

	/**
	* Método que permite unir los XML y enviarlo automaticamente al S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return boolean
	**/	
	private function EnvioDTE()
	{
		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->_siiDatos["emisor_region"]);

		$caratula = new XML();
		$caratula->loadXML($this->Caratula);

		$recibo = new XML();
		$recibo->loadXML($this->Recibo);

		$_caratula = new SimpleXMLElement($caratula->saveXML());
		$_recibo = new SimpleXMLElement($recibo->saveXML());

		$id = "ACUSE_Mercaderia_EnvioRecibos_".str_replace("-","_",$_caratula->RutRecibe)."_".$this->_siiDatos["emisor_region"]."_".$_recibo->DocumentoRecibo->Folio."_".Date("YmdHis");

		$archivo = $id;

		$EnvioDTE = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$EnvioDTE .='<EnvioRecibos version="1.0" xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioRecibos_v10.xsd">';
		$EnvioDTE .='<SetRecibos ID="'.$id.'">';
		$EnvioDTE .= $this->Caratula;
		$EnvioDTE .= $this->Recibo;
		$EnvioDTE .='</SetRecibos>';
		$EnvioDTE .='</EnvioRecibos>';

		$objFirma = new FirmaElectronica($this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"]);
		$xml = $objFirma->firmarXML($EnvioDTE,"#".$id,"SetRecibos",true);

		$objValidate = new Validate();

		$Schema = $objValidate->validateSCHEMA("ACUSE_3",$xml);
		$Firma = $objValidate->validateSCHEMA("ACUSE_3",$xml);
		$ruta = $this->ruta.$this->_year."/".$this->_month;

		$destino = "Documentos/acuse/".$this->_year."/".$this->_month."/".$id.".xml";
		$folioInterno = $this->_siiDatos["folioInterno"];

		if($Schema == "" && $Firma == "")
		{
			$this->token = trim($this->getToken());

			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" => "El servicio no está disponible.");
			}else{
				$token = new SimpleXMLElement($this->token);
				if(trim($token->GLOSA == "Token Creado"))
				{
					$fp = fopen($ruta."/".$archivo.".xml", "w+");
					fwrite($fp, $xml);
					fclose($fp);
					
					$objDTE = new DTE($archivo.".xml",$token->TOKEN,"16473220","7",$empresa[1]["empresa_rut"],$empresa[1]["empresa_dv"],"acuse_2");
					$res = $objDTE->enviarDTE2($this->_year,$this->_month);

					if($res->STATUS == 0)
					{
						$this->actualizarRuta($destino,$folioInterno);
						$objRecibo = new Recibo();
						return array("Respuesta" => true, "Mensaje" => "Documento generado y enviado con exito!");
					}else{
						return array("Respuesta" => false,"Mensaje" => "ESTADO : ".$res->STATUS."\nERROR : ".$res->DETAIL->ERROR);
					}

				}else{
					return array("Respuesta" => false,"Mensaje" => trim($token->GLOSA));
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
			$query = "UPDATE sii_dte_recibido SET recibido_ruta_3 = ? WHERE recibido_foliointerno = ?";
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
		$objRecibo = new Recibo();
		$detalle = $objRecibo->getDetalleArchivo($this->_siiDatos["recibido_id"]);
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->_siiDatos["emisor_region"]);
		$Caratula = new XML();
		$Caratula->generate([
			"Caratula" => [
			"@attributes" => [
			"version" => "1.0"
			],
			"RutResponde" => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			"RutRecibe" => $detalle[1]["recibido_emisor_rut"]."-".$detalle[1]["recibido_emisor_dv"],
			"NmbContacto" => ($this->_siiDatos["recibido_nombre"][1] == "") ? false : substr($this->_siiDatos["recibido_nombre"][1],0,40),
			"FonoContacto" => ($this->_siiDatos["recibido_telefono"][1] == "") ? false : substr($this->_siiDatos["recibido_telefono"][1],0,40),
			"MailContacto" => ($this->_siiDatos["recibido_correo"][1] == "") ? false : substr($this->_siiDatos["recibido_correo"][1],0,40),
			"TmstFirmaEnv" => $this->_timestamp,
			]
			]);

		$this->Caratula = self::Extrae($Caratula->saveXML());
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