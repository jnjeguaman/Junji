<?php
require_once("class.db_connect.php");

/**
 * Clase para trabajar con los DTE y las referencias de los mismos
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Referencia
{
	
	function __construct(){}

	/**
	* Método que obtiene el listado de las referencias disponibles que se pueden generar
	* @return Array
	**/
	public function getReferencia()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dcto_ref";
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
	* Método que obtiene el detalle de una referencia dada
	* @return Array
	* @param Integer $input Codigo de la referencia
	**/
	public function getDetalleReferencia($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dcto_ref WHERE ref_codigo = ? LIMIT 1";
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
	* Método que comprueba y lista si un documento dado tiene otros documentos que lo referencien.
	* @return Array
	* @param Integer $input ID del DTE buscado
	**/
	public function getReferencias($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_referencia a 
			INNER JOIN sii_dte b ON b.dte_id = a.referencia_dte_id 
			INNER JOIN sii_dcto c ON c.dcto_codigo = b.dte_dcto_id 
			WHERE a.referencia_referencia_id = ?";
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
					if(sizeof($arrayName) == 0)
					{
						return array("Respuesta" => false,"Mensaje" => "No existen documentos referenciados para este DTE");
					}else{
						return array("Respuesta" => true,"Mensaje" => $arrayName);
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
	* Método que obtiene el listado de las referencias de un determinado DTE
	* @return Array
	**/
	public function buscarReferencia($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dte WHERE dte_cotizacion_id = ?";
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
	* Método que obtiene todos los impuestos asociados a un id de un tipo de documento que se recibe por parametro
	* @return Array
	**/
	public static function getImpuestosAsociadosDocumento($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = 'SELECT b.otros_imp_id,b.otros_imp_cod,b.otros_imp_glosa,b.otros_imp_tasa FROM sii_asignacion_otros_dcto a join sii_otros_imp b on a.asignacion_id_otros_imp = b.otros_imp_id where a.asignacion_id_dcto ='.$input;
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
}
?>