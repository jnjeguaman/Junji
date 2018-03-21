<?php
require_once("class.db_connect.php");
/**
* Clase que permite la interaccion con la cuenta del usuario logeado al sistema
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Usuario
{
	private $_id;	
	function __construct($input)
	{
		$this->_id = $input;
	}

	/**
	* Función que permite obtener el detalle del usuario solicitado
	* @return Array $arrayName con el resultado de la consulta
	**/
	public function getDetalleUsuario()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_usuario where usuario_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$this->_id);
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
	* Método que permite actualizar la informacion del usuario
	* @param Array $input Informacion proveniente del formulario
	* @return Array con el resultado de la consulta
	**/
	public function actualizarUsuario($input)
	{
		try {

			if($input["usuario_password"] <> "" && $input["usuario_password2"] <> "")
			{
				$response = $this->verificarPassword($input["usuario_password"],$input["usuario_password2"]);
			}

			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_usuario SET usuario_nombre = ?, usuario_apellido_paterno = ?, usuario_apellido_materno = ? WHERE usuario_id = ? ";
			$stmt = $objDbConnect->getConnection()->prepare($query);


			if($stmt)
			{
				$stmt->bind_param("sssi",$input["usuario_nombre"],$input["usuario_apellido_paterno"],$input["usuario_apellido_materno"],$this->_id);

				if($stmt->execute())
				{
					if($response["Respuesta"] == 1)
					{
						return array("Respuesta" => true,"Mensaje" => "Password");
					}else{
						return array("Respuesta" => true,"Mensaje" => "Información actualizada con exito!");
					}
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

	/**
	* Método que permite comprobar la contraseña enviada con la registrada en la base de datos
	* @param String $password Contraseña actual del usuario
	* @param String $password2 Nueva contraseña del usuario
	* @return Array con la respuesta de la consulta
	**/
	private function verificarPassword($password,$password2)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_usuario WHERE usuario_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$this->_id);
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

					$dbPassword = $arrayName[1]["usuario_password"];
					$frmPassword = md5($password);

					if(strcmp($dbPassword, $frmPassword) === 0)
					{
						return $this->actualizarPassword($password2);
					}else{
						return array("Respuesta" => false,"Mensaje" => "Contraseña no coincida");
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
	* Functión que permite actualizar la contraseña del usuario
	* @param String $input Contraseña del usuario
	* @return Array con la respuesta de la consulta
	**/
	private function actualizarPassword($input)
	{
		try {
			$password = md5($input);
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_usuario SET usuario_password = ? WHERE usuario_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("si",$password,$this->_id);

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
}
?>