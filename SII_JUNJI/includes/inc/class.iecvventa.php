<?php
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
require_once("class.dte.php");

/**
 * Clase que permite trabajar con la Informacion Electronica de Compra y Venta
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class IECVVenta
{
	private $siiDatos;
	private $Caratula;
	private $ResumenPeriodo;
	private $DetallePeriodo;
	private $timestamp;

	private $client = NULL;
	private $wsdl_url = array(0 => "https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL",1 => "https://palena.sii.cl/DTEWS/GetTokenFromSeed.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);
	private $hoy;

	function __construct(){
		
		$this->timestamp = date('Y-m-d\TH:i:s');
		$this->hoy = date("Y-m-d");
	}

	/**
	* Funcion que permite obtener el detalle de los documentos emitidos filtrados por un periodo dado
	* @return Array
	* @param Array con el periodo
	**/	
	public function getIECVPeriodoVentas($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dte a INNER JOIN sii_dcto_ref b ON b.ref_codigo = a.dte_dcto_id INNER JOIN sii_cliente c ON c.cliente_id = a.dte_cliente_id WHERE YEAR(dte_fecha) = ".$input[0]." AND MONTH(dte_fecha) = ".$input[1]." AND a.dte_fecha IS NOT NULL AND dte_dcto_id <> 52 AND a.dte_estado = 0";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$max += 1;
						foreach ($row as $key => $value)
						{
							$arrayName[$max][$key] = $value;
						}
					}
					return $arrayName;
				}else{
					return false;
				}
			}else{
				return false;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Funcion que permite obtener el listado de todos los documentos emitidos segun periodo solicitado
	* @return Array
	* @param Array con el periodo
	**/	
	public function detallePeriodo($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dte a INNER JOIN sii_cliente b ON b.cliente_id = a.dte_cliente_id WHERE year(a.dte_fecha) = ? AND MONTH(a.dte_fecha) = ? AND dte_dcto_id <> 52 AND dte_fecha >= '2017-01-01' AND dte_estado = 0";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("ii",$input[0],$input[1]);
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$max += 1;
						foreach ($row as $key => $value)
						{
							$arrayName[$max][$key] = $value;
						}
					}
					return $arrayName;
				}else{
					return false;
				}
			}else{
				return false;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Funcion que permite todos los DTE de ventas segun periodo dado
	* @return Array
	* @param Array con el periodo
	**/	
	public function getDTEVentas($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT dte_dcto_id as Tipo, COUNT(dte_id) as TotalDTE, SUM(dte_iva) AS Iva, SUM(dte_neto) AS Neto, SUM(dte_total) AS Total, SUM(dte_exento) AS Exento FROM sii_dte WHERE YEAR(dte_fecha) = ".$input[0]." AND MONTH(dte_fecha) = ".$input[1]." AND dte_dcto_id <> 52 AND dte_fecha >= '2017-01-01' AND dte_estado = 0 GROUP BY dte_dcto_id";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$max += 1;
						foreach ($row as $key => $value)
						{
							$arrayName[$max][$key] = $value;
						}
					}
					return $arrayName;
				}else{
					return false;
				}
			}else{
				return false;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Funcion que permite la creacion de la carpeta de destino si no existe
	* @param Integer con el tipo de documento
	* @param Integer con el año solicitado
	* @param Intener con el mes que se desea crear
	**/	
	private function verificaCarpeta($tipoDCTO,$year,$month)
	{
		try {
			$ruta = "../../sistemas/archivos/SII/Documentos/".$this->ruta.$tipoDCTO.'/'.$year;
			mkdir($ruta,0777,true);		
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Funcion principal que llama a los otros métodos para la creacion del DTE correspondiente
	* que sera enviado automaticamente al S.I.I.
	* @return boolean
	**/
	public function GenerarXML($input)
	{
		$this->siiDatos = $input;
		self::GeneraCaratula();
		self::ResumenPeriodo();
		self::GeneraDetalle();
		return self::EnvioDTE();
	}

	/**
	* Método que permite unir los XML y enviarlo automaticamente al S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return boolean
	**/
	private function EnvioDTE($esSimplificado = false,$incluirDetalle = false)
	{
		$id = "ID".str_replace("-","",$this->siiDatos["periodo"]);
		$periodo = explode("-",$this->siiDatos["periodo"]);
		$objFirma = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
		$ruta = "../../sistemas/archivos/SII/Documentos/IECV/".$periodo[0];
		$archivo = "VENTA_".$this->siiDatos["periodo"].".xml";
		$destino = $ruta."/".$archivo;
		$esSimplificado = $esSimplificado;
		$incluirDetalle = $incluirDetalle;

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa();

		$xml = new XML();
		$xml->load($this->ResumenPeriodo);
		/*
		$EnvioDTE  = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$EnvioDTE .= '<LibroCompraVenta xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="'.($esSimplificado) ? "http://www.sii.cl/SiiDte LibroCVS_v10.xsd" : "http://www.sii.cl/SiiDte LibroCV_v10.xsd" .'" version="1.0">';
		$EnvioDTE .= ' <EnvioLibro ID="'.$id.'">';
		$EnvioDTE .= $this->Caratula;
		if(count($this->ResumenPeriodo) <> 0)
		{
			$EnvioDTE .= '<ResumenPeriodo>';
			$EnvioDTE .= $this->ResumenPeriodo;
			$EnvioDTE .= '</ResumenPeriodo>';
		}
		$EnvioDTE .= ($esSimplificado) ? $this->DetallePeriodo : '';
		$EnvioDTE .= '<TmstFirma>'.$this->timestamp.'</TmstFirma>';
		$EnvioDTE .= '</EnvioLibro>';
		$EnvioDTE .= '</LibroCompraVenta>';
		*/
		$ResumenPeriodo = new XML();
		$ResumenPeriodo->loadXML($this->ResumenPeriodo);

		$Detalle = new XML();
		$Detalle->loadXML($this->DetallePeriodo);

		$Caratula = new XML();
		$Caratula->loadXML($this->Caratula);

		$EnvioDTE = new XML();
		$EnvioDTE->generate([
			"LibroCompraVenta" => [
				"@attributes" => [
					"xmlns" => "http://www.sii.cl/SiiDte",
					"xmlns:xsi" => "http://www.w3.org/2001/XMLSchema-instance",
					"xsi:schemaLocation" => ($esSimplificado) ? "http://www.sii.cl/SiiDte LibroCVS_v10.xsd" : "http://www.sii.cl/SiiDte LibroCV_v10.xsd",
					"version" => "1.0"
				],
				"EnvioLibro" => [
					"@attributes" => [
						"ID" => $id
					],
					"Caratula" => $Caratula->getElementsByTagName("Caratula")->item(0),
					"ResumenPeriodo" => (count($this->ResumenPeriodo) <> 0) ? $ResumenPeriodo->getElementsByTagName("ResumenPeriodo")->item(0) : false,
					"Detalle" => ($incluirDetalle) ? $Detalle->getElementsByTagName("DetallePeriodo")->item(0) : false,
					"TmstFirma" => $this->timestamp
				],
			]

		]);

		$array = array("<DetallePeriodo>","</DetallePeriodo>");
		$EnvioDTE = trim(str_replace($array, "", $EnvioDTE->saveXML()));
		$resp = self::verificaCarpeta("IECV",$periodo[0],$periodo[1]);

		$esValido = $objFirma->validaUsuario($this->siiDatos["emisor_region"],"libro_venta",$this->siiDatos["emisor_rut"]);
		if(!$esValido[1]["esValido"])
		{
			echo json_encode(array("Respuesta" => false,"Mensaje" => "Usuario no autorizado a firmar el DTE solicitado"));
			exit;
		}

		$xml = $objFirma->firmarXML($EnvioDTE, '#'.$id, "EnvioLibro",true);
		
		$objValidate = new Validate();

		$Schema = $objValidate->validateSCHEMA("IECV",$xml);
		$Firma = $objValidate->validateSCHEMA("IECV",$xml);

		$Firma2 = $objFirma->verifyXML($xml,"EnvioLibro");

		if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Error en SCHEMA : ".$Schema);}
			if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma);}
				if(!$Firma2){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma2);}

					// echo $xml;
					// exit;

					if($Schema == "" && $Firma == "" && $Firma2)
					{
						$fp = fopen($destino, "w+");
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
									$objDTE = new DTE($destino,$token->TOKEN,$this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"],$empresa[1]["empresa_rut"],$empresa[1]["empresa_dv"],"IECV");
									$res = $objDTE->enviarIECV();

									if($res->STATUS == 0)
									{
										$this->guardaHistorial($this->siiDatos,$ruta,$archivo,$res->STATUS,$res->TRACKID);	
										return array("Respuesta" => true, "Mensaje" => "Libro de Venta generado exitosamente!");
									}else{
										return array("Respuesta" => false,"Mensaje" => $res->DETAIL->ERROR);
									}
								}else{
									return array("Respuesta" => false,"Mensaje" => trim($token->GLOSA));
								}
							} catch (Exception $e) {
								return array("Respuesta" => false,"Mensaje" => $e->getMessage());
							}

						}

					}

				}

	/**
	* Método que permite guardar cada libro que el usuario genere
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @param Array $datos Contiene la informacion del formulario enviado
	* @param String $ruta Destino en donde se guardara el XML resultante de la operacion
	* @param String $archivo Nombre del fichero que contendra la informacion generada en formato XML
	* @param Integer $estado Estado del envio automático al S.I.I.
	* @param Integer $trackid Codigo generado automáticamente por el S.I.I cuando se envia un DTE.
	* @return boolean
	**/
	private function guardaHistorial($datos,$ruta,$archivo,$estado,$trackid)
	{
		try {
			$ruta = trim(str_replace("../","",$ruta));
			$objDbConnect = new db_connect();
			$null = NULL;
			$hora = date("H:i:s");
			$query = "INSERT INTO sii_iecv_historial VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE iecv_femision = '".$this->hoy."', iecv_hora = '".$hora."'";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				$stmt->bind_param("issssissssissss",
					$null,
					$datos["periodo"],
					$datos["periodo_tipo_operacion"],
					$datos["periodo_tipo_envio"],
					$datos["periodo_tipo_libro"],
					$estado,
					$trackid,
					$ruta,
					$archivo,
					$datos["CodAutRec"],
					$this->siiDatos["emisor_region"],
					$this->hoy,
					$hora,
					$null,
					$null
				);
				
				if($stmt->execute())
				{
					return true;
				}else{
					return $stmt->error;
				}
			}else{
				return false;
			}
			exit;
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que permite el detalle de todos los documentos que componen el Libro de compras
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraDetalle()
	{
		$periodo = explode("-",$this->siiDatos["periodo"]);
		$periodo = array(0 => $periodo[0],1 => $periodo[1]);
		$detallePeriodo = $this->detallePeriodo($periodo);
		$DetallePeriodo = new XML();
		foreach ($detallePeriodo as $key => $value) {
			if($value["dte_dcto_id"] <> 52){
				$DetallePeriodo->generate([
					"Detalle" => [
						"TpoDoc" => $value["dte_dcto_id"],
						"NroDoc" => $value["dte_folio"],
						"TasaImp" => ($value["dte_dcto_id"] == 34) ? false : 0.19,
						"FchDoc" => $value["dte_fecha"],
						"RUTDoc" => $value["cliente_rut"]."-".$value["cliente_dv"],
						"RznSoc" => substr(utf8_encode($value["recibido_cliente"]),0,50),
						"MntExe" => ($value["dte_exento"] <> NULL) ? $value["dte_exento"] : 0,
						"MntNeto" => ($value["dte_neto"] <> NULL || $value["dte_dcto_id"] <> 34) ? $value["dte_neto"] : false,
						"MntIVA" => ($value["dte_iva"] <> NULL || $value["dte_dcto_id"] <> 34) ? $value["dte_iva"] : false,
						"MntTotal" => ($value["dte_total"] <> NULL) ? $value["dte_total"] : 0,
					]
				]);
			}
		}
		// $this->DetallePeriodo = self::Extrae($DetallePeriodo->saveXML());
		$this->DetallePeriodo="<DetallePeriodo>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$DetallePeriodo->saveXML()))."</DetallePeriodo>";
	}

	/**
	* Método que permite generar la Carátula del documento segun el esquema
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/	
	private function GeneraCaratula()
	{
		if($this->siiDatos["periodo_tipo_libro"] == "ESPECIAL")
		{
			// $file = 'IECV.txt';
			// $uniq = file_get_contents($file);
			// $id = $uniq + 1 ;
			// file_put_contents($file, $id);
		}

		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);
		$Caratula = new XML();
		$Caratula->generate([
			"Caratula" => [
			// "@attributes" => [
			// "version" => "1.0"
			// ],
				"RutEmisorLibro" => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
				"RutEnvia" => $this->siiDatos["emisor_rut"]."-".$this->siiDatos["emisor_dv"],
				"PeriodoTributario" => $this->siiDatos["periodo"],
				"FchResol" => $datosEmpresa[1]["empresa_fecha"],
				"NroResol" => $datosEmpresa[1]["empresa_resolucion"],
				"TipoOperacion" => $this->siiDatos["periodo_tipo_operacion"],
				"TipoLibro" => $this->siiDatos["periodo_tipo_libro"],
				"TipoEnvio" => $this->siiDatos["periodo_tipo_envio"],
				"FolioNotificacion" => ($this->siiDatos["periodo_tipo_libro"] == "ESPECIAL") ? /*str_replace("-", "", $this->siiDatos["periodo"])*/ 1 : false,
				"CodAutRec" => ($this->siiDatos["periodo_tipo_libro"] == "RECTIFICA") ? $this->siiDatos["CodAutRec"] : false,
			]
		]);
		$this->Caratula = self::Extrae($Caratula->saveXML());
	}


	/**
	* Funcion que permite generar el resumen del periodo con los datos solicitados
	* @return XML
	**/	
	private function ResumenPeriodo()
	{
		$periodo = explode("-",$this->siiDatos["periodo"]);
		$periodo = array(0 => $periodo[0],1 => $periodo[1]);
		$resumenPeriodo = self::getDTEVentas($periodo);
		$ResumenPeriodo = new XML();
		foreach ($resumenPeriodo as $key => $value) {
			if($value["Tipo"] <> 52){
				$ResumenPeriodo->generate([
					"TotalesPeriodo" => [
						"TpoDoc" => $value["Tipo"],
						"TotDoc" => $value["TotalDTE"],
						"TotAnulado" => ($value["Tipo"] == 35) ? self::TotAnulado($periodo,$value["Tipo"]) : false,
						"TotOpExe" => ($value["Tipo"]== 34) ? $value["TotalDTE"] : false,
						"TotMntExe" => $value["Exento"],
						"TotMntNeto" => ($value["Tipo"] == 34) ? 0 : $value["Neto"],
						"TotMntIVA" => ($value["Tipo"] == 34) ? 0 : $value["Iva"],
						"TotMntTotal" => $value["Total"],
					]
				]);
			}
		}
		if(count($resumenPeriodo) == 0)
		{
			$this->ResumenPeriodo = 0;
		}else{
			// $this->ResumenPeriodo = self::Extrae($ResumenPeriodo->saveXML());
			$this->ResumenPeriodo = "<ResumenPeriodo>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$ResumenPeriodo->saveXML()))."</ResumenPeriodo>";
		}

	}

	private function TotAnulado($periodo,$tipoDCTO)
	{

		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT COUNT(dte_id) as Total FROM sii_dte WHERE dte_estado = 1 AND YEAR(dte_fecha) = ? AND MONTH(dte_fecha) = ? AND dte_dcto_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("iii",$periodo[0],$periodo[1],$tipoDCTO);
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$max += 1;
						foreach ($row as $key => $value)
						{
							$arrayName[$max][$key] = $value;
						}
					}
					if($arrayName[1]["Total"] > 1)
					{
						return $arrayName[1]["Total"];
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
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