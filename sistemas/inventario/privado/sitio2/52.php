<?php
header("content-type:text/html");
ini_set('display_errors', '0');
require_once("../../../../SII_JUNJI/includes/inc/class.xml.php");
require_once("../../../../SII_JUNJI/includes/inc/class.CAF.php");
require_once("../../../../SII_JUNJI/includes/inc/class.FirmaElectronica.php");
// require_once("class.validateSCHEMA.php");
require_once("../../../../SII_JUNJI/includes/inc/class.validate.php");
require_once("../../../../SII_JUNJI/includes/inc/class.dte.php");
require_once("../../../../SII_JUNJI/includes/inc/class.documentos.php");
require_once("../../../../SII_JUNJI/includes/inc/class.empresa.php");
require_once("../../../../SII_JUNJI/includes/inc/class.cotizacion.php");
require_once("../../../../SII_JUNJI/includes/inc/class.autorizado.php");
require_once("../../../../SII_JUNJI/includes/inc/class.umbral.php");

/**
 * Clase para trabajar con las Guias de Despacho Electronicas
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class GuiaDespachoElectronica
{
	private $siiDatos;
	private $timestamp;
	private $referencia;

	private $TED;
	private $Caratula;
	private $Detalle;
	private $DTE;
	private $RegionEmpresaReceptora;

	private $DetalleProductos;

	private $token;
	private $Documento;
	private $tipo_dcto;
	private $folio;
	private $IndTraslado;
	private $GuiaDespachoId;

	private $datosPersonaAutorizada;
	private $total = 0;
	private $totaliva = 0;

	private $EmpresaEmisora;
	private $origen;

	private $client = NULL;
	private $wsdl_url = array(0 => "https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL",1 => "https://palena.sii.cl/DTEWS/GetTokenFromSeed.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);

	//0 : CERTIFICACION, 1 : PRODUCCION
	private $ambiente = 1;

	function __construct($input)
	{
		$this->RegionEmpresaReceptora = $input['destino_region'];
		$this->origen = $input["dte_origen"];
		$this->DetalleProductos = $input['detalle_prod'];
		$this->siiDatos = $input;
		$this->IndTraslado = 6;
		$this->tipo_dcto = 52;
		$this->GuiaDespachoId = $input['guia_despacho_id'];
		$objCAF = new CAF($this->tipo_dcto,$input["emisor_region"]);
		$resCAF = $objCAF->getCAF();
		if($resCAF)$this->folio = $resCAF[1]["folio_actual"] + 1;
		$this->timestamp = date('Y-m-d\TH:i:s');
		$this->referencia = "F".$this->folio."T".$this->tipo_dcto;

		$objEmpresa = new Empresa();
		$this->EmpresaEmisora = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);

		// $this->datosPersonaAutorizada = Autorizado::getDetalleAutorizacion($this->siiDatos["emisor_region"],$this->tipo_dcto);

		foreach ($this->DetalleProductos as $value) {
			$this->total += ($value["doc_conversion"]*$value['doc_cantidad']);
		}
		$this->totaliva =$this->total*0.19;

	}

	/**
	* Funcion principal que llama a los otros métodos para la creacion del DTE correspondiente
	* que sera enviado automaticamente al S.I.I.
	* @return boolean
	**/	
	public function GenerarXML()
	{

		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);
		$resFolio = $objCAF->validaFolio($this->folio,$this->tipo_dcto,$this->siiDatos["emisor_region"]);
		if($resFolio["Respuesta"] == false)
		{
			return array("Respuesta" => false,"Mensaje" => $resFolio["Mensaje"]);
		}

		self::GeneraCaratula();
		self::GeneraTED();
		self::GeneraDetalle();
		self::GeneraDocumento();
		self::Timbrar(); // NUEVO

		return self::EnvioDTE();
	}

	/**
	* Método que permite timbrar el documento dado
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function Timbrar(){
		$TED = new XML();
		$TED->loadXML(utf8_encode($this->TED));

		$Documento = new XML();
		$Documento->loadXML(utf8_encode($this->Documento));
		$parent = $Documento->getElementsByTagName("Documento")->item(0);

		$Documento->generate(['TmstFirma'=>$this->timestamp], $parent);

		$arr = array("<DATA>","</DATA>");
		$objFirma = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
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
		//self::GeneraDetalle();
		//self::GeneraTED();
		$Detalle = new XML();
		$Detalle->loadXML($this->Detalle);

		$Ted = new XML();
		$Ted->loadXML(utf8_encode($this->TED));

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"],$this->siiDatos["origen_despacho"]);
		$empresareceptora = $objEmpresa->getEmpresa($this->RegionEmpresaReceptora);//AQUI HAY QUE GUARDAR LA REGION DEL RECEPTOR PARA IR A BUSCAR LOS DATOS DEL RECEPTOR POR MIENTRAS PROBAMOS CON LAS 14
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
			"FchEmis" => Date("Y-m-d"),
			"IndTraslado" => $this->IndTraslado,
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
			"RUTRecep" => $empresareceptora[1]["empresa_rut"]."-".$empresareceptora[1]["empresa_dv"],
			// "RznSocRecep" => substr($empresareceptora[1]["empresa_glosa"], 0,100),
			"RznSocRecep" => substr($this->siiDatos["datosDestino"]["Destinatario"], 0,100),
			// "GiroRecep" => substr($empresareceptora[1]["empresa_giro"], 0,40),
			// "DirRecep" => substr($empresareceptora[1]["empresa_direccion"],0,70),
			// "CmnaRecep" => substr($empresareceptora[1]["empresa_comuna"],0,20),
			// "CiudadRecep" => substr($empresareceptora[1]["empresa_ciudad"],0,20),
			"GiroRecep" => substr($empresareceptora[1]["empresa_giro"], 0,40),
			"DirRecep" => substr($this->siiDatos["datosDestino"]["Direccion"],0,70),
			"CmnaRecep" => substr($this->siiDatos["datosDestino"]["Comuna"],0,20),
			"CiudadRecep" => substr($this->siiDatos["datosDestino"]["Ciudad"],0,20),
			],
			"Totales" => [
			"MntNeto" =>$this->total,
			"TasaIVA" => 19,
			"IVA" => round($this->totaliva),
			"MntTotal" => round($this->total+$this->totaliva)]
			,],//Encabezado
			"Detalle" => $Detalle->getElementsByTagName("DATA")->item(0),
			"TED" => $Ted->getElementsByTagName("TED")->item(0),
				// "TmstFirma" => $this->timestamp
				]//Documento
				],//DTE

				]);
		// echo $Documento->saveXML();
		// exit;
		$this->Documento = self::Extrae($Documento->saveXML());
	}

	/**
	* Método que permite unir los XML y enviarlo automaticamente al S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return boolean
	**/	
	private function EnvioDTE()
	{

		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);
		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);
		$empresareceptora = $objEmpresa->getEmpresa($this->RegionEmpresaReceptora);//ESTE ES UN NUMERO DE LA REGION CREADO PARA LA EMPRESA RECEPTORA

		$EnvioDTE='<?xml version="1.0" encoding="ISO-8859-1"?>';
		$EnvioDTE.='<EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd" version="1.0">';
		$EnvioDTE.='<SetDTE ID="SetDoc">';
		$EnvioDTE.= $this->Caratula;
		$EnvioDTE.= trim(str_replace('<?xml version="1.0"?>','',self::Timbrar()));
		$EnvioDTE.="</SetDTE>";
		$EnvioDTE.="</EnvioDTE>";
		$objFirma = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
		if(!$objFirma->verificarCaducidad())return array("Respuesta" => false,"Mensaje" => "Firma Electrónica Inválida");
		$xml = $objFirma->firmarXML($EnvioDTE,"#SetDoc","SetDTE",true);

		$objValidate = new Validate();

		$Schema = $objValidate->validateSCHEMA("DTE",$xml);
		$Firma = $objValidate->validateSCHEMA("DTE",$xml);

		// if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Error en SCHEMA : ".$Schema);}
		// if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma);}
		if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Se ha producido un error en el Schema del documento generado.");}
		if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al firmar el documento con su firma digital");}

		// echo $xml;
		// exit;
		/************* ENVIO A SII AUTOMATICO ***************/
		if($Schema == "" && $Firma == "")
		{
			$year = substr($this->timestamp, 0,4);
			$month = substr($this->timestamp, 5,2);

			$this->verificaCarpeta($this->tipo_dcto,$year,$month);

			$fp = fopen("../../../../sistemas/archivos/SII/Documentos/".$this->tipo_dcto."/".$year."/".$month."/".$this->referencia.".xml","w+");
			fwrite($fp, $xml);
			fclose($fp);
			$this->token = trim($this->getToken());

			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" => "El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($this->token);
					if(trim($token->GLOSA == "Token Creado"))
					{	
						$objDTE = new DTE($this->referencia,$token->TOKEN,$this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"],$empresa[1]["empresa_rut"],$empresa[1]["empresa_dv"],$this->tipo_dcto,$year,$month);
						$res = $objDTE->enviarDTE();
						if($res->STATUS == 0)
						{
							$Result = DTE::nuevoDTE_52($this->referencia,$this->tipo_dcto,$this->folio,$res,$empresareceptora[1]["empresa_id"],$this->GuiaDespachoId,$this->siiDatos["emisor_region"],round($this->total),round($this->totaliva),round($this->total+$this->totaliva),$this->DetalleProductos,$this->IndTraslado,$this->origen);

							$objCAF->actualizarFolio($this->folio,$this->tipo_dcto,$this->siiDatos["emisor_region"]);

							$objUmbral = new Umbral($this->tipo_dcto,$this->siiDatos["emisor_region"]);
							return array("Respuesta" => true, "Mensaje" => $res ,"Iddte" => $Result,"folio" => $this->folio);
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
			$ruta = "../../../../sistemas/archivos/SII/Documentos/".$tipoDCTO."/".$year."/$month";
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
		return htmlentities($input);
	}

	/**
	* Método que permite el detalle de los bienes y/o servicios del documento
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraDetalle()
	{
		$Detalle = new XML();
		$productos = $this->DetalleProductos;
		$cont=1;
		foreach ($productos as $value) {
			//$value['inv_codigo'];
			$Detalle->generate([
				"Detalle" => [
				"NroLinDet" => $cont,
				"CdgItem" => ($value['inv_codigo'] <> '') ? self::getCdgItem($value['inv_codigo'])->getElementsByTagName("CdgItem")->item(0) : false,
				"NmbItem" => substr(self::decode($value['doc_especificacion']), 0,80),
				"QtyItem" => $value['doc_cantidad'],
					// "PrcItem" => $value["doc_conversion"],// ($this->IndTraslado == 5) ? false : 
				"UnmdItem" => ($value["doc_umedida"] <> '') ? substr($value["doc_umedida"],0,4) : false,
				"PrcItem" => ($value["doc_conversion"] <> 0) ? $value["doc_conversion"] : false,
				"MontoItem" => ($value["doc_conversion"]*$value['doc_cantidad'])
				],
				]);
			$cont++;
		}
		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$Detalle->saveXML()))."</DATA>";

		$this->Detalle = $xml;
	}

	/**
    * Método que permite agregar el codigo del producto si tuviese alguno
    * @param String $input Codigo a ingresar
    * @return XML Resultado en formato XML
    *
    * TIPOS DE CODIGO
    * EAN13
    * PLU
    * DUN14
    * INT1
    * INT2
    * EAN128
    **/
	private function getCdgItem($input)
	{
		$tipo = 3;
		$codificacion = [
		0 => "EAN",
		1 => "PLU",
		2 => "DUN",
		3 => "INT"
		];
		$CdgItem = new XML();
		$CdgItem->generate([
			"CdgItem" => [
			"TpoCodigo" => substr($codificacion[$tipo],0,10),
			"VlrCodigo" => substr($input,0,35)
			]
			]);
		return $CdgItem;
	}

	/**
	* Método que permite generar la Carátula del documento segun el esquema
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraCaratula()
	{
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"],$this->siiDatos["origen_despacho"]);
		$empresareceptora = $objEmpresa->getEmpresa($this->RegionEmpresaReceptora);
		$Caratula = new XML();
		$Caratula->generate([
			"Caratula" => [
			"@attributes" => ["version" => "1.0"],
			"RutEmisor" => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			"RutEnvia" => $this->siiDatos["emisor_rut"]."-".$this->siiDatos["emisor_dv"],
			// "RutReceptor" => ($this->ambiente == 0) ? "60803000-K" : trim($empresareceptora[1]["empresa_rut"])."-".trim($empresareceptora[1]["empresa_dv"]),
			"RutReceptor" => "60803000-K",
			"FchResol" => $datosEmpresa[1]["empresa_fecha"],
			"NroResol" => $datosEmpresa[1]["empresa_resolucion"],
			"TmstFirmaEnv" => $this->timestamp,
			"SubTotDTE" => ["TpoDTE" => $this->tipo_dcto,"NroDTE" => 1],
			]
			]);
		// echo $Caratula->saveXML();
		// exit;
		$this->Caratula = self::Extrae($Caratula->saveXML());
	}

	/**
	* Método que permite generar el TED (Timbre Electronico del DTE)
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraTED()
	{
		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);
		$pkey = $objCAF->getPkey();

		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);
		$empresareceptora = $objEmpresa->getEmpresa($this->RegionEmpresaReceptora);

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
			'RR' => ($this->ambiente == 0) ? "60803000-K" : $empresareceptora[1]["empresa_rut"]."-".$empresareceptora[1]["empresa_dv"],
			'RSR' => substr($empresareceptora[1]["empresa_glosa"],0, 40),
			'MNT' => round($this->total+$this->totaliva),
			'IT1' => substr(self::decode($this->DetalleProductos[0]['doc_especificacion']), 0,40),
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
		// echo $TED->saveXML();
		// exit;
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
	private function Extrae2($xml)
	{
		$reemplazo = "<?xml version=\"1.0\"?>";
		return trim(str_replace($reemplazo,"",$xml));
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
			$objFIRMA = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
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

			$opts =[
			"ssl" => [
					'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => false]
	];

		$context = stream_context_create($opts);
		$options = array("stream_context" => $context);
		
			return $this->client = new SoapClient($wsdl,$options);
		} catch (SoapFault $e) {
			throw new Exception ("La Conexion ha fallado");
		}
	}

}

?>
