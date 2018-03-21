<?php
require_once("class.db_connect.php");
/**
* 
*/
class Ciudades
{
	
	function __construct()
	{
		# code...
	}

	public function getCiudades($input)
	{
		try {
					$objDbConnect = new db_connect();
					$arrayName = array();
					$max = 0;
					$query = "SELECT * FROM sii_comuna WHERE comuna_estado = 1 AND comuna_provincia_id	 = ?";
					$stmt = $objDbConnect->getConnection()->prepare($query);
					if($stmt)
					{
						$stmt->bind_param("i",$input["provincia_id"]);
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