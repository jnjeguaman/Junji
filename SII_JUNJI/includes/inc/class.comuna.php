<?php
require_once("class.db_connect.php");

/**
 * Clase para trabajar con las comunas registradas en el sistema
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Comunas
{
	
	function __construct(){}

	/**
	* Método que permite obtener el listado de las comunas activas del sistema
	* @return XML
	**/
	public function getComunas()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_ciudad WHERE ciudad_estado = 1";
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