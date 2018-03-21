<?php
ini_set("max_execution_time", 300);
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
require_once("class.dte.php");
require_once("class.recibo.php");

/**
 * Clase que permite trabajar con la Informacion Electronica de Compra y Venta
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class IECVCompra
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
	* Método inserta una compra en la tabla sii_iecv
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param $input Contiene la informacion del formulario
	**/
	public static function crearIECVCompra($input)
	{
		try {
			$tipoDCTO = explode("-", $input["iecv_tipo_dcto"]);
			$numerocamposenblanco = 0;
			$initivanorec = 0;
			$ivausocomun = 'NULL';
			$initivanoreccodigo = 'NULL';
			$initotrosimp = 0;
			$initotrosimpcodigo = 'NULL';
			$initotrosimptasa = 'NULL';
			$initotrosimpmonto = 'NULL';
			$ivanorecmonto = 'NULL';
		    //AQUI VALIDAMOS LOS CAMPOS REQUERIDOS Y LOS QUE PUEDEN SER NULL
			foreach ($input as $key => $value) {
				if(trim($value) == "" and $key != "iecv_iva_norec" and $key != "iecv_iva_norec_cod" and $key != "iecv_iva_usocomun" and $key != "iecv_otros_imp_tasa" and $key != "iecv_otros_imp_monto"
					and $key != "iecv_iva_norec_monto" and $key != "iecv_iva_usocomun"
					and $key != "iecv_otros_imp" and $key != ""){
					$numerocamposenblanco++;
			}
		}
		// if($numerocamposenblanco > 0)return array("Respuesta" => false,"id" => $stmt->insert_id,"Mensaje" => "Lo sentimos existen ".$numerocamposenblanco." campo requeridos vacíos, favor revisar");
		if($input["iecv_iva_usocomun"] != "")$ivausocomun = $input["iecv_iva_usocomun"];
		if($input['iecv_iva_norec_monto'] != "")$ivanorecmonto = $input['iecv_iva_norec_monto'];
            //AQUÍ VERIFICAMOS SI VIENE EL CAMPO IVA NOREC, SI VIENE SETIAMOS DOS CAMPOS EL IECV_IVA_NOREC EN 1 (BOOL), Y EL CODIGO DEL IVA NOREC LO SRTIAMOS EN IECV_IVA_NOREC_CODIGO
		if($input['iecv_iva_norec'] != "0"){
			$initivanoreccodigo = $input['iecv_iva_norec'];
			$initivanorec = 1;
		}
		if($input['iecv_otros_imp'] != ""){
			if($input['iecv_otros_imp_tasa'] != "")$initotrosimptasa = $input['iecv_otros_imp_tasa'];
			if($input['iecv_otros_imp_monto'] != "")$initotrosimpmonto = $input['iecv_otros_imp_monto'];
			$initotrosimpcodigo = $input['iecv_otros_imp'];
			$initotrosimp = 1;
		}


		$rutsinpuntos = str_replace(".","",$input["iecv_rut"]);
		$objDbConnect = new db_connect();
		$query = 'INSERT INTO sii_iecv (iecv_tipo_dcto, iecv_folio, iecv_rut, iecv_dv, iecv_cliente, iecv_iva, iecv_neto, iecv_total, iecv_exento, iecv_femision, iecv_region,iecv_iva_norec,iecv_iva_norec_cod,iecv_iva_usocomun,iecv_iva_norec_monto,iecv_otros_imp,iecv_otros_imp_cod,iecv_otros_imp_tasa,iecv_otros_imp_monto) VALUES ('.$tipoDCTO[1].','.$input["iecv_folio"].','.$rutsinpuntos.', "'.$input["iecv_dv"].'", "'.$input["iecv_cliente"].'", '.$input["iecv_iva"].','.$input["iecv_neto"].','.$input["iecv_total"].','.$input["iecv_exento"].', "'.$input["iecv_fecha"].'", '.$input["emisor_region"].','.$initivanorec.','.$initivanoreccodigo.','.$ivausocomun.','.$ivanorecmonto.','.$initotrosimp.','.$initotrosimpcodigo.','.$initotrosimptasa.','.$initotrosimpmonto.')';
		$stmt = $objDbConnect->getConnection()->prepare($query);

		if($stmt)
		{
			if($stmt->execute())
			{
				return array("Respuesta" => true,"Mensaje" => "Insertado correctamente con el id:".$stmt->insert_id);
			}else{
				return $stmt->error;
			}
		}else{
			return array("Respuesta" => false,"Mensaje" => "Lo sentimos ocurrio un error al intentar establecer conexión con la base de datos");
		}
	}catch (Exception $e) {
		return $e->getMessage();
	}
}



	/**
	* Funcion que permite obtener el detalle de los documentos recibidos filtrados por un periodo dado
	* @return Array
	* @param Array con el periodo
	**/	
	public function getIECVPeriodo($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_iecv a INNER JOIN sii_dcto_ref b ON b.ref_codigo = a.iecv_tipo_dcto WHERE YEAR(iecv_femision) = ".$input[0]." AND MONTH(iecv_femision) = ".$input[1];
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
	* Funcion que permite obtener el listado de todos los documentos recibidos segun periodo solicitado
	* @return Array
	* @param Array con el periodo
	**/	
	public function detallePeriodo($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_iecv WHERE YEAR(iecv_femision) = ? AND MONTH(iecv_femision) = ? AND iecv_folio <> 0 ORDER BY iecv_tipo_dcto ASC";
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
	* Funcion que permite todos los DTE de compras segun periodo dado
	* @return Array
	* @param Array con el periodo
	**/	
	public function getDTECompras($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			// $query = "SELECT iecv_tipo_dcto as Tipo, COUNT(iecv_id) as TotalDTE, SUM(iecv_iva) AS Iva, SUM(iecv_neto) AS Neto, SUM(iecv_iva + iecv_neto + iecv_exento + iecv_iva_usocomun) AS Total, SUM(iecv_exento) AS Exento, SUM(iecv_iva_norec_monto) AS NoReconocido, SUM(iecv_otros_imp_monto) AS OtrosImpuestos, SUM(iecv_iva_usocomun) as UsoComun FROM sii_iecv WHERE YEAR(iecv_femision) = ".$input[0]." AND MONTH(iecv_femision) = ".$input[1]." GROUP BY iecv_tipo_dcto";
			$query = "SELECT iecv_tipo_dcto as Tipo, COUNT(iecv_id) as TotalDTE, SUM(iecv_iva) AS Iva, SUM(iecv_neto) AS Neto, SUM(iecv_total) AS Total, SUM(iecv_exento) AS Exento, SUM(iecv_iva_norec_monto) AS NoReconocido, SUM(iecv_otros_imp_monto) AS OtrosImpuestos, SUM(iecv_iva_usocomun) as UsoComun FROM sii_iecv WHERE YEAR(iecv_femision) = ".$input[0]." AND MONTH(iecv_femision) = ".$input[1]." GROUP BY iecv_tipo_dcto";
			// echo $query;
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
	private function EnvioDTE($incluirDetalle = true)
	{
		$id = "LibroCompra".str_replace("-","",$this->siiDatos["periodo"]);
		$periodo = explode("-",$this->siiDatos["periodo"]);
		$objFirma = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
		$ruta = "../../sistemas/archivos/SII/Documentos/IECV/".$periodo[0];
		$archivo = "COMPRA_".$this->siiDatos["periodo"].".xml";
		$destino = $ruta."/".$archivo;

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);

		$xml = new XML();
		$xml->load($this->ResumenPeriodo);
		$EnvioDTE  = '<?xml version="1.0" encoding="ISO-8859-1"?>';
		$EnvioDTE .= '<LibroCompraVenta xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte LibroCV_v10.xsd" version="1.0">';
		$EnvioDTE .= ' <EnvioLibro ID="'.$id.'">';
		$EnvioDTE .= $this->Caratula;
		if($this->ResumenPeriodo <> "")
		{
			$EnvioDTE .= '<ResumenPeriodo>';
			$EnvioDTE .= $this->ResumenPeriodo;
			$EnvioDTE .= '</ResumenPeriodo>';
		}
		if($incluirDetalle)
		{
			$EnvioDTE .= $this->DetallePeriodo;
		}
		$EnvioDTE .= '<TmstFirma>'.$this->timestamp.'</TmstFirma>';
		$EnvioDTE .= '</EnvioLibro>';
		$EnvioDTE .= '</LibroCompraVenta>';


		$resp = self::verificaCarpeta("IECV",$periodo[0],$periodo[1]);

		$esValido = $objFirma->validaUsuario($this->siiDatos["emisor_region"],"libro_compra",$this->siiDatos["emisor_rut"]);
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
							return array("Respuesta" => true, "Mensaje" => "Libro generado y enviado exitosamente!");
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
			$query = "INSERT INTO sii_iecv_historial VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE iecv_femision = '".$this->hoy."', iecv_hora = '".$hora."',iecv_track_id = '".$trackid."' ";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("issssissssissss",$null,$datos["periodo"],$datos["periodo_tipo_operacion"],$datos["periodo_tipo_envio"],$datos["periodo_tipo_libro"],$estado,$trackid,$ruta,$archivo,$datos["CodAutRec"],$datos["emisor_region"],$this->hoy,$hora,$null,$null);
				
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
			$DetallePeriodo->generate([
				"Detalle" => [
				"TpoDoc" => $value["iecv_tipo_dcto"],
				"NroDoc" => $value["iecv_folio"],
				"TasaImp" => 0.19,
				"FchDoc" => $value["iecv_femision"],
				"RUTDoc" => $value["iecv_rut"]."-".$value["iecv_dv"],
				"RznSoc" => substr(utf8_encode($value["iecv_cliente"]),0,50),
				"MntExe" => $value["iecv_exento"],
				"MntNeto" => $value["iecv_neto"],
				"MntIVA" => ($value["iecv_iva_norec"] == 1 || $value["iecv_otros_imp"] == 1 && $value["iecv_tipo_dcto"] <> 46/* || $value["iecv_factor"] <> ""*/)  ? false : $value["iecv_iva"],
				// "IVAUsoComun" => ($value["iecv_factor"] <> "") ? floor($value["iecv_neto"]*0.19) : false,
				"IVAUsoComun" => ($value["iecv_factor"] <> "") ? $value["iecv_iva_usocomun"] : false,
				"IVANoRec" => ($value["iecv_iva_norec"] == 1) ? $this->getNoReconocido2($this->siiDatos["periodo"])->getElementsByTagName("IVANoRec")->item(0) : false,
				"OtrosImp" => ($value["iecv_otros_imp"] == 1) ?  $this->getOtrosImpuestos2($this->siiDatos["periodo"])->getElementsByTagName("OtrosImp")->item(0) : false,
				// "MntTotal" => ($value["iecv_tipo_dcto"] <> 46) ? ($value["iecv_neto"]+round($value["iecv_neto"]*0.19) + $value["iecv_exento"]) : $value["iecv_neto"],
				"MntTotal" => ($value["iecv_tipo_dcto"] <> 46) ? ($value["iecv_neto"]+ $value["iecv_iva"] + $value["iecv_iva_usocomun"] + $value["iecv_exento"] + $value["iecv_iva_norec_monto"]) : $value["iecv_neto"],
				]
				]);
		}
		$this->DetallePeriodo = self::Extrae($DetallePeriodo->saveXML());
	}

	/**
	* Método que permite generar la Carátula del documento segun el esquema
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/	
	private function GeneraCaratula()
	{
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
			"FolioNotificacion" => ($this->siiDatos["periodo_tipo_libro"] == "ESPECIAL") ? /*str_replace("-", "", $this->siiDatos["periodo"])*/ 2 : false,
			"CodAutRec" => ($this->siiDatos["periodo_tipo_libro"] == "RECTIFICA") ? $this->siiDatos["CodAutRec"] : false,
			]
			]);
		$this->Caratula = self::Extrae($Caratula->saveXML());
	}

	/**
	* Método que permite obtener los tipos de Impuestos o Recargos
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/	
	private function getOtrosImpuestos2($input)
	{
		try {
			$input = explode("-", $input);
			$NoReconocido = new XML();
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_iecv WHERE YEAR(iecv_femision) = ".$input[0]." AND MONTH(iecv_femision) = ".$input[1]." AND iecv_otros_imp = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$NoReconocido->generate([
							"OtrosImp" => [
							"CodImp" => $row["iecv_otros_imp_cod"],
							"TasaImp" => 19,
							"MntImp" => round($row["iecv_otros_imp_monto"] * 0.19)
							]
							]);
					}
					$xml = new XML();
					$xml->loadXML($NoReconocido->saveXML());
					return $xml;

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
	* Funcion que permite obtener los tipos de impuestos o recargos
	* @return XML
	**/
	private function getOtrosImpuestos($input)
	{
		try {
			$input = explode("-", $input);
			$NoReconocido = new XML();
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_iecv WHERE YEAR(iecv_femision) = ".$input[0]." AND MONTH(iecv_femision) = ".$input[1]." AND iecv_otros_imp = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$NoReconocido->generate([
							"TotOtrosImp" => [
							"CodImp" => $row["iecv_otros_imp_cod"],
							"TotMntImp" => round($row["iecv_otros_imp_monto"] * 0.19)
							]
							]);
					}
					$xml = new XML();
					$xml->loadXML($NoReconocido->saveXML());
					return $xml;

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
	* Funcion que permite obtener el IVA no recuperable de cada documento
	* @return XML
	**/
	private function getNoReconocido2($input)
	{
		try {
			$input = explode("-", $input);
			$NoReconocido = new XML();
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_iecv WHERE YEAR(iecv_femision) = ".$input[0]." AND MONTH(iecv_femision) = ".$input[1]." AND iecv_iva_norec = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$NoReconocido->generate([
							"IVANoRec" => [
							"CodIVANoRec" => $row["iecv_iva_norec_cod"],
							"MntIVANoRec" => $row["iecv_iva_norec_monto"]
							]
							]);
					}
					$xml = new XML();
					$xml->loadXML($NoReconocido->saveXML());
					return $xml;

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
	* Funcion que permite obtener el total de IVA no recuperable
	* @return XML
	**/
	private function getNoReconocido($input,$tipo)
	{
		try {
			$input = explode("-", $input);
			$NoReconocido = new XML();
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_iecv WHERE YEAR(iecv_femision) = ".$input[0]." AND MONTH(iecv_femision) = ".$input[1]." AND iecv_iva_norec = 1 AND iecv_tipo_dcto = ".$tipo;
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$NoReconocido->generate([
							"TotIVANoRec" => [
							"CodIVANoRec" => $row["iecv_iva_norec_cod"],
							"TotOpIVANoRec" => 1,
							"TotMntIVANoRec" =>$row["iecv_iva_norec_monto"]
							]
							]);
					}
					$xml = new XML();
					$xml->loadXML($NoReconocido->saveXML());
					return $xml;

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
	* Funcion que permite generar el resumen del periodo con los datos solicitados
	* @return XML
	**/	
	private function ResumenPeriodo()
	{
		$periodo = explode("-",$this->siiDatos["periodo"]);
		$periodo = array(0 => $periodo[0],1 => $periodo[1]);
		$resumenPeriodo = self::getDTECompras($periodo);
		$ResumenPeriodo = new XML();
		foreach ($resumenPeriodo as $key => $value) {

			if($value["UsoComun"] <> "")
			{
				$iva = round($value["Neto"] * 0.19) - $value["UsoComun"];
			}else{
				$iva = $value["Iva"];
			}
			$ResumenPeriodo->generate([
				"TotalesPeriodo" => [
				"TpoDoc" => $value["Tipo"],
				"TotDoc" => $value["TotalDTE"],
				"TotMntExe" => $value["Exento"],
				"TotMntNeto" => $value["Neto"],
				"TotMntIVA" => ($value["UsoComun"] <> "") ? $iva : $value["Iva"],
				"TotIVAUsoComun" => ($value["UsoComun"] <> "") ? $value["UsoComun"] : false,
				"FctProp" => ($value["UsoComun"] <> "") ? 0.6 : false,
				"TotCredIVAUsoComun" => ($value["UsoComun"] <> "") ? round($value["UsoComun"] * 0.6) : false,
				"TotIVANoRec" => ($value["NoReconocido"] == "") ? false : ($this->getNoReconocido($this->siiDatos["periodo"],$value["Tipo"])->getElementsByTagName("TotIVANoRec")->item(0)),
				"TotOtrosImp" => ($value["OtrosImpuestos"] == "") ? false : ($this->getOtrosImpuestos($this->siiDatos["periodo"])->getElementsByTagName("TotOtrosImp")->item(0)),
				"TotMntTotal" => ($value["Tipo"] == 46) ? $value["Neto"] : $value["Neto"] + $iva + $value["Exento"] + $value["NoReconocido"] + $value["UsoComun"],
				]
				]);
		}
		if(count($resumenPeriodo) == 0)
		{
			$this->ResumenPeriodo = 0;
		}else{
			$this->ResumenPeriodo = self::Extrae($ResumenPeriodo->saveXML());
		}

	}

/**
* Método que obtiene el historial de libros enviados hasta la fecha
* @param $input Region de la consulta
* @return $arrayName Resultado de la operacion
**/
public function getHistorial($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_iecv_historial WHERE iecv_region = ? AND iecv_tipo_operacion = 'COMPRA' order by iecv_periodo DESC";
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

/*
			[recibido_id] => 1
            [recibido_tipo_dcto] => 33
            [recibido_folio] => 52543
            [recibido_rut] => 88888888
            [recibido_dv] => 8
            [recibido_ruta] => Documentos/recibidos/33/2016/12
            [recibido_archivo] => ENVIO_DTE_734384.xml
            [recibido_acuse_1] => 0
            [recibido_acuse_2] => 0
            [recibido_acuse_3] => 
            [recibido_estado] => 1
            [recibido_cliente] => EMPRESA DE PRUEBA
            [recibido_neto] => 12885
            [recibido_iva] => 2448
            [recibido_monto] => 15333
            [recibido_exento] => 0
            [recibido_femision] => 2016-12-09
            [recibido_trackid] => 
            [recibido_foliointerno] => 1
            [recibido_digest] => 3F+KyBCs7Yby97GS8uRW4M8e2tc=
            [recibido_rut2] => 76535898
            [recibido_dv2] => 1
            [recibido_dteid] => T33
            [recibido_emisor_rut] => 88888888
            [recibido_emisor_dv] => 8
            [recibido_region] => 14
*/

	/**
	* Método que ingresa informacion al libro de compra a partir de un xml recibido previa aceptacion comercial
	* @param Array $input  Informacion del XML
	* @return Array Resultado de la operación
	**/
	public function ingresaCompraXML($input,$region)
	{
		try {
			$objRecibo = new Recibo();
			$detalle = $objRecibo->getDetalleArchivo($input);

			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_iecv VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{

				$stmt->bind_param("iiiissiiiisiiiiiiiiii",
					$null,
					$detalle[1]["recibido_tipo_dcto"],
					$detalle[1]["recibido_folio"],
					$detalle[1]["recibido_rut"],
					$detalle[1]["recibido_dv"],
					$detalle[1]["recibido_cliente"],
					$detalle[1]["recibido_iva"],
					$detalle[1]["recibido_neto"],
					$detalle[1]["recibido_monto"],
					$detalle[1]["recibido_exento"],
					$detalle[1]["recibido_femision"],
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$region		
					);

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

}
?>