<?php
require_once("class.db_connect.php");
require_once("class.autorizado.php");
/**
* Clase que permite interactuar con la cuenta del usuario
* @author Freddy Varas Henríquez (fvaras@pradi.cl)
*/
class Usuario
{
	
	function __construct(){}

	/**
	* Método que permite el ingreso de un nuevo usuario al sistema
	* @param Array $input Datos del formulario
	* @return Array Respuesta de la consulta
	**/
	public function crearUsuario($input,$archivo)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_usuario VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$usuario_tipo = 0;

			$cargaCertificado = self::cargaCertificado($input,$archivo);
			if(!$cargaCertificado["Respuesta"]) return $cargaCertificado;
			if($stmt)
			{

				$rut = trim(str_replace(".","",$input["usuario_rut"]));
				$stmt->bind_param("isssissiissiiiiiiiiiiis",$null,$input["usuario_nombre"],$input["usuario_apellido_paterno"],$input["usuario_apellido_materno"],$rut,$input["usuario_dv"],md5($input["usuario_password"]),$input["usuario_estado"],$input["usuario_region"],$cargaCertificado["Ruta"],base64_encode($cargaCertificado["Password"]),$null,$null,$null,$null,$null,$null,$null,$null,$null,$input["usuario_sistema"],$usuario_tipo,strtolower($input["usuario_inedis"]));

				if($stmt->execute())
				{
					// $objAutorizado = new Autorizado();
					// $objAutorizado->nuevoAutorizado($input);
					return array("Respuesta" => true,"Mensaje" => "Usuario creado correctamente!");
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
	* Método que permite la carga al sistema de un certificado digital
	* @param Array $input Informacion del usuario.
	* @param Files $archivo Informacion del archivo cargado
	* @return Boolean Respuesta de la carga del fichero en el sistema
	**/
	private function cargaCertificado($input,$archivo)
	{
		try {
			$extensionValida = array("PFX");
			$extension = strtoupper(pathinfo($archivo["usuario_certificado"]["name"],PATHINFO_EXTENSION));

			// COMPROBAMOS QUE SEA LA EXTENSION USADA POR EL SISTEMA
			if(in_array($extension, $extensionValida))
			{
						// SE COMPRUEBA QUE EL CERTIFICADO PUEDA SER LEIDO
				if(is_readable($archivo["usuario_certificado"]["tmp_name"]))
				{
							// COMPROBAMOS QUE EL CERTIFICADO SEA PXCS12
					if($archivo["usuario_certificado"]["type"] == "application/x-pkcs12")
					{								
								// VERIFICAMOS QUE EL ARCHIVO NO TENGA ERRORES
						if($archivo["usuario_certificado"]["error"] == 0)
						{
							// COMPROBAMOS QUE LA CONTRASEÑA DADA SEA LA CORRECTA

							$contenido = file_get_contents($archivo["usuario_certificado"]["tmp_name"]);
							openssl_pkcs12_read($contenido, $certs, $input["usuario_certificado_password"]);
							if(count($certs["cert"]))
							{

								$nombre_archivo = trim(str_replace(".","",$input["usuario_rut"]).$input["usuario_dv"]."_".$input["usuario_region"].".".$extension);
							// COPIAMOS EL CERTIFICADO EN LA CARPETA
								$destino = "../../includes/inc/certificados/".$nombre_archivo;
								$ruta = "certificados/".$nombre_archivo;
								if(copy($archivo["usuario_certificado"]["tmp_name"],$destino))
								{
									return array("Respuesta" => true,"Ruta" => $ruta,"Password" => $input["usuario_certificado_password"]);
								}else{
									return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error al cargar el certificado");
								}

							}else{
								return array("Respuesta" => false,"Mensaje" => "Contraseña del certificado incorrecta");
							}

						}else{
							return array("Respuesta" => false,"Mensaje" => "El archivo corrompido");
						}
					}else{
						return array("Respuesta" => false,"Mensaje" => "Formato del archivo incorrecto.");
					}
				}else{
					return array("Respuesta" => false,"Mensaje" => "El archivo es ilegible");
				}
			}else{
				return array("Respuesta" => false,"Mensaje" => "Extension del archivo inválida. Extensión permitida : PFX");
			}
			
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Function que permite obtener los usuarios registrados en el sistema
	* @return Array $arrayName Resultado de la consulta
	**/
	public function getUsuarios()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_usuario";
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

	/**
	* Funcuón que permite la actualizacion de datos de un usuario deseado
	* @param Array $input Informacion desde el formulario
	* @return Array Respuesta de la consulta
	**/
	public function actualizarUsuario($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_usuario SET usuario_nombre = ?, usuario_apellido_paterno = ?, usuario_apellido_materno = ?, usuario_rut = ?, usuario_dv = ?, usuario_estado = ?, usuario_region = ?, usuario_user = ? WHERE usuario_id = ?
			";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{	
				$rut = trim(str_replace(".", "", $input["usuario_rut"]));
				$stmt->bind_param("sssisiisi",$input["usuario_nombre"],$input["usuario_apellido_paterno"],$input["usuario_apellido_materno"],$rut,$input["usuario_dv"],$input["usuario_estado"],$input["usuario_region"],strtolower($input["usuario_inedis"]),$input["usuario_id"]);

				if($stmt->execute())
				{
					return array("Respuesta" => true,"Mensaje" => "Información actualizada con exito!");
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
	* Function que permite obtener la informacion de un usuaio especifico
	* @param Integer $input ID del usuario solicitado
	* @return Array $arrayName Resultado de la consulta
	**/
	public function getDetalleUsuario($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_usuario WHERE usuario_id = ?";
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

	public function actualizarPassword($input)
	{
		try {
			$Password = md5($input["usuario_password"]);
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "UPDATE sii_usuario SET usuario_password = ? WHERE usuario_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("si",$Password,$input["usuario_id"]);
				if($stmt->execute())
				{
					return true;
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

	public function actualizarCertificado($input,$archivo)
	{
		try {
			$Password = md5($input["usuario_password"]);
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$Password = base64_encode($input["usuario_certificado_password"]);

			$query = "UPDATE sii_usuario SET usuario_certificado_password = ? WHERE usuario_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);


			$cargaCertificado = self::cargaCertificado($input,$archivo);
			if(!$cargaCertificado["Respuesta"]) return $cargaCertificado;

			if($stmt)
			{
				$stmt->bind_param("si",$Password,$input["usuario_id"]);
				if($stmt->execute())
				{
					// $objAutorizado = new Autorizado();
					// $objAutorizado->nuevoAutorizado($input);
					return array("Respuesta" => true,"Mensaje" => "Certificado actualizado correctamente!");
				}else{
					return array("Respuesta" => false,"Mensaje" => $stmt->error);
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