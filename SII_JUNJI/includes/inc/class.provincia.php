<?php
require_once("class.db_connect.php");

/**
* Clase para utilizar las provincias registradas en el sistema
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Provincia
{
	private $_provincia_region_id;
	function __construct($input)
	{
		$this->_provincia_region_id = $input;
	}

/**
* Método que permite obtener las provincias disponibles del sistema
* @return Array
**/
	public function getProvincias()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_provincia WHERE provincia_region_id = ? AND provincia_estado = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$this->_provincia_region_id);
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