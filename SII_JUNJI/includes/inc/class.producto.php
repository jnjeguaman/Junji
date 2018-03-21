<?php
require_once("class.db_connect.php");

/**
* Clase para utilizar los bienes y/o servicios registrados en el sistema
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Productos
{
	
	function __construct(){}

/**
* Método que permite obtener todos los productos activos del sistema
* @return Array
* @param Integer $input ID de la categoria especifica donde buscar
**/
public function getProductos($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_productos WHERE producto_categoria_id = ? AND producto_estado = 1";
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
* Método que permite obtener el precio unitario neto de un item especifico
* @return Array
* @param Integet $input ID del producto solicitado
**/
public function getUnitario($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_productos WHERE producto_id = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		if($stmt)
		{
			$stmt->bind_param("i",$input["producto_id"]);
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
}
?>