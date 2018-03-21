<?php
require_once("class.db_connect.php");
/**
* Clase para trabajar con los recintos de entrega de productos y/o servicios
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Recinto
{
	
	private $_region;

	function __construct($input)
	{
		$this->_region = $input;
	}

	/**
	* Método que despliega todos los recintos posibles en donde se puede recibir la mercaderia y/o servicio.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Array
	**/
	public function getRecintos()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_recinto WHERE recinto_region = ? AND recinto_estado = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$this->_region);
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						$max += 1;
						foreach ($row as $key => $value)
						{
							$arrayName[$max][$key] = utf8_decode($value);
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