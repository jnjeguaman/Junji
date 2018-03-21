<?php
require_once("class.db_connect.php");

/**
 * Clase para trabajar con los datos de los clientes registrados en el sistema
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Cliente
{
	
	function __construct(){}

	/**
	* Método que permite obtener el listado de los clientes registrados en el sistema
	* @return XML
	**/
	public function getClientesGlobal()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT DISTINCT(recibido_rut) AS cliente_rut, recibido_dv AS cliente_dv, recibido_razon AS cliente_empresa FROM sii_dtews";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$tipo);
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
	* Método que permite obtener el listado de los clientes registrados en el sistema
	* @return XML
	**/
	public function getClientes($tipo)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_cliente WHERE cliente_estado = 1 AND cliente_tipo = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$tipo);
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
	* Método que permite obtener el detalle del cliente
	* @return Array
	* @param Integer con el id del cliente
	**/
	public function getClienteDetalle($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_cliente WHERE cliente_id = ?";
			
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$input["cliente_id"]);
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
	* Método que permite obtener el detalle del cliente mediante el Rut para ser desplegado en el archivo PDF final
	* @return Array
	* @param Array con el rut del cliente y digito verificador
	**/
	public function getClienteDetallePorRut($input)
	{
		try {
			$rut = explode("-", $input);
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_cliente WHERE cliente_rut = ? AND cliente_dv = ? LIMIT 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("ss",$rut[0],$rut[1]);
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
	* Método que permite obtener el detalle del cliente mediante el Rut para ser desplegado en el archivo PDF final
	* @return Array
	* @param Array con el rut del cliente y digito verificador
	**/
	public function getClienteDetallePorRutUnico($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = 'SELECT cli.cliente_empresa,cli.cliente_dv,cli.cliente_id,cli.cliente_rut,prov.provincia_region_id from sii_cliente cli join sii_provincia prov on cli.cliente_provincia_id = prov.provincia_glosa where cli.cliente_rut ='.$input["cliente_rut"];
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
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}



	public function getActividadEconomica($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_actividad_economica WHERE acti_codigo = ?";
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
							$arrayName[$max][$key] = utf8_encode($value);
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

	public function getMisClientes()
	{
		try {
					$objDbConnect = new db_connect();
					$arrayName = array();
					$max = 0;
					$query = "SELECT * FROM sii_cliente";
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