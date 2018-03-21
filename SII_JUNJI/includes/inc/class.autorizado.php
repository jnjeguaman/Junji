<?php
// require_once("class.db_connect.php");
/**
* Clase que permite tranajar con las personas autorizadas a realizar ciertas acciones dentro del sistema, tales como firmar los Documentos Trinutarios Electronicos
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Autorizado
{
	private $_region;
	private $_tipoDCTO;
	private $_rut;
	function __construct($region = null,$tipoDCTO = null,$rut = null)
	{
		$this->_region = $region;
		$this->_tipoDCTO = $tipoDCTO;
		$this->_rut = $rut;
	}

	/**
	* Método que permite comprobar si un usuario está autorizado a firmar un determinado DTE
	* @return Boolean
	**/

	public function validaUsuario()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT usuario_autorizado_".$this->_tipoDCTO." as esValido FROM sii_usuario WHERE usuario_rut = ? and usuario_autorizado_".$this->_tipoDCTO." = 1 AND usuario_autorizado_firmar = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$this->_rut);
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
}
?>