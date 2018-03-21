<?php
ini_set("display_errors", 0);
require_once("class.db_connect.php");
require_once("class.token.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/SII_JUNJI/mantenedor/includes/Classes/PHPExcel.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/SII_JUNJI/mantenedor/includes/Classes/PHPExcel/Reader/Excel5.php");

/**
* Clase que permite interactuar con la aceptacion y/o reclamo de DTE recibidos.
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/

class dteWS
{	
	private $client = NULL;
	// 0 : DESARROLLO
	// 1 : PRODUCCIÓN
	private $wsdl_url = array(
		0 => "https://ws2.sii.cl/WSREGISTRORECLAMODTECERT/registroreclamodteservice?wsdl",
		1 => "https://ws1.sii.cl/WSREGISTRORECLAMODTE/registroreclamodteservice?wsdl");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);
	private $cesionErrores = [
	1 => "Rut Emisor Erróneo.",
	2 => "Número de Folio Erróneo.",
	10 => "Documento no emitido y/o recibido en el SII desde el 14 de Enero de 2017 en adelante.",
	18 => "Documento no ha sido recibido.",
	20 => "Tipo de documento no es cedible.",
	21 => "DTE No cedible, referenciado por nota de crédito de anulación del emisor dentro de los primeros 8 días",
	22 => "No existe registro de reclamo o de recepción de mercadería o servicios.",
	23 => "DTE Cedible, sin reclamos",
	24 => "DTE No Cedible, DTE reclamado por el receptor",
	25 => "DTE Cedible, habiendo pasado 8 días se entiende dado acuse de recibo"
	];

	private $Documentos = [
	"Factura No Afecta o Exenta Electrónica" => 34,
	"Factura Electronica" => 33,
	"Nota de Credito Electronica" => 61,
	" Nota de Debito Electronica" => 56
	];
	private $archivo;
	function __construct(){}

	/**
	*
	* Método que permite grabar en la base de datos archivo CSV con los DTE Recibidos en el portal del Servicio de Impuestos Internos
	* @param Array $input Arreglo con los datos provenientes del archivo cargado
	* @return Array Respuesta de la carga
	*
	**/
	public function grabarRecibido($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_dtews VALUES(?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$exito = 0;
			$fracaso = 0;

			$respuesta = $this->leerCSV($input);
			if($respuesta)
			{
				if($stmt)
				{
					foreach ($this->archivo as $key => $value) {
						$Rut = explode("-", $value["RutEmisor"]);
						$stmt->bind_param("issssssssss",$null,$Rut[0],$Rut[1],$value["RazonSocial"],$value["TipoDTE"],$value["Folio"],$value["FechaEmision"],$value["MontoTotal"],$value["FechaRecepcion"],$value["TrackID"],$null);
						if($stmt->execute())
						{
							$exito++;
						}else{
							$fracaso++;
						}

					}
				}

				if($exito > 0)
				{
					return array("Respuesta" => true,"Mensaje" => array("Correctos" => $exito,"Incorrectos" => $fracaso));
				}else{
					return array("Respuesta" => false,"Mensaje" => "Se han encontrado un total de <strong>".$fracaso."</strong> errores.");
				}
			}else{
				return array("Respuesta" => false,"Mensaje" => "El archivo no tiene el formato correcto");
			}
			exit;
				
			
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function leerCSV($input)
	{

		// Cargando la hoja de cálculo
		$objReader = new PHPExcel_Reader_Excel2007();
		$objPHPExcel = $objReader->load($input);
		$objPHPExcel->setActiveSheetIndex(0);
		// OBTENEMOS EL N° DE FILAS DEL EXCEL, INCLUYENDO ENCABEZADO
		$highestRow =  $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		$columnas = [
		1 => "Linea",
		2 => "Rut Emisor",
		3 => "Razon Social",
		4 => "Tipo Dte",
		5 => "Folio Dte",
		6 => "Fecha Emision(DD-MM-AAAA)",
		7 => "Monto Total",
		8 => "Fecha Hora Recepcion(DD-MM-AAAA HH:MM)",
		9 => "TrackId",
		];
		
		$_DATOS_EXCEL[1]['a1'] = $objPHPExcel->getActiveSheet()->getCell('A1')->getCalculatedValue(); // Linea
		$_DATOS_EXCEL[1]['a2'] = $objPHPExcel->getActiveSheet()->getCell('B1')->getCalculatedValue(); // Rut Emisor
		$_DATOS_EXCEL[1]['a3'] = $objPHPExcel->getActiveSheet()->getCell('C1')->getCalculatedValue(); // Razon Social
		$_DATOS_EXCEL[1]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D1')->getCalculatedValue(); // Tipo Dte
		$_DATOS_EXCEL[1]['a5'] = $objPHPExcel->getActiveSheet()->getCell('E1')->getCalculatedValue(); // Folio Dte
		$_DATOS_EXCEL[1]['a6'] = $objPHPExcel->getActiveSheet()->getCell('F1')->getCalculatedValue(); // Fecha Emision(DD-MM-AAAA)
		$_DATOS_EXCEL[1]['a7'] = $objPHPExcel->getActiveSheet()->getCell('G1')->getCalculatedValue(); // Monto Total
		$_DATOS_EXCEL[1]['a8'] = $objPHPExcel->getActiveSheet()->getCell('H1')->getCalculatedValue(); // Fecha Hora Recepcion(DD-MM-AAAA HH:MM)
		$_DATOS_EXCEL[1]['a9'] = $objPHPExcel->getActiveSheet()->getCell('I1')->getCalculatedValue(); // TrackIds

		if(sizeof((array_diff($columnas, $_DATOS_EXCEL[1]))) == 0)
		{
			// RECORREMOS EL EXCEL DESDE LA POSICION 2 (NOS SALTAMOS EL ENCABEZADO)
			for ($i = 2; $i <= $highestRow; $i++) {
		    $_DATOS_EXCEL[$i]['a1'] = $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue(); // Linea
			$_DATOS_EXCEL[$i]['a2'] = $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue(); // Rut Emisor
			$_DATOS_EXCEL[$i]['a3'] = $objPHPExcel-> getActiveSheet()->getCell('C' . $i)->getCalculatedValue(); // Razon Social
			$_DATOS_EXCEL[$i]['a4'] = $objPHPExcel->getActiveSheet()->getCell('D' . $i)->getCalculatedValue(); // Tipo Dte
			$_DATOS_EXCEL[$i]['a5'] = $objPHPExcel-> getActiveSheet()->getCell('E' . $i)->getCalculatedValue(); // Folio Dte
			$_DATOS_EXCEL[$i]['a6'] = $objPHPExcel-> getActiveSheet()->getCell('F' . $i)->getCalculatedValue(); // Fecha Emision(DD-MM-AAAA)
			$_DATOS_EXCEL[$i]['a7'] = $objPHPExcel-> getActiveSheet()->getCell('G' . $i)->getCalculatedValue(); // Monto Total
			$_DATOS_EXCEL[$i]['a8'] = $objPHPExcel-> getActiveSheet()->getCell('H' . $i)->getCalculatedValue(); // Fecha Hora Recepcion(DD-MM-AAAA HH:MM)
			$_DATOS_EXCEL[$i]['a9'] = $objPHPExcel-> getActiveSheet()->getCell('I' . $i)->getCalculatedValue(); // TrackIds
			$datos[] = [
			"Linea" => $objPHPExcel->getActiveSheet()->getCell('A' . $i)->getCalculatedValue(),
			"RutEmisor" => $objPHPExcel->getActiveSheet()->getCell('B' . $i)->getCalculatedValue(),
			"RazonSocial" => $objPHPExcel-> getActiveSheet()->getCell('C' . $i)->getCalculatedValue(),
			"TipoDTE" => $this->Documentos[$objPHPExcel-> getActiveSheet()->getCell('D' . $i)->getCalculatedValue()],
			"Folio" => $objPHPExcel-> getActiveSheet()->getCell('E' . $i)->getCalculatedValue(),
			"FechaEmision" => gmdate("Y-m-d",PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel-> getActiveSheet()->getCell('F' . $i)->getValue())),
			"MontoTotal" => $objPHPExcel-> getActiveSheet()->getCell('G' . $i)->getCalculatedValue(),
			"FechaRecepcion" => gmdate("Y-m-d H:i:s",PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel-> getActiveSheet()->getCell('H' . $i)->getValue())),
			"TrackID" => $objPHPExcel->getActiveSheet()->getCell('I' . $i)->getCalculatedValue(),
			];			
		}
		$this->archivo = $datos;
		return true;
	}else{
		return false;
	}


}

	/**
	*
	* Método que permite consultar en el Servicio de Impuestos Internos mediante WebService si un DTE recibido tiene cesión de crédito o no
	* @param Array $input Contenedor de datos necesarios para realizar la consulta en el S.I.I.
	* @return Array Respuesta obtenida del WebServide del S.I.I. de un DTE en particular
	*
	**/
	public function consultarDocDteCedible($input)
	{
		try {
			$objTOKEN =  new Token($input["emisor_rut"],$input["emisor_dv"]);
			$token = $objTOKEN->getToken();
			$tokenRESP = simplexml_load_string($token);
			if((string)$tokenRESP->GLOSA == "Token Creado")
			{
				try {
					$this->client = $this->getConnection($this->wsdl_url[1]);
					$this->client->__setCookie("TOKEN",(string)$tokenRESP->TOKEN);
					$respuesta = $this->client->consultarDocDteCedible($input["cesion_rut"],$input["cesion_dv"],$input["cesion_tipoDTE"],$input["cesion_folio"]);
					return array("Respuesta" => true,"Mensaje" => $respuesta->descResp);
				} catch (SoapFault $e) {
					return array("Respuesta" => false,"Mensaje" => $e->getMessage());
				}
			}else{
				return array("Respuesta" => false,"Mensaje" => (string)$tokenRESP->GLOSA);
			}
		} catch (Exception $e) {
			print_r($e);
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
	*
	* Función que permite obtener los documentos recibidos en el portal del S.I.I mediante la carga del archivo CSV
	* @param Integer $periodo_annio Año que se desea consultar
	* @param Integer $periodo_mes Mes que se desea consultar
	* @return Array $arrayName Respuesta con los resultados obtenidos
	*
	**/

	public function getDocumentos($periodo_annio,$periodo_mes)
	{
		try {

			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dtews a INNER JOIN sii_dcto b ON a.recibido_tipo = b.dcto_codigo WHERE YEAR(a.recibido_emision) = ? AND MONTH(a.recibido_emision) = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("ii",$periodo_annio,$periodo_mes);
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
	*
	* Método que permite consultar en el Servicio de Impuestos Internos mediante WebService si un DTE recibido tiene cesión de crédito o no
	* @param Array $input Contenedor de datos necesarios para realizar la consulta en el S.I.I.
	* @return Array Respuesta obtenida del WebServide del S.I.I. de un DTE en particular
	*
	**/
	public function listarEventosHistDoc($input)
	{
		try {
			$objTOKEN =  new Token($input["emisor_rut"],$input["emisor_dv"]);
			$token = $objTOKEN->getToken();
			$tokenRESP = simplexml_load_string($token);
			if((string)$tokenRESP->GLOSA == "Token Creado")
			{
				try {
					$this->client = $this->getConnection($this->wsdl_url[1]);
					$this->client->__setCookie("TOKEN",(string)$tokenRESP->TOKEN);
					$respuesta = $this->client->listarEventosHistDoc($input["cesion_rut"],$input["cesion_dv"],$input["cesion_tipoDTE"],$input["cesion_folio"]);
					return array("Respuesta" => true,"Mensaje" => $respuesta->descResp);
				} catch (SoapFault $e) {
					return array("Respuesta" => false,"Mensaje" => $e->getMessage());
				}
			}else{
				return array("Respuesta" => false,"Mensaje" => (string)$tokenRESP->GLOSA);
			}
		} catch (Exception $e) {
			return array("Respuesta" => false,"Mensaje" => $e->getMessage());
		}
	}

	public function getDetalleDocumento($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dtews a INNER JOIN sii_dcto b ON b.dcto_codigo = a.recibido_tipo WHERE recibido_id = ?";
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


	public function getHistorial($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dtews a INNER JOIN sii_historial_dtews b ON b.histo_recibido_id = a.recibido_id INNER JOIN sii_dcto c ON c.dcto_codigo = a.recibido_tipo WHERE a.recibido_id = ?";
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

	public function ingresarAceptacionReclamoDoc($input)
	{
		try {
			$objTOKEN =  new Token($input["emisor_rut"],$input["emisor_dv"]);
			$token = $objTOKEN->getToken();
			$tokenRESP = simplexml_load_string($token);
			if((string)$tokenRESP->GLOSA == "Token Creado")
			{
				try {
					$this->client = $this->getConnection($this->wsdl_url[0]);
					$this->client->__setCookie("TOKEN",(string)$tokenRESP->TOKEN);
					$respuesta = $this->client->ingresarAceptacionReclamoDoc($input["proveedor_rut"],$input["proveedor_dv"],$input["proveedor_tipo"],$input["proveedor_folio"],$input["recibido_accion"]);
					$this->ingresaHistorial($input["proveedor_id"],$input["recibido_accion"]);
					return array("Respuesta" => true,"Mensaje" => $respuesta->descResp);
				} catch (SoapFault $e) {
					return array("Respuesta" => false,"Mensaje" => $e->getMessage());
				}
			}else{
				return array("Respuesta" => false,"Mensaje" => (string)$tokenRESP->GLOSA);
			}
		} catch (Exception $e) {
			return array("Respuesta" => false,"Mensaje" => $e->getMessage());
		}
	}


	private function ingresaHistorial($recibido_id,$accion)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_historial_dtews VALUES(?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$hoy = date("Y-m-d");
			$hora = date("H:i:s");
			if($stmt)
			{

				$stmt->bind_param("iisss",$null,$recibido_id,$hoy,$hora,$accion);

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