<?php
ini_set("display_errors", 0);
require_once("class.token.php");
require_once("class.db_connect.php");

/**
 * Clase para consultar al S.I.I mediante WebService el estado de un DTE en particular
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Consulta
{
	private $token = NULL;
	private $client = NULL;
	private $wsdl_url = array(
		0 => "https://palena.sii.cl/DTEWS/services/QueryEstDteAv?wsdl",
		1 => "https://palena.sii.cl/DTEWS/QueryEstDte.jws?WSDL",
		2 => "https://palena.sii.cl/DTEWS/QueryEstUp.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);
	private $emisor_rut;
	private $emisor_dv;


	function __construct($rut,$dv)
	{
		$objTOKEN = new Token($rut,$dv);
		$this->token = trim($objTOKEN->getToken());
		$this->emisor_rut = $rut;
		$this->emisor_dv = $dv;
	}

	/**
	* Método que permite realizar una consulta avanzada al WebService del S.I.I de un DTE enviado.
	* El objetivo de este servicio es entregar una herramienta que permita consultar por el estado de un DTE
	* y corroborar los datos asociados a dicho DTE.
	* @return Array
	* @param Array con los datos necesarios a consultar
	**/
	public function QueryEstDteAv($input)
	{
		try {
			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" =>"El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($this->token);
					if(trim($token->GLOSA == "Token Creado"))
					{
						$this->client = $this->getConnection($this->wsdl_url[0]);
						$contenido = file_get_contents("../../sistemas/archivos/SII/".$input["ruta"].$input["archivo"].".xml");
						$xml = new SimpleXMLElement($contenido);
						$firma = $xml->SetDTE->DTE->Signature->SignatureValue;

						$fechaEmision = explode("-", $input["dcto_fecha_emision"]);
						$fecha = $fechaEmision[2]."-".$fechaEmision[1]."-".$fechaEmision[0];
						try {
							// getEstDteAv(string $RutEmpresa, string $DvEmpresa, string $RutReceptor, string $DvReceptor, string $TipoDte, string $FolioDte, string $FechaEmisionDte, string $MontoDte, string $FirmaDte, string $Token)
							$QueryEstDteAv = $this->client->getEstDteAv($input["rutEmisor"],$input["dvEmisor"],$input["receptor_rut"],$input["receptor_dv"],$input["tipo_dte"],$input["dcto_folio"],$fecha,$input["dcto_monto"],$firma,$token->TOKEN);
							$xml = new SimpleXMLElement($QueryEstDteAv);
							$xml->registerXPathNamespace('SII', 'http://www.sii.cl/XMLSchema');
							$events = $xml->xpath('//SII:RESP_BODY');
							$recibido = $events[0]->RECIBIDO;
							$estado = $events[0]->ESTADO;
							$glosa = $events[0]->GLOSA;


							if($recibido[0] == "SI" && $estado[0] == "DOK" && $glosa[0] == "Documento Recibido por el SII. Datos Coinciden con los Registrados")
							{
								return array("Respuesta" => true,"Mensaje" => $estado[0]);
							}else{
								return array("Respuesta" => false,"Mensaje" => "Recibido : ".$recibido."\nEstado : ".$estado."\nGlosa : ".$glosa);
							}
						} catch (SoapFault $e) {
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
	* Método que permite realizar una consulta básica al WebService del S.I.I de un DTE enviado.
	* El objetivo de este servicio es entregar una herramienta que permita consultar por el estado de un DTE
	* @return Array
	* @param Array con los datos necesarios a consultar
	**/
	public function QueryEstDte($input)
	{
		try {
			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" =>"El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($this->token);
					if(trim($token->GLOSA == "Token Creado"))
					{
						$this->client = $this->getConnection($this->wsdl_url[1]);
						$fechaEmision = explode("-", $input["dcto_fecha_emision"]);
						$fecha = $fechaEmision[2].$fechaEmision[1].$fechaEmision[0];
						// getEstDte(string $RutConsultante, string $DvConsultante, string $RutCompania, string $DvCompania, string $RutReceptor, string $DvReceptor, string $TipoDte, string $FolioDte, string $FechaEmisionDte, string $MontoDte, string $Token)
						$QueryEstDte = $this->client->getEstDte($input["consultante_rut"],$input["consultante_dv"],$input["rutEmisor"],$input["dvEmisor"],$input["receptor_rut"],$input["receptor_dv"],$input["sii_tipo_dcto"],$input["dcto_folio"],$fecha,$input["dcto_monto"],$token->TOKEN);
						try {
							$xml = new SimpleXMLElement($QueryEstDte);
							$xml->registerXPathNamespace('SII', 'http://www.sii.cl/XMLSchema');
							$events = $xml->xpath('//SII:RESP_HDR');

							if((string)$events[0]->ESTADO == "DOK" && (string)$events[0]->GLOSA_ESTADO == "DTE Recibido")
							{
								return array("Respuesta" => true,"Mensaje" => (string)$events[0]->ESTADO." - ".$events[0]->GLOSA_ESTADO.". ".$events[0]->GLOSA_ERR);
							}else{
								return array("Respuesta" => false,"Mensaje" => (string)$events[0]->GLOSA_ERR);
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
			return array("Respuesta" => false,"Mensaje" => "La Conexion ha fallado. ".$e->getMessage());
		}
	}

	/**
	* Método que permite consultar via WebService el estado de un envio al S.I.I de un DTE enviado.
	* El objetivo de este servicio es entregar una herramienta que permita consultar por el estado de un DTE
	* @return Array
	* @param Array con los datos necesarios a consultar
	**/
	public function QueryEstUp($input)
	{

		if($this->token === "Service Temporarily Unavailable")
		{
			return array("Respuesta" => false,"Mensaje" => "El servicio no está disponible.");
		}else{
			try {
				$token = new SimpleXMLElement($this->token);
				if(trim($token->GLOSA == "Token Creado"))
				{			
					try {
						$this->client = $this->getConnection($this->wsdl_url[2]);
						// getEstUp(string $RutCompania, string $DvCompania, string $TrackId, string $Token)
						$QueryEstUp = $this->client->getEstUp($input["receptor_rut"],$input["receptor_dv"],$input["consulta_trackid"],$token->TOKEN);
						$xml = new SimpleXMLElement($QueryEstUp);
						$xml->registerXPathNamespace('SII', 'http://www.sii.cl/XMLSchema');
						$events1 = $xml->xpath('//SII:RESP_HDR');
						$events2 = $xml->xpath('//SII:RESP_BODY');

						// print_r($events1);
						// print_r($events2);

						$estado = $events1[0]->ESTADO;
						$glosa = $events1[0]->GLOSA;
						$aceptado = $events2[0]->ACEPTADOS;

						if($input["tipo"] == "iecv")
						{
							if($estado == "LOK")
							{
								//ACTUALIZAMOS LA INFORMACION EN LA BASE DE DATOS
								$this->actualizaIECV($input["id"],$estado,$glosa);
								return array("Respuesta" => true,"Mensaje" => $estado." - ".$glosa);
							}else{
								return array("Respuesta" => false,"Mensaje" => $estado." - ".$glosa);
							}
						}else{
							if($estado == "EPR" && $aceptado)
							{
								//ACTUALIZAMOS LA INFORMACION EN LA BASE DE DATOS
								$this->actualizaDTE($input["id"],$estado,$glosa);
								return array("Respuesta" => true,"Mensaje" => $estado." - ".$glosa);
							}else{
								return array("Respuesta" => false,"Mensaje" => $estado." - ".$glosa);
							}
						}
						// $Respuesta = array("TRACKID" => $events1[0]->TRACKID,"ESTADO" => $events1[0]->ESTADO,"GLOSA" => $events1[0]->GLOSA,"NUM_ATENCION" => $events1[0]->NUM_ATENCION,"TIPO_DOCTO" => $events2[0]->TIPO_DOCTO,"INFORMADOS" => $events2[0]->INFORMADOS,"ACEPTADOS" => $events2[0]->ACEPTADOS,"RECHAZADOS" => $events2[0]->RECHAZADOS,"REPAROS" => $events2[0]->REPAROS);
						// if((string)$events1[0]->ESTADO == "EPR" && (string)$events1[0]->GLOSA == "Envio Procesado" && intval($events2[0]->INFORMADOS) == 1 && intval($events2[0]->ACEPTADOS == 1))
						// {
						// 	return array("Respuesta" => true, "Mensaje" => $events1[0]->ESTADO." ".$events1[0]->GLOSA);
						// }else{
						// 	return array("Respuesta" => false, "Mensaje" => $events1[0]->ESTADO." ".$events1[0]->GLOSA);
						// }
					} catch (SoapFault $e) {
						return array("Respuesta" => false,"Mensaje" => $e->getMessage());
					}

				}else{
					return array("Respuesta" => false,"Mensaje" => "Error : ".$token->GLOSA);
				}
			} catch (Exception $e) {
				return array("Respuesta" => false,"Mensaje" => $e->getMessage());
			}
		}
	}

/**
* Método que actualiza la informacion del DTE al momento de consultar su estado
* @param Intener $id ID del DTE a actualizar
* @param String $estado Estado del documento al momento de la consulta
* @param String $glosa Glosa / Texto del estado del documento al momento de la consulta
* @return Array con la respuesta de la consulta;
**/
private function actualizaDTE($id,$estado,$glosa){
	try {
		$objDbConnect = new db_connect();
		$null = NULL;
		$query = "UPDATE sii_dte SET dte_estado_upload = ? WHERE dte_id = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		$estado = $estado." - ".$glosa;
		if($stmt)
		{
			$stmt->bind_param("si",$estado,$id);
			
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
	* Funcion que permite actualizar el estado del libro en la base de datos
	* @param $iecv_id Integer ID del libro a actualizar
	* @param $iecv_estado Estado del libro consultado. Ej: LOK
	* @param $iecv_glosa Glosa detalle del libro consultado. Ej: Libro Cuadrado
	* @return Boolean
	**/
	private function actualizaIECV($iecv_id,$iecv_estado,$iecv_glosa)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_iecv_historial SET iecv_estado_envio = ?, iecv_estado_glosa = ? WHERE iecv_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("ssi",$iecv_estado,$iecv_glosa,$iecv_id);
				
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