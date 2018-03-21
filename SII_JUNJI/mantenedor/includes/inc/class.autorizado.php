<?php
require_once("class.db_connect.php");
/**
* Clase que permite tranajar con las personas autorizadas a realizar ciertas acciones dentro del sistema, tales como firmar los Documentos Trinutarios Electronicos
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Autorizado
{
	function __construct()
	{
		
	}

	/**
	* Método que permite comprobar si un usuario está autorizado a firmar un determinado DTE
	* @return Boolean
	**/

	public function actualizarAutorizacion($input)
	{
		try {
			try {
				$objDbConnect = new db_connect();
				$null = NULL;
				
				$query = "UPDATE sii_usuario SET usuario_autorizado_".$input["autorizado_tipo"]." = ? WHERE usuario_id = ?";
				$stmt = $objDbConnect->getConnection()->prepare($query);

				if($stmt)
				{

					$stmt->bind_param("ii",$input["estado"],$input["usuario_id"]);

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
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que obtiene el listado de los DTE permitidos a firmar digitalmente
	* @param Integer $input RUT del usuario a consultar
	* @return Array Retorno de datos consultados
	**/
	public function getAutorizaciones($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_autorizado WHERE autorizado_rut = ?";
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
	* Funcion que permite el ingreso de una nueva persona al listado de usuarios autorizados
	* @param Array $input Informacion del usuario
	* @return Array Respuesta de la consulta generada 
	**/
	public function nuevoAutorizado($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "INSERT INTO sii_autorizado VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$default = 0;
			$estado = 1;
			$rut = str_replace(".","",$input["usuario_rut"]);
			if($stmt)
			{
				
				$stmt->bind_param("issiiiiiiiiii",$null,$rut,$input["usuario_dv"],$input["usuario_region"],$input["usuario_estado"],$default,$default,$default,$default,$default,$default,$default,$default);
				
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

	/**
	* Metodo que habilita / deshabilita a un usuario determinado firmar y emitir documentos tributarios electrónicos
	* @param Array $input Informacion proveniente del formulario a actualizar
	* @return Array Respuesta de la consulta generada
	**/
	public function actualizarAutorizacionEstado($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_usuario SET usuario_autorizado_firmar = ? WHERE usuario_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("ii",$input["estado"],$input["usuario_id"]);

				if($stmt->execute())
				{
					return array("Respuesta" => true,"Mensaje" => "Informacion actualizada con exito");
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