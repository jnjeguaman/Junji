<?php
require_once("class.db_connect.php");
/**
* 
*/
class Comunas
{
	
	function __construct()
	{
		# code...
	}

	public function getComunas($input)
	{
		try {
					$objDbConnect = new db_connect();
					$arrayName = array();
					$max = 0;
					$query = "SELECT * FROM sii_provincia WHERE provincia_estado = 1 AND provincia_region_id = ?";
					$stmt = $objDbConnect->getConnection()->prepare($query);
					if($stmt)
					{
						$stmt->bind_param("i",$input["region_id"]);
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