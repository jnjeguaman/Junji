<?php
require_once("class.db_connect.php");
require_once("class.xml.php");

/**
 * Clase para trabajar con el Codigo Autenticador de Folios (CAF)
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class CAF
{
	private $_tipoDcto;
	private $_filename;
	private $_region;
	function __construct($tipoDCTO,$region)
	{
		$this->_tipoDcto = $tipoDCTO;
		$this->_region = $region;
	}

	/**
	* Funcion que permite obtener la ruta del archivo CAF para el timbraje de los DTE
	* @return Array con los datos solicitados por la aplicación
	**/
	public function getCAF()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_folio WHERE folio_tipo = ? AND folio_estado = 1 AND folio_region = ? LIMIT 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("ii",$this->_tipoDcto,$this->_region);
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
	* Método que permite obtener el nodo CAF del XML para autenticar y timbrar el DTE
	* @return XML
	**/
	public function getCAF2()
	{
		$response = $this->getCAF();
		$contenido = dirname(__DIR__)."/CAF/".$response[1]["folio_tipo"]."/".$response[1]["folio_file"];
		$data = utf8_encode(file_get_contents($contenido));

		$xml = new XML();
		$xml->preserveWhiteSpace = true;
		$xml->loadXML($data);
		$xml->preserveWhiteSpace = true;
		
		return $xml->getElementsByTagName("CAF")->item(0);
	}

	/**
	* Funcion que permite obtener la llave privada del archivo CAF
	* @return String
	**/
	public function getPkey()
	{
		$response = $this->getCAF();
		$contenido = dirname(__DIR__)."/CAF/".$response[1]["folio_tipo"]."/".$response[1]["folio_file"];
		$data = utf8_encode(file_get_contents($contenido));
		$doc = new XML();
		$doc->loadXML($data);
		$pkey = trim($doc->documentElement->getElementsByTagName("RSASK")->item(0)->nodeValue);
		return $pkey;
	}

	/**
	* Método que permite obtener último folio ingresado al sistema segun tipo de documento solicitado.
	* @return Array
	**/
	public function getFolio($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_folio WHERE folio_tipo = ? AND folio_estado = 1 LIMIT 1";
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
	* Método que permite actualizar el último folio utilizado segun tipo de documento dado
	* @return Boolean
	**/
	public function actualizarFolio($folio,$tipo_dcto,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_folio SET folio_actual = ? WHERE folio_tipo = ? AND folio_region = ? AND folio_estado = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				$stmt->bind_param("iii",$folio,$tipo_dcto,$region);
				
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
	* Método que permite validar el folio enviado con el rango del CAF autorizado en el sistema o si no quedan folios disponibles
	* @return Boolean
	**/
	public function validaFolio($folio,$tipo_dcto,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_folio WHERE folio_tipo = ? AND folio_estado = 1 AND folio_region = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				$stmt->bind_param("ii",$tipo_dcto,$region);
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
					if($folio >= $arrayName[1]["folio_inicio"] && $folio <= $arrayName[1]["folio_fin"])
					{
						return array("Respuesta" => true);
					}else{
						return array("Respuesta" => false,"Mensaje" => "No hay folios disponibles.");
					}
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
