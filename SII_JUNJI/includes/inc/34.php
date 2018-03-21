<?php
require_once("class.xml.php");
require_once("class.CAF.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
require_once("class.dte.php");
require_once("class.documentos.php");
require_once("class.empresa.php");
require_once("class.cotizacion.php");

/**
 * Clase para trabajar con la Factura No Afecta o Exenta Electronica
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class FacturaElectronicaAfecta
{
	private $cotizacion;
	private $siiDatos;
	private $timestamp;
	private $referencia;

	private $TED;
	private $Caratula;
	private $Detalle;
	private $DTE;

	private $token;
	private $Documento;
	private $tipo_dcto;
	private $folio;

	private $DscRcgGlobal;

	private $client = NULL;
	private $wsdl_url = array(0 => "https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL",1 => "https://palena.sii.cl/DTEWS/GetTokenFromSeed.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);

	//0 : CERTIFICACION, 1 : PRODUCCION
	private $ambiente = 0;
	function __construct($input)
	{
		$this->cotizacion = $input["cotizacion_id"];
		$this->tipo_dcto = $input["tipo_dcto"];
		$objCAF = new CAF($this->tipo_dcto);
		$resCAF = $objCAF->getCAF();
		$this->folio = $resCAF[1]["folio_actual"] + 1;

		$this->timestamp = date('Y-m-d\TH:i:s');
		$this->referencia = "F".$this->folio."T".$this->tipo_dcto;
		$this->siiDatos = $input;

		$esValido = $objFirma->validaUsuario($this->siiDatos["emisor_region"],34,$this->siiDatos["emisor_rut"]);
		if(!$esValido[1]["esValido"])
		{
			echo json_encode(array("Respuesta" => false,"Mensaje" => "Usuario no autorizado a firmar el DTE solicitado"));
			exit;
		}
	}

	/**
	* Funcion principal que llama a los otros métodos para la creacion del DTE correspondiente
	* que sera enviado automaticamente al S.I.I.
	* @return boolean
	**/
	public function GenerarXML()
	{
		$objCAF = new CAF($this->tipo_dcto);
		$resFolio = $objCAF->validaFolio($this->folio,$this->tipo_dcto);
		if($resFolio["Respuesta"] == false)
		{
			return array("Respuesta" => false,"Mensaje" => $resFolio["Mensaje"]);
		}

		self::GeneraCaratula();
		$objCotizacion = new Cotizacion();
		$cotizacion = $objCotizacion->getCotizacion($this->cotizacion);

		if($cotizacion[1]["cotizacion_valordr"] <> 0)
		{
			self::generaDctoGlobal($cotizacion[1]["cotizacion_tpomov"],$cotizacion[1]["cotizacion_tpovalor"],$cotizacion[1]["cotizacion_valordr"]);
		}

		self::GeneraTED();
		self::GeneraDetalle();
		self::GeneraDocumento();
		self::Timbrar();
		return self::EnvioDTE();
	}

	/**
	* Metodo que agrega al XML un descuento o recargo segun corresponda
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	*/
	public function generaDctoGlobal($TpoMov,$TpoValor,$ValorDR)
	{
		$DscRcgGlobal = new XML();
		$DscRcgGlobal->generate([
			"DscRcgGlobal" => [
			"NroLinDR" => 1,
			"TpoMov" => $TpoMov,
			"GlosaDR" => ($TpoValor == "D") ? substr("DESCUENTO GLOBAL ITEMS AFECTOS",0,45) : substr("RECARGO GLOBAL ITEMS AFECTOS",0,45),
			"TpoValor" => "%",
			"ValorDR" => $ValorDR,
			]
			]);
		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$DscRcgGlobal->saveXML()))."</DATA>";
		$this->DscRcgGlobal = $xml;
	}

	/**
	* Método que permite timbrar el documento dado
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	public function Timbrar(){
		$TED = new XML();
		$TED->loadXML(utf8_encode($this->TED));

		$Documento = new XML();
		$Documento->loadXML(utf8_encode($this->Documento));
		// echo $->saveXML();
		$parent = $Documento->getElementsByTagName("Documento")->item(0);
		// print_r($parent);

		$Documento->generate(['TmstFirma'=>$this->timestamp], $parent);

		$arr = array("<DATA>","</DATA>");
		$objFirma = new FirmaElectronica();
		$xml = $objFirma->firmarXML(trim(str_replace($arr,'',$Documento->saveXML())), '#'.$this->referencia, "Documento");
		return $xml;
	}

	/**
	* Método que permite generar la estructura XML del documento
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraDocumento()
	{
		$Detalle = new XML();
		$Detalle->loadXML($this->Detalle);

		$Ted = new XML();
		$Ted->loadXML(utf8_encode($this->TED));

		$objCotizacion = new Cotizacion();
		$cotizacion = $objCotizacion->getCotizacion($this->cotizacion);

		$DscRcgGlobal = new XML();
		$DscRcgGlobal->loadXML($this->DscRcgGlobal);

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);

		$Documento = new XML();
		$Documento->generate([
			"DTE" => [
			"@attributes" => [
			"version" => "1.0",
			"xmlns" => "http://www.sii.cl/SiiDte",
			],
			"Documento" =>[
			"@attributes" => [
			"ID" => $this->referencia
			],

			"Encabezado" => [
			"IdDoc" => [
			"TipoDTE" => $this->tipo_dcto,
			"Folio" => $this->folio,
			"FchEmis" => Date("Y-m-d")
			],
			"Emisor" => [
			"RUTEmisor" => $empresa[1]["empresa_rut"]."-".$empresa[1]["empresa_dv"],
			"RznSoc" => substr($empresa[1]["empresa_glosa"], 0,100),
			"GiroEmis" => substr($empresa[1]["empresa_giro"], 0,80),
			"Acteco" => $empresa[1]["empresa_acteco"],
			"CdgSIISucur" => $empresa[1]["empresa_sucursal"],
			"DirOrigen" => substr($empresa[1]["empresa_direccion"],0,70),
			"CmnaOrigen" => substr($empresa[1]["empresa_comuna"],0,20),
			"CiudadOrigen" => substr($empresa[1]["empresa_ciudad"],0,20),
			],
			"Receptor" => [
				// "RUTRecep" => $cotizacion[1]["cliente_rut"]."-".$cotizacion[1]["cliente_dv"],
			"RUTRecep" => $this->siiDatos["receptor_rut"]."-".$this->siiDatos["receptor_dv"],
			"RznSocRecep" => substr($cotizacion[1]["cliente_empresa"],0,100),
			"GiroRecep" => substr($cotizacion[1]["cliente_giro"],0,40),
			"DirRecep" => substr($cotizacion[1]["cliente_direccion"],0,70),
			"CmnaRecep" => substr($cotizacion[1]["region_glosa"],0,20),
			"CiudadRecep" => substr($cotizacion[1]["ciudad_glosa"],0,20),
			],
			"Totales" => [
			"MntExe" => $this->siiDatos["exento"],
			"MntTotal" => $this->siiDatos["exento"],
			],
				],//Encabezado
				"Detalle" => $Detalle->getElementsByTagName("DATA")->item(0),
				// "DscRcgGlobal" => ($cotizacion[1]["cotizacion_valordr"] == 0) ? false : $DscRcgGlobal->getElementsByTagName("DscRcgGlobal")->item(0),
				"TED" => $Ted->getElementsByTagName("TED")->item(0),
				]
				],

				]);
		$this->Documento = self::Extrae($Documento->saveXML());
	}

	/**
	* Método que permite unir los XML y enviarlo automaticamente al S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return boolean
	**/	
	private function EnvioDTE()
	{

		$objCAF = new CAF($this->tipo_dcto);
		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa();

		$objCotizacion = new Cotizacion();
		$cotizacion = $objCotizacion->getCotizacion($this->cotizacion);

		$EnvioDTE='<?xml version="1.0" encoding="ISO-8859-1"?>';
		$EnvioDTE.='<EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd" version="1.0">';
		$EnvioDTE.='<SetDTE ID="SetDoc">';
		$EnvioDTE.= $this->Caratula;
		$EnvioDTE.= trim(str_replace('<?xml version="1.0"?>','',self::Timbrar()));
		$EnvioDTE.="</SetDTE>";
		$EnvioDTE.="</EnvioDTE>";

		$objFirma = new FirmaElectronica();
		if(!$objFirma->verificarCaducidad())
		return array("Respuesta" => false,"Mensaje" => "Firma Electrónica Inválida");
	
		$xml = $objFirma->firmarXML($EnvioDTE,"#SetDoc","SetDTE",true);
		$objValidate = new Validate();

		$Schema = $objValidate->validateSCHEMA("DTE",$xml);
		$Firma = $objValidate->validateSCHEMA("DTE",$xml);

		if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Error en SCHEMA : ".$Schema);}
		if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma);}

		/************* ENVIO A SII AUTOMATICO ***************/
		if($Schema == "" && $Firma == "")
		{
			$this->token = trim($this->getToken());

			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false,"Mensaje" => "El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($this->token);
					if(trim($token->GLOSA == "Token Creado"))
					{	

						$year = substr($this->timestamp, 0,4);
						$month = substr($this->timestamp, 5,2);

						$this->verificaCarpeta($this->tipo_dcto,$year,$month);

						$fp = fopen("../Documentos/".$this->tipo_dcto."/".$year."/".$month."/".$this->referencia.".xml","w+");
						fwrite($fp, $xml);
						fclose($fp);

						$objDTE = new DTE($this->referencia,$token->TOKEN,$this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"],$empresa[1]["empresa_rut"],$empresa[1]["empresa_dv"],$this->tipo_dcto,$year,$month);
						$res = $objDTE->enviarDTE();
						if($res->STATUS == 0)
						{
							$objDTE->nuevoDTE($this->referencia,$this->tipo_dcto,$this->folio,$res,$cotizacion[1]["cotizacion_cliente_id"],$this->cotizacion);
							// $objDTE->actualizarMonto($this->cotizacion,$cotizacion[1]["cotizacion_neto"]);
							$objCotizacion->actualizarEstado($this->cotizacion,34);
							$objCAF->actualizarFolio($this->folio,$this->tipo_dcto);
							return array("Respuesta" => true,"Mensaje" =>$res);
						}else{
							return array("Respuesta" => false, $res);
						}
					}else{
						return array("Respuesta" => false,"Mensaje" => trim($token->GLOSA));
					}
				} catch (Exception $e) {
					return array("Respuesta" => false,"Mensaje" => "No se ha podido generar el TOKEN al S.I.I.");
				}
			}
		}else{
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en el envio del DTE : ".$Schema."\n".$Firma);
		}
	}


	/**
	* Funcion que permite la creacion de la carpeta de destino si no existe
	* @param Integer $tipoDCTO Tipo de documento
	* @param Integer $year Año solicitado
	* @param Intener $month Mes que se desea crear
	**/	
	private function verificaCarpeta($tipoDCTO,$year,$month)
	{
		try {
			$ruta = "../Documentos/".$tipoDCTO."/".$year."/$month";
			mkdir($ruta,0777,true);					
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que codificar el texto de entrada a formato ISO-8859-1 requerido por el S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return string
	**/	
	private function decode($input)
	{
		$codificacion =  mb_detect_encoding($input);
		// echo $codificacion.":".$input."<br>";
		if($codificacion == "UTF-8")
		{
			return mb_convert_encoding($input,"UTF-8","ISO-8859-1");
		}else if($codificacion == "ASCII"){
			return mb_convert_encoding($input,"UTF-8","ISO-8859-1");
		}
		return $input;
	}

	/**
	* Método que permite el detalle de los bienes y/o servicios del documento
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/	
	private function GeneraDetalle()
	{
		$objCotizacion = new Cotizacion();
		$cotizacion = $objCotizacion->getCotizacion($this->cotizacion);
		$Detalle = new XML();
		$Data = new XML();
		// $totalElementos = $this->siiDatos["totalElementos"];
		$totalElementos = count($cotizacion);
		$cont=1;
		
		for ($i=1; $i <= $totalElementos; $i++) {
			if($cotizacion[$i]["detalle_producto_id"] <> "")
			{
				$Detalle->generate([
					"Detalle" => [
					"NroLinDet" => $cont,
					"NmbItem" => self::decode($cotizacion[$i]["detalle_producto_id"]),
					"QtyItem" => $cotizacion[$i]["detalle_cantidad"],
					"PrcItem" => $cotizacion[$i]["detalle_unitario"],
					"DescuentoPct" => ($cotizacion[$i]["detalle_descuento"] == 0) ? false : ($cotizacion[$i]["detalle_descuento"] / 100),
					"DescuentoMonto" => ($cotizacion[$i]["detalle_descuento_monto"] == 0) ? false : $cotizacion[$i]["detalle_descuento_monto"],
					"MontoItem" => $cotizacion[$i]["detalle_subtotal"],
					],
					]);
				$cont++;
			}
		}

		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$Detalle->saveXML()))."</DATA>";
		
		// $this->Detalle = self::Extrae($Detalle->saveXML());
		$this->Detalle = $xml;
	}

	/**
	* Método que permite generar la Carátula del documento segun el esquema
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraCaratula()
	{
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa();
		$Caratula = new XML();
		$Caratula->generate([
			"Caratula" => [
			"@attributes" => [
			"version" => "1.0"
			],
			"RutEmisor" => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			"RutEnvia" => "16473220-7",
			"RutReceptor" => $this->siiDatos["receptor_rut"]."-".$this->siiDatos["receptor_dv"],
			"FchResol" => "2016-04-28",
			"NroResol" => 0,
			"TmstFirmaEnv" => $this->timestamp,
			"SubTotDTE" => [
			"TpoDTE" => $this->tipo_dcto,
			"NroDTE" => 1,
			]
			]
			]);

		$this->Caratula = self::Extrae($Caratula->saveXML());
	}

	/**
	* Método que permite generar el TED (Timbre Electronico del DTE)
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/	
	private function GeneraTED()
	{
		$objCAF = new CAF($this->tipo_dcto);
		$pkey = $objCAF->getPkey();

		$objCotizacion = new Cotizacion();
		$cotizacion = $objCotizacion->getCotizacion($this->cotizacion);
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa();

		$TED = new XML();
		$TED->generate([
			'TED' => [
			'@attributes' => [
			'version' => '1.0',
			],
			'DD' => [
			'RE' => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			'TD' => $this->tipo_dcto,
			'F' => $this->folio,
			'FE' => Date("Y-m-d"),
			// 'RR' => $cotizacion[1]["cliente_rut"]."-".$cotizacion[1]["cliente_dv"],
			'RR' => $this->siiDatos["receptor_rut"]."-".$this->siiDatos["receptor_dv"],
			'RSR' => substr($cotizacion[1]["cliente_empresa"],0, 40),
			'MNT' => $this->siiDatos["exento"],
			'IT1' => $cotizacion[1]["detalle_producto_id"],
			'CAF' => $objCAF->getCAF2(),
			'TSTED' => $this->timestamp,
			],
			'FRMT' => [
			'@attributes' => [
			'algoritmo' => 'SHA1withRSA'
			],
			],

			],
			]);

		$DD = $TED->getFlattened('/TED/DD');

		$pkeyid = openssl_pkey_get_private($pkey);
		openssl_sign($DD, $signature, $pkeyid,OPENSSL_ALGO_SHA1);

		$TED->getElementsByTagName('FRMT')->item(0)->nodeValue =  base64_encode($signature);
		openssl_free_key($pkeyid);
		$this->TED = self::Extrae($TED->saveXML());
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
			$objFIRMA = new FirmaElectronica();
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