<?php
require_once("class.db_connect.php");

/**
* 
*/
class Documentos
{
	private $_tipoDCTO;
	private $_referencia;
	private $_folio;

	function __construct($tipoDCTO = null,$referencia = null,$folio = null)
	{
		$this->_tipoDCTO = $tipoDCTO;
		$this->_referencia = $referencia;
		$this->_folio = $folio;
	}

	public function getDocumentos()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dcto WHERE dcto_estado = 1";
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

	public function nuevoDTE($input,$cliente_id,$cotizacion_id)
	{
		
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$fecha = Date("Y-m-d");
			$hora = Date("H:i:s");
			$ruta = "Documentos/".$this->_tipoDCTO."/";
			$archivo = $this->_referencia;

			$query = "INSERT INTO sii_dte VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("issssssiiiiiiiiiiiss",$null,$this->_tipoDCTO,$ruta,$archivo,$input->TRACKID,$fecha,$hora,$input->STATUS,$this->_folio,$cliente_id,$cotizacion_id,$null,$null,$null,$null,$null,$null,$null,$null,$null);

				if($stmt->execute())
				{
					return true;
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

	/**
	* Funcion que nos permite buscar todos los documentos generados segun la region del usuario
	* @param Integer $input Tipo de documento a solicitar (33,34,52,56,61)
	* @param Integer $region Region del usuario
	* @return $arrayName Resultado obtenido de la consulta
	**/
	public function getDocumentosDTE($input,$region,$periodo)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			if($region <> 17)
			{
				$where = " AND a.dte_region = ? ";
			}else{
				$where = "";
			}

			$query = "SELECT * FROM sii_dte a INNER JOIN sii_cotizacion b ON b.cotizacion_id = a.dte_cotizacion_id INNER JOIN sii_cliente c ON c.cliente_id = b.cotizacion_cliente_id INNER JOIN sii_dcto d on d.dcto_codigo = a.dte_dcto_id WHERE a.dte_estado = 0 AND a.dte_dcto_id = ? ".$where." AND YEAR(dte_fecha) = ".$periodo[0]." AND MONTH(dte_fecha) = ".$periodo[1]." ORDER BY dte_id DESC";
			
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				$stmt->bind_param("ii",$input,$region);
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

	public function getDocumentosDTE2()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dte a INNER JOIN sii_cotizacion b ON b.cotizacion_id = a.dte_cotizacion_id INNER JOIN sii_cliente c ON c.cliente_id = b.cotizacion_cliente_id INNER JOIN sii_dcto d ON d.dcto_codigo = a.dte_dcto_id WHERE a.dte_estado = 0 AND (a.dte_dcto_id = 33 || a.dte_dcto_id = 56 || a.dte_dcto_id = 34)";
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

	public function getDocumentosDTE3()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dte a INNER JOIN sii_cotizacion b ON b.cotizacion_id = a.dte_cotizacion_id INNER JOIN sii_cliente c ON c.cliente_id = b.cotizacion_cliente_id INNER JOIN sii_dcto d ON d.dcto_codigo = a.dte_dcto_id WHERE a.dte_estado = 0 AND (a.dte_dcto_id = 33 || a.dte_dcto_id = 34 || a.dte_dcto_id = 61)";
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

	public function getDetalleDTE($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * 
			FROM 
			sii_dte a 
			LEFT JOIN sii_detalle_dte b ON a.dte_id = b.detalle_dte_id 
			LEFT JOIN sii_cliente d ON d.cliente_id = a.dte_cliente_id
			INNER JOIN sii_dcto g ON g.dcto_codigo = a.dte_dcto_id
			
			WHERE a.dte_id = ?";
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
	* Funcion que nos permite buscar todos los documentos generados segun la region del usuario
	* @param $input Tipo de documento a solicitar (33,52,56,61)
	* @param $region Region del usuario
	* @return $arrayName Resultado obtenido de la consulta
	**/
	public function getDocumentoDTE_52($input,$region,$periodo)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			if($region <> 17)
			{
				$where = " AND a.dte_region = ? ";
			}else{
				$where = "";
			}
			$query = "SELECT * FROM sii_dte a  INNER JOIN sii_empresa c ON c.empresa_id = a.dte_cliente_id WHERE a.dte_estado = 0 AND a.dte_dcto_id = ? ".$where." AND YEAR(dte_fecha) = ".$periodo[0]." AND MONTH(dte_fecha) = ".$periodo[1];
			
			//saque ESTE JOIN - INNER JOIN cae12628_junji.bode_orcom b ON b.oc_id = a.dte_cotizacion_id 
			
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				if($region<>17)
				{
					$stmt->bind_param("ii",$input,$region);
				}else{
					$stmt->bind_param("i",$input);
				}
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
				echo "ERROR : ";
				return false;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

}
?>