<?php
/**
* Clase que permite traer informacion de la bodega a traves del sistema INEDIS
*/
require_once("class.db_connect.php");
class Bodega 
{
	
	function __construct()
	{
		# code...
	}


	public function getDatosBodega($input)
	{
		try {
					$objDbConnect = new db_connect();
					$arrayName = array();
					$max = 0;
					$query = "SELECT * FROM bode_orcom WHERE oc_dte_id = ?";
					echo $query;
					$stmt = $objDbConnect->getConnectionINEDIS()->prepare($query);
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
							print_r($arrayName);
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