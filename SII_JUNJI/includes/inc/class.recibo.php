<?php
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.validate.php");

/**
* Clase para trabajar con los DTE recibidos de los proveedores
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Recibo
{
	private $ruta = "../../Documentos/recibidos/";
	private $_Caratula = null;
	private $_IdDoc = null;
	private $_Emisor = null;
	private $_Receptor = null;
	private $_Totales = null;
	private $_Detalle = null;
	
	function __construct(){}

	/**
	* Funcion que permite la creacion de la carpeta de destino si no existe
	* @param Integer $tipoDCTO con el tipo de documento
	* @param Integer $year con el año solicitado
	* @param Intener $month con el mes que se desea crear
	**/	
	private function crearDirectorio($tipoDCTO,$year,$month)
	{
		try {
			$ruta = $this->ruta.$tipoDCTO.'/'.$year.'/'.$month;
			mkdir($ruta,0777,true);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

/**
* Método que permite obtener el ultimo folio interno de los DTE recibidos
* @return Array
**/	
public function getFolioInterno()
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT MAX(recibido_foliointerno) as Folio FROM sii_dte_recibido";
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
* Método que permite la carga de la informacion al sistema a partir de un DTE en formato XML entregado por el S.I.I.
* @return Array
* @param Array $input Datos del XML en un arreglo
* @param Integer $path Tipo de formato del XML
* @param String $file Nombre del archivo para ser cargado al sistema
**/	
public function cargarXMLSII($xml,$file,$region)
{
	$ultimo = $this->getFolioInterno();
	$totalElementos = count($xml->DTE);
	if($ultimo[1]["Folio"] == "")
	{
		$ultimo = 1;
	}else{
		$ultimo = $ultimo[1]["Folio"] + 1;
	}
	$contador = 0;
	for($i=0;$i<$totalElementos;$i++){
		$tipoDTE = $xml->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE;
		//CARGAMOS TODOS LOS DTE EXCEPTO LAS BOLETAS Y LAS GUIAS DE DESPACHO ELECTRONICAS
		if($tipoDTE <> 39 && $tipoDTE <> 52)
		{
			$fecha 				= explode("-",$xml->DTE[$i]->Documento->Encabezado->IdDoc->FchEmis);
			$recibido_tipo_dcto = $xml->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE;
			$recibido_folio 	= $xml->DTE[$i]->Documento->Encabezado->IdDoc->Folio;
			$rut 				= explode("-",$xml->DTE[$i]->Documento->Encabezado->Emisor->RUTEmisor);
			$recibido_rut 		= $rut[0];
			$recibido_dv 		= $rut[1];
			$recibido_cliente 	= $xml->DTE[$i]->Documento->Encabezado->Emisor->RznSoc;
			$recibido_ruta 		= "Documentos/recibidos/".$recibido_tipo_dcto."/".$fecha[0]."/".$fecha[1];
			$recibido_monto 	= $xml->DTE[$i]->Documento->Encabezado->Totales->MntTotal;
			$recibido_femision 	= $xml->DTE[$i]->Documento->Encabezado->IdDoc->FchEmis;
			$recibido_neto 		= $xml->DTE[$i]->Documento->Encabezado->Totales->MntNeto;
			$recibido_iva 		= $xml->DTE[$i]->Documento->Encabezado->Totales->IVA;
			$recibido_exento 	= $xml->DTE[$i]->Documento->Encabezado->Totales->MntExe;
			$recibido_digest    = $xml->DTE[$i]->Signature->SignedInfo->Reference->DigestValue;

			$rut2 				= explode("-",$xml->DTE[$i]->Documento->Encabezado->Receptor->RUTRecep);
			$recibido_rut2 		= $rut2[0];
			$recibido_dv2 		= $rut2[1];
			$recibido_dteid		= $xml->DTE[$i]->Documento["ID"];

			$recibido_emisor_rut = explode("-",$xml->Caratula->RutEmisor);

			$archivo = $_FILES["archivo"]["name"];
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_dte_recibido VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$estado = 1;

			if($stmt)
			{
				$stmt->bind_param("iiiisssiiiisiiiissisissssisss",$null,$recibido_tipo_dcto,$recibido_folio,$recibido_rut,$recibido_dv,$recibido_ruta,$archivo,$null,$null,$null,$estado,$recibido_cliente,$recibido_neto,$recibido_iva,$recibido_monto,$recibido_exento,$recibido_femision,$null,$ultimo,$recibido_digest,$recibido_rut2,$recibido_dv2,$recibido_dteid,$recibido_emisor_rut[0],$recibido_emisor_rut[1],$region,$null,$null,$null);

				if($stmt->execute())
				{
					$contador++;
				}

			}else{
				$error = error_get_last();
				return array("Respuesta" => false,"Mensaje" => $error["message"]);
			}

		}//FIN IF
	}//FIN FOR

	$this->cargarIECVSII($xml,$region);
	if($contador == $totalElementos)
	{
		return array("Respuesta" => true);
	}

}

/**
* Método que permite la carga de la informacion al sistema a partir de un DTE en formato XML
* @return Array
* @param Array $input Datos del XML en un arreglo
* @param Integer $path Tipo de formato del XML
* @param String $file Nombre del archivo para ser cargado al sistema
**/	
public function cargarXML($input,$path,$file,$region)
{
	try {
		if($path == 1)
		{
			$totalElementos = count($input->SetDTE->DTE);
		}else if($path == 0){
			$totalElementos = count($input->Documento);
		}else if($path == 2)
		{
			$totalElementos = count($input->DTE);
		}

		$ultimo = $this->getFolioInterno();
		if($ultimo[1]["Folio"] == "")
		{
			$ultimo = 1;
		}else{
			$ultimo = $ultimo[1]["Folio"] + 1;
		}
		$contador = 0;
		for($i=0;$i<$totalElementos;$i++){

			$tipoDTE = ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE : $input[$i]->Documento->Encabezado->IdDoc->TipoDTE;
			if($path == 0)
			{
				$tipoDTE = $input[$i]->Documento->Encabezado->IdDoc->TipoDTE;
			}else if($path == 1)
			{
				$tipoDTE = $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE;
			}else if($path == 2)
			{
				$tipoDTE = $input->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE;
			}
			if($tipoDTE == 39)
			{
				// self::cargarBoleta($input);
				return array("Respuesta" => false,"Mensaje" => "Documento no permitido. (".$tipoDTE.")");
			}
			$fecha 				= explode("-",($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->FchEmis : $input[$i]->Documento->Encabezado->IdDoc->FchEmis);
			$recibido_tipo_dcto = ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE : $input[$i]->Documento->Encabezado->IdDoc->TipoDTE;
			$recibido_folio 	= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->Folio : $input[$i]->Documento->Encabezado->IdDoc->Folio;
			$rut 				= explode("-",($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Emisor->RUTEmisor : $input[$i]->Documento->Encabezado->Emisor->RUTEmisor);
			$recibido_rut 		= $rut[0];
			$recibido_dv 		= $rut[1];
			$recibido_cliente 	= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Emisor->RznSoc : $input[$i]->Documento->Encabezado->Emisor->RznSoc;
			$recibido_ruta 		= "Documentos/recibidos/".$recibido_tipo_dcto."/".$fecha[0]."/".$fecha[1];
			$recibido_monto 	= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->MntTotal : $input[$i]->Documento->Encabezado->Totales->MntTotal;
			$recibido_femision 	= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->FchEmis : $input[$i]->Documento->Encabezado->IdDoc->FchEmis;
			$recibido_neto 		= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->MntNeto : $input[$i]->Documento->Encabezado->Totales->MntNeto;
			$recibido_iva 		= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->IVA : $input[$i]->Documento->Encabezado->Totales->IVA;
			$recibido_exento 	= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->MntExe : $input[$i]->Documento->Encabezado->Totales->MntExe;
			$recibido_digest    = ($path === 1) ? $input->SetDTE->DTE[$i]->Signature->SignedInfo->Reference->DigestValue : $input[$i]->Signature->SignedInfo->Reference->DigestValue;

			$rut2 				= explode("-",($path === 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Receptor->RUTRecep : $input[$i]->Documento->Encabezado->Receptor->RUTRecep);
			$recibido_rut2 		= $rut2[0];
			$recibido_dv2 		= $rut2[1];
			$recibido_dteid		= ($path === 1) ? $input->SetDTE->DTE[$i]->Documento["ID"] : $input[$i]->Documento["ID"];

			$recibido_emisor_rut = ($path === 1) ? explode("-",$input->SetDTE->Caratula->RutEmisor) : explode("-",$input->Documento->TED->DD->RE);
			$archivo = $_FILES["archivo"]["name"];
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_dte_recibido VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$estado = 1;
			$this->cargarIECV($input,$path,$region,$totalElementos);

			if($stmt)
			{
				$stmt->bind_param("iiiisssiiiisiiiissisissssisss",$null,$recibido_tipo_dcto,$recibido_folio,$recibido_rut,$recibido_dv,$recibido_ruta,$archivo,$null,$null,$null,$estado,$recibido_cliente,$recibido_neto,$recibido_iva,$recibido_monto,$recibido_exento,$recibido_femision,$null,$ultimo,$recibido_digest,$recibido_rut2,$recibido_dv2,$recibido_dteid,$recibido_emisor_rut[0],$recibido_emisor_rut[1],$region,$null,$null,$null);

				if($stmt->execute())
				{
					$contador++;
				}else{
					echo $stmt->error;
				}

			}else{
				// echo "ERROR";
				// $error = error_get_last();
				// return array("Respuesta" => false,"Mensaje" => $error["message"]);
			}

		}
		if($contador == $totalElementos)
		{
			return array("Respuesta" => true);
		}


	}catch (Exception $e) {
		return $e->getMessage();
	}
}

/**
* Método que permite la carga de la informacion al libro de compras
* @return Array
**/	
private function cargarIECVSII($input,$region)
{
	try {
		$totalElementos = count($input->DTE);
		$objDbConnect = new db_connect();
		$null = NULL;
		$query = "INSERT INTO sii_iecv VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $objDbConnect->getConnection()->prepare($query);

		for($i=0;$i<$totalElementos;$i++){
			if($stmt)
			{

				$stmt->bind_param("iiiissiiiisiiiiiiiiii",
					$null,
					$input->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE,
					$input->DTE[$i]->Documento->Encabezado->IdDoc->Folio,
					explode("-", $input->DTE[$i]->Documento->Encabezado->Emisor->RUTEmisor)[0],
					explode("-", $input->DTE[$i]->Documento->Encabezado->Emisor->RUTEmisor)[1],
					$input->DTE[$i]->Documento->Encabezado->Emisor->RznSoc,
					$input->DTE[$i]->Documento->Encabezado->Totales->IVA,
					$input->DTE[$i]->Documento->Encabezado->Totales->MntNeto,
					$input->DTE[$i]->Documento->Encabezado->Totales->MntTotal,
					$input->DTE[$i]->Documento->Encabezado->Totales->MntExe,
					$input->DTE[$i]->Documento->Encabezado->IdDoc->FchEmis,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$region,
					$null,
					$null
					);

				if($stmt->execute())
				{
				// return true;
				}else{
				// return $stmt->error;
				}
			}else{
			// return false;
			}
	}//FIN FOR
}catch (Exception $e) {
	return $e->getMessage();
}
}

/**
* Método que permite la carga de la informacion al libro de compras
* @return Array
**/	
private function cargarIECV($input,$path,$region,$totalElementos)
{

	try {
		$objDbConnect = new db_connect();
		$null = NULL;
		$query = "INSERT INTO sii_iecv VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		$contador = 1;
		for($i=0;$i<$totalElementos;$i++)
		{
			if($stmt)
			{
				$stmt->bind_param("iiiissiiiisiiiiiiiiii",
					$null,
					($path == 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->TipoDTE : $input[$i]->Documento->Encabezado->IdDoc->TipoDTE,
					($path == 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->Folio : $input[$i]->Documento->Encabezado->IdDoc->Folio,
					explode("-", ($path == 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Emisor->RUTEmisor : $input[$i]->Documento->Encabezado->Emisor->RUTEmisor)[0],
					explode("-", ($path == 1) ? $input->SetDTE->DTE[$i]->Documento->Encabezado->Emisor->RUTEmisor : $input[$i]->Documento->Encabezado->Emisor->RUTEmisor)[1],
					($path == 1) ?  $input->SetDTE->DTE[$i]->Documento->Encabezado->Emisor->RznSoc : $input[$i]->Documento->Encabezado->Emisor->RznSoc,
					($path == 1) ?  $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->IVA : $input[$i]->Documento->Encabezado->Totales->IVA,
					($path == 1) ?  $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->MntNeto : $input[$i]->Documento->Encabezado->Totales->MntNeto,
					($path == 1) ?  $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->MntTotal : $input[$i]->Documento->Encabezado->Totales->MntTotal,
					($path == 1) ?  $input->SetDTE->DTE[$i]->Documento->Encabezado->Totales->MntExe : $input[$i]->Documento->Encabezado->Totales->MntExe,
					($path == 1) ?  $input->SetDTE->DTE[$i]->Documento->Encabezado->IdDoc->FchEmis : $input[$i]->Documento->Encabezado->IdDoc->FchEmis,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$null,
					$region,
					$null,
					$null
					);

				if($stmt->execute())
				{
					// return true;
					$contador++;
				}else{
					// return $stmt->error;
					// echo $stmt->error;
				}

			}else{
				// return false;
			}

		}// FIN FOR
		if($contador === $totalElementos)
		{
			return true;
		}else{
			return false;
		}
	}catch (Exception $e) {
		return $e->getMessage();
	}
}

/**
* Método que permite verificar la duplicidad de los DTE recibidos
* @return Array
* @param Integer $tipoDCTO Tipo de documento a verificar
* @param Integer $folio Folio que se desea comprobar
* @param Integer $rut Rut del proveedor
* @param String $dv Digito verificador del proveedor
* @param String $archivo Nombre del archivo a comprobar
**/	
public function verificaDuplicidad($tipoDCTO,$folio,$rut,$dv,$archivo)
{
	try {

		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT count(DISTINCT(recibido_foliointerno)) as Total FROM sii_dte_recibido WHERE recibido_archivo = ? GROUP BY recibido_foliointerno";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		if($stmt)
		{
				// $stmt->bind_param("iisi",$tipoDCTO,$rut,$dv,$folio);
			$stmt->bind_param("s",$archivo);
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
				return count($arrayName);
					// exit;
					// if(count($arrayName) == 0)
					// {
						// return array("Respuesta" => false);
					// }else{
						// return array("Respuesta" => true, "Mensaje" => "DTE ya existe.");
					// }
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
* Método que permite verificar la duplicidad de un DTE dado
* @return Array
* @param Integer $recibido_tipo_dcto Tipo de documento enviado
* @param Integer $recibido_folio Folio del documento enviado
* @param String $recibido_digest Resumen (DIGEST) de la firma del documento
* @param String $recibido_dteid ID del documento enviado
*
*
**/	
public function verificaDuplicidadDTE($recibido_tipo_dcto,$recibido_folio,$recibido_digest,$recibido_dteid)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_dte_recibido WHERE recibido_tipo_dcto = ? AND recibido_folio = ? AND recibido_digest = ? AND recibido_dteid = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		if($stmt)
		{
			$stmt->bind_param("iiss",$recibido_tipo_dcto,$recibido_folio,$recibido_digest,$recibido_dteid);
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
				return count($arrayName);
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
* Método que permite la verificacion de la firma del DTE con el esqueda proporcionado por el S.I.I.
* @return Boolean
* @param String $ruta Ruta del archivo XML a consultar
* @param String $archivo Nombre del archivo a consultar
**/	
public function verificaFirma($ruta,$archivo)
{
	$objValidate = new Validate();
	$ruta_archivo = $ruta."/".$archivo;
	$contenido = file_get_contents($ruta_archivo);
	$xml = new XML();
	$xml->loadXML($contenido);

	$valida = $objValidate->validateSCHEMA("DTE",$xml->saveXML());
	if($valida == "")
	{
		return true;
	}else{
		return false;
	}
}

/**
* Método que obtiene el listado de todos los documentos recibidos registrados en el sistema que han sido cargados
* @return Array
**/	
public function getDTEREcibidos($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		// $query = "SELECT * FROM sii_dte_recibido a INNER JOIN sii_dcto b ON b.dcto_codigo = a.recibido_tipo_dcto WHERE a.recibido_acuse_1 IS NULL OR a.recibido_acuse_2 IS NULL OR a.recibido_acuse_3 IS NULL";
		$query = "SELECT * FROM sii_dte_recibido a INNER JOIN sii_dcto b ON b.dcto_codigo = a.recibido_tipo_dcto WHERE (a.recibido_acuse_1 IS NULL OR a.recibido_acuse_2 IS NULL OR a.recibido_acuse_3 IS NULL) AND a.recibido_region = ?";
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
* Método que permite obtener el detalle de un DTE recibido
* @return Array
* @param Integer $input ID del arhivo consultado
**/	
public function getDetalleArchivo($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_dte_recibido WHERE recibido_id = ?";
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
* Método que obtiene todos los documentos que tienen aprobacion comercial para hacer el acuse de recibo de mercaderia respectivo
* @param Integer $input Folio interno donde buscara los documentos
* @return Array Con el resultado de la consulta
**/
public function getDetalleArchivo3($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_dte_recibido WHERE recibido_acuse_1 = 0 AND recibido_acuse_2 = 0 AND recibido_foliointerno = ?";
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
* Método que permite actualizar el estado de recepcion del dte
* @return Array
* @param Integer $recepcion_estado Estado de la recepcion de envio del documento
* @param Integer $recepcion_id ID del documento recibido
**/	
public function actualizaRecibo1($recepcion_estado,$recepcion_id)
{
	try {
		$objDbConnect = new db_connect();
		$null = NULL;
		$query = "UPDATE sii_dte_recibido SET recibido_acuse_1 = ? WHERE recibido_id = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);

		if($stmt)
		{

			$stmt->bind_param("si",$recepcion_estado,$recepcion_id);

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

/**
* Método que permite actualizar el estado de recepcion del dte
* @return Array
* @param Integer $recepcion_estado Estado de la recepcion de envio del documento
* @param Integer $recepcion_id ID del documento recibido
**/
public function actualizaRecibo2($recepcion_estado,$recepcion_id)
{
	try {
		$objDbConnect = new db_connect();
		$null = NULL;
		$query = "UPDATE sii_dte_recibido SET recibido_acuse_2 = ? WHERE recibido_id = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		if($stmt)
		{

			$stmt->bind_param("si",$recepcion_estado,$recepcion_id);

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

/**
* Método que permite actualizar el estado de recepcion del dte
* @return Array
* @param Integer $recepcion_estado Estado de la recepcion de envio del documento
* @param Integer $recepcion_id ID del documento recibido
**/
public function actualizaRecibo3($recepcion_estado,$recepcion_id)
{
	try {
		$objDbConnect = new db_connect();
		$null = NULL;
		$query = "UPDATE sii_dte_recibido SET recibido_acuse_3 = ? WHERE recibido_id = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);

		if($stmt)
		{
			$stmt->bind_param("si",$recepcion_estado,$recepcion_id);

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


/**
* Método que permite obtener el detalle de un dte recibido
* @return Array
* @param Integer $input ID del documento solicitado
**/	
public function getDetalleRecibo($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_dte_recibido WHERE recibido_foliointerno = ?";
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
* Método que obtiene todos los documentos que tienen los 3 acuses
* @param Integer $input Region de los documentos a consultar
* @return Array Respuesta de la consulta efectuada
**/
public function getDTERecibidosCompletados($input)
{
	try {
				$objDbConnect = new db_connect();
				$arrayName = array();
				$max = 0;
				$query = "SELECT * FROM sii_dte_recibido a INNER JOIN sii_dcto b ON b.dcto_codigo = a.recibido_tipo_dcto WHERE a.recibido_acuse_1 = 0 AND a.recibido_acuse_2 = 0 AND a.recibido_acuse_3 = 0 AND recibido_region = ?";
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
}
?>