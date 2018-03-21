<?php
require_once("class.db_connect.php");
/**
*
*/
class Cliente
{
	private $_siiDatos;
	function __construct($input)
	{
		$this->_siiDatos = $input;
	}

	public function nuevoCliente()
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_cliente VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$estado = 1;
			$tipo = 34;
			if($stmt)
			{

				$stmt->bind_param("issssssisssii",
					$null,
					$this->_siiDatos["cliente_razon_social"],
					trim(str_replace('.','',$this->_siiDatos["cliente_rut"])),
					$this->_siiDatos["cliente_dv"],
					$this->_siiDatos["cliente_direccion"],
					$this->_siiDatos["cliente_provincia_id"],
					$this->_siiDatos["cliente_comuna_id"],
					$estado,
					$this->_siiDatos["cliente_giro"],
					$this->_siiDatos["cliente_correo_contacto"],
					$this->_siiDatos["cliente_correo_intercambio"],
					$this->_siiDatos["cliente_actividad_economica"],
					$this->_siiDatos["cliente_tipo"]);

				if($stmt->execute())
				{
					return array("Respuesta" =>true);
				}else{
					return array("Respuesta" => false, "Mensaje" => $stmt->error);
				}
			}else{
				return array("Respuesta" =>false,"Mensaje" => "Ha ocurrido un error en la consulta SQL");
			}
		}catch (Exception $e) {
			return array("Respuesta" => false,"Mensaje" => $e->getMessage());
		}
	}

	public function getClientes()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_cliente WHERE cliente_estado = 1";
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

	public function getDetalleCliente($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_cliente WHERE cliente_id = ?";
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

	public function editarCliente($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_cliente SET cliente_empresa = ?,cliente_direccion = ?,cliente_provincia_id = ?,cliente_comuna_id = ?,cliente_estado = ?,cliente_giro = ?,cliente_correo_contacto = ?,cliente_correo_intercambio = ?,cliente_actividad_economica = ? WHERE cliente_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("ssssisssii",$input["cliente_razon_social"],$input["cliente_direccion"],$input["cliente_provincia_id"],$input["cliente_comuna"],$input["cliente_estado"],$input["cliente_giro"],$input["cliente_correo_contacto"],$input["cliente_correo_intercambio"],$input["cliente_actividad_economica"],$input["cliente_id"]);

				if($stmt->execute())
				{
					return array("Respuesta" => true);
				}else{
					return array("Respuesta" => false,"Mensaje" => $stmt->error);
				}
			}else{
				$error = error_get_last();
				return array("Respuesta" => false,"Mensaje" => $error["message"]);
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function cargaExcel($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_cliente VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$totalElementos = count($this->_siiDatos) + 1;
			$estado = 1;
			$correctos = 0;
			$incorrectos = 0;
			
			if($stmt)
			{
				for($i=2;$i<=$totalElementos;$i++)
				{
					$this->_siiDatos[$i]["a2"]."<br>";
					$stmt->bind_param("isissssisssii",
						$null,
						strtoupper($this->_siiDatos[$i]["a2"]),
						$this->_siiDatos[$i]["a3"],
						strtoupper($this->_siiDatos[$i]["a4"]),
						strtoupper($this->_siiDatos[$i]["a5"]),
						$this->_siiDatos[$i]["a6"],
						$this->_siiDatos[$i]["a7"],
						$estado,
						strtoupper($this->_siiDatos[$i]["a9"]),
						strtolower($this->_siiDatos[$i]["a10"]),
						strtolower($this->_siiDatos[$i]["a11"]),
						$this->_siiDatos[$i]["a12"],
						$this->_siiDatos[$i]["a13"]);

					if($stmt->execute())
					{
						$correctos++;
					}else{
						$incorrectos++;
					}
					
				}

				return array("Respuesta" => true,"Mensaje" => "Carga completada","Correctos" => $correctos,"Incorrectos" => $incorrectos);
			}else{
				return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en la consulta SQL");
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
		
	}

}

?>
