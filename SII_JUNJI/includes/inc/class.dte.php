<?php
/**
* 
*/
require_once("class.cotizacion.php");
require_once("class.referencia.php");
require_once("class.token.php");

class DTE
{
	private $_url;
	private $_archivo_xml;
	private $_token;
	private $_rutSender;
	private $_dvSender;
	private $_rutCompany;
	private $_dvCompany;
	private $_tipoDcto;
	private $_year;
	private $_month;

	function __construct($archivo_xml, $token, $rutSender, $dvSender, $rutCompany, $dvCompany, $tipoDcto,$year,$month)
	{
		$this->_archivo_xml = $archivo_xml;
		$this->_token = $token;
		$this->_rutSender = $rutSender;
		$this->_dvSender = $dvSender;
		$this->_rutCompany = $rutCompany;
		$this->_dvCompany = $dvCompany;
		$this->_tipoDcto = $tipoDcto;
		$this->_year = $year;
		$this->_month = $month;
	}

public function reenviarSII($input)
	{
		$arhivo_xml = "../../sistemas/archivos/SII/".$input[0].$input[1].".xml";
		$xml = file_get_contents($arhivo_xml);
		$xml_parse = simplexml_load_string($xml);

		$datos = [
		"RutEmisor" => explode("-",(string)$xml_parse->SetDTE->Caratula->RutEmisor),
		"RutEnvia" => explode("-",(string)$xml_parse->SetDTE->Caratula->RutEnvia),
		"Archivo" => $input[1],
		];

		$femision = explode("T",(string)$xml_parse->SetDTE->Caratula->TmstFirmaEnv);
		
		$objTOKEN =  new Token($datos["RutEnvia"][0],$datos["RutEnvia"][1]);
		$token = $objTOKEN->getToken();
		$tokenRESP = simplexml_load_string($token);
		
		if((string)$tokenRESP->GLOSA == "Token Creado")
		{
			$filename = $arhivo_xml;
			// $cfile = new CURLFile($filename,"text/xml",$file);
			// $file = $_SERVER["DOCUMENT_ROOT"]."/SII_JUNJI/tmp/dte_".md5(microtime().$this->_token.$this->_tipoDcto).".xml";
			$file = $_SERVER["DOCUMENT_ROOT"]."/sistemas/archivos/SII/tmp/dte_REENVIO_".$datos["Archivo"].".xml";
			file_put_contents($file, file_get_contents($filename));

			$headers[] = "POST /cgi_dte/UPL/DTEUpload HTTP/1.0";
			$headers[] = "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/ms-excel, application/msword, */*";
			$headers[] = "Referer: http://www.junji.cl";
			$headers[] = "Accept-Language: es-cl";
			$headers[] = "Content-Type: multipart/form-data";
			$headers[] = "Accept-Encoding: gzip, deflate";
			$headers[] = "Connection: Keep-Alive";
			$headers[] = "User-Agent: Mozilla/4.0 (compatible; PROG 1.0; Windows NT 5.0; YComp 5.0.2.4)";
			$headers[] = "Connection: Keep-Alive";
			$headers[] = "Cache-Control: no-cache";
			$headers[] = "Cookie: TOKEN=".(string)$tokenRESP->TOKEN;

			$cuerpo = array(
			"rutSender" => $datos["RutEnvia"][0],
			"dvSender" => $datos["RutEnvia"][1],
			"rutCompany" => $datos["RutEmisor"][0],
			"dvCompany" => $datos["RutEmisor"][1],
			"archivo" => curl_file_create(
				$file,
				'application/xml',
				basename($file))
			);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $cuerpo);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, "https://palena.sii.cl/cgi_dte/UPL/DTEUpload");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($ch, CURLOPT_PORT, 443);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);


		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CAINFO, getcwd().'\ca-bundle.pem');
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);

		$result = curl_exec ($ch);
		if(!$result);
		 // print_r(curl_error($ch));
		$info = curl_getinfo($ch);
		curl_close ($ch);

		$resultado = simplexml_load_string($result);
		if((string)$resultado->STATUS == 0)
		{
			$this->actualizarTrackID($input,$resultado,$femision);
			unlink($file);
			return array("Respuesta" => true,"Mensaje" =>"El DTE ".$datos["Archivo"]." ha sido reenviado con el TrackID : ".(string)$resultado->TRACKID);
		}else{
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error: ".curl_error($ch));
		}

			// return array("Respuesta" => true,"Mensaje" => "Token Generado ".(string)$tokenRESP->TOKEN);
		}else
		{
			return array("Respuesta" => false,"Mensaje" => "No se ha podido generar el Token al S.I.I.");
			exit;
		}
	}

	private function actualizarTrackID($info,$sii,$femision)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_dte SET dte_tracking = ?, dte_fecha = ?, dte_hora = ?, dte_estado = ? WHERE dte_archivo = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("sssss",$sii->TRACKID,$femision[0],$femision[1],$sii->STATUS,$info[1]);

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

	public function enviarDTE2($year,$month)
	{

		$xml = '
		<RECEPCIONDTE>
			<RUTSENDER>1-9</RUTSENDER>
			<RUTCOMPANY >3-5</RUTCOMPANY>
			<FILE>EnvioEjemplo.xml</FILE>
			<TIMESTAMP>'.Date("Y-m-d H:i:s").'</TIMESTAMP>
			<STATUS>0</STATUS>
			<TRACKID>'.rand(1,100000000).'</TRACKID>
		</RECEPCIONDTE>';
// 
		try {
			$resultado = new SimpleXMLElement($xml);
			if($resultado->STATUS == 0)
			{
				return $resultado;
			}else{
				return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I.");
			}
		} catch (Exception $e) {
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I. : ".$e->getMessage());
		}
		exit;
		
		if($this->_tipoDcto == "acuse_2")
		{
			$filename = "../Documentos/acuse/".$year."/".$month."/".$this->_archivo_xml;
			$file = sys_get_temp_dir().'/dte_'.md5(microtime().$this->_token.$this->_tipoDcto).'.xml';
		}else{
			$filename = "../Documentos/acuse/".$year."/".$month."/".$this->_archivo_xml;
			$file = sys_get_temp_dir().'/dte_'.md5(microtime().$this->_token.$this->_tipoDcto).'.xml';
		}

		$cfile = new CURLFile($filename,"text/xml",$this->_archivo_xml);
		file_put_contents($file, file_get_contents($filename));

		$delimiter = '------------------------' . uniqid();

		$headers[] = "POST /cgi_dte/UPL/DTEUpload HTTP/1.0";
		$headers[] = "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/ms-excel, application/msword, */*";
		$headers[] = "Referer: http://www.junji.cl";
		$headers[] = "Accept-Language: es-cl";
		//$headers[] = "Content-Type: multipart/form-data; boundary=".$delimiter;
		$headers[] = "Content-Type: multipart/form-data";
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Connection: Keep-Alive";
		$headers[] = "User-Agent: Mozilla/4.0 (compatible; PROG 1.0; Windows NT 5.0; YComp 5.0.2.4)";
		$headers[] = "Connection: Keep-Alive";
		$headers[] = "Cache-Control: no-cache";
		$headers[] = "Cookie: TOKEN=".$this->_token;
		
		$cuerpo = array(
			"rutSender" => $this->_rutSender,
			"dvSender" => $this->_dvSender,
			"rutCompany" => $this->_rutCompany,
			"dvCompany" => $this->_dvCompany,
			"archivo" => curl_file_create(
				$file,
				'application/xml',
				basename($file))
			);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $cuerpo);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, "https://maullin.sii.cl/cgi_dte/UPL/DTEUpload");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_PORT, 443);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);

		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CAINFO, getcwd().'\ca-bundle.pem');
		curl_setopt($ch, CURLOPT_HEADER,0);
		//curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);

		//$ssl_codes = parse_ini_file("ssl_codes.ini");
		//$http_codes = parse_ini_file("http_codes.ini");
		$result = curl_exec ($ch);
		if(!$result) print_r(curl_error($ch));
		$info = curl_getinfo($ch);
		//print_r(curl_getinfo($ch,CURLINFO_HEADER_OUT));
		curl_close ($ch);
		//echo "<br />SSL VERIFYRESULT<br />";
		//echo "Codigo SSL CODE:".$info['ssl_verify_result'] . "->" . $ssl_codes[$info['ssl_verify_result']];
		//echo "The server responded: <br />";
		//echo "Codigo HTTP CODE:" . $info['http_code'] . "->" . $http_codes[$info['http_code']];
		//echo "Info <br />";
		//print_r($info);
		//print_r($result);
		//echo "<br /><br /> <h3>Result</h3> <br />";

		//$file = fopen("test.xml", "w+");
		//fwrite($file, $result);
		//fclose($file);
		// print_r($result);
		$resultado = new SimpleXMLElement($result);
		return $resultado;

	}

	public function enviarDTE(){

		// $xml = '
		// <RECEPCIONDTE>
		// 	<RUTSENDER>1-9</RUTSENDER>
		// 	<RUTCOMPANY >3-5</RUTCOMPANY>
		// 	<FILE>EnvioEjemplo.xml</FILE>
		// 	<TIMESTAMP>'.Date("Y-m-d H:i:s").'</TIMESTAMP>
		// 	<STATUS>0</STATUS>
		// 	<TRACKID>'.rand(1,100000000).'</TRACKID>
		// </RECEPCIONDTE>';
// 
		// try {
		// 	$resultado = new SimpleXMLElement($xml);
		// 	if($resultado->STATUS == 0)
		// 	{
		// 		return $resultado;
		// 	}else{
		// 		return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I.");
		// 	}
		// } catch (Exception $e) {
		// 	return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I. : ".$e->getMessage());
		// }
		// exit;
		// $filename = dirname(__FILE__)."/Documentos/".$this->_tipoDcto."/".$this->_archivo_xml;
		// ../sistemas/archivos/SII/
		$filename = $_SERVER["DOCUMENT_ROOT"]."/sistemas/archivos/SII/Documentos/".$this->_tipoDcto."/".$this->_year."/".$this->_month."/".$this->_archivo_xml.".xml";
		// $file = sys_get_temp_dir().'/dte_'.md5(microtime().$this->_token.$this->_tipoDcto).'.xml';
		// $file = dirname(__FILE__).'/dte_'.md5(microtime().$this->_token.$this->_tipoDcto).'.xml';
		$file = $_SERVER["DOCUMENT_ROOT"]."/sistemas/archivos/SII/tmp/dte_".md5(microtime().$this->_token.$this->_tipoDcto).".xml";
		//$filename = realpath(dirname(__FILE__)."/Documentos/".$this->_tipoDcto."/".$this->_archivo_xml);
		//$filename = $_SERVER["DOCUMENT_ROOT"]."/FE/includes/Documentos/".$this->_tipoDcto."/".$this->_archivo_xml;
		$cfile = new CURLFile($filename,"text/xml",$this->_archivo_xml);
		file_put_contents($file, file_get_contents($filename));
		$delimiter = '------------------------' . uniqid();

		$headers[] = "POST /cgi_dte/UPL/DTEUpload HTTP/1.0";
		$headers[] = "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/ms-excel, application/msword, */*";
		$headers[] = "Referer: http://www.junji.cl";
		$headers[] = "Accept-Language: es-cl";
		//$headers[] = "Content-Type: multipart/form-data; boundary=".$delimiter;
		$headers[] = "Content-Type: multipart/form-data";
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Connection: Keep-Alive";
		$headers[] = "User-Agent: Mozilla/4.0 (compatible; PROG 1.0; Windows NT 5.0; YComp 5.0.2.4)";
		$headers[] = "Connection: Keep-Alive";
		$headers[] = "Cache-Control: no-cache";
		$headers[] = "Cookie: TOKEN=".$this->_token;
		
		$cuerpo = array(
			"rutSender" => $this->_rutSender,
			"dvSender" => $this->_dvSender,
			"rutCompany" => $this->_rutCompany,
			"dvCompany" => $this->_dvCompany,
			// "archivo" => $cfile
			"archivo" => curl_file_create(
				$file,
				'application/xml',
				basename($file))
			);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $cuerpo);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, "https://palena.sii.cl/cgi_dte/UPL/DTEUpload");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($ch, CURLOPT_PORT, 443);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);


		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CAINFO, getcwd().'\ca-bundle.pem');
		curl_setopt($ch, CURLOPT_HEADER,0);
		//curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);

		//$ssl_codes = parse_ini_file("ssl_codes.ini");
		//$http_codes = parse_ini_file("http_codes.ini");
		$result = curl_exec ($ch);
		if(!$result) print_r(curl_error($ch));
		$info = curl_getinfo($ch);
		//print_r(curl_getinfo($ch,CURLINFO_HEADER_OUT));
		curl_close ($ch);
		//echo "<br />SSL VERIFYRESULT<br />";
		//echo "Codigo SSL CODE:".$info['ssl_verify_result'] . "->" . $ssl_codes[$info['ssl_verify_result']];
		//echo "The server responded: <br />";
		//echo "Codigo HTTP CODE:" . $info['http_code'] . "->" . $http_codes[$info['http_code']];
		//echo "Info <br />";
		//print_r($info);
		//print_r($result);
		//echo "<br /><br /> <h3>Result</h3> <br />";

		//$file = fopen("test.xml", "w+");
		//fwrite($file, $result);
		//fclose($file);
		try {
			$resultado = new SimpleXMLElement($result);

			if($resultado->STATUS == 0)
			{
				unlink($file);
				// return array("Respuesta" => true,"Mensaje" => "Se ha creado el documento : ".$this->_archivo_xml);
				return $resultado;
			}else{
				return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I.");
			}

		} catch (Exception $e) {
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I. : ".$e->getMessage());
		}
		
		// return $resultado;
	}


	public function nuevoDTE($referencia,$dcto,$folio,$res,$cliente,$cotizacion_id,$region,$datos = null)
	{
		try {
			$objCotizacion = new Cotizacion();
			$detalleCotizacion = $objCotizacion->getCotizacion($cotizacion_id);

			$objDbConnect = new db_connect();
			$null = NULL;


			$fecha = explode(" ", $res->TIMESTAMP);
			$f_emision = explode("-",$fecha[0]);


			$query = "INSERT INTO sii_dte VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$ruta = "Documentos/".$dcto."/".$f_emision[0]."/".$f_emision["1"]."/";

			$status = 0;
			if($stmt)
			{
				$stmt->bind_param("issssssiiiiiiiissis",
					$null,
					$dcto,
					$ruta,
					$referencia,
					$res->TRACKID,
					$fecha[0],
					$fecha[1],
					$res->STATUS,
					$folio,
					$cliente,
					$cotizacion_id,
					($dcto == 34) ? 0 : $detalleCotizacion[1]["cotizacion_neto"],
					($dcto == 34) ? 0 : $detalleCotizacion[1]["cotizacion_iva"],
					($dcto == 34) ? 0 : $detalleCotizacion[1]["cotizacion_total"],
					($dcto == 34) ? $detalleCotizacion[1]["cotizacion_exento"] : $detalleCotizacion[1]["cotizacion_exento"],
					$null,
					$null,
					$region,
					$null,
					$null);
				
				if($stmt->execute())
				{

					if($dcto == 61 || $dcto == 56 || $dcto == 52)
					{
						$objReferencia = new Referencia();
						$dte_id = $objReferencia->buscarReferencia($detalleCotizacion[1]["cotizacion_id"])[1]["dte_id"];
						$this->insertarReferencia($stmt->insert_id,$dte_id);
					}

					if($dcto == 52)
					{
						$this->actualizarIndTraslado($stmt->insert_id,$datos);
					}


					return $this->insertarDetalle($cotizacion_id,$stmt->insert_id);
				}else{
					echo $stmt->error;
				}
			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function actualizarIndTraslado($dte_id,$datos)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_dte SET dte_gd_traslado = ? WHERE dte_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("ii",$datos["IndTraslado"],$dte_id);
				
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

		private function actualizarIndTraslado2($dte_id,$indTraslado)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_dte SET dte_gd_traslado = ? WHERE dte_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("ii",$indTraslado,$dte_id);
				
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
	public function actualizarMonto($cotizacion_id,$monto)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_cotizacion SET cotizacion_total = ? WHERE cotizacion_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				
				$stmt->bind_param("ii",$monto,$cotizacion_id);

				if($stmt->execute())
				{
					return true;
				}else{
					return $stmt->error;
				}
			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function insertarDetalle($cotizacion_id,$ultimo_id)
	{
		try {
			$exito = 0;
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_detalle_dte VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			$objCotizacion = new Cotizacion();
			$detalleCotizacion = $objCotizacion->getDetalleCotizacion($cotizacion_id);

			if($stmt)
			{
				foreach ($detalleCotizacion as $key => $value) {
					$stmt->bind_param("isiiiiiiiisi",$null,$value["detalle_producto_id"],$ultimo_id,$value["detalle_cantidad"],$value["detalle_estado"],$value["detalle_descuento"],$value["detalle_subtotal"],$value["detalle_descuento_monto"],$value["detalle_unitario"],$value["detalle_indexe"],$null,$null);
					if($stmt->execute())
					{
						$exito++;
					}
				}

				if($exito == count($detalleCotizacion))
				{
					return true;
				}else{
					return false;
				}

			}else{
				return false;
			}
			
			
		}catch (Exception $e) {
			return $e->getMessage();
		}		
	}

	public function nuevoDTE2($referencia,$dcto,$folio,$res,$cliente,$cotizacion_id,$datos)
	{
		try {
			$objCotizacion = new Cotizacion();
			$detalleCotizacion = $objCotizacion->getCotizacion($cotizacion_id);
			$objDbConnect = new db_connect();
			$null = NULL;
			$status = 0;
			$fecha = explode(" ", $res->TIMESTAMP);
			$dte_origen = 3;

			if($datos["DscRcgGlobal"] == "on")
			{

				if($datos["DscRcgGlobalTpoMov"] <> "" && $datos["DscRcgGlobalTpoValor"] <> "" && $datos["DscRcgGlobalValorDR"] <> "")
				{
					//DESCUENTO
					if($datos["DscRcgGlobalTpoMov"] == "D")
					{
						if($datos["DscRcgGlobalTpoValor"] == "%")
						{
							$neto = $datos["cotizacion_neto"] - (round($datos["cotizacion_neto"] * ($datos["DscRcgGlobalValorDR"] / 100)));
						}else if($datos["DscRcgGlobalTpoValor"] == "$")
						{
							$neto = $datos["cotizacion_neto"] - $datos["DscRcgGlobalValorDR"];
						}else{
							$neto = $datos["cotizacion_neto"];
						}
					// RECARGO
					}else{
						if($datos["DscRcgGlobalTpoValor"] == "%")
						{
							$neto = $datos["cotizacion_neto"] + (round($datos["cotizacion_neto"] * ($datos["DscRcgGlobalValorDR"] / 100)));
						}else if($datos["DscRcgGlobalTpoValor"] == "$")
						{
							$neto = $datos["cotizacion_neto"] + $datos["DscRcgGlobalValorDR"];
						}else{
							$neto = $datos["cotizacion_neto"];
						}
					}
				}else{
					$neto = $datos["cotizacion_neto"];
				}
			}else{
				$neto = $datos["cotizacion_neto"];
			}

			$f_emision = explode("-",$fecha[0]);

			$total = $neto + round($neto * 0.19) + $datos["cotizacion_exento"];
			$query = "INSERT INTO sii_dte VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			// $ruta = "Documentos/".$dcto."/";
			$ruta = "Documentos/".$dcto."/".$f_emision[0]."/".$f_emision["1"]."/";
			if($stmt)
			{
				$stmt->bind_param("issssssiiiiiiiississs",
					$null,
					$dcto,
					$ruta,
					$referencia,
					$res->TRACKID,
					$fecha[0],
					$fecha[1],
					$res->STATUS,
					$folio,
					$cliente,
					$datos["dte_cotizacion_id"],
					($datos["CodRef"] == 2) ? 0 : $neto,
					($datos["CodRef"] == 2) ? 0 : round($neto * 0.19),
					($datos["CodRef"] == 2) ? 0 : $total,
					($datos["CodRef"] == 2) ? 0 : $datos["cotizacion_exento"],
					$null,
					$null,
					$datos["emisor_region"],
					$null,
					$null,
					$dte_origen);
				
				if($stmt->execute())
				{
					if($dcto == 61 || $dcto == 56)
					{
						$this->insertarReferencia($stmt->insert_id,$datos["dte_id"]);
					}
					return $this->insertarDetalle2($cotizacion_id,$stmt->insert_id,$datos);
				}else{
					return $stmt->error;
				}
			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function insertarDetalle2($cotizacion_id,$ultimo_id,$datos)
	{
		try {
			$exito = 0;
			$objDbConnect = new db_connect();
			$null = NULL;
			$estado = 1;
			$query = "INSERT INTO sii_detalle_dte VALUES(?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			// $objCotizacion = new Cotizacion();
			// $detalleCotizacion = $objCotizacion->getDetalleCotizacion($cotizacion_id);
			if($stmt)
			{
				if($datos["CodRef"] == 2)
				{
					$stmt->bind_param("isiiiiiiiis",$null,$datos["RazonRef"],$ultimo_id,$exito,$estado,$exito,$exito,$exito,$exito,$estado,$exito);
					if($stmt->execute())
					{
						return true;
					}else{
						echo $stmt->error;
					}
					exit;
				}else{
					for($i=0;$i<$datos["totalElementos"];$i++)
					{
						if($datos["var12"][$i] == "on"){
							$stmt->bind_param("isiiiiiiiis",$null,$datos["var5"][$i],$ultimo_id,$datos["var4"][$i],$estado,$datos["var1"][$i],$datos["var2"][$i],$datos["var6"][$i],$datos["var3"][$i],$datos["var10"][$i],$datos["var13"][$i]);
							if($stmt->execute())
							{
								$exito++;
							}else{
								$stmt->error;
							}
						}
					}
				}

				if($exito == count($detalleCotizacion))
				{
					return true;
				}else{
					return false;
				}

			}else{
				return false;
			}
			
			
		}catch (Exception $e) {
			return $e->getMessage();
		}		
	}

	private function insertarReferencia($dte_id,$referencia_id)
	{
		try {
			
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_referencia VALUES(?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("iii",$null,$dte_id,$referencia_id);
				
				if($stmt->execute())
				{
					return true;
				}else{
					return $stmt->error;
				}
			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}


	public function enviarIECV(){

/*
		$xml = '
		<RECEPCIONDTE>
			<RUTSENDER>1-9</RUTSENDER>
			<RUTCOMPANY >3-5</RUTCOMPANY>
			<FILE>EnvioEjemplo.xml</FILE>
			<TIMESTAMP>'.Date("Y-m-d H:i:s").'</TIMESTAMP>
			<STATUS>0</STATUS>
			<TRACKID>'.rand(1,100000000).'</TRACKID>
		</RECEPCIONDTE>';
// 
		try {
			$resultado = new SimpleXMLElement($xml);
			if($resultado->STATUS == 0)
			{
				return $resultado;
			}else{
				return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I.");
			}
		} catch (Exception $e) {
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al enviar el DTE al S.I.I. : ".$e->getMessage());
		}
		exit;
*/
		// $filename = dirname(__FILE__)."/Documentos/".$this->_tipoDcto."/".$this->_archivo_xml;
		$filename = $this->_archivo_xml;

		$file = sys_get_temp_dir().'/dte_'.md5(microtime().$this->_token.$this->_tipoDcto).'.xml';
		//$filename = realpath(dirname(__FILE__)."/Documentos/".$this->_tipoDcto."/".$this->_archivo_xml);
		//$filename = $_SERVER["DOCUMENT_ROOT"]."/FE/includes/Documentos/".$this->_tipoDcto."/".$this->_archivo_xml;
		$cfile = new CURLFile($filename,"text/xml",$this->_archivo_xml);
		file_put_contents($file, file_get_contents($filename));

		$delimiter = '------------------------' . uniqid();

		$headers[] = "POST /cgi_dte/UPL/DTEUpload HTTP/1.0";
		$headers[] = "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/ms-excel, application/msword, */*";
		$headers[] = "Referer: http://www.junji.cl";
		$headers[] = "Accept-Language: es-cl";
		//$headers[] = "Content-Type: multipart/form-data; boundary=".$delimiter;
		$headers[] = "Content-Type: multipart/form-data";
		$headers[] = "Accept-Encoding: gzip, deflate";
		$headers[] = "Connection: Keep-Alive";
		$headers[] = "User-Agent: Mozilla/4.0 (compatible; PROG 1.0; Windows NT 5.0; YComp 5.0.2.4)";
		$headers[] = "Connection: Keep-Alive";
		$headers[] = "Cache-Control: no-cache";
		$headers[] = "Cookie: TOKEN=".$this->_token;
		
		$cuerpo = array(
			"rutSender" => $this->_rutSender,
			"dvSender" => $this->_dvSender,
			"rutCompany" => $this->_rutCompany,
			"dvCompany" => $this->_dvCompany,
			// "archivo" => $cfile
			"archivo" => curl_file_create(
				$file,
				'application/xml',
				basename($file))
			);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $cuerpo);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, "https://palena.sii.cl/cgi_dte/UPL/DTEUpload");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


		curl_setopt($ch, CURLOPT_PORT, 443);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);


		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_CAINFO, getcwd().'\ca-bundle.pem');
		curl_setopt($ch, CURLOPT_HEADER,0);
		//curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);

		//$ssl_codes = parse_ini_file("ssl_codes.ini");
		//$http_codes = parse_ini_file("http_codes.ini");
		$result = curl_exec ($ch);
		if(!$result) print_r(curl_error($ch));
		$info = curl_getinfo($ch);
		//print_r(curl_getinfo($ch,CURLINFO_HEADER_OUT));
		curl_close ($ch);
		//echo "<br />SSL VERIFYRESULT<br />";
		//echo "Codigo SSL CODE:".$info['ssl_verify_result'] . "->" . $ssl_codes[$info['ssl_verify_result']];
		//echo "The server responded: <br />";
		//echo "Codigo HTTP CODE:" . $info['http_code'] . "->" . $http_codes[$info['http_code']];
		//echo "Info <br />";
		//print_r($info);
		//print_r($result);
		//echo "<br /><br /> <h3>Result</h3> <br />";

		//$file = fopen("test.xml", "w+");
		//fwrite($file, $result);
		//fclose($file);
		// print_r($result);
		$resultado = new SimpleXMLElement($result);
		return $resultado;
	}



	public static function nuevoDTE_52($referencia,$dcto,$folio,$res,$cliente,$guia_despacho_id,$region,$totalneto,$montoiva,$total,$detalleproductos,$indTraslado,$origen)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;

			$fecha = explode(" ", $res->TIMESTAMP);
			$f_emision = explode("-",$fecha[0]);

			$query = "INSERT INTO sii_dte VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$ruta = "Documentos/".$dcto."/".$f_emision[0]."/".$f_emision["1"]."/";
			$status = 0;

			if($stmt)
			{
				$stmt->bind_param("issssssiiiiiiiissisii",
					$null,
					$dcto,
					$ruta,
					$referencia,
					$res->TRACKID,
					$fecha[0],
					$fecha[1],
					$res->STATUS,
					$folio,
					$cliente,
					$guia_despacho_id,
					($dcto == 34) ? 0 : $totalneto,
					($dcto == 34) ? 0 : $montoiva,
					($dcto == 34) ? 0 : $total,
					($dcto == 34) ? 0 : $status,//este es el exento
					$null,
					$null,
					$region,
					$null,
					$null,
					$origen);
				
				if($stmt->execute())
				{
					$ultimo = $stmt->insert_id;
					if($dcto == 52)
					{
						self::actualizarIndTraslado2($ultimo,$indTraslado);
					}
					return self::insertarDetalle_52($ultimo,$detalleproductos);//HAY QUE PASARLE LOS PRODUCTOS $detalleproductos
				}else{
					echo $stmt->error;
				}

			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}


	private function insertarDetalle_52($dte_id_ingresadoultimo,$productos)
	{
		try {
			$exito = 0;
			$escero = 0;
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_detalle_dte VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				foreach ($productos as $key => $value) {
					$resd = $value["doc_cantidad"]*$value["doc_conversion"];
					$stmt->bind_param("isiiiiiiiisi",$null,$value["doc_especificacion"],$dte_id_ingresadoultimo,$value["doc_cantidad"],$value["doc_estado"],$null,$resd,$null,$value["doc_conversion"],$escero,$value["doc_umedida"],$value['inv_codigo']);
					
					if($stmt->execute())
					{
						$exito++;
					}
				}

				if($exito == count($productos))
				{
					return $dte_id_ingresadoultimo;
				}else{
					return false;
				}

			}else{
				return false;
			}
			
			
		}catch (Exception $e) {
			return $e->getMessage();
		}		
	}

}
?>