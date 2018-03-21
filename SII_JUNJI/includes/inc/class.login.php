<?php
require_once("class.db_connect.php");

/**
 * Clase para realizar el login al sistema
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Login
{
	private $_usuario_rut;
	private $_usuario_password;
	function __construct($usuario_rut,$usuario_password)
	{
		$this->_usuario_rut = $usuario_rut;
		$this->_usuario_password = md5($usuario_password);
	}

	/**
	* Método que permite autenticar al usuario en el sistema
	* @return Boolean
	**/
	public function login()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_usuario WHERE usuario_rut = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$this->_usuario_rut);
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
					// SE COMPRUEBA QUE EL USUARIO ESTE HABILITADO
					if($arrayName[1]["usuario_estado"] == 1)
					{

					// COMPROBAMOS LAS CONTRASEÑAS
						$password_formulario = $this->_usuario_password;
						$password_bd = $arrayName[1]["usuario_password"];

						if(strcasecmp($password_formulario, $password_bd) === 0)
						{
							session_start();
							$_SESSION["sii"]["usuario_rut"] = $arrayName[1]["usuario_rut"]."-".$arrayName[1]["usuario_dv"];
							$_SESSION["sii"]["usuario_conectado"] = true;
							$_SESSION["sii"]["usuario_nombre"] = $arrayName[1]["usuario_nombre"];
							$_SESSION["sii"]["usuario_apellido_paterno"] = $arrayName[1]["usuario_apellido_paterno"];
							$_SESSION["sii"]["usuario_apellido_materno"] = $arrayName[1]["usuario_apellido_materno"];
							$_SESSION["sii"]["usuario_region"] =  $arrayName[1]["usuario_region"];
							$_SESSION["sii"]["usuario_id"] = $arrayName[1]["usuario_id"];

							return array("Respuesta" => true,"Mensaje" => "Usuario Autenticado.");
						}else{
							return array("Respuesta" => false,"Mensaje" => "Nombre de usuario y/o contraseña incorrecta.");
						}	

					}else{
						return array("Respuesta" => false,"Mensaje" => "Usuario Bloqueado.");
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
}
?>