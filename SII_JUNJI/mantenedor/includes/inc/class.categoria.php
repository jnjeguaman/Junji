<?php
require_once("class.db_connect.php");
/**
* 
*/
class Categoria
{
	
	function __construct()
	{
		# code...
	}

	public function crearCategoria($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_categoria VALUES(?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("isi",$null,$input["categoria_nombre"],$input["categoria_estado"]);

				if($stmt->execute())
				{
					return array("Respuesta" => true);
				}else{
					return array("Respuesta" => false,"Mensaje" => $stmt->error);
				}
			}else{
				return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en la consulta SQL");
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function getCategorias()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT count(producto_id) as totalProductos,a.categoria_estado,a.categoria_glosa,a.categoria_id FROM sii_categoria a LEFT JOIN sii_productos b on b.producto_categoria_id = a.categoria_id group by a.categoria_id";
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

	public function getDetalleCategoria($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_categoria WHERE categoria_id = ?";
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

	public function editarCategoria($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = " UPDATE sii_categoria SET categoria_glosa = ?, categoria_estado = ? WHERE categoria_id = ? ";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("sii",
					$input["categoria_glosa"],
					$input["categoria_estado"],
					$input["categoria_id"]);

				if($stmt->execute())
				{
					return array("Respuesta" => true,"Mensaje" => "OK");
				}else{
					return array("Respuesta" => false,"Mensaje" => $stmt->error);
				}
			}else{
				return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en la consulta SQL");
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
?>