<?php
require_once("class.db_connect.php");
/**
* Clase que permite obtener los acceso del usuario deseado
*/
class Acceso
{
	private $_rut;
	private $_dv;
	function __construct($input)
	{
		$pizza = explode("-",$input);
		$this->_rut=$pizza[0];
		$this->_dv =$pizza[1];
	}

	/**
	* Funcion que permite obtener los accesos y permisos
	* otorgados a un usuario en especifico
	* @return Array $arrayName Listado de los permisos registrados en la base de datos.
	**/
	function getAcceso()
	{
		try {
					$objDbConnect = new db_connect();
					$arrayName = array();
					$max = 0;
					$query = "SELECT * FROM sii_usuario WHERE usuario_rut = ? AND usuario_dv = ?";
					$stmt = $objDbConnect->getConnection()->prepare($query);
					if($stmt)
					{
						$stmt->bind_param("is",$this->_rut,$this->_dv);
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