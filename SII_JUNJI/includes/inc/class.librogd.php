<?php
error_reporting(E_ALL);
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
/**
* 
*/
class LibroGD
{
	private $_siiDatos;
	private $_Caratula;
	private $_Detalle;
	private $_ResumenPeriodo;
	private $_Traslados;
	private $_TmstFirma;

	private $client = NULL;
	private $wsdl_url = array(0 => "https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL",1 => "https://palena.sii.cl/DTEWS/GetTokenFromSeed.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);
	private $hoy;

	function __construct(){
		$this->_TmstFirma = date('Y-m-d\TH:i:s');
		$this->hoy = date("Y-m-d");
	}

	public function getGDPeriodo($input,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT dte_dcto_id as Tipo,COUNT(dte_id) as TotalDTE,SUM(dte_iva) as Iva,SUM(dte_neto) as Neto,SUM(dte_exento) as Exento FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ".$input[0]." AND MONTH(dte_fecha) = ".$input[1]." AND dte_region = ".$region;
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


	public function getDetalle($periodo,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			// $query = "SELECT * FROM sii_dte a INNER JOIN sii_cliente b on b.cliente_id = a.dte_cliente_id WHERE a.dte_dcto_id = 52 AND YEAR(a.dte_fecha) = ".$periodo[0]." AND MONTH(a.dte_fecha) = ".$periodo[1]." AND a.dte_region = ".$region;
			$query = "SELECT * FROM sii_dte a INNER JOIN sii_empresa b on b.empresa_id = a.dte_cliente_id WHERE a.dte_dcto_id = 52 AND YEAR(a.dte_fecha) = ? AND MONTH(a.dte_fecha) = ? AND a.dte_region = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("iii",$periodo[0],$periodo[1],$region);
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

	public function getAnulados($periodo,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT count(dte_gd_estado) as Total, dte_gd_estado as Tipo FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ? AND MONTH(dte_fecha) = ? AND dte_gd_estado <> '' AND dte_region = ? GROUP BY dte_gd_estado";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("iii",$periodo[0],$periodo[1],$region);
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

	public function getTraslados($periodo,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT count(dte_gd_traslado) as Total, dte_gd_traslado as Tipo, SUM(dte_total) as Monto FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ? AND MONTH(dte_fecha) = ? AND (dte_gd_traslado = 2 OR dte_gd_traslado = 3 OR dte_gd_traslado = 4 OR dte_gd_traslado = 5 OR dte_gd_traslado = 6 OR dte_gd_traslado = 7) AND dte_region = ? GROUP BY dte_gd_traslado";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				$stmt->bind_param("iii",$periodo[0],$periodo[1],$region);
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

	public function generarXML($input)
	{
		$this->_siiDatos = $input;

		$carpeta = explode("-", $this->_siiDatos["periodo"]);
		self::verificaCarpeta("LibroGD",$carpeta[0]);
		self::generarCaratula();
		self::generaResumenPeriodo();
		self::generaDetalle();
		return self::envioDTE();
	}

	private function verificaCarpeta($tipoDCTO,$year)
	{
		try {
			$ruta = "../Documentos/".$tipoDCTO."/".$year;
			mkdir($ruta,0777,true);		
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function envioDTE()
	{
		$id = "EnvioLibro_".$this->_siiDatos["periodo"];
		$carpeta = explode("-", $this->_siiDatos["periodo"]);
		
		$Caratula = new XML();
		$Caratula->loadXML($this->_Caratula);

		$ResumenPeriodo = new XML();
		$ResumenPeriodo->loadXML($this->_ResumenPeriodo);

		$Detalle = new XML();
		$Detalle->loadXML($this->_Detalle);
		$elem = new SimpleXMLElement($Detalle->saveXML());
		$periodo = explode("-", $this->_siiDatos["periodo"]);
		$ruta = "../Documentos/LibroGD/".$periodo[0];
		// $archivo = "LIBROGD_".$this->_siiDatos["periodo"].".xml";
		$archivo = $id.".xml";
		$destino = $ruta."/".$archivo;

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->_siiDatos["emisor_region"]);

// echo $Detalle->saveXML();
		/*$envioDTE='<?xml version="1.0" encoding="ISO-8859-1"?>';
		$envioDTE='<LibroGuia xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte LibroGuia_v10.xsd" version="1.0">';
		$envioDTE.='<EnvioLibro ID="'.$id.'">';
		$envioDTE.=$this->_Caratula;
		$envioDTE.=$this->_ResumenPeriodo;
		$envioDTE.=$this->_Detalle;
		$envioDTE.= '<TmstFirma>'.$this->_TmstFirma.'</TmstFirma>';
		$envioDTE.='</EnvioLibro>';
		$envioDTE.='</LibroGuia>';
		*/

		$EnvioDTE = new XML();
		$EnvioDTE->generate([
			'LibroGuia' => [
			'@attributes' => [
			'xmlns' => 'http://www.sii.cl/SiiDte',
			'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
			'xsi:schemaLocation' => 'http://www.sii.cl/SiiDte LibroGuia_v10.xsd',
			'version' => '1.0',
			],
			'EnvioLibro' => [
			'@attributes' => [
			'ID' => $id,
			],
			'Caratula' => $Caratula->getElementsByTagName("Caratula")->item(0),
			'ResumenPeriodo' => $ResumenPeriodo->getElementsByTagName("ResumenPeriodo")->item(0),
			'Detalle' => ($elem->count() <> 0) ? $Detalle->getElementsByTagName("DATA")->item(0) : false,
			'TmstFirma' => $this->_TmstFirma,
			],
			]
			]);

		$arr = array("<DATA>","</DATA>");
		$envioDTE = trim(str_replace($arr,"",$EnvioDTE->saveXML()));

		$objFirma = new FirmaElectronica($this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"]);
		$objValidate = new Validate();
		$esValido = $objFirma->validaUsuario($this->siiDatos["emisor_region"],"libro_guia",$this->_siiDatos["emisor_rut"]);
		if(!$esValido[1]["esValido"])
		{
			echo json_encode(array("Respuesta" => false,"Mensaje" => "Usuario no autorizado a firmar el DTE solicitado"));
			exit;
		}

		$xml = $objFirma->firmarXML($envioDTE,"#".$id,"EnvioLibro",true);

		$Schema = $objValidate->validateSCHEMA("LibroGD",$xml);
		$Firma = $objValidate->validateSCHEMA("LibroGD",$xml);

		// $fp = fopen("../Documentos/LibroGD/".$carpeta[0]."/".$id.".xml", "w+");
		// fwrite($fp, $xml);
		// fclose($fp);
		$this->token = trim($this->getToken());

		if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Error en SCHEMA : ".$Schema);}
		if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma);}
		if($Schema == "" && $Firma == "")
		{
			$fp = fopen($destino, "w+");
			fwrite($fp, $xml);
			fclose($fp);
			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" => "El servicio no está disponible.");
			}else{

				$token = new SimpleXMLElement($this->token);
				if(trim($token->GLOSA == "Token Creado"))
				{	

					$objDTE = new DTE($destino,$token->TOKEN,$this->_siiDatos["emisor_rut"],$this->_siiDatos["emisor_dv"],$empresa[1]["empresa_rut"],$empresa[1]["empresa_dv"],"IECV");
					$res = $objDTE->enviarIECV();

					if($res->STATUS == 0)
					{
						$this->guardaHistorial($this->_siiDatos,$ruta,$archivo,$res->STATUS,$res->TRACKID);	
						return array("Respuesta" => true,"Mensaje" => "Libro generado y enviado exitosamente!");
					}else{
						return array("Respuesta" => false,"Mensaje" => $res->DETAIL->ERROR);
					}
				}else{
					return array("Respuesta" => false,"Mensaje" => trim($token->GLOSA));
				}

			}
			//INSERTAR DATOS EN LA TABLA SII_IECV_HISTORIAL
			// $this->guardaHistorial($this->_siiDatos,$ruta,$archivo,$res->STATUS,$res->TRACKID);
			// return array("Respuesta" => true,"Mensaje" => "Exito!");
		}else{
			return array("Respuesta" => false,"Mensaje" => "Error!");
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
			$query = "INSERT INTO sii_iecv_historial VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$hoy = date("Y-m-d");
			$hora = date("H:i:s");
			$periodo_tipo_operacion = "LIBROGD";
			
			if($stmt)
			{
				$stmt->bind_param("issssissssissss",
					$null,
					$datos["periodo"],
					$periodo_tipo_operacion,
					$datos["periodo_tipo_envio"],
					$datos["periodo_tipo_libro"],
					$estado,
					$trackid,
					$ruta,
					$archivo,
					$null,
					$datos["emisor_region"],
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

	public function generarCaratula()
	{
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->_siiDatos["emisor_region"]);

		$Caratula = new XML();
		$Caratula->generate([
			"Caratula" => [
			"RutEmisorLibro" => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			"RutEnvia" => $this->_siiDatos["envia_rut"],
			"PeriodoTributario" => $this->_siiDatos["periodo"],
			"FchResol" => $datosEmpresa[1]["empresa_fecha"],
			"NroResol" => $datosEmpresa[1]["empresa_resolucion"],
			"TipoLibro" => $this->_siiDatos["periodo_tipo_libro"],
			"TipoEnvio" => $this->_siiDatos["periodo_tipo_envio"],
			"FolioNotificacion" => ($this->_siiDatos["periodo_tipo_libro"] == "ESPECIAL") ? str_replace("-", "", $this->_siiDatos["periodo"]) : false
			]
			]);
		$this->_Caratula = self::Extrae($Caratula->saveXML());
	}

	public function getGuiaAnulado($input,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			// $query = "SELECT count(dte_gd_estado) as Total, dte_gd_estado as Tipo FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ".$periodo[0]." AND MONTH(dte_fecha) = ".$periodo[1]." AND dte_gd_estado <> '' GROUP BY dte_gd_estado";
			$query = "SELECT count(dte_id) as Total FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ".$input[0]." AND MONTH(dte_fecha) = ".$input[1]." AND dte_gd_estado = 2 AND dte_region = ".$region;
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

	public function getFolioAnulado($input,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT count(dte_id) as Total FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ".$input[0]." AND MONTH(dte_fecha) = ".$input[1]." AND dte_gd_estado = 1 AND dte_region = ".$region;
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

	public function getVentas($input,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT count(dte_id) as Total, SUM(dte_total) as Monto FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ".$input[0]." AND MONTH(dte_fecha) = ".$input[1]." AND dte_gd_traslado = 1 AND dte_gd_estado IS NULL AND dte_region = ".$region;
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


	public function generaResumenPeriodo()
	{
		$ResumenPeriodo = new XML();
		$periodo = explode("-", $this->_siiDatos["periodo"]);
		$periodo = array(0 => $periodo[0],1 => $periodo[1]);
		$g_anulados = self::getGuiaAnulado($periodo,$this->_siiDatos["emisor_region"]);
		$f_anulados = self::getFolioAnulado($periodo,$this->_siiDatos["emisor_region"]);
		$g_venta = self::getVentas($periodo,$this->_siiDatos["emisor_region"]);
		$resumenPeriodo = self::getGDPeriodo($periodo,$this->_siiDatos["emisor_region"]);

		self::setTraslados($periodo,$this->_siiDatos["emisor_region"]);
		$Traslados = new XML();
		$Traslados->loadXML($this->_Traslados);

		$elem = new SimpleXMLElement($Traslados->saveXML());
		$ResumenPeriodo->generate([
			"ResumenPeriodo" => [
			"TotFolAnulado" => ($f_anulados[1]["Total"] <> 0) ? $f_anulados[1]["Total"] : false,
			"TotGuiaAnulada" => ($g_anulados[1]["Total"] <> 0) ? $g_anulados[1]["Total"] : false,
			"TotGuiaVenta" => $g_venta[1]["Total"],
			"TotMntGuiaVta" => ($g_venta[1]["Monto"] <> "") ? $g_venta[1]["Monto"] : 0,
			"TotMntModificado" => 0,
			"TotTraslado" => (count($elem->TotTraslado) <> 0) ? $Traslados->getElementsByTagName("DATA")->item(0) : false,
			]
			]);
		echo $ResumenPeriodo->saveXML();
		exit;
		$this->_ResumenPeriodo = self::Extrae($ResumenPeriodo->saveXML());

	}

	public function generaDetalle()
	{
		$periodo = explode("-", $this->_siiDatos["periodo"]);
		$periodo = array(0 => $periodo[0],1 => $periodo[1]);

		$Detalle = new XML();
		$detalle = self::getDetalle($periodo,$this->_siiDatos["emisor_region"]);
		foreach ($detalle as $key => $value) {
			$referencia = self::getReferencia($value["dte_id"]);
			$Detalle->generate([
				"Detalle" => [
				"Folio" => $value["dte_folio"],
				"Anulado" => ($value["dte_gd_estado"] == 2) ? 2 : false,
				"TpoOper" => $value["dte_gd_traslado"],
				"FchDoc" => $value["dte_fecha"],
				"RUTDoc" => $value["empresa_rut"]."-".$value["empresa_dv"],
				"RznSoc" => utf8_encode(substr($value["empresa_glosa"],0,50)),
				"MntNeto" => $value["dte_neto"],
				"TasaImp" => 19,
				"IVA" => $value["dte_iva"],
				"MntTotal" => $value["dte_total"],
				"TpoDocRef" => (count($referencia) <> "") ? $referencia[1]["dte_dcto_id"] : false,
				"FolioDocRef" => (count($referencia) <> "") ? $referencia[1]["dte_folio"] : false,
				"FchDocRef" => (count($referencia) <> "") ? $referencia[1]["dte_fecha"] : false,
				]
				]);
		}
		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$Detalle->saveXML()))."</DATA>";
		$this->_Detalle = $xml;
	}

	public function getReferencia($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_referencia a INNER JOIN sii_dte b ON a.referencia_id = b.dte_id WHERE a.referencia_dte_id = ".$input;
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$input);
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
	public function setTraslados($input,$region)
	{
		$traslados = self::getTraslados($input,$region);
		$Traslados = new XML();
		foreach ($traslados as $key => $value) {
			$Traslados->generate([
				"TotTraslado" => [
				"TpoTraslado" => $value["Tipo"],
				"CantGuia" => $value["Total"],
				"MntGuia" => $value["Monto"],
				]
				]);
		}
		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$Traslados->saveXML()))."</DATA>";
		$this->_Traslados = $xml;
	}

	/**
	* Método que permite obtener el historial de los libros de guias generados y enviados en un periodo en particular
	* @param Integer $input Periodo a consultar
	* @return Array $arrayNanme Resultado de la busqueda
	**/
	public function getHistorial($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$like = $input."%";
			$query = "SELECT * FROM sii_iecv_historial WHERE iecv_tipo_operacion = 'LIBROGD' and iecv_periodo LIKE '$like'";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("s",$input);
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

	public function getDetalleEnvio($input,$region)
	{
		try {
					$objDbConnect = new db_connect();
					$arrayName = array();
					$max = 0;
					$query = "SELECT COUNT(dte_gd_traslado) AS Total, dte_gd_traslado AS Tipo FROM sii_dte WHERE dte_dcto_id = 52 AND YEAR(dte_fecha) = ? AND MONTH(dte_fecha) = ? AND dte_gd_traslado <> '' AND dte_region = ? GROUP BY dte_gd_traslado";
					$stmt = $objDbConnect->getConnection()->prepare($query);
					if($stmt)
					{
						$stmt->bind_param("iii",$input[0],$input[1],$region);
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


}
?>