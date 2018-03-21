<?php
require_once("class.db_connect.php");

/**
 * Clase para trabajar con las categorias de productos del sistema
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Categorias
{
	function __construct(){}

	/**
	* Método que permite obtener el listado de las categorias activas del sistema
	* @return Array
	**/
	public function getCategorias()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_categoria WHERE categoria_estado = 1";
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